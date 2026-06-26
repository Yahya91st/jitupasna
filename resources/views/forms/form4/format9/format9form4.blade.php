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
    <p class="fw-bold">Format 9: Sektor Telkom</p>    
    <form action="{{ route('forms.form4.format9.store') }}" method="POST">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">        
            <table class="table table-bordered">
                <tr>
                    <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                    <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
                </tr>
            </table>

        @php
            $komponenKerusakan = range(1, 4);
            $detailIndex = 0;
        @endphp

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="4">
                            PERKIRAAN KERUSAKAN
                        </th>
                    </tr>

                    <tr>
                        <th style="width:40%">
                            Komponen
                        </th>

                        <th>
                            Satuan
                        </th>

                        <th>
                            Jumlah
                        </th>

                        <th>
                            Harga Satuan
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($komponenKerusakan as $urut)

                    <tr>

                        <td>
                            <input
                                type="text"
                                class="form-control"
                                name="details[{{ $detailIndex }}][komponen]"
                                placeholder="Nama Komponen">
                        </td>

                        <td>
                            <input
                                type="text"
                                class="form-control"
                                name="details[{{ $detailIndex }}][satuan]"
                                placeholder="Satuan"
                                value="unit">
                        </td>

                        <td>
                            <input
                                type="number"
                                class="form-control"
                                name="details[{{ $detailIndex }}][jumlah]">
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
                            </div>
                        </td>

                        <input
                            type="hidden"
                            name="details[{{ $detailIndex }}][kategori]"
                            value="kerusakan_sarana_prasarana">

                        <input
                            type="hidden"
                            name="details[{{ $detailIndex }}][sub_kategori]"
                            value="komponen_{{ $urut }}">

                    </tr>

                    @php $detailIndex++; @endphp

                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">

                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="2">
                            PERKIRAAN KERUGIAN
                        </th>
                    </tr>
                </thead>

                <tbody>
                    {{-- DURASI --}}
                    <tr>
                        <td style="width:40%">
                            Jangka Waktu Pemulihan
                        </td>

                        <td>
                            <div class="input-group">
                                <input type="number"
                                    class="form-control"
                                    name="global[durasi]">
                                <input type="hidden"
                                    class="form-control"
                                    name="global[durasi_satuan]"
                                    value="bulan">

                                <span class="input-group-text">bulan</span>
                            </div>
                        </td>
                    </tr>
                    <tr class="bg-secondary text-white">
                        <th colspan="2">
                            PERKIRAAN KEHILANGAN / PENURUNAN PENDAPATAN
                        </th>
                    </tr>
                    <input type="hidden"
                        class="form-control"
                        name="penurunan_pendapatan[kategori]"
                        value="permintaan_telekomunikasi">
                    <input type="hidden"
                        class="form-control"
                        name="penurunan_pendapatan[satuan]"
                        value="permintaan">
                    {{-- JUMLAH SEBELUM (jumlah1) --}}
                    <tr>
                        <td>
                            Permintaan Sebelum Bencana
                        </td>

                        <td>
                            <div class="input-group">
                                <input type="number"
                                    class="form-control"
                                    name="penurunan_pendapatan[jumlah]">

                                <span class="input-group-text">pelanggan</span>
                            </div>
                        </td>
                    </tr>

                    {{-- JUMLAH SESUDAH (jumlah2) --}}
                    <tr>
                        <td>
                            Permintaan Pasca Bencana
                        </td>

                        <td>
                            <div class="input-group">
                                <input type="number"
                                    class="form-control"
                                    name="penurunan_pendapatan[jumlah2]">

                                <span class="input-group-text">pelanggan</span>
                            </div>
                        </td>
                    </tr>

                    {{-- HARGA SATUAN --}}
                    <tr>
                        <td>
                            Tarif
                        </td>

                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>

                                <input type="number"
                                    class="form-control"
                                    name="penurunan_pendapatan[harga_satuan]">
                            </div>
                        </td>
                    </tr>

                    {{-- TOTAL (HASIL HITUNG) --}}
                    <tr>
                        <td>
                            Penurunan Pendapatan
                        </td>

                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>

                                <input type="number"
                                    class="form-control"
                                    name="penurunan_pendapatan[total]"
                                    readonly>
                            </div>
                        </td>
                    </tr>

                    <tr class="bg-secondary text-white">
                        <th colspan="2">
                            PERKIRAAN KENAIKAN BIAYA OPERASIONAL
                        </th>
                    </tr>
                    <input type="hidden"
                        class="form-control"
                        name="operasional[kategori]"
                        value="operasional">
                    <input type="hidden"
                        class="form-control"
                        name="operasional[satuan]"
                        value="rp">
                
                    {{-- B: SEBELUM --}}
                    <tr>
                        <td style="width:40%">
                            Biaya Operasional Sebelum
                        </td>

                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>

                                <input type="number"
                                    class="form-control"
                                    name="operasional[jumlah]">
                            </div>
                        </td>
                    </tr>

                    {{-- C: PASCA --}}
                    <tr>
                        <td>
                            Biaya Operasional Pasca
                        </td>

                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>

                                <input type="number"
                                    class="form-control"
                                    name="operasional[jumlah2]">
                            </div>
                        </td>
                    </tr>

                    {{-- A: BULAN --}}
                    <tr>
                        <td>
                            Jangka Waktu (Bulan)
                        </td>

                        <td>
                            <div class="input-group">
                                <input type="number"
                                    class="form-control"
                                    name="operasional[bulan]">

                                <span class="input-group-text">bulan</span>
                            </div>
                        </td>
                    </tr>

                    {{-- E: HASIL --}}
                    <tr>
                        <td>
                            Kenaikan Biaya Operasional
                        </td>

                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>

                                <input type="number"
                                    class="form-control"
                                    name="operasional[total]"
                                    readonly>
                            </div>
                        </td>
                    </tr>

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