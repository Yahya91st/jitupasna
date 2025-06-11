@extends('layouts.main')

@push('style')
<style>
    .card-data {
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border-radius: 0.5rem;
        border: none;
        margin-bottom: 1.5rem;
    }
    
    .card-data:hover {
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    
    .card-header-custom {
        background: linear-gradient(to right, #4a6cf7, #28bafd);
        color: white;
        border-radius: 0.5rem 0.5rem 0 0;
        padding: 1rem 1.5rem;
        font-weight: 600;
    }
    
    .detail-table {
        width: 100%;
    }
    
    .detail-table td, .detail-table th {
        padding: 0.75rem;
        border-bottom: 1px solid #e9ecef;
    }
    
    .detail-table th {
        width: 40%;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <h3>Detail Diskusi Kelompok Terfokus (FGD)</h3>
        <p class="text-subtitle text-muted">Data lengkap Diskusi Kelompok Terfokus (FGD) pascabencana</p>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-content">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success shadow-sm">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('forms.form7.list') }}" class="btn btn-secondary me-2">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                                <a href="{{ route('forms.form7.edit', $fgd->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('forms.form7.pdf', $fgd->id) }}" class="btn btn-danger me-2" target="_blank">
                                    <i class="bi bi-file-pdf me-1"></i> Download PDF
                                </a>
                                <a href="{{ route('forms.form7.preview-pdf', $fgd->id) }}" class="btn btn-info" target="_blank">
                                    <i class="bi bi-eye me-1"></i> Preview PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-data">
                            <div class="card-header-custom">
                                <i class="bi bi-info-circle me-2"></i>Informasi Bencana
                            </div>
                            <div class="card-body">
                                <table class="detail-table">
                                    <tr>
                                        <th>Nama Bencana</th>
                                        <td>{{ $fgd->bencana->Ref }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Bencana</th>
                                        <td>{{ $fgd->bencana->tanggal }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-data">
                            <div class="card-header-custom">
                                <i class="bi bi-geo-alt me-2"></i>Informasi Lokasi
                            </div>
                            <div class="card-body">
                                <table class="detail-table">
                                    <tr>
                                        <th>Desa/Kelurahan</th>
                                        <td>{{ $fgd->desa_kelurahan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kecamatan</th>
                                        <td>{{ $fgd->kecamatan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kabupaten</th>
                                        <td>{{ $fgd->kabupaten }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jarak dari Lokasi Bencana</th>
                                        <td>{{ $fgd->jarak_bencana }} KM</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-data">
                            <div class="card-header-custom">
                                <i class="bi bi-people me-2"></i>Informasi Peserta
                            </div>
                            <div class="card-body">
                                <table class="detail-table">
                                    <tr>
                                        <th>Tempat Sesi</th>
                                        <td>{{ $fgd->tempat_sesi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pelaksanaan</th>
                                        <td>{{ \Carbon\Carbon::parse($fgd->tanggal)->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Peserta</th>
                                        <td>{{ $fgd->jumlah_peserta }} orang</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Peserta Perempuan</th>
                                        <td>{{ $fgd->jumlah_perempuan }} orang</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Peserta Laki-laki</th>
                                        <td>{{ $fgd->jumlah_laki_laki }} orang</td>
                                    </tr>
                                    <tr>
                                        <th>Komposisi Peserta</th>
                                        <td>{{ $fgd->komposisi_peserta }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-data">
                            <div class="card-header-custom">
                                <i class="bi bi-person-badge me-2"></i>Fasilitator & Pencatat
                            </div>
                            <div class="card-body">
                                <table class="detail-table">
                                    <tr>
                                        <th>Fasilitator</th>
                                        <td>{{ $fgd->fasilitator }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pencatat</th>
                                        <td>{{ $fgd->pencatat }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-data">
                            <div class="card-header-custom">
                                <i class="bi bi-calendar-check me-2"></i>Informasi Pencatatan
                            </div>
                            <div class="card-body">
                                <table class="detail-table">
                                    <tr>
                                        <th>Dibuat Oleh</th>
                                        <td>{{ $fgd->createdBy->name ?? 'Unknown' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Input</th>
                                        <td>{{ $fgd->created_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                    @if($fgd->updated_by)
                                    <tr>
                                        <th>Diperbarui Oleh</th>
                                        <td>{{ $fgd->updatedBy->name ?? 'Unknown' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Update</th>
                                        <td>{{ $fgd->updated_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-data">
                            <div class="card-header-custom">
                                <i class="bi bi-chat-left-text me-2"></i>Hasil Diskusi - Akses Hak
                            </div>
                            <div class="card-body">
                                <div class="p-3">
                                    {!! nl2br(e($fgd->akses_hak)) ?? '<em>Tidak ada data</em>' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-data">
                            <div class="card-header-custom">
                                <i class="bi bi-chat-left-text me-2"></i>Hasil Diskusi - Fungsi Pranata
                            </div>
                            <div class="card-body">
                                <div class="p-3">
                                    {!! nl2br(e($fgd->fungsi_pranata)) ?? '<em>Tidak ada data</em>' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-data">
                            <div class="card-header-custom">
                                <i class="bi bi-chat-left-text me-2"></i>Hasil Diskusi - Resiko Kerentanan
                            </div>
                            <div class="card-body">
                                <div class="p-3">
                                    {!! nl2br(e($fgd->resiko_kerentanan)) ?? '<em>Tidak ada data</em>' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
