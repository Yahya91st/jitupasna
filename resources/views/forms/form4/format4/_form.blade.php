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
    </style>

    @php

        $items = isset($formulir) ? $formulir->items : collect();

        $getItem = function ($kategori, $subKategori = null, $tingkatKerusakan = null) use ($items) {
            return $items->first(function ($item) use ($kategori, $subKategori, $tingkatKerusakan) {
                return $item->kategori === $kategori && $item->sub_kategori === $subKategori && $item->tingkat_kerusakan === $tingkatKerusakan;
            });
        };

        $getCategoryItem = function ($kategori) use ($items) {
            return $items->first(function ($item) use ($kategori) {
                return $item->kategori === $kategori;
            });
        };

        $bangunan = [
            'panti_asuhan' => 'Panti Asuhan',
            'panti_wredha' => 'Panti Wredha',
            'panti_tuna_grahita' => 'Panti Tuna Grahita',
            'lainnya' => 'Lainnya',
        ];

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
                'judul' => '2. BIAYA PENYEDIAAN JATAH HIDUP',
                'fields' => [
                    [
                        'label' => 'Jumlah Pengungsi',
                        'kategori' => 'pengungsi',
                        'jumlah_field' => 'jumlah',
                        'harga_field' => 'harga_satuan',
                        'addon1' => 'Orang',
                        'addon2' => 'Rp',
                    ],
                ],
            ],

            [
                'judul' => '3. TAMBAHAN BIAYA SOSIAL',
                'fields' => [
                    [
                        'label' => 'Biaya Pelayanan Kesehatan',
                        'kategori' => 'pelayanan_kesehatan',
                        'addon1' => 'Rp',
                        'single' => true,
                    ],
                    [
                        'label' => 'Biaya Pelayanan Pendidikan',
                        'kategori' => 'pelayanan_pendidikan',
                        'addon1' => 'Rp',
                        'single' => true,
                    ],
                    [
                        'label' => 'Biaya Pendampingan Psikososial',
                        'kategori' => 'pendampingan_psikososial',
                        'addon1' => 'Rp',
                        'single' => true,
                    ],
                    [
                        'label' => 'Biaya Pelatihan Darurat',
                        'kategori' => 'pelatihan_darurat',
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
            Format 4: Sektor Perlindungan Sosial
        </p>

        <form id="format4Form" action="{{ isset($edit) && $edit ? route('forms.form4.format4.update', $formulir->id) : route('forms.form4.format4.store') }}" method="POST">

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
            {{-- DATA KERUSAKAN BANGUNAN --}}
            {{-- ========================================================= --}}

            <div class="table-responsive">

                <table class="table table-bordered text-center align-middle small">

                    <thead>

                        <tr>

                            <th rowspan="2">
                                Jenis Bangunan
                            </th>

                            <th colspan="6">
                                Jumlah Unit Rusak
                            </th>

                            <th rowspan="2">
                                Rata-rata Luas Bangunan
                            </th>

                            <th colspan="4">
                                Harga Satuan
                            </th>

                        </tr>

                        <tr>

                            <th>
                                Berat Negeri
                            </th>

                            <th>
                                Berat Swasta
                            </th>

                            <th>
                                Sedang Negeri
                            </th>

                            <th>
                                Sedang Swasta
                            </th>

                            <th>
                                Ringan Negeri
                            </th>

                            <th>
                                Ringan Swasta
                            </th>

                            <th>
                                Bangunan/m²
                            </th>

                            <th>
                                Obat-obatan
                            </th>

                            <th>
                                Meubelair
                            </th>

                            <th>
                                Peralatan lab dan lainnya
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @php
                            $index = 0;
                        @endphp

                        @foreach ($bangunan as $kategori => $label)
                            @php

                                $beratNegeri = $getItem($kategori, 'negeri', 'berat');

                                $beratSwasta = $getItem($kategori, 'swasta', 'berat');

                                $sedangNegeri = $getItem($kategori, 'negeri', 'sedang');

                                $sedangSwasta = $getItem($kategori, 'swasta', 'sedang');

                                $ringanNegeri = $getItem($kategori, 'negeri', 'ringan');

                                $ringanSwasta = $getItem($kategori, 'swasta', 'ringan');

                                $categoryItem = $getCategoryItem($kategori);

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

                                    <input type="number" class="form-control" name="dimensi[{{ $kategori }}]" value="{{ old('dimensi.' . $kategori, $categoryItem->dimensi ?? '') }}">

                                </td>

                                {{-- ================================================= --}}
                                {{-- HARGA BANGUNAN --}}
                                {{-- ================================================= --}}

                                <td>

                                    <input type="number" class="form-control" name="harga_bangunan[{{ $kategori }}]" value="{{ old('harga_bangunan.' . $kategori, $categoryItem->harga_satuan ?? '') }}">

                                </td>

                                {{-- ================================================= --}}
                                {{-- HARGA OBAT --}}
                                {{-- ================================================= --}}

                                <td>

                                    <input type="number" class="form-control" name="harga_obat[{{ $kategori }}]" value="{{ old('harga_obat.' . $kategori, '') }}">

                                </td>

                                {{-- ================================================= --}}
                                {{-- HARGA MEUBELAIR --}}
                                {{-- ================================================= --}}

                                <td>

                                    <input type="number" class="form-control" name="harga_meubelair[{{ $kategori }}]" value="{{ old('harga_meubelair.' . $kategori, '') }}">

                                </td>

                                {{-- ================================================= --}}
                                {{-- HARGA PERALATAN --}}
                                {{-- ================================================= --}}

                                <td>

                                    <input type="number" class="form-control" name="harga_peralatan[{{ $kategori }}]" value="{{ old('harga_peralatan.' . $kategori, '') }}">

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

            <hr class="my-4">

            {{-- ========================================================= --}}
            {{-- PERKIRAAN KERUGIAN --}}
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

                                            <input type="number" class="form-control" name="{{ $field['kategori'] }}" value="{{ old($field['kategori'], $jumlahValue) }}">

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

        {{-- ========================================================= --}}
        {{-- SESSION / ERROR --}}
        {{-- ========================================================= --}}

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
