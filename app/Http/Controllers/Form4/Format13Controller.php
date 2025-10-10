<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format13Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format13Controller extends Controller
{
    /**
     * Display Format 13 form for data collection
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
        
        return view('forms.form4.format13.format13form4', compact('bencana'));
    }

    /**
     * Store format13 form data
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
                // Format 13 specific fields - customize based on actual form requirements
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
             $form = Format13Form4::create($validated);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' =>  $form
                ]);
            }

            return redirect()->route('forms.form4.list-format13', ['bencana_id' =>  $form->bencana_id])
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
         $form = Format13Form4::with('bencana')->findOrFail($id);
        $bencana =  $form->bencana;
        
        // Prepare data array that matches the Blade template expectations
        $data = [
            'nama_kampung' =>  $form->nama_kampung,
            'nama_distrik' =>  $form->nama_distrik,
            
            // A. Kerusakan Bangunan Produksi - Map generic items to specific building types
            'unit_produksi_jumlah' =>  $form->jumlah_rusak_1 ?? 0,
            'unit_produksi_luas' => 0, // Not available in current model
            'unit_produksi_harga' =>  $form->harga_satuan_1 ?? 0,
            'unit_produksi_total' => ( $form->jumlah_rusak_1 ?? 0) * ( $form->harga_satuan_1 ?? 0),
            
            'gudang_jumlah' =>  $form->jumlah_rusak_2 ?? 0,
            'gudang_luas' => 0,
            'gudang_harga' =>  $form->harga_satuan_2 ?? 0,
            'gudang_total' => ( $form->jumlah_rusak_2 ?? 0) * ( $form->harga_satuan_2 ?? 0),
            
            'toko_jumlah' =>  $form->jumlah_rusak_3 ?? 0,
            'toko_luas' => 0,
            'toko_harga' =>  $form->harga_satuan_3 ?? 0,
            'toko_total' => ( $form->jumlah_rusak_3 ?? 0) * ( $form->harga_satuan_3 ?? 0),
            
            'lainnya_jenis_bangunan' =>  $form->item_rusak_4 ?? 'Lainnya',
            'lainnya_bangunan_jumlah' =>  $form->jumlah_rusak_4 ?? 0,
            'lainnya_bangunan_luas' => 0,
            'lainnya_bangunan_harga' =>  $form->harga_satuan_4 ?? 0,
            'lainnya_bangunan_total' => ( $form->jumlah_rusak_4 ?? 0) * ( $form->harga_satuan_4 ?? 0),
            
            // B. Kerusakan Peralatan Produksi - Map to equipment types
            'mesin_jahit_jumlah' => 0, // Default values since current model doesn't have these
            'mesin_jahit_harga' => 0,
            'mesin_jahit_total' => 0,
            
            'oven_jumlah' => 0,
            'oven_harga' => 0,
            'oven_total' => 0,
            
            'etalase_jumlah' => 0,
            'etalase_harga' => 0,
            'etalase_total' => 0,
            
            'lainnya_jenis_peralatan' =>  $form->item_rusak_5 ?? 'Lainnya',
            'lainnya_peralatan_jumlah' =>  $form->jumlah_rusak_5 ?? 0,
            'lainnya_peralatan_harga' =>  $form->harga_satuan_5 ?? 0,
            'lainnya_peralatan_total' => ( $form->jumlah_rusak_5 ?? 0) * ( $form->harga_satuan_5 ?? 0),
            
            // C. Kehilangan Produksi & Pendapatan - Default values as not in current model
            'roti_produksi' => 0,
            'roti_harga' => 0,
            'roti_hari' => 0,
            'roti_total' => 0,
            
            'pakaian_produksi' => 0,
            'pakaian_harga' => 0,
            'pakaian_hari' => 0,
            'pakaian_total' => 0,
            
            'mebel_produksi' => 0,
            'mebel_harga' => 0,
            'mebel_hari' => 0,
            'mebel_total' => 0,
            
            'lainnya_jenis_usaha' => 'Lainnya',
            'lainnya_usaha_produksi' => 0,
            'lainnya_usaha_harga' => 0,
            'lainnya_usaha_hari' => 0,
            'lainnya_usaha_total' => 0,
            
            // D. Biaya Tambahan - Default values as not in current model
            'sewa_tempat' => 0,
            'transportasi_bahan' => 0,
            'alat_bantu' => 0,
        ];
        
        return view('forms.form4.format13.show-format13', compact(' form', 'bencana', 'data'));
    }

    /**
     * Show the form for editing the specified resource (Format 13)
     */
    public function edit($id)
    {
        $formIndustri = Format13Form4::with('bencana')->findOrFail($id);
        $bencana = $formIndustri->bencana;
        return view('forms.form4.format13.edit', compact('formIndustri', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 13)
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
             $form = Format13Form4::findOrFail($id);
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
             $form->update($validated);
            DB::commit();
            return redirect()->route('forms.form4.list-format13', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 13)
     */
    public function destroy($id)
    {
        $form = Format13Form4::findOrFail($id);
        $bencana_id = $form->bencana_id;
        $form->delete(); // Hard delete
        return redirect()->route('forms.form4.list-format13', ['bencana_id' => $bencana_id])
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
        $reports = Format13Form4::where('bencana_id', $bencana_id)->get(); // No soft delete filter
        return view('forms.form4.format13.list-format13', compact('bencana', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
         $form = Format13Form4::with('bencana')->findOrFail($id);
        $bencana =  $form->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format13.pdf', compact(' form', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format13_' .  $form->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
         $form = Format13Form4::with('bencana')->findOrFail($id);
        $bencana =  $form->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format13.pdf', compact(' form', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format13_' .  $form->nama_kampung . '.pdf');
    }
}
