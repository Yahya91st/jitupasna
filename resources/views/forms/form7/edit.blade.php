@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title mb-4">
            <h3>Edit Data Focus Group Discussion (Form 7)</h3>
            <p class="text-subtitle text-muted">Ubah data FGD yang telah dilaksanakan</p>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('forms.form7.update', $form->id) }}" method="POST" class="form">
                        @csrf
                        @method('PATCH')

                        <h5 class="mt-3 mb-3">Informasi Lokasi</h5>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="desa_kelurahan">Desa/Kelurahan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('desa_kelurahan') is-invalid @enderror" id="desa_kelurahan" name="desa_kelurahan" value="{{ old('desa_kelurahan', $form->desa_kelurahan) }}" required>
                                    @error('desa_kelurahan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $form->kecamatan) }}" required>
                                    @error('kecamatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kabupaten">Kabupaten <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('kabupaten') is-invalid @enderror" id="kabupaten" name="kabupaten" value="{{ old('kabupaten', $form->kabupaten) }}" required>
                                    @error('kabupaten')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal FGD <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $form->tanggal ? $form->tanggal->format('Y-m-d') : '') }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jarak_bencana">Jarak dari Lokasi Bencana (km)</label>
                                    <input type="number" step="0.1" class="form-control @error('jarak_bencana') is-invalid @enderror" id="jarak_bencana" name="jarak_bencana" value="{{ old('jarak_bencana', $form->jarak_bencana) }}">
                                    @error('jarak_bencana')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempat_sesi">Tempat Pelaksanaan Sesi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('tempat_sesi') is-invalid @enderror" id="tempat_sesi" name="tempat_sesi" value="{{ old('tempat_sesi', $form->tempat_sesi) }}" required>
                                    @error('tempat_sesi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3">Informasi Peserta</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jumlah_peserta">Jumlah Peserta <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror" id="jumlah_peserta" name="jumlah_peserta" value="{{ old('jumlah_peserta', $form->jumlah_peserta) }}" min="1" required readonly>
                                    @error('jumlah_peserta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Total otomatis dari jumlah perempuan + laki-laki</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jumlah_perempuan">Jumlah Perempuan <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('jumlah_perempuan') is-invalid @enderror" id="jumlah_perempuan" name="jumlah_perempuan" value="{{ old('jumlah_perempuan', $form->jumlah_perempuan) }}" min="0" required>
                                    @error('jumlah_perempuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jumlah_laki_laki">Jumlah Laki-laki <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('jumlah_laki_laki') is-invalid @enderror" id="jumlah_laki_laki" name="jumlah_laki_laki" value="{{ old('jumlah_laki_laki', $form->jumlah_laki_laki) }}" min="0" required>
                                    @error('jumlah_laki_laki')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="komposisi_peserta">Komposisi Peserta</label>
                                    <textarea class="form-control @error('komposisi_peserta') is-invalid @enderror" id="komposisi_peserta" name="komposisi_peserta" rows="3">{{ old('komposisi_peserta', $form->komposisi_peserta) }}</textarea>
                                    @error('komposisi_peserta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Contoh: Kepala Desa, Tokoh Masyarakat, Tokoh Agama, Kelompok Perempuan, dll.</small>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3">Penyelenggara</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fasilitator">Fasilitator <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('fasilitator') is-invalid @enderror" id="fasilitator" name="fasilitator" value="{{ old('fasilitator', $form->fasilitator) }}" required>
                                    @error('fasilitator')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pencatat">Pencatat/Notulen <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('pencatat') is-invalid @enderror" id="pencatat" name="pencatat" value="{{ old('pencatat', $form->pencatat) }}" required>
                                    @error('pencatat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3">Hasil Diskusi</h5>
                        <div class="form-group">
                            <label for="akses_hak">1. Akses dan Hak Terhadap Sumber Daya</label>
                            <textarea class="form-control @error('akses_hak') is-invalid @enderror" id="akses_hak" name="akses_hak" rows="5">{{ old('akses_hak', $form->akses_hak) }}</textarea>
                            @error('akses_hak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fungsi_pranata">2. Fungsi Pranata Sosial dan Keagamaan</label>
                            <textarea class="form-control @error('fungsi_pranata') is-invalid @enderror" id="fungsi_pranata" name="fungsi_pranata" rows="5">{{ old('fungsi_pranata', $form->fungsi_pranata) }}</textarea>
                            @error('fungsi_pranata')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="resiko_kerentanan">3. Resiko dan Kerentanan</label>
                            <textarea class="form-control @error('resiko_kerentanan') is-invalid @enderror" id="resiko_kerentanan" name="resiko_kerentanan" rows="5">{{ old('resiko_kerentanan', $form->resiko_kerentanan) }}</textarea>
                            @error('resiko_kerentanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update Data
                            </button>
                            <a href="{{ route('forms.form7.show', $form->id) }}" class="btn btn-secondary">
                                <i class="bi bi-x"></i> Batalkan
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Auto-calculate total participants
        function updateTotalParticipants() {
            const perempuan = parseInt(document.getElementById('jumlah_perempuan').value) || 0;
            const lakiLaki = parseInt(document.getElementById('jumlah_laki_laki').value) || 0;
            document.getElementById('jumlah_peserta').value = perempuan + lakiLaki;
        }

        document.getElementById('jumlah_perempuan').addEventListener('input', updateTotalParticipants);
        document.getElementById('jumlah_laki_laki').addEventListener('input', updateTotalParticipants);
    </script>
@endpush
