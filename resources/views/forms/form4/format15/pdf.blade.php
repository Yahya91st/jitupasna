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
    <title>Form Sektor Pariwisata - {{ $formulir->nama_kampung }}</title>
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
        <h2>FORMAT 15: PENGUMPULAN DATA SEKTOR PARIWISATA</h2>
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

    <h3>Data Kerusakan Bangunan Sektor Pariwisata</h3>
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
                <td>Hotel/Penginapan</td>
                <td class="text-center">{{ $getItem('hotel_restaurant', 'fasilitas', 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('hotel_restaurant', 'fasilitas', 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('hotel_restaurant', 'fasilitas', 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('hotel_restaurant', 'fasilitas')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('hotel_restaurant', 'fasilitas')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Restoran/Rumah Makan</td>
                <td class="text-center">{{ $getItem('hotel_restaurant', 'fasilitas', 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('hotel_restaurant', 'fasilitas', 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('hotel_restaurant', 'fasilitas', 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('hotel_restaurant', 'fasilitas')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('hotel_restaurant', 'fasilitas')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Objek Wisata</td>
                <td class="text-center">{{ $getItem('tempat_wisata', 'fasilitas', 'berat')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('tempat_wisata', 'fasilitas', 'sedang')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ $getItem('tempat_wisata', 'fasilitas', 'ringan')?->jumlah ?? 0 }}</td>
                <td class="text-center">{{ number_format($getDimensi($getCategoryItem('tempat_wisata', 'fasilitas')), 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($getCategoryItem('tempat_wisata', 'fasilitas')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
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

    <h3>Data Kerusakan Peralatan Pariwisata</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Peralatan</th>
                <th class="text-center">Nilai Kerusakan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Peralatan Hotel/Penginapan</td>
                <td class="text-right">{{ number_format($getCategoryItem('hotel_restaurant', 'fasilitas')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Peralatan Restoran/Rumah Makan</td>
                <td class="text-right">{{ number_format($getCategoryItem('hotel_restaurant', 'fasilitas')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Peralatan Objek Wisata</td>
                <td class="text-right">{{ number_format($getCategoryItem('tempat_wisata', 'fasilitas')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
            </tr>
            @if ($getCategoryItem('lainnya_jenis_peralatan')?->jumlah ?? 0)
                <tr>
                    <td>{{ $getCategoryItem('lainnya_jenis_peralatan')?->jumlah ?? 0 }}</td>
                    <td class="text-right">{{ number_format($getCategoryItem('lainnya_peralatan')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                </tr>
            @endif
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td>Total Kerusakan Peralatan</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Data Kerugian Gangguan Usaha</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">Jenis Usaha</th>
                <th class="text-center" colspan="3">Parameter</th>
                <th class="text-center">Nilai Kerugian (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="3">Hotel/Penginapan</td>
                <td>Jumlah Kamar: {{ $getCategoryItem('hotel_jumlah_kamar')?->jumlah ?? 0 }}</td>
                <td>Tarif: Rp {{ number_format($getCategoryItem('hotel_restaurant', 'fasilitas')?->harga_satuan ?? 0, 0, ',', '.') }}/kamar</td>
                <td>Durasi: {{ $getCategoryItem('hotel_durasi')?->durasi ?? 0 }} hari</td>
                <td class="text-right" rowspan="3">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3">Okupansi: {{ $getCategoryItem('hotel_okupansi')?->jumlah ?? 0 }}%</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td rowspan="2">Restoran/Rumah Makan</td>
                <td>Pengunjung/hari: {{ $getCategoryItem('restoran_jumlah_pengunjung_per')?->durasi ?? 0 }}</td>
                <td>Pengeluaran/pengunjung: Rp {{ number_format($getCategoryItem('hotel_restaurant', 'fasilitas')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td>Durasi: {{ $getCategoryItem('restoran_durasi')?->durasi ?? 0 }} hari</td>
                <td class="text-right" rowspan="2">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td rowspan="2">Objek Wisata</td>
                <td>Pengunjung/hari: {{ $getCategoryItem('objek_wisata_jumlah_pengunjung_per')?->durasi ?? 0 }}</td>
                <td>Harga Tiket: Rp {{ number_format($getCategoryItem('tempat_wisata', 'fasilitas')?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                <td>Durasi: {{ $getCategoryItem('objek_wisata_durasi')?->durasi ?? 0 }} hari</td>
                <td class="text-right" rowspan="2">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="4">Total Kerugian Gangguan Usaha</td>
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
                <td>Tenaga Kerja: {{ $getCategoryItem('biaya_tenaga_kerja')?->harga_satuan ?? 0 }} HOK @ Rp {{ number_format($getCategoryItem('biaya_tenaga_kerja_upah')?->jumlah ?? 0, 0, ',', '.') }}/HOK</td>
                <td class="text-right">{{ number_format(($getCategoryItem('biaya_tenaga_kerja')?->harga_satuan ?? 0) * ($getCategoryItem('biaya_tenaga_kerja_upah')?->jumlah ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Alat Berat: {{ $getCategoryItem('biaya_alat_berat')?->durasi ?? 0 }} hari @ Rp {{ number_format($getCategoryItem('biaya_alat_berat')?->harga_satuan ?? 0, 0, ',', '.') }}/hari</td>
                <td class="text-right">{{ number_format(($getCategoryItem('biaya_alat_berat')?->durasi ?? 0) * ($getCategoryItem('biaya_alat_berat')?->harga_satuan ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Promosi Pemulihan</td>
                <td>Promosi untuk menarik kembali wisatawan</td>
                <td class="text-right">{{ number_format($getCategoryItem('biaya_promosi_pemulihan')?->jumlah ?? (0 ?? 0), 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="2">Total Kerugian Lainnya</td>
                <td class="text-right">{{ number_format($items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)) + $items->sum(fn($item) => (float) ($item->jumlah ?? 0) * (float) ($item->harga_satuan ?? 0)), 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Rekapitulasi Dampak Sektor Pariwisata</h3>
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
                <td>Total Kerugian (Gangguan Usaha + Pembersihan + Promosi)</td>
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
