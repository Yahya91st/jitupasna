@extends('layouts.main')

@section('content')

    <style>
        .table th,
        .table td {
            padding: 0.25rem 0.3rem !important;
            vertical-align: middle !important;
            text-align: center;
        }

        .table input.form-control {
            padding: 0.15rem 0.3rem !important;
            font-size: 0.95rem;
        }

        .input-group-text {
            padding: 0.2rem 0.5rem !important;
            font-size: 0.9rem;
        }
    </style>

    @php
        /*
        |--------------------------------------------------------------------------
        | DATA FORMULIR
        |--------------------------------------------------------------------------
        */

        $items = isset($formulir) ? $formulir->items : collect();

        /*
        |--------------------------------------------------------------------------
        | HELPER MENGAMBIL ITEM
        |--------------------------------------------------------------------------
        */

        $getItem = function ($kategori, $subKategori = null, $tingkatKerusakan = null) use ($items) {
            return $items->first(function ($item) use ($kategori, $subKategori, $tingkatKerusakan) {
                return $item->kategori === $kategori && $item->sub_kategori === $subKategori && $item->tingkat_kerusakan === $tingkatKerusakan;
            });
        };

        /*
        |--------------------------------------------------------------------------
        | HELPER MENGAMBIL ITEM BERDASARKAN KATEGORI SAJA
        |--------------------------------------------------------------------------
        */

        $getCategoryItem = function ($kategori) use ($items) {
            return $items->first(function ($item) use ($kategori) {
                return $item->kategori === $kategori;
            });
        };

        /*
        |--------------------------------------------------------------------------
        | HELPER MENGAMBIL NILAI
        |--------------------------------------------------------------------------
        */

        $getValue = function ($kategori, $subKategori = null, $tingkatKerusakan = null, $field = 'jumlah') use ($getItem) {
            $item = $getItem($kategori, $subKategori, $tingkatKerusakan);

            return $item?->{$field} ?? '';
        };

        /*
        |--------------------------------------------------------------------------
        | HELPER FORMAT RUPIAH
        |--------------------------------------------------------------------------
        */

        $rupiah = function ($value) {
            return number_format((float) ($value ?? 0), 0, ',', '.');
        };

        /*
        |--------------------------------------------------------------------------
        | DATA FASKES
        |--------------------------------------------------------------------------
        */

        $faskes = [
            'rs' => 'Rumah Sakit',
            'puskesmas' => 'Puskesmas',
            'poliklinik' => 'Poliklinik/Tempat Praktek Bersama',
            'pustu' => 'Puskesmas Pembantu',
            'polindes' => 'Polindes',
            'posyandu' => 'Posyandu',
        ];

        /*
        |--------------------------------------------------------------------------
        | DATA KERUGIAN
        |--------------------------------------------------------------------------
        */

        $kerugian = [
            [
                'judul' => '1. BIAYA PEMBERSIHAN PUING',
                'fields' => [
                    [
                        'label' => 'A. Biaya Tenaga Kerja',
                        'kategori' => 'tenaga_kerja',
                        'jumlah_field' => 'jumlah',
                        'harga_field' => 'harga_satuan',
                        'addon1' => 'HOK',
                        'addon2' => 'Rp',
                    ],
                    [
                        'label' => 'B. Biaya Alat Berat',
                        'kategori' => 'alat_berat',
                        'jumlah_field' => 'jumlah',
                        'harga_field' => 'harga_satuan',
                        'addon1' => 'Hari',
                        'addon2' => 'Rp',
                    ],
                ],
            ],

            [
                'judul' => '2. BIAYA PEMULASARAAN JENAZAH',
                'fields' => [
                    [
                        'label' => 'Jumlah Jenazah',
                        'kategori' => 'jenazah',
                        'jumlah_field' => 'jumlah',
                        'harga_field' => 'harga_satuan',
                        'addon1' => 'Jenazah',
                        'addon2' => 'Rp',
                    ],
                ],
            ],

            [
                'judul' => '3. BIAYA PERAWATAN KORBAN BENCANA',
                'fields' => [
                    [
                        'label' => 'Jumlah Korban Dirawat',
                        'kategori' => 'pasien',
                        'jumlah_field' => 'jumlah',
                        'harga_field' => 'harga_satuan',
                        'addon1' => 'Orang',
                        'addon2' => 'Rp',
                    ],
                ],
            ],

            [
                'judul' => '4. FASILITAS KESEHATAN SEMENTARA',
                'fields' => [
                    [
                        'label' => 'Jumlah Unit',
                        'kategori' => 'faskes',
                        'jumlah_field' => 'jumlah',
                        'harga_field' => 'harga_satuan',
                        'addon1' => 'Unit',
                        'addon2' => 'Rp',
                    ],
                ],
            ],

            [
                'judul' => '5. BIAYA PENANGANAN PSIKOLOGIS KORBAN BENCANA',
                'fields' => [
                    [
                        'label' => 'Jumlah Korban',
                        'kategori' => 'psikologis',
                        'jumlah_field' => 'jumlah',
                        'harga_field' => 'harga_satuan',
                        'addon1' => 'Orang',
                        'addon2' => 'Rp',
                    ],
                ],
            ],

            [
                'judul' => '6. PENCEGAHAN PENYAKIT',
                'fields' => [
                    [
                        'label' => 'Biaya Pencegahan Penyakit Menular',
                        'kategori' => 'pencegahan_penyakit',
                        'jumlah_field' => 'jumlah',
                        'harga_field' => null,
                        'addon1' => 'Rp',
                        'single' => true,
                    ],
                ],
            ],

            [
                'judul' => '7. TENAGA KESEHATAN',
                'fields' => [
                    [
                        'label' => 'Jumlah Tenaga Kesehatan',
                        'kategori' => 'tenaga_kesehatan',
                        'jumlah_field' => 'jumlah',
                        'harga_field' => 'harga_satuan',
                        'addon1' => 'Orang',
                        'addon2' => 'Rp',
                    ],
                ],
            ],

            [
                'judul' => '8. HONORARIUM TENAGA KESEHATAN',
                'fields' => [
                    [
                        'label' => 'Honorarium Tenaga Kesehatan',
                        'kategori' => 'honorarium_tenaga_kesehatan',
                        'jumlah_field' => 'jumlah',
                        'harga_field' => null,
                        'addon1' => 'Rp',
                        'single' => true,
                    ],
                ],
            ],

            [
                'judul' => '9. PENDAPATAN FASKES SWASTA',
                'fields' => [
                    [
                        'label' => 'Pendapatan Faskes Swasta/Bulan',
                        'kategori' => 'pendapatan_faskes_swasta',
                        'jumlah_field' => 'jumlah',
                        'harga_field' => null,
                        'addon1' => 'Rp',
                        'single' => true,
                    ],
                ],
            ],
        ];
    @endphp

    <div class="container mt-4">

        <h5 class="text-center fw-bold" style="color: #F28705;">
            Formulir 04<br>
            Pengkajian Kebutuhan Pasca Bencana
        </h5>

        <p class="fw-bold">
            Format 3: Sektor Kesehatan
        </p>

        <form id="format3Form" action="{{ isset($edit) && $edit ? route('forms.form4.format3.update', $formulir->id) : route('forms.form4.format3.store') }}" method="POST">

            @csrf

            @if (isset($edit) && $edit)
                @method('PATCH')
            @endif

            <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">

            {{-- ========================================================= --}}
            {{-- IDENTITAS --}}
            {{-- ========================================================= --}}

            <table class="table table-bordered">

                <tr>

                    <td style="width: 50%">

                        NAMA KAMPUNG:

                        <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $formulir->nama_kampung ?? '') }}">

                        @error('nama_kampung')
                            <div class="text-danger small">
                                {{ $message }}
                            </div>
                        @enderror

                    </td>

                    <td>

                        NAMA DISTRIK:

                        <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $formulir->nama_distrik ?? '') }}">

                        @error('nama_distrik')
                            <div class="text-danger small">
                                {{ $message }}
                            </div>
                        @enderror

                    </td>

                </tr>

            </table>

            {{-- ========================================================= --}}
            {{-- DATA KERUSAKAN FASKES --}}
            {{-- ========================================================= --}}

            <div class="table-responsive">

                <table class="table table-bordered text-center align-middle" style="width: 100%;">

                    <thead>

                        <tr>

                            <th rowspan="3" class="align-middle" style="width: 20%;">
                                Keterangan
                            </th>

                            <th colspan="6" class="text-center" style="width: 40%;">
                                Jumlah Unit yang Rusak
                            </th>

                            <th rowspan="3" class="text-center" style="width: 20%;">
                                Luas rata rata bangunan
                            </th>

                            <th colspan="4" class="text-center" style="width: 40%;">
                                HARGA SATUAN
                            </th>

                        </tr>

                        <tr>

                            <th colspan="2" class="text-center">
                                RB
                            </th>

                            <th colspan="2" class="text-center">
                                RS
                            </th>

                            <th colspan="2" class="text-center">
                                RR
                            </th>

                            <th rowspan="2" class="text-center">
                                Bangunan/m2
                            </th>

                            <th rowspan="2" class="text-center">
                                Obat-obatan
                            </th>

                            <th rowspan="2" class="text-center">
                                Meubelair
                            </th>

                            <th rowspan="2" class="text-center">
                                Peralatan Lab Dan Lainnya
                            </th>

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

                        @php
                            $index = 0;
                        @endphp

                        @foreach ($faskes as $kategori => $label)
                            @php

                                /*
                        |--------------------------------------------------------------------------
                        | ITEM KERUSAKAN
                        |--------------------------------------------------------------------------
                        */

                                $beratNegeri = $getItem($kategori, 'negeri', 'berat');

                                $beratSwasta = $getItem($kategori, 'swasta', 'berat');

                                $sedangNegeri = $getItem($kategori, 'negeri', 'sedang');

                                $sedangSwasta = $getItem($kategori, 'swasta', 'sedang');

                                $ringanNegeri = $getItem($kategori, 'negeri', 'ringan');

                                $ringanSwasta = $getItem($kategori, 'swasta', 'ringan');

                                /*
                        |--------------------------------------------------------------------------
                        | DIMENSI
                        |--------------------------------------------------------------------------
                        */

                                $dimensiItem = $items->first(function ($item) use ($kategori) {
                                    return $item->kategori === $kategori && $item->dimensi !== null;
                                });

                                /*
                        |--------------------------------------------------------------------------
                        | HARGA
                        |--------------------------------------------------------------------------
                        */

                                $hargaBangunan = $items->first(function ($item) use ($kategori) {
                                    return $item->kategori === $kategori && $item->sub_kategori === 'bangunan';
                                });

                                $hargaObat = $items->first(function ($item) use ($kategori) {
                                    return $item->kategori === $kategori && $item->sub_kategori === 'obat';
                                });

                                $hargaMeubelair = $items->first(function ($item) use ($kategori) {
                                    return $item->kategori === $kategori && $item->sub_kategori === 'meubelair';
                                });

                                $hargaPeralatan = $items->first(function ($item) use ($kategori) {
                                    return $item->kategori === $kategori && $item->sub_kategori === 'peralatan';
                                });

                            @endphp

                            <tr>

                                <td class="fw-bold">
                                    {{ $label }}
                                </td>

                                {{-- ================================================= --}}
                                {{-- RB NEGERI --}}
                                {{-- ================================================= --}}

                                <td>

                                    <input type="number" class="form-control" name="details[{{ $index }}][jumlah]" value="{{ old('details.' . $index . '.jumlah', $beratNegeri->jumlah ?? '') }}">

                                    <input type="hidden" name="details[{{ $index }}][kategori]" value="{{ $kategori }}">

                                    <input type="hidden" name="details[{{ $index }}][sub_kategori]" value="negeri">

                                    <input type="hidden" name="details[{{ $index }}][tingkat_kerusakan]" value="berat">

                                    <input type="hidden" name="details[{{ $index }}][kriteria_id]" value="2">

                                    <input type="hidden" name="details[{{ $index }}][satuan]" value="unit">

                                </td>

                                @php $index++; @endphp

                                {{-- ================================================= --}}
                                {{-- RB SWASTA --}}
                                {{-- ================================================= --}}

                                <td>

                                    <input type="number" class="form-control" name="details[{{ $index }}][jumlah]" value="{{ old('details.' . $index . '.jumlah', $beratSwasta->jumlah ?? '') }}">

                                    <input type="hidden" name="details[{{ $index }}][kategori]" value="{{ $kategori }}">

                                    <input type="hidden" name="details[{{ $index }}][sub_kategori]" value="swasta">

                                    <input type="hidden" name="details[{{ $index }}][tingkat_kerusakan]" value="berat">

                                    <input type="hidden" name="details[{{ $index }}][kriteria_id]" value="2">

                                    <input type="hidden" name="details[{{ $index }}][satuan]" value="unit">

                                </td>

                                @php $index++; @endphp

                                {{-- ================================================= --}}
                                {{-- RS NEGERI --}}
                                {{-- ================================================= --}}

                                <td>

                                    <input type="number" class="form-control" name="details[{{ $index }}][jumlah]" value="{{ old('details.' . $index . '.jumlah', $sedangNegeri->jumlah ?? '') }}">

                                    <input type="hidden" name="details[{{ $index }}][kategori]" value="{{ $kategori }}">

                                    <input type="hidden" name="details[{{ $index }}][sub_kategori]" value="negeri">

                                    <input type="hidden" name="details[{{ $index }}][tingkat_kerusakan]" value="sedang">

                                    <input type="hidden" name="details[{{ $index }}][kriteria_id]" value="3">

                                    <input type="hidden" name="details[{{ $index }}][satuan]" value="unit">

                                </td>

                                @php $index++; @endphp

                                {{-- ================================================= --}}
                                {{-- RS SWASTA --}}
                                {{-- ================================================= --}}

                                <td>

                                    <input type="number" class="form-control" name="details[{{ $index }}][jumlah]" value="{{ old('details.' . $index . '.jumlah', $sedangSwasta->jumlah ?? '') }}">

                                    <input type="hidden" name="details[{{ $index }}][kategori]" value="{{ $kategori }}">

                                    <input type="hidden" name="details[{{ $index }}][sub_kategori]" value="swasta">

                                    <input type="hidden" name="details[{{ $index }}][tingkat_kerusakan]" value="sedang">

                                    <input type="hidden" name="details[{{ $index }}][kriteria_id]" value="3">

                                    <input type="hidden" name="details[{{ $index }}][satuan]" value="unit">

                                </td>

                                @php $index++; @endphp

                                {{-- ================================================= --}}
                                {{-- RR NEGERI --}}
                                {{-- ================================================= --}}

                                <td>

                                    <input type="number" class="form-control" name="details[{{ $index }}][jumlah]" value="{{ old('details.' . $index . '.jumlah', $ringanNegeri->jumlah ?? '') }}">

                                    <input type="hidden" name="details[{{ $index }}][kategori]" value="{{ $kategori }}">

                                    <input type="hidden" name="details[{{ $index }}][sub_kategori]" value="negeri">

                                    <input type="hidden" name="details[{{ $index }}][tingkat_kerusakan]" value="ringan">

                                    <input type="hidden" name="details[{{ $index }}][kriteria_id]" value="4">

                                    <input type="hidden" name="details[{{ $index }}][satuan]" value="unit">

                                </td>

                                @php $index++; @endphp

                                {{-- ================================================= --}}
                                {{-- RR SWASTA --}}
                                {{-- ================================================= --}}

                                <td>

                                    <input type="number" class="form-control" name="details[{{ $index }}][jumlah]" value="{{ old('details.' . $index . '.jumlah', $ringanSwasta->jumlah ?? '') }}">

                                    <input type="hidden" name="details[{{ $index }}][kategori]" value="{{ $kategori }}">

                                    <input type="hidden" name="details[{{ $index }}][sub_kategori]" value="swasta">

                                    <input type="hidden" name="details[{{ $index }}][tingkat_kerusakan]" value="ringan">

                                    <input type="hidden" name="details[{{ $index }}][kriteria_id]" value="4">

                                    <input type="hidden" name="details[{{ $index }}][satuan]" value="unit">

                                </td>

                                @php $index++; @endphp

                                {{-- ================================================= --}}
                                {{-- DIMENSI --}}
                                {{-- ================================================= --}}

                                <td>

                                    <input type="number" class="form-control" name="dimensi[{{ $kategori }}]" value="{{ old('dimensi.' . $kategori, $dimensiItem->dimensi ?? '') }}">

                                </td>

                                {{-- ================================================= --}}
                                {{-- HARGA BANGUNAN --}}
                                {{-- ================================================= --}}

                                <td>

                                    <input type="number" class="form-control" name="harga_bangunan[{{ $kategori }}]" value="{{ old('harga_bangunan.' . $kategori, $hargaBangunan->harga_satuan ?? '') }}">

                                </td>

                                {{-- ================================================= --}}
                                {{-- HARGA OBAT --}}
                                {{-- ================================================= --}}

                                <td>

                                    <input type="number" class="form-control" name="harga_obat[{{ $kategori }}]" value="{{ old('harga_obat.' . $kategori, $hargaObat->harga_satuan ?? '') }}">

                                </td>

                                {{-- ================================================= --}}
                                {{-- HARGA MEUBELAIR --}}
                                {{-- ================================================= --}}

                                <td>

                                    <input type="number" class="form-control" name="harga_meubelair[{{ $kategori }}]" value="{{ old('harga_meubelair.' . $kategori, $hargaMeubelair->harga_satuan ?? '') }}">

                                </td>

                                {{-- ================================================= --}}
                                {{-- HARGA PERALATAN --}}
                                {{-- ================================================= --}}

                                <td>

                                    <input type="number" class="form-control" name="harga_peralatan[{{ $kategori }}]" value="{{ old('harga_peralatan.' . $kategori, $hargaPeralatan->harga_satuan ?? '') }}">

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

            <hr class="my-4">

            {{-- ========================================================= --}}
            {{-- II. PERKIRAAN KERUGIAN --}}
            {{-- ========================================================= --}}

            <h6 class="fw-bold">
                II. PERKIRAAN KERUGIAN
            </h6>

            @foreach ($kerugian as $section)
                <table class="table table-bordered mt-3">

                    <thead>

                        <tr class="bg-secondary text-white">

                            <th colspan="4">
                                {{ $section['judul'] }}
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($section['fields'] as $field)
                            @php

                                $itemKerugian = $getCategoryItem($field['kategori']);

                                $jumlahValue = $itemKerugian->jumlah ?? '';

                                $hargaValue = null;

                                if (!empty($field['harga_field'])) {
                                    $hargaValue = $itemKerugian?->{$field['harga_field']} ?? '';
                                }

                            @endphp

                            <tr>

                                <td style="width: 15%">
                                    {{ $field['label'] }}
                                </td>

                                @if (isset($field['single']) && $field['single'])
                                    <td colspan="3">

                                        <div class="input-group">

                                            <span class="input-group-text">
                                                {{ $field['addon1'] ?? 'Rp' }}
                                            </span>

                                            <input type="number" class="form-control" name="{{ $field['kategori'] }}" value="{{ old($field['kategori'], $itemKerugian->jumlah ?? '') }}">

                                        </div>

                                    </td>
                                @else
                                    <td style="width: 35%">

                                        <div class="input-group">

                                            <input type="number" class="form-control" name="{{ $field['kategori'] }}_jumlah" value="{{ old($field['kategori'] . '_jumlah', $jumlahValue) }}">

                                            <span class="input-group-text">
                                                {{ $field['addon1'] ?? '' }}
                                            </span>

                                        </div>

                                        <input type="hidden" name="{{ $field['kategori'] }}_id" value="{{ $itemKerugian->id ?? '' }}">

                                    </td>

                                    <td style="width: 15%">
                                        Nilai
                                    </td>

                                    <td style="width: 35%">

                                        <div class="input-group">

                                            <span class="input-group-text">
                                                {{ $field['addon2'] ?? 'Rp' }}
                                            </span>

                                            <input type="number" class="form-control" name="{{ $field['kategori'] }}_harga" value="{{ old($field['kategori'] . '_harga', $hargaValue) }}">

                                        </div>

                                    </td>
                                @endif

                            </tr>
                        @endforeach

                    </tbody>

                </table>
            @endforeach

            {{-- ========================================================= --}}
            {{-- BUTTON --}}
            {{-- ========================================================= --}}

            <div class="row mb-4">

                <div class="col-12 text-center">

                    <button type="submit" class="btn" style="
                    background-color: #F28705;
                    color: white;
                    border: none;
                ">
                        {{ isset($edit) && $edit ? 'Update Data' : 'Simpan Data' }}
                    </button>

                </div>

                <div class="col-12 mt-2">

                    <button type="button" class="btn btn-warning" id="fillDummy">
                        Isi Data Dummy
                    </button>

                </div>

            </div>

        </form>

        <hr class="my-4">

        <div class="card mt-4">

            <div class="card-header bg-danger text-white">

                <h5 class="mb-0">
                    Total Kerusakan (Otomatis)
                </h5>

            </div>

            <div class="card-body text-center">

                @php

                    $totalKerusakan = 0;

                    foreach ($items as $item) {
                        $jumlah = (float) ($item->jumlah ?? 0);

                        $harga = (float) ($item->harga_satuan ?? 0);

                        $totalKerusakan += $jumlah * $harga;
                    }

                @endphp

                <h4 class="mb-1">
                    Rp {{ number_format($totalKerusakan, 0, ',', '.') }}
                </h4>

                <small>
                    Total Kerusakan Format 3
                </small>

            </div>

        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">

                {{ session('error') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        @endif

    </div>

    <script>
        document
            .getElementById('fillDummy')
            .addEventListener('click', function() {

                document
                    .querySelectorAll('input[type="number"]')
                    .forEach(function(input) {

                        if (input.value === '') {
                            input.value = 1;
                        }

                    });

            });
    </script>

@endsection
