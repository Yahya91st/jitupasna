@extends('layouts.main')

@section('content')
<style>
.d-flex {
    display: flex;
}
.gap-2 {
    gap: 0.5rem;
}
.flex-wrap {
    flex-wrap: wrap;
}
.btn-outline-info {
    color: #17a2b8;
    border-color: #17a2b8;
}
.btn-outline-info:hover {
    color: #fff;
    background-color: #17a2b8;
    border-color: #17a2b8;
}
.btn-outline-success {
    color: #28a745;
    border-color: #28a745;
}
.btn-outline-success:hover {
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
}
</style>
<div class="page-heading">
    <div class="page-title mb-4">
        <h3>Form Pengumpulan Data Sektor</h3>
        @if($bencana)
            <div class="alert alert-light-primary color-primary mt-2">
                <p>Bencana: {{ $bencana->kategori_bencana->nama }}</p>
                <p>Tanggal: {{ $bencana->tanggal }}</p>
                <p>Lokasi: 
                    @foreach($bencana->desa as $desa)
                        {{ $desa->nama }}@if(!$loop->last), @endif
                    @endforeach
                </p>
            </div>
        @endif
        <p class="text-subtitle text-muted">Pilih sektor yang akan didata</p>
        
        <!-- Redundant "Lihat Data" buttons removed as each format card already has its own button -->
    </div>
    <div class="row">        
        <!-- Format 1 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 1 - Sektor Perumahan</h5>
                        <p class="card-text">Format pengumpulan data sektor perumahan.</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('forms.form4.format1form4', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form4.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 2 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 2 - Sektor Pendidikan</h5>
                        <p class="card-text">Format pengumpulan data sektor pendidikan.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form4.show-format2', $bencana->id) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 3 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 3 - Sektor Kesehatan</h5>
                        <p class="card-text">Format pengumpulan data sektor kesehatan.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form4.show-format3', $bencana->id) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 4 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 4 - Perlindungan Sosial</h5>
                        <p class="card-text">Format pengumpulan data sektor perlindungan sosial.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-primary">Buka Form</a>
                            <a href="#" class="btn btn-outline-info" onclick="alert('Format 4 - Fitur Lihat Data belum tersedia')">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 5 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 5 - Sektor Keagamaan</h5>
                        <p class="card-text">Format pengumpulan data sektor keagamaan.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-primary">Buka Form</a>
                            <a href="#" class="btn btn-outline-info" onclick="alert('Format 5 - Fitur Lihat Data belum tersedia')">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 6 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 6 - Air Minum</h5>
                        <p class="card-text">Format pengumpulan data sektor sarana dan prasarana air minum.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-primary">Buka Form</a>
                            <a href="#" class="btn btn-outline-info" onclick="alert('Format 6 - Fitur Lihat Data belum tersedia')">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 7 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 7 - Transportasi</h5>
                        <p class="card-text">Format pengumpulan data sektor transportasi.</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('forms.form4.format7form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form4.show-format7', $bencana->id) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 8 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 8 - Sektor Listrik</h5>
                        <p class="card-text">Format laporan sektor listrik.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-primary">Buka Form</a>
                            <a href="#" class="btn btn-outline-info" onclick="alert('Format 8 - Fitur Lihat Data belum tersedia')">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 9 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 9 - Sektor Telkom</h5>
                        <p class="card-text">Format pengumpulan data sektor Telkom.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-primary">Buka Form</a>
                            <a href="#" class="btn btn-outline-info" onclick="alert('Format 9 - Fitur Lihat Data belum tersedia')">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 10 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 10 - Pertanian</h5>
                        <p class="card-text">Format pengumpulan data sektor pertanian/perkebunan.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-primary">Buka Form</a>
                            <a href="#" class="btn btn-outline-info" onclick="alert('Format 10 - Fitur Lihat Data belum tersedia')">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 11 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 11 - Peternakan</h5>
                        <p class="card-text">Format pengumpulan data sektor peternakan.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-primary">Buka Form</a>
                            <a href="#" class="btn btn-outline-info" onclick="alert('Format 11 - Fitur Lihat Data belum tersedia')">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 12 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 12 - Perikanan</h5>
                        <p class="card-text">Format pengumpulan data sektor perikanan.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-primary">Buka Form</a>
                            <a href="#" class="btn btn-outline-info" onclick="alert('Format 12 - Fitur Lihat Data belum tersedia')">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 13 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 13 - Industri/UMKM</h5>
                        <p class="card-text">Format pengumpulan data sektor industri dan UMKM.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-primary">Buka Form</a>
                            <a href="#" class="btn btn-outline-info" onclick="alert('Format 13 - Fitur Lihat Data belum tersedia')">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 14 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 14 - Perdagangan</h5>
                        <p class="card-text">Format pengumpulan data sektor perdagangan.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-primary">Buka Form</a>
                            <a href="#" class="btn btn-outline-info" onclick="alert('Format 14 - Fitur Lihat Data belum tersedia')">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 15 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 15 - Pariwisata</h5>
                        <p class="card-text">Format pengumpulan data sektor pariwisata.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-primary">Buka Form</a>
                            <a href="#" class="btn btn-outline-info" onclick="alert('Format 15 - Fitur Lihat Data belum tersedia')">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 16 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 16 - Pemerintahan</h5>
                        <p class="card-text">Format pengumpulan data sektor pemerintahan.</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('forms.form4.format16form4', ['bencana_id' => $bencana->id ?? null]) }}" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form4.show-format16', $bencana->id) }}" class="btn btn-outline-info">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format 17 -->
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h5 class="card-title">Format 17 - Lingkungan Hidup</h5>
                        <p class="card-text">Format pengumpulan data sektor lingkungan hidup.</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('forms.form4.format17form4', ['bencana_id' => $bencana->id ?? null]) }}" class="btn btn-primary">Buka Form</a>
                            <a href="{{ route('forms.form4.show-format17', $bencana->id) }}" class="btn btn-outline-success">
                                <i class="fa fa-eye"></i> Lihat Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
