<?php

namespace App\Http\Controllers;

use App\Models\Bencana;
use App\Models\Form3;
use App\Models\Form3Row_1;
use App\Models\Form3Row_2;
use App\Models\Form3Row_3;
use App\Http\Requests\StoreForm3Request;
use App\Models\Form3Row_4;
use App\Models\Form3Row_5;
use App\Models\Form3Row_6;
use App\Models\Form3Row_7;
use App\Models\Form3Row_8;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class Form3Controller extends Controller
{
    /**
     * Display the form for creating a new Form3.
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
        
        // Check for existing Form3 data for this bencana
        $existingData = Form3::where('bencana_id', $bencana_id)->first();
        
        return view('forms.form3.form3', compact('bencana', 'existingData'));
    }

public function store(StoreForm3Request $request)
{
    $validated = $request->validated();

    // contoh penyimpanan sederhana
    $form = Form3::create([
        'bencana_id' => $validated['bencana_id'] ?? null,        
        'wilayah_bencana' => $validated['wilayah_bencana'] ?? null,
        'nama_opd_1'=>$validated['nama_opd_1'] ?? null,
        'tanggal_opd_1'=>$validated['tanggal_opd_1'] ?? null,
        'nama_opd_2'=>$validated['nama_opd_2'] ?? null,
        'tanggal_opd_2'=>$validated['tanggal_opd_2'] ?? null,
        'nama_opd_3'=>$validated['nama_opd_3'] ?? null,
        'tanggal_opd_3'=>$validated['tanggal_opd_3'] ?? null,
        'nama_opd_4'=>$validated['nama_opd_4'] ?? null,
        'tanggal_opd_4'=>$validated['tanggal_opd_4'] ?? null,
        'nama_opd_5'=>$validated['nama_opd_5'] ?? null,
        'tanggal_opd_5'=>$validated['tanggal_opd_5'] ?? null,
        'nama_opd_6'=>$validated['nama_opd_6'] ?? null,
        'tanggal_opd_6'=>$validated['tanggal_opd_6'] ?? null,
        'tanggal' => $validated['tanggal'] ?? null,
        'keterangan' => $validated['keterangan'] ?? null,
    ]);

    // mapping (sama seperti di blade) - gunakan shared config jika memungkinkan
    $slugs_data_dasar_sebelum_bencana = [
        1 => 'Jumlah laki-laki', 2 => 'Jumlah perempuan', 3 => 'Jumlah rumah tangga',
        4 => 'Jumlah rumah sakit', 5 => 'Jumlah PUSKESMAS', 6 => 'Jumlah PUSKESMAS Pembantu',
        7 => 'Jumlah POLINDES', 8 => 'Jumlah POSYANDU', 9 => 'Jumlah dokter',
        10 => 'Jumlah paramedis', 11 => 'Jumlah bidan', 12 => 'Jumlah kader kesehatan',
        13 => 'Jumlah kunjungan ke PUSKESMAS', 14 => 'Jumlah balita', 15 => 'Jumlah balita gizi buruk',
        16 => 'Jumlah balita gizi kurang', 17 => 'Jumlah balita ditimbang di Posyandu',
        18 => 'Jumlah manula', 19 => 'Jumlah penerima JPS kesehatan',
        20 => 'Jumlah cakupan rumah dengan air bersih', 21 => 'Jumlah cakupan rumah dengan jamban (MCK)',
        22 => 'Jumlah Keluarga Pra-Sejahtera/Miskin', 23 => 'Jumlah Keluarga Sejahtera -1',
        24 => 'Jumlah Penduduk Miskin', 25 => 'Jumlah Keluarga Penerima Beras Miskin',
        26 => 'Jumlah rumah tangga pertanian', 27 => 'Jumlah rumah tangga peternak',
        28 => 'Jumlah rumah tangga perikanan', 29 => 'Jumlah rumah tangga perkebunan',
        30 => 'Jumlah industri kecil-menengah', 31 => 'Jumlah pedagang kecil-menengah',
        32 => 'Jumlah koperasi/lembaga ekonomi masyarakat', 33 => 'Jumlah tempat wisata umum / tempat menarik',
        34 => 'Jumlah pasar', 35 => 'Jumlah tambang',
        36 => 'Jumlah masjid', 37 => 'Jumlah mushola', 38 => 'Jumlah gereja Protestan/rumah kebaktian',
        39 => 'Jumlah gereja Katolik/kapel', 40 => 'Jumlah vihara/sejenis', 41 => 'Jumlah pura/sejenis',
        42 => 'Islam (termasuk Ponpes)', 43 => 'Katolik', 44 => 'Protestan', 45 => 'Budha',
        46 => 'Hindu', 47 => 'Kepercayaan', 48 => 'Kepemudaan', 49 => 'Adat istiadat',
        50 => 'Jumlah penyandang PMKS', 51 => 'Jumlah rumah permanen', 52 => 'Jumlah rumah semi permanen',
        53 => 'Jumlah rumah non-permanen', 54 => 'Panjang jalan negara', 55 => 'Panjang jalan propinsi',
        56 => 'Panjang jalan kabupaten', 57 => 'Jumlah bangunan bersejarah',
        58 => 'Jumlah produksi komoditas pertanian', 59 => 'Jumlah produksi komoditas industri pengolahan',
        60 => 'Harga produksi (di tingkat produsen)', 61 => 'Omset pedagang', 62 => 'Jumlah penumpang transportasi',
        63 => 'Harga konstruksi untuk per M2 untuk rumah', 64 => 'Harga konstruksi untuk per M2 untuk bangunan gedung',
        65 => 'Harga konstruksi untuk per M2 untuk jalan', 66 => 'Harga konstruksi untuk per M2 untuk jembatan',
        67 => 'Harga konstruksi untuk per M2 untuk dermaga/pelabuhan', 68 => 'Harga sewa rumah',
    ];

    $groups_data_dasar_sebelum_bencana = [
        'Penduduk-Wilayah' => [1,2,3],
        'Sarana Kesehatan' => [4,5,6,7,8],
        'Tenaga Kesehatan' => [9,10,11,12],
        'Kunjungan ke PUSKESMAS' => [13],
        'Balita' => [14,15,16,17],
        'Manula' => [18],
        'Penerima JPS Kesehatan' => [19],
        'Sanitasi' => [20,21],
        'Kondisi Keluarga' => [22,23,24,25],
        'Unit Kegiatan Ekonomi' => [26,27,28,29,30,31,32,33,34,35],
        'Sarana Ibadah' => [36,37,38,39,40,41],
        'Jumlah Lembaga Sosial Masyarakat' => [42,43,44,45,46,47,48,49],
        'Penyandang PMKS' => [50],
        'Rumah' => [51,52,53],
        'Jalan' => [54,55,56],
        'Bangunan Bersejarah' => [57],
        'Produksi' => [58,59,60,61,62],
        'Harga' => [63,64,65,66,67,68],
    ];

    foreach ($validated['data_dasar_sebelum_bencana'] as $index => $value) {
        $idx = (int) $index;
        $slug = $slugs_data_dasar_sebelum_bencana[$idx] ?? null;

        Form3Row_1::create([
            'form3_id'     => $form->id,
            'kategori'     => $groupName ?? 'Lainnya',
            'sub_kategori' => $slugs_data_dasar_sebelum_bencana[$index] ?? null,
            'jawaban'      => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : (string) $value,
        ]);
    }
    
    $slug_data_sekunder_akibat_bencana_umum = [
    1 => 'Sejarah bencana di masa lalu',
    2 => 'Kronologis kejadian bencana saat ini',
    3 => 'Wilayah yang terdampak bencana saat ini',
    4 => 'Jumlah korban meninggal dunia',
    5 => 'Jumlah korban luka-luka',
    6 => 'Jumlah korban yang mengunsi',
    7 => 'Kerusakan dan kerugian yang dialami',
    ];
    
    foreach ($validated['data_sekunder_akibat_bencana_umum'] as $index => $value) {
        $idx = (int)$index;
        $slug = $slug_data_sekunder_akibat_bencana_umum[$idx] ?? null;

        Form3Row_2::create([
            'form3_id' => $form->id,
            'pertanyaan' => $slug ?? null,
            'jawaban'      => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : (string) $value,
        ]);
    }

    $slug_data_sekunder_akibat_bencana_khusus_opd_1 = [
        1 => 'Pertanian pangan dan sayuran',
        2 => 'Peternakan',
        3 => 'Perikanan',
        4 => 'Perkebunan',
        5 => 'Lainnya',
        6 => 'Pertanian pangan dan sayuran: berupa',
        7 => 'Peternakan: berupa',
        8 => 'Perikanan: berupa',
        9 => 'Perkebunan: berupa',
        10 => 'Lainnya: berupa',
        11 => 'Jenis produk pertanian lokal khas yang terkena dampak bencana',
        12 => 'Seberapa berat dampak bencana terhadap produk tersebut',
        13 => 'Kegiatan pemulihan yang dibutuhkan untuk pemulihan produk tersebut',
        14 => 'Jumlah organisasi/lembaga pertanian di lokasi bencana yang terkena dampak bencana',
        15 => 'Sebutkan bentuk-bentuk organisasi/lembaga tersebut',
        16 => 'Seberapa berat dampak bencana terhadap organisasi/lembaga pertanian tersebut',
        17 => 'Kegiatan pemulihan yang dibutuhkan untuk pemulihan organisasi/lembaga pertanian tersebut',
    ];

    $groups_data_sekunder_akibat_bencana_khusus_opd_1 = [
        'Rumah tangga yang terkena bencana dan terganggu kegiatan ekonominya:' => [1, 2, 3, 4, 5],
        'Bentuk gangguan kegiatan ekonomi, pada:' => [6, 7, 8, 9, 10],
        'Dampak pada produk pertanian lokal khas' => [11, 12, 13],
        'Dampak pada organisasi/lembaga pertanian' => [14, 15, 16, 17],
    ];

    foreach($validated['data_sekunder_akibat_bencana_khusus_opd_1'] as $index => $value) {
        $idx = (int) $index;
        $slug = $slug_data_sekunder_akibat_bencana_khusus_opd_1[$idx] ?? null;

        Form3Row_3::create([
            'form3_id' => $form->id,
            'grup' => $groupName ?? 'Lainnya',
            'pertanyaan' => $slug_data_sekunder_akibat_bencana_khusus_opd_1[$index] ?? null,
            'jawaban'      => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : (string) $value,
        ]);
    }         
    
    $slug_data_sekunder_akibat_bencana_khusus_opd_2 = [
        1 => 'Perdagangan kecil :',
        2 => 'Perdagangan menengah :',
        3 => 'Perdagangan besar :',
        4 => 'Industri kecil (rakyat) :',
        5 => 'Industri menengah :',
        6 => 'Lanjutan : <br> Jumlah Industri besar :',
        7 => 'Koperasi :',
        8 => 'Lainnya ...... :',
        9 => 'Perdagangan kecil : berupa',
        10 => 'Perdagangan menengah : berupa',
        11 => 'Perdagangan besar : berupa',
        12 => 'Industri kecil-menengah : berupa',
        13 => 'Industri besar : berupa',
        14 => 'Lainnya : berupa',
        15 => 'Jenis produk industri lokal khas yang terkena dampak bencana:',
        16 => 'Seberapa berat dampak bencana terhadap produk tersebut:',
        17 => 'Kegiatan yang dibutuhkan untuk pemulihan produk tersebut:',
        18 => 'Jumlah organisasi/lembaga koperasi di lokasi bencana yang terkena dampak bencana',
        19 => 'Seberapa berat dampak bencana terhadap organisasi/lembaga koperasi tersebut',
        20 => 'Kegiatan pemulihan yang dibutuhkan untuk pemulihan organisasi/lembaga koperasi tersebut',
    ];

    $groups_data_sekunder_akibat_bencana_khusus_opd_2 = [
        'Rumah tangga yang terkena bencana dan terganggu kegiatan ekonominya' => [1, 2, 3, 4, 5, 6, 7, 8],
        'Bentuk gangguan kegiatan ekonomi, pada' => [9, 10, 11, 12, 13, 14],
        'Dampak pada produk industri' => [15, 16, 17],
        'Dampak organisasi/lembaga koperasi' => [18, 19, 20],
    ];

    foreach ($validated['data_sekunder_akibat_bencana_khusus_opd_2'] as $index => $value) {
        $idx = (int) $index;
        $slug = $slug_data_sekunder_akibat_bencana_khusus_opd_2[$idx] ?? null;

        Form3Row_4::create([
            'form3_id' => $form->id,
            'pertanyaan' => $slug_data_sekunder_akibat_bencana_khusus_opd_2[$index] ?? null,
            'jawaban'      => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : (string) $value,
        ]);
    }

    $slug_data_sekunder_akibat_bencana_khusus_opd_3 = [
        1 => 'Jumlah rumah tangga yang kehilangan akses terhadap naungan yang layak (rumah rusak berat dan rusak sedang):',
        2 => 'Jumlah penyandang cacat akibat bencana: ',
        3 => 'Kegiatan yang dibutuhkan untuk membantu rehabilitasi penyandang cacat akibat bencana:',
        4 => 'Kegiatan agama, sosial kemasyarakatan yang terkena dampak bencana: <br> Jelaskan:',
        5 => 'Penggerak kegiatan masyarakat tersebut:',
        6 => 'Kondisi Keberfungsian kegiatan masyarakat tersebut setelah mengalami bencana:',
        7 => 'Kegiatan yang dibutuhkan untuk pemulihan kegiatan tersebut:',
        8 => 'Adakah permasalahan sosial akibat bencana? <br> Jelaskan:',
        9 => 'Kegiatan yang dibutuhkan untuk pengurangan permasalahan sosial tersebut:',
        10 => 'Adakah pengetahuan/kearifan lokal yang dapat digunakan untuk mengurangi resiko akibat bencana? <br> Jelaskan:',
    ];

    $groups_data_sekunder_akibat_bencana_khusus_opd_3 = [
        'rumah tangga' => [1],
        'penyandang cacat' => [2, 3],
        'kegiatan agama, sosial kemasyarakatan' => [4],
        'penggerak kegiatan masyarakat' => [5],
        'kondisi keberfungsian kegiatan masyarakat' => [6, 7],
        'permasalahan sosial' => [8, 9],
        'kearifan lokal' => [10],
    ];
    

    foreach ($validated['data_sekunder_akibat_bencana_khusus_opd_3'] as $index => $value) {
        $idx = (int) $index;
        $slug = $slug_data_sekunder_akibat_bencana_khusus_opd_3[$idx] ?? null;

        Form3Row_5::create([
            'form3_id' => $form->id,
            'pertanyaan' => $slug_data_sekunder_akibat_bencana_khusus_opd_3[$index] ?? null,
            'jawaban'      => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : (string) $value,
        ]);
    }

    $slug_data_sekunder_akibat_bencana_khusus_opd_4 = [
        1 => 'Permasalahan umum yang menghambat pelaksanaan pendidikan pada masa sebelum bencana (dari faktor pemberi layanan, penduduk, infrastruktur maupun bentang alam)',
        2 => 'Adakah indikasi siswa dan/atau guru terkena trauma setelah bencana?',
        3 => 'Berapa jumlah/persentase diantara mereka yang terindikasi mengalami trauma?',
        4 => 'Permasalahan pendidikan akibat bencana? <br> Jelaskan:',
        5 => 'Kegiatan yang dibutuhkan untuk pengurangan permasalahan tersebut:',
        6 => 'Jumlah sasaran:',
        7 => 'Jumlah guru yang meninggal/berpindah setelah bencana:',
        8 => 'Kegiatan yang dibutuhkan untuk mengatasi permasalahan guru yang meninggal/berpindah:',
    ];

    $groups_data_sekunder_akibat_bencana_khusus_opd_4 = [
        'Permasalahan umum yang menghambat pelaksanaan pendidikan pada masa sebelum bencana' => [1],
        'Trauma siswa dan/atau guru setelah bencana' => [2, 3],
        'Permasalahan pendidikan akibat bencana' => [4, 5, 6],
        'Guru yang meninggal/berpindah setelah bencana' => [7, 8],
    ];
    

    foreach ($validated['data_sekunder_akibat_bencana_khusus_opd_4'] as $index => $value) {
        $idx = (int) $index;
        $slug = $slug_data_sekunder_akibat_bencana_khusus_opd_4[$idx] ?? null;

        Form3Row_6::create([
            'form3_id' => $form->id,
            'pertanyaan' => $slug_data_sekunder_akibat_bencana_khusus_opd_4[$index] ?? null,
            'jawaban'      => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : (string) $value,
        ]);
    }

    $slug_data_sekunder_akibat_bencana_khusus_opd_5 = [
    1 => 'Jumlah Rukun Tetangga/Rukun Warga/Kelurahan/Kecamatan yang terganggu akibat bencana:',
    2 => 'Jenis gangguan:',
    3 => 'Kebutuhan dukungan untuk pemulihan:',
    4 => 'Adakah komunitas desa yang memiliki sistem pemeliharaan dan sarana desa?<br>
    Bila ada jelaskan:<br>',
    5 => 'Apakah sistem tersebut terganggu akibat bencana?<br>
    Jelaskan:<br>',
    6 => 'Adakah komunitas desa yang memiliki ketahanan pangan desa (lumbung dll)?<br>
    Bila ada jelaskan:<br>',
    7 => 'Apakah sistem tersebut terganggu akibat bencana?<br>
    Jelaskan:<br>',
    8 => 'Jumlah penduduk/keluarga yang kehilangan surat-surat penting (sertifikat tanah, KTP dan lain sebagainya):',
    9 => 'Kegiatan yang dibutuhkan untuk mengatasi hal tersebut:<br>',
    10 => 'Apakah pemerintah daerah memiliki rencana kontingensi untuk permasalahan administrasi penduduk?<br>
    Jelaskan:<br>',
    11 => 'Kegiatan yang dibutuhkan untuk pengurangan permasalahan tersebut:',
    12 => 'Jumlah pegawai pemerintah yang meninggal/berpindah:',
    13 => 'Dukungan yang dibutuhkan untuk mengatasi permasalahan tersebut:',
    ];

    $groups_data_sekunder_akibat_bencana_khusus_opd_5 = [
        'a' => [1, 2, 3],
        'b' => [4, 5],
        'c' => [6, 7],
        'd' => [8, 9],
        'e' => [10, 11],
        'f' => [12, 13],
    ];    

    foreach ($validated['data_sekunder_akibat_bencana_khusus_opd_5'] as $index => $value) {
        $idx = (int) $index;
        $slug = $slug_data_sekunder_akibat_bencana_khusus_opd_5[$idx] ?? null;

        Form3Row_7::create([
            'form3_id' => $form->id,
            'pertanyaan' => $slug_data_sekunder_akibat_bencana_khusus_opd_5[$index] ?? null,
            'jawaban'      => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : (string) $value,
        ]);
    }

    $slug_data_sekunder_akibat_bencana_khusus_opd_6 = [
        1 => 'Permasalahan umum yang menghambat pelaksanaan pelayanan kesehatan pada masa sebelum bencana (dari faktor pemberi layanan, penduduk, infrastruktur maupun bentang alam):',
        2 => 'Adakah indikasi penduduk trauma setelah bencana?:',
        3 => 'Berapa jumlah/persentase diantara mereka yang terindikasi mengalami trauma?:',
        4 => 'Adakah program/kegiatan kesehatan masal dalam penanggulangan dampak bencana?<br>
        Jelaskan:',
        5 => 'Permasalahan kesehatan yang umum akibat bencana?<br>
        Jelaskan:<br>',
        6 => 'Kegiatan yang dibutuhkan untuk pengurangan permasalahan tersebut:',
        7 => 'Adakah program pemberian makanan tambahan untuk balita/anak sekolah?<br>
        Jelaskan:',
        8 => 'Jumlah balita yang terdampak bencana:',
        9 => 'Jelaskan dampak bencana terhadap balita:',
        10 => 'Kegiatan yang dibutuhkan untuk mengatasi dampak bencana terhadap balita:',
        11 => 'Jumlah ibu hamil yang terdampak bencana:',
        12 => 'Jelaskan dampak bencana terhadap ibu hamil:',
        13 => 'Kegiatan yang dibutuhkan untuk mengatasi dampak bencana terhadap ibu hamil:',
        14 => 'Jumlah lansia yang terdampak bencana:',
        15 => 'Jelaskan dampak bencana terhadap lansia:',
        16 => 'Kegiatan yang dibutuhkan untuk mengatasi dampak bencana terhadap lansia',
        17 => 'Perkiraan dampak kesehatan jangka menengah akibat bencana<br>
        Jelaskan:<br>',
        18 => 'Kegiatan yang dibutuhkan untuk mengatasi dampak kesehatan jangka menengah tersebut:',
        19 => 'Jumlah tenaga kesehatan yang meninggal/berpindah setelah bencana:',
    ];

    $groups_data_sekunder_akibat_bencana_khusus_opd_6 = [
        'a' => [1],
        'b' => [2, 3],
        'c' => [4],
        'd' => [5, 6],
        'e' => [7],
        'f' => [8, 9, 10],
        'g' => [11, 12, 13],
        'h' => [14, 15, 16],
        'i' => [17, 18],
        'j' => [19],
    ];

    foreach ($validated['data_sekunder_akibat_bencana_khusus_opd_6'] as $index => $value) {
        $idx = (int) $index;
        $slug = $slug_data_sekunder_akibat_bencana_khusus_opd_6[$idx] ?? null;

        Form3Row_8::create([
            'form3_id' => $form->id,
            'pertanyaan' => $slug_data_sekunder_akibat_bencana_khusus_opd_6[$index] ?? null,
            'jawaban'      => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : (string) $value,
        ]);
    }

    
        return redirect()->route('forms.form3.show', $form->id)
            ->with('success', 'Formulir berhasil disimpan.');
}

    public function show($id)
    {
        $form = Form3::with(['bencana'])->findOrFail($id);
        return view('forms.form3.show', compact('form'));
    }

    public function list(Request $request)
    {
        $bencana_id = $request->input('bencana_id');
        
        if (!$bencana_id) {
            return redirect()->route('bencana.index', ['source' => 'forms']);
        }
        
        $bencana = Bencana::findOrFail($bencana_id);
         $form = Form3::where('bencana_id', $bencana_id)->latest()->get();
        
        return view('forms.form3.list', compact('bencana', 'form'));
    }

    public function generatePdf($id)
    {
        $form = Form3::with(['bencana'])->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form3.pdf', compact('form'));
        return $pdf->download('Formulir_03_PDNA_' . $form->id . '.pdf');
    }   

    public function previewPdf($id)
    {
        $form = Form3::with(['bencana'])->findOrFail($id);
        
        $pdf = Pdf::loadView('forms.form3.pdf', compact('form'));
        return $pdf->stream('Formulir_03_PDNA_' . $form->id . '.pdf');
    }

    public function edit($id)
    {
        try {
            $form = Form3::findOrFail($id);
            $bencana = Bencana::find($form->bencana_id);
            
            return view('forms.form3.edit', compact('form', 'bencana'));
        } catch (\Exception $e) {
            return back()->with('error', 'Data formulir tidak ditemukan.');
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $form = Form3::findOrFail($id);
            $validator = Validator::make($request->all(), [
            'bencana_id' => 'required|exists:bencana,id',
            'program_kesehatan_masal' => 'nullable|string',
            'permasalahan_kesehatan' => 'nullable|string',
            'kegiatan_permasalahan_kesehatan' => 'nullable|string',
            'program_makanan_tambahan' => 'nullable|string',
            'jumlah_balita_terdampak' => 'nullable|integer|min:0',
            'dampak_balita' => 'nullable|string',
            'kegiatan_balita' => 'nullable|string',
            'jumlah_ibu_hamil_terdampak' => 'nullable|integer|min:0',
            'dampak_ibu_hamil' => 'nullable|string',
            'kegiatan_ibu_hamil' => 'nullable|string',
            'jumlah_lansia_terdampak' => 'nullable|integer|min:0',
            'dampak_lansia' => 'nullable|string',
            'kegiatan_lansia' => 'nullable|string',
            'dampak_kesehatan_menengah' => 'nullable|string',
            'kegiatan_dampak_kesehatan' => 'nullable|string',
            'rencana_kontingensi_kesehatan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
            $form->update($request->all());

            return redirect()->route('forms.form3.show', $form->id)
                ->with('success', 'Formulir berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }    
    }

    public function destroy($id)
    {
        try {
            $form = Form3::findOrFail($id);
            $bencana_id = $form->bencana_id;
            $form->delete();
            
            return redirect()->route('forms.form3.list', ['bencana_id' => $bencana_id])
                ->with('success', 'Data Form 3 berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
