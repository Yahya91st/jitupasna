<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 8 - Analisis Per Baris Kerusakan dan Kerugian</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 1cm;
        }

        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.3;
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 10pt;
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
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #333;
        }

        .header h3 {
            margin: 0.2rem 0;
            font-size: 10pt;
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

        .item-card {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            page-break-inside: avoid; /* prevent splitting an item across pages */
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .item-header {
            background-color: #f5f5f5;
            padding: 6px 8px;
            margin: -8px -8px 8px -8px;
            border-radius: 4px 4px 0 0;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            font-size: 9pt;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-number {
            font-size: 8pt;
            color: #666;
            font-weight: normal;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 8px;
            align-items: start;
        }

        .detail-section {
            padding: 6px;
            border: 1px solid #eee;
            border-radius: 3px;
            background-color: #fbfbfb;
            font-size: 8pt;
        }

        .detail-title {
            font-weight: bold;
            font-size: 8pt;
            margin-bottom: 4px;
            color: #333;
            text-transform: uppercase;
        }

        .detail-content {
            font-size: 8pt;
            line-height: 1.2;
        }

        .kerusakan-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 4px;
        }

        .kerusakan-item {
            text-align: center;
            background-color: #fff;
            padding: 4px;
            border: 1px solid #ccc;
            border-radius: 2px;
        }

        .kerusakan-label {
            font-size: 7pt;
            font-weight: bold;
            margin-bottom: 2px;
            color: #333;
        }

        .kerusakan-value {
            font-size: 8pt;
            font-weight: bold;
            color: #2563eb;
        }

        .nilai-section {
            margin-bottom: 8px;
        }

        .nilai-title {
            font-weight: bold;
            font-size: 8pt;
            margin-bottom: 4px;
            text-transform: uppercase;
            color: #333;
        }

        .nilai-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 6px;
        }

        .nilai-item {
            display: flex;
            justify-content: space-between;
            padding: 4px 8px;
            background-color: #fff;
            border: 1px solid #eee;
            border-radius: 2px;
            font-size: 8pt;
        }

        .nilai-label {
            font-weight: bold;
        }

        .nilai-value {
            font-family: 'Courier New', monospace;
            color: #16a34a;
        }

        .total-section {
            background-color: #222;
            color: white;
            padding: 8px 10px;
            margin: 8px -8px -8px -8px;
            border-radius: 0 0 4px 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 9pt;
        }

        .total-label {
            font-weight: bold;
            font-size: 8pt;
        }

        .total-value {
            font-family: 'Courier New', monospace;
            font-size: 9pt;
            font-weight: bold;
        }

        .summary-card {
            margin-top: 12px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f7fdff;
        }

        .summary-title {
            font-weight: bold;
            font-size: 10pt;
            text-align: center;
            margin-bottom: 8px;
            text-transform: uppercase;
            color: #333;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .summary-item {
            text-align: center;
            padding: 6px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .summary-item-title {
            font-size: 7pt;
            font-weight: bold;
            margin-bottom: 2px;
            color: #666;
            text-transform: uppercase;
        }

        .summary-item-value {
            font-size: 9pt;
            font-weight: bold;
            color: #333;
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
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>FORMULIR ANALISIS KERUSAKAN DAN KERUGIAN PASCABENCANA</h2>
            <h3>ANALISIS PER BARIS - DETAIL KOMPREHENSIF</h3>
        </div>

        <!-- Intro Text -->
        <div class="intro-text">
            <span class="intro-label">Deskripsi Format:</span>
            Menampilkan setiap item kerusakan dan kerugian dalam format baris terpisah untuk memudahkan analisis detail per komponen. Format ini memberikan informasi lengkap untuk setiap sektor dengan breakdown nilai kerusakan, kerugian, dan kebutuhan pemulihan yang jelas dan terstruktur.
        </div>

        @if($allRows->count() > 0)
            @foreach($allRows as $index => $row)
            <!-- Item Card -->
            <div class="item-card">
                <div class="item-header">
                    {{ $row->sektor_sub_sektor ?? 'Tidak Diketahui' }} - {{ $row->komponen_kerusakan ?? 'Tidak Diketahui' }}
                    <span class="item-number">Item #{{ $index + 1 }}</span>
                </div>
                
                <div class="detail-grid">
                    <div class="detail-section">
                        <div class="detail-title">Informasi Lokasi</div>
                        <div class="detail-content">
                            <strong>Lokasi:</strong> {{ $row->lokasi ?? 'Tidak Diketahui' }}<br>
                            <strong>Komponen:</strong> {{ $row->komponen_kerusakan ?? 'Tidak Diketahui' }}<br>
                            <strong>Sektor:</strong> {{ $row->sektor_sub_sektor ?? 'Tidak Diketahui' }}
                        </div>
                    </div>
                    <div class="detail-section">
                        <div class="detail-title">Data Kerusakan</div>
                        <div class="kerusakan-grid">
                            <div class="kerusakan-item">
                                <div class="kerusakan-label">Rusak Berat</div>
                                <div class="kerusakan-value">{{ number_format($row->data_kerusakan_rb ?? 0, 0, ',', '.') }}</div>
                            </div>
                            <div class="kerusakan-item">
                                <div class="kerusakan-label">Rusak Sedang</div>
                                <div class="kerusakan-value">{{ number_format($row->data_kerusakan_rs ?? 0, 0, ',', '.') }}</div>
                            </div>
                            <div class="kerusakan-item">
                                <div class="kerusakan-label">Rusak Ringan</div>
                                <div class="kerusakan-value">{{ number_format($row->data_kerusakan_rr ?? 0, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nilai-section">
                    <div class="nilai-title">Analisis Nilai Kerusakan</div>
                    <div class="nilai-grid">
                        <div class="nilai-item">
                            <span class="nilai-label">Nilai RB:</span>
                            <span class="nilai-value">Rp {{ number_format($row->nilai_kerusakan_rb ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="nilai-item">
                            <span class="nilai-label">Nilai RS:</span>
                            <span class="nilai-value">Rp {{ number_format($row->nilai_kerusakan_rs ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="nilai-item">
                            <span class="nilai-label">Nilai RR:</span>
                            <span class="nilai-value">Rp {{ number_format($row->nilai_kerusakan_rr ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="nilai-item">
                            <span class="nilai-label">Kerugian:</span>
                            <span class="nilai-value">Rp {{ number_format($row->perkiraan_kerugian ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="total-section">
                    <div class="total-label">TOTAL KEBUTUHAN PEMULIHAN:</div>
                    <div class="total-value">Rp {{ number_format($row->kebutuhan ?? 0, 0, ',', '.') }}</div>
                </div>
            </div>
            @endforeach
        @else
            <div class="no-data">
                Tidak ada data kerusakan dan kerugian yang tersedia
            </div>
        @endif

        <!-- Summary Card -->
        <div class="summary-card">
            <div class="summary-title">REKAPITULASI KESELURUHAN</div>
            <div class="summary-grid">
                <div class="summary-item">
                    <div class="summary-item-title">Total Item</div>
                    <div class="summary-item-value">{{ $totalItems ?? 0 }}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-item-title">Total Kerusakan</div>
                    <div class="summary-item-value">Rp {{ number_format($totalKerusakan ?? 0, 0, ',', '.') }}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-item-title">Total Kebutuhan</div>
                    <div class="summary-item-value">Rp {{ number_format($totalKebutuhan ?? 0, 0, ',', '.') }}</div>
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