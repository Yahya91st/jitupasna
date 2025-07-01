<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Ekonomi - {{ $report->nama_kampung }}</title>
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
        <h2>FORMAT 5: PENGUMPULAN DATA SEKTOR EKONOMI</h2>
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

    <h3>A. Data Kerusakan Infrastruktur Ekonomi</h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2" class="text-center">Jenis Infrastruktur Ekonomi</th>
                <th colspan="3" class="text-center">Jumlah Kerusakan</th>
                <th rowspan="2" class="text-center">Ukuran Rata-rata (m²)</th>
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
            <!-- Toko/Kios/Ruko -->
            <tr>
                <td>Toko/Kios/Ruko</td>
                <td class="text-center">{{ $report->toko_rb }}</td>
                <td class="text-center">{{ $report->toko_rs }}</td>
                <td class="text-center">{{ $report->toko_rr }}</td>
                <td class="text-center">{{ $report->toko_luas }}</td>
                <td class="text-right">{{ number_format($report->toko_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(
                    ($report->toko_rb * $report->toko_luas * $report->toko_harga) +
                    ($report->toko_rs * $report->toko_luas * $report->toko_harga * 0.3) +
                    ($report->toko_rr * $report->toko_luas * $report->toko_harga * 0.1)
                , 0, ',', '.') }}</td>
            </tr>
            
            <!-- Pasar Tradisional -->
            <tr>
                <td>Pasar Tradisional</td>
                <td class="text-center">{{ $report->pasar_rb }}</td>
                <td class="text-center">{{ $report->pasar_rs }}</td>
                <td class="text-center">{{ $report->pasar_rr }}</td>
                <td class="text-center">{{ $report->pasar_luas }}</td>
                <td class="text-right">{{ number_format($report->pasar_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(
                    ($report->pasar_rb * $report->pasar_luas * $report->pasar_harga) +
                    ($report->pasar_rs * $report->pasar_luas * $report->pasar_harga * 0.3) +
                    ($report->pasar_rr * $report->pasar_luas * $report->pasar_harga * 0.1)
                , 0, ',', '.') }}</td>
            </tr>
            
            <!-- Hotel/Penginapan -->
            <tr>
                <td>Hotel/Penginapan</td>
                <td class="text-center">{{ $report->hotel_rb }}</td>
                <td class="text-center">{{ $report->hotel_rs }}</td>
                <td class="text-center">{{ $report->hotel_rr }}</td>
                <td class="text-center">{{ $report->hotel_luas }}</td>
                <td class="text-right">{{ number_format($report->hotel_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(
                    ($report->hotel_rb * $report->hotel_luas * $report->hotel_harga) +
                    ($report->hotel_rs * $report->hotel_luas * $report->hotel_harga * 0.3) +
                    ($report->hotel_rr * $report->hotel_luas * $report->hotel_harga * 0.1)
                , 0, ',', '.') }}</td>
            </tr>
            
            <!-- Gudang -->
            <tr>
                <td>Gudang</td>
                <td class="text-center">{{ $report->gudang_rb }}</td>
                <td class="text-center">{{ $report->gudang_rs }}</td>
                <td class="text-center">{{ $report->gudang_rr }}</td>
                <td class="text-center">{{ $report->gudang_luas }}</td>
                <td class="text-right">{{ number_format($report->gudang_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(
                    ($report->gudang_rb * $report->gudang_luas * $report->gudang_harga) +
                    ($report->gudang_rs * $report->gudang_luas * $report->gudang_harga * 0.3) +
                    ($report->gudang_rr * $report->gudang_luas * $report->gudang_harga * 0.1)
                , 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>B. Data Kerugian Sektor Ekonomi</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Usaha</th>
                <th class="text-center">Pendapatan Per Hari (Rp)</th>
                <th class="text-center">Jumlah Hari Kerugian</th>
                <th class="text-center">Jumlah Unit Usaha</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Usaha Mikro</td>
                <td class="text-right">{{ number_format($report->usaha_mikro_pendapatan, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->usaha_mikro_hari }}</td>
                <td class="text-center">{{ $report->usaha_mikro_jumlah }}</td>
                <td class="text-right">{{ number_format($report->usaha_mikro_pendapatan * $report->usaha_mikro_hari * $report->usaha_mikro_jumlah, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Usaha Kecil</td>
                <td class="text-right">{{ number_format($report->usaha_kecil_pendapatan, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->usaha_kecil_hari }}</td>
                <td class="text-center">{{ $report->usaha_kecil_jumlah }}</td>
                <td class="text-right">{{ number_format($report->usaha_kecil_pendapatan * $report->usaha_kecil_hari * $report->usaha_kecil_jumlah, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Usaha Menengah</td>
                <td class="text-right">{{ number_format($report->usaha_menengah_pendapatan, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->usaha_menengah_hari }}</td>
                <td class="text-center">{{ $report->usaha_menengah_jumlah }}</td>
                <td class="text-right">{{ number_format($report->usaha_menengah_pendapatan * $report->usaha_menengah_hari * $report->usaha_menengah_jumlah, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Usaha Besar</td>
                <td class="text-right">{{ number_format($report->usaha_besar_pendapatan, 0, ',', '.') }}</td>
                <td class="text-center">{{ $report->usaha_besar_hari }}</td>
                <td class="text-center">{{ $report->usaha_besar_jumlah }}</td>
                <td class="text-right">{{ number_format($report->usaha_besar_pendapatan * $report->usaha_besar_hari * $report->usaha_besar_jumlah, 0, ',', '.') }}</td>
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
