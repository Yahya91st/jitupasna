@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 4: Pengumpulan Data Sektor Perlindungan Sosial</p>
    
    <form action="{{ route('forms.form4.store-format4') }}" method="POST">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">
    
        <div class="row mb-2">
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

    <p><strong>A. Kerusakan Fisik Bangunan / Sarana Pelayanan Sosial</strong></p>    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle" style="min-width: 1200px;">
            <thead>
                <tr>
                    <th rowspan="2">Jenis Bangunan</th>
                    <th colspan="6">Jumlah Unit Rusak</th>
                    <th rowspan="2">Rata-rata Luas Bangunan</th>
                    <th colspan="4">Harga Satuan</th>
                </tr>
                <tr>
                    <th>Berat Negeri</th>
                    <th>Berat Swasta</th>
                    <th>Sedang Negeri</th>
                    <th>Sedang Swasta</th>
                    <th>Ringan Negeri</th>
                    <th>Ringan Swasta</th>
                    <th>Bangunan/m²</th>
                    <th>Obat-obatan</th>
                    <th>Meubelair</th>
                    <th>Peralatan lab dan lainnya</th>
                </tr>
            </thead>
            <tbody>            <tr>
                <td>Panti Asuhan</td>
                <td><input type="number" class="form-control form-control-sm" name="panti_sosial_rb_negeri" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_sosial_rb_swasta" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_sosial_rs_negeri" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_sosial_rs_swasta" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_sosial_rr_negeri" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_sosial_rr_swasta" style="min-width: 80px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="panti_sosial_luas" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_sosial_harga_bangunan" style="min-width: 100px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="panti_sosial_harga_peralatan" style="min-width: 100px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="panti_sosial_harga_meubelair" style="min-width: 100px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="panti_sosial_harga_peralatan_lab" style="min-width: 100px;"></td>
            </tr><tr>
                <td>Panti Wredha</td>
                <td><input type="number" class="form-control form-control-sm" name="panti_asuhan_rb_negeri" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_asuhan_rb_swasta" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_asuhan_rs_negeri" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_asuhan_rs_swasta" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_asuhan_rr_negeri" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_asuhan_rr_swasta" style="min-width: 80px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="panti_asuhan_luas" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_asuhan_harga_bangunan" style="min-width: 100px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="panti_asuhan_harga_peralatan" style="min-width: 100px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="panti_asuhan_harga_meubelair" style="min-width: 100px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="panti_asuhan_harga_peralatan_lab" style="min-width: 100px;"></td>
            </tr><tr>
                <td>Panti Tuna  Grahita</td>
                <td><input type="number" class="form-control form-control-sm" name="balai_pelayanan_rb_negeri" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_pelayanan_rb_swasta" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_pelayanan_rs_negeri" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_pelayanan_rs_swasta" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_pelayanan_rr_negeri" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_pelayanan_rr_swasta" style="min-width: 80px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="balai_pelayanan_luas" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_pelayanan_harga_bangunan" style="min-width: 100px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="balai_pelayanan_harga_peralatan" style="min-width: 100px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="balai_pelayanan_harga_meubelair" style="min-width: 100px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="balai_pelayanan_harga_peralatan_lab" style="min-width: 100px;"></td>
            </tr><tr>
                <td>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Lainnya:</span>
                        <input type="text" class="form-control form-control-sm" name="lainnya_jenis" placeholder="Sebutkan">
                    </div>
                </td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_rb_negeri" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_rb_swasta" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_rs_negeri" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_rs_swasta" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_rr_negeri" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_rr_swasta" style="min-width: 80px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="lainnya_luas" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_harga_bangunan" style="min-width: 100px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="lainnya_harga_peralatan" style="min-width: 100px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="lainnya_harga_meubelair" style="min-width: 100px;"></td>
                <td><input type="text" class="form-control form-control-sm" name="lainnya_harga_peralatan_lab" style="min-width: 100px;"></td>
            </tr>
        </tbody>
    </table>    <h6 class="fw-bold mt-4">B. Perkiraan Kerugian</h6>
    
    <div class="card mb-3">
        <div class="card-header py-1 small fw-bold">1) Biaya Pembersihan Puing</div>
        <div class="card-body py-2">
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text">A. Biaya Tenaga Kerja</span>
                <input type="number" class="form-control form-control-sm" name="biaya_tenaga_kerja_hok" placeholder="HOK" style="min-width: 100px;">
                <span class="input-group-text">x Rp</span>
                <input type="number" class="form-control form-control-sm" name="biaya_tenaga_kerja_upah" placeholder="Upah" style="min-width: 120px;">
            </div>
            <div class="input-group input-group-sm">
                <span class="input-group-text">B. Biaya Alat Berat</span>
                <input type="number" class="form-control form-control-sm" name="biaya_alat_berat_hari" placeholder="Hari" style="min-width: 100px;">
                <span class="input-group-text">x Rp</span>
                <input type="number" class="form-control form-control-sm" name="biaya_alat_berat_harga" placeholder="Sewa/Hari" style="min-width: 120px;">
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header py-1 small fw-bold">2) Biaya Penyediaan Jatah Hidup</div>
        <div class="card-body py-2">
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text">Perkiraan Jumlah Pengungsi yang perlu ditangani</span>
                <input type="number" class="form-control form-control-sm" name="jumlah_penerima" placeholder="0" style="min-width: 120px;">
            </div>
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text">Rata rata biaya penanganan pengungsi</span>
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control form-control-sm" name="bantuan_per_orang" placeholder="0" style="min-width: 120px;">
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header py-1 small fw-bold">3) Tambahan Biaya Sosial</div>
        <div class="card-body py-2">
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text">Biaya Pelayanan Kesehatan</span>
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control form-control-sm" name="biaya_pelayanan_kesehatan" placeholder="0" style="min-width: 120px;">
            </div>
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text">Biaya Pelayanan Pendidikan</span>
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control form-control-sm" name="biaya_pelayanan_pendidikan" placeholder="0" style="min-width: 120px;">
            </div>
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text">Biaya Pendampingan Psikososial</span>
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control form-control-sm" name="biaya_pendampingan_psikososial" placeholder="0" style="min-width: 120px;">
            </div>
            <div class="input-group input-group-sm">
                <span class="input-group-text">Biaya Pelatihan Darurat</span>
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control form-control-sm" name="biaya_pelatihan_darurat" placeholder="0" style="min-width: 120px;">
            </div>
        </div>
    </div>
    
    <div class="text-center mt-3 mb-5">
        <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
    </div>
    </form>
</div>
@endsection
