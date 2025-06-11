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
    
    .btn-custom {
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .btn-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .btn-back {
        background-color: #6c757d;
        color: white;
    }
    
    .btn-edit {
        background-color: #ffc107;
        color: #212529;
    }
    
    .btn-pdf {
        background-color: #dc3545;
        color: white;
    }
    
    .btn-preview {
        background-color: #0dcaf0;
        color: white;
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
    
    .badge-custom {
        padding: 0.4rem 0.8rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.8rem;
    }
    
    .img-container {
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
        position: relative;
        height: 250px;
    }
    
    .img-container:hover {
        transform: scale(1.02);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    
    .img-caption {
        margin-top: 0.5rem;
        font-weight: 600;
        color: #495057;
        text-align: center;
    }
    
    .img-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .img-fluid {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .section-title {
        position: relative;
        padding-left: 15px;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: #333;
    }
    
    .section-title::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: linear-gradient(to bottom, #4a6cf7, #28bafd);
        border-radius: 4px;
    }
    
    .badge-danger {
        background-color: #dc3545;
        color: white;
    }
    
    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }
    
    .badge-info {
        background-color: #0dcaf0;
        color: white;
    }
    
    .badge-success {
        background-color: #198754;
        color: white;
    }
    
    .badge-secondary {
        background-color: #6c757d;
        color: white;
    }
    
    .badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }
    
    .image-zoom-container {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.9);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    
    .zoom-content {
        max-width: 90%;
        max-height: 90%;
    }
    
    .zoom-image {
        max-width: 100%;
        max-height: 90vh;
        object-fit: contain;
    }
    
    .zoom-close {
        position: absolute;
        top: 20px;
        right: 20px;
        color: white;
        font-size: 30px;
        cursor: pointer;
    }
</style>
@endpush

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <h3>Formulir 06 - Pendataan Tingkat Rumahtangga</h3>
        <p class="text-subtitle text-muted">Data lengkap pendataan kerusakan dan kebutuhan tingkat rumahtangga</p>
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
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="mb-2">
                                    <a href="{{ route('forms.form6.list') }}" class="btn btn-custom btn-back me-2">
                                        <i class="bi bi-arrow-left me-1"></i> Kembali
                                    </a>
                                    <a href="{{ route('forms.form6.edit', $rumahtangga->id) }}" class="btn btn-custom btn-edit">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route('forms.form6.pdf', $rumahtangga->id) }}" class="btn btn-custom btn-pdf me-2" target="_blank">
                                        <i class="bi bi-file-pdf me-1"></i> Download PDF
                                    </a>
                                    <a href="{{ route('forms.form6.preview-pdf', $rumahtangga->id) }}" class="btn btn-custom btn-preview" target="_blank">
                                        <i class="bi bi-eye me-1"></i> Preview PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h5 class="section-title">Detail Informasi</h5>                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-data">
                                <div class="card-header-custom">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Bencana
                                </div>
                                <div class="card-body">
                                    <table class="detail-table">
                                        <tr>
                                            <th>Nama Bencana</th>
                                            <td>{{ $rumahtangga->bencana->nama_bencana }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Bencana</th>
                                            <td>{{ $rumahtangga->bencana->tanggal }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi Bencana</th>
                                            <td>{{ $rumahtangga->bencana->lokasi }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-data">
                                <div class="card-header-custom">
                                    <i class="bi bi-person me-2"></i>Informasi Kepala Keluarga
                                </div>
                                <div class="card-body">
                                    <table class="detail-table">
                                        <tr>
                                            <th>Nama Kepala Keluarga</th>
                                            <td>{{ $rumahtangga->nama_kk }}</td>
                                        </tr>
                                        <tr>
                                            <th>NIK</th>
                                            <td>{{ $rumahtangga->nik_kk }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Anggota Keluarga</th>
                                            <td>{{ $rumahtangga->jumlah_anggota }} orang</td>
                                        </tr>
                                        <tr>
                                            <th>No. HP/Telepon</th>
                                            <td>{{ $rumahtangga->nomor_hp }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card card-data">
                                <div class="card-header-custom">
                                    <i class="bi bi-geo-alt me-2"></i>Alamat Lengkap
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="detail-table">
                                                <tr>
                                                    <th>Dusun/Lingkungan</th>
                                                    <td>{{ $rumahtangga->dusun }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Desa/Kelurahan</th>
                                                    <td>{{ $rumahtangga->desa }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kabupaten/Kota</th>
                                                    <td>{{ $rumahtangga->kabupaten }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="detail-table">
                                                <tr>
                                                    <th>RT/RW</th>
                                                    <td>{{ $rumahtangga->rt }}/{{ $rumahtangga->rw }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kecamatan</th>
                                                    <td>{{ $rumahtangga->kecamatan }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Provinsi</th>
                                                    <td>{{ $rumahtangga->provinsi }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card card-data">
                                <div class="card-header-custom">
                                    <i class="bi bi-house me-2"></i>Informasi Rumah & Kerusakan
                                </div>
                                <div class="card-body">
                                    <table class="detail-table">
                                        <tr>
                                            <th>Status Rumah</th>
                                            <td>{{ $rumahtangga->status_rumah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status Hunian Pasca Bencana</th>
                                            <td>{{ $rumahtangga->status_hunian }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kategori Kerusakan</th>
                                            <td>
                                                @if($rumahtangga->kategori_kerusakan == 'Rusak Berat')
                                                    <span class="badge badge-danger">{{ $rumahtangga->kategori_kerusakan }}</span>
                                                @elseif($rumahtangga->kategori_kerusakan == 'Rusak Sedang')
                                                    <span class="badge badge-warning">{{ $rumahtangga->kategori_kerusakan }}</span>
                                                @elseif($rumahtangga->kategori_kerusakan == 'Rusak Ringan')
                                                    <span class="badge badge-info">{{ $rumahtangga->kategori_kerusakan }}</span>
                                                @else
                                                    <span class="badge badge-success">{{ $rumahtangga->kategori_kerusakan }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-data">
                                <div class="card-header-custom">
                                    <i class="bi bi-box-seam me-2"></i>Informasi Bantuan
                                </div>
                                <div class="card-body">
                                    <table class="detail-table">
                                        <tr>
                                            <th>Status Bantuan</th>
                                            <td>
                                                @if($rumahtangga->status_bantuan == 'Ya')
                                                    <span class="badge badge-success">Sudah Menerima Bantuan</span>
                                                @else
                                                    <span class="badge badge-secondary">Belum Menerima Bantuan</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @if($rumahtangga->status_bantuan == 'Ya')
                                        <tr>
                                            <th>Jenis Bantuan</th>
                                            <td>{{ $rumahtangga->jenis_bantuan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nominal/Nilai Bantuan</th>
                                            <td>Rp {{ number_format($rumahtangga->nominal_bantuan, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pemberi Bantuan</th>
                                            <td>{{ $rumahtangga->pemberi_bantuan }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card card-data">
                                <div class="card-header-custom">
                                    <i class="bi bi-tools me-2"></i>Kebutuhan Rehabilitasi
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="border-start border-4 border-primary ps-3 mb-3">
                                                <h6 class="fw-bold text-primary">Kebutuhan Material</h6>
                                                <p class="mb-0">{{ $rumahtangga->kebutuhan_material ?: 'Tidak ada' }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="border-start border-4 border-success ps-3 mb-3">
                                                <h6 class="fw-bold text-success">Kebutuhan SDM</h6>
                                                <p class="mb-0">{{ $rumahtangga->kebutuhan_sdm ?: 'Tidak ada' }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="border-start border-4 border-danger ps-3 mb-3">
                                                <h6 class="fw-bold text-danger">Estimasi Kebutuhan Dana</h6>
                                                <p class="mb-0">Rp {{ number_format($rumahtangga->kebutuhan_dana, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    @if($rumahtangga->keterangan_tambahan)
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card card-data">
                                <div class="card-header-custom">
                                    <i class="bi bi-info-circle me-2"></i>Keterangan Tambahan
                                </div>
                                <div class="card-body">
                                    <div class="p-3 bg-light rounded">
                                        <p class="mb-0">{{ $rumahtangga->keterangan_tambahan }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card card-data">
                                <div class="card-header-custom">
                                    <i class="bi bi-images me-2"></i>Dokumentasi
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="img-wrapper">
                                                <div class="img-container" id="img-rumah">
                                                    <img src="{{ asset('storage/' . $rumahtangga->foto_rumah) }}" class="img-fluid" alt="Foto Rumah">
                                                </div>
                                                <p class="img-caption">Foto Rumah/Bangunan</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="img-wrapper">
                                                <div class="img-container" id="img-ktp">
                                                    <img src="{{ asset('storage/' . $rumahtangga->foto_ktp) }}" class="img-fluid" alt="Foto KTP">
                                                </div>
                                                <p class="img-caption">Foto KTP Kepala Keluarga</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="img-wrapper">
                                                <div class="img-container" id="img-kk">
                                                    <img src="{{ asset('storage/' . $rumahtangga->foto_kk) }}" class="img-fluid" alt="Foto KK">
                                                </div>
                                                <p class="img-caption">Foto Kartu Keluarga</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image Zoom Container -->
                    <div class="image-zoom-container" id="image-zoom">
                        <span class="zoom-close" onclick="closeZoom()">&times;</span>
                        <div class="zoom-content">
                            <img src="" class="zoom-image" id="zoomed-image">
                        </div>
                    </div>                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card card-data">
                                <div class="card-header-custom">
                                    <i class="bi bi-clock-history me-2"></i>Informasi Pencatatan
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center p-3 bg-light rounded mb-3">
                                                <div class="me-3">
                                                    <i class="bi bi-person-plus fs-3 text-primary"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Dibuat Oleh: <strong>{{ $rumahtangga->createdBy->name ?? 'Unknown' }}</strong></h6>
                                                    <small class="text-muted">{{ $rumahtangga->created_at->format('d-m-Y H:i') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        @if($rumahtangga->updated_by)
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center p-3 bg-light rounded mb-3">
                                                <div class="me-3">
                                                    <i class="bi bi-pencil-square fs-3 text-success"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Diperbarui Oleh: <strong>{{ $rumahtangga->updatedBy->name ?? 'Unknown' }}</strong></h6>
                                                    <small class="text-muted">{{ $rumahtangga->updated_at->format('d-m-Y H:i') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image zoom functionality
        const imgRumah = document.getElementById('img-rumah');
        const imgKTP = document.getElementById('img-ktp');
        const imgKK = document.getElementById('img-kk');
        const imageZoom = document.getElementById('image-zoom');
        const zoomedImage = document.getElementById('zoomed-image');
        
        if (imgRumah) {
            imgRumah.addEventListener('click', function() {
                const imgSrc = this.querySelector('img').src;
                zoomedImage.src = imgSrc;
                imageZoom.style.display = 'flex';
            });
        }
        
        if (imgKTP) {
            imgKTP.addEventListener('click', function() {
                const imgSrc = this.querySelector('img').src;
                zoomedImage.src = imgSrc;
                imageZoom.style.display = 'flex';
            });
        }
        
        if (imgKK) {
            imgKK.addEventListener('click', function() {
                const imgSrc = this.querySelector('img').src;
                zoomedImage.src = imgSrc;
                imageZoom.style.display = 'flex';
            });
        }
    });
    
    function closeZoom() {
        document.getElementById('image-zoom').style.display = 'none';
    }
</script>
@endpush

@endsection
