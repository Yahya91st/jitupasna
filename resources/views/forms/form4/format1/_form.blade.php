@extends('layouts.main')

@section('content')

    <style>
        .table th,
        .table td {
            padding: .25rem .3rem !important;
        }

        .table input.form-control {
            padding: .15rem .3rem !important;
            font-size: .95rem;
        }

        .main-title {
            background: linear-gradient(135deg, #ff8a50, #ff6b35);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>

    <div class="container mt-4">

        <h5 class="text-center fw-bold main-title">
            Formulir 04<br>
            Pengumpulan Data Sektor
        </h5>

        <p class="fw-bold">
            Format 1a : Pengumpulan Data Sektor Perumahan
        </p>

        <form action="{{ $action }}" method="POST">

            @csrf

            @if ($edit)
                @method($method)
            @endif

            <input type="hidden" name="bencana_id" value="{{ request('bencana_id') ?? ($data->bencana_id ?? '') }}">

            <table class="table table-bordered">

                <tr>

                    <td width="50%">

                        NAMA KAMPUNG

                        <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}">

                    </td>

                    <td>

                        NAMA DISTRIK

                        <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}">

                    </td>

                </tr>

            </table>

            @php

                $tingkatRusak = [
                    'hancur_total' => '1a) JUMLAH RUMAH HANCUR TOTAL',
                    'berat' => '1b) JUMLAH RUMAH RUSAK BERAT',
                    'sedang' => '1c) JUMLAH RUMAH RUSAK SEDANG',
                    'ringan' => '1d) JUMLAH RUMAH RUSAK RINGAN',
                ];

            @endphp

            <table class="table table-bordered text-center align-middle">

                <thead>

                    <tr>

                        <th rowspan="2">
                            Perkiraan Kerusakan
                        </th>

                        <th colspan="3">
                            Jumlah Rumah
                        </th>

                        <th colspan="2">
                            Harga Satuan
                        </th>

                    </tr>

                    <tr>

                        <th>Permanen</th>
                        <th>Non Permanen</th>
                        <th>Jumlah</th>
                        <th>Permanen</th>
                        <th>Non Permanen</th>

                    </tr>

                </thead>

                <tbody>

                    @php
                        $index = 0;
                    @endphp

                    @foreach ($tingkatRusak as $tingkat => $label)
                        @php

                            $permanen = isset($formulir)
                                ? $formulir->items->first(function ($item) use ($tingkat) {
                                    return $item->kategori == 'rumah' && $item->sub_kategori == 'permanen' && $item->tingkat_kerusakan == $tingkat;
                                })
                                : null;

                            $nonPermanen = isset($formulir)
                                ? $formulir->items->first(function ($item) use ($tingkat) {
                                    return $item->kategori == 'rumah' && $item->sub_kategori == 'non_permanen' && $item->tingkat_kerusakan == $tingkat;
                                })
                                : null;

                            $permanenIndex = $index++;
                            $nonIndex = $index++;

                        @endphp

                        <tr>

                            <td class="text-start">
                                {{ $label }}
                            </td>

                            <td>

                                <input type="number" class="form-control rumah" name="details[{{ $permanenIndex }}][jumlah]" value="{{ old("details.$permanenIndex.jumlah", $permanen->jumlah ?? '') }}">

                                <input type="hidden" name="details[{{ $permanenIndex }}][kategori]" value="rumah">

                                <input type="hidden" name="details[{{ $permanenIndex }}][sub_kategori]" value="permanen">

                                <input type="hidden" name="details[{{ $permanenIndex }}][tingkat_kerusakan]" value="{{ $tingkat }}">

                                <input type="hidden" name="details[{{ $permanenIndex }}][kriteria_id]" value="1">

                                <input type="hidden" name="details[{{ $permanenIndex }}][satuan]" value="unit">

                            </td>

                            <td>

                                <input type="number" class="form-control rumah" name="details[{{ $nonIndex }}][jumlah]" value="{{ old("details.$nonIndex.jumlah", $nonPermanen->jumlah ?? '') }}">

                                <input type="hidden" name="details[{{ $nonIndex }}][kategori]" value="rumah">

                                <input type="hidden" name="details[{{ $nonIndex }}][sub_kategori]" value="non_permanen">

                                <input type="hidden" name="details[{{ $nonIndex }}][tingkat_kerusakan]" value="{{ $tingkat }}">

                                <input type="hidden" name="details[{{ $nonIndex }}][kriteria_id]" value="1">

                                <input type="hidden" name="details[{{ $nonIndex }}][satuan]" value="unit">

                            </td>

                            <td>

                                <input type="number" class="form-control total-rumah" readonly>

                            </td>

                            <td>

                                <input type="number" class="form-control" name="details[{{ $permanenIndex }}][harga_satuan]" value="{{ old("details.$permanenIndex.harga_satuan", $permanen->harga_satuan ?? '') }}">

                            </td>

                            <td>

                                <input type="number" class="form-control" name="details[{{ $nonIndex }}][harga_satuan]" value="{{ old("details.$nonIndex.harga_satuan", $nonPermanen->harga_satuan ?? '') }}">

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

            @php

                $kerusakanPrasarana = [
                    [
                        'judul' => '2.1 JALAN LINGKUNGAN',
                        'kategori' => 'jalan',
                        'satuan' => 'm²',
                        'kriteria_id' => 2,
                    ],

                    [
                        'judul' => '2.2 SALURAN AIR / GORONG-GORONG',
                        'kategori' => 'saluran',
                        'satuan' => 'm²',
                        'kriteria_id' => 2,
                    ],

                    [
                        'judul' => '2.3 BALAI PERTEMUAN RW / RT',
                        'kategori' => 'balai',
                        'satuan' => 'unit',
                        'kriteria_id' => 2,
                    ],
                ];

                $tingkatKerusakan = [
                    'berat' => 'Rusak Berat',
                    'sedang' => 'Rusak Sedang',
                    'ringan' => 'Rusak Ringan',
                ];

                $index = 100;

            @endphp

            @foreach ($kerusakanPrasarana as $prasarana)
                @php

                    $harga = isset($formulir) ? $formulir->items->where('kategori', $prasarana['kategori'])->first() : null;

                @endphp

                <table class="table table-bordered mt-4">

                    <thead>

                        <tr class="table-light">

                            <th colspan="4">
                                {{ $prasarana['judul'] }}
                            </th>

                        </tr>

                        <tr>

                            <th width="25%">
                                Tingkat Kerusakan
                            </th>

                            <th width="25%">
                                Jumlah
                            </th>

                            <th width="25%">
                                Satuan
                            </th>

                            <th width="25%">
                                Harga Satuan
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($tingkatKerusakan as $tingkat => $label)
                            @php

                                $detail = isset($formulir)
                                    ? $formulir->items->first(function ($item) use ($prasarana, $tingkat) {
                                        return $item->kategori == $prasarana['kategori'] && $item->tingkat_kerusakan == $tingkat;
                                    })
                                    : null;

                            @endphp

                            <tr>

                                <td>

                                    {{ $label }}

                                </td>

                                <td>

                                    <input type="number" class="form-control" name="details[{{ $index }}][jumlah]" value="{{ old("details.$index.jumlah", $detail->jumlah ?? '') }}">

                                    <input type="hidden" name="details[{{ $index }}][kategori]" value="{{ $prasarana['kategori'] }}">

                                    <input type="hidden" name="details[{{ $index }}][tingkat_kerusakan]" value="{{ $tingkat }}">

                                    <input type="hidden" name="details[{{ $index }}][kriteria_id]" value="{{ $prasarana['kriteria_id'] }}">

                                    <input type="hidden" name="details[{{ $index }}][satuan]" value="{{ $prasarana['satuan'] }}">

                                </td>

                                <td>

                                    {{ $prasarana['satuan'] }}

                                </td>

                                <td>

                                    <input type="number" class="form-control" name="details[{{ $index }}][harga_satuan]" value="{{ old("details.$index.harga_satuan", $detail->harga_satuan ?? ($harga->harga_satuan ?? '')) }}">

                                </td>

                            </tr>

                            @php
                                $index++;
                            @endphp
                        @endforeach

                    </tbody>

                </table>
            @endforeach

            <hr class="my-4">

            <div class="d-flex justify-content-end">

                <button type="submit" id="submitBtn" class="btn btn-primary">

                    <i data-feather="save"></i>
                    {{ $edit ? 'Perbarui Data' : 'Simpan Data' }}

                </button>

            </div>

            @if (session('success'))
                <div class="alert alert-success mt-3">

                    {{ session('success') }}

                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger mt-3">

                    {{ session('error') }}

                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mt-3">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>
            @endif

        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Hitung total rumah permanen + non permanen
            function hitungTotalRumah() {

                const rows = document.querySelectorAll('table tbody tr');

                rows.forEach(function(row) {

                    const rumah = row.querySelectorAll('input.rumah');

                    const total = row.querySelector('.total-rumah');

                    if (rumah.length === 2 && total) {

                        const p = parseFloat(rumah[0].value) || 0;
                        const np = parseFloat(rumah[1].value) || 0;

                        total.value = p + np;

                    }

                });

            }

            hitungTotalRumah();

            document.querySelectorAll('input.rumah').forEach(function(input) {

                input.addEventListener('input', hitungTotalRumah);

            });

            const form = document.querySelector('form');

            const submit = document.getElementById('submitBtn');

            if (form) {

                form.addEventListener('submit', function() {

                    submit.disabled = true;

                    submit.innerHTML =
                        '<span class="spinner-border spinner-border-sm"></span> Menyimpan...';

                });

            }

        });
    </script>

@endsection
