@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="alert alert-info">
            <h4><i class="fa fa-info-circle"></i> Format Belum Diimplementasikan</h4>
            <p><strong>Format 2: Pengumpulan Data Sektor Pendidikan</strong> belum diimplementasikan dalam sistem ini.</p>
        </div>

        @if($bencana)
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Bencana</h5>
                </div>
                <div class="card-body">
                    <p><strong>Jenis Bencana:</strong> {{ $bencana->kategori_bencana->nama ?? 'N/A' }}</p>
                    <p><strong>Tanggal:</strong> {{ $bencana->tanggal }}</p>
                    <p><strong>Ref:</strong> {{ $bencana->Ref }}</p>
                    <p><strong>Lokasi:</strong> 
                        @if($bencana->desa->count() > 0)
                            @foreach($bencana->desa as $desa)
                                {{ $desa->nama }}@if(!$loop->last), @endif
                            @endforeach
                        @else
                            Belum ditentukan
                        @endif
                    </p>
                </div>
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id ?? request()->query('bencana_id')]) }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali ke Form 4
            </a>
        </div>

        <div class="mt-4">
            <div class="card">
                <div class="card-header">
                    <h6>Format yang Tersedia</h6>
                </div>
                <div class="card-body">
                    <p>Untuk saat ini, hanya <strong>Format 1 (Sektor Perumahan)</strong> yang telah diimplementasikan.</p>
                    <a href="{{ route('forms.form4.format1.index', ['bencana_id' => $bencana->id ?? request()->query('bencana_id')]) }}" class="btn btn-primary">
                        <i class="fa fa-home"></i> Gunakan Format 1 - Sektor Perumahan
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
