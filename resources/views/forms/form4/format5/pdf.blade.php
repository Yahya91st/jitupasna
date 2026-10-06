<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Format 5 - {{ $formulir->nama_kampung }}</title>
    <style>
        @page {
            size: landscape
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px
        }

        th,
        td {
            border: 1px solid #333;
            padding: 4px
        }

        th {
            background: #f2f2f2
        }

        .center {
            text-align: center
        }

        .right {
            text-align: right
        }
    </style>
</head>

<body>
    @php
        $items = $formulir->items ?? collect();
        $getItem = function ($kategori, $subKategori = null, $tingkatKerusakan = null) use ($items) {
            return $items->first(fn($item) => $item->kategori === $kategori && $item->sub_kategori === $subKategori && $item->tingkat_kerusakan === $tingkatKerusakan);
        };
        $getCategoryItem = fn($kategori) => $items->firstWhere('kategori', $kategori);
        $getDimensi = fn($kategori) => $items->first(fn($item) => $item->kategori === $kategori && $item->dimensi !== null)?->dimensi ?? 0;
        $bangunan = ['gereja' => 'Gereja', 'kapel' => 'Kapel', 'masjid' => 'Masjid', 'musholla' => 'Musholla', 'pura' => 'Pura', 'vihara' => 'Vihara'];
        $rupiah = fn($value) => number_format((float) ($value ?? 0), 0, ',', '.');
    @endphp
    <h2 class="center">FORMULIR 04 - FORMAT 5: SEKTOR KEAGAMAAN</h2>
    <table>
        <tr>
            <th>Bencana</th>
            <td>{{ $bencana->jenis_bencana ?? '-' }}</td>
            <th>Tanggal</th>
            <td>{{ $bencana->tanggal ?? '-' }}</td>
        </tr>
        <tr>
            <th>Kampung</th>
            <td>{{ $formulir->nama_kampung ?? '-' }}</td>
            <th>Distrik</th>
            <td>{{ $formulir->nama_distrik ?? '-' }}</td>
        </tr>
    </table>
    <h3>A. Data Kerusakan Bangunan Keagamaan</h3>
    <table>
        <tr>
            <th rowspan="2">Jenis</th>
            <th colspan="2">Berat</th>
            <th colspan="2">Sedang</th>
            <th colspan="2">Ringan</th>
            <th rowspan="2">Luas</th>
            <th rowspan="2">Harga Satuan</th>
        </tr>
        <tr>
            <th>Negeri</th>
            <th>Swasta</th>
            <th>Negeri</th>
            <th>Swasta</th>
            <th>Negeri</th>
            <th>Swasta</th>
        </tr>
        @foreach ($bangunan as $kategori => $label)
            @php $categoryItem=$getCategoryItem($kategori); @endphp<tr>
                <td>{{ $label }}</td>
                @foreach ([['berat', 'negeri'], ['berat', 'swasta'], ['sedang', 'negeri'], ['sedang', 'swasta'], ['ringan', 'negeri'], ['ringan', 'swasta']] as [$tingkat, $status])
                    <td class="center">{{ $getItem($kategori, $status, $tingkat)?->jumlah ?? 0 }}</td>
                @endforeach
                <td class="center">
                    {{ $getDimensi($kategori) }}</td>
                <td class="right">Rp {{ $rupiah($categoryItem?->harga_satuan) }}</td>
            </tr>
        @endforeach
    </table>
    <h3>B. Data Kerugian</h3>
    <table>
        <tr>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total</th>
        </tr>
        @foreach ([['tenaga_kerja', 'Tenaga Kerja', 'HOK'], ['alat_berat', 'Alat Berat', 'Hari']] as [$kategori, $label, $satuan])
            @php $item=$getCategoryItem($kategori); @endphp
            <tr>
                <td>{{ $label }}</td>
                <td>{{ $item?->jumlah ?? 0 }} {{ $satuan }}</td>
                <td class="right">Rp {{ $rupiah($item?->harga_satuan) }}</td>
                <td class="right">Rp {{ $rupiah(($item?->jumlah ?? 0) * ($item?->harga_satuan ?? 0)) }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
