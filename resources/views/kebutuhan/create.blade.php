@extends('layouts.main')

@section('content')
<style>
    .page-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .page-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .page-header h2 {
        color: #F28705;
        font-weight: 600;
        margin: 0;
    }

    .breadcrumb {
        display: flex;
        justify-content: center;
        background: transparent;
        padding: 10px 0;
        margin: 0;
    }

    .breadcrumb-item a {
        color: #F28705;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        color: #d97604;
        text-decoration: underline;
    }

    .breadcrumb-item.active {
        color: #666;
    }

    .main-card {
        background: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .card-header {
        background: #f9f9f9;
        padding: 15px 20px;
        border-bottom: 1px solid #ddd;
    }

    .card-header h4 {
        margin: 0;
        color: #333;
        font-weight: 600;
    }

    .card-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-group p {
        margin: 0;
        color: #555;
        padding: 10px 12px;
        background: #f9f9f9;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #F28705;
        box-shadow: 0 0 0 0.2rem rgba(242, 135, 5, 0.25);
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-right: 10px;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-primary {
        background: #F28705;
        color: white;
    }

    .btn-primary:hover {
        background: #d97604;
        color: white;
    }

    .btn-light-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-light-secondary:hover {
        background: #5a6268;
        color: white;
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 10px;
        }

        .btn {
            padding: 8px 16px;
            font-size: 13px;
        }
    }
</style>

<div class="page-container">
    <div class="page-header">
        <h2>Input Kebutuhan Pascabencana</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('kebutuhan.index') }}">Kebutuhan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Input</li>
            </ol>
        </nav>
    </div>

    <div class="main-card">
        <div class="card-header">
            <h4>Detail Bencana</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Kejadian</label>
                        <p>{{ is_string($bencana->tanggal) ? $bencana->tanggal : $bencana->tanggal->format('d-m-Y') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenis Bencana</label>
                        <p>{{ $bencana->jenis_bencana ?? ($bencana->kategori_bencana ? $bencana->kategori_bencana->nama_kategori : '-') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <p>{{ $bencana->kecamatan ?? $bencana->kecamatan_id }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Desa</label>
                        <p>{{ $bencana->desa ?? $bencana->desa_id }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-card">
        <div class="card-header">
            <h4>Form Input Kebutuhan</h4>
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
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('kebutuhan.index') }}" class="btn btn-light-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection