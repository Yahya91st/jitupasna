<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format5Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format5Controller extends Controller
{
    /**
     * Display Format 5 form for Religious sector data collection
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
        
        return view('forms.form4.format5.format5form4', compact('bencana'));
    }

    /**
     * Store format5 form data for Religious sector
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
                // Gereja
                'gereja_rb_negeri' => 'nullable|integer',
                'gereja_rb_swasta' => 'nullable|integer',
                'gereja_rs_negeri' => 'nullable|integer',
                'gereja_rs_swasta' => 'nullable|integer',
                'gereja_rr_negeri' => 'nullable|integer',
                'gereja_rr_swasta' => 'nullable|integer',
                'gereja_luas' => 'nullable|numeric',
                'gereja_harga_bangunan' => 'nullable|numeric',
                'gereja_harga_peralatan' => 'nullable|numeric',
                // Kapel
                'kapel_rb_negeri' => 'nullable|integer',
                'kapel_rb_swasta' => 'nullable|integer',
                'kapel_rs_negeri' => 'nullable|integer',
                'kapel_rs_swasta' => 'nullable|integer',
                'kapel_rr_negeri' => 'nullable|integer',
                'kapel_rr_swasta' => 'nullable|integer',
                'kapel_luas' => 'nullable|numeric',
                'kapel_harga_bangunan' => 'nullable|numeric',
                'kapel_harga_peralatan' => 'nullable|numeric',
                // Masjid
                'masjid_rb_negeri' => 'nullable|integer',
                'masjid_rb_swasta' => 'nullable|integer',
                'masjid_rs_negeri' => 'nullable|integer',
                'masjid_rs_swasta' => 'nullable|integer',
                'masjid_rr_negeri' => 'nullable|integer',
                'masjid_rr_swasta' => 'nullable|integer',
                'masjid_luas' => 'nullable|numeric',
                'masjid_harga_bangunan' => 'nullable|numeric',
                'masjid_harga_peralatan' => 'nullable|numeric',
                // Musholla
                'musholla_rb_negeri' => 'nullable|integer',
                'musholla_rb_swasta' => 'nullable|integer',
                'musholla_rs_negeri' => 'nullable|integer',
                'musholla_rs_swasta' => 'nullable|integer',
                'musholla_rr_negeri' => 'nullable|integer',
                'musholla_rr_swasta' => 'nullable|integer',
                'musholla_luas' => 'nullable|numeric',
                'musholla_harga_bangunan' => 'nullable|numeric',
                'musholla_harga_peralatan' => 'nullable|numeric',
                // Pura
                'pura_rb_negeri' => 'nullable|integer',
                'pura_rb_swasta' => 'nullable|integer',
                'pura_rs_negeri' => 'nullable|integer',
                'pura_rs_swasta' => 'nullable|integer',
                'pura_rr_negeri' => 'nullable|integer',
                'pura_rr_swasta' => 'nullable|integer',
                'pura_luas' => 'nullable|numeric',
                'pura_harga_bangunan' => 'nullable|numeric',
                'pura_harga_peralatan' => 'nullable|numeric',
                // Vihara
                'vihara_rb_negeri' => 'nullable|integer',
                'vihara_rb_swasta' => 'nullable|integer',
                'vihara_rs_negeri' => 'nullable|integer',
                'vihara_rs_swasta' => 'nullable|integer',
                'vihara_rr_negeri' => 'nullable|integer',
                'vihara_rr_swasta' => 'nullable|integer',
                'vihara_luas' => 'nullable|numeric',
                'vihara_harga_bangunan' => 'nullable|numeric',
                'vihara_harga_peralatan' => 'nullable|numeric',
                // Kerugian / tambahan (opsional)
                'biaya_tenaga_kerja_hok' => 'nullable|numeric',
                'biaya_tenaga_kerja_upah' => 'nullable|numeric',
                'biaya_alat_berat_hari' => 'nullable|integer',
                'biaya_alat_berat_harga' => 'nullable|numeric',
                // Totals (opsional)
                'total_kerusakan' => 'nullable|numeric',
                'total_kerugian' => 'nullable|numeric',
            ]);

            // Save all user input fields as per $fillable
            
            $data = $request->only((new Format5Form4)->getFillable());
            
            // Ensure numeric fields are properly cast
            foreach ($data as $key => $value) {
                if (empty($value) || $value === '') {
                    $data[$key] = null;
                }
            }
            // Cari atau buat rekap berdasarkan bencana_id
            $rekap = Rekap::firstOrCreate([
                'bencana_id' => $validated['bencana_id']
            ]);

            // Simpan data Format3Form4 dengan rekap_id
            $data = $validated;
            $data['rekap_id'] = $rekap->id;
            // unset($data['bencana_id']); // pastikan tidak ada bencana_id di insert

            
            $formAgama = Format5Form4::create($data);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formAgama
                ]);
            }

            return redirect()->route('forms.form4.format5.list', ['bencana_id' => $formAgama->bencana_id])
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
        $formAgama = Format5Form4::with('bencana')->findOrFail($id);
        $bencana = $formAgama->bencana;
        $report = $formAgama; // For compatibility with view
        
        return view('forms.form4.format5.show-format5', compact('formAgama', 'bencana', 'report'));
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
        $form = Format5Form4::where('bencana_id', $bencana_id)->get();
        $reports =  $form; // For compatibility with the view
        return view('forms.form4.format5.list-format5', compact('bencana', 'form', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formAgama = Format5Form4::with('bencana')->findOrFail($id);
        $bencana = $formAgama->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format5.pdf', compact('formAgama', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format5_Agama_' . $formAgama->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formAgama = Format5Form4::with('bencana')->findOrFail($id);
        $bencana = $formAgama->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format5.pdf', compact('formAgama', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format5_Agama_' . $formAgama->nama_kampung . '.pdf');
    }

    /**
     * Show the form for editing the specified resource (Format 5)
     */
    public function edit($id)
    {
        $formKeagamaan = Format5Form4::with('bencana')->findOrFail($id);
        $bencana = $formKeagamaan->bencana;
        return view('forms.form4.format5.edit', compact('formKeagamaan', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 5)
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            
            $formAgama = Format5Form4::findOrFail($id);
            
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Gereja
                'gereja_rb_negeri' => 'nullable|integer',
                'gereja_rb_swasta' => 'nullable|integer',
                'gereja_rs_negeri' => 'nullable|integer',
                'gereja_rs_swasta' => 'nullable|integer',
                'gereja_rr_negeri' => 'nullable|integer',
                'gereja_rr_swasta' => 'nullable|integer',
                'gereja_luas' => 'nullable|numeric',
                'gereja_harga_bangunan' => 'nullable|numeric',
                'gereja_harga_peralatan' => 'nullable|numeric',
                // Kapel
                'kapel_rb_negeri' => 'nullable|integer',
                'kapel_rb_swasta' => 'nullable|integer',
                'kapel_rs_negeri' => 'nullable|integer',
                'kapel_rs_swasta' => 'nullable|integer',
                'kapel_rr_negeri' => 'nullable|integer',
                'kapel_rr_swasta' => 'nullable|integer',
                'kapel_luas' => 'nullable|numeric',
                'kapel_harga_bangunan' => 'nullable|numeric',
                'kapel_harga_peralatan' => 'nullable|numeric',
                // Masjid
                'masjid_rb_negeri' => 'nullable|integer',
                'masjid_rb_swasta' => 'nullable|integer',
                'masjid_rs_negeri' => 'nullable|integer',
                'masjid_rs_swasta' => 'nullable|integer',
                'masjid_rr_negeri' => 'nullable|integer',
                'masjid_rr_swasta' => 'nullable|integer',
                'masjid_luas' => 'nullable|numeric',
                'masjid_harga_bangunan' => 'nullable|numeric',
                'masjid_harga_peralatan' => 'nullable|numeric',
                // Musholla
                'musholla_rb_negeri' => 'nullable|integer',
                'musholla_rb_swasta' => 'nullable|integer',
                'musholla_rs_negeri' => 'nullable|integer',
                'musholla_rs_swasta' => 'nullable|integer',
                'musholla_rr_negeri' => 'nullable|integer',
                'musholla_rr_swasta' => 'nullable|integer',
                'musholla_luas' => 'nullable|numeric',
                'musholla_harga_bangunan' => 'nullable|numeric',
                'musholla_harga_peralatan' => 'nullable|numeric',
                // Pura
                'pura_rb_negeri' => 'nullable|integer',
                'pura_rb_swasta' => 'nullable|integer',
                'pura_rs_negeri' => 'nullable|integer',
                'pura_rs_swasta' => 'nullable|integer',
                'pura_rr_negeri' => 'nullable|integer',
                'pura_rr_swasta' => 'nullable|integer',
                'pura_luas' => 'nullable|numeric',
                'pura_harga_bangunan' => 'nullable|numeric',
                'pura_harga_peralatan' => 'nullable|numeric',
                // Vihara
                'vihara_rb_negeri' => 'nullable|integer',
                'vihara_rb_swasta' => 'nullable|integer',
                'vihara_rs_negeri' => 'nullable|integer',
                'vihara_rs_swasta' => 'nullable|integer',
                'vihara_rr_negeri' => 'nullable|integer',
                'vihara_rr_swasta' => 'nullable|integer',
                'vihara_luas' => 'nullable|numeric',
                'vihara_harga_bangunan' => 'nullable|numeric',
                'vihara_harga_peralatan' => 'nullable|numeric',
                // Kerugian / tambahan (opsional)
                'biaya_tenaga_kerja_hok' => 'nullable|numeric',
                'biaya_tenaga_kerja_upah' => 'nullable|numeric',
                'biaya_alat_berat_hari' => 'nullable|integer',
                'biaya_alat_berat_harga' => 'nullable|numeric',
                // Totals (opsional)
                'total_kerusakan' => 'nullable|numeric',
                'total_kerugian' => 'nullable|numeric',
            ]);
            
            // Get all fillable data from request
            $data = $request->only((new Format5Form4)->getFillable());
            
            // Ensure numeric fields are properly cast
            foreach ($data as $key => $value) {
                if (empty($value) || $value === '') {
                    $data[$key] = null;
                }
            }
            
            $formAgama->update($data);
            
            DB::commit();
            
            return redirect()->route('forms.form4.format5.list', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 5)
     */
    public function destroy($id)
    {
        $formAgama = Format5Form4::findOrFail($id);
        $bencana_id = $formAgama->bencana_id;
        $formAgama->delete();
        return redirect()->route('forms.form4.format5.list', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }
}
