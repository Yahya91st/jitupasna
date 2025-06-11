@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <h3>Edit Data Pendataan Tingkat Rumahtangga</h3>
        <p class="text-subtitle text-muted">Ubah data pendataan kerusakan dan kebutuhan tingkat rumahtangga</p>
    </div>
    
    <div class="card">
        <div class="card-content">
            <div class="card-body">
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

                    <form action="{{ route('forms.form6.update', $rumahtangga->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bencana_id">Pilih Bencana</label>
                                    <select name="bencana_id" id="bencana_id" class="form-control" required>
                                        <option value="">-- Pilih Bencana --</option>
                                        @foreach($bencanas as $bencana)
                                            <option value="{{ $bencana->id }}" {{ $rumahtangga->bencana_id == $bencana->id ? 'selected' : '' }}>
                                                {{ $bencana->nama_bencana }} ({{ $bencana->tanggal }})
                                            </option>
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
                                    <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ old('provinsi', $rumahtangga->provinsi) }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kabupaten">Kabupaten/Kota</label>
                                    <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="{{ old('kabupaten', $rumahtangga->kabupaten) }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $rumahtangga->kecamatan) }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="desa">Desa/Kelurahan</label>
                                    <input type="text" class="form-control" id="desa" name="desa" value="{{ old('desa', $rumahtangga->desa) }}" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dusun">Dusun/Lingkungan</label>
                                    <input type="text" class="form-control" id="dusun" name="dusun" value="{{ old('dusun', $rumahtangga->dusun) }}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="rt">RT</label>
                                    <input type="text" class="form-control" id="rt" name="rt" value="{{ old('rt', $rumahtangga->rt) }}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="rw">RW</label>
                                    <input type="text" class="form-control" id="rw" name="rw" value="{{ old('rw', $rumahtangga->rw) }}" required>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3">Informasi Kepala Keluarga</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_kk">Nama Kepala Keluarga</label>
                                    <input type="text" class="form-control" id="nama_kk" name="nama_kk" value="{{ old('nama_kk', $rumahtangga->nama_kk) }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nik_kk">NIK Kepala Keluarga</label>
                                    <input type="text" class="form-control" id="nik_kk" name="nik_kk" value="{{ old('nik_kk', $rumahtangga->nik_kk) }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nomor_hp">Nomor HP/Telepon</label>
                                    <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp', $rumahtangga->nomor_hp) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jumlah_anggota">Jumlah Anggota Keluarga</label>
                                    <input type="number" class="form-control" id="jumlah_anggota" name="jumlah_anggota" value="{{ old('jumlah_anggota', $rumahtangga->jumlah_anggota) }}" min="1" required>
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
                                        <option value="Milik Sendiri" {{ old('status_rumah', $rumahtangga->status_rumah) == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                        <option value="Sewa/Kontrak" {{ old('status_rumah', $rumahtangga->status_rumah) == 'Sewa/Kontrak' ? 'selected' : '' }}>Sewa/Kontrak</option>
                                        <option value="Menumpang" {{ old('status_rumah', $rumahtangga->status_rumah) == 'Menumpang' ? 'selected' : '' }}>Menumpang</option>
                                        <option value="Lainnya" {{ old('status_rumah', $rumahtangga->status_rumah) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status_hunian">Status Hunian Pasca Bencana</label>
                                    <select class="form-control" id="status_hunian" name="status_hunian" required>
                                        <option value="">-- Pilih Status Hunian --</option>
                                        <option value="Masih Dihuni" {{ old('status_hunian', $rumahtangga->status_hunian) == 'Masih Dihuni' ? 'selected' : '' }}>Masih Dihuni</option>
                                        <option value="Mengungsi" {{ old('status_hunian', $rumahtangga->status_hunian) == 'Mengungsi' ? 'selected' : '' }}>Mengungsi</option>
                                        <option value="Menumpang" {{ old('status_hunian', $rumahtangga->status_hunian) == 'Menumpang' ? 'selected' : '' }}>Menumpang</option>
                                        <option value="Lainnya" {{ old('status_hunian', $rumahtangga->status_hunian) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kategori_kerusakan">Kategori Kerusakan</label>
                                    <select class="form-control" id="kategori_kerusakan" name="kategori_kerusakan" required>
                                        <option value="">-- Pilih Kategori Kerusakan --</option>
                                        <option value="Rusak Berat" {{ old('kategori_kerusakan', $rumahtangga->kategori_kerusakan) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                        <option value="Rusak Sedang" {{ old('kategori_kerusakan', $rumahtangga->kategori_kerusakan) == 'Rusak Sedang' ? 'selected' : '' }}>Rusak Sedang</option>
                                        <option value="Rusak Ringan" {{ old('kategori_kerusakan', $rumahtangga->kategori_kerusakan) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                        <option value="Tidak Rusak" {{ old('kategori_kerusakan', $rumahtangga->kategori_kerusakan) == 'Tidak Rusak' ? 'selected' : '' }}>Tidak Rusak</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3">Informasi Kebutuhan</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kebutuhan_material">Kebutuhan Material</label>
                                    <textarea class="form-control" id="kebutuhan_material" name="kebutuhan_material" rows="3">{{ old('kebutuhan_material', $rumahtangga->kebutuhan_material) }}</textarea>
                                    <small class="text-muted">Tuliskan jenis material yang dibutuhkan (semen, pasir, kayu, dll)</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kebutuhan_sdm">Kebutuhan SDM</label>
                                    <textarea class="form-control" id="kebutuhan_sdm" name="kebutuhan_sdm" rows="3">{{ old('kebutuhan_sdm', $rumahtangga->kebutuhan_sdm) }}</textarea>
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
                                        <input type="number" class="form-control" id="kebutuhan_dana" name="kebutuhan_dana" value="{{ old('kebutuhan_dana', $rumahtangga->kebutuhan_dana) }}">
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
                                        <option value="Ya" {{ old('status_bantuan', $rumahtangga->status_bantuan) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                        <option value="Tidak" {{ old('status_bantuan', $rumahtangga->status_bantuan) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 bantuan-detail">
                                <div class="form-group">
                                    <label for="jenis_bantuan">Jenis Bantuan</label>
                                    <input type="text" class="form-control" id="jenis_bantuan" name="jenis_bantuan" value="{{ old('jenis_bantuan', $rumahtangga->jenis_bantuan) }}">
                                </div>
                            </div>
                            <div class="col-md-3 bantuan-detail">
                                <div class="form-group">
                                    <label for="nominal_bantuan">Nominal/Nilai Bantuan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" id="nominal_bantuan" name="nominal_bantuan" value="{{ old('nominal_bantuan', $rumahtangga->nominal_bantuan) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bantuan-detail">
                                <div class="form-group">
                                    <label for="pemberi_bantuan">Pemberi Bantuan</label>
                                    <input type="text" class="form-control" id="pemberi_bantuan" name="pemberi_bantuan" value="{{ old('pemberi_bantuan', $rumahtangga->pemberi_bantuan) }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="keterangan_tambahan">Keterangan Tambahan</label>
                            <textarea class="form-control" id="keterangan_tambahan" name="keterangan_tambahan" rows="4">{{ old('keterangan_tambahan', $rumahtangga->keterangan_tambahan) }}</textarea>
                        </div>

                        <h5 class="mt-4 mb-3">Dokumentasi</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="foto_rumah">Foto Rumah/Bangunan</label>
                                    <input type="file" class="form-control" id="foto_rumah" name="foto_rumah" accept="image/*">
                                    <small class="text-muted">Format: JPG/PNG, Maks: 2MB. Kosongkan jika tidak ingin mengubah.</small>
                                    <div class="mt-2">
                                        <img id="preview_foto_rumah" src="{{ asset('storage/' . $rumahtangga->foto_rumah) }}" alt="Foto Rumah" style="max-width: 100%; max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="foto_ktp">Foto KTP Kepala Keluarga</label>
                                    <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" accept="image/*">
                                    <small class="text-muted">Format: JPG/PNG, Maks: 2MB. Kosongkan jika tidak ingin mengubah.</small>
                                    <div class="mt-2">
                                        <img id="preview_foto_ktp" src="{{ asset('storage/' . $rumahtangga->foto_ktp) }}" alt="Foto KTP" style="max-width: 100%; max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="foto_kk">Foto Kartu Keluarga</label>
                                    <input type="file" class="form-control" id="foto_kk" name="foto_kk" accept="image/*">
                                    <small class="text-muted">Format: JPG/PNG, Maks: 2MB. Kosongkan jika tidak ingin mengubah.</small>
                                    <div class="mt-2">
                                        <img id="preview_foto_kk" src="{{ asset('storage/' . $rumahtangga->foto_kk) }}" alt="Foto KK" style="max-width: 100%; max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Update Data</button>
                            <a href="{{ route('forms.form6.show', $rumahtangga->id) }}" class="btn btn-secondary">Batalkan</a>
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
            readURL(this, "#preview_foto_kk");        });
    });
</script>
@endpush
