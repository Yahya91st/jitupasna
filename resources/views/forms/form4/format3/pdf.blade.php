<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Kesehatan - {{ $report->nama_kampung }}</title>
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
        <h2>FORMAT 3: PENGUMPULAN DATA SEKTOR KESEHATAN</h2>
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

    <h3>A. Data Kerusakan Fasilitas Kesehatan</h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2" class="text-center">Jenis Fasilitas Kesehatan</th>
                <th colspan="3" class="text-center">Jumlah Kerusakan</th>
                <th rowspan="2" class="text-center">Ukuran Rata-rata (m²)</th>
                <th rowspan="2" class="text-center">Harga Bangunan<br>(Rp/m²)</th>
                <th rowspan="2" class="text-center">Harga Peralatan<br>(Rp/unit)</th>
                <th rowspan="2" class="text-center">Harga Obat-obatan<br>(Rp/unit)</th>
            </tr>
            <tr>
                <th class="text-center">Rusak Berat</th>
                <th class="text-center">Rusak Sedang</th>
                <th class="text-center">Rusak Ringan</th>
            </tr>
        </thead>
        <tbody>
            <!-- Rumah Sakit -->
            <tr>
                <td>Rumah Sakit</td>
                <td class="text-center">{{ $report->rs_rb }}</td>
                <td class="text-center">{{ $report->rs_rs }}</td>
                <td class="text-center">{{ $report->rs_rr }}</td>
                <td class="text-center">{{ $report->rs_ukuran }}</td>
                <td class="text-right">{{ number_format($report->rs_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ $report->rs_harga_peralatan }}</td>
                <td class="text-right">{{ $report->rs_harga_obat }}</td>
            </tr>
            
            <!-- Puskesmas -->
            <tr>
                <td>Puskesmas</td>
                <td class="text-center">{{ $report->puskesmas_rb }}</td>
                <td class="text-center">{{ $report->puskesmas_rs }}</td>
                <td class="text-center">{{ $report->puskesmas_rr }}</td>
                <td class="text-center">{{ $report->puskesmas_ukuran }}</td>
                <td class="text-right">{{ number_format($report->puskesmas_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ $report->puskesmas_harga_peralatan }}</td>
                <td class="text-right">{{ $report->puskesmas_harga_obat }}</td>
            </tr>
            
            <!-- Pustu -->
            <tr>
                <td>Puskesmas Pembantu (Pustu)</td>
                <td class="text-center">{{ $report->pustu_rb }}</td>
                <td class="text-center">{{ $report->pustu_rs }}</td>
                <td class="text-center">{{ $report->pustu_rr }}</td>
                <td class="text-center">{{ $report->pustu_ukuran }}</td>
                <td class="text-right">{{ number_format($report->pustu_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ $report->pustu_harga_peralatan }}</td>
                <td class="text-right">{{ $report->pustu_harga_obat }}</td>
            </tr>
            
            <!-- Polindes -->
            <tr>
                <td>Polindes/Poskesdes</td>
                <td class="text-center">{{ $report->polindes_rb }}</td>
                <td class="text-center">{{ $report->polindes_rs }}</td>
                <td class="text-center">{{ $report->polindes_rr }}</td>
                <td class="text-center">{{ $report->polindes_ukuran }}</td>
                <td class="text-right">{{ number_format($report->polindes_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ $report->polindes_harga_peralatan }}</td>
                <td class="text-right">{{ $report->polindes_harga_obat }}</td>
            </tr>
            
            <!-- Posyandu -->
            <tr>
                <td>Posyandu</td>
                <td class="text-center">{{ $report->posyandu_rb }}</td>
                <td class="text-center">{{ $report->posyandu_rs }}</td>
                <td class="text-center">{{ $report->posyandu_rr }}</td>
                <td class="text-center">{{ $report->posyandu_ukuran }}</td>
                <td class="text-right">{{ number_format($report->posyandu_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ $report->posyandu_harga_peralatan }}</td>
                <td class="text-right">{{ $report->posyandu_harga_obat }}</td>
            </tr>
            
            <!-- Apotek/Toko Obat -->
            <tr>
                <td>Apotek/Toko Obat</td>
                <td class="text-center">{{ $report->apotek_rb }}</td>
                <td class="text-center">{{ $report->apotek_rs }}</td>
                <td class="text-center">{{ $report->apotek_rr }}</td>
                <td class="text-center">{{ $report->apotek_ukuran }}</td>
                <td class="text-right">{{ number_format($report->apotek_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ $report->apotek_harga_peralatan }}</td>
                <td class="text-right">{{ $report->apotek_harga_obat }}</td>
            </tr>
        </tbody>
    </table>

    <h3>B. Data Kerugian Sektor Kesehatan</h3>
    <table>
        <tr>
            <th class="text-center">Jumlah Pasien Rawat Inap (orang)</th>
            <td class="text-center">{{ $report->pasien_rawat_inap }}</td>
            <th class="text-center">Biaya Per Hari (Rp)</th>
            <td class="text-center">{{ number_format($report->biaya_pasien_per_hari, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th class="text-center">Jumlah Hari</th>
            <td class="text-center">{{ $report->jumlah_hari }}</td>
            <th class="text-center">Biaya Obat & Perawatan Per Orang (Rp)</th>
            <td class="text-center">{{ number_format($report->biaya_obat_per_orang, 0, ',', '.') }}</td>
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
