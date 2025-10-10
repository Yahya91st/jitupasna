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
</style>
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengkajian Kebutuhan Pasca Bencana</h5>
    <p class="fw-bold">Format 3: Sektor Kesehatan</p>
    <form action="{{ isset($edit) && $edit ? route('forms.form4.format3.update', $data->id) : route('forms.form4.format3.store') }}" method="POST">
        @csrf
        @if(isset($edit) && $edit)
            @method('PATCH')
        @endif
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">
        <table class="table table-bordered">
            <tr>
                <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
            </tr>
        </table>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle" style="width: 100%;">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle" style="width: 20%;">Keterangan</th>
                        <th colspan="3" class="text-center" style="width: 40%;">Jumlah Unit yang Rusak</th>
                        <th colspan="3" class="text-center" style="width: 40%;">HARGA SATUAN</th>
                    </tr>
                    <tr>
                        <th class="text-center" style="width: 13%;">Berat</th>
                        <th class="text-center" style="width: 13%;">Sedang</th>
                        <th class="text-center" style="width: 14%;">Ringan</th>
                        <th class="text-center" style="width: 13%;">RB</th>
                        <th class="text-center" style="width: 13%;">RS</th>
                        <th class="text-center" style="width: 14%;">RR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-bold bg-secondary text-white" colspan="7" style="padding-left: 15%;">PERKIRAAN KERUSAKAN</td>
                    </tr>
                    @foreach([
                        ['Rumah Sakit', 'rs'],
                        ['Puskesmas', 'puskesmas'],
                        ['Poliklinik/Tempat Praktek Bersama', 'poliklinik'],
                        ['Puskesmas Pembantu', 'pustu'],
                        ['Polindes', 'polindes'],
                        ['Posyandu', 'posyandu'],
                    ] as [$label, $prefix])
                    <tr>
                        <td class="align-middle fw-bold">{{ $label }}</td>
                        <td><input type="number" name="{{ $prefix }}_berat" class="form-control" min="0" value="{{ old($prefix.'_berat', $data->{$prefix.'_berat'} ?? '0') }}"></td>
                        <td><input type="number" name="{{ $prefix }}_sedang" class="form-control" min="0" value="{{ old($prefix.'_sedang', $data->{$prefix.'_sedang'} ?? '0') }}"></td>
                        <td><input type="number" name="{{ $prefix }}_ringan" class="form-control" min="0" value="{{ old($prefix.'_ringan', $data->{$prefix.'_ringan'} ?? '0') }}"></td>
                        <td><input type="number" name="{{ $prefix }}_rb_harga" class="form-control" min="0" step="1000" value="{{ old($prefix.'_rb_harga', $data->{$prefix.'_rb_harga'} ?? '0') }}"></td>
                        <td><input type="number" name="{{ $prefix }}_rs_harga" class="form-control" min="0" step="1000" value="{{ old($prefix.'_rs_harga', $data->{$prefix.'_rs_harga'} ?? '0') }}"></td>
                        <td><input type="number" name="{{ $prefix }}_rr_harga" class="form-control" min="0" step="1000" value="{{ old($prefix.'_rr_harga', $data->{$prefix.'_rr_harga'} ?? '0') }}"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <hr class="my-4">

        <h6 class="fw-bold">II. PERKIRAAN KERUGIAN</h6>
        <table class="table table-bordered mt-3">
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
                            <input type="number" name="biaya_tenaga_kerja_hok" class="form-control" placeholder="0" value="{{ old('biaya_tenaga_kerja_hok', $data->biaya_tenaga_kerja_hok ?? '') }}">
                            <span class="input-group-text">HOK</span>
                        </div>
                    </td>
                    <td style="width: 15%">Upah Harian</td>
                    <td style="width: 35%">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="upah_harian" class="form-control" placeholder="0" value="{{ old('upah_harian', $data->upah_harian ?? '') }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>B. Biaya Alat Berat</td>
                    <td>
                        <div class="input-group">
                            <input type="number" name="biaya_alat_berat_hari" class="form-control" placeholder="0" value="{{ old('biaya_alat_berat_hari', $data->biaya_alat_berat_hari ?? '') }}">
                            <span class="input-group-text">Hari</span>
                        </div>
                    </td>
                    <td>Tarif per Hari</td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="biaya_alat_berat_tarif" class="form-control" placeholder="0" value="{{ old('biaya_alat_berat_tarif', $data->biaya_alat_berat_tarif ?? '') }}">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered mt-3">
            <thead>
                <tr class="bg-secondary text-white">
                    <th colspan="4">2. BIAYA PEMULASARAAN JENAZAH</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 15%">Jumlah Jenazah</td>
                    <td style="width: 35%">
                        <div class="input-group">
                            <input type="number" name="jumlah_jenazah" class="form-control" placeholder="0" value="{{ old('jumlah_jenazah', $data->jumlah_jenazah ?? '') }}">
                            <span class="input-group-text">Jenazah</span>
                        </div>
                    </td>
                    <td style="width: 15%">Biaya per Jenazah</td>
                    <td style="width: 35%">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="biaya_per_jenazah" class="form-control" placeholder="0" value="{{ old('biaya_per_jenazah', $data->biaya_per_jenazah ?? '') }}">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered mt-3">
            <thead>
                <tr class="bg-secondary text-white">
                    <th colspan="4">3. BIAYA PERAWATAN KORBAN BENCANA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 15%">Jumlah Korban Dirawat</td>
                    <td style="width: 35%">
                        <div class="input-group">
                            <input type="number" name="jumlah_pasien" class="form-control" placeholder="0" value="{{ old('jumlah_pasien', $data->jumlah_pasien ?? '') }}">
                            <span class="input-group-text">Orang</span>
                        </div>
                    </td>
                    <td style="width: 15%">Biaya per Korban</td>
                    <td style="width: 35%">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="biaya_per_pasien" class="form-control" placeholder="0" value="{{ old('biaya_per_pasien', $data->biaya_per_pasien ?? '') }}">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered mt-3">
            <thead>
                <tr class="bg-secondary text-white">
                    <th colspan="4">4. FASILITAS KESEHATAN SEMENTARA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 15%">Jenis Faskes</td>
                    <td style="width: 35%">
                        <input type="text" name="jenis_operasional" class="form-control" placeholder="Jenis Faskes" value="{{ old('jenis_operasional', $data->jenis_operasional ?? '') }}">
                    </td>
                    <td style="width: 15%">Jumlah Unit</td>
                    <td style="width: 35%">
                        <div class="input-group">
                            <input type="number" name="jumlah_faskes" class="form-control" placeholder="0" value="{{ old('jumlah_faskes', $data->jumlah_faskes ?? '') }}">
                            <span class="input-group-text">Unit</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Biaya Pengadaan Faskes Sementara</td>
                    <td colspan="2">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="biaya_pengadaan_faskes" class="form-control" placeholder="0" value="{{ old('biaya_pengadaan_faskes', $data->biaya_pengadaan_faskes ?? '') }}">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered mt-3">
            <thead>
                <tr class="bg-secondary text-white">
                    <th colspan="4">5. BIAYA PENANGANAN PSIKOLOGIS KORBAN BENCANA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 15%">Jumlah Korban</td>
                    <td style="width: 35%">
                        <div class="input-group">
                            <input type="number" name="jumlah_korban_psikologis" class="form-control" placeholder="0" value="{{ old('jumlah_korban_psikologis', $data->jumlah_korban_psikologis ?? '') }}">
                            <span class="input-group-text">Orang</span>
                        </div>
                    </td>
                    <td style="width: 15%">Biaya per Korban</td>
                    <td style="width: 35%">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="biaya_penanganan_psikologis" class="form-control" placeholder="0" value="{{ old('biaya_penanganan_psikologis', $data->biaya_penanganan_psikologis ?? '') }}">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered mt-3">
            <thead>
                <tr class="bg-secondary text-white">
                    <th colspan="2">6. BIAYA PENCEGAHAN PENYAKIT MENULAR</th>
                    <th colspan="2">7. JUMLAH BANTUAN TENAGA KESEHATAN YANG DIPERLUKAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 25%">Biaya Pencegahan Penyakit Menular</td>
                    <td style="width: 25%">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="biaya_pencegahan_penyakit" class="form-control" placeholder="0" value="{{ old('biaya_pencegahan_penyakit', $data->biaya_pencegahan_penyakit ?? '') }}">
                        </div>
                    </td>
                    <td style="width: 25%">Jumlah Tenaga Kesehatan</td>
                    <td style="width: 25%">
                        <div class="input-group">
                            <input type="number" name="jumlah_tenaga_kesehatan" class="form-control" placeholder="0" value="{{ old('jumlah_tenaga_kesehatan', $data->jumlah_tenaga_kesehatan ?? '') }}">
                            <span class="input-group-text">Orang</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered mt-3">
            <thead>
                <tr class="bg-secondary text-white">
                    <th colspan="2">8. BIAYA HONORARIUM TENAGA KESEHATAN BANTUAN</th>
                    <th colspan="2">9. RATA-RATA PENDAPATAN FASKES SWASTA/BULAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 25%">Honorarium Tenaga Kesehatan</td>
                    <td style="width: 25%">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="honorarium_tenaga_kesehatan" class="form-control" placeholder="0" value="{{ old('honorarium_tenaga_kesehatan', $data->honorarium_tenaga_kesehatan ?? '') }}">
                        </div>
                    </td>
                    <td style="width: 25%">Pendapatan Faskes Swasta/Bulan</td>
                    <td style="width: 25%">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="pendapatan_faskes_swasta" class="form-control" placeholder="0" value="{{ old('pendapatan_faskes_swasta', $data->pendapatan_faskes_swasta ?? '') }}">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

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
                $faskes = ['rs', 'puskesmas', 'poliklinik', 'pustu', 'polindes', 'posyandu'];
                foreach ($faskes as $f) {
                    $totalKerusakan += ($data->{$f.'_berat'} ?? 0) * ($data->{$f.'_rb_harga'} ?? 0);
                    $totalKerusakan += ($data->{$f.'_sedang'} ?? 0) * ($data->{$f.'_rs_harga'} ?? 0);
                    $totalKerusakan += ($data->{$f.'_ringan'} ?? 0) * ($data->{$f.'_rr_harga'} ?? 0);
                }
                $totalKerusakan += ($data->biaya_tenaga_kerja_hok ?? 0) * ($data->upah_harian ?? 0);
                $totalKerusakan += ($data->biaya_alat_berat_hari ?? 0) * ($data->biaya_alat_berat_tarif ?? 0);
                $totalKerusakan += ($data->jumlah_jenazah ?? 0) * ($data->biaya_per_jenazah ?? 0);
                $totalKerusakan += ($data->jumlah_pasien ?? 0) * ($data->biaya_per_pasien ?? 0);
                $totalKerusakan += ($data->jumlah_faskes ?? 0) * ($data->biaya_pengadaan_faskes ?? 0);
                $totalKerusakan += ($data->jumlah_korban_psikologis ?? 0) * ($data->biaya_penanganan_psikologis ?? 0);
                $totalKerusakan += ($data->biaya_pencegahan_penyakit ?? 0);
                $totalKerusakan += ($data->jumlah_tenaga_kesehatan ?? 0) * ($data->honorarium_tenaga_kesehatan ?? 0);
                $totalKerusakan += ($data->pendapatan_faskes_swasta ?? 0);
            @endphp
            <h4 class="mb-1">Rp {{ number_format($totalKerusakan, 0, ',', '.') }}</h4>
            <small>Total Kerusakan Format 3</small>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const submitBtn = document.querySelector('button[type="submit"]');
    const form = document.querySelector('form');
    if (form && submitBtn) {
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
        });
    }
});
</script>
@endsection