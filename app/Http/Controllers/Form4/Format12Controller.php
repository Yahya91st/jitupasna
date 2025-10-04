<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format12Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format12Controller extends Controller
{
    /**
     * Display Format 12 form for data collection
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
        
        return view('forms.form4.format12.format12form4', compact('bencana'));
    }

    /**
     * Store format12 form data
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the basic required fields and form fields
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                
                // Tempat Pemeliharaan fields
                'tempat_pemeliharaan_jenis_0' => 'nullable|string',
                'tempat_pemeliharaan_unit_0' => 'nullable|integer',
                'tempat_pemeliharaan_harga_satuan_0' => 'nullable|numeric',
                'tempat_pemeliharaan_jenis_1' => 'nullable|string',
                'tempat_pemeliharaan_unit_1' => 'nullable|integer',
                'tempat_pemeliharaan_harga_satuan_1' => 'nullable|numeric',
                'tempat_pemeliharaan_jenis_2' => 'nullable|string',
                'tempat_pemeliharaan_unit_2' => 'nullable|integer',
                'tempat_pemeliharaan_harga_satuan_2' => 'nullable|numeric',
                
                // Kapal Perahu fields
                'kerusakan_kapal_perahu_jenis_0' => 'nullable|string',
                'kerusakan_kapal_perahu_unit_0' => 'nullable|integer',
                'kerusakan_kapal_perahu_harga_satuan_0' => 'nullable|numeric',
                'kerusakan_kapal_perahu_jenis_1' => 'nullable|string',
                'kerusakan_kapal_perahu_unit_1' => 'nullable|integer',
                'kerusakan_kapal_perahu_harga_satuan_1' => 'nullable|numeric',
                'kerusakan_kapal_perahu_jenis_2' => 'nullable|string',
                'kerusakan_kapal_perahu_unit_2' => 'nullable|integer',
                'kerusakan_kapal_perahu_harga_satuan_2' => 'nullable|numeric',
                
                // Additional fields from the form can be added here as needed
            ]);

            // Map form fields to model's generic structure
            // For now, we'll map the first few tempat_pemeliharaan entries to the model fields
            $modelData = [
                'bencana_id' => $validated['bencana_id'],
                'nama_kampung' => $validated['nama_kampung'],
                'nama_distrik' => $validated['nama_distrik'],
                'item_rusak_1' => $validated['tempat_pemeliharaan_jenis_0'] ?? null,
                'jumlah_rusak_1' => $validated['tempat_pemeliharaan_unit_0'] ?? 0,
                'harga_satuan_1' => $validated['tempat_pemeliharaan_harga_satuan_0'] ?? 0,
                'item_rusak_2' => $validated['tempat_pemeliharaan_jenis_1'] ?? null,
                'jumlah_rusak_2' => $validated['tempat_pemeliharaan_unit_1'] ?? 0,
                'harga_satuan_2' => $validated['tempat_pemeliharaan_harga_satuan_1'] ?? 0,
                'item_rusak_3' => $validated['tempat_pemeliharaan_jenis_2'] ?? null,
                'jumlah_rusak_3' => $validated['tempat_pemeliharaan_unit_2'] ?? 0,
                'harga_satuan_3' => $validated['tempat_pemeliharaan_harga_satuan_2'] ?? 0,
                'item_rusak_4' => $validated['kerusakan_kapal_perahu_jenis_0'] ?? null,
                'jumlah_rusak_4' => $validated['kerusakan_kapal_perahu_unit_0'] ?? 0,
                'harga_satuan_4' => $validated['kerusakan_kapal_perahu_harga_satuan_0'] ?? 0,
                'item_rusak_5' => $validated['kerusakan_kapal_perahu_jenis_1'] ?? null,
                'jumlah_rusak_5' => $validated['kerusakan_kapal_perahu_unit_1'] ?? 0,
                'harga_satuan_5' => $validated['kerusakan_kapal_perahu_harga_satuan_1'] ?? 0,
                'total_biaya' => 0, // Can be calculated from the individual items
                'keterangan' => null,
            ];

            // Create new form data
            $formData = Format12Form4::create($modelData);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formData
                ]);
            }

            return redirect()->route('forms.form4.list-format12', ['bencana_id' => $formData->bencana_id])
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
        $formData = Format12Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        // Prepare data array that matches the Blade template expectations
        $data = [
            'nama_kampung' => $formData->nama_kampung,
            'nama_distrik' => $formData->nama_distrik,
            
            // A. Kerusakan Sarana Budidaya - Map generic items to specific facility types
            'kolam_ikan_jumlah' => $formData->jumlah_rusak_1 ?? 0,
            'kolam_ikan_harga' => $formData->harga_satuan_1 ?? 0,
            'kolam_ikan_total' => ($formData->jumlah_rusak_1 ?? 0) * ($formData->harga_satuan_1 ?? 0),
            
            'tambak_jumlah' => $formData->jumlah_rusak_2 ?? 0,
            'tambak_harga' => $formData->harga_satuan_2 ?? 0,
            'tambak_total' => ($formData->jumlah_rusak_2 ?? 0) * ($formData->harga_satuan_2 ?? 0),
            
            'keramba_jumlah' => $formData->jumlah_rusak_3 ?? 0,
            'keramba_harga' => $formData->harga_satuan_3 ?? 0,
            'keramba_total' => ($formData->jumlah_rusak_3 ?? 0) * ($formData->harga_satuan_3 ?? 0),
            
            'hatchery_jumlah' => $formData->jumlah_rusak_4 ?? 0,
            'hatchery_harga' => $formData->harga_satuan_4 ?? 0,
            'hatchery_total' => ($formData->jumlah_rusak_4 ?? 0) * ($formData->harga_satuan_4 ?? 0),
            
            'lainnya_jenis_sarana' => $formData->item_rusak_5 ?? 'Lainnya',
            'lainnya_sarana_jumlah' => $formData->jumlah_rusak_5 ?? 0,
            'lainnya_sarana_harga' => $formData->harga_satuan_5 ?? 0,
            'lainnya_sarana_total' => ($formData->jumlah_rusak_5 ?? 0) * ($formData->harga_satuan_5 ?? 0),
            
            // B. Kerusakan Sarana Tangkap - Default values as not in current model
            'perahu_motor_jumlah' => 0,
            'perahu_motor_harga' => 0,
            'perahu_motor_total' => 0,
            
            'perahu_dayung_jumlah' => 0,
            'perahu_dayung_harga' => 0,
            'perahu_dayung_total' => 0,
            
            'jaring_insang_jumlah' => 0,
            'jaring_insang_harga' => 0,
            'jaring_insang_total' => 0,
            
            'jaring_purse_seine_jumlah' => 0,
            'jaring_purse_seine_harga' => 0,
            'jaring_purse_seine_total' => 0,
            
            'alat_penangkap_lain_jumlah' => 0,
            'alat_penangkap_lain_harga' => 0,
            'alat_penangkap_lain_total' => 0,
            
            // C. Kematian/Hilangnya Hasil Perikanan - Default values as not in current model
            'ikan_lele_jumlah' => 0,
            'ikan_lele_harga' => 0,
            'ikan_lele_total' => 0,
            
            'ikan_nila_jumlah' => 0,
            'ikan_nila_harga' => 0,
            'ikan_nila_total' => 0,
            
            'udang_jumlah' => 0,
            'udang_harga' => 0,
            'udang_total' => 0,
            
            'bandeng_jumlah' => 0,
            'bandeng_harga' => 0,
            'bandeng_total' => 0,
            
            'lainnya_jenis_ikan' => 'Lainnya',
            'lainnya_ikan_jumlah' => 0,
            'lainnya_ikan_harga' => 0,
            'lainnya_ikan_total' => 0,
            
            // D. Dampak Ekonomi - Default values as not in current model
            'kehilangan_pendapatan_harian' => 0,
            'hari_tidak_melaut' => 0,
            'biaya_sewa_alat' => 0,
            'kenaikan_harga_pakan' => 0,
        ];
        
        return view('forms.form4.format12.show-format12', compact('formData', 'bencana', 'data'));
    }

    /**
     * Show the form for editing the specified resource (Format 12)
     */
    public function edit($id)
    {
        $formPerikanan = Format12Form4::with('bencana')->findOrFail($id);
        $bencana = $formPerikanan->bencana;
        return view('forms.form4.format12.edit', compact('formPerikanan', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 12)
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $formData = Format12Form4::findOrFail($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
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
            $formData->update($validated);
            DB::commit();
            return redirect()->route('forms.form4.list-format12', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 12)
     */
    public function destroy($id)
    {
        $form = Format12Form4::findOrFail($id);
        $bencana_id = $form->bencana_id;
        $form->delete(); // Hard delete
        return redirect()->route('forms.form4.list-format12', ['bencana_id' => $bencana_id])
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
        $reports = Format12Form4::where('bencana_id', $bencana_id)->get(); // No soft delete filter
        return view('forms.form4.format12.list-format12', compact('bencana', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formData = Format12Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format12.pdf', compact('formData', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format12_' . $formData->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formData = Format12Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format12.pdf', compact('formData', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format12_' . $formData->nama_kampung . '.pdf');
    }
}
