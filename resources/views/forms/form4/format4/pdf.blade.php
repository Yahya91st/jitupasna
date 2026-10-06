<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sektor Sosial - {{ $formulir->nama_kampung }}</title>

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

    @php
        $items = $formulir->items ?? collect();

        /*
         * Ambil item berdasarkan:
         * kategori
         * sub_kategori
         * tingkat_kerusakan
         */
        $getItem = function ($kategori, $subKategori = null, $tingkatKerusakan = null) use ($items) {
            return $items->first(function ($item) use ($kategori, $subKategori, $tingkatKerusakan) {
                return $item->kategori === $kategori && $item->sub_kategori === $subKategori && $item->tingkat_kerusakan === $tingkatKerusakan;
            });
        };

        /*
         * Ambil item berdasarkan kategori saja
         */
        $getCategoryItem = function ($kategori) use ($items) {
            return $items->first(function ($item) use ($kategori) {
                return $item->kategori === $kategori;
            });
        };

        /*
         * Ambil item berdasarkan kategori + sub kategori
         */
        $getSubCategoryItem = function ($kategori, $subKategori) use ($items) {
            return $items->first(function ($item) use ($kategori, $subKategori) {
                return $item->kategori === $kategori && $item->sub_kategori === $subKategori;
            });
        };

        /*
         * Daftar fasilitas sosial Format 4
         */
        $fasilitas = [
            'panti_asuhan' => 'Panti Asuhan',
            'panti_wredha' => 'Panti Wredha',
            'panti_tuna_grahita' => 'Panti Tuna Grahita',
            'lainnya' => 'Lainnya',
        ];

        /*
         * Bencana
         */
        $bencanaNama = optional($bencana->kategori_bencana)->nama;

        /*
         * Data kerugian
         */
        $tenagaKerja = $getCategoryItem('tenaga_kerja');
        $alatBerat = $getCategoryItem('alat_berat');
        $pengungsi = $getCategoryItem('pengungsi');

        $pelayananKesehatan = $getCategoryItem('pelayanan_kesehatan');
        $pelayananPendidikan = $getCategoryItem('pelayanan_pendidikan');
        $pendampinganPsikososial = $getCategoryItem('pendampingan_psikososial');
        $pelatihanDarurat = $getCategoryItem('pelatihan_darurat');
    @endphp

    <div class="header">
        <h1>FORMULIR 04 - PENGUMPULAN DATA SEKTOR</h1>
        <h2>FORMAT 4: PENGUMPULAN DATA SEKTOR SOSIAL</h2>
    </div>

    <table class="info-table">
        <tr>
            <th>Bencana</th>
            <td>{{ $bencanaNama }}</td>

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

    <h3>A. Data Kerusakan Fasilitas Sosial</h3>

    <table>
        <thead>
            <tr>
                <th rowspan="2" class="text-center">
                    Jenis Fasilitas Sosial
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
                    Harga Meubelair<br>
                    (Rp/unit)
                </th>

                <th rowspan="2" class="text-center">
                    Harga Obat<br>
                    (Rp)
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

            @foreach ($fasilitas as $kategori => $namaFasilitas)
                @php
                    $berat = $getItem($kategori, 'negeri', 'berat');
                    $sedang = $getItem($kategori, 'negeri', 'sedang');
                    $ringan = $getItem($kategori, 'negeri', 'ringan');

                    /*
                     * Cari item yang memiliki dimensi.
                     */
                    $itemDimensi = $items->first(function ($item) use ($kategori) {
                        return $item->kategori === $kategori && !is_null($item->dimensi);
                    });

                    /*
                     * Harga berdasarkan sub_kategori
                     */
                    $hargaBangunan = $getSubCategoryItem($kategori, 'bangunan');

                    $hargaObat = $getSubCategoryItem($kategori, 'obat');

                    $hargaMeubelair = $getSubCategoryItem($kategori, 'meubelair');

                    $hargaPeralatan = $getSubCategoryItem($kategori, 'peralatan');
                @endphp

                <tr>
                    <td>
                        {{ $namaFasilitas }}
                    </td>

                    <td class="text-center">
                        {{ $berat->jumlah ?? 0 }}
                    </td>

                    <td class="text-center">
                        {{ $sedang->jumlah ?? 0 }}
                    </td>

                    <td class="text-center">
                        {{ $ringan->jumlah ?? 0 }}
                    </td>

                    <td class="text-center">
                        {{ $itemDimensi->dimensi ?? 0 }}
                    </td>

                    <td class="text-right">
                        {{ number_format($hargaBangunan->harga_satuan ?? 0, 0, ',', '.') }}
                    </td>

                    <td class="text-right">
                        {{ number_format($hargaPeralatan->harga_satuan ?? 0, 0, ',', '.') }}
                    </td>

                    <td class="text-right">
                        {{ number_format($hargaMeubelair->harga_satuan ?? 0, 0, ',', '.') }}
                    </td>

                    <td class="text-right">
                        {{ number_format($hargaObat->harga_satuan ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <h3>B. Data Kerugian Sektor Sosial</h3>

    <table>
        <tr>
            <th class="text-center">
                Biaya Tenaga Kerja
            </th>

            <td class="text-center">
                {{ $tenagaKerja->jumlah ?? 0 }} HOK
            </td>

            <th class="text-center">
                Biaya per HOK (Rp)
            </th>

            <td class="text-right">
                {{ number_format($tenagaKerja->harga_satuan ?? 0, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <th class="text-center">
                Biaya Alat Berat
            </th>

            <td class="text-center">
                {{ $alatBerat->jumlah ?? 0 }} Hari
            </td>

            <th class="text-center">
                Biaya per Hari (Rp)
            </th>

            <td class="text-right">
                {{ number_format($alatBerat->harga_satuan ?? 0, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <th class="text-center">
                Jumlah Pengungsi
            </th>

            <td class="text-center">
                {{ $pengungsi->jumlah ?? 0 }} Orang
            </td>

            <th class="text-center">
                Bantuan per Orang (Rp)
            </th>

            <td class="text-right">
                {{ number_format($pengungsi->harga_satuan ?? 0, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <th class="text-center">
                Biaya Pelayanan Kesehatan
            </th>

            <td colspan="3" class="text-right">
                {{ number_format($pelayananKesehatan->jumlah ?? 0, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <th class="text-center">
                Biaya Pelayanan Pendidikan
            </th>

            <td colspan="3" class="text-right">
                {{ number_format($pelayananPendidikan->jumlah ?? 0, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <th class="text-center">
                Biaya Pendampingan Psikososial
            </th>

            <td colspan="3" class="text-right">
                {{ number_format($pendampinganPsikososial->jumlah ?? 0, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <th class="text-center">
                Biaya Pelatihan Darurat
            </th>

            <td colspan="3" class="text-right">
                {{ number_format($pelatihanDarurat->jumlah ?? 0, 0, ',', '.') }}
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

            <p>
                ___________________________
            </p>

            <p>
                NIP.
            </p>
        </div>
    </div>

</body>

</html>
