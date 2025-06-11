@extends('layouts.main')

@push('style')
<style>
    .card {
        height: 100%;
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
        @if($bencana)
            <p class="text-subtitle text-muted">
                Bencana: {{ $bencana->kategori_bencana->nama }} - Ref: {{ $bencana->Ref }} - Tanggal: {{ $bencana->tanggal }}
                <a href="{{ route('bencana.index', ['source' => 'forms']) }}" class="btn btn-sm btn-outline-primary">
                    Ganti Bencana
                </a>
            </p>
        @else
            <p class="text-subtitle text-muted">Pilih form yang ingin diisi</p>
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
                        <h5 class="card-title">Form Surat Permohonan Keterlibatan PDNA</h5>
                        <p class="card-text">Formulir untuk memohon keterlibatan kementerian/lembaga dalam Pengkajian Kebutuhan Pascabencana.</p>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('forms.form1.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form1.list-form1', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
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
                        <h5 class="card-title">Form Penilaian Kerusakan</h5>
                        <p class="card-text">Formulir untuk menilai tingkat kerusakan infrastruktur pasca bencana.</p>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('forms.form2.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form2.list', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
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
                        <h5 class="card-title">Form Pendataan ke OPD</h5>
                        <p class="card-text">Formulir untuk pendataan dan pengumpulan data sebelum dan sesudah bencana.</p>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('forms.form3.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form3.list', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form 4 - Available to both admin and regular users -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Form Pengumpulan Data Sektor</h5>
                        <p class="card-text">Formulir untuk mengumpulkan data per sektor.</p>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('forms.form4.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form4.list', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form 6 - Available to both admin and regular users -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Form Pendataan Tingkat Rumahtangga</h5>
                        <p class="card-text">Formulir untuk pendataan kerusakan dan kebutuhan tingkat rumahtangga pasca bencana.</p>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('forms.form6.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form6.list', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form 7 - Available to both admin and regular users -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Form Diskusi Kelompok Terfokus (FGD)</h5>
                        <p class="card-text">Formulir untuk pencatatan hasil Focus Group Discussion (FGD) pascabencana.</p>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('forms.form7.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form7.list', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional forms can be added here in the future as needed -->
        <div class="col-xl-12 col-md-12 col-sm-12 mt-4">
            <div class="alert alert-info">
                <h4 class="alert-heading">Informasi</h4>
                <p>
                    Formulir tambahan akan tersedia di masa mendatang.
                    Untuk saat ini, silahkan gunakan formulir yang telah tersedia di atas.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection