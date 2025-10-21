<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Form6;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class Form6Controller extends Controller
{
    /**
     * Display the form
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
        
        return view('forms.form6.form6', compact('bencana'));
    }

    /**
     * Store a new form submission
     */
    public function store(Request $request)
    {
        // Daftar semua nama field checkbox di form6
        $checkboxes = [
            'nafkah_pre_suami', 'nafkah_pre_istri', 'nafkah_pre_anak', 'nafkah_pre_lain',
            'nafkah_post_suami', 'nafkah_post_istri', 'nafkah_post_anak', 'nafkah_post_lain',
            'sumber_pertanian', 'sumber_peternakan', 'sumber_dagang', 'sumber_industri', 'sumber_jasa', 'sumber_pegawai', 'sumber_pertukangan', 'sumber_lain',
            'bantuan_keterampilan', 'bantuan_peralatan', 'bantuan_modal', 'bantuan_pasar', 'bantuan_lain',
            'cadangan_tabungan', 'cadangan_pinjaman', 'cadangan_barang', 'cadangan_ternak', 'cadangan_jamsos', 'cadangan_lain',
            'dukungan_koperasi', 'dukungan_kelompok', 'dukungan_pinjaman', 'dukungan_pemerintah', 'dukungan_lain',
            'bantu_lindung_penyuluhan', 'bantu_lindung_moral', 'bantu_lindung_polisi', 'bantu_lindung_pos', 'bantu_lindung_rumah', 'bantu_lindung_lain',
            'masalah_rumah_relokasi', 'masalah_rumah_rusak', 'masalah_rumah_belum', 'masalah_rumah_lain',
            'tindakan_rumah_stimulus', 'tindakan_rumah_kredit', 'tindakan_rumah_teknis', 'tindakan_rumah_lain',
            'makanan_bantuan', 'makanan_cadangan', 'makanan_tanaman', 'makanan_lain',
            'dukungan_pangan_langsung', 'dukungan_pangan_pulih', 'dukungan_pangan_gotong', 'dukungan_pangan_lain',
            'air_kurang', 'air_kotor', 'air_simpan', 'air_lain',
            'dukungan_air_sedia', 'dukungan_air_pulih', 'dukungan_air_simpan', 'dukungan_air_lain',
            'perbaikan_obat', 'perbaikan_medis', 'perbaikan_jarak', 'perbaikan_biaya', 'perbaikan_psiko', 'perbaikan_lain',
            'dukungan_pend_guru', 'dukungan_pend_alat', 'dukungan_pend_biaya', 'dukungan_pend_trans', 'dukungan_pend_dekat', 'dukungan_pend_bangun', 'dukungan_pend_lain',
            'dukungan_agama_stimulus', 'dukungan_agama_latih', 'dukungan_agama_izin', 'dukungan_agama_lain',
            'cegah_info', 'cegah_latih', 'cegah_rencana', 'cegah_fasilitas', 'cegah_warning', 'cegah_komunitas', 'cegah_budaya', 'cegah_lain',
            'butuh_anak', 'butuh_lansia', 'butuh_difabel', 'butuh_hamil', 'butuh_lain'
        ];

        // Set semua checkbox yang tidak ada di request menjadi 0
        foreach ($checkboxes as $cb) {
            if (!$request->has($cb)) {
                $request->merge([$cb => 0]);
            }
        }

        $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'enumerator' => 'required|string|max:100',
            'tgl_wawancara' => 'required|date',
            'paraf_enum' => 'nullable|string|max:100',
            'data_entry' => 'required|string|max:100',
            'tgl_entry' => 'required|date',
            'paraf_entry' => 'nullable|string|max:100',

            // Informasi Umum
            'responden' => 'required|in:l,p',
            'umur' => 'required|in:20,21_30,31_40,41_50,50plus',
            'nama' => 'required|string|max:100',
            'desa' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'pendidikan' => 'required|in:sd,sltp,slta,pt',
            'krt_perempuan' => 'required|in:ya,tidak',
            'jumlah_anggota' => 'required|in:3,3_5,5plus',
            'jumlah_anak' => 'required|in:1,2,3,3plus',
            'jumlah_balita' => 'required|in:1,2,3,3plus',
            'tipe_hunian' => 'required|in:sendiri,tumpangan,huntara,pengungsian,fasum,lain',

            // Pertanyaan 1
            'nafkah_pre_suami' => 'nullable|boolean',
            'nafkah_pre_istri' => 'nullable|boolean',
            'nafkah_pre_anak' => 'nullable|boolean',
            'nafkah_pre_lain' => 'nullable|boolean',
            'nafkah_pre_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 2
            'nafkah_post_suami' => 'nullable|boolean',
            'nafkah_post_istri' => 'nullable|boolean',
            'nafkah_post_anak' => 'nullable|boolean',
            'nafkah_post_lain' => 'nullable|boolean',
            'nafkah_post_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 3
            'sumber_pertanian' => 'nullable|boolean',
            'sumber_peternakan' => 'nullable|boolean',
            'sumber_dagang' => 'nullable|boolean',
            'sumber_industri' => 'nullable|boolean',
            'sumber_jasa' => 'nullable|boolean',
            'sumber_pegawai' => 'nullable|boolean',
            'sumber_pertukangan' => 'nullable|boolean',
            'sumber_lain' => 'nullable|boolean',
            'sumber_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 4
            'penghasilan_hilang' => 'nullable|in:ada,tidak',

            // Pertanyaan 5
            'bantuan_keterampilan' => 'nullable|boolean',
            'bantuan_peralatan' => 'nullable|boolean',
            'bantuan_modal' => 'nullable|boolean',
            'bantuan_pasar' => 'nullable|boolean',
            'bantuan_lain' => 'nullable|boolean',
            'bantuan_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 6
            'cadangan_tabungan' => 'nullable|boolean',
            'cadangan_pinjaman' => 'nullable|boolean',
            'cadangan_barang' => 'nullable|boolean',
            'cadangan_ternak' => 'nullable|boolean',
            'cadangan_jamsos' => 'nullable|boolean',
            'cadangan_lain' => 'nullable|boolean',
            'cadangan_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 7
            'dukungan_koperasi' => 'nullable|boolean',
            'dukungan_kelompok' => 'nullable|boolean',
            'dukungan_pinjaman' => 'nullable|boolean',
            'dukungan_pemerintah' => 'nullable|boolean',
            'dukungan_lain' => 'nullable|boolean',
            'dukungan_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 8
            'perlindungan' => 'nullable|in:meningkat,menurun,sama',

            // Pertanyaan 9
            'bantu_lindung_penyuluhan' => 'nullable|boolean',
            'bantu_lindung_moral' => 'nullable|boolean',
            'bantu_lindung_polisi' => 'nullable|boolean',
            'bantu_lindung_pos' => 'nullable|boolean',
            'bantu_lindung_rumah' => 'nullable|boolean',
            'bantu_lindung_lain' => 'nullable|boolean',
            'bantu_lindung_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 10
            'masalah_rumah_relokasi' => 'nullable|boolean',
            'masalah_rumah_rusak' => 'nullable|boolean',
            'masalah_rumah_belum' => 'nullable|boolean',
            'masalah_rumah_lain' => 'nullable|boolean',
            'masalah_rumah_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 11
            'tindakan_rumah_stimulus' => 'nullable|boolean',
            'tindakan_rumah_kredit' => 'nullable|boolean',
            'tindakan_rumah_teknis' => 'nullable|boolean',
            'tindakan_rumah_lain' => 'nullable|boolean',
            'tindakan_rumah_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 12
            'perkiraan_tinggal' => 'nullable|in:rumah_asal,desa_asal,tempat_lain',
            'perkiraan_tempat_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 13
            'makanan_bantuan' => 'nullable|boolean',
            'makanan_cadangan' => 'nullable|boolean',
            'makanan_tanaman' => 'nullable|boolean',
            'makanan_lain' => 'nullable|boolean',
            'makanan_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 14
            'dukungan_pangan_langsung' => 'nullable|boolean',
            'dukungan_pangan_pulih' => 'nullable|boolean',
            'dukungan_pangan_gotong' => 'nullable|boolean',
            'dukungan_pangan_lain' => 'nullable|boolean',
            'dukungan_pangan_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 15
            'air_kurang' => 'nullable|boolean',
            'air_kotor' => 'nullable|boolean',
            'air_simpan' => 'nullable|boolean',
            'air_lain' => 'nullable|boolean',
            'air_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 16
            'dukungan_air_sedia' => 'nullable|boolean',
            'dukungan_air_pulih' => 'nullable|boolean',
            'dukungan_air_simpan' => 'nullable|boolean',
            'dukungan_air_lain' => 'nullable|boolean',
            'dukungan_air_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 17
            'pelayanan_kesehatan' => 'nullable|in:memadai,tidak',

            // Pertanyaan 18
            'perbaikan_obat' => 'nullable|boolean',
            'perbaikan_medis' => 'nullable|boolean',
            'perbaikan_jarak' => 'nullable|boolean',
            'perbaikan_biaya' => 'nullable|boolean',
            'perbaikan_psiko' => 'nullable|boolean',
            'perbaikan_lain' => 'nullable|boolean',
            'perbaikan_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 19
            'sekolah_terganggu' => 'nullable|in:ya,tidak',

            // Pertanyaan 20
            'dukungan_pend_guru' => 'nullable|boolean',
            'dukungan_pend_alat' => 'nullable|boolean',
            'dukungan_pend_biaya' => 'nullable|boolean',
            'dukungan_pend_trans' => 'nullable|boolean',
            'dukungan_pend_dekat' => 'nullable|boolean',
            'dukungan_pend_bangun' => 'nullable|boolean',
            'dukungan_pend_lain' => 'nullable|boolean',
            'dukungan_pend_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 21
            'agama_terganggu' => 'nullable|in:ya,tidak',

            // Pertanyaan 22
            'dukungan_agama_stimulus' => 'nullable|boolean',
            'dukungan_agama_latih' => 'nullable|boolean',
            'dukungan_agama_izin' => 'nullable|boolean',
            'dukungan_agama_lain' => 'nullable|boolean',
            'dukungan_agama_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 23
            'cegah_info' => 'nullable|boolean',
            'cegah_latih' => 'nullable|boolean',
            'cegah_rencana' => 'nullable|boolean',
            'cegah_fasilitas' => 'nullable|boolean',
            'cegah_warning' => 'nullable|boolean',
            'cegah_komunitas' => 'nullable|boolean',
            'cegah_budaya' => 'nullable|boolean',
            'cegah_lain' => 'nullable|boolean',
            'cegah_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 24
            'butuh_anak' => 'nullable|boolean',
            'butuh_lansia' => 'nullable|boolean',
            'butuh_difabel' => 'nullable|boolean',
            'butuh_hamil' => 'nullable|boolean',
            'butuh_lain' => 'nullable|boolean',
            'butuh_lain_text' => 'nullable|string|max:100',

            // Pertanyaan 25
            'penghasilan_suami' => 'nullable|string|max:100',
            'bidang_suami' => 'nullable|string|max:100',
            'penghasilan_istri' => 'nullable|string|max:100',
            'bidang_istri' => 'nullable|string|max:100',
            'penghasilan_lainnya' => 'nullable|string|max:100',
            'bidang_lainnya' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $form = Form6::create($request->all());

        return redirect()->route('forms.form6.show', $form->id)
            ->with('success', 'Formulir berhasil disimpan.');
    }

    /**
     * Display a specific form entry     */    
    public function show($id)
    {
        $form = Form6::with(['bencana'])->findOrFail($id);
        return view('forms.form6.show', compact('form'));
    }

    /**
     * List all form entries for a specific bencana
     */
    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::findOrFail($bencana_id);
        $form = Form6::where('bencana_id', $bencana_id)->latest()->get();
        
        return view('forms.form6.list', compact('bencana', 'form'));
    }

    /**
     * Generate PDF for form data
     */    
    public function generatePdf($id)
    {
        $rumahtangga = Form6::with(['bencana'])->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form6.pdf', compact('rumahtangga'));
        return $pdf->download('Formulir_06_PDNA_' . $rumahtangga->id . '.pdf');
    }   

    /**
     * Preview PDF without downloading
     */    
    public function previewPdf($id)
    {
        $rumahtangga = Form6::with(['bencana'])->findOrFail($id);
                
        $pdf = Pdf::loadView('forms.form6.pdf', compact('rumahtangga'));
        return $pdf->stream('Formulir_06_PDNA_' . $rumahtangga->id . '.pdf');
    }

    /**
     * Show the form for editing the specified form.
     */
    public function edit($id)
    {
        try {
            $form = Form6::findOrFail($id);
            $bencana = Bencana::find($form->bencana_id);
            
            return view('forms.form6.edit', compact('form', 'bencana'));
        } catch (\Exception $e) {
            return back()->with('error', 'Data formulir tidak ditemukan.');
        }
    }
    
    /**
     * Update the specified form in database.
     */
    public function update(Request $request, $id)
    {
        try {
            $form = Form6::findOrFail($id);
            
            $validator = Validator::make($request->all(), [
                'kop_surat' => 'nullable|string|max:255',
                'nomor_surat' => 'required|string|max:255',
                'nomor_surat_date' => 'required|date',
                'sifat' => 'required|in:Segera,Biasa,Rahasia',
                'lampiran' => 'nullable|integer|min:0',
                'kepada_jabatan' => 'required|string',
                'lokasi_pdna' => 'required|string|max:255',
                'hari_tanggal' => 'required|string|max:255',
                'waktu' => 'required|string|max:255',
                'tempat' => 'required|string|max:255',
                'agenda' => 'required|string',
                'nama_penandatangan' => 'required|string|max:255',
                'tembusan' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $form->update($request->all());
            
            return redirect()->route('forms.form6.show', $form->id)
                ->with('success', 'Formulir berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }    
    }

    public function destroy($id)
    {
        try {
            $form = Form6::findOrFail($id);
            $bencana_id = $form->bencana_id;
            $form->delete();
            
            return redirect()->route('forms.form6.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 6 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Generate contoh PDF dengan data dummy
     */
    public function contohPdf()
    {
        $bencana = (object)[
            'bencana' => (object)[
                'nama_bencana' => 'Gempa Bumi',
                'tanggal' => '2025-10-10',
                'lokasi' => 'Kecamatan Sukamaju, Kabupaten Cianjur'
            ]
        ];

        $form = (object)[
            'nama_kk' => 'Ahmad Wijaya',
            'nik_kk' => '3201010101010001',
            'jumlah_anggota' => 5,
            'nomor_hp' => '081234567890',
            'dusun' => 'Sukamaju',
            'rt' => '02',
            'rw' => '05',
            'desa' => 'Sukamaju',
            'kecamatan' => 'Cianjur',
            'kabupaten' => 'Cianjur',
            'provinsi' => 'Jawa Barat',
            'status_rumah' => 'Milik Sendiri',
            'status_hunian' => 'Masih Dihuni',
            'kategori_kerusakan' => 'Rusak Berat',
            'kebutuhan_material' => 'Semen, Batu Bata, Genteng',
            'kebutuhan_sdm' => 'Tukang Bangunan, Relawan',
            'kebutuhan_dana' => 15000000,
            'status_bantuan' => 'Ya',
            'jenis_bantuan' => 'Dana Tunai, Material Bangunan',
            'nominal_bantuan' => 5000000,
            'pemberi_bantuan' => 'BPBD Cianjur',
            'keterangan_tambahan' => 'Keluarga membutuhkan bantuan tambahan untuk renovasi dapur.',
            'foto_rumah' => 'dummy_rumah.jpg',
            'foto_ktp' => 'dummy_ktp.jpg',
            'foto_kk' => 'dummy_kk.jpg',
            'createdBy' => (object)[
                'name' => 'Budi Santoso'
            ]
        ];

        $pdf = Pdf::loadView('forms.form6.contoh_form6_pdf', compact('bencana', 'form'));
        return $pdf->stream('Contoh_Formulir_06_PDNA.pdf');
    }
}