@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-4">
        <h1 class="text-2xl font-bold mb-2">Detail Analisa Data Akibat</h1>
        <p class="text-muted">Formulir 10 - Analisa Data Akibat terhadap Akses, Fungsi, dan Resiko</p>
    </div>

    @if(session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="mb-4 d-flex gap-2">
        <a href="{{ route('forms.form10.list', ['bencana_id' => $analisa->bencana_id]) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Kembali ke Daftar
        </a>
        <a href="{{ route('forms.form10.edit', $analisa->id) }}" class="btn btn-warning">
            <i class="fa fa-edit mr-2"></i> Edit Data
        </a>
        <a href="{{ route('forms.form10.pdf', $analisa->id) }}" class="btn btn-primary" target="_blank">
            <i class="fa fa-download mr-2"></i> Unduh PDF
        </a>
        <a href="{{ route('forms.form10.preview-pdf', $analisa->id) }}" class="btn btn-info" target="_blank">
            <i class="fa fa-search mr-2"></i> Lihat PDF
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h4 class="card-title">Informasi Bencana</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="font-weight-bold d-block">Nama Bencana</label>
                    <p>{{ $analisa->bencana->kategori_bencana->nama }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="font-weight-bold d-block">Tanggal Bencana</label>
                    <p>{{ $analisa->bencana->tanggal }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="font-weight-bold d-block">Lokasi Bencana</label>
                    <p>
                        @foreach($analisa->bencana->desa as $desa)
                            {{ $desa->nama }}@if(!$loop->last), @endif
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h4 class="card-title">Informasi Analisa Data Akibat</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="font-weight-bold d-block">Sektor</label>
                    <p>{{ $analisa->sektor }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="font-weight-bold d-block">Sub Sektor</label>
                    <p>{{ $analisa->sub_sektor }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="font-weight-bold d-block">Lokasi</label>
                    <p>{{ $analisa->lokasi }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-3">
                    <label class="font-weight-bold d-block">Point Penting Hasil Pengolahan Data Survey</label>
                    <div class="p-3 bg-light rounded">
                        {!! nl2br(e($analisa->hasil_survey)) !!}
                    </div>
                </div>
                
                <div class="col-12 mb-3">
                    <label class="font-weight-bold d-block">Point Penting Hasil Wawancara/FGD</label>
                    <div class="p-3 bg-light rounded">
                        {!! nl2br(e($analisa->hasil_wawancara)) !!}
                    </div>
                </div>
                
                <div class="col-12 mb-3">
                    <label class="font-weight-bold d-block">Point Penting Hasil Pendataan ke SKPD</label>
                    <div class="p-3 bg-light rounded">
                        {!! nl2br(e($analisa->hasil_pendataan_skpd)) !!}
                    </div>
                </div>
                  <div class="col-12 mb-3">
                    <label class="font-weight-bold d-block">Kebutuhan-Kegiatan Pemulihan</label>
                    <div class="p-3 bg-light rounded">
                        {!! nl2br(e($analisa->kebutuhan_pemulihan)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h4 class="card-title">Informasi Pencatatan</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold d-block">Tanggal Dibuat</label>
                    <p>{{ $analisa->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="font-weight-bold d-block">Terakhir Diupdate</label>
                    <p>{{ $analisa->updated_at->format('d F Y, H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
