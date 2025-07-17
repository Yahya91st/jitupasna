<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format4Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format4Controller extends Controller
{
    /**
     * Display Format 4 form for Social Protection sector data collection
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
        
        return view('forms.form4.format4.format4form4', compact('bencana'));
    }

    /**
     * Store format4 form data for Social Protection sector
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
                // Panti Sosial
                'panti_sosial_rb_negeri' => 'nullable|integer',
                'panti_sosial_rb_swasta' => 'nullable|integer',
                'panti_sosial_rs_negeri' => 'nullable|integer',
                'panti_sosial_rs_swasta' => 'nullable|integer',
                'panti_sosial_rr_negeri' => 'nullable|integer',
                'panti_sosial_rr_swasta' => 'nullable|integer',
                'panti_sosial_luas' => 'nullable|string',
                'panti_sosial_harga_bangunan' => 'nullable|numeric',
                'panti_sosial_harga_peralatan' => 'nullable|string',
                'panti_sosial_harga_meubelair' => 'nullable|string',
                'panti_sosial_harga_peralatan_lab' => 'nullable|string',
                // Panti Asuhan
                'panti_asuhan_rb_negeri' => 'nullable|integer',
                'panti_asuhan_rb_swasta' => 'nullable|integer',
                'panti_asuhan_rs_negeri' => 'nullable|integer',
                'panti_asuhan_rs_swasta' => 'nullable|integer',
                'panti_asuhan_rr_negeri' => 'nullable|integer',
                'panti_asuhan_rr_swasta' => 'nullable|integer',
                'panti_asuhan_luas' => 'nullable|string',
                'panti_asuhan_harga_bangunan' => 'nullable|numeric',
                'panti_asuhan_harga_peralatan' => 'nullable|string',
                'panti_asuhan_harga_meubelair' => 'nullable|string',
                'panti_asuhan_harga_peralatan_lab' => 'nullable|string',
                // Balai Pelayanan
                'balai_pelayanan_rb_negeri' => 'nullable|integer',
                'balai_pelayanan_rb_swasta' => 'nullable|integer',
                'balai_pelayanan_rs_negeri' => 'nullable|integer',
                'balai_pelayanan_rs_swasta' => 'nullable|integer',
                'balai_pelayanan_rr_negeri' => 'nullable|integer',
                'balai_pelayanan_rr_swasta' => 'nullable|integer',
                'balai_pelayanan_luas' => 'nullable|string',
                'balai_pelayanan_harga_bangunan' => 'nullable|numeric',
                'balai_pelayanan_harga_peralatan' => 'nullable|string',
                'balai_pelayanan_harga_meubelair' => 'nullable|string',
                'balai_pelayanan_harga_peralatan_lab' => 'nullable|string',
                // Lainnya
                'lainnya_jenis' => 'nullable|string',
                'lainnya_rb_negeri' => 'nullable|integer',
                'lainnya_rb_swasta' => 'nullable|integer',
                'lainnya_rs_negeri' => 'nullable|integer',
                'lainnya_rs_swasta' => 'nullable|integer',
                'lainnya_rr_negeri' => 'nullable|integer',
                'lainnya_rr_swasta' => 'nullable|integer',
                'lainnya_luas' => 'nullable|string',
                'lainnya_harga_bangunan' => 'nullable|numeric',
                'lainnya_harga_peralatan' => 'nullable|string',
                'lainnya_harga_meubelair' => 'nullable|string',
                'lainnya_harga_peralatan_lab' => 'nullable|string',
                // Kerugian
                'biaya_tenaga_kerja_hok' => 'nullable|integer',
                'biaya_tenaga_kerja_upah' => 'nullable|numeric',
                'biaya_alat_berat_hari' => 'nullable|integer',
                'biaya_alat_berat_harga' => 'nullable|numeric',
                'jumlah_penerima' => 'nullable|integer',
                'bantuan_per_orang' => 'nullable|numeric',
                'biaya_pelayanan_kesehatan' => 'nullable|numeric',
                'biaya_pelayanan_pendidikan' => 'nullable|numeric',
                'biaya_pendampingan_psikososial' => 'nullable|numeric',
                'biaya_pelatihan_darurat' => 'nullable|numeric',
            ]);

            // Save all user input fields as per $fillable
            $data = $request->only((new \App\Models\Format4Form4)->getFillable());
            $formSosial = Format4Form4::create($data);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formSosial
                ]);
            }

            return redirect()->route('forms.form4.list-format4', ['bencana_id' => $formSosial->bencana_id])
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
        $formSosial = Format4Form4::with('bencana')->findOrFail($id);
        $bencana = $formSosial->bencana;
        
        return view('forms.form4.format4.show-format4', compact('formSosial', 'bencana'));
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
        $reports = Format4Form4::where('bencana_id', $bencana_id)->get();
        return view('forms.form4.format4.list-format4', compact('bencana', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formSosial = Format4Form4::with('bencana')->findOrFail($id);
        $bencana = $formSosial->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format4.pdf', compact('formSosial', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format4_Sosial_' . $formSosial->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formSosial = Format4Form4::with('bencana')->findOrFail($id);
        $bencana = $formSosial->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format4.pdf', compact('formSosial', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format4_Sosial_' . $formSosial->nama_kampung . '.pdf');
    }

    /**
     * Show the form for editing the specified resource (Format 4)
     */
    public function edit($id)
    {
        $formSosial = \App\Models\Format4Form4::with('bencana')->findOrFail($id);
        $bencana = $formSosial->bencana;
        return view('forms.form4.format4.edit', compact('formSosial', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 4)
     */
    public function update(Request $request, $id)
    {
        try {
            \DB::beginTransaction();
            $formSosial = \App\Models\Format4Form4::findOrFail($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Panti Sosial
                'panti_sosial_rb_negeri' => 'nullable|integer',
                'panti_sosial_rb_swasta' => 'nullable|integer',
                'panti_sosial_rs_negeri' => 'nullable|integer',
                'panti_sosial_rs_swasta' => 'nullable|integer',
                'panti_sosial_rr_negeri' => 'nullable|integer',
                'panti_sosial_rr_swasta' => 'nullable|integer',
                'panti_sosial_luas' => 'nullable|string',
                'panti_sosial_harga_bangunan' => 'nullable|numeric',
                'panti_sosial_harga_peralatan' => 'nullable|string',
                'panti_sosial_harga_meubelair' => 'nullable|string',
                'panti_sosial_harga_peralatan_lab' => 'nullable|string',
                // Panti Asuhan
                'panti_asuhan_rb_negeri' => 'nullable|integer',
                'panti_asuhan_rb_swasta' => 'nullable|integer',
                'panti_asuhan_rs_negeri' => 'nullable|integer',
                'panti_asuhan_rs_swasta' => 'nullable|integer',
                'panti_asuhan_rr_negeri' => 'nullable|integer',
                'panti_asuhan_rr_swasta' => 'nullable|integer',
                'panti_asuhan_luas' => 'nullable|string',
                'panti_asuhan_harga_bangunan' => 'nullable|numeric',
                'panti_asuhan_harga_peralatan' => 'nullable|string',
                'panti_asuhan_harga_meubelair' => 'nullable|string',
                'panti_asuhan_harga_peralatan_lab' => 'nullable|string',
                // Balai Pelayanan
                'balai_pelayanan_rb_negeri' => 'nullable|integer',
                'balai_pelayanan_rb_swasta' => 'nullable|integer',
                'balai_pelayanan_rs_negeri' => 'nullable|integer',
                'balai_pelayanan_rs_swasta' => 'nullable|integer',
                'balai_pelayanan_rr_negeri' => 'nullable|integer',
                'balai_pelayanan_rr_swasta' => 'nullable|integer',
                'balai_pelayanan_luas' => 'nullable|string',
                'balai_pelayanan_harga_bangunan' => 'nullable|numeric',
                'balai_pelayanan_harga_peralatan' => 'nullable|string',
                'balai_pelayanan_harga_meubelair' => 'nullable|string',
                'balai_pelayanan_harga_peralatan_lab' => 'nullable|string',
                // Lainnya
                'lainnya_jenis' => 'nullable|string',
                'lainnya_rb_negeri' => 'nullable|integer',
                'lainnya_rb_swasta' => 'nullable|integer',
                'lainnya_rs_negeri' => 'nullable|integer',
                'lainnya_rs_swasta' => 'nullable|integer',
                'lainnya_rr_negeri' => 'nullable|integer',
                'lainnya_rr_swasta' => 'nullable|integer',
                'lainnya_luas' => 'nullable|string',
                'lainnya_harga_bangunan' => 'nullable|numeric',
                'lainnya_harga_peralatan' => 'nullable|string',
                'lainnya_harga_meubelair' => 'nullable|string',
                'lainnya_harga_peralatan_lab' => 'nullable|string',
                // Kerugian
                'biaya_tenaga_kerja_hok' => 'nullable|integer',
                'biaya_tenaga_kerja_upah' => 'nullable|numeric',
                'biaya_alat_berat_hari' => 'nullable|integer',
                'biaya_alat_berat_harga' => 'nullable|numeric',
                'jumlah_penerima' => 'nullable|integer',
                'bantuan_per_orang' => 'nullable|numeric',
                'biaya_pelayanan_kesehatan' => 'nullable|numeric',
                'biaya_pelayanan_pendidikan' => 'nullable|numeric',
                'biaya_pendampingan_psikososial' => 'nullable|numeric',
                'biaya_pelatihan_darurat' => 'nullable|numeric',
            ]);
            $formSosial->update($validated);
            \DB::commit();
            return redirect()->route('forms.form4.list-format4', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 4)
     */
    public function destroy($id)
    {
        $formSosial = \App\Models\Format4Form4::findOrFail($id);
        $bencana_id = $formSosial->bencana_id;
        $formSosial->delete();
        return redirect()->route('forms.form4.list-format4', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }
}
