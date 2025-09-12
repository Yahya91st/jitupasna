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

    <form action="{{ isset($edit) && $edit ? route('forms.form4.update-format5', $data->id) : route('forms.form4.store-format5') }}" method="POST">
        @csrf
        @if(isset($edit) && $edit)
            @method('PUT')
        @endif
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">
    
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">NAMA KAMPUNG</span>
                    <input type="text" class="form-control" name="nama_kampung" value="{{ isset($edit) && $edit ? $data->nama_kampung : '' }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">NAMA DISTRIK</span>
                    <input type="text" class="form-control" name="nama_distrik" value="{{ isset($edit) && $edit ? $data->nama_distrik : '' }}" required>
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
                <td><input type="number" class="form-control" name="gereja_rb_negeri" value="{{ isset($edit) && $edit ? $data->gereja_rb_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_rb_swasta" value="{{ isset($edit) && $edit ? $data->gereja_rb_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_rs_negeri" value="{{ isset($edit) && $edit ? $data->gereja_rs_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_rs_swasta" value="{{ isset($edit) && $edit ? $data->gereja_rs_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_rr_negeri" value="{{ isset($edit) && $edit ? $data->gereja_rr_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_rr_swasta" value="{{ isset($edit) && $edit ? $data->gereja_rr_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_luas" value="{{ isset($edit) && $edit ? $data->gereja_luas : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_harga_bangunan" value="{{ isset($edit) && $edit ? $data->gereja_harga_bangunan : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="gereja_harga_peralatan" value="{{ isset($edit) && $edit ? $data->gereja_harga_peralatan : '' }}" style="width: 100%;"></td>
            </tr>            <tr>
                <td>Kapel</td>
                <td><input type="number" class="form-control" name="kapel_rb_negeri" value="{{ isset($edit) && $edit ? $data->kapel_rb_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_rb_swasta" value="{{ isset($edit) && $edit ? $data->kapel_rb_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_rs_negeri" value="{{ isset($edit) && $edit ? $data->kapel_rs_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_rs_swasta" value="{{ isset($edit) && $edit ? $data->kapel_rs_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_rr_negeri" value="{{ isset($edit) && $edit ? $data->kapel_rr_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_rr_swasta" value="{{ isset($edit) && $edit ? $data->kapel_rr_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_luas" value="{{ isset($edit) && $edit ? $data->kapel_luas : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_harga_bangunan" value="{{ isset($edit) && $edit ? $data->kapel_harga_bangunan : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="kapel_harga_peralatan" value="{{ isset($edit) && $edit ? $data->kapel_harga_peralatan : '' }}" style="width: 100%;"></td>
            </tr>            <tr>
                <td>Masjid</td>
                <td><input type="number" class="form-control" name="masjid_rb_negeri" value="{{ isset($edit) && $edit ? $data->masjid_rb_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_rb_swasta" value="{{ isset($edit) && $edit ? $data->masjid_rb_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_rs_negeri" value="{{ isset($edit) && $edit ? $data->masjid_rs_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_rs_swasta" value="{{ isset($edit) && $edit ? $data->masjid_rs_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_rr_negeri" value="{{ isset($edit) && $edit ? $data->masjid_rr_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_rr_swasta" value="{{ isset($edit) && $edit ? $data->masjid_rr_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_luas" value="{{ isset($edit) && $edit ? $data->masjid_luas : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_harga_bangunan" value="{{ isset($edit) && $edit ? $data->masjid_harga_bangunan : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="masjid_harga_peralatan" value="{{ isset($edit) && $edit ? $data->masjid_harga_peralatan : '' }}" style="width: 100%;"></td>
            </tr>            <tr>
                <td>Musholla</td>
                <td><input type="number" class="form-control" name="musholla_rb_negeri" value="{{ isset($edit) && $edit ? $data->musholla_rb_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_rb_swasta" value="{{ isset($edit) && $edit ? $data->musholla_rb_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_rs_negeri" value="{{ isset($edit) && $edit ? $data->musholla_rs_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_rs_swasta" value="{{ isset($edit) && $edit ? $data->musholla_rs_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_rr_negeri" value="{{ isset($edit) && $edit ? $data->musholla_rr_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_rr_swasta" value="{{ isset($edit) && $edit ? $data->musholla_rr_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_luas" value="{{ isset($edit) && $edit ? $data->musholla_luas : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_harga_bangunan" value="{{ isset($edit) && $edit ? $data->musholla_harga_bangunan : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="musholla_harga_peralatan" value="{{ isset($edit) && $edit ? $data->musholla_harga_peralatan : '' }}" style="width: 100%;"></td>
            </tr>            <tr>
                <td>Pura</td>
                <td><input type="number" class="form-control" name="pura_rb_negeri" value="{{ isset($edit) && $edit ? $data->pura_rb_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_rb_swasta" value="{{ isset($edit) && $edit ? $data->pura_rb_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_rs_negeri" value="{{ isset($edit) && $edit ? $data->pura_rs_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_rs_swasta" value="{{ isset($edit) && $edit ? $data->pura_rs_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_rr_negeri" value="{{ isset($edit) && $edit ? $data->pura_rr_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_rr_swasta" value="{{ isset($edit) && $edit ? $data->pura_rr_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_luas" value="{{ isset($edit) && $edit ? $data->pura_luas : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_harga_bangunan" value="{{ isset($edit) && $edit ? $data->pura_harga_bangunan : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="pura_harga_peralatan" value="{{ isset($edit) && $edit ? $data->pura_harga_peralatan : '' }}" style="width: 100%;"></td>
            </tr>            <tr>
                <td>Vihara</td>
                <td><input type="number" class="form-control" name="vihara_rb_negeri" value="{{ isset($edit) && $edit ? $data->vihara_rb_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_rb_swasta" value="{{ isset($edit) && $edit ? $data->vihara_rb_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_rs_negeri" value="{{ isset($edit) && $edit ? $data->vihara_rs_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_rs_swasta" value="{{ isset($edit) && $edit ? $data->vihara_rs_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_rr_negeri" value="{{ isset($edit) && $edit ? $data->vihara_rr_negeri : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_rr_swasta" value="{{ isset($edit) && $edit ? $data->vihara_rr_swasta : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_luas" value="{{ isset($edit) && $edit ? $data->vihara_luas : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_harga_bangunan" value="{{ isset($edit) && $edit ? $data->vihara_harga_bangunan : '' }}" style="width: 100%;"></td>
                <td><input type="number" class="form-control" name="vihara_harga_peralatan" value="{{ isset($edit) && $edit ? $data->vihara_harga_peralatan : '' }}" style="width: 100%;"></td>
            </tr>
        </tbody>
    </table>

    <p><strong>B. Perkiraan Kerugian</strong></p>
    
    <div class="card mb-3">
        <div class="card-header py-1 small fw-bold">1) Biaya Pembersihan Puing</div>
        <div class="card-body py-2">
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text">A. Biaya Tenaga Kerja</span>
                <input type="number" class="form-control" name="biaya_tenaga_kerja_hok" value="{{ isset($edit) && $edit ? $data->biaya_tenaga_kerja_hok : '' }}" placeholder="HOK" style="width: 100%;">
                <span class="input-group-text">x Rp</span>
                <input type="number" class="form-control" name="biaya_tenaga_kerja_upah" value="{{ isset($edit) && $edit ? $data->biaya_tenaga_kerja_upah : '' }}" placeholder="Upah" style="width: 100%;">
            </div>
            <div class="input-group input-group-sm">
                <span class="input-group-text">B. Biaya Alat Berat</span>
                <input type="number" class="form-control" name="biaya_alat_berat_hari" value="{{ isset($edit) && $edit ? $data->biaya_alat_berat_hari : '' }}" placeholder="Hari" style="width: 100%;">
                <span class="input-group-text">x Rp</span>
                <input type="number" class="form-control" name="biaya_alat_berat_harga" value="{{ isset($edit) && $edit ? $data->biaya_alat_berat_harga : '' }}" placeholder="Sewa/Hari" style="width: 100%;">
            </div>
        </div>
    </div>
    
    <div class="text-center mt-3 mb-5">
        <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
    </div>
    </form>
    
    <!-- Total Calculation Display -->
    <div class="card mt-3 mb-4">
        <div class="card-header py-2 small fw-bold">Ringkasan Perhitungan</div>
        <div class="card-body py-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-info py-2 mb-2">
                        <strong>Total Kerusakan:</strong> <span id="totalKerusakan">Rp 0</span>
                        <br><small class="text-muted">Termasuk kerusakan bangunan + biaya pembersihan</small>
                        <br><small class="text-warning"><strong>Catatan:</strong> Tidak menggunakan luas & peralatan dalam perhitungan</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-warning py-2 mb-2">
                        <strong>Total Kerugian:</strong> <span id="totalKerugian">Rp 0</span>
                        <br><small class="text-muted">Sesuai aturan: semua masuk ke kerusakan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-calculate when input changes
    const inputs = document.querySelectorAll('input[type="number"]');
    inputs.forEach(input => {
        input.addEventListener('input', calculateTotal);
    });
    
    // Initial calculation
    calculateTotal();
    
    function calculateTotal() {
        let totalKerusakan = 0;
        
        // Daftar jenis bangunan ibadah
        const jenisIbadah = ['gereja', 'kapel', 'masjid', 'musholla', 'pura', 'vihara'];
        
        jenisIbadah.forEach(jenis => {
            // Hitung total unit kerusakan
            const rbNegeri = parseFloat(document.querySelector(`input[name="${jenis}_rb_negeri"]`)?.value || 0);
            const rbSwasta = parseFloat(document.querySelector(`input[name="${jenis}_rb_swasta"]`)?.value || 0);
            const rsNegeri = parseFloat(document.querySelector(`input[name="${jenis}_rs_negeri"]`)?.value || 0);
            const rsSwasta = parseFloat(document.querySelector(`input[name="${jenis}_rs_swasta"]`)?.value || 0);
            const rrNegeri = parseFloat(document.querySelector(`input[name="${jenis}_rr_negeri"]`)?.value || 0);
            const rrSwasta = parseFloat(document.querySelector(`input[name="${jenis}_rr_swasta"]`)?.value || 0);
            
            const totalUnit = rbNegeri + rbSwasta + rsNegeri + rsSwasta + rrNegeri + rrSwasta;
            
            // TIDAK menggunakan luas dan peralatan dalam perhitungan sesuai permintaan
            // const luas = parseFloat(document.querySelector(`input[name="${jenis}_luas"]`)?.value || 0);
            const hargaBangunan = parseFloat(document.querySelector(`input[name="${jenis}_harga_bangunan"]`)?.value || 0);
            // const hargaPeralatan = parseFloat(document.querySelector(`input[name="${jenis}_harga_peralatan"]`)?.value || 0); // TIDAK DIGUNAKAN
            
            // Kerusakan = HANYA (total unit * harga bangunan)
            // TANPA mengalikan dengan luas dan TANPA harga peralatan
            totalKerusakan += (totalUnit * hargaBangunan);
        });
        
        // Tambahkan biaya pembersihan puing (kerugian masuk ke kerusakan)
        const biayaTenagaKerjaHok = parseFloat(document.querySelector('input[name="biaya_tenaga_kerja_hok"]')?.value || 0);
        const biayaTenagaKerjaUpah = parseFloat(document.querySelector('input[name="biaya_tenaga_kerja_upah"]')?.value || 0);
        const biayaAlatBeratHari = parseFloat(document.querySelector('input[name="biaya_alat_berat_hari"]')?.value || 0);
        const biayaAlatBeratHarga = parseFloat(document.querySelector('input[name="biaya_alat_berat_harga"]')?.value || 0);
        
        const biayaTenagaKerja = biayaTenagaKerjaHok * biayaTenagaKerjaUpah;
        const biayaAlatBerat = biayaAlatBeratHari * biayaAlatBeratHarga;
        
        totalKerusakan += biayaTenagaKerja + biayaAlatBerat;
        
        // Update display
        document.getElementById('totalKerusakan').textContent = 'Rp ' + totalKerusakan.toLocaleString('id-ID');
        document.getElementById('totalKerugian').textContent = 'Rp 0'; // Sesuai aturan
    }
});
</script>
@endsection

