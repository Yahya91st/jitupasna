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

            $validated = $request->validated([
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
        
        return view('forms.form4.format3.list-format3', compact('bencana', '$form'));
    }
}
