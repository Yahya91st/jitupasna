<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Format 17 - Sektor Lingkungan Hidup</title>
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
        th, td {
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #e0e0e0;
            font-weight: bold;
            text-align: center;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 15px;
            background-color: #d0d0d0;
            padding: 8px;
            border: 1px solid #333;
            text-transform: uppercase;
        }
        .subsection-title {
            font-size: 13px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 10px;
            background-color: #f0f0f0;
            padding: 5px;
            border-left: 4px solid #333;
        }
        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        .currency {
            text-align: right;
        }
        .number {
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            page-break-inside: avoid;
        }
        .signature {
            margin-top: 30px;
            float: right;
            width: 40%;
            text-align: center;
        }
        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #000;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        .page-break {
            page-break-after: always;
        }
        .summary-box {
            border: 2px solid #333;
            padding: 10px;
            margin: 15px 0;
            background-color: #f8f8f8;
        }
        .summary-title {
            font-weight: bold;
            font-size: 13px;
            text-align: center;
            margin-bottom: 10px;
        }
        .no-data {
            text-align: center;
            font-style: italic;
            color: #666;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN KERUSAKAN DAN KERUGIAN SEKTOR LINGKUNGAN HIDUP</h1>
        <h2>FORMAT 17</h2>
        <p>Tanggal Laporan: {{ $tanggal }}</p>
    </div>

    <div class="bencana-info">
        <p><strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama }}</p>
        <p><strong>Tanggal Kejadian:</strong> {{ $bencana->tanggal }}</p>
        <p><strong>Lokasi:</strong> 
            @foreach($bencana->desa as $desa)
                {{ $desa->nama }}@if(!$loop->last), @endif
            @endforeach
        </p>
    </div>

    <!-- I. PERKIRAAN KERUSAKAN LINGKUNGAN HIDUP -->
    <div class="section-title">I. PERKIRAAN KERUSAKAN LINGKUNGAN HIDUP</div>
    
    @if($damageReports->count() > 0)
        @foreach($damageReports as $ekosistem => $reports)
            <div class="subsection-title">
                {{ ucfirst($ekosistem) }} Ecosystem
            </div>
            <table>
                <thead>
                    <tr>
                        <th width="20%">Jenis Kerusakan</th>
                        <th width="10%">Rusak Berat (RB)</th>
                        <th width="10%">Rusak Sedang (RS)</th>
                        <th width="10%">Rusak Ringan (RR)</th>
                        <th width="15%">Harga Satuan RB</th>
                        <th width="15%">Harga Satuan RS</th>
                        <th width="15%">Harga Satuan RR</th>
                        <th width="15%">Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalEkosistem = 0; @endphp
                    @foreach($reports as $report)
                        @php 
                            $totalItem = ($report->rb * $report->harga_rb) + ($report->rs * $report->harga_rs) + ($report->rr * $report->harga_rr);
                            $totalEkosistem += $totalItem;
                        @endphp
                        <tr>
                            <td>{{ $report->jenis_kerusakan }}</td>
                            <td class="number">{{ number_format($report->rb, 0, ',', '.') }}</td>
                            <td class="number">{{ number_format($report->rs, 0, ',', '.') }}</td>
                            <td class="number">{{ number_format($report->rr, 0, ',', '.') }}</td>
                            <td class="currency">Rp {{ number_format($report->harga_rb, 0, ',', '.') }}</td>
                            <td class="currency">Rp {{ number_format($report->harga_rs, 0, ',', '.') }}</td>
                            <td class="currency">Rp {{ number_format($report->harga_rr, 0, ',', '.') }}</td>
                            <td class="currency"><strong>Rp {{ number_format($totalItem, 0, ',', '.') }}</strong></td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="7"><strong>TOTAL {{ strtoupper($ekosistem) }}</strong></td>
                        <td class="currency"><strong>Rp {{ number_format($totalEkosistem, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
        @endforeach
        
        @php
            $totalKerusakan = 0;
            foreach($damageReports as $reports) {
                foreach($reports as $report) {
                    $totalKerusakan += ($report->rb * $report->harga_rb) + ($report->rs * $report->harga_rs) + ($report->rr * $report->harga_rr);
                }
            }
        @endphp
        
        <div class="summary-box">
            <div class="summary-title">TOTAL KERUSAKAN LINGKUNGAN HIDUP</div>
            <table>
                <tr class="total-row">
                    <td width="80%"><strong>GRAND TOTAL KERUSAKAN</strong></td>
                    <td width="20%" class="currency"><strong>Rp {{ number_format($totalKerusakan, 0, ',', '.') }}</strong></td>
                </tr>
            </table>
        </div>
    @else
        <div class="no-data">
            Belum ada data kerusakan lingkungan hidup yang tercatat untuk bencana ini.
        </div>
    @endif

    <!-- Halaman baru untuk kerugian -->
    <div class="page-break"></div>

    <!-- II. PERKIRAAN KERUGIAN LINGKUNGAN HIDUP -->
    <div class="section-title">II. PERKIRAAN KERUGIAN LINGKUNGAN HIDUP</div>
    
    @if($lossReports->count() > 0)
        @foreach($lossReports as $jenisKerugian => $reports)
            <div class="subsection-title">
                @switch($jenisKerugian)
                    @case('kehilangan_jasa_lingkungan')
                        Kehilangan Jasa Lingkungan
                        @break
                    @case('pencemaran_air')
                        Biaya Akibat Pencemaran Air
                        @break
                    @case('pencemaran_udara')
                        Biaya Akibat Pencemaran Udara
                        @break
                    @default
                        {{ ucfirst(str_replace('_', ' ', $jenisKerugian)) }}
                @endswitch
            </div>
            <table>
                <thead>
                    <tr>
                        <th width="20%">Jenis</th>
                        <th width="20%">Dasar Perhitungan</th>
                        <th width="8%">RB</th>
                        <th width="8%">RS</th>
                        <th width="8%">RR</th>
                        <th width="12%">Harga RB</th>
                        <th width="12%">Harga RS</th>
                        <th width="12%">Harga RR</th>
                        <th width="15%">Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalKategori = 0; @endphp
                    @foreach($reports as $report)
                        @php 
                            $totalItem = ($report->rb * $report->harga_rb) + ($report->rs * $report->harga_rs) + ($report->rr * $report->harga_rr);
                            $totalKategori += $totalItem;
                        @endphp
                        <tr>
                            <td>{{ $report->jenis }}</td>
                            <td>{{ $report->dasar_perhitungan }}</td>
                            <td class="number">{{ number_format($report->rb, 0, ',', '.') }}</td>
                            <td class="number">{{ number_format($report->rs, 0, ',', '.') }}</td>
                            <td class="number">{{ number_format($report->rr, 0, ',', '.') }}</td>
                            <td class="currency">Rp {{ number_format($report->harga_rb, 0, ',', '.') }}</td>
                            <td class="currency">Rp {{ number_format($report->harga_rs, 0, ',', '.') }}</td>
                            <td class="currency">Rp {{ number_format($report->harga_rr, 0, ',', '.') }}</td>
                            <td class="currency"><strong>Rp {{ number_format($totalItem, 0, ',', '.') }}</strong></td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="8"><strong>TOTAL 
                            @switch($jenisKerugian)
                                @case('kehilangan_jasa_lingkungan')
                                    JASA LINGKUNGAN
                                    @break
                                @case('pencemaran_air')
                                    PENCEMARAN AIR
                                    @break
                                @case('pencemaran_udara')
                                    PENCEMARAN UDARA
                                    @break
                                @default
                                    {{ strtoupper(str_replace('_', ' ', $jenisKerugian)) }}
                            @endswitch
                        </strong></td>
                        <td class="currency"><strong>Rp {{ number_format($totalKategori, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
        @endforeach
        
        @php
            $totalKerugian = 0;
            foreach($lossReports as $reports) {
                foreach($reports as $report) {
                    $totalKerugian += ($report->rb * $report->harga_rb) + ($report->rs * $report->harga_rs) + ($report->rr * $report->harga_rr);
                }
            }
        @endphp
        
        <div class="summary-box">
            <div class="summary-title">TOTAL KERUGIAN LINGKUNGAN HIDUP</div>
            <table>
                <tr class="total-row">
                    <td width="80%"><strong>GRAND TOTAL KERUGIAN</strong></td>
                    <td width="20%" class="currency"><strong>Rp {{ number_format($totalKerugian, 0, ',', '.') }}</strong></td>
                </tr>
            </table>
        </div>
    @else
        <div class="no-data">
            Belum ada data kerugian lingkungan hidup yang tercatat untuk bencana ini.
        </div>
    @endif

    <!-- RINGKASAN KESELURUHAN -->
    @if($damageReports->count() > 0 || $lossReports->count() > 0)
        @php
            $grandTotal = $totalKerusakan + $totalKerugian;
        @endphp
        
        <div class="summary-box" style="border: 3px solid #000; background-color: #e0e0e0;">
            <div class="summary-title" style="font-size: 14px;">RINGKASAN TOTAL KERUSAKAN DAN KERUGIAN LINGKUNGAN HIDUP</div>
            <table style="border: 2px solid #000;">
                <tr>
                    <td width="60%"><strong>Total Kerusakan Lingkungan Hidup</strong></td>
                    <td width="40%" class="currency"><strong>Rp {{ number_format($totalKerusakan ?? 0, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td><strong>Total Kerugian Lingkungan Hidup</strong></td>
                    <td class="currency"><strong>Rp {{ number_format($totalKerugian ?? 0, 0, ',', '.') }}</strong></td>
                </tr>
                <tr class="total-row" style="font-size: 13px; background-color: #d0d0d0;">
                    <td><strong>GRAND TOTAL KESELURUHAN</strong></td>
                    <td class="currency"><strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
                </tr>
            </table>
        </div>
    @endif

    <div class="footer">
        <div class="signature">
            <p>{{ $bencana->desa->first()->nama ?? 'Lokasi Bencana' }}, {{ $tanggal }}</p>
            <p>Petugas Pelapor</p>
            <div class="signature-line"></div>
            <p>(_________________________)</p>
            <p>NIP/NIK:</p>
        </div>
    </div>
</body>
</html>
