<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lintas Sektor - {{ $report->nama_kampung }}</title>
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
        <h2>FORMAT 9: PENGUMPULAN DATA LINTAS SEKTOR</h2>
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

    <h3>Rekapitulasi Kerusakan dan Kerugian Lintas Sektor</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" rowspan="2">Sektor</th>
                <th class="text-center" colspan="2">Nilai Dampak (Rp)</th>
                <th class="text-center" rowspan="2">Total (Rp)</th>
            </tr>
            <tr>
                <th class="text-center">Kerusakan</th>
                <th class="text-center">Kerugian</th>
            </tr>
        </thead>
        <tbody>
            <!-- Perumahan -->
            <tr>
                <td>Perumahan</td>
                <td class="text-right">{{ number_format($report->perumahan_kerusakan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->perumahan_kerugian, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->perumahan_kerusakan + $report->perumahan_kerugian, 0, ',', '.') }}</td>
            </tr>
            
            <!-- Pendidikan -->
            <tr>
                <td>Pendidikan</td>
                <td class="text-right">{{ number_format($report->pendidikan_kerusakan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->pendidikan_kerugian, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->pendidikan_kerusakan + $report->pendidikan_kerugian, 0, ',', '.') }}</td>
            </tr>
            
            <!-- Kesehatan -->
            <tr>
                <td>Kesehatan</td>
                <td class="text-right">{{ number_format($report->kesehatan_kerusakan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->kesehatan_kerugian, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->kesehatan_kerusakan + $report->kesehatan_kerugian, 0, ',', '.') }}</td>
            </tr>
            
            <!-- Sosial -->
            <tr>
                <td>Sosial</td>
                <td class="text-right">{{ number_format($report->sosial_kerusakan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->sosial_kerugian, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->sosial_kerusakan + $report->sosial_kerugian, 0, ',', '.') }}</td>
            </tr>
            
            <!-- Ekonomi -->
            <tr>
                <td>Ekonomi</td>
                <td class="text-right">{{ number_format($report->ekonomi_kerusakan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->ekonomi_kerugian, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->ekonomi_kerusakan + $report->ekonomi_kerugian, 0, ',', '.') }}</td>
            </tr>
            
            <!-- Pertanian -->
            <tr>
                <td>Pertanian</td>
                <td class="text-right">{{ number_format($report->pertanian_kerusakan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->pertanian_kerugian, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->pertanian_kerusakan + $report->pertanian_kerugian, 0, ',', '.') }}</td>
            </tr>
            
            <!-- Transportasi -->
            <tr>
                <td>Transportasi</td>
                <td class="text-right">{{ number_format($report->transportasi_kerusakan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->transportasi_kerugian, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->transportasi_kerusakan + $report->transportasi_kerugian, 0, ',', '.') }}</td>
            </tr>
            
            <!-- Infrastruktur -->
            <tr>
                <td>Infrastruktur</td>
                <td class="text-right">{{ number_format($report->infrastruktur_kerusakan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->infrastruktur_kerugian, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->infrastruktur_kerusakan + $report->infrastruktur_kerugian, 0, ',', '.') }}</td>
            </tr>
            
            <!-- Pemerintahan -->
            <tr>
                <td>Pemerintahan</td>
                <td class="text-right">{{ number_format($report->pemerintahan_kerusakan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->pemerintahan_kerugian, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->pemerintahan_kerusakan + $report->pemerintahan_kerugian, 0, ',', '.') }}</td>
            </tr>
            
            <!-- Lingkungan -->
            <tr>
                <td>Lingkungan</td>
                <td class="text-right">{{ number_format($report->lingkungan_kerusakan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->lingkungan_kerugian, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->lingkungan_kerusakan + $report->lingkungan_kerugian, 0, ',', '.') }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td>TOTAL</td>
                <td class="text-right">{{ number_format($report->total_kerusakan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->total_kerugian, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->total_kerusakan + $report->total_kerugian, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
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
