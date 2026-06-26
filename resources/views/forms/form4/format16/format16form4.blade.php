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
    <p class="fw-bold">Format 16: Sektor Pemerintahan</p>

    <form action="{{ isset($edit) && $edit ? route('forms.form4.format16.update', $data->id) : route('forms.form4.format16.store') }}" method="POST">
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
        $kerusakanItems = [
            'kantor_pemkab' => 'Kantor Pemkab',
            'kantor_kecamatan' => 'Kantor Kecamatan',
            'kantor_dinas' => 'Kantor Dinas',
            'kantor_vertikal' => 'Kantor Instansi Vertikal/Pemerintah Pusat',
            'mebelair' => 'Mebelair dan Peralatan Kantor',
        ];

        $index = 0;
        @endphp

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle small">

                <thead>

                    <tr class="bg-white">

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

                    <tr class="bg-secondary text-white">
                        <td colspan="7">
                            PERKIRAAN KERUSAKAN
                        </td>
                    </tr>

                    @foreach($kerusakanItems as $kategori => $label)

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
                                value="kerusakan">

                            <input
                                type="hidden"
                                name="details[{{ $index }}][satuan]"
                                value="unit">

                            @php $index++; @endphp

                        </td>

                        @endforeach

                    </tr>

                    @endforeach

                </tbody>

            </table>
        </div>

        <div class="table-responsive"> 
            <table class="table table-bordered text-center align-middle" style="width: 100%;">
                <tr>
                    <td class="bg-secondary align-middle fw-bold text-white text-center" colspan="7">
                        PERKIRAAN KERUGIAN
                    </td>
                </tr>

                <tr class="fw-bold">
                    <td>A. Biaya Pembersihan Puing</td>
                    <td colspan="2">Volume</td>
                    <td colspan="2">Tarif</td>
                    <td colspan="2">Satuan</td>
                </tr>

                <tr>
                    <td>Tenaga Kerja</td>

                    <td colspan="2">
                        <input type="number"
                            name="biaya_tenaga_kerja_hok"
                            class="form-control"
                            value="{{ old('biaya_tenaga_kerja_hok', $data->biaya_tenaga_kerja_hok ?? '') }}">
                    </td>

                    <td colspan="2">
                        <input type="number"
                            name="upah_harian"
                            class="form-control"
                            value="{{ old('upah_harian', $data->upah_harian ?? '') }}">
                    </td>

                    <td colspan="2">HOK</td>
                </tr>

                <tr>
                    <td>Alat Berat</td>

                    <td colspan="2">
                        <input type="number"
                            name="biaya_alat_berat_hari"
                            class="form-control"
                            value="{{ old('biaya_alat_berat_hari', $data->biaya_alat_berat_hari ?? '') }}">
                    </td>

                    <td colspan="2">
                        <input type="number"
                            name="biaya_alat_berat_tarif"
                            class="form-control"
                            value="{{ old('biaya_alat_berat_tarif', $data->biaya_alat_berat_tarif ?? '') }}">
                    </td>

                    <td colspan="2">Hari</td>
                </tr>
            </table>
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

        <hr class="my-4">

        <!-- <div class="card mt-4">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Total Kerusakan (Otomatis)</h5>
            </div>
            <div class="card-body text-center">
                @php
                    $totalKerusakan = 0;
                    
                    // Kantor Pemkab
                    $totalKerusakan += ($data->kantor_pemkab_berat ?? 0) * ($data->kantor_pemkab_rb_harga ?? 0);
                    $totalKerusakan += ($data->kantor_pemkab_sedang ?? 0) * ($data->kantor_pemkab_rs_harga ?? 0);
                    $totalKerusakan += ($data->kantor_pemkab_ringan ?? 0) * ($data->kantor_pemkab_rr_harga ?? 0);
                    
                    // Kantor Kecamatan
                    $totalKerusakan += ($data->kantor_kecamatan_berat ?? 0) * ($data->kantor_kecamatan_rb_harga ?? 0);
                    $totalKerusakan += ($data->kantor_kecamatan_sedang ?? 0) * ($data->kantor_kecamatan_rs_harga ?? 0);
                    $totalKerusakan += ($data->kantor_kecamatan_ringan ?? 0) * ($data->kantor_kecamatan_rr_harga ?? 0);
                    
                    // Kantor Dinas
                    $totalKerusakan += ($data->kantor_dinas_berat ?? 0) * ($data->kantor_dinas_rb_harga ?? 0);
                    $totalKerusakan += ($data->kantor_dinas_sedang ?? 0) * ($data->kantor_dinas_rs_harga ?? 0);
                    $totalKerusakan += ($data->kantor_dinas_ringan ?? 0) * ($data->kantor_dinas_rr_harga ?? 0);
                    
                    // Kantor Vertikal
                    $totalKerusakan += ($data->kantor_vertikal_berat ?? 0) * ($data->kantor_vertikal_rb_harga ?? 0);
                    $totalKerusakan += ($data->kantor_vertikal_sedang ?? 0) * ($data->kantor_vertikal_rs_harga ?? 0);
                    $totalKerusakan += ($data->kantor_vertikal_ringan ?? 0) * ($data->kantor_vertikal_rr_harga ?? 0);
                    
                    // Mebelair
                    $totalKerusakan += ($data->mebelair_berat ?? 0) * ($data->mebelair_rb_harga ?? 0);
                    $totalKerusakan += ($data->mebelair_sedang ?? 0) * ($data->mebelair_rs_harga ?? 0);
                    $totalKerusakan += ($data->mebelair_ringan ?? 0) * ($data->mebelair_rr_harga ?? 0);
                    
                    // Biaya Pembersihan
                    $totalKerusakan += ($data->biaya_tenaga_kerja_hok ?? 0) * ($data->upah_harian ?? 0);
                    $totalKerusakan += ($data->biaya_alat_berat_hari ?? 0) * ($data->biaya_alat_berat_tarif ?? 0);
                    
                    // Biaya Sewa Kantor
                    $totalKerusakan += ($data->sewa_kantor_jumlah_unit ?? 0) * ($data->sewa_kantor_biaya_per_unit ?? 0);
                    
                    // Biaya Restorasi Arsip
                    $totalKerusakan += ($data->restorasi_arsip_jumlah ?? 0) * ($data->restorasi_arsip_harga_satuan ?? 0);
                @endphp
                <h4 class="mb-1">Rp {{ number_format($totalKerusakan, 0, ',', '.') }}</h4>
                <small>Total Kerusakan Format 16</small>
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
