@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Rekapitulasi Kebutuhan Pascabencana</h4>
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
                    <form action="{{ route('forms.form11.update', $rekapitulasi->id) }}" method="POST" class="form-group">
                        @csrf
                        @method('PATCH')
                        
                        <!-- Bencana Selection -->
                        <div class="form-group mb-3">
                            <label for="bencana_id" class="form-label">Pilih Bencana <span class="text-danger">*</span></label>
                            <select name="bencana_id" id="bencana_id" class="form-control select2 @error('bencana_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Bencana --</option>
                                @foreach($bencanas as $b)
                                <option value="{{ $b->id }}" {{ (old('bencana_id', $rekapitulasi->bencana_id) == $b->id) ? 'selected' : '' }}>
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
                                <option value="Perumahan" {{ old('sektor', $rekapitulasi->sektor) == 'Perumahan' ? 'selected' : '' }}>Perumahan</option>
                                <option value="Infrastruktur" {{ old('sektor', $rekapitulasi->sektor) == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                                <option value="Ekonomi Produktif" {{ old('sektor', $rekapitulasi->sektor) == 'Ekonomi Produktif' ? 'selected' : '' }}>Ekonomi Produktif</option>
                                <option value="Sosial" {{ old('sektor', $rekapitulasi->sektor) == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                                <option value="Lintas Sektor" {{ old('sektor', $rekapitulasi->sektor) == 'Lintas Sektor' ? 'selected' : '' }}>Lintas Sektor</option>
                            </select>
                            @error('sektor')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Sub Sektor -->
                        <div class="form-group mb-3">
                            <label for="sub_sektor" class="form-label">Sub Sektor <span class="text-danger">*</span></label>
                            <input type="text" name="sub_sektor" id="sub_sektor" class="form-control @error('sub_sektor') is-invalid @enderror" value="{{ old('sub_sektor', $rekapitulasi->sub_sektor) }}" required>
                            @error('sub_sektor')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Lokasi -->
                        <div class="form-group mb-3">
                            <label for="lokasi" class="form-label">Lokasi <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $rekapitulasi->lokasi) }}" required>
                            @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Jenis Kebutuhan -->
                        <div class="form-group mb-3">
                            <label for="jenis_kebutuhan" class="form-label">Jenis Kebutuhan <span class="text-danger">*</span></label>
                            <textarea name="jenis_kebutuhan" id="jenis_kebutuhan" class="form-control @error('jenis_kebutuhan') is-invalid @enderror" rows="3" required>{{ old('jenis_kebutuhan', $rekapitulasi->jenis_kebutuhan) }}</textarea>
                            @error('jenis_kebutuhan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Rincian Kebutuhan -->
                        <div class="form-group mb-3">
                            <label for="rincian_kebutuhan" class="form-label">Rincian Kebutuhan <span class="text-danger">*</span></label>
                            <textarea name="rincian_kebutuhan" id="rincian_kebutuhan" class="form-control @error('rincian_kebutuhan') is-invalid @enderror" rows="4" required>{{ old('rincian_kebutuhan', $rekapitulasi->rincian_kebutuhan) }}</textarea>
                            @error('rincian_kebutuhan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Jumlah Unit -->
                        <div class="form-group mb-3">
                            <label for="jumlah_unit" class="form-label">Jumlah Unit <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="jumlah_unit" id="jumlah_unit" class="form-control @error('jumlah_unit') is-invalid @enderror" value="{{ old('jumlah_unit', $rekapitulasi->jumlah_unit) }}" required>
                            @error('jumlah_unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Satuan -->
                        <div class="form-group mb-3">
                            <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                            <input type="text" name="satuan" id="satuan" class="form-control @error('satuan') is-invalid @enderror" value="{{ old('satuan', $rekapitulasi->satuan) }}" required placeholder="Unit, Buah, Meter, dsb">
                            @error('satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Harga Satuan -->
                        <div class="form-group mb-3">
                            <label for="harga_satuan" class="form-label">Harga Satuan (Rp) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="harga_satuan" id="harga_satuan" class="form-control @error('harga_satuan') is-invalid @enderror" value="{{ old('harga_satuan', $rekapitulasi->harga_satuan) }}" required>
                            @error('harga_satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Prioritas -->
                        <div class="form-group mb-3">
                            <label for="prioritas" class="form-label">Prioritas <span class="text-danger">*</span></label>
                            <select name="prioritas" id="prioritas" class="form-control @error('prioritas') is-invalid @enderror" required>
                                <option value="">-- Pilih Prioritas --</option>
                                <option value="Tinggi" {{ old('prioritas', $rekapitulasi->prioritas) == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                                <option value="Sedang" {{ old('prioritas', $rekapitulasi->prioritas) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="Rendah" {{ old('prioritas', $rekapitulasi->prioritas) == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                            </select>
                            @error('prioritas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Durasi Penyelesaian -->
                        <div class="form-group mb-3">
                            <label for="durasi_penyelesaian" class="form-label">Durasi Penyelesaian <span class="text-danger">*</span></label>
                            <input type="text" name="durasi_penyelesaian" id="durasi_penyelesaian" class="form-control @error('durasi_penyelesaian') is-invalid @enderror" value="{{ old('durasi_penyelesaian', $rekapitulasi->durasi_penyelesaian) }}" required placeholder="Contoh: 3 bulan, 1 tahun, dsb">
                            @error('durasi_penyelesaian')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Penanggung Jawab -->
                        <div class="form-group mb-3">
                            <label for="penanggung_jawab" class="form-label">Penanggung Jawab <span class="text-danger">*</span></label>
                            <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control @error('penanggung_jawab') is-invalid @enderror" value="{{ old('penanggung_jawab', $rekapitulasi->penanggung_jawab) }}" required>
                            @error('penanggung_jawab')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Keterangan -->
                        <div class="form-group mb-3">
                            <label for="keterangan" class="form-label">Keterangan Tambahan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="3">{{ old('keterangan', $rekapitulasi->keterangan) }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group d-flex justify-content-between mt-4">
                            <a href="{{ route('forms.form11.show', $rekapitulasi->id) }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Perbarui Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        // Auto calculate total based on jumlah_unit and harga_satuan
        $('#jumlah_unit, #harga_satuan').on('input', function() {
            let jumlahUnit = parseFloat($('#jumlah_unit').val()) || 0;
            let hargaSatuan = parseFloat($('#harga_satuan').val()) || 0;
            let total = jumlahUnit * hargaSatuan;
            
            // You could display this somewhere if needed
            console.log('Total Kebutuhan: ' + total);
        });
        
        // Initialize select2 if available
        if($.fn.select2) {
            $('.select2').select2();
        }
    });
</script>
@endpush
