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
        <p class="fw-bold">Format 13: Sektor Industri dan UMKM</p>

        <form action="{{ route('forms.form4.format13.store') }}" method="POST">
            @csrf
            <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">

            <table class="table table-bordered">
                <tr>
                    <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                    <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
                </tr>
            </table>

            @php
            $kerusakan = [
                'pabrik' => 'Pabrik / Tempat Usaha',
                'mesin' => 'Mesin dan Peralatan',
                'bahan_baku' => 'Bahan Baku',
                'bahan_jadi' => 'Bahan Jadi',
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

                        @foreach($kerusakan as $kategori => $label)

                        <tr>

                            <td>
                                {{ $label }}
                            </td>

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
                                    value="unit">

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

                        @endforeach

                        @php $detailIndex = 100; @endphp

                    </tbody>

                </table>
            </div>

            @php
            $kehilanganProduksiRows = range(1, 3);
            @endphp

            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">

                    <thead>

                        <tr class="bg-secondary text-white">
                            <th colspan="3">
                                1. KEHILANGAN TOTAL PRODUKSI
                            </th>
                        </tr>

                        <tr>
                            <th>
                                A. Jenis Komoditi
                            </th>

                            <th>
                                B. Jumlah Produksi
                            </th>

                            <th>
                                C. Harga Satuan
                            </th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($kehilanganProduksiRows as $row)

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
                                value="kehilangan_total_produksi">

                            <input
                                type="hidden"
                                name="details[{{ $detailIndex }}][satuan]"
                                value="unit">

                        </tr>

                        @php $detailIndex++; @endphp

                        @endforeach

                    </tbody>

                </table>
            </div>

            @php
            $penurunanProduksiRows = range(1, 3);
            @endphp

            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">

                    <thead>

                        <tr class="bg-secondary text-white">
                            <th colspan="4">
                                2. PENURUNAN PRODUKTIVITAS
                            </th>
                        </tr>

                        <tr>
                            <th>
                                A. Jenis Komoditi
                            </th>

                            <th>
                                B. Produksi Sebelum Bencana
                            </th>

                            <th>
                                C. Produksi Sesudah Bencana
                            </th>
                            <th>
                                D. Harga Satuan
                            </th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($penurunanProduksiRows as $row)

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
                                value="penurunan_produktivitas">

                            <input
                                type="hidden"
                                name="details[{{ $detailIndex }}][satuan]"
                                value="unit">

                        </tr>

                        @php $detailIndex++; @endphp

                        @endforeach

                    </tbody>

                </table>
            </div>

            @php
                $kategoriOngkos = [
                    'biaya_bahan' => 'Biaya Bahan Baku yang Lebih Tinggi',
                    'biaya_operasional' => 'Biaya Operasional yang Lebih Tinggi',
                ];

                $jumlahBaris = 3;
            @endphp

            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">

                    <thead>

                        <tr class="bg-secondary text-white">
                            <th colspan="5">
                                3. KENAIKAN ONGKOS PRODUKSI
                            </th>
                        </tr>

                        <tr>
                            <th></th>
                            <th>A. Jenis Produk</th>
                            <th>B. Biaya Sebelum Bencana</th>
                            <th>C. Biaya Sesudah Bencana</th>
                            <th>D. Harga Satuan</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($kategoriOngkos as $kategori => $label)

                            @for($i = 1; $i <= $jumlahBaris; $i++)

                                <tr>

                                    @if($i == 1)
                                        <td rowspan="{{ $jumlahBaris }}">
                                            {{ $label }}
                                        </td>
                                    @endif

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
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                Rp
                                            </span>

                                            <input
                                                type="number"
                                                class="form-control"
                                                name="details[{{ $detailIndex }}][harga_satuan]">
                                        </div>

                                        <input
                                            type="hidden"
                                            name="details[{{ $detailIndex }}][kategori]"
                                            value="{{ $kategori }}">

                                        <input
                                            type="hidden"
                                            name="details[{{ $detailIndex }}][satuan]"
                                            value="unit">
                                    </td>

                                </tr>

                                @php $detailIndex++; @endphp

                            @endfor

                        @endforeach

                    </tbody>

                </table>
            </div>
            

        

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
