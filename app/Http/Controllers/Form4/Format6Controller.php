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
                'struktur_air_unit' => 'nullable|integer',
                'struktur_air_harga' => 'nullable|numeric',
                'struktur_air_total' => 'nullable|numeric',
                'instalasi_pemurnian_unit' => 'nullable|integer',
                'instalasi_pemurnian_harga' => 'nullable|numeric',
                'instalasi_pemurnian_total' => 'nullable|numeric',
                'perpipaan_unit' => 'nullable|integer',
                'perpipaan_harga' => 'nullable|numeric',
                'perpipaan_total' => 'nullable|numeric',
                'penyimpanan_unit' => 'nullable|integer',
                'penyimpanan_harga' => 'nullable|numeric',
                'penyimpanan_total' => 'nullable|numeric',
                'sumur_unit' => 'nullable|integer',
                'sumur_harga' => 'nullable|numeric',
                'sumur_total' => 'nullable|numeric',
                'mck_unit' => 'nullable|integer',
                'mck_harga' => 'nullable|numeric',
                'mck_total' => 'nullable|numeric',
                // Sanitasi
                'sanitasi_unit' => 'nullable|integer',
                'sanitasi_harga' => 'nullable|numeric',
                'sanitasi_total' => 'nullable|numeric',
                'drainase_unit' => 'nullable|integer',
                'drainase_harga' => 'nullable|numeric',
                'drainase_total' => 'nullable|numeric',
                'limbah_padat_unit' => 'nullable|integer',
                'limbah_padat_harga' => 'nullable|numeric',
                'limbah_padat_total' => 'nullable|numeric',
                'wc_umum_unit' => 'nullable|integer',
                'wc_umum_harga' => 'nullable|numeric',
                'wc_umum_total' => 'nullable|numeric',
                // Kerugian
                'kehilangan_pendapatan_pdam' => 'nullable|numeric',
                'biaya_pemurnian_air' => 'nullable|numeric',
                'biaya_distribusi_air' => 'nullable|numeric',
                'biaya_pembersihan_sumur' => 'nullable|numeric',
                'biaya_lain_air' => 'nullable|numeric',
                'biaya_sanitasi_lain' => 'nullable|numeric',
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
        
        return view('forms.form4.format6.show-format6', compact('formAirSanitasi', 'bencana'));
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
        $formData = Format6Form4::where('bencana_id', $bencana_id)->get();
        $reports = $formData; // For compatibility with the view
        return view('forms.form4.format6.list-format6', compact('bencana', 'formData', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formAirSanitasi = Format6Form4::with('bencana')->findOrFail($id);
        $bencana = $formAirSanitasi->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format6.pdf', compact('formAirSanitasi', 'bencana'));
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
        
        $pdf = Pdf::loadView('forms.form4.format6.pdf', compact('formAirSanitasi', 'bencana'));
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
                'struktur_air_unit' => 'nullable|integer',
                'struktur_air_harga' => 'nullable|numeric',
                'struktur_air_total' => 'nullable|numeric',
                'instalasi_pemurnian_unit' => 'nullable|integer',
                'instalasi_pemurnian_harga' => 'nullable|numeric',
                'instalasi_pemurnian_total' => 'nullable|numeric',
                'perpipaan_unit' => 'nullable|integer',
                'perpipaan_harga' => 'nullable|numeric',
                'perpipaan_total' => 'nullable|numeric',
                'penyimpanan_unit' => 'nullable|integer',
                'penyimpanan_harga' => 'nullable|numeric',
                'penyimpanan_total' => 'nullable|numeric',
                'sumur_unit' => 'nullable|integer',
                'sumur_harga' => 'nullable|numeric',
                'sumur_total' => 'nullable|numeric',
                'mck_unit' => 'nullable|integer',
                'mck_harga' => 'nullable|numeric',
                'mck_total' => 'nullable|numeric',
                // Sanitasi
                'sanitasi_unit' => 'nullable|integer',
                'sanitasi_harga' => 'nullable|numeric',
                'sanitasi_total' => 'nullable|numeric',
                'drainase_unit' => 'nullable|integer',
                'drainase_harga' => 'nullable|numeric',
                'drainase_total' => 'nullable|numeric',
                'limbah_padat_unit' => 'nullable|integer',
                'limbah_padat_harga' => 'nullable|numeric',
                'limbah_padat_total' => 'nullable|numeric',
                'wc_umum_unit' => 'nullable|integer',
                'wc_umum_harga' => 'nullable|numeric',
                'wc_umum_total' => 'nullable|numeric',
                // Kerugian
                'kehilangan_pendapatan_pdam' => 'nullable|numeric',
                'biaya_pemurnian_air' => 'nullable|numeric',
                'biaya_distribusi_air' => 'nullable|numeric',
                'biaya_pembersihan_sumur' => 'nullable|numeric',
                'biaya_lain_air' => 'nullable|numeric',
                'biaya_sanitasi_lain' => 'nullable|numeric',
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
