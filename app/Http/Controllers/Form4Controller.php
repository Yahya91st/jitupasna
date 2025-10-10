<?php

/**
 * IMPORTANT: THIS CONTROLLER IS BEING PHASED OUT
 * 
 * This controller is being replaced by individual controllers for each format:
 * - \App\Http\Controllers\Form4\Format1Controller.php (Housing)
 * - \App\Http\Controllers\Form4\Format2Controller.php (Education)
 * - \App\Http\Controllers\Form4\Format3Controller.php (Health)
 * - \App\Http\Controllers\Form4\Format4Controller.php (Social Protection)
 * - \App\Http\Controllers\Form4\Format5Controller.php (Religious)
 * - \App\Http\Controllers\Form4\Format6Controller.php (Clean Water and Sanitation)
 * - \App\Http\Controllers\Form4\Format7Controller.php (Transportation)
 * - \App\Http\Controllers\Form4\Format8Controller.php (Electricity)
 * - \App\Http\Controllers\Form4\Format9Controller.php (Telecommunications)
 * - \App\Http\Controllers\Form4\Format10Controller.php (Agriculture)
 * - \App\Http\Controllers\Form4\Format11Controller.php (Livestock)
 * - \App\Http\Controllers\Form4\Format12Controller.php (Fishery)
 * - \App\Http\Controllers\Form4\Format13Controller.php (Industry)
 * - \App\Http\Controllers\Form4\Format14Controller.php (Commerce)
 * - \App\Http\Controllers\Form4\Format15Controller.php (Tourism)
 * - \App\Http\Controllers\Form4\Format16Controller.php (Government)
 * - \App\Http\Controllers\Form4\Format17Controller.php (Environment)
 * 
 * Please use the new controllers for all new development.
 * This controller is maintained temporarily for backwards compatibility.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\FormPerumahan;
use App\Models\EnvironmentalReport;
use App\Models\GovernmentReport;
use App\Models\ form;
use App\Models\Format10Form4;
use App\Models\Format11Form4;
use App\Models\Format12Form4;
use App\Models\Format13Form4;
use App\Models\Format14Form4;
use App\Models\Format15Form4;
use App\Models\Format16Form4;
use App\Models\Format17Form4;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPdf;

class Form4Controller extends Controller
{
    public function index(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4', compact('bencana'));
    }

    public function format1form4(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format1.format1form4', compact('bencana'));
    }
    
    public function format17form4(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format17.format17form4', compact('bencana'));
    }

    public function format4form4(Request $request)
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

    public function format5form4(Request $request)
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
     * Display the Format 6 form
     */
    public function format6form4(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format6.format6form4', compact('bencana'));
    }

    public function format7form4(Request $request)
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

    public function format2form4(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format2.format2form4', compact('bencana'));
    }

    public function format16form4(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        // Get existing government reports for this bencana
        $governmentReports = GovernmentReport::where('bencana_id', $bencana_id)->get();
        
        return view('forms.form4.format16.format16form4', compact('bencana', 'governmentReports'));
    }
    
    /**
     * Display the Format 3 form for Health Sector data collection
     */
    public function format3form4(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format3.format3form3', compact('bencana'));
    }

    /**
     * Display the Format 8 form
     */
    public function format8form4(Request $request)
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

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                'rumah_hancur_total_permanen' => 'nullable|integer',
                'rumah_hancur_total_non_permanen' => 'nullable|integer',
                'rumah_rusak_berat_permanen' => 'nullable|integer',
                'rumah_rusak_berat_non_permanen' => 'nullable|integer',
                'rumah_rusak_sedang_permanen' => 'nullable|integer',
                'rumah_rusak_sedang_non_permanen' => 'nullable|integer',
                'rumah_rusak_ringan_permanen' => 'nullable|integer',
                'rumah_rusak_ringan_non_permanen' => 'nullable|integer',
                'harga_satuan_permanen' => 'nullable|numeric',
                'harga_satuan_non_permanen' => 'nullable|numeric',
                'jalan_rusak_berat' => 'nullable|numeric',
                'jalan_rusak_sedang' => 'nullable|numeric',
                'jalan_rusak_ringan' => 'nullable|numeric',
                'harga_satuan_jalan' => 'nullable|numeric',
                'saluran_rusak_berat' => 'nullable|numeric',
                'saluran_rusak_sedang' => 'nullable|numeric',
                'saluran_rusak_ringan' => 'nullable|numeric',
                'harga_satuan_saluran' => 'nullable|numeric',
                'balai_rusak_berat' => 'nullable|integer',
                'balai_rusak_sedang' => 'nullable|integer',
                'harga_satuan_balai' => 'nullable|numeric',
                'tenaga_kerja_hok' => 'nullable|integer',
                'upah_harian' => 'nullable|numeric',
                'alat_berat_hari' => 'nullable|integer',
                'biaya_per_hari' => 'nullable|numeric',
                'harga_sewa_per_bulan' => 'nullable|numeric',
                'jumlah_tenda' => 'nullable|integer',
                'harga_tenda' => 'nullable|numeric',
                'jumlah_barak' => 'nullable|integer',
                'harga_barak' => 'nullable|numeric',
                'jumlah_rumah_sementara' => 'nullable|integer',
                'harga_rumah_sementara' => 'nullable|numeric',
                'bencana_id' => 'nullable|exists:bencana,id'
            ]);

            // Create new form data
            $formPerumahan = FormPerumahan::create($validated);

            DB::commit();

            // Redirect to show page where user can see data and download PDF
            return redirect()->route('forms.form4.show-format1', $formPerumahan->id)
                ->with('success', 'Data berhasil disimpan. Anda dapat mengunduh PDF data ini.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Store format17 form data
     */
    public function storeFormat17(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                
                // Damage validation
                'darat_jenis_kerusakan.*' => 'nullable|string',
                'darat_rb.*' => 'nullable|integer',
                'darat_rs.*' => 'nullable|integer',
                'darat_rr.*' => 'nullable|integer',
                'darat_harga_rb.*' => 'nullable|numeric',
                'darat_harga_rs.*' => 'nullable|numeric',
                'darat_harga_rr.*' => 'nullable|numeric',
                
                'laut_jenis_kerusakan.*' => 'nullable|string',
                'laut_rb.*' => 'nullable|integer',
                'laut_rs.*' => 'nullable|integer',
                'laut_rr.*' => 'nullable|integer',
                'laut_harga_rb.*' => 'nullable|numeric',
                'laut_harga_rs.*' => 'nullable|numeric',
                'laut_harga_rr.*' => 'nullable|numeric',
                
                'udara_jenis_kerusakan.*' => 'nullable|string',
                'udara_rb.*' => 'nullable|integer',
                'udara_rs.*' => 'nullable|integer',
                'udara_rr.*' => 'nullable|integer',
                'udara_harga_rb.*' => 'nullable|numeric',
                'udara_harga_rs.*' => 'nullable|numeric',
                'udara_harga_rr.*' => 'nullable|numeric',
                
                // Loss validation - updated field names
                'jasa_jenis_kerugian.*' => 'nullable|string',
                'jasa_dasar_perhitungan.*' => 'nullable|string',
                'jasa_rb.*' => 'nullable|integer',
                'jasa_rs.*' => 'nullable|integer',
                'jasa_rr.*' => 'nullable|integer',
                'jasa_harga_rb.*' => 'nullable|numeric',
                'jasa_harga_rs.*' => 'nullable|numeric',
                'jasa_harga_rr.*' => 'nullable|numeric',
                
                'air_jenis_kerugian.*' => 'nullable|string',
                'air_dasar_perhitungan.*' => 'nullable|string',
                'air_rb.*' => 'nullable|integer',
                'air_rs.*' => 'nullable|integer',
                'air_rr.*' => 'nullable|integer',
                'air_harga_rb.*' => 'nullable|numeric',
                'air_harga_rs.*' => 'nullable|numeric',
                'air_harga_rr.*' => 'nullable|numeric',
                
                'udara_jenis_kerugian.*' => 'nullable|string',
                'udara_dasar_perhitungan.*' => 'nullable|string',
            ]);
            
            $bencana_id = $request->bencana_id;
            
            // Store bencana_id in session for compatibility
            session(['bencana_id' => $bencana_id]);
            
            // Process Ekosistem Darat data
            if ($request->has('darat_jenis_kerusakan')) {
                foreach ($request->darat_jenis_kerusakan as $key => $jenis) {
                    if (!empty($jenis)) {
                        EnvironmentalReport::create([
                            'bencana_id' => $bencana_id,
                            'report_type' => 'damage',
                            'ekosistem' => 'darat',
                            'jenis_kerusakan' => $jenis,
                            'rb' => $request->darat_rb[$key] ?? 0,
                            'rs' => $request->darat_rs[$key] ?? 0,
                            'rr' => $request->darat_rr[$key] ?? 0,
                            'harga_rb' => $request->darat_harga_rb[$key] ?? 0,
                            'harga_rs' => $request->darat_harga_rs[$key] ?? 0,
                            'harga_rr' => $request->darat_harga_rr[$key] ?? 0,
                        ]);
                    }
                }
            }
            
            // Process Ekosistem Laut data
            if ($request->has('laut_jenis_kerusakan')) {
                foreach ($request->laut_jenis_kerusakan as $key => $jenis) {
                    if (!empty($jenis)) {
                        EnvironmentalReport::create([
                            'bencana_id' => $bencana_id,
                            'report_type' => 'damage',
                            'ekosistem' => 'laut',
                            'jenis_kerusakan' => $jenis,
                            'rb' => $request->laut_rb[$key] ?? 0,
                            'rs' => $request->laut_rs[$key] ?? 0,
                            'rr' => $request->laut_rr[$key] ?? 0,
                            'harga_rb' => $request->laut_harga_rb[$key] ?? 0,
                            'harga_rs' => $request->laut_harga_rs[$key] ?? 0,
                            'harga_rr' => $request->laut_harga_rr[$key] ?? 0,
                        ]);
                    }
                }
            }
            
            // Process Ekosistem Udara data
            if ($request->has('udara_jenis_kerusakan')) {
                foreach ($request->udara_jenis_kerusakan as $key => $jenis) {
                    if (!empty($jenis)) {
                        EnvironmentalReport::create([
                            'bencana_id' => $bencana_id,
                            'report_type' => 'damage',
                            'ekosistem' => 'udara',
                            'jenis_kerusakan' => $jenis,
                            'rb' => $request->udara_rb[$key] ?? 0,
                            'rs' => $request->udara_rs[$key] ?? 0,
                            'rr' => $request->udara_rr[$key] ?? 0,
                            'harga_rb' => $request->udara_harga_rb[$key] ?? 0,
                            'harga_rs' => $request->udara_harga_rs[$key] ?? 0,
                            'harga_rr' => $request->udara_harga_rr[$key] ?? 0,
                        ]);
                    }
                }
            }
            
            // Process Jasa Lingkungan data
            if ($request->has('jasa_jenis_kerugian')) {
                foreach ($request->jasa_jenis_kerugian as $key => $kerugian) {
                    if (!empty($kerugian)) {
                        EnvironmentalReport::create([
                            'bencana_id' => $bencana_id,
                            'report_type' => 'loss',
                            'jenis_kerugian' => 'kehilangan_jasa_lingkungan',
                            'jenis' => $kerugian,
                            'dasar_perhitungan' => $request->jasa_dasar_perhitungan[$key] ?? '',
                            'rb' => $request->jasa_rb[$key] ?? 0,
                            'rs' => $request->jasa_rs[$key] ?? 0,
                            'rr' => $request->jasa_rr[$key] ?? 0,
                            'harga_rb' => $request->jasa_harga_rb[$key] ?? 0,
                            'harga_rs' => $request->jasa_harga_rs[$key] ?? 0,
                            'harga_rr' => $request->jasa_harga_rr[$key] ?? 0,
                        ]);
                    }
                }
            }
            
            // Process Pencemaran Air data
            if ($request->has('air_jenis_kerugian')) {
                foreach ($request->air_jenis_kerugian as $key => $kerugian) {
                    if (!empty($kerugian)) {
                        EnvironmentalReport::create([
                            'bencana_id' => $bencana_id,
                            'report_type' => 'loss',
                            'jenis_kerugian' => 'pencemaran_air',
                            'jenis' => $kerugian,
                            'dasar_perhitungan' => $request->air_dasar_perhitungan[$key] ?? '',
                            'rb' => $request->air_rb[$key] ?? 0,
                            'rs' => $request->air_rs[$key] ?? 0,
                            'rr' => $request->air_rr[$key] ?? 0,
                            'harga_rb' => $request->air_harga_rb[$key] ?? 0,
                            'harga_rs' => $request->air_harga_rs[$key] ?? 0,
                            'harga_rr' => $request->air_harga_rr[$key] ?? 0,
                        ]);
                    }
                }
            }
            
            // Process Pencemaran Udara data
            if ($request->has('udara_jenis_kerugian')) {
                foreach ($request->udara_jenis_kerugian as $key => $kerugian) {
                    if (!empty($kerugian)) {
                        EnvironmentalReport::create([
                            'bencana_id' => $bencana_id,
                            'report_type' => 'loss',
                            'jenis_kerugian' => 'pencemaran_udara',
                            'jenis' => $kerugian,
                            'dasar_perhitungan' => $request->udara_dasar_perhitungan[$key] ?? '',
                            'rb' => $request->udara_rb[$key] ?? 0,
                            'rs' => $request->udara_rs[$key] ?? 0,
                            'rr' => $request->udara_rr[$key] ?? 0,
                            'harga_rb' => $request->udara_harga_rb[$key] ?? 0,
                            'harga_rs' => $request->udara_harga_rs[$key] ?? 0,
                            'harga_rr' => $request->udara_harga_rr[$key] ?? 0,
                        ]);
                    }
                }
            }
            
            DB::commit();
            
            // Redirect to show page where user can see the submitted data
            return redirect()->route('forms.form4.show-format17', $request->bencana_id)
                ->with('success', 'Data Format 17 Lingkungan Hidup berhasil disimpan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Store format2 form data for Education sector
     */
    public function storeFormat2(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string|max:255',
                'nama_distrik' => 'required|string|max:255',
                
                // Data sekolah
                'tk_berat_negeri' => 'nullable|integer',
                'tk_berat_swasta' => 'nullable|integer',
                'tk_sedang_negeri' => 'nullable|integer',
                'tk_sedang_swasta' => 'nullable|integer',
                'tk_ringan_negeri' => 'nullable|integer',
                'tk_ringan_swasta' => 'nullable|integer',
                'tk_ukuran' => 'nullable|integer',
                'tk_harga_bangunan' => 'nullable|integer',
                'tk_harga_peralatan' => 'nullable|integer',
                'tk_harga_meubelair' => 'nullable|integer',
                
                'sd_berat_negeri' => 'nullable|integer',
                'sd_berat_swasta' => 'nullable|integer',
                'sd_sedang_negeri' => 'nullable|integer',
                'sd_sedang_swasta' => 'nullable|integer',
                'sd_ringan_negeri' => 'nullable|integer',
                'sd_ringan_swasta' => 'nullable|integer',
                'sd_ukuran' => 'nullable|integer',
                'sd_harga_bangunan' => 'nullable|integer',
                'sd_harga_peralatan' => 'nullable|integer',
                'sd_harga_meubelair' => 'nullable|integer',
                
                'smp_berat_negeri' => 'nullable|integer',
                'smp_berat_swasta' => 'nullable|integer',
                'smp_sedang_negeri' => 'nullable|integer',
                'smp_sedang_swasta' => 'nullable|integer',
                'smp_ringan_negeri' => 'nullable|integer',
                'smp_ringan_swasta' => 'nullable|integer',
                'smp_ukuran' => 'nullable|integer',
                'smp_harga_bangunan' => 'nullable|integer',
                'smp_harga_peralatan' => 'nullable|integer',
                'smp_harga_meubelair' => 'nullable|integer',
                
                'sma_berat_negeri' => 'nullable|integer',
                'sma_berat_swasta' => 'nullable|integer',
                'sma_sedang_negeri' => 'nullable|integer',
                'sma_sedang_swasta' => 'nullable|integer',
                'sma_ringan_negeri' => 'nullable|integer',
                'sma_ringan_swasta' => 'nullable|integer',
                'sma_ukuran' => 'nullable|integer',
                'sma_harga_bangunan' => 'nullable|integer',
                'sma_harga_peralatan' => 'nullable|integer',
                'sma_harga_meubelair' => 'nullable|integer',
                
                // Data kerugian
                'biaya_tenaga_kerja_hok' => 'nullable|integer',
                'biaya_tenaga_kerja_upah' => 'nullable|integer',
                'biaya_alat_berat_hari' => 'nullable|integer',
                'biaya_alat_berat_harga' => 'nullable|integer',
                'sekolah_pengungsian' => 'nullable|integer',
                'guru_korban' => 'nullable|integer',
                'iuran_sekolah' => 'nullable|integer',
                'jumlah_sekolah_sementara' => 'nullable|integer',
                'harga_sekolah_sementara' => 'nullable|integer'
            ]);
            
            $bencana_id = $request->bencana_id;
            
            // Create a new education report record
            $report = \App\Models\EducationReport::create([
                'bencana_id' => $bencana_id,
                'nama_kampung' => $request->nama_kampung,
                'nama_distrik' => $request->nama_distrik,
                'data' => json_encode($request->except(['_token', 'bencana_id', 'nama_kampung', 'nama_distrik'])),
            ]);
            
            DB::commit();            
            // Redirect to show page where user can see the submitted data
            return redirect()->route('forms.form4.show-format2', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Format 2 Sektor Pendidikan berhasil disimpan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Store format7 form data for Transportation sector
     */
    public function storeFormat7(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                
                // Jalan (Road)
                'jalan_ruas.*' => 'nullable|string|max:255',
                'jalan_jenis_status.*' => 'nullable|string|in:Nasional,Kabupaten,Kota,Desa',
                'jalan_jenis_material.*' => 'nullable|string|in:Aspal,Batu,Tanah',
                'jalan_kerusakan_berat.*' => 'nullable|numeric',
                'jalan_kerusakan_sedang.*' => 'nullable|numeric',
                'jalan_kerusakan_ringan.*' => 'nullable|numeric',
                'jalan_harga_satuan.*' => 'nullable|numeric',
                'jalan_biaya_perbaikan.*' => 'nullable|numeric',
                
                // Jembatan (Bridge)
                'jembatan_nama.*' => 'nullable|string|max:255',
                'jembatan_jenis_status.*' => 'nullable|string|in:Nasional,Kabupaten,Kota,Desa',
                'jembatan_jenis_material.*' => 'nullable|string|in:Beton,Baja,Kayu',
                'jembatan_kerusakan_berat.*' => 'nullable|numeric',
                'jembatan_kerusakan_sedang.*' => 'nullable|numeric',
                'jembatan_kerusakan_ringan.*' => 'nullable|numeric',
                'jembatan_harga_satuan.*' => 'nullable|numeric',
                'jembatan_biaya_perbaikan.*' => 'nullable|numeric',
                
                // Kendaraan (Vehicle)
                'kendaraan_jenis.*' => 'nullable|string|max:255',
                'kendaraan_moda.*' => 'nullable|string|in:Darat,Laut,Udara',
                'kendaraan_rusak_berat.*' => 'nullable|numeric',
                'kendaraan_rusak_sedang.*' => 'nullable|numeric',
                'kendaraan_rusak_ringan.*' => 'nullable|numeric',
                'kendaraan_harga_satuan.*' => 'nullable|numeric',
                'kendaraan_biaya_kerusakan.*' => 'nullable|numeric',
                
                // Prasarana (Infrastructure)
                'prasarana_jenis.*' => 'nullable|string|max:255',
                'prasarana_tipe.*' => 'nullable|string|max:255',
                'prasarana_luas.*' => 'nullable|numeric',
                'prasarana_rusak_berat.*' => 'nullable|numeric',
                'prasarana_rusak_sedang.*' => 'nullable|numeric',
                'prasarana_rusak_ringan.*' => 'nullable|numeric',
                'prasarana_harga_satuan.*' => 'nullable|numeric',
                'prasarana_biaya_kerusakan.*' => 'nullable|numeric',
                
                // Pendapatan (Revenue loss)
                'pendapatan_jenis.*' => 'nullable|string|max:255',
                'pendapatan_per_hari.*' => 'nullable|numeric',
                'pendapatan_jumlah_terdampak.*' => 'nullable|integer',
                'pendapatan_jumlah_hari.*' => 'nullable|integer',
                'pendapatan_total_kehilangan.*' => 'nullable|numeric',
                
                // Operasional (Operational costs)
                'operasional_jenis_kendaraan.*' => 'nullable|string|max:255',
                'operasional_biaya_sebelum.*' => 'nullable|numeric',
                'operasional_biaya_sesudah.*' => 'nullable|numeric',
                'operasional_jumlah_kendaraan.*' => 'nullable|integer',
                'operasional_jarak_tempuh.*' => 'nullable|numeric',
                'operasional_durasi.*' => 'nullable|integer',
                'operasional_total_kenaikan.*' => 'nullable|numeric',
                
                // Infrastruktur Darurat (Emergency infrastructure)
                'infrastruktur_jenis.*' => 'nullable|string|max:255',
                'infrastruktur_jumlah_unit.*' => 'nullable|integer',
                'infrastruktur_biaya_per_unit.*' => 'nullable|numeric',
                'infrastruktur_total_biaya.*' => 'nullable|numeric',
            ]);
            
            $bencana_id = $request->bencana_id;
            
            // Process road (jalan) data
            if ($request->has('jalan_ruas')) {
                foreach ($request->jalan_ruas as $key => $ruas) {
                    if (!empty($ruas)) {
                        \App\Models\TransportationReport::create([
                            'bencana_id' => $bencana_id,
                            'report_type' => 'jalan',
                            'ruas_jalan' => $ruas,
                            'status_jalan' => $request->jalan_jenis_status[$key] ?? null,
                            'jenis_jalan' => $request->jalan_jenis_material[$key] ?? null,
                            'rusak_berat' => $request->jalan_kerusakan_berat[$key] ?? 0,
                            'rusak_sedang' => $request->jalan_kerusakan_sedang[$key] ?? 0,
                            'rusak_ringan' => $request->jalan_kerusakan_ringan[$key] ?? 0,
                            'harga_satuan' => $request->jalan_harga_satuan[$key] ?? 0,
                            'biaya_total' => $request->jalan_biaya_perbaikan[$key] ?? 0,
                        ]);
                    }
                }
            }
            
            // Process bridge (jembatan) data
            if ($request->has('jembatan_nama')) {
                foreach ($request->jembatan_nama as $key => $nama) {
                    if (!empty($nama)) {
                        \App\Models\TransportationReport::create([
                            'bencana_id' => $bencana_id,
                            'report_type' => 'jembatan',
                            'nama_jembatan' => $nama,
                            'status_jembatan' => $request->jembatan_jenis_status[$key] ?? null,
                            'jenis_jembatan' => $request->jembatan_jenis_material[$key] ?? null,
                            'rusak_berat' => $request->jembatan_kerusakan_berat[$key] ?? 0,
                            'rusak_sedang' => $request->jembatan_kerusakan_sedang[$key] ?? 0,
                            'rusak_ringan' => $request->jembatan_kerusakan_ringan[$key] ?? 0,
                            'harga_satuan' => $request->jembatan_harga_satuan[$key] ?? 0,
                            'biaya_total' => $request->jembatan_biaya_perbaikan[$key] ?? 0,
                        ]);
                    }
                }
            }
            
            // Process vehicle (kendaraan) data
            if ($request->has('kendaraan_jenis')) {
                foreach ($request->kendaraan_jenis as $key => $jenis) {
                    if (!empty($jenis)) {
                        \App\Models\TransportationReport::create([
                            'bencana_id' => $bencana_id,
                            'report_type' => 'kendaraan',
                            'jenis_kendaraan' => $jenis,
                            'moda' => $request->kendaraan_moda[$key] ?? null,
                            'rusak_berat' => $request->kendaraan_rusak_berat[$key] ?? 0,
                            'rusak_sedang' => $request->kendaraan_rusak_sedang[$key] ?? 0,
                            'rusak_ringan' => $request->kendaraan_rusak_ringan[$key] ?? 0,
                            'harga_satuan' => $request->kendaraan_harga_satuan[$key] ?? 0,
                            'biaya_total' => $request->kendaraan_biaya_kerusakan[$key] ?? 0,
                        ]);
                    }
                }
            }
            
            // Process infrastructure (prasarana) data
            if ($request->has('prasarana_jenis')) {
                foreach ($request->prasarana_jenis as $key => $jenis) {
                    if (!empty($jenis)) {
                        \App\Models\TransportationReport::create([
                            'bencana_id' => $bencana_id,
                            'report_type' => 'prasarana',
                            'jenis_prasarana' => $jenis,
                            'tipe_prasarana' => $request->prasarana_tipe[$key] ?? null,
                            'luas_prasarana' => $request->prasarana_luas[$key] ?? 0,
                            'rusak_berat' => $request->prasarana_rusak_berat[$key] ?? 0,
                            'rusak_sedang' => $request->prasarana_rusak_sedang[$key] ?? 0,
                            'rusak_ringan' => $request->prasarana_rusak_ringan[$key] ?? 0,
                            'harga_satuan' => $request->prasarana_harga_satuan[$key] ?? 0,
                            'biaya_total' => $request->prasarana_biaya_kerusakan[$key] ?? 0,
                        ]);
                    }
                }
            }
            
            // Process revenue loss (pendapatan) data
            if ($request->has('pendapatan_jenis')) {
                foreach ($request->pendapatan_jenis as $key => $jenis) {
                    if (!empty($jenis)) {
                        \App\Models\TransportationReport::create([
                            'bencana_id' => $bencana_id,
                            'report_type' => 'pendapatan',
                            'jenis_kendaraan' => $jenis, // Reusing field for jenis pendapatan
                            'pendapatan_per_hari' => $request->pendapatan_per_hari[$key] ?? 0,
                            'jumlah_terdampak' => $request->pendapatan_jumlah_terdampak[$key] ?? 0,
                            'jumlah_hari' => $request->pendapatan_jumlah_hari[$key] ?? 0,
                            'biaya_total' => $request->pendapatan_total_kehilangan[$key] ?? 0,
                        ]);
                    }
                }
            }
            
            // Process operational cost (operasional) data
            if ($request->has('operasional_jenis_kendaraan')) {
                foreach ($request->operasional_jenis_kendaraan as $key => $jenis) {
                    if (!empty($jenis)) {
                        \App\Models\TransportationReport::create([
                            'bencana_id' => $bencana_id,
                            'report_type' => 'operasional',
                            'jenis_kendaraan' => $jenis,
                            'biaya_sebelum' => $request->operasional_biaya_sebelum[$key] ?? 0,
                            'biaya_sesudah' => $request->operasional_biaya_sesudah[$key] ?? 0,
                            'jumlah_kendaraan' => $request->operasional_jumlah_kendaraan[$key] ?? 0,
                            'jarak_tempuh' => $request->operasional_jarak_tempuh[$key] ?? 0,
                            'durasi' => $request->operasional_durasi[$key] ?? 0,
                            'biaya_total' => $request->operasional_total_kenaikan[$key] ?? 0,
                        ]);
                    }
                }
            }
            
            // Process emergency infrastructure (infrastruktur darurat) data
            if ($request->has('infrastruktur_jenis')) {
                foreach ($request->infrastruktur_jenis as $key => $jenis) {
                    if (!empty($jenis)) {
                        \App\Models\TransportationReport::create([
                            'bencana_id' => $bencana_id,
                            'report_type' => 'infrastruktur_darurat',
                            'jenis_infrastruktur_darurat' => $jenis,
                            'jumlah_unit' => $request->infrastruktur_jumlah_unit[$key] ?? 0,
                            'biaya_per_unit' => $request->infrastruktur_biaya_per_unit[$key] ?? 0,
                            'biaya_total' => $request->infrastruktur_total_biaya[$key] ?? 0,
                        ]);
                    }
                }
            }
            
            DB::commit();
            
            // Redirect back to the form4 page with the bencana_id
            return redirect()->route('forms.form4.index', ['bencana_id' => $request->bencana_id])
                ->with('success', 'Data Format 7 Sektor Transportasi berhasil disimpan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Store format16 form data
     */
    public function storeFormat16(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'tenaga_kerja_hok' => 'nullable|integer',
                'upah_harian' => 'nullable|numeric',
                'alat_berat_hari' => 'nullable|integer',
                'biaya_per_hari_alat_berat' => 'nullable|numeric',
                'jumlah_unit' => 'nullable|integer',
                'biaya_sewa_per_unit' => 'nullable|numeric',
                'jumlah_arsip' => 'nullable|integer',
                'harga_satuan' => 'nullable|numeric',
                'dasar_perhitungan' => 'nullable|string',
            ]);
            
            $bencana_id = $request->bencana_id;
            
            // Process Fasilitas Pemerintahan data
            if ($request->has('jenis_fasilitas')) {
                foreach ($request->jenis_fasilitas as $key => $jenis) {
                    if (!empty($jenis)) {
                        // Create a combined record for each facility with damage data
                        GovernmentReport::create([
                            'bencana_id' => $bencana_id,
                            'jenis_fasilitas' => $jenis,
                            'jumlah_rb' => $request->jumlah_rb[$key] ?? 0,
                            'jumlah_rs' => $request->jumlah_rs[$key] ?? 0,
                            'jumlah_rr' => $request->jumlah_rr[$key] ?? 0,
                            'harga_rb' => $request->harga_rb[$key] ?? 0,
                            'harga_rs' => $request->harga_rs[$key] ?? 0,
                            'harga_rr' => $request->harga_rr[$key] ?? 0,
                            // Loss fields default to null
                            'tenaga_kerja_hok' => null,
                            'upah_harian' => null,
                            'alat_berat_hari' => null, 
                            'biaya_per_hari_alat_berat' => null,
                            'jumlah_unit' => null,
                            'biaya_sewa_per_unit' => null,
                            'jumlah_arsip' => null,
                            'harga_satuan' => null,
                            'dasar_perhitungan' => null,
                        ]);
                    }
                }
            }
            
            // Save Government Loss data in a separate entry
            // This creates one entry without facility details but with loss information
            GovernmentReport::create([
                'bencana_id' => $bencana_id,
                // Damage fields default to null or empty
                'jenis_fasilitas' => 'Kerugian Lainnya',
                'jumlah_rb' => null,
                'jumlah_rs' => null,
                'jumlah_rr' => null,
                'harga_rb' => null,
                'harga_rs' => null,
                'harga_rr' => null,
                // Loss data
                'tenaga_kerja_hok' => $request->tenaga_kerja_hok,
                'upah_harian' => $request->upah_harian,
                'alat_berat_hari' => $request->alat_berat_hari,
                'biaya_per_hari_alat_berat' => $request->biaya_per_hari_alat_berat,
                'jumlah_unit' => $request->jumlah_unit,
                'biaya_sewa_per_unit' => $request->biaya_sewa_per_unit,
                'jumlah_arsip' => $request->jumlah_arsip,
                'harga_satuan' => $request->harga_satuan,
                'dasar_perhitungan' => $request->dasar_perhitungan,
            ]);
            
            DB::commit();
            
            // Redirect back to the form4 page with the bencana_id
            return redirect()->route('forms.form4.index', ['bencana_id' => $request->bencana_id])
                ->with('success', 'Data Format 16 Sektor Pemerintahan berhasil disimpan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Show a specific form data
     */
    public function showFormat1($id)
    {
        $formPerumahan = FormPerumahan::with('bencana')->findOrFail($id);
        $bencana = $formPerumahan->bencana;
        
        return view('forms.form4.format1.show-format1', compact('formPerumahan', 'bencana'));
    }

    /**
     * Show Format 9 (Telecommunications sector) data
     */
    public function showFormat9($id)
    {
        $formTelekomunikasi = \App\Models\Format9Form4::with('bencana')->findOrFail($id);
        $bencana = $formTelekomunikasi->bencana;
        
        return view('forms.form4.format9.show-format9', compact('formTelekomunikasi', 'bencana'));
    }

    /**
     * List Format 9 (Telecommunications sector) data
     */
    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        $forms = \App\Models\Format9Form4::when($bencana_id, function($query) use ($bencana_id) {
            return $query->where('bencana_id', $bencana_id);
        })->with('bencana')->latest()->paginate(10);
        
        return view('forms.form4.format9.list-format9', compact('forms', 'bencana_id'));
    }

    /**
     * Generate PDF for form data
     */ 
    public function generatePdf($id)
    {
        $formPerumahan = FormPerumahan::with('bencana.kategori_bencana', 'bencana.desa')->findOrFail($id);
        $bencana = $formPerumahan->bencana;
        
        // Calculate totals
        $totalRumahPermanen = (int)$formPerumahan->rumah_hancur_total_permanen + 
                             (int)$formPerumahan->rumah_rusak_berat_permanen + 
                             (int)$formPerumahan->rumah_rusak_sedang_permanen + 
                             (int)$formPerumahan->rumah_rusak_ringan_permanen;
        
        $totalRumahNonPermanen = (int)$formPerumahan->rumah_hancur_total_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_berat_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_sedang_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_ringan_non_permanen;
        
        $totalJalanRusak = (float)$formPerumahan->jalan_rusak_berat + 
                          (float)$formPerumahan->jalan_rusak_sedang + 
                          (float)$formPerumahan->jalan_rusak_ringan;
        
        $totalSaluranRusak = (float)$formPerumahan->saluran_rusak_berat + 
                            (float)$formPerumahan->saluran_rusak_sedang + 
                            (float)$formPerumahan->saluran_rusak_ringan;
        
        $totalBalaiRusak = (int)$formPerumahan->balai_rusak_berat + 
                          (int)$formPerumahan->balai_rusak_sedang;
        
        // Calculate estimated costs
        $biayaRumahPermanen = $totalRumahPermanen * (float)$formPerumahan->harga_satuan_permanen;
        $biayaRumahNonPermanen = $totalRumahNonPermanen * (float)$formPerumahan->harga_satuan_non_permanen;
        $biayaJalan = $totalJalanRusak * (float)$formPerumahan->harga_satuan_jalan;
        $biayaSaluran = $totalSaluranRusak * (float)$formPerumahan->harga_satuan_saluran;
        $biayaBalai = $totalBalaiRusak * (float)$formPerumahan->harga_satuan_balai;
        
        $biayaHOK = (int)$formPerumahan->tenaga_kerja_hok * (float)$formPerumahan->upah_harian;
        $biayaAlatBerat = (int)$formPerumahan->alat_berat_hari * (float)$formPerumahan->biaya_per_hari;
        $biayaTenda = (int)$formPerumahan->jumlah_tenda * (float)$formPerumahan->harga_tenda;
        $biayaBarak = (int)$formPerumahan->jumlah_barak * (float)$formPerumahan->harga_barak;
        $biayaRumahSementara = (int)$formPerumahan->jumlah_rumah_sementara * (float)$formPerumahan->harga_rumah_sementara;
        
        $totalBiayaKerusakan = $biayaRumahPermanen + $biayaRumahNonPermanen + $biayaJalan + $biayaSaluran + $biayaBalai;
        $totalBiayaKerugian = $biayaHOK + $biayaAlatBerat + (float)$formPerumahan->harga_sewa_per_bulan + $biayaTenda + $biayaBarak + $biayaRumahSementara;
        $totalKeseluruhanBiaya = $totalBiayaKerusakan + $totalBiayaKerugian;
        
        $data = [
            'formPerumahan' => $formPerumahan,
            'bencana' => $bencana,
            'totalRumahPermanen' => $totalRumahPermanen,
            'totalRumahNonPermanen' => $totalRumahNonPermanen,
            'totalJalanRusak' => $totalJalanRusak,
            'totalSaluranRusak' => $totalSaluranRusak,
            'totalBalaiRusak' => $totalBalaiRusak,
            'biayaRumahPermanen' => $biayaRumahPermanen,
            'biayaRumahNonPermanen' => $biayaRumahNonPermanen,
            'biayaJalan' => $biayaJalan,
            'biayaSaluran' => $biayaSaluran,
            'biayaBalai' => $biayaBalai,
            'biayaHOK' => $biayaHOK,
            'biayaAlatBerat' => $biayaAlatBerat,
            'biayaTenda' => $biayaTenda,
            'biayaBarak' => $biayaBarak,
            'biayaRumahSementara' => $biayaRumahSementara,
            'totalBiayaKerusakan' => $totalBiayaKerusakan,
            'totalBiayaKerugian' => $totalBiayaKerugian,
            'totalKeseluruhanBiaya' => $totalKeseluruhanBiaya,
            'tanggal' => date('d-m-Y'),
        ];
        
        // Load view dengan DomPdf dan atur landscape
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format1.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('FormPerumahan_' . $formPerumahan->id . '.pdf');
    }

    /**
     * List all form data for a bencana
     */
    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::findOrFail($bencana_id);
         $form = FormPerumahan::where('bencana_id', $bencana_id)->latest()->get();
        
        return view('forms.form4.format1.format1list', compact('bencana', ' form'));
    }

    /**
     * Preview PDF tanpa download
     */
    public function previewPdf($id)
    {
        $formPerumahan = FormPerumahan::with('bencana.kategori_bencana', 'bencana.desa')->findOrFail($id);
        $bencana = $formPerumahan->bencana;
        
        // Calculate totals
        $totalRumahPermanen = (int)$formPerumahan->rumah_hancur_total_permanen + 
                             (int)$formPerumahan->rumah_rusak_berat_permanen + 
                             (int)$formPerumahan->rumah_rusak_sedang_permanen + 
                             (int)$formPerumahan->rumah_rusak_ringan_permanen;
        
        $totalRumahNonPermanen = (int)$formPerumahan->rumah_hancur_total_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_berat_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_sedang_non_permanen + 
                                (int)$formPerumahan->rumah_rusak_ringan_non_permanen;
        
        $totalJalanRusak = (float)$formPerumahan->jalan_rusak_berat + 
                          (float)$formPerumahan->jalan_rusak_sedang + 
                          (float)$formPerumahan->jalan_rusak_ringan;
        
        $totalSaluranRusak = (float)$formPerumahan->saluran_rusak_berat + 
                            (float)$formPerumahan->saluran_rusak_sedang + 
                            (float)$formPerumahan->saluran_rusak_ringan;
        
        $totalBalaiRusak = (int)$formPerumahan->balai_rusak_berat + 
                          (int)$formPerumahan->balai_rusak_sedang;
        
        // Calculate estimated costs
        $biayaRumahPermanen = $totalRumahPermanen * (float)$formPerumahan->harga_satuan_permanen;
        $biayaRumahNonPermanen = $totalRumahNonPermanen * (float)$formPerumahan->harga_satuan_non_permanen;
        $biayaJalan = $totalJalanRusak * (float)$formPerumahan->harga_satuan_jalan;
        $biayaSaluran = $totalSaluranRusak * (float)$formPerumahan->harga_satuan_saluran;
        $biayaBalai = $totalBalaiRusak * (float)$formPerumahan->harga_satuan_balai;
        
        $biayaHOK = (int)$formPerumahan->tenaga_kerja_hok * (float)$formPerumahan->upah_harian;
        $biayaAlatBerat = (int)$formPerumahan->alat_berat_hari * (float)$formPerumahan->biaya_per_hari;
        $biayaTenda = (int)$formPerumahan->jumlah_tenda * (float)$formPerumahan->harga_tenda;
        $biayaBarak = (int)$formPerumahan->jumlah_barak * (float)$formPerumahan->harga_barak;
        $biayaRumahSementara = (int)$formPerumahan->jumlah_rumah_sementara * (float)$formPerumahan->harga_rumah_sementara;
        
        $totalBiayaKerusakan = $biayaRumahPermanen + $biayaRumahNonPermanen + $biayaJalan + $biayaSaluran + $biayaBalai;
        $totalBiayaKerugian = $biayaHOK + $biayaAlatBerat + (float)$formPerumahan->harga_sewa_per_bulan + $biayaTenda + $biayaBarak + $biayaRumahSementara;
        $totalKeseluruhanBiaya = $totalBiayaKerusakan + $totalBiayaKerugian;
        
        $data = [
            'formPerumahan' => $formPerumahan,
            'bencana' => $bencana,
            'totalRumahPermanen' => $totalRumahPermanen,
            'totalRumahNonPermanen' => $totalRumahNonPermanen,
            'totalJalanRusak' => $totalJalanRusak,
            'totalSaluranRusak' => $totalSaluranRusak,
            'totalBalaiRusak' => $totalBalaiRusak,
            'biayaRumahPermanen' => $biayaRumahPermanen,
            'biayaRumahNonPermanen' => $biayaRumahNonPermanen,
            'biayaJalan' => $biayaJalan,
            'biayaSaluran' => $biayaSaluran,
            'biayaBalai' => $biayaBalai,
            'biayaHOK' => $biayaHOK,
            'biayaAlatBerat' => $biayaAlatBerat,
            'biayaTenda' => $biayaTenda,
            'biayaBarak' => $biayaBarak,
            'biayaRumahSementara' => $biayaRumahSementara,
            'totalBiayaKerusakan' => $totalBiayaKerusakan,
            'totalBiayaKerugian' => $totalBiayaKerugian,
            'totalKeseluruhanBiaya' => $totalKeseluruhanBiaya,
            'tanggal' => date('d-m-Y'),
        ];
        
        // Load view dengan DomPdf dan atur landscape
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format1.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('FormPerumahan_' . $formPerumahan->id . '.pdf');
    }

    /**
     * Generate PDF for Format 10 (Agriculture sector)
     */
    public function generateFormat10Pdf($bencana_id)
    {
        $report = Format10Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format10.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_Pertanian_' . $report->id . '.pdf');
    }

    /**
     * Preview PDF for Format 10 (Agriculture sector)
     */
    public function previewFormat10Pdf($bencana_id)
    {
        $report = Format10Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format10.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_Pertanian_' . $report->id . '.pdf');
    }

    /**
     * Generate PDF for Format 11 (Livestock sector)
     */
    public function generateFormat11Pdf($bencana_id)
    {
        $report = Format11Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format11.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_Peternakan_' . $report->id . '.pdf');
    }

    /**
     * Preview PDF for Format 11 (Livestock sector)
     */
    public function previewFormat11Pdf($bencana_id)
    {
        $report = Format11Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format11.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_Peternakan_' . $report->id . '.pdf');
    }

    /**
     * Generate PDF for Format 12 (Fishery sector)
     */
    public function generateFormat12Pdf($bencana_id)
    {
        $report = Format12Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format12.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_Perikanan_' . $report->id . '.pdf');
    }

    /**
     * Preview PDF for Format 12 (Fishery sector)
     */
    public function previewFormat12Pdf($bencana_id)
    {
        $report = Format12Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format12.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_Perikanan_' . $report->id . '.pdf');
    }

    /**
     * Generate PDF for Format 13 (SME sector)
     */
    public function generateFormat13Pdf($bencana_id)
    {
        $report = Format13Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format13.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_UMKM_' . $report->id . '.pdf');
    }

    /**
     * Preview PDF for Format 13 (SME sector)
     */
    public function previewFormat13Pdf($bencana_id)
    {
        $report = Format13Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format13.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_UMKM_' . $report->id . '.pdf');
    }

    /**
     * Generate PDF for Format 14 (Tourism sector)
     */
    public function generateFormat14Pdf($bencana_id)
    {
        $report = Format14Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format14.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_Pariwisata_' . $report->id . '.pdf');
    }

    /**
     * Preview PDF for Format 14 (Tourism sector)
     */
    public function previewFormat14Pdf($bencana_id)
    {
        $report = Format14Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format14.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_Pariwisata_' . $report->id . '.pdf');
    }

    /**
     * Generate PDF for Format 15 (Industry sector)
     */
    public function generateFormat15Pdf($bencana_id)
    {
        $report = Format15Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format15.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_Industri_' . $report->id . '.pdf');
    }

    /**
     * Preview PDF for Format 15 (Industry sector)
     */
    public function previewFormat15Pdf($bencana_id)
    {
        $report = Format15Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format15.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_Industri_' . $report->id . '.pdf');
    }

    /**
     * Generate PDF for Format 16 (Government sector)
     */
    public function generateFormat16Pdf($bencana_id)
    {
        $report = Format16Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format16.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_Pemerintahan_' . $report->id . '.pdf');
    }

    /**
     * Preview PDF for Format 16 (Government sector)
     */
    public function previewFormat16Pdf($bencana_id)
    {
        $report = Format16Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format16.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_Pemerintahan_' . $report->id . '.pdf');
    }

    /**
     * Generate PDF for Format 17 (Environment sector)
     */
    public function generateFormat17Pdf($bencana_id)
    {
        $report = Format17Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format17.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Sektor_Lingkungan_' . $report->id . '.pdf');
    }

    /**
     * Preview PDF for Format 17 (Environment sector)
     */
    public function previewFormat17Pdf($bencana_id)
    {
        $report = Format17Form4::with('bencana')->where('bencana_id', $bencana_id)->latest()->first();
        
        if (!$report) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }
        
        $data = [
            'report' => $report,
            'bencana' => $report->bencana,
            'tanggal' => date('d-m-Y'),
        ];
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.format17.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Sektor_Lingkungan_' . $report->id . '.pdf');
    }
}
