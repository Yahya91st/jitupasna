@php
    $items = $formulir->items ?? collect();
    $getItem = fn($kategori, $subKategori = null, $tingkatKerusakan = null) => $items->first(fn($item) => $item->kategori === $kategori && ($subKategori === null || $item->sub_kategori === $subKategori) && ($tingkatKerusakan === null || $item->tingkat_kerusakan === $tingkatKerusakan));
    $getCategoryItem = fn($kategori, $subKategori = null) => $items->first(fn($item) => $item->kategori === $kategori && ($subKategori === null || $item->sub_kategori === $subKategori));
    $getDimensi = fn($item) => $item->dimensi ?? ($item->jumlah2 ?? ($item->jumlah ?? 0));
@endphp
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Peternakan - {{ $formulir->nama_kampung }}</title>
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
        <h2>FORMAT 11: PENGUMPULAN DATA SEKTOR PETERNAKAN</h2>
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

    <h3>Data Kerusakan Bangunan Peternakan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" rowspan="2">Jenis Bangunan</th>
                <th class="text-center" colspan="3">Jumlah (Unit)</th>
                <th class="text-center" rowspan="2">Luas per Unit (mâ”¬â–“)</th>
                <th class="text-center" rowspan="2">Harga per mâ”¬â–“ (Rp)</th>
                <th class="text-center" rowspan="2">Nilai Kerusakan (Rp)</th>
            </tr>
            <tr>
                <th class="text-center">Rusak Berat</th>
                <th class="text-center">Rusak Sedang</th>
                <th class="text-center">Rusak Ringan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Kandang</td>
                <td class="text-center">{{ $getItem('kerusakan_kandang', null, 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('kerusakan_kandang', null, 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('kerusakan_kandang', null, 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('kerusakan_kandang')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kerusakan_kandang')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Gudang Pakan</td>
                <td class="text-center">{{ $getItem('kerusakan_kandang', null, 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('kerusakan_kandang', null, 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('kerusakan_kandang', null, 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('kerusakan_kandang')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kerusakan_kandang')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Balai Inseminasi</td>
                <td class="text-center">{{ $getItem('kerusakan_kandang', null, 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('kerusakan_kandang', null, 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('kerusakan_kandang', null, 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('kerusakan_kandang')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kerusakan_kandang')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            @if ($getCategoryItem('lainnya_jenis_bangunan')?->jumlah ?? 0)
                <tr>
                    <td>{{ $getCategoryItem('lainnya_jenis_bangunan')?->jumlah ?? 0 }}</td>
                    <td class="text-center">{{ $getItem('lainnya_bangunan', null, 'berat')?->jumlah ?? 0 }}</td>
                    <td class="text-center">{{ $getItem('lainnya_bangunan', null, 'sedang')?->jumlah ?? 0 }}</td>
                    <td class="text-center">{{ $getItem('lainnya_bangunan', null, 'ringan')?->jumlah ?? 0 }}</td>
                    <td class="text-center">{{ number_format($getDimensi($getCategoryItem('lainnya_bangunan')), 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($getCategoryItem('lainnya_bangunan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
                </tr>
            @endif
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="6">Total Kerusakan Bangunan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerusakan Peralatan Peternakan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Peralatan</th>
                <th class="text-center">Jumlah Rusak (Unit)</th>
                <th class="text-center">Harga per Unit (Rp)</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mesin Pencacah Pakan</td>
                <td class="text-center">{{ $getCategoryItem('kerusakan_peralatan')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kerusakan_peralatan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Mesin Pembuat Pakan</td>
                <td class="text-center">{{ $getCategoryItem('kerusakan_peralatan')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kerusakan_peralatan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Alat Penampung Susu</td>
                <td class="text-center">{{ $getCategoryItem('kerusakan_peralatan')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kerusakan_peralatan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            @if ($getCategoryItem('lainnya_jenis_peralatan')?->jumlah ?? 0)
                <tr>
                    <td>{{ $getCategoryItem('lainnya_jenis_peralatan')?->jumlah ?? 0 }}</td>
                    <td class="text-center">{{ $getCategoryItem('lainnya_peralatan')?->jumlah ?? 0 }}</td>
                    <td class="text-right">{{ number_format($getCategoryItem('lainnya_peralatan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
                </tr>
            @endif
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerusakan Peralatan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Ternak</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Ternak</th>
                <th class="text-center">Jumlah (Ekor)</th>
                <th class="text-center">Harga per Ekor (Rp)</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sapi</td>
                <td class="text-center">{{ $getCategoryItem('kematian_ternak')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kematian_ternak')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Kambing</td>
                <td class="text-center">{{ $getCategoryItem('kematian_ternak')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kematian_ternak')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Ayam</td>
                <td class="text-center">{{ $getCategoryItem('kematian_ternak')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kematian_ternak')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Bebek</td>
                <td class="text-center">{{ $getCategoryItem('bebek')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('bebek')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            @if ($getCategoryItem('lainnya_jenis_ternak')?->jumlah ?? 0)
                <tr>
                    <td>{{ $getCategoryItem('lainnya_jenis_ternak')?->jumlah ?? 0 }}</td>
                    <td class="text-center">{{ $getCategoryItem('lainnya_ternak')?->jumlah ?? 0 }}</td>
                    <td class="text-right">{{ number_format($getCategoryItem('lainnya_ternak')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
                </tr>
            @endif
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerugian Ternak</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Lainnya</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Kerugian</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Kerugian Pakan</td>
                <td>{{ number_format($getCategoryItem('pakan_jumlah_ton')?->jumlah ?? 0, 2, ',', '.') }} ton @ Rp {{ number_format($getCategoryItem('pakan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Gangguan Usaha</td>
                <td>{{ $getCategoryItem('gangguan_usaha')?->durasi ?? 0 }} hari @ Rp {{ number_format($getCategoryItem('pendapatan_per')?->durasi ?? 0, 0, ',', '.') }}/hari</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="2">Total Kerugian Lainnya</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)) + $items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Rekapitulasi Dampak Sektor Peternakan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 60%">Kategori</th>
                <th class="text-center">Nilai (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Kerusakan (Bangunan + Peralatan)</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Kerugian (Ternak + Pakan + Gangguan Usaha)</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td>TOTAL DAMPAK</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)) + $items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
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
