<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Pertanian - {{ $report->nama_kampung }}</title>
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
        <h2>FORMAT 6: PENGUMPULAN DATA SEKTOR PERTANIAN</h2>
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

    <h3>A. Data Kerusakan Infrastruktur Pertanian</h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2" class="text-center">Jenis Infrastruktur</th>
                <th colspan="3" class="text-center">Jumlah Kerusakan</th>
                <th rowspan="2" class="text-center">Ukuran (m²/ha)</th>
                <th rowspan="2" class="text-center">Harga Satuan<br>(Rp/m² atau Rp/ha)</th>
                <th rowspan="2" class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
            <tr>
                <th class="text-center">Rusak Berat</th>
                <th class="text-center">Rusak Sedang</th>
                <th class="text-center">Rusak Ringan</th>
            </tr>
        </thead>
        <tbody>
            <!-- Sawah/Ladang -->
            <tr>
                <td>Sawah/Ladang</td>
                <td class="text-center">{{ $report->sawah_rb }}</td>
                <td class="text-center">{{ $report->sawah_rs }}</td>
                <td class="text-center">{{ $report->sawah_rr }}</td>
                <td class="text-center">{{ $report->sawah_luas }}</td>
                <td class="text-right">{{ number_format($report->sawah_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(
                    ($report->sawah_rb * $report->sawah_luas * $report->sawah_harga) +
                    ($report->sawah_rs * $report->sawah_luas * $report->sawah_harga * 0.3) +
                    ($report->sawah_rr * $report->sawah_luas * $report->sawah_harga * 0.1)
                , 0, ',', '.') }}</td>
            </tr>
            
            <!-- Irigasi -->
            <tr>
                <td>Irigasi</td>
                <td class="text-center">{{ $report->irigasi_rb }}</td>
                <td class="text-center">{{ $report->irigasi_rs }}</td>
                <td class="text-center">{{ $report->irigasi_rr }}</td>
                <td class="text-center">{{ $report->irigasi_luas }}</td>
                <td class="text-right">{{ number_format($report->irigasi_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(
                    ($report->irigasi_rb * $report->irigasi_luas * $report->irigasi_harga) +
                    ($report->irigasi_rs * $report->irigasi_luas * $report->irigasi_harga * 0.3) +
                    ($report->irigasi_rr * $report->irigasi_luas * $report->irigasi_harga * 0.1)
                , 0, ',', '.') }}</td>
            </tr>
            
            <!-- Gudang/Lumbung -->
            <tr>
                <td>Gudang/Lumbung</td>
                <td class="text-center">{{ $report->lumbung_rb }}</td>
                <td class="text-center">{{ $report->lumbung_rs }}</td>
                <td class="text-center">{{ $report->lumbung_rr }}</td>
                <td class="text-center">{{ $report->lumbung_luas }}</td>
                <td class="text-right">{{ number_format($report->lumbung_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(
                    ($report->lumbung_rb * $report->lumbung_luas * $report->lumbung_harga) +
                    ($report->lumbung_rs * $report->lumbung_luas * $report->lumbung_harga * 0.3) +
                    ($report->lumbung_rr * $report->lumbung_luas * $report->lumbung_harga * 0.1)
                , 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>B. Data Kerugian Hasil Pertanian</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Tanaman</th>
                <th class="text-center">Luas Terdampak (ha)</th>
                <th class="text-center">Hasil Per ha (ton)</th>
                <th class="text-center">Harga Per Ton (Rp)</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Padi</td>
                <td class="text-center">{{ $report->padi_luas }}</td>
                <td class="text-center">{{ $report->padi_hasil }}</td>
                <td class="text-right">{{ number_format($report->padi_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->padi_luas * $report->padi_hasil * $report->padi_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Jagung</td>
                <td class="text-center">{{ $report->jagung_luas }}</td>
                <td class="text-center">{{ $report->jagung_hasil }}</td>
                <td class="text-right">{{ number_format($report->jagung_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->jagung_luas * $report->jagung_hasil * $report->jagung_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Sayuran</td>
                <td class="text-center">{{ $report->sayuran_luas }}</td>
                <td class="text-center">{{ $report->sayuran_hasil }}</td>
                <td class="text-right">{{ number_format($report->sayuran_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->sayuran_luas * $report->sayuran_hasil * $report->sayuran_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Buah-buahan</td>
                <td class="text-center">{{ $report->buah_luas }}</td>
                <td class="text-center">{{ $report->buah_hasil }}</td>
                <td class="text-right">{{ number_format($report->buah_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->buah_luas * $report->buah_hasil * $report->buah_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Lainnya: {{ $report->lainnya_jenis }}</td>
                <td class="text-center">{{ $report->lainnya_luas }}</td>
                <td class="text-center">{{ $report->lainnya_hasil }}</td>
                <td class="text-right">{{ number_format($report->lainnya_harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->lainnya_luas * $report->lainnya_hasil * $report->lainnya_harga, 0, ',', '.') }}</td>
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
