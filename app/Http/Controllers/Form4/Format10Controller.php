<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format10Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format10Controller extends Controller
{
    /**
     * Display Format 10 form for Agriculture sector data collection
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
        
        return view('forms.form4.format10.format10form4', compact('bencana'));
    }

    /**
     * Store format10 form data for Agriculture sector
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
                // Agriculture sector specific fields
                'sawah_rusak_total' => 'nullable|numeric',
                'sawah_rusak_sebagian' => 'nullable|numeric',
                'harga_satuan_sawah' => 'nullable|numeric',
                'kebun_rusak_total' => 'nullable|numeric',
                'kebun_rusak_sebagian' => 'nullable|numeric',
                'harga_satuan_kebun' => 'nullable|numeric',
                'kolam_ikan_rusak_total' => 'nullable|numeric',
                'kolam_ikan_rusak_sebagian' => 'nullable|numeric',
                'harga_satuan_kolam_ikan' => 'nullable|numeric',
                'tambak_rusak_total' => 'nullable|numeric',
                'tambak_rusak_sebagian' => 'nullable|numeric',
                'harga_satuan_tambak' => 'nullable|numeric',
                'gudang_pupuk_rusak_total' => 'nullable|integer',
                'gudang_pupuk_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_gudang_pupuk' => 'nullable|numeric',
                'traktor_rusak' => 'nullable|integer',
                'harga_satuan_traktor' => 'nullable|numeric',
                'alat_pertanian_rusak' => 'nullable|integer',
                'harga_satuan_alat_pertanian' => 'nullable|numeric',
            ]);

            // Create new form data
            $formPertanian = Format10Form4::create($validated);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formPertanian
                ]);
            }

            return redirect()->route('forms.form4.list-format10', ['bencana_id' => $formPertanian->bencana_id])
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
        $report = Format10Form4::with('bencana')->findOrFail($id);
        $bencana = $report->bencana;
        
        return view('forms.form4.format10.show-format10', compact('report', 'bencana'));
    }

    /**
     * List all entries for this format
     */
    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        $bencana = Bencana::findOrFail($bencana_id);
        $reports = Format10Form4::where('bencana_id', $bencana_id)->get(); // No soft delete filter
        return view('forms.form4.format10.list-format10', compact('bencana', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formPertanian = Format10Form4::with('bencana')->findOrFail($id);
        $bencana = $formPertanian->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format10.pdf', compact('formPertanian', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format10_Pertanian_' . $formPertanian->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formPertanian = Format10Form4::with('bencana')->findOrFail($id);
        $bencana = $formPertanian->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format10.pdf', compact('formPertanian', 'bencana'));        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format10_Pertanian_' . $formPertanian->nama_kampung . '.pdf');
    }

    /**
     * Show the form for editing the specified resource (Format 10)
     */
    public function edit($id)
    {
        $formPertanian = \App\Models\Format10Form4::with('bencana')->findOrFail($id);
        $bencana = $formPertanian->bencana;
        return view('forms.form4.format10.edit', compact('formPertanian', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 10)
     */
    public function update(Request $request, $id)
    {
        try {
            \DB::beginTransaction();
            $formPertanian = \App\Models\Format10Form4::findOrFail($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Agriculture sector specific fields
                'sawah_rusak_total' => 'nullable|numeric',
                'sawah_rusak_sebagian' => 'nullable|numeric',
                'harga_satuan_sawah' => 'nullable|numeric',
                'kebun_rusak_total' => 'nullable|numeric',
                'kebun_rusak_sebagian' => 'nullable|numeric',
                'harga_satuan_kebun' => 'nullable|numeric',
                'kolam_ikan_rusak_total' => 'nullable|numeric',
                'kolam_ikan_rusak_sebagian' => 'nullable|numeric',
                'harga_satuan_kolam_ikan' => 'nullable|numeric',
                'tambak_rusak_total' => 'nullable|numeric',
                'tambak_rusak_sebagian' => 'nullable|numeric',
                'harga_satuan_tambak' => 'nullable|numeric',
                'gudang_pupuk_rusak_total' => 'nullable|integer',
                'gudang_pupuk_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_gudang_pupuk' => 'nullable|numeric',
                'traktor_rusak' => 'nullable|integer',
                'harga_satuan_traktor' => 'nullable|numeric',
            ]);
            $formPertanian->update($validated);
            \DB::commit();
            return redirect()->route('forms.form4.list-format10', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 10)
     */
    public function destroy($id)
    {
        $form = \App\Models\Format10Form4::findOrFail($id);
        $bencana_id = $form->bencana_id;
        $form->delete(); // Hard delete
        return redirect()->route('forms.form4.list-format10', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }
}
