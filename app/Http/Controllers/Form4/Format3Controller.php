<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format3Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format3Controller extends Controller
{
    /**
     * Display Format 3 form for Health sector data collection
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
        
        return view('forms.form4.format3.format3form4', compact('bencana'));
    }

    /**
     * Store format3 form data for Health sector
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Ambil semua input yang sesuai $fillable
            $data = $request->only((new \App\Models\Format3Form4)->getFillable());

            // Validasi minimal kolom wajib
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Validasi untuk field harga yang diubah ke string
                'rs_harga_obat' => 'nullable|string',
                'rs_harga_meubelair' => 'nullable|string',
                'rs_harga_peralatan' => 'nullable|string',
                'puskesmas_harga_obat' => 'nullable|string',
                'puskesmas_harga_meubelair' => 'nullable|string',
                'puskesmas_harga_peralatan' => 'nullable|string',
                'poliklinik_harga_obat' => 'nullable|string',
                'poliklinik_harga_meubelair' => 'nullable|string',
                'poliklinik_harga_peralatan' => 'nullable|string',
                'pustu_harga_obat' => 'nullable|string',
                'pustu_harga_meubelair' => 'nullable|string',
                'pustu_harga_peralatan' => 'nullable|string',
                'polindes_harga_obat' => 'nullable|string',
                'polindes_harga_meubelair' => 'nullable|string',
                'polindes_harga_peralatan' => 'nullable|string',
                'posyandu_harga_obat' => 'nullable|string',
                'posyandu_harga_meubelair' => 'nullable|string',
                'posyandu_harga_peralatan' => 'nullable|string',
            ]);

            // Gabungkan semua custom fields ke dalam satu array dan tidak wajib diisi
            $customFields = [
                // Semua field tambahan dari form3form4.blade.php yang tidak ada di $fillable model
                'rs_rb_negeri', 'rs_rb_swasta', 'rs_rs_negeri', 'rs_rs_swasta', 'rs_rr_negeri', 'rs_rr_swasta', 'rs_luas', 'rs_harga_bangunan', 'rs_harga_obat', 'rs_harga_meubelair', 'rs_harga_peralatan',
                'puskesmas_rb_negeri', 'puskesmas_rb_swasta', 'puskesmas_rs_negeri', 'puskesmas_rs_swasta', 'puskesmas_rr_negeri', 'puskesmas_rr_swasta', 'puskesmas_luas', 'puskesmas_harga_bangunan', 'puskesmas_harga_obat', 'puskesmas_harga_meubelair', 'puskesmas_harga_peralatan',
                'poliklinik_rb_negeri', 'poliklinik_rb_swasta', 'poliklinik_rs_negeri', 'poliklinik_rs_swasta', 'poliklinik_rr_negeri', 'poliklinik_rr_swasta', 'poliklinik_luas', 'poliklinik_harga_bangunan', 'poliklinik_harga_obat', 'poliklinik_harga_meubelair', 'poliklinik_harga_peralatan',
                'pustu_rb_negeri', 'pustu_rb_swasta', 'pustu_rs_negeri', 'pustu_rs_swasta', 'pustu_rr_negeri', 'pustu_rr_swasta', 'pustu_luas', 'pustu_harga_bangunan', 'pustu_harga_obat', 'pustu_harga_meubelair', 'pustu_harga_peralatan',
                'polindes_rb_negeri', 'polindes_rb_swasta', 'polindes_rs_negeri', 'polindes_rs_swasta', 'polindes_rr_negeri', 'polindes_rr_swasta', 'polindes_luas', 'polindes_harga_bangunan', 'polindes_harga_obat', 'polindes_harga_meubelair', 'polindes_harga_peralatan',
                'posyandu_rb_negeri', 'posyandu_rb_swasta', 'posyandu_rs_negeri', 'posyandu_rs_swasta', 'posyandu_rr_negeri', 'posyandu_rr_swasta', 'posyandu_luas', 'posyandu_harga_bangunan', 'posyandu_harga_obat', 'posyandu_harga_meubelair', 'posyandu_harga_peralatan',
                'biaya_tenaga_kerja_hok', 'biaya_tenaga_kerja_upah', 'biaya_alat_berat_hari', 'biaya_alat_berat_harga', 'jumlah_jenazah', 'biaya_per_jenazah', 'jumlah_pasien', 'biaya_per_pasien', 'jenis_operasional', 'jumlah_faskes', 'biaya_pengadaan_faskes', 'jumlah_korban_psikologis', 'biaya_penanganan_psikologis', 'biaya_pencegahan_penyakit', 'jumlah_tenaga_kesehatan', 'honorarium_tenaga_kesehatan', 'pendapatan_faskes_swasta'
            ];
            foreach ($customFields as $field) {
                $data[$field] = $request->input($field, null); // nullable, tidak wajib diisi
            }

            $formKesehatan = Format3Form4::create($data);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formKesehatan
                ]);
            }

            return redirect()->route('forms.form4.list-format3', ['bencana_id' => $formKesehatan->bencana_id])
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
        $formKesehatan = Format3Form4::with('bencana')->findOrFail($id);
        $bencana = $formKesehatan->bencana;
        
        return view('forms.form4.format3.show-format3', compact('formKesehatan', 'bencana'));
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
        $formData = Format3Form4::where('bencana_id', $bencana_id)->get();
        
        return view('forms.form4.format3.list-format3', compact('bencana', 'formData'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formKesehatan = Format3Form4::with('bencana')->findOrFail($id);
        $bencana = $formKesehatan->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format3.pdf', compact('formKesehatan', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format3_Kesehatan_' . $formKesehatan->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formKesehatan = Format3Form4::with('bencana')->findOrFail($id);
        $bencana = $formKesehatan->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format3.pdf', compact('formKesehatan', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format3_Kesehatan_' . $formKesehatan->nama_kampung . '.pdf');
    }

    /**
     * Show the form for editing the specified resource (Format 3)
     */
    public function edit($id)
    {
        $formKesehatan = \App\Models\Format3Form4::with('bencana')->findOrFail($id);
        $bencana = $formKesehatan->bencana;
        return view('forms.form4.format3.edit', compact('formKesehatan', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 3)
     */
    public function update(Request $request, $id)
    {
        try {
            \DB::beginTransaction();
            $formKesehatan = \App\Models\Format3Form4::findOrFail($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Validasi untuk field harga yang diubah ke string
                'rs_harga_obat' => 'nullable|string',
                'rs_harga_meubelair' => 'nullable|string',
                'rs_harga_peralatan' => 'nullable|string',
                'puskesmas_harga_obat' => 'nullable|string',
                'puskesmas_harga_meubelair' => 'nullable|string',
                'puskesmas_harga_peralatan' => 'nullable|string',
                'poliklinik_harga_obat' => 'nullable|string',
                'poliklinik_harga_meubelair' => 'nullable|string',
                'poliklinik_harga_peralatan' => 'nullable|string',
                'pustu_harga_obat' => 'nullable|string',
                'pustu_harga_meubelair' => 'nullable|string',
                'pustu_harga_peralatan' => 'nullable|string',
                'polindes_harga_obat' => 'nullable|string',
                'polindes_harga_meubelair' => 'nullable|string',
                'polindes_harga_peralatan' => 'nullable|string',
                'posyandu_harga_obat' => 'nullable|string',
                'posyandu_harga_meubelair' => 'nullable|string',
                'posyandu_harga_peralatan' => 'nullable|string',
                // ...validation rules sesuai kebutuhan format3...
            ]);
            // ...perhitungan total kerusakan & kerugian jika ada...
            $formKesehatan->update($validated);
            \DB::commit();
            return redirect()->route('forms.form4.list-format3', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 3)
     */
    public function destroy($id)
    {
        $formKesehatan = \App\Models\Format3Form4::findOrFail($id);
        $bencana_id = $formKesehatan->bencana_id;
        $formKesehatan->delete();
        return redirect()->route('forms.form4.list-format3', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }
}
