@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel dan input agar lebih kompak */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
    }
    .table input.form-control {
        padding: 0.15rem 0.3rem !important;
        font-size: 0.95rem;
    }
</style>
<div class="container mt-4">
    <h5 class="text-center fw-bold"style="color: #F28705;">Formulir 04<br>Pengkajian Kebutuhan Pasca Bencana</h5>
    <p class="fw-bold">Format 14: Sektor Perdagangan</p>

    <form action="{{ isset($edit) && $edit ? route('forms.form4.format14.update', $data->id) : route('forms.form4.format14.store') }}" method="POST">
        @csrf
        @if(isset($edit) && $edit)
            @method('PATCH')
        @endif
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">
        <input type="hidden" name="kabupaten" value="{{ old('kabupaten', $data->kabupaten ?? 'Papua Selatan') }}">

        <table class="table table-bordered">
            <tr>
                <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
            </tr>
        </table>

        @php
        $kerusakanItems = [
            'tempat_usaha' => 'Tempat Usaha (Pasar, Warung, Toko)',
            'peralatan' => 'Peralatan',
            'barang_dagangan' => 'Barang Dagangan',
        ];

        $index = 0;
        @endphp

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle small">

                <thead>

                    <tr class="bg-white">
                        <th rowspan="2">
                            Jenis Tempat Usaha
                        </th>

                        <th colspan="2">
                            Rusak Berat
                        </th>

                        <th colspan="2">
                            Rusak Sedang
                        </th>

                        <th colspan="2">
                            Rusak Ringan
                        </th>
                    </tr>

                    <tr>
                        <th>Jumlah</th>
                        <th>Harga</th>

                        <th>Jumlah</th>
                        <th>Harga</th>

                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>

                </thead>

                <tbody>

                    <tr class="bg-secondary text-white">
                        <td colspan="7">
                            PERKIRAAN KERUSAKAN
                        </td>
                    </tr>

                    @foreach($kerusakanItems as $kategori => $label)

                        @for($i = 1; $i <= 3; $i++)

                            <tr>

                                @if($i == 1)
                                <td rowspan="3" class="align-middle">
                                    {{ $label }}
                                </td>
                                @endif

                                @foreach(['berat','sedang','ringan'] as $tingkat)

                                <td>

                                    <input
                                        type="number"
                                        class="form-control"
                                        name="details[{{ $index }}][jumlah]">

                                    <input
                                        type="hidden"
                                        name="details[{{ $index }}][kategori]"
                                        value="{{ $kategori }}">

                                    <input
                                        type="hidden"
                                        name="details[{{ $index }}][tingkat_kerusakan]"
                                        value="{{ $tingkat }}">

                                    <input
                                        type="hidden"
                                        name="details[{{ $index }}][sub_kategori]"
                                        value="kerusakan">

                                    <input
                                        type="hidden"
                                        name="details[{{ $index }}][satuan]"
                                        value="unit">

                                </td>

                                <td>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            Rp
                                        </span>

                                        <input
                                            type="number"
                                            class="form-control"
                                            name="details[{{ $index }}][harga_satuan]">

                                    </div>

                                </td>

                                @php $index++; @endphp

                                
                                @endforeach
                                
                            </tr>
                            
                        @endfor
                    @endforeach

                </tbody>

            </table>
        </div>

        @php

        $kerugianItems = [
            [
                'title' => 'A. Kehilangan Penjualan Total',
                'kategori' => 'kehilangan_penjualan',
                'kolom_a' => 'Nama Tempat Usaha',
                'kolom_b' => 'Penjualan Normal',
                'kolom_c' => 'Jangka Waktu Pemulihan',
                'satuan_a' => 'unit',
                'satuan_b' => 'rp',
                'satuan_c' => 'bulan',
            ],
            [
                'title' => 'B. Penurunan Produktivitas',
                'kategori' => 'penurunan_produktivitas',
                'kolom_a' => 'Nama Tempat Usaha',
                'kolom_b' => 'Produksi Normal',
                'kolom_c' => 'Jangka Waktu Pemulihan',
                'satuan_a' => 'unit',
                'satuan_b' => 'unit',
                'satuan_c' => 'bulan',
            ],
            [
                'title' => 'C. Kenaikan Biaya Produksi',
                'kategori' => 'kenaikan_biaya_produksi',
                'kolom_a' => 'Nama Tempat Usaha',
                'kolom_b' => 'Biaya Operasional',
                'kolom_c' => 'Jangka Waktu Pemulihan',
                'satuan_a' => 'unit',
                'satuan_b' => 'rp',
                'satuan_c' => 'bulan',
            ],
        ];

        @endphp

        <div class="table-responsive mt-3">
            <table class="table table-bordered text-center align-middle">

                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="4">
                            PERKIRAAN KERUGIAN
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($kerugianItems as $item)

                    <tr class="table-light">
                        <td colspan="4" class="fw-bold text-start">
                            {{ $item['title'] }}
                        </td>
                    </tr>

                    <tr>
                        <th>{{ $item['kolom_a'] }}</th>
                        <th>{{ $item['kolom_b'] }}</th>
                        <th>{{ $item['kolom_c'] }}</th>
                        <!-- <th>Harga Satuan</th> -->
                    </tr>

                    @for($row = 1; $row <= 3; $row++)

                    <tr>

                        <td>

                            <input
                                type="text"
                                class="form-control"
                                name="details[{{ $index }}][nama]">

                        </td>

                        <td>

                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $index }}][jumlah]">

                        </td>

                        <td>

                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $index }}][durasi]">

                        </td>

                        <!-- <td>

                            <div class="input-group">

                                <span class="input-group-text">
                                    Rp
                                </span>

                                <input
                                    type="number"
                                    class="form-control"
                                    name="details[{{ $index }}][harga_satuan]">

                            </div>

                        </td> -->

                        <input
                            type="hidden"
                            name="details[{{ $index }}][kategori]"
                            value="{{ $item['kategori'] }}">

                        <input
                            type="hidden"
                            name="details[{{ $index }}][sub_kategori]"
                            value="usaha">

                        <input
                            type="hidden"
                            name="details[{{ $index }}][satuan]"
                            value="{{ $item['satuan_b'] }}">
                        <input
                            type="hidden"
                            name="details[{{ $index }}][durasi_satuan]"
                            value="bulan">

                    </tr>

                    @php $index++; @endphp

                    @endfor

                    @endforeach

                </tbody>

            </table>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger mt-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success mt-4">{{ session('success') }}</div>
        @endif

        <!-- <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Total Perhitungan</h5>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Total Perkiraan Kerusakan:</strong><br>
                        RB: Rp. <?php 
                            $total_rb = 0;
                            for($i = 1; $i <= 3; $i++) {
                                $total_rb += (old("tempatusaha_{$i}_rb_jumlah", $data->{"tempatusaha_{$i}_rb_jumlah"} ?? 0) * old("tempatusaha_{$i}_rb_harga", $data->{"tempatusaha_{$i}_rb_harga"} ?? 0));
                                $total_rb += (old("peralatan_{$i}_rb_jumlah", $data->{"peralatan_{$i}_rb_jumlah"} ?? 0) * old("peralatan_{$i}_rb_harga", $data->{"peralatan_{$i}_rb_harga"} ?? 0));
                                $total_rb += (old("barangdagangan_{$i}_rb_jumlah", $data->{"barangdagangan_{$i}_rb_jumlah"} ?? 0) * old("barangdagangan_{$i}_rb_harga", $data->{"barangdagangan_{$i}_rb_harga"} ?? 0));
                            }
                            echo number_format($total_rb, 0, ',', '.');
                        ?><br>
                        RS: Rp. <?php 
                            $total_rs = 0;
                            for($i = 1; $i <= 3; $i++) {
                                $total_rs += (old("tempatusaha_{$i}_rs_jumlah", $data->{"tempatusaha_{$i}_rs_jumlah"} ?? 0) * old("tempatusaha_{$i}_rs_harga", $data->{"tempatusaha_{$i}_rs_harga"} ?? 0));
                                $total_rs += (old("peralatan_{$i}_rs_jumlah", $data->{"peralatan_{$i}_rs_jumlah"} ?? 0) * old("peralatan_{$i}_rs_harga", $data->{"peralatan_{$i}_rs_harga"} ?? 0));
                                $total_rs += (old("barangdagangan_{$i}_rs_jumlah", $data->{"barangdagangan_{$i}_rs_jumlah"} ?? 0) * old("barangdagangan_{$i}_rs_harga", $data->{"barangdagangan_{$i}_rs_harga"} ?? 0));
                            }
                            echo number_format($total_rs, 0, ',', '.');
                        ?><br>
                        RR: Rp. <?php 
                            $total_rr = 0;
                            for($i = 1; $i <= 3; $i++) {
                                $total_rr += (old("tempatusaha_{$i}_rr_jumlah", $data->{"tempatusaha_{$i}_rr_jumlah"} ?? 0) * old("tempatusaha_{$i}_rr_harga", $data->{"tempatusaha_{$i}_rr_harga"} ?? 0));
                                $total_rr += (old("peralatan_{$i}_rr_jumlah", $data->{"peralatan_{$i}_rr_jumlah"} ?? 0) * old("peralatan_{$i}_rr_harga", $data->{"peralatan_{$i}_rr_harga"} ?? 0));
                                $total_rr += (old("barangdagangan_{$i}_rr_jumlah", $data->{"barangdagangan_{$i}_rr_jumlah"} ?? 0) * old("barangdagangan_{$i}_rr_harga", $data->{"barangdagangan_{$i}_rr_harga"} ?? 0));
                            }
                            echo number_format($total_rr, 0, ',', '.');
                        ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Total Perkiraan Kerugian:</strong><br>
                        Kehilangan Penjualan: Rp. <?php 
                            $total_kehilangan = 0;
                            for($i = 1; $i <= 3; $i++) {
                                $total_kehilangan += old("kehilangan_penjualan_{$i}_total", $data->{"kehilangan_penjualan_{$i}_total"} ?? 0);
                            }
                            echo number_format($total_kehilangan, 0, ',', '.');
                        ?><br>
                        Penurunan Produktifitas: Rp. <?php 
                            $total_produktifitas = 0;
                            for($i = 1; $i <= 3; $i++) {
                                $total_produktifitas += old("penurunan_produktifitas_{$i}_total", $data->{"penurunan_produktifitas_{$i}_total"} ?? 0);
                            }
                            echo number_format($total_produktifitas, 0, ',', '.');
                        ?><br>
                        Kenaikan Biaya: Rp. <?php 
                            $total_kenaikan = 0;
                            for($i = 1; $i <= 3; $i++) {
                                $total_kenaikan += old("kenaikan_biaya_{$i}_total", $data->{"kenaikan_biaya_{$i}_total"} ?? 0);
                            }
                            echo number_format($total_kenaikan, 0, ',', '.');
                        ?>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <strong>TOTAL KESELURUHAN: Rp. <?php 
                        echo number_format(($total_rb + $total_rs + $total_rr + $total_kehilangan + $total_produktifitas + $total_kenaikan), 0, ',', '.');
                    ?></strong>
                </div>
            </div>
        </div> -->

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

    document.querySelectorAll('input[type="number"]:not([readonly]), input[type="text"]:not([readonly])')
        .forEach(function(input) {

            if (input.value === '') {
                input.value = 1;
            }

        });

});
</script>
@endsection
