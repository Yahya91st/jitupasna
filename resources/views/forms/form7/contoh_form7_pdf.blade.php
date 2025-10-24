<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 07 - Diskusi Kelompok Terfokus</title>
    <style>
        @page {
            margin: 0.8cm;
            size: A4;
        }

        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.2;
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 9pt;
        }

        .container {
            width: 100%;
            max-width: 100%;
            margin: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 1px solid #ddd;
        }

        .header h2 {
            margin: 0.1rem 0;
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #333;
        }

        .header h3 {
            margin: 0.1rem 0;
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #333;
        }

        .intro-text {
            text-align: justify;
            font-size: 8pt;
            line-height: 1.2;
            margin-bottom: 6px;
            padding: 4px 6px;
            background-color: #f9f9f9;
            border-left: 2px solid #333;
            border-radius: 2px;
        }

        .intro-label {
            font-weight: 600;
            font-size: 8pt;
            margin-bottom: 1px;
            display: block;
            color: #333;
        }

        .section-box {
            border: 1px solid #ddd;
            padding: 6px 8px;
            margin-bottom: 4px;
            background-color: #fff;
        }

        .section-title {
            font-weight: bold;
            font-size: 9pt;
            margin-bottom: 4px;
            text-transform: uppercase;
            background-color: #333;
            color: #fff;
            padding: 3px 4px;
            margin-left: -8px;
            margin-right: -8px;
            margin-top: -6px;
            letter-spacing: 0.5px;
        }

        .section-number {
            display: inline-block;
            background-color: #333;
            color: #fff;
            padding: 1px 4px;
            margin-right: 3px;
            border-radius: 2px;
            font-weight: bold;
        }

        .subsection-title {
            font-weight: 500;
            font-size: 8pt;
            margin: 4px 0 3px 0;
            padding: 3px 4px;
            background-color: #f9f9f9;
            border-left: 2px solid #333;
            color: #333;
        }

        .info-box {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 3px;
            margin: 2px 0 3px 0;
            border-radius: 2px;
        }

        .info-box-title {
            font-weight: 600;
            font-size: 7pt;
            margin-bottom: 1px;
            color: #333;
        }

        .table-header-main {
            text-align: center;
            font-size: 9pt;
            font-weight: 600;
            margin: 6px 0 4px 0;
            padding: 4px;
            background-color: #333;
            color: #fff;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border: 1px solid #333;
        }

        .question-number {
            display: inline-block;
            width: auto;
            height: auto;
            background-color: transparent;
            color: #333;
            text-align: center;
            border-radius: 0;
            font-weight: 600;
            line-height: normal;
            margin-right: 3px;
            font-size: 8pt;
        }

        .help-text {
            font-size: 7pt;
            color: #666;
            font-style: italic;
            margin-top: 1px;
        }

        .form-row {
            margin-bottom: 3px;
            line-height: 1.2;
        }

        .form-row label {
            display: inline-block;
            min-width: 120px;
            font-weight: 500;
            color: #333;
        }

        .underline {
            border-bottom: 1px solid #333;
            display: inline-block;
            min-width: 150px;
            padding: 0 2px;
        }

        .checklist-section {
            margin-top: 6px;
            padding-top: 4px;
            border-top: 1px solid #333;
        }

        .checklist-title {
            font-weight: 600;
            margin-bottom: 3px;
            font-size: 8pt;
            color: #333;
        }

        .checklist-item {
            margin-bottom: 3px;
            padding-left: 12px;
            line-height: 1.2;
        }

        .checkbox {
            display: inline-block;
            width: 10px;
            height: 10px;
            border: 1px solid #333;
            margin-right: 4px;
            vertical-align: middle;
        }

        .checkbox.checked::before {
            content: '✓';
            font-weight: bold;
            font-size: 10pt;
            margin-left: 0px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3px;
            border: 1px solid #333;
            page-break-inside: avoid;
        }

        th,
        td {
            padding: 3px 4px;
            text-align: left;
            font-size: 8pt;
            vertical-align: top;
            border: 1px solid #333;
            line-height: 1.2;
        }

        th {
            background-color: #f9f9f9;
            font-weight: 600;
            text-align: center;
            padding: 4px 3px;
            border-bottom: 1px solid #333;
            color: #333;
            font-size: 8pt;
        }
        
        td {
            background-color: #fff;
        }
        
        .compact-table {
            page-break-inside: avoid;
            margin-bottom: 2px;
        }
        
        .compact-table td {
            padding: 2px 3px;
            font-size: 7pt;
            line-height: 1.1;
        }
        
        /* Table untuk checklist dengan spacing khusus */
        .checklist-section table {
            border-collapse: collapse;
            border: 1px solid #333;
            margin-top: 4px;
        }
        
        .checklist-section th,
        .checklist-section td {
            border: 1px solid #333;
            padding: 6px 4px;
        }
        
        .checklist-section th {
            background-color: #f9f9f9;
            font-weight: 600;
            text-align: center;
            border-bottom: 1px solid #333;
            font-size: 8pt;
            color: #333;
        }
        
        .checklist-section td {
            background-color: #fff;
            font-size: 8pt;
        }
        
        .checklist-section tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        .page-break {
            page-break-after: always;
        }

        .signature-table {
            margin-top: 15px;
            border: none;
        }

        .signature-table td {
            border: none;
            padding: 6px;
        }

        .signature-box {
            text-align: center;
            margin-top: 30px;
        }

        .signature-line {
            border-top: 1px solid #333;
            width: 150px;
            margin: 0 auto;
            padding-top: 3px;
            font-weight: 600;
        }

        .small-text {
            font-size: 7pt;
            line-height: 1.2;
        }
        
        .small-text strong {
            font-size: 7pt;
            font-weight: 600;
        }

        ul {
            margin: 3px 0;
            padding-left: 12px;
        }

        ul li {
            margin-bottom: 1px;
            line-height: 1.2;
        }

        @media print {
            @page {
                margin: 0.8cm;
            }

            body {
                margin: 0;
                font-size: 9pt;
            }

            .page-break {
                page-break-after: always;
            }

            .section-box {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>FORMULIR 07</h2>
            <h3>Diskusi Kelompok Terfokus (Focus Group Discussion)</h3>
            <div style="font-size: 7pt; margin-top: 2px; color: #333;">JITUPASNA - Sistem Informasi Pengkajian Kebutuhan Pasca Bencana</div>
        </div>

        <!-- Intro Text -->
        <div class="intro-text">
            <span class="intro-label">📋 Tentang FGD:</span>
            <em>FGD</em> adalah metode pengumpulan data kualitatif yang memberikan gambaran mendalam tentang masalah yang tidak tertampung dalam laporan statistik. Laksanakan <em>FGD</em> secara informal, singkat, dan efektif untuk hasil optimal.
        </div>

        <!-- Umum Section -->
        <div class="section-box">
            <div class="section-title"><span class="section-number">I</span> DATA UMUM PELAKSANAAN FGD</div>

            <div class="subsection-title">A. Informasi Lokasi</div>
            
            <table style="width: 100%; border: none; margin-bottom: 8px;">
                <tr>
                    <td style="width: 50%; border: none; padding: 2px;">
                        <div class="form-row">
                            <strong>Desa/Kelurahan:</strong><br>
                            <span class="underline" style="min-width: 200px; display: inline-block;">{{ $form->desa_kelurahan ?? 'Sukamaju' }}</span>
                        </div>
                    </td>
                    <td style="width: 50%; border: none; padding: 2px;">
                        <div class="form-row">
                            <strong>Kecamatan:</strong><br>
                            <span class="underline" style="min-width: 200px; display: inline-block;">{{ $form->kecamatan ?? 'Cianjur' }}</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%; border: none; padding: 2px;">
                        <div class="form-row">
                            <strong>Kabupaten:</strong><br>
                            <span class="underline" style="min-width: 200px; display: inline-block;">{{ $form->kabupaten ?? 'Cianjur' }}</span>
                        </div>
                    </td>
                    <td style="width: 50%; border: none; padding: 2px;">
                        <div class="form-row">
                            <strong>Tanggal Pelaksanaan:</strong><br>
                            <span class="underline" style="min-width: 200px; display: inline-block;">{{ $form->tanggal ? \Carbon\Carbon::parse($form->tanggal)->format('d F Y') : '16 October 2025' }}</span>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="form-row" style="margin-bottom: 8px;">
                <strong>Jarak dari Lokasi Bencana:</strong> <span class="underline" style="min-width: 60px; display: inline-block; text-align: center;">{{ $form->jarak_bencana ?? '3' }}</span> <strong>km</strong>
                <span class="help-text" style="margin-left: 10px;">(diisi oleh fasilitator/pencatat)</span>
            </div>

            <div class="subsection-title">B. Tempat Pelaksanaan</div>

            <div class="form-row" style="margin-bottom: 6px;">
                <strong>Tempat/Lokasi Sesi:</strong><br>
                <span class="underline" style="min-width: 400px; display: inline-block;">{{ $form->tempat_sesi ?? 'Balai Desa Sukamaju' }}</span>
            </div>
            
            <table style="width: 100%; border: none; margin-bottom: 8px;">
                <tr>
                    <td style="width: 50%; border: none; padding: 2px;">
                        <div class="form-row">
                            <strong>Desa/Kelurahan:</strong><br>
                            <span class="underline" style="min-width: 200px; display: inline-block;">{{ $form->desa_sesi ?? 'Sukamaju' }}</span>
                        </div>
                    </td>
                    <td style="width: 50%; border: none; padding: 2px;">
                        <div class="form-row">
                            <strong>Kecamatan:</strong><br>
                            <span class="underline" style="min-width: 200px; display: inline-block;">{{ $form->kec_sesi ?? 'Cianjur' }}</span>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="subsection-title">C. Informasi Peserta</div>

            <table style="width: 100%; border: none; margin-bottom: 6px;">
                <tr>
                    <td style="width: 40%; border: none; padding: 2px;">
                        <div class="form-row">
                            <strong>Jumlah Total Peserta:</strong><br>
                            <span class="underline" style="min-width: 50px; display: inline-block; text-align: center;">{{ $form->jumlah_peserta ?? '15' }}</span> <strong>orang</strong>
                        </div>
                    </td>
                    <td style="width: 30%; border: none; padding: 2px;">
                        <div class="form-row">
                            <strong>Perempuan:</strong><br>
                            <span class="underline" style="min-width: 50px; display: inline-block; text-align: center;">{{ $form->jumlah_perempuan ?? '7' }}</span> <strong>orang</strong>
                        </div>
                    </td>
                    <td style="width: 30%; border: none; padding: 2px;">
                        <div class="form-row">
                            <strong>Laki-laki:</strong><br>
                            <span class="underline" style="min-width: 50px; display: inline-block; text-align: center;">{{ $form->jumlah_laki_laki ?? '8' }}</span> <strong>orang</strong>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="info-box">
                <div class="info-box-title">Komposisi Peserta (pekerjaan, status sosial, kelompok umur, dll):</div>
                <div style="padding: 2px; font-size: 7pt;">
                    {{ $form->komposisi_peserta ?? 'Contoh: Kepala Desa, Tokoh Masyarakat, RT/RW, PKK, Karang Taruna, Petani, Pedagang, dll.' }}
                </div>
            </div>

            <div class="subsection-title">D. Tim Penyelenggara</div>

            <table style="border: 1px solid #333; margin-top: 4px;">
                <tr>
                    <td style="width: 25%; background-color: #f9f9f9; border: 1px solid #333; font-weight: 600; text-align: center; padding: 6px; color: #333;"><strong>Posisi</strong></td>
                    <td style="width: 50%; background-color: #f9f9f9; border: 1px solid #333; font-weight: 600; text-align: center; padding: 6px; color: #333;"><strong>Nama</strong></td>
                    <td style="width: 25%; background-color: #f9f9f9; border: 1px solid #333; font-weight: 600; text-align: center; padding: 6px; color: #333;"><strong>Paraf</strong></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 6px; background-color: #fff; font-weight: 500; color: #333;"><strong>Fasilitator</strong></td>
                    <td style="border: 1px solid #333; padding: 6px; background-color: #fff;">{{ $form->fasilitator ?? '____________________________________' }}</td>
                    <td style="border: 1px solid #333; padding: 6px; text-align: center; background-color: #fff;">{{ $form->paraf_fasilitator ?? '______________' }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 6px; background-color: #f9f9f9; font-weight: 500; color: #333;"><strong>Pencatat/Notulen</strong></td>
                    <td style="border: 1px solid #333; padding: 6px; background-color: #f9f9f9;">{{ $form->pencatat ?? '____________________________________' }}</td>
                    <td style="border: 1px solid #333; padding: 6px; text-align: center; background-color: #f9f9f9;">{{ $form->paraf_pencatat ?? '______________' }}</td>
                </tr>
            </table>

            <div class="subsection-title">E. Checklist Tahapan Pelaksanaan FGD</div>
            
            <div class="info-box" style="background-color: #fffbf0;">
                <div class="info-box-title">Petunjuk: Beri tanda ✓ pada tahapan yang dilaksanakan</div>
            </div>

            <div class="checklist-section">
                <table style="width: 100%; border: 1px solid #333; margin-top: 4px;">
                    <thead>
                        <tr>
                            <th style="width: 8%; background-color: #f9f9f9; padding: 6px 4px; border-bottom: 1px solid #333; color: #333;">No.</th>
                            <th style="width: 62%; background-color: #f9f9f9; padding: 6px 6px; border-bottom: 1px solid #333; color: #333;">Tahapan Pelaksanaan FGD</th>
                            <th style="width: 15%; background-color: #f9f9f9; padding: 6px 4px; border-bottom: 1px solid #333; color: #333;">Ya</th>
                            <th style="width: 15%; background-color: #f9f9f9; padding: 6px 4px; border-bottom: 1px solid #333; color: #333;">Tidak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #fff;">1</td>
                            <td style="border: 1px solid #333; padding: 6px; background-color: #fff;"><strong>Persiapan Pra-FGD</strong><br><span class="small-text">Koordinasi awal, persiapan materi, dan identifikasi peserta</span></td>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #fff;">
                                <span class="checkbox checked">✓</span>
                            </td>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #fff;">
                                <span class="checkbox"></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #f9f9f9;">2</td>
                            <td style="border: 1px solid #333; padding: 6px; background-color: #f9f9f9;"><strong>Pembagian Tugas Pelaksana</strong><br><span class="small-text">Penentuan fasilitator, notulen, dan tim pendukung</span></td>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #f9f9f9;">
                                <span class="checkbox checked">✓</span>
                            </td>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #f9f9f9;">
                                <span class="checkbox"></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #fff;">3</td>
                            <td style="border: 1px solid #333; padding: 6px; background-color: #fff;"><strong>Koordinasi dengan Pengantar</strong><br><span class="small-text">Koordinasi dengan tokoh masyarakat/pemerintah setempat</span></td>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #fff;">
                                <span class="checkbox checked">✓</span>
                            </td>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #fff;">
                                <span class="checkbox"></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #f9f9f9;">4</td>
                            <td style="border: 1px solid #333; padding: 6px; background-color: #f9f9f9;"><strong>Pembahasan Materi</strong><br><span class="small-text">Diskusi inti sesuai topik dan tujuan FGD</span></td>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #f9f9f9;">
                                <span class="checkbox checked">✓</span>
                            </td>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #f9f9f9;">
                                <span class="checkbox"></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #fff;">5</td>
                            <td style="border: 1px solid #333; padding: 6px; background-color: #fff;"><strong>Pendalaman Tanya Jawab</strong><br><span class="small-text">Eksplorasi mendalam terhadap isu-isu penting</span></td>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #fff;">
                                <span class="checkbox"></span>
                            </td>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #fff;">
                                <span class="checkbox checked">✓</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #f9f9f9;">6</td>
                            <td style="border: 1px solid #333; padding: 6px; background-color: #f9f9f9;"><strong>Penyimpulan dan Penutupan</strong><br><span class="small-text">Kesimpulan hasil diskusi dan ucapan terima kasih</span></td>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #f9f9f9;">
                                <span class="checkbox checked">✓</span>
                            </td>
                            <td style="text-align: center; border: 1px solid #333; padding: 6px; background-color: #f9f9f9;">
                                <span class="checkbox"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Page Break untuk memindahkan ke halaman 2 -->
        <div class="page-break"></div>

        <!-- Pertanyaan Akses Section -->
        <div class="section-box" style="border: none; padding: 0; page-break-inside: avoid;">
            <div class="table-header-main">
                <span class="section-number">II</span>
                AKSES DAN HAK TERHADAP SUMBER DAYA
            </div>
            
            <div class="info-box" style="background-color: #f9f9f9; margin-bottom: 2px; padding: 2px;">
                <div class="info-box-title">📌 Petunjuk:</div>
                <div style="font-size: 7pt;">
                    Bagian ini menggali informasi tentang hak-hak dasar masyarakat dan aksesibilitas terhadap sumber daya pasca bencana.
                </div>
            </div>
        </div>

        <table class="compact-table" style="page-break-inside: avoid;">
            <thead>
                <tr>
                    <th style="width: 14%;">
                        <strong>1. Hak Bekerja</strong>
                    </th>
                    <th style="width: 14%;">
                        <strong>2. Hak Jaminan Keamanan Sosial</strong>
                    </th>
                    <th style="width: 14%;">
                        <strong>3. Hak Perlindungan & Bantuan Keluarga</strong>
                    </th>
                    <th style="width: 14%;">
                        <strong>4. Hak Taraf Kehidupan Memadai</strong>
                    </th>
                    <th style="width: 15%;">
                        <strong>5. Hak Pelayanan Kesehatan</strong>
                    </th>
                    <th style="width: 14%;">
                        <strong>6. Hak Pendidikan</strong>
                    </th>
                    <th style="width: 15%;">
                        <strong>7. Hak Kehidupan Budaya</strong>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="small-text">
                        <strong style="color: #000;">Pertanyaan Kunci:</strong><br>
                        1. Apakah "Kepala Keluarga" dapat melaksanakan aktivitas bekerja sebelum bencana?<br>
                        2. Apa bentuk bantuan yang dibutuhkan?<br>
                        • Modal usaha<br>
                        • Alat/peralatan kerja<br>
                        • Pelatihan keterampilan
                    </td>
                    <td class="small-text">
                        <strong style="color: #000;">Pertanyaan Kunci:</strong><br>
                        1. Bila beraktivitas, apakah memiliki sumber daya cadangan?<br>
                        2. Apa bentuk sumber daya cadangan yang dimiliki?<br>
                        • Tabungan<br>
                        • Aset<br>
                        • Jaminan sosial
                    </td>
                    <td class="small-text">
                        <strong style="color: #000;">Pertanyaan Kunci:</strong><br>
                        1. Perlindungan terhadap keluarga:<br>
                        • Perempuan<br>
                        • Anak-anak<br>
                        • Lansia<br>
                        • Disabilitas<br>
                        2. Bentuk bantuan yang diperlukan
                    </td>
                    <td class="small-text">
                        <strong style="color: #000;">Pertanyaan Kunci:</strong><br>
                        1. Sandang, Pangan, Perumahan<br>
                        2. Transportasi<br>
                        3. Papan/Tempat tinggal<br>
                        4. Air bersih & sanitasi<br>
                        5. MCK<br>
                        6. Kebutuhan energi (BBM, listrik, gas)
                    </td>
                    <td class="small-text">
                        <strong style="color: #000;">Pertanyaan Kunci:</strong><br>
                        1. Apakah tenaga medis masih berfungsi?<br>
                        2. Ketersediaan obat-obatan<br>
                        3. Tempat pelayanan dapat dicapai dengan mudah?<br>
                        4. Biaya pelayanan kesehatan<br>
                        5. Alat kesehatan
                    </td>
                    <td class="small-text">
                        <strong style="color: #000;">Pertanyaan Kunci:</strong><br>
                        1. Apakah tenaga pendidik masih berfungsi?<br>
                        2. Kondisi sekolah dan perlengkapan anak didik<br>
                        3. Tempat dapat dicapai dengan mudah?<br>
                        4. Biaya pendidikan<br>
                        5. Fasilitas belajar
                    </td>
                    <td class="small-text">
                        <strong style="color: #000;">Pertanyaan Kunci:</strong><br>
                        1. Apakah bisa melaksanakan kegiatan tradisi yang diinginkan?<br>
                        2. Apakah melaksanakan ritual keagamaan yang biasa dijalankan?<br>
                        3. Apakah tradisi digunakan dalam penanggulangan bencana?
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pertanyaan Fungsi Section -->
        <div class="section-box" style="border: none; padding: 0; page-break-inside: avoid; margin-top: 8px;">
            <div class="table-header-main">
                <span class="section-number">III</span>
                FUNGSI PRANATA SOSIAL DAN KEAGAMAAN
            </div>
            
            <div class="info-box" style="background-color: #f9f9f9; margin-bottom: 2px; padding: 2px;">
                <div class="info-box-title">📌 Petunjuk:</div>
                <div style="font-size: 7pt;">
                    Bagian ini mengeksplorasi peran pranata/lembaga kemasyarakatan sebelum dan sesudah bencana.
                </div>
            </div>
        </div>

        <table class="compact-table" style="page-break-inside: avoid;">
            <thead>
                <tr>
                    <th style="width: 25%;">
                        <strong>1. Pranata Sosial</strong><br>
                        <span class="small-text">(Organisasi masyarakat, Karang Taruna, PKK, dll)</span>
                    </th>
                    <th style="width: 25%;">
                        <strong>2. Pranata Ekonomi</strong><br>
                        <span class="small-text">(Koperasi, Kelompok Tani, UMKM, dll)</span>
                    </th>
                    <th style="width: 25%;">                        
                        <strong>3. Pranata Agama & Tradisi</strong><br>
                        <span class="small-text">(Organisasi keagamaan, Adat, dll)</span>
                    </th>
                     <th style="width: 25%;">
                        <strong>4. Pranata Pemerintahan</strong><br>
                        <span class="small-text">(RT/RW, Desa, Kecamatan, dll)</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="small-text">
                        <strong style="color: #000;">Pertanyaan Kunci:</strong><br>
                        1. Apa saja organisasi sosial yang ada?<br>
                        2. Bagaimana fungsinya sebelum bencana?<br>
                        3. Bagaimana saat bencana terjadi?<br>
                        4. Bagaimana setelah bencana?<br>
                        5. Mengapa keadaannya sedemikian rupa?<br>
                        6. Bagaimana cara memaksimalkan untuk pemulihan?
                    </td>
                    <td class="small-text">
                        <strong style="color: #000;">Pertanyaan Kunci:</strong><br>
                        1. Apa saja organisasi ekonomi yang ada?<br>
                        2. Bagaimana fungsinya sebelum bencana?<br>
                        3. Bagaimana saat bencana terjadi?<br>
                        4. Bagaimana setelah bencana?<br>
                        5. Mengapa keadaannya sedemikian rupa?<br>
                        6. Bagaimana cara memaksimalkan untuk pemulihan ekonomi?
                    </td>
                    <td class="small-text">
                        <strong style="color: #000;">Pertanyaan Kunci:</strong><br>
                        1. Apa saja organisasi keagamaan/adat yang ada?<br>
                        2. Bagaimana fungsinya sebelum bencana?<br>
                        3. Bagaimana saat bencana terjadi?<br>
                        4. Bagaimana setelah bencana?<br>
                        5. Mengapa keadaannya sedemikian rupa?<br>
                        6. Bagaimana cara memaksimalkan untuk pemulihan sosial-spiritual?
                    </td>
                    <td class="small-text">
                        <strong style="color: #000;">Pertanyaan Kunci:</strong><br>
                        1. Bagaimana pemerintahan berfungsi sebelum bencana?<br>
                        2. Bagaimana perannya saat bencana?<br>
                        3. Bagaimana keadaannya setelah bencana?<br>
                        4. Mengapa keadaannya sedemikian rupa?<br>
                        5. Bagaimana cara memaksimalkan?<br>
                        6. Jika tidak berfungsi, apa dampaknya?
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pertanyaan Resiko Section -->
        <div class="section-box" style="border: none; padding: 0; page-break-inside: avoid; margin-top: 8px;">
            <div class="table-header-main">
                <span class="section-number">IV</span>
                RESIKO DAN KERENTANAN MASYARAKAT
            </div>
            
            <div class="info-box" style="background-color: #f9f9f9; margin-bottom: 2px; padding: 2px;">
                <div class="info-box-title">📌 Petunjuk:</div>
                <div style="font-size: 7pt;">
                    Bagian ini mengidentifikasi kelompok rentan dari berbagai sudut pandang.
                </div>
            </div>
        </div>

        <table class="compact-table" style="page-break-inside: avoid;">
            <thead>
                <tr>
                    <th style="width: 33%;">
                        <strong>1. Karakter Sosial</strong><br>
                        <span class="small-text">(Gender, Usia, Status, dll)</span>
                    </th>
                    <th style="width: 33%;">
                        <strong>2. Karakter & Kelas Ekonomi</strong><br>
                        <span class="small-text">(Tingkat Penghasilan, Pekerjaan, Aset, dll)</span>
                    </th>
                    <th style="width: 34%;">
                        <strong>3. Karakter Geografis</strong><br>
                        <span class="small-text">(Lokasi Tempat Tinggal, Lahan, dll)</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="small-text">
                        <strong style="color: #000;">Pertanyaan Kunci:</strong><br>
                        1. Dari sudut karakter sosial, kelompok mana yang paling rentan?<br>
                        <span style="font-style: italic; font-size: 5.5pt;">(Contoh: perempuan, anak, lansia, disabilitas)</span><br>
                        2. Apa bentuk kerentanan mereka?<br>
                        3. Mengapa mereka bisa menjadi rentan?<br>
                        4. Bagaimana caranya membantu mereka?<br>
                        5. Mengapa harus dengan cara itu?
                    </td>
                    <td class="small-text">
                        <strong style="color: #000;">Pertanyaan Kunci:</strong><br>
                        1. Dari sudut ekonomi, kelompok mana yang paling rentan?<br>
                        <span style="font-style: italic; font-size: 5.5pt;">(Contoh: buruh harian, petani kecil, pedagang kecil)</span><br>
                        2. Apa bentuk kerentanan mereka?<br>
                        3. Mengapa mereka bisa menjadi rentan?<br>
                        4. Bagaimana caranya membantu mereka?<br>
                        5. Mengapa harus dengan cara itu?
                    </td>
                    <td class="small-text">
                        <strong style="color: #000;">Pertanyaan Kunci:</strong><br>
                        1. Dari sudut lokasi, kelompok mana yang paling rentan?<br>
                        <span style="font-style: italic; font-size: 5.5pt;">(Contoh: tepi sungai, lereng bukit, pesisir)</span><br>
                        2. Apa bentuk kerentanan mereka?<br>
                        3. Mengapa mereka bisa menjadi rentan?<br>
                        4. Bagaimana caranya membantu mereka?<br>
                        5. Mengapa harus dengan cara itu?
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Spacer untuk mendorong signature ke bawah -->
        <div style="flex-grow: 1; min-height: 50px;"></div>

        

        <!-- Signature Section -->
        <div class="signature-table" style="position: fixed; bottom: 60px; left: 0; right: 0; margin: 0; padding: 0 0.8cm;">
            <div style="border-top: 1px solid #333; padding-top: 8px;">
                <table style="border: none; width: 100%;">
                    <tr>
                        <td style="width: 50%; border: none; text-align: center; vertical-align: top; padding: 8px;">
                            <div style="margin-bottom: 4px;">
                                <strong style="font-size: 9pt; color: #333;">PENCATAT/NOTULEN</strong>
                            </div>
                            <div style="height: 30px;"></div>
                            <div style="border-top: 1px solid #333; width: 150px; margin: 0 auto; padding-top: 3px;">
                                <strong style="font-size: 9pt; color: #333;">{{ $form->pencatat ?? 'Siti Nurhaliza' }}</strong>
                            </div>
                        </td>
                        <td style="width: 50%; border: none; text-align: center; vertical-align: top; padding: 8px;">
                            <div style="margin-bottom: 2px; font-size: 8pt; color: #333;">
                                Cianjur, {{ $form->tanggal ? \Carbon\Carbon::parse($form->tanggal)->format('d F Y') : '16 October 2025' }}
                            </div>
                            <div style="margin-bottom: 4px;">
                                <strong style="font-size: 9pt; color: #333;">FASILITATOR FGD</strong>
                            </div>
                            <div style="height: 30px;"></div>
                            <div style="border-top: 1px solid #333; width: 150px; margin: 0 auto; padding-top: 3px;">
                                <strong style="font-size: 9pt; color: #333;">{{ $form->fasilitator ?? 'Budi Santoso' }}</strong>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Footer Note di bagian paling bawah -->
        <div style="position: fixed; bottom: 0; left: 0; right: 0; margin: 0; padding: 0 0.8cm; border-top: 1px solid #ddd; background-color: #f9f9f9;">
            <p style="font-size: 8pt; color: #333; margin: 1px 0; font-style: italic; text-align: center;"><em>Formulir 07 - Diskusi Kelompok Terfokus (FGD)</em></p>
            <p style="font-size: 9pt; font-weight: 600; margin: 1px 0; color: #333; text-align: center;">JITUPASNA</p>
            <p style="font-size: 7pt; color: #666; margin: 1px 0; text-align: center;">Sistem Informasi Pengkajian Kebutuhan Pasca Bencana</p>
        </div>

        <!-- Spacer untuk memberi ruang untuk signature dan footer fixed -->
        <div style="height: 120px;"></div>

    </div>
</body>

</html>
