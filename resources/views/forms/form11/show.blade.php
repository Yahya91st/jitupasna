@extends('layouts.main')

@push('style')
    <style>
        .card-header-custom {
            background-color: #F28705;
            color: white;
            border-radius: 0.5rem 0.5rem 0 0;
            padding: 1rem 1.5rem;
            font-weight: 600;
        }

        .detail-table {
            width: 100%;
        }

        .detail-table td,
        .detail-table th {
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
            <h3>Formulir 11 - Rekapitulasi Kebutuhan Pascabencana</h3>
            <p class="text-subtitle text-muted">Data lengkap rekapitulasi kebutuhan untuk pemulihan pascabencana</p>
        </div>

        <div class="card shadow-sm">
            <div class="card-content">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success shadow-sm">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="mb-2">
                                    <a href="{{ route('forms.form11.list', ['bencana_id' => $form11->bencana_id]) }}" class="btn me-2" style="background-color: #6c757d; color: white;">
                                        <i class="bi bi-arrow-left me-1"></i> Kembali
                                    </a>
                                    <a href="{{ route('forms.form11.edit', $form11->id) }}" class="btn" style="background-color: #F28705; color: white;">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route('forms.form11.pdf', $form11->id) }}" class="btn me-2" style="background-color: #dc3545; color: white;" target="_blank">
                                        <i class="bi bi-file-pdf me-1"></i> Download PDF
                                    </a>
                                    <a href="{{ route('forms.form11.preview-pdf', $form11->id) }}" class="btn" style="background-color: #0dcaf0; color: white;" target="_blank">
                                        <i class="bi bi-eye me-1"></i> Preview PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PDF Preview Section -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header-custom">
                                    <i class="bi bi-file-pdf me-2"></i>Preview Dokumen - Rekapitulasi Kebutuhan ({{ $form11->tanggal ? \Carbon\Carbon::parse($form11->tanggal)->format('d/m/Y') : '-' }})
                                </div>
                                <div class="card-body p-0">
                                    <iframe 
                                        src="{{ route('forms.form11.preview-pdf', $form11->id) }}" 
                                        width="100%" 
                                        height="800px" 
                                        style="border: none;"
                                        frameborder="0">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Pencatatan -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
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
                                                    <h6 class="mb-0">Dibuat Oleh: <strong>{{ $form11->createdBy->name ?? 'Unknown' }}</strong></h6>
                                                    <small class="text-muted">{{ $form11->created_at->format('d-m-Y H:i') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($form11->updated_by)
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center p-3 bg-light rounded mb-3">
                                                    <div class="me-3">
                                                        <i class="bi bi-pencil-square fs-3 text-success"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">Diperbarui Oleh: <strong>{{ $form11->updatedBy->name ?? 'Unknown' }}</strong></h6>
                                                        <small class="text-muted">{{ $form11->updated_at->format('d-m-Y H:i') }}</small>
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
@endsection
