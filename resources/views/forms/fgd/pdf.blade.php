<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 07 - Diskusi Kelompok Terfokus (FGD)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.4;
            margin: 0;
            padding: 1cm;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #000;
            padding-bottom: 10px;
        }
        .title {
            font-size: 16pt;
            font-weight: bold;
            margin: 5px 0;
        }
        .subtitle {
            font-size: 14pt;
            margin: 5px 0;
        }
        .section {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .section-title {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 2px solid #4a6cf7;
            padding-bottom: 5px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            width: 30%;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10pt;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .page-break {
            page-break-after: always;
        }
        .text-content {
            margin-top: 10px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #eee;
            border-radius: 4px;
            min-height: 50px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">FORMULIR 07 - DISKUSI KELOMPOK TERFOKUS (FGD)</div>
        <div class="subtitle">PENGKAJIAN KEBUTUHAN PASCA BENCANA</div>
    </div>
    
    <div class="section">
        <div class="section-title">1. Informasi Umum</div>
        <table>
            <tr>
                <th>Nama Bencana</th>
                <td>{{ $fgd->bencana->Ref }}</td>
            </tr>
            <tr>
                <th>Tanggal Bencana</th>
                <td>{{ $fgd->bencana->tanggal }}</td>
            </tr>
            <tr>
                <th>Desa/Kelurahan Asal</th>
                <td>{{ $fgd->desa_kelurahan }}</td>
            </tr>
            <tr>
                <th>Kecamatan Asal</th>
                <td>{{ $fgd->kecamatan }}</td>
            </tr>
            <tr>
                <th>Kabupaten Asal</th>
                <td>{{ $fgd->kabupaten }}</td>
            </tr>
            <tr>
                <th>Jarak dari Lokasi Bencana</th>
                <td>{{ $fgd->jarak_bencana }} KM</td>
            </tr>
        </table>
    </div>
    
    <div class="section">
        <div class="section-title">2. Informasi Pelaksanaan</div>
        <table>
            <tr>
                <th>Tanggal Pelaksanaan</th>
                <td>{{ \Carbon\Carbon::parse($fgd->tanggal)->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Tempat Sesi</th>
                <td>{{ $fgd->tempat_sesi }}</td>
            </tr>
            <tr>
                <th>Jumlah Peserta</th>
                <td>{{ $fgd->jumlah_peserta }} orang</td>
            </tr>
            <tr>
                <th>Jumlah Peserta Perempuan</th>
                <td>{{ $fgd->jumlah_perempuan }} orang</td>
            </tr>
            <tr>
                <th>Jumlah Peserta Laki-laki</th>
                <td>{{ $fgd->jumlah_laki_laki }} orang</td>
            </tr>
            <tr>
                <th>Komposisi Peserta</th>
                <td>{{ $fgd->komposisi_peserta }}</td>
            </tr>
            <tr>
                <th>Fasilitator</th>
                <td>{{ $fgd->fasilitator }}</td>
            </tr>
            <tr>
                <th>Pencatat</th>
                <td>{{ $fgd->pencatat }}</td>
            </tr>
        </table>
    </div>
    
    <div class="page-break"></div>
    
    <div class="section">
        <div class="section-title">3. Hasil Diskusi - Akses Hak</div>
        <div class="text-content">
            {!! nl2br(e($fgd->akses_hak)) ?? '<em>Tidak ada data</em>' !!}
        </div>
    </div>
    
    <div class="section">
        <div class="section-title">4. Hasil Diskusi - Fungsi Pranata</div>
        <div class="text-content">
            {!! nl2br(e($fgd->fungsi_pranata)) ?? '<em>Tidak ada data</em>' !!}
        </div>
    </div>
    
    <div class="section">
        <div class="section-title">5. Hasil Diskusi - Resiko Kerentanan</div>
        <div class="text-content">
            {!! nl2br(e($fgd->resiko_kerentanan)) ?? '<em>Tidak ada data</em>' !!}
        </div>
    </div>
    
    <div class="section">
        <div class="section-title">6. Informasi Pencatatan</div>
        <table>
            <tr>
                <th>Dibuat Oleh</th>
                <td>{{ $fgd->createdBy->name ?? 'Unknown' }}</td>
            </tr>
            <tr>
                <th>Tanggal Input</th>
                <td>{{ $fgd->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @if($fgd->updated_by)
            <tr>
                <th>Diperbarui Oleh</th>
                <td>{{ $fgd->updatedBy->name ?? 'Unknown' }}</td>
            </tr>
            <tr>
                <th>Tanggal Update</th>
                <td>{{ $fgd->updated_at->format('d-m-Y H:i') }}</td>
            </tr>
            @endif
        </table>
    </div>
    
    <div class="footer">
        JITUPASNA - Formulir 07 - Diskusi Kelompok Terfokus (FGD) | Halaman 1 dari 1
    </div>
</body>
</html>
