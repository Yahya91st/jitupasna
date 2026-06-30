@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel dan input agar lebih kompak */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
        vertical-align: middle !important;
        text-align: center;
    }
    .table input.form-control {
        padding: 0.15rem 0.3rem !important;
        font-size: 0.95rem;
    }
    .table thead th {
        color: #727E8C !important;
        color: #ffffffff;
        font-weight: 600;
    }
    .input-group-text {
        padding: 0.15rem 0.5rem;
        font-size: 0.95rem;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
    }
    .input-group input.form-control {
        text-align: left;
    }
    .bg-secondary.text-white th {
        background-color: #475F7B !important;
        color: white !important;
    }
    .table-bordered > :not(caption) > * {
        border-width: 1px 0;
    }
    .table-bordered > :not(caption) > * > * {
        border-width: 0 1px;
    }
</style>
<div class="container mt-4">
    <h5 class="text-center fw-bold" style="color: #F28705;">Formulir 04<br>Pengkajian Kebutuhan Pasca Bencana</h5>
    <p class="fw-bold">Format 7: Pengumpulan Data Sektor Transportasi</p>
    
    <form method="POST" action="{{ route('forms.form4.format7.store') }}">
        @csrf
        <table class="table table-bordered">
            <tr>
                <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $bencana->nama_kampung ?? '') }}"></td>
                <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $bencana->nama_distrik ?? '') }}"></td>
            </tr>
        </table>
        <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">

        <div class="table-responsive">            
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th>Uraian</th>
                        <th>Nama/Ruas</th>
                        <th>Jenis</th>
                        <th>Tipe</th>
                        <th>Berat</th>
                        <th>Sedang</th>
                        <th>Ringan</th>
                        <th>Harga Satuan</th>
                        <th>Biaya Perbaikan</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                    $infrastruktur = [
                        ['Jalan', 'jalan'],
                        ['Jembatan', 'jembatan'],
                    ];

                    $index = 0;
                    @endphp

                    @foreach($infrastruktur as $row => [$label, $kategori])

                    <tr>
                        
                        <td>{{ $label }}</td>
                        
                        <td>
                            <input type="text" class="form-control"
                            name="infrastruktur[{{ $row }}][nama]">
                            <input type="hidden"
                            name="infrastruktur[{{ $row }}][kategori]"
                            value="{{ $kategori }}">
                            <input type="hidden"
                            name="infrastruktur[{{ $row }}][satuan]"
                            value="unit">
                        </td>

                        <td>
                            <input type="text" class="form-control"
                                name="infrastruktur[{{ $row }}][jenis]">
                        </td>

                        <td>
                            <input type="text" class="form-control"
                                name="infrastruktur[{{ $row }}][tipe]">
                        </td>

                        <td>
                            <input type="number" class="form-control"
                                name="infrastruktur[{{ $row }}][berat]">
                        </td>

                        <td>
                            <input type="number" class="form-control"
                                name="infrastruktur[{{ $row }}][sedang]">
                        </td>

                        <td>
                            <input type="number" class="form-control"
                                name="infrastruktur[{{ $row }}][ringan]">
                        </td>

                        <td>
                            <input type="number" class="form-control"
                                name="infrastruktur[{{ $row }}][harga_satuan]">
                        </td>

                        <td>
                            <input type="number" class="form-control"
                                name="infrastruktur[{{ $row }}][biaya_perbaikan]">
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>

            <table class="table table-bordered mt-3">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="4">
                            II. KERUSAKAN KENDARAAN
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @php
                    $kendaraan = [
                        ['Sedan dan Minibus', 'sedan_minibus'],
                        ['Bus dan Truk', 'bus_truk'],
                        ['Kendaraan Berat', 'kendaraan_berat'],
                        ['Kapal Laut', 'kapal_laut'],
                        ['Bus Air', 'bus_air'],
                        ['Speed Boat', 'speed_boat'],
                        ['Perahu Klotok', 'perahu_klotok'],
                    ];
                    @endphp
                    <tr>
                        <td>

                        </td>
                        <td>
                            Jumlah
                        </td>
                        <td>
                            Harga Satuan
                        </td>
                    </tr>

                    @foreach($kendaraan as [$label, $kategori])

                    <tr>

                        <td>
                            {{ $label }}
                        </td>

                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][sub_kategori]"
                                value="jumlah_kendaraan">

                            <input type="hidden"
                                name="details[{{ $index }}][kriteria_id]"
                                value="1">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>
                        <td>
                            <input type="number"
                                class="form-control auto-row"
                                name="details[{{ $index }}][harga_satuan]">
                        </td>

                    </tr>

                    @php $index++; @endphp

                    @endforeach
                </tbody>
            </table>


            @php
            $prasarana = [
                ['Terminal', 'terminal'],
                ['Dermaga', 'dermaga'],
                ['Bandara', 'bandara'],
            ];
            @endphp

            <table class="table table-bordered mt-3">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th>Prasarana</th>
                        <th>Jumlah Unit</th>
                        <th>Rusak Berat</th>
                        <th>Rusak Sedang</th>
                        <th>Rusak Ringan</th>
                        <th>Biaya Perbaikan</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($prasarana as [$label, $kategori])

                    <tr>

                        <td>{{ $label }}</td>

                        {{-- Jumlah Unit --}}
                        <td>
                            <input type="number"
                                class="form-control"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][sub_kategori]"
                                value="jumlah_unit">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>
                        @php $index++; @endphp

                        {{-- Rusak Berat --}}
                        <td>
                            <input type="number"
                                class="form-control"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][tingkat_kerusakan]"
                                value="berat">

                            <input type="hidden"
                                name="details[{{ $index }}][kriteria_id]"
                                value="1">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>
                        @php $index++; @endphp

                        {{-- Rusak Sedang --}}
                        <td>
                            <input type="number"
                                class="form-control"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][tingkat_kerusakan]"
                                value="sedang">

                            <input type="hidden"
                                name="details[{{ $index }}][kriteria_id]"
                                value="2">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>
                        @php $index++; @endphp

                        {{-- Rusak Ringan --}}
                        <td>
                            <input type="number"
                                class="form-control"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

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

                        {{-- Biaya Perbaikan --}}
                        <td>
                            <input type="number"
                                class="form-control"
                                name="details[{{ $index }}][jumlah]">

                            <input type="hidden"
                                name="details[{{ $index }}][kategori]"
                                value="{{ $kategori }}">

                            <input type="hidden"
                                name="details[{{ $index }}][sub_kategori]"
                                value="biaya_perbaikan">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="rp">
                        </td>
                        @php $index++; @endphp

                    </tr>

                    @endforeach

                </tbody>
            </table>

            @php
            $kerugian = [

                [
                    'judul' => 'KEHILANGAN PENDAPATAN ANGKUTAN DARAT',
                    'kategori' => 'angkutan_darat',
                    'fields' => [
                        [
                            'label' => 'Pendapatan per Hari',
                            'sub_kategori' => 'pendapatan_per_hari',
                            'satuan' => 'rp',
                            'addon' => 'Rp',
                        ],
                        [
                            'label' => 'Jumlah Angkutan Terdampak',
                            'sub_kategori' => 'jumlah_angkutan_terdampak',
                            'satuan' => 'unit',
                            'addon' => 'Unit',
                        ],
                    ]
                ],

                [
                    'judul' => 'KEHILANGAN PENDAPATAN ANGKUTAN LAUT',
                    'kategori' => 'angkutan_laut',
                    'fields' => [
                        [
                            'label' => 'Pendapatan per Hari',
                            'sub_kategori' => 'pendapatan_per_hari',
                            'satuan' => 'rp',
                            'addon' => 'Rp',
                        ],
                        [
                            'label' => 'Jumlah Angkutan Terdampak',
                            'sub_kategori' => 'jumlah_angkutan_terdampak',
                            'satuan' => 'unit',
                            'addon' => 'Unit',
                        ],
                    ]
                ],

                [
                    'judul' => 'KEHILANGAN PENDAPATAN ANGKUTAN UDARA',
                    'kategori' => 'angkutan_udara',
                    'fields' => [
                        [
                            'label' => 'Pendapatan per Hari',
                            'sub_kategori' => 'pendapatan_per_hari',
                            'satuan' => 'rp',
                            'addon' => 'Rp',
                        ],
                        [
                            'label' => 'Jumlah Angkutan Terdampak',
                            'sub_kategori' => 'jumlah_angkutan_terdampak',
                            'satuan' => 'unit',
                            'addon' => 'Unit',
                        ],
                    ]
                ],

                [
                    'judul' => 'KEHILANGAN PENDAPATAN TERMINAL',
                    'kategori' => 'terminal',
                    'fields' => [
                        [
                            'label' => 'Pendapatan per Hari',
                            'sub_kategori' => 'pendapatan_per_hari',
                            'satuan' => 'rp',
                            'addon' => 'Rp',
                        ],
                    ]
                ],

                [
                    'judul' => 'KEHILANGAN PENDAPATAN DERMAGA',
                    'kategori' => 'dermaga',
                    'fields' => [
                        [
                            'label' => 'Pendapatan per Hari',
                            'sub_kategori' => 'pendapatan_per_hari',
                            'satuan' => 'rp',
                            'addon' => 'Rp',
                        ],
                    ]
                ],

                [
                    'judul' => 'KEHILANGAN PENDAPATAN BANDARA',
                    'kategori' => 'bandara',
                    'fields' => [
                        [
                            'label' => 'Pendapatan per Hari',
                            'sub_kategori' => 'pendapatan_per_hari',
                            'satuan' => 'rp',
                            'addon' => 'Rp',
                        ],
                    ]
                ],

                [
                    'judul' => 'KENAIKAN BIAYA OPERASIONAL KENDARAAN AKIBAT PENGGUNAAN JALAN YANG RUSAK',
                    'kategori' => 'biaya_operasional_kendaraan',
                    'fields' => [
                        [
                            'label' => 'Biaya Operasional Kendaraan Sebelum Bencana',
                            'sub_kategori' => 'sebelum_bencana',
                            'satuan' => 'rp',
                            'addon' => 'Rp',
                        ],
                        [
                            'label' => 'Biaya Operasional Kendaraan Sesudah Bencana',
                            'sub_kategori' => 'sesudah_bencana',
                            'satuan' => 'rp',
                            'addon' => 'Rp',
                        ],
                    ]
                ],

                [
                    'judul' => 'BIAYA PEMASANGAN INFRASTRUKTUR DARURAT',
                    'kategori' => 'infrastruktur_darurat',
                    'fields' => [
                        [
                            'label' => 'Jumlah Kendaraan Terdampak',
                            'sub_kategori' => 'jumlah_kendaraan_terdampak',
                            'satuan' => 'unit',
                            'addon' => 'Unit',
                        ],
                        [
                            'label' => 'Jumlah Unit Terdampak',
                            'sub_kategori' => 'jumlah_unit_terdampak',
                            'satuan' => 'unit',
                            'addon' => 'Unit',
                        ],
                        [
                            'label' => 'Biaya Per Unit',
                            'sub_kategori' => 'biaya_per_unit',
                            'satuan' => 'rp',
                            'addon' => 'Rp',
                        ],
                    ]
                ],
            ];
            @endphp

            @foreach($kerugian as $section)

            <table class="table table-bordered mt-3">

                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="2">
                            {{ $section['judul'] }}
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($section['fields'] as $field)

                    <tr>

                        <td width="35%">
                            {{ $field['label'] }}
                        </td>

                        <td>

                            <div class="input-group">

                                @if(isset($field['addon']))
                                <span class="input-group-text">
                                    {{ $field['addon'] }}
                                </span>
                                @endif

                                <input type="number"
                                    class="form-control"
                                    name="details[{{ $index }}][jumlah]">

                                <input type="hidden"
                                    name="details[{{ $index }}][kategori]"
                                    value="{{ $section['kategori'] }}">

                                <input type="hidden"
                                    name="details[{{ $index }}][sub_kategori]"
                                    value="{{ $field['sub_kategori'] }}">

                                <input type="hidden"
                                    name="details[{{ $index }}][satuan]"
                                    value="{{ $field['satuan'] }}">

                            </div>

                        </td>

                    </tr>

                    @php $index++; @endphp

                    @endforeach

                </tbody>

            </table>

            @endforeach
        </div>
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">{{ isset($edit) && $edit ? 'Update Data' : 'Simpan Data' }}</button>
        </div>
        <div class="col-12 text-center">
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
            document.querySelectorAll(['input[type="number"]','input[type="text"]']).forEach(function(input) {

                if (input.value === '') {
                    input.value = 1;
                }

            });

        });
</script>
@endsection