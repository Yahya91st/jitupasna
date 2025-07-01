<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Pendidikan - {{ $report->nama_kampung }}</title>
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
        <h2>FORMAT 2: PENGUMPULAN DATA SEKTOR PENDIDIKAN</h2>
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

    <h3>A. Data Kerusakan Bangunan Pendidikan</h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2" class="text-center">Jenis Fasilitas Pendidikan</th>
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
            <!-- TK/PAUD -->
            <tr>
                <td>TK/PAUD</td>
                <td class="text-center">Negeri: {{ $report->tk_berat_negeri }}<br>Swasta: {{ $report->tk_berat_swasta }}</td>
                <td class="text-center">Negeri: {{ $report->tk_sedang_negeri }}<br>Swasta: {{ $report->tk_sedang_swasta }}</td>
                <td class="text-center">Negeri: {{ $report->tk_ringan_negeri }}<br>Swasta: {{ $report->tk_ringan_swasta }}</td>
                <td class="text-center">{{ $report->tk_ukuran }}</td>
                <td class="text-right">{{ number_format($report->tk_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->tk_harga_peralatan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->tk_harga_meubelair, 0, ',', '.') }}</td>
            </tr>
            
            <!-- SD/MI -->
            <tr>
                <td>SD/MI</td>
                <td class="text-center">Negeri: {{ $report->sd_berat_negeri }}<br>Swasta: {{ $report->sd_berat_swasta }}</td>
                <td class="text-center">Negeri: {{ $report->sd_sedang_negeri }}<br>Swasta: {{ $report->sd_sedang_swasta }}</td>
                <td class="text-center">Negeri: {{ $report->sd_ringan_negeri }}<br>Swasta: {{ $report->sd_ringan_swasta }}</td>
                <td class="text-center">{{ $report->sd_ukuran }}</td>
                <td class="text-right">{{ number_format($report->sd_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->sd_harga_peralatan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->sd_harga_meubelair, 0, ',', '.') }}</td>
            </tr>
            
            <!-- SMP/MTs -->
            <tr>
                <td>SMP/MTs</td>
                <td class="text-center">Negeri: {{ $report->smp_berat_negeri }}<br>Swasta: {{ $report->smp_berat_swasta }}</td>
                <td class="text-center">Negeri: {{ $report->smp_sedang_negeri }}<br>Swasta: {{ $report->smp_sedang_swasta }}</td>
                <td class="text-center">Negeri: {{ $report->smp_ringan_negeri }}<br>Swasta: {{ $report->smp_ringan_swasta }}</td>
                <td class="text-center">{{ $report->smp_ukuran }}</td>
                <td class="text-right">{{ number_format($report->smp_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->smp_harga_peralatan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->smp_harga_meubelair, 0, ',', '.') }}</td>
            </tr>
            
            <!-- SMA/SMK/MA -->
            <tr>
                <td>SMA/MA</td>
                <td class="text-center">Negeri: {{ $report->sma_berat_negeri }}<br>Swasta: {{ $report->sma_berat_swasta }}</td>
                <td class="text-center">Negeri: {{ $report->sma_sedang_negeri }}<br>Swasta: {{ $report->sma_sedang_swasta }}</td>
                <td class="text-center">Negeri: {{ $report->sma_ringan_negeri }}<br>Swasta: {{ $report->sma_ringan_swasta }}</td>
                <td class="text-center">{{ $report->sma_ukuran }}</td>
                <td class="text-right">{{ number_format($report->sma_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->sma_harga_peralatan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->sma_harga_meubelair, 0, ',', '.') }}</td>
            </tr>
            
            <tr>
                <td>SMK</td>
                <td class="text-center">Negeri: {{ $report->smk_berat_negeri }}<br>Swasta: {{ $report->smk_berat_swasta }}</td>
                <td class="text-center">Negeri: {{ $report->smk_sedang_negeri }}<br>Swasta: {{ $report->smk_sedang_swasta }}</td>
                <td class="text-center">Negeri: {{ $report->smk_ringan_negeri }}<br>Swasta: {{ $report->smk_ringan_swasta }}</td>
                <td class="text-center">{{ $report->smk_ukuran }}</td>
                <td class="text-right">{{ number_format($report->smk_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->smk_harga_peralatan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->smk_harga_meubelair, 0, ',', '.') }}</td>
            </tr>
            
            <tr>
                <td>Universitas/Akademi</td>
                <td class="text-center">Negeri: {{ $report->universitas_berat_negeri }}<br>Swasta: {{ $report->universitas_berat_swasta }}</td>
                <td class="text-center">Negeri: {{ $report->universitas_sedang_negeri }}<br>Swasta: {{ $report->universitas_sedang_swasta }}</td>
                <td class="text-center">Negeri: {{ $report->universitas_ringan_negeri }}<br>Swasta: {{ $report->universitas_ringan_swasta }}</td>
                <td class="text-center">{{ $report->universitas_ukuran }}</td>
                <td class="text-right">{{ number_format($report->universitas_harga_bangunan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->universitas_harga_peralatan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->universitas_harga_meubelair, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>B. Data Kerugian Sektor Pendidikan</h3>
    <table>
        <tr>
            <th class="text-center">Biaya Bersih Sekolah (Hari)</th>
            <td class="text-center">{{ $report->biaya_bersih_sekolah_hari }}</td>
            <th class="text-center">Biaya Per Hari (Rp)</th>
            <td class="text-center">{{ number_format($report->biaya_per_hari, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th class="text-center">Biaya Sewa Gedung (Bulan)</th>
            <td class="text-center">{{ $report->biaya_sewa_gedung_bulan }}</td>
            <th class="text-center">Biaya Per Bulan (Rp)</th>
            <td class="text-center">{{ number_format($report->biaya_sewa_per_bulan, 0, ',', '.') }}</td>
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
