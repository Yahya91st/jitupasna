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
    <title>Form Sektor Perikanan - {{ $formulir->nama_kampung }}</title>
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
        <h2>FORMAT 12: PENGUMPULAN DATA SEKTOR PERIKANAN</h2>
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

    <h3>Data Kerusakan Sarana Budidaya Perikanan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Sarana</th>
                <th class="text-center">Jumlah Rusak (Unit)</th>
                <th class="text-center">Harga per Unit (Rp)</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Kolam Ikan</td>
                <td class="text-center">{{ $getCategoryItem('tempat_pemeliharaan')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('tempat_pemeliharaan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tambak</td>
                <td class="text-center">{{ $getCategoryItem('tempat_pemeliharaan')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('tempat_pemeliharaan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Keramba</td>
                <td class="text-center">{{ $getCategoryItem('tempat_pemeliharaan')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('tempat_pemeliharaan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Hatchery</td>
                <td class="text-center">{{ $getCategoryItem('tempat_pemeliharaan')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('tempat_pemeliharaan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            @if ($getCategoryItem('lainnya_jenis_sarana')?->jumlah ?? 0)
                <tr>
                    <td>{{ $getCategoryItem('lainnya_jenis_sarana')?->jumlah ?? 0 }}</td>
                    <td class="text-center">{{ $getCategoryItem('lainnya_sarana')?->jumlah ?? 0 }}</td>
                    <td class="text-right">{{ number_format($getCategoryItem('lainnya_sarana')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
                </tr>
            @endif
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerusakan Sarana Budidaya</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerusakan Alat Penangkapan Ikan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Alat</th>
                <th class="text-center">Jumlah Rusak (Unit)</th>
                <th class="text-center">Harga per Unit (Rp)</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Perahu Bermotor</td>
                <td class="text-center">{{ $getCategoryItem('kapal_perahu')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kapal_perahu')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Perahu Dayung</td>
                <td class="text-center">{{ $getCategoryItem('kapal_perahu')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kapal_perahu')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Jaring Insang</td>
                <td class="text-center">{{ $getCategoryItem('tempat_pelelangan')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('tempat_pelelangan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Jaring Purse Seine</td>
                <td class="text-center">{{ $getCategoryItem('tempat_pelelangan')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('tempat_pelelangan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Alat Penangkap Lainnya</td>
                <td class="text-center">{{ $getCategoryItem('tempat_pelelangan')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('tempat_pelelangan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerusakan Alat Penangkapan Ikan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Budidaya Ikan dan Perikanan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Ikan</th>
                <th class="text-center">Jumlah (kg)</th>
                <th class="text-center">Harga per kg (Rp)</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Ikan Lele</td>
                <td class="text-center">{{ $getCategoryItem('produksi_hilang_total')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('produksi_hilang_total')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Ikan Nila</td>
                <td class="text-center">{{ $getCategoryItem('produksi_hilang_total')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('produksi_hilang_total')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Ikan Mas</td>
                <td class="text-center">{{ $getCategoryItem('produksi_hilang_total')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('produksi_hilang_total')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Udang</td>
                <td class="text-center">{{ $getCategoryItem('udang')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('udang')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Bandeng</td>
                <td class="text-center">{{ $getCategoryItem('bandeng')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('bandeng')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Ikan Laut Lainnya</td>
                <td class="text-center">{{ $getCategoryItem('ikan_laut')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('ikan_laut')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerugian Ikan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Gangguan Usaha</h3>
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
                <td>Gangguan Usaha Perikanan</td>
                <td>{{ $getCategoryItem('gangguan_usaha')?->durasi ?? 0 }} hari @ Rp {{ number_format($getCategoryItem('pendapatan_per')?->durasi ?? 0, 0, ',', '.') }}/hari</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Rekapitulasi Dampak Sektor Perikanan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 60%">Kategori</th>
                <th class="text-center">Nilai (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Kerusakan (Sarana Budidaya + Alat Penangkapan)</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Kerugian (Ikan + Gangguan Usaha)</td>
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
