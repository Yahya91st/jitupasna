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

            // Validate the request with actual form fields
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                'kabupaten' => 'nullable|string',
                // Kematian fields
                'kematian_jenis_0' => 'nullable|string',
                'kematian_unit_0' => 'nullable|integer|min:0',
                'kematian_harga_satuan_0' => 'nullable|numeric|min:0',
                'kematian_jenis_1' => 'nullable|string',
                'kematian_unit_1' => 'nullable|integer|min:0',
                'kematian_harga_satuan_1' => 'nullable|numeric|min:0',
                'kematian_jenis_2' => 'nullable|string',
                'kematian_unit_2' => 'nullable|integer|min:0',
                'kematian_harga_satuan_2' => 'nullable|numeric|min:0',
                // Kandang fields
                'kandang_jenis_0' => 'nullable|string',
                'kandang_unit_0' => 'nullable|integer|min:0',
                'kandang_harga_satuan_0' => 'nullable|numeric|min:0',
                'kandang_jenis_1' => 'nullable|string',
                'kandang_unit_1' => 'nullable|integer|min:0',
                'kandang_harga_satuan_1' => 'nullable|numeric|min:0',
                'kandang_jenis_2' => 'nullable|string',
                'kandang_unit_2' => 'nullable|integer|min:0',
                'kandang_harga_satuan_2' => 'nullable|numeric|min:0',
                // Peralatan fields
                'peralatan_jenis_0' => 'nullable|string',
                'peralatan_unit_0' => 'nullable|integer|min:0',
                'peralatan_harga_satuan_0' => 'nullable|numeric|min:0',
                'peralatan_jenis_1' => 'nullable|string',
                'peralatan_unit_1' => 'nullable|integer|min:0',
                'peralatan_harga_satuan_1' => 'nullable|numeric|min:0',
                'peralatan_jenis_2' => 'nullable|string',
                'peralatan_unit_2' => 'nullable|integer|min:0',
                'peralatan_harga_satuan_2' => 'nullable|numeric|min:0',
                // Hilang fields
                'hilang_jenis_0' => 'nullable|string',
                'hilang_unit_0' => 'nullable|integer|min:0',
                'hilang_harga_satuan_0' => 'nullable|numeric|min:0',
                'hilang_jenis_1' => 'nullable|string',
                'hilang_unit_1' => 'nullable|integer|min:0',
                'hilang_harga_satuan_1' => 'nullable|numeric|min:0',
                'hilang_jenis_2' => 'nullable|string',
                'hilang_unit_2' => 'nullable|integer|min:0',
                'hilang_harga_satuan_2' => 'nullable|numeric|min:0',
                // Produktifitas fields
                'produktifitas_jenis_0' => 'nullable|string',
                'produktifitas_unit_0' => 'nullable|integer|min:0',
                'produktifitas_harga_satuan_0' => 'nullable|numeric|min:0',
                'produktifitas_jenis_1' => 'nullable|string',
                'produktifitas_unit_1' => 'nullable|integer|min:0',
                'produktifitas_harga_satuan_1' => 'nullable|numeric|min:0',
                'produktifitas_jenis_2' => 'nullable|string',
                'produktifitas_unit_2' => 'nullable|integer|min:0',
                'produktifitas_harga_satuan_2' => 'nullable|numeric|min:0',
                // Ongkos fields
                'ongkos_jenis_0' => 'nullable|string',
                'ongkos_unit_0' => 'nullable|integer|min:0',
                'ongkos_harga_satuan_0' => 'nullable|numeric|min:0',
                'ongkos_jenis_1' => 'nullable|string',
                'ongkos_unit_1' => 'nullable|integer|min:0',
                'ongkos_harga_satuan_1' => 'nullable|numeric|min:0',
                'ongkos_jenis_2' => 'nullable|string',
                'ongkos_unit_2' => 'nullable|integer|min:0',
                'ongkos_harga_satuan_2' => 'nullable|numeric|min:0',
            ]);

            // Map form fields to model structure
            $mappedData = [
                'bencana_id' => $validated['bencana_id'],
                'nama_kampung' => $validated['nama_kampung'],
                'nama_distrik' => $validated['nama_distrik'],
                // Map kematian fields (0->1, 1->2, 2->3, add extra one as kematian_4)
                'kematian_1_jenis' => $validated['kematian_jenis_0'] ?? null,
                'kematian_1_unit' => $validated['kematian_unit_0'] ?? 0,
                'kematian_1_harga_satuan' => $validated['kematian_harga_satuan_0'] ?? 0,
                'kematian_2_jenis' => $validated['kematian_jenis_1'] ?? null,
                'kematian_2_unit' => $validated['kematian_unit_1'] ?? 0,
                'kematian_2_harga_satuan' => $validated['kematian_harga_satuan_1'] ?? 0,
                'kematian_3_jenis' => $validated['kematian_jenis_2'] ?? null,
                'kematian_3_unit' => $validated['kematian_unit_2'] ?? 0,
                'kematian_3_harga_satuan' => $validated['kematian_harga_satuan_2'] ?? 0,
                'kematian_4_jenis' => null, // Extra field in model
                'kematian_4_unit' => 0,
                'kematian_4_harga_satuan' => 0,
                // Map kandang fields
                'kandang_1_jenis' => $validated['kandang_jenis_0'] ?? null,
                'kandang_1_unit' => $validated['kandang_unit_0'] ?? 0,
                'kandang_1_harga_satuan' => $validated['kandang_harga_satuan_0'] ?? 0,
                'kandang_2_jenis' => $validated['kandang_jenis_1'] ?? null,
                'kandang_2_unit' => $validated['kandang_unit_1'] ?? 0,
                'kandang_2_harga_satuan' => $validated['kandang_harga_satuan_1'] ?? 0,
                'kandang_3_jenis' => $validated['kandang_jenis_2'] ?? null,
                'kandang_3_unit' => $validated['kandang_unit_2'] ?? 0,
                'kandang_3_harga_satuan' => $validated['kandang_harga_satuan_2'] ?? 0,
                // Map peralatan fields
                'peralatan_1_jenis' => $validated['peralatan_jenis_0'] ?? null,
                'peralatan_1_unit' => $validated['peralatan_unit_0'] ?? 0,
                'peralatan_1_harga_satuan' => $validated['peralatan_harga_satuan_0'] ?? 0,
                'peralatan_2_jenis' => $validated['peralatan_jenis_1'] ?? null,
                'peralatan_2_unit' => $validated['peralatan_unit_1'] ?? 0,
                'peralatan_2_harga_satuan' => $validated['peralatan_harga_satuan_1'] ?? 0,
                'peralatan_3_jenis' => $validated['peralatan_jenis_2'] ?? null,
                'peralatan_3_unit' => $validated['peralatan_unit_2'] ?? 0,
                'peralatan_3_harga_satuan' => $validated['peralatan_harga_satuan_2'] ?? 0,
                // Map hilang fields
                'hilang_1_jenis' => $validated['hilang_jenis_0'] ?? null,
                'hilang_1_unit' => $validated['hilang_unit_0'] ?? 0,
                'hilang_1_harga_satuan' => $validated['hilang_harga_satuan_0'] ?? 0,
                'hilang_2_jenis' => $validated['hilang_jenis_1'] ?? null,
                'hilang_2_unit' => $validated['hilang_unit_1'] ?? 0,
                'hilang_2_harga_satuan' => $validated['hilang_harga_satuan_1'] ?? 0,
                'hilang_3_jenis' => $validated['hilang_jenis_2'] ?? null,
                'hilang_3_unit' => $validated['hilang_unit_2'] ?? 0,
                'hilang_3_harga_satuan' => $validated['hilang_harga_satuan_2'] ?? 0,
                // Map produktifitas fields
                'produktifitas_1_jenis' => $validated['produktifitas_jenis_0'] ?? null,
                'produktifitas_1_unit' => $validated['produktifitas_unit_0'] ?? 0,
                'produktifitas_1_harga_satuan' => $validated['produktifitas_harga_satuan_0'] ?? 0,
                'produktifitas_2_jenis' => $validated['produktifitas_jenis_1'] ?? null,
                'produktifitas_2_unit' => $validated['produktifitas_unit_1'] ?? 0,
                'produktifitas_2_harga_satuan' => $validated['produktifitas_harga_satuan_1'] ?? 0,
                'produktifitas_3_jenis' => $validated['produktifitas_jenis_2'] ?? null,
                'produktifitas_3_unit' => $validated['produktifitas_unit_2'] ?? 0,
                'produktifitas_3_harga_satuan' => $validated['produktifitas_harga_satuan_2'] ?? 0,
                // Map ongkos fields
                'ongkos_1_jenis' => $validated['ongkos_jenis_0'] ?? null,
                'ongkos_1_unit' => $validated['ongkos_unit_0'] ?? 0,
                'ongkos_1_harga_satuan' => $validated['ongkos_harga_satuan_0'] ?? 0,
                'ongkos_2_jenis' => $validated['ongkos_jenis_1'] ?? null,
                'ongkos_2_unit' => $validated['ongkos_unit_1'] ?? 0,
                'ongkos_2_harga_satuan' => $validated['ongkos_harga_satuan_1'] ?? 0,
                'ongkos_3_jenis' => $validated['ongkos_jenis_2'] ?? null,
                'ongkos_3_unit' => $validated['ongkos_unit_2'] ?? 0,
                'ongkos_3_harga_satuan' => $validated['ongkos_harga_satuan_2'] ?? 0,
                // Calculate totals (optional)
                'total_kerusakan' => 0,
                'total_kerugian' => 0,
            ];

            // Create new form data
             $form = Format11Form4::create($mappedData);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' =>  $form
                ]);
            }

            return redirect()->route('forms.form4.list-format11', ['bencana_id' =>  $form->bencana_id])
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
         $form = Format11Form4::with('bencana')->findOrFail($id);
        $bencana =  $form->bencana;
        
        // Map model fields to expected data array structure for the view
        $data = [
            'nama_kampung' =>  $form->nama_kampung,
            'nama_distrik' =>  $form->nama_distrik,
            
            // A. Kerusakan Bangunan & Sarana Peternakan
            'kandang_rb' =>  $form->kandang_1_unit ?? 0,
            'kandang_rs' =>  $form->kandang_2_unit ?? 0,
            'kandang_rr' =>  $form->kandang_3_unit ?? 0,
            'kandang_luas' => 100, // Default value - approximate livestock building size
            'kandang_harga_m2' =>  $form->kandang_1_harga_satuan ?? 0,
            
            'gudang_pakan_rb' => 0, // Not mapped to current model structure
            'gudang_pakan_rs' => 0,
            'gudang_pakan_rr' => 0,
            'gudang_pakan_luas' => 50, // Default value
            'gudang_pakan_harga_m2' => 0,
            
            'balai_inseminasi_rb' => 0, // Not mapped to current model structure
            'balai_inseminasi_rs' => 0,
            'balai_inseminasi_rr' => 0,
            'balai_inseminasi_luas' => 80, // Default value
            'balai_inseminasi_harga_m2' => 0,
            
            'lainnya_jenis_bangunan' =>  $form->peralatan_1_jenis ?? 'Lainnya',
            'lainnya_bangunan_rb' =>  $form->peralatan_1_unit ?? 0,
            'lainnya_bangunan_rs' =>  $form->peralatan_2_unit ?? 0,
            'lainnya_bangunan_rr' =>  $form->peralatan_3_unit ?? 0,
            'lainnya_bangunan_luas' => 60, // Default value
            'lainnya_bangunan_harga_m2' =>  $form->peralatan_1_harga_satuan ?? 0,
            
            // B. Kerusakan Peralatan
            'mesin_pencacah_jumlah' =>  $form->peralatan_1_unit ?? 0,
            'mesin_pencacah_harga' =>  $form->peralatan_1_harga_satuan ?? 0,
            
            'mesin_pakan_jumlah' =>  $form->peralatan_2_unit ?? 0,
            'mesin_pakan_harga' =>  $form->peralatan_2_harga_satuan ?? 0,
            
            'alat_penampung_susu_jumlah' =>  $form->peralatan_3_unit ?? 0,
            'alat_penampung_susu_harga' =>  $form->peralatan_3_harga_satuan ?? 0,
            
            'lainnya_jenis_peralatan' =>  $form->peralatan_3_jenis ?? 'Lainnya',
            'lainnya_peralatan_jumlah' =>  $form->peralatan_3_unit ?? 0,
            'lainnya_peralatan_harga' =>  $form->peralatan_3_harga_satuan ?? 0,
            
            // C. Kematian Hewan Ternak - Map from kematian fields
            'sapi_jumlah' =>  $form->kematian_1_unit ?? 0,
            'sapi_harga' =>  $form->kematian_1_harga_satuan ?? 0,
            
            'kambing_jumlah' =>  $form->kematian_2_unit ?? 0,
            'kambing_harga' =>  $form->kematian_2_harga_satuan ?? 0,
            
            'ayam_jumlah' =>  $form->kematian_3_unit ?? 0,
            'ayam_harga' =>  $form->kematian_3_harga_satuan ?? 0,
            
            'babi_jumlah' =>  $form->kematian_4_unit ?? 0,
            'babi_harga' =>  $form->kematian_4_harga_satuan ?? 0,
            
            'lainnya_jenis_ternak' =>  $form->hilang_1_jenis ?? 'Lainnya',
            'lainnya_ternak_jumlah' =>  $form->hilang_1_unit ?? 0,
            'lainnya_ternak_harga' =>  $form->hilang_1_harga_satuan ?? 0,
            
            // D. Dampak Ekonomi - Map from various fields or defaults
            'kehilangan_pendapatan' => ( $form->produktifitas_1_unit ?? 0) * ( $form->produktifitas_1_harga_satuan ?? 0),
            'penurunan_produksi' =>  $form->produktifitas_2_unit ?? 0,
            'kenaikan_harga_pakan' =>  $form->ongkos_1_harga_satuan ?? 0,
            'biaya_kesehatan_ternak' =>  $form->ongkos_2_harga_satuan ?? 0,
        ];
        
        return view('forms.form4.format11.show-format11', compact(' form', 'bencana', 'data'));
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
         $form = Format11Form4::with('bencana')->findOrFail($id);
        $bencana =  $form->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format11.pdf', compact(' form', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format11_' .  $form->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
         $form = Format11Form4::with('bencana')->findOrFail($id);
        $bencana =  $form->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format11.pdf', compact(' form', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format11_' .  $form->nama_kampung . '.pdf');
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
             $form = Format11Form4::findOrFail($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // ...validation rules sesuai kebutuhan format11...
            ]);
             $form->update($validated);
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
        $form = Format11Form4::findOrFail($id);
        $bencana_id = $form->bencana_id;
        $form->delete(); // Hard delete
        return redirect()->route('forms.form4.list-format11', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }
}
