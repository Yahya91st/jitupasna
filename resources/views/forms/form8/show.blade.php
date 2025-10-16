@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title mb-4">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Penilaian</h3>
                    <p class="text-subtitle text-muted">Detail data pengolahan dan analisis penilaian kerusakan dan kerugian</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-md-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('forms.form8.index') }}">Formulir 08</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail Penilaian Kerusakan dan Kerugian</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="alert alert-light-primary color-primary">
                            <p><strong>Bencana:</strong> {{ $form8->bencana->kategori_bencana->nama }}</p>
                            <p><strong>Tanggal:</strong> {{ $form8->bencana->tanggal }}</p>
                            <p><strong>Lokasi:</strong>
                                @foreach ($form8->bencana->desa as $desa)
                                    {{ $desa->nama }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 1. Informasi Umum -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-3 mb-4">1. Informasi Umum</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td style="width: 40%"><strong>Sektor</strong></td>
                                <td>{{ $form8->sektor }}</td>
                            </tr>
                            <tr>
                                <td><strong>Sub Sektor</strong></td>
                                <td>{{ $form8->sub_sektor }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td style="width: 40%"><strong>Komponen Kerusakan</strong></td>
                                <td>{{ $form8->komponen_kerusakan }}</td>
                            </tr>
                            <tr>
                                <td><strong>Lokasi</strong></td>
                                <td>{{ $form8->lokasi }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- 2. Estimasi Kerugian -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-4 mb-4">2. Estimasi Kerugian</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td style="width: 40%"><strong>Perkiraan Kerugian (Losses)</strong></td>
                                <td>Rp {{ number_format($form8->perkiraan_kerugian, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Total Kerusakan + Kerugian</strong></td>
                                <td>Rp {{ number_format($form8->total_kerusakan_kerugian, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td colspan="2"><strong>Kebutuhan:</strong></td>
                            </tr>
                            <tr>
                                <td style="width: 40%">Rehabilitasi (RB)</td>
                                <td>Rp {{ number_format($form8->kebutuhan_rb, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Rekonstruksi Sederhana (RS)</td>
                                <td>Rp {{ number_format($form8->kebutuhan_rs, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Rekonstruksi Besar (RR)</td>
                                <td>Rp {{ number_format($form8->kebutuhan_rr, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- 3. Data Kerusakan -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-4 mb-4">3. Data Kerusakan</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td style="width: 40%"><strong>Harga Satuan</strong></td>
                                <td>Rp {{ number_format($form8->harga_satuan, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nilai Kerusakan (Damage)</strong></td>
                                <td>Rp {{ number_format($form8->nilai_kerusakan, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('forms.form8.list', ['bencana_id' => $form8->bencana_id]) }}" class="btn btn-secondary">Kembali</a>
                            <div>
                                <a href="{{ route('forms.form8.preview-pdf', $form8->id) }}" class="btn btn-secondary" target="_blank">
                                    <i class="bi bi-eye"></i> Lihat PDF
                                </a>
                                <a href="{{ route('forms.form8.pdf', $form8->id) }}" class="btn btn-primary">
                                    <i class="bi bi-download"></i> Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
