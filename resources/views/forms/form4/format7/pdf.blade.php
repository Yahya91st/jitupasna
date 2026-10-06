@php
    $items = $formulir->items ?? collect();
    $getItem = fn($kategori, $subKategori = null, $tingkatKerusakan = null) => $items->first(fn($item) => $item->kategori === $kategori && ($subKategori === null || $item->sub_kategori === $subKategori) && ($tingkatKerusakan === null || $item->tingkat_kerusakan === $tingkatKerusakan));
    $getCategoryItem = fn($kategori, $subKategori = null) => $items->first(fn($item) => $item->kategori === $kategori && ($subKategori === null || $item->sub_kategori === $subKategori));
    $getDimensi = fn($item) => $item->dimensi ?? ($item->jumlah2 ?? ($item->jumlah ?? 0));
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Transportasi - {{ $formulir->nama_kampung }}</title>
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

        table,
        th,
        td {
            border: 1px solid #333;
        }

        th,
        td {
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

        .info-table td,
        .info-table th {
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
        <h2>FORMAT 7: PENGUMPULAN DATA SEKTOR TRANSPORTASI</h2>
    </div>

    <table class="info-table">
        <tr>
            <th>Bencana</th>
            <td>{{ $bencana->jenis_bencana }}</td>
            <th>Tanggal</th>
            <td>{{ $bencana->tanggal }}</td>
        </tr>
        <tr>
            <th>Kampung</th>
            <td>{{ $formulir->nama_kampung }}</td>
            <th>Distrik</th>
            <td>{{ $formulir->nama_distrik }}</td>
        </tr>
    </table>

    <h3>A. Data Kerusakan Infrastruktur Transportasi</h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2" class="text-center">Jenis Infrastruktur</th>
                <th colspan="3" class="text-center">Jumlah Kerusakan</th>
                <th rowspan="2" class="text-center">Panjang (m)</th>
                <th rowspan="2" class="text-center">Lebar (m)</th>
                <th rowspan="2" class="text-center">Harga Satuan<br>(Rp/mâ”¬â–“)</th>
                <th rowspan="2" class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
            <tr>
                <th class="text-center">Rusak Berat</th>
                <th class="text-center">Rusak Sedang</th>
                <th class="text-center">Rusak Ringan</th>
            </tr>
        </thead>
        <tbody>
            <!-- Jalan -->
            <tr>
                <td>Jalan</td>
                <td class="text-center">{{ $getItem('jalan', null, 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('jalan', null, 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('jalan', null, 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getDimensi($getCategoryItem('jalan')) }}</td>
                <td class="text-center">{{ $getCategoryItem('jalan')?->jumlah2 ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('jalan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">
                    {{ number_format(
                        ($getItem('jalan', null, 'berat')?->jumlah ?? 0 * $getDimensi($getCategoryItem('jalan')) * ($getCategoryItem('jalan')?->jumlah2 ?? 0) * ($getCategoryItem('jalan')?->harga_satuan ?? 0)) +
                            ($getItem('jalan', null, 'sedang')?->jumlah ?? 0 * $getDimensi($getCategoryItem('jalan')) * ($getCategoryItem('jalan')?->jumlah2 ?? 0) * ($getCategoryItem('jalan')?->harga_satuan ?? 0) * 0.3) +
                            ($getItem('jalan', null, 'ringan')?->jumlah ?? 0 * $getDimensi($getCategoryItem('jalan')) * ($getCategoryItem('jalan')?->jumlah2 ?? 0) * ($getCategoryItem('jalan')?->harga_satuan ?? 0) * 0.1),
                        0,
                        ',',
                        '.',
                    ) }}
                </td>
            </tr>

            <!-- Jembatan -->
            <tr>
                <td>Jembatan</td>
                <td class="text-center">{{ $getItem('jembatan', null, 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('jembatan', null, 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('jembatan', null, 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getDimensi($getCategoryItem('jembatan')) }}</td>
                <td class="text-center">{{ $getCategoryItem('jembatan')?->jumlah2 ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('jembatan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">
                    {{ number_format(
                        ($getItem('jembatan', null, 'berat')?->jumlah ?? 0 * $getDimensi($getCategoryItem('jembatan')) * ($getCategoryItem('jembatan')?->jumlah2 ?? 0) * ($getCategoryItem('jembatan')?->harga_satuan ?? 0)) +
                            ($getItem('jembatan', null, 'sedang')?->jumlah ?? 0 * $getDimensi($getCategoryItem('jembatan')) * ($getCategoryItem('jembatan')?->jumlah2 ?? 0) * ($getCategoryItem('jembatan')?->harga_satuan ?? 0) * 0.3) +
                            ($getItem('jembatan', null, 'ringan')?->jumlah ?? 0 * $getDimensi($getCategoryItem('jembatan')) * ($getCategoryItem('jembatan')?->jumlah2 ?? 0) * ($getCategoryItem('jembatan')?->harga_satuan ?? 0) * 0.1),
                        0,
                        ',',
                        '.',
                    ) }}
                </td>
            </tr>

            <!-- Terminal -->
            <tr>
                <td>Terminal</td>
                <td class="text-center">{{ $getItem('terminal', null, 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('terminal', null, 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('terminal', null, 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getDimensi($getCategoryItem('terminal')) }}</td>
                <td class="text-center">{{ $getCategoryItem('terminal')?->jumlah2 ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('terminal')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">
                    {{ number_format(
                        ($getItem('terminal', null, 'berat')?->jumlah ?? 0 * $getDimensi($getCategoryItem('terminal')) * ($getCategoryItem('terminal')?->jumlah2 ?? 0) * ($getCategoryItem('terminal')?->harga_satuan ?? 0)) +
                            ($getItem('terminal', null, 'sedang')?->jumlah ?? 0 * $getDimensi($getCategoryItem('terminal')) * ($getCategoryItem('terminal')?->jumlah2 ?? 0) * ($getCategoryItem('terminal')?->harga_satuan ?? 0) * 0.3) +
                            ($getItem('terminal', null, 'ringan')?->jumlah ?? 0 * $getDimensi($getCategoryItem('terminal')) * ($getCategoryItem('terminal')?->jumlah2 ?? 0) * ($getCategoryItem('terminal')?->harga_satuan ?? 0) * 0.1),
                        0,
                        ',',
                        '.',
                    ) }}
                </td>
            </tr>

            <!-- Pelabuhan -->
            <tr>
                <td>Pelabuhan</td>
                <td class="text-center">{{ $getItem('pelabuhan', null, 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('pelabuhan', null, 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('pelabuhan', null, 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getDimensi($getCategoryItem('pelabuhan')) }}</td>
                <td class="text-center">{{ $getCategoryItem('pelabuhan')?->jumlah2 ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('pelabuhan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">
                    {{ number_format(
                        ($getItem('pelabuhan', null, 'berat')?->jumlah ?? 0 * $getDimensi($getCategoryItem('pelabuhan')) * ($getCategoryItem('pelabuhan')?->jumlah2 ?? 0) * ($getCategoryItem('pelabuhan')?->harga_satuan ?? 0)) +
                            ($getItem('pelabuhan', null, 'sedang')?->jumlah ?? 0 * $getDimensi($getCategoryItem('pelabuhan')) * ($getCategoryItem('pelabuhan')?->jumlah2 ?? 0) * ($getCategoryItem('pelabuhan')?->harga_satuan ?? 0) * 0.3) +
                            ($getItem('pelabuhan', null, 'ringan')?->jumlah ?? 0 * $getDimensi($getCategoryItem('pelabuhan')) * ($getCategoryItem('pelabuhan')?->jumlah2 ?? 0) * ($getCategoryItem('pelabuhan')?->harga_satuan ?? 0) * 0.1),
                        0,
                        ',',
                        '.',
                    ) }}
                </td>
            </tr>

            <!-- Bandara -->
            <tr>
                <td>Bandara</td>
                <td class="text-center">{{ $getItem('bandara', null, 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('bandara', null, 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('bandara', null, 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getDimensi($getCategoryItem('bandara')) }}</td>
                <td class="text-center">{{ $getCategoryItem('bandara')?->jumlah2 ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('bandara')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">
                    {{ number_format(
                        ($getItem('bandara', null, 'berat')?->jumlah ?? 0 * $getDimensi($getCategoryItem('bandara')) * ($getCategoryItem('bandara')?->jumlah2 ?? 0) * ($getCategoryItem('bandara')?->harga_satuan ?? 0)) +
                            ($getItem('bandara', null, 'sedang')?->jumlah ?? 0 * $getDimensi($getCategoryItem('bandara')) * ($getCategoryItem('bandara')?->jumlah2 ?? 0) * ($getCategoryItem('bandara')?->harga_satuan ?? 0) * 0.3) +
                            ($getItem('bandara', null, 'ringan')?->jumlah ?? 0 * $getDimensi($getCategoryItem('bandara')) * ($getCategoryItem('bandara')?->jumlah2 ?? 0) * ($getCategoryItem('bandara')?->harga_satuan ?? 0) * 0.1),
                        0,
                        ',',
                        '.',
                    ) }}
                </td>
            </tr>
        </tbody>
    </table>

    <h3>B. Data Kerugian Sektor Transportasi</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Kerugian</th>
                <th class="text-center">Pendapatan Per Hari (Rp)</th>
                <th class="text-center">Jumlah Hari</th>
                <th class="text-center">Jumlah Unit</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Angkutan Darat</td>
                <td class="text-right">{{ number_format($getCategoryItem('angkutan_darat')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $getCategoryItem('angkutan_darat')?->durasi ?? 0 }}</td>
                <td class="text-center">{{ $getCategoryItem('angkutan_darat')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format(($getCategoryItem('angkutan_darat')?->harga_satuan ?? 0) * ($getCategoryItem('angkutan_darat')?->durasi ?? 0) * ($getCategoryItem('angkutan_darat')?->jumlah ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Angkutan Laut</td>
                <td class="text-right">{{ number_format($getCategoryItem('angkutan_laut')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $getCategoryItem('angkutan_laut')?->durasi ?? 0 }}</td>
                <td class="text-center">{{ $getCategoryItem('angkutan_laut')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format(($getCategoryItem('angkutan_laut')?->harga_satuan ?? 0) * ($getCategoryItem('angkutan_laut')?->durasi ?? 0) * ($getCategoryItem('angkutan_laut')?->jumlah ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Angkutan Udara</td>
                <td class="text-right">{{ number_format($getCategoryItem('angkutan_udara')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $getCategoryItem('angkutan_udara')?->durasi ?? 0 }}</td>
                <td class="text-center">{{ $getCategoryItem('angkutan_udara')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format(($getCategoryItem('angkutan_udara')?->harga_satuan ?? 0) * ($getCategoryItem('angkutan_udara')?->durasi ?? 0) * ($getCategoryItem('angkutan_udara')?->jumlah ?? 0), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>{{ $formulir->nama_distrik }}, {{ now()->format('d F Y') }}</p>
        <div class="footer-sign">
            <p>Petugas</p>
            <br><br><br>
            <p>___________________________</p>
            <p>NIP.</p>
        </div>
    </div>
</body>

</html>
