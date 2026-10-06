<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Kesehatan - {{ $formulir->nama_kampung }}</title>

    ```
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
    ```

</head>

<body>

    ```
    @php
        /*
    |--------------------------------------------------------------------------
    | DATA FORMULIR
    |--------------------------------------------------------------------------
    */

        $items = $formulir->items;

        /*
    |--------------------------------------------------------------------------
    | HELPER ITEM KERUSAKAN
    |--------------------------------------------------------------------------
    */

        $getDamageItem = function ($kategori, $subKategori, $tingkatKerusakan) use ($items) {
            return $items->first(function ($item) use ($kategori, $subKategori, $tingkatKerusakan) {
                return $item->kategori === $kategori && $item->sub_kategori === $subKategori && $item->tingkat_kerusakan === $tingkatKerusakan;
            });
        };

        /*
    |--------------------------------------------------------------------------
    | HELPER ITEM BERDASARKAN KATEGORI + SUB KATEGORI
    |--------------------------------------------------------------------------
    */

        $getCategoryItem = function ($kategori, $subKategori = null) use ($items) {
            return $items->first(function ($item) use ($kategori, $subKategori) {
                return $item->kategori === $kategori && $item->sub_kategori === $subKategori;
            });
        };

        /*
    |--------------------------------------------------------------------------
    | HELPER JUMLAH KERUSAKAN
    |--------------------------------------------------------------------------
    */

        $getDamageValue = function ($kategori, $tingkatKerusakan) use ($getDamageItem) {
            $negeri = $getDamageItem($kategori, 'negeri', $tingkatKerusakan);
            $swasta = $getDamageItem($kategori, 'swasta', $tingkatKerusakan);

            return (float) ($negeri?->jumlah ?? 0) + (float) ($swasta?->jumlah ?? 0);
        };

        /*
    |--------------------------------------------------------------------------
    | HELPER DIMENSI
    |--------------------------------------------------------------------------
    */

        $getDimensi = function ($kategori) use ($items) {
            $item = $items->first(function ($item) use ($kategori) {
                return $item->kategori === $kategori && $item->dimensi !== null;
            });

            return $item?->dimensi ?? 0;
        };

        /*
    |--------------------------------------------------------------------------
    | HELPER HARGA
    |--------------------------------------------------------------------------
    */

        $getHarga = function ($kategori, $subKategori) use ($getCategoryItem) {
            $item = $getCategoryItem($kategori, $subKategori);

            return $item?->harga_satuan ?? 0;
        };

        /*
    |--------------------------------------------------------------------------
    | HELPER DATA KERUGIAN
    |--------------------------------------------------------------------------
    */

        $getLossItem = function ($kategori) use ($items) {
            return $items->first(function ($item) use ($kategori) {
                return $item->kategori === $kategori && $item->sub_kategori === null;
            });
        };

        /*
    |--------------------------------------------------------------------------
    | FORMAT RUPIAH
    |--------------------------------------------------------------------------
    */

        $rupiah = function ($value) {
            return number_format((float) ($value ?? 0), 0, ',', '.');
        };
    @endphp

    <div class="header">
        <h1>FORMULIR 04 - PENGUMPULAN DATA SEKTOR</h1>
        <h2>FORMAT 3: PENGUMPULAN DATA SEKTOR KESEHATAN</h2>
    </div>

    <table class="info-table">
        <tr>
            <th>Bencana</th>
            <td>
                {{ $bencana->jenis_bencana ?? '-' }}
            </td>

            <th>Tanggal</th>
            <td>
                {{ $bencana->tanggal ?? '-' }}
            </td>
        </tr>

        <tr>
            <th>Kampung</th>
            <td>
                {{ $formulir->nama_kampung ?? '-' }}
            </td>

            <th>Distrik</th>
            <td>
                {{ $formulir->nama_distrik ?? '-' }}
            </td>
        </tr>
    </table>

    <h3>A. Data Kerusakan Fasilitas Kesehatan</h3>

    <table>
        <thead>
            <tr>
                <th rowspan="2" class="text-center">
                    Jenis Fasilitas Kesehatan
                </th>

                <th colspan="3" class="text-center">
                    Jumlah Kerusakan
                </th>

                <th rowspan="2" class="text-center">
                    Ukuran Rata-rata (m²)
                </th>

                <th rowspan="2" class="text-center">
                    Harga Bangunan<br>
                    (Rp/m²)
                </th>

                <th rowspan="2" class="text-center">
                    Harga Peralatan<br>
                    (Rp/unit)
                </th>

                <th rowspan="2" class="text-center">
                    Harga Obat-obatan<br>
                    (Rp/unit)
                </th>

                <th rowspan="2" class="text-center">
                    Harga Meubelair<br>
                    (Rp/unit)
                </th>
            </tr>

            <tr>
                <th class="text-center">
                    Rusak Berat
                </th>

                <th class="text-center">
                    Rusak Sedang
                </th>

                <th class="text-center">
                    Rusak Ringan
                </th>
            </tr>
        </thead>

        <tbody>

            @php
                $faskes = [
                    'rs' => 'Rumah Sakit',
                    'puskesmas' => 'Puskesmas',
                    'poliklinik' => 'Poliklinik/Tempat Praktek Bersama',
                    'pustu' => 'Puskesmas Pembantu',
                    'polindes' => 'Polindes',
                    'posyandu' => 'Posyandu',
                ];
            @endphp

            @foreach ($faskes as $kategori => $label)
                <tr>

                    <td>
                        {{ $label }}
                    </td>

                    {{-- RUSAK BERAT --}}
                    <td class="text-center">
                        {{ $getDamageValue($kategori, 'berat') }}
                    </td>

                    {{-- RUSAK SEDANG --}}
                    <td class="text-center">
                        {{ $getDamageValue($kategori, 'sedang') }}
                    </td>

                    {{-- RUSAK RINGAN --}}
                    <td class="text-center">
                        {{ $getDamageValue($kategori, 'ringan') }}
                    </td>

                    {{-- DIMENSI --}}
                    <td class="text-center">
                        {{ $getDimensi($kategori) }}
                    </td>

                    {{-- BANGUNAN --}}
                    <td class="text-right">
                        Rp {{ $rupiah($getHarga($kategori, 'bangunan')) }}
                    </td>

                    {{-- PERALATAN --}}
                    <td class="text-right">
                        Rp {{ $rupiah($getHarga($kategori, 'peralatan')) }}
                    </td>

                    {{-- OBAT --}}
                    <td class="text-right">
                        Rp {{ $rupiah($getHarga($kategori, 'obat')) }}
                    </td>

                    {{-- MEUBELAIR --}}
                    <td class="text-right">
                        Rp {{ $rupiah($getHarga($kategori, 'meubelair')) }}
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>

    <h3>B. Data Kerugian Sektor Kesehatan</h3>

    <table>

        <tr>
            <th class="text-center">
                Jumlah Tenaga Kerja
            </th>

            <td class="text-center">
                {{ $getLossItem('tenaga_kerja')?->jumlah ?? 0 }}
            </td>

            <th class="text-center">
                Upah/HOK (Rp)
            </th>

            <td class="text-center">
                {{ $rupiah($getLossItem('tenaga_kerja')?->harga_satuan ?? 0) }}
            </td>
        </tr>

        <tr>
            <th class="text-center">
                Jumlah Hari Alat Berat
            </th>

            <td class="text-center">
                {{ $getLossItem('alat_berat')?->jumlah ?? 0 }}
            </td>

            <th class="text-center">
                Tarif Alat Berat/Hari (Rp)
            </th>

            <td class="text-center">
                {{ $rupiah($getLossItem('alat_berat')?->harga_satuan ?? 0) }}
            </td>
        </tr>

        <tr>
            <th class="text-center">
                Jumlah Jenazah
            </th>

            <td class="text-center">
                {{ $getLossItem('jenazah')?->jumlah ?? 0 }}
            </td>

            <th class="text-center">
                Biaya Per Jenazah (Rp)
            </th>

            <td class="text-center">
                {{ $rupiah($getLossItem('jenazah')?->harga_satuan ?? 0) }}
            </td>
        </tr>

        <tr>
            <th class="text-center">
                Jumlah Pasien Dirawat
            </th>

            <td class="text-center">
                {{ $getLossItem('pasien')?->jumlah ?? 0 }}
            </td>

            <th class="text-center">
                Biaya Per Pasien (Rp)
            </th>

            <td class="text-center">
                {{ $rupiah($getLossItem('pasien')?->harga_satuan ?? 0) }}
            </td>
        </tr>

        <tr>
            <th class="text-center">
                Jumlah Fasilitas Kesehatan Sementara
            </th>

            <td class="text-center">
                {{ $getLossItem('faskes')?->jumlah ?? 0 }}
            </td>

            <th class="text-center">
                Biaya Pengadaan Per Unit (Rp)
            </th>

            <td class="text-center">
                {{ $rupiah($getLossItem('faskes')?->harga_satuan ?? 0) }}
            </td>
        </tr>

        <tr>
            <th class="text-center">
                Jumlah Korban Ditangani Psikologis
            </th>

            <td class="text-center">
                {{ $getLossItem('psikologis')?->jumlah ?? 0 }}
            </td>

            <th class="text-center">
                Biaya Penanganan Per Orang (Rp)
            </th>

            <td class="text-center">
                {{ $rupiah($getLossItem('psikologis')?->harga_satuan ?? 0) }}
            </td>
        </tr>

        <tr>
            <th class="text-center">
                Biaya Pencegahan Penyakit Menular (Rp)
            </th>

            <td colspan="3" class="text-center">
                {{ $rupiah($getLossItem('pencegahan_penyakit')?->jumlah ?? 0) }}
            </td>
        </tr>

        <tr>
            <th class="text-center">
                Jumlah Tenaga Kesehatan
            </th>

            <td class="text-center">
                {{ $getLossItem('tenaga_kesehatan')?->jumlah ?? 0 }}
            </td>

            <th class="text-center">
                Honorarium Per Orang (Rp)
            </th>

            <td class="text-center">
                {{ $rupiah($getLossItem('tenaga_kesehatan')?->harga_satuan ?? 0) }}
            </td>
        </tr>

        <tr>
            <th class="text-center">
                Honorarium Tenaga Kesehatan (Rp)
            </th>

            <td colspan="3" class="text-center">
                {{ $rupiah($getLossItem('honorarium_tenaga_kesehatan')?->jumlah ?? 0) }}
            </td>
        </tr>

        <tr>
            <th class="text-center">
                Pendapatan Faskes Swasta/Bulan (Rp)
            </th>

            <td colspan="3" class="text-center">
                {{ $rupiah($getLossItem('pendapatan_faskes_swasta')?->jumlah ?? 0) }}
            </td>
        </tr>

    </table>

    <div class="footer">
        <p>
            {{ $formulir->nama_distrik }},
            {{ now()->format('d F Y') }}
        </p>

        <div class="footer-sign">
            <p>Petugas</p>

            <br>
            <br>
            <br>

            <p>___________________________</p>
            <p>NIP.</p>
        </div>
    </div>
    ```

</body>

</html>
