<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format8Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format8Controller extends Controller
{
    /**
     * Display Format 8 form for Electricity sector data collection
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
        
        return view('forms.form4.format8.format8form4', compact('bencana'));
    }

    /**
     * Store format8 form data for Electricity sector
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
                // Sistem Transmisi dan Distribusi
                'kabel_unit' => 'nullable|integer',
                'kabel_harga_satuan' => 'nullable|numeric',
                'kabel_jumlah' => 'nullable|numeric',
                'tiang_unit' => 'nullable|integer',
                'tiang_harga_satuan' => 'nullable|numeric',
                'tiang_jumlah' => 'nullable|numeric',
                'trafo_unit' => 'nullable|integer',
                'trafo_harga_satuan' => 'nullable|numeric',
                'trafo_jumlah' => 'nullable|numeric',
                // Sistem Pembangkitan
                'plta_unit' => 'nullable|integer',
                'plta_harga_satuan' => 'nullable|numeric',
                'plta_jumlah' => 'nullable|numeric',
                'pltu_unit' => 'nullable|integer',
                'pltu_harga_satuan' => 'nullable|numeric',
                'pltu_jumlah' => 'nullable|numeric',
                'pltd_unit' => 'nullable|integer',
                'pltd_harga_satuan' => 'nullable|numeric',
                'pltd_jumlah' => 'nullable|numeric',
                'pembangkit_lain_unit' => 'nullable|integer',
                'pembangkit_lain_harga_satuan' => 'nullable|numeric',
                'pembangkit_lain_jumlah' => 'nullable|numeric',
                'pembangkit_lain_keterangan' => 'nullable|string',
                // Perkiraan Jangka Waktu Pemulihan
                'jangka_waktu_pemulihan_bulan' => 'nullable|integer',
                // Pembangkit Listrik Darurat
                'genset_unit' => 'nullable|integer',
                'genset_biaya_pengadaan' => 'nullable|numeric',
                // Perkiraan Kehilangan/Penurunan Pendapatan
                'permintaan_listrik_sebelum_kwh' => 'nullable|numeric',
                'permintaan_listrik_pasca_kwh' => 'nullable|numeric',
                'tarif_listrik_per_kwh' => 'nullable|numeric',
                'penurunan_pendapatan' => 'nullable|numeric',
                // Perkiraan Kenaikan Biaya Operasional
                'biaya_operasional_sebelum' => 'nullable|numeric',
                'biaya_operasional_pasca' => 'nullable|numeric',
                'kenaikan_biaya_operasional' => 'nullable|numeric',
            ]);

            // Create new form data
            $formListrik = Format8Form4::create($validated);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formListrik
                ]);
            }

            return redirect()->route('forms.form4.list-format8', ['bencana_id' => $formListrik->bencana_id])
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
        $formListrik = Format8Form4::with('bencana')->findOrFail($id);
        $bencana = $formListrik->bencana;
        
        return view('forms.form4.format8.show-format8', compact('formListrik', 'bencana'));
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
        $reports = Format8Form4::where('bencana_id', $bencana_id)->get(); // No soft delete filter
        return view('forms.form4.format8.list-format8', compact('bencana', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formListrik = Format8Form4::with('bencana')->findOrFail($id);
        $bencana = $formListrik->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format8.pdf', compact('formListrik', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format8_Listrik_' . $formListrik->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formListrik = Format8Form4::with('bencana')->findOrFail($id);
        $bencana = $formListrik->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format8.pdf', compact('formListrik', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format8_Listrik_' . $formListrik->nama_kampung . '.pdf');    
    }

    /**
     * Show the form for editing the specified resource (Format 8)
     */
    public function edit($id)
    {
        $formListrik = \App\Models\Format8Form4::with('bencana')->findOrFail($id);
        $bencana = $formListrik->bencana;
        return view('forms.form4.format8.edit', compact('formListrik', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 8)
     */
    public function update(Request $request, $id)
    {
        try {
            \DB::beginTransaction();
            $formListrik = \App\Models\Format8Form4::findOrFail($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Sistem Transmisi dan Distribusi
                'kabel_unit' => 'nullable|integer',
                'kabel_harga_satuan' => 'nullable|numeric',
                'kabel_jumlah' => 'nullable|numeric',
                'tiang_unit' => 'nullable|integer',
                'tiang_harga_satuan' => 'nullable|numeric',
                'tiang_jumlah' => 'nullable|numeric',
                'trafo_unit' => 'nullable|integer',
                'trafo_harga_satuan' => 'nullable|numeric',
                'trafo_jumlah' => 'nullable|numeric',
                // Sistem Pembangkitan
                'plta_unit' => 'nullable|integer',
                'plta_harga_satuan' => 'nullable|numeric',
                'plta_jumlah' => 'nullable|numeric',
                'pltu_unit' => 'nullable|integer',
                'pltu_harga_satuan' => 'nullable|numeric',
                'pltu_jumlah' => 'nullable|numeric',
                'pltd_unit' => 'nullable|integer',
                'pltd_harga_satuan' => 'nullable|numeric',
                'pltd_jumlah' => 'nullable|numeric',
                'pembangkit_lain_unit' => 'nullable|integer',
                'pembangkit_lain_harga_satuan' => 'nullable|numeric',
                'pembangkit_lain_jumlah' => 'nullable|numeric',
                'pembangkit_lain_keterangan' => 'nullable|string',
                // Perkiraan Jangka Waktu Pemulihan
                'jangka_waktu_pemulihan_bulan' => 'nullable|integer',
                // Pembangkit Listrik Darurat
                'genset_unit' => 'nullable|integer',
                'genset_biaya_pengadaan' => 'nullable|numeric',
                // Perkiraan Kehilangan/Penurunan Pendapatan
                'permintaan_listrik_sebelum_kwh' => 'nullable|numeric',
                'permintaan_listrik_pasca_kwh' => 'nullable|numeric',
                'tarif_listrik_per_kwh' => 'nullable|numeric',
                'penurunan_pendapatan' => 'nullable|numeric',
                // Perkiraan Kenaikan Biaya Operasional
                'biaya_operasional_sebelum' => 'nullable|numeric',
                'biaya_operasional_pasca' => 'nullable|numeric',
                'kenaikan_biaya_operasional' => 'nullable|numeric',
            ]);
            $formListrik->update($validated);
            \DB::commit();
            return redirect()->route('forms.form4.list-format8', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 8)
     */
    public function destroy($id)
    {
        $formListrik = \App\Models\Format8Form4::findOrFail($id);
        $bencana_id = $formListrik->bencana_id;
        $formListrik->delete(); // This will hard delete if model does not use SoftDeletes
        return redirect()->route('forms.form4.list-format8', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }
}
