<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 07 - Diskusi Kelompok Terfokus</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.6;
            color: #000;
            margin: 20px;
            padding: 0;
            font-size: 11pt;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header h2 {
            margin: 3px 0;
            font-size: 14pt;
            font-weight: bold;
        }

        .header h3 {
            margin: 3px 0;
            font-size: 12pt;
            font-weight: bold;
        }

        .intro-text {
            text-align: justify;
            font-size: 10pt;
            line-height: 1.5;
            margin-bottom: 15px;
            font-style: italic;
        }

        .section-box {
            border: 2px solid #000;
            padding: 15px;
            margin-bottom: 15px;
        }

        .section-title {
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .form-row {
            margin-bottom: 8px;
            line-height: 1.8;
        }

        .form-row label {
            display: inline-block;
            min-width: 150px;
        }

        .underline {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 200px;
        }

        .checklist-section {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #000;
        }

        .checklist-title {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .checklist-item {
            margin-bottom: 5px;
            padding-left: 20px;
        }

        .checkbox {
            display: inline-block;
            width: 15px;
            height: 15px;
            border: 1px solid #000;
            margin-right: 8px;
            vertical-align: middle;
        }

        .checkbox.checked::before {
            content: '✓';
            font-weight: bold;
            font-size: 12pt;
            margin-left: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            font-size: 10pt;
            vertical-align: top;
        }

        th {
            background-color: #d3d3d3;
            font-weight: bold;
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }

        .signature-table {
            margin-top: 20px;
            border: none;
        }

        .signature-table td {
            border: none;
            padding: 5px;
        }

        .signature-box {
            text-align: center;
            margin-top: 60px;
        }

        .small-text {
            font-size: 9pt;
        }

        ul {
            margin: 5px 0;
            padding-left: 20px;
        }

        ul li {
            margin-bottom: 3px;
        }

        @media print {
            body {
                margin: 10px;
            }

            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>Formulir 07</h2>
            <h3>Diskusi Kelompok Terfokus</h3>
        </div>

        <!-- Intro Text -->
        <div class="intro-text">
            <em>FGD</em> membantu pengumpulan data kualitatif yang memberikan gambaran tentang masalah-masalah yang tidak tertampung dalam laporan statistik maupun survei. <em>FGD</em> memungkinkan tim untuk dapat mendapatkan gambaran pemikiran masyarakat tentang pemilihan dan. Silakan laksanakan <em>FGD</em> secara informal, singkat dan efektif. Salah satu fungsinya adalah untuk melihat berencana sesuai <em>FGD</em> yang lebih baik dan peryekaman yang teliti waktu tidak harus rinci.
        </div>

        <!-- Umum Section -->
        <div class="section-box">
            <div class="section-title">UMUM</div>

            <div class="form-row">
                Desa/kelurahan asal: <span class="underline">{{ $form->desa_kelurahan ?? '__________________' }}</span>
                &nbsp;&nbsp;&nbsp;
                Kecamatan asal: <span class="underline">{{ $form->kecamatan ?? '__________________' }}</span>
            </div>

            <div class="form-row">
                Kabupaten asal: <span class="underline">{{ $form->kabupaten ?? '__________________' }}</span>
                &nbsp;&nbsp;&nbsp;
                Tanggal: <span class="underline">{{ $form->tanggal ? \Carbon\Carbon::parse($form->tanggal)->format('d/m/Y') : '__________________' }}</span>
            </div>

            <div class="form-row">
                Km dari Bencana: <span class="underline">{{ $form->jarak_bencana ?? '__________________' }}</span> (diisi oleh fasilitator/pencatat)
            </div>

            <div class="form-row">
                Tempat sesi: <span class="underline">{{ $form->tempat_sesi ?? '__________________' }}</span>
                Desa/kel: <span class="underline">{{ $form->desa_sesi ?? '__________________' }}</span>
                Kec: <span class="underline">{{ $form->kec_sesi ?? '__________________' }}</span>
            </div>

            <div class="form-row">
                Jumlah peserta: <span class="underline">{{ $form->jumlah_peserta ?? '____' }}</span> (perempuan: <span class="underline">{{ $form->jumlah_perempuan ?? '____' }}</span> laki-laki: <span class="underline">{{ $form->jumlah_laki_laki ?? '____' }}</span>)
            </div>

            <div class="form-row">
                Gambaran komposisi peserta, misalnya pekerjaan, status sosial, kelompok umur, dsb.
            </div>

            <div class="form-row" style="margin-left: 20px;">
                {{ $form->komposisi_peserta ?? '_____________________________________________________________________________' }}
            </div>

            <div class="checklist-section">
                <table style="width: 100%; border: none;">
                    <tr>
                        <td style="width: 50%; border: none; vertical-align: top;">
                            <strong>Penyelenggara</strong><br>
                            Fasilitator: <span class="underline" style="min-width: 150px;">{{ $form->fasilitator ?? '________________' }}</span><br>
                            Pencatat: <span class="underline" style="min-width: 150px;">{{ $form->pencatat ?? '________________' }}</span>
                        </td>
                        <td style="width: 50%; border: none; vertical-align: top;">
                            <strong>Paraf</strong><br>
                            <span class="underline" style="min-width: 150px;">{{ $form->paraf_fasilitator ?? '________________' }}</span><br>
                            <span class="underline" style="min-width: 150px;">{{ $form->paraf_pencatat ?? '________________' }}</span>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="checklist-section">
                <div class="checklist-title">Checklist Persiapan</div>
                <div class="checklist-item">
                    1. Persiapan pra-FGD:
                    <span class="checkbox {{ isset($form->persiapan_pra_fgd) && $form->persiapan_pra_fgd ? 'checked' : '' }}"></span> Ya
                    <span class="checkbox {{ isset($form->persiapan_pra_fgd) && !$form->persiapan_pra_fgd ? 'checked' : '' }}"></span> Tidak
                </div>
                <div class="checklist-item">
                    2. Pembagian tugas pelaksana
                    <span class="checkbox {{ isset($form->pembagian_tugas) && $form->pembagian_tugas ? 'checked' : '' }}"></span> Ya
                    <span class="checkbox {{ isset($form->pembagian_tugas) && !$form->pembagian_tugas ? 'checked' : '' }}"></span> Tidak
                </div>
                <div class="checklist-item">
                    3. Koordinasi dengan pengantar
                    <span class="checkbox {{ isset($form->koordinasi_pengantar) && $form->koordinasi_pengantar ? 'checked' : '' }}"></span> Ya
                    <span class="checkbox {{ isset($form->koordinasi_pengantar) && !$form->koordinasi_pengantar ? 'checked' : '' }}"></span> Tidak
                </div>
                <div class="checklist-item">
                    4. Pembahasan
                    <span class="checkbox {{ isset($form->pembahasan) && $form->pembahasan ? 'checked' : '' }}"></span> Ya
                    <span class="checkbox {{ isset($form->pembahasan) && !$form->pembahasan ? 'checked' : '' }}"></span> Tidak
                </div>
                <div class="checklist-item">
                    5. Pendalaman Tanya jawab
                    <span class="checkbox {{ isset($form->pendalaman_tanya_jawab) && $form->pendalaman_tanya_jawab ? 'checked' : '' }}"></span> Ya
                    <span class="checkbox {{ isset($form->pendalaman_tanya_jawab) && !$form->pendalaman_tanya_jawab ? 'checked' : '' }}"></span> Tidak
                </div>
                <div class="checklist-item">
                    6. Penyimpulan dan penutupan
                    <span class="checkbox {{ isset($form->penyimpulan_penutupan) && $form->penyimpulan_penutupan ? 'checked' : '' }}"></span> Ya
                    <span class="checkbox {{ isset($form->penyimpulan_penutupan) && !$form->penyimpulan_penutupan ? 'checked' : '' }}"></span> Tidak
                </div>
            </div>
        </div>

        <!-- Page Break -->
        <div class="page-break"></div>

        <!-- Pertanyaan Akses Section -->
        <h3 style="text-align: center; margin: 20px 0;">Pertanyaan Akses</h3>

        <table>
            <thead>
                <tr>
                    <th style="width: 14%;">Hak Bekerja</th>
                    <th style="width: 14%;">Hak Jaminan Keamanan Sosial</th>
                    <th style="width: 14%;">Hak Memperoleh Perlindungan & Bantuan Keluarga</th>
                    <th style="width: 14%;">Hak Memperoleh Taraf Baku Kehidupan Memadai</th>
                    <th style="width: 15%;">Hak Pelayanan Kesehatan</th>
                    <th style="width: 14%;">Hak Memperoleh Pendidikan Dasar & Lanjutan</th>
                    <th style="width: 15%;">Hak Menikmati Hasil Kehidupan & Martabat Penge tahuan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="small-text">
                        1. Apakah "Kepala Keluarga" dapat melaksanakan aktivitas bekerja sebelum bencana<br>
                        2. Apa bentuk bantuan yang dibutuhkan:<br>
                        • Modal<br>
                        • Alat<br>
                        • Keterampilan
                    </td>
                    <td class="small-text">
                        1. Bila beraktivitas apakah memiliki sumber daya cadangan:<br>
                        Dan apa Bentuk sumberdaya cadangan yang dimiliki
                    </td>
                    <td class="small-text">
                        1. Perlindungan terhadap keluarga:<br>
                        • Perempuan<br>
                        • Anak<br>
                        •
                    </td>
                    <td class="small-text">
                        1. Sandang, Pangan dan Perumahan<br>
                        2. Transportasi<br>
                        3. Papan<br>
                        4. Air bersih sanitasi<br>
                        5. MCK<br>
                        6. Kebutuhan energi (BB, listrik, gas)
                    </td>
                    <td class="small-text">
                        1. Tenaga medis berfungsi?<br>
                        2. Obat?<br>
                        3. Tempat pelayanan dapat dicapai dgn mudah<br>
                        4. Biaya
                    </td>
                    <td class="small-text">
                        1. Tenaga didik berfungsi?<br>
                        2. Sekolah dan perlengkapan anak didik<br>
                        3. Tempat dapat dicapai<br>
                        4. Biaya
                    </td>
                    <td class="small-text">
                        1. Apakah bisa melaksanakan kegiatan yang ada dalam tradisi yang diinginkan<br>
                        2. Apakah melaksanakan kegiatan-kegiatan yang ada dalam ritual keagamaan yang dijalanin?<br>
                        3. Apakah tradisi yang ada digunakan dalam mekanisme penanggulangan bencana yang ada?
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Page Break -->
        <div class="page-break"></div>

        <!-- Pertanyaan Fungsi Section -->
        <h3 style="text-align: center; margin: 20px 0;">Pertanyaan Fungsi</h3>

        <table>
            <thead>
                <tr>
                    <th style="width: 25%;">Pranata Sosial</th>
                    <th style="width: 25%;">Pranata Ekonomi</th>
                    <th style="width: 25%;">Pranata Agama dan tradisi</th>
                    <th style="width: 25%;">Pranata Pemerintahan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="small-text">
                        1. Apa saja organisasi yang ada<br>
                        2. Bagaimana organisasi itu berfungsi selama ini<br>
                        3. Bagaimana keadanya selama ini<br>
                        4. Bagaimana keadanya setelah bencana?<br>
                        5. Mengapa keadaannya sedemikian rupa<br>
                        6. Bagaimana caranya lembaga tersebut dimaksimalisi
                    </td>
                    <td class="small-text">
                        1. Apa saja organisasi yang ada<br>
                        2. Bagaimana organisasi itu berfungsi selama ini<br>
                        3. Bagaimana keadanya selama ini<br>
                        4. Bagaimana keadanya setelah bencana?<br>
                        5. Mengapa keadaannya sedemikian rupa<br>
                        6. Bagaimana caranya lembaga tersebut dimaksimalisi
                    </td>
                    <td class="small-text">
                        1. Apa saja organisasi yang ada<br>
                        2. Bagaimana organisasi itu berfungsi selama ini<br>
                        3. Bagaimana keadanya setelah bencana terjadi?<br>
                        4. Bagaimana keadanya setelah bencana?<br>
                        5. Mengapa keadaannya sedemikian rupa<br>
                        6. Bagaimana caranya lembaga tersebut dimaksimalisasi
                    </td>
                    <td class="small-text">
                        1. Bagaimana organisasi itu berfungsi selama ini?<br>
                        2. Bagaimana peranya waktu bencana terjadi?<br>
                        3. Bagaimana keadaannya setelah bencana?<br>
                        4. Mengapa keadaannya sedemikian rupa<br>
                        5. Bagaimarna caranya lembaga tersebut dimaksimalisasi<br>
                        6. Jika organisasi Pemerintahan tidak dapat berfungsi, apa dampaknya kepada kehidupan komunitas?
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Page Break -->
        <div class="page-break"></div>

        <!-- Pertanyaan Resiko Section -->
        <h3 style="text-align: center; margin: 20px 0;">Pertanyaan Resiko</h3>

        <table>
            <thead>
                <tr>
                    <th style="width: 33%;">Karakter Sosial</th>
                    <th style="width: 33%;">Karakter & Kelas Ekonomi</th>
                    <th style="width: 34%;">Karakter Geografis</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="small-text">
                        1. Dari sudut karakter sosial, kelompok manakan yang paling rentan?<br>
                        2. Mengapa bisa begitu?<br>
                        3. Mengapa bisa begitu?<br>
                        4. Bagaimana caranya membantu mereka?<br>
                        5. Mengapa harus dengan cara itu?
                    </td>
                    <td class="small-text">
                        1. Dari sudut karakter sosial-ekonomi, kelompok manakan yang paling rentan?<br>
                        2. Mengapa bisa begitu?<br>
                        3. Mengapa bisa begitu?<br>
                        4. Bagaimana caranya membantu mereka?<br>
                        5. Mengapa harus dengan cara i
                    </td>
                    <td class="small-text">
                        1. Dari sudut karakter lokasi tempat tinggal dan lahan pertaniannya., kelompok manakan yang paling rentan?<br>
                        2. Apa bentuk kerentanan mereka<br>
                        3. Mengapa bisa begitu?<br>
                        4. Bagaimana caranya membantu mereka?<br>
                        5. Mengapa harus dengan cara itu?
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Signature Section -->
        <div class="signature-table">
            <table style="border: none; margin-top: 30px;">
                <tr>
                    <td style="width: 50%; border: none; text-align: center;"></td>
                    <td style="width: 50%; border: none; text-align: center;">
                        {{ $form->kabupaten ?? 'Kabupaten' }}, {{ $form->tanggal ? \Carbon\Carbon::parse($form->tanggal)->format('d F Y') : now()->format('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <td style="border: none; text-align: center;">
                        <strong>Pencatat</strong>
                        <div class="signature-box">
                            {{ $form->pencatat ?? '(____________________)' }}
                        </div>
                    </td>
                    <td style="border: none; text-align: center;">
                        <strong>Fasilitator</strong>
                        <div class="signature-box">
                            {{ $form->fasilitator ?? '(____________________)' }}
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Footer Note -->
        <div style="margin-top: 30px; border-top: 2px solid #000; padding-top: 10px; text-align: center; font-size: 9pt; color: #666;">
            <p><em>Formulir 07 - Diskusi Kelompok Terfokus (FGD)</em></p>
            <p><strong>JITUPASNA</strong> - Sistem Informasi Pengkajian Kebutuhan Pasca Bencana</p>
        </div>
    </div>
</body>

</html>
