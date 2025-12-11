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
            $data = $request->only((new Format3Form4)->getFillable());

            // Validasi minimal kolom wajib

            $validated = $request->validate([

                'bencana_id' => 'required|exists:bencana,id',
                'nama_kampung' => 'required|string',
                'nama_distrik' => 'required|string',
                // Validasi untuk field harga yang diubah ke string

                'rs_rb_negeri'=>'nullable|integer', 
                'rs_rb_swasta'=>'nullable|integer',
                'rs_rs_negeri'=>'nullable|integer',
                'rs_rs_swasta'=>'nullable|integer',
                'rs_rr_negeri'=>'nullable|integer',
                'rs_rr_swasta'=>'nullable|integer',

                'rs_luas'=>'nullable|integer',
                'rs_harga_bangunan'=>'nullable|integer',
                'rs_harga_obat'=>'nullable|integer',
                'rs_harga_meubelair'=>'nullable|integer',
                'rs_harga_peralatan'=>'nullable|integer',

                
                'puskesmas_rb_negeri'=>'nullable|integer',
                'puskesmas_rb_swasta'=>'nullable|integer',
                'puskesmas_rs_negeri'=>'nullable|integer',
                'puskesmas_rs_swasta'=>'nullable|integer',
                'puskesmas_rr_negeri'=>'nullable|integer',
                'puskesmas_rr_swasta'=>'nullable|integer',
                'puskesmas_luas'=>'nullable|integer',
                'puskesmas_harga_bangunan'=>'nullable|integer',
                'puskesmas_harga_obat'=>'nullable|integer',
                'puskesmas_harga_meubelair'=>'nullable|integer',
                'puskesmas_harga_peralatan'=>'nullable|integer',

                'poliklinik_rb_negeri'=>'nullable|integer',
                'poliklinik_rb_swasta'=>'nullable|integer',
                'poliklinik_rs_negeri'=>'nullable|integer',
                'poliklinik_rs_swasta'=>'nullable|integer',
                'poliklinik_rr_negeri'=>'nullable|integer',
                'poliklinik_rr_swasta'=>'nullable|integer',
                'poliklinik_luas'=>'nullable|integer',
                'poliklinik_harga_bangunan'=>'nullable|integer',
                'poliklinik_harga_obat'=>'nullable|integer',
                'poliklinik_harga_meubelair'=>'nullable|integer',
                'poliklinik_harga_peralatan'=>'nullable|integer',

                'pustu_rb_negeri'=>'nullable|integer',
                'pustu_rb_swasta'=>'nullable|integer',
                'pustu_rs_negeri'=>'nullable|integer',
                'pustu_rs_swasta'=>'nullable|integer',
                'pustu_rr_negeri'=>'nullable|integer',
                'pustu_rr_swasta'=>'nullable|integer',
                'pustu_luas'=>'nullable|integer',
                'pustu_harga_bangunan'=>'nullable|integer',
                'pustu_harga_obat'=>'nullable|integer',
                'pustu_harga_meubelair'=>'nullable|integer',
                'pustu_harga_peralatan'=>'nullable|integer',

                'polindes_rb_negeri'=>'nullable|integer', 
                'polindes_rb_swasta'=>'nullable|integer',
                'polindes_rs_negeri'=>'nullable|integer',
                'polindes_rs_swasta'=>'nullable|integer',
                'polindes_rr_negeri'=>'nullable|integer',
                'polindes_rr_swasta'=>'nullable|integer',
                'polindes_luas'=>'nullable|integer',
                'polindes_harga_bangunan'=>'nullable|integer',
                'polindes_harga_obat'=>'nullable|integer',
                'polindes_harga_meubelair'=>'nullable|integer',
                'polindes_harga_peralatan'=>'nullable|integer',

                'posyandu_rb_negeri'=>'nullable|integer',
                'posyandu_rb_swasta'=>'nullable|integer',
                'posyandu_rs_negeri'=>'nullable|integer',
                'posyandu_rs_swasta'=>'nullable|integer',
                'posyandu_rr_negeri'=>'nullable|integer',
                'posyandu_rr_swasta'=>'nullable|integer',
                'posyandu_luas'=>'nullable|integer',
                'posyandu_harga_bangunan'=>'nullable|integer',
                'posyandu_harga_obat'=>'nullable|integer',
                'posyandu_harga_meubelair'=>'nullable|integer',
                'posyandu_harga_peralatan'=>'nullable|integer',


            ]);

            // Gabungkan semua custom fields ke dalam satu array dan tidak wajib diisi
            $customFields = [
                // Semua field tambahan dari form3form4.blade.php yang tidak ada di $fillable model
                'biaya_tenaga_kerja_hok', 'biaya_tenaga_kerja_upah', 'biaya_alat_berat_hari', 'biaya_alat_berat_harga', 'jumlah_jenazah', 'biaya_per_jenazah', 'jumlah_pasien', 'biaya_per_pasien', 'jenis_operasional', 'jumlah_faskes', 'biaya_pengadaan_faskes', 'jumlah_korban_psikologis', 'biaya_penanganan_psikologis', 'biaya_pencegahan_penyakit', 'jumlah_tenaga_kesehatan', 'honorarium_tenaga_kesehatan', 'pendapatan_faskes_swasta'
            ];
            foreach ($customFields as $field) {
                $data[$field] = $request->input($field, null); // nullable, tidak wajib diisi
            }

            // Hitung total kerusakan (termasuk semua item yang dipindahkan dari kerugian)
            $faskes = ['rs', 'puskesmas', 'poliklinik', 'pustu', 'polindes', 'posyandu'];
            $totalKerusakan = 0;
            
            // 1. Kerusakan bangunan fasilitas kesehatan
            foreach ($faskes as $f) {
                // Rusak berat (100% x harga bangunan)
                $totalKerusakan += (($data[$f.'_rb_negeri'] ?? 0) + ($data[$f.'_rb_swasta'] ?? 0)) * 
                                  ($data[$f.'_harga_bangunan'] ?? 0);
                // Rusak sedang (75% x harga bangunan)
                $totalKerusakan += (($data[$f.'_rs_negeri'] ?? 0) + ($data[$f.'_rs_swasta'] ?? 0)) * 
                                  ($data[$f.'_harga_bangunan'] ?? 0);
                // Rusak ringan (50% x harga bangunan)
                $totalKerusakan += (($data[$f.'_rr_negeri'] ?? 0) + ($data[$f.'_rr_swasta'] ?? 0)) * 
                                  ($data[$f.'_harga_bangunan'] ?? 0);
            }
            
            // 2. Biaya pembersihan puing (dipindahkan dari kerugian ke kerusakan)
            $totalKerusakan += ($data['biaya_tenaga_kerja_hok'] ?? 0) * ($data['biaya_tenaga_kerja_upah'] ?? 0);
            $totalKerusakan += ($data['biaya_alat_berat_hari'] ?? 0) * ($data['biaya_alat_berat_harga'] ?? 0);
            
            // 3. Biaya pemulasaraan jenazah (dipindahkan dari kerugian ke kerusakan)
            $totalKerusakan += ($data['jumlah_jenazah'] ?? 0) * ($data['biaya_per_jenazah'] ?? 0);
            
            // 4. Biaya perawatan korban bencana (dipindahkan dari kerugian ke kerusakan)
            $totalKerusakan += ($data['jumlah_pasien'] ?? 0) * ($data['biaya_per_pasien'] ?? 0);
            
            // 5. Biaya faskes sementara (dipindahkan dari kerugian ke kerusakan)
            $totalKerusakan += ($data['jumlah_faskes'] ?? 0) * ($data['biaya_pengadaan_faskes'] ?? 0);
            
            // 6. Biaya penanganan psikologis (dipindahkan dari kerugian ke kerusakan)
            $totalKerusakan += ($data['jumlah_korban_psikologis'] ?? 0) * ($data['biaya_penanganan_psikologis'] ?? 0);
            
            // 7. Biaya pencegahan penyakit menular (dipindahkan dari kerugian ke kerusakan)
            $totalKerusakan += ($data['biaya_pencegahan_penyakit'] ?? 0);
            
            // 8. Biaya honorarium tenaga kesehatan (dipindahkan dari kerugian ke kerusakan)
            $totalKerusakan += ($data['jumlah_tenaga_kesehatan'] ?? 0) * ($data['honorarium_tenaga_kesehatan'] ?? 0);
            
            // 9. Pendapatan faskes swasta (dipindahkan dari kerugian ke kerusakan)
            $totalKerusakan += ($data['pendapatan_faskes_swasta'] ?? 0);
            
            $data['total_kerusakan'] = $totalKerusakan;

            // Hitung total kerugian (sekarang 0 karena semua dipindahkan ke kerusakan)
            $totalKerugian = 0;
            $data['total_kerugian'] = $totalKerugian;

            $format3form4 = Format3Form4::create($data);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $format3form4
                ]);
            }

            return redirect()->route('forms.form4.list-format3', ['bencana_id' => $format3form4->bencana_id])
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
        $format3form4 = Format3Form4::with('bencana')->findOrFail($id);
        $bencana = $format3form4->bencana;
        
        return view('forms.form4.format3.show', compact('format3form4', 'bencana'));
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
        $form = Format3Form4::where('bencana_id', $bencana_id)->get();
        
        return view('forms.form4.format3.list-format3', compact('bencana', 'form'));
    }
        public function edit($id)
    {
        try {
            $format3form4 = Format3Form4::with('bencana')->findOrFail($id);
            $bencana = $format3form4->bencana;
            
            return view('forms.form4.format3.edit', compact('format3form4', 'bencana'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Data tidak ditemukan: ' . $e->getMessage()]);
        }
    }

    /**
     * Update the specified format3 data
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Find the existing record
            $format3form4 = Format3Form4::findOrFail($id);
            // Validate the request
            $validated = $request->validate([
                'bencana_id' => 'required|exists:bencana,id',
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

                // Individual harga satuan for each category
                'harga_satuan_hancur_total_permanen' => 'nullable|numeric',
                'harga_satuan_hancur_total_non_permanen' => 'nullable|numeric',
                'harga_satuan_rusak_berat_permanen' => 'nullable|numeric',
                'harga_satuan_rusak_berat_non_permanen' => 'nullable|numeric',
                'harga_satuan_rusak_sedang_permanen' => 'nullable|numeric',
                'harga_satuan_rusak_sedang_non_permanen' => 'nullable|numeric',
                'harga_satuan_rusak_ringan_permanen' => 'nullable|numeric',
                'harga_satuan_rusak_ringan_non_permanen' => 'nullable|numeric',

                // Prasarana lingkungan
                'jalan_rusak_berat' => 'nullable|numeric',
                'jalan_rusak_sedang' => 'nullable|numeric',
                'jalan_rusak_ringan' => 'nullable|numeric',
                'harga_satuan_jalan' => 'nullable|numeric',
                'saluran_rusak_berat' => 'nullable|numeric',
                'saluran_rusak_sedang' => 'nullable|numeric',
                'saluran_rusak_ringan' => 'nullable|numeric',
                'harga_satuan_saluran' => 'nullable|numeric',

                // Balai / fasilitas
                'balai_rusak_berat' => 'nullable|integer',
                'balai_rusak_sedang' => 'nullable|integer',
                'balai_rusak_ringan' => 'nullable|integer',
                'harga_satuan_balai' => 'nullable|numeric',

                // Biaya pembersihan / alat berat
                'tenaga_kerja_hok' => 'nullable|integer',
                'upah_harian' => 'nullable|numeric',
                'alat_berat_hari' => 'nullable|integer',
                'biaya_per_hari' => 'nullable|numeric',

                // Sewa / hunian sementara
                'jumlah_rumah_disewa' => 'nullable|integer',
                'harga_sewa_per_bulan' => 'nullable|numeric',
                'durasi_sewa_bulan' => 'nullable|integer',
                'jumlah_tenda' => 'nullable|integer',
                'harga_tenda' => 'nullable|numeric',
                'jumlah_barak' => 'nullable|integer',
                'harga_barak' => 'nullable|numeric',
                'jumlah_rumah_sementara' => 'nullable|integer',
                'harga_rumah_sementara' => 'nullable|numeric',
            ]);

            // Hitung total kerusakan otomatis (termasuk semua item yang dipindahkan dari kerugian)
            $total_kerusakan =
                // 1. Kerusakan rumah
                ($validated['rumah_hancur_total_permanen'] ?? 0) * ($validated['harga_satuan_hancur_total_permanen'] ?? 0) +
                ($validated['rumah_hancur_total_non_permanen'] ?? 0) * ($validated['harga_satuan_hancur_total_non_permanen'] ?? 0) +
                ($validated['rumah_rusak_berat_permanen'] ?? 0) * ($validated['harga_satuan_rusak_berat_permanen'] ?? 0) +
                ($validated['rumah_rusak_berat_non_permanen'] ?? 0) * ($validated['harga_satuan_rusak_berat_non_permanen'] ?? 0) +
                ($validated['rumah_rusak_sedang_permanen'] ?? 0) * ($validated['harga_satuan_rusak_sedang_permanen'] ?? 0) +
                ($validated['rumah_rusak_sedang_non_permanen'] ?? 0) * ($validated['harga_satuan_rusak_sedang_non_permanen'] ?? 0) +
                ($validated['rumah_rusak_ringan_permanen'] ?? 0) * ($validated['harga_satuan_rusak_ringan_permanen'] ?? 0) +
                ($validated['rumah_rusak_ringan_non_permanen'] ?? 0) * ($validated['harga_satuan_rusak_ringan_non_permanen'] ?? 0) +
                // 2. Kerusakan prasarana lingkungan
                (($validated['jalan_rusak_berat'] ?? 0) + ($validated['jalan_rusak_sedang'] ?? 0) + ($validated['jalan_rusak_ringan'] ?? 0)) * ($validated['harga_satuan_jalan'] ?? 0) +
                (($validated['saluran_rusak_berat'] ?? 0) + ($validated['saluran_rusak_sedang'] ?? 0) + ($validated['saluran_rusak_ringan'] ?? 0)) * ($validated['harga_satuan_saluran'] ?? 0) +
                (($validated['balai_rusak_berat'] ?? 0) + ($validated['balai_rusak_sedang'] ?? 0) + ($validated['balai_rusak_ringan'] ?? 0)) * ($validated['harga_satuan_balai'] ?? 0) +
                // Biaya pembersihan puing (dipindahkan dari kerugian ke kerusakan)
                ($validated['tenaga_kerja_hok'] ?? 0) * ($validated['upah_harian'] ?? 0) +
                ($validated['alat_berat_hari'] ?? 0) * ($validated['biaya_per_hari'] ?? 0) +
                // Biaya sewa rumah (dipindahkan dari kerugian ke kerusakan)
                ($validated['jumlah_rumah_disewa'] ?? 0) * ($validated['harga_sewa_per_bulan'] ?? 0) * ($validated['durasi_sewa_bulan'] ?? 0) +
                // Biaya hunian sementara (dipindahkan dari kerugian ke kerusakan)
                ($validated['jumlah_tenda'] ?? 0) * ($validated['harga_tenda'] ?? 0) +
                ($validated['jumlah_barak'] ?? 0) * ($validated['harga_barak'] ?? 0) +
                ($validated['jumlah_rumah_sementara'] ?? 0) * ($validated['harga_rumah_sementara'] ?? 0);

            // simpan total ke array validasi
            $validated['total_kerusakan'] = $total_kerusakan;
            // semua kerugian dipindah => total kerugian 0
            $validated['total_kerugian'] = 0;

            // Update the record (pastikan variabel model sama seperti yang ditemukan sebelumnya)
            $format3form4 = Format3Form4::findOrFail($id);
            $format3form4->update($validated);

            DB::commit();

            return redirect()->route('forms.form4.list-format3', ['bencana_id' => $format3form4->bencana_id])
                             ->with('success', 'Data berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()]);
        }
    }

}
