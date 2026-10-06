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
    <title>Form Sektor Pemerintahan - {{ $formulir->nama_kampung }}</title>
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
        <h2>FORMAT 16: PENGUMPULAN DATA SEKTOR PEMERINTAHAN</h2>
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

    <h3>Data Kerusakan Bangunan Pemerintahan</h3>
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
                <td>Kantor Pemerintahan</td>
                <td class="text-center">{{ $getItem('kantor_pemkab', null, 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('kantor_pemkab', null, 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('kantor_pemkab', null, 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('kantor_pemkab')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kantor_pemkab')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Puskesmas/Pustu</td>
                <td class="text-center">{{ $getItem('kantor_dinas', null, 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('kantor_dinas', null, 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('kantor_dinas', null, 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('kantor_dinas')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kantor_dinas')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Pos Keamanan</td>
                <td class="text-center">{{ $getItem('kantor_vertikal', null, 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('kantor_vertikal', null, 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('kantor_vertikal', null, 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('kantor_vertikal')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('kantor_vertikal')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            @if ($getCategoryItem('lainnya_jenis_bangunan')?->jumlah ?? 0)
                <tr>
                    <td>{{ $getCategoryItem('lainnya_jenis_bangunan')?->jumlah ?? 0 }}</td>
                    <td class="text-center">{{ $getItem('lainnya', null, 'berat')?->jumlah ?? 0 }}</td>
                    <td class="text-center">{{ $getItem('lainnya', null, 'sedang')?->jumlah ?? 0 }}</td>
                    <td class="text-center">{{ $getItem('lainnya', null, 'ringan')?->jumlah ?? 0 }}</td>
                    <td class="text-center">{{ number_format($getDimensi($getCategoryItem('lainnya')), 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($getCategoryItem('lainnya')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
                </tr>
            @endif
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="6">Total Kerusakan Bangunan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Peralatan dan Perlengkapan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Peralatan</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Harga per Unit (Rp)</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Furnitur dan Perlengkapan Kantor</td>
                <td class="text-center">{{ $getCategoryItem('mebelair')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('mebelair')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Peralatan Elektronik</td>
                <td class="text-center">{{ $getCategoryItem('mebelair')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('mebelair')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Arsip dan Dokumen</td>
                <td class="text-center">{{ $getCategoryItem('mebelair')?->jumlah ?? 0 }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('mebelair')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerugian Peralatan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Lainnya</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Kerugian</th>
                <th class="text-center">Rincian</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="2">Biaya Pembersihan</td>
                <td>Tenaga Kerja: {{ $getCategoryItem('tenaga_kerja')?->harga_satuan ?? 0 }} HOK @ Rp {{ number_format($getCategoryItem('upah_harian')?->jumlah ?? 0, 0, ',', '.') }}/HOK</td>
                <td class="text-right">{{ number_format(($getCategoryItem('tenaga_kerja')?->harga_satuan ?? 0) * ($getCategoryItem('upah_harian')?->jumlah ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Alat Berat: {{ $getCategoryItem('alat_berat')?->durasi ?? 0 }} hari @ Rp {{ number_format($getCategoryItem('biaya_per_hari_alat_berat')?->jumlah ?? 0, 0, ',', '.') }}/hari</td>
                <td class="text-right">{{ number_format(($getCategoryItem('alat_berat')?->durasi ?? 0) * ($getCategoryItem('biaya_per_hari_alat_berat')?->jumlah ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Sewa Kantor Sementara</td>
                <td>{{ $getCategoryItem('jumlah_kantor_sementara')?->jumlah ?? 0 }} kantor, {{ $getCategoryItem('durasi_sewa_bulan')?->jumlah ?? 0 }} bulan @ Rp {{ number_format($getCategoryItem('biaya_sewa_per_bulan')?->jumlah ?? 0, 0, ',', '.') }}/bulan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Layanan Darurat</td>
                <td>{{ $getCategoryItem('gangguan_layanan')?->durasi ?? 0 }} hari @ Rp {{ number_format($getCategoryItem('biaya_layanan_darurat')?->jumlah ?? 0, 0, ',', '.') }}/hari</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="2">Total Kerugian Lainnya</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)) + $items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)) + $items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Rekapitulasi Dampak Sektor Pemerintahan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 60%">Kategori</th>
                <th class="text-center">Nilai (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Kerusakan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Kerugian</td>
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
