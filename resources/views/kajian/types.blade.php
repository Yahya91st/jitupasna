@extends('layouts.main')

@push('style')
    <style>
        .card {
            height: 96%;
        }

        .card-content {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .card-text {
            flex: 1;
        }
    </style>
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title mb-4">
            <h3>Daftar Form Lanjutan</h3>
            @if ($bencana)
                <p class="text-subtitle text-muted">
                    Bencana: {{ $bencana->kategori_bencana->nama }} - Ref: {{ $bencana->Ref }} - Tanggal: {{ $bencana->tanggal }}
                    <a href="{{ route('bencana.index', ['source' => 'forms']) }}" class="btn btn-sm" style="background-color: #6c757d; color: white; border: none;">
                        Ganti Bencana
                    </a>
                </p>
            @endif
            <div class="mt-2">
                <span class="badge bg-info">Pengguna JITUPASNA</span>
            </div>
        </div>
        <div class="row">

            <!-- Form 1 - Available to both admin and regular users -->
            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h5 class="card-title">Kehilangan Akses</h5>
                            <p class="card-text"></p>
                            <div class="d-flex flex-column">
                                <a href="{{ route('kajian.createAkses', ['bencana_id' => $bencana->id]) }}" class="btn mb-2" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form 2 - Available to both admin and regular users -->
            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h5 class="card-title">Gangguan Fungsi</h5>
                            <p class="card-text"></p>
                            <div class="d-flex flex-column">
                                <a href="{{ route('kajian.createFungsi', ['bencana_id' => $bencana->id]) }}" class="btn mb-2" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form 3 - Available to all users -->
            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h5 class="card-title">Peningkatan Resiko</h5>
                            <p class="card-text"></p>
                            <div class="d-flex flex-column">
                                <a href="{{ route('kajian.createResiko', ['bencana_id' => $bencana->id]) }}" class="btn mb-2" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Additional forms would be added here if needed -->
            <div class="col-xl-12 col-md-12 col-sm-12 mt-4">
                <div class="alert alert-info">
                    <h4 class="alert-heading">Informasi</h4>
                    <p>
                        Seluruh formulir untuk pengkajian dan penilaian kebutuhan pascabencana telah tersedia.
                        Silahkan gunakan formulir sesuai dengan kebutuhan pengkajian Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
