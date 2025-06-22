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

    <p><strong>A. Kerusakan Fisik Bangunan / Sarana Pelayanan Sosial</strong></p>    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Jenis Bangunan</th>
                <th>Jumlah Unit Rusak Berat</th>
                <th>Jumlah Unit Rusak Sedang</th>
                <th>Jumlah Unit Rusak Ringan</th>
                <th>Rata-rata Luas Bangunan</th>
                <th>Harga Satuan (Bangunan/m²)</th>
                <th>Harga Satuan Peralatan</th>
                <th>Harga Satuan Meubelair</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Panti Sosial</td>
                <td><input type="number" class="form-control form-control-sm" name="panti_sosial_rb" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_sosial_rs" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_sosial_rr" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_sosial_luas" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_sosial_harga_bangunan" style="min-width: 100px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_sosial_harga_peralatan" style="min-width: 100px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_sosial_harga_meubelair" style="min-width: 100px;"></td>
            </tr>
            <tr>
                <td>Panti Asuhan</td>
                <td><input type="number" class="form-control form-control-sm" name="panti_asuhan_rb" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_asuhan_rs" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_asuhan_rr" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_asuhan_luas" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_asuhan_harga_bangunan" style="min-width: 100px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_asuhan_harga_peralatan" style="min-width: 100px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="panti_asuhan_harga_meubelair" style="min-width: 100px;"></td>
            </tr>
            <tr>
                <td>Balai Pelayanan Sosial</td>
                <td><input type="number" class="form-control form-control-sm" name="balai_pelayanan_rb" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_pelayanan_rs" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_pelayanan_rr" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_pelayanan_luas" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_pelayanan_harga_bangunan" style="min-width: 100px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_pelayanan_harga_peralatan" style="min-width: 100px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_pelayanan_harga_meubelair" style="min-width: 100px;"></td>
            </tr>
            <tr>
                <td>Balai Latihan Sosial</td>
                <td><input type="number" class="form-control form-control-sm" name="balai_latihan_rb" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_latihan_rs" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_latihan_rr" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_latihan_luas" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_latihan_harga_bangunan" style="min-width: 100px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_latihan_harga_peralatan" style="min-width: 100px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="balai_latihan_harga_meubelair" style="min-width: 100px;"></td>
            </tr>
            <tr>
                <td>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Lainnya:</span>
                        <input type="text" class="form-control form-control-sm" name="lainnya_jenis" placeholder="Sebutkan">
                    </div>
                </td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_rb" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_rs" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_rr" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_luas" style="min-width: 80px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_harga_bangunan" style="min-width: 100px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_harga_peralatan" style="min-width: 100px;"></td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_harga_meubelair" style="min-width: 100px;"></td>
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
        <div class="card-header py-1 small fw-bold">2) Kehilangan Pendapatan Unit Pelayanan Sosial</div>
        <div class="card-body py-2">
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text">Rata-rata Pendapatan per Hari</span>
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control form-control-sm" name="pendapatan_perhari" placeholder="0" style="min-width: 120px;">
            </div>
            <div class="input-group input-group-sm">
                <span class="input-group-text">Lama Gangguan Layanan</span>
                <input type="number" class="form-control form-control-sm" name="lama_gangguan" placeholder="0" style="min-width: 100px;">
                <span class="input-group-text">Hari</span>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header py-1 small fw-bold">3) Tambahan Biaya Sosial</div>
        <div class="card-body py-2">
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text">Penanganan Korban Bencana (Tuna Sosial, Anak, Lansia)</span>
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control form-control-sm" name="biaya_penanganan_korban" placeholder="0" style="min-width: 120px;">
            </div>
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text">Bantuan Logistik</span>
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control form-control-sm" name="biaya_logistik" placeholder="0" style="min-width: 120px;">
            </div>
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text">Kebutuhan Pos Pelayanan Sementara</span>
                <input type="number" class="form-control form-control-sm" name="jumlah_pos" placeholder="0" style="min-width: 100px;">
                <span class="input-group-text">Unit</span>
            </div>
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text">Biaya Operasional Pos Pelayanan per Hari</span>
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control form-control-sm" name="biaya_operasional_perhari" placeholder="0" style="min-width: 120px;">
            </div>
            <div class="input-group input-group-sm">
                <span class="input-group-text">Jangka Waktu Operasional</span>
                <input type="number" class="form-control form-control-sm" name="jangka_waktu" placeholder="0" style="min-width: 100px;">
                <span class="input-group-text">Hari</span>
            </div>
        </div>
    </div>
    
    <div class="text-center mt-3 mb-5">
        <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
    </div>
    </form>
</div>
@endsection
