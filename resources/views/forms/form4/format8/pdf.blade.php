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
    <title>Form Sektor Infrastruktur - {{ $formulir->nama_kampung }}</title>
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
        <h2>FORMAT 8: PENGUMPULAN DATA SEKTOR INFRASTRUKTUR</h2>
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

    <h3>A. Data Kerusakan Infrastruktur Publik</h3>
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
            <!-- Saluran Air -->
            <tr>
                <td>Saluran Air/Drainase</td>
                <td class="text-center">{{ $getItem('saluran_air', null, 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('saluran_air', null, 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('saluran_air', null, 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getDimensi($getCategoryItem('saluran_air')) }}</td>
                <td class="text-center">{{ $getCategoryItem('saluran_air')?->jumlah2 ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('saluran_air')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">
                    {{ number_format(
                        ($getItem('saluran_air', null, 'berat')?->jumlah ?? 0 * $getDimensi($getCategoryItem('saluran_air')) * ($getCategoryItem('saluran_air')?->jumlah2 ?? 0) * ($getCategoryItem('saluran_air')?->harga_satuan ?? 0)) +
                            ($getItem('saluran_air', null, 'sedang')?->jumlah ?? 0 * $getDimensi($getCategoryItem('saluran_air')) * ($getCategoryItem('saluran_air')?->jumlah2 ?? 0) * ($getCategoryItem('saluran_air')?->harga_satuan ?? 0) * 0.3) +
                            ($getItem('saluran_air', null, 'ringan')?->jumlah ?? 0 * $getDimensi($getCategoryItem('saluran_air')) * ($getCategoryItem('saluran_air')?->jumlah2 ?? 0) * ($getCategoryItem('saluran_air')?->harga_satuan ?? 0) * 0.1),
                        0,
                        ',',
                        '.',
                    ) }}
                </td>
            </tr>

            <!-- Embung/Waduk -->
            <tr>
                <td>Embung/Waduk</td>
                <td class="text-center">{{ $getItem('embung', null, 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('embung', null, 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('embung', null, 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getDimensi($getCategoryItem('embung')) }}</td>
                <td class="text-center">{{ $getCategoryItem('embung')?->jumlah2 ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('embung')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">
                    {{ number_format(
                        ($getItem('embung', null, 'berat')?->jumlah ?? 0 * $getDimensi($getCategoryItem('embung')) * ($getCategoryItem('embung')?->jumlah2 ?? 0) * ($getCategoryItem('embung')?->harga_satuan ?? 0)) +
                            ($getItem('embung', null, 'sedang')?->jumlah ?? 0 * $getDimensi($getCategoryItem('embung')) * ($getCategoryItem('embung')?->jumlah2 ?? 0) * ($getCategoryItem('embung')?->harga_satuan ?? 0) * 0.3) +
                            ($getItem('embung', null, 'ringan')?->jumlah ?? 0 * $getDimensi($getCategoryItem('embung')) * ($getCategoryItem('embung')?->jumlah2 ?? 0) * ($getCategoryItem('embung')?->harga_satuan ?? 0) * 0.1),
                        0,
                        ',',
                        '.',
                    ) }}
                </td>
            </tr>

            <!-- Tanggul -->
            <tr>
                <td>Tanggul/Dam</td>
                <td class="text-center">{{ $getItem('tanggul', null, 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('tanggul', null, 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('tanggul', null, 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getDimensi($getCategoryItem('tanggul')) }}</td>
                <td class="text-center">{{ $getCategoryItem('tanggul')?->jumlah2 ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('tanggul')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">
                    {{ number_format(
                        ($getItem('tanggul', null, 'berat')?->jumlah ?? 0 * $getDimensi($getCategoryItem('tanggul')) * ($getCategoryItem('tanggul')?->jumlah2 ?? 0) * ($getCategoryItem('tanggul')?->harga_satuan ?? 0)) +
                            ($getItem('tanggul', null, 'sedang')?->jumlah ?? 0 * $getDimensi($getCategoryItem('tanggul')) * ($getCategoryItem('tanggul')?->jumlah2 ?? 0) * ($getCategoryItem('tanggul')?->harga_satuan ?? 0) * 0.3) +
                            ($getItem('tanggul', null, 'ringan')?->jumlah ?? 0 * $getDimensi($getCategoryItem('tanggul')) * ($getCategoryItem('tanggul')?->jumlah2 ?? 0) * ($getCategoryItem('tanggul')?->harga_satuan ?? 0) * 0.1),
                        0,
                        ',',
                        '.',
                    ) }}
                </td>
            </tr>
        </tbody>
    </table>

    <h3>B. Data Kerugian Sektor Infrastruktur</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Kerugian</th>
                <th class="text-center">Pendapatan Per Hari (Rp)</th>
                <th class="text-center">Jumlah Hari</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Biaya Operasional Darurat</td>
                <td class="text-right">{{ number_format($getCategoryItem('operasional_darurat')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $getCategoryItem('operasional_darurat')?->durasi ?? 0 }}</td>
                <td class="text-right">{{ number_format(($getCategoryItem('operasional_darurat')?->harga_satuan ?? 0) * ($getCategoryItem('operasional_darurat')?->durasi ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Pembersihan</td>
                <td class="text-right">{{ number_format($getCategoryItem('biaya_pembersihan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $getDimensi($getCategoryItem('biaya_pembersihan')) }}</td>
                <td class="text-right">{{ number_format(($getCategoryItem('biaya_pembersihan')?->harga_satuan ?? 0) * $getDimensi($getCategoryItem('biaya_pembersihan')), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Penanganan Darurat Lainnya</td>
                <td class="text-right">{{ number_format($getCategoryItem('penanganan_lainnya')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $getCategoryItem('penanganan_lainnya')?->durasi ?? 0 }}</td>
                <td class="text-right">{{ number_format(($getCategoryItem('penanganan_lainnya')?->harga_satuan ?? 0) * ($getCategoryItem('penanganan_lainnya')?->durasi ?? 0), 0, ',', '.') }}</td>
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
