<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format16Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format16Controller extends Controller
{
    /**
     * Display Format 16 form for data collection
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
        
        return view('forms.form4.format16.format16form4', compact('bencana'));
    }

    /**
     * Store format16 form data
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'kabupaten' => 'nullable|string',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Kantor Pemkab
                'kantor_pemkab_berat' => 'nullable|integer',
                'kantor_pemkab_sedang' => 'nullable|integer',
                'kantor_pemkab_ringan' => 'nullable|integer',
                'kantor_pemkab_rb_harga' => 'nullable|numeric',
                'kantor_pemkab_rs_harga' => 'nullable|numeric',
                'kantor_pemkab_rr_harga' => 'nullable|numeric',
                // Kantor Kecamatan
                'kantor_kecamatan_berat' => 'nullable|integer',
                'kantor_kecamatan_sedang' => 'nullable|integer',
                'kantor_kecamatan_ringan' => 'nullable|integer',
                'kantor_kecamatan_rb_harga' => 'nullable|numeric',
                'kantor_kecamatan_rs_harga' => 'nullable|numeric',
                'kantor_kecamatan_rr_harga' => 'nullable|numeric',
                // Kantor Dinas
                'kantor_dinas_berat' => 'nullable|integer',
                'kantor_dinas_sedang' => 'nullable|integer',
                'kantor_dinas_ringan' => 'nullable|integer',
                'kantor_dinas_rb_harga' => 'nullable|numeric',
                'kantor_dinas_rs_harga' => 'nullable|numeric',
                'kantor_dinas_rr_harga' => 'nullable|numeric',
                // Kantor Vertikal
                'kantor_vertikal_berat' => 'nullable|integer',
                'kantor_vertikal_sedang' => 'nullable|integer',
                'kantor_vertikal_ringan' => 'nullable|integer',
                'kantor_vertikal_rb_harga' => 'nullable|numeric',
                'kantor_vertikal_rs_harga' => 'nullable|numeric',
                'kantor_vertikal_rr_harga' => 'nullable|numeric',
                // Mebelair
                'mebelair_berat' => 'nullable|integer',
                'mebelair_sedang' => 'nullable|integer',
                'mebelair_ringan' => 'nullable|integer',
                'mebelair_rb_harga' => 'nullable|numeric',
                'mebelair_rs_harga' => 'nullable|numeric',
                'mebelair_rr_harga' => 'nullable|numeric',
                // Biaya Pembersihan Puing
                'biaya_tenaga_kerja_hok' => 'nullable|integer',
                'upah_harian' => 'nullable|numeric',
                'biaya_alat_berat_hari' => 'nullable|integer',
                'biaya_alat_berat_tarif' => 'nullable|numeric',
                // Biaya Sewa Kantor Sementara
                'sewa_kantor_jumlah_unit' => 'nullable|integer',
                'sewa_kantor_biaya_per_unit' => 'nullable|numeric',
                // Biaya Restorasi Arsip
                'restorasi_arsip_jumlah' => 'nullable|integer',
                'restorasi_arsip_harga_satuan' => 'nullable|numeric',
                // Kehilangan Pendapatan Retribusi
                'dasar_perhitungan_retribusi' => 'nullable|string',
            ]);

            // Add default kabupaten if not provided
            if (empty($validated['kabupaten'])) {
                $validated['kabupaten'] = 'Papua Selatan'; // Default value
            }
            
            // Create new form data with validated input
            $formData = Format16Form4::create($validated);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formData
                ]);
            }

            return redirect()->route('forms.form4.list-format16', ['bencana_id' => $formData->bencana_id])
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
        $formData = Format16Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        // Prepare facility reports (kerusakan fasilitas)
        $facilityReports = collect();
        
        // Add facility damage data if exists
        if (!empty($formData->kantor_pemkab_berat) || !empty($formData->kantor_pemkab_sedang) || !empty($formData->kantor_pemkab_ringan)) {
            $facilityReports->push((object)[
                'jenis_fasilitas' => 'Kantor Pemkab',
                'jumlah_rb' => $formData->kantor_pemkab_berat ?? 0,
                'jumlah_rs' => $formData->kantor_pemkab_sedang ?? 0,
                'jumlah_rr' => $formData->kantor_pemkab_ringan ?? 0,
                'harga_rb' => $formData->kantor_pemkab_rb_harga ?? 0,
                'harga_rs' => $formData->kantor_pemkab_rs_harga ?? 0,
                'harga_rr' => $formData->kantor_pemkab_rr_harga ?? 0,
            ]);
        }
        
        if (!empty($formData->kantor_kecamatan_berat) || !empty($formData->kantor_kecamatan_sedang) || !empty($formData->kantor_kecamatan_ringan)) {
            $facilityReports->push((object)[
                'jenis_fasilitas' => 'Kantor Kecamatan',
                'jumlah_rb' => $formData->kantor_kecamatan_berat ?? 0,
                'jumlah_rs' => $formData->kantor_kecamatan_sedang ?? 0,
                'jumlah_rr' => $formData->kantor_kecamatan_ringan ?? 0,
                'harga_rb' => $formData->kantor_kecamatan_rb_harga ?? 0,
                'harga_rs' => $formData->kantor_kecamatan_rs_harga ?? 0,
                'harga_rr' => $formData->kantor_kecamatan_rr_harga ?? 0,
            ]);
        }
        
        if (!empty($formData->kantor_dinas_berat) || !empty($formData->kantor_dinas_sedang) || !empty($formData->kantor_dinas_ringan)) {
            $facilityReports->push((object)[
                'jenis_fasilitas' => 'Kantor Dinas',
                'jumlah_rb' => $formData->kantor_dinas_berat ?? 0,
                'jumlah_rs' => $formData->kantor_dinas_sedang ?? 0,
                'jumlah_rr' => $formData->kantor_dinas_ringan ?? 0,
                'harga_rb' => $formData->kantor_dinas_rb_harga ?? 0,
                'harga_rs' => $formData->kantor_dinas_rs_harga ?? 0,
                'harga_rr' => $formData->kantor_dinas_rr_harga ?? 0,
            ]);
        }
        
        if (!empty($formData->kantor_vertikal_berat) || !empty($formData->kantor_vertikal_sedang) || !empty($formData->kantor_vertikal_ringan)) {
            $facilityReports->push((object)[
                'jenis_fasilitas' => 'Kantor Instansi Vertikal',
                'jumlah_rb' => $formData->kantor_vertikal_berat ?? 0,
                'jumlah_rs' => $formData->kantor_vertikal_sedang ?? 0,
                'jumlah_rr' => $formData->kantor_vertikal_ringan ?? 0,
                'harga_rb' => $formData->kantor_vertikal_rb_harga ?? 0,
                'harga_rs' => $formData->kantor_vertikal_rs_harga ?? 0,
                'harga_rr' => $formData->kantor_vertikal_rr_harga ?? 0,
            ]);
        }
        
        if (!empty($formData->mebelair_berat) || !empty($formData->mebelair_sedang) || !empty($formData->mebelair_ringan)) {
            $facilityReports->push((object)[
                'jenis_fasilitas' => 'Mebelair dan Peralatan Kantor',
                'jumlah_rb' => $formData->mebelair_berat ?? 0,
                'jumlah_rs' => $formData->mebelair_sedang ?? 0,
                'jumlah_rr' => $formData->mebelair_ringan ?? 0,
                'harga_rb' => $formData->mebelair_rb_harga ?? 0,
                'harga_rs' => $formData->mebelair_rs_harga ?? 0,
                'harga_rr' => $formData->mebelair_rr_harga ?? 0,
            ]);
        }
        
        // Prepare loss reports (kerugian)
        $lossReports = collect();
        
        // Check if there's loss data (pembersihan puing, kantor sementara, arsip)
        if (!empty($formData->biaya_tenaga_kerja_hok) || !empty($formData->upah_harian) || 
            !empty($formData->biaya_alat_berat_hari) || !empty($formData->biaya_alat_berat_tarif) ||
            !empty($formData->sewa_kantor_jumlah_unit) || !empty($formData->sewa_kantor_biaya_per_unit) ||
            !empty($formData->restorasi_arsip_jumlah) || !empty($formData->restorasi_arsip_harga_satuan)) {
            
            $lossReports->push((object)[
                'id' => $formData->id,
                'tenaga_kerja_hok' => $formData->biaya_tenaga_kerja_hok,
                'upah_harian' => $formData->upah_harian,
                'alat_berat_hari' => $formData->biaya_alat_berat_hari,
                'biaya_per_hari_alat_berat' => $formData->biaya_alat_berat_tarif,
                'jumlah_unit' => $formData->sewa_kantor_jumlah_unit,
                'biaya_sewa_per_unit' => $formData->sewa_kantor_biaya_per_unit,
                'jumlah_arsip' => $formData->restorasi_arsip_jumlah,
                'harga_satuan' => $formData->restorasi_arsip_harga_satuan,
                'dasar_perhitungan' => $formData->dasar_perhitungan_retribusi ?? 'Berdasarkan data terdampak',
            ]);
        }
        
        // Create governmentReports collection for backward compatibility
        $governmentReports = $facilityReports->merge($lossReports);
        
        return view('forms.form4.format16.show-format16', compact(
            'formData', 
            'bencana', 
            'facilityReports', 
            'lossReports', 
            'governmentReports'
        ));
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
        $reports = Format16Form4::where('bencana_id', $bencana_id)->get(); // No soft delete filter
        return view('forms.form4.format16.list-format16', compact('bencana', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formData = Format16Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format16.pdf', compact('formData', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format16_' . $formData->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formData = Format16Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format16.pdf', compact('formData', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format16_' . $formData->nama_kampung . '.pdf');
    }

    /**
     * Show the form for editing the specified resource (Format 16)
     */
    public function edit($id)
    {
        $formPemerintahan = Format16Form4::with('bencana')->findOrFail($id);
        $bencana = $formPemerintahan->bencana;
        return view('forms.form4.format16.edit', compact('formPemerintahan', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 16)
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $formData = Format16Form4::findOrFail($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'kabupaten' => 'nullable|string',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Kantor Pemkab
                'kantor_pemkab_berat' => 'nullable|integer',
                'kantor_pemkab_sedang' => 'nullable|integer',
                'kantor_pemkab_ringan' => 'nullable|integer',
                'kantor_pemkab_rb_harga' => 'nullable|numeric',
                'kantor_pemkab_rs_harga' => 'nullable|numeric',
                'kantor_pemkab_rr_harga' => 'nullable|numeric',
                // Kantor Kecamatan
                'kantor_kecamatan_berat' => 'nullable|integer',
                'kantor_kecamatan_sedang' => 'nullable|integer',
                'kantor_kecamatan_ringan' => 'nullable|integer',
                'kantor_kecamatan_rb_harga' => 'nullable|numeric',
                'kantor_kecamatan_rs_harga' => 'nullable|numeric',
                'kantor_kecamatan_rr_harga' => 'nullable|numeric',
                // Kantor Dinas
                'kantor_dinas_berat' => 'nullable|integer',
                'kantor_dinas_sedang' => 'nullable|integer',
                'kantor_dinas_ringan' => 'nullable|integer',
                'kantor_dinas_rb_harga' => 'nullable|numeric',
                'kantor_dinas_rs_harga' => 'nullable|numeric',
                'kantor_dinas_rr_harga' => 'nullable|numeric',
                // Kantor Vertikal
                'kantor_vertikal_berat' => 'nullable|integer',
                'kantor_vertikal_sedang' => 'nullable|integer',
                'kantor_vertikal_ringan' => 'nullable|integer',
                'kantor_vertikal_rb_harga' => 'nullable|numeric',
                'kantor_vertikal_rs_harga' => 'nullable|numeric',
                'kantor_vertikal_rr_harga' => 'nullable|numeric',
                // Mebelair
                'mebelair_berat' => 'nullable|integer',
                'mebelair_sedang' => 'nullable|integer',
                'mebelair_ringan' => 'nullable|integer',
                'mebelair_rb_harga' => 'nullable|numeric',
                'mebelair_rs_harga' => 'nullable|numeric',
                'mebelair_rr_harga' => 'nullable|numeric',
                // Biaya Pembersihan Puing
                'biaya_tenaga_kerja_hok' => 'nullable|integer',
                'upah_harian' => 'nullable|numeric',
                'biaya_alat_berat_hari' => 'nullable|integer',
                'biaya_alat_berat_tarif' => 'nullable|numeric',
                // Biaya Sewa Kantor Sementara
                'sewa_kantor_jumlah_unit' => 'nullable|integer',
                'sewa_kantor_biaya_per_unit' => 'nullable|numeric',
                // Biaya Restorasi Arsip
                'restorasi_arsip_jumlah' => 'nullable|integer',
                'restorasi_arsip_harga_satuan' => 'nullable|numeric',
                // Kehilangan Pendapatan Retribusi
                'dasar_perhitungan_retribusi' => 'nullable|string',
            ]);
            $formData->update($validated);
            DB::commit();
            return redirect()->route('forms.form4.list-format16', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 16)
     */
    public function destroy($id)
    {
        $form = Format16Form4::findOrFail($id);
        $bencana_id = $form->bencana_id;
        $form->delete(); // Hard delete
        return redirect()->route('forms.form4.list-format16', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }
}
