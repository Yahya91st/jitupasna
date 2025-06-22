@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Detail Kuesioner Form 09</h1>
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    <div class="mb-4">
        <a href="{{ route('forms.form9.list', ['bencana_id' => $form->bencana_id]) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Kembali ke Daftar
        </a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Kuesioner</h4>
            @if($bencana)
            <div class="alert alert-light-primary color-primary mt-2">
                <p><strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama }}</p>
                <p><strong>Tanggal Bencana:</strong> {{ $bencana->tanggal }}</p>
                <p><strong>Lokasi:</strong> 
                    @foreach($bencana->desa as $desa)
                        {{ $desa->nama }}@if(!$loop->last), @endif
                    @endforeach
                </p>
            </div>
            @endif
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Nomor Kuesioner:</label>
                        <p>{{ $form->nomor_kuesioner }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Tanggal:</label>
                        <p>{{ \Carbon\Carbon::parse($form->tanggal)->format('d-m-Y') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Kecamatan:</label>
                        <p>{{ $form->kecamatan }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Desa/Kelurahan:</label>
                        <p>{{ $form->desa_kelurahan }}</p>
                    </div>
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Jenis Kelamin:</label>
                        <p>{{ $form->jenis_kelamin }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Umur:</label>
                        <p>{{ $form->umur }}</p>
                    </div>
                </div>
            </div>
            
            @if(isset($form->dukungan_pangan_air) && is_array($form->dukungan_pangan_air))
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="font-weight-bold">Dukungan untuk Pemulihan Pangan dan Air Bersih:</label>
                        <ul class="list-group">
                            @foreach($form->dukungan_pangan_air as $item)
                            <li class="list-group-item">{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            
        </div>
    </div>
</div>
@endsection
