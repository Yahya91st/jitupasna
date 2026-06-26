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
    <h5 class="text-center fw-bold" style="color: #F28705;">Formulir 04<br>Pengkajian Kebutuhan Pasca Bencana</h5>
    <p class="fw-bold">Format 11: Sektor Peternakan</p>

    <form action="{{ route('forms.form4.format11.store') }}" method="POST">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
        <input type="hidden" name="kabupaten" value="Default">
        
        <table class="table table-bordered">
            <tr>
                <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
            </tr>
        </table>
                
        @php
        $kelompokPeternakan = [
            'kematian_ternak' => [
                'label' => 'A. Kematian Hewan Ternak',
                'placeholder' => 'Jenis Hewan Ternak',
                'rows' => 3,
                'satuan' => 'ekor',
            ],

            'kerusakan_kandang' => [
                'label' => 'B. Kerusakan Kandang',
                'placeholder' => 'Jenis Kandang',
                'rows' => 3,
                'satuan' => 'unit',
            ],

            'kerusakan_peralatan' => [
                'label' => 'C. Kerusakan Peralatan Kandang',
                'placeholder' => 'Jenis Peralatan',
                'rows' => 3,
                'satuan' => 'unit',
            ],            
        ];

        $detailIndex = 0;
        @endphp

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle small">

                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="4">
                            PERKIRAAN KERUSAKAN DAN KERUGIAN
                        </th>
                    </tr>

                    <tr>
                        <th style="width:25%">
                            Uraian
                        </th>

                        <th>
                            Jenis Hewan / Produk
                        </th>

                        <th style="width:15%">
                            Jumlah
                        </th>

                        <th style="width:20%">
                            Harga Satuan (Rp)
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($kelompokPeternakan as $kategori => $item)

                        @for($row = 0; $row < $item['rows']; $row++)

                        <tr>

                            @if($row == 0)
                            <td rowspan="{{ $item['rows'] }}">
                                {{ $item['label'] }}
                            </td>
                            @endif

                            <td>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="{{ $item['placeholder'] }}"
                                    name="details[{{ $detailIndex }}][sub_kategori]">

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
                                value="{{ $kategori }}">

                            <input
                                type="hidden"
                                name="details[{{ $detailIndex }}][satuan]"
                                value="{{ $item['satuan'] }}">

                        </tr>

                        @php $detailIndex++; @endphp

                        @endfor

                    @endforeach

                </tbody>

            </table>

            @php
            $produksiHilangTotal = range(1,6);
            @endphp

            <table class="table table-bordered text-center align-middle">

                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="3">
                            Produksi yang Hilang Total
                        </th>
                    </tr>

                    <tr>
                        <th>Jenis Hewan Ternak</th>
                        <th>Jumlah Hewan yang Hilang</th>
                        <th>Harga Satugan Ternak/Produk Ternak</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($produksiHilangTotal as $row)

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
                                name="details[{{ $detailIndex }}][harga_satuan]">
                        </td>

                        <input
                            type="hidden"
                            name="details[{{ $detailIndex }}][kategori]"
                            value="produksi_hilang">
                        <input
                            type="hidden"
                            name="details[{{ $detailIndex }}][satuan]"
                            value="ekor">

                    </tr>

                    @php $detailIndex++; @endphp

                @endforeach

                </tbody>

            </table>

            @php
            $penurunanProduksivitas = range(1,6);
            @endphp

            <table class="table table-bordered text-center align-middle">

                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="4">
                            Penurunan Produksivitas
                        </th>
                    </tr>

                    <tr>
                        <th>Jenis Produk Ternak</th>
                        <th>Penurunan Produktivitas Per Hari/Bulan/Tahun</th>
                        <th>Harga Satugan Ternak/Produk Ternak</th>
                        <th>Perkiraan Waktu Jangka Pemulihan</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($penurunanProduksivitas as $row)

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
                            value="penurunan_produktivitas">
                        <input
                            type="hidden"
                            name="details[{{ $detailIndex }}][satuan]"
                            value="ekor">

                    </tr>

                    @php $detailIndex++; @endphp

                @endforeach

                </tbody>

            </table>

            @php
            $kenaikanOngkos = range(1,6);
            @endphp

            <table class="table table-bordered text-center align-middle">

                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="4">
                            Kenaikan Ongkos Produksi
                        </th>
                    </tr>

                    <tr>
                        <th>Jenis Produk Ternak</th>
                        <th>Kenaikan Ongkos Produksi</th>
                        <th>Jumlah Hewan yang Terpengaruh</th>
                        <th>Perkiraan Jangka Waktu Pemulihan</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($kenaikanOngkos as $row)

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
                            value="kenaikan_ongkos">

                        <input
                            type="hidden"
                            name="details[{{ $detailIndex }}][satuan]"
                            value="rp">
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
