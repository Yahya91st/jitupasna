<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;

class Format2Controller extends Controller
{
    /**
     * Display Format 2 form for Education sector data collection
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
        
        return view('forms.form4.format2.format2form4', compact('bencana'));
    }

    /**
     * Store format2 form data for Education sector
     */
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();

            // Validation rules for all education sector fields
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // TK/RA
                'tk_berat_negeri' => 'nullable|integer', 'tk_berat_swasta' => 'nullable|integer',
                'tk_sedang_negeri' => 'nullable|integer', 'tk_sedang_swasta' => 'nullable|integer',
                'tk_ringan_negeri' => 'nullable|integer', 'tk_ringan_swasta' => 'nullable|integer',
                'tk_ukuran' => 'nullable|integer',
                'tk_harga_bangunan' => 'nullable|numeric', 'tk_harga_peralatan' => 'nullable|string', 'tk_harga_meubelair' => 'nullable|string',
                // SD/MI
                'sd_berat_negeri' => 'nullable|integer', 'sd_berat_swasta' => 'nullable|integer',
                'sd_sedang_negeri' => 'nullable|integer', 'sd_sedang_swasta' => 'nullable|integer',
                'sd_ringan_negeri' => 'nullable|integer', 'sd_ringan_swasta' => 'nullable|integer',
                'sd_ukuran' => 'nullable|integer',
                'sd_harga_bangunan' => 'nullable|numeric', 'sd_harga_peralatan' => 'nullable|string', 'sd_harga_meubelair' => 'nullable|string',
                // SMP/MTS
                'smp_berat_negeri' => 'nullable|integer', 'smp_berat_swasta' => 'nullable|integer',
                'smp_sedang_negeri' => 'nullable|integer', 'smp_sedang_swasta' => 'nullable|integer',
                'smp_ringan_negeri' => 'nullable|integer', 'smp_ringan_swasta' => 'nullable|integer',
                'smp_ukuran' => 'nullable|integer',
                'smp_harga_bangunan' => 'nullable|numeric', 'smp_harga_peralatan' => 'nullable|string', 'smp_harga_meubelair' => 'nullable|string',
                // SMA/MA
                'sma_berat_negeri' => 'nullable|integer', 'sma_berat_swasta' => 'nullable|integer',
                'sma_sedang_negeri' => 'nullable|integer', 'sma_sedang_swasta' => 'nullable|integer',
                'sma_ringan_negeri' => 'nullable|integer', 'sma_ringan_swasta' => 'nullable|integer',
                'sma_ukuran' => 'nullable|integer',
                'sma_harga_bangunan' => 'nullable|numeric', 'sma_harga_peralatan' => 'nullable|string', 'sma_harga_meubelair' => 'nullable|string',
                // SMK
                'smk_berat_negeri' => 'nullable|integer', 'smk_berat_swasta' => 'nullable|integer',
                'smk_sedang_negeri' => 'nullable|integer', 'smk_sedang_swasta' => 'nullable|integer',
                'smk_ringan_negeri' => 'nullable|integer', 'smk_ringan_swasta' => 'nullable|integer',
                'smk_ukuran' => 'nullable|integer',
                'smk_harga_bangunan' => 'nullable|numeric', 'smk_harga_peralatan' => 'nullable|string', 'smk_harga_meubelair' => 'nullable|string',
                // Perguruan Tinggi
                'pt_berat_negeri' => 'nullable|integer', 'pt_berat_swasta' => 'nullable|integer',
                'pt_sedang_negeri' => 'nullable|integer', 'pt_sedang_swasta' => 'nullable|integer',
                'pt_ringan_negeri' => 'nullable|integer', 'pt_ringan_swasta' => 'nullable|integer',
                'pt_ukuran' => 'nullable|integer',
                'pt_harga_bangunan' => 'nullable|numeric', 'pt_harga_peralatan' => 'nullable|string', 'pt_harga_meubelair' => 'nullable|string',
                // Perpustakaan
                'perpus_berat_negeri' => 'nullable|integer', 'perpus_berat_swasta' => 'nullable|integer',
                'perpus_sedang_negeri' => 'nullable|integer', 'perpus_sedang_swasta' => 'nullable|integer',
                'perpus_ringan_negeri' => 'nullable|integer', 'perpus_ringan_swasta' => 'nullable|integer',
                'perpus_ukuran' => 'nullable|integer',
                'perpus_harga_bangunan' => 'nullable|numeric', 'perpus_harga_peralatan' => 'nullable|string', 'perpus_harga_meubelair' => 'nullable|string',
                // Laboratorium
                'lab_berat_negeri' => 'nullable|integer', 'lab_berat_swasta' => 'nullable|integer',
                'lab_sedang_negeri' => 'nullable|integer', 'lab_sedang_swasta' => 'nullable|integer',
                'lab_ringan_negeri' => 'nullable|integer', 'lab_ringan_swasta' => 'nullable|integer',
                'lab_ukuran' => 'nullable|integer',
                'lab_harga_bangunan' => 'nullable|numeric', 'lab_harga_peralatan' => 'nullable|string', 'lab_harga_meubelair' => 'nullable|string',
                // Lainnya
                'lainnya_berat_negeri' => 'nullable|integer', 'lainnya_berat_swasta' => 'nullable|integer',
                'lainnya_sedang_negeri' => 'nullable|integer', 'lainnya_sedang_swasta' => 'nullable|integer',
                'lainnya_ringan_negeri' => 'nullable|integer', 'lainnya_ringan_swasta' => 'nullable|integer',
                'lainnya_ukuran' => 'nullable|integer',
                'lainnya_harga_bangunan' => 'nullable|numeric', 'lainnya_harga_peralatan' => 'nullable|string', 'lainnya_harga_meubelair' => 'nullable|string',
                // Kerugian & info sekolah
                'biaya_tenaga_kerja_hok' => 'nullable|integer',
                'biaya_tenaga_kerja_upah' => 'nullable|numeric',
                'biaya_alat_berat_hari' => 'nullable|integer',
                'biaya_alat_berat_harga' => 'nullable|numeric',
                'sekolah_pengungsian' => 'nullable|integer',
                'guru_korban' => 'nullable|integer',
                'iuran_sekolah' => 'nullable|numeric',
                'jumlah_sekolah_sementara' => 'nullable|integer',
                'harga_sekolah_sementara' => 'nullable|numeric',
            ]);

            // Hitung total kerusakan
            $bangunan = ['tk','sd','smp','sma','smk','pt','perpus','lab','lainnya'];
            $totalKerusakan = 0;
            foreach ($bangunan as $b) {
                $totalKerusakan += (($validated[$b.'_berat_negeri'] ?? 0) + ($validated[$b.'_berat_swasta'] ?? 0)) * ($validated[$b.'_harga_bangunan'] ?? 0);
                $totalKerusakan += (($validated[$b.'_sedang_negeri'] ?? 0) + ($validated[$b.'_sedang_swasta'] ?? 0)) * ($validated[$b.'_harga_bangunan'] ?? 0);
                $totalKerusakan += (($validated[$b.'_ringan_negeri'] ?? 0) + ($validated[$b.'_ringan_swasta'] ?? 0)) * ($validated[$b.'_harga_bangunan'] ?? 0);
            }
            $validated['total_kerusakan'] = $totalKerusakan;

            // Hitung total kerugian
            $totalKerugian = ($validated['biaya_tenaga_kerja_hok'] ?? 0) * ($validated['biaya_tenaga_kerja_upah'] ?? 0)
                + ($validated['biaya_alat_berat_hari'] ?? 0) * ($validated['biaya_alat_berat_harga'] ?? 0)
                + ($validated['jumlah_sekolah_sementara'] ?? 0) * ($validated['harga_sekolah_sementara'] ?? 0);
            $validated['total_kerugian'] = $totalKerugian;

            // Create new form data
            $formPendidikan = \App\Models\Format2Form4::create($validated);

            \DB::commit();
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formPendidikan
                ]);
            }
            return redirect()->route('forms.form4.list-format2', ['bencana_id' => $formPendidikan->bencana_id])
                ->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            \DB::rollBack();
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
        $formPendidikan = \App\Models\Format2Form4::with('bencana')->findOrFail($id);
        $bencana = $formPendidikan->bencana;
        return view('forms.form4.format2.show-format2', compact('formPendidikan', 'bencana'));
    }

    /**
     * List all entries for this format (list-format2)
     */
    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        $bencana = Bencana::with(['kategori_bencana', 'desa'])->findOrFail($bencana_id);
        $educationReports = \App\Models\Format2Form4::where('bencana_id', $bencana_id)->get();
        return view('forms.form4.format2.list-format2', compact('bencana', 'educationReports'));
    }

    /**
     * Generate PDF for a specific form data (future)
     */
    public function generatePdf($id)
    {
        $formPendidikan = \App\Models\Format2Form4::with('bencana')->findOrFail($id);
        $bencana = $formPendidikan->bencana;
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('forms.form4.format2.pdf', compact('formPendidikan', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Format2_Pendidikan_' . $formPendidikan->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF (Not implemented yet)
     */
    public function previewPdf($id)
    {
        return redirect()->back()->with('error', 'Format 2 (Education Sector) belum diimplementasikan.');
    }

    /**
     * Show the form for editing the specified resource (Format 2)
     */
    public function edit($id)
    {
        $formPendidikan = \App\Models\Format2Form4::with('bencana')->findOrFail($id);
        $bencana = $formPendidikan->bencana;
        return view('forms.form4.format2.edit', compact('formPendidikan', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 2)
     */
    public function update(Request $request, $id)
    {
        try {
            \DB::beginTransaction();
            $formPendidikan = \App\Models\Format2Form4::findOrFail($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // TK/RA
                'tk_berat_negeri' => 'nullable|integer', 'tk_berat_swasta' => 'nullable|integer',
                'tk_sedang_negeri' => 'nullable|integer', 'tk_sedang_swasta' => 'nullable|integer',
                'tk_ringan_negeri' => 'nullable|integer', 'tk_ringan_swasta' => 'nullable|integer',
                'tk_ukuran' => 'nullable|integer',
                'tk_harga_bangunan' => 'nullable|numeric', 'tk_harga_peralatan' => 'nullable|string', 'tk_harga_meubelair' => 'nullable|string',
                // SD/MI
                'sd_berat_negeri' => 'nullable|integer', 'sd_berat_swasta' => 'nullable|integer',
                'sd_sedang_negeri' => 'nullable|integer', 'sd_sedang_swasta' => 'nullable|integer',
                'sd_ringan_negeri' => 'nullable|integer', 'sd_ringan_swasta' => 'nullable|integer',
                'sd_ukuran' => 'nullable|integer',
                'sd_harga_bangunan' => 'nullable|numeric', 'sd_harga_peralatan' => 'nullable|string', 'sd_harga_meubelair' => 'nullable|string',
                // SMP/MTS
                'smp_berat_negeri' => 'nullable|integer', 'smp_berat_swasta' => 'nullable|integer',
                'smp_sedang_negeri' => 'nullable|integer', 'smp_sedang_swasta' => 'nullable|integer',
                'smp_ringan_negeri' => 'nullable|integer', 'smp_ringan_swasta' => 'nullable|integer',
                'smp_ukuran' => 'nullable|integer',
                'smp_harga_bangunan' => 'nullable|numeric', 'smp_harga_peralatan' => 'nullable|string', 'smp_harga_meubelair' => 'nullable|string',
                // SMA/MA
                'sma_berat_negeri' => 'nullable|integer', 'sma_berat_swasta' => 'nullable|integer',
                'sma_sedang_negeri' => 'nullable|integer', 'sma_sedang_swasta' => 'nullable|integer',
                'sma_ringan_negeri' => 'nullable|integer', 'sma_ringan_swasta' => 'nullable|integer',
                'sma_ukuran' => 'nullable|integer',
                'sma_harga_bangunan' => 'nullable|numeric', 'sma_harga_peralatan' => 'nullable|string', 'sma_harga_meubelair' => 'nullable|string',
                // SMK
                'smk_berat_negeri' => 'nullable|integer', 'smk_berat_swasta' => 'nullable|integer',
                'smk_sedang_negeri' => 'nullable|integer', 'smk_sedang_swasta' => 'nullable|integer',
                'smk_ringan_negeri' => 'nullable|integer', 'smk_ringan_swasta' => 'nullable|integer',
                'smk_ukuran' => 'nullable|integer',
                'smk_harga_bangunan' => 'nullable|numeric', 'smk_harga_peralatan' => 'nullable|string', 'smk_harga_meubelair' => 'nullable|string',
                // Perguruan Tinggi
                'pt_berat_negeri' => 'nullable|integer', 'pt_berat_swasta' => 'nullable|integer',
                'pt_sedang_negeri' => 'nullable|integer', 'pt_sedang_swasta' => 'nullable|integer',
                'pt_ringan_negeri' => 'nullable|integer', 'pt_ringan_swasta' => 'nullable|integer',
                'pt_ukuran' => 'nullable|integer',
                'pt_harga_bangunan' => 'nullable|numeric', 'pt_harga_peralatan' => 'nullable|string', 'pt_harga_meubelair' => 'nullable|string',
                // Perpustakaan
                'perpus_berat_negeri' => 'nullable|integer', 'perpus_berat_swasta' => 'nullable|integer',
                'perpus_sedang_negeri' => 'nullable|integer', 'perpus_sedang_swasta' => 'nullable|integer',
                'perpus_ringan_negeri' => 'nullable|integer', 'perpus_ringan_swasta' => 'nullable|integer',
                'perpus_ukuran' => 'nullable|integer',
                'perpus_harga_bangunan' => 'nullable|numeric', 'perpus_harga_peralatan' => 'nullable|string', 'perpus_harga_meubelair' => 'nullable|string',
                // Laboratorium
                'lab_berat_negeri' => 'nullable|integer', 'lab_berat_swasta' => 'nullable|integer',
                'lab_sedang_negeri' => 'nullable|integer', 'lab_sedang_swasta' => 'nullable|integer',
                'lab_ringan_negeri' => 'nullable|integer', 'lab_ringan_swasta' => 'nullable|integer',
                'lab_ukuran' => 'nullable|integer',
                'lab_harga_bangunan' => 'nullable|numeric', 'lab_harga_peralatan' => 'nullable|string', 'lab_harga_meubelair' => 'nullable|string',
                // Lainnya
                'lainnya_berat_negeri' => 'nullable|integer', 'lainnya_berat_swasta' => 'nullable|integer',
                'lainnya_sedang_negeri' => 'nullable|integer', 'lainnya_sedang_swasta' => 'nullable|integer',
                'lainnya_ringan_negeri' => 'nullable|integer', 'lainnya_ringan_swasta' => 'nullable|integer',
                'lainnya_ukuran' => 'nullable|integer',
                'lainnya_harga_bangunan' => 'nullable|numeric', 'lainnya_harga_peralatan' => 'nullable|string', 'lainnya_harga_meubelair' => 'nullable|string',
                // Kerugian & info sekolah
                'biaya_tenaga_kerja_hok' => 'nullable|integer',
                'biaya_tenaga_kerja_upah' => 'nullable|numeric',
                'biaya_alat_berat_hari' => 'nullable|integer',
                'biaya_alat_berat_harga' => 'nullable|numeric',
                'sekolah_pengungsian' => 'nullable|integer',
                'guru_korban' => 'nullable|integer',
                'iuran_sekolah' => 'nullable|numeric',
                'jumlah_sekolah_sementara' => 'nullable|integer',
                'harga_sekolah_sementara' => 'nullable|numeric',
            ]);

            // Hitung total kerusakan
            $bangunan = ['tk','sd','smp','sma','smk','pt','perpus','lab','lainnya'];
            $totalKerusakan = 0;
            foreach ($bangunan as $b) {
                $totalKerusakan += (($validated[$b.'_berat_negeri'] ?? 0) + ($validated[$b.'_berat_swasta'] ?? 0)) * ($validated[$b.'_harga_bangunan'] ?? 0);
                $totalKerusakan += (($validated[$b.'_sedang_negeri'] ?? 0) + ($validated[$b.'_sedang_swasta'] ?? 0)) * ($validated[$b.'_harga_bangunan'] ?? 0);
                $totalKerusakan += (($validated[$b.'_ringan_negeri'] ?? 0) + ($validated[$b.'_ringan_swasta'] ?? 0)) * ($validated[$b.'_harga_bangunan'] ?? 0);
            }
            $validated['total_kerusakan'] = $totalKerusakan;

            // Hitung total kerugian
            $totalKerugian = ($validated['biaya_tenaga_kerja_hok'] ?? 0) * ($validated['biaya_tenaga_kerja_upah'] ?? 0)
                + ($validated['biaya_alat_berat_hari'] ?? 0) * ($validated['biaya_alat_berat_harga'] ?? 0)
                + ($validated['jumlah_sekolah_sementara'] ?? 0) * ($validated['harga_sekolah_sementara'] ?? 0);
            $validated['total_kerugian'] = $totalKerugian;

            $formPendidikan->update($validated);
            \DB::commit();
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil diupdate',
                    'data' => $formPendidikan
                ]);
            }
            return redirect()->route('forms.form4.list-format2', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            \DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 2)
     */
    public function destroy($id)
    {
        $formPendidikan = \App\Models\Format2Form4::findOrFail($id);
        $bencana_id = $formPendidikan->bencana_id;
        $formPendidikan->delete();
        return redirect()->route('forms.form4.list-format2', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }
}
