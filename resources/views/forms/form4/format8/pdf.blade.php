<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Infrastruktur - {{ $report->nama_kampung }}</title>
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
        <h2>FORMAT 8: PENGUMPULAN DATA SEKTOR INFRASTRUKTUR</h2>
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

    <h3>A. Data Kerusakan Infrastruktur Publik</h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2" class="text-center">Jenis Infrastruktur</th>
                <th colspan="3" class="text-center">Jumlah Kerusakan</th>
                <th rowspan="2" class="text-center">Panjang (m)</th>
                <th rowspan="2" class="text-center">Lebar (m)</th>
                <th rowspan="2" class="text-center">Harga Satuan<br>(Rp/m²)</th>
                <th rowspan="2" class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
            <tr>
                <th class="text-center">Rusak Berat</th>
                <th class="text-center">Rusak Sedang</th>
                <th class="text-center">Rusak Ringan</th>
            </tr>
        </thead>
        <tbody>
            <!-- Saluran Air -->
            <tr>
                <td>Saluran Air/Drainase</td>
                <td class="text-center">{{ $report->saluran_air_rb }}</td>
                <td class="text-center">{{ $report->saluran_air_rs }}</td>
                <td class="text-center">{{ $report->saluran_air_rr }}</td>
                <td class="text-center">{{ $report->saluran_air_panjang }}</td>
                <td class="text-center">{{ $report->saluran_air_lebar }}</td>
                <td class="text-right">{{ number_format($report->saluran_air_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(
                    ($report->saluran_air_rb * $report->saluran_air_panjang * $report->saluran_air_lebar * $report->saluran_air_harga) +
                    ($report->saluran_air_rs * $report->saluran_air_panjang * $report->saluran_air_lebar * $report->saluran_air_harga * 0.3) +
                    ($report->saluran_air_rr * $report->saluran_air_panjang * $report->saluran_air_lebar * $report->saluran_air_harga * 0.1)
                , 0, ',', '.') }}</td>
            </tr>
            
            <!-- Embung/Waduk -->
            <tr>
                <td>Embung/Waduk</td>
                <td class="text-center">{{ $report->embung_rb }}</td>
                <td class="text-center">{{ $report->embung_rs }}</td>
                <td class="text-center">{{ $report->embung_rr }}</td>
                <td class="text-center">{{ $report->embung_panjang }}</td>
                <td class="text-center">{{ $report->embung_lebar }}</td>
                <td class="text-right">{{ number_format($report->embung_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(
                    ($report->embung_rb * $report->embung_panjang * $report->embung_lebar * $report->embung_harga) +
                    ($report->embung_rs * $report->embung_panjang * $report->embung_lebar * $report->embung_harga * 0.3) +
                    ($report->embung_rr * $report->embung_panjang * $report->embung_lebar * $report->embung_harga * 0.1)
                , 0, ',', '.') }}</td>
            </tr>
            
            <!-- Tanggul -->
            <tr>
                <td>Tanggul/Dam</td>
                <td class="text-center">{{ $report->tanggul_rb }}</td>
                <td class="text-center">{{ $report->tanggul_rs }}</td>
                <td class="text-center">{{ $report->tanggul_rr }}</td>
                <td class="text-center">{{ $report->tanggul_panjang }}</td>
                <td class="text-center">{{ $report->tanggul_lebar }}</td>
                <td class="text-right">{{ number_format($report->tanggul_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(
                    ($report->tanggul_rb * $report->tanggul_panjang * $report->tanggul_lebar * $report->tanggul_harga) +
                    ($report->tanggul_rs * $report->tanggul_panjang * $report->tanggul_lebar * $report->tanggul_harga * 0.3) +
                    ($report->tanggul_rr * $report->tanggul_panjang * $report->tanggul_lebar * $report->tanggul_harga * 0.1)
                , 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>B. Data Kerugian Sektor Infrastruktur</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Kerugian</th>
                <th class="text-center">Pendapatan Per Hari (Rp)</th>
                <th class="text-center">Jumlah Hari</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Biaya Operasional Darurat</td>
                <td class="text-right">{{ number_format($report->operasional_darurat_biaya, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->operasional_darurat_hari }}</td>
                <td class="text-right">{{ number_format($report->operasional_darurat_biaya * $report->operasional_darurat_hari, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Pembersihan</td>
                <td class="text-right">{{ number_format($report->biaya_pembersihan_harga, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->biaya_pembersihan_volume }}</td>
                <td class="text-right">{{ number_format($report->biaya_pembersihan_harga * $report->biaya_pembersihan_volume, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Penanganan Darurat Lainnya</td>
                <td class="text-right">{{ number_format($report->penanganan_lainnya_biaya, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->penanganan_lainnya_hari }}</td>
                <td class="text-right">{{ number_format($report->penanganan_lainnya_biaya * $report->penanganan_lainnya_hari, 0, ',', '.') }}</td>
            </tr>
        </tbody>
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
