@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 2: Pengumpulan Data Sektor PENDIDIKAN</p>    <div class="row mb-2">
        <div class="col-md-6">
            <div class="input-group input-group-sm">
                <span class="input-group-text">NAMA KAMPUNG</span>
                <input type="text" class="form-control form-control-sm" name="nama_kampung" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-sm">
                <span class="input-group-text">NAMA DISTRIK</span>
                <input type="text" class="form-control form-control-sm" name="nama_distrik" required>
            </div>
        </div>
    </div>
      <form action="{{ route('forms.form4.store-format2') }}" method="POST">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">
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
                <tbody>                    <tr>
                        <td>TK/RA</td>
                        <td><input type="number" class="form-control form-control-sm" name="tk_berat_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="tk_berat_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="tk_sedang_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="tk_sedang_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="tk_ringan_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="tk_ringan_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="tk_ukuran" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="tk_harga_bangunan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="tk_harga_peralatan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="tk_harga_meubelair" style="min-width: 100px;"></td>
                    </tr>                    <tr>
                        <td>SD/MI</td>
                        <td><input type="number" class="form-control form-control-sm" name="sd_berat_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sd_berat_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sd_sedang_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sd_sedang_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sd_ringan_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sd_ringan_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sd_ukuran" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sd_harga_bangunan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sd_harga_peralatan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sd_harga_meubelair" style="min-width: 100px;"></td>
                    </tr>                    <tr>
                        <td>SMP/MTS</td>
                        <td><input type="number" class="form-control form-control-sm" name="smp_berat_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smp_berat_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smp_sedang_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smp_sedang_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smp_ringan_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smp_ringan_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smp_ukuran" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smp_harga_bangunan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smp_harga_peralatan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smp_harga_meubelair" style="min-width: 100px;"></td>
                    </tr>                    <tr>
                        <td>SMA/MA</td>
                        <td><input type="number" class="form-control form-control-sm" name="sma_berat_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sma_berat_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sma_sedang_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sma_sedang_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sma_ringan_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sma_ringan_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sma_ukuran" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sma_harga_bangunan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sma_harga_peralatan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="sma_harga_meubelair" style="min-width: 100px;"></td>
                    </tr>
                    <tr>
                        <td>SMK</td>
                        <td><input type="number" class="form-control form-control-sm" name="smk_berat_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smk_berat_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smk_sedang_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smk_sedang_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smk_ringan_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smk_ringan_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smk_ukuran" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smk_harga_bangunan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smk_harga_peralatan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="smk_harga_meubelair" style="min-width: 100px;"></td>
                    </tr>
                    <tr>
                        <td>Perguruan Tinggi</td>
                        <td><input type="number" class="form-control form-control-sm" name="pt_berat_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="pt_berat_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="pt_sedang_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="pt_sedang_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="pt_ringan_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="pt_ringan_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="pt_ukuran" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="pt_harga_bangunan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="pt_harga_peralatan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="pt_harga_meubelair" style="min-width: 100px;"></td>
                    </tr>
                    <tr>
                        <td>Perpustakaan</td>
                        <td><input type="number" class="form-control form-control-sm" name="perpus_berat_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="perpus_berat_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="perpus_sedang_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="perpus_sedang_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="perpus_ringan_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="perpus_ringan_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="perpus_ukuran" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="perpus_harga_bangunan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="perpus_harga_peralatan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="perpus_harga_meubelair" style="min-width: 100px;"></td>
                    </tr>
                    <tr>
                        <td>Laboratorium</td>
                        <td><input type="number" class="form-control form-control-sm" name="lab_berat_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lab_berat_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lab_sedang_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lab_sedang_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lab_ringan_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lab_ringan_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lab_ukuran" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lab_harga_bangunan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lab_harga_peralatan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lab_harga_meubelair" style="min-width: 100px;"></td>
                    </tr>
                    <tr>
                        <td>Lainnya</td>
                        <td><input type="number" class="form-control form-control-sm" name="lainnya_berat_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lainnya_berat_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lainnya_sedang_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lainnya_sedang_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lainnya_ringan_negeri" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lainnya_ringan_swasta" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lainnya_ukuran" style="min-width: 80px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lainnya_harga_bangunan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lainnya_harga_peralatan" style="min-width: 100px;"></td>
                        <td><input type="number" class="form-control form-control-sm" name="lainnya_harga_meubelair" style="min-width: 100px;"></td>
                    </tr>
                </tbody>
            </table>
        </div>        <h6 class="fw-bold mt-3 mb-2">Perkiraan Kerugian</h6>
        <div class="row g-2">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header py-1 small fw-bold">Biaya Pembersihan Puing</div>
                    <div class="card-body py-2">                        <div class="input-group input-group-sm mb-2">
                            <span class="input-group-text">Tenaga Kerja</span>
                            <input type="number" class="form-control form-control-sm" name="biaya_tenaga_kerja_hok" placeholder="HOK" style="min-width: 100px;">
                            <span class="input-group-text">x Rp</span>
                            <input type="number" class="form-control form-control-sm" name="biaya_tenaga_kerja_upah" placeholder="Upah" style="min-width: 120px;">
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">Alat Berat</span>
                            <input type="number" class="form-control form-control-sm" name="biaya_alat_berat_hari" placeholder="Hari" style="min-width: 100px;">
                            <span class="input-group-text">x Rp</span>
                            <input type="number" class="form-control form-control-sm" name="biaya_alat_berat_harga" placeholder="Sewa/Hari" style="min-width: 120px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header py-1 small fw-bold">Informasi Sekolah</div>
                    <div class="card-body py-2">                        <div class="input-group input-group-sm mb-2">
                            <span class="input-group-text">Sekolah utk Pengungsian</span>
                            <input type="number" class="form-control form-control-sm" name="sekolah_pengungsian" placeholder="Unit" style="min-width: 120px;">
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <span class="input-group-text">Guru Korban Bencana</span>
                            <input type="number" class="form-control form-control-sm" name="guru_korban" placeholder="Orang" style="min-width: 120px;">
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">Iuran Sekolah Swasta</span>
                            <input type="number" class="form-control form-control-sm" name="iuran_sekolah" placeholder="Rp/Bulan" style="min-width: 120px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header py-1 small fw-bold">Sekolah Sementara</div>
                    <div class="card-body py-2">
                        <div class="row">
                            <div class="col-md-6">                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Jumlah yang Diperlukan</span>
                                    <input type="number" class="form-control form-control-sm" name="jumlah_sekolah_sementara" placeholder="Unit" style="min-width: 120px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Harga Satuan</span>
                                    <input type="number" class="form-control form-control-sm" name="harga_sekolah_sementara" placeholder="Rp/Unit" style="min-width: 120px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-3 mb-5">
            <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
