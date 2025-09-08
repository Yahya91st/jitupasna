<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format11Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format11Controller extends Controller
{
    /**
     * Display Format 11 form for data collection
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
        
        return view('forms.form4.format11.format11form4', compact('bencana'));
    }

    /**
     * Store format11 form data
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
                // Format 11 specific fields - customize based on actual form requirements
                'item_rusak_1' => 'nullable|string',
                'jumlah_rusak_1' => 'nullable|integer',
                'harga_satuan_1' => 'nullable|numeric',
                'item_rusak_2' => 'nullable|string',
                'jumlah_rusak_2' => 'nullable|integer',
                'harga_satuan_2' => 'nullable|numeric',
                'item_rusak_3' => 'nullable|string',
                'jumlah_rusak_3' => 'nullable|integer',
                'harga_satuan_3' => 'nullable|numeric',
                'item_rusak_4' => 'nullable|string',
                'jumlah_rusak_4' => 'nullable|integer',
                'harga_satuan_4' => 'nullable|numeric',
                'item_rusak_5' => 'nullable|string',
                'jumlah_rusak_5' => 'nullable|integer',
                'harga_satuan_5' => 'nullable|numeric',
                'total_biaya' => 'nullable|numeric',
                'keterangan' => 'nullable|string',
            ]);

            // Create new form data
            $formData = Format11Form4::create($validated);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formData
                ]);
            }

            return redirect()->route('forms.form4.list-format11', ['bencana_id' => $formData->bencana_id])
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
        $formData = Format11Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        return view('forms.form4.format11.show-format11', compact('formData', 'bencana'));
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
        $reports = Format11Form4::where('bencana_id', $bencana_id)->get(); // No soft delete filter
        return view('forms.form4.format11.list-format11', compact('bencana', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formData = Format11Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format11.pdf', compact('formData', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format11_' . $formData->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formData = Format11Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format11.pdf', compact('formData', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format11_' . $formData->nama_kampung . '.pdf');
    }

    /**
     * Show the form for editing the specified resource (Format 11)
     */
    public function edit($id)
    {
        $formPeternakan = Format11Form4::with('bencana')->findOrFail($id);
        $bencana = $formPeternakan->bencana;
        return view('forms.form4.format11.edit', compact('formPeternakan', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 11)
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $formData = Format11Form4::findOrFail($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // ...validation rules sesuai kebutuhan format11...
            ]);
            $formData->update($validated);
            DB::commit();
            return redirect()->route('forms.form4.list-format11', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 11)
     */
    public function destroy($id)
    {
        $form = \App\Models\Format11Form4::findOrFail($id);
        $bencana_id = $form->bencana_id;
        $form->delete(); // Hard delete
        return redirect()->route('forms.form4.list-format11', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }
}
