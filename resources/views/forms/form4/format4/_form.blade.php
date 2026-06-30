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
    <div class="container mt-4">
        <h5 class="text-center fw-bold" style="color: #F28705;">Formulir 04<br>Pengkajian Kebutuhan Pasca Bencana</h5>
        <p class="fw-bold">Format 4: Sektor Perlindungan Sosial</p>
        <form action="{{ isset($edit) && $edit ? route('forms.form4.format4.update', $data->id) : route('forms.form4.format4.store') }}" method="POST">
            @csrf
            <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">

            <table class="table table-bordered mb-2">
                <tr>
                    <td style="width: 50%">
                        NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required>
                    </td>
                    <td>
                        NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required>
                    </td>
                </tr>
            </table>

            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle small">
                    <thead>
                        <tr>
                            <th rowspan="2">Jenis Bangunan</th>
                            <th colspan="6">Jumlah Unit Rusak</th>
                            <th rowspan="2">Rata-rata Luas Bangunan</th>
                            <th colspan="4">Harga Satuan</th>
                        </tr>
                        <tr>
                            <th>Berat Negeri</th>
                            <th>Berat Swasta</th>
                            <th>Sedang Negeri</th>
                            <th>Sedang Swasta</th>
                            <th>Ringan Negeri</th>
                            <th>Ringan Swasta</th>
                            <th>Bangunan/m²</th>
                            <th>Obat-obatan</th>
                            <th>Meubelair</th>
                            <th>Peralatan lab dan lainnya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $bangunan = [
                            'panti_asuhan' => 'Panti Asuhan',
                            'panti_wredha' => 'Panti Wredha',
                            'panti_tuna_grahita' => 'Panti Tuna Grahita',
                            'lainnya' => 'Lainnya',
                        ];

                        $index = 0;
                        @endphp

                        @foreach($bangunan as $kategori => $label)
                        
                        <tr>
                        <td class="fw-bold">{{ $label }}</td>

                        {{-- RB NEGERI --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][sub_kategori]"
                                value="negeri">

                            <input type="hidden"
                                name="details[{{ $index }}][tingkat_kerusakan]"
                                value="berat">

                            <input type="hidden"
                                name="details[{{ $index }}][kriteria_id]"
                                value="3">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- RB SWASTA --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][sub_kategori]"
                                value="swasta">

                            <input type="hidden"
                                name="details[{{ $index }}][tingkat_kerusakan]"
                                value="berat">

                            <input type="hidden"
                                name="details[{{ $index }}][kriteria_id]"
                                value="3">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- RS NEGERI --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][sub_kategori]"
                                value="negeri">

                            <input type="hidden"
                                name="details[{{ $index }}][tingkat_kerusakan]"
                                value="sedang">

                            <input type="hidden"
                                name="details[{{ $index }}][kriteria_id]"
                                value="3">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- RS SWASTA --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][sub_kategori]"
                                value="swasta">

                            <input type="hidden"
                                name="details[{{ $index }}][tingkat_kerusakan]"
                                value="sedang">

                            <input type="hidden"
                                name="details[{{ $index }}][kriteria_id]"
                                value="3">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- RR NEGERI --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][sub_kategori]"
                                value="negeri">

                            <input type="hidden"
                                name="details[{{ $index }}][tingkat_kerusakan]"
                                value="ringan">

                            <input type="hidden"
                                name="details[{{ $index }}][kriteria_id]"
                                value="3">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- RR SWASTA --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][sub_kategori]"
                                value="swasta">

                            <input type="hidden"
                                name="details[{{ $index }}][tingkat_kerusakan]"
                                value="ringan">

                            <input type="hidden"
                                name="details[{{ $index }}][kriteria_id]"
                                value="3">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- LUAS --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="dimensi[{{ $kategori }}]"
                                placeholder="m²">
                        </td>

                        {{-- HARGA BANGUNAN --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="harga_bangunan[{{ $kategori }}]">
                        </td>

                        {{-- HARGA OBAT --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="harga_obat[{{ $kategori }}]">
                        </td>

                        {{-- MEUBELAIR --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="harga_meubelair[{{ $kategori }}]">
                        </td>

                        {{-- PERALATAN --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="harga_peralatan[{{ $kategori }}]">
                        </td>

                    </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>

            <h6 class="fw-bold mt-3 mb-2">Perkiraan Kerugian</h6>
            @php
            $kerugian = [
                [
                    'judul' => '1. BIAYA PEMBERSIHAN PUING',
                    'fields' => [
                        [
                            'label' => 'A. Biaya Tenaga Kerja',
                            'name1' => 'biaya_tenaga_kerja_hok',
                            'addon1' => 'HOK',
                            'name2' => 'biaya_tenaga_kerja_upah',
                            'addon2' => 'Rp',
                            'label2' => 'Upah Harian',
                        ],
                        [
                            'label' => 'B. Biaya Alat Berat',
                            'name1' => 'biaya_alat_berat_hari',
                            'addon1' => 'Hari',
                            'name2' => 'biaya_alat_berat_harga',
                            'addon2' => 'Rp',
                            'label2' => 'Tarif per Hari',
                        ],
                    ]
                ],

                [
                    'judul' => '2. BIAYA PENYEDIAAN JATAH HIDUP',
                    'fields' => [
                        [
                            'label' => 'Jumlah Pengungsi',
                            'name1' => 'jumlah_penerima',
                            'addon1' => 'Orang',
                            'name2' => 'bantuan_per_orang',
                            'addon2' => 'Rp',
                            'label2' => 'Biaya per Orang',
                        ],
                    ]
                ],

                [
                    'judul' => '3. TAMBAHAN BIAYA SOSIAL',
                    'fields' => [
                        [
                            'label' => 'Biaya Pelayanan Kesehatan',
                            'name1' => 'biaya_pelayanan_kesehatan',
                            'addon1' => 'Rp',
                            'single' => true,
                        ],

                        [
                            'label' => 'Biaya Pelayanan Pendidikan',
                            'name1' => 'biaya_pelayanan_pendidikan',
                            'addon1' => 'Rp',
                            'single' => true,
                        ],

                        [
                            'label' => 'Biaya Pendampingan Psikososial',
                            'name1' => 'biaya_pendampingan_psikososial',
                            'addon1' => 'Rp',
                            'single' => true,
                        ],

                        [
                            'label' => 'Biaya Pelatihan Darurat',
                            'name1' => 'biaya_pelatihan_darurat',
                            'addon1' => 'Rp',
                            'single' => true,
                        ],
                    ]
                ],
            ];
            @endphp

            @foreach ($kerugian as $section)
            <table class="table table-bordered mt-3">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="4">{{ $section['judul'] }}</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($section['fields'] as $field)

                    <tr>

                        <td style="width:15%">
                            {{ $field['label'] }}
                        </td>

                        <td
                            style="width:35%"
                            @if(isset($field['single']))
                                colspan="3"
                            @endif
                        >
                            <div class="input-group">

                                <input
                                    type="number"
                                    class="form-control"
                                    name="{{ $field['name1'] }}"
                                    value="{{ old($field['name1']) }}">

                                @if(isset($field['addon1']))
                                    <span class="input-group-text">
                                        {{ $field['addon1'] }}
                                    </span>
                                @endif

                            </div>
                        </td>

                        @unless(isset($field['single']))
                            <td style="width:15%">
                                {{ $field['label2'] ?? 'Nilai' }}
                            </td>

                            <td style="width:35%">
                                <div class="input-group">

                                    @if(isset($field['addon2']))
                                        <span class="input-group-text">
                                            {{ $field['addon2'] }}
                                        </span>
                                    @endif

                                    <input
                                        type="number"
                                        class="form-control"
                                        name="{{ $field['name2'] }}"
                                        value="{{ old($field['name2']) }}">

                                </div>
                            </td>
                        @endunless

                    </tr>

                    @endforeach

                </tbody>
            </table>
            @endforeach

            <div class="row mb-4">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">{{ isset($edit) && $edit ? 'Update Data' : 'Simpan Data' }}</button>
                </div>
                <button type="button"
                        class="btn btn-warning"
                        id="fillDummy">
                    Isi Data Dummy
                </button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('fillDummy').addEventListener('click', function () {

            // Semua input number yang kosong
            document.querySelectorAll('input[type="number"]').forEach(function(input) {

                if (input.value === '') {
                    input.value = 1;
                }

            });

        });
    </script>
@endsection
