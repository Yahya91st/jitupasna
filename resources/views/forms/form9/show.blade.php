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
    </style>
@endpush

@section('content')
    @if (session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger shadow-sm">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="mb-2">
                    <a href="{{ route('forms.form9.list', ['bencana_id' => $form->bencana_id]) }}" class="btn btn-custom btn-back me-2">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <a href="{{ route('forms.form9.edit', $form->id) }}" class="btn btn-custom btn-edit">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                </div>
                <div>
                    <a href="{{ route('forms.form9.preview-pdf', $form->id) }}" class="btn btn-custom btn-pdf me-2" target="_blank">
                        <i class="bi bi-file-pdf me-1"></i> Download PDF
                    </a>
                    <a href="{{ route('forms.form9.preview-pdf', $form->id) }}" class="btn btn-custom btn-preview" target="_blank">
                        <i class="bi bi-eye me-1"></i> Preview PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- PDF Preview Section -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-data">
                <div class="card-header-custom">
                    <i class="bi bi-file-pdf me-2"></i>Preview Dokumen - Kuesioner Form 9 ({{ $form->tanggal ? \Carbon\Carbon::parse($form->tanggal)->format('d/m/Y') : '-' }})
                </div>
                <div class="card-body p-0">
                    <iframe 
                        src="{{ route('forms.form9.preview-pdf', $form->id) }}" 
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
                                    <h6 class="mb-0">Dibuat Oleh: <strong>{{ $form->creator->name ?? 'Unknown' }}</strong></h6>
                                    <small class="text-muted">{{ $form->created_at ? $form->created_at->format('d-m-Y H:i') : '-' }}</small>
                                </div>
                            </div>
                        </div>
                        @if ($form->updated_by)
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded mb-3">
                                    <div class="me-3">
                                        <i class="bi bi-pencil-square fs-3 text-success"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Diperbarui Oleh: <strong>{{ $form->updater->name ?? 'Unknown' }}</strong></h6>
                                        <small class="text-muted">{{ $form->updated_at ? $form->updated_at->format('d-m-Y H:i') : '-' }}</small>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
