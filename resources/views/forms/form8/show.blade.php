@extends('layouts.main')

@push('style')
    <style>
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
    </style>
@endpush

@section('content')
    @if (session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="mb-2">
                    <a href="{{ route('forms.form8.list', ['bencana_id' => $form->bencana_id]) }}" class="btn btn-custom me-2" style="background-color: #6c757d; color: white;">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <a href="{{ route('forms.form8.edit', $form->id) }}" class="btn btn-custom" style="background-color: #F28705; color: white;">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                </div>
                <div>
                    <a href="{{ route('forms.form8.pdf', $form->id) }}" class="btn btn-custom me-2" style="background-color: #dc3545; color: white;" target="_blank">
                        <i class="bi bi-file-pdf me-1"></i> Download PDF
                    </a>
                    <a href="{{ route('forms.form8.preview-pdf', $form->id) }}" class="btn btn-custom" style="background-color: #0dcaf0; color: white;" target="_blank">
                        <i class="bi bi-eye me-1"></i> Preview PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- PDF Preview Section -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #F28705; color: white;">
                    <i class="bi bi-file-pdf me-2"></i>Preview Dokumen - {{ $form->sektor }} ({{ $form->lokasi }})
                </div>
                <div class="card-body p-0">
                    <iframe 
                        src="{{ route('forms.form8.preview-pdf', $form->id) }}" 
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
                <div class="card-header" style="background-color: #F28705; color: white;">
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
                                    <h6 class="mb-0">Dibuat Oleh: <strong>{{ $form->createdBy->name ?? 'Unknown' }}</strong></h6>
                                    <small class="text-muted">{{ $form->created_at->format('d-m-Y H:i') }}</small>
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
                                        <h6 class="mb-0">Diperbarui Oleh: <strong>{{ $form->updatedBy->name ?? 'Unknown' }}</strong></h6>
                                        <small class="text-muted">{{ $form->updated_at->format('d-m-Y H:i') }}</small>
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
