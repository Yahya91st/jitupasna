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
    <h5 class="text-center fw-bold" style="color: #F28705;">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 10: Pengumpulan Data Sektor Pertanian & Perkebunan</p>     
    <form action="{{ isset($edit) && $edit ? route('forms.form4.format10.update', $data['id'] ?? '') : route('forms.form4.format10.store') }}" method="POST">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">
        <table class="table table-bordered">
            <tr>
                <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
            </tr>
        </table>

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="5">
                            1. KERUSAKAN LAHAN PERTANIAN
                        </th>
                    </tr>

                    <tr>
                        <th></th>
                        <th>Jenis Tanaman</th>
                        <th>Luas Terdampak (Ha)</th>
                        <th>Umur Tanaman</th>
                        <th>Harga Panen / Ha</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $lahanPertanian = range(1, 6);
                        $detailIndex = 0;
                    @endphp

                    @foreach($lahanPertanian as $row)
                        <tr>
                            <td>Kerusakan Lahan Pertanian</td>

                            <td>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="details[{{ $detailIndex }}][sub_kategori]">
                            </td>

                            <td>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="details[{{ $detailIndex }}][jumlah]">
                            </td>

                            <td>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="details[{{ $detailIndex }}][jumlah2]">
                            </td>

                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>

                                    <input
                                        type="number"
                                        class="form-control"
                                        name="details[{{ $detailIndex }}][harga_satuan]">
                                </div>

                                <input
                                    type="hidden"
                                    name="details[{{ $detailIndex }}][kategori]"
                                    value="kerusakan_lahan_pertanian">

                                <input
                                    type="hidden"
                                    name="details[{{ $detailIndex }}][satuan]"
                                    value="ha">
                            </td>
                        </tr>

                        @php $detailIndex++; @endphp
                    @endforeach

                    @php
                        $bibitTanaman = range(1, 4);
                    @endphp

                    @foreach($bibitTanaman as $row)
                        <tr>
                            <td>Bibit Tanaman</td>

                            <td>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="details[{{ $detailIndex }}][sub_kategori]">
                            </td>

                            <td>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="details[{{ $detailIndex }}][jumlah]">
                            </td>

                            <td>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="details[{{ $detailIndex }}][jumlah2]">
                            </td>

                            <td>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="details[{{ $detailIndex }}][harga_satuan]">

                                <input
                                    type="hidden"
                                    name="details[{{ $detailIndex }}][kategori]"
                                    value="kerusakan_bibit_tanaman">
                                <input
                                    type="hidden"
                                    name="details[{{ $detailIndex }}][satuan]"
                                    value="pohon">
                            </td>
                        </tr>

                        @php $detailIndex++; @endphp

                    @endforeach   
                </tbody>
            </table>                 
                    
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="5">Sarana Irigasi</th>
                    </tr>
                    <tr>
                        <th>Jenis Jaringan</th>
                        <th>Luasan Kerusakan</th>
                        <th>Luas Tanaman Terdampak</th>
                        <th>Perkiraan Biaya Perbaikan</th>
                    </tr>
                </thead>

                <tbody>

                    @php

                    $irigasi = [

                        'primer' => 'Jaringan Primer',
                        'tersier' => 'Jaringan Tersier',
                        'desa' => 'Jaringan Irigasi Desa',

                    ];

                    @endphp

                    @foreach($irigasi as $kode => $label)

                    <tr>

                        <td>
                            {{ $label }}
                        </td>

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $detailIndex }}][jumlah]">
                        </td>

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $detailIndex }}][jumlah2]">
                        </td>

                        <td>

                            <div class="input-group">

                                <span class="input-group-text">
                                    Rp
                                </span>

                                <input
                                    type="number"
                                    class="form-control"
                                    name="details[{{ $detailIndex }}][harga_satuan]">

                                    <input
                                        type="hidden"
                                        name="details[{{ $detailIndex }}][kategori]"
                                        value="sarana_irigasi">
            
                                    <input
                                        type="hidden"
                                        name="details[{{ $detailIndex }}][sub_kategori]"
                                        value="{{ $kode }}">
                                    <input
                                        type="hidden"
                                        name="details[{{ $detailIndex }}][satuan]"
                                        value="ha">
                            </div>

                        </td>


                    </tr>

                        @php $detailIndex++; @endphp

                    @endforeach

                    
                </tbody>
            </table>

            @php
            $mesinRows = range(1,4);
            $tingkatKerusakan = ['berat', 'sedang', 'ringan'];
            @endphp

            @php

            $tingkatKerusakan = [
                'berat',
                'sedang',
                'ringan'
            ];

            @endphp

            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="5">MESIN PERTANIAN DAN PERALATAN</th>
                    </tr>
                    <tr>
                        <th>Jenis</th>
                        <th>Harga Satuan</th>
                        <th>Rusak Berat</th>
                        <th>Rusak Sedang</th>
                        <th>Rusak Ringan</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($mesinRows as $row)

                <tr>
                    <td>
                        {{ $loop->first ? 'Mesin Pertanian & Peralatan' : '' }}
                    </td>

                    <td>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>

                            <input
                                type="number"
                                class="form-control"
                                name="harga_satuan[{{ $row }}]">
                        </div>
                    </td>

                    @foreach($tingkatKerusakan as $tingkat)

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $detailIndex }}][jumlah]">

                            <input
                                type="hidden"
                                name="details[{{ $detailIndex }}][kategori]"
                                value="mesin_pertanian">

                            <input
                                type="hidden"
                                name="details[{{ $detailIndex }}][sub_kategori]"
                                value="baris_{{ $row }}">

                            <input
                                type="hidden"
                                name="details[{{ $detailIndex }}][tingkat_kerusakan]"
                                value="{{ $tingkat }}">

                            <input
                                type="hidden"
                                name="details[{{ $detailIndex }}][satuan]"
                                value="unit">
                        </td>

                        @php $detailIndex++; @endphp

                    @endforeach

                </tr>

            @endforeach

                </tbody>
            </table>

            @php
            $gudangRows = range(1,4);

            $tingkatKerusakan = ['berat', 'sedang', 'ringan'];
            @endphp

            @php

            $tingkatKerusakan = [
                'berat',
                'sedang',
                'ringan'
            ];

            @endphp

            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="5">KERUSAKAN GUDANG DAN BANGUNAN LAINNYA</th>
                    </tr>
                    <tr>
                        <th>Jenis</th>
                        <th>Harga Satuan</th>
                        <th>Rusak Berat</th>
                        <th>Rusak Sedang</th>
                        <th>Rusak Ringan</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($gudangRows as $row)

                <tr>
                    <td>
                        {{ $loop->first ? 'Gudang & Bangunan' : '' }}
                    </td>

                    <td>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>

                            <input
                                type="number"
                                class="form-control"
                                name="harga_satuan[{{ $row }}]">
                        </div>
                    </td>

                    @foreach($tingkatKerusakan as $tingkat)

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $detailIndex }}][jumlah]">

                            <input
                                type="hidden"
                                name="details[{{ $detailIndex }}][kategori]"
                                value="gudang_pertanian">

                            <input
                                type="hidden"
                                name="details[{{ $detailIndex }}][sub_kategori]"
                                value="baris_{{ $row }}">

                            <input
                                type="hidden"
                                name="details[{{ $detailIndex }}][tingkat_kerusakan]"
                                value="{{ $tingkat }}">

                            <input
                                type="hidden"
                                name="details[{{ $detailIndex }}][satuan]"
                                value="unit">
                        </td>

                        @php $detailIndex++; @endphp

                    @endforeach

                </tr>

            @endforeach

                </tbody>
            </table>


            @php
            $produksiHilang = range(1,6);
            @endphp

            <table class="table table-bordered text-center align-middle">

                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="5">
                            PRODUKSI YANG HILANG TOTAL
                        </th>
                    </tr>

                    <tr>
                        <th>Jenis Tanaman</th>
                        <th>Luas Tanaman</th>
                        <th>Produktivitas/Ha</th>
                        <th>Harga Panen/Kg</th>
                        <!-- <th>Total Kehilangan</th> -->
                    </tr>
                </thead>

                <tbody>

                @foreach($produksiHilang as $row)

                    <tr>

                        <td>
                            <input
                                type="text"
                                class="form-control"
                                name="details[{{ $detailIndex }}][sub_kategori]">
                        </td>

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $detailIndex }}][jumlah]">
                        </td>

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $detailIndex }}][jumlah2]">
                        </td>

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $detailIndex }}][harga_satuan]">
                        </td>

                        <!-- <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $detailIndex }}][jumlah]">
                        </td> -->

                        <input
                            type="hidden"
                            name="details[{{ $detailIndex }}][kategori]"
                            value="produksi_hilang">
                        <input
                            type="hidden"
                            name="details[{{ $detailIndex }}][satuan]"
                            value="ha">

                    </tr>

                    @php $detailIndex++; @endphp

                @endforeach

                </tbody>

            </table>

            @php
            $penurunanProduksi = range(1,6);
            @endphp

            <table class="table table-bordered text-center align-middle">

                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="5">
                            Penurunan Produksi
                        </th>
                    </tr>

                    <tr>
                        <th>Jenis Tanaman</th>
                        <th>Luas Tanaman</th>
                        <th>Selisih Penurunan Produktivitas/Ha</th>
                        <th>Harga Panen/Kg</th>
                        <th>Jangka Waktu Penurunan Produktivitas</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($penurunanProduksi as $row)

                    <tr>

                        <td>
                            <input
                                type="text"
                                class="form-control"
                                name="details[{{ $detailIndex }}][sub_kategori]">
                        </td>

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $detailIndex }}][jumlah]">
                        </td>

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $detailIndex }}][jumlah2]">
                        </td>

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $detailIndex }}][harga_satuan]">
                        </td>

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $detailIndex }}][durasi]">
                        </td>

                        <input
                            type="hidden"
                            class="form-control"
                            name="details[{{ $detailIndex }}][durasi_satuan]"
                            value="bulan">

                        <input
                            type="hidden"
                            name="details[{{ $detailIndex }}][kategori]"
                            value="produksi_turun">
                        <input
                            type="hidden"
                            name="details[{{ $detailIndex }}][satuan]"
                            value="ha">

                    </tr>

                    @php $detailIndex++; @endphp

                @endforeach

                </tbody>

            </table>

            @php
            $kenaikanOngkosProduksi = range(1,6);
            @endphp

            <table class="table table-bordered text-center align-middle">

                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="5">
                            Kenaikan Ongkos Produksi
                        </th>
                    </tr>

                    <tr>
                        <th>Jenis Tanaman</th>
                        <th>Luas Tanaman</th>
                        <th>Selisih Penurunan Kenaikan Ongkos Produksi</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($kenaikanOngkosProduksi as $row)

                    <tr>

                        <td>
                            <input
                                type="text"
                                class="form-control"
                                name="details[{{ $detailIndex }}][sub_kategori]">
                        </td>

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $detailIndex }}][jumlah]">
                        </td>

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $detailIndex }}][jumlah2]">
                        </td>

                        <input
                            type="hidden"
                            name="details[{{ $detailIndex }}][kategori]"
                            value="ongkos_produksi">
                        <input
                            type="hidden"
                            name="details[{{ $detailIndex }}][satuan]"
                            value="ha">

                    </tr>

                    @php $detailIndex++; @endphp

                @endforeach

                </tbody>

            </table>
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

    document.querySelectorAll('input[type="number"]:not([readonly]), input[type="text"]:not([readonly])')
        .forEach(function(input) {

            if (input.value === '') {
                input.value = 1;
            }

        });

});
</script>
@endsection