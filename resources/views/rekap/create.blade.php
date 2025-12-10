@extends('layouts.main')

@section('content')
<style>
    :root {
        --orange-primary: #F28705;
        --orange-gradient: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
    }

    .main-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.04);
    }

    .card-header-gradient {
        background: var(--orange-gradient);
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header-gradient h4 {
        color: white;
        margin: 0;
        font-weight: 700;
        font-size: 1.15rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-content {
        padding: 2rem;
    }

    .form-group label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control, .form-select {
        padding: 0.625rem 0.875rem;
        border-radius: 8px;
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--orange-primary);
        box-shadow: 0 0 0 0.2rem rgba(242, 135, 5, 0.15);
        outline: none;
    }

    .btn-orange {
        background: var(--orange-gradient);
        color: white;
        border: none;
        padding: 0.625rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-orange:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(242, 135, 5, 0.3);
        color: white;
    }

    .btn-light-secondary {
        background: #f8f9fa;
        color: #6c757d;
        border: 1px solid #dee2e6;
        padding: 0.625rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-light-secondary:hover {
        background: #e9ecef;
        border-color: #adb5bd;
    }

    .info-card {
        background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
        border-radius: 10px;
        padding: 1.25rem;
        margin-bottom: 1.75rem;
        border-left: 5px solid var(--orange-primary);
        box-shadow: 0 2px 8px rgba(242, 135, 5, 0.1);
    }

    .info-card strong {
        color: var(--orange-primary);
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .info-card .mb-2 {
        margin-bottom: 0.75rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }

    .ql-container {
        min-height: 150px;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .ql-toolbar {
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        background: #f8f9fa;
    }
</style>

<div class="container mt-4">
    <div class="col-12">
        <div class="card main-card">
            <div class="card-header card-header-gradient">
                <h4>
                    <i data-feather="file-text" style="width: 20px; height: 20px;"></i>
                    Tambah Rekap Bencana
                </h4>
                <a href="{{ route('bencana.index') }}" class="btn btn-light-secondary">
                    <i data-feather="arrow-left" style="width: 16px; height: 16px;"></i>
                    Kembali
                </a>
            </div>
            
            <div class="card-content">
                <div class="card-body">
                    @if(isset($bencana))
                    <div class="info-card">
                        <div class="mb-2">
                            <strong>
                                <i data-feather="alert-triangle" style="width:16px;height:16px;"></i> 
                                Kategori Bencana:
                            </strong> 
                            {{ $bencana->kategori_bencana->nama ?? 'Tidak ada kategori' }}
                        </div>
                        
                        <div class="mb-2">
                            <strong>
                                <i data-feather="map-pin" style="width:16px;height:16px;"></i> 
                                Lokasi:
                            </strong> 
                            @php
                                // Ambil dan parse data villages dari berbagai kemungkinan format
                                $lokasiText = '';
                                
                                // Cek field village_code (biasanya JSON string atau array)
                                if (!empty($bencana->village_code)) {
                                    // Decode jika masih JSON string
                                    $villages = is_string($bencana->village_code) 
                                        ? json_decode($bencana->village_code, true) 
                                        : $bencana->village_code;
                                    
                                    // Extract nama desa dari array
                                    if (is_array($villages) && count($villages) > 0) {
                                        $villageNames = [];
                                        foreach ($villages as $village) {
                                            // Jika village adalah array, ambil 'name' atau 'code'
                                            if (is_array($village)) {
                                                $villageNames[] = $village['name'] ?? $village['code'] ?? '';
                                            } 
                                            // Jika village sudah string langsung
                                            elseif (is_string($village)) {
                                                $villageNames[] = $village;
                                            }
                                        }
                                        // Gabungkan dengan koma, filter yang kosong
                                        $lokasiText = implode(', ', array_filter($villageNames));
                                    }
                                }
                                
                                // Fallback: cek field villages (relasi atau attribute)
                                if (empty($lokasiText) && !empty($bencana->villages)) {
                                    $villages = is_string($bencana->villages) 
                                        ? json_decode($bencana->villages, true) 
                                        : $bencana->villages;
                                    
                                    if (is_array($villages) && count($villages) > 0) {
                                        $villageNames = [];
                                        foreach ($villages as $village) {
                                            if (is_array($village)) {
                                                $villageNames[] = $village['name'] ?? $village['code'] ?? '';
                                            } elseif (is_string($village)) {
                                                $villageNames[] = $village;
                                            }
                                        }
                                        $lokasiText = implode(', ', array_filter($villageNames));
                                    }
                                }
                                
                                // Fallback terakhir: field desa_kelurahan
                                if (empty($lokasiText) && !empty($bencana->desa_kelurahan)) {
                                    $lokasiText = $bencana->desa_kelurahan;
                                }
                            @endphp
                            
                            {{ $lokasiText ?: 'N/A' }}
                            
                            @if($bencana->kecamatan || $bencana->kabupaten_kota || $bencana->provinsi)
                            <br>
                            <small class="text-muted">
                                @if($bencana->kecamatan)
                                    Kec. {{ $bencana->kecamatan }}
                                @endif
                                @if($bencana->kecamatan && ($bencana->kabupaten_kota || $bencana->provinsi))
                                    , 
                                @endif
                                @if($bencana->kabupaten_kota)
                                    {{ $bencana->kabupaten_kota }}
                                @endif
                                @if($bencana->kabupaten_kota && $bencana->provinsi)
                                    , 
                                @endif
                                @if($bencana->provinsi)
                                    {{ $bencana->provinsi }}
                                @endif
                            </small>
                            @endif
                        </div>
                        
                        <div>
                            <strong>
                                <i data-feather="calendar" style="width:16px;height:16px;"></i> 
                                Tanggal Bencana:
                            </strong> 
                            @if($bencana->tanggal)
                                {{ \Carbon\Carbon::parse($bencana->tanggal)->translatedFormat('d F Y') }}
                                <small class="text-muted">({{ \Carbon\Carbon::parse($bencana->tanggal)->diffForHumans() }})</small>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('rekap.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? '' }}">

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="judul">Judul Rekap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                           id="judul" name="judul" value="{{ old('judul') }}" required>
                                    @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="tanggal_rekap">Tanggal Rekap <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal_rekap') is-invalid @enderror" 
                                           id="tanggal_rekap" name="tanggal_rekap" value="{{ old('tanggal_rekap', date('Y-m-d')) }}" required>
                                    @error('tanggal_rekap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi Rekap</label>
                                    <div id="quillEditor"></div>
                                    <input type="hidden" name="deskripsi" id="deskripsi">
                                    @error('deskripsi')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('bencana.index') }}" class="btn btn-light-secondary">
                                <i data-feather="x" style="width: 16px; height: 16px;"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-orange">
                                <i data-feather="save" style="width: 16px; height: 16px;"></i>
                                Simpan Rekap
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('frontend/dist/assets/vendors/quill/quill.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Feather Icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }

    // Initialize Quill editor
    var quill = new Quill('#quillEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'font': [] }, { 'size': [] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['link'],
                ['clean']
            ]
        },
        placeholder: 'Tulis deskripsi rekap...'
    });

    // Form submit - save Quill content to hidden input
    var form = document.querySelector('form');
    if (form) {
        form.onsubmit = function() {
            document.querySelector('#deskripsi').value = quill.root.innerHTML;
        };
    }
});
</script>
@endpush