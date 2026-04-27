<?php

namespace App\Http\Controllers\Form4;

use App\Http\Controllers\Controller;
use App\Models\Bencana;
use App\Models\Format3Form4;
use App\Models\Rekap;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // gunakan data yang tervalidasi sebagai dasar
        $data = array_merge($data, $validated);

        // Gabungkan semua custom fields (nullable)
        $customFields = [
            'biaya_tenaga_kerja_hok', 'biaya_tenaga_kerja_upah',
            'biaya_alat_berat_hari', 'biaya_alat_berat_harga',
            'jumlah_jenazah', 'biaya_per_jenazah',
            'jumlah_pasien', 'biaya_per_pasien',
            'jenis_operasional', 'jumlah_faskes', 'biaya_pengadaan_faskes',
            'jumlah_korban_psikologis', 'biaya_penanganan_psikologis',
            'biaya_pencegahan_penyakit', 'jumlah_tenaga_kesehatan',
            'honorarium_tenaga_kesehatan', 'pendapatan_faskes_swasta'
        ];
        foreach ($customFields as $field) {
            $data[$field] = $request->input($field, null);
        }

        // Hitung total kerusakan (dinamis seperti di update)
        $faskes = ['rs', 'puskesmas', 'poliklinik', 'pustu', 'polindes', 'posyandu'];
        $weights = ['rb' => 1.0, 'rs' => 0.75, 'rr' => 0.5];
        $totalKerusakan = 0.0;

        foreach ($faskes as $f) {
            $price = floatval($data["{$f}_harga_bangunan"] ?? 0);
            foreach ($weights as $suf => $w) {
                $count = intval($data["{$f}_{$suf}_negeri"] ?? 0) + intval($data["{$f}_{$suf}_swasta"] ?? 0);
                $totalKerusakan += $count * $price * $w;
            }
        }

        // Tambahan item dari kerugian
        $totalKerusakan += (floatval($data['biaya_tenaga_kerja_hok'] ?? 0) * floatval($data['biaya_tenaga_kerja_upah'] ?? 0));
        $totalKerusakan += (floatval($data['biaya_alat_berat_hari'] ?? 0) * floatval($data['biaya_alat_berat_harga'] ?? 0));
        $totalKerusakan += (intval($data['jumlah_jenazah'] ?? 0) * floatval($data['biaya_per_jenazah'] ?? 0));
        $totalKerusakan += (intval($data['jumlah_pasien'] ?? 0) * floatval($data['biaya_per_pasien'] ?? 0));
        $totalKerusakan += (intval($data['jumlah_faskes'] ?? 0) * floatval($data['biaya_pengadaan_faskes'] ?? 0));
        $totalKerusakan += (intval($data['jumlah_korban_psikologis'] ?? 0) * floatval($data['biaya_penanganan_psikologis'] ?? 0));
        $totalKerusakan += floatval($data['biaya_pencegahan_penyakit'] ?? 0);
        $totalKerusakan += (intval($data['jumlah_tenaga_kesehatan'] ?? 0) * floatval($data['honorarium_tenaga_kesehatan'] ?? 0));
        $totalKerusakan += floatval($data['pendapatan_faskes_swasta'] ?? 0);

        $data['total_kerusakan'] = $totalKerusakan;
        $data['total_kerugian'] = 0;

        // Cari atau buat rekap berdasarkan bencana_id
        $rekap = Rekap::firstOrCreate([
            'bencana_id' => $validated['bencana_id']
        ]);

        // Simpan data Format3Form4 dengan rekap_id
        $data = $validated;
        $data['rekap_id'] = $rekap->id;
        // unset($data['bencana_id']); // pastikan tidak ada bencana_id di insert

        // Create sekali setelah semua field siap
        $format3form4 = Format3Form4::create($data);

        DB::commit();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan', 'data' => $format3form4]);
        }

        return redirect()->route('forms.form4.format3.list', ['bencana_id' => $rekap->bencana_id])
            ->with('success', 'Data berhasil disimpan');

    } catch (\Exception $e) {
        DB::rollBack();
        if ($request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
        return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. ' . $e->getMessage()]);
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
        $form = Format3Form4::where('rekap_id', $bencana_id)->get();
        
        return view('forms.form4.format3.list', compact('bencana', 'form'));
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
            
            // baru: hitung kerusakan untuk setiap fasilitas secara dinamis menggunakan field yang tersedia
            $faskes = ['rs', 'puskesmas', 'poliklinik', 'pustu', 'polindes', 'posyandu'];
            $weights = [
                'rb' => 1.0,   // rusak berat = 100%
                'rs' => 0.75,  // rusak sedang = 75%
                'rr' => 0.5,   // rusak ringan = 50%
            ];

            $total_kerusakan = 0;

            foreach ($faskes as $f) {
                $priceField = "{$f}_harga_bangunan";
                $price = floatval($validated[$priceField] ?? 0);

                foreach ($weights as $suffix => $weight) {
                    $negeriField = "{$f}_{$suffix}_negeri";
                    $swastaField = "{$f}_{$suffix}_swasta";
                    $count = intval($validated[$negeriField] ?? 0) + intval($validated[$swastaField] ?? 0);
                    $total_kerusakan += $count * $price * $weight;
                }
            }

            // Tambahan item yang dipindahkan dari kerugian ke kerusakan
            $total_kerusakan += (floatval($validated['biaya_tenaga_kerja_hok'] ?? 0) * floatval($validated['biaya_tenaga_kerja_upah'] ?? 0));
            $total_kerusakan += (floatval($validated['biaya_alat_berat_hari'] ?? 0) * floatval($validated['biaya_alat_berat_harga'] ?? 0));
            $total_kerusakan += (intval($validated['jumlah_jenazah'] ?? 0) * floatval($validated['biaya_per_jenazah'] ?? 0));
            $total_kerusakan += (intval($validated['jumlah_pasien'] ?? 0) * floatval($validated['biaya_per_pasien'] ?? 0));
            $total_kerusakan += (intval($validated['jumlah_faskes'] ?? 0) * floatval($validated['biaya_pengadaan_faskes'] ?? 0));
            $total_kerusakan += (intval($validated['jumlah_korban_psikologis'] ?? 0) * floatval($validated['biaya_penanganan_psikologis'] ?? 0));
            $total_kerusakan += floatval($validated['biaya_pencegahan_penyakit'] ?? 0);
            $total_kerusakan += (intval($validated['jumlah_tenaga_kesehatan'] ?? 0) * floatval($validated['honorarium_tenaga_kesehatan'] ?? 0));
            $total_kerusakan += floatval($validated['pendapatan_faskes_swasta'] ?? 0);

            // simpan total ke array validasi
            $validated['total_kerusakan'] = $total_kerusakan;
            // semua kerugian dipindah => total kerugian 0
            $validated['total_kerugian'] = 0;

            // Update the record (pastikan variabel model sama seperti yang ditemukan sebelumnya)
            $format3form4 = Format3Form4::findOrFail($id);
            $format3form4->update($validated);

            DB::commit();

            return redirect()->route('forms.form4.format3.list', ['bencana_id' => $format3form4->bencana_id])
                             ->with('success', 'Data berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()]);
        }
    }
        public function destroy($id)
    {
        $format3form4 = Format3Form4::findOrFail($id);
        $bencana_id = $format3form4->bencana_id;
        $format3form4->delete();
        return redirect()->route('forms.form4.format3.list', ['bencana_id' => $bencana_id])
            ->with('success', 'Data berhasil dihapus');
    }


}
