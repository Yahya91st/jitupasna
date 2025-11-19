<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 10 - Analisa Data Akibat</title>
    <style>
        @page {
            margin: 0.5cm;
            size: A4 landscape;
        }
        
        body {
            font-family: 'Times New Roman', serif;
            font-size: 8pt;
            line-height: 1.2;
            margin: 0.5cm;
            color: #333;
        }
        
        .document-title {
            text-align: center;
            margin-bottom: 6px;
            padding-bottom: 4px;
            border-bottom: 2px solid #0066cc;
        }
        
        .document-title h5 {
            margin: 0.1rem 0;
            font-weight: bold;
            color: #333;
            font-size: 10pt;
        }
        
        .document-title h5:first-child {
            color: #0066cc;
            margin-bottom: 0.1rem;
            font-size: 9pt;
        }
        
        .section-header {
            font-size: 8pt;
            font-weight: bold;
            background: #f0f0f0;
            color: #333;
            padding: 3px 6px;
            margin: 6px 0 3px 0;
            border-left: 3px solid #0066cc;
            letter-spacing: 0.2px;
        }
        
        .form-section {
            margin-bottom: 3px;
        }
        
        .form-label {
            display: inline-block;
            width: 140px;
            vertical-align: top;
            font-weight: 600;
            color: #555;
            font-size: 8pt;
        }
        
        .form-value {
            color: #000;
            font-weight: normal;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 4px 0;
            font-size: 8pt;
        }
        
        table th, table td {
            border: 1px solid #333;
            padding: 3px 5px;
            vertical-align: top;
            min-height: 20px;
        }
        
        table th {
            background: #f5f5f5;
            font-weight: 600;
            color: #333;
            text-align: center;
        }
        
        .label {
            font-weight: 600;
            width: 35%;
            background: #f5f5f5;
            color: #333;
        }
        
        .value {
            width: 65%;
            background: white;
            color: #000;
        }
        
        .text-content {
            margin: 0;
            padding: 3px 5px;
            background: white;
            font-size: 8pt;
            min-height: 12px;
            color: #000;
            line-height: 1.2;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-left {
            text-align: left;
        }
        
        .font-bold {
            font-weight: bold;
        }
        
        .empty-row td {
            min-height: 30px;
            padding: 8px 5px;
        }
        
        .signature-section {
            position: relative;
            text-align: right;
            margin-top: 8px;
            page-break-inside: avoid;
        }
        
        .signature-box {
            display: inline-block;
            text-align: center;
            width: 150px;
            float: right;
        }
        
        .signature-name {
            text-align: center;
            font-weight: bold;
            margin-top: 35px;
            border-bottom: 1px solid #333;
            padding-bottom: 2px;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        p {
            margin: 2px 0;
            line-height: 1.2;
            font-size: 8pt;
        }
        
        strong {
            font-weight: 600;
        }
        
        @media print {
            body { 
                font-size: 8pt;
            }
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>

<body>
    <!-- Document Header -->
    <div class="document-title">
        <h5><strong>Formulir 10</strong></h5>
        <h5>Analisa Data Akibat terhadap Akses, Fungsi, dan Resiko (PDNA)</h5>
    </div>

    <!-- A. INFORMASI BENCANA -->
    <div class="section-header">A. INFORMASI BENCANA</div>
    <div class="form-section">
        <p>
            <span class="form-label">Nama Bencana</span>: <span class="form-value">{{ $form->bencana->kategori_bencana->nama }}</span>
        </p>
        <p>
            <span class="form-label">Referensi</span>: <span class="form-value">{{ $form->bencana->Ref }}</span>
        </p>
        <p>
            <span class="form-label">Tanggal Bencana</span>: <span class="form-value">{{ \Carbon\Carbon::parse($form->bencana->tanggal)->format('d F Y') }}</span>
        </p>
        <p>
            <span class="form-label">Lokasi Bencana</span>: <span class="form-value">
                @foreach($form->bencana->desa as $desa)
                    {{ $desa->nama }}@if(!$loop->last), @endif
                @endforeach
            </span>
        </p>
    </div>

    <!-- B. ANALISA DATA AKIBAT -->
    <div class="section-header">B. ANALISA DATA AKIBAT</div>
    
    <table>
        <thead>
            <tr>
                <th rowspan="2" width="5%">No</th>
                <th rowspan="2" width="15%">Sektor-sub.sektor</th>
                <th rowspan="2" width="12%">Lokasi</th>
                <th colspan="3" width="48%">Akibat terhadap akses, fungsi dan resiko</th>
                <th rowspan="2" width="20%">Kebutuhan-kegiatan pemulihan</th>
            </tr>
            <tr>
                <th width="16%">Point penting hasil pengolahan data survey</th>
                <th width="16%">Point penting hasil wawancara/FGD</th>
                <th width="16%">Point penting hasil pendataan ke SKPD</th>
            </tr>
        </thead>
        <tbody>
            <!-- 1. Perumahan -->
            <tr>
                <td class="text-center font-bold">1</td>
                <td class="font-bold">Perumahan</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-size: 7pt;">Analisa kebutuhan pemulihan pada tiap-tiap sektor/sub-sektor dengan melihat pada akibat yang telah diidentifikasi !</td>
            </tr>
            <tr class="empty-row">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="empty-row">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="empty-row">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            
            <!-- 2. Infrastruktur -->
            <tr>
                <td class="text-center font-bold">2</td>
                <td class="font-bold">Infrastruktur</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Transportasi</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Energi</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>dll</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            
            <!-- 3. Ekonomi Produktif -->
            <tr>
                <td class="text-center font-bold">3</td>
                <td class="font-bold">Ekonomi Produktif</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Pertanian</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Peternakan</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Perikanan</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>dll</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            
            <!-- 4. Sosial -->
            <tr>
                <td class="text-center font-bold">4</td>
                <td class="font-bold">Sosial</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Pendidikan</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Kesehatan</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Agama</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Budaya</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>dll</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            
            <!-- 5. Lintas sektor -->
            <tr>
                <td class="text-center font-bold">5</td>
                <td class="font-bold">Lintas sektor</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Pemerintahan</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Lingkungan hidup</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>dll</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            
            <!-- Jumlah Kebutuhan -->
            <tr>
                <td colspan="2" class="text-center font-bold">Jumlah Kebutuhan</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
