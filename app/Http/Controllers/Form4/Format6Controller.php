<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format6Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format6Controller extends Controller
{
    /**
     * Display Format 6 form for Clean Water and Sanitation sector data collection
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
        
        return view('forms.form4.format6.format6form4', compact('bencana'));
    }

    /**
     * Store format6 form data for Clean Water and Sanitation sector
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
                // Air Minum
                'struktur_air_unit' => 'nullable|string',
                'struktur_air_jumlah' => 'nullable|integer',
                'struktur_air_harga_satuan' => 'nullable|numeric',
                'struktur_air_total' => 'nullable|numeric',
                'instalasi_pemurnian_unit' => 'nullable|string',
                'instalasi_pemurnian_jumlah' => 'nullable|integer',
                'instalasi_pemurnian_harga_satuan' => 'nullable|numeric',
                'instalasi_pemurnian_total' => 'nullable|numeric',
                'perpipaan_unit' => 'nullable|string',
                'perpipaan_jumlah' => 'nullable|integer',
                'perpipaan_harga_satuan' => 'nullable|numeric',
                'perpipaan_total' => 'nullable|numeric',
                'penyimpanan_unit' => 'nullable|string',
                'penyimpanan_jumlah' => 'nullable|integer',
                'penyimpanan_harga_satuan' => 'nullable|numeric',
                'penyimpanan_total' => 'nullable|numeric',
                'sumur_unit' => 'nullable|string',
                'sumur_jumlah' => 'nullable|integer',
                'sumur_harga_satuan' => 'nullable|numeric',
                'sumur_total' => 'nullable|numeric',
                'mck_unit' => 'nullable|string',
                'mck_jumlah' => 'nullable|integer',
                'mck_harga_satuan' => 'nullable|numeric',
                'mck_total' => 'nullable|numeric',
                // Sanitasi
                'sanitasi_unit' => 'nullable|string',
                'sanitasi_jumlah' => 'nullable|integer',
                'sanitasi_harga_satuan' => 'nullable|numeric',
                'sanitasi_total' => 'nullable|numeric',
                'drainase_unit' => 'nullable|string',
                'drainase_jumlah' => 'nullable|integer',
                'drainase_harga_satuan' => 'nullable|numeric',
                'drainase_total' => 'nullable|numeric',
                'limbah_padat_unit' => 'nullable|string',
                'limbah_padat_jumlah' => 'nullable|integer',
                'limbah_padat_harga_satuan' => 'nullable|numeric',
                'limbah_padat_total' => 'nullable|numeric',
                'wc_umum_unit' => 'nullable|string',
                'wc_umum_jumlah' => 'nullable|integer',
                'wc_umum_harga_satuan' => 'nullable|numeric',
                'wc_umum_total' => 'nullable|numeric',
                // Kerugian
                'kehilangan_pendapatan_pdam' => 'nullable|numeric',
                'biaya_pemurnian' => 'nullable|numeric',
                'dasar_perhitungan_biaya_pemurnian' => 'nullable|string',
                'biaya_distribusi' => 'nullable|numeric',
                'dasar_perhitungan_biaya_distribusi' => 'nullable|string',
                'biaya_pembersihan' => 'nullable|numeric',
                'dasar_perhitungan_biaya_pembersihan' => 'nullable|string',
                'biaya_lain' => 'nullable|numeric',
                'dasar_perhitungan_biaya_lain' => 'nullable|string',
                'sanitasi_pendapatan' => 'nullable|numeric',
                'biaya_pembersihan_jaringan' => 'nullable|numeric',
                'dasar_perhitungan_biaya_pembersihan_jaringan' => 'nullable|string',
                'biaya_bahan_kimia' => 'nullable|numeric',
                'dasar_perhitungan_biaya_bahan_kimia' => 'nullable|string',
                'total_kerusakan' => 'nullable|numeric',
                'total_kerugian' => 'nullable|numeric',
            ]);

            // Create new form data
            $formAirSanitasi = Format6Form4::create($validated);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formAirSanitasi
                ]);
            }

            return redirect()->route('forms.form4.list-format6', ['bencana_id' => $formAirSanitasi->bencana_id])
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
        $formAirSanitasi = Format6Form4::with('bencana')->findOrFail($id);
        $bencana = $formAirSanitasi->bencana;
        $data = $formAirSanitasi->toArray(); // Convert model to array for the view
        
        return view('forms.form4.format6.show-format6', compact('formAirSanitasi', 'bencana', 'data'));
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
        
        // Get form data for this disaster
         $form = Format6Form4::where('bencana_id', $bencana_id)->get();
        $reports =  $form; // For compatibility with the view
        return view('forms.form4.format6.list-format6', compact('bencana', ' form', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formAirSanitasi = Format6Form4::with('bencana')->findOrFail($id);
        $bencana = $formAirSanitasi->bencana;
        $report = $formAirSanitasi; // For compatibility with the PDF view
        
        $pdf = Pdf::loadView('forms.form4.format6.pdf', compact('formAirSanitasi', 'bencana', 'report'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format6_AirSanitasi_' . $formAirSanitasi->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formAirSanitasi = Format6Form4::with('bencana')->findOrFail($id);
        $bencana = $formAirSanitasi->bencana;
        $report = $formAirSanitasi; // For compatibility with the PDF view
        
        $pdf = Pdf::loadView('forms.form4.format6.pdf', compact('formAirSanitasi', 'bencana', 'report'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format6_AirSanitasi_' . $formAirSanitasi->nama_kampung . '.pdf');
    }

    /**
     * Show the form for editing the specified resource (Format 6)
     */
    public function edit($id)
    {
        $formAirSanitasi = \App\Models\Format6Form4::with('bencana')->findOrFail($id);
        $bencana = $formAirSanitasi->bencana;
        return view('forms.form4.format6.edit', compact('formAirSanitasi', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 6)
     */
    public function update(Request $request, $id)
    {
        try {
            \DB::beginTransaction();
            $formAirSanitasi = \App\Models\Format6Form4::findOrFail($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Air Minum
                'struktur_air_unit' => 'nullable|string',
                'struktur_air_jumlah' => 'nullable|integer',
                'struktur_air_harga_satuan' => 'nullable|numeric',
                'struktur_air_total' => 'nullable|numeric',
                'instalasi_pemurnian_unit' => 'nullable|string',
                'instalasi_pemurnian_jumlah' => 'nullable|integer',
                'instalasi_pemurnian_harga_satuan' => 'nullable|numeric',
                'instalasi_pemurnian_total' => 'nullable|numeric',
                'perpipaan_unit' => 'nullable|string',
                'perpipaan_jumlah' => 'nullable|integer',
                'perpipaan_harga_satuan' => 'nullable|numeric',
                'perpipaan_total' => 'nullable|numeric',
                'penyimpanan_unit' => 'nullable|string',
                'penyimpanan_jumlah' => 'nullable|integer',
                'penyimpanan_harga_satuan' => 'nullable|numeric',
                'penyimpanan_total' => 'nullable|numeric',
                'sumur_unit' => 'nullable|string',
                'sumur_jumlah' => 'nullable|integer',
                'sumur_harga_satuan' => 'nullable|numeric',
                'sumur_total' => 'nullable|numeric',
                'mck_unit' => 'nullable|string',
                'mck_jumlah' => 'nullable|integer',
                'mck_harga_satuan' => 'nullable|numeric',
                'mck_total' => 'nullable|numeric',
                // Sanitasi
                'sanitasi_unit' => 'nullable|string',
                'sanitasi_jumlah' => 'nullable|integer',
                'sanitasi_harga_satuan' => 'nullable|numeric',
                'sanitasi_total' => 'nullable|numeric',
                'drainase_unit' => 'nullable|string',
                'drainase_jumlah' => 'nullable|integer',
                'drainase_harga_satuan' => 'nullable|numeric',
                'drainase_total' => 'nullable|numeric',
                'limbah_padat_unit' => 'nullable|string',
                'limbah_padat_jumlah' => 'nullable|integer',
                'limbah_padat_harga_satuan' => 'nullable|numeric',
                'limbah_padat_total' => 'nullable|numeric',
                'wc_umum_unit' => 'nullable|string',
                'wc_umum_jumlah' => 'nullable|integer',
                'wc_umum_harga_satuan' => 'nullable|numeric',
                'wc_umum_total' => 'nullable|numeric',
                // Kerugian
                'kehilangan_pendapatan_pdam' => 'nullable|numeric',
                'biaya_pemurnian' => 'nullable|numeric',
                'dasar_perhitungan_biaya_pemurnian' => 'nullable|string',
                'biaya_distribusi' => 'nullable|numeric',
                'dasar_perhitungan_biaya_distribusi' => 'nullable|string',
                'biaya_pembersihan' => 'nullable|numeric',
                'dasar_perhitungan_biaya_pembersihan' => 'nullable|string',
                'biaya_lain' => 'nullable|numeric',
                'dasar_perhitungan_biaya_lain' => 'nullable|string',
                'sanitasi_pendapatan' => 'nullable|numeric',
                'biaya_pembersihan_jaringan' => 'nullable|numeric',
                'dasar_perhitungan_biaya_pembersihan_jaringan' => 'nullable|string',
                'biaya_bahan_kimia' => 'nullable|numeric',
                'dasar_perhitungan_biaya_bahan_kimia' => 'nullable|string',
                'total_kerusakan' => 'nullable|numeric',
                'total_kerugian' => 'nullable|numeric',
            ]);
            $formAirSanitasi->update($validated);
            \DB::commit();
            return redirect()->route('forms.form4.list-format6', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 6)
     */
    public function destroy($id)
    {
        $formAirSanitasi = \App\Models\Format6Form4::findOrFail($id);
        $bencana_id = $formAirSanitasi->bencana_id;
        $formAirSanitasi->delete();
        return redirect()->route('forms.form4.format6.list', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }
}
