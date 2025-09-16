@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel dan input agar lebih kompak */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
    }
    .table input.form-control {
        padding: 0.15rem 0.3rem !important;
        font-size: 0.95rem;
    }
</style>
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengkajian Kebutuhan Pasca Bencana</h5>
    <p class="fw-bold">Format 16: Sektor Pemerintahan</p>

    <form action="{{ isset($edit) && $edit ? route('forms.form4.format16.update', $data->id) : route('forms.form4.format16.store') }}" method="POST">
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
                            
                            <!-- KANTOR PEMKAB -->
                            <tr>
                                <td class="align-middle fw-bold">Kantor Pemkab</td>
                                <td><input type="number" name="kantor_pemkab_berat" class="form-control" min="0" value="{{ old('kantor_pemkab_berat', $data->kantor_pemkab_berat ?? '0') }}"></td>
                                <td><input type="number" name="kantor_pemkab_sedang" class="form-control" min="0" value="{{ old('kantor_pemkab_sedang', $data->kantor_pemkab_sedang ?? '0') }}"></td>
                                <td><input type="number" name="kantor_pemkab_ringan" class="form-control" min="0" value="{{ old('kantor_pemkab_ringan', $data->kantor_pemkab_ringan ?? '0') }}"></td>
                                <td><input type="number" name="kantor_pemkab_rb_harga" class="form-control" min="0" step="1000" value="{{ old('kantor_pemkab_rb_harga', $data->kantor_pemkab_rb_harga ?? '0') }}"></td>
                                <td><input type="number" name="kantor_pemkab_rs_harga" class="form-control" min="0" step="1000" value="{{ old('kantor_pemkab_rs_harga', $data->kantor_pemkab_rs_harga ?? '0') }}"></td>
                                <td><input type="number" name="kantor_pemkab_rr_harga" class="form-control" min="0" step="1000" value="{{ old('kantor_pemkab_rr_harga', $data->kantor_pemkab_rr_harga ?? '0') }}"></td>
                            </tr>
                            
                            <!-- KANTOR KECAMATAN -->
                            <tr>
                                <td class="align-middle fw-bold">Kantor Kecamatan</td>
                                <td><input type="number" name="kantor_kecamatan_berat" class="form-control" min="0" value="{{ old('kantor_kecamatan_berat', $data->kantor_kecamatan_berat ?? '0') }}"></td>
                                <td><input type="number" name="kantor_kecamatan_sedang" class="form-control" min="0" value="{{ old('kantor_kecamatan_sedang', $data->kantor_kecamatan_sedang ?? '0') }}"></td>
                                <td><input type="number" name="kantor_kecamatan_ringan" class="form-control" min="0" value="{{ old('kantor_kecamatan_ringan', $data->kantor_kecamatan_ringan ?? '0') }}"></td>
                                <td><input type="number" name="kantor_kecamatan_rb_harga" class="form-control" min="0" step="1000" value="{{ old('kantor_kecamatan_rb_harga', $data->kantor_kecamatan_rb_harga ?? '0') }}"></td>
                                <td><input type="number" name="kantor_kecamatan_rs_harga" class="form-control" min="0" step="1000" value="{{ old('kantor_kecamatan_rs_harga', $data->kantor_kecamatan_rs_harga ?? '0') }}"></td>
                                <td><input type="number" name="kantor_kecamatan_rr_harga" class="form-control" min="0" step="1000" value="{{ old('kantor_kecamatan_rr_harga', $data->kantor_kecamatan_rr_harga ?? '0') }}"></td>
                            </tr>
                            
                            <!-- KANTOR DINAS -->
                            <tr>
                                <td class="align-middle fw-bold">Kantor Dinas</td>
                                <td><input type="number" name="kantor_dinas_berat" class="form-control" min="0" value="{{ old('kantor_dinas_berat', $data->kantor_dinas_berat ?? '0') }}"></td>
                                <td><input type="number" name="kantor_dinas_sedang" class="form-control" min="0" value="{{ old('kantor_dinas_sedang', $data->kantor_dinas_sedang ?? '0') }}"></td>
                                <td><input type="number" name="kantor_dinas_ringan" class="form-control" min="0" value="{{ old('kantor_dinas_ringan', $data->kantor_dinas_ringan ?? '0') }}"></td>
                                <td><input type="number" name="kantor_dinas_rb_harga" class="form-control" min="0" step="1000" value="{{ old('kantor_dinas_rb_harga', $data->kantor_dinas_rb_harga ?? '0') }}"></td>
                                <td><input type="number" name="kantor_dinas_rs_harga" class="form-control" min="0" step="1000" value="{{ old('kantor_dinas_rs_harga', $data->kantor_dinas_rs_harga ?? '0') }}"></td>
                                <td><input type="number" name="kantor_dinas_rr_harga" class="form-control" min="0" step="1000" value="{{ old('kantor_dinas_rr_harga', $data->kantor_dinas_rr_harga ?? '0') }}"></td>
                            </tr>
                            
                            <!-- KANTOR INSTANSI VERTIKAL -->
                            <tr>
                                <td class="align-middle fw-bold">Kantor Instansi Vertikal/Pemerintah Pusat</td>
                                <td><input type="number" name="kantor_vertikal_berat" class="form-control" min="0" value="{{ old('kantor_vertikal_berat', $data->kantor_vertikal_berat ?? '0') }}"></td>
                                <td><input type="number" name="kantor_vertikal_sedang" class="form-control" min="0" value="{{ old('kantor_vertikal_sedang', $data->kantor_vertikal_sedang ?? '0') }}"></td>
                                <td><input type="number" name="kantor_vertikal_ringan" class="form-control" min="0" value="{{ old('kantor_vertikal_ringan', $data->kantor_vertikal_ringan ?? '0') }}"></td>
                                <td><input type="number" name="kantor_vertikal_rb_harga" class="form-control" min="0" step="1000" value="{{ old('kantor_vertikal_rb_harga', $data->kantor_vertikal_rb_harga ?? '0') }}"></td>
                                <td><input type="number" name="kantor_vertikal_rs_harga" class="form-control" min="0" step="1000" value="{{ old('kantor_vertikal_rs_harga', $data->kantor_vertikal_rs_harga ?? '0') }}"></td>
                                <td><input type="number" name="kantor_vertikal_rr_harga" class="form-control" min="0" step="1000" value="{{ old('kantor_vertikal_rr_harga', $data->kantor_vertikal_rr_harga ?? '0') }}"></td>
                            </tr>
                            
                            <!-- MEBELAIR DAN PERALATAN KANTOR -->
                            <tr>
                                <td class="align-middle fw-bold">Mebelair dan Peralatan Kantor</td>
                                <td><input type="number" name="mebelair_berat" class="form-control" min="0" value="{{ old('mebelair_berat', $data->mebelair_berat ?? '0') }}"></td>
                                <td><input type="number" name="mebelair_sedang" class="form-control" min="0" value="{{ old('mebelair_sedang', $data->mebelair_sedang ?? '0') }}"></td>
                                <td><input type="number" name="mebelair_ringan" class="form-control" min="0" value="{{ old('mebelair_ringan', $data->mebelair_ringan ?? '0') }}"></td>
                                <td><input type="number" name="mebelair_rb_harga" class="form-control" min="0" step="1000" value="{{ old('mebelair_rb_harga', $data->mebelair_rb_harga ?? '0') }}"></td>
                                <td><input type="number" name="mebelair_rs_harga" class="form-control" min="0" step="1000" value="{{ old('mebelair_rs_harga', $data->mebelair_rs_harga ?? '0') }}"></td>
                                <td><input type="number" name="mebelair_rr_harga" class="form-control" min="0" step="1000" value="{{ old('mebelair_rr_harga', $data->mebelair_rr_harga ?? '0') }}"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr class="my-4">

                <h6 class="fw-bold">II. PERKIRAAN KERUGIAN</h6>
                
                <!-- BIAYA PEMBERSIHAN PUING -->
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

                <!-- BIAYA SEWA KANTOR SEMENTARA -->
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr class="bg-secondary text-white">
                            <th colspan="4">2. BIAYA SEWA KANTOR SEMENTARA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 15%">Jumlah Unit</td>
                            <td style="width: 35%">
                                <div class="input-group">
                                    <input type="number" name="sewa_kantor_jumlah_unit" class="form-control" placeholder="0" value="{{ old('sewa_kantor_jumlah_unit', $data->sewa_kantor_jumlah_unit ?? '') }}">
                                    <span class="input-group-text">Unit</span>
                                </div>
                            </td>
                            <td style="width: 15%">Biaya per Unit</td>
                            <td style="width: 35%">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="sewa_kantor_biaya_per_unit" class="form-control" placeholder="0" value="{{ old('sewa_kantor_biaya_per_unit', $data->sewa_kantor_biaya_per_unit ?? '') }}">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- BIAYA RESTORASI ARSIP -->
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr class="bg-secondary text-white">
                            <th colspan="4">3. BIAYA RESTORASI ARSIP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 15%">Jumlah Arsip</td>
                            <td style="width: 35%">
                                <div class="input-group">
                                    <input type="number" name="restorasi_arsip_jumlah" class="form-control" placeholder="0" value="{{ old('restorasi_arsip_jumlah', $data->restorasi_arsip_jumlah ?? '') }}">
                                    <span class="input-group-text">Unit</span>
                                </div>
                            </td>
                            <td style="width: 15%">Harga Satuan</td>
                            <td style="width: 35%">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="restorasi_arsip_harga_satuan" class="form-control" placeholder="0" value="{{ old('restorasi_arsip_harga_satuan', $data->restorasi_arsip_harga_satuan ?? '') }}">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- KEHILANGAN PENDAPATAN RETRIBUSI -->
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr class="bg-secondary text-white">
                            <th>4. KEHILANGAN PENDAPATAN RETRIBUSI JASA PEMERINTAHAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <textarea name="dasar_perhitungan_retribusi" class="form-control" rows="3" placeholder="Masukkan dasar perhitungan kehilangan pendapatan retribusi...">{{ old('dasar_perhitungan_retribusi', $data->dasar_perhitungan_retribusi ?? '') }}</textarea>
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
                        
                        // Kantor Pemkab
                        $totalKerusakan += ($data->kantor_pemkab_berat ?? 0) * ($data->kantor_pemkab_rb_harga ?? 0);
                        $totalKerusakan += ($data->kantor_pemkab_sedang ?? 0) * ($data->kantor_pemkab_rs_harga ?? 0);
                        $totalKerusakan += ($data->kantor_pemkab_ringan ?? 0) * ($data->kantor_pemkab_rr_harga ?? 0);
                        
                        // Kantor Kecamatan
                        $totalKerusakan += ($data->kantor_kecamatan_berat ?? 0) * ($data->kantor_kecamatan_rb_harga ?? 0);
                        $totalKerusakan += ($data->kantor_kecamatan_sedang ?? 0) * ($data->kantor_kecamatan_rs_harga ?? 0);
                        $totalKerusakan += ($data->kantor_kecamatan_ringan ?? 0) * ($data->kantor_kecamatan_rr_harga ?? 0);
                        
                        // Kantor Dinas
                        $totalKerusakan += ($data->kantor_dinas_berat ?? 0) * ($data->kantor_dinas_rb_harga ?? 0);
                        $totalKerusakan += ($data->kantor_dinas_sedang ?? 0) * ($data->kantor_dinas_rs_harga ?? 0);
                        $totalKerusakan += ($data->kantor_dinas_ringan ?? 0) * ($data->kantor_dinas_rr_harga ?? 0);
                        
                        // Kantor Vertikal
                        $totalKerusakan += ($data->kantor_vertikal_berat ?? 0) * ($data->kantor_vertikal_rb_harga ?? 0);
                        $totalKerusakan += ($data->kantor_vertikal_sedang ?? 0) * ($data->kantor_vertikal_rs_harga ?? 0);
                        $totalKerusakan += ($data->kantor_vertikal_ringan ?? 0) * ($data->kantor_vertikal_rr_harga ?? 0);
                        
                        // Mebelair
                        $totalKerusakan += ($data->mebelair_berat ?? 0) * ($data->mebelair_rb_harga ?? 0);
                        $totalKerusakan += ($data->mebelair_sedang ?? 0) * ($data->mebelair_rs_harga ?? 0);
                        $totalKerusakan += ($data->mebelair_ringan ?? 0) * ($data->mebelair_rr_harga ?? 0);
                        
                        // Biaya Pembersihan
                        $totalKerusakan += ($data->biaya_tenaga_kerja_hok ?? 0) * ($data->upah_harian ?? 0);
                        $totalKerusakan += ($data->biaya_alat_berat_hari ?? 0) * ($data->biaya_alat_berat_tarif ?? 0);
                        
                        // Biaya Sewa Kantor
                        $totalKerusakan += ($data->sewa_kantor_jumlah_unit ?? 0) * ($data->sewa_kantor_biaya_per_unit ?? 0);
                        
                        // Biaya Restorasi Arsip
                        $totalKerusakan += ($data->restorasi_arsip_jumlah ?? 0) * ($data->restorasi_arsip_harga_satuan ?? 0);
                    @endphp
                    <h4 class="mb-1">Rp {{ number_format($totalKerusakan, 0, ',', '.') }}</h4>
                    <small>Total Kerusakan Format 16</small>
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
        // Form submission with loading state
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
