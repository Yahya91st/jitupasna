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
    <h5 class="text-center fw-bold">Formulir 04<br>Pengkajian Kebutuhan Pasca Bencana</h5>
    <p class="fw-bold">Format 15: Sektor Pariwisata</p>

    <form action="{{ isset($edit) && $edit ? route('forms.form4.format15.update', $data->id) : route('forms.form4.format15.store') }}" method="POST">
        @csrf
        @if(isset($edit) && $edit)
            @method('PATCH')
        @endif
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">

        <table class="table table-bordered">
            <tr>
                <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
            </tr>
        </table>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 15%;">Keterangan</th>
                        <th style="width: 20%;">Jenis Fasilitas</th>
                        <th style="width: 10%;">RB</th>
                        <th style="width: 10%;">RS</th>
                        <th style="width: 10%;">RR</th>
                        <th style="width: 11%;">RB Harga</th>
                        <th style="width: 12%;">RS Harga</th>
                        <th style="width: 12%;">RR Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="background-color: #A3AFBD;" class="align-middle fw-bold text-white" colspan="8">PERKIRAAN KERUSAKAN</td>
                    </tr>
                    <!-- TEMPAT WISATA -->
                    @for ($i = 1; $i <= 3; $i++)
                    <tr>
                        @if ($i == 1)
                            <td class="text-start align-middle" rowspan="3">A. Tempat Wisata</td>
                        @endif
                        <td><input type="text" name="tempat_wisata_{{ $i }}_jenis" class="form-control" value="{{ old('tempat_wisata_'.$i.'_jenis', $data->{'tempat_wisata_'.$i.'_jenis'} ?? '') }}" placeholder="Jenis Fasilitas"></td>
                        <td><input type="number" name="tempat_wisata_{{ $i }}_rb" class="form-control" min="0" value="{{ old('tempat_wisata_'.$i.'_rb', $data->{'tempat_wisata_'.$i.'_rb'} ?? '') }}"></td>
                        <td><input type="number" name="tempat_wisata_{{ $i }}_rs" class="form-control" min="0" value="{{ old('tempat_wisata_'.$i.'_rs', $data->{'tempat_wisata_'.$i.'_rs'} ?? '') }}"></td>
                        <td><input type="number" name="tempat_wisata_{{ $i }}_rr" class="form-control" min="0" value="{{ old('tempat_wisata_'.$i.'_rr', $data->{'tempat_wisata_'.$i.'_rr'} ?? '') }}"></td>
                        <td><input type="number" name="tempat_wisata_{{ $i }}_rb_harga" class="form-control" min="0" step="1000" value="{{ old('tempat_wisata_'.$i.'_rb_harga', $data->{'tempat_wisata_'.$i.'_rb_harga'} ?? '') }}"></td>
                        <td><input type="number" name="tempat_wisata_{{ $i }}_rs_harga" class="form-control" min="0" step="1000" value="{{ old('tempat_wisata_'.$i.'_rs_harga', $data->{'tempat_wisata_'.$i.'_rs_harga'} ?? '') }}"></td>
                        <td><input type="number" name="tempat_wisata_{{ $i }}_rr_harga" class="form-control" min="0" step="1000" value="{{ old('tempat_wisata_'.$i.'_rr_harga', $data->{'tempat_wisata_'.$i.'_rr_harga'} ?? '') }}"></td>
                    </tr>
                    @endfor
                    @for ($i = 1; $i <= 3; $i++)
                    <tr>
                        @if ($i == 1)
                            <td class="text-start align-middle" rowspan="3">B. Hotel Dan Restaurant</td>
                        @endif
                        <td><input type="text" name="hotel_restaurant_{{ $i }}_jenis" class="form-control" value="{{ old('hotel_restaurant_'.$i.'_jenis', $data->{'hotel_restaurant_'.$i.'_jenis'} ?? '') }}" placeholder="Jenis Fasilitas"></td>
                        <td><input type="number" name="hotel_restaurant_{{ $i }}_rb" class="form-control" min="0" value="{{ old('hotel_restaurant_'.$i.'_rb', $data->{'hotel_restaurant_'.$i.'_rb'} ?? '') }}"></td>
                        <td><input type="number" name="hotel_restaurant_{{ $i }}_rs" class="form-control" min="0" value="{{ old('hotel_restaurant_'.$i.'_rs', $data->{'hotel_restaurant_'.$i.'_rs'} ?? '') }}"></td>
                        <td><input type="number" name="hotel_restaurant_{{ $i }}_rr" class="form-control" min="0" value="{{ old('hotel_restaurant_'.$i.'_rr', $data->{'hotel_restaurant_'.$i.'_rr'} ?? '') }}"></td>
                        <td><input type="number" name="hotel_restaurant_{{ $i }}_rb_harga" class="form-control" min="0" step="1000" value="{{ old('hotel_restaurant_'.$i.'_rb_harga', $data->{'hotel_restaurant_'.$i.'_rb_harga'} ?? '') }}"></td>
                        <td><input type="number" name="hotel_restaurant_{{ $i }}_rs_harga" class="form-control" min="0" step="1000" value="{{ old('hotel_restaurant_'.$i.'_rs_harga', $data->{'hotel_restaurant_'.$i.'_rs_harga'} ?? '') }}"></td>
                        <td><input type="number" name="hotel_restaurant_{{ $i }}_rr_harga" class="form-control" min="0" step="1000" value="{{ old('hotel_restaurant_'.$i.'_rr_harga', $data->{'hotel_restaurant_'.$i.'_rr_harga'} ?? '') }}"></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <input type="hidden" name="total_kerusakan" value="0">

        <div class="row mb-4">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">{{ isset($edit) && $edit ? 'Update Data' : 'Simpan Data' }}</button>
            </div>
        </div>
    </form>

    <hr class="my-4">

    <div class="card mt-4">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Total Kerusakan (Otomatis)</h5>
        </div>
        <div class="card-body text-center">
            @php
                $totalKerusakan = 0;
                
                // Menghitung total kerusakan tempat wisata
                for ($i = 1; $i <= 3; $i++) {
                    $totalKerusakan += ($data->{'tempat_wisata_'.$i.'_rb'} ?? 0) * ($data->{'tempat_wisata_'.$i.'_rb_harga'} ?? 0);
                    $totalKerusakan += ($data->{'tempat_wisata_'.$i.'_rs'} ?? 0) * ($data->{'tempat_wisata_'.$i.'_rs_harga'} ?? 0);
                    $totalKerusakan += ($data->{'tempat_wisata_'.$i.'_rr'} ?? 0) * ($data->{'tempat_wisata_'.$i.'_rr_harga'} ?? 0);
                }

                // Menghitung total kerusakan hotel restaurant
                for ($i = 1; $i <= 3; $i++) {
                    $totalKerusakan += ($data->{'hotel_restaurant_'.$i.'_rb'} ?? 0) * ($data->{'hotel_restaurant_'.$i.'_rb_harga'} ?? 0);
                    $totalKerusakan += ($data->{'hotel_restaurant_'.$i.'_rs'} ?? 0) * ($data->{'hotel_restaurant_'.$i.'_rs_harga'} ?? 0);
                    $totalKerusakan += ($data->{'hotel_restaurant_'.$i.'_rr'} ?? 0) * ($data->{'hotel_restaurant_'.$i.'_rr_harga'} ?? 0);
                }
            @endphp
            <h4 class="mb-1">Rp {{ number_format($totalKerusakan, 0, ',', '.') }}</h4>
            <small>Total Kerusakan Format 15</small>
        </div>
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
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission with loading state
    const submitBtn = document.querySelector('button[type="submit"]');
    const form = document.querySelector('form');
    
    if (form && submitBtn) {
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
        });
    }
});
</script>
@endsection
