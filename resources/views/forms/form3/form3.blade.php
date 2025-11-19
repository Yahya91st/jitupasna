@extends('layouts.main')

@section('content')
    <style>
        /* Container & Layout - Konsisten dengan Form1 & Form6 */
        .container {
            max-width: 1000px;
            font-family: 'Times New Roman', serif;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Header Styling */
        .document-title {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }

        .document-title h5 {
            margin: 0.5rem 0;
            font-weight: bold;
            color: #333;
        }

        .document-title h5:first-child {
            color: #0066cc;
            margin-bottom: 0.3rem;
        }

        /* Card Styling */
        .card {
            background: white;
            border: none;
            box-shadow: none;
        }

        .card-body {
            padding: 20px 0;
        }

        /* Typography */
        p {
            margin-bottom: 0.8em;
            line-height: 1.6;
            color: #333;
        }

        /* Section Headers */
        .section-header {
            background: #f9f9f9;
            color: #333;
            font-weight: 600;
            padding: 10px 15px;
            margin: 20px 0 15px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Table Styling */
        .form-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }

        .form-table th {
            background-color: #f9f9f9;
            font-weight: 600;
            text-align: center;
            padding: 12px 8px;
            border: 1px solid #ddd;
            color: #333;
        }

        .form-table td {
            padding: 12px 8px;
            vertical-align: top;
            border: 1px solid #ddd;
        }

        .form-table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .form-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .form-table tbody tr:hover {
            background-color: rgba(0, 102, 204, 0.05);
            transition: background-color 0.2s ease;
        }

        .form-table ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        /* Three column table layout */
        .three-column-table th,
        .three-column-table td {
            box-sizing: border-box;
        }

        .three-column-table tr {
            display: table-row;
        }

        .three-column-table th:nth-child(1),
        .three-column-table td:nth-child(1) {
            width: 30%;
        }

        .three-column-table th:nth-child(2),
        .three-column-table td:nth-child(2) {
            width: 40%;
        }

        .three-column-table th:nth-child(3),
        .three-column-table td:nth-child(3) {
            width: 30%;
        }

        /* Two column table layout */
        .two-column-table th:nth-child(1),
        .two-column-table td:nth-child(1) {
            width: 40%;
        }

        .two-column-table th:nth-child(2),
        .two-column-table td:nth-child(2) {
            width: 60%;
        }

        /* Form container */
        .form-container {
            max-width: 1000px;
            font-family: "Times New Roman", serif;
            line-height: 1.6;
            padding-bottom: 20px;
        }

        /* Divider */
        .section-divider {
            margin: 30px 0;
            border-top: 1px solid #ddd;
        }

        /* Form Inputs */
        .form-input {
            background: transparent;
            border: none;
            border-bottom: 1px dotted #333;
            font-family: 'Times New Roman', serif;
            font-size: 14px;
            color: inherit;
            outline: none;
            padding: 2px 4px;
            transition: border-color 0.3s ease;
            line-height: 1.5;
        }

        .form-input:focus {
            border-bottom-color: #0066cc;
            background-color: rgba(0, 102, 204, 0.05);
        }

        textarea.form-input {
            resize: vertical;
            min-height: 60px;
            border: 1px dotted #333;
            padding: 8px;
            line-height: 1.5;
            border-radius: 3px;
        }

        textarea.form-input:focus {
            border-color: #0066cc;
            background-color: rgba(0, 102, 204, 0.05);
        }

        .form-label {
            display: inline-block;
            width: 160px;
            font-weight: 500;
            vertical-align: top;
            margin-right: 5px;
            color: #333;
        }

        /* Answer cell styles */
        .three-column-table td:nth-child(3) {
            position: relative;
        }

        /* Dotted line for form fields */
        .dotted-line {
            display: inline-block;
            border-bottom: 1px dotted #333;
            min-width: 300px;
            height: 1.2em;
            vertical-align: bottom;
        }

        /* List item spacing */
        .form-list-item {
            margin-bottom: 8px;
        }

        .form-list-item:last-child {
            margin-bottom: 0;
        }

        /* Button Styling */
        .btn {
            margin: 0 5px;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            font-family: 'Times New Roman', serif;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-warning {
            background: #ffc107;
            color: #212529;
        }

        .btn-info {
            background: #17a2b8;
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        /* Action buttons container */
        .d-flex {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .form-table {
                font-size: 12px;
            }

            .form-input {
                font-size: 12px;
            }

            .btn {
                margin: 2px;
                padding: 6px 12px;
                font-size: 12px;
            }
        }

        /* Print Styles */
        @media print {
            .btn {
                display: none !important;
            }

            .container {
                box-shadow: none;
                margin: 0;
                padding: 10px;
            }

            body {
                font-size: 12pt;
                line-height: 1.4;
            }
        }
    </style>

    <form method="POST" action="{{ route('forms.form3.store') }}">
        @csrf
        <input type="hidden" name="form_type" value="form3">
        <input type="hidden" name="bencana_id" value="{{ request('bencana_id') }}">

        <div class="container" style="max-width: 1000px; font-family: Times New Roman, serif;">
            <!-- Document Header -->
            <div class="document-title">
                <h5><strong>Formulir 03</strong></h5>
                <h5>Pendataan ke OPD</h5>
            </div>

            <div class="card">
                <div class="card-body">
                    <h6 class="section-header">1. Formulir Isian Data Dasar Sebelum Bencana</h6>
                    <p>
                        <span class="form-label">Wilayah bencana</span>
                        <span>Kab/kota/kecamatan: </span>
                        <input type="text" class="form-input" style="width: 300px; border-inline-color" name="wilayah_bencana">
                    </p>

                    <table class="form-table three-column-table">
                        <thead class="text-center">
                            <tr>
                                <th>Kategori</th>
                                <th>Sub-Kategori</th>
                                <th>Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                // mapping index ke slug sesuai permintaan
                                $slugs_data_dasar_sebelum_bencana = [
                                    // Penduduk-Wilayah
                                    1 => 'Jumlah laki-laki',
                                    2 => 'Jumlah perempuan',
                                    3 => 'Jumlah rumah tangga',
                                    // Kesehatan
                                    // Sarana Kesehatan
                                    4 => 'Jumlah rumah sakit',
                                    5 => 'Jumlah PUSKESMAS',
                                    6 => 'Jumlah PUSKESMAS Pembantu',
                                    7 => 'Jumlah POLINDES',
                                    8 => 'Jumlah POSYANDU',
                                    // Tenaga Kesehatan
                                    9 => 'Jumlah dokter',
                                    10 => 'Jumlah paramedis',
                                    11 => 'Jumlah bidan',
                                    12 => 'Jumlah kader kesehatan',
                                    // Kunjungan ke PUSKESMAS
                                    13 => 'Jumlah kunjungan ke PUSKESMAS',
                                    // Balita
                                    14 => 'Jumlah balita',
                                    15 => 'Jumlah balita gizi buruk',
                                    16 => 'Jumlah balita gizi kurang',
                                    17 => 'Jumlah balita ditimbang di Posyandu',
                                    // Manula
                                    18 => 'Jumlah manula',
                                    // Penerima JPS Kesehatan
                                    19 => 'Jumlah penerima JPS kesehatan',
                                    // Sanitasi
                                    20 => 'Jumlah cakupan rumah dengan air bersih',
                                    21 => 'Jumlah cakupan rumah dengan jamban (MCK)',
                                    // Ekonomi
                                    // Kondisi Keluarga
                                    22 => 'Jumlah Keluarga Pra-Sejahtera/Miskin',
                                    23 => 'Jumlah Keluarga Sejahtera -1',
                                    24 => 'Jumlah Penduduk Miskin',
                                    25 => 'Jumlah Keluarga Penerima Beras Miskin',
                                    // Unit Kegiatan Ekonomi
                                    26 => 'Jumlah rumah tangga pertanian',
                                    27 => 'Jumlah rumah tangga peternak',
                                    28 => 'Jumlah rumah tangga perikanan',
                                    29 => 'Jumlah rumah tangga perkebunan',
                                    30 => 'Jumlah industri kecil-menengah',
                                    31 => 'Jumlah pedagang kecil-menengah',
                                    32 => 'Jumlah koperasi/lembaga ekonomi masyarakat',
                                    33 => 'Jumlah tempat wisata umum / tempat menarik',
                                    34 => 'Jumlah pasar',
                                    35 => 'Jumlah tambang',
                                    // Sosial dan Agama
                                    // Sarana Ibadah
                                    36 => 'Jumlah masjid',
                                    37 => 'Jumlah mushola',
                                    38 => 'Jumlah gereja Protestan/rumah kebaktian',
                                    39 => 'Jumlah gereja Katolik/kapel',
                                    40 => 'Jumlah vihara/sejenis',
                                    41 => 'Jumlah pura/sejenis',
                                    // Jumlah Lembaga Sosial Masyarakat
                                    42 => 'Islam (termasuk Ponpes)',
                                    43 => 'Katolik',
                                    44 => 'Protestan',
                                    45 => 'Budha',
                                    46 => 'Hindu',
                                    47 => 'Kepercayaan',
                                    48 => 'Kepemudaan',
                                    49 => 'Adat istiadat',
                                    // Penyandang PMKS
                                    50 => 'Jumlah penyandang PMKS',
                                    // Perumahan
                                    // Rumah
                                    51 => 'Jumlah rumah permanen',
                                    52 => 'Jumlah rumah semi permanen',
                                    53 => 'Jumlah rumah non-permanen',
                                    // Jalan
                                    // Jalan
                                    54 => 'Panjang jalan negara',
                                    55 => 'Panjang jalan propinsi',
                                    56 => 'Panjang jalan kabupaten',
                                    // Bangunan dan Produksi
                                    // Bangunan Bersejarah
                                    57 => 'Jumlah bangunan bersejarah',
                                    // Produksi
                                    58 => 'Jumlah produksi komoditas pertanian',
                                    59 => 'Jumlah produksi komoditas industri pengolahan',
                                    60 => 'Harga produksi (di tingkat produsen)',
                                    61 => 'Omset pedagang',
                                    62 => 'Jumlah penumpang transportasi',
                                    // Harga
                                    63 => 'Harga konstruksi untuk per M2 untuk rumah',
                                    64 => 'Harga konstruksi untuk per M2 untuk bangunan gedung',
                                    65 => 'Harga konstruksi untuk per M2 untuk jalan',
                                    66 => 'Harga konstruksi untuk per M2 untuk jembatan',
                                    67 => 'Harga konstruksi untuk per M2 untuk dermaga/pelabuhan',
                                    68 => 'Harga sewa rumah',
                                ];

                                $groups_data_dasar_sebelum_bencana = [
                                    'Penduduk-Wilayah' => [1, 2, 3],
                                    'Sarana Kesehatan' => [4, 5, 6, 7, 8],
                                    'Tenaga Kesehatan' => [9, 10, 11, 12],
                                    'Kunjungan ke PUSKESMAS' => [13],
                                    'Balita' => [14, 15, 16, 17],
                                    'Manula' => [18],
                                    'Penerima JPS Kesehatan' => [19],
                                    'Sanitasi' => [20, 21],
                                    'Kondisi Keluarga' => [22, 23, 24, 25],
                                    'Unit Kegiatan Ekonomi' => [26, 27, 28, 29, 30, 31, 32, 33, 34, 35],
                                    'Sarana Ibadah' => [36, 37, 38, 39, 40, 41],
                                    'Jumlah Lembaga Sosial Masyarakat' => [42, 43, 44, 45, 46, 47, 48, 49],
                                    'Penyandang PMKS' => [50],
                                    'Rumah' => [51, 52, 53],
                                    'Jalan' => [54, 55, 56],
                                    'Bangunan Bersejarah' => [57],
                                    'Produksi' => [58, 59, 60, 61, 62],
                                    'Harga' => [63, 64, 65, 66, 67, 68],
                                ];
                            @endphp

                            @foreach ($groups_data_dasar_sebelum_bencana as $groupName => $indexes)
                                @foreach ($indexes as $idx)
                                    @php $slug = $slugs_data_dasar_sebelum_bencana[$idx] ?? 'dll'; @endphp
                                    <tr>
                                        @if ($loop->first)
                                            <td rowspan="{{ count($indexes) }}">{{ $groupName }}</td>
                                        @endif
                                        <td>{{ $slug }}</td>
                                        <td><input type="text" class="form-input" style="width: 100%;" name="data_dasar_sebelum_bencana[{{ $idx }}]"></td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>

                    <p class="mt-3"><small><strong>Sumber data:</strong> Badan Pusat Statistik (BPS), data daerah (Provinsi, Kab/Kota) dalam angka, data kecamatan/kelurahan serta data OPD terkait</small></p>

                    <div class="section-divider"></div>

                    <h6 class="section-header">2. Formulir Isian Data Sekunder Akibat Bencana (Umum)</h6>
                    <table class="form-table two-column-table">
                        <thead class="text-center">
                            <tr>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $slug_data_sekunder_akibat_bencana_umum = [
                                    1 => 'Sejarah bencana di masa lalu',
                                    2 => 'Kronologis kejadian bencana saat ini',
                                    3 => 'Wilayah yang terdampak bencana saat ini',
                                    4 => 'Jumlah korban meninggal dunia',
                                    5 => 'Jumlah korban luka-luka',
                                    6 => 'Jumlah korban yang mengunsi',
                                    7 => 'Kerusakan dan kerugian yang dialami',
                                ];
                            @endphp

                            @foreach ($slug_data_sekunder_akibat_bencana_umum as $idx => $slug)
                                @php $slug = $slug_data_sekunder_akibat_bencana_umum[$idx] ?? 'dll'; @endphp
                                <tr>
                                    <td>{{ $slug }}</td>
                                    <td>
                                        <textarea name="data_sekunder_akibat_bencana_umum[{{ $idx }}]" class="form-input" rows="3" style="width: 100%; border: none; border-bottom: 1px dotted #999;"></textarea>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="section-divider"></div>

                    <h6 class="section-header">3. Formulir Isian Data Sekunder Akibat Bencana (Khusus)</h6>
                    <p><strong>Satuan Kerja Perangkat Daerah</strong></p>
                    <table class="form-table">
                        <tr>
                            <td style="width: 30%;">Nama OPD</td>
                            <td>: <input type="text" class="form-input" style="width: calc(100% - 10px);" name="nama_opd_1" value="{{ $existingData->nama_opd_1 ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td>Tgl/Bln/Thn</td>
                            <td>: <input type="date" class="form-input" style="width: calc(100% - 10px);" name="tanggal_opd_1" value="{{ $existingData->tanggal_opd_1 ?? '' }}"></td>
                        </tr>
                    </table>

                    <table class="form-table" style="margin-top: 20px;">
                        <thead class="text-center">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>POKOK BAHASAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
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
                            @endphp

                            @foreach ($groups_data_sekunder_akibat_bencana_khusus_opd_1 as $groupName => $indexes)
                                @foreach ($indexes as $idx)
                                    @php $slug = $slug_data_sekunder_akibat_bencana_khusus_opd_1[$idx] ?? 'dll'; @endphp
                                    <tr>
                                        @if ($loop->first)
                                            <td rowspan="{{ count($indexes) }}">{{ $loop->parent->iteration }}</td> {{-- nomor grup: 1,2,... --}}
                                        @endif

                                        <td>
                                            @if ($loop->first)
                                                <strong>{{ $groupName }}</strong><br>
                                            @endif
                                            {{ $slug }}</br><input type="text" class="form-input" style="width: 300px;" name="data_sekunder_akibat_bencana_khusus_opd_1[{{ $idx }}]">
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>

                    <div class="section-divider"></div>

                    <p><strong>SATUAN KERJA PERANGKAT DAERAH</strong></p>
                    <table class="form-table">
                        <tr>
                            <td style="width: 30%;">Nama OPD</td>
                            <td>: <input type="text" class="form-input" style="width: calc(100% - 10px);" name="nama_opd_2" placeholder="OPD yang terkait dengan Bidang Non Pertanian: Perdagangan, Perindustrian, Koperasi, Usaha Kecil Menengah dll">
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl/Bln/Thn</td>
                            <td>: <input type="date" class="form-input" style="width: calc(100% - 10px);" name="tanggal_opd_2"></td>
                        </tr>
                    </table>

                    <table class="form-table" style="margin-top: 20px;">
                        <thead class="text-center">
                            <tr>
                                <th style="width: 5%;">NO</th>
                                <th>POKOK BAHASAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
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
                            @endphp
                            @foreach ($groups_data_sekunder_akibat_bencana_khusus_opd_2 as $groupName => $indexes)
                                @foreach ($indexes as $idx)
                                    @php $slug = $slug_data_sekunder_akibat_bencana_khusus_opd_2[$idx] ?? 'dll'; @endphp
                                    <tr>
                                        @if ($loop->first)
                                            <td rowspan="{{ count($indexes) }}">{{ $loop->parent->iteration }}</td> {{-- nomor grup: 1,2,... --}}
                                        @endif

                                        <td>
                                            @if ($loop->first)
                                                <strong>{{ $groupName }}</strong><br>
                                            @endif
                                            {!! $slug !!}</br><input type="text" class="form-input" style="width: 300px;" name="data_sekunder_akibat_bencana_khusus_opd_2[{{ $idx }}]">
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3" style="background: #f9f9f9; padding: 15px; border-radius: 4px; border-left: 3px solid #0066cc;">
                        <p style="margin-bottom: 10px;"><em><strong>Catatan:</strong> perlunya menjabarkan batasan operasional/pengertian dari setiap istilah:</em></p>
                        <div style="margin-bottom: 8px;">
                            Perdagangan kecil adalah <input type="text" class="form-input" style="width: calc(100% - 200px);" name="def_perdagangan_kecil">
                        </div>
                        <div style="margin-bottom: 8px;">
                            Perdagangan besar adalah <input type="text" class="form-input" style="width: calc(100% - 210px);" name="def_perdagangan_besar">
                        </div>
                        <div style="margin-bottom: 8px;">
                            Industri kecil adalah <input type="text" class="form-input" style="width: calc(100% - 180px);" name="def_industri_kecil">
                        </div>
                        <div>
                            Industri besar adalah <input type="text" class="form-input" style="width: calc(100% - 190px);" name="def_industri_besar">
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <p><strong>SATUAN KERJA PERANGKAT DAERAH</strong></p>
                    <table class="form-table">
                        <tr>
                            <td style="width: 30%;">Nama OPD</td>
                            <td>: <input type="text" class="form-input" style="width: calc(100% - 10px);" name="nama_opd_sosial" placeholder="OPD yang terkait dengan Bidang Sosial dan Keagamaan">
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl/Bln/Thn</td>
                            <td>: <input type="date" class="form-input" style="width: calc(100% - 10px);" name="tanggal_opd_sosial"></td>
                        </tr>
                    </table>

                    <table class="form-table" style="margin-top: 20px;">
                        <thead class="text-center">
                            <tr>
                                <th style="width: 5%;">NO</th>
                                <th>POKOK BAHASAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
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
                            @endphp

                            @foreach ($groups_data_sekunder_akibat_bencana_khusus_opd_3 as $groupName => $indexes)
                                @foreach ($indexes as $idx)
                                    @php $slug = $slug_data_sekunder_akibat_bencana_khusus_opd_3[$idx] ?? 'dll'; @endphp
                                    <tr>
                                        @if ($loop->first)
                                            <td rowspan="{{ count($indexes) }}">{{ $loop->parent->iteration }}</td>
                                        @endif

                                        <td>
                                            {!! $slug !!}</br><input type="text" class="form-input" style="width: 300px;" name="data_sekunder_akibat_bencana_khusus_opd_3[{{ $idx }}]">
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>

                    <div class="section-divider"></div>

                    <p><strong>SATUAN KERJA PERANGKAT DAERAH</strong></p>
                    <table class="table table-bordered form-table" border="1">
                        <tr>
                            <td style="width: 30%;">Nama OPD</td>
                            <td>: <input type="text" class="form-input" style="width: calc(100% - 10px);" name="nama_opd_pendidikan" placeholder="OPD yang terkait dengan Pendidikan">
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl/Bln/Thn</td>
                            <td>: <input type="date" class="form-input" style="width: calc(100% - 10px);" name="tanggal_opd_pendidikan"></td>
                        </tr>
                    </table>

                    <table class="table table-bordered form-table" border="1" style="margin-top: 20px;">
                        <thead class="text-center">
                            <tr>
                                <th style="width: 5%;">NO</th>
                                <th>POKOK BAHASAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php

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
                            @endphp

                            @foreach ($groups_data_sekunder_akibat_bencana_khusus_opd_4 as $groupName => $indexes)
                                @foreach ($indexes as $idx)
                                    @php $slug = $slug_data_sekunder_akibat_bencana_khusus_opd_4[$idx] ?? 'dll'; @endphp
                                    <tr>
                                        @if ($loop->first)
                                            <td rowspan="{{ count($indexes) }}">{{ $loop->parent->iteration }}</td>
                                        @endif

                                        <td>
                                            {!! $slug !!}</br><input type="text" class="form-input" style="width: 300px;" name="data_sekunder_akibat_bencana_khusus_opd_4[{{ $idx }}]">
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>

                    <div class="section-divider"></div>

                    <p><strong>SATUAN KERJA PERANGKAT DAERAH</strong></p>
                    <table class="table table-bordered form-table" border="1">
                        <tr>
                            <td style="width: 30%;">Nama OPD</td>
                            <td>: <input type="text" class="form-input" style="width: calc(100% - 10px);" name="nama_opd_sekretariat" placeholder="OPD Sekretariat Daerah">
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl/Bln/Thn</td>
                            <td>: <input type="date" class="form-input" style="width: calc(100% - 10px);" name="tanggal_opd_sekretariat"></td>
                        </tr>
                    </table>

                    <table class="table table-bordered form-table" border="1" style="margin-top: 20px;">
                        <thead class="text-center">
                            <tr>
                                <th style="width: 5%;">NO</th>
                                <th>POKOK BAHASAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php

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
                            @endphp

                            @foreach ($groups_data_sekunder_akibat_bencana_khusus_opd_5 as $groupName => $indexes)
                                @foreach ($indexes as $idx)
                                    @php $slug = $slug_data_sekunder_akibat_bencana_khusus_opd_5[$idx] ?? 'dll'; @endphp
                                    <tr>
                                        @if ($loop->first)
                                            <td rowspan="{{ count($indexes) }}">{{ $loop->parent->iteration }}</td>
                                        @endif

                                        <td>
                                            {!! $slug !!}</br><input type="text" class="form-input" style="width: 300px;" name="data_sekunder_akibat_bencana_khusus_opd_5[{{ $idx }}]">
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>

                    <div class="section-divider"></div>

                    <p><strong>SATUAN KERJA PERANGKAT DAERAH</strong></p>
                    <table class="table table-bordered form-table" border="1">
                        <tr>
                            <td style="width: 30%;">Nama OPD</td>
                            <td>: <input type="text" class="form-input" style="width: calc(100% - 10px);" name="nama_opd_kesehatan" placeholder="Dinas Kesehatan">
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl/Bln/Thn</td>
                            <td>: <input type="date" class="form-input" style="width: calc(100% - 10px);" name="tanggal_opd_kesehatan"></td>
                        </tr>
                    </table>

                    <table class="table table-bordered form-table" border="1" style="margin-top: 20px;">
                        <thead class="text-center">
                            <tr>
                                <th>NO</th>
                                <th>POKOK BAHASAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php

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
                            @endphp

                            @foreach ($groups_data_sekunder_akibat_bencana_khusus_opd_6 as $groupName => $indexes)
                                @foreach ($indexes as $idx)
                                    @php $slug = $slug_data_sekunder_akibat_bencana_khusus_opd_6[$idx] ?? 'dll'; @endphp
                                    <tr>
                                        @if ($loop->first)
                                            <td rowspan="{{ count($indexes) }}">{{ $loop->parent->iteration }}</td>
                                        @endif

                                        <td>
                                            {!! $slug !!}</br><input type="text" class="form-input" style="width: 300px;" name="data_sekunder_akibat_bencana_khusus_opd_6[{{ $idx }}]">
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Tombol Aksi -->
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-3">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Simpan Data
                        </button>
                        <button type="reset" class="btn btn-warning" onclick="resetForm()">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </button>
                        <button type="button" class="btn btn-info" onclick="printForm()">
                            <i class="bi bi-printer"></i> Cetak
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="previewForm()">
                            <i class="bi bi-eye"></i> Preview
                        </button>
                    </div>
                </div>
            </div>
    </form>

    <script>
        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset semua data form?')) {
                document.querySelector('form').reset();
            }
        }

        function printForm() {
            window.print();
        }

        function previewForm() {
            // Create preview window
            const previewWindow = window.open('', '_blank', 'width=800,height=600,scrollbars=yes');
            const formContent = document.querySelector('.container').cloneNode(true);

            // Remove buttons from preview
            const buttons = formContent.querySelectorAll('button');
            buttons.forEach(btn => btn.style.display = 'none');

            // Remove input borders for preview
            const inputs = formContent.querySelectorAll('.form-input');
            inputs.forEach(input => {
                const span = document.createElement('span');
                span.textContent = input.value || input.placeholder || '';
                span.style.borderBottom = '1px solid #000';
                span.style.minWidth = '100px';
                span.style.display = 'inline-block';
                input.parentNode.replaceChild(span, input);
            });

            previewWindow.document.write(`
        <html>
        <head>
            <title>Preview Form 3</title>
            <style>
                body { font-family: 'Times New Roman', serif; padding: 20px; }
                .table { border-collapse: collapse; }
                .table td, .table th { border: 1px solid #000; }
            </style>
        </head>
        <body>
            ${formContent.outerHTML}
        </body>
        </html>
    `);
            previewWindow.document.close();
        }
    </script>
@endsection
