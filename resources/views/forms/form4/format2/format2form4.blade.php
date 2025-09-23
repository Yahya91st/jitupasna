@extends('layouts.main')

@section('content')
<style>
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
        vertical-align: middle !important;
        text-align: center;
    }
    .table input.form-control {
        padding: 0.15rem 0.3rem !important;
        font-size: 0.95rem;
    }
    .input-group-text {
        padding: 0.2rem 0.5rem !important;
        font-size: 0.9rem;
    }
</style>
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengkajian Kebutuhan Pasca Bencana</h5>
    <p class="fw-bold">Format 2: Sektor Pendidikan</p>
    <form action="{{ isset($edit) && $edit ? route('forms.form4.format2.update', $data['id'] ?? '') : route('forms.form4.format2.store') }}" method="POST">
        @csrf
        @if(isset($edit) && $edit)
            @method('PATCH')
        @endif
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">
        <table class="table table-bordered mb-2">
            <tr>
                <td style="width: 50%">
                    NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" value="{{ old('nama_kampung', $data['nama_kampung'] ?? '') }}" required>
                    @error('nama_kampung')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </td>
                <td>
                    NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" value="{{ old('nama_distrik', $data['nama_distrik'] ?? '') }}" required>
                    @error('nama_distrik')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>
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
                        <td><input type="number" class="form-control" name="{{ $prefix . '_' . $f }}" value="{{ old($prefix . '_' . $f, $data[$prefix . '_' . $f] ?? '') }}"></td>
                        @endforeach
                        <td><input type="number" class="form-control" name="{{ $prefix . '_ukuran' }}" value="{{ old($prefix . '_ukuran', $data[$prefix . '_ukuran'] ?? '') }}"></td>
                        <td><input type="number" class="form-control" name="{{ $prefix . '_harga_bangunan' }}" value="{{ old($prefix . '_harga_bangunan', $data[$prefix . '_harga_bangunan'] ?? '') }}"></td>
                        <td><input type="text" class="form-control" name="{{ $prefix . '_harga_peralatan' }}" value="{{ old($prefix . '_harga_peralatan', $data[$prefix . '_harga_peralatan'] ?? '') }}"></td>
                        <td><input type="text" class="form-control" name="{{ $prefix . '_harga_meubelair' }}" value="{{ old($prefix . '_harga_meubelair', $data[$prefix . '_harga_meubelair'] ?? '') }}"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h6 class="fw-bold mt-3 mb-2">Perkiraan Kerugian</h6>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="4">1. BIAYA PEMBERSIHAN PUING</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 15%">A. Biaya Tenaga Kerja</td>
                        <td style="width: 35%">
                            <div class="input-group">
                                <input type="number" name="biaya_tenaga_kerja_hok" class="form-control" placeholder="0" value="{{ old('biaya_tenaga_kerja_hok', $data['biaya_tenaga_kerja_hok'] ?? '') }}">
                                <span class="input-group-text">HOK</span>
                            </div>
                        </td>
                        <td style="width: 15%">Upah Harian</td>
                        <td style="width: 35%">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="biaya_tenaga_kerja_upah" class="form-control" placeholder="0" value="{{ old('biaya_tenaga_kerja_upah', $data['biaya_tenaga_kerja_upah'] ?? '') }}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>B. Biaya Alat Berat</td>
                        <td>
                            <div class="input-group">
                                <input type="number" name="biaya_alat_berat_hari" class="form-control" placeholder="0" value="{{ old('biaya_alat_berat_hari', $data['biaya_alat_berat_hari'] ?? '') }}">
                                <span class="input-group-text">Hari</span>
                            </div>
                        </td>
                        <td>Tarif per Hari</td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="biaya_alat_berat_harga" class="form-control" placeholder="0" value="{{ old('biaya_alat_berat_harga', $data['biaya_alat_berat_harga'] ?? '') }}">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="4">2. SEKOLAH SEMENTARA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 15%">Jumlah yang Diperlukan</td>
                        <td style="width: 35%">
                            <input type="number" name="jumlah_sekolah_sementara" class="form-control" placeholder="0" value="{{ old('jumlah_sekolah_sementara', $data['jumlah_sekolah_sementara'] ?? '') }}">
                        </td>
                        <td style="width: 15%">Harga Satuan</td>
                        <td style="width: 35%">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_sekolah_sementara" class="form-control" placeholder="0" value="{{ old('harga_sekolah_sementara', $data['harga_sekolah_sementara'] ?? '') }}">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th style="width: 34%">Sekolah utk Pengungsian</th>
                        <th style="width: 33%">Guru Korban Bencana</th>
                        <th style="width: 33%">Iuran Sekolah Swasta</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="number" class="form-control" name="sekolah_pengungsian" value="{{ old('sekolah_pengungsian', $data['sekolah_pengungsian'] ?? '') }}" placeholder="Unit">
                        </td>
                        <td>
                            <input type="number" class="form-control" name="guru_korban" value="{{ old('guru_korban', $data['guru_korban'] ?? '') }}" placeholder="Orang">
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" name="iuran_sekolah" value="{{ old('iuran_sekolah', $data['iuran_sekolah'] ?? '') }}" placeholder="Rp/Bulan">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mb-4">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">{{ isset($edit) && $edit ? 'Update Data' : 'Simpan Data' }}</button>
            </div>
        </div>
    </form>
</div>
@endsection