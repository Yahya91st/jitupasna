<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 8 - Analisis Komprehensif Kerusakan dan Kerugian</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 0.8cm;
        }

        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.2;
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 9pt;
        }

        .container {
            width: 100%;
            max-width: 100%;
            margin: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            padding-bottom: 6px;
            border-bottom: 2px solid #333;
        }

        .header h2 {
            margin: 0.2rem 0;
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #333;
        }

        .header h3 {
            margin: 0.2rem 0;
            font-size: 9pt;
            font-weight: bold;
            color: #333;
        }

        .intro-text {
            text-align: justify;
            font-size: 8pt;
            line-height: 1.3;
            margin-bottom: 8px;
            padding: 6px 8px;
            background-color: #f9f9f9;
            border-left: 3px solid #333;
            border-radius: 3px;
        }

        .intro-label {
            font-weight: 600;
            font-size: 8pt;
            margin-bottom: 2px;
            display: block;
            color: #333;
        }

        /* Table Styles */
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            page-break-inside: avoid;
            table-layout: fixed;
            overflow-wrap: break-word;
        }

        .summary-table th, 
        .summary-table td {
            padding: 4px 4px;
            text-align: center;
            font-size: 7.5pt;
            vertical-align: middle;
            border: 1px solid #e6e6e6;
            line-height: 1.1;
            overflow: hidden;
        }

        .summary-table th {
            background-color: #f9f9f9;
            font-weight: bold;
            color: #333;
            font-size: 6pt;
            text-transform: uppercase;
        }

        .sektor-cell {
            text-align: left;
            width: 16%;
            padding-left: 6px;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .komponen-cell {
            text-align: left;
            width: 18%;
            padding-left: 6px;
            overflow-wrap: break-word;
        }

        .lokasi-cell {
            width: 10%;
            font-size: 6pt;
        }

        .data-cell {
            width: 5%;
            font-family: 'Courier New', monospace;
            font-size: 7pt;
        }

        .currency-cell {
            width: 9%;
            text-align: right;
            font-family: 'Courier New', monospace;
            font-size: 7pt;
            padding-right: 6px;
        }

        .total-row {
            background-color: #f5f5f5;
            font-weight: bold;
            border-top: 2px solid #333;
        }

        .total-row td {
            font-weight: bold;
            font-size: 7pt;
        }

        /* Sector Analysis Styles */
        .sector-analysis {
            margin-bottom: 15px;
            page-break-inside: avoid;
            padding-bottom: 6px;
        }

        .sector-title {
            background-color: #333;
            color: white;
            padding: 6px 8px;
            font-weight: bold;
            font-size: 9pt;
            text-transform: uppercase;
            margin-bottom: 8px;
            border-radius: 3px;
        }

        .analysis-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 8px;
        }

        .analysis-card {
            border: 1px solid #ddd;
            border-radius: 3px;
            overflow: hidden;
        }

        .card-header {
            background-color: #f5f5f5;
            padding: 4px 6px;
            font-weight: bold;
            font-size: 8pt;
            text-transform: uppercase;
            color: #333;
        }

        .card-content {
            padding: 6px;
            background-color: #fff;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
            font-size: 7pt;
        }

        .stat-label {
            color: #666;
        }

        .stat-value {
            font-weight: bold;
            color: #333;
            font-family: 'Courier New', monospace;
        }

        .sector-summary {
            background-color: #f0f9ff;
            padding: 6px 8px;
            border: 1px solid #333;
            border-radius: 3px;
            margin-top: 6px;
        }

        .sector-summary-title {
            font-weight: bold;
            font-size: 8pt;
            margin-bottom: 4px;
            text-transform: uppercase;
            color: #333;
        }

        .sector-summary-content {
            font-size: 7pt;
            line-height: 1.2;
        }

        /* Final Summary */
        .final-summary {
            background-color: #333;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
        }

        .final-summary-title {
            font-weight: bold;
            font-size: 10pt;
            text-align: center;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .final-summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .final-summary-item {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 6px;
            border-radius: 3px;
        }

        .final-summary-label {
            font-size: 7pt;
            margin-bottom: 2px;
            color: #ccc;
        }

        .final-summary-value {
            font-size: 9pt;
            font-weight: bold;
            font-family: 'Courier New', monospace;
        }

        .footer {
            margin-top: 15px;
            text-align: center;
            font-size: 7pt;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }

        .signature-area {
            margin-top: 15px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .signature-box {
            text-align: center;
        }

        .signature-line {
            border-bottom: 1px solid #333;
            margin-top: 30px;
            margin-bottom: 3px;
        }

        .signature-title {
            font-size: 8pt;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .signature-name {
            font-size: 7pt;
            color: #666;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            color: #666;
            margin: 20px 0;
            font-size: 12pt;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>FORMULIR ANALISIS KERUSAKAN DAN KERUGIAN PASCABENCANA</h2>
            <h3>ANALISIS KOMPREHENSIF - GABUNGAN TABEL & DETAIL</h3>
        </div>

        <!-- Intro Text -->
        <div class="intro-text">
            <span class="intro-label">Deskripsi Format:</span>
            Format komprehensif menggabungkan tabel ringkas dengan analisis detail per sektor. Memberikan gambaran menyeluruh kerusakan dan kerugian dengan breakdown lengkap untuk mendukung pengambilan keputusan strategis dan perencanaan pemulihan pascabencana.
        </div>

        @if($allRows->count() > 0)
            <!-- Summary Table -->
            <table class="summary-table">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 3%;">No</th>
                        <th rowspan="2" class="sektor-cell">Sektor</th>
                        <th rowspan="2" class="komponen-cell">Komponen</th>
                        <th rowspan="2" class="lokasi-cell">Lokasi</th>
                        <th colspan="3" style="width: 15%;">Data Kerusakan</th>
                        <th colspan="3" style="width: 24%;">Nilai Kerusakan (Rp)</th>
                        <th rowspan="2" class="currency-cell">Kerugian</th>
                        <th rowspan="2" class="currency-cell">Total</th>
                        <th rowspan="2" class="currency-cell">Kebutuhan</th>
                    </tr>
                    <tr>
                        <th class="data-cell">RB</th>
                        <th class="data-cell">RS</th>
                        <th class="data-cell">RR</th>
                        <th class="currency-cell">RB</th>
                        <th class="currency-cell">RS</th>
                        <th class="currency-cell">RR</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($allRows as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td class="sektor-cell">{{ $row->sektor_sub_sektor ?? '-' }}</td>
                        <td class="komponen-cell">{{ $row->komponen_kerusakan ?? '-' }}</td>
                        <td class="lokasi-cell">{{ $row->lokasi ?? '-' }}</td>
                        <td class="data-cell">{{ number_format($row->data_kerusakan_rb ?? 0, 0, ',', '.') }}</td>
                        <td class="data-cell">{{ number_format($row->data_kerusakan_rs ?? 0, 0, ',', '.') }}</td>
                        <td class="data-cell">{{ number_format($row->data_kerusakan_rr ?? 0, 0, ',', '.') }}</td>
                        <td class="currency-cell">{{ number_format($row->nilai_kerusakan_rb ?? 0, 0, ',', '.') }}</td>
                        <td class="currency-cell">{{ number_format($row->nilai_kerusakan_rs ?? 0, 0, ',', '.') }}</td>
                        <td class="currency-cell">{{ number_format($row->nilai_kerusakan_rr ?? 0, 0, ',', '.') }}</td>
                        <td class="currency-cell">{{ number_format($row->perkiraan_kerugian ?? 0, 0, ',', '.') }}</td>
                        <td class="currency-cell">{{ number_format($row->jumlah_kerusakan_kerugian ?? 0, 0, ',', '.') }}</td>
                        <td class="currency-cell">{{ number_format($row->kebutuhan ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach

                    <!-- Total Row -->
                    <tr class="total-row">
                        <td colspan="4"><strong>TOTAL KESELURUHAN</strong></td>
                        <td class="data-cell"><strong>{{ number_format($totalRB ?? 0, 0, ',', '.') }}</strong></td>
                        <td class="data-cell"><strong>{{ number_format($totalRS ?? 0, 0, ',', '.') }}</strong></td>
                        <td class="data-cell"><strong>{{ number_format($totalRR ?? 0, 0, ',', '.') }}</strong></td>
                        <td class="currency-cell"><strong>{{ number_format($totalNilaiKerusakan ?? 0, 0, ',', '.') }}</strong></td>
                        <td class="currency-cell"><strong>-</strong></td>
                        <td class="currency-cell"><strong>-</strong></td>
                        <td class="currency-cell"><strong>{{ number_format($totalKerugian ?? 0, 0, ',', '.') }}</strong></td>
                        <td class="currency-cell"><strong>{{ number_format($totalKeruskanKerugian ?? 0, 0, ',', '.') }}</strong></td>
                        <td class="currency-cell"><strong>{{ number_format($totalKebutuhan ?? 0, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>

            <!-- Detailed Analysis per Sector -->
            <div class="page-break"></div>
            <h3 style="text-align: center; margin-bottom: 10px; font-size: 10pt;">ANALISIS DETAIL PER SEKTOR</h3>

            @foreach($groupedBySector as $sektor => $rows)
            <div class="sector-analysis">
                <div class="sector-title">{{ $sektor ?? 'Sektor Tidak Diketahui' }}</div>
                
                    <div class="analysis-grid">
                    <div class="analysis-card">
                        <div class="card-header">Data Kerusakan</div>
                        <div class="card-content">
                            <div class="stat-item">
                                <span class="stat-label">Rusak Berat:</span>
                                <span class="stat-value">{{ number_format($rows->sum('data_kerusakan_rb'), 0, ',', '.') }} unit</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Rusak Sedang:</span>
                                <span class="stat-value">{{ number_format($rows->sum('data_kerusakan_rs'), 0, ',', '.') }} unit</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Rusak Ringan:</span>
                                <span class="stat-value">{{ number_format($rows->sum('data_kerusakan_rr'), 0, ',', '.') }} unit</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Total Unit:</span>
                                <span class="stat-value">{{ number_format($rows->sum('data_kerusakan_rb') + $rows->sum('data_kerusakan_rs') + $rows->sum('data_kerusakan_rr'), 0, ',', '.') }} unit</span>
                            </div>
                        </div>
                    </div>

                    <div class="analysis-card">
                        <div class="card-header">Nilai Finansial</div>
                        <div class="card-content">
                            <div class="stat-item">
                                <span class="stat-label">Nilai Kerusakan:</span>
                                <span class="stat-value">Rp {{ number_format($rows->sum('nilai_kerusakan_rb') + $rows->sum('nilai_kerusakan_rs') + $rows->sum('nilai_kerusakan_rr'), 0, ',', '.') }}</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Perkiraan Kerugian:</span>
                                <span class="stat-value">Rp {{ number_format($rows->sum('perkiraan_kerugian'), 0, ',', '.') }}</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Total Kerusakan & Kerugian:</span>
                                <span class="stat-value">Rp {{ number_format($rows->sum('jumlah_kerusakan_kerugian'), 0, ',', '.') }}</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-label">Kebutuhan Pemulihan:</span>
                                <span class="stat-value">Rp {{ number_format($rows->sum('kebutuhan'), 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sector-summary">
                    <div class="sector-summary-title">Ringkasan Sektor {{ $sektor }}</div>
                    <div class="sector-summary-content">
                        Sektor {{ $sektor }} mengalami kerusakan pada {{ $rows->count() }} komponen dengan total unit terdampak sebanyak {{ number_format($rows->sum('data_kerusakan_rb') + $rows->sum('data_kerusakan_rs') + $rows->sum('data_kerusakan_rr'), 0, ',', '.') }} unit. 
                        Total nilai kerusakan mencapai Rp {{ number_format($rows->sum('nilai_kerusakan_rb') + $rows->sum('nilai_kerusakan_rs') + $rows->sum('nilai_kerusakan_rr'), 0, ',', '.') }} dengan perkiraan kerugian Rp {{ number_format($rows->sum('perkiraan_kerugian'), 0, ',', '.') }}. 
                        Kebutuhan pemulihan diperkirakan mencapai Rp {{ number_format($rows->sum('kebutuhan'), 0, ',', '.') }} untuk mengembalikan kondisi sektor ini ke keadaan semula.
                    </div>
                </div>
            </div>
            @endforeach

        @else
            <div class="no-data">
                Tidak ada data kerusakan dan kerugian yang tersedia untuk analisis
            </div>
        @endif

        <!-- Final Summary -->
        <div class="final-summary">
            <div class="final-summary-title">REKAPITULASI AKHIR</div>
            <div class="final-summary-grid">
                <div class="final-summary-item">
                    <div class="final-summary-label">Total Kerusakan Fisik</div>
                    <div class="final-summary-value">{{ number_format(($totalRB ?? 0) + ($totalRS ?? 0) + ($totalRR ?? 0), 0, ',', '.') }} Unit</div>
                </div>
                <div class="final-summary-item">
                    <div class="final-summary-label">Total Nilai Kerusakan & Kerugian</div>
                    <div class="final-summary-value">Rp {{ number_format($totalKeruskanKerugian ?? 0, 0, ',', '.') }}</div>
                </div>
                <div class="final-summary-item">
                    <div class="final-summary-label">Total Kebutuhan Pemulihan</div>
                    <div class="final-summary-value">Rp {{ number_format($totalKebutuhan ?? 0, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        <!-- Signature Area -->
        <div class="signature-area">
            <div class="signature-box">
                <div class="signature-title">Koordinator Analisis</div>
                <div class="signature-line"></div>
                <div class="signature-name">Nama & Tanda Tangan</div>
            </div>
            <div class="signature-box">
                <div class="signature-title">Kepala Daerah</div>
                <div class="signature-line"></div>
                <div class="signature-name">Nama & Tanda Tangan</div>
            </div>
            <div class="signature-box">
                <div class="signature-title">BNPB Pusat</div>
                <div class="signature-line"></div>
                <div class="signature-name">Nama & Tanda Tangan</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div>Formulir ini dibuat sesuai dengan Peraturan Kepala BNPB tentang Pedoman Umum Pengkajian Risiko Bencana</div>
            <div>Dokumen ini merupakan hasil analisis resmi kerusakan dan kerugian pascabencana</div>
        </div>
    </div>
</body>
</html>