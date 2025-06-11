@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form 6 - Pendataan Tingkat Rumahtangga</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('forms.form6.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bencana_id">Pilih Bencana</label>
                                    <select name="bencana_id" id="bencana_id" class="form-control" required>
                                        <option value="">-- Pilih Bencana --</option>
                                        @foreach($bencanas as $bencana)
                                            <option value="{{ $bencana->id }}">{{ $bencana->nama_bencana }} ({{ $bencana->tanggal }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3">Informasi Lokasi</h5>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="provinsi">Provinsi</label>
                                    <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ old('provinsi') }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kabupaten">Kabupaten/Kota</label>
                                    <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="{{ old('kabupaten') }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="desa">Desa/Kelurahan</label>
                                    <input type="text" class="form-control" id="desa" name="desa" value="{{ old('desa') }}" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dusun">Dusun/Lingkungan</label>
                                    <input type="text" class="form-control" id="dusun" name="dusun" value="{{ old('dusun') }}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="rt">RT</label>
                                    <input type="text" class="form-control" id="rt" name="rt" value="{{ old('rt') }}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="rw">RW</label>
                                    <input type="text" class="form-control" id="rw" name="rw" value="{{ old('rw') }}" required>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3">Informasi Kepala Keluarga</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_kk">Nama Kepala Keluarga</label>
                                    <input type="text" class="form-control" id="nama_kk" name="nama_kk" value="{{ old('nama_kk') }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nik_kk">NIK Kepala Keluarga</label>
                                    <input type="text" class="form-control" id="nik_kk" name="nik_kk" value="{{ old('nik_kk') }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nomor_hp">Nomor HP/Telepon</label>
                                    <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jumlah_anggota">Jumlah Anggota Keluarga</label>
                                    <input type="number" class="form-control" id="jumlah_anggota" name="jumlah_anggota" value="{{ old('jumlah_anggota') }}" min="1" required>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3">Informasi Rumah & Kerusakan</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status_rumah">Status Rumah</label>
                                    <select class="form-control" id="status_rumah" name="status_rumah" required>
                                        <option value="">-- Pilih Status Rumah --</option>
                                        <option value="Milik Sendiri" {{ old('status_rumah') == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                        <option value="Sewa/Kontrak" {{ old('status_rumah') == 'Sewa/Kontrak' ? 'selected' : '' }}>Sewa/Kontrak</option>
                                        <option value="Menumpang" {{ old('status_rumah') == 'Menumpang' ? 'selected' : '' }}>Menumpang</option>
                                        <option value="Lainnya" {{ old('status_rumah') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status_hunian">Status Hunian Pasca Bencana</label>
                                    <select class="form-control" id="status_hunian" name="status_hunian" required>
                                        <option value="">-- Pilih Status Hunian --</option>
                                        <option value="Masih Dihuni" {{ old('status_hunian') == 'Masih Dihuni' ? 'selected' : '' }}>Masih Dihuni</option>
                                        <option value="Mengungsi" {{ old('status_hunian') == 'Mengungsi' ? 'selected' : '' }}>Mengungsi</option>
                                        <option value="Menumpang" {{ old('status_hunian') == 'Menumpang' ? 'selected' : '' }}>Menumpang</option>
                                        <option value="Lainnya" {{ old('status_hunian') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kategori_kerusakan">Kategori Kerusakan</label>
                                    <select class="form-control" id="kategori_kerusakan" name="kategori_kerusakan" required>
                                        <option value="">-- Pilih Kategori Kerusakan --</option>
                                        <option value="Rusak Berat" {{ old('kategori_kerusakan') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                        <option value="Rusak Sedang" {{ old('kategori_kerusakan') == 'Rusak Sedang' ? 'selected' : '' }}>Rusak Sedang</option>
                                        <option value="Rusak Ringan" {{ old('kategori_kerusakan') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                        <option value="Tidak Rusak" {{ old('kategori_kerusakan') == 'Tidak Rusak' ? 'selected' : '' }}>Tidak Rusak</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3">Informasi Kebutuhan</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kebutuhan_material">Kebutuhan Material</label>
                                    <textarea class="form-control" id="kebutuhan_material" name="kebutuhan_material" rows="3">{{ old('kebutuhan_material') }}</textarea>
                                    <small class="text-muted">Tuliskan jenis material yang dibutuhkan (semen, pasir, kayu, dll)</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kebutuhan_sdm">Kebutuhan SDM</label>
                                    <textarea class="form-control" id="kebutuhan_sdm" name="kebutuhan_sdm" rows="3">{{ old('kebutuhan_sdm') }}</textarea>
                                    <small class="text-muted">Tuliskan kebutuhan tenaga kerja (tukang, kuli, dll)</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kebutuhan_dana">Estimasi Kebutuhan Dana</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" id="kebutuhan_dana" name="kebutuhan_dana" value="{{ old('kebutuhan_dana') ?? 0 }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3">Informasi Bantuan</h5>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status_bantuan">Sudah Menerima Bantuan?</label>
                                    <select class="form-control" id="status_bantuan" name="status_bantuan" required>
                                        <option value="Ya" {{ old('status_bantuan') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                        <option value="Tidak" {{ old('status_bantuan') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 bantuan-detail" id="bantuan-detail">
                                <div class="form-group">
                                    <label for="jenis_bantuan">Jenis Bantuan</label>
                                    <input type="text" class="form-control" id="jenis_bantuan" name="jenis_bantuan" value="{{ old('jenis_bantuan') }}">
                                </div>
                            </div>
                            <div class="col-md-3 bantuan-detail">
                                <div class="form-group">
                                    <label for="nominal_bantuan">Nominal/Nilai Bantuan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" id="nominal_bantuan" name="nominal_bantuan" value="{{ old('nominal_bantuan') ?? 0 }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bantuan-detail">
                                <div class="form-group">
                                    <label for="pemberi_bantuan">Pemberi Bantuan</label>
                                    <input type="text" class="form-control" id="pemberi_bantuan" name="pemberi_bantuan" value="{{ old('pemberi_bantuan') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="keterangan_tambahan">Keterangan Tambahan</label>
                            <textarea class="form-control" id="keterangan_tambahan" name="keterangan_tambahan" rows="4">{{ old('keterangan_tambahan') }}</textarea>
                        </div>

                        <h5 class="mt-4 mb-3">Dokumentasi</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="foto_rumah">Foto Rumah/Bangunan</label>
                                    <input type="file" class="form-control" id="foto_rumah" name="foto_rumah" accept="image/*" required>
                                    <small class="text-muted">Format: JPG/PNG, Maks: 2MB</small>
                                    <div class="mt-2">
                                        <img id="preview_foto_rumah" src="#" alt="Preview Foto Rumah" style="max-width: 100%; max-height: 200px; display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="foto_ktp">Foto KTP Kepala Keluarga</label>
                                    <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" accept="image/*" required>
                                    <small class="text-muted">Format: JPG/PNG, Maks: 2MB</small>
                                    <div class="mt-2">
                                        <img id="preview_foto_ktp" src="#" alt="Preview Foto KTP" style="max-width: 100%; max-height: 200px; display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="foto_kk">Foto Kartu Keluarga</label>
                                    <input type="file" class="form-control" id="foto_kk" name="foto_kk" accept="image/*" required>
                                    <small class="text-muted">Format: JPG/PNG, Maks: 2MB</small>
                                    <div class="mt-2">
                                        <img id="preview_foto_kk" src="#" alt="Preview Foto KK" style="max-width: 100%; max-height: 200px; display: none;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                            <a href="{{ route('forms.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script>
    $(document).ready(function() {
        // Toggle bantuan detail fields based on status_bantuan selection
        function toggleBantuanDetail() {
            if ($("#status_bantuan").val() === "Ya") {
                $(".bantuan-detail").show();
            } else {
                $(".bantuan-detail").hide();
            }
        }

        // Call on page load
        toggleBantuanDetail();

        // Call on change
        $("#status_bantuan").change(function() {
            toggleBantuanDetail();
        });

        // Image preview functions
        function readURL(input, preview) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $(preview).attr('src', e.target.result);
                    $(preview).show();
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#foto_rumah").change(function() {
            readURL(this, "#preview_foto_rumah");
        });

        $("#foto_ktp").change(function() {
            readURL(this, "#preview_foto_ktp");
        });

        $("#foto_kk").change(function() {
            readURL(this, "#preview_foto_kk");
        });
    });
</script>
@endpush
@endsection
