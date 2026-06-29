<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Perumahan - Formulir {{ $formulir->id }}</title>
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
            font-weight: bold;
            margin-bottom: 5px;
        }
        .bencana-info {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 11px; /* Ukuran font sedikit lebih kecil untuk landscape */
        }
        table, th, td { 
            border: 1px solid #ddd;
        }
        th, td {
            padding: 6px 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            background-color: #e0e0e0;
            padding: 5px;
        }
        .subsection-title {
            font-size: 13px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 10px;
        }
        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .page-break {
            page-break-after: always;
        }
        .signature {
            margin-top: 50px;
            float: right;
            width: 40%;
            text-align: center;
        }
        .signature-line {
            margin-top: 50px;
            border-top: 1px solid #000;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN KERUSAKAN DAN KERUGIAN SEKTOR PERUMAHAN</h1>
        <p>Tanggal Laporan: {{ optional($formulir->laporan?->tanggal_lapor)->format('d F Y') ?? '-' }}</p>
    </div>

    <div class="bencana-info">
        <p><strong>Bencana:</strong> {{ $bencana->jenis_bencana ?? '-' }}</p>
        <p><strong>Tanggal Kejadian:</strong> {{ optional($bencana->tanggal)->format('d F Y') ?? '-' }}</p>
        <p><strong>Lokasi:</strong> 
            @if($bencana && $bencana->desa)
                @foreach($bencana->desa as $desa)
                    {{ $desa->nama }}@if(!$loop->last), @endif
                @endforeach
            @else
                -
            @endif
        </p>
        <p><strong>Formulir ID:</strong> {{ $formulir->id }}</p>
    </div>

    <div class="section-title">I. PERKIRAAN KERUSAKAN</div>
    <table>
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Sub Kategori</th>
                <th>Tingkat Kerusakan</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr>
                    <td>{{ $item['kategori'] }}</td>
                    <td>{{ $item['sub_kategori'] ?? '-' }}</td>
                    <td>{{ $item['tingkat_kerusakan'] ?? '-' }}</td>
                    <td>{{ $item['jumlah'] ?? 0 }} {{ $item['satuan'] ?? '' }}</td>
                    <td>Rp {{ number_format($item['harga_satuan'] ?? 0, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item['subtotal'] ?? 0, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada item</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">II. TOTAL KERUSAKAN DAN KERUGIAN</div>
    <table>
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Kerusakan</td>
                <td>Rp {{ number_format($totals['total_kerusakan'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Kerugian</td>
                <td>Rp {{ number_format($totals['total_kerugian'] ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>Total Keseluruhan</td>
                <td>Rp {{ number_format($totals['total_keseluruhan'] ?? 0, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <div class="signature">
            <p>{{ $bencana->jenis_bencana ?? '-' }}, {{ now()->format('d F Y') }}</p>
            <p>Petugas,</p>
            <div class="signature-line"></div>
            <p>________________________</p>
            <p>NIP.</p>
        </div>
    </div>

</body>
</html>
