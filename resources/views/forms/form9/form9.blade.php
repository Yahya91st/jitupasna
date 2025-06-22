@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <h3>Formulir 09 - Pengolahan Data dan Kuesioner</h3>
        <p class="text-subtitle text-muted">Pengisian formulir kuesioner untuk pendataan dampak bencana terhadap masyarakat</p>
    </div>

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

    <div class="card">        <div class="card-header">
            <h4 class="card-title">Data Kuesioner</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('forms.form9.store') }}" method="POST">
                @csrf
                <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->get('bencana_id') }}">
                
                <!-- Data Bencana -->
                @if(isset($bencana))
                <div class="col-md-12 mb-4">
                    <div class="alert alert-light-primary color-primary">
                        <p><strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama }}</p>
                        <p><strong>Tanggal:</strong> {{ $bencana->tanggal }}</p>
                        <p><strong>Lokasi:</strong> 
                            @foreach($bencana->desa as $desa)
                                {{ $desa->nama }}@if(!$loop->last), @endif
                            @endforeach
                        </p>
                    </div>
                </div>
                @endif

                <!-- 1. Informasi Umum -->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-3 mb-4">1. Informasi Umum</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_kuesioner">Nomor Kuesioner</label>
                            <input type="text" class="form-control @error('nomor_kuesioner') is-invalid @enderror" 
                                   id="nomor_kuesioner" name="nomor_kuesioner" value="{{ old('nomor_kuesioner') }}" required>
                            @error('nomor_kuesioner')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin Responden</label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                   id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="umur">Umur</label>
                            <select class="form-select @error('umur') is-invalid @enderror" 
                                   id="umur" name="umur" required>
                                <option value="">Pilih</option>
                                <option value="20" {{ old('umur') == '20' ? 'selected' : '' }}>≤ 20 tahun</option>
                                <option value="30" {{ old('umur') == '30' ? 'selected' : '' }}>21-30 tahun</option>
                                <option value="40" {{ old('umur') == '40' ? 'selected' : '' }}>31-40 tahun</option>
                                <option value="50" {{ old('umur') == '50' ? 'selected' : '' }}>41-50 tahun</option>
                                <option value="51" {{ old('umur') == '51' ? 'selected' : '' }}>>50 tahun</option>
                            </select>
                            @error('umur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="desa_kelurahan">Desa/Kelurahan</label>
                            <input type="text" class="form-control @error('desa_kelurahan') is-invalid @enderror" 
                                   id="desa_kelurahan" name="desa_kelurahan" value="{{ old('desa_kelurahan') }}" required>
                            @error('desa_kelurahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" 
                                   id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}" required>
                            @error('kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten</label>
                            <input type="text" class="form-control @error('kabupaten') is-invalid @enderror" 
                                   id="kabupaten" name="kabupaten" value="{{ old('kabupaten') }}" required>
                            @error('kabupaten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                            <select class="form-select @error('pendidikan_terakhir') is-invalid @enderror" 
                                   id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                                <option value="">Pilih</option>
                                <option value="SD" {{ old('pendidikan_terakhir') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SLTP" {{ old('pendidikan_terakhir') == 'SLTP' ? 'selected' : '' }}>SLTP</option>
                                <option value="SLTA" {{ old('pendidikan_terakhir') == 'SLTA' ? 'selected' : '' }}>SLTA</option>
                                <option value="PT" {{ old('pendidikan_terakhir') == 'PT' ? 'selected' : '' }}>PT</option>
                            </select>
                            @error('pendidikan_terakhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kepala_rumah_tangga_perempuan">Apakah Kepala Rumah Tangga Perempuan?</label>
                            <select class="form-select @error('kepala_rumah_tangga_perempuan') is-invalid @enderror"
                                   id="kepala_rumah_tangga_perempuan" name="kepala_rumah_tangga_perempuan" required>
                                <option value="">Pilih</option>
                                <option value="1" {{ old('kepala_rumah_tangga_perempuan') == '1' ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ old('kepala_rumah_tangga_perempuan') == '0' ? 'selected' : '' }}>Tidak</option>
                            </select>
                            @error('kepala_rumah_tangga_perempuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_anggota_keluarga">Jumlah Anggota Keluarga</label>
                            <select class="form-select @error('jumlah_anggota_keluarga') is-invalid @enderror"
                                   id="jumlah_anggota_keluarga" name="jumlah_anggota_keluarga" required>
                                <option value="">Pilih</option>
                                <option value="3" {{ old('jumlah_anggota_keluarga') == '3' ? 'selected' : '' }}>≤3</option>
                                <option value="4" {{ old('jumlah_anggota_keluarga') == '4' ? 'selected' : '' }}>3-5</option>
                                <option value="6" {{ old('jumlah_anggota_keluarga') == '6' ? 'selected' : '' }}>>5</option>
                            </select>
                            @error('jumlah_anggota_keluarga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_anak">Jumlah Anak (&lt;18 tahun)</label>
                            <select class="form-select @error('jumlah_anak') is-invalid @enderror"
                                   id="jumlah_anak" name="jumlah_anak" required>
                                <option value="">Pilih</option>
                                <option value="1" {{ old('jumlah_anak') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('jumlah_anak') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('jumlah_anak') == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('jumlah_anak') == '4' ? 'selected' : '' }}>>3</option>
                            </select>
                            @error('jumlah_anak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_balita">Jumlah Anak Balita</label>
                            <select class="form-select @error('jumlah_balita') is-invalid @enderror"
                                   id="jumlah_balita" name="jumlah_balita" required>
                                <option value="">Pilih</option>
                                <option value="1" {{ old('jumlah_balita') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('jumlah_balita') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('jumlah_balita') == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('jumlah_balita') == '4' ? 'selected' : '' }}>>3</option>
                            </select>
                            @error('jumlah_balita')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tipe_hunian">Tipe Hunian Sekarang</label>
                            <select class="form-select @error('tipe_hunian') is-invalid @enderror"
                                   id="tipe_hunian" name="tipe_hunian" required>
                                <option value="">Pilih</option>
                                <option value="Rumah tinggal sendiri" {{ old('tipe_hunian') == 'Rumah tinggal sendiri' ? 'selected' : '' }}>Rumah tinggal sendiri</option>
                                <option value="Rumah tumpangan" {{ old('tipe_hunian') == 'Rumah tumpangan' ? 'selected' : '' }}>Rumah tumpangan</option>
                                <option value="Pengungsian" {{ old('tipe_hunian') == 'Pengungsian' ? 'selected' : '' }}>Pengungsian</option>
                                <option value="Fasilitas umum" {{ old('tipe_hunian') == 'Fasilitas umum' ? 'selected' : '' }}>Fasilitas umum</option>
                                <option value="Lain-lain" {{ old('tipe_hunian') == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                            </select>
                            @error('tipe_hunian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">2. Informasi Ekonomi dan Sosial</h5>
            </div>
            <div class="card-body">                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pencari_nafkah">Pencari Nafkah Sebelum dan Sesudah Bencana</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pencari_nafkah[]" value="Suami" id="pencari_nafkah_suami" 
                                    {{ (is_array(old('pencari_nafkah')) && in_array('Suami', old('pencari_nafkah'))) ? 'checked' : '' }}>
                                <label class="form-check-label" for="pencari_nafkah_suami">Suami</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pencari_nafkah[]" value="Istri" id="pencari_nafkah_istri" 
                                    {{ (is_array(old('pencari_nafkah')) && in_array('Istri', old('pencari_nafkah'))) ? 'checked' : '' }}>
                                <label class="form-check-label" for="pencari_nafkah_istri">Istri</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pencari_nafkah[]" value="Anak" id="pencari_nafkah_anak" 
                                    {{ (is_array(old('pencari_nafkah')) && in_array('Anak', old('pencari_nafkah'))) ? 'checked' : '' }}>
                                <label class="form-check-label" for="pencari_nafkah_anak">Anak (&lt;18 tahun)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="pencari_nafkah[]" value="Lainnya" id="pencari_nafkah_lainnya" 
                                    {{ (is_array(old('pencari_nafkah')) && in_array('Lainnya', old('pencari_nafkah'))) ? 'checked' : '' }}>
                                <label class="form-check-label" for="pencari_nafkah_lainnya">Lainnya</label>
                            </div>
                            @error('pencari_nafkah')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Sumber Penghasilan Keluarga Sebelum Bencana</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="sumber_penghasilan[]" value="Pertanian" id="sumber_pertanian" 
                                            {{ (is_array(old('sumber_penghasilan')) && in_array('Pertanian', old('sumber_penghasilan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sumber_pertanian">Pertanian</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="sumber_penghasilan[]" value="Peternakan" id="sumber_peternakan" 
                                            {{ (is_array(old('sumber_penghasilan')) && in_array('Peternakan', old('sumber_penghasilan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sumber_peternakan">Peternakan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="sumber_penghasilan[]" value="Perdagangan" id="sumber_perdagangan" 
                                            {{ (is_array(old('sumber_penghasilan')) && in_array('Perdagangan', old('sumber_penghasilan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sumber_perdagangan">Perdagangan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="sumber_penghasilan[]" value="Industri" id="sumber_industri" 
                                            {{ (is_array(old('sumber_penghasilan')) && in_array('Industri', old('sumber_penghasilan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sumber_industri">Industri</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="sumber_penghasilan[]" value="Jasa" id="sumber_jasa" 
                                            {{ (is_array(old('sumber_penghasilan')) && in_array('Jasa', old('sumber_penghasilan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sumber_jasa">Jasa</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="sumber_penghasilan[]" value="Pegawai" id="sumber_pegawai" 
                                            {{ (is_array(old('sumber_penghasilan')) && in_array('Pegawai', old('sumber_penghasilan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sumber_pegawai">Pegawai</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="sumber_penghasilan[]" value="Pertukangan" id="sumber_pertukangan" 
                                            {{ (is_array(old('sumber_penghasilan')) && in_array('Pertukangan', old('sumber_penghasilan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sumber_pertukangan">Pertukangan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="sumber_penghasilan[]" value="Nelayan" id="sumber_nelayan" 
                                            {{ (is_array(old('sumber_penghasilan')) && in_array('Nelayan', old('sumber_penghasilan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sumber_nelayan">Nelayan</label>
                                    </div>
                                </div>
                            </div>
                            @error('sumber_penghasilan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="penghasilan_hilang">Sumber Penghasilan yang Hilang/Menurun Setelah Bencana</label>
                            <select class="form-select @error('penghasilan_hilang') is-invalid @enderror"
                                  id="penghasilan_hilang" name="penghasilan_hilang" required>
                                <option value="">Pilih</option>
                                <option value="Ada" {{ old('penghasilan_hilang') == 'Ada' ? 'selected' : '' }}>Ada</option>
                                <option value="Tidak" {{ old('penghasilan_hilang') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                            @error('penghasilan_hilang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Bantuan yang Dibutuhkan untuk Pemulihan Mata Pencaharian</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="bantuan_pemulihan[]" value="Keterampilan" id="bantuan_keterampilan" 
                                            {{ (is_array(old('bantuan_pemulihan')) && in_array('Keterampilan', old('bantuan_pemulihan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bantuan_keterampilan">Keterampilan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="bantuan_pemulihan[]" value="Peralatan" id="bantuan_peralatan" 
                                            {{ (is_array(old('bantuan_pemulihan')) && in_array('Peralatan', old('bantuan_pemulihan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bantuan_peralatan">Peralatan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="bantuan_pemulihan[]" value="Modal" id="bantuan_modal" 
                                            {{ (is_array(old('bantuan_pemulihan')) && in_array('Modal', old('bantuan_pemulihan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bantuan_modal">Modal</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="bantuan_pemulihan[]" value="Akses Pasar" id="bantuan_akses" 
                                            {{ (is_array(old('bantuan_pemulihan')) && in_array('Akses Pasar', old('bantuan_pemulihan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bantuan_akses">Akses Pasar</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="bantuan_pemulihan[]" value="Lain-lain" id="bantuan_lain" 
                                            {{ (is_array(old('bantuan_pemulihan')) && in_array('Lain-lain', old('bantuan_pemulihan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bantuan_lain">Lain-lain</label>
                                    </div>
                                </div>
                            </div>
                            @error('bantuan_pemulihan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Sumber Cadangan Keluarga yang Terganggu Setelah Bencana</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="cadangan_terganggu[]" value="Tabungan" id="cadangan_tabungan" 
                                            {{ (is_array(old('cadangan_terganggu')) && in_array('Tabungan', old('cadangan_terganggu'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cadangan_tabungan">Tabungan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="cadangan_terganggu[]" value="Pinjaman" id="cadangan_pinjaman" 
                                            {{ (is_array(old('cadangan_terganggu')) && in_array('Pinjaman', old('cadangan_terganggu'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cadangan_pinjaman">Pinjaman</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="cadangan_terganggu[]" value="Barang/Perhiasan" id="cadangan_barang" 
                                            {{ (is_array(old('cadangan_terganggu')) && in_array('Barang/Perhiasan', old('cadangan_terganggu'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cadangan_barang">Barang/Perhiasan</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="cadangan_terganggu[]" value="Ternak/bibit/hasil pertanian" id="cadangan_ternak" 
                                            {{ (is_array(old('cadangan_terganggu')) && in_array('Ternak/bibit/hasil pertanian', old('cadangan_terganggu'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cadangan_ternak">Ternak/bibit/hasil pertanian</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="cadangan_terganggu[]" value="Jaminan Sosial Pemerintah" id="cadangan_jaminan" 
                                            {{ (is_array(old('cadangan_terganggu')) && in_array('Jaminan Sosial Pemerintah', old('cadangan_terganggu'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cadangan_jaminan">Jaminan Sosial Pemerintah</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="cadangan_terganggu[]" value="Lainnya" id="cadangan_lainnya" 
                                            {{ (is_array(old('cadangan_terganggu')) && in_array('Lainnya', old('cadangan_terganggu'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cadangan_lainnya">Lainnya</label>
                                    </div>
                                </div>
                            </div>
                            @error('cadangan_terganggu')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Dukungan untuk Pemulihan Sumber Cadangan</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_cadangan[]" value="Koperasi" id="dukungan_koperasi" 
                                            {{ (is_array(old('dukungan_cadangan')) && in_array('Koperasi', old('dukungan_cadangan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dukungan_koperasi">Koperasi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_cadangan[]" value="Kelompok Usaha Bersama" id="dukungan_kub" 
                                            {{ (is_array(old('dukungan_cadangan')) && in_array('Kelompok Usaha Bersama', old('dukungan_cadangan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dukungan_kub">Kelompok Usaha Bersama</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_cadangan[]" value="Pinjaman" id="dukungan_pinjaman" 
                                            {{ (is_array(old('dukungan_cadangan')) && in_array('Pinjaman', old('dukungan_cadangan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dukungan_pinjaman">Pinjaman</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_cadangan[]" value="Bantuan Pemerintah" id="dukungan_pemerintah" 
                                            {{ (is_array(old('dukungan_cadangan')) && in_array('Bantuan Pemerintah', old('dukungan_cadangan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dukungan_pemerintah">Bantuan Pemerintah</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_cadangan[]" value="Lain-lain" id="dukungan_lainnya" 
                                            {{ (is_array(old('dukungan_cadangan')) && in_array('Lain-lain', old('dukungan_cadangan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dukungan_lainnya">Lain-lain</label>
                                    </div>
                                </div>
                            </div>
                            @error('dukungan_cadangan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title">3. Perlindungan dan Kesejahteraan</h5>
            </div>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="perlindungan_perempuan_anak">Perlindungan terhadap Perempuan dan Anak</label>
                            <select class="form-select @error('perlindungan_perempuan_anak') is-invalid @enderror"
                                  id="perlindungan_perempuan_anak" name="perlindungan_perempuan_anak" required>
                                <option value="">Pilih</option>
                                <option value="Meningkat" {{ old('perlindungan_perempuan_anak') == 'Meningkat' ? 'selected' : '' }}>Meningkat</option>
                                <option value="Menurun" {{ old('perlindungan_perempuan_anak') == 'Menurun' ? 'selected' : '' }}>Menurun</option>
                                <option value="Sama saja" {{ old('perlindungan_perempuan_anak') == 'Sama saja' ? 'selected' : '' }}>Sama saja</option>
                            </select>
                            @error('perlindungan_perempuan_anak')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Bantuan yang Dibutuhkan untuk Perlindungan</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="bantuan_perlindungan[]" value="Penyuluhan" id="perlindungan_penyuluhan" 
                                            {{ (is_array(old('bantuan_perlindungan')) && in_array('Penyuluhan', old('bantuan_perlindungan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perlindungan_penyuluhan">Penyuluhan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="bantuan_perlindungan[]" value="Penguatan moral" id="perlindungan_moral" 
                                            {{ (is_array(old('bantuan_perlindungan')) && in_array('Penguatan moral', old('bantuan_perlindungan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perlindungan_moral">Penguatan moral</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="bantuan_perlindungan[]" value="Polisi keliling" id="perlindungan_polisi" 
                                            {{ (is_array(old('bantuan_perlindungan')) && in_array('Polisi keliling', old('bantuan_perlindungan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perlindungan_polisi">Polisi keliling</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="bantuan_perlindungan[]" value="Pos Pengaduan" id="perlindungan_pos" 
                                            {{ (is_array(old('bantuan_perlindungan')) && in_array('Pos Pengaduan', old('bantuan_perlindungan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perlindungan_pos">Pos Pengaduan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="bantuan_perlindungan[]" value="Rumah perlindungan bagi korban kekerasan" id="perlindungan_rumah" 
                                            {{ (is_array(old('bantuan_perlindungan')) && in_array('Rumah perlindungan bagi korban kekerasan', old('bantuan_perlindungan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perlindungan_rumah">Rumah perlindungan bagi korban kekerasan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="bantuan_perlindungan[]" value="Lain-lain" id="perlindungan_lainnya" 
                                            {{ (is_array(old('bantuan_perlindungan')) && in_array('Lain-lain', old('bantuan_perlindungan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perlindungan_lainnya">Lain-lain</label>
                                    </div>
                                </div>
                            </div>
                            @error('bantuan_perlindungan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="masalah_perumahan">Masalah Perumahan Setelah Bencana</label>
                            <select class="form-select @error('masalah_perumahan') is-invalid @enderror"
                                  id="masalah_perumahan" name="masalah_perumahan" required>
                                <option value="">Pilih</option>
                                <option value="Harus relokasi" {{ old('masalah_perumahan') == 'Harus relokasi' ? 'selected' : '' }}>Harus relokasi</option>
                                <option value="Rumah & lingkungan rusak" {{ old('masalah_perumahan') == 'Rumah & lingkungan rusak' ? 'selected' : '' }}>Rumah & lingkungan rusak</option>
                                <option value="Masih belum punya rumah" {{ old('masalah_perumahan') == 'Masih belum punya rumah' ? 'selected' : '' }}>Masih belum punya rumah</option>
                                <option value="Lainnya" {{ old('masalah_perumahan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('masalah_perumahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Dukungan untuk Pemulihan Perumahan</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_perumahan[]" value="Stimulus pembangunan rumah" id="perumahan_stimulus" 
                                            {{ (is_array(old('dukungan_perumahan')) && in_array('Stimulus pembangunan rumah', old('dukungan_perumahan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perumahan_stimulus">Stimulus pembangunan rumah</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_perumahan[]" value="Kredit perumahan" id="perumahan_kredit" 
                                            {{ (is_array(old('dukungan_perumahan')) && in_array('Kredit perumahan', old('dukungan_perumahan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perumahan_kredit">Kredit perumahan</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_perumahan[]" value="Bantuan teknis" id="perumahan_teknis" 
                                            {{ (is_array(old('dukungan_perumahan')) && in_array('Bantuan teknis', old('dukungan_perumahan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perumahan_teknis">Bantuan teknis</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_perumahan[]" value="Lainnya" id="perumahan_lainnya" 
                                            {{ (is_array(old('dukungan_perumahan')) && in_array('Lainnya', old('dukungan_perumahan'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perumahan_lainnya">Lainnya</label>
                                    </div>
                                </div>
                            </div>
                            @error('dukungan_perumahan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="masalah_pangan_air">Masalah Pangan dan Air Bersih</label>
                            <select class="form-select @error('masalah_pangan_air') is-invalid @enderror"
                                  id="masalah_pangan_air" name="masalah_pangan_air" required>
                                <option value="">Pilih</option>
                                <option value="Bantuan pangan" {{ old('masalah_pangan_air') == 'Bantuan pangan' ? 'selected' : '' }}>Bantuan pangan</option>
                                <option value="Cadangan keluarga" {{ old('masalah_pangan_air') == 'Cadangan keluarga' ? 'selected' : '' }}>Cadangan keluarga</option>
                                <option value="Sisa tanaman yang terselamatkan" {{ old('masalah_pangan_air') == 'Sisa tanaman yang terselamatkan' ? 'selected' : '' }}>Sisa tanaman yang terselamatkan</option>
                                <option value="Lainnya" {{ old('masalah_pangan_air') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('masalah_pangan_air')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Dukungan untuk Pemulihan Pangan dan Air Bersih</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_pangan_air[]" value="Bantuan pangan langsung" id="pangan_bantuan" 
                                            {{ (is_array(old('dukungan_pangan_air')) && in_array('Bantuan pangan langsung', old('dukungan_pangan_air'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pangan_bantuan">Bantuan pangan langsung</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_pangan_air[]" value="Pemulihan sumber pangan" id="pangan_pemulihan" 
                                            {{ (is_array(old('dukungan_pangan_air')) && in_array('Pemulihan sumber pangan', old('dukungan_pangan_air'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pangan_pemulihan">Pemulihan sumber pangan</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_pangan_air[]" value="Pemulihan sumber daya kemasyarakatan" id="pangan_sumber_daya" 
                                            {{ (is_array(old('dukungan_pangan_air')) && in_array('Pemulihan sumber daya kemasyarakatan', old('dukungan_pangan_air'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pangan_sumber_daya">Pemulihan sumber daya kemasyarakatan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dukungan_pangan_air[]" value="Lainnya" id="pangan_lainnya" 
                                            {{ (is_array(old('dukungan_pangan_air')) && in_array('Lainnya', old('dukungan_pangan_air'))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pangan_lainnya">Lainnya</label>
                                    </div>
                                </div>
                            </div>
                            @error('dukungan_pangan_air')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="row mt-4">            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Simpan Kuesioner</button>
                    <a href="{{ route('forms.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
