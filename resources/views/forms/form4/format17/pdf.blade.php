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
    <title>Form Sektor Lingkungan - {{ $formulir->nama_kampung }}</title>
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
        <h2>FORMAT 17: PENGUMPULAN DATA SEKTOR LINGKUNGAN</h2>
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

    <h3>Data Kerusakan Ekosistem Daratan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Ekosistem</th>
                <th class="text-center">Luas (Ha)</th>
                <th class="text-center">Harga per Ha (Rp)</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Hutan</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('ekosistem_darat')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('ekosistem_darat')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tanah/Lahan</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('ekosistem_darat')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('ekosistem_darat')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Taman/Ruang Terbuka Hijau</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('ekosistem_darat')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('ekosistem_darat')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerusakan Ekosistem Daratan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerusakan Ekosistem Laut</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Ekosistem</th>
                <th class="text-center">Luas (Ha)</th>
                <th class="text-center">Harga per Ha (Rp)</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Terumbu Karang</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('ekosistem_laut')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('ekosistem_laut')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Mangrove</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('ekosistem_laut')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('ekosistem_laut')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Padang Lamun</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('ekosistem_laut')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('ekosistem_laut')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerusakan Ekosistem Laut</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerusakan Kualitas Udara</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Kerusakan</th>
                <th class="text-center">Durasi (Hari)</th>
                <th class="text-center">Luas (Kmâ”¬â–“)</th>
                <th class="text-center">Biaya per Unit</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Pencemaran Udara</td>
                <td class="text-center">{{ number_format($getCategoryItem('pencemaran_udara_durasi')?->durasi ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">{{ number_format($getCategoryItem('pencemaran_udara_luasan')?->jumlah ?? 0, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('ekosistem_udara')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="4">Total Kerusakan Kualitas Udara</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Jasa Lingkungan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Jasa Lingkungan</th>
                <th class="text-center">Parameter 1</th>
                <th class="text-center">Parameter 2</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Air Bersih</td>
                <td>{{ number_format($getDimensi($getCategoryItem('ekosistem_laut')), 0, ',', '.') }} mâ”¬â”‚</td>
                <td>Rp {{ number_format($getCategoryItem('ekosistem_laut')?->harga_satuan ?? 0, 0, ',', '.') }}/mâ”¬â”‚</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Hasil Hutan Non-kayu</td>
                <td>{{ number_format($getCategoryItem('ekosistem_darat')?->durasi ?? 0, 0, ',', '.') }} bulan</td>
                <td>Rp {{ number_format($getCategoryItem('hasil_hutan_nilai_bulanan')?->jumlah ?? 0, 0, ',', '.') }}/bulan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Ekowisata</td>
                <td>{{ number_format($getCategoryItem('ekosistem_darat')?->durasi ?? 0, 0, ',', '.') }} bulan</td>
                <td>Rp {{ number_format($getCategoryItem('ekowisata_nilai_bulanan')?->jumlah ?? 0, 0, ',', '.') }}/bulan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerugian Jasa Lingkungan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Akibat Pencemaran</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Pencemaran</th>
                <th class="text-center">Parameter 1</th>
                <th class="text-center">Parameter 2</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Pencemaran Air</td>
                <td>{{ number_format($getDimensi($getCategoryItem('pencemaran_air')), 0, ',', '.') }} mâ”¬â”‚</td>
                <td>Rp {{ number_format($getCategoryItem('pencemaran_air_biaya_pemulihan')?->jumlah ?? 0, 0, ',', '.') }}/mâ”¬â”‚</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Pencemaran Tanah</td>
                <td>{{ number_format($getDimensi($getCategoryItem('pencemaran_tanah')), 2, ',', '.') }} Ha</td>
                <td>Rp {{ number_format($getCategoryItem('pencemaran_tanah_biaya_pemulihan')?->jumlah ?? 0, 0, ',', '.') }}/Ha</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Penanganan Sampah</td>
                <td>{{ number_format($getDimensi($getCategoryItem('sampah')), 0, ',', '.') }} ton</td>
                <td>Rp {{ number_format($getCategoryItem('sampah_biaya_penanganan')?->jumlah ?? 0, 0, ',', '.') }}/ton</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="3">Total Kerugian Akibat Pencemaran</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Biaya Pemulihan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Biaya</th>
                <th class="text-center">Nilai (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Biaya Pemulihan Ekosistem</td>
                <td class="text-right">{{ number_format($getCategoryItem('biaya_pemulihan_ekosistem')?->jumlah ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Monitoring Lingkungan</td>
                <td class="text-right">{{ number_format($getCategoryItem('biaya_monitoring_lingkungan')?->jumlah ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Pelatihan Pengelolaan Lingkungan</td>
                <td class="text-right">{{ number_format($getCategoryItem('biaya_pelatihan_lingkungan')?->jumlah ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td>Total Biaya Pemulihan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Rekapitulasi Dampak Sektor Lingkungan</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 60%">Kategori</th>
                <th class="text-center">Nilai (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Kerusakan (Ekosistem Daratan + Laut + Udara)</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Kerugian (Jasa Lingkungan + Pencemaran + Pemulihan)</td>
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
