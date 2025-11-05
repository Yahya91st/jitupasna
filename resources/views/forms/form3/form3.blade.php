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
                        <input type="text" class="form-input" style="width: 300px;" name="wilayah_bencana">
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
                            <!-- Penduduk-Wilayah -->
                            <tr>
                                <td rowspan="3">Penduduk-Wilayah</td>
                                <td>Jumlah laki-laki</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah perempuan</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah rumah tangga</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <!-- Kesehatan -->
                            <tr>
                                <td rowspan="5">Sarana Kesehatan</td>
                                <td>Jumlah rumah sakit</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah PUSKESMAS</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah PUSKESMAS Pembantu</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah POLINDES</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah POSYANDU</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <tr>
                                <td rowspan="4">Tenaga Kesehatan</td>
                                <td>Jumlah dokter</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah paramedis</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah bidan</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah kader kesehatan</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <tr>
                                <td>Kunjungan ke PUSKESMAS</td>
                                <td>Jumlah kunjungan ke PUSKESMAS</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <tr>
                                <td rowspan="4">Balita</td>
                                <td>Jumlah balita</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah balita gizi buruk</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah balita gizi kurang</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah balita ditimbang di Posyandu</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <tr>
                                <td>Manula</td>
                                <td>Jumlah manula</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <tr>
                                <td>Penerima JPS Kesehatan</td>
                                <td>Jumlah penerima JPS kesehatan</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <tr>
                                <td rowspan="2">Sanitasi</td>
                                <td>Jumlah cakupan rumah dengan air bersih</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah cakupan rumah dengan jamban (MCK)</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <!-- Ekonomi -->
                            <tr>
                                <td rowspan="4">Kondisi Keluarga</td>
                                <td>Jumlah Keluarga Pra-Sejahtera/Miskin</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah Keluarga Sejahtera -1</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah Penduduk Miskin</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah Keluarga Penerima Beras Miskin</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <tr>
                                <td rowspan="10">Unit Kegiatan Ekonomi</td>
                                <td>Jumlah rumah tangga pertanian</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah rumah tangga peternak</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah rumah tangga perikanan</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah rumah tangga perkebunan</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah industri kecil-menengah</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah pedagang kecil-menengah</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah koperasi/lembaga ekonomi masyarakat</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah tempat wisata umum / tempat menarik</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah pasar</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah tambang</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <!-- Sosial dan Agama -->
                            <tr>
                                <td rowspan="6">Sarana Ibadah</td>
                                <td>Jumlah masjid</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah mushola</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah gereja Protestan/rumah kebaktian</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah gereja Katolik/kapel</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah vihara/sejenis</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah pura/sejenis</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <tr>
                                <td rowspan="8">Jumlah Lembaga Sosial Masyarakat</td>
                                <td>Islam (termasuk Ponpes)</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Katolik</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Protestan</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Budha</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Hindu</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Kepercayaan</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Kepemudaan</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Adat istiadat</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <tr>
                                <td>Penyandang PMKS</td>
                                <td>Jumlah penyandang PMKS</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <!-- Perumahan -->
                            <tr>
                                <td rowspan="3">Rumah</td>
                                <td>Jumlah rumah permanen</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah rumah semi permanen</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah rumah non-permanen</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <!-- Jalan -->
                            <tr>
                                <td rowspan="3">Jalan</td>
                                <td>Panjang jalan negara</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Panjang jalan propinsi</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Panjang jalan kabupaten</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <!-- Bangunan dan Produksi -->
                            <tr>
                                <td>Bangunan Bersejarah</td>
                                <td>Jumlah bangunan bersejarah</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <tr>
                                <td rowspan="5">Produksi</td>
                                <td>Jumlah produksi komoditas pertanian</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah produksi komoditas industri pengolahan</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Harga produksi (di tingkat produsen)</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Omset pedagang</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah penumpang transportasi</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>

                            <!-- Harga -->
                            <tr>
                                <td rowspan="6">Harga</td>
                                <td>Harga konstruksi untuk per M2 untuk rumah</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Harga konstruksi untuk per M2 untuk bangunan gedung</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Harga konstruksi untuk per M2 untuk jalan</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Harga konstruksi untuk per M2 untuk jembatan</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Harga konstruksi untuk per M2 untuk dermaga/pelabuhan</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Harga sewa rumah</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
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
                            <tr>
                                <td>Sejarah bencana di masa lalu</td>
                                <td>
                                    <textarea class="form-input" rows="3" style="width: 100%; border: none; border-bottom: 1px dotted #999;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Kronologis kejadian bencana saat ini</td>
                                <td>
                                    <textarea class="form-input" rows="3" style="width: 100%; border: none; border-bottom: 1px dotted #999;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Wilayah yang terdampak bencana saat ini</td>
                                <td>
                                    <textarea class="form-input" rows="3" style="width: 100%; border: none; border-bottom: 1px dotted #999;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Jumlah korban meninggal dunia</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah korban luka-luka</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Jumlah korban yang mengunsi</td>
                                <td><input type="text" class="form-input" style="width: 100%;"></td>
                            </tr>
                            <tr>
                                <td>Kerusakan dan kerugian yang dialami</td>
                                <td>
                                    <textarea class="form-input" rows="3" style="width: 100%; border: none; border-bottom: 1px dotted #999;"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="section-divider"></div>

                    <h6 class="section-header">3. Formulir Isian Data Sekunder Akibat Bencana (Khusus)</h6>
                    <p><strong>Satuan Kerja Perangkat Daerah</strong></p>
                    <table class="form-table">
                        <tr>
                            <td style="width: 30%;">Nama OPD</td>
                            <td>: <input type="text" class="form-input" style="width: calc(100% - 10px);" name="nama_opd_1"></td>
                        </tr>
                        <tr>
                            <td>Tgl/Bln/Thn</td>
                            <td>: <input type="date" class="form-input" style="width: calc(100% - 10px);" name="tanggal_opd_1"></td>
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
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    <strong>Rumah tangga yang terkena bencana dan terganggu kegiatan ekonominya:</strong>
                                    <ul>
                                        <li class="form-list-item">Pertanian pangan dan sayuran: <input type="text" class="form-input" style="width: 300px;" name="rt_pertanian"></li>
                                        <li class="form-list-item">Peternakan: <input type="text" class="form-input" style="width: 300px;" name="rt_peternakan"></li>
                                        <li class="form-list-item">Perikanan: <input type="text" class="form-input" style="width: 300px;" name="rt_perikanan"></li>
                                        <li class="form-list-item">Perkebunan: <input type="text" class="form-input" style="width: 300px;" name="rt_perkebunan"></li>
                                        <li class="form-list-item">Lainnya: <input type="text" class="form-input" style="width: 300px;" name="rt_lainnya"></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <strong>Bentuk gangguan kegiatan ekonomi, pada:</strong>
                                    <ul>
                                        <li class="form-list-item">Pertanian pangan dan sayuran: berupa <input type="text" class="form-input" style="width: 250px;" name="gangguan_pertanian"></li>
                                        <li class="form-list-item">Peternakan: berupa <input type="text" class="form-input" style="width: 250px;" name="gangguan_peternakan"></li>
                                        <li class="form-list-item">Perikanan: berupa <input type="text" class="form-input" style="width: 250px;" name="gangguan_perikanan"></li>
                                        <li class="form-list-item">Perkebunan: berupa <input type="text" class="form-input" style="width: 250px;" name="gangguan_perkebunan"></li>
                                        <li class="form-list-item">Lainnya: berupa <input type="text" class="form-input" style="width: 250px;" name="gangguan_lainnya"></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>
                                    <div class="mb-3">
                                        <strong>Jenis produk pertanian lokal khas yang terkena dampak bencana:</strong><br>
                                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #333; margin-top: 5px;" name="produk_pertanian_terdampak"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Seberapa berat dampak bencana terhadap produk tersebut:</strong><br>
                                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #333; margin-top: 5px;" name="dampak_produk_pertanian"></textarea>
                                    </div>

                                    <div>
                                        <strong>Kegiatan pemulihan yang dibutuhkan untuk pemulihan produk tersebut:</strong><br>
                                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #333; margin-top: 5px;" name="pemulihan_produk_pertanian"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>
                                    <div class="mb-3">
                                        <strong>Jumlah organisasi/lembaga pertanian di lokasi bencana yang terkena dampak bencana .... unit.</strong><br>
                                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #999; margin-top: 5px;"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Sebutkan bentuk-bentuk organisasi/lembaga tersebut..........</strong><br>
                                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #999; margin-top: 5px;"></textarea>
                                    </div>

                                    <div>
                                        <strong>Seberapa berat dampak bencana terhadap organisasi/lembaga pertanian tersebut.......</strong><br>
                                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #999; margin-top: 5px;"></textarea>
                                    </div>
                                    <div>
                                        <strong>Kegiatan pemulihan yang dibutuhkan untuk pemulihan organisasi/lembaga pertanian tersebut.......</strong><br>
                                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #999; margin-top: 5px;"></textarea>
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="section-divider"></div>

                    <h6 class="section-header">4. Formulir Lanjutan: Satuan Kerja Perangkat Daerah</h6>

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
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    Rumah tangga yang <strong>terkena bencana</strong> dan <strong>terganggu kegiatan ekonominya:</strong><br>
                                    Perdagangan kecil : <input type="text" class="form-input" style="width: 300px;" name="rt_perdagangan_kecil"><br>
                                    Perdagangan menengah : <input type="text" class="form-input" style="width: 300px;" name="rt_perdagangan_menengah"><br>
                                    Perdagangan besar : <input type="text" class="form-input" style="width: 300px;" name="rt_perdagangan_besar"><br>
                                    Industri kecil (rakyat) : <input type="text" class="form-input" style="width: 300px;" name="rt_industri_kecil"><br>
                                    Industri menengah : <input type="text" class="form-input" style="width: 300px;" name="rt_industri_menengah"><br>
                                    <em>Lanjutan:</em><br>
                                    Industri besar : <input type="text" class="form-input" style="width: 300px;" name="rt_industri_besar"><br>
                                    Koperasi : <input type="text" class="form-input" style="width: 300px;" name="rt_koperasi"><br>
                                    Lainnya ...... : <input type="text" class="form-input" style="width: 300px;" name="rt_lainnya_2">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    Bentuk gangguan kegiatan ekonomi, pada:<br>
                                    Perdagangan kecil : berupa <input type="text" class="form-input" style="width: calc(100% - 200px);" name="gangguan_perdagangan_kecil"><br>
                                    Perdagangan menengah : berupa <input type="text" class="form-input" style="width: calc(100% - 250px);" name="gangguan_perdagangan_menengah"><br>
                                    Perdagangan besar : berupa <input type="text" class="form-input" style="width: calc(100% - 220px);" name="gangguan_perdagangan_besar"><br>
                                    Industri kecil-menengah : berupa <input type="text" class="form-input" style="width: calc(100% - 250px);" name="gangguan_industri_kecil_menengah"><br>
                                    Industri besar : berupa <input type="text" class="form-input" style="width: calc(100% - 180px);" name="gangguan_industri_besar"><br>
                                    Lainnya : berupa <input type="text" class="form-input" style="width: calc(100% - 150px);" name="gangguan_lainnya_2"><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>
                                    <div class="mb-3">
                                        <strong>Jenis produk industri lokal khas yang terkena dampak bencana:</strong><br>
                                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #333; margin-top: 5px;" name="produk_industri_terdampak"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Seberapa berat dampak bencana terhadap produk tersebut:</strong><br>
                                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #333; margin-top: 5px;" name="dampak_produk_industri"></textarea>
                                    </div>

                                    <div>
                                        <strong>Kegiatan yang dibutuhkan untuk pemulihan produk tersebut:</strong><br>
                                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #333; margin-top: 5px;" name="pemulihan_produk_industri"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>
                                    <div class="mb-3">
                                        <strong>Jumlah organisasi/lembaga koperasi di lokasi bencana yang terkena dampak bencana</strong><br>
                                        <input type="text" class="form-input" style="width: 150px;" name="jumlah_koperasi_terdampak"> unit.
                                    </div>

                                    <div class="mb-3">
                                        <strong>Seberapa berat dampak bencana terhadap organisasi/lembaga koperasi tersebut</strong><br>
                                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #333; margin-top: 5px;" name="dampak_koperasi"></textarea>
                                    </div>

                                    <div>
                                        <strong>Kegiatan pemulihan yang dibutuhkan untuk pemulihan organisasi/lembaga koperasi tersebut</strong><br>
                                        <textarea class="form-input" rows="2" style="width: 100%; border: none; border-bottom: 1px dotted #333; margin-top: 5px;" name="pemulihan_koperasi"></textarea>
                                    </div>
                                </td>
                            </tr>
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
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    Jumlah rumah tangga yang kehilangan akses terhadap naungan yang layak (rumah rusak berat dan rusak sedang): 
                                    <input type="text" class="form-input" style="width: 200px;" name="jumlah_rt_kehilangan_naungan">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <div class="mb-2">
                                        Jumlah penyandang cacat akibat bencana: 
                                        <input type="text" class="form-input" style="width: 150px;" name="jumlah_penyandang_cacat">
                                    </div>
                                    <div>
                                        Kegiatan yang dibutuhkan untuk membantu rehabilitasi penyandang cacat akibat bencana:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kegiatan_rehabilitasi_cacat"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>
                                    Kegiatan agama, sosial kemasyarakatan yang terkena dampak bencana:<br>
                                    Jelaskan:<br>
                                    <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kegiatan_agama_sosial_terdampak"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>
                                    Penggerak kegiatan masyarakat tersebut:<br>
                                    <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="penggerak_kegiatan_masyarakat"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td>
                                    <div class="mb-2">
                                        Kondisi Keberfungsian kegiatan masyarakat tersebut setelah mengalami bencana:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kondisi_kegiatan_masyarakat"></textarea>
                                    </div>
                                    <div>
                                        Kegiatan yang dibutuhkan untuk pemulihan kegiatan tersebut:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kegiatan_pemulihan_masyarakat"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">6</td>
                                <td>
                                    <div class="mb-2">
                                        Adakah permasalahan sosial akibat bencana?<br>
                                        Jelaskan:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="permasalahan_sosial"></textarea>
                                    </div>
                                    <div>
                                        Kegiatan yang dibutuhkan untuk pengurangan permasalahan sosial tersebut:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kegiatan_pengurangan_masalah_sosial"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">7</td>
                                <td>
                                    Adakah pengetahuan/kearifan lokal yang dapat digunakan untuk mengurangi resiko akibat bencana?<br>
                                    Jelaskan:<br>
                                    <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kearifan_lokal"></textarea>
                                </td>
                            </tr>
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
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    Permasalahan umum yang menghambat pelaksanaan pendidikan pada masa sebelum bencana (dari faktor pemberi layanan, penduduk, infrastruktur maupun bentang alam):<br>
                                    <textarea class="form-input" rows="3" style="width: 100%; margin-top: 5px;" name="permasalahan_pendidikan_sebelum_bencana"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <div class="mb-2">
                                        Adakah indikasi siswa dan/atau guru terkena trauma setelah bencana?: 
                                        <input type="text" class="form-input" style="width: 200px;" name="indikasi_trauma_pendidikan">
                                    </div>
                                    <div>
                                        Berapa jumlah/persentase diantara mereka yang terindikasi mengalami trauma?: 
                                        <input type="text" class="form-input" style="width: 200px;" name="jumlah_trauma_pendidikan">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>
                                    <div class="mb-2">
                                        Permasalahan pendidikan akibat bencana?<br>
                                        Jelaskan:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="permasalahan_pendidikan_bencana"></textarea>
                                    </div>
                                    <div class="mb-2">
                                        Kegiatan yang dibutuhkan untuk pengurangan permasalahan tersebut:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kegiatan_permasalahan_pendidikan"></textarea>
                                    </div>
                                    <div>
                                        Jumlah sasaran: 
                                        <input type="text" class="form-input" style="width: 200px;" name="jumlah_sasaran_pendidikan">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>
                                    <div class="mb-2">
                                        Jumlah guru yang meninggal/berpindah setelah bencana: 
                                        <input type="text" class="form-input" style="width: 200px;" name="jumlah_guru_meninggal_pindah">
                                    </div>
                                    <div>
                                        Kegiatan yang dibutuhkan untuk mengatasi permasalahan guru yang meninggal/berpindah:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kegiatan_guru_meninggal_pindah"></textarea>
                                    </div>
                                </td>
                            </tr>
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
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    <div class="mb-2">
                                        Jumlah Rukun Tetangga/Rukun Warga/Kelurahan/Kecamatan yang terganggu akibat bencana: 
                                        <input type="text" class="form-input" style="width: 150px;" name="jumlah_rt_rw_terganggu">
                                    </div>
                                    <div class="mb-2">
                                        Jenis gangguan:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="jenis_gangguan_rt_rw"></textarea>
                                    </div>
                                    <div>
                                        Kebutuhan dukungan untuk pemulihan:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kebutuhan_dukungan_pemulihan"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <div class="mb-2">
                                        Adakah komunitas desa yang memiliki sistem pemeliharaan dan sarana desa?<br>
                                        Bila ada jelaskan:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="sistem_pemeliharaan_desa"></textarea>
                                    </div>
                                    <div>
                                        Apakah sistem tersebut terganggu akibat bencana?<br>
                                        Jelaskan:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="gangguan_sistem_pemeliharaan"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>
                                    <div class="mb-2">
                                        Adakah komunitas desa yang memiliki ketahanan pangan desa (lumbung dll)?<br>
                                        Bila ada jelaskan:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="ketahanan_pangan_desa"></textarea>
                                    </div>
                                    <div>
                                        Apakah sistem tersebut terganggu akibat bencana?<br>
                                        Jelaskan:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="gangguan_ketahanan_pangan"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>
                                    <div class="mb-2">
                                        Jumlah penduduk/keluarga yang kehilangan surat-surat penting (sertifikat tanah, KTP dan lain sebagainya): 
                                        <input type="text" class="form-input" style="width: 150px;" name="jumlah_kehilangan_surat">
                                    </div>
                                    <div>
                                        Kegiatan yang dibutuhkan untuk mengatasi hal tersebut:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kegiatan_kehilangan_surat"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td>
                                    <div class="mb-2">
                                        Apakah pemerintah daerah memiliki rencana kontingensi untuk permasalahan administrasi penduduk?<br>
                                        Jelaskan:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="rencana_kontingensi_administrasi"></textarea>
                                    </div>
                                    <div>
                                        Kegiatan yang dibutuhkan untuk pengurangan permasalahan tersebut:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kegiatan_kontingensi_administrasi"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">6</td>
                                <td>
                                    <div class="mb-2">
                                        Jumlah pegawai pemerintah yang meninggal/berpindah: 
                                        <input type="text" class="form-input" style="width: 150px;" name="jumlah_pegawai_meninggal_pindah">
                                    </div>
                                    <div>
                                        Dukungan yang dibutuhkan untuk mengatasi permasalahan tersebut:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="dukungan_pegawai_meninggal_pindah"></textarea>
                                    </div>
                                </td>
                            </tr>
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
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    Permasalahan umum yang menghambat pelaksanaan pelayanan kesehatan pada masa sebelum bencana (dari faktor pemberi layanan, penduduk, infrastruktur maupun bentang alam):<br>
                                    <textarea class="form-input" rows="3" style="width: 100%; margin-top: 5px;" name="permasalahan_kesehatan_sebelum_bencana"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <div class="mb-2">
                                        Adakah indikasi penduduk trauma setelah bencana?: 
                                        <input type="text" class="form-input" style="width: 200px;" name="indikasi_trauma_kesehatan">
                                    </div>
                                    <div>
                                        Berapa jumlah/persentase diantara mereka yang terindikasi mengalami trauma?: 
                                        <input type="text" class="form-input" style="width: 200px;" name="jumlah_trauma_kesehatan">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>
                                    Adakah program/kegiatan kesehatan masal dalam penanggulangan dampak bencana?<br>
                                    Jelaskan: 
                                    <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="program_kesehatan_masal"></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">4</td>
                                <td>
                                    <div class="mb-2">
                                        Permasalahan kesehatan yang umum akibat bencana?<br>
                                        Jelaskan:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="permasalahan_kesehatan"></textarea>
                                    </div>
                                    <div>
                                        Kegiatan yang dibutuhkan untuk pengurangan permasalahan tersebut:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kegiatan_permasalahan_kesehatan"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td>
                                    Adakah program pemberian makanan tambahan untuk balita/anak sekolah?<br>
                                    Jelaskan: 
                                    <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="program_makanan_tambahan"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">6</td>
                                <td>
                                    <div class="mb-2">
                                        Jumlah balita yang terdampak bencana: 
                                        <input type="number" name="jumlah_balita_terdampak" class="form-input" style="width: 150px;">
                                    </div>
                                    <div class="mb-2">
                                        Jelaskan dampak bencana terhadap balita:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="dampak_balita"></textarea>
                                    </div>
                                    <div>
                                        Kegiatan yang dibutuhkan untuk mengatasi dampak bencana terhadap balita:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kegiatan_balita"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">7</td>
                                <td>
                                    <div class="mb-2">
                                        Jumlah ibu hamil yang terdampak bencana: 
                                        <input type="number" name="jumlah_ibu_hamil_terdampak" class="form-input" style="width: 150px;">
                                    </div>
                                    <div class="mb-2">
                                        Jelaskan dampak bencana terhadap ibu hamil:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="dampak_ibu_hamil"></textarea>
                                    </div>
                                    <div>
                                        Kegiatan yang dibutuhkan untuk mengatasi dampak bencana terhadap ibu hamil:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kegiatan_ibu_hamil"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">8</td>
                                <td>
                                    <div class="mb-2">
                                        Jumlah lansia yang terdampak bencana: 
                                        <input type="number" name="jumlah_lansia_terdampak" class="form-input" style="width: 150px;">
                                    </div>
                                    <div class="mb-2">
                                        Jelaskan dampak bencana terhadap lansia:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="dampak_lansia"></textarea>
                                    </div>
                                    <div>
                                        Kegiatan yang dibutuhkan untuk mengatasi dampak bencana terhadap lansia:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kegiatan_lansia"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">9</td>
                                <td>
                                    <div class="mb-2">
                                        Perkiraan dampak kesehatan jangka menengah akibat bencana<br>
                                        Jelaskan:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="dampak_kesehatan_menengah"></textarea>
                                    </div>
                                    <div>
                                        Kegiatan yang dibutuhkan untuk pengurangan permasalahan tersebut:<br>
                                        <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="kegiatan_dampak_kesehatan"></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">10</td>
                                <td>
                                    Adakah rencana kontingensi terkait bidang kesehatan dalam mengurangi risiko akibat bencana?<br>
                                    Jelaskan:<br>
                                    <textarea class="form-input" rows="2" style="width: 100%; margin-top: 5px;" name="rencana_kontingensi_kesehatan"></textarea>
                                </td>
                            </tr>
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
