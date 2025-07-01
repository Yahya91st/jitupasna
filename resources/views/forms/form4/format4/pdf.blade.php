<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Sosial - {{ $report->nama_kampung }}</title>
    <style>
        @page {
            size: landscape;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .header h2 {
            font-size: 14px;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .info-table td, .info-table th {
            width: 25%;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .footer-sign {
            display: inline-block;
            width: 200px;
            text-align: center;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FORMULIR 04 - PENGUMPULAN DATA SEKTOR</h1>
        <h2>FORMAT 4: PENGUMPULAN DATA SEKTOR SOSIAL</h2>
    </div>

    <table class="info-table">
        <tr>
            <th>Bencana</th>
            <td>{{ $bencana->kategori_bencana->nama }}</td>
            <th>Tanggal</th>
            <td>{{ $bencana->tanggal }}</td>
        </tr>
        <tr>
            <th>Kampung</th>
            <td>{{ $report->nama_kampung }}</td>
            <th>Distrik</th>
            <td>{{ $report->nama_distrik }}</td>
        </tr>
    </table>

    <h3>A. Data Kerusakan Fasilitas Sosial</h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2" class="text-center">Jenis Fasilitas Sosial</th>
                <th colspan="3" class="text-center">Jumlah Kerusakan</th>
                <th rowspan="2" class="text-center">Ukuran Rata-rata (m²)</th>
                <th rowspan="2" class="text-center">Harga Bangunan<br>(Rp/m²)</th>
                <th rowspan="2" class="text-center">Harga Peralatan<br>(Rp/unit)</th>
                <th rowspan="2" class="text-center">Harga Meubelair<br>(Rp/unit)</th>
            </tr>
            <tr>
                <th class="text-center">Rusak Berat</th>
                <th class="text-center">Rusak Sedang</th>
                <th class="text-center">Rusak Ringan</th>
            </tr>
        </thead>
        <tbody>
            <!-- Panti Sosial -->
            <tr>
                <td>Panti Sosial</td>
                <td class="text-center">{{ $report->panti_sosial_rb }}</td>
                <td class="text-center">{{ $report->panti_sosial_rs }}</td>
                <td class="text-center">{{ $report->panti_sosial_rr }}</td>
                <td class="text-center">{{ $report->panti_sosial_luas }}</td>
                <td class="text-right">{{ number_format($report->panti_sosial_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->panti_sosial_harga_peralatan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->panti_sosial_harga_meubelair, 0, ',', '.') }}</td>
            </tr>
            
            <!-- Panti Asuhan -->
            <tr>
                <td>Panti Asuhan</td>
                <td class="text-center">{{ $report->panti_asuhan_rb }}</td>
                <td class="text-center">{{ $report->panti_asuhan_rs }}</td>
                <td class="text-center">{{ $report->panti_asuhan_rr }}</td>
                <td class="text-center">{{ $report->panti_asuhan_luas }}</td>
                <td class="text-right">{{ number_format($report->panti_asuhan_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->panti_asuhan_harga_peralatan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->panti_asuhan_harga_meubelair, 0, ',', '.') }}</td>
            </tr>
            
            <!-- Panti Jompo -->
            <tr>
                <td>Panti Jompo</td>
                <td class="text-center">{{ $report->panti_jompo_rb }}</td>
                <td class="text-center">{{ $report->panti_jompo_rs }}</td>
                <td class="text-center">{{ $report->panti_jompo_rr }}</td>
                <td class="text-center">{{ $report->panti_jompo_luas }}</td>
                <td class="text-right">{{ number_format($report->panti_jompo_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->panti_jompo_harga_peralatan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->panti_jompo_harga_meubelair, 0, ',', '.') }}</td>
            </tr>
            
            <!-- Rumah Pengungsian -->
            <tr>
                <td>Rumah Pengungsian</td>
                <td class="text-center">{{ $report->rumah_pengungsian_rb }}</td>
                <td class="text-center">{{ $report->rumah_pengungsian_rs }}</td>
                <td class="text-center">{{ $report->rumah_pengungsian_rr }}</td>
                <td class="text-center">{{ $report->rumah_pengungsian_luas }}</td>
                <td class="text-right">{{ number_format($report->rumah_pengungsian_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->rumah_pengungsian_harga_peralatan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->rumah_pengungsian_harga_meubelair, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>B. Data Kerugian Sektor Sosial</h3>
    <table>
        <tr>
            <th class="text-center">Biaya Penampungan Sementara (Hari)</th>
            <td class="text-center">{{ $report->biaya_penampungan_hari }}</td>
            <th class="text-center">Biaya Per Hari (Rp)</th>
            <td class="text-center">{{ number_format($report->biaya_penampungan_per_hari, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th class="text-center">Biaya Pembersihan (m²)</th>
            <td class="text-center">{{ $report->biaya_pembersihan_luas }}</td>
            <th class="text-center">Biaya Per m² (Rp)</th>
            <td class="text-center">{{ number_format($report->biaya_pembersihan_per_meter, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>{{ $report->nama_distrik }}, {{ now()->format('d F Y') }}</p>
        <div class="footer-sign">
            <p>Petugas</p>
            <br><br><br>
            <p>___________________________</p>
            <p>NIP.</p>
        </div>
    </div>
</body>
</html>
