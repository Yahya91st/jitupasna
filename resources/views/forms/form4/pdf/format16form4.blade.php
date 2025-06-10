<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Format 16 - Sektor Pemerintahan</title>
    <style>
        @page {
            size: landscape;
            margin: 20mm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .header h2 {
            font-size: 14px;
            margin-bottom: 5px;
        }
        .bencana-info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .bencana-info p {
            margin: 3px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 11px;
        }
        table, th, td { 
            border: 1px solid #333;
        }
        th {
            background-color: #f0f0f0;
            padding: 6px;
            font-weight: bold;
            text-align: center;
        }
        td {
            padding: 6px;
            vertical-align: top;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin: 20px 0 10px 0;
            padding: 5px;
            background-color: #f0f0f0;
            border-radius: 3px;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .total-row {
            font-weight: bold;
            background-color: #e6e6e6;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FORMAT 16 - SEKTOR PEMERINTAHAN</h1>
        <h2>FORMULIR PERKIRAAN KERUSAKAN DAN KERUGIAN FASILITAS PEMERINTAHAN</h2>
        <h2>AKIBAT BENCANA</h2>
    </div>
    
    <div class="bencana-info">
        <p><strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama }}</p>
        <p><strong>Tanggal:</strong> {{ $bencana->tanggal }}</p>
        <p><strong>Lokasi:</strong> 
            @foreach($bencana->desa as $desa)
                {{ $desa->nama }}@if(!$loop->last), @endif
            @endforeach
        </p>
        <p><strong>Tanggal Laporan:</strong> {{ $tanggal }}</p>
    </div>
    
    @if($damageReports->count() > 0)
    <div class="section-title">I. PERKIRAAN KERUSAKAN FASILITAS PEMERINTAHAN</div>
    <table>
        <thead>
            <tr>
                <th rowspan="2" style="width: 5%">No</th>
                <th rowspan="2" style="width: 25%">Jenis Fasilitas</th>
                <th colspan="3">Jumlah Kerusakan</th>
                <th colspan="3">Harga Satuan (Rp)</th>
                <th rowspan="2" style="width: 15%">Total Biaya (Rp)</th>
            </tr>
            <tr>
                <th>RB</th>
                <th>RS</th>
                <th>RR</th>
                <th>RB</th>
                <th>RS</th>
                <th>RR</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $no = 1;
                $totalRb = 0;
                $totalRs = 0;
                $totalRr = 0;
                $grandTotal = 0;
            @endphp
            @foreach($damageReports as $report)
            @php
                $damageTotal = ($report->jumlah_rb * $report->harga_rb) + 
                              ($report->jumlah_rs * $report->harga_rs) + 
                              ($report->jumlah_rr * $report->harga_rr);
                $totalRb += ($report->jumlah_rb * $report->harga_rb);
                $totalRs += ($report->jumlah_rs * $report->harga_rs);
                $totalRr += ($report->jumlah_rr * $report->harga_rr);
                $grandTotal += $damageTotal;
            @endphp
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ $report->jenis_fasilitas }}</td>
                <td class="text-center">{{ $report->jumlah_rb }}</td>
                <td class="text-center">{{ $report->jumlah_rs }}</td>
                <td class="text-center">{{ $report->jumlah_rr }}</td>
                <td class="text-right">{{ number_format($report->harga_rb, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->harga_rs, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($report->harga_rr, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($damageTotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td class="text-right" colspan="2">SUBTOTAL KERUSAKAN</td>
                <td class="text-right" colspan="3">{{ number_format($totalRb, 0, ',', '.') }}</td>
                <td class="text-right" colspan="3">{{ number_format($totalRs + $totalRr, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    @endif
    
    @if($lossReport)
    <div class="section-title">II. PERKIRAAN KERUGIAN SEKTOR PEMERINTAHAN</div>
    
    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 30%">Jenis Kerugian</th>
                <th style="width: 15%">Jumlah</th>
                <th style="width: 15%">Satuan</th>
                <th style="width: 15%">Biaya Satuan (Rp)</th>
                <th style="width: 20%">Total Biaya (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">1</td>
                <td>Pembersihan Puing-puing</td>
                <td class="text-center">{{ $lossReport->tenaga_kerja_hok ?? 0 }}</td>
                <td>HOK</td>
                <td class="text-right">{{ number_format($lossReport->upah_harian ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(($lossReport->tenaga_kerja_hok ?? 0) * ($lossReport->upah_harian ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td>Penggunaan Alat Berat</td>
                <td class="text-center">{{ $lossReport->alat_berat_hari ?? 0 }}</td>
                <td>Hari</td>
                <td class="text-right">{{ number_format($lossReport->biaya_per_hari_alat_berat ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(($lossReport->alat_berat_hari ?? 0) * ($lossReport->biaya_per_hari_alat_berat ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="text-center">3</td>
                <td>Sewa Gedung/Kantor Sementara</td>
                <td class="text-center">{{ $lossReport->jumlah_unit ?? 0 }}</td>
                <td>Unit</td>
                <td class="text-right">{{ number_format($lossReport->biaya_sewa_per_unit ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(($lossReport->jumlah_unit ?? 0) * ($lossReport->biaya_sewa_per_unit ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="text-center">4</td>
                <td>Pemulihan Dokumen/Arsip</td>
                <td class="text-center">{{ $lossReport->jumlah_arsip ?? 0 }}</td>
                <td>Item</td>
                <td class="text-right">{{ number_format($lossReport->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format(($lossReport->jumlah_arsip ?? 0) * ($lossReport->harga_satuan ?? 0), 0, ',', '.') }}</td>
            </tr>
            @php
                $totalLoss = 0;
                if ($lossReport) {
                    $totalLoss = ($lossReport->tenaga_kerja_hok ?? 0) * ($lossReport->upah_harian ?? 0) +
                                 ($lossReport->alat_berat_hari ?? 0) * ($lossReport->biaya_per_hari_alat_berat ?? 0) +
                                 ($lossReport->jumlah_unit ?? 0) * ($lossReport->biaya_sewa_per_unit ?? 0) +
                                 ($lossReport->jumlah_arsip ?? 0) * ($lossReport->harga_satuan ?? 0);
                }
            @endphp
            <tr class="total-row">
                <td class="text-right" colspan="5">SUBTOTAL KERUGIAN</td>
                <td class="text-right">{{ number_format($totalLoss, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    @endif
    
    <div class="section-title">III. REKAPITULASI KERUSAKAN DAN KERUGIAN</div>
    <table>
        <thead>
            <tr>
                <th style="width: 70%">Kategori</th>
                <th style="width: 30%">Total (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Kerusakan Fasilitas Pemerintahan</td>
                <td class="text-right">{{ number_format($totalDamageValue, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Kerugian Sektor Pemerintahan</td>
                <td class="text-right">{{ number_format($totalLossValue, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>TOTAL KERUSAKAN DAN KERUGIAN</td>
                <td class="text-right">{{ number_format($totalOverall, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    
    <div style="margin-top: 30px; text-align: right;">
        <p>{{ $tanggal }}</p>
        <p>Pelapor,</p>
        <br><br><br>
        <p>________________________</p>
        <p>Admin Pelapor</p>
    </div>
</body>
</html>
