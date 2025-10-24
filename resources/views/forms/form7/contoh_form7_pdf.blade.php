<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 07 - Diskusi Kelompok Terfokus</title>
    <style>
        @page {
            margin: 1.5cm 1.8cm;
            size: A4;
        }

        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.3;
            color: #000;
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
            margin-bottom: 10px;
            padding-bottom: 6px;
            border-bottom: 2px double #000;
        }

        .header h2 {
            margin: 2px 0;
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .header h3 {
            margin: 2px 0;
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .intro-text {
            text-align: justify;
            font-size: 8pt;
            line-height: 1.3;
            margin-bottom: 8px;
            padding: 6px 8px;
            background-color: #f8f8f8;
            border-left: 3px solid #000;
        }

        .intro-label {
            font-weight: bold;
            font-size: 8pt;
            margin-bottom: 2px;
            display: block;
        }

        .section-box {
            border: 1.5px solid #000;
            padding: 8px 10px;
            margin-bottom: 5px;
            background-color: #fff;
        }

        .section-title {
            font-weight: bold;
            font-size: 9pt;
            margin-bottom: 6px;
            text-transform: uppercase;
            background-color: #000;
            color: #fff;
            padding: 4px 6px;
            margin-left: -10px;
            margin-right: -10px;
            margin-top: -8px;
            letter-spacing: 1px;
        }

        .section-number {
            display: inline-block;
            background-color: #fff;
            color: #000;
            padding: 1px 6px;
            margin-right: 4px;
            border-radius: 2px;
            font-weight: bold;
        }

        .subsection-title {
            font-weight: bold;
            font-size: 8pt;
            margin: 6px 0 4px 0;
            padding: 4px 6px;
            background-color: #f0f0f0;
            border-left: 3px solid #000;
        }

        .info-box {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            padding: 5px;
            margin: 3px 0 5px 0;
        }

        .info-box-title {
            font-weight: bold;
            font-size: 7pt;
            margin-bottom: 2px;
            color: #333;
        }

        .table-header-main {
            text-align: center;
            font-size: 9pt;
            font-weight: bold;
            margin: 8px 0 5px 0;
            padding: 6px;
            background-color: #000;
            color: #fff;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: 1.5px solid #000;
        }

        .question-number {
            display: inline-block;
            width: 18px;
            height: 18px;
            background-color: #000;
            color: #fff;
            text-align: center;
            border-radius: 50%;
            font-weight: bold;
            line-height: 18px;
            margin-right: 4px;
            font-size: 8pt;
        }

        .help-text {
            font-size: 7pt;
            color: #666;
            font-style: italic;
            margin-top: 1px;
        }

        .form-row {
            margin-bottom: 4px;
            line-height: 1.4;
        }

        .form-row label {
            display: inline-block;
            min-width: 140px;
            font-weight: bold;
        }

        .underline {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 180px;
            padding: 0 3px;
        }

        .checklist-section {
            margin-top: 8px;
            padding-top: 6px;
            border-top: 1.5px solid #000;
        }

        .checklist-title {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 8pt;
        }

        .checklist-item {
            margin-bottom: 4px;
            padding-left: 15px;
            line-height: 1.3;
        }

        .checkbox {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1.5px solid #000;
            margin-right: 5px;
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
            margin-bottom: 4px;
            border: 1.5px solid #000;
            page-break-inside: avoid;
        }

        th,
        td {
            padding: 4px 6px;
            text-align: left;
            font-size: 7pt;
            vertical-align: top;
            border: 1px solid #000;
            line-height: 1.2;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
            padding: 5px 4px;
            border-bottom: 1.5px solid #000;
            color: #000;
            font-size: 7.5pt;
        }
        
        td {
            background-color: #fff;
        }
        
        .compact-table {
            page-break-inside: avoid;
            margin-bottom: 2px;
        }
        
        .compact-table td {
            padding: 3px 5px;
            font-size: 6.5pt;
            line-height: 1.1;
        }
        
        /* Table untuk checklist dengan spacing khusus */
        .checklist-section table {
            border-collapse: collapse;
            border: 2px solid #000;
            margin-top: 5px;
        }
        
        .checklist-section th,
        .checklist-section td {
            border: 1px solid #333;
            padding: 8px 6px;
        }
        
        .checklist-section th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
            border-bottom: 2px solid #000;
            font-size: 8pt;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .checklist-section td {
            background-color: #fff;
            font-size: 7.5pt;
        }
        
        .checklist-section tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        .page-break {
            page-break-after: always;
        }

        .signature-table {
            margin-top: 25px;
            border: none;
        }

        .signature-table td {
            border: none;
            padding: 8px;
        }

        .signature-box {
            text-align: center;
            margin-top: 50px;
        }

        .signature-line {
            border-top: 2px solid #000;
            width: 170px;
            margin: 0 auto;
            padding-top: 4px;
            font-weight: bold;
        }

        .small-text {
            font-size: 6pt;
            line-height: 1.2;
        }
        
        .small-text strong {
            font-size: 6.5pt;
        }

        .question-number {
            display: inline-block;
            width: 14px;
            height: 14px;
            background-color: #000;
            color: #fff;
            text-align: center;
            border-radius: 50%;
            font-weight: bold;
            line-height: 14px;
            margin-right: 2px;
            font-size: 7pt;
        }        ul {
            margin: 4px 0;
            padding-left: 15px;
        }

        ul li {
            margin-bottom: 2px;
            line-height: 1.3;
        }

        @media print {
            @page {
                margin: 1.5cm 1.8cm;
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
            
            <div class="form-row">
                <strong>Desa/Kelurahan:</strong> <span class="underline">{{ $form->desa_kelurahan ?? '______________________________' }}</span>
                &nbsp;&nbsp;&nbsp;
                <strong>Kecamatan:</strong> <span class="underline">{{ $form->kecamatan ?? '______________________________' }}</span>
            </div>

            <div class="form-row">
                <strong>Kabupaten:</strong> <span class="underline">{{ $form->kabupaten ?? '______________________________' }}</span>
                &nbsp;&nbsp;&nbsp;
                <strong>Tanggal Pelaksanaan:</strong> <span class="underline">{{ $form->tanggal ? \Carbon\Carbon::parse($form->tanggal)->format('d F Y') : '______________________________' }}</span>
            </div>

            <div class="form-row">
                <strong>Jarak dari Lokasi Bencana:</strong> <span class="underline">{{ $form->jarak_bencana ?? '______' }}</span> <strong>km</strong>
                <span class="help-text">(diisi oleh fasilitator/pencatat)</span>
            </div>

            <div class="subsection-title">B. Tempat Pelaksanaan</div>

            <div class="form-row">
                <strong>Tempat/Lokasi Sesi:</strong> <span class="underline">{{ $form->tempat_sesi ?? '_______________________________________________' }}</span>
            </div>
            
            <div class="form-row">
                <strong>Desa/Kelurahan:</strong> <span class="underline">{{ $form->desa_sesi ?? '______________________' }}</span>
                &nbsp;&nbsp;&nbsp;
                <strong>Kecamatan:</strong> <span class="underline">{{ $form->kec_sesi ?? '______________________' }}</span>
            </div>

            <div class="subsection-title">C. Informasi Peserta</div>

            <div class="form-row">
                <strong>Jumlah Total Peserta:</strong> <span class="underline">{{ $form->jumlah_peserta ?? '______' }}</span> <strong>orang</strong>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <strong>Perempuan:</strong> <span class="underline">{{ $form->jumlah_perempuan ?? '______' }}</span> <strong>orang</strong>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <strong>Laki-laki:</strong> <span class="underline">{{ $form->jumlah_laki_laki ?? '______' }}</span> <strong>orang</strong>
            </div>

            <div class="info-box">
                <div class="info-box-title">Komposisi Peserta (pekerjaan, status sosial, kelompok umur, dll):</div>
                <div style="padding: 2px; font-size: 7pt;">
                    {{ $form->komposisi_peserta ?? 'Contoh: Kepala Desa, Tokoh Masyarakat, RT/RW, PKK, Karang Taruna, Petani, Pedagang, dll.' }}
                </div>
            </div>

            <div class="subsection-title">D. Tim Penyelenggara</div>

            <table style="border: 2px solid #333; margin-top: 6px;">
                <tr>
                    <td style="width: 25%; background-color: #f5f5f5; border: 1px solid #333; font-weight: bold; text-align: center; padding: 8px;"><strong>Posisi</strong></td>
                    <td style="width: 50%; background-color: #f5f5f5; border: 1px solid #333; font-weight: bold; text-align: center; padding: 8px;"><strong>Nama</strong></td>
                    <td style="width: 25%; background-color: #f5f5f5; border: 1px solid #333; font-weight: bold; text-align: center; padding: 8px;"><strong>Paraf</strong></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 8px; background-color: #fff;"><strong>Fasilitator</strong></td>
                    <td style="border: 1px solid #333; padding: 8px; background-color: #fff;">{{ $form->fasilitator ?? '____________________________________' }}</td>
                    <td style="border: 1px solid #333; padding: 8px; text-align: center; background-color: #fff;">{{ $form->paraf_fasilitator ?? '______________' }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #333; padding: 8px; background-color: #fafafa;"><strong>Pencatat/Notulen</strong></td>
                    <td style="border: 1px solid #333; padding: 8px; background-color: #fafafa;">{{ $form->pencatat ?? '____________________________________' }}</td>
                    <td style="border: 1px solid #333; padding: 8px; text-align: center; background-color: #fafafa;">{{ $form->paraf_pencatat ?? '______________' }}</td>
                </tr>
            </table>

            <div class="subsection-title">E. Checklist Tahapan Pelaksanaan FGD</div>
            
            <div class="info-box" style="background-color: #fffbf0;">
                <div class="info-box-title">Petunjuk: Beri tanda ✓ pada tahapan yang dilaksanakan</div>
            </div>

            <div class="checklist-section">
                <table style="width: 100%; border: 2px solid #000; margin-top: 6px;">
                    <thead>
                        <tr>
                            <th style="width: 8%; background-color: #f0f0f0; padding: 10px 6px; border-bottom: 2px solid #000;">No.</th>
                            <th style="width: 62%; background-color: #f0f0f0; padding: 10px 8px; border-bottom: 2px solid #000;">Tahapan Pelaksanaan FGD</th>
                            <th style="width: 15%; background-color: #f0f0f0; padding: 10px 6px; border-bottom: 2px solid #000;">Ya</th>
                            <th style="width: 15%; background-color: #f0f0f0; padding: 10px 6px; border-bottom: 2px solid #000;">Tidak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #fff;">1</td>
                            <td style="border: 1px solid #333; padding: 8px; background-color: #fff;"><strong>Persiapan Pra-FGD</strong><br><span class="small-text">Koordinasi awal, persiapan materi, dan identifikasi peserta</span></td>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #fff;">
                                <span class="checkbox {{ isset($form->persiapan_pra_fgd) && $form->persiapan_pra_fgd ? 'checked' : '' }}"></span>
                            </td>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #fff;">
                                <span class="checkbox {{ isset($form->persiapan_pra_fgd) && !$form->persiapan_pra_fgd ? 'checked' : '' }}"></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #f9f9f9;">2</td>
                            <td style="border: 1px solid #333; padding: 8px; background-color: #f9f9f9;"><strong>Pembagian Tugas Pelaksana</strong><br><span class="small-text">Penentuan fasilitator, notulen, dan tim pendukung</span></td>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #f9f9f9;">
                                <span class="checkbox {{ isset($form->pembagian_tugas) && $form->pembagian_tugas ? 'checked' : '' }}"></span>
                            </td>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #f9f9f9;">
                                <span class="checkbox {{ isset($form->pembagian_tugas) && !$form->pembagian_tugas ? 'checked' : '' }}"></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #fff;">3</td>
                            <td style="border: 1px solid #333; padding: 8px; background-color: #fff;"><strong>Koordinasi dengan Pengantar</strong><br><span class="small-text">Koordinasi dengan tokoh masyarakat/pemerintah setempat</span></td>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #fff;">
                                <span class="checkbox {{ isset($form->koordinasi_pengantar) && $form->koordinasi_pengantar ? 'checked' : '' }}"></span>
                            </td>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #fff;">
                                <span class="checkbox {{ isset($form->koordinasi_pengantar) && !$form->koordinasi_pengantar ? 'checked' : '' }}"></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #f9f9f9;">4</td>
                            <td style="border: 1px solid #333; padding: 8px; background-color: #f9f9f9;"><strong>Pembahasan Materi</strong><br><span class="small-text">Diskusi inti sesuai topik dan tujuan FGD</span></td>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #f9f9f9;">
                                <span class="checkbox {{ isset($form->pembahasan) && $form->pembahasan ? 'checked' : '' }}"></span>
                            </td>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #f9f9f9;">
                                <span class="checkbox {{ isset($form->pembahasan) && !$form->pembahasan ? 'checked' : '' }}"></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #fff;">5</td>
                            <td style="border: 1px solid #333; padding: 8px; background-color: #fff;"><strong>Pendalaman Tanya Jawab</strong><br><span class="small-text">Eksplorasi mendalam terhadap isu-isu penting</span></td>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #fff;">
                                <span class="checkbox {{ isset($form->pendalaman_tanya_jawab) && $form->pendalaman_tanya_jawab ? 'checked' : '' }}"></span>
                            </td>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #fff;">
                                <span class="checkbox {{ isset($form->pendalaman_tanya_jawab) && !$form->pendalaman_tanya_jawab ? 'checked' : '' }}"></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #f9f9f9;">6</td>
                            <td style="border: 1px solid #333; padding: 8px; background-color: #f9f9f9;"><strong>Penyimpulan dan Penutupan</strong><br><span class="small-text">Kesimpulan hasil diskusi dan ucapan terima kasih</span></td>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #f9f9f9;">
                                <span class="checkbox {{ isset($form->penyimpulan_penutupan) && $form->penyimpulan_penutupan ? 'checked' : '' }}"></span>
                            </td>
                            <td style="text-align: center; border: 1px solid #333; padding: 8px; background-color: #f9f9f9;">
                                <span class="checkbox {{ isset($form->penyimpulan_penutupan) && !$form->penyimpulan_penutupan ? 'checked' : '' }}"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Page Break -->
        <div style="page-break-before: avoid;"></div>

        <!-- Pertanyaan Akses Section -->
        <div class="section-box" style="border: none; padding: 0; page-break-inside: avoid;">
            <div class="table-header-main">
                <span class="section-number" style="background-color: #fff; color: #000; padding: 3px 8px;">II</span>
                AKSES DAN HAK TERHADAP SUMBER DAYA
            </div>
            
            <div class="info-box" style="background-color: #fffbf0; margin-bottom: 3px; padding: 3px;">
                <div class="info-box-title">📌 Petunjuk:</div>
                <div style="font-size: 6pt;">
                    Bagian ini menggali informasi tentang hak-hak dasar masyarakat dan aksesibilitas terhadap sumber daya pasca bencana.
                </div>
            </div>
        </div>

        <table class="compact-table" style="page-break-inside: avoid;">
            <thead>
                <tr>
                    <th style="width: 14%;">
                        <div class="question-number">1</div>
                        <strong>Hak Bekerja</strong>
                    </th>
                    <th style="width: 14%;">
                        <div class="question-number">2</div>
                        <strong>Hak Jaminan Keamanan Sosial</strong>
                    </th>
                    <th style="width: 14%;">
                        <div class="question-number">3</div>
                        <strong>Hak Perlindungan & Bantuan Keluarga</strong>
                    </th>
                    <th style="width: 14%;">
                        <div class="question-number">4</div>
                        <strong>Hak Taraf Kehidupan Memadai</strong>
                    </th>
                    <th style="width: 15%;">
                        <div class="question-number">5</div>
                        <strong>Hak Pelayanan Kesehatan</strong>
                    </th>
                    <th style="width: 14%;">
                        <div class="question-number">6</div>
                        <strong>Hak Pendidikan</strong>
                    </th>
                    <th style="width: 15%;">
                        <div class="question-number">7</div>
                        <strong>Hak Kehidupan Budaya</strong>
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
                <span class="section-number" style="background-color: #fff; color: #000; padding: 3px 8px;">III</span>
                FUNGSI PRANATA SOSIAL DAN KEAGAMAAN
            </div>
            
            <div class="info-box" style="background-color: #fffbf0; margin-bottom: 3px; padding: 3px;">
                <div class="info-box-title">📌 Petunjuk:</div>
                <div style="font-size: 6pt;">
                    Bagian ini mengeksplorasi peran pranata/lembaga kemasyarakatan sebelum dan sesudah bencana.
                </div>
            </div>
        </div>

        <table class="compact-table" style="page-break-inside: avoid;">
            <thead>
                <tr>
                    <th style="width: 25%;">
                        <div class="question-number">1</div>
                        <strong>Pranata Sosial</strong><br>
                        <span class="small-text">(Organisasi masyarakat, Karang Taruna, PKK, dll)</span>
                    </th>
                    <th style="width: 25%;">
                        <div class="question-number">2</div>
                        <strong>Pranata Ekonomi</strong><br>
                        <span class="small-text">(Koperasi, Kelompok Tani, UMKM, dll)</span>
                    </th>
                    <th style="width: 25%;">
                        <div class="question-number">3</div>
                        <strong>Pranata Agama & Tradisi</strong><br>
                        <span class="small-text">(Organisasi keagamaan, Adat, dll)</span>
                    </th>
                    <th style="width: 25%;">
                        <div class="question-number">4</div>
                        <strong>Pranata Pemerintahan</strong><br>
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
                <span class="section-number" style="background-color: #fff; color: #000; padding: 3px 8px;">IV</span>
                RESIKO DAN KERENTANAN MASYARAKAT
            </div>
            
            <div class="info-box" style="background-color: #fffbf0; margin-bottom: 3px; padding: 3px;">
                <div class="info-box-title">📌 Petunjuk:</div>
                <div style="font-size: 6pt;">
                    Bagian ini mengidentifikasi kelompok rentan dari berbagai sudut pandang.
                </div>
            </div>
        </div>

        <table class="compact-table" style="page-break-inside: avoid;">
            <thead>
                <tr>
                    <th style="width: 33%;">
                        <div class="question-number">1</div>
                        <strong>Karakter Sosial</strong><br>
                        <span class="small-text">(Gender, Usia, Status, dll)</span>
                    </th>
                    <th style="width: 33%;">
                        <div class="question-number">2</div>
                        <strong>Karakter & Kelas Ekonomi</strong><br>
                        <span class="small-text">(Tingkat Penghasilan, Pekerjaan, Aset, dll)</span>
                    </th>
                    <th style="width: 34%;">
                        <div class="question-number">3</div>
                        <strong>Karakter Geografis</strong><br>
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

        <!-- Signature Section -->
        <div class="signature-table">
            <div style="margin-top: 25px; border-top: 2px solid #000; padding-top: 10px;">
                <table style="border: none; width: 100%;">
                    <tr>
                        <td style="width: 50%; border: none; text-align: center; vertical-align: top; padding: 10px;">
                            <div style="margin-bottom: 6px;">
                                <strong style="font-size: 9pt; text-transform: uppercase; letter-spacing: 1px;">PENCATAT/NOTULEN</strong>
                            </div>
                            <div style="height: 50px;"></div>
                            <div style="border-top: 2px solid #000; width: 170px; margin: 0 auto; padding-top: 4px;">
                                <strong style="font-size: 9pt;">{{ $form->pencatat ?? '(Nama Lengkap)' }}</strong>
                            </div>
                        </td>
                        <td style="width: 50%; border: none; text-align: center; vertical-align: top; padding: 10px;">
                            <div style="margin-bottom: 3px; font-size: 8pt; color: #333;">
                                {{ $form->kabupaten ?? 'Kabupaten' }}, {{ $form->tanggal ? \Carbon\Carbon::parse($form->tanggal)->format('d F Y') : now()->format('d F Y') }}
                            </div>
                            <div style="margin-bottom: 6px;">
                                <strong style="font-size: 9pt; text-transform: uppercase; letter-spacing: 1px;">FASILITATOR FGD</strong>
                            </div>
                            <div style="height: 50px;"></div>
                            <div style="border-top: 2px solid #000; width: 170px; margin: 0 auto; padding-top: 4px;">
                                <strong style="font-size: 9pt;">{{ $form->fasilitator ?? '(Nama Lengkap)' }}</strong>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Footer Note -->
        <div style="margin-top: 20px; border-top: 2px double #000; padding-top: 8px; text-align: center; background-color: #f8f8f8;">
            <p style="font-size: 8pt; color: #333; margin: 2px 0; font-style: italic;"><em>Formulir 07 - Diskusi Kelompok Terfokus (FGD)</em></p>
            <p style="font-size: 10pt; font-weight: bold; margin: 2px 0; letter-spacing: 1px;">JITUPASNA</p>
            <p style="font-size: 7pt; color: #666; margin: 2px 0;">Sistem Informasi Pengkajian Kebutuhan Pasca Bencana</p>
        </div>
    </div>
</body>

</html>
