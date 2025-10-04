<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format14Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format14Controller extends Controller
{
    /**
     * Display Format 14 form for data collection
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
        
        return view('forms.form4.format14.format14form4', compact('bencana'));
    }

    /**
     * Store format14 form data
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request with actual form field names
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'kabupaten' => 'nullable|string',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                
                // Tempat Usaha fields
                'tempatusaha_jenis_1' => 'nullable|string',
                'tempatusaha_rb_jumlah_1' => 'nullable|integer',
                'tempatusaha_rs_jumlah_1' => 'nullable|integer', 
                'tempatusaha_rr_jumlah_1' => 'nullable|integer',
                'tempatusaha_rb_harga_1' => 'nullable|numeric',
                'tempatusaha_rs_harga_1' => 'nullable|numeric',
                'tempatusaha_rr_harga_1' => 'nullable|numeric',
                
                'tempatusaha_jenis_2' => 'nullable|string',
                'tempatusaha_rb_jumlah_2' => 'nullable|integer',
                'tempatusaha_rs_jumlah_2' => 'nullable|integer',
                'tempatusaha_rr_jumlah_2' => 'nullable|integer',
                'tempatusaha_rb_harga_2' => 'nullable|numeric',
                'tempatusaha_rs_harga_2' => 'nullable|numeric',
                'tempatusaha_rr_harga_2' => 'nullable|numeric',
                
                'tempatusaha_jenis_3' => 'nullable|string',
                'tempatusaha_rb_jumlah_3' => 'nullable|integer',
                'tempatusaha_rs_jumlah_3' => 'nullable|integer',
                'tempatusaha_rr_jumlah_3' => 'nullable|integer',
                'tempatusaha_rb_harga_3' => 'nullable|numeric',
                'tempatusaha_rs_harga_3' => 'nullable|numeric',
                'tempatusaha_rr_harga_3' => 'nullable|numeric',
                
                // Peralatan fields
                'peralatan_jenis_1' => 'nullable|string',
                'peralatan_rb_jumlah_1' => 'nullable|integer',
                'peralatan_rs_jumlah_1' => 'nullable|integer',
                'peralatan_rr_jumlah_1' => 'nullable|integer',
                'peralatan_rb_harga_1' => 'nullable|numeric',
                'peralatan_rs_harga_1' => 'nullable|numeric',
                'peralatan_rr_harga_1' => 'nullable|numeric',
                
                'peralatan_jenis_2' => 'nullable|string',
                'peralatan_rb_jumlah_2' => 'nullable|integer',
                'peralatan_rs_jumlah_2' => 'nullable|integer',
                'peralatan_rr_jumlah_2' => 'nullable|integer',
                'peralatan_rb_harga_2' => 'nullable|numeric',
                'peralatan_rs_harga_2' => 'nullable|numeric',
                'peralatan_rr_harga_2' => 'nullable|numeric',
                
                'peralatan_jenis_3' => 'nullable|string',
                'peralatan_rb_jumlah_3' => 'nullable|integer',
                'peralatan_rs_jumlah_3' => 'nullable|integer',
                'peralatan_rr_jumlah_3' => 'nullable|integer',
                'peralatan_rb_harga_3' => 'nullable|numeric',
                'peralatan_rs_harga_3' => 'nullable|numeric',
                'peralatan_rr_harga_3' => 'nullable|numeric',
                
                // Barang Dagangan fields
                'barangdagangan_jenis_1' => 'nullable|string',
                'barangdagangan_rb_jumlah_1' => 'nullable|integer',
                'barangdagangan_rs_jumlah_1' => 'nullable|integer',
                'barangdagangan_rr_jumlah_1' => 'nullable|integer',
                'barangdagangan_rb_harga_1' => 'nullable|numeric',
                'barangdagangan_rs_harga_1' => 'nullable|numeric',
                'barangdagangan_rr_harga_1' => 'nullable|numeric',
                
                'barangdagangan_jenis_2' => 'nullable|string',
                'barangdagangan_rb_jumlah_2' => 'nullable|integer',
                'barangdagangan_rs_jumlah_2' => 'nullable|integer',
                'barangdagangan_rr_jumlah_2' => 'nullable|integer',
                'barangdagangan_rb_harga_2' => 'nullable|numeric',
                'barangdagangan_rs_harga_2' => 'nullable|numeric',
                'barangdagangan_rr_harga_2' => 'nullable|numeric',
                
                'barangdagangan_jenis_3' => 'nullable|string',
                'barangdagangan_rb_jumlah_3' => 'nullable|integer',
                'barangdagangan_rs_jumlah_3' => 'nullable|integer',
                'barangdagangan_rr_jumlah_3' => 'nullable|integer',
                'barangdagangan_rb_harga_3' => 'nullable|numeric',
                'barangdagangan_rs_harga_3' => 'nullable|numeric',
                'barangdagangan_rr_harga_3' => 'nullable|numeric',
            ]);

            // Add default kabupaten if not provided
            $validated['kabupaten'] = $validated['kabupaten'] ?? 'Papua Selatan';

            // Map form field names to model field names
            $modelData = [
                'bencana_id' => $validated['bencana_id'],
                'kabupaten' => $validated['kabupaten'],
                'nama_kampung' => $validated['nama_kampung'],
                'nama_distrik' => $validated['nama_distrik'],
            ];
            
            // Map Tempat Usaha fields
            for ($i = 1; $i <= 3; $i++) {
                $modelData["tempatusaha_{$i}_jenis"] = $validated["tempatusaha_jenis_{$i}"] ?? null;
                $modelData["tempatusaha_{$i}_rb_jumlah"] = $validated["tempatusaha_rb_jumlah_{$i}"] ?? 0;
                $modelData["tempatusaha_{$i}_rs_jumlah"] = $validated["tempatusaha_rs_jumlah_{$i}"] ?? 0;
                $modelData["tempatusaha_{$i}_rr_jumlah"] = $validated["tempatusaha_rr_jumlah_{$i}"] ?? 0;
                $modelData["tempatusaha_{$i}_rb_harga"] = $validated["tempatusaha_rb_harga_{$i}"] ?? 0;
                $modelData["tempatusaha_{$i}_rs_harga"] = $validated["tempatusaha_rs_harga_{$i}"] ?? 0;
                $modelData["tempatusaha_{$i}_rr_harga"] = $validated["tempatusaha_rr_harga_{$i}"] ?? 0;
            }
            
            // Map Peralatan fields
            for ($i = 1; $i <= 3; $i++) {
                $modelData["peralatan_{$i}_jenis"] = $validated["peralatan_jenis_{$i}"] ?? null;
                $modelData["peralatan_{$i}_rb_jumlah"] = $validated["peralatan_rb_jumlah_{$i}"] ?? 0;
                $modelData["peralatan_{$i}_rs_jumlah"] = $validated["peralatan_rs_jumlah_{$i}"] ?? 0;
                $modelData["peralatan_{$i}_rr_jumlah"] = $validated["peralatan_rr_jumlah_{$i}"] ?? 0;
                $modelData["peralatan_{$i}_rb_harga"] = $validated["peralatan_rb_harga_{$i}"] ?? 0;
                $modelData["peralatan_{$i}_rs_harga"] = $validated["peralatan_rs_harga_{$i}"] ?? 0;
                $modelData["peralatan_{$i}_rr_harga"] = $validated["peralatan_rr_harga_{$i}"] ?? 0;
            }
            
            // Map Barang Dagangan fields
            for ($i = 1; $i <= 3; $i++) {
                $modelData["barangdagangan_{$i}_jenis"] = $validated["barangdagangan_jenis_{$i}"] ?? null;
                $modelData["barangdagangan_{$i}_rb_jumlah"] = $validated["barangdagangan_rb_jumlah_{$i}"] ?? 0;
                $modelData["barangdagangan_{$i}_rs_jumlah"] = $validated["barangdagangan_rs_jumlah_{$i}"] ?? 0;
                $modelData["barangdagangan_{$i}_rr_jumlah"] = $validated["barangdagangan_rr_jumlah_{$i}"] ?? 0;
                $modelData["barangdagangan_{$i}_rb_harga"] = $validated["barangdagangan_rb_harga_{$i}"] ?? 0;
                $modelData["barangdagangan_{$i}_rs_harga"] = $validated["barangdagangan_rs_harga_{$i}"] ?? 0;
                $modelData["barangdagangan_{$i}_rr_harga"] = $validated["barangdagangan_rr_harga_{$i}"] ?? 0;
            }

            // Create new form data with properly mapped field names
            $formData = Format14Form4::create($modelData);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $formData
                ]);
            }

            return redirect()->route('forms.form4.list-format14', ['bencana_id' => $formData->bencana_id])
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
        $formData = Format14Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        // Prepare data array that matches the Blade template expectations
        $data = [
            'nama_kampung' => $formData->nama_kampung,
            'nama_distrik' => $formData->nama_distrik,
            
            // A. Kerusakan Fisik - Map tempat usaha to building types
            'toko_kecil_jumlah' => ($formData->tempatusaha_1_rb_jumlah ?? 0) + ($formData->tempatusaha_1_rs_jumlah ?? 0) + ($formData->tempatusaha_1_rr_jumlah ?? 0),
            'toko_kecil_luas' => 0, // Not available in model
            'toko_kecil_harga' => (($formData->tempatusaha_1_rb_harga ?? 0) + ($formData->tempatusaha_1_rs_harga ?? 0) + ($formData->tempatusaha_1_rr_harga ?? 0)) / 3,
            'toko_kecil_total' => (($formData->tempatusaha_1_rb_jumlah ?? 0) * ($formData->tempatusaha_1_rb_harga ?? 0)) + 
                                 (($formData->tempatusaha_1_rs_jumlah ?? 0) * ($formData->tempatusaha_1_rs_harga ?? 0)) + 
                                 (($formData->tempatusaha_1_rr_jumlah ?? 0) * ($formData->tempatusaha_1_rr_harga ?? 0)),
            
            'kios_pasar_jumlah' => ($formData->tempatusaha_2_rb_jumlah ?? 0) + ($formData->tempatusaha_2_rs_jumlah ?? 0) + ($formData->tempatusaha_2_rr_jumlah ?? 0),
            'kios_pasar_luas' => 0,
            'kios_pasar_harga' => (($formData->tempatusaha_2_rb_harga ?? 0) + ($formData->tempatusaha_2_rs_harga ?? 0) + ($formData->tempatusaha_2_rr_harga ?? 0)) / 3,
            'kios_pasar_total' => (($formData->tempatusaha_2_rb_jumlah ?? 0) * ($formData->tempatusaha_2_rb_harga ?? 0)) + 
                                 (($formData->tempatusaha_2_rs_jumlah ?? 0) * ($formData->tempatusaha_2_rs_harga ?? 0)) + 
                                 (($formData->tempatusaha_2_rr_jumlah ?? 0) * ($formData->tempatusaha_2_rr_harga ?? 0)),
            
            'grosir_jumlah' => ($formData->tempatusaha_3_rb_jumlah ?? 0) + ($formData->tempatusaha_3_rs_jumlah ?? 0) + ($formData->tempatusaha_3_rr_jumlah ?? 0),
            'grosir_luas' => 0,
            'grosir_harga' => (($formData->tempatusaha_3_rb_harga ?? 0) + ($formData->tempatusaha_3_rs_harga ?? 0) + ($formData->tempatusaha_3_rr_harga ?? 0)) / 3,
            'grosir_total' => (($formData->tempatusaha_3_rb_jumlah ?? 0) * ($formData->tempatusaha_3_rb_harga ?? 0)) + 
                             (($formData->tempatusaha_3_rs_jumlah ?? 0) * ($formData->tempatusaha_3_rs_harga ?? 0)) + 
                             (($formData->tempatusaha_3_rr_jumlah ?? 0) * ($formData->tempatusaha_3_rr_harga ?? 0)),
            
            // Additional building type from peralatan_1
            'lainnya_jenis_bangunan' => $formData->peralatan_1_jenis ?? 'Lainnya',
            'lainnya_bangunan_jumlah' => ($formData->peralatan_1_rb_jumlah ?? 0) + ($formData->peralatan_1_rs_jumlah ?? 0) + ($formData->peralatan_1_rr_jumlah ?? 0),
            'lainnya_bangunan_luas' => 0,
            'lainnya_bangunan_harga' => (($formData->peralatan_1_rb_harga ?? 0) + ($formData->peralatan_1_rs_harga ?? 0) + ($formData->peralatan_1_rr_harga ?? 0)) / 3,
            'lainnya_bangunan_total' => (($formData->peralatan_1_rb_jumlah ?? 0) * ($formData->peralatan_1_rb_harga ?? 0)) + 
                                       (($formData->peralatan_1_rs_jumlah ?? 0) * ($formData->peralatan_1_rs_harga ?? 0)) + 
                                       (($formData->peralatan_1_rr_jumlah ?? 0) * ($formData->peralatan_1_rr_harga ?? 0)),
            
            // B. Kerusakan Barang Dagangan - Map barang dagangan to goods types
            'beras_jumlah' => ($formData->barangdagangan_1_rb_jumlah ?? 0) + ($formData->barangdagangan_1_rs_jumlah ?? 0) + ($formData->barangdagangan_1_rr_jumlah ?? 0),
            'beras_harga' => (($formData->barangdagangan_1_rb_harga ?? 0) + ($formData->barangdagangan_1_rs_harga ?? 0) + ($formData->barangdagangan_1_rr_harga ?? 0)) / 3,
            'beras_total' => (($formData->barangdagangan_1_rb_jumlah ?? 0) * ($formData->barangdagangan_1_rb_harga ?? 0)) + 
                            (($formData->barangdagangan_1_rs_jumlah ?? 0) * ($formData->barangdagangan_1_rs_harga ?? 0)) + 
                            (($formData->barangdagangan_1_rr_jumlah ?? 0) * ($formData->barangdagangan_1_rr_harga ?? 0)),
            
            'minyak_jumlah' => ($formData->barangdagangan_2_rb_jumlah ?? 0) + ($formData->barangdagangan_2_rs_jumlah ?? 0) + ($formData->barangdagangan_2_rr_jumlah ?? 0),
            'minyak_harga' => (($formData->barangdagangan_2_rb_harga ?? 0) + ($formData->barangdagangan_2_rs_harga ?? 0) + ($formData->barangdagangan_2_rr_harga ?? 0)) / 3,
            'minyak_total' => (($formData->barangdagangan_2_rb_jumlah ?? 0) * ($formData->barangdagangan_2_rb_harga ?? 0)) + 
                             (($formData->barangdagangan_2_rs_jumlah ?? 0) * ($formData->barangdagangan_2_rs_harga ?? 0)) + 
                             (($formData->barangdagangan_2_rr_jumlah ?? 0) * ($formData->barangdagangan_2_rr_harga ?? 0)),
            
            'pakaian_jumlah' => ($formData->barangdagangan_3_rb_jumlah ?? 0) + ($formData->barangdagangan_3_rs_jumlah ?? 0) + ($formData->barangdagangan_3_rr_jumlah ?? 0),
            'pakaian_harga' => (($formData->barangdagangan_3_rb_harga ?? 0) + ($formData->barangdagangan_3_rs_harga ?? 0) + ($formData->barangdagangan_3_rr_harga ?? 0)) / 3,
            'pakaian_total' => (($formData->barangdagangan_3_rb_jumlah ?? 0) * ($formData->barangdagangan_3_rb_harga ?? 0)) + 
                              (($formData->barangdagangan_3_rs_jumlah ?? 0) * ($formData->barangdagangan_3_rs_harga ?? 0)) + 
                              (($formData->barangdagangan_3_rr_jumlah ?? 0) * ($formData->barangdagangan_3_rr_harga ?? 0)),
            
            // Electronics from peralatan_2
            'elektronik_jumlah' => ($formData->peralatan_2_rb_jumlah ?? 0) + ($formData->peralatan_2_rs_jumlah ?? 0) + ($formData->peralatan_2_rr_jumlah ?? 0),
            'elektronik_harga' => (($formData->peralatan_2_rb_harga ?? 0) + ($formData->peralatan_2_rs_harga ?? 0) + ($formData->peralatan_2_rr_harga ?? 0)) / 3,
            'elektronik_total' => (($formData->peralatan_2_rb_jumlah ?? 0) * ($formData->peralatan_2_rb_harga ?? 0)) + 
                                 (($formData->peralatan_2_rs_jumlah ?? 0) * ($formData->peralatan_2_rs_harga ?? 0)) + 
                                 (($formData->peralatan_2_rr_jumlah ?? 0) * ($formData->peralatan_2_rr_harga ?? 0)),
            
            // Other goods from peralatan_3
            'lainnya_jenis_barang' => $formData->peralatan_3_jenis ?? 'Lainnya',
            'lainnya_barang_jumlah' => ($formData->peralatan_3_rb_jumlah ?? 0) + ($formData->peralatan_3_rs_jumlah ?? 0) + ($formData->peralatan_3_rr_jumlah ?? 0),
            'lainnya_barang_harga' => (($formData->peralatan_3_rb_harga ?? 0) + ($formData->peralatan_3_rs_harga ?? 0) + ($formData->peralatan_3_rr_harga ?? 0)) / 3,
            'lainnya_barang_total' => (($formData->peralatan_3_rb_jumlah ?? 0) * ($formData->peralatan_3_rb_harga ?? 0)) + 
                                     (($formData->peralatan_3_rs_jumlah ?? 0) * ($formData->peralatan_3_rs_harga ?? 0)) + 
                                     (($formData->peralatan_3_rr_jumlah ?? 0) * ($formData->peralatan_3_rr_harga ?? 0)),
            
            // C. Kehilangan Pendapatan - Default values as not in current model
            'jumlah_pelaku_usaha' => 0,
            'pendapatan_harian' => 0,
            'lama_tidak_operasi' => 0,
        ];
        
        return view('forms.form4.format14.show-format14', compact('formData', 'bencana', 'data'));
    }

    /**
     * Show the form for editing the specified resource (Format 14)
     */
    public function edit($id)
    {
        $formPerdagangan = Format14Form4::with('bencana')->findOrFail($id);
        $bencana = $formPerdagangan->bencana;
        
        // Pass data with correct variable names that the form expects
        $data = $formPerdagangan;
        
        return view('forms.form4.format14.edit', compact('formPerdagangan', 'bencana', 'data'));
    }

    /**
     * Update the specified resource in storage (Format 14)
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $formData = Format14Form4::findOrFail($id);
            
            // Validate with actual form field names
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'kabupaten' => 'nullable|string',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                
                // Tempat Usaha fields
                'tempatusaha_jenis_1' => 'nullable|string',
                'tempatusaha_rb_jumlah_1' => 'nullable|integer',
                'tempatusaha_rs_jumlah_1' => 'nullable|integer', 
                'tempatusaha_rr_jumlah_1' => 'nullable|integer',
                'tempatusaha_rb_harga_1' => 'nullable|numeric',
                'tempatusaha_rs_harga_1' => 'nullable|numeric',
                'tempatusaha_rr_harga_1' => 'nullable|numeric',
                
                'tempatusaha_jenis_2' => 'nullable|string',
                'tempatusaha_rb_jumlah_2' => 'nullable|integer',
                'tempatusaha_rs_jumlah_2' => 'nullable|integer',
                'tempatusaha_rr_jumlah_2' => 'nullable|integer',
                'tempatusaha_rb_harga_2' => 'nullable|numeric',
                'tempatusaha_rs_harga_2' => 'nullable|numeric',
                'tempatusaha_rr_harga_2' => 'nullable|numeric',
                
                'tempatusaha_jenis_3' => 'nullable|string',
                'tempatusaha_rb_jumlah_3' => 'nullable|integer',
                'tempatusaha_rs_jumlah_3' => 'nullable|integer',
                'tempatusaha_rr_jumlah_3' => 'nullable|integer',
                'tempatusaha_rb_harga_3' => 'nullable|numeric',
                'tempatusaha_rs_harga_3' => 'nullable|numeric',
                'tempatusaha_rr_harga_3' => 'nullable|numeric',
                
                // Peralatan fields
                'peralatan_jenis_1' => 'nullable|string',
                'peralatan_rb_jumlah_1' => 'nullable|integer',
                'peralatan_rs_jumlah_1' => 'nullable|integer',
                'peralatan_rr_jumlah_1' => 'nullable|integer',
                'peralatan_rb_harga_1' => 'nullable|numeric',
                'peralatan_rs_harga_1' => 'nullable|numeric',
                'peralatan_rr_harga_1' => 'nullable|numeric',
                
                'peralatan_jenis_2' => 'nullable|string',
                'peralatan_rb_jumlah_2' => 'nullable|integer',
                'peralatan_rs_jumlah_2' => 'nullable|integer',
                'peralatan_rr_jumlah_2' => 'nullable|integer',
                'peralatan_rb_harga_2' => 'nullable|numeric',
                'peralatan_rs_harga_2' => 'nullable|numeric',
                'peralatan_rr_harga_2' => 'nullable|numeric',
                
                'peralatan_jenis_3' => 'nullable|string',
                'peralatan_rb_jumlah_3' => 'nullable|integer',
                'peralatan_rs_jumlah_3' => 'nullable|integer',
                'peralatan_rr_jumlah_3' => 'nullable|integer',
                'peralatan_rb_harga_3' => 'nullable|numeric',
                'peralatan_rs_harga_3' => 'nullable|numeric',
                'peralatan_rr_harga_3' => 'nullable|numeric',
                
                // Barang Dagangan fields
                'barangdagangan_jenis_1' => 'nullable|string',
                'barangdagangan_rb_jumlah_1' => 'nullable|integer',
                'barangdagangan_rs_jumlah_1' => 'nullable|integer',
                'barangdagangan_rr_jumlah_1' => 'nullable|integer',
                'barangdagangan_rb_harga_1' => 'nullable|numeric',
                'barangdagangan_rs_harga_1' => 'nullable|numeric',
                'barangdagangan_rr_harga_1' => 'nullable|numeric',
                
                'barangdagangan_jenis_2' => 'nullable|string',
                'barangdagangan_rb_jumlah_2' => 'nullable|integer',
                'barangdagangan_rs_jumlah_2' => 'nullable|integer',
                'barangdagangan_rr_jumlah_2' => 'nullable|integer',
                'barangdagangan_rb_harga_2' => 'nullable|numeric',
                'barangdagangan_rs_harga_2' => 'nullable|numeric',
                'barangdagangan_rr_harga_2' => 'nullable|numeric',
                
                'barangdagangan_jenis_3' => 'nullable|string',
                'barangdagangan_rb_jumlah_3' => 'nullable|integer',
                'barangdagangan_rs_jumlah_3' => 'nullable|integer',
                'barangdagangan_rr_jumlah_3' => 'nullable|integer',
                'barangdagangan_rb_harga_3' => 'nullable|numeric',
                'barangdagangan_rs_harga_3' => 'nullable|numeric',
                'barangdagangan_rr_harga_3' => 'nullable|numeric',
            ]);

            // Add default kabupaten if not provided
            $validated['kabupaten'] = $validated['kabupaten'] ?? 'Papua Selatan';

            // Map form field names to model field names
            $modelData = [
                'bencana_id' => $validated['bencana_id'],
                'kabupaten' => $validated['kabupaten'],
                'nama_kampung' => $validated['nama_kampung'],
                'nama_distrik' => $validated['nama_distrik'],
            ];
            
            // Map Tempat Usaha fields
            for ($i = 1; $i <= 3; $i++) {
                $modelData["tempatusaha_{$i}_jenis"] = $validated["tempatusaha_jenis_{$i}"] ?? null;
                $modelData["tempatusaha_{$i}_rb_jumlah"] = $validated["tempatusaha_rb_jumlah_{$i}"] ?? 0;
                $modelData["tempatusaha_{$i}_rs_jumlah"] = $validated["tempatusaha_rs_jumlah_{$i}"] ?? 0;
                $modelData["tempatusaha_{$i}_rr_jumlah"] = $validated["tempatusaha_rr_jumlah_{$i}"] ?? 0;
                $modelData["tempatusaha_{$i}_rb_harga"] = $validated["tempatusaha_rb_harga_{$i}"] ?? 0;
                $modelData["tempatusaha_{$i}_rs_harga"] = $validated["tempatusaha_rs_harga_{$i}"] ?? 0;
                $modelData["tempatusaha_{$i}_rr_harga"] = $validated["tempatusaha_rr_harga_{$i}"] ?? 0;
            }
            
            // Map Peralatan fields
            for ($i = 1; $i <= 3; $i++) {
                $modelData["peralatan_{$i}_jenis"] = $validated["peralatan_jenis_{$i}"] ?? null;
                $modelData["peralatan_{$i}_rb_jumlah"] = $validated["peralatan_rb_jumlah_{$i}"] ?? 0;
                $modelData["peralatan_{$i}_rs_jumlah"] = $validated["peralatan_rs_jumlah_{$i}"] ?? 0;
                $modelData["peralatan_{$i}_rr_jumlah"] = $validated["peralatan_rr_jumlah_{$i}"] ?? 0;
                $modelData["peralatan_{$i}_rb_harga"] = $validated["peralatan_rb_harga_{$i}"] ?? 0;
                $modelData["peralatan_{$i}_rs_harga"] = $validated["peralatan_rs_harga_{$i}"] ?? 0;
                $modelData["peralatan_{$i}_rr_harga"] = $validated["peralatan_rr_harga_{$i}"] ?? 0;
            }
            
            // Map Barang Dagangan fields
            for ($i = 1; $i <= 3; $i++) {
                $modelData["barangdagangan_{$i}_jenis"] = $validated["barangdagangan_jenis_{$i}"] ?? null;
                $modelData["barangdagangan_{$i}_rb_jumlah"] = $validated["barangdagangan_rb_jumlah_{$i}"] ?? 0;
                $modelData["barangdagangan_{$i}_rs_jumlah"] = $validated["barangdagangan_rs_jumlah_{$i}"] ?? 0;
                $modelData["barangdagangan_{$i}_rr_jumlah"] = $validated["barangdagangan_rr_jumlah_{$i}"] ?? 0;
                $modelData["barangdagangan_{$i}_rb_harga"] = $validated["barangdagangan_rb_harga_{$i}"] ?? 0;
                $modelData["barangdagangan_{$i}_rs_harga"] = $validated["barangdagangan_rs_harga_{$i}"] ?? 0;
                $modelData["barangdagangan_{$i}_rr_harga"] = $validated["barangdagangan_rr_harga_{$i}"] ?? 0;
            }
            
            // Update with properly mapped field names
            $formData->update($modelData);
            DB::commit();
            return redirect()->route('forms.form4.list-format14', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 14)
     */
    public function destroy($id)
    {
        $form = Format14Form4::findOrFail($id);
        $bencana_id = $form->bencana_id;
        $form->delete(); // Hard delete
        return redirect()->route('forms.form4.list-format14', ['bencana_id' => $bencana_id])
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
        $reports = Format14Form4::where('bencana_id', $bencana_id)->get(); // No soft delete filter
        return view('forms.form4.format14.list-format14', compact('bencana', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
        $formData = Format14Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format14.pdf', compact('formData', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format14_' . $formData->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
        $formData = Format14Form4::with('bencana')->findOrFail($id);
        $bencana = $formData->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format14.pdf', compact('formData', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format14_' . $formData->nama_kampung . '.pdf');
    }
}
