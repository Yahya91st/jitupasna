@extends('layouts.main')

@section('content')
<div class="container mt-4">    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 6: Sarana dan Prasarana Air Minum & Sanitasi</p>
    
    <form action="{{ route('forms.form4.store-format6') }}" method="POST">
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

    <p><strong>A. Kerusakan Sarana Air Minum</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Komponen</th>
                <th>Jumlah Kerusakan Unit</th>
                <th>Harga Satuan</th>
                <th>Total Biaya</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Struktur Pengambilan Air</td>
                <td><input type="number" class="form-control form-control-sm" name="struktur_air_jumlah" min="0" step="1"></td>
                <td><input type="number" class="form-control form-control-sm" name="struktur_air_harga" min="0"></td>
                <td><input type="number" class="form-control form-control-sm" name="struktur_air_total" min="0" readonly></td>
            </tr>
            <tr>
                <td>Instalasi Pemurnian Air</td>
                <td><input type="number" class="form-control form-control-sm" name="instalasi_pemurnian_jumlah" min="0" step="1"></td>
                <td><input type="number" class="form-control form-control-sm" name="instalasi_pemurnian_harga" min="0"></td>
                <td><input type="number" class="form-control form-control-sm" name="instalasi_pemurnian_total" min="0" readonly></td>
            </tr>
            <tr>
                <td>Sistem Perpipaan</td>
                <td><input type="number" class="form-control form-control-sm" name="perpipaan_jumlah" min="0" step="1"></td>
                <td><input type="number" class="form-control form-control-sm" name="perpipaan_harga" min="0"></td>
                <td><input type="number" class="form-control form-control-sm" name="perpipaan_total" min="0" readonly></td>
            </tr>
            <tr>
                <td>Sistem Penyimpanan</td>
                <td><input type="number" class="form-control form-control-sm" name="penyimpanan_jumlah" min="0" step="1"></td>
                <td><input type="number" class="form-control form-control-sm" name="penyimpanan_harga" min="0"></td>
                <td><input type="number" class="form-control form-control-sm" name="penyimpanan_total" min="0" readonly></td>
            </tr>
            <tr>
                <td>Sumur</td>
                <td><input type="number" class="form-control form-control-sm" name="sumur_jumlah" min="0" step="1"></td>
                <td><input type="number" class="form-control form-control-sm" name="sumur_harga" min="0"></td>
                <td><input type="number" class="form-control form-control-sm" name="sumur_total" min="0" readonly></td>
            </tr>
            <tr>
                <td>WC Umum</td>
                <td><input type="number" class="form-control form-control-sm" name="wc_umum_jumlah" min="0" step="1"></td>
                <td><input type="number" class="form-control form-control-sm" name="wc_umum_harga" min="0"></td>
                <td><input type="number" class="form-control form-control-sm" name="wc_umum_total" min="0" readonly></td>
            </tr>
            <tr>
                <td><input type="text" class="form-control form-control-sm" name="lainnya_jenis_sarana" placeholder="Lainnya:"></td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_sarana_jumlah" min="0" step="1"></td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_sarana_harga" min="0"></td>
                <td><input type="number" class="form-control form-control-sm" name="lainnya_sarana_total" min="0" readonly></td>
            </tr>
        </tbody>
    </table>

    <p><strong>B. Kerusakan Sistem Sanitasi</strong></p>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>Komponen</th>
                <th>Jumlah Kerusakan Unit</th>
                <th>Harga Satuan</th>
                <th>Total Biaya</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Jaringan Pembuangan</td>
                <td><input type="number" class="form-control form-control-sm" name="jaringan_pembuangan_jumlah" min="0" step="1"></td>
                <td><input type="number" class="form-control form-control-sm" name="jaringan_pembuangan_harga" min="0"></td>
                <td><input type="number" class="form-control form-control-sm" name="jaringan_pembuangan_total" min="0" readonly></td>
            </tr>
            <tr>
                <td>Septic Tank</td>
                <td><input type="number" class="form-control form-control-sm" name="septic_tank_jumlah" min="0" step="1"></td>
                <td><input type="number" class="form-control form-control-sm" name="septic_tank_harga" min="0"></td>
                <td><input type="number" class="form-control form-control-sm" name="septic_tank_total" min="0" readonly></td>
            </tr>
            <tr>
                <td>Sistem Pengumpulan Limbah Padat</td>
                <td><input type="number" class="form-control form-control-sm" name="limbah_padat_jumlah" min="0" step="1"></td>
                <td><input type="number" class="form-control form-control-sm" name="limbah_padat_harga" min="0"></td>
                <td><input type="number" class="form-control form-control-sm" name="limbah_padat_total" min="0" readonly></td>
            </tr>
        </tbody>
    </table>

    <h6 class="fw-bold mt-4">Perkiraan Dampak Ekonomi</h6>
    <p><strong>A. Kehilangan Pendapatan Instansi Terkait:</strong> Rp <input type="number" class="form-control-sm" name="kehilangan_pendapatan" min="0" style="width: 150px;"> / bulan</p>

    <p><strong>B. Kenaikan Biaya:</strong></p>
    <ul>
        <li>Biaya Pemurnian Air Tambahan: Rp <input type="number" class="form-control-sm" name="biaya_pemurnian" min="0" style="width: 150px;"></li>
        <li>Biaya Distribusi Air Tambahan: Rp <input type="number" class="form-control-sm" name="biaya_distribusi" min="0" style="width: 150px;"></li>
        <li>Biaya Pembersihan Sumur: Rp <input type="number" class="form-control-sm" name="biaya_pembersihan_sumur" min="0" style="width: 150px;"></li>
        <li>Biaya Bahan Kimia Tambahan: Rp <input type="number" class="form-control-sm" name="biaya_bahan_kimia" min="0" style="width: 150px;"></li>
        <li>Lain-lain (<input type="text" class="form-control-sm" name="biaya_lainnya_keterangan" placeholder="sebutkan" style="width: 150px;">): 
            Rp <input type="number" class="form-control-sm" name="biaya_lainnya" min="0" style="width: 150px;"></li>
    </ul>

    <p><strong>C. Jangka Waktu Pemulihan:</strong></p>
    <ul>
        <li>Rehabilitasi: <input type="number" class="form-control-sm" name="rehabilitasi_bulan" min="0" step="1" style="width: 80px;"> bulan</li>
        <li>Rekonstruksi: <input type="number" class="form-control-sm" name="rekonstruksi_bulan" min="0" step="1" style="width: 80px;"> bulan</li>
    </ul>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <a href="{{ route('forms.form4.index', ['bencana_id' => request()->query('bencana_id')]) }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto calculate totals for air minum section
    const airComponents = [
        { jumlah: 'struktur_air_jumlah', harga: 'struktur_air_harga', total: 'struktur_air_total' },
        { jumlah: 'instalasi_pemurnian_jumlah', harga: 'instalasi_pemurnian_harga', total: 'instalasi_pemurnian_total' },
        { jumlah: 'perpipaan_jumlah', harga: 'perpipaan_harga', total: 'perpipaan_total' },
        { jumlah: 'penyimpanan_jumlah', harga: 'penyimpanan_harga', total: 'penyimpanan_total' },
        { jumlah: 'sumur_jumlah', harga: 'sumur_harga', total: 'sumur_total' },
        { jumlah: 'wc_umum_jumlah', harga: 'wc_umum_harga', total: 'wc_umum_total' },
        { jumlah: 'lainnya_sarana_jumlah', harga: 'lainnya_sarana_harga', total: 'lainnya_sarana_total' },
    ];
    
    // Auto calculate totals for sanitasi section
    const sanitasiComponents = [
        { jumlah: 'jaringan_pembuangan_jumlah', harga: 'jaringan_pembuangan_harga', total: 'jaringan_pembuangan_total' },
        { jumlah: 'septic_tank_jumlah', harga: 'septic_tank_harga', total: 'septic_tank_total' },
        { jumlah: 'limbah_padat_jumlah', harga: 'limbah_padat_harga', total: 'limbah_padat_total' },
    ];
    
    // Function to set up auto-calculation for a component
    function setupAutoCalculation(component) {
        const jumlahInput = document.querySelector(`[name="${component.jumlah}"]`);
        const hargaInput = document.querySelector(`[name="${component.harga}"]`);
        const totalInput = document.querySelector(`[name="${component.total}"]`);
        
        function calculateTotal() {
            const jumlah = parseFloat(jumlahInput.value) || 0;
            const harga = parseFloat(hargaInput.value) || 0;
            totalInput.value = jumlah * harga;
        }
        
        jumlahInput.addEventListener('input', calculateTotal);
        hargaInput.addEventListener('input', calculateTotal);
    }
    
    // Setup auto-calculation for all components
    airComponents.forEach(setupAutoCalculation);
    sanitasiComponents.forEach(setupAutoCalculation);
});
</script>
@endsection
