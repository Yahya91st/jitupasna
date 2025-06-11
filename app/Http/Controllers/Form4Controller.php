<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bencana;
use App\Models\FormPerumahan;
use App\Models\EnvironmentalReport;
use App\Models\GovernmentReport;
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
        
        return view('forms.form4.format1form4', compact('bencana'));
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
        
        return view('forms.form4.format17form4', compact('bencana'));
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
        
        return view('forms.form4.format7form4', compact('bencana'));
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
        
        return view('forms.form4.format16form4', compact('bencana', 'governmentReports'));
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
        
        return view('forms.form4.show', compact('formPerumahan', 'bencana'));
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
        $pdf->loadView('forms.form4.pdf', $data)
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
        
        return view('forms.form4.format1list', compact('bencana', 'formData'));
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
        $pdf->loadView('forms.form4.pdf', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('FormPerumahan_' . $formPerumahan->id . '.pdf');
    }

    /**
     * Display Format 17 environmental reports for a specific disaster
     */
    public function showFormat17($bencana_id)
    {
        // Get the disaster information
        $bencana = \App\Models\Bencana::with(['kategori_bencana', 'desa'])->findOrFail($bencana_id);
        
        // Get all environmental reports for this disaster
        $environmentalReports = \App\Models\EnvironmentalReport::where('bencana_id', $bencana_id)->get();
        
        // Group the reports by type and category
        $damageReports = $environmentalReports->where('report_type', 'damage')->groupBy('ekosistem');
        $lossReports = $environmentalReports->where('report_type', 'loss')->groupBy('jenis_kerugian');
        
        return view('forms.form4.show-format17', compact('bencana', 'damageReports', 'lossReports'));
    }

    /**
     * List all Format 17 environmental reports for a disaster
     */
    public function listFormat17(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::with(['kategori_bencana', 'desa'])->findOrFail($bencana_id);
        $environmentalReports = EnvironmentalReport::where('bencana_id', $bencana_id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('forms.form4.list-format17', compact('bencana', 'environmentalReports'));
    }

    /**
     * Generate PDF for Format 17 environmental reports
     */
    public function generateFormat17Pdf($bencana_id)
    {
        // Get the disaster information
        $bencana = Bencana::with(['kategori_bencana', 'desa'])->findOrFail($bencana_id);
        
        // Get all environmental reports for this disaster
        $environmentalReports = EnvironmentalReport::where('bencana_id', $bencana_id)->get();
        
        // Group the reports by type and category
        $damageReports = $environmentalReports->where('report_type', 'damage')->groupBy('ekosistem');
        $lossReports = $environmentalReports->where('report_type', 'loss')->groupBy('jenis_kerugian');
        
        // Calculate totals for damage reports
        $totalDamageValue = 0;
        foreach ($damageReports as $ecosystem => $reports) {
            foreach ($reports as $report) {
                $totalDamageValue += ($report->rb * $report->harga_rb) + 
                                   ($report->rs * $report->harga_rs) + 
                                   ($report->rr * $report->harga_rr);
            }
        }
        
        // Calculate totals for loss reports
        $totalLossValue = 0;
        foreach ($lossReports as $category => $reports) {
            foreach ($reports as $report) {
                $totalLossValue += ($report->rb * $report->harga_rb) + 
                                 ($report->rs * $report->harga_rs) + 
                                 ($report->rr * $report->harga_rr);
            }
        }
        
        $totalOverall = $totalDamageValue + $totalLossValue;
        
        $data = [
            'bencana' => $bencana,
            'damageReports' => $damageReports,
            'lossReports' => $lossReports,
            'totalDamageValue' => $totalDamageValue,
            'totalLossValue' => $totalLossValue,
            'totalOverall' => $totalOverall,
            'tanggal' => date('d-m-Y'),
        ];
        
        // Load view dengan DomPdf dan atur landscape
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.pdf.format17form4', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Format17_LingkunganHidup_' . $bencana_id . '.pdf');
    }

    /**
     * Preview PDF Format 17 tanpa download
     */
    public function previewFormat17Pdf($bencana_id)
    {
        // Get the disaster information
        $bencana = Bencana::with(['kategori_bencana', 'desa'])->findOrFail($bencana_id);
        
        // Get all environmental reports for this disaster
        $environmentalReports = EnvironmentalReport::where('bencana_id', $bencana_id)->get();
        
        // Group the reports by type and category
        $damageReports = $environmentalReports->where('report_type', 'damage')->groupBy('ekosistem');
        $lossReports = $environmentalReports->where('report_type', 'loss')->groupBy('jenis_kerugian');
        
        // Calculate totals for damage reports
        $totalDamageValue = 0;
        foreach ($damageReports as $ecosystem => $reports) {
            foreach ($reports as $report) {
                $totalDamageValue += ($report->rb * $report->harga_rb) + 
                                   ($report->rs * $report->harga_rs) + 
                                   ($report->rr * $report->harga_rr);
            }
        }
        
        // Calculate totals for loss reports
        $totalLossValue = 0;
        foreach ($lossReports as $category => $reports) {
            foreach ($reports as $report) {
                $totalLossValue += ($report->rb * $report->harga_rb) + 
                                 ($report->rs * $report->harga_rs) + 
                                 ($report->rr * $report->harga_rr);
            }
        }
        
        $totalOverall = $totalDamageValue + $totalLossValue;
        
        $data = [
            'bencana' => $bencana,
            'damageReports' => $damageReports,
            'lossReports' => $lossReports,
            'totalDamageValue' => $totalDamageValue,
            'totalLossValue' => $totalLossValue,
            'totalOverall' => $totalOverall,
            'tanggal' => date('d-m-Y'),
        ];
        
        // Load view dengan DomPdf dan atur landscape
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.pdf.format17form4', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Format17_LingkunganHidup_' . $bencana_id . '.pdf');
    }

    /**
     * Display Format 3 health reports for a specific disaster
     */
    public function showFormat3($bencana_id)
    {
        // Get the disaster information
        $bencana = \App\Models\Bencana::with(['kategori_bencana', 'desa'])->findOrFail($bencana_id);
        
        // Get all health reports for this disaster
        $healthReports = \App\Models\HealthReport::where('bencana_id', $bencana_id)->get();
        
        // Group the reports by facility type
        $facilityReports = $healthReports->groupBy('jenis_fasilitas');
        
        return view('forms.form4.show-format3', compact('bencana', 'facilityReports', 'healthReports'));
    }

    /**
     * List all Format 3 health reports for a disaster
     */
    public function listFormat3(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::with(['kategori_bencana', 'desa'])->findOrFail($bencana_id);
        $healthReports = \App\Models\HealthReport::where('bencana_id', $bencana_id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('forms.form4.list-format3', compact('bencana', 'healthReports'));
    }

    /**
     * Display Format 2 education reports for a specific disaster
     */
    public function showFormat2($bencana_id)
    {
        // Get the disaster information
        $bencana = \App\Models\Bencana::with(['kategori_bencana', 'desa'])->findOrFail($bencana_id);
        
        // Get all education reports for this disaster
        $educationReports = \App\Models\EducationReport::where('bencana_id', $bencana_id)->get();
        
        // Group the reports by facility type
        $facilityReports = $educationReports->groupBy('jenis_fasilitas');
        
        return view('forms.form4.show-format2', compact('bencana', 'facilityReports', 'educationReports'));
    }

    /**
     * List all Format 2 education reports for a disaster
     */
    public function listFormat2(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::with(['kategori_bencana', 'desa'])->findOrFail($bencana_id);
        $educationReports = \App\Models\EducationReport::where('bencana_id', $bencana_id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('forms.form4.list-format2', compact('bencana', 'educationReports'));
    }

    /**
     * Display Format 16 government reports for a specific disaster
     */
    public function showFormat16($bencana_id)
    {
        // Get the disaster information
        $bencana = \App\Models\Bencana::with(['kategori_bencana', 'desa'])->findOrFail($bencana_id);
        
        // Get all government reports for this disaster
        $governmentReports = \App\Models\GovernmentReport::where('bencana_id', $bencana_id)->get();
        
        // Group the reports by type
        $facilityReports = $governmentReports->where('jenis_fasilitas', '!=', 'Kerugian Lainnya');
        $lossReports = $governmentReports->where('jenis_fasilitas', 'Kerugian Lainnya'); // Get all loss reports
        $lossReport = $lossReports->first(); // Keep for backward compatibility
        
        return view('forms.form4.show-format16', compact('bencana', 'facilityReports', 'lossReport', 'lossReports', 'governmentReports'));
    }

    /**
     * List all Format 16 government reports for a disaster
     */
    public function listFormat16(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::with(['kategori_bencana', 'desa'])->findOrFail($bencana_id);
        $governmentReports = \App\Models\GovernmentReport::where('bencana_id', $bencana_id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('forms.form4.list-format16', compact('bencana', 'governmentReports'));
    }

    /**
     * Generate PDF for Format 16 government reports
     */
    public function generateFormat16Pdf($bencana_id)
    {
        // Get the disaster information
        $bencana = Bencana::with(['kategori_bencana', 'desa'])->findOrFail($bencana_id);
        
        // Get all government reports for this disaster
        $governmentReports = GovernmentReport::where('bencana_id', $bencana_id)->get();
        
        // Group the reports by type
        $damageReports = $governmentReports->where('jenis_fasilitas', '!=', 'Kerugian Lainnya');
        $lossReport = $governmentReports->where('jenis_fasilitas', 'Kerugian Lainnya')->first();
        
        // Calculate totals for damage reports
        $totalDamageValue = 0;
        foreach ($damageReports as $report) {
            $totalDamageValue += ($report->jumlah_rb * $report->harga_rb) + 
                               ($report->jumlah_rs * $report->harga_rs) + 
                               ($report->jumlah_rr * $report->harga_rr);
        }
        
        // Calculate total loss value
        $totalLossValue = 0;
        if ($lossReport) {
            $totalLossValue = ($lossReport->tenaga_kerja_hok ?? 0) * ($lossReport->upah_harian ?? 0) +
                            ($lossReport->alat_berat_hari ?? 0) * ($lossReport->biaya_per_hari_alat_berat ?? 0) +
                            ($lossReport->jumlah_unit ?? 0) * ($lossReport->biaya_sewa_per_unit ?? 0) +
                            ($lossReport->jumlah_arsip ?? 0) * ($lossReport->harga_satuan ?? 0);
        }
        
        $totalOverall = $totalDamageValue + $totalLossValue;
        
        $data = [
            'bencana' => $bencana,
            'damageReports' => $damageReports,
            'lossReport' => $lossReport,
            'totalDamageValue' => $totalDamageValue,
            'totalLossValue' => $totalLossValue,
            'totalOverall' => $totalOverall,
            'tanggal' => date('d-m-Y'),
        ];
        
        // Load view with DomPdf and set to landscape
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.pdf.format16form4', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->download('Format16_SektorPemerintahan_' . $bencana_id . '.pdf');
    }
    
    /**
     * Preview PDF for Format 16 government reports
     */
    public function previewFormat16Pdf($bencana_id)
    {
        // Get the disaster information
        $bencana = Bencana::with(['kategori_bencana', 'desa'])->findOrFail($bencana_id);
        
        // Get all government reports for this disaster
        $governmentReports = GovernmentReport::where('bencana_id', $bencana_id)->get();
        
        // Group the reports by type
        $damageReports = $governmentReports->where('jenis_fasilitas', '!=', 'Kerugian Lainnya');
        $lossReport = $governmentReports->where('jenis_fasilitas', 'Kerugian Lainnya')->first();
        
        // Calculate totals for damage reports
        $totalDamageValue = 0;
        foreach ($damageReports as $report) {
            $totalDamageValue += ($report->jumlah_rb * $report->harga_rb) + 
                               ($report->jumlah_rs * $report->harga_rs) + 
                               ($report->jumlah_rr * $report->harga_rr);
        }
        
        // Calculate total loss value
        $totalLossValue = 0;
        if ($lossReport) {
            $totalLossValue = ($lossReport->tenaga_kerja_hok ?? 0) * ($lossReport->upah_harian ?? 0) +
                            ($lossReport->alat_berat_hari ?? 0) * ($lossReport->biaya_per_hari_alat_berat ?? 0) +
                            ($lossReport->jumlah_unit ?? 0) * ($lossReport->biaya_sewa_per_unit ?? 0) +
                            ($lossReport->jumlah_arsip ?? 0) * ($lossReport->harga_satuan ?? 0);
        }
        
        $totalOverall = $totalDamageValue + $totalLossValue;
        
        $data = [
            'bencana' => $bencana,
            'damageReports' => $damageReports,
            'lossReport' => $lossReport,
            'totalDamageValue' => $totalDamageValue,
            'totalLossValue' => $totalLossValue,
            'totalOverall' => $totalOverall,
            'tanggal' => date('d-m-Y'),
        ];
        
        // Load view with DomPdf and set to landscape
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('forms.form4.pdf.format16form4', $data)
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Format16_SektorPemerintahan_' . $bencana_id . '.pdf');
    }
}
