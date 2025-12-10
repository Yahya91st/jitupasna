@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 style="color: #F28705; margin-bottom: 1.5rem;">Format Analisis Form 8</h1>

    <!-- Intro Section -->
    <div class="alert" style="background-color: rgba(242, 135, 5, 0.1); border-left: 4px solid #F28705; padding: 1rem; margin-bottom: 2rem;">
        <h5 style="color: #F28705;"><i class="bi bi-info-circle"></i> Tentang Format Analisis</h5>
        <p class="mb-2">
            Form 8 tersedia dalam 3 format analisis yang berbeda untuk memudahkan pengambilan keputusan 
            berdasarkan data kerusakan dan kerugian pascabencana:
        </p>
        <ul class="mb-0">
            <li><strong>Tabel Ringkas:</strong> Overview cepat semua data dalam format tabel kompak</li>
            <li><strong>Per Baris:</strong> Analisis detail setiap item dengan breakdown lengkap</li>
            <li><strong>Komprehensif:</strong> Kombinasi tabel ringkas + analisis detail per sektor</li>
        </ul>
    </div>

    <!-- Format Options -->
    <div class="row">
        <!-- Tabel Ringkas -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100" style="border: 2px solid #007bff; transition: transform 0.2s;">
                <div class="card-header text-center" style="background-color: #007bff; color: white; padding: 1.5rem;">
                    <i class="bi bi-table" style="font-size: 3rem;"></i>
                    <h5 class="mt-2 mb-0">Tabel Ringkas</h5>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="flex-grow-1">
                        <h6 style="color: #007bff;">Format Landscape - Analisis Cepat</h6>
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
                        <a href="{{ route('forms.form8.table-ringkas') }}" class="btn w-100" style="background-color: #007bff; color: white;" target="_blank">
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
            <div class="card h-100" style="border: 2px solid #28a745; transition: transform 0.2s;">
                <div class="card-header text-center" style="background-color: #28a745; color: white; padding: 1.5rem;">
                    <i class="bi bi-list-ol" style="font-size: 3rem;"></i>
                    <h5 class="mt-2 mb-0">Format Per Baris</h5>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="flex-grow-1">
                        <h6 style="color: #28a745;">Format Portrait - Detail Lengkap</h6>
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
                        <a href="{{ route('forms.form8.per-baris') }}" class="btn w-100" style="background-color: #28a745; color: white;" target="_blank">
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
            <div class="card h-100" style="border: 2px solid #ffc107; transition: transform 0.2s;">
                <div class="card-header text-center" style="background-color: #ffc107; color: white; padding: 1.5rem;">
                    <i class="bi bi-graph-up" style="font-size: 3rem;"></i>
                    <h5 class="mt-2 mb-0">Analisis Komprehensif</h5>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="flex-grow-1">
                        <h6 style="color: #ffc107;">Format Hybrid - Laporan Lengkap</h6>
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
                        <a href="{{ route('forms.form8.analisis-komprehensif') }}" class="btn w-100" style="background-color: #ffc107; color: white;" target="_blank">
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
    <div class="card mt-4">
        <div class="card-header" style="background-color: #F28705; color: white;">
            <h5 class="mb-0"><i class="bi bi-compare"></i> Perbandingan Format</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead style="background-color: #f8f9fa;">
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
                            <span class="badge" style="background-color: #007bff;">Ringkas</span>
                        </td>
                        <td class="text-center">
                            <span class="badge" style="background-color: #28a745;">Detail</span>
                        </td>
                        <td class="text-center">
                            <span class="badge" style="background-color: #ffc107;">Lengkap</span>
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

    <!-- Back Button -->
    <div class="mt-4">
        <a href="{{ route('forms.form8.list') }}" class="btn" style="background-color: #6c757d; color: white;">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Form 8
        </a>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.badge {
    font-size: 0.85rem;
    padding: 0.4em 0.8em;
}
</style>
@endsection