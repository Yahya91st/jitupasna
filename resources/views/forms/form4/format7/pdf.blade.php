<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Transportasi - {{ $report->nama_kampung }}</title>
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
        <h2>FORMAT 7: PENGUMPULAN DATA SEKTOR TRANSPORTASI</h2>
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

    <h3>A. Data Kerusakan Infrastruktur Transportasi</h3>
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
            <!-- Jalan -->
            <tr>
                <td>Jalan</td>
                <td class="text-center">{{ $report->jalan_rb }}</td>
                <td class="text-center">{{ $report->jalan_rs }}</td>
                <td class="text-center">{{ $report->jalan_rr }}</td>
                <td class="text-center">{{ $report->jalan_panjang }}</td>
                <td class="text-center">{{ $report->jalan_lebar }}</td>
                <td class="text-right">{{ number_format($report->jalan_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(
                    ($report->jalan_rb * $report->jalan_panjang * $report->jalan_lebar * $report->jalan_harga) +
                    ($report->jalan_rs * $report->jalan_panjang * $report->jalan_lebar * $report->jalan_harga * 0.3) +
                    ($report->jalan_rr * $report->jalan_panjang * $report->jalan_lebar * $report->jalan_harga * 0.1)
                , 0, ',', '.') }}</td>
            </tr>
            
            <!-- Jembatan -->
            <tr>
                <td>Jembatan</td>
                <td class="text-center">{{ $report->jembatan_rb }}</td>
                <td class="text-center">{{ $report->jembatan_rs }}</td>
                <td class="text-center">{{ $report->jembatan_rr }}</td>
                <td class="text-center">{{ $report->jembatan_panjang }}</td>
                <td class="text-center">{{ $report->jembatan_lebar }}</td>
                <td class="text-right">{{ number_format($report->jembatan_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(
                    ($report->jembatan_rb * $report->jembatan_panjang * $report->jembatan_lebar * $report->jembatan_harga) +
                    ($report->jembatan_rs * $report->jembatan_panjang * $report->jembatan_lebar * $report->jembatan_harga * 0.3) +
                    ($report->jembatan_rr * $report->jembatan_panjang * $report->jembatan_lebar * $report->jembatan_harga * 0.1)
                , 0, ',', '.') }}</td>
            </tr>
            
            <!-- Terminal -->
            <tr>
                <td>Terminal</td>
                <td class="text-center">{{ $report->terminal_rb }}</td>
                <td class="text-center">{{ $report->terminal_rs }}</td>
                <td class="text-center">{{ $report->terminal_rr }}</td>
                <td class="text-center">{{ $report->terminal_panjang }}</td>
                <td class="text-center">{{ $report->terminal_lebar }}</td>
                <td class="text-right">{{ number_format($report->terminal_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(
                    ($report->terminal_rb * $report->terminal_panjang * $report->terminal_lebar * $report->terminal_harga) +
                    ($report->terminal_rs * $report->terminal_panjang * $report->terminal_lebar * $report->terminal_harga * 0.3) +
                    ($report->terminal_rr * $report->terminal_panjang * $report->terminal_lebar * $report->terminal_harga * 0.1)
                , 0, ',', '.') }}</td>
            </tr>
            
            <!-- Pelabuhan -->
            <tr>
                <td>Pelabuhan</td>
                <td class="text-center">{{ $report->pelabuhan_rb }}</td>
                <td class="text-center">{{ $report->pelabuhan_rs }}</td>
                <td class="text-center">{{ $report->pelabuhan_rr }}</td>
                <td class="text-center">{{ $report->pelabuhan_panjang }}</td>
                <td class="text-center">{{ $report->pelabuhan_lebar }}</td>
                <td class="text-right">{{ number_format($report->pelabuhan_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(
                    ($report->pelabuhan_rb * $report->pelabuhan_panjang * $report->pelabuhan_lebar * $report->pelabuhan_harga) +
                    ($report->pelabuhan_rs * $report->pelabuhan_panjang * $report->pelabuhan_lebar * $report->pelabuhan_harga * 0.3) +
                    ($report->pelabuhan_rr * $report->pelabuhan_panjang * $report->pelabuhan_lebar * $report->pelabuhan_harga * 0.1)
                , 0, ',', '.') }}</td>
            </tr>
            
            <!-- Bandara -->
            <tr>
                <td>Bandara</td>
                <td class="text-center">{{ $report->bandara_rb }}</td>
                <td class="text-center">{{ $report->bandara_rs }}</td>
                <td class="text-center">{{ $report->bandara_rr }}</td>
                <td class="text-center">{{ $report->bandara_panjang }}</td>
                <td class="text-center">{{ $report->bandara_lebar }}</td>
                <td class="text-right">{{ number_format($report->bandara_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(
                    ($report->bandara_rb * $report->bandara_panjang * $report->bandara_lebar * $report->bandara_harga) +
                    ($report->bandara_rs * $report->bandara_panjang * $report->bandara_lebar * $report->bandara_harga * 0.3) +
                    ($report->bandara_rr * $report->bandara_panjang * $report->bandara_lebar * $report->bandara_harga * 0.1)
                , 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>B. Data Kerugian Sektor Transportasi</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Kerugian</th>
                <th class="text-center">Pendapatan Per Hari (Rp)</th>
                <th class="text-center">Jumlah Hari</th>
                <th class="text-center">Jumlah Unit</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Angkutan Darat</td>
                <td class="text-right">{{ number_format($report->angkutan_darat_pendapatan, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->angkutan_darat_hari }}</td>
                <td class="text-center">{{ $report->angkutan_darat_unit }}</td>
                <td class="text-right">{{ number_format($report->angkutan_darat_pendapatan * $report->angkutan_darat_hari * $report->angkutan_darat_unit, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Angkutan Laut</td>
                <td class="text-right">{{ number_format($report->angkutan_laut_pendapatan, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->angkutan_laut_hari }}</td>
                <td class="text-center">{{ $report->angkutan_laut_unit }}</td>
                <td class="text-right">{{ number_format($report->angkutan_laut_pendapatan * $report->angkutan_laut_hari * $report->angkutan_laut_unit, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Angkutan Udara</td>
                <td class="text-right">{{ number_format($report->angkutan_udara_pendapatan, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->angkutan_udara_hari }}</td>
                <td class="text-center">{{ $report->angkutan_udara_unit }}</td>
                <td class="text-right">{{ number_format($report->angkutan_udara_pendapatan * $report->angkutan_udara_hari * $report->angkutan_udara_unit, 0, ',', '.') }}</td>
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
