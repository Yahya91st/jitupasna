@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Format Analisis Form 8</h3>
                <p class="text-subtitle text-muted">Pilih format analisis kerusakan dan kerugian yang sesuai kebutuhan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-md-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('forms.form8.list') }}">Form 8</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Format Analisis</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Intro Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-light-primary">
                <h5><i class="bi bi-info-circle"></i> Tentang Format Analisis Baru</h5>
                <p class="mb-2">
                    Form 8 kini tersedia dalam 3 format analisis yang berbeda untuk memudahkan pengambilan keputusan 
                    berdasarkan data kerusakan dan kerugian pascabencana:
                </p>
                <ul class="mb-0">
                    <li><strong>Tabel Ringkas:</strong> Overview cepat semua data dalam format tabel kompak</li>
                    <li><strong>Per Baris:</strong> Analisis detail setiap item dengan breakdown lengkap</li>
                    <li><strong>Komprehensif:</strong> Kombinasi tabel ringkas + analisis detail per sektor</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Format Options -->
    <div class="row">
        <!-- Tabel Ringkas -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 border-primary">
                <div class="card-header bg-primary text-white text-center">
                    <i class="bi bi-table" style="font-size: 3rem;"></i>
                    <h5 class="mt-2 mb-0">Tabel Ringkas</h5>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="flex-grow-1">
                        <h6 class="text-primary">Format Landscape - Analisis Cepat</h6>
                        <p class="text-muted">
                            Menampilkan semua data dalam tabel kompak dengan kolom essential untuk 
                            analisis cepat dan pengambilan keputusan.
                        </p>
                        <ul class="small text-muted">
                            <li>Format A4 Landscape</li>
                            <li>10 baris data utama</li>
                            <li>Kolom RB, RS, RR</li>
                            <li>Nilai kerusakan & total</li>
                            <li>Rekapitulasi di bawah</li>
                        </ul>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('forms.form8.table-ringkas') }}" class="btn btn-primary w-100" target="_blank">
                            <i class="bi bi-file-pdf"></i> Lihat PDF
                        </a>
                        <div class="text-center mt-2">
                            <small class="text-muted">Total: Rp {{ number_format($totalKebutuhan ?? 0, 0, ',', '.') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Per Baris -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 border-success">
                <div class="card-header bg-success text-white text-center">
                    <i class="bi bi-list-ol" style="font-size: 3rem;"></i>
                    <h5 class="mt-2 mb-0">Format Per Baris</h5>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="flex-grow-1">
                        <h6 class="text-success">Format Portrait - Detail Lengkap</h6>
                        <p class="text-muted">
                            Setiap item ditampilkan dalam card terpisah dengan breakdown 
                            detail untuk analisis mendalam per komponen.
                        </p>
                        <ul class="small text-muted">
                            <li>Format A4 Portrait</li>
                            <li>Card layout per item</li>
                            <li>Grid data kerusakan</li>
                            <li>Analisis nilai detail</li>
                            <li>Summary per item</li>
                        </ul>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('forms.form8.per-baris') }}" class="btn btn-success w-100" target="_blank">
                            <i class="bi bi-file-pdf"></i> Lihat PDF
                        </a>
                        <div class="text-center mt-2">
                            <small class="text-muted">5 items detail</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analisis Komprehensif -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 border-warning">
                <div class="card-header bg-warning text-white text-center">
                    <i class="bi bi-graph-up" style="font-size: 3rem;"></i>
                    <h5 class="mt-2 mb-0">Analisis Komprehensif</h5>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="flex-grow-1">
                        <h6 class="text-warning">Format Hybrid - Laporan Lengkap</h6>
                        <p class="text-muted">
                            Kombinasi tabel ringkas dan analisis detail per sektor 
                            untuk laporan eksekutif yang komprehensif.
                        </p>
                        <ul class="small text-muted">
                            <li>Tabel ringkas di atas</li>
                            <li>Detail per sektor</li>
                            <li>Page break otomatis</li>
                            <li>Grand summary</li>
                            <li>Format laporan final</li>
                        </ul>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('forms.form8.analisis-komprehensif') }}" class="btn btn-warning w-100" target="_blank">
                            <i class="bi bi-file-pdf"></i> Lihat PDF
                        </a>
                        <div class="text-center mt-2">
                            <small class="text-muted">Multi-page report</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Comparison Table -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="bi bi-compare"></i> Perbandingan Format</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Aspek</th>
                                    <th class="text-center">Tabel Ringkas</th>
                                    <th class="text-center">Per Baris</th>
                                    <th class="text-center">Komprehensif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Format Kertas</strong></td>
                                    <td class="text-center">A4 Landscape</td>
                                    <td class="text-center">A4 Portrait</td>
                                    <td class="text-center">A4 Portrait</td>
                                </tr>
                                <tr>
                                    <td><strong>Jumlah Halaman</strong></td>
                                    <td class="text-center">1 halaman</td>
                                    <td class="text-center">2-3 halaman</td>
                                    <td class="text-center">3-4 halaman</td>
                                </tr>
                                <tr>
                                    <td><strong>Level Detail</strong></td>
                                    <td class="text-center">
                                        <span class="badge bg-primary">Ringkas</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success">Detail</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning">Lengkap</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Kecepatan Analisis</strong></td>
                                    <td class="text-center">⚡ Sangat Cepat</td>
                                    <td class="text-center">🔍 Mendalam</td>
                                    <td class="text-center">📊 Menyeluruh</td>
                                </tr>
                                <tr>
                                    <td><strong>Cocok Untuk</strong></td>
                                    <td class="text-center">Meeting, Overview</td>
                                    <td class="text-center">Analisis Detail</td>
                                    <td class="text-center">Laporan Eksekutif</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('forms.form8.list') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Form 8
            </a>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
}

.card-header i {
    opacity: 0.9;
}

.badge {
    font-size: 0.8rem;
}

.table th {
    background-color: #f8f9fa;
    font-weight: 600;
}
</style>
@endsection