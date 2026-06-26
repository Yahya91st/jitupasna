@extends('layouts.main')

@section('content')
    <style>
        .table th,
        .table td {
            padding: 0.25rem 0.3rem !important;
            vertical-align: middle !important;
            text-align: center;
            border: 1px solid #bdbdbd !important;
        }

        .table thead th {
            background: #f8f9fa;
            font-weight: 600;
        }

        .table input.form-control,
        .table input.form-control-sm {
            padding: 0.15rem 0.3rem !important;
            font-size: 0.95rem;
            height: 31px;
            border-radius: 0.25rem;
        }

        .input-group-text {
            padding: 0.2rem 0.5rem !important;
            font-size: 0.9rem;
            background: #f1f1f1;
            border-radius: 0.25rem 0 0 0.25rem;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.2rem;
        }
    </style>
    <div class="container mt-4">
        <h5 class="text-center fw-bold " style="color: #F28705;">Formulir 04<br>Pengumpulan Data Sektor</h5>
        <p class="fw-bold">Format 6: Sarana dan Prasarana Air Minum & Sanitasi</p>

        <form action="{{ isset($edit) && $edit ? route('forms.form4.format6.update', $data['id'] ?? '') : route('forms.form4.format6.store') }}" method="POST">
            @csrf
            @if (isset($edit) && $edit)
                @method('PUT')
            @endif
            <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">

            <table class="table table-bordered mb-3">
                <tr>
                    <td style="width: 50%">
                        <label class="form-label mb-0">NAMA KAMPUNG</label>
                        <input type="text" class="form-control" name="nama_kampung" required value="{{ isset($data) ? $data->nama_kampung : old('nama_kampung') }}">
                    </td>
                    <td>
                        <label class="form-label mb-0">NAMA DISTRIK</label>
                        <input type="text" class="form-control" name="nama_distrik" required value="{{ isset($data) ? $data->nama_distrik : old('nama_distrik') }}">
                    </td>
                </tr>
            </table>

            <div class="table-responsive">
                <table class="table table-bordered mb-4">
                    <thead>
                        <tr>
                            <th rowspan="2" style="width: 18%;">Uraian</th>
                            <th rowspan="2" style="width: 18%;">Komponen</th>
                            <th colspan="2" style="width: 18%;">Jumlah Kerusakan</th>
                            <th rowspan="2" style="width: 18%;">Harga Satuan</th>
                        </tr>
                        <tr>
                            <th style="width: 9%;">Unit</th>
                            <th style="width: 9%;">Jumlah</th>
                        </tr>
                    </thead>
                    @php

                    $kerusakan = [
                        'Sarana dan Prasarana Air Minum' => [
                            'struktur_air' => 'Struktur Pengambilan Air',
                            'instalasi_pemurnian' => 'Instalasi Pemurnian Air',
                            'perpipaan' => 'Sistem Perpipaan',
                            'penyimpanan' => 'Sistem Penyimpanan',
                            'sumur' => 'Sumur',
                            'lain' => 'Lain-lain',
                        ],

                        'Sistem Sanitasi' => [
                            'sanitasi' => 'Jaringan Pembuangan',
                            'septik' => 'Septik Tank',
                            'limbah_padat' => 'Sistem Pengumpulan Limbah Padat',
                            'wc_umum' => 'WC Umum',
                        ],

                        '' => [
                            'rehabilitasi' => 'Perkiraan Jangka Waktu Rehabilitasi (dalam bulan)',
                            'rekonstruksi' => 'Perkiraan Jangka Waktu Rekonstruksi (dalam bulan)',
                        ]
                    ];

                    $index = 0;

                    @endphp

                    <tbody>

                    @foreach($kerusakan as $group => $items)

                    @php
                        $first = true;
                        $rowspan = count($items);
                    @endphp

                    @foreach($items as $kategori => $label)

                        <tr>

                            @if($first)
                                <td rowspan="{{ $rowspan }}"
                                    class="align-middle fw-bold">
                                    {{ $group }}
                                </td>
                                @php $first = false; @endphp
                            @endif

                            <td>{{ $label }}</td>

                            @if(in_array($kategori, ['rehabilitasi', 'rekonstruksi']))

                                <td colspan="2">
                                    <input type="number"
                                        class="form-control"
                                        name="details[{{ $index }}][jumlah]">
                                    <input type="hidden"
                                    name="details[{{ $index }}][kategori]"
                                    value="{{ $kategori }}">
                                    <input type="hidden"
                                        class="form-control"
                                        name="details[{{ $index }}][satuan]"
                                        value="bulan">
                                </td>

                            @else

                                <td>
                                    <input type="text"
                                        class="form-control"
                                        name="details[{{ $index }}][satuan]"
                                        value="unit"
                                        readonly>

                                    <input type="hidden"
                                        name="details[{{ $index }}][kategori]"
                                        value="{{ $kategori }}">
                                </td>

                                <td>
                                    <input type="number"
                                        class="form-control"
                                        name="details[{{ $index }}][jumlah]">
                                </td>

                                <td>
                                    <input type="number"
                                        class="form-control"
                                        name="details[{{ $index }}][harga_satuan]">
                                </td>

                            @endif

                        </tr>

                        @php $index++; @endphp

                    @endforeach

                @endforeach

                    </tbody>
                    
                </table>
            </div>

            <hr class="my-4">

            <h6 class="fw-bold">PERKIRAAN KERUGIAN</h6>
            @php

            $kerugian = [

                [
                    'judul' => 'SISTEM AIR MINUM',
                    'fields' => [

                        [
                            'label' => 'Kehilangan Pendapatan PDAM',
                            'name1' => 'kehilangan_pendapatan_pdam',
                            'addon1' => 'Rp/Bulan',
                            'single' => true,
                        ],

                        [
                            'label' => 'Biaya Pemurnian Air',
                            'name1' => 'biaya_pemurnian',
                            'addon1' => 'Rp',

                            'label2' => 'Dasar Perhitungan',
                            'name2' => 'dasar_perhitungan_biaya_pemurnian',
                            'type2' => 'text',
                        ],

                        [
                            'label' => 'Biaya Distribusi Air',
                            'name1' => 'biaya_distribusi',
                            'addon1' => 'Rp',

                            'label2' => 'Dasar Perhitungan',
                            'name2' => 'dasar_perhitungan_biaya_distribusi',
                            'type2' => 'text',
                        ],

                        [
                            'label' => 'Biaya Pembersihan Sumur',
                            'name1' => 'biaya_pembersihan',
                            'addon1' => 'Rp',

                            'label2' => 'Dasar Perhitungan',
                            'name2' => 'dasar_perhitungan_biaya_pembersihan',
                            'type2' => 'text',
                        ],

                        [
                            'label' => 'Biaya Lain',
                            'name1' => 'biaya_lain',
                            'addon1' => 'Rp',

                            'label2' => 'Dasar Perhitungan',
                            'name2' => 'dasar_perhitungan_biaya_lain',
                            'type2' => 'text',
                        ],

                    ]
                ],

                [
                    'judul' => 'SISTEM SANITASI',
                    'fields' => [

                        [
                            'label' => 'Penurunan Pendapatan Instansi',
                            'name1' => 'sanitasi_pendapatan',
                            'addon1' => 'Rp/Bulan',
                            'single' => true,
                        ],

                        [
                            'label' => 'Pembersihan Jaringan Pembuangan',
                            'name1' => 'biaya_pembersihan_jaringan',
                            'addon1' => 'Rp',

                            'label2' => 'Dasar Perhitungan',
                            'name2' => 'dasar_perhitungan_biaya_pembersihan_jaringan',
                            'type2' => 'text',
                        ],

                        [
                            'label' => 'Biaya Bahan Kimia',
                            'name1' => 'biaya_bahan_kimia',
                            'addon1' => 'Rp',

                            'label2' => 'Dasar Perhitungan',
                            'name2' => 'dasar_perhitungan_biaya_bahan_kimia',
                            'type2' => 'text',
                        ],

                    ]
                ]

            ];

            @endphp

            @foreach($kerugian as $section)

            <table class="table table-bordered mt-3">

                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="4">
                            {{ $section['judul'] }}
                        </th>
                    </tr>
                </thead>

                <tbody>

                @foreach($section['fields'] as $field)

                    <tr>

                        <td width="15%">
                            {{ $field['label'] }}
                        </td>

                        <td width="35%">

                            <div class="input-group">

                                <input
                                    type="{{ $field['type1'] ?? 'number' }}"
                                    class="form-control"
                                    name="{{ $field['name1'] }}">

                                @if(isset($field['addon1']))
                                    <span class="input-group-text">
                                        {{ $field['addon1'] }}
                                    </span>
                                @endif

                            </div>

                        </td>

                        @if(isset($field['name2']))

                            <td width="15%">
                                {{ $field['label2'] }}
                            </td>

                            <td width="35%">

                                <input
                                    type="{{ $field['type2'] ?? 'number' }}"
                                    class="form-control"
                                    name="{{ $field['name2'] }}">

                            </td>

                        @else

                            <td colspan="2"></td>

                        @endif

                    </tr>

                @endforeach

                </tbody>

            </table>

            @endforeach

            <div class="row mb-4">
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
