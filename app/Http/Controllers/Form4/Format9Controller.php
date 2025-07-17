<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format9Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format9Controller extends Controller
{
    /**
     * Display Format 9 form for Telecommunications sector data collection
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
        
        return view('forms.form4.format9.format9form4', compact('bencana'));
    }

    /**
     * Store format9 form data for Telecommunications sector
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
                'kerusakan_1_nama' => 'nullable|string',
                'kerusakan_1_satuan' => 'nullable|string',
                'kerusakan_1_jumlah_unit' => 'nullable|integer',
                'kerusakan_1_harga_satuan' => 'nullable|numeric',
                'kerusakan_2_nama' => 'nullable|string',
                'kerusakan_2_satuan' => 'nullable|string',
                'kerusakan_2_jumlah_unit' => 'nullable|integer',
                'kerusakan_2_harga_satuan' => 'nullable|numeric',
                'kerusakan_3_nama' => 'nullable|string',
                'kerusakan_3_satuan' => 'nullable|string',
                'kerusakan_3_jumlah_unit' => 'nullable|integer',
                'kerusakan_3_harga_satuan' => 'nullable|numeric',
                'kerusakan_4_nama' => 'nullable|string',
                'kerusakan_4_satuan' => 'nullable|string',
                'kerusakan_4_jumlah_unit' => 'nullable|integer',
                'kerusakan_4_harga_satuan' => 'nullable|numeric',
                // Telecommunications sector specific fields
                'tower_bts_rusak_total' => 'nullable|integer',
                'tower_bts_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_tower_bts' => 'nullable|numeric',
                'menara_telkom_rusak_total' => 'nullable|integer',
                'menara_telkom_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_menara_telkom' => 'nullable|numeric',
                'kabel_telepon_rusak' => 'nullable|numeric',
                'harga_satuan_kabel_telepon' => 'nullable|numeric',
                'kabel_fiber_optic_rusak' => 'nullable|numeric',
                'harga_satuan_kabel_fiber' => 'nullable|numeric',
                'wartel_rusak_total' => 'nullable|integer',
                'wartel_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_wartel' => 'nullable|numeric',
                'internet_cafe_rusak_total' => 'nullable|integer',
                'internet_cafe_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_internet_cafe' => 'nullable|numeric',
            ]);

            // Create new form data
            $formTelekomunikasi = Format9Form4::create($validated);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formTelekomunikasi
                ]);
            }

            return redirect()->route('forms.form4.list-format9', ['bencana_id' => $formTelekomunikasi->bencana_id])
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
        $formTelekomunikasi = Format9Form4::with('bencana')->findOrFail($id);
        $bencana = $formTelekomunikasi->bencana;
        
        return view('forms.form4.format9.show-format9', compact('formTelekomunikasi', 'bencana'));
    }

    /**
     * List all entries for this format
     */
    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        // Jika bencana_id tidak ada di request, coba ambil dari session (jika sebelumnya pernah disimpan)
        if (!$bencana_id) {
            $bencana_id = session('last_bencana_id');
        }
        // Redirect ke pemilihan bencana jika tetap tidak ada
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        // Simpan bencana_id ke session untuk akses berikutnya
        session(['last_bencana_id' => $bencana_id]);
        $bencana = Bencana::findOrFail($bencana_id);
        $reports = Format9Form4::where('bencana_id', $bencana_id)->get();
        return view('forms.form4.format9.list-format9', compact('bencana', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formTelekomunikasi = Format9Form4::with('bencana')->findOrFail($id);
        $bencana = $formTelekomunikasi->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format9.pdf', compact('formTelekomunikasi', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format9_Telekomunikasi_' . $formTelekomunikasi->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formTelekomunikasi = Format9Form4::with('bencana')->findOrFail($id);
        $bencana = $formTelekomunikasi->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format9.pdf', compact('formTelekomunikasi', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
          return $pdf->stream('Format9_Telekomunikasi_' . $formTelekomunikasi->nama_kampung . '.pdf');
    }

    /**
     * Show the form for editing the specified resource (Format 9)
     */
    public function edit($id)
    {
        $formTelekom = \App\Models\Format9Form4::with('bencana')->findOrFail($id);
        $bencana = $formTelekom->bencana;
        return view('forms.form4.format9.edit', compact('formTelekom', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 9)
     */
    public function update(Request $request, $id)
    {
        try {
            \DB::beginTransaction();
            $formTelekom = \App\Models\Format9Form4::findOrFail($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                'kerusakan_1_nama' => 'nullable|string',
                'kerusakan_1_satuan' => 'nullable|string',
                'kerusakan_1_jumlah_unit' => 'nullable|integer',
                'kerusakan_1_harga_satuan' => 'nullable|numeric',
                'kerusakan_2_nama' => 'nullable|string',
                'kerusakan_2_satuan' => 'nullable|string',
                'kerusakan_2_jumlah_unit' => 'nullable|integer',
                'kerusakan_2_harga_satuan' => 'nullable|numeric',
                'kerusakan_3_nama' => 'nullable|string',
                'kerusakan_3_satuan' => 'nullable|string',
                'kerusakan_3_jumlah_unit' => 'nullable|integer',
                'kerusakan_3_harga_satuan' => 'nullable|numeric',
                'kerusakan_4_nama' => 'nullable|string',
                'kerusakan_4_satuan' => 'nullable|string',
                'kerusakan_4_jumlah_unit' => 'nullable|integer',
                'kerusakan_4_harga_satuan' => 'nullable|numeric',
                // Telecommunications sector specific fields
                'tower_bts_rusak_total' => 'nullable|integer',
                'tower_bts_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_tower_bts' => 'nullable|numeric',
                'menara_telkom_rusak_total' => 'nullable|integer',
                'menara_telkom_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_menara_telkom' => 'nullable|numeric',
                'kabel_telepon_rusak' => 'nullable|numeric',
                'harga_satuan_kabel_telepon' => 'nullable|numeric',
                'kabel_fiber_optic_rusak' => 'nullable|numeric',
                'harga_satuan_kabel_fiber' => 'nullable|numeric',
                'wartel_rusak_total' => 'nullable|integer',
                'wartel_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_wartel' => 'nullable|numeric',
                'internet_cafe_rusak_total' => 'nullable|integer',
                'internet_cafe_rusak_sebagian' => 'nullable|integer',
                'harga_satuan_internet_cafe' => 'nullable|numeric',
            ]);
            $formTelekom->update($validated);
            \DB::commit();
            return redirect()->route('forms.form4.list-format9', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 9)
     */
    public function destroy($id)
    {
        $form = \App\Models\Format9Form4::findOrFail($id);
        $bencana_id = $form->bencana_id;
        $form->delete(); // Hard delete
        return redirect()->route('forms.form4.list-format9', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }
}
