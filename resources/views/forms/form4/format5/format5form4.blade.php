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
    .input-group-text {
        padding: 0.2rem 0.5rem !important;
        font-size: 0.9rem;
    }
</style>
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 5: Pengumpulan Data Sektor Keagamaan</p>

    <form action="{{ route('forms.form4.store-format5') }}" method="POST">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">
    
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">NAMA KAMPUNG</span>
                    <input type="text" class="form-control" name="nama_kampung" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">NAMA DISTRIK</span>
                    <input type="text" class="form-control" name="nama_distrik" required>
                </div>
            </div>
        </div>

    <p><strong>A. Kerusakan Bangunan Ibadah</strong></p>    
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle" style="width: 100%;">
        <thead>
            <tr>
                <th rowspan="2">Jenis Bangunan Ibadah</th>
                <th colspan="6">Jumlah Unit Rusak</th>
                <th rowspan="2">Rata-Rata Luas Bangunan (m²)</th>
                <th colspan="2">Harga Satuan</th>
            </tr>
            <tr>
                <th>Berat Negeri</th>
                <th>Berat Swasta</th>
                <th>Sedang Negeri</th>
                <th>Sedang Swasta</th>
                <th>Ringan Negeri</th>
                <th>Ringan Swasta</th>
                <th>Bangunan/m²</th>
                <th>Peralatan Keagamaan</th>
            </tr>
        </thead>
        <tbody>            <tr>
                <td>Gereja</td>
                <td><input type="number" class="form-control" name="gereja_rb_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_rb_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_rs_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_rs_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_rr_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_rr_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_luas" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_harga_bangunan" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_harga_peralatan" style="width: 100%;"></td>
            </tr>            <tr>
                <td>Kapel</td>
                <td><input type="number" class="form-control" name="kapel_rb_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_rb_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_rs_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_rs_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_rr_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_rr_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_luas" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_harga_bangunan" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_harga_peralatan" style="width: 100%;"></td>
            </tr>            <tr>
                <td>Masjid</td>
                <td><input type="number" class="form-control" name="masjid_rb_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_rb_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_rs_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_rs_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_rr_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_rr_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_luas" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_harga_bangunan" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_harga_peralatan" style="width: 100%;"></td>
            </tr>            <tr>
                <td>Musholla</td>
                <td><input type="number" class="form-control" name="musholla_rb_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_rb_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_rs_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_rs_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_rr_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_rr_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_luas" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_harga_bangunan" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_harga_peralatan" style="width: 100%;"></td>
            </tr>            <tr>
                <td>Pura</td>
                <td><input type="number" class="form-control" name="pura_rb_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_rb_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_rs_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_rs_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_rr_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_rr_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_luas" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_harga_bangunan" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_harga_peralatan" style="width: 100%;"></td>
            </tr>            <tr>
                <td>Vihara</td>
                <td><input type="number" class="form-control" name="vihara_rb_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_rb_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_rs_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_rs_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_rr_negeri" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_rr_swasta" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_luas" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_harga_bangunan" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_harga_peralatan" style="width: 100%;"></td>
            </tr>
        </tbody>
    </table>

    <p><strong>B. Perkiraan Kerugian</strong></p>
    
    <div class="card mb-3">
        <div class="card-header py-1 small fw-bold">1) Biaya Pembersihan Puing</div>
        <div class="card-body py-2">
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text">A. Biaya Tenaga Kerja</span>
                <input type="number" class="form-control" name="biaya_tenaga_kerja_hok" placeholder="HOK" style="width: 100%;">
                <span class="input-group-text">x Rp</span>
                <input type="number" class="form-control" name="biaya_tenaga_kerja_upah" placeholder="Upah" style="width: 100%;">
            </div>
            <div class="input-group input-group-sm">
                <span class="input-group-text">B. Biaya Alat Berat</span>
                <input type="number" class="form-control" name="biaya_alat_berat_hari" placeholder="Hari" style="width: 100%;">
                <span class="input-group-text">x Rp</span>
                <input type="number" class="form-control" name="biaya_alat_berat_harga" placeholder="Sewa/Hari" style="width: 100%;">
            </div>
        </div>
    </div>
    
    <div class="text-center mt-3 mb-5">
        <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
    </div>
    </form>
</div>
@endsection

