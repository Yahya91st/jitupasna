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

            // Use validated data and filter by fillable fields
            $data = $request->only((new \App\Models\Format4Form4)->getFillable());
            
            // Convert empty strings to null for better handling
            foreach ($data as $key => $value) {
                if ($value === '' || $value === '0' || $value === 0) {
                    $data[$key] = null;
                } elseif (is_numeric($value)) {
                    $data[$key] = $value;
                }
            }
            
            // Calculate kerusakan (damage) - only for building damage
            $kerusakan_bangunan = $this->calculateKerusakanBangunan($data);
            
            // Calculate all kerugian items
            $total_kerugian_items = $this->calculateKerugianItems($data);
            
            // Move all kerugian to kerusakan, make kerugian = 0
            $data['total_kerusakan'] = $kerusakan_bangunan + $total_kerugian_items;
            $data['total_kerugian'] = 0;
            
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
            DB::beginTransaction();
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
            
            // Convert empty strings to null for better handling
            foreach ($validated as $key => $value) {
                if ($value === '' || $value === '0' || $value === 0) {
                    $validated[$key] = null;
                } elseif (is_numeric($value)) {
                    $validated[$key] = $value;
                }
            }
            
            // Calculate totals before updating
            $validated['total_kerusakan'] = $this->calculateKerusakanBangunan($validated) + $this->calculateKerugianItems($validated);
            $validated['total_kerugian'] = 0;
            
            $formSosial->update($validated);
            DB::commit();
            return redirect()->route('forms.form4.list-format4', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
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

    /**
     * Calculate total kerusakan bangunan (physical building damage)
     */
    private function calculateKerusakanBangunan($data)
    {
        $total = 0;
        
        // Calculate for each building type
        $buildingTypes = ['panti_sosial', 'panti_asuhan', 'balai_pelayanan', 'lainnya'];
        
        foreach ($buildingTypes as $type) {
            // Get unit counts
            $rb_negeri = floatval($data[$type . '_rb_negeri'] ?? 0);
            $rb_swasta = floatval($data[$type . '_rb_swasta'] ?? 0);
            $rs_negeri = floatval($data[$type . '_rs_negeri'] ?? 0);
            $rs_swasta = floatval($data[$type . '_rs_swasta'] ?? 0);
            $rr_negeri = floatval($data[$type . '_rr_negeri'] ?? 0);
            $rr_swasta = floatval($data[$type . '_rr_swasta'] ?? 0);
            
            $total_units = $rb_negeri + $rb_swasta + $rs_negeri + $rs_swasta + $rr_negeri + $rr_swasta;
            
            // Get price per unit
            $harga_bangunan = floatval($data[$type . '_harga_bangunan'] ?? 0);
            
            // Calculate building damage (units × price, not using luas)
            $total += $total_units * $harga_bangunan;
        }
        
        return $total;
    }

    /**
     * Calculate total kerugian items (all loss items that will be moved to kerusakan)
     */
    private function calculateKerugianItems($data)
    {
        $total = 0;
        
        // 1. Biaya Pembersihan Puing
        $biaya_tenaga_kerja = floatval($data['biaya_tenaga_kerja_hok'] ?? 0) * floatval($data['biaya_tenaga_kerja_upah'] ?? 0);
        $biaya_alat_berat = floatval($data['biaya_alat_berat_hari'] ?? 0) * floatval($data['biaya_alat_berat_harga'] ?? 0);
        $total += $biaya_tenaga_kerja + $biaya_alat_berat;
        
        // 2. Biaya Penyediaan Jatah Hidup
        $biaya_jatah_hidup = floatval($data['jumlah_penerima'] ?? 0) * floatval($data['bantuan_per_orang'] ?? 0);
        $total += $biaya_jatah_hidup;
        
        // 3. Tambahan Biaya Sosial
        $total += floatval($data['biaya_pelayanan_kesehatan'] ?? 0);
        $total += floatval($data['biaya_pelayanan_pendidikan'] ?? 0);
        $total += floatval($data['biaya_pendampingan_psikososial'] ?? 0);
        $total += floatval($data['biaya_pelatihan_darurat'] ?? 0);
        
        return $total;
    }
}
