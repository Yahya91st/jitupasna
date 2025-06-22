@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Formulir 10 - Analisa Data Akibat</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    
                    <!-- Form start -->
                    <form action="{{ route('forms.form10.update', $analisa->id) }}" method="POST" class="form-group">
                        @csrf
                        @method('PATCH')
                        
                        <!-- Bencana Selection -->
                        <div class="form-group mb-3">
                            <label for="bencana_id" class="form-label">Pilih Bencana <span class="text-danger">*</span></label>
                            <select name="bencana_id" id="bencana_id" class="form-control select2 @error('bencana_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Bencana --</option>
                                @foreach($bencanas as $b)
                                <option value="{{ $b->id }}" {{ old('bencana_id', $analisa->bencana_id) == $b->id ? 'selected' : '' }}>
                                    {{ $b->kategori_bencana->nama }} - Ref: {{ $b->Ref }} - {{ $b->tanggal }}
                                </option>
                                @endforeach
                            </select>
                            @error('bencana_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Sektor -->
                        <div class="form-group mb-3">
                            <label for="sektor" class="form-label">Sektor <span class="text-danger">*</span></label>
                            <select name="sektor" id="sektor" class="form-control @error('sektor') is-invalid @enderror" required>
                                <option value="">-- Pilih Sektor --</option>
                                <option value="Perumahan" {{ old('sektor', $analisa->sektor) == 'Perumahan' ? 'selected' : '' }}>Perumahan</option>
                                <option value="Infrastruktur" {{ old('sektor', $analisa->sektor) == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                                <option value="Ekonomi Produktif" {{ old('sektor', $analisa->sektor) == 'Ekonomi Produktif' ? 'selected' : '' }}>Ekonomi Produktif</option>
                                <option value="Sosial" {{ old('sektor', $analisa->sektor) == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                                <option value="Lintas Sektor" {{ old('sektor', $analisa->sektor) == 'Lintas Sektor' ? 'selected' : '' }}>Lintas Sektor</option>
                            </select>
                            @error('sektor')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Sub Sektor -->
                        <div class="form-group mb-3">
                            <label for="sub_sektor" class="form-label">Sub Sektor <span class="text-danger">*</span></label>
                            <input type="text" name="sub_sektor" id="sub_sektor" class="form-control @error('sub_sektor') is-invalid @enderror" value="{{ old('sub_sektor', $analisa->sub_sektor) }}" required>
                            @error('sub_sektor')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Lokasi -->
                        <div class="form-group mb-3">
                            <label for="lokasi" class="form-label">Lokasi <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $analisa->lokasi) }}" required>
                            @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Hasil Survey -->
                        <div class="form-group mb-3">
                            <label for="hasil_survey" class="form-label">Point Penting Hasil Pengolahan Data Survey <span class="text-danger">*</span></label>
                            <textarea name="hasil_survey" id="hasil_survey" class="form-control @error('hasil_survey') is-invalid @enderror" rows="4" required>{{ old('hasil_survey', $analisa->hasil_survey) }}</textarea>
                            @error('hasil_survey')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Hasil Wawancara/FGD -->
                        <div class="form-group mb-3">
                            <label for="hasil_wawancara" class="form-label">Point Penting Hasil Wawancara/FGD <span class="text-danger">*</span></label>
                            <textarea name="hasil_wawancara" id="hasil_wawancara" class="form-control @error('hasil_wawancara') is-invalid @enderror" rows="4" required>{{ old('hasil_wawancara', $analisa->hasil_wawancara) }}</textarea>
                            @error('hasil_wawancara')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Hasil Pendataan SKPD -->
                        <div class="form-group mb-3">
                            <label for="hasil_pendataan_skpd" class="form-label">Point Penting Hasil Pendataan ke SKPD <span class="text-danger">*</span></label>
                            <textarea name="hasil_pendataan_skpd" id="hasil_pendataan_skpd" class="form-control @error('hasil_pendataan_skpd') is-invalid @enderror" rows="4" required>{{ old('hasil_pendataan_skpd', $analisa->hasil_pendataan_skpd) }}</textarea>
                            @error('hasil_pendataan_skpd')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                          <!-- Kebutuhan Pemulihan -->
                        <div class="form-group mb-3">
                            <label for="kebutuhan_pemulihan" class="form-label">Kebutuhan-Kegiatan Pemulihan <span class="text-danger">*</span></label>
                            <textarea name="kebutuhan_pemulihan" id="kebutuhan_pemulihan" class="form-control @error('kebutuhan_pemulihan') is-invalid @enderror" rows="4" required>{{ old('kebutuhan_pemulihan', $analisa->kebutuhan_pemulihan) }}</textarea>
                            @error('kebutuhan_pemulihan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Update Data</button>
                            <a href="{{ route('forms.form10.show', $analisa->id) }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                    <!-- Form end -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        if($('.select2').length) {
            $('.select2').select2();
        }
    });
</script>
@endpush
