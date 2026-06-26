<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormat1Request;
use App\Models\Bencana;
use App\Models\LaporanBencana;
use App\Models\Format2Form4;
use App\Models\Formulir;
use App\Models\FormulirItem;
use App\Models\KriteriaKerusakan;
use App\Models\Rekap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Format1Controller extends Controller
{
    /**
     * Display Format 1 form for Housing sector data collection
     */
    public function index(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format1.index', compact('bencana'));
    }

    /**
     * Store format1 form data for Housing sector
     */
    public function store(StoreFormat1Request $request)
    {        

        try {
            DB::beginTransaction();

            $laporan = LaporanBencana::firstOrCreate(
                [
                    'bencana_id' => $request->bencana_id,
                    'user_id' => auth()->id(),
                ],
                [
                    'tanggal_lapor' => now()->toDateString(),
                    'status' => 'draft',
                ]
            );

            $formulir = Formulir::firstOrCreate(
                [
                    'laporan_id' => $laporan->id,
                    'format_id' => 1,
                ],
                [
                    'status' => 'draft',
                ]
            );            

            $details = $request->details;

            $hargaSatuan = $request->harga_satuan;

            foreach ($details as &$detail) {

                if ($detail['kategori'] === 'jalan') {
                    $detail['harga_satuan'] = $hargaSatuan['jalan'] ?? 0;
                }

                if ($detail['kategori'] === 'saluran') {
                    $detail['harga_satuan'] = $hargaSatuan['saluran'] ?? 0;
                }

                if ($detail['kategori'] === 'balai') {
                    $detail['harga_satuan'] = $hargaSatuan['balai'] ?? 0;
                }
            }

            $request->merge([
                'details' => $details
            ]);

            // Validasi request tanpa rekap_id, gunakan bencana_id
            $validated = $request->validated();
            
            foreach ($details as $detail) {

                FormulirItem::create([
                    'formulir_id' => $formulir->id,

                    'kriteria_id' => $detail['kriteria_id'],

                    'kategori' => $detail['kategori'],
                    'sub_kategori' => $detail['sub_kategori'] ?? null,

                    'dimensi' => $detail['dimensi'] ?? null,

                    'tingkat_kerusakan' => $detail['tingkat_kerusakan'],

                    'jumlah' => $detail['jumlah'],
                    'harga_satuan' => $detail['harga_satuan'],

                    'satuan' => $detail['satuan'] ?? null,
                ]);
            }

            DB::commit();
            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $format1Form4
                ]);
            }            
            return redirect()->route('forms.form4.format1.list')
            ->with('success', 'Data berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }

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
        $format1Form4 = FormulirItem::with('rekap.bencana')->findOrFail($id);
        $bencana = $format1Form4->rekap ? $format1Form4->rekap->bencana : null;
        return view('forms.form4.format1.show-format1', compact('format1Form4', 'bencana'));
    }

    /**
     * List all entries for this format
     */
    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        // Ambil data Format1Form4 yang terkait dengan bencana_id melalui relasi rekap
        $reports = Formulir::whereHas('laporan', function ($q) use ($bencana_id) {
            $q->where('bencana_id', $bencana_id);
        })
        ->where('format_id', 1)
        ->get();
        
        return view('forms.form4.format1.list-format1', compact('bencana', 'reports'));
    }

    /**
     * Generate PDF for a specific form data (Format1/Perumahan)
     *
     * @param  int  $id
     * @return mixed
     */
    public function generatePdf($id)
    {
        $format1Form4 = FormulirItem::with('bencana')->findOrFail($id);
        $bencana = $format1Form4->bencana;
        $pdf = Pdf::loadView('forms.form4.format1.pdf', compact('format1Form4', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Format1_Perumahan_' . $format1Form4->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $format1Form4 = FormulirItem::with('bencana')->findOrFail($id);
        $bencana = $format1Form4->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format1.pdf', compact('format1Form4', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format1_Perumahan_' . $format1Form4->nama_kampung . '.pdf');
    }

    /**
     * Delete a specific form data
     */
    public function destroy($id)
    {
        try {
            $format1Form4 = FormulirItem::findOrFail($id);
            $bencana_id = $format1Form4->bencana_id;
            
            // Delete the record
            $format1Form4->delete();
            
            // Return success response
            return redirect()->route('forms.form4.list-format1', ['bencana_id' => $bencana_id])
                           ->with('success', 'Data berhasil dihapus');
                           
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing a specific format1 data
     */
    public function edit($id)
    {
        try {
            $format1Form4 = FormulirItem::with('bencana')->findOrFail($id);
            $bencana = $format1Form4->bencana;
            
            return view('forms.form4.format1.edit', compact('format1Form4', 'bencana'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Data tidak ditemukan: ' . $e->getMessage()]);
        }
    }

    /**
     * Update the specified format1 data
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Find the existing record
            $format1Form4 = FormulirItem::findOrFail($id);
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
                // Individual harga satuan for each category
                'harga_satuan_hancur_total_permanen' => 'nullable|numeric',
                'harga_satuan_hancur_total_non_permanen' => 'nullable|numeric',
                'harga_satuan_rusak_berat_permanen' => 'nullable|numeric',
                'harga_satuan_rusak_berat_non_permanen' => 'nullable|numeric',
                'harga_satuan_rusak_sedang_permanen' => 'nullable|numeric',
                'harga_satuan_rusak_sedang_non_permanen' => 'nullable|numeric',
                'harga_satuan_rusak_ringan_permanen' => 'nullable|numeric',
                'harga_satuan_rusak_ringan_non_permanen' => 'nullable|numeric',
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
                'balai_rusak_ringan' => 'nullable|integer',
                'harga_satuan_balai' => 'nullable|numeric',
                'tenaga_kerja_hok' => 'nullable|integer',
                'upah_harian' => 'nullable|numeric',
                'alat_berat_hari' => 'nullable|integer',
                'biaya_per_hari' => 'nullable|numeric',
                'jumlah_rumah_disewa' => 'nullable|integer',
                'harga_sewa_per_bulan' => 'nullable|numeric',
                'durasi_sewa_bulan' => 'nullable|integer',
                'jumlah_tenda' => 'nullable|integer',
                'harga_tenda' => 'nullable|numeric',
                'jumlah_barak' => 'nullable|integer',
                'harga_barak' => 'nullable|numeric',
                'jumlah_rumah_sementara' => 'nullable|integer',
                'harga_rumah_sementara' => 'nullable|numeric',
            ]);

            // Hitung total kerusakan otomatis (termasuk semua item yang dipindahkan dari kerugian)
            $total_kerusakan =
                // 1. Kerusakan rumah
                ($validated['rumah_hancur_total_permanen'] ?? 0) * ($validated['harga_satuan_hancur_total_permanen'] ?? 0) +
                ($validated['rumah_hancur_total_non_permanen'] ?? 0) * ($validated['harga_satuan_hancur_total_non_permanen'] ?? 0) +
                ($validated['rumah_rusak_berat_permanen'] ?? 0) * ($validated['harga_satuan_rusak_berat_permanen'] ?? 0) +
                ($validated['rumah_rusak_berat_non_permanen'] ?? 0) * ($validated['harga_satuan_rusak_berat_non_permanen'] ?? 0) +
                ($validated['rumah_rusak_sedang_permanen'] ?? 0) * ($validated['harga_satuan_rusak_sedang_permanen'] ?? 0) +
                ($validated['rumah_rusak_sedang_non_permanen'] ?? 0) * ($validated['harga_satuan_rusak_sedang_non_permanen'] ?? 0) +
                ($validated['rumah_rusak_ringan_permanen'] ?? 0) * ($validated['harga_satuan_rusak_ringan_permanen'] ?? 0) +
                ($validated['rumah_rusak_ringan_non_permanen'] ?? 0) * ($validated['harga_satuan_rusak_ringan_non_permanen'] ?? 0) +
                // 2. Kerusakan prasarana lingkungan
                (($validated['jalan_rusak_berat'] ?? 0) + ($validated['jalan_rusak_sedang'] ?? 0) + ($validated['jalan_rusak_ringan'] ?? 0)) * ($validated['harga_satuan_jalan'] ?? 0) +
                (($validated['saluran_rusak_berat'] ?? 0) + ($validated['saluran_rusak_sedang'] ?? 0) + ($validated['saluran_rusak_ringan'] ?? 0)) * ($validated['harga_satuan_saluran'] ?? 0) +
                (($validated['balai_rusak_berat'] ?? 0) + ($validated['balai_rusak_sedang'] ?? 0) + ($validated['balai_rusak_ringan'] ?? 0)) * ($validated['harga_satuan_balai'] ?? 0) +
                // Biaya pembersihan puing (dipindahkan dari kerugian ke kerusakan)
                ($validated['tenaga_kerja_hok'] ?? 0) * ($validated['upah_harian'] ?? 0) +
                ($validated['alat_berat_hari'] ?? 0) * ($validated['biaya_per_hari'] ?? 0) +
                // Biaya sewa rumah (dipindahkan dari kerugian ke kerusakan)
                ($validated['jumlah_rumah_disewa'] ?? 0) * ($validated['harga_sewa_per_bulan'] ?? 0) * ($validated['durasi_sewa_bulan'] ?? 0) +
                // Biaya hunian sementara (dipindahkan dari kerugian ke kerusakan)
                ($validated['jumlah_tenda'] ?? 0) * ($validated['harga_tenda'] ?? 0) +
                ($validated['jumlah_barak'] ?? 0) * ($validated['harga_barak'] ?? 0) +
                ($validated['jumlah_rumah_sementara'] ?? 0) * ($validated['harga_rumah_sementara'] ?? 0);
            $validated['total_kerusakan'] = $total_kerusakan;

            // Update the record
            $format1Form4->update($validated);

            DB::commit();

            return redirect()->route('forms.form4.list-format1', ['bencana_id' => $format1Form4->bencana_id])
                           ->with('success', 'Data berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()]);
        }
    }
}
