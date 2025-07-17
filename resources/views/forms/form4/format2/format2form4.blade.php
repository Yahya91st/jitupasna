@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 2: Pengumpulan Data Sektor PENDIDIKAN</p>
    <form action="{{ isset($edit) && $edit ? route('forms.form4.format2.update', $data['id'] ?? '') : route('forms.form4.format2.store') }}" method="POST">
        @csrf
        @if(isset($edit) && $edit)
            @method('PATCH')
        @endif
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">NAMA KAMPUNG</span>
                    <input type="text" class="form-control form-control-sm" name="nama_kampung" value="{{ old('nama_kampung', $data['nama_kampung'] ?? '') }}" required>
                </div>
                @error('nama_kampung')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">NAMA DISTRIK</span>
                    <input type="text" class="form-control form-control-sm" name="nama_distrik" value="{{ old('nama_distrik', $data['nama_distrik'] ?? '') }}" required>
                </div>
                @error('nama_distrik')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle small">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 10%;">Bangunan</th>
                        <th colspan="2">Rusak Berat</th>
                        <th colspan="2">Rusak Sedang</th>
                        <th colspan="2">Rusak Ringan</th>
                        <th rowspan="2" style="width: 8%;">Ukuran Ruang</th>
                        <th colspan="3">Harga Satuan (Rp)</th>
                    </tr>
                    <tr>
                        <th>Negeri</th>
                        <th>Swasta</th>
                        <th>Negeri</th>
                        <th>Swasta</th>
                        <th>Negeri</th>
                        <th>Swasta</th>
                        <th>Bangunan</th>
                        <th>Peralatan</th>
                        <th>Meubelair</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $bangunan = [
                        'tk' => 'TK/RA',
                        'sd' => 'SD/MI',
                        'smp' => 'SMP/MTS',
                        'sma' => 'SMA/MA',
                        'smk' => 'SMK',
                        'pt' => 'Perguruan Tinggi',
                        'perpus' => 'Perpustakaan',
                        'lab' => 'Laboratorium',
                        'lainnya' => 'Lainnya',
                    ];
                    @endphp
                    @foreach($bangunan as $prefix => $label)
                    <tr>
                        <td>{{ $label }}</td>
                        @foreach(['berat_negeri','berat_swasta','sedang_negeri','sedang_swasta','ringan_negeri','ringan_swasta'] as $f)
                        <td><input type="number" class="form-control form-control-sm" name="{{ $prefix . '_' . $f }}" value="{{ old($prefix . '_' . $f, $data[$prefix . '_' . $f] ?? '') }}" style="min-width: 80px;"></td>
                        @endforeach
                        <td><input type="number" class="form-control form-control-sm" name="{{ $prefix . '_ukuran' }}" value="{{ old($prefix . '_ukuran', $data[$prefix . '_ukuran'] ?? '') }}" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="{{ $prefix . '_harga_bangunan' }}" value="{{ old($prefix . '_harga_bangunan', $data[$prefix . '_harga_bangunan'] ?? '') }}" style="min-width: 100px;"></td>
                        <td><input type="text" class="form-control form-control-sm" name="{{ $prefix . '_harga_peralatan' }}" value="{{ old($prefix . '_harga_peralatan', $data[$prefix . '_harga_peralatan'] ?? '') }}" style="min-width: 100px;"></td>
                        <td><input type="text" class="form-control form-control-sm" name="{{ $prefix . '_harga_meubelair' }}" value="{{ old($prefix . '_harga_meubelair', $data[$prefix . '_harga_meubelair'] ?? '') }}" style="min-width: 100px;"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h6 class="fw-bold mt-3 mb-2">Perkiraan Kerugian</h6>
        <div class="row g-2">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header py-1 small fw-bold">Biaya Pembersihan Puing</div>
                    <div class="card-body py-2">
                        <div class="input-group input-group-sm mb-2">
                            <span class="input-group-text">Tenaga Kerja</span>
                            <input type="number" class="form-control form-control-sm" name="biaya_tenaga_kerja_hok" value="{{ old('biaya_tenaga_kerja_hok', $data['biaya_tenaga_kerja_hok'] ?? '') }}" placeholder="HOK" style="min-width: 100px;">
                            <span class="input-group-text">x Rp</span>
                            <input type="number" class="form-control form-control-sm" name="biaya_tenaga_kerja_upah" value="{{ old('biaya_tenaga_kerja_upah', $data['biaya_tenaga_kerja_upah'] ?? '') }}" placeholder="Upah" style="min-width: 120px;">
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">Alat Berat</span>
                            <input type="number" class="form-control form-control-sm" name="biaya_alat_berat_hari" value="{{ old('biaya_alat_berat_hari', $data['biaya_alat_berat_hari'] ?? '') }}" placeholder="Hari" style="min-width: 100px;">
                            <span class="input-group-text">x Rp</span>
                            <input type="number" class="form-control form-control-sm" name="biaya_alat_berat_harga" value="{{ old('biaya_alat_berat_harga', $data['biaya_alat_berat_harga'] ?? '') }}" placeholder="Sewa/Hari" style="min-width: 120px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header py-1 small fw-bold">Informasi Sekolah</div>
                    <div class="card-body py-2">
                        <div class="input-group input-group-sm mb-2">
                            <span class="input-group-text">Sekolah utk Pengungsian</span>
                            <input type="number" class="form-control form-control-sm" name="sekolah_pengungsian" value="{{ old('sekolah_pengungsian', $data['sekolah_pengungsian'] ?? '') }}" placeholder="Unit" style="min-width: 120px;">
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <span class="input-group-text">Guru Korban Bencana</span>
                            <input type="number" class="form-control form-control-sm" name="guru_korban" value="{{ old('guru_korban', $data['guru_korban'] ?? '') }}" placeholder="Orang" style="min-width: 120px;">
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">Iuran Sekolah Swasta</span>
                            <input type="number" class="form-control form-control-sm" name="iuran_sekolah" value="{{ old('iuran_sekolah', $data['iuran_sekolah'] ?? '') }}" placeholder="Rp/Bulan" style="min-width: 120px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header py-1 small fw-bold">Sekolah Sementara</div>
                    <div class="card-body py-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Jumlah yang Diperlukan</span>
                                    <input type="number" class="form-control form-control-sm" name="jumlah_sekolah_sementara" value="{{ old('jumlah_sekolah_sementara', $data['jumlah_sekolah_sementara'] ?? '') }}" placeholder="Unit" style="min-width: 120px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Harga Satuan</span>
                                    <input type="number" class="form-control form-control-sm" name="harga_sekolah_sementara" value="{{ old('harga_sekolah_sementara', $data['harga_sekolah_sementara'] ?? '') }}" placeholder="Rp/Unit" style="min-width: 120px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">{{ isset($edit) && $edit ? 'Update Data' : 'Simpan Data' }}</button>
            </div>
        </div>
    </form>
    <hr class="my-4">
    <div class="card mt-4">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Total Kerusakan (Otomatis)</h5>
        </div>
        <div class="card-body text-center">
            @php
                $totalKerusakan = 0;
                $bangunan = [
                    'tk','sd','smp','sma','smk','pt','perpus','lab','lainnya'
                ];
                foreach($bangunan as $b) {
                    $totalKerusakan += (($data[$b.'_berat_negeri'] ?? 0) + ($data[$b.'_berat_swasta'] ?? 0)) * ($data[$b.'_harga_bangunan'] ?? 0);
                    $totalKerusakan += (($data[$b.'_sedang_negeri'] ?? 0) + ($data[$b.'_sedang_swasta'] ?? 0)) * ($data[$b.'_harga_bangunan'] ?? 0);
                    $totalKerusakan += (($data[$b.'_ringan_negeri'] ?? 0) + ($data[$b.'_ringan_swasta'] ?? 0)) * ($data[$b.'_harga_bangunan'] ?? 0);
                }
            @endphp
            <h4 class="mb-1">Rp {{ number_format($totalKerusakan, 0, ',', '.') }}</h4>
            <small>Total Kerusakan Format 2</small>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
@endsection
