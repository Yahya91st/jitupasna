@extends('layouts.main')

@section('content')
<style>
    /* Container & Layout */
    .form-container {
        max-width: 900px;
        font-family: 'Times New Roman', serif;
        margin: 0 auto;
        padding: 20px;
        background: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Header Styling */
    .form-header {
        text-align: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #ddd;
    }

    .form-header h5 {
        margin: 0.5rem 0;
        font-weight: bold;
        color: #333;
    }

    .form-header h5:first-child {
        color: #F28705;
        margin-bottom: 0.3rem;
    }

    /* Section Headers */
    .section-header {
        background: #f9f9f9;
        color: #333;
        font-weight: 600;
        padding: 10px 15px;
        margin: 20px 0 15px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    /* Table Styling */
    .table {
        border: 1px solid #ddd;
        margin-bottom: 1.5rem;
        font-size: 14px;
        border-radius: 4px;
        overflow: hidden;
    }

    .table td,
    .table th {
        padding: 8px 12px;
        border: 1px solid #ddd;
        vertical-align: middle;
    }

    .table thead th {
        background: #f9f9f9;
        color: #333;
        font-weight: 600;
        text-align: center;
        border-bottom: 2px solid #ddd;
    }

    /* Form Controls */
    .form-control {
        font-family: 'Times New Roman', serif;
        font-size: 14px;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    /* Button Styling */
    .btn {
        margin: 0 5px;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-success {
        background: #28a745;
        color: white;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .alert-info {
        background: #6c757d;    
        border-radius: 4px;
        padding: 1rem;  
        margin-bottom: 1.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-container {
            padding: 10px;
        }

        .table {
            font-size: 12px;
        }

        .btn {
            margin: 2px;
            padding: 6px 12px;
            font-size: 12px;
        }
    }
</style>

<form method="POST" action="{{ route('forms.form6.update', $form->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <input type="hidden" name="bencana_id" value="{{ $form->bencana_id }}">

    <div class="form-container">
        <!-- Document Header -->
        <div class="form-header">
            <h5><strong>Formulir 06 - Edit</strong></h5>
            <h5>Pendataan Tingkat Rumahtangga</h5>
        </div>

        <div class="main-card">
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

                <div class="alert alert-info">
                    <strong>Bencana:</strong> {{ $bencana->nama_bencana ?? 'N/A' }} ({{ $bencana->tanggal ?? 'N/A' }})
                </div>

                <!-- Informasi Lokasi -->
                <div class="section-header">
                    INFORMASI LOKASI
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td style="width: 25%; font-weight: 600; background-color: #f8f9fa;">Provinsi:</td>
                        <td><input type="text" class="form-control" name="provinsi" value="{{ old('provinsi', $form->provinsi) }}" required></td>
                        <td style="width: 25%; font-weight: 600; background-color: #f8f9fa;">Kabupaten/Kota:</td>
                        <td><input type="text" class="form-control" name="kabupaten" value="{{ old('kabupaten', $form->kabupaten) }}" required></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; background-color: #f8f9fa;">Kecamatan:</td>
                        <td><input type="text" class="form-control" name="kecamatan" value="{{ old('kecamatan', $form->kecamatan) }}" required></td>
                        <td style="font-weight: 600; background-color: #f8f9fa;">Desa/Kelurahan:</td>
                        <td><input type="text" class="form-control" name="desa" value="{{ old('desa', $form->desa) }}" required></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; background-color: #f8f9fa;">Dusun/Lingkungan:</td>
                        <td><input type="text" class="form-control" name="dusun" value="{{ old('dusun', $form->dusun) }}" required></td>
                        <td style="font-weight: 600; background-color: #f8f9fa;">RT/RW:</td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <input type="text" class="form-control" name="rt" value="{{ old('rt', $form->rt) }}" placeholder="RT" required style="width: 45%;">
                                <input type="text" class="form-control" name="rw" value="{{ old('rw', $form->rw) }}" placeholder="RW" required style="width: 45%;">
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- Informasi Kepala Keluarga -->
                <div class="section-header">
                    INFORMASI KEPALA KELUARGA
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td style="width: 30%; font-weight: 600; background-color: #f8f9fa;">Nama Kepala Keluarga:</td>
                        <td colspan="3"><input type="text" class="form-control" name="nama_kk" value="{{ old('nama_kk', $form->nama_kk) }}" required></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; background-color: #f8f9fa;">NIK Kepala Keluarga:</td>
                        <td><input type="text" class="form-control" name="nik_kk" value="{{ old('nik_kk', $form->nik_kk) }}" required></td>
                        <td style="width: 25%; font-weight: 600; background-color: #f8f9fa;">Nomor HP/Telepon:</td>
                        <td><input type="text" class="form-control" name="nomor_hp" value="{{ old('nomor_hp', $form->nomor_hp) }}" required></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; background-color: #f8f9fa;">Jumlah Anggota Keluarga:</td>
                        <td colspan="3"><input type="number" class="form-control" name="jumlah_anggota" value="{{ old('jumlah_anggota', $form->jumlah_anggota) }}" min="1" required></td>
                    </tr>
                </table>

                <!-- Informasi Rumah & Kerusakan -->
                <div class="section-header">
                    INFORMASI RUMAH & KERUSAKAN
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td style="width: 30%; font-weight: 600; background-color: #f8f9fa;">Status Rumah:</td>
                        <td>
                            <select class="form-control" name="status_rumah" required>
                                <option value="">-- Pilih Status Rumah --</option>
                                <option value="Milik Sendiri" {{ old('status_rumah', $form->status_rumah) == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                <option value="Sewa/Kontrak" {{ old('status_rumah', $form->status_rumah) == 'Sewa/Kontrak' ? 'selected' : '' }}>Sewa/Kontrak</option>
                                <option value="Menumpang" {{ old('status_rumah', $form->status_rumah) == 'Menumpang' ? 'selected' : '' }}>Menumpang</option>
                                <option value="Lainnya" {{ old('status_rumah', $form->status_rumah) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; background-color: #f8f9fa;">Status Hunian Pasca Bencana:</td>
                        <td>
                            <select class="form-control" name="status_hunian" required>
                                <option value="">-- Pilih Status Hunian --</option>
                                <option value="Masih Dihuni" {{ old('status_hunian', $form->status_hunian) == 'Masih Dihuni' ? 'selected' : '' }}>Masih Dihuni</option>
                                <option value="Mengungsi" {{ old('status_hunian', $form->status_hunian) == 'Mengungsi' ? 'selected' : '' }}>Mengungsi</option>
                                <option value="Menumpang" {{ old('status_hunian', $form->status_hunian) == 'Menumpang' ? 'selected' : '' }}>Menumpang</option>
                                <option value="Lainnya" {{ old('status_hunian', $form->status_hunian) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; background-color: #f8f9fa;">Kategori Kerusakan:</td>
                        <td>
                            <select class="form-control" name="kategori_kerusakan" required>
                                <option value="">-- Pilih Kategori Kerusakan --</option>
                                <option value="Rusak Berat" {{ old('kategori_kerusakan', $form->kategori_kerusakan) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                <option value="Rusak Sedang" {{ old('kategori_kerusakan', $form->kategori_kerusakan) == 'Rusak Sedang' ? 'selected' : '' }}>Rusak Sedang</option>
                                <option value="Rusak Ringan" {{ old('kategori_kerusakan', $form->kategori_kerusakan) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="Tidak Rusak" {{ old('kategori_kerusakan', $form->kategori_kerusakan) == 'Tidak Rusak' ? 'selected' : '' }}>Tidak Rusak</option>
                            </select>
                        </td>
                    </tr>
                </table>

                <!-- Informasi Kebutuhan -->
                <div class="section-header">
                    INFORMASI KEBUTUHAN
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td style="width: 30%; font-weight: 600; background-color: #f8f9fa;">Kebutuhan Material:</td>
                        <td>
                            <textarea class="form-control" name="kebutuhan_material" rows="3">{{ old('kebutuhan_material', $form->kebutuhan_material) }}</textarea>
                            <small class="text-muted">Tuliskan jenis material yang dibutuhkan (semen, pasir, kayu, dll)</small>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; background-color: #f8f9fa;">Kebutuhan SDM:</td>
                        <td>
                            <textarea class="form-control" name="kebutuhan_sdm" rows="3">{{ old('kebutuhan_sdm', $form->kebutuhan_sdm) }}</textarea>
                            <small class="text-muted">Tuliskan kebutuhan tenaga kerja (tukang, kuli, dll)</small>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; background-color: #f8f9fa;">Estimasi Kebutuhan Dana:</td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" name="kebutuhan_dana" value="{{ old('kebutuhan_dana', $form->kebutuhan_dana) }}">
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- Informasi Bantuan -->
                <div class="section-header">
                    INFORMASI BANTUAN
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td style="width: 30%; font-weight: 600; background-color: #f8f9fa;">Sudah Menerima Bantuan?</td>
                        <td>
                            <select class="form-control" id="status_bantuan" name="status_bantuan" required>
                                <option value="Ya" {{ old('status_bantuan', $form->status_bantuan) == 'Ya' ? 'selected' : '' }}>Ya</option>
                                <option value="Tidak" {{ old('status_bantuan', $form->status_bantuan) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="bantuan-detail">
                        <td style="font-weight: 600; background-color: #f8f9fa;">Jenis Bantuan:</td>
                        <td><input type="text" class="form-control" name="jenis_bantuan" value="{{ old('jenis_bantuan', $form->jenis_bantuan) }}"></td>
                    </tr>
                    <tr class="bantuan-detail">
                        <td style="font-weight: 600; background-color: #f8f9fa;">Nominal/Nilai Bantuan:</td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" name="nominal_bantuan" value="{{ old('nominal_bantuan', $form->nominal_bantuan) }}">
                            </div>
                        </td>
                    </tr>
                    <tr class="bantuan-detail">
                        <td style="font-weight: 600; background-color: #f8f9fa;">Pemberi Bantuan:</td>
                        <td><input type="text" class="form-control" name="pemberi_bantuan" value="{{ old('pemberi_bantuan', $form->pemberi_bantuan) }}"></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; background-color: #f8f9fa;">Keterangan Tambahan:</td>
                        <td><textarea class="form-control" name="keterangan_tambahan" rows="4">{{ old('keterangan_tambahan', $form->keterangan_tambahan) }}</textarea></td>
                    </tr>
                </table>

                <!-- Dokumentasi -->
                <div class="section-header">
                    DOKUMENTASI
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td style="width: 30%; font-weight: 600; background-color: #f8f9fa;">Foto Rumah/Bangunan:</td>
                        <td>
                            <input type="file" class="form-control" id="foto_rumah" name="foto_rumah" accept="image/*">
                            <small class="text-muted">Format: JPG/PNG, Maks: 2MB. Kosongkan jika tidak ingin mengubah.</small>
                            @if($form->foto_rumah)
                                <div class="mt-2">
                                    <img id="preview_foto_rumah" src="{{ asset('storage/' . $form->foto_rumah) }}" alt="Foto Rumah" style="max-width: 100%; max-height: 200px;">
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; background-color: #f8f9fa;">Foto KTP Kepala Keluarga:</td>
                        <td>
                            <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" accept="image/*">
                            <small class="text-muted">Format: JPG/PNG, Maks: 2MB. Kosongkan jika tidak ingin mengubah.</small>
                            @if($form->foto_ktp)
                                <div class="mt-2">
                                    <img id="preview_foto_ktp" src="{{ asset('storage/' . $form->foto_ktp) }}" alt="Foto KTP" style="max-width: 100%; max-height: 200px;">
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; background-color: #f8f9fa;">Foto Kartu Keluarga:</td>
                        <td>
                            <input type="file" class="form-control" id="foto_kk" name="foto_kk" accept="image/*">
                            <small class="text-muted">Format: JPG/PNG, Maks: 2MB. Kosongkan jika tidak ingin mengubah.</small>
                            @if($form->foto_kk)
                                <div class="mt-2">
                                    <img id="preview_foto_kk" src="{{ asset('storage/' . $form->foto_kk) }}" alt="Foto KK" style="max-width: 100%; max-height: 200px;">
                                </div>
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="action-buttons">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Update Data
                    </button>
                    <a href="{{ route('forms.form6.show', $form->id) }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</form>
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
            readURL(this, "#preview_foto_kk");
        });
    });
</script>
@endpush
