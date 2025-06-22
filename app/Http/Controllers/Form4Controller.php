<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\FormPerumahan;
use App\Models\EnvironmentalReport;
use App\Models\GovernmentReport;
use App\Models\FormData;
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
        $governmentReports = \App\Models\GovernmentReport::where('bencana_id', $bencana_id)->get();
        
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
                        \App\Models\EnvironmentalReport::create([
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
                        \App\Models\EnvironmentalReport::create([
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
                        \App\Models\EnvironmentalReport::create([
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
                        \App\Models\EnvironmentalReport::create([
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
                        \App\Models\EnvironmentalReport::create([
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
                        \App\Models\EnvironmentalReport::create([
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
                        \App\Models\GovernmentReport::create([
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
            \App\Models\GovernmentReport::create([
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
    public function listFormat1(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::findOrFail($bencana_id);
        $formData = FormPerumahan::where('bencana_id', $bencana_id)->latest()->get();
        
        return view('forms.form4.format1.format1list', compact('bencana', 'formData'));
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
     * Display the Format 4 form for Social Protection Sector data collection
     */
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

    /**
     * Store Format 4 form data for Social Protection sector
     */
    public function storeFormat4(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string|max:255',
                'nama_distrik' => 'required|string|max:255',
                
                // Panti Sosial
                'panti_sosial_rb' => 'nullable|integer',
                'panti_sosial_rs' => 'nullable|integer',
                'panti_sosial_rr' => 'nullable|integer',
                'panti_sosial_luas' => 'nullable|numeric',
                'panti_sosial_harga_bangunan' => 'nullable|numeric',
                'panti_sosial_harga_peralatan' => 'nullable|numeric',
                'panti_sosial_harga_meubelair' => 'nullable|numeric',
                
                // Panti Asuhan
                'panti_asuhan_rb' => 'nullable|integer',
                'panti_asuhan_rs' => 'nullable|integer',
                'panti_asuhan_rr' => 'nullable|integer',
                'panti_asuhan_luas' => 'nullable|numeric',
                'panti_asuhan_harga_bangunan' => 'nullable|numeric',
                'panti_asuhan_harga_peralatan' => 'nullable|numeric',
                'panti_asuhan_harga_meubelair' => 'nullable|numeric',
                
                // Balai Pelayanan Sosial
                'balai_pelayanan_rb' => 'nullable|integer',
                'balai_pelayanan_rs' => 'nullable|integer',
                'balai_pelayanan_rr' => 'nullable|integer',
                'balai_pelayanan_luas' => 'nullable|numeric',
                'balai_pelayanan_harga_bangunan' => 'nullable|numeric',
                'balai_pelayanan_harga_peralatan' => 'nullable|numeric',
                'balai_pelayanan_harga_meubelair' => 'nullable|numeric',
                
                // Balai Latihan Sosial
                'balai_latihan_rb' => 'nullable|integer',
                'balai_latihan_rs' => 'nullable|integer',
                'balai_latihan_rr' => 'nullable|integer',
                'balai_latihan_luas' => 'nullable|numeric',
                'balai_latihan_harga_bangunan' => 'nullable|numeric',
                'balai_latihan_harga_peralatan' => 'nullable|numeric',
                'balai_latihan_harga_meubelair' => 'nullable|numeric',
                
                // Fasilitas lainnya
                'lainnya_jenis' => 'nullable|string|max:255',
                'lainnya_rb' => 'nullable|integer',
                'lainnya_rs' => 'nullable|integer',
                'lainnya_rr' => 'nullable|integer',
                'lainnya_luas' => 'nullable|numeric',
                'lainnya_harga_bangunan' => 'nullable|numeric',
                'lainnya_harga_peralatan' => 'nullable|numeric',
                'lainnya_harga_meubelair' => 'nullable|numeric',
                
                // Biaya Pembersihan Puing
                'biaya_tenaga_kerja_hok' => 'nullable|integer',
                'biaya_tenaga_kerja_upah' => 'nullable|numeric',
                'biaya_alat_berat_hari' => 'nullable|integer',
                'biaya_alat_berat_harga' => 'nullable|numeric',
                
                // Kehilangan Pendapatan
                'pendapatan_perhari' => 'nullable|numeric',
                'lama_gangguan' => 'nullable|integer',
                
                // Tambahan Biaya Sosial
                'biaya_penanganan_korban' => 'nullable|numeric',
                'biaya_logistik' => 'nullable|numeric',
                'jumlah_pos' => 'nullable|integer',
                'biaya_operasional_perhari' => 'nullable|numeric',
                'jangka_waktu' => 'nullable|integer'
            ]);
            
            $bencana_id = $request->bencana_id;
            
            // Create a SocialProtectionReport model if it doesn't exist
            // For simplicity, we'll store the data in JSON format in the database
            
            // First, let's create an array of facility types to process
            $facilityTypes = [
                'panti_sosial' => 'Panti Sosial',
                'panti_asuhan' => 'Panti Asuhan',
                'balai_pelayanan' => 'Balai Pelayanan Sosial',
                'balai_latihan' => 'Balai Latihan Sosial'
            ];
            
            // Add the custom facility if provided
            if (!empty($request->lainnya_jenis)) {
                $facilityTypes['lainnya'] = $request->lainnya_jenis;
            }
            
            // Create a record for all facilities that have damage data
            foreach ($facilityTypes as $type => $name) {
                $rb = $request->{$type.'_rb'} ?? 0;
                $rs = $request->{$type.'_rs'} ?? 0;
                $rr = $request->{$type.'_rr'} ?? 0;
                
                // Only create records for facilities with damage
                if ($rb > 0 || $rs > 0 || $rr > 0) {
                    // Calculate costs
                    $harga_bangunan = $request->{$type.'_harga_bangunan'} ?? 0;
                    $harga_peralatan = $request->{$type.'_harga_peralatan'} ?? 0;
                    $harga_meubelair = $request->{$type.'_harga_meubelair'} ?? 0;
                    $luas = $request->{$type.'_luas'} ?? 0;
                    
                    $biaya_rb = $rb * $harga_bangunan * $luas;
                    $biaya_rs = $rs * $harga_bangunan * $luas * 0.7; // 70% of total cost for medium damage
                    $biaya_rr = $rr * $harga_bangunan * $luas * 0.3; // 30% of total cost for light damage
                    
                    // Additional costs for equipment and furniture
                    $biaya_peralatan = ($rb + $rs + $rr) * $harga_peralatan;
                    $biaya_meubelair = ($rb + $rs + $rr) * $harga_meubelair;
                    
                    $total_biaya = $biaya_rb + $biaya_rs + $biaya_rr + $biaya_peralatan + $biaya_meubelair;
                    
                    // Create or update a record in the database
                    \App\Models\FormData::create([
                        'form_type' => 'social_protection',
                        'bencana_id' => $bencana_id,
                        'category' => 'facility',
                        'name' => $name,
                        'data' => json_encode([
                            'facility_type' => $type,
                            'rusak_berat' => $rb,
                            'rusak_sedang' => $rs,
                            'rusak_ringan' => $rr,
                            'luas' => $luas,
                            'harga_bangunan' => $harga_bangunan,
                            'harga_peralatan' => $harga_peralatan,
                            'harga_meubelair' => $harga_meubelair,
                            'biaya_rb' => $biaya_rb,
                            'biaya_rs' => $biaya_rs,
                            'biaya_rr' => $biaya_rr,
                            'biaya_peralatan' => $biaya_peralatan,
                            'biaya_meubelair' => $biaya_meubelair,
                            'total_biaya' => $total_biaya
                        ])
                    ]);
                }
            }
            
            // Calculate loss costs
            $biaya_tenaga_kerja = ($request->biaya_tenaga_kerja_hok ?? 0) * ($request->biaya_tenaga_kerja_upah ?? 0);
            $biaya_alat_berat = ($request->biaya_alat_berat_hari ?? 0) * ($request->biaya_per_hari_alat_berat ?? 0);
            $biaya_kehilangan_pendapatan = ($request->pendapatan_perhari ?? 0) * ($request->lama_gangguan ?? 0);
            $biaya_pos_pelayanan = ($request->jumlah_pos ?? 0) * ($request->biaya_operasional_perhari ?? 0) * ($request->jangka_waktu ?? 0);
            
            $total_biaya_kerugian = $biaya_tenaga_kerja + 
                                  $biaya_alat_berat + 
                                  $biaya_kehilangan_pendapatan + 
                                  ($request->biaya_penanganan_korban ?? 0) + 
                                  ($request->biaya_logistik ?? 0) + 
                                  $biaya_pos_pelayanan;
            
            // Store loss data
            \App\Models\FormData::create([
                'form_type' => 'social_protection',
                'bencana_id' => $bencana_id,
                'category' => 'loss',
                'name' => 'Perkiraan Kerugian',
                'data' => json_encode([
                    'nama_kampung' => $request->nama_kampung,
                    'nama_distrik' => $request->nama_distrik,
                    'biaya_tenaga_kerja_hok' => $request->biaya_tenaga_kerja_hok,
                    'biaya_tenaga_kerja_upah' => $request->biaya_tenaga_kerja_upah,
                    'biaya_tenaga_kerja' => $biaya_tenaga_kerja,
                    'biaya_alat_berat_hari' => $request->biaya_alat_berat_hari,
                    'biaya_alat_berat_harga' => $request->biaya_alat_berat_harga,
                    'biaya_alat_berat' => $biaya_alat_berat,
                    'pendapatan_perhari' => $request->pendapatan_perhari,
                    'lama_gangguan' => $request->lama_gangguan,
                    'biaya_kehilangan_pendapatan' => $biaya_kehilangan_pendapatan,
                    'biaya_penanganan_korban' => $request->biaya_penanganan_korban,
                    'biaya_logistik' => $request->biaya_logistik,
                    'jumlah_pos' => $request->jumlah_pos,
                    'biaya_operasional_perhari' => $request->biaya_operasional_perhari,
                    'jangka_waktu' => $request->jangka_waktu,
                    'biaya_pos_pelayanan' => $biaya_pos_pelayanan,
                    'total_biaya_kerugian' => $total_biaya_kerugian
                ])
            ]);
            
            DB::commit();
            
            return redirect()->route('forms.form4.index', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Format 4 Sektor Perlindungan Sosial berhasil disimpan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Store format5 form data (Religious Sector)
     */
    public function storeFormat5(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string|max:255',
                'nama_distrik' => 'required|string|max:255',
                
                // Religious facilities
                'masjid_rb' => 'nullable|integer',
                'masjid_rs' => 'nullable|integer',
                'masjid_rr' => 'nullable|integer',
                'masjid_luas' => 'nullable|numeric',
                'masjid_harga_bangunan' => 'nullable|numeric',
                'masjid_harga_peralatan' => 'nullable|numeric',
                'masjid_harga_inventaris' => 'nullable|numeric',
                
                'gereja_rb' => 'nullable|integer',
                'gereja_rs' => 'nullable|integer',
                'gereja_rr' => 'nullable|integer',
                'gereja_luas' => 'nullable|numeric',
                'gereja_harga_bangunan' => 'nullable|numeric',
                'gereja_harga_peralatan' => 'nullable|numeric',
                'gereja_harga_inventaris' => 'nullable|numeric',
                
                'pura_rb' => 'nullable|integer',
                'pura_rs' => 'nullable|integer',
                'pura_rr' => 'nullable|integer',
                'pura_luas' => 'nullable|numeric',
                'pura_harga_bangunan' => 'nullable|numeric',
                'pura_harga_peralatan' => 'nullable|numeric',
                'pura_harga_inventaris' => 'nullable|numeric',
                
                'vihara_rb' => 'nullable|integer',
                'vihara_rs' => 'nullable|integer',
                'vihara_rr' => 'nullable|integer',
                'vihara_luas' => 'nullable|numeric',
                'vihara_harga_bangunan' => 'nullable|numeric',
                'vihara_harga_peralatan' => 'nullable|numeric',
                'vihara_harga_inventaris' => 'nullable|numeric',
                
                'klenteng_rb' => 'nullable|integer',
                'klenteng_rs' => 'nullable|integer',
                'klenteng_rr' => 'nullable|integer',
                'klenteng_luas' => 'nullable|numeric',
                'klenteng_harga_bangunan' => 'nullable|numeric',
                'klenteng_harga_peralatan' => 'nullable|numeric',
                'klenteng_harga_inventaris' => 'nullable|numeric',
                
                'lainnya_jenis' => 'nullable|string|max:255',
                'lainnya_rb' => 'nullable|integer',
                'lainnya_rs' => 'nullable|integer',
                'lainnya_rr' => 'nullable|integer',
                'lainnya_luas' => 'nullable|numeric',
                'lainnya_harga_bangunan' => 'nullable|numeric',
                'lainnya_harga_peralatan' => 'nullable|numeric',
                'lainnya_harga_inventaris' => 'nullable|numeric',
                
                // Biaya Pembersihan Puing
                'biaya_tenaga_kerja_hok' => 'nullable|integer',
                'biaya_tenaga_kerja_upah' => 'nullable|numeric',
                'biaya_alat_berat_hari' => 'nullable|integer',
                'biaya_alat_berat_harga' => 'nullable|numeric',
            ]);
            
            $bencana_id = $request->bencana_id;
            
            // Create a FormData record for religious sector
            \App\Models\FormData::create([
                'form_type' => 'religious_sector',
                'bencana_id' => $bencana_id,
                'category' => 'damage_data',
                'name' => 'Data Kerusakan Sektor Keagamaan',
                'data' => json_encode($validated)
            ]);
            
            DB::commit();
            
            return redirect()->route('forms.form4.index', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Format 5 Sektor Keagamaan berhasil disimpan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Store format6 form data (Drinking Water Sector)
     */
    public function storeFormat6(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string|max:255',
                'nama_distrik' => 'required|string|max:255',
                
                // Kerusakan Sarana Air Minum
                'struktur_air_jumlah' => 'nullable|integer',
                'struktur_air_harga' => 'nullable|numeric',
                'struktur_air_total' => 'nullable|numeric',
                
                'instalasi_pemurnian_jumlah' => 'nullable|integer',
                'instalasi_pemurnian_harga' => 'nullable|numeric',
                'instalasi_pemurnian_total' => 'nullable|numeric',
                
                'perpipaan_jumlah' => 'nullable|integer',
                'perpipaan_harga' => 'nullable|numeric',
                'perpipaan_total' => 'nullable|numeric',
                
                'penyimpanan_jumlah' => 'nullable|integer',
                'penyimpanan_harga' => 'nullable|numeric',
                'penyimpanan_total' => 'nullable|numeric',
                
                'sumur_jumlah' => 'nullable|integer',
                'sumur_harga' => 'nullable|numeric',
                'sumur_total' => 'nullable|numeric',
                
                'wc_umum_jumlah' => 'nullable|integer',
                'wc_umum_harga' => 'nullable|numeric',
                'wc_umum_total' => 'nullable|numeric',
                
                'lainnya_jenis_sarana' => 'nullable|string|max:255',
                'lainnya_sarana_jumlah' => 'nullable|integer',
                'lainnya_sarana_harga' => 'nullable|numeric',
                'lainnya_sarana_total' => 'nullable|numeric',
                
                // Kerusakan Sistem Sanitasi
                'jaringan_pembuangan_jumlah' => 'nullable|integer',
                'jaringan_pembuangan_harga' => 'nullable|numeric',
                'jaringan_pembuangan_total' => 'nullable|numeric',
                
                'septic_tank_jumlah' => 'nullable|integer',
                'septic_tank_harga' => 'nullable|numeric',
                'septic_tank_total' => 'nullable|numeric',
                
                'limbah_padat_jumlah' => 'nullable|integer',
                'limbah_padat_harga' => 'nullable|numeric',
                'limbah_padat_total' => 'nullable|numeric',
                
                // Perkiraan Dampak Ekonomi
                'kehilangan_pendapatan' => 'nullable|numeric',
                'biaya_pemurnian' => 'nullable|numeric',
                'biaya_distribusi' => 'nullable|numeric',
                'biaya_pembersihan_sumur' => 'nullable|numeric',
                'biaya_bahan_kimia' => 'nullable|numeric',
                'biaya_lainnya_keterangan' => 'nullable|string|max:255',
                'biaya_lainnya' => 'nullable|numeric',
                'rehabilitasi_bulan' => 'nullable|integer',
                'rekonstruksi_bulan' => 'nullable|integer',
            ]);
            
            $bencana_id = $request->bencana_id;
            
            // Create a FormData record for water supply sector
            \App\Models\FormData::create([
                'form_type' => 'format6',
                'bencana_id' => $bencana_id,
                'category' => 'damage_loss_data',
                'name' => 'Data Kerusakan & Kerugian Sarana Air Minum & Sanitasi',
                'data' => json_encode($validated)
            ]);
            
            DB::commit();
            
            return redirect()->route('forms.form4.index', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Format 6 Sektor Air Minum & Sanitasi berhasil disimpan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Store format8 form data (Electricity Sector)
     */
    public function storeFormat8(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string|max:255',
                'nama_distrik' => 'required|string|max:255',
                
                // Electricity facilities
                'pembangkit_rb' => 'nullable|integer',
                                                                                                                                
                'pembangkit_rs' => 'nullable|integer',
                'pembangkit_rr' => 'nullable|integer',
                'pembangkit_kapasitas' => 'nullable|numeric',
                'pembangkit_harga_unit' => 'nullable|numeric',
                
                'gardu_rb' => 'nullable|integer',
                'gardu_rs' => 'nullable|integer',
                'gardu_rr' => 'nullable|integer',
                'gardu_kapasitas' => 'nullable|numeric',
                'gardu_harga_unit' => 'nullable|numeric',
                
                'trafo_rb' => 'nullable|integer',
                'trafo_rs' => 'nullable|integer',
                'trafo_rr' => 'nullable|integer',
                'trafo_kapasitas' => 'nullable|numeric',
                'trafo_harga_unit' => 'nullable|numeric',
                
                'tiang_rb' => 'nullable|integer',
                'tiang_rs' => 'nullable|integer',
                'tiang_rr' => 'nullable|integer',
                'tiang_harga_unit' => 'nullable|numeric',
                
                'kabel_rb' => 'nullable|numeric',
                'kabel_rs' => 'nullable|numeric',
                'kabel_rr' => 'nullable|numeric',
                'kabel_harga_meter' => 'nullable|numeric',
                
                'lainnya_jenis' => 'nullable|string|max:255',
                'lainnya_rb' => 'nullable|integer',
                'lainnya_rs' => 'nullable|integer',
                'lainnya_rr' => 'nullable|integer',
                'lainnya_harga_unit' => 'nullable|numeric',
                
                // Biaya Pembersihan dan Loss
                'biaya_tenaga_kerja_hok' => 'nullable|integer',
                'biaya_tenaga_kerja_upah' => 'nullable|numeric',
                'biaya_alat_berat_hari' => 'nullable|integer',
                'biaya_alat_berat_harga' => 'nullable|numeric',
                'lama_gangguan_layanan' => 'nullable|integer',
                'pendapatan_perhari' => 'nullable|numeric',
                'jumlah_pelanggan' => 'nullable|integer',
            ]);
            
            $bencana_id = $request->bencana_id;
            
            // Create a FormData record for electricity sector
            \App\Models\FormData::create([
                'form_type' => 'electricity_sector',
                'bencana_id' => $bencana_id,
                'category' => 'damage_loss_data',
                'name' => 'Data Kerusakan & Kerugian Sektor Listrik',
                'data' => json_encode($validated)
            ]);
            
            DB::commit();
            
            return redirect()->route('forms.form4.index', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Format 8 Sektor Listrik berhasil disimpan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Store format9 form data (Telecom Sector)
     */
    public function storeFormat9(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string|max:255',
                'nama_distrik' => 'required|string|max:255',
                
                // Telecom facilities
                'bts_rb' => 'nullable|integer',
                'bts_rs' => 'nullable|integer',
                'bts_rr' => 'nullable|integer',
                'bts_harga_unit' => 'nullable|numeric',
                
                'kantor_rb' => 'nullable|integer',
                'kantor_rs' => 'nullable|integer',
                'kantor_rr' => 'nullable|integer',
                'kantor_luas' => 'nullable|numeric',
                'kantor_harga_m2' => 'nullable|numeric',
                
                'pemancar_rb' => 'nullable|integer',
                'pemancar_rs' => 'nullable|integer',
                'pemancar_rr' => 'nullable|integer',
                'pemancar_harga_unit' => 'nullable|numeric',
                
                'kabel_rb' => 'nullable|numeric',
                'kabel_rs' => 'nullable|numeric',
                'kabel_rr' => 'nullable|numeric',
                'kabel_harga_meter' => 'nullable|numeric',
                
                'server_rb' => 'nullable|integer',
                'server_rs' => 'nullable|integer',
                'server_rr' => 'nullable|integer',
                'server_harga_unit' => 'nullable|numeric',
                
                'lainnya_jenis' => 'nullable|string|max:255',
                'lainnya_rb' => 'nullable|integer',
                'lainnya_rs' => 'nullable|integer',
                'lainnya_rr' => 'nullable|integer',
                'lainnya_harga_unit' => 'nullable|numeric',
                
                // Biaya Pembersihan dan Loss
                'biaya_tenaga_kerja_hok' => 'nullable|integer',
                'biaya_tenaga_kerja_upah' => 'nullable|numeric',
                'biaya_alat_berat_hari' => 'nullable|integer',
                'biaya_alat_berat_harga' => 'nullable|numeric',
                'lama_gangguan_layanan' => 'nullable|integer',
                'pendapatan_perhari' => 'nullable|numeric',
                'jumlah_pelanggan' => 'nullable|integer',
            ]);
            
            $bencana_id = $request->bencana_id;
            
            // Create a FormData record for telecom sector
            \App\Models\FormData::create([
                'form_type' => 'telecom_sector',
                'bencana_id' => $bencana_id,
                'category' => 'damage_loss_data',
                'name' => 'Data Kerusakan & Kerugian Sektor Telekomunikasi',
                'data' => json_encode($validated)
            ]);
            
            DB::commit();
            
            return redirect()->route('forms.form4.index', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Format 9 Sektor Telekomunikasi berhasil disimpan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Store format10 form data (Agriculture Sector)
     */
    public function storeFormat10(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string|max:255',
                'nama_distrik' => 'required|string|max:255',
                
                // Agriculture damages
                'padi_luas_rusak' => 'nullable|numeric',
                'padi_harga_per_ha' => 'nullable|numeric',
                'padi_lama_tanam' => 'nullable|numeric',
                
                'jagung_luas_rusak' => 'nullable|numeric',
                'jagung_harga_per_ha' => 'nullable|numeric',
                'jagung_lama_tanam' => 'nullable|numeric',
                
                'kedelai_luas_rusak' => 'nullable|numeric',
                'kedelai_harga_per_ha' => 'nullable|numeric',
                'kedelai_lama_tanam' => 'nullable|numeric',
                
                'sayuran_luas_rusak' => 'nullable|numeric',
                'sayuran_harga_per_ha' => 'nullable|numeric',
                'sayuran_lama_tanam' => 'nullable|numeric',
                
                'buah_luas_rusak' => 'nullable|numeric',
                'buah_harga_per_ha' => 'nullable|numeric',
                'buah_lama_tanam' => 'nullable|numeric',
                
                'lainnya_jenis' => 'nullable|string|max:255',
                'lainnya_luas_rusak' => 'nullable|numeric',
                'lainnya_harga_per_ha' => 'nullable|numeric',
                'lainnya_lama_tanam' => 'nullable|numeric',
                
                // Agricultural facilities
                'irigasi_rb' => 'nullable|numeric',
                'irigasi_rs' => 'nullable|numeric',
                'irigasi_rr' => 'nullable|numeric',
                'irigasi_harga_per_m' => 'nullable|numeric',
                
                'gudang_rb' => 'nullable|integer',
                'gudang_rs' => 'nullable|integer',
                'gudang_rr' => 'nullable|integer',
                'gudang_luas' => 'nullable|numeric',
                'gudang_harga_per_m2' => 'nullable|numeric',
                
                'peralatan_rb' => 'nullable|integer',
                'peralatan_rs' => 'nullable|integer',
                'peralatan_rr' => 'nullable|integer',
                'peralatan_harga_unit' => 'nullable|numeric',
                
                // Biaya Pembersihan dan Loss
                'biaya_tenaga_kerja_hok' => 'nullable|integer',
                'biaya_tenaga_kerja_upah' => 'nullable|numeric',
                'biaya_alat_berat_hari' => 'nullable|integer',
                'biaya_alat_berat_harga' => 'nullable|numeric',
                'lama_gangguan_produksi' => 'nullable|integer',
                'pendapatan_perhari' => 'nullable|numeric',
            ]);
            
            $bencana_id = $request->bencana_id;
            
            // Create a FormData record for agriculture sector
            \App\Models\FormData::create([
                'form_type' => 'agriculture_sector',
                'bencana_id' => $bencana_id,
                'category' => 'damage_loss_data',
                'name' => 'Data Kerusakan & Kerugian Sektor Pertanian',
                'data' => json_encode($validated)
            ]);
            
            DB::commit();
            
            return redirect()->route('forms.form4.index', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Format 10 Sektor Pertanian berhasil disimpan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Store format11 form data (Animal Husbandry Sector)
     */
    public function storeFormat11(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string|max:255',
                'nama_distrik' => 'required|string|max:255',
                
                // Building damages
                'kandang_rb' => 'nullable|integer',
                'kandang_rs' => 'nullable|integer',
                'kandang_rr' => 'nullable|integer',
                'kandang_luas' => 'nullable|numeric',
                'kandang_harga_m2' => 'nullable|numeric',
                
                'gudang_pakan_rb' => 'nullable|integer',
                'gudang_pakan_rs' => 'nullable|integer',
                'gudang_pakan_rr' => 'nullable|integer',
                'gudang_pakan_luas' => 'nullable|numeric',
                'gudang_pakan_harga_m2' => 'nullable|numeric',
                
                'balai_inseminasi_rb' => 'nullable|integer',
                'balai_inseminasi_rs' => 'nullable|integer',
                'balai_inseminasi_rr' => 'nullable|integer',
                'balai_inseminasi_luas' => 'nullable|numeric',
                'balai_inseminasi_harga_m2' => 'nullable|numeric',
                
                'lainnya_jenis_bangunan' => 'nullable|string|max:255',
                'lainnya_bangunan_rb' => 'nullable|integer',
                'lainnya_bangunan_rs' => 'nullable|integer',
                'lainnya_bangunan_rr' => 'nullable|integer',
                'lainnya_bangunan_luas' => 'nullable|numeric',
                'lainnya_bangunan_harga_m2' => 'nullable|numeric',
                
                // Equipment damages
                'mesin_pencacah_jumlah' => 'nullable|integer',
                'mesin_pencacah_harga' => 'nullable|numeric',
                
                'mesin_pakan_jumlah' => 'nullable|integer',
                'mesin_pakan_harga' => 'nullable|numeric',
                
                'alat_penampung_susu_jumlah' => 'nullable|integer',
                'alat_penampung_susu_harga' => 'nullable|numeric',
                
                'lainnya_jenis_peralatan' => 'nullable|string|max:255',
                'lainnya_peralatan_jumlah' => 'nullable|integer',
                'lainnya_peralatan_harga' => 'nullable|numeric',
                
                // Livestock loss
                'sapi_jumlah' => 'nullable|integer',
                'sapi_harga' => 'nullable|numeric',
                
                'kambing_jumlah' => 'nullable|integer',
                'kambing_harga' => 'nullable|numeric',
                
                'ayam_jumlah' => 'nullable|integer',
                'ayam_harga' => 'nullable|numeric',
                
                'babi_jumlah' => 'nullable|integer',
                'babi_harga' => 'nullable|numeric',
                
                'lainnya_jenis_ternak' => 'nullable|string|max:255',
                'lainnya_ternak_jumlah' => 'nullable|integer',
                'lainnya_ternak_harga' => 'nullable|numeric',
                
                // Economic impact
                'kehilangan_pendapatan' => 'nullable|numeric',
                'penurunan_produksi' => 'nullable|numeric',
                'kenaikan_harga_pakan' => 'nullable|numeric',
                'biaya_kesehatan_ternak' => 'nullable|numeric',
            ]);
            
            $bencana_id = $request->bencana_id;
            
            // Create a FormData record for animal husbandry sector
            \App\Models\FormData::create([
                'form_type' => 'animal_husbandry_sector',
                'bencana_id' => $bencana_id,
                'category' => 'damage_loss_data',
                'name' => 'Data Kerusakan & Kerugian Sektor Peternakan',
                'data' => json_encode($validated)
            ]);
            
            DB::commit();
            
            return redirect()->route('forms.form4.index', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Format 11 Sektor Peternakan berhasil disimpan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Store format12 form data (Fisheries Sector)
     */
    public function storeFormat12(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string|max:255',
                'nama_distrik' => 'required|string|max:255',
                
                // Cultivation facilities damages
                'kolam_ikan_jumlah' => 'nullable|integer',
                'kolam_ikan_harga' => 'nullable|numeric',
                'kolam_ikan_total' => 'nullable|numeric',
                
                'tambak_jumlah' => 'nullable|integer',
                'tambak_harga' => 'nullable|numeric',
                'tambak_total' => 'nullable|numeric',
                
                'keramba_jumlah' => 'nullable|integer',
                'keramba_harga' => 'nullable|numeric',
                'keramba_total' => 'nullable|numeric',
                
                'hatchery_jumlah' => 'nullable|integer',
                'hatchery_harga' => 'nullable|numeric',
                'hatchery_total' => 'nullable|numeric',
                
                'lainnya_jenis_sarana' => 'nullable|string|max:255',
                'lainnya_sarana_jumlah' => 'nullable|integer',
                'lainnya_sarana_harga' => 'nullable|numeric',
                'lainnya_sarana_total' => 'nullable|numeric',
                
                // Fishing equipment damages
                'perahu_motor_jumlah' => 'nullable|integer',
                'perahu_motor_harga' => 'nullable|numeric',
                'perahu_motor_total' => 'nullable|numeric',
                
                'perahu_dayung_jumlah' => 'nullable|integer',
                'perahu_dayung_harga' => 'nullable|numeric',
                'perahu_dayung_total' => 'nullable|numeric',
                
                'jaring_insang_jumlah' => 'nullable|integer',
                'jaring_insang_harga' => 'nullable|numeric',
                'jaring_insang_total' => 'nullable|numeric',
                
                'jaring_purse_seine_jumlah' => 'nullable|integer',
                'jaring_purse_seine_harga' => 'nullable|numeric',
                'jaring_purse_seine_total' => 'nullable|numeric',
                
                'alat_penangkap_lain_jumlah' => 'nullable|integer',
                'alat_penangkap_lain_harga' => 'nullable|numeric',
                'alat_penangkap_lain_total' => 'nullable|numeric',
                
                // Fish loss
                'ikan_lele_jumlah' => 'nullable|numeric',
                'ikan_lele_harga' => 'nullable|numeric',
                'ikan_lele_total' => 'nullable|numeric',
                
                'ikan_nila_jumlah' => 'nullable|numeric',
                'ikan_nila_harga' => 'nullable|numeric',
                'ikan_nila_total' => 'nullable|numeric',
                
                'udang_jumlah' => 'nullable|numeric',
                'udang_harga' => 'nullable|numeric',
                'udang_total' => 'nullable|numeric',
                
                'bandeng_jumlah' => 'nullable|numeric',
                'bandeng_harga' => 'nullable|numeric',
                'bandeng_total' => 'nullable|numeric',
                
                'lainnya_jenis_ikan' => 'nullable|string|max:255',
                'lainnya_ikan_jumlah' => 'nullable|numeric',
                'lainnya_ikan_harga' => 'nullable|numeric',
                'lainnya_ikan_total' => 'nullable|numeric',
                
                // Economic impact
                'kehilangan_pendapatan_harian' => 'nullable|numeric',
                'hari_tidak_melaut' => 'nullable|integer',
                'biaya_sewa_alat' => 'nullable|numeric',
                'kenaikan_harga_pakan' => 'nullable|numeric',
            ]);
            
            $bencana_id = $request->bencana_id;
            
            // Create a FormData record for fisheries sector
            \App\Models\FormData::create([
                'form_type' => 'fisheries_sector',
                'bencana_id' => $bencana_id,
                'category' => 'damage_loss_data',
                'name' => 'Data Kerusakan & Kerugian Sektor Perikanan',
                'data' => json_encode($validated)
            ]);
            
            DB::commit();
            
            return redirect()->route('forms.form4.index', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Format 12 Sektor Perikanan berhasil disimpan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Store format13 form data (Industry & SME Sector)
     */
    public function storeFormat13(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string|max:255',
                'nama_distrik' => 'required|string|max:255',
                
                // Building damages
                'unit_produksi_jumlah' => 'nullable|integer',
                'unit_produksi_luas' => 'nullable|numeric',
                'unit_produksi_harga_m2' => 'nullable|numeric',
                'unit_produksi_total' => 'nullable|numeric',
                
                'gudang_jumlah' => 'nullable|integer',
                'gudang_luas' => 'nullable|numeric',
                'gudang_harga_m2' => 'nullable|numeric',
                'gudang_total' => 'nullable|numeric',
                
                'toko_jumlah' => 'nullable|integer',
                'toko_luas' => 'nullable|numeric',
                'toko_harga_m2' => 'nullable|numeric',
                'toko_total' => 'nullable|numeric',
                
                'lainnya_jenis_bangunan' => 'nullable|string|max:255',
                'lainnya_bangunan_jumlah' => 'nullable|integer',
                'lainnya_bangunan_luas' => 'nullable|numeric',
                'lainnya_bangunan_harga_m2' => 'nullable|numeric',
                'lainnya_bangunan_total' => 'nullable|numeric',
                
                // Equipment damages
                'mesin_jahit_jumlah' => 'nullable|integer',
                'mesin_jahit_harga' => 'nullable|numeric',
                'mesin_jahit_total' => 'nullable|numeric',
                
                'oven_jumlah' => 'nullable|integer',
                'oven_harga' => 'nullable|numeric',
                'oven_total' => 'nullable|numeric',
                
                'etalase_jumlah' => 'nullable|integer',
                'etalase_harga' => 'nullable|numeric',
                'etalase_total' => 'nullable|numeric',
                
                'lainnya_jenis_peralatan' => 'nullable|string|max:255',
                'lainnya_peralatan_jumlah' => 'nullable|integer',
                'lainnya_peralatan_harga' => 'nullable|numeric',
                'lainnya_peralatan_total' => 'nullable|numeric',
                
                // Production loss
                'roti_produksi_harian' => 'nullable|numeric',
                'roti_harga_unit' => 'nullable|numeric',
                'roti_hari_tidak_produksi' => 'nullable|integer',
                'roti_total' => 'nullable|numeric',
                
                'pakaian_produksi_harian' => 'nullable|numeric',
                'pakaian_harga_unit' => 'nullable|numeric',
                'pakaian_hari_tidak_produksi' => 'nullable|integer',
                'pakaian_total' => 'nullable|numeric',
                
                'mebel_produksi_harian' => 'nullable|numeric',
                'mebel_harga_unit' => 'nullable|numeric',
                'mebel_hari_tidak_produksi' => 'nullable|integer',
                'mebel_total' => 'nullable|numeric',
                
                'lainnya_jenis_usaha' => 'nullable|string|max:255',
                'lainnya_produksi_harian' => 'nullable|numeric',
                'lainnya_harga_unit' => 'nullable|numeric',
                'lainnya_hari_tidak_produksi' => 'nullable|integer',
                'lainnya_total' => 'nullable|numeric',
                
                // Additional costs
                'sewa_tempat' => 'nullable|numeric',
                'transportasi_bahan_baku' => 'nullable|numeric',
                'alat_bantu_darurat' => 'nullable|numeric',
            ]);
            
            $bencana_id = $request->bencana_id;
            
            // Create a FormData record for industry sector
            \App\Models\FormData::create([
                'form_type' => 'industry_sector',
                'bencana_id' => $bencana_id,
                'category' => 'damage_loss_data',
                'name' => 'Data Kerusakan & Kerugian Sektor Industri & UMKM',
                'data' => json_encode($validated)
            ]);
            
            DB::commit();
            
            return redirect()->route('forms.form4.index', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Format 13 Sektor Industri & UMKM berhasil disimpan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Store format14 form data (Trade Sector)
     */
    public function storeFormat14(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string|max:255',
                'nama_distrik' => 'required|string|max:255',
                
                // Building damages
                'toko_rb' => 'nullable|integer',
                'toko_rs' => 'nullable|integer',
                'toko_rr' => 'nullable|integer',
                'toko_luas' => 'nullable|numeric',
                'toko_harga_m2' => 'nullable|numeric',
                
                'kios_rb' => 'nullable|integer',
                'kios_rs' => 'nullable|integer',
                'kios_rr' => 'nullable|integer',
                'kios_luas' => 'nullable|numeric',
                'kios_harga_m2' => 'nullable|numeric',
                
                'pasar_rb' => 'nullable|integer',
                'pasar_rs' => 'nullable|integer',
                'pasar_rr' => 'nullable|integer',
                'pasar_luas' => 'nullable|numeric',
                'pasar_harga_m2' => 'nullable|numeric',
                
                'gudang_rb' => 'nullable|integer',
                'gudang_rs' => 'nullable|integer',
                'gudang_rr' => 'nullable|integer',
                'gudang_luas' => 'nullable|numeric',
                'gudang_harga_m2' => 'nullable|numeric',
                
                'lainnya_jenis_bangunan' => 'nullable|string|max:255',
                'lainnya_rb' => 'nullable|integer',
                'lainnya_rs' => 'nullable|integer',
                'lainnya_rr' => 'nullable|integer',
                'lainnya_luas' => 'nullable|numeric',
                'lainnya_harga_m2' => 'nullable|numeric',
                
                // Inventory loss
                'barang_dagangan_rusak' => 'nullable|numeric',
                'stok_barang_rusak' => 'nullable|numeric',
                'peralatan_dagangan_rusak' => 'nullable|numeric',
                
                // Business impact
                'penurunan_omset' => 'nullable|numeric',
                'hari_tidak_beroperasi' => 'nullable|integer',
                'rata_rata_omset_harian' => 'nullable|numeric',
                'biaya_operasional_tambahan' => 'nullable|numeric',
            ]);
            
            $bencana_id = $request->bencana_id;
            
            // Create a FormData record for trade sector
            \App\Models\FormData::create([
                'form_type' => 'trade_sector',
                'bencana_id' => $bencana_id,
                'category' => 'damage_loss_data',
                'name' => 'Data Kerusakan & Kerugian Sektor Perdagangan',
                'data' => json_encode($validated)
            ]);
            
            DB::commit();
            
            return redirect()->route('forms.form4.index', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Format 14 Sektor Perdagangan berhasil disimpan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Store format15 form data (Tourism Sector)
     */
    public function storeFormat15(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string|max:255',
                'nama_distrik' => 'required|string|max:255',
                
                // Building damages
                'hotel_rb' => 'nullable|integer',
                'hotel_rs' => 'nullable|integer',
                'hotel_rr' => 'nullable|integer',
                'hotel_luas' => 'nullable|numeric',
                'hotel_harga_m2' => 'nullable|numeric',
                
                'restoran_rb' => 'nullable|integer',
                'restoran_rs' => 'nullable|integer',
                'restoran_rr' => 'nullable|integer',
                'restoran_luas' => 'nullable|numeric',
                'restoran_harga_m2' => 'nullable|numeric',
                
                'objek_wisata_rb' => 'nullable|integer',
                'objek_wisata_rs' => 'nullable|integer',
                'objek_wisata_rr' => 'nullable|integer',
                'objek_wisata_luas' => 'nullable|numeric',
                'objek_wisata_harga_m2' => 'nullable|numeric',
                
                'lainnya_jenis_bangunan' => 'nullable|string|max:255',
                'lainnya_rb' => 'nullable|integer',
                'lainnya_rs' => 'nullable|integer',
                'lainnya_rr' => 'nullable|integer',
                'lainnya_luas' => 'nullable|numeric',
                'lainnya_harga_m2' => 'nullable|numeric',
                
                // Equipment damages
                'peralatan_hotel_rusak' => 'nullable|numeric',
                'peralatan_restoran_rusak' => 'nullable|numeric',
                'peralatan_objek_wisata_rusak' => 'nullable|numeric',
                
                // Tourism business impact
                'penurunan_wisatawan' => 'nullable|integer',
                'rata_rata_wisatawan_per_hari' => 'nullable|integer',
                'rata_rata_pengeluaran_wisatawan' => 'nullable|numeric',
                'hari_tutup_operasi' => 'nullable|integer',
                'biaya_perbaikan_tambahan' => 'nullable|numeric',
                'pembatalan_pemesanan' => 'nullable|integer',
            ]);
            
            $bencana_id = $request->bencana_id;
            
            // Create a FormData record for tourism sector
            \App\Models\FormData::create([
                'form_type' => 'tourism_sector',
                'bencana_id' => $bencana_id,
                'category' => 'damage_loss_data',
                'name' => 'Data Kerusakan & Kerugian Sektor Pariwisata',
                'data' => json_encode($validated)
            ]);
            
            DB::commit();
            
            return redirect()->route('forms.form4.index', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Format 15 Sektor Pariwisata berhasil disimpan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
        }
    }

    /**
     * Show Format 11 data (Animal Husbandry Sector)
     */
    public function showFormat11($id)
    {
        $formData = \App\Models\FormData::findOrFail($id);
        $bencana = \App\Models\Bencana::findOrFail($formData->bencana_id);
        $data = json_decode($formData->data, true);
        
        return view('forms.form4.format11.show-format11', compact('formData', 'bencana', 'data'));
    }
    
    /**
     * Show Format 12 data (Fisheries Sector)
     */
    public function showFormat12($id)
    {
        $formData = \App\Models\FormData::findOrFail($id);
        $bencana = \App\Models\Bencana::findOrFail($formData->bencana_id);
        $data = json_decode($formData->data, true);
        
        return view('forms.form4.format12.show-format12', compact('formData', 'bencana', 'data'));
    }
    
    /**
     * Show Format 13 data (Industry & SME Sector)
     */
    public function showFormat13($id)
    {
        $formData = \App\Models\FormData::findOrFail($id);
        $bencana = \App\Models\Bencana::findOrFail($formData->bencana_id);
        $data = json_decode($formData->data, true);
        
        return view('forms.form4.format13.show-format13', compact('formData', 'bencana', 'data'));
    }
    
    /**
     * Show Format 14 data (Trade Sector)
     */
    public function showFormat14($id)
    {
        $formData = \App\Models\FormData::findOrFail($id);
        $bencana = \App\Models\Bencana::findOrFail($formData->bencana_id);
        $data = json_decode($formData->data, true);
        
        return view('forms.form4.format14.show-format14', compact('formData', 'bencana', 'data'));
    }
    
    /**
     * Show Format 15 data (Tourism Sector)
     */
    public function showFormat15($id)
    {
        $formData = \App\Models\FormData::findOrFail($id);
        $bencana = \App\Models\Bencana::findOrFail($formData->bencana_id);
        $data = json_decode($formData->data, true);
        
        return view('forms.form4.format15.show-format15', compact('formData', 'bencana', 'data'));
    }

    /**
     * Show submitted data for Format 4
     */
    public function showFormat4($id)
    {
        $data = \App\Models\FormData::findOrFail($id);
        $bencana = Bencana::findOrFail($data->bencana_id);
        return view('forms.form4.format4.show-format4', compact('data', 'bencana'));
    }

    /**
     * Show submitted data for Format 5
     */
    public function showFormat5($id)
    {
        $data = \App\Models\FormData::findOrFail($id);
        $bencana = Bencana::findOrFail($data->bencana_id);
        return view('forms.form4.format5.show-format5', compact('data', 'bencana'));
    }

    /**
     * Show submitted data for Format 8
     */
    public function showFormat8($id)
    {
        $data = \App\Models\FormData::findOrFail($id);
        $bencana = Bencana::findOrFail($data->bencana_id);
        return view('forms.form4.format8.show-format8', compact('data', 'bencana'));
    }

    /**
     * Show submitted data for Format 9
     */
    public function showFormat9($id)
    {
        $data = \App\Models\FormData::findOrFail($id);
        $bencana = Bencana::findOrFail($data->bencana_id);
        return view('forms.form4.format9.show-format9', compact('data', 'bencana'));
    }

    /**
     * Show submitted data for Format 10
     */
    public function showFormat10($id)
    {
        $data = \App\Models\FormData::findOrFail($id);
        $bencana = Bencana::findOrFail($data->bencana_id);
        return view('forms.form4.format10.show-format10', compact('data', 'bencana'));
    }

    /**
     * List data for Format 4
     */
    public function listFormat4(Request $request)
    {
        $search = $request->input('search', '');
        $query = \App\Models\FormData::where('form_type', 'format4')
            ->orderBy('created_at', 'desc');
            
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('location', 'LIKE', "%{$search}%")
                  ->orWhere('id', 'LIKE', "%{$search}%");
            });
        }
        
        $data = $query->paginate(10);
        return view('forms.form4.format4.list-format4', compact('data', 'search'));
    }

    /**
     * List data for Format 5
     */
    public function listFormat5(Request $request)
    {
        $search = $request->input('search', '');
        $query = \App\Models\FormData::where('form_type', 'format5')
            ->orderBy('created_at', 'desc');
            
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('location', 'LIKE', "%{$search}%")
                  ->orWhere('id', 'LIKE', "%{$search}%");
            });
        }
        
        $data = $query->paginate(10);
        return view('forms.form4.format5.list-format5', compact('data', 'search'));
    }

    /**
     * List data for Format 8
     */
    public function listFormat8(Request $request)
    {
        $search = $request->input('search', '');
        $query = \App\Models\FormData::where('form_type', 'format8')
            ->orderBy('created_at', 'desc');
            
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('location', 'LIKE', "%{$search}%")
                  ->orWhere('id', 'LIKE', "%{$search}%");
            });
        }
        
        $data = $query->paginate(10);
        return view('forms.form4.format8.list-format8', compact('data', 'search'));
    }

    /**
     * List data for Format 9
     */
    public function listFormat9(Request $request)
    {
        $search = $request->input('search', '');
        $query = \App\Models\FormData::where('form_type', 'format9')
            ->orderBy('created_at', 'desc');
            
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('location', 'LIKE', "%{$search}%")
                  ->orWhere('id', 'LIKE', "%{$search}%");
            });
        }
        
        $data = $query->paginate(10);
        return view('forms.form4.format9.list-format9', compact('data', 'search'));
    }

    /**
     * List data for Format 10
     */
    public function listFormat10(Request $request)
    {
        $search = $request->input('search', '');
        $query = \App\Models\FormData::where('form_type', 'format10')
            ->orderBy('created_at', 'desc');
            
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('location', 'LIKE', "%{$search}%")
                  ->orWhere('id', 'LIKE', "%{$search}%");
            });
        }
        
        $data = $query->paginate(10);
        return view('forms.form4.format10.list-format10', compact('data', 'search'));
    }

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

    public function format9form4(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format9.format9form4', compact('bencana'));
    }

    public function format10form4(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format10.format10form4', compact('bencana'));
    }
    public function format11form4(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format11.format11form4', compact('bencana'));
    }

    public function format12form4(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format12.format12form4', compact('bencana'));
    }

    public function format13form4(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        // Redirect to bencana selection if no bencana_id is provided
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        // Get bencana details
        $bencana = Bencana::findOrFail($bencana_id);
        
        return view('forms.form4.format13.format13form4', compact('bencana'));
    }

    public function format14form4(Request $request)
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

    public function format15form4(Request $request)
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
}
