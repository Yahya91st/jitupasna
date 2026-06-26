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
    <p class="fw-bold">Format 15: Sektor Pariwisata</p>

    <form action="{{ isset($edit) && $edit ? route('forms.form4.format15.update', $data->id) : route('forms.form4.format15.store') }}" method="POST">
        @csrf
        @if(isset($edit) && $edit)
            @method('PATCH')
        @endif
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">
        <input type="hidden" name="kabupaten" value="{{ $bencana->kabupaten ?? 'Papua Selatan' }}">

        <table class="table table-bordered">
            <tr>
                <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
            </tr>
        </table>

        @php
        $fasilitasWisata = [
            'tempat_wisata' => 'Tempat Wisata',
            'hotel_restaurant' => 'Hotel dan Restaurant',
        ];

        $index = 0;
        @endphp

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle small">

                <thead>

                    <tr class="bg-secondary text-white">

                        <th rowspan="2">
                            Keterangan
                        </th>

                        <th rowspan="2">
                            Jenis Fasilitas
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

                        <th>Unit</th>
                        <th>Harga</th>

                        <th>Unit</th>
                        <th>Harga</th>

                        <th>Unit</th>
                        <th>Harga</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($fasilitasWisata as $kategori => $label)

                        @for($row = 1; $row <= 3; $row++)

                        <tr>

                            @if($row == 1)
                            <td rowspan="3" class="align-middle">
                                {{ $label }}
                            </td>
                            @endif

                            <td>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="details[{{ $index }}][nama]">

                            </td>

                            @foreach(['berat','sedang','ringan'] as $tingkat)

                            <td>

                                <input
                                    type="number"
                                    class="form-control"
                                    name="details[{{ $index }}][jumlah]">

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
                                    value="fasilitas">

                                <input
                                    type="hidden"
                                    name="details[{{ $index }}][satuan]"
                                    value="unit">

                                @php $index++; @endphp

                            </td>

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
                'label' => 'A. Kehilangan Total Pendapatan',
                'kategori' => 'kehilangan_total_pendapatan',
            ],
            [
                'label' => 'B. Penurunan Pendapatan',
                'kategori' => 'penurunan_pendapatan',
            ],
            [
                'label' => 'C. Kenaikan Biaya Produksi',
                'kategori' => 'kenaikan_biaya_produksi',
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
                        
                    </tr>

                    <tr>
                        <th></th>
                        <th>Jenis Fasilitas</th>
                        <th>Pendapatan Normal</th>
                        <th>Jangka Waktu Pemulihan</th>
                    </tr>

                    @for($row = 1; $row <= 3; $row++)

                    <tr>
                        @if ($row == 1)
                        <td rowspan="3" class="fw-bold text-start">
                            {{ $item['label'] }}
                        </td>
                        @endif

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
                            value="rp">
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
    
    <hr class="my-4">
    
    <!-- <div class="card mt-4">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Total Kerusakan (Otomatis)</h5>
        </div>
        <div class="card-body text-center">
             @php
            $totalKerusakan = 0;
            for ($i = 1; $i <= 3; $i++) {
                $totalKerusakan += ($data->{'tempat_wisata_'.$i.'_rb'} ?? 0) * ($data->{'tempat_wisata_'.$i.'_rb_harga'} ?? 0);
                $totalKerusakan += ($data->{'tempat_wisata_'.$i.'_rs'} ?? 0) * ($data->{'tempat_wisata_'.$i.'_rs_harga'} ?? 0);
                $totalKerusakan += ($data->{'tempat_wisata_'.$i.'_rr'} ?? 0) * ($data->{'tempat_wisata_'.$i.'_rr_harga'} ?? 0);
            }
            for ($i = 1; $i <= 3; $i++) {
                $totalKerusakan += ($data->{'hotel_restaurant_'.$i.'_rb'} ?? 0) * ($data->{'hotel_restaurant_'.$i.'_rb_harga'} ?? 0);
                $totalKerusakan += ($data->{'hotel_restaurant_'.$i.'_rs'} ?? 0) * ($data->{'hotel_restaurant_'.$i.'_rs_harga'} ?? 0);
                $totalKerusakan += ($data->{'hotel_restaurant_'.$i.'_rr'} ?? 0) * ($data->{'hotel_restaurant_'.$i.'_rr_harga'} ?? 0);
            }
            @endphp

            <input type="hidden" name="total_kerusakan" value="{{ old('total_kerusakan', $totalKerusakan) }}">
            {{-- $totalKerusakan sudah dihitung di atas --}}
             <h4 class="mb-1">Rp {{ number_format($totalKerusakan, 0, ',', '.') }}</h4>
             <small>Total Kerusakan Format 15</small>
        </div>
    </div> -->
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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
