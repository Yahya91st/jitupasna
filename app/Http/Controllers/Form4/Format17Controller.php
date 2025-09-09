<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format17Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format17Controller extends Controller
{
    /**
     * Display Format 17 form for data collection
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
        
        return view('forms.form4.format17.format17form4', compact('bencana'));
    }

    /**
     * Store format17 form data
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
                // Ekosistem Darat
                'ekosistem_darat_1_jenis' => 'nullable|string',
                'ekosistem_darat_1_rb' => 'nullable|integer',
                'ekosistem_darat_1_rs' => 'nullable|integer',
                'ekosistem_darat_1_rr' => 'nullable|integer',
                'ekosistem_darat_1_rb_harga' => 'nullable|numeric',
                'ekosistem_darat_1_rs_harga' => 'nullable|numeric',
                'ekosistem_darat_1_rr_harga' => 'nullable|numeric',
                'ekosistem_darat_2_jenis' => 'nullable|string',
                'ekosistem_darat_2_rb' => 'nullable|integer',
                'ekosistem_darat_2_rs' => 'nullable|integer',
                'ekosistem_darat_2_rr' => 'nullable|integer',
                'ekosistem_darat_2_rb_harga' => 'nullable|numeric',
                'ekosistem_darat_2_rs_harga' => 'nullable|numeric',
                'ekosistem_darat_2_rr_harga' => 'nullable|numeric',
                'ekosistem_darat_3_jenis' => 'nullable|string',
                'ekosistem_darat_3_rb' => 'nullable|integer',
                'ekosistem_darat_3_rs' => 'nullable|integer',
                'ekosistem_darat_3_rr' => 'nullable|integer',
                'ekosistem_darat_3_rb_harga' => 'nullable|numeric',
                'ekosistem_darat_3_rs_harga' => 'nullable|numeric',
                'ekosistem_darat_3_rr_harga' => 'nullable|numeric',
                // Ekosistem Laut
                'ekosistem_laut_1_jenis' => 'nullable|string',
                'ekosistem_laut_1_rb' => 'nullable|integer',
                'ekosistem_laut_1_rs' => 'nullable|integer',
                'ekosistem_laut_1_rr' => 'nullable|integer',
                'ekosistem_laut_1_rb_harga' => 'nullable|numeric',
                'ekosistem_laut_1_rs_harga' => 'nullable|numeric',
                'ekosistem_laut_1_rr_harga' => 'nullable|numeric',
                'ekosistem_laut_2_jenis' => 'nullable|string',
                'ekosistem_laut_2_rb' => 'nullable|integer',
                'ekosistem_laut_2_rs' => 'nullable|integer',
                'ekosistem_laut_2_rr' => 'nullable|integer',
                'ekosistem_laut_2_rb_harga' => 'nullable|numeric',
                'ekosistem_laut_2_rs_harga' => 'nullable|numeric',
                'ekosistem_laut_2_rr_harga' => 'nullable|numeric',
                'ekosistem_laut_3_jenis' => 'nullable|string',
                'ekosistem_laut_3_rb' => 'nullable|integer',
                'ekosistem_laut_3_rs' => 'nullable|integer',
                'ekosistem_laut_3_rr' => 'nullable|integer',
                'ekosistem_laut_3_rb_harga' => 'nullable|numeric',
                'ekosistem_laut_3_rs_harga' => 'nullable|numeric',
                'ekosistem_laut_3_rr_harga' => 'nullable|numeric',
                // Ekosistem Udara
                'ekosistem_udara_1_jenis' => 'nullable|string',
                'ekosistem_udara_1_rb' => 'nullable|integer',
                'ekosistem_udara_1_rs' => 'nullable|integer',
                'ekosistem_udara_1_rr' => 'nullable|integer',
                'ekosistem_udara_1_rb_harga' => 'nullable|numeric',
                'ekosistem_udara_1_rs_harga' => 'nullable|numeric',
                'ekosistem_udara_1_rr_harga' => 'nullable|numeric',
                'ekosistem_udara_2_jenis' => 'nullable|string',
                'ekosistem_udara_2_rb' => 'nullable|integer',
                'ekosistem_udara_2_rs' => 'nullable|integer',
                'ekosistem_udara_2_rr' => 'nullable|integer',
                'ekosistem_udara_2_rb_harga' => 'nullable|numeric',
                'ekosistem_udara_2_rs_harga' => 'nullable|numeric',
                'ekosistem_udara_2_rr_harga' => 'nullable|numeric',
                'ekosistem_udara_3_jenis' => 'nullable|string',
                'ekosistem_udara_3_rb' => 'nullable|integer',
                'ekosistem_udara_3_rs' => 'nullable|integer',
                'ekosistem_udara_3_rr' => 'nullable|integer',
                'ekosistem_udara_3_rb_harga' => 'nullable|numeric',
                'ekosistem_udara_3_rs_harga' => 'nullable|numeric',
                'ekosistem_udara_3_rr_harga' => 'nullable|numeric',
                // Kerugian Lingkungan
                'kerugian_1_jenis' => 'nullable|string',
                'kerugian_1_rb' => 'nullable|integer',
                'kerugian_1_rs' => 'nullable|integer',
                'kerugian_1_rr' => 'nullable|integer',
                'kerugian_1_rb_harga' => 'nullable|numeric',
                'kerugian_1_rs_harga' => 'nullable|numeric',
                'kerugian_1_rr_harga' => 'nullable|numeric',
                'kerugian_2_jenis' => 'nullable|string',
                'kerugian_2_rb' => 'nullable|integer',
                'kerugian_2_rs' => 'nullable|integer',
                'kerugian_2_rr' => 'nullable|integer',
                'kerugian_2_rb_harga' => 'nullable|numeric',
                'kerugian_2_rs_harga' => 'nullable|numeric',
                'kerugian_2_rr_harga' => 'nullable|numeric',
                'kerugian_3_jenis' => 'nullable|string',
                'kerugian_3_rb' => 'nullable|integer',
                'kerugian_3_rs' => 'nullable|integer',
                'kerugian_3_rr' => 'nullable|integer',
                'kerugian_3_rb_harga' => 'nullable|numeric',
                'kerugian_3_rs_harga' => 'nullable|numeric',
                'kerugian_3_rr_harga' => 'nullable|numeric',
                'total_kerusakan' => 'nullable|numeric',
            ]);

            // Create new form data
            $formData = Format17Form4::create($validated);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formData
                ]);
            }

            return redirect()->route('forms.form4.list-format17', ['bencana_id' => $formData->bencana_id])
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
        $formData = Format17Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        return view('forms.form4.format17.show-format17', compact('formData', 'bencana'));
    }

    /**
     * Show the form for editing the specified resource (Format 17)
     */
    public function edit($id)
    {
        $formLingkungan = Format17Form4::with('bencana')->findOrFail($id);
        $bencana = $formLingkungan->bencana;
        return view('forms.form4.format17.edit', compact('formLingkungan', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 17)
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $formData = Format17Form4::findOrFail($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Ekosistem Darat
                'ekosistem_darat_1_jenis' => 'nullable|string',
                'ekosistem_darat_1_rb' => 'nullable|integer',
                'ekosistem_darat_1_rs' => 'nullable|integer',
                'ekosistem_darat_1_rr' => 'nullable|integer',
                'ekosistem_darat_1_rb_harga' => 'nullable|numeric',
                'ekosistem_darat_1_rs_harga' => 'nullable|numeric',
                'ekosistem_darat_1_rr_harga' => 'nullable|numeric',
                'ekosistem_darat_2_jenis' => 'nullable|string',
                'ekosistem_darat_2_rb' => 'nullable|integer',
                'ekosistem_darat_2_rs' => 'nullable|integer',
                'ekosistem_darat_2_rr' => 'nullable|integer',
                'ekosistem_darat_2_rb_harga' => 'nullable|numeric',
                'ekosistem_darat_2_rs_harga' => 'nullable|numeric',
                'ekosistem_darat_2_rr_harga' => 'nullable|numeric',
                'ekosistem_darat_3_jenis' => 'nullable|string',
                'ekosistem_darat_3_rb' => 'nullable|integer',
                'ekosistem_darat_3_rs' => 'nullable|integer',
                'ekosistem_darat_3_rr' => 'nullable|integer',
                'ekosistem_darat_3_rb_harga' => 'nullable|numeric',
                'ekosistem_darat_3_rs_harga' => 'nullable|numeric',
                'ekosistem_darat_3_rr_harga' => 'nullable|numeric',
                // Ekosistem Laut
                'ekosistem_laut_1_jenis' => 'nullable|string',
                'ekosistem_laut_1_rb' => 'nullable|integer',
                'ekosistem_laut_1_rs' => 'nullable|integer',
                'ekosistem_laut_1_rr' => 'nullable|integer',
                'ekosistem_laut_1_rb_harga' => 'nullable|numeric',
                'ekosistem_laut_1_rs_harga' => 'nullable|numeric',
                'ekosistem_laut_1_rr_harga' => 'nullable|numeric',
                'ekosistem_laut_2_jenis' => 'nullable|string',
                'ekosistem_laut_2_rb' => 'nullable|integer',
                'ekosistem_laut_2_rs' => 'nullable|integer',
                'ekosistem_laut_2_rr' => 'nullable|integer',
                'ekosistem_laut_2_rb_harga' => 'nullable|numeric',
                'ekosistem_laut_2_rs_harga' => 'nullable|numeric',
                'ekosistem_laut_2_rr_harga' => 'nullable|numeric',
                'ekosistem_laut_3_jenis' => 'nullable|string',
                'ekosistem_laut_3_rb' => 'nullable|integer',
                'ekosistem_laut_3_rs' => 'nullable|integer',
                'ekosistem_laut_3_rr' => 'nullable|integer',
                'ekosistem_laut_3_rb_harga' => 'nullable|numeric',
                'ekosistem_laut_3_rs_harga' => 'nullable|numeric',
                'ekosistem_laut_3_rr_harga' => 'nullable|numeric',
                // Ekosistem Udara
                'ekosistem_udara_1_jenis' => 'nullable|string',
                'ekosistem_udara_1_rb' => 'nullable|integer',
                'ekosistem_udara_1_rs' => 'nullable|integer',
                'ekosistem_udara_1_rr' => 'nullable|integer',
                'ekosistem_udara_1_rb_harga' => 'nullable|numeric',
                'ekosistem_udara_1_rs_harga' => 'nullable|numeric',
                'ekosistem_udara_1_rr_harga' => 'nullable|numeric',
                'ekosistem_udara_2_jenis' => 'nullable|string',
                'ekosistem_udara_2_rb' => 'nullable|integer',
                'ekosistem_udara_2_rs' => 'nullable|integer',
                'ekosistem_udara_2_rr' => 'nullable|integer',
                'ekosistem_udara_2_rb_harga' => 'nullable|numeric',
                'ekosistem_udara_2_rs_harga' => 'nullable|numeric',
                'ekosistem_udara_2_rr_harga' => 'nullable|numeric',
                'ekosistem_udara_3_jenis' => 'nullable|string',
                'ekosistem_udara_3_rb' => 'nullable|integer',
                'ekosistem_udara_3_rs' => 'nullable|integer',
                'ekosistem_udara_3_rr' => 'nullable|integer',
                'ekosistem_udara_3_rb_harga' => 'nullable|numeric',
                'ekosistem_udara_3_rs_harga' => 'nullable|numeric',
                'ekosistem_udara_3_rr_harga' => 'nullable|numeric',
                // Kerugian Lingkungan
                'kerugian_1_jenis' => 'nullable|string',
                'kerugian_1_rb' => 'nullable|integer',
                'kerugian_1_rs' => 'nullable|integer',
                'kerugian_1_rr' => 'nullable|integer',
                'kerugian_1_rb_harga' => 'nullable|numeric',
                'kerugian_1_rs_harga' => 'nullable|numeric',
                'kerugian_1_rr_harga' => 'nullable|numeric',
                'kerugian_2_jenis' => 'nullable|string',
                'kerugian_2_rb' => 'nullable|integer',
                'kerugian_2_rs' => 'nullable|integer',
                'kerugian_2_rr' => 'nullable|integer',
                'kerugian_2_rb_harga' => 'nullable|numeric',
                'kerugian_2_rs_harga' => 'nullable|numeric',
                'kerugian_2_rr_harga' => 'nullable|numeric',
                'kerugian_3_jenis' => 'nullable|string',
                'kerugian_3_rb' => 'nullable|integer',
                'kerugian_3_rs' => 'nullable|integer',
                'kerugian_3_rr' => 'nullable|integer',
                'kerugian_3_rb_harga' => 'nullable|numeric',
                'kerugian_3_rs_harga' => 'nullable|numeric',
                'kerugian_3_rr_harga' => 'nullable|numeric',
                'total_kerusakan' => 'nullable|numeric',
            ]);
            $formData->update($validated);
            DB::commit();
            return redirect()->route('forms.form4.list-format17', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 17)
     */
    public function destroy($id)
    {
        $form = Format17Form4::findOrFail($id);
        $bencana_id = $form->bencana_id;
        $form->delete(); // Hard delete
        return redirect()->route('forms.form4.list-format17', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
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
        $reports = Format17Form4::where('bencana_id', $bencana_id)->get(); // No soft delete filter
        return view('forms.form4.format17.list-format17', compact('bencana', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formData = Format17Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format17.pdf', compact('formData', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format17_' . $formData->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formData = Format17Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format17.pdf', compact('formData', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format17_' . $formData->nama_kampung . '.pdf');
    }
}
