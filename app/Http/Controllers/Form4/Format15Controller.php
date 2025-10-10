<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\Format15Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class Format15Controller extends Controller
{
    /**
     * Display Format 15 form for data collection
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
        
        return view('forms.form4.format15.format15form4', compact('bencana'));
    }

    /**
     * Store format15 form data
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request based on actual form fields
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'kabupaten' => 'nullable|string',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Tempat Wisata (1-3)
                'tempat_wisata_1_jenis' => 'nullable|string',
                'tempat_wisata_1_rb' => 'nullable|integer',
                'tempat_wisata_1_rs' => 'nullable|integer',
                'tempat_wisata_1_rr' => 'nullable|integer',
                'tempat_wisata_1_rb_harga' => 'nullable|numeric',
                'tempat_wisata_1_rs_harga' => 'nullable|numeric',
                'tempat_wisata_1_rr_harga' => 'nullable|numeric',
                'tempat_wisata_2_jenis' => 'nullable|string',
                'tempat_wisata_2_rb' => 'nullable|integer',
                'tempat_wisata_2_rs' => 'nullable|integer',
                'tempat_wisata_2_rr' => 'nullable|integer',
                'tempat_wisata_2_rb_harga' => 'nullable|numeric',
                'tempat_wisata_2_rs_harga' => 'nullable|numeric',
                'tempat_wisata_2_rr_harga' => 'nullable|numeric',
                'tempat_wisata_3_jenis' => 'nullable|string',
                'tempat_wisata_3_rb' => 'nullable|integer',
                'tempat_wisata_3_rs' => 'nullable|integer',
                'tempat_wisata_3_rr' => 'nullable|integer',
                'tempat_wisata_3_rb_harga' => 'nullable|numeric',
                'tempat_wisata_3_rs_harga' => 'nullable|numeric',
                'tempat_wisata_3_rr_harga' => 'nullable|numeric',
                // Hotel Restaurant (1-3)
                'hotel_restaurant_1_jenis' => 'nullable|string',
                'hotel_restaurant_1_rb' => 'nullable|integer',
                'hotel_restaurant_1_rs' => 'nullable|integer',
                'hotel_restaurant_1_rr' => 'nullable|integer',
                'hotel_restaurant_1_rb_harga' => 'nullable|numeric',
                'hotel_restaurant_1_rs_harga' => 'nullable|numeric',
                'hotel_restaurant_1_rr_harga' => 'nullable|numeric',
                'hotel_restaurant_2_jenis' => 'nullable|string',
                'hotel_restaurant_2_rb' => 'nullable|integer',
                'hotel_restaurant_2_rs' => 'nullable|integer',
                'hotel_restaurant_2_rr' => 'nullable|integer',
                'hotel_restaurant_2_rb_harga' => 'nullable|numeric',
                'hotel_restaurant_2_rs_harga' => 'nullable|numeric',
                'hotel_restaurant_2_rr_harga' => 'nullable|numeric',
                'hotel_restaurant_3_jenis' => 'nullable|string',
                'hotel_restaurant_3_rb' => 'nullable|integer',
                'hotel_restaurant_3_rs' => 'nullable|integer',
                'hotel_restaurant_3_rr' => 'nullable|integer',
                'hotel_restaurant_3_rb_harga' => 'nullable|numeric',
                'hotel_restaurant_3_rs_harga' => 'nullable|numeric',
                'hotel_restaurant_3_rr_harga' => 'nullable|numeric',
                // Kerugian fields
                'kehilangan_total_pendapatan_jenis_fasilitas' => 'nullable|string',
                'kehilangan_total_pendapatan_pendapatan_rata_rata' => 'nullable|string',
                'kehilangan_total_pendapatan_waktu' => 'nullable|string',
                'penurunan_pendapatan_jenis_fasilitas' => 'nullable|string',
                'penurunan_pendapatan_pendapatan_rata_rata' => 'nullable|string',
                'penurunan_pendapatan_waktu' => 'nullable|string',
                'kenaikan_biaya_produksi_jenis_fasilitas' => 'nullable|string',
                'kenaikan_biaya_produksi_pendapatan_rata_rata' => 'nullable|string',
            ]);

            // Add default kabupaten if not provided
            if (empty($validated['kabupaten'])) {
                $validated['kabupaten'] = 'Papua Selatan'; // Default value
            }
            
            // Map form fields to model fields
            $mappedData = [
                'bencana_id' => $validated['bencana_id'],
                'kabupaten' => $validated['kabupaten'],
                'nama_kampung' => $validated['nama_kampung'],
                'nama_distrik' => $validated['nama_distrik'],
                
                // Map tempat_wisata to fasilitas_1
                'fasilitas_1_jenis' => $validated['tempat_wisata_1_jenis'] ?? null,
                'fasilitas_1_rb_tingkat' => $validated['tempat_wisata_1_rb'] ?? null,
                'fasilitas_1_rs_tingkat' => $validated['tempat_wisata_1_rs'] ?? null,
                'fasilitas_1_rr_tingkat' => $validated['tempat_wisata_1_rr'] ?? null,
                'fasilitas_1_rb_harga' => $validated['tempat_wisata_1_rb_harga'] ?? null,
                'fasilitas_1_rs_harga' => $validated['tempat_wisata_1_rs_harga'] ?? null,
                'fasilitas_1_rr_harga' => $validated['tempat_wisata_1_rr_harga'] ?? null,
                
                // Map hotel_restaurant to fasilitas_2
                'fasilitas_2_jenis' => $validated['hotel_restaurant_1_jenis'] ?? null,
                'fasilitas_2_rb_tingkat' => $validated['hotel_restaurant_1_rb'] ?? null,
                'fasilitas_2_rs_tingkat' => $validated['hotel_restaurant_1_rs'] ?? null,
                'fasilitas_2_rr_tingkat' => $validated['hotel_restaurant_1_rr'] ?? null,
                'fasilitas_2_rb_harga' => $validated['hotel_restaurant_1_rb_harga'] ?? null,
                'fasilitas_2_rs_harga' => $validated['hotel_restaurant_1_rs_harga'] ?? null,
                'fasilitas_2_rr_harga' => $validated['hotel_restaurant_1_rr_harga'] ?? null,
                
                // Map additional tempat_wisata to fasilitas_3
                'fasilitas_3_jenis' => $validated['tempat_wisata_2_jenis'] ?? null,
                'fasilitas_3_rb_tingkat' => $validated['tempat_wisata_2_rb'] ?? null,
                'fasilitas_3_rs_tingkat' => $validated['tempat_wisata_2_rs'] ?? null,
                'fasilitas_3_rr_tingkat' => $validated['tempat_wisata_2_rr'] ?? null,
                'fasilitas_3_rb_harga' => $validated['tempat_wisata_2_rb_harga'] ?? null,
                'fasilitas_3_rs_harga' => $validated['tempat_wisata_2_rs_harga'] ?? null,
                'fasilitas_3_rr_harga' => $validated['tempat_wisata_2_rr_harga'] ?? null,
                
                // Map kerugian fields
                'kerugian_1_jenis' => $validated['kehilangan_total_pendapatan_jenis_fasilitas'] ?? null,
                'kerugian_1_rb_nilai' => is_numeric($validated['kehilangan_total_pendapatan_pendapatan_rata_rata'] ?? null) ? $validated['kehilangan_total_pendapatan_pendapatan_rata_rata'] : null,
                'kerugian_1_rs_nilai' => is_numeric($validated['kehilangan_total_pendapatan_waktu'] ?? null) ? $validated['kehilangan_total_pendapatan_waktu'] : null,
                
                'kerugian_2_jenis' => $validated['penurunan_pendapatan_jenis_fasilitas'] ?? null,
                'kerugian_2_rb_nilai' => is_numeric($validated['penurunan_pendapatan_pendapatan_rata_rata'] ?? null) ? $validated['penurunan_pendapatan_pendapatan_rata_rata'] : null,
                'kerugian_2_rs_nilai' => is_numeric($validated['penurunan_pendapatan_waktu'] ?? null) ? $validated['penurunan_pendapatan_waktu'] : null,
                
                'kerugian_3_jenis' => $validated['kenaikan_biaya_produksi_jenis_fasilitas'] ?? null,
                'kerugian_3_rb_nilai' => is_numeric($validated['kenaikan_biaya_produksi_pendapatan_rata_rata'] ?? null) ? $validated['kenaikan_biaya_produksi_pendapatan_rata_rata'] : null,
            ];
            
            // Create new form data with mapped fields
             $form = Format15Form4::create($mappedData);

            DB::commit();

            // Return success response for AJAX or redirect for regular form
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' =>  $form
                ]);
            }

            return redirect()->route('forms.form4.list-format15', ['bencana_id' =>  $form->bencana_id])
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
         $form = Format15Form4::with('bencana')->findOrFail($id);
        $bencana =  $form->bencana;
        
        // Prepare data array that matches the Blade template expectations
        $data = [
            'nama_kampung' =>  $form->nama_kampung,
            'nama_distrik' =>  $form->nama_distrik,
            
            // Map facility data to expected tourism facility names
            'penginapan_jumlah' =>  $form->fasilitas_1_rb_tingkat +  $form->fasilitas_1_rs_tingkat +  $form->fasilitas_1_rr_tingkat,
            'penginapan_harga' => ( $form->fasilitas_1_rb_harga +  $form->fasilitas_1_rs_harga +  $form->fasilitas_1_rr_harga) / 3,
            'penginapan_total' => ( $form->fasilitas_1_rb_tingkat *  $form->fasilitas_1_rb_harga) + 
                                 ( $form->fasilitas_1_rs_tingkat *  $form->fasilitas_1_rs_harga) + 
                                 ( $form->fasilitas_1_rr_tingkat *  $form->fasilitas_1_rr_harga),
            
            'restoran_jumlah' =>  $form->fasilitas_2_rb_tingkat +  $form->fasilitas_2_rs_tingkat +  $form->fasilitas_2_rr_tingkat,
            'restoran_harga' => ( $form->fasilitas_2_rb_harga +  $form->fasilitas_2_rs_harga +  $form->fasilitas_2_rr_harga) / 3,
            'restoran_total' => ( $form->fasilitas_2_rb_tingkat *  $form->fasilitas_2_rb_harga) + 
                               ( $form->fasilitas_2_rs_tingkat *  $form->fasilitas_2_rs_harga) + 
                               ( $form->fasilitas_2_rr_tingkat *  $form->fasilitas_2_rr_harga),
            
            'objek_wisata_jumlah' =>  $form->fasilitas_3_rb_tingkat +  $form->fasilitas_3_rs_tingkat +  $form->fasilitas_3_rr_tingkat,
            'objek_wisata_harga' => ( $form->fasilitas_3_rb_harga +  $form->fasilitas_3_rs_harga +  $form->fasilitas_3_rr_harga) / 3,
            'objek_wisata_total' => ( $form->fasilitas_3_rb_tingkat *  $form->fasilitas_3_rb_harga) + 
                                   ( $form->fasilitas_3_rs_tingkat *  $form->fasilitas_3_rs_harga) + 
                                   ( $form->fasilitas_3_rr_tingkat *  $form->fasilitas_3_rr_harga),
            
            // For pusat_info, we can use a default or leave empty
            'pusat_info_jumlah' => 0,
            'pusat_info_harga' => 0,
            'pusat_info_total' => 0,
            
            // Map loss data to tourism loss fields
            'jumlah_usaha_terdampak' =>  $form->kerugian_1_rb_nilai ?? 0,
            'pendapatan_harian' =>  $form->kerugian_2_rb_nilai ?? 0,
            'hari_tutup' =>  $form->kerugian_3_rb_nilai ?? 0,
            'kehilangan_wisatawan' =>  $form->kerugian_4_rb_nilai ?? 0,
        ];
        
        return view('forms.form4.format15.show-format15', compact(' form', 'bencana', 'data'));
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
        $reports = Format15Form4::where('bencana_id', $bencana_id)->get(); // No soft delete filter
        return view('forms.form4.format15.list-format15', compact('bencana', 'reports'));
    }

    /**
     * Generate PDF for a specific form data
     */
    public function generatePdf($id)
    {
         $form = Format15Form4::with('bencana')->findOrFail($id);
        $bencana =  $form->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format15.pdf', compact(' form', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->download('Format15_' .  $form->nama_kampung . '.pdf');
    }

    /**
     * Preview PDF for a specific form data
     */
    public function previewPdf($id)
    {
         $form = Format15Form4::with('bencana')->findOrFail($id);
        $bencana =  $form->bencana;
        
        $pdf = Pdf::loadView('forms.form4.format15.pdf', compact(' form', 'bencana'));
        $pdf->setPaper('A4', 'landscape');
        
        return $pdf->stream('Format15_' .  $form->nama_kampung . '.pdf');
    }

    /**
     * Show the form for editing the specified resource (Format 15)
     */
    public function edit($id)
    {
        $formPariwisata = Format15Form4::with('bencana')->findOrFail($id);
        $bencana = $formPariwisata->bencana;
        return view('forms.form4.format15.edit', compact('formPariwisata', 'bencana'));
    }

    /**
     * Update the specified resource in storage (Format 15)
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
             $form = Format15Form4::findOrFail($id);
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'kabupaten' => 'nullable|string',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Tempat Wisata (1-3)
                'tempat_wisata_1_jenis' => 'nullable|string',
                'tempat_wisata_1_rb' => 'nullable|integer',
                'tempat_wisata_1_rs' => 'nullable|integer',
                'tempat_wisata_1_rr' => 'nullable|integer',
                'tempat_wisata_1_rb_harga' => 'nullable|numeric',
                'tempat_wisata_1_rs_harga' => 'nullable|numeric',
                'tempat_wisata_1_rr_harga' => 'nullable|numeric',
                'tempat_wisata_2_jenis' => 'nullable|string',
                'tempat_wisata_2_rb' => 'nullable|integer',
                'tempat_wisata_2_rs' => 'nullable|integer',
                'tempat_wisata_2_rr' => 'nullable|integer',
                'tempat_wisata_2_rb_harga' => 'nullable|numeric',
                'tempat_wisata_2_rs_harga' => 'nullable|numeric',
                'tempat_wisata_2_rr_harga' => 'nullable|numeric',
                'tempat_wisata_3_jenis' => 'nullable|string',
                'tempat_wisata_3_rb' => 'nullable|integer',
                'tempat_wisata_3_rs' => 'nullable|integer',
                'tempat_wisata_3_rr' => 'nullable|integer',
                'tempat_wisata_3_rb_harga' => 'nullable|numeric',
                'tempat_wisata_3_rs_harga' => 'nullable|numeric',
                'tempat_wisata_3_rr_harga' => 'nullable|numeric',
                // Hotel Restaurant (1-3)
                'hotel_restaurant_1_jenis' => 'nullable|string',
                'hotel_restaurant_1_rb' => 'nullable|integer',
                'hotel_restaurant_1_rs' => 'nullable|integer',
                'hotel_restaurant_1_rr' => 'nullable|integer',
                'hotel_restaurant_1_rb_harga' => 'nullable|numeric',
                'hotel_restaurant_1_rs_harga' => 'nullable|numeric',
                'hotel_restaurant_1_rr_harga' => 'nullable|numeric',
                'hotel_restaurant_2_jenis' => 'nullable|string',
                'hotel_restaurant_2_rb' => 'nullable|integer',
                'hotel_restaurant_2_rs' => 'nullable|integer',
                'hotel_restaurant_2_rr' => 'nullable|integer',
                'hotel_restaurant_2_rb_harga' => 'nullable|numeric',
                'hotel_restaurant_2_rs_harga' => 'nullable|numeric',
                'hotel_restaurant_2_rr_harga' => 'nullable|numeric',
                'hotel_restaurant_3_jenis' => 'nullable|string',
                'hotel_restaurant_3_rb' => 'nullable|integer',
                'hotel_restaurant_3_rs' => 'nullable|integer',
                'hotel_restaurant_3_rr' => 'nullable|integer',
                'hotel_restaurant_3_rb_harga' => 'nullable|numeric',
                'hotel_restaurant_3_rs_harga' => 'nullable|numeric',
                'hotel_restaurant_3_rr_harga' => 'nullable|numeric',
                // Kerugian fields
                'kehilangan_total_pendapatan_jenis_fasilitas' => 'nullable|string',
                'kehilangan_total_pendapatan_pendapatan_rata_rata' => 'nullable|string',
                'kehilangan_total_pendapatan_waktu' => 'nullable|string',
                'penurunan_pendapatan_jenis_fasilitas' => 'nullable|string',
                'penurunan_pendapatan_pendapatan_rata_rata' => 'nullable|string',
                'penurunan_pendapatan_waktu' => 'nullable|string',
                'kenaikan_biaya_produksi_jenis_fasilitas' => 'nullable|string',
                'kenaikan_biaya_produksi_pendapatan_rata_rata' => 'nullable|string',
            ]);
            // Map form fields to model fields
            $mappedData = [
                'bencana_id' => $validated['bencana_id'],
                'kabupaten' => $validated['kabupaten'] ?? 'Papua Selatan',
                'nama_kampung' => $validated['nama_kampung'],
                'nama_distrik' => $validated['nama_distrik'],
                
                // Map tempat_wisata to fasilitas_1
                'fasilitas_1_jenis' => $validated['tempat_wisata_1_jenis'] ?? null,
                'fasilitas_1_rb_tingkat' => $validated['tempat_wisata_1_rb'] ?? null,
                'fasilitas_1_rs_tingkat' => $validated['tempat_wisata_1_rs'] ?? null,
                'fasilitas_1_rr_tingkat' => $validated['tempat_wisata_1_rr'] ?? null,
                'fasilitas_1_rb_harga' => $validated['tempat_wisata_1_rb_harga'] ?? null,
                'fasilitas_1_rs_harga' => $validated['tempat_wisata_1_rs_harga'] ?? null,
                'fasilitas_1_rr_harga' => $validated['tempat_wisata_1_rr_harga'] ?? null,
                
                // Map hotel_restaurant to fasilitas_2
                'fasilitas_2_jenis' => $validated['hotel_restaurant_1_jenis'] ?? null,
                'fasilitas_2_rb_tingkat' => $validated['hotel_restaurant_1_rb'] ?? null,
                'fasilitas_2_rs_tingkat' => $validated['hotel_restaurant_1_rs'] ?? null,
                'fasilitas_2_rr_tingkat' => $validated['hotel_restaurant_1_rr'] ?? null,
                'fasilitas_2_rb_harga' => $validated['hotel_restaurant_1_rb_harga'] ?? null,
                'fasilitas_2_rs_harga' => $validated['hotel_restaurant_1_rs_harga'] ?? null,
                'fasilitas_2_rr_harga' => $validated['hotel_restaurant_1_rr_harga'] ?? null,
                
                // Map additional tempat_wisata to fasilitas_3
                'fasilitas_3_jenis' => $validated['tempat_wisata_2_jenis'] ?? null,
                'fasilitas_3_rb_tingkat' => $validated['tempat_wisata_2_rb'] ?? null,
                'fasilitas_3_rs_tingkat' => $validated['tempat_wisata_2_rs'] ?? null,
                'fasilitas_3_rr_tingkat' => $validated['tempat_wisata_2_rr'] ?? null,
                'fasilitas_3_rb_harga' => $validated['tempat_wisata_2_rb_harga'] ?? null,
                'fasilitas_3_rs_harga' => $validated['tempat_wisata_2_rs_harga'] ?? null,
                'fasilitas_3_rr_harga' => $validated['tempat_wisata_2_rr_harga'] ?? null,
                
                // Map kerugian fields
                'kerugian_1_jenis' => $validated['kehilangan_total_pendapatan_jenis_fasilitas'] ?? null,
                'kerugian_1_rb_nilai' => is_numeric($validated['kehilangan_total_pendapatan_pendapatan_rata_rata'] ?? null) ? $validated['kehilangan_total_pendapatan_pendapatan_rata_rata'] : null,
                'kerugian_1_rs_nilai' => is_numeric($validated['kehilangan_total_pendapatan_waktu'] ?? null) ? $validated['kehilangan_total_pendapatan_waktu'] : null,
                
                'kerugian_2_jenis' => $validated['penurunan_pendapatan_jenis_fasilitas'] ?? null,
                'kerugian_2_rb_nilai' => is_numeric($validated['penurunan_pendapatan_pendapatan_rata_rata'] ?? null) ? $validated['penurunan_pendapatan_pendapatan_rata_rata'] : null,
                'kerugian_2_rs_nilai' => is_numeric($validated['penurunan_pendapatan_waktu'] ?? null) ? $validated['penurunan_pendapatan_waktu'] : null,
                
                'kerugian_3_jenis' => $validated['kenaikan_biaya_produksi_jenis_fasilitas'] ?? null,
                'kerugian_3_rb_nilai' => is_numeric($validated['kenaikan_biaya_produksi_pendapatan_rata_rata'] ?? null) ? $validated['kenaikan_biaya_produksi_pendapatan_rata_rata'] : null,
            ];
            
             $form->update($mappedData);
            DB::commit();
            return redirect()->route('forms.form4.list-format15', ['bencana_id' => $validated['bencana_id']])
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat update data. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (Format 15)
     */
    public function destroy($id)
    {
        $form = Format15Form4::findOrFail($id);
        $bencana_id = $form->bencana_id;
        $form->delete(); // Hard delete
        return redirect()->route('forms.form4.list-format15', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }
}
