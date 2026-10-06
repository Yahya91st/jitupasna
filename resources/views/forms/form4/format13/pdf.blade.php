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
    <title>Form Sektor Industri - {{ $formulir->nama_kampung }}</title>
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
        <h2>FORMAT 13: PENGUMPULAN DATA SEKTOR INDUSTRI</h2>
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

    <h3>Data Kerusakan Bangunan Industri</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Bangunan</th>
                <th class="text-center">Jumlah (Unit)</th>
                <th class="text-center">Luas per Unit (mâ”¬â–“)</th>
                <th class="text-center">Harga per mâ”¬â–“ (Rp)</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Unit Produksi</td>
                <td class="text-center">{{ $getCategoryItem('pabrik')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('pabrik')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('pabrik')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Gudang</td>
                <td class="text-center">{{ $getCategoryItem('pabrik')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('pabrik')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('pabrik')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Toko</td>
                <td class="text-center">{{ $getCategoryItem('pabrik')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('pabrik')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('pabrik')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            @if ($getCategoryItem('lainnya_jenis_bangunan')?->jumlah ?? 0)
                <tr>
                    <td>{{ $getCategoryItem('lainnya_jenis_bangunan')?->jumlah ?? 0 }}</td>
                    <td class="text-center">{{ $getCategoryItem('lainnya_bangunan')?->jumlah ?? 0 }}</td>
                    <td class="text-center">{{ number_format($getDimensi($getCategoryItem('lainnya_bangunan')), 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($getCategoryItem('lainnya_bangunan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
                </tr>
            @endif
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="4">Total Kerusakan Bangunan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerusakan Peralatan Industri</h3>
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
                <td>Mesin Jahit</td>
                <td class="text-center">{{ $getCategoryItem('mesin')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('mesin')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Oven</td>
                <td class="text-center">{{ $getCategoryItem('mesin')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('mesin')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Mesin Produksi</td>
                <td class="text-center">{{ $getCategoryItem('mesin')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('mesin')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Alat Produksi Lainnya</td>
                <td class="text-center">{{ $getCategoryItem('mesin')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('mesin')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerusakan Peralatan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Inventaris dan Bahan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Inventaris</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Harga per Satuan (Rp)</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Bahan Baku</td>
                <td class="text-center">{{ $getCategoryItem('bahan_baku')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('bahan_baku')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Barang Setengah Jadi</td>
                <td class="text-center">{{ $getCategoryItem('bahan_jadi')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('bahan_jadi')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Barang Jadi</td>
                <td class="text-center">{{ $getCategoryItem('bahan_jadi')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('bahan_jadi')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerugian Inventaris</td>
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
                <td>Gangguan Usaha</td>
                <td>{{ $getCategoryItem('gangguan_usaha')?->durasi ?? 0 }} hari @ Rp {{ number_format($getCategoryItem('pendapatan_per')?->durasi ?? 0, 0, ',', '.') }}/hari</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Relokasi</td>
                <td>Relokasi sementara</td>
                <td class="text-right">{{ number_format($getCategoryItem('biaya_relokasi')?->jumlah ?? (0 ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Pengadaan Air</td>
                <td>Penyediaan air bersih</td>
                <td class="text-right">{{ number_format($getCategoryItem('biaya_pengadaan_air')?->jumlah ?? (0 ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Pengadaan Listrik</td>
                <td>Generator atau listrik alternatif</td>
                <td class="text-right">{{ number_format($getCategoryItem('biaya_pengadaan_listrik')?->jumlah ?? (0 ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Transportasi Tambahan</td>
                <td>Biaya logistik tambahan</td>
                <td class="text-right">{{ number_format($getCategoryItem('biaya_transportasi_tambahan')?->jumlah ?? (0 ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="2">Total Kerugian Lainnya</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)) + $items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Rekapitulasi Dampak Sektor Industri</h3>
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
                <td>Total Kerugian (Inventaris + Gangguan Usaha + Biaya Tambahan)</td>
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
