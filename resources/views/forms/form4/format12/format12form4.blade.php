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
    <p class="fw-bold">Format 12: Sektor Perikanan</p>
    
    <form action="{{ route('forms.form4.format12.store') }}" method="POST">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
        
        <table class="table table-bordered">
        <tr>
            <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
            <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
        </tr>
        </table>            
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle" style="width: 100%;">
                <thead>                    
                    <tr class="bg-secondary text-white">
                        <th colspan="5">
                            PERKIRAAN KERUSAKAN
                        </th>
                    </tr>
                </thead>
                    
                <tbody>
                <tr>
                    <td>Perkiraan Kerusakan</td>
                    <td>Jenis Tempat Pemeliharaan</td>
                    <td>Unit Kerusakan</td>
                    <td>Harga Satuan</td>
                </tr>
                    @php
                    $detailIndex = 0;

                    $kerusakan = [
                        'tempat_pemeliharaan' => [
                            'label' => 'Kerusakan Tempat Pemeliharaan Ikan',
                            'placeholder' => 'Jenis Tempat Pemeliharaan',
                            'rows' => 3,
                            'satuan' => 'unit',
                        ],

                        'kapal_perahu' => [
                            'label' => 'Kerusakan Kapal Motor/Perahu Nelayan',
                            'placeholder' => 'Jenis Kapal/Perahu',
                            'rows' => 3,
                            'satuan' => 'unit',
                        ],

                        'tempat_pelelangan' => [
                            'label' => 'Kerusakan Tempat Pelelangan Ikan',
                            'placeholder' => 'Jenis Tempat Pelelangan',
                            'rows' => 3,
                            'satuan' => 'unit',
                        ],
                    ];
                    @endphp

                    @foreach($kerusakan as $kategori => $item)

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
                                <span class="input-group-text">Rp</span>

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
            $detailIndex = 100;

            $kerugian = [
                [
                    'kategori' => 'produksi_hilang_total',
                    'label' => 'A. Produksi Yang Hilang Total',
                    'kolom_jumlah' => 'Jumlah Produksi Yang Hilang',
                    'durasi' => false,
                ],
                [
                    'kategori' => 'penurunan_produktivitas',
                    'label' => 'B. Penurunan Produktivitas',
                    'kolom_jumlah' => 'Penurunan Produktivitas',
                    'durasi' => true,
                ],
                [
                    'kategori' => 'kenaikan_ongkos_produksi',
                    'label' => 'C. Kenaikan Ongkos Produksi',
                    'kolom_jumlah' => 'Kenaikan Biaya',
                    'durasi' => true,
                ],
            ];
            @endphp

            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">

                    <thead>
                        <tr class="bg-secondary text-white">
                            <th colspan="5">
                                PERKIRAAN KERUGIAN
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($kerugian as $section)

                        <tr class="table-light fw-bold">
                            <td style="width:25%">
                                {{ $section['label'] }}
                            </td>

                            <td>
                                Jenis Ikan
                            </td>

                            <td>
                                {{ $section['kolom_jumlah'] }}
                            </td>

                            <td>
                                Harga Satuan
                            </td>

                            @if($section['durasi'])
                                <td>
                                    Jangka Waktu Pemulihan
                                </td>
                            @endif
                        </tr>

                        @for($i = 0; $i < 3; $i++)

                        <tr>
                            <td></td>

                            <td>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="details[{{ $detailIndex }}][sub_kategori]"
                                    placeholder="Jenis Ikan">
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

                            @if($section['durasi'])

                            <td>
                                <div class="input-group">

                                    <input
                                        type="number"
                                        class="form-control"
                                        name="details[{{ $detailIndex }}][durasi]">

                                    <span class="input-group-text">
                                        Bulan
                                    </span>

                                </div>

                                <input
                                    type="hidden"
                                    name="details[{{ $detailIndex }}][durasi_satuan]"
                                    value="bulan">
                            </td>

                            @endif

                            <input
                                type="hidden"
                                name="details[{{ $detailIndex }}][kategori]"
                                value="{{ $section['kategori'] }}">

                            <input
                                type="hidden"
                                name="details[{{ $detailIndex }}][satuan]"
                                value="kg">

                        </tr>

                        @php $detailIndex++; @endphp

                        @endfor

                    @endforeach

                    </tbody>

                </table>
            </div>
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
