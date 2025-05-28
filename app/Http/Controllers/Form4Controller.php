<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\FormPerumahan;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPdf;

class Form4Controller extends Controller
{
    public function index(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4', compact('bencana'));
    }

    public function format1form4(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format1form4', compact('bencana'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                'rumah_hancur_total_permanen' => 'nullable|integer',
                'rumah_hancur_total_non_permanen' => 'nullable|integer',
                'rumah_rusak_berat_permanen' => 'nullable|integer',
                'rumah_rusak_berat_non_permanen' => 'nullable|integer',
                'rumah_rusak_sedang_permanen' => 'nullable|integer',
                'rumah_rusak_sedang_non_permanen' => 'nullable|integer',
                'rumah_rusak_ringan_permanen' => 'nullable|integer',
                'rumah_rusak_ringan_non_permanen' => 'nullable|integer',
                'harga_satuan_permanen' => 'nullable|numeric',
                'harga_satuan_non_permanen' => 'nullable|numeric',
                'jalan_rusak_berat' => 'nullable|numeric',
                'jalan_rusak_sedang' => 'nullable|numeric',
                'jalan_rusak_ringan' => 'nullable|numeric',
                'harga_satuan_jalan' => 'nullable|numeric',
                'saluran_rusak_berat' => 'nullable|numeric',
                'saluran_rusak_sedang' => 'nullable|numeric',
                'saluran_rusak_ringan' => 'nullable|numeric',
                'harga_satuan_saluran' => 'nullable|numeric',
                'balai_rusak_berat' => 'nullable|integer',
                'balai_rusak_sedang' => 'nullable|integer',
                'harga_satuan_balai' => 'nullable|numeric',
                'tenaga_kerja_hok' => 'nullable|integer',
                'upah_harian' => 'nullable|numeric',
                'alat_berat_hari' => 'nullable|integer',
                'biaya_per_hari' => 'nullable|numeric',
                'harga_sewa_per_bulan' => 'nullable|numeric',
                'jumlah_tenda' => 'nullable|integer',
                'harga_tenda' => 'nullable|numeric',
                'jumlah_barak' => 'nullable|integer',
                'harga_barak' => 'nullable|numeric',
                'jumlah_rumah_sementara' => 'nullable|integer',
                'harga_rumah_sementara' => 'nullable|numeric',
                'bencana_id' => 'nullable|exists:bencana,id'
            ]);

            // Create new form data
            $formPerumahan = FormPerumahan::create($validated);

            DB::commit();

            // Redirect to show page where user can see data and download PDF
            return redirect()->route('forms.form4.show', $formPerumahan->id)
                ->with('success', 'Data berhasil disimpan. Anda dapat mengunduh PDF data ini.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Show a specific form data
     */
    public function show($id)
    {
        $formPerumahan = FormPerumahan::with('bencana')->findOrFail($id);
        $bencana = $formPerumahan->bencana;
        
        return view('forms.form4.show', compact('formPerumahan', 'bencana'));
    }

    /**
     * Generate PDF for form data
     */ 
    public function generatePdf($id)
    {
        $formPerumahan = FormPerumahan::with('bencana.kategori_bencana', 'bencana.desa')->findOrFail($id);
        $bencana = $formPerumahan->bencana;
        
        // Calculate totals
        $totalRumahPermanen = (int)$formPerumahan->rumah_hancur_total_permanen + 
                             (int)$formPerumahan->rumah_rusak_berat_permanen + 
                             (int)$formPerumahan->rumah_rusak_sedang_permanen + 
                             (int)$formPerumahan->rumah_rusak_ringan_permanen;
        
        $totalRumahNonPermanen = (int)$formPerumahan->rumah_hancur_total_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_berat_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_sedang_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_ringan_non_permanen;
        
        $totalJalanRusak = (float)$formPerumahan->jalan_rusak_berat + 
                          (float)$formPerumahan->jalan_rusak_sedang + 
                          (float)$formPerumahan->jalan_rusak_ringan;
        
        $totalSaluranRusak = (float)$formPerumahan->saluran_rusak_berat + 
                            (float)$formPerumahan->saluran_rusak_sedang + 
                            (float)$formPerumahan->saluran_rusak_ringan;
        
        $totalBalaiRusak = (int)$formPerumahan->balai_rusak_berat + 
                          (int)$formPerumahan->balai_rusak_sedang;
        
        // Calculate estimated costs
        $biayaRumahPermanen = $totalRumahPermanen * (float)$formPerumahan->harga_satuan_permanen;
        $biayaRumahNonPermanen = $totalRumahNonPermanen * (float)$formPerumahan->harga_satuan_non_permanen;
        $biayaJalan = $totalJalanRusak * (float)$formPerumahan->harga_satuan_jalan;
        $biayaSaluran = $totalSaluranRusak * (float)$formPerumahan->harga_satuan_saluran;
        $biayaBalai = $totalBalaiRusak * (float)$formPerumahan->harga_satuan_balai;
        
        $biayaHOK = (int)$formPerumahan->tenaga_kerja_hok * (float)$formPerumahan->upah_harian;
        $biayaAlatBerat = (int)$formPerumahan->alat_berat_hari * (float)$formPerumahan->biaya_per_hari;
        $biayaTenda = (int)$formPerumahan->jumlah_tenda * (float)$formPerumahan->harga_tenda;
        $biayaBarak = (int)$formPerumahan->jumlah_barak * (float)$formPerumahan->harga_barak;
        $biayaRumahSementara = (int)$formPerumahan->jumlah_rumah_sementara * (float)$formPerumahan->harga_rumah_sementara;
        
        $totalBiayaKerusakan = $biayaRumahPermanen + $biayaRumahNonPermanen + $biayaJalan + $biayaSaluran + $biayaBalai;
        $totalBiayaKerugian = $biayaHOK + $biayaAlatBerat + (float)$formPerumahan->harga_sewa_per_bulan + $biayaTenda + $biayaBarak + $biayaRumahSementara;
        $totalKeseluruhanBiaya = $totalBiayaKerusakan + $totalBiayaKerugian;
        
        $data = [
            'formPerumahan' => $formPerumahan,
            'bencana' => $bencana,
            'totalRumahPermanen' => $totalRumahPermanen,
            'totalRumahNonPermanen' => $totalRumahNonPermanen,
            'totalJalanRusak' => $totalJalanRusak,
            'totalSaluranRusak' => $totalSaluranRusak,
            'totalBalaiRusak' => $totalBalaiRusak,
            'biayaRumahPermanen' => $biayaRumahPermanen,
            'biayaRumahNonPermanen' => $biayaRumahNonPermanen,
            'biayaJalan' => $biayaJalan,
            'biayaSaluran' => $biayaSaluran,
            'biayaBalai' => $biayaBalai,
            'biayaHOK' => $biayaHOK,
            'biayaAlatBerat' => $biayaAlatBerat,
            'biayaTenda' => $biayaTenda,
            'biayaBarak' => $biayaBarak,
            'biayaRumahSementara' => $biayaRumahSementara,
            'totalBiayaKerusakan' => $totalBiayaKerusakan,
            'totalBiayaKerugian' => $totalBiayaKerugian,
            'totalKeseluruhanBiaya' => $totalKeseluruhanBiaya,
            'tanggal' => date('d-m-Y'),
        ];
        
        // Load view dengan DomPdf dan atur landscape
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('FormPerumahan_' . $formPerumahan->id . '.pdf');
    }

    /**
     * List all form data for a bencana
     */
    public function listData(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::findOrFail($bencana_id);
        $formData = FormPerumahan::where('bencana_id', $bencana_id)->latest()->get();
        
        return view('forms.form4.list', compact('bencana', 'formData'));
    }

    /**
     * Preview PDF tanpa download
     */
    public function previewPdf($id)
    {
        $formPerumahan = FormPerumahan::with('bencana.kategori_bencana', 'bencana.desa')->findOrFail($id);
        $bencana = $formPerumahan->bencana;
        
        // Calculate totals
        $totalRumahPermanen = (int)$formPerumahan->rumah_hancur_total_permanen + 
                             (int)$formPerumahan->rumah_rusak_berat_permanen + 
                             (int)$formPerumahan->rumah_rusak_sedang_permanen + 
                             (int)$formPerumahan->rumah_rusak_ringan_permanen;
        
        $totalRumahNonPermanen = (int)$formPerumahan->rumah_hancur_total_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_berat_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_sedang_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_ringan_non_permanen;
        
        $totalJalanRusak = (float)$formPerumahan->jalan_rusak_berat + 
                          (float)$formPerumahan->jalan_rusak_sedang + 
                          (float)$formPerumahan->jalan_rusak_ringan;
        
        $totalSaluranRusak = (float)$formPerumahan->saluran_rusak_berat + 
                            (float)$formPerumahan->saluran_rusak_sedang + 
                            (float)$formPerumahan->saluran_rusak_ringan;
        
        $totalBalaiRusak = (int)$formPerumahan->balai_rusak_berat + 
                          (int)$formPerumahan->balai_rusak_sedang;
        
        // Calculate estimated costs
        $biayaRumahPermanen = $totalRumahPermanen * (float)$formPerumahan->harga_satuan_permanen;
        $biayaRumahNonPermanen = $totalRumahNonPermanen * (float)$formPerumahan->harga_satuan_non_permanen;
        $biayaJalan = $totalJalanRusak * (float)$formPerumahan->harga_satuan_jalan;
        $biayaSaluran = $totalSaluranRusak * (float)$formPerumahan->harga_satuan_saluran;
        $biayaBalai = $totalBalaiRusak * (float)$formPerumahan->harga_satuan_balai;
        
        $biayaHOK = (int)$formPerumahan->tenaga_kerja_hok * (float)$formPerumahan->upah_harian;
        $biayaAlatBerat = (int)$formPerumahan->alat_berat_hari * (float)$formPerumahan->biaya_per_hari;
        $biayaTenda = (int)$formPerumahan->jumlah_tenda * (float)$formPerumahan->harga_tenda;
        $biayaBarak = (int)$formPerumahan->jumlah_barak * (float)$formPerumahan->harga_barak;
        $biayaRumahSementara = (int)$formPerumahan->jumlah_rumah_sementara * (float)$formPerumahan->harga_rumah_sementara;
        
        $totalBiayaKerusakan = $biayaRumahPermanen + $biayaRumahNonPermanen + $biayaJalan + $biayaSaluran + $biayaBalai;
        $totalBiayaKerugian = $biayaHOK + $biayaAlatBerat + (float)$formPerumahan->harga_sewa_per_bulan + $biayaTenda + $biayaBarak + $biayaRumahSementara;
        $totalKeseluruhanBiaya = $totalBiayaKerusakan + $totalBiayaKerugian;
        
        $data = [
            'formPerumahan' => $formPerumahan,
            'bencana' => $bencana,
            'totalRumahPermanen' => $totalRumahPermanen,
            'totalRumahNonPermanen' => $totalRumahNonPermanen,
            'totalJalanRusak' => $totalJalanRusak,
            'totalSaluranRusak' => $totalSaluranRusak,
            'totalBalaiRusak' => $totalBalaiRusak,
            'biayaRumahPermanen' => $biayaRumahPermanen,
            'biayaRumahNonPermanen' => $biayaRumahNonPermanen,
            'biayaJalan' => $biayaJalan,
            'biayaSaluran' => $biayaSaluran,
            'biayaBalai' => $biayaBalai,
            'biayaHOK' => $biayaHOK,
            'biayaAlatBerat' => $biayaAlatBerat,
            'biayaTenda' => $biayaTenda,
            'biayaBarak' => $biayaBarak,
            'biayaRumahSementara' => $biayaRumahSementara,
            'totalBiayaKerusakan' => $totalBiayaKerusakan,
            'totalBiayaKerugian' => $totalBiayaKerugian,
            'totalKeseluruhanBiaya' => $totalKeseluruhanBiaya,
            'tanggal' => date('d-m-Y'),
        ];
        
        // Load view dengan DomPdf dan atur landscape
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('FormPerumahan_' . $formPerumahan->id . '.pdf');
    }
}
