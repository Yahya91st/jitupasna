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
    <title>Form Sektor Pertanian - {{ $formulir->nama_kampung }}</title>
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
            page-break-inside: avoid;
        }

        .footer-sign {
            float: right;
            text-align: center;
            width: 200px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>FORMAT 10: LAPORAN KERUSAKAN DAN KERUGIAN SEKTOR PERTANIAN AKIBAT BENCANA</h1>
        <h2>{{ strtoupper($bencana->nama_bencana) }} DI {{ strtoupper($formulir->nama_kampung) }}, {{ strtoupper($formulir->nama_distrik) }}</h2>
    </div>

    <table class="info-table">
        <tr>
            <th>Nama Bencana</th>
            <td>{{ $bencana->nama_bencana }}</td>
            <th>Tanggal Kejadian</th>
            <td>{{ date('d-m-Y', strtotime($bencana->tanggal_kejadian)) }}</td>
        </tr>
        <tr>
            <th>Lokasi</th>
            <td>{{ $formulir->nama_kampung }}, {{ $formulir->nama_distrik }}</td>
            <th>Tanggal Laporan</th>
            <td>{{ $tanggal }}</td>
        </tr>
    </table>

    <h3>Data Kerusakan Tanaman</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Tanaman</th>
                <th class="text-center">Luas Terdampak (Ha)</th>
                <th class="text-center">Biaya Kerusakan Per Ha (Rp)</th>
                <th class="text-center">Lama Tanam (Bulan)</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Padi</td>
                <td class="text-center">{{ number_format($getCategoryItem('padi_luas_rusak')?->jumlah ?? 0, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kerusakan_lahan_pertanian')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $getCategoryItem('kerusakan_lahan_pertanian')?->durasi ?? 0 }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Jagung</td>
                <td class="text-center">{{ number_format($getCategoryItem('jagung_luas_rusak')?->jumlah ?? 0, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kerusakan_lahan_pertanian')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $getCategoryItem('kerusakan_lahan_pertanian')?->durasi ?? 0 }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Kedelai</td>
                <td class="text-center">{{ number_format($getCategoryItem('kedelai_luas_rusak')?->jumlah ?? 0, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kerusakan_lahan_pertanian')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $getCategoryItem('kerusakan_lahan_pertanian')?->durasi ?? 0 }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Sayuran</td>
                <td class="text-center">{{ number_format($getCategoryItem('sayuran_luas_rusak')?->jumlah ?? 0, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kerusakan_lahan_pertanian')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $getCategoryItem('kerusakan_lahan_pertanian')?->durasi ?? 0 }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Buah-buahan</td>
                <td class="text-center">{{ number_format($getCategoryItem('buah_luas_rusak')?->jumlah ?? 0, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kerusakan_lahan_pertanian')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ $getCategoryItem('kerusakan_lahan_pertanian')?->durasi ?? 0 }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            @if ($getCategoryItem('kerusakan_lahan_pertanian')?->sub_kategori ?? '')
                <tr>
                    <td>{{ $getCategoryItem('kerusakan_lahan_pertanian')?->sub_kategori ?? '' }}</td>
                    <td class="text-center">{{ number_format($getCategoryItem('lainnya_luas_rusak')?->jumlah ?? 0, 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($getCategoryItem('kerusakan_lahan_pertanian')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $getCategoryItem('kerusakan_lahan_pertanian')?->durasi ?? 0 }}</td>
                    <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
                </tr>
            @endif
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="4">Total Kerusakan Tanaman</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerusakan Infrastruktur Pertanian</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Infrastruktur</th>
                <th class="text-center">Jumlah Rusak</th>
                <th class="text-center">Satuan</th>
                <th class="text-center">Biaya Per Unit (Rp)</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Saluran Irigasi</td>
                <td class="text-center">{{ number_format($getCategoryItem('irigasi_panjang_rusak')?->jumlah ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">meter</td>
                <td class="text-right">{{ number_format($getCategoryItem('sarana_irigasi')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Traktor/Mesin Pengolah Tanah</td>
                <td class="text-center">{{ $getCategoryItem('traktor_jumlah_rusak')?->jumlah ?? 0 }}</td>
                <td class="text-center">unit</td>
                <td class="text-right">{{ number_format($getCategoryItem('mesin_pertanian')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Pompa Air</td>
                <td class="text-center">{{ $getCategoryItem('pompa_jumlah_rusak')?->jumlah ?? 0 }}</td>
                <td class="text-center">unit</td>
                <td class="text-right">{{ number_format($getCategoryItem('mesin_pertanian')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Alat Penanam</td>
                <td class="text-center">{{ $getCategoryItem('alat_tanam_jumlah_rusak')?->jumlah ?? 0 }}</td>
                <td class="text-center">unit</td>
                <td class="text-right">{{ number_format($getCategoryItem('mesin_pertanian')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Gudang Penyimpanan</td>
                <td class="text-center">{{ $getCategoryItem('gudang_jumlah_rusak')?->jumlah ?? 0 }} ({{ number_format($getCategoryItem('gudang_luas_per')?->jumlah ?? 0, 0, ',', '.') }} mâ”¬â–“)</td>
                <td class="text-center">unit</td>
                <td class="text-right">{{ number_format($getCategoryItem('gudang_pertanian')?->harga_satuan ?? 0, 0, ',', '.') }}/mâ”¬â–“</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="4">Total Kerusakan Infrastruktur</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Akibat Bencana</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Kerugian</th>
                <th class="text-center">Parameter 1</th>
                <th class="text-center">Parameter 2</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Pembersihan Lahan</td>
                <td>{{ number_format($getCategoryItem('luas_lahan_dibersihkan')?->jumlah ?? 0, 2, ',', '.') }} Ha</td>
                <td>Rp {{ number_format($getCategoryItem('biaya_pembersihan_per_ha')?->jumlah ?? 0, 0, ',', '.') }}/Ha</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Penurunan Hasil Panen</td>
                <td>{{ number_format($getCategoryItem('luas_panen_terdampak')?->jumlah ?? 0, 2, ',', '.') }} Ha</td>
                <td>Penurunan {{ number_format(($getCategoryItem('produksi_normal_per_ha')?->jumlah ?? 0) - ($getCategoryItem('produksi_pasca_bencana_per_ha')?->jumlah ?? 0), 2, ',', '.') }} ton/Ha</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Tambahan Produksi</td>
                <td>{{ number_format($getCategoryItem('luas_lahan_terdampak')?->jumlah ?? 0, 2, ',', '.') }} Ha</td>
                <td>Rp {{ number_format($getCategoryItem('tambahan_biaya_per_ha')?->jumlah ?? 0, 0, ',', '.') }}/Ha</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerugian Akibat Bencana</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Rekapitulasi Dampak Sektor Pertanian</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 60%">Kategori</th>
                <th class="text-center">Nilai (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Kerusakan (Tanaman + Infrastruktur)</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Kerugian (Pembersihan + Produksi + Biaya Tambahan)</td>
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
