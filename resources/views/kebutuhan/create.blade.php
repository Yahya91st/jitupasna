@extends('layouts.main')

@section('content')
<style>
    * {
        font-family: 'Times New Roman', Times, serif;
    }
    
    .main-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        border: none;
        overflow: hidden;
    }
    
    .orange-header {
        background: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
        color: white;
        padding: 20px;
        margin: -1px -1px 20px -1px;
        border-radius: 15px 15px 0 0;
    }
    
    .orange-header h3 {
        margin: 0;
        font-weight: 600;
        font-size: 1.8rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .orange-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
    }
    
    .breadcrumb {
        background: transparent;
        margin: 0;
    }
    
    .breadcrumb-item a {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
    }
    
    .breadcrumb-item a:hover {
        color: white;
    }
    
    .breadcrumb-item.active {
        color: white;
    }
    
    .detail-card {
        background: white;
        border-radius: 12px;
        border: 3px solid #F28705;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    
    .card-header {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
        border-bottom: none;
        border-radius: 12px 12px 0 0;
    }
    
    .card-header h4 {
        margin: 0;
        font-weight: 600;
    }
    
    .form-group label {
        color: #495057;
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #F28705;
        box-shadow: 0 0 0 0.2rem rgba(242, 135, 5, 0.25);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
        border: none;
        border-radius: 8px;
        font-weight: 500;
        padding: 12px 24px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(242, 135, 5, 0.3);
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #e07600 0%, #f57c00 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(242, 135, 5, 0.4);
    }
    
    .btn-light-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        border: none;
        color: white;
        border-radius: 8px;
        font-weight: 500;
        padding: 12px 24px;
        transition: all 0.3s ease;
    }
    
    .btn-light-secondary:hover {
        background: linear-gradient(135deg, #5a6268 0%, #3d4142 100%);
        color: white;
        transform: translateY(-2px);
    }
</style>

<div class="container-fluid">
<div class="main-card">
    <div class="orange-header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Input Kebutuhan Pascabencana</h3>
                <p class="text-subtitle">Form input kebutuhan pascabencana</p>
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

    <div style="padding: 20px;">
        <div class="detail-card">
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

        <div class="detail-card">
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
</div>
</div>
@endsection