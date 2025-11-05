<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 02 - Surat Keputusan Pembentukan Tim Kerja PDNA</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.1;
            color: #000;
            margin: 0;
            padding: 8mm;
            font-size: 8pt;
        }

        .header {
            text-align: center;
            margin-bottom: 8px;
            border-bottom: 1px solid #000;
            padding-bottom: 4px;
        }

        .header h2 {
            font-size: 9pt;
            font-weight: bold;
            margin: 1px 0;
            text-transform: uppercase;
        }

        .header h3 {
            font-size: 8pt;
            font-weight: normal;
            margin: 1px 0;
        }

        .decree-header {
            text-align: center;
            margin: 8px 0;
        }

        .decree-header h1 {
            font-size: 9pt;
            font-weight: bold;
            margin: 2px 0;
            text-transform: uppercase;
        }

        .decree-header h2 {
            font-size: 8pt;
            font-weight: normal;
            margin: 1px 0;
        }

        .pejabat-section {
            text-align: center;
            margin: 8px 0;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 8pt;
        }

        .section {
            margin: 4px 0;
        }

        .section-label {
            font-weight: bold;
            margin-bottom: 2px;
            font-size: 8pt;
        }

        .section-content {
            margin-left: 12px;
            text-align: justify;
        }

        .section-content p {
            margin: 1px 0;
            text-indent: 0;
            font-size: 8pt;
        }

        .memutuskan {
            text-align: center;
            font-weight: bold;
            font-size: 9pt;
            margin: 6px 0;
            text-transform: uppercase;
        }

        .diktum {
            margin: 3px 0;
        }

        .diktum-label {
            font-weight: bold;
            margin-bottom: 1px;
            text-transform: uppercase;
            font-size: 8pt;
        }

        .diktum-content {
            margin-left: 12px;
            text-align: justify;
        }

        .diktum-content p {
            margin: 1px 0;
            font-size: 8pt;
        }

        .diktum-list {
            margin-left: 12px;
        }

        .diktum-list p {
            margin: 1px 0;
            font-size: 8pt;
        }

        .signature-section {
            margin-top: 10px;
            text-align: center;
        }

        .signature-left {
            text-align: left;
            margin-bottom: 15px;
            font-size: 8pt;
        }

        .signature-right {
            text-align: center;
            margin-left: 60%;
            font-size: 8pt;
        }

        .signature-space {
            height: 25px;
            margin: 5px 0;
        }

        .signature-name {
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
            margin-bottom: 2px;
            font-size: 8pt;
        }

        .tembusan {
            margin-top: 10px;
        }

        .tembusan-title {
            font-weight: bold;
            margin-bottom: 2px;
            font-size: 8pt;
        }

        .tembusan-list {
            margin-left: 12px;
        }

        .tembusan-list p {
            margin: 1px 0;
            font-size: 8pt;
        }

        /* Print styles */
        @media print {
            body {
                padding: 8mm;
            }
            
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>
<body>
    <!-- Header Formulir -->
    <div class="header">
        <h2>Formulir 02</h2>
        <h3>Surat Keputusan Pembentukan Tim Kerja</h3>
        <h3>Pengkajian Kebutuhan Pasca Bencana (PDNA)</h3>
    </div>

    <!-- Header Surat Keputusan -->
    <div class="decree-header">
        <h1>SURAT KEPUTUSAN</h1>
        <h2>No: {{ $form->nomor_surat ?? '................' }}</h2>
        <br>
        <h1>TENTANG</h1>
        <br>
        <h1>{{ strtoupper($form->tentang ?? 'PEMBENTUKAN TIM KERJA PENGKAJIAN KEBUTUHAN') }}</h1>
        <h1>{{ strtoupper($form->lokasi ?? 'PASCA BENCANA (PDNA) DI ..............') }}</h1>
    </div>

    <!-- Bagian Menimbang -->
    <div class="section">
        <div class="section-label">Menimbang</div>
        <div class="section-content">
            <p>a. bahwa dalam rangka perencanaan rehabilitasi dan rekonstruksi pascabencana di {{ $form->lokasi ?? '...........' }}, perlu dilaksanakan pengkajian kebutuhan pascabencana;</p>
            <p>b. bahwa untuk melaksanakan pengkajian kebutuhan pasca bencana perlu dibentuk tim kerja pengkajian kebutuhan pascabencana;</p>
            <p>c. bahwa untuk maksud tersebut huruf b, perlu ditetapkan dengan Keputusan {{ $form->pejabat_penandatangan ?? 'Deputi Rehabilitasi dan Rekonstruksi BNPB' }} (atau Kepala BPBD...);</p>
        </div>
    </div>

    <!-- Bagian Mengingat -->
    <div class="section">
        <div class="section-label">Mengingat</div>
        <div class="section-content">
            <p>a. Undang-Undang no. 24 tahun 2007 tentang Penanggulangan Bencana;</p>
            <p>b. Peraturan Pemerintah no. 21 tahun 2008 tentang Penyelenggaraan Penanggulangan Bencana;</p>
            <p>c. Peraturan Kepala BNPB no. 17 tahun 2010 tentang Pedoman Umum Rehabilitasi dan Rekonstruksi;</p>
        </div>
    </div>

    <!-- Memutuskan -->
    <div class="memutuskan">MEMUTUSKAN</div>

    <div class="section">
        <div class="section-label">Menetapkan</div>
    </div>

    <!-- Diktum Pertama -->
    <div class="diktum">
        <div class="diktum-label">PERTAMA</div>
        <div class="diktum-content">
            <p>: Membentuk Tim Kerja Pengkajian Kebutuhan Pascabencana di {{ $form->lokasi ?? '...........' }}, dengan susunan personil sebagaimana terdapat pada lampiran keputusan ini.</p>
        </div>
    </div>

    <!-- Diktum Kedua -->
    <div class="diktum">
        <div class="diktum-label">KEDUA</div>
        <div class="diktum-content">
            <p>: Tim dimaksud diktum pertama mempunyai tugas sebagai berikut:</p>
            <div class="diktum-list">
                <p>1. Melakukan perencanaan dan persiapan pelaksanaan pengkajian kebutuhan pascabencana.</p>
                <p>2. Melakukan pengumpulan data.</p>
                <p>3. Melakukan pengolahan dan analisis data.</p>
                <p>4. Menyusun laporan pengkajian kebutuhan pascabencana.</p>
            </div>
        </div>
    </div>

    <!-- Diktum Ketiga -->
    <div class="diktum">
        <div class="diktum-label">KETIGA</div>
        <div class="diktum-content">
            <p>: Tim Kerja dalam melaksanakan tugasnya bertanggung jawab kepada {{ $form->pejabat_penandatangan ?? 'Deputi Rehabilitasi dan Rekonstruksi BNPB' }} (atau Kepala Daerah....).</p>
        </div>
    </div>

    <!-- Diktum Keempat -->
    <div class="diktum">
        <div class="diktum-label">KEEMPAT</div>
        <div class="diktum-content">
            <p>: Keputusan ini berlaku sejak tanggal ditetapkan, apabila dikemudian hari terdapat kekeliruan dalam penetapan ini akan diperbaiki sebagaimana mestinya.</p>
        </div>
    </div>

    <!-- Bagian Tanda Tangan -->
    <div class="signature-section">
        <div class="signature-left">
            <p>Ditetapkan di: {{ $form->lokasi ?? '...............' }}</p>
            <p>Pada tanggal: {{ $form->tanggal_ditetapkan ?? '...............' }}</p>
        </div>
        
        <div class="signature-right">
            <p><strong>{{ strtoupper($form->pejabat_penandatangan ?? 'Deputi Rehabilitasi dan Rekonstruksi BNPB') }}</strong></p>
            <p><strong>(atau Kepala Pelaksana Harian BPBD...)</strong></p>
            
            <div class="signature-space"></div>
            
            <div class="signature-name">
                <strong>{{ $form->nama_penandatangan ?? 'Nama Jelas' }}</strong>
            </div>
        </div>
    </div>

    <!-- Tembusan -->
    <div class="tembusan">
        <div class="tembusan-title">Tembusan Yth.</div>
        <div class="tembusan-list">
            <p>1. Kepala BNPB (atau Kepala Daerah...)</p>
            <p>2. Menteri..... Kepala Lembaga..... (atau Kepala OPD...)</p>
        </div>
    </div>
</body>
</html>
