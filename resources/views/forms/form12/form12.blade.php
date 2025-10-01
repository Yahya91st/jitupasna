@extends('layouts.main')

@section('content')

<div class="container" style="max-width: 800px; font-family: Times New Roman, serif;">    
    <div class="text-center mb-4">
        <h5><strong>Formulir 12</strong></h5>
        <h5>Standar Penyusunan Kegiatan dan Anggaran untuk PKPB</h5>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
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

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-3">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Simpan Data
                            </button>
                            <button type="reset" class="btn btn-warning" onclick="resetForm()">
                                <i class="bi bi-arrow-clockwise"></i> Reset
                            </button>
                            <button type="button" class="btn btn-info" onclick="printForm()">
                                <i class="bi bi-printer"></i> Cetak
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="previewForm()">
                                <i class="bi bi-eye"></i> Preview
                            </button>
                            <a href="{{ route('forms.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
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

    function resetForm() {
        if (confirm('Apakah Anda yakin ingin mereset semua data form?')) {
            document.querySelector('form').reset();
        }
    }

    function printForm() {
        window.print();
    }

    function previewForm() {
        // Create preview window
        const previewWindow = window.open('', '_blank', 'width=800,height=600,scrollbars=yes');
        const formContent = document.querySelector('.container').cloneNode(true);
        
        // Remove buttons from preview
        const buttons = formContent.querySelectorAll('button');
        buttons.forEach(btn => btn.style.display = 'none');
        
        // Remove links from preview
        const links = formContent.querySelectorAll('a');
        links.forEach(link => link.style.display = 'none');
        
        // Remove input borders for preview
        const inputs = formContent.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            const span = document.createElement('span');
            span.textContent = input.value || input.placeholder || (input.selectedOptions && input.selectedOptions[0] ? input.selectedOptions[0].text : '');
            span.style.borderBottom = '1px solid #000';
            span.style.minWidth = '100px';
            span.style.display = 'inline-block';
            input.parentNode.replaceChild(span, input);
        });
        
        previewWindow.document.write(`
            <html>
            <head>
                <title>Preview Form 12 - Standar Anggaran PKPB</title>
                <style>
                    body { font-family: 'Times New Roman', serif; padding: 20px; }
                    .card { border: none; }
                    .card-body { padding: 0; }
                </style>
            </head>
            <body>
                ${formContent.outerHTML}
            </body>
            </html>
        `);
        previewWindow.document.close();
    }
</script>
@endpush
