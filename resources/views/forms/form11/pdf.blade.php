<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir 11 - Rekapitulasi Kebutuhan Pascabencana</title>
    <style>
        @page {
            margin: 0.5cm;
            size: A4;
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
        
        .status-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 2px;
            font-size: 7pt;
            font-weight: bold;
        }
        
        .badge-success {
            background: #28a745;
            color: white;
        }
        
        .badge-warning {
            background: #ffc107;
            color: #000;
        }
        
        .badge-danger {
            background: #dc3545;
            color: white;
        }
        
        .badge-info {
            background: #17a2b8;
            color: white;
        }
        
        .badge-secondary {
            background: #6c757d;
            color: white;
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
        <h5><strong>Formulir 11</strong></h5>
        <h5>Rekapitulasi Kebutuhan Pascabencana (PDNA)</h5>
    </div>

    <!-- A. INFORMASI BENCANA -->
    <div class="section-header">A. INFORMASI BENCANA</div>
    <div class="form-section">
        <p>
            <span class="form-label">Nama Bencana</span>: <span class="form-value">{{ $form11->bencana->kategori_bencana->nama }}</span>
        </p>
        <p>
            <span class="form-label">Referensi</span>: <span class="form-value">{{ $form11->bencana->Ref }}</span>
        </p>
        <p>
            <span class="form-label">Tanggal Bencana</span>: <span class="form-value">{{ \Carbon\Carbon::parse($form11->bencana->tanggal)->format('d F Y') }}</span>
        </p>
        <p>
            <span class="form-label">Lokasi Bencana</span>: <span class="form-value">
                @foreach($form11->bencana->desa as $desa)
                    {{ $desa->nama }}@if(!$loop->last), @endif
                @endforeach
            </span>
        </p>
        <p>
            <span class="form-label">Tanggal Rekapitulasi</span>: <span class="form-value">{{ $form11->tanggal ? \Carbon\Carbon::parse($form11->tanggal)->format('d F Y') : '-' }}</span>
        </p>
    </div>

    <!-- B. DETAIL REKAPITULASI KEBUTUHAN -->
    <div class="section-header">B. DETAIL REKAPITULASI KEBUTUHAN</div>
    
    <table>
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 10%;">Sektor</th>
                <th style="width: 10%;">Lokasi</th>
                <th style="width: 15%;">Jenis Kebutuhan</th>
                <th style="width: 15%;">Rincian Kebutuhan</th>
                <th style="width: 7%;">Volume</th>
                <th style="width: 6%;">Satuan</th>
                <th style="width: 11%;">Harga Satuan</th>
                <th style="width: 12%;">Total</th>
                <th style="width: 6%;">Prioritas</th>
                <th style="width: 4%;">PJ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($form11->rows as $index => $row)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $row->sector_slug ?? '-' }}</td>
                <td>{{ $row->lokasi ?? $row->main_lokasi ?? '-' }}</td>
                <td>{{ $row->jenis_kebutuhan ?? '-' }}</td>
                <td>{{ $row->rincian_kebutuhan ?? '-' }}</td>
                <td class="text-right">{{ number_format($row->jumlah_unit ?? $row->volume ?? 0, 2) }}</td>
                <td class="text-center">{{ $row->satuan ?? '-' }}</td>
                <td class="text-right">{{ number_format($row->harga_satuan ?? $row->harga ?? 0, 0, ',', '.') }}</td>
                <td class="text-right font-bold">{{ number_format($row->total_kebutuhan ?? $row->jumlah ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">
                    @if($row->prioritas == 'Tinggi')
                        <span class="status-badge badge-danger">T</span>
                    @elseif($row->prioritas == 'Sedang')
                        <span class="status-badge badge-warning">S</span>
                    @elseif($row->prioritas == 'Rendah')
                        <span class="status-badge badge-info">R</span>
                    @else
                        <span class="status-badge badge-secondary">-</span>
                    @endif
                </td>
                <td style="font-size: 7pt;">{{ $row->penanggung_jawab ? substr($row->penanggung_jawab, 0, 8) : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center">Tidak ada data rekapitulasi kebutuhan</td>
            </tr>
            @endforelse
        </tbody>
        @if($form11->rows->count() > 0)
        <tfoot>
            <tr style="background: #f0f0f0;">
                <th colspan="8" class="text-right">Total Keseluruhan:</th>
                <th class="text-right">{{ number_format($form11->rows->sum(function($row) { return $row->total_kebutuhan ?? $row->jumlah ?? 0; }), 0, ',', '.') }}</th>
                <th colspan="2"></th>
            </tr>
        </tfoot>
        @endif
    </table>

    @if($form11->keterangan)
    <!-- C. KETERANGAN TAMBAHAN -->
    <div class="section-header">C. KETERANGAN TAMBAHAN</div>
    <table>
        <tr>
            <td class="value">
                <div class="text-content">{{ $form11->keterangan }}</div>
            </td>
        </tr>
    </table>
    @endif

    <!-- D. RINGKASAN PRIORITAS -->
    @if($form11->rows->count() > 0)
    <div class="section-header">D. RINGKASAN BERDASARKAN PRIORITAS</div>
    <table>
        @php
            $prioritas_stats = $form11->rows->groupBy('prioritas')->map(function($items, $key) {
                return [
                    'jumlah' => $items->count(),
                    'total' => $items->sum(function($item) { return $item->total_kebutuhan ?? $item->jumlah ?? 0; })
                ];
            });
        @endphp
        @foreach(['Tinggi', 'Sedang', 'Rendah'] as $prioritas)
            @if($prioritas_stats->has($prioritas))
            <tr>
                <td class="label">Prioritas {{ $prioritas }}</td>
                <td class="value">
                    {{ $prioritas_stats[$prioritas]['jumlah'] }} item - 
                    <strong>Rp {{ number_format($prioritas_stats[$prioritas]['total'], 0, ',', '.') }}</strong>
                </td>
            </tr>
            @endif
        @endforeach
    </table>
    @endif

    <!-- Signature Section -->
    <div class="signature-section">
        <div class="signature-box">
            <p style="margin: 0;">{{ $form11->bencana->desa->first()->nama ?? 'Lokasi' }}, {{ $form11->created_at ? $form11->created_at->format('d F Y') : now()->format('d F Y') }}</p>
            <p style="margin: 5px 0;"><strong>Petugas PDNA</strong></p>
            <div class="signature-name">
                {{ $form11->createdBy->name ?? 'Petugas' }}
            </div>
        </div>
    </div>
</body>
</html>
