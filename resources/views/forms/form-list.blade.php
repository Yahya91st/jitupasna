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
                        <h5 class="card-title">(Form 1) Form Surat Permohonan Keterlibatan PDNA</h5>
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
                        <h5 class="card-title">(Form 2) Form Penilaian Kerusakan</h5>
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
                        <h5 class="card-title">(Form 3) Form Pendataan ke OPD</h5>
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
                        <h5 class="card-title">(Form 4) Form Pengumpulan Data Sektor</h5>
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
                        <h5 class="card-title">(Form 6) Form Pendataan Tingkat Rumahtangga</h5>
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
                        <h5 class="card-title">(Form 7) Form Diskusi Kelompok Terfokus (FGD)</h5>
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

        <!-- Form 8 - Pengolahan dan Analisis Data Penilaian Kerusakan dan Kerugian -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">(Form 8) Form Pengolahan dan Analisis Data</h5>
                        <p class="card-text">Formulir pengolahan dan analisis data penilaian kerusakan dan kerugian pascabencana.</p>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('forms.form8.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form8.listPenilaian', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form 9 - Pengolahan Data dan Kuesioner -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">(Form 9) Form Pengolahan Data dan Kuesioner</h5>
                        <p class="card-text">Formulir kuesioner untuk pendataan dampak bencana terhadap masyarakat.</p>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('forms.form9.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form9.list', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form 10 - Analisa Data Akibat terhadap Akses, Fungsi, dan Resiko -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">(Form 10) Form Analisa Data Akibat</h5>
                        <p class="card-text">Formulir untuk analisa data akibat terhadap akses, fungsi, dan risiko pascabencana.</p>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('forms.form10.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form10.list', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form 11 - Rekapitulasi Kebutuhan Pascabencana (PDNA) -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">(Form 11) Form Rekapitulasi Kebutuhan</h5>
                        <p class="card-text">Formulir untuk rekapitulasi kebutuhan pascabencana dengan prioritas dan penanggung jawab.</p>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('forms.form11.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form11.list', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form 12 - Standar Penyusunan Kegiatan dan Anggaran untuk PKPB -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">(Form 12) Form Standar Anggaran PKPB</h5>
                        <p class="card-text">Formulir untuk penyusunan kegiatan dan anggaran pemulihan kebutuhan pascabencana dengan indeks biaya.</p>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('forms.form12.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form12.list', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
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