@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel dan input agar lebih kompak */
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
        padding: 0.15rem 0.5rem !important;
        font-size: 0.95rem;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
    }
    .input-group input.form-control {
        text-align: right;
    }
    .input-group-currency input.form-control {
        text-align: right;
    }
    .table-bordered > :not(caption) > * {
        border-width: 1px 0;
    }
    .table-bordered > :not(caption) > * > * {
        border-width: 0 1px;
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
    
            <table class="table table-bordered">
            <tr>
                <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
            </tr>
        </table>

    <tr>
        <td colspan="10" class="bg-secondary text-white">A. KERUSAKAN BANGUNAN IBADAH</td>
    </tr>
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle" style="width: 100%;">
        <thead>
            <tr class="bg-secondary text-white">
                <th rowspan="2" class="align-middle" style="width: 15%">Jenis Bangunan Ibadah</th>
                <th colspan="6" class="text-center" style="width: 40%">Jumlah Unit Rusak</th>
                <th rowspan="2" class="align-middle" style="width: 15%">Rata-Rata Luas Bangunan (m²)</th>
                <th colspan="2" class="text-center" style="width: 30%">Harga Satuan</th>
            </tr>
            <tr class="bg-secondary text-white">
                <th class="text-center" style="width: 6.67%">Berat Negeri</th>
                <th class="text-center" style="width: 6.67%">Berat Swasta</th>
                <th class="text-center" style="width: 6.67%">Sedang Negeri</th>
                <th class="text-center" style="width: 6.67%">Sedang Swasta</th>
                <th class="text-center" style="width: 6.67%">Ringan Negeri</th>
                <th class="text-center" style="width: 6.67%">Ringan Swasta</th>
                <th class="text-center" style="width: 15%">Bangunan/m²</th>
                <th class="text-center" style="width: 15%">Peralatan Keagamaan</th>
            </tr>
        </thead>
        <tbody>            <tr>
                <td class="fw-bold">Gereja</td>
                <td><input type="number" class="form-control form-control-sm text-end" name="gereja_rb_negeri" value="{{ isset($edit) && $edit ? $data->gereja_rb_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="gereja_rb_swasta" value="{{ isset($edit) && $edit ? $data->gereja_rb_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="gereja_rs_negeri" value="{{ isset($edit) && $edit ? $data->gereja_rs_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="gereja_rs_swasta" value="{{ isset($edit) && $edit ? $data->gereja_rs_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="gereja_rr_negeri" value="{{ isset($edit) && $edit ? $data->gereja_rr_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="gereja_rr_swasta" value="{{ isset($edit) && $edit ? $data->gereja_rr_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="gereja_luas" value="{{ isset($edit) && $edit ? $data->gereja_luas : '' }}"></td>
                <td><div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control form-control-sm text-end" name="gereja_harga_bangunan" value="{{ isset($edit) && $edit ? $data->gereja_harga_bangunan : '' }}">
                </div></td>
                <td><div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control form-control-sm text-end" name="gereja_harga_peralatan" value="{{ isset($edit) && $edit ? $data->gereja_harga_peralatan : '' }}">
                </div></td>
            </tr>            <tr>
                <td class="fw-bold">Kapel</td>
                <td><input type="number" class="form-control form-control-sm text-end" name="kapel_rb_negeri" value="{{ isset($edit) && $edit ? $data->kapel_rb_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="kapel_rb_swasta" value="{{ isset($edit) && $edit ? $data->kapel_rb_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="kapel_rs_negeri" value="{{ isset($edit) && $edit ? $data->kapel_rs_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="kapel_rs_swasta" value="{{ isset($edit) && $edit ? $data->kapel_rs_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="kapel_rr_negeri" value="{{ isset($edit) && $edit ? $data->kapel_rr_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="kapel_rr_swasta" value="{{ isset($edit) && $edit ? $data->kapel_rr_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="kapel_luas" value="{{ isset($edit) && $edit ? $data->kapel_luas : '' }}"></td>
                <td><div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control form-control-sm text-end" name="kapel_harga_bangunan" value="{{ isset($edit) && $edit ? $data->kapel_harga_bangunan : '' }}">
                </div></td>
                <td><div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control form-control-sm text-end" name="kapel_harga_peralatan" value="{{ isset($edit) && $edit ? $data->kapel_harga_peralatan : '' }}">
                </div></td>
            </tr>            <tr>
                <td class="fw-bold">Masjid</td>
                <td><input type="number" class="form-control form-control-sm text-end" name="masjid_rb_negeri" value="{{ isset($edit) && $edit ? $data->masjid_rb_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="masjid_rb_swasta" value="{{ isset($edit) && $edit ? $data->masjid_rb_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="masjid_rs_negeri" value="{{ isset($edit) && $edit ? $data->masjid_rs_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="masjid_rs_swasta" value="{{ isset($edit) && $edit ? $data->masjid_rs_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="masjid_rr_negeri" value="{{ isset($edit) && $edit ? $data->masjid_rr_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="masjid_rr_swasta" value="{{ isset($edit) && $edit ? $data->masjid_rr_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="masjid_luas" value="{{ isset($edit) && $edit ? $data->masjid_luas : '' }}"></td>
                <td><div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control form-control-sm text-end" name="masjid_harga_bangunan" value="{{ isset($edit) && $edit ? $data->masjid_harga_bangunan : '' }}">
                </div></td>
                <td><div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control form-control-sm text-end" name="masjid_harga_peralatan" value="{{ isset($edit) && $edit ? $data->masjid_harga_peralatan : '' }}">
                </div></td>
            </tr>            <tr>
                <td class="fw-bold">Musholla</td>
                <td><input type="number" class="form-control form-control-sm text-end" name="musholla_rb_negeri" value="{{ isset($edit) && $edit ? $data->musholla_rb_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="musholla_rb_swasta" value="{{ isset($edit) && $edit ? $data->musholla_rb_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="musholla_rs_negeri" value="{{ isset($edit) && $edit ? $data->musholla_rs_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="musholla_rs_swasta" value="{{ isset($edit) && $edit ? $data->musholla_rs_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="musholla_rr_negeri" value="{{ isset($edit) && $edit ? $data->musholla_rr_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="musholla_rr_swasta" value="{{ isset($edit) && $edit ? $data->musholla_rr_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="musholla_luas" value="{{ isset($edit) && $edit ? $data->musholla_luas : '' }}"></td>
                <td><div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control form-control-sm text-end" name="musholla_harga_bangunan" value="{{ isset($edit) && $edit ? $data->musholla_harga_bangunan : '' }}">
                </div></td>
                <td><div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control form-control-sm text-end" name="musholla_harga_peralatan" value="{{ isset($edit) && $edit ? $data->musholla_harga_peralatan : '' }}">
                </div></td>
            </tr>            <tr>
                <td class="fw-bold">Pura</td>
                <td><input type="number" class="form-control form-control-sm text-end" name="pura_rb_negeri" value="{{ isset($edit) && $edit ? $data->pura_rb_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="pura_rb_swasta" value="{{ isset($edit) && $edit ? $data->pura_rb_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="pura_rs_negeri" value="{{ isset($edit) && $edit ? $data->pura_rs_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="pura_rs_swasta" value="{{ isset($edit) && $edit ? $data->pura_rs_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="pura_rr_negeri" value="{{ isset($edit) && $edit ? $data->pura_rr_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="pura_rr_swasta" value="{{ isset($edit) && $edit ? $data->pura_rr_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="pura_luas" value="{{ isset($edit) && $edit ? $data->pura_luas : '' }}"></td>
                <td><div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control form-control-sm text-end" name="pura_harga_bangunan" value="{{ isset($edit) && $edit ? $data->pura_harga_bangunan : '' }}">
                </div></td>
                <td><div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control form-control-sm text-end" name="pura_harga_peralatan" value="{{ isset($edit) && $edit ? $data->pura_harga_peralatan : '' }}">
                </div></td>
            </tr>            <tr>
                <td class="fw-bold">Vihara</td>
                <td><input type="number" class="form-control form-control-sm text-end" name="vihara_rb_negeri" value="{{ isset($edit) && $edit ? $data->vihara_rb_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="vihara_rb_swasta" value="{{ isset($edit) && $edit ? $data->vihara_rb_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="vihara_rs_negeri" value="{{ isset($edit) && $edit ? $data->vihara_rs_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="vihara_rs_swasta" value="{{ isset($edit) && $edit ? $data->vihara_rs_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="vihara_rr_negeri" value="{{ isset($edit) && $edit ? $data->vihara_rr_negeri : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="vihara_rr_swasta" value="{{ isset($edit) && $edit ? $data->vihara_rr_swasta : '' }}"></td>
                <td><input type="number" class="form-control form-control-sm text-end" name="vihara_luas" value="{{ isset($edit) && $edit ? $data->vihara_luas : '' }}"></td>
                <td><div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control form-control-sm text-end" name="vihara_harga_bangunan" value="{{ isset($edit) && $edit ? $data->vihara_harga_bangunan : '' }}">
                </div></td>
                <td><div class="input-group input-group-sm">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control form-control-sm text-end" name="vihara_harga_peralatan" value="{{ isset($edit) && $edit ? $data->vihara_harga_peralatan : '' }}">
                </div></td>
            </tr>
        </tbody>
    </table>

    <tr>
        <td colspan="10" class="bg-secondary text-white">B. PERKIRAAN KERUGIAN</td>
    </tr>
    
    <div class="card mb-3">
        <div class="card-header py-1 small fw-bold">1) Biaya Pembersihan Puing</div>
        <div class="card-body py-2">
            <div class="input-group input-group-sm mb-2">
                <span class="input-group-text">A. Biaya Tenaga Kerja</span>
                <input type="number" class="form-control" name="biaya_tenaga_kerja_hok" value="{{ isset($edit) && $edit ? $data->biaya_tenaga_kerja_hok : '' }}" placeholder="HOK" style="width: 100%;">
                <span class="input-group-text">x</span>
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control text-end" name="biaya_tenaga_kerja_upah" value="{{ isset($edit) && $edit ? $data->biaya_tenaga_kerja_upah : '' }}" placeholder="Upah" style="width: 100%;">
            </div>
            <div class="input-group input-group-sm">
                <span class="input-group-text">B. Biaya Alat Berat</span>
                <input type="number" class="form-control" name="biaya_alat_berat_hari" value="{{ isset($edit) && $edit ? $data->biaya_alat_berat_hari : '' }}" placeholder="Hari" style="width: 100%;">
                <span class="input-group-text">x</span>
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control text-end" name="biaya_alat_berat_harga" value="{{ isset($edit) && $edit ? $data->biaya_alat_berat_harga : '' }}" placeholder="Sewa/Hari" style="width: 100%;">
            </div>
        </div>
    </div>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
        <a href="{{ route('forms.form4.index', ['bencana_id' => request()->query('bencana_id')]) }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </div>
    </form>
    
    <!-- Total Calculation Display -->
    <div class="card mt-4">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Total Kerusakan dan Kerugian (Otomatis)</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="alert alert-primary mb-0">
                        <div class="d-flex flex-column align-items-center">
                            <h4 class="mb-1" id="totalKerusakan">Rp 0</h4>
                            <div class="text-center">
                                <strong>Total Kerusakan</strong>
                                <div class="small text-muted">Termasuk kerusakan bangunan + biaya pembersihan</div>
                                <div class="small text-danger"><strong>Catatan:</strong> Tidak menggunakan luas & peralatan dalam perhitungan</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-warning mb-0">
                        <div class="d-flex flex-column align-items-center">
                            <h4 class="mb-1" id="totalKerugian">Rp 0</h4>
                            <div class="text-center">
                                <strong>Total Kerugian</strong>
                                <div class="small text-muted">Sesuai aturan: semua masuk ke kerusakan</div>
                            </div>
                        </div>
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

