<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 8 - Tabel Ringkas Kerusakan dan Kerugian</title>
    <style>
        @page {
            size: A4 landscape;
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
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 1px solid #ddd;
        }

        .header h2 {
            margin: 0.1rem 0;
            font-size: 10pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #333;
        }

        .header h3 {
            margin: 0.1rem 0;
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #333;
        }

        .intro-text {
            text-align: justify;
            font-size: 8pt;
            line-height: 1.2;
            margin-bottom: 6px;
            padding: 4px 6px;
            background-color: #f9f9f9;
            border-left: 2px solid #333;
            border-radius: 2px;
        }

        .intro-label {
            font-weight: 600;
            font-size: 8pt;
            margin-bottom: 1px;
            display: block;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
            border: 1px solid #333;
            page-break-inside: auto;
            table-layout: fixed; /* ensure consistent column widths */
            word-break: keep-all;
            overflow-wrap: break-word;
        }

        th, td {
            padding: 4px 4px;
            text-align: center;
            font-size: 7.5pt;
            vertical-align: middle;
            border: 1px solid #333;
            line-height: 1.1;
            overflow: hidden;
        }

        th {
            background-color: #f9f9f9;
            font-weight: bold;
            color: #333;
            font-size: 6pt;
            text-transform: uppercase;
        }

        .sektor-column {
            width: 14%;
            text-align: left;
            padding-left: 6px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .komponen-column {
            width: 18%;
            text-align: left;
            padding-left: 6px;
            overflow-wrap: break-word;
        }

        .lokasi-column {
            width: 10%;
            font-size: 7pt;
            padding-left: 6px;
        }

        .data-column {
            width: 5%;
            font-family: 'Courier New', monospace;
            font-size: 7pt;
        }

        .currency-column {
            width: 8%;
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

        .summary-box {
            margin-top: 8px;
            padding: 8px;
            border: 1px solid #333;
            background-color: #f9f9f9;
            border-radius: 3px;
            font-size: 7.5pt;
        }

        .summary-title {
            font-weight: bold;
            font-size: 8pt;
            text-align: center;
            margin-bottom: 4px;
            text-transform: uppercase;
            color: #333;
        }

        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 6pt;
            color: #666;
        }

        .signature-area {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
        }

        .signature-box {
            text-align: center;
            width: 30%;
        }

        .signature-line {
            border-bottom: 1px solid #333;
            margin-top: 40px;
            margin-bottom: 2px;
        }

        .no-border {
            border: none !important;
            padding: 0 !important;
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
            <h3>TABEL RINGKAS - REKAPITULASI KOMPREHENSIF</h3>
        </div>

        <!-- Intro Text -->
        <div class="intro-text">
            <span class="intro-label">Deskripsi Format:</span>
            Tabel ringkas ini menyajikan rekapitulasi komprehensif data kerusakan dan kerugian pascabencana dalam format landscape untuk memudahkan analisis cepat dan pengambilan keputusan strategis.
        </div>

        <!-- Main Table -->
        <table>
            <thead>
                <tr>
                    <th rowspan="2" style="width: 3%;">No</th>
                    <th rowspan="2" class="sektor-column">Sektor/Sub Sektor</th>
                    <th rowspan="2" class="komponen-column">Komponen Kerusakan</th>
                    <th rowspan="2" class="lokasi-column">Lokasi</th>
                    <th colspan="3" style="width: 12%;">Data Kerusakan</th>
                    <th colspan="3" style="width: 18%;">Nilai Kerusakan (Rp)</th>
                    <th rowspan="2" class="currency-column">Perkiraan Kerugian (Rp)</th>
                    <th rowspan="2" class="currency-column">Jumlah Kerusakan & Kerugian (Rp)</th>
                    <th rowspan="2" class="currency-column">Kebutuhan Pemulihan (Rp)</th>
                </tr>
                <tr>
                    <th class="currency-column">RB</th>
                    <th class="currency-column">RS</th>
                    <th class="currency-column">RR</th>
                    <th class="currency-column">RB</th>
                    <th class="currency-column">RS</th>
                    <th class="currency-column">RR</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @if($allRows->count() > 0)
                    @foreach($allRows as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td class="sektor-column">{{ $row->sektor_sub_sektor ?? '-' }}</td>
                        <td class="komponen-column">{{ $row->komponen_kerusakan ?? '-' }}</td>
                        <td class="lokasi-column">{{ $row->lokasi ?? '-' }}</td>
                        <td class="data-column">{{ number_format($row->data_kerusakan_rb ?? 0, 0, ',', '.') }}</td>
                        <td class="data-column">{{ number_format($row->data_kerusakan_rs ?? 0, 0, ',', '.') }}</td>
                        <td class="data-column">{{ number_format($row->data_kerusakan_rr ?? 0, 0, ',', '.') }}</td>
                        <td class="currency-column">{{ number_format($row->nilai_kerusakan_rb ?? 0, 0, ',', '.') }}</td>
                        <td class="currency-column">{{ number_format($row->nilai_kerusakan_rs ?? 0, 0, ',', '.') }}</td>
                        <td class="currency-column">{{ number_format($row->nilai_kerusakan_rr ?? 0, 0, ',', '.') }}</td>
                        <td class="currency-column">{{ number_format($row->perkiraan_kerugian ?? 0, 0, ',', '.') }}</td>
                        <td class="currency-column">{{ number_format($row->jumlah_kerusakan_kerugian ?? 0, 0, ',', '.') }}</td>
                        <td class="currency-column">{{ number_format($row->kebutuhan ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="13" style="text-align: center; font-style: italic; color: #666;">
                            Tidak ada data tersedia
                        </td>
                    </tr>
                @endif

                <!-- Rekapitulasi Total -->
                <tr class="total-row">
                    <td colspan="4"><strong>TOTAL KESELURUHAN</strong></td>
                    <td class="data-column"><strong>{{ number_format($totalRB ?? 0, 0, ',', '.') }}</strong></td>
                    <td class="data-column"><strong>{{ number_format($totalRS ?? 0, 0, ',', '.') }}</strong></td>
                    <td class="data-column"><strong>{{ number_format($totalRR ?? 0, 0, ',', '.') }}</strong></td>
                    <td class="currency-column"><strong>{{ number_format($totalNilaiKerusakan ?? 0, 0, ',', '.') }}</strong></td>
                    <td class="currency-column"><strong>-</strong></td>
                    <td class="currency-column"><strong>-</strong></td>
                    <td class="currency-column"><strong>{{ number_format($totalKerugian ?? 0, 0, ',', '.') }}</strong></td>
                    <td class="currency-column"><strong>{{ number_format($totalKeruskanKerugian ?? 0, 0, ',', '.') }}</strong></td>
                    <td class="currency-column"><strong>{{ number_format($totalKebutuhan ?? 0, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="summary-box">
            <div class="summary-title">REKAPITULASI KERUSAKAN DAN KERUGIAN</div>
            <div style="margin-top: 6px; font-size: 7pt; line-height: 1.3;">
                <div>• <strong>Total Kerusakan Fisik:</strong> {{ number_format(($totalRB ?? 0) + ($totalRS ?? 0) + ($totalRR ?? 0), 0, ',', '.') }} unit (RB: {{ number_format($totalRB ?? 0, 0, ',', '.') }}, RS: {{ number_format($totalRS ?? 0, 0, ',', '.') }}, RR: {{ number_format($totalRR ?? 0, 0, ',', '.') }})</div>
                <div>• <strong>Total Nilai Kerusakan:</strong> Rp {{ number_format($totalNilaiKerusakan ?? 0, 0, ',', '.') }}</div>
                <div>• <strong>Total Kerugian:</strong> Rp {{ number_format($totalKerugian ?? 0, 0, ',', '.') }}</div>
                <div>• <strong>Total Kerusakan & Kerugian:</strong> Rp {{ number_format($totalKeruskanKerugian ?? 0, 0, ',', '.') }}</div>
                <div>• <strong>Total Kebutuhan Pemulihan:</strong> Rp {{ number_format($totalKebutuhan ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Signature Area -->
        <div class="signature-area">
            <div class="signature-box">
                <div style="font-size: 7pt; margin-bottom: 4px;">Koordinator Analisis</div>
                <div class="signature-line"></div>
                <div style="font-size: 6pt; margin-top: 2px;">Nama & Tanda Tangan</div>
            </div>
            <div class="signature-box">
                <div style="font-size: 7pt; margin-bottom: 4px;">Kepala Daerah</div>
                <div class="signature-line"></div>
                <div style="font-size: 6pt; margin-top: 2px;">Nama & Tanda Tangan</div>
            </div>
            <div class="signature-box">
                <div style="font-size: 7pt; margin-bottom: 4px;">BNPB Pusat</div>
                <div class="signature-line"></div>
                <div style="font-size: 6pt; margin-top: 2px;">Nama & Tanda Tangan</div>
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