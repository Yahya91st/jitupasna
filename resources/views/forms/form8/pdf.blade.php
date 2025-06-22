<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pengolahan dan Analisis Data Penilaian Kerusakan dan Kerugian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            font-size: 12pt;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .header h2, .header h3 {
            margin: 5px 0;
        }
        table.info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table.info th {
            text-align: left;
            width: 35%;
            padding: 5px;
            vertical-align: top;
        }
        table.info td {
            padding: 5px;
            vertical-align: top;
        }
        .section {
            margin-top: 20px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .subsection {
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .finansial {
            float: left;
            width: 45%;
            margin-top: 10px;
        }
        .finansial table {
            width: 100%;
            border-collapse: collapse;
        }
        .finansial table th,
        .finansial table td {
            padding: 5px;
            text-align: left;
        }
        .clear {
            clear: both;
        }
        @page {
            margin: 2cm;
        }
    </style>
</head>
<body>
    <!-- Kop Surat -->
    <div class="header">
        <!-- <img src="{{ public_path('assets/images/logo_bnpb.png') }}" alt="Logo BNPB"> -->
        <h2>BADAN NASIONAL PENANGGULANGAN BENCANA</h2>
        <p>Jl. Pramuka No. 38, Jakarta Timur 13120<br>
        Telepon: (021) 29827793, Fax: (021) 21281200<br>
        Website: https://bnpb.go.id</p>
        <hr>
        <h3>FORMULIR 08 - PENGOLAHAN DAN ANALISIS DATA PENILAIAN KERUSAKAN DAN KERUGIAN</h3>
    </div>
    
    <!-- Data Bencana -->
    <div class="section">Data Bencana:</div>
    <table class="info">
        <tr>
            <th>Bencana</th>
            <td>: {{ $penilaian->bencana->kategori_bencana->nama }}</td>
        </tr>
        <tr>
            <th>Tanggal Kejadian</th>
            <td>: {{ $penilaian->bencana->tanggal instanceof \Carbon\Carbon ? $penilaian->bencana->tanggal->format('d F Y') : \Carbon\Carbon::parse($penilaian->bencana->tanggal)->format('d F Y') }}</td>
        </tr>
        <tr>
            <th>Lokasi Kejadian</th>
            <td>: 
                @foreach($penilaian->bencana->desa as $index => $desa)
                    {{ $desa->nama }}{{ $index < count($penilaian->bencana->desa) - 1 ? ', ' : '' }}
                @endforeach
            </td>
        </tr>
    </table>
    
    <!-- 1. Informasi Umum -->
    <div class="section">1. Informasi Umum</div>
    <table class="info">
        <tr>
            <th>Sektor</th>
            <td>: {{ $penilaian->sektor }}</td>
        </tr>
        <tr>
            <th>Sub Sektor</th>
            <td>: {{ $penilaian->sub_sektor }}</td>
        </tr>
        <tr>
            <th>Komponen Kerusakan dan Kerugian</th>
            <td>: {{ $penilaian->komponen_kerusakan }}</td>
        </tr>
        <tr>
            <th>Lokasi</th>
            <td>: {{ $penilaian->lokasi }}</td>
        </tr>
    </table>
    
    <!-- 2. Estimasi Kerugian -->
    <div class="section">2. Estimasi Kerugian</div>
    <table class="info">
        <tr>
            <th>Perkiraan Kerugian (Losses)</th>
            <td>: Rp {{ number_format($penilaian->perkiraan_kerugian, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Kerusakan + Kerugian</th>
            <td>: Rp {{ number_format($penilaian->total_kerusakan_kerugian, 0, ',', '.') }}</td>
        </tr>
    </table>
    
    <div class="subsection">Kebutuhan:</div>
    <table class="info">
        <tr>
            <th>Rehabilitasi (RB)</th>
            <td>: Rp {{ number_format($penilaian->kebutuhan_rb, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Rekonstruksi Sederhana (RS)</th>
            <td>: Rp {{ number_format($penilaian->kebutuhan_rs, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Rekonstruksi Besar (RR)</th>
            <td>: Rp {{ number_format($penilaian->kebutuhan_rr, 0, ',', '.') }}</td>
        </tr>
    </table>
    
    <!-- 3. Data Kerusakan -->
    <div class="section">3. Data Kerusakan</div>
    <table class="info">
        <tr>
            <th>Harga Satuan</th>
            <td>: Rp {{ number_format($penilaian->harga_satuan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Nilai Kerusakan (Damage)</th>
            <td>: Rp {{ number_format($penilaian->nilai_kerusakan, 0, ',', '.') }}</td>
        </tr>
    </table>
    
    <div style="margin-top: 50px;">
        <p>Dokumen ini dihasilkan secara otomatis oleh sistem JITU PASNA BNPB pada {{ \Carbon\Carbon::now()->format('d F Y, H:i:s') }}</p>
    </div>
</body>
</html>
