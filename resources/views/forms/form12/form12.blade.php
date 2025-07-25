@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Formulir 12 - Standar Penyusunan Kegiatan dan Anggaran untuk PKPB</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('forms.form12.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h5>Informasi Bencana</h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="bencana_id" class="form-label">Pilih Bencana</label>
                                <select name="bencana_id" id="bencana_id" class="form-select" required>
                                    <option value="">-- Pilih Bencana --</option>
                                    @if(isset($bencana))
                                        <option value="{{ $bencana->id }}" selected>
                                            {{ $bencana->kategori_bencana->nama }} - {{ $bencana->tanggal }}
                                        </option>
                                    @else
                                        @foreach($bencanas as $b)
                                            <option value="{{ $b->id }}" {{ old('bencana_id') == $b->id ? 'selected' : '' }}>
                                                {{ $b->kategori_bencana->nama }} - {{ $b->tanggal }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h5>Informasi Anggaran Kegiatan</h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sektor" class="form-label">Sektor</label>
                                <select name="sektor" id="sektor" class="form-select" required>
                                    <option value="">-- Pilih Sektor --</option>
                                    <option value="Perumahan" {{ old('sektor') == 'Perumahan' ? 'selected' : '' }}>Perumahan</option>
                                    <option value="Kesehatan" {{ old('sektor') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                    <option value="Pendidikan" {{ old('sektor') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                    <option value="Sosial" {{ old('sektor') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                                    <option value="Ekonomi" {{ old('sektor') == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                                    <option value="Infrastruktur" {{ old('sektor') == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                                    <option value="Pemerintahan" {{ old('sektor') == 'Pemerintahan' ? 'selected' : '' }}>Pemerintahan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="komponen_kebutuhan" class="form-label">Komponen Kebutuhan</label>
                                <input type="text" name="komponen_kebutuhan" id="komponen_kebutuhan" class="form-control" value="{{ old('komponen_kebutuhan') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kegiatan" class="form-label">Kegiatan</label>
                                <input type="text" name="kegiatan" id="kegiatan" class="form-control" value="{{ old('kegiatan') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ old('lokasi') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 mb-3">
                                <label for="volume" class="form-label">Volume</label>
                                <input type="number" name="volume" id="volume" class="form-control" value="{{ old('volume', 1) }}" min="1" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <input type="text" name="satuan" id="satuan" class="form-control" value="{{ old('satuan') }}" required>
                                <small class="form-text text-muted">Contoh: Unit, Paket, Orang, dll.</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="harga_satuan" class="form-label">Harga Satuan (Rp)</label>
                                <input type="number" name="harga_satuan" id="harga_satuan" class="form-control" value="{{ old('harga_satuan', 0) }}" min="0" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ old('keterangan') }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('forms.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary float-end">Simpan Data</button>
                            </div>
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
    document.addEventListener('DOMContentLoaded', function () {
        // Calculate total
        const volumeInput = document.getElementById('volume');
        const hargaSatuanInput = document.getElementById('harga_satuan');
        
        function updateTotal() {
            const volume = parseFloat(volumeInput.value) || 0;
            const hargaSatuan = parseFloat(hargaSatuanInput.value) || 0;
            const total = volume * hargaSatuan;
            
            // We could display the total if desired
            console.log("Total biaya: " + total);
        }
        
        volumeInput.addEventListener('input', updateTotal);
        hargaSatuanInput.addEventListener('input', updateTotal);
    });
</script>
@endpush
