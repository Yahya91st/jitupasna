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
            color: #6c757d;
            border-color: #6c757d;
        }

        .btn-outline-info:hover {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-outline-success {
            color: #6c757d;
            border-color: #6c757d;
        }

        .btn-outline-success:hover {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .card {
            height: 96%;
        }

        .card-content,
        .card-body {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
    <div class="page-heading">
        <div class="page-title mb-4">
            <h3>Form Pengumpulan Data Sektor</h3>
            @if ($bencana)
                <div class="alert mt-2" style="background-color: rgba(108, 117, 125, 0.1); border: 1px solid rgba(108, 117, 125, 0.2); color: #495057;">
                    <p>Bencana: {{ $bencana->kategori_bencana->nama }}</p>
                    <p>Tanggal: {{ $bencana->tanggal }}</p>
                    <p>Lokasi:
                        @foreach ($bencana->desa as $desa)
                            {{ $desa->nama }}@if (!$loop->last)
                                ,
                            @endif
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
                                <a href="{{ route('forms.form4.format1.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format1.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format2.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format2.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format3.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format3.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format4.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format4.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format5.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format5.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format6.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format6.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format7.index', ['bencana_id' => $bencana->id]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format7.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format8.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format8.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format9.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format9.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format10.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format10.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format11.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format11.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format12.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format12.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format13.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format13.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format14.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format14.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format15.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format15.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format16.index', ['bencana_id' => $bencana->id ?? null]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format16.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info">
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
                                <a href="{{ route('forms.form4.format17.index', ['bencana_id' => $bencana->id ?? null]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">Buka Form</a>
                                <a href="{{ route('forms.form4.format17.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-success">
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
