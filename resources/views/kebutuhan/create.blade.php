@extends('layouts.main')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Input Kebutuhan Pascabencana</h3>
            <p class="text-subtitle text-muted">Form input kebutuhan pascabencana</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-md-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('kebutuhan.index') }}">Kebutuhan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Input</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Detail Bencana</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal">Tanggal Kejadian</label>
                        <p>{{ is_string($bencana->tanggal) ? $bencana->tanggal : $bencana->tanggal->format('d-m-Y') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jenis_bencana">Jenis Bencana</label>
                        <p>{{ $bencana->jenis_bencana ?? ($bencana->kategori_bencana ? $bencana->kategori_bencana->nama_kategori : '-') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <p>{{ $bencana->kecamatan ?? $bencana->kecamatan_id }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="desa">Desa</label>
                        <p>{{ $bencana->desa ?? $bencana->desa_id }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Input Kebutuhan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('kebutuhan.store', $bencana->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kebutuhan_material">Kebutuhan Material</label>
                            <textarea class="form-control" id="kebutuhan_material" name="kebutuhan_material" rows="3" placeholder="Masukkan kebutuhan material">{{ old('kebutuhan_material') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kebutuhan_sdm">Kebutuhan SDM</label>
                            <textarea class="form-control" id="kebutuhan_sdm" name="kebutuhan_sdm" rows="3" placeholder="Masukkan kebutuhan SDM">{{ old('kebutuhan_sdm') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kebutuhan_dana">Estimasi Kebutuhan Dana (Rp)</label>
                            <input type="number" class="form-control" id="kebutuhan_dana" name="kebutuhan_dana" placeholder="Masukkan estimasi kebutuhan dana" value="{{ old('kebutuhan_dana') }}">
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                        <a href="{{ route('kebutuhan.index') }}" class="btn btn-light-secondary me-1 mb-1">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection