<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format7Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format7Controller extends Controller
{
    /**
     * Display Format 7 form for Transportation sector data collection
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
        
        return view('forms.form4.format7.format7form4', compact('bencana'));
    }

    /**
     * Store format7 form data for Transportation sector
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
                // Jalan
                'jalan_ruas' => 'nullable|string',
                'jalan_jenis' => 'nullable|string',
                'jalan_tipe' => 'nullable|string',
                'jalan_rusak_berat' => 'nullable|numeric',
                'jalan_rusak_sedang' => 'nullable|numeric',
                'jalan_rusak_ringan' => 'nullable|numeric',
                'jalan_harga_satuan' => 'nullable|numeric',
                'jalan_biaya_perbaikan' => 'nullable|numeric',
                // Jembatan
                'jembatan_nama' => 'nullable|string',
                'jembatan_jenis' => 'nullable|string',
                'jembatan_tipe' => 'nullable|string',
                'jembatan_rusak_berat' => 'nullable|numeric',
                'jembatan_rusak_sedang' => 'nullable|numeric',
                'jembatan_rusak_ringan' => 'nullable|numeric',
                'jembatan_harga_satuan' => 'nullable|numeric',
                'jembatan_biaya_perbaikan' => 'nullable|numeric',
                // Kendaraan
                'sedan_minibus_jumlah' => 'nullable|integer',
                'sedan_minibus_unit' => 'nullable|integer',
                'bus_truk_jumlah' => 'nullable|integer',
                'bus_truk_unit' => 'nullable|integer',
                'kendaraan_berat_jumlah' => 'nullable|integer',
                'kendaraan_berat_unit' => 'nullable|integer',
                'kapal_laut_jumlah' => 'nullable|integer',
                'kapal_laut_unit' => 'nullable|integer',
                'bus_air_jumlah' => 'nullable|integer',
                'bus_air_unit' => 'nullable|integer',
                'speed_boat_jumlah' => 'nullable|integer',
                'speed_boat_unit' => 'nullable|integer',
                'perahu_klotok_jumlah' => 'nullable|integer',
                'perahu_klotok_unit' => 'nullable|integer',
                // Prasarana Transportasi
                'terminal_jumlah' => 'nullable|integer',
                'terminal_rusak_berat' => 'nullable|integer',
                'terminal_rusak_sedang' => 'nullable|integer',
                'terminal_rusak_ringan' => 'nullable|integer',
                'terminal_biaya_perbaikan' => 'nullable|numeric',
                'dermaga_jumlah' => 'nullable|integer',
                'dermaga_rusak_berat' => 'nullable|integer',
                'dermaga_rusak_sedang' => 'nullable|integer',
                'dermaga_rusak_ringan' => 'nullable|integer',
                'dermaga_biaya_perbaikan' => 'nullable|numeric',
                'bandara_jumlah' => 'nullable|integer',
                'bandara_rusak_berat' => 'nullable|integer',
                'bandara_rusak_sedang' => 'nullable|integer',
                'bandara_rusak_ringan' => 'nullable|integer',
                'bandara_biaya_perbaikan' => 'nullable|numeric',
                // Kehilangan Pendapatan
                'pendapatan_darat_per_hari' => 'nullable|numeric',
                'jumlah_angkutan_darat_terdampak' => 'nullable|integer',
                'pendapatan_laut_per_hari' => 'nullable|numeric',
                'jumlah_angkutan_laut_terdampak' => 'nullable|integer',
                'pendapatan_udara_per_hari' => 'nullable|numeric',
                'jumlah_angkutan_udara_terdampak' => 'nullable|integer',
                'pendapatan_terminal_per_hari' => 'nullable|numeric',
                'pendapatan_dermaga_per_hari' => 'nullable|numeric',
                'pendapatan_bandara_per_hari' => 'nullable|numeric',
                // Kenaikan Biaya Operasional
                'biaya_operasional_sebelum' => 'nullable|numeric',
                'biaya_operasional_setelah' => 'nullable|numeric',
                'jumlah_kendaraan_biaya_operasional' => 'nullable|integer',
                // Infrastruktur Darurat
                'infrastruktur_darurat_jumlah' => 'nullable|integer',
                'infrastruktur_darurat_biaya' => 'nullable|numeric',
            ]);

            // Create new form data
            $formTransportasi = Format7Form4::create($validated + $request->only(array_keys(Format7Form4::getModel()->getFillable())));

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formTransportasi
                ]);
            }

            return redirect()->route('forms.form4.list-format7', ['bencana_id' => $formTransportasi->bencana_id])
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
        $formTransportasi = Format7Form4::with('bencana')->findOrFail($id);
        $bencana = $formTransportasi->bencana;
        
        // Initialize empty collections for vehicle and infrastructure reports
        // These will be populated if needed in future versions
        $vehicleReports = collect();
        $infrastructureReports = collect();
        
        return view('forms.form4.format7.show-format7', compact('formTransportasi', 'bencana', 'vehicleReports', 'infrastructureReports'));
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
        $reports = Format7Form4::where('bencana_id', $bencana_id)->get();
        return view('forms.form4.format7.list-format7', compact('bencana', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formTransportasi = Format7Form4::with('bencana')->findOrFail($id);
        $bencana = $formTransportasi->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format7.pdf', compact('formTransportasi', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format7_Transportasi_' . $formTransportasi->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formTransportasi = Format7Form4::with('bencana')->findOrFail($id);
        $bencana = $formTransportasi->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format7.pdf', compact('formTransportasi', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format7_Transportasi_' . $formTransportasi->nama_kampung . '.pdf');
    }

    /**
     * Show the form for editing the specified resource (Format 7)
     */
    public function edit($id)
    {
        $formTransportasi = \App\Models\Format7Form4::with('bencana')->findOrFail($id);
        $bencana = $formTransportasi->bencana;
        return view('forms.form4.format7.edit', compact('formTransportasi', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 7)
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $formTransportasi = Format7Form4::findOrFail($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Transportation sector specific fields
                'jalan_aspal_rusak' => 'nullable|numeric',
                'harga_satuan_jalan_aspal' => 'nullable|numeric',
                'jalan_beton_rusak' => 'nullable|numeric',
                'harga_satuan_jalan_beton' => 'nullable|numeric',
                'jalan_tanah_rusak' => 'nullable|numeric',
                'harga_satuan_jalan_tanah' => 'nullable|numeric',
                'jembatan_rusak' => 'nullable|integer',
                'harga_satuan_jembatan' => 'nullable|numeric',
                'dermaga_rusak' => 'nullable|integer',
                'harga_satuan_dermaga' => 'nullable|numeric',
                'bandara_rusak' => 'nullable|integer',
                'harga_satuan_bandara' => 'nullable|numeric',
                'terminal_rusak' => 'nullable|integer',
                'harga_satuan_terminal' => 'nullable|numeric',
            ]);
            $formTransportasi->update($validated);
            DB::commit();
            return redirect()->route('forms.form4.list-format7', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 7)
     */
    public function destroy($id)
    {
        $formTransportasi = Format7Form4::findOrFail($id);
        $bencana_id = $formTransportasi->bencana_id;
        $formTransportasi->delete();
        return redirect()->route('forms.form4.list-format7', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }
}
