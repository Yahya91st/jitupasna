@extends('layouts.main')

@section('content')
<style>
    .table th, .table td {
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
<div class="container mt-4">
    <h5 class="text-center fw-bold" style="color: #F28705;">Formulir 04<br>Pengkajian Kebutuhan Pasca Bencana</h5>
    <p class="fw-bold">Format 2: Sektor Pendidikan</p>
    <form action="{{ isset($edit) && $edit ? route('forms.form4.format2.update', $data['id'] ?? '') : route('forms.form4.format2.store') }}" method="POST">
        @csrf
        @if(isset($edit) && $edit)
            @method('PATCH')
        @endif
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">
        <table class="table table-bordered mb-2">
            <tr>
                <td style="width: 50%">
                    NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" value="{{ old('nama_kampung', $data['nama_kampung'] ?? '') }}" required>
                    @error('nama_kampung')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </td>
                <td>
                    NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" value="{{ old('nama_distrik', $data['nama_distrik'] ?? '') }}" required>
                    @error('nama_distrik')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle small">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 10%;">Bangunan</th>
                        <th colspan="2">Rusak Berat</th>
                        <th colspan="2">Rusak Sedang</th>
                        <th colspan="2">Rusak Ringan</th>
                        <th rowspan="2" style="width: 8%;">Ukuran Ruang</th>
                        <th colspan="3">Harga Satuan (Rp)</th>
                    </tr>
                    <tr>
                        <th>Negeri</th>
                        <th>Swasta</th>
                        <th>Negeri</th>
                        <th>Swasta</th>
                        <th>Negeri</th>
                        <th>Swasta</th>
                        <th>Bangunan</th>
                        <th>Peralatan</th>
                        <th>Meubelair</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $bangunan = [
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

                    @php $index = 0; @endphp

                    @foreach($bangunan as $kategori => $label)

                    <tr>
                        <td>{{ $label }}</td>

                        {{-- Berat Negeri --}}
                        <td>
                            <input type="number"
                                class="form-control auto-row "
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
                                value="1">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- Berat Swasta --}}
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
                                value="1">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- Sedang Negeri --}}
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
                                value="1">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- Sedang Swasta --}}
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
                                value="1">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- Ringan Negeri --}}
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
                                value="1">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        @php $index++; @endphp

                        {{-- Ringan Swasta --}}
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
                                value="1">

                            <input type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">
                        </td>

                        {{-- Ukuran Ruang --}}
                        <td>
                            <input
                                type="number"
                                class="form-control auto-row"
                                name="dimensi[{{ $kategori }}]"
                                placeholder="m²">
                        </td>

                        {{-- Harga Bangunan --}}
                        <td>
                            <input
                                type="number"
                                class="form-control auto-row"
                                name="harga_bangunan[{{ $kategori }}]">
                        </td>

                        {{-- Harga Peralatan --}}
                        <td>
                            <input
                                type="number"
                                class="form-control auto-row"
                                name="harga_peralatan[{{ $kategori }}]">
                        </td>

                        {{-- Harga Meubelair --}}
                        <td>
                            <input
                                type="number"
                                class="form-control auto-row"
                                name="harga_meubelair[{{ $kategori }}]">
                        </td>

                        @php $index++; @endphp
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
        @php
        $biayaPuing = [
            [
                'label' => 'A. Biaya Tenaga Kerja',
                'jumlah_name' => 'biaya_tenaga_kerja_hok',
                'jumlah_suffix' => 'HOK',
                'harga_name' => 'biaya_tenaga_kerja_upah',
                'harga_label' => 'Upah Harian',
            ],
            [
                'label' => 'B. Biaya Alat Berat',
                'jumlah_name' => 'biaya_alat_berat_hari',
                'jumlah_suffix' => 'Hari',
                'harga_name' => 'biaya_alat_berat_harga',
                'harga_label' => 'Tarif per Hari',
            ],
        ];
        @endphp

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="4">1. BIAYA PEMBERSIHAN PUING</th>
                    </tr>
                </thead>
                <tbody>
                    @php $detailIndex = 100; @endphp

                    @foreach($biayaPuing as $item)
                    <tr>
                        <td style="width:15%">
                            {{ $item['label'] }}
                        </td>

                        <td style="width:35%">
                            <div class="input-group">

                                <input
                                    type="number"
                                    name="details[{{ $detailIndex }}][jumlah]"
                                    class="form-control"
                                    placeholder="0"
                                    value="">

                                <span class="input-group-text">
                                    {{ $item['jumlah_suffix'] }}
                                </span>

                                <input type="hidden"
                                    name="details[{{ $detailIndex }}][kategori]"
                                    value="{{ $item['jumlah_name'] }}">

                                <input type="hidden"
                                    name="details[{{ $detailIndex }}][sub_kategori]"
                                    value="jumlah">

                                <input type="hidden"
                                    name="details[{{ $detailIndex }}][satuan]"
                                    value="{{ $item['jumlah_suffix'] }}">
                            </div>
                        </td>

                        <td style="width:15%">
                            {{ $item['harga_label'] }}
                        </td>

                        <td style="width:35%">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input
                                    type="number"
                                    name="details[{{ $detailIndex }}][harga_satuan]"
                                    class="form-control"
                                    placeholder="0"
                                    value="">
                            </div>
                        </td>
                        @php $detailIndex++; @endphp
                    </tr>

                    
                    @endforeach
                </tbody>
            </table>
        </div>
        @php
        $lainnya = [
            [
                'label' => 'Sekolah utk Pengungsian',
                'name' => 'sekolah_pengungsian',
                'placeholder' => 'Unit',
            ],
            [
                'label' => 'Guru Korban Bencana',
                'name' => 'guru_korban',
                'placeholder' => 'Orang',
            ],
            [
                'label' => 'Iuran Sekolah Swasta',
                'name' => 'iuran_sekolah',
                'placeholder' => 'rp',
                'rupiah' => true,
            ],
        ];
        @endphp

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr class="bg-secondary text-white">
                        @foreach($lainnya as $item)
                            <th>{{ $item['label'] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($lainnya as $item)
                        <td>
                            @if(!empty($item['rupiah']))
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="{{ $item['name'] }}"
                                        value="{{ old($item['name']) }}"
                                        placeholder="{{ $item['placeholder'] }}">
                                </div>
                            @else
                                <input
                                    type="number"
                                    class="form-control"
                                    name="{{ $item['name'] }}"
                                    value="{{ old($item['name']) }}"
                                    placeholder="{{ $item['placeholder'] }}">
                            @endif
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mb-4">
            <div class="col-12 text-center">
                <button type="submit" class="btn" style="background-color: #F28705; color: white; border: none;">{{ isset($edit) && $edit ? 'Update Data' : 'Simpan Data' }}</button>
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