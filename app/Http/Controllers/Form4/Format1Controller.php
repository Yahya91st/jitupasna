<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format1Form4;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

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
        
        return view('forms.form4.format1.format1form4', compact('bencana'));
    }

    /**
     * Store format1 form data for Housing sector
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
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

            // Debug log: cek data yang diterima dari form
            Log::debug('Format1Form4 STORE validated data', $validated);

            // Hitung total kerusakan otomatis (semua item sekarang masuk ke kerusakan)
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
                // Rumah sewa (dipindahkan dari kerugian ke kerusakan)
                ($validated['jumlah_rumah_disewa'] ?? 0) * ($validated['harga_sewa_per_bulan'] ?? 0) * ($validated['durasi_sewa_bulan'] ?? 0) +
                // Hunian sementara (dipindahkan dari kerugian ke kerusakan)
                ($validated['jumlah_tenda'] ?? 0) * ($validated['harga_tenda'] ?? 0) +
                ($validated['jumlah_barak'] ?? 0) * ($validated['harga_barak'] ?? 0) +
                ($validated['jumlah_rumah_sementara'] ?? 0) * ($validated['harga_rumah_sementara'] ?? 0);
            $validated['total_kerusakan'] = $total_kerusakan;

            // Debug log: cek hasil perhitungan total_kerusakan
            Log::debug('Format1Form4 STORE total_kerusakan', ['total_kerusakan' => $total_kerusakan]);

            // Create new form data
            $formPerumahan = Format1Form4::create($validated);

            DB::commit();            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formPerumahan
                ]);
            }            return redirect()->route('forms.form4.list-format1', ['bencana_id' => $validated['bencana_id']])
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
        $formPerumahan = Format1Form4::with('bencana')->findOrFail($id);
        $bencana = $formPerumahan->bencana;
        
        return view('forms.form4.format1.show-format1', compact('formPerumahan', 'bencana'));
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
        $bencana = Bencana::findOrFail($bencana_id);        // Get form data for this disaster
        $reports = Format1Form4::where('bencana_id', $bencana_id)->get();
        
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
        $formPerumahan = Format1Form4::with('bencana')->findOrFail($id);
        $bencana = $formPerumahan->bencana;
        $pdf = Pdf::loadView('forms.form4.format1.pdf', compact('formPerumahan', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Format1_Perumahan_' . $formPerumahan->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formPerumahan = Format1Form4::with('bencana')->findOrFail($id);
        $bencana = $formPerumahan->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format1.pdf', compact('formPerumahan', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format1_Perumahan_' . $formPerumahan->nama_kampung . '.pdf');
    }

    /**
     * Delete a specific form data
     */
    public function destroy($id)
    {
        try {
            $formPerumahan = Format1Form4::findOrFail($id);
            $bencana_id = $formPerumahan->bencana_id;
            
            // Delete the record
            $formPerumahan->delete();
            
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
            $formPerumahan = Format1Form4::with('bencana')->findOrFail($id);
            $bencana = $formPerumahan->bencana;
            
            return view('forms.form4.format1.edit', compact('formPerumahan', 'bencana'));
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
            $formPerumahan = Format1Form4::findOrFail($id);
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
            $formPerumahan->update($validated);

            DB::commit();

            return redirect()->route('forms.form4.list-format1', ['bencana_id' => $formPerumahan->bencana_id])
                           ->with('success', 'Data berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()]);
        }
    }
}
