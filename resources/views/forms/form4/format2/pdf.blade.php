<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Formulir 04 - Format 2</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 15mm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: middle;
        }

        th {
            text-align: center;
        }

        .no-border,
        .no-border td {
            border: none;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h3,
        .header h4 {
            margin: 2px 0;
        }

        .info {
            margin-bottom: 10px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    @php
        $items = $formulir->items;

        /*
    |--------------------------------------------------------------------------
    | Helper mengambil item
    |--------------------------------------------------------------------------
    */
        $getItem = function ($kategori, $subKategori = null, $tingkatKerusakan = null) use ($items) {
            return $items->first(function ($item) use ($kategori, $subKategori, $tingkatKerusakan) {
                return $item->kategori === $kategori && $item->sub_kategori === $subKategori && $item->tingkat_kerusakan === $tingkatKerusakan;
            });
        };

        $getValue = function ($kategori, $subKategori = null, $tingkatKerusakan = null, $field = 'jumlah') use ($getItem) {
            $item = $getItem($kategori, $subKategori, $tingkatKerusakan);

            return $item?->{$field} ?? 0;
        };

        /*
    |--------------------------------------------------------------------------
    | Daftar kategori pendidikan
    |--------------------------------------------------------------------------
    */
        $pendidikan = [
            'tk' => 'TK/RA',
            'sd' => 'SD/MI',
            'smp' => 'SMP/MTS',
            'sma' => 'SMA/MA',
            'smk' => 'SMK',
            'pt' => 'Perguruan Tinggi',
            'perpus' => 'Perpustakaan',
            'lab' => 'Laboratorium',
            'lainnya' => 'Lainnya',
        ];
    @endphp

    <div class="header">
        <h3>FORMULIR 04</h3>
        <h4>FORMAT 2 - SEKTOR PENDIDIKAN</h4>
    </div>

    <table class="no-border info">
        <tr>
            <td width="15%">Nama Kampung</td>
            <td width="35%">: {{ $formulir->nama_kampung }}</td>

            <td width="15%">Nama Distrik</td>
            <td width="35%">: {{ $formulir->nama_distrik }}</td>
        </tr>
    </table>

    <div class="section-title">
        A. DATA KERUSAKAN SARANA PENDIDIKAN
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="3" width="15%">Jenis Bangunan</th>
                <th colspan="6">Tingkat Kerusakan</th>
                <th rowspan="3" width="12%">Dimensi</th>
                <th rowspan="3" width="12%">Harga Satuan</th>
            </tr>

            <tr>
                <th colspan="2">Berat</th>
                <th colspan="2">Sedang</th>
                <th colspan="2">Ringan</th>
            </tr>

            <tr>
                <th>Negeri</th>
                <th>Swasta</th>
                <th>Negeri</th>
                <th>Swasta</th>
                <th>Negeri</th>
                <th>Swasta</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($pendidikan as $kategori => $nama)
                @php
                    /*
                | Ambil dimensi dan harga satuan dari salah satu item
                | kategori tersebut.
                */
                    $referensiItem = $items->first(function ($item) use ($kategori) {
                        return $item->kategori === $kategori;
                    });

                    $dimensi = $referensiItem?->dimensi ?? 0;
                    $hargaSatuan = $referensiItem?->harga_satuan ?? 0;
                @endphp

                <tr>
                    <td>
                        {{ $nama }}
                    </td>

                    {{-- Berat Negeri --}}
                    <td class="text-center">
                        {{ $getValue($kategori, 'negeri', 'berat', 'jumlah') }}
                    </td>

                    {{-- Berat Swasta --}}
                    <td class="text-center">
                        {{ $getValue($kategori, 'swasta', 'berat', 'jumlah') }}
                    </td>

                    {{-- Sedang Negeri --}}
                    <td class="text-center">
                        {{ $getValue($kategori, 'negeri', 'sedang', 'jumlah') }}
                    </td>

                    {{-- Sedang Swasta --}}
                    <td class="text-center">
                        {{ $getValue($kategori, 'swasta', 'sedang', 'jumlah') }}
                    </td>

                    {{-- Ringan Negeri --}}
                    <td class="text-center">
                        {{ $getValue($kategori, 'negeri', 'ringan', 'jumlah') }}
                    </td>

                    {{-- Ringan Swasta --}}
                    <td class="text-center">
                        {{ $getValue($kategori, 'swasta', 'ringan', 'jumlah') }}
                    </td>

                    {{-- Dimensi --}}
                    <td class="text-center">
                        {{ $dimensi }}
                    </td>

                    {{-- Harga Satuan --}}
                    <td class="text-right">
                        Rp {{ number_format((float) $hargaSatuan, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class="section-title">
        B. DATA BIAYA LAINNYA
    </div>

    <table>
        <thead>
            <tr>
                <th width="40%">Jenis</th>
                <th width="20%">Jumlah</th>
                <th width="20%">Satuan</th>
                <th width="20%">Harga Satuan</th>
            </tr>
        </thead>

        <tbody>

            @php
                $sekolahPengungsian = $items->first(function ($item) {
                    return $item->kategori === 'sekolah_pengungsian';
                });

                $guruKorban = $items->first(function ($item) {
                    return $item->kategori === 'guru_korban';
                });

                $iuranSekolah = $items->first(function ($item) {
                    return $item->kategori === 'iuran_sekolah';
                });

                $biayaTenagaKerja = $items->first(function ($item) {
                    return $item->kategori === 'biaya_tenaga_kerja_hok';
                });

                $biayaAlatBerat = $items->first(function ($item) {
                    return $item->kategori === 'biaya_alat_berat_hari';
                });
            @endphp

            <tr>
                <td>Sekolah untuk Pengungsian</td>
                <td class="text-center">
                    {{ $sekolahPengungsian?->jumlah ?? 0 }}
                </td>
                <td class="text-center">
                    {{ $sekolahPengungsian?->satuan ?? 'unit' }}
                </td>
                <td class="text-right">
                    Rp {{ number_format((float) ($sekolahPengungsian?->harga_satuan ?? 0), 0, ',', '.') }}
                </td>
            </tr>

            <tr>
                <td>Guru Korban Bencana</td>
                <td class="text-center">
                    {{ $guruKorban?->jumlah ?? 0 }}
                </td>
                <td class="text-center">
                    {{ $guruKorban?->satuan ?? 'jiwa' }}
                </td>
                <td class="text-right">
                    Rp {{ number_format((float) ($guruKorban?->harga_satuan ?? 0), 0, ',', '.') }}
                </td>
            </tr>

            <tr>
                <td>Iuran Sekolah Swasta</td>
                <td class="text-center">
                    {{ $iuranSekolah?->jumlah ?? 0 }}
                </td>
                <td class="text-center">
                    {{ $iuranSekolah?->satuan ?? 'rp' }}
                </td>
                <td class="text-right">
                    Rp {{ number_format((float) ($iuranSekolah?->harga_satuan ?? 0), 0, ',', '.') }}
                </td>
            </tr>

            <tr>
                <td>Biaya Tenaga Kerja</td>
                <td class="text-center">
                    {{ $biayaTenagaKerja?->jumlah ?? 0 }}
                </td>
                <td class="text-center">
                    {{ $biayaTenagaKerja?->satuan ?? 'HOK' }}
                </td>
                <td class="text-right">
                    Rp {{ number_format((float) ($biayaTenagaKerja?->harga_satuan ?? 0), 0, ',', '.') }}
                </td>
            </tr>

            <tr>
                <td>Biaya Alat Berat</td>
                <td class="text-center">
                    {{ $biayaAlatBerat?->jumlah ?? 0 }}
                </td>
                <td class="text-center">
                    {{ $biayaAlatBerat?->satuan ?? 'Hari' }}
                </td>
                <td class="text-right">
                    Rp {{ number_format((float) ($biayaAlatBerat?->harga_satuan ?? 0), 0, ',', '.') }}
                </td>
            </tr>

        </tbody>
    </table>

    <div class="section-title">
        C. KETERANGAN
    </div>

    <table>
        <tr>
            <td height="60"></td>
        </tr>
    </table>

</body>

</html>
