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
        <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
        <p class="fw-bold">Format 1a: Pengumpulan Data Sektor Perumahan</p>
        
        <form action="{{ isset($edit) && $edit ? route('forms.form4.format1.update', $data->id) : route('forms.form4.format1.store') }}" method="POST">
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

        <table class="table table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th rowspan="2">Perkiraan Kerusakan</th>
                    <th colspan="3">Jumlah Rumah</th>
                    <th colspan="2">Harga Satuan</th>
                </tr>
                <tr>
                    <th>Rumah Permanen</th>
                    <th>Rumah Non Permanen</th>
                    <th>Jumlah</th>
                    <th>Permanen</th>
                    <th>Non Permanen</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1a) JUMLAH RUMAH HANCUR TOTAL</td>
                    <td><input type="number" class="form-control" name="rumah_hancur_total_permanen" placeholder="0" value="{{ old('rumah_hancur_total_permanen', $data->rumah_hancur_total_permanen ?? '') }}"></td>
                    <td><input type="number" class="form-control" name="rumah_hancur_total_non_permanen" placeholder="0" value="{{ old('rumah_hancur_total_non_permanen', $data->rumah_hancur_total_non_permanen ?? '') }}"></td>
                    <td><input type="number" class="form-control" name="hancur_total_jumlah" placeholder="0" value="{{ ($data->rumah_hancur_total_permanen ?? 0) + ($data->rumah_hancur_total_non_permanen ?? 0) }}" readonly></td>
                    <td><input type="number" class="form-control" name="harga_satuan_hancur_total_permanen" placeholder="0" value="{{ old('harga_satuan_hancur_total_permanen', $data->harga_satuan_hancur_total_permanen ?? '') }}"></td>
                    <td><input type="number" class="form-control" name="harga_satuan_hancur_total_non_permanen" placeholder="0" value="{{ old('harga_satuan_hancur_total_non_permanen', $data->harga_satuan_hancur_total_non_permanen ?? '') }}"></td>
                </tr>
                <tr>
                    <td>1b) JUMLAH RUMAH RUSAK BERAT</td>
                    <td><input type="number" class="form-control" name="rumah_rusak_berat_permanen" placeholder="0" value="{{ old('rumah_rusak_berat_permanen', $data->rumah_rusak_berat_permanen ?? '') }}"></td>
                    <td><input type="number" class="form-control" name="rumah_rusak_berat_non_permanen" placeholder="0" value="{{ old('rumah_rusak_berat_non_permanen', $data->rumah_rusak_berat_non_permanen ?? '') }}"></td>
                    <td><input type="number" class="form-control" name="rusak_berat_jumlah" placeholder="0" value="{{ ($data->rumah_rusak_berat_permanen ?? 0) + ($data->rumah_rusak_berat_non_permanen ?? 0) }}" readonly></td>
                    <td><input type="number" class="form-control" name="harga_satuan_rusak_berat_permanen" placeholder="0" value="{{ old('harga_satuan_rusak_berat_permanen', $data->harga_satuan_rusak_berat_permanen ?? '') }}"></td>
                    <td><input type="number" class="form-control" name="harga_satuan_rusak_berat_non_permanen" placeholder="0" value="{{ old('harga_satuan_rusak_berat_non_permanen', $data->harga_satuan_rusak_berat_non_permanen ?? '') }}"></td>
                </tr>
                <tr>
                    <td>1c) JUMLAH RUMAH RUSAK SEDANG</td>
                    <td><input type="number" class="form-control" name="rumah_rusak_sedang_permanen" placeholder="0" value="{{ old('rumah_rusak_sedang_permanen', $data->rumah_rusak_sedang_permanen ?? '') }}"></td>
                    <td><input type="number" class="form-control" name="rumah_rusak_sedang_non_permanen" placeholder="0" value="{{ old('rumah_rusak_sedang_non_permanen', $data->rumah_rusak_sedang_non_permanen ?? '') }}"></td>
                    <td><input type="number" class="form-control" name="rusak_sedang_jumlah" placeholder="0" value="{{ ($data->rumah_rusak_sedang_permanen ?? 0) + ($data->rumah_rusak_sedang_non_permanen ?? 0) }}" readonly></td>
                    <td><input type="number" class="form-control" name="harga_satuan_rusak_sedang_permanen" placeholder="0" value="{{ old('harga_satuan_rusak_sedang_permanen', $data->harga_satuan_rusak_sedang_permanen ?? '') }}"></td>
                    <td><input type="number" class="form-control" name="harga_satuan_rusak_sedang_non_permanen" placeholder="0" value="{{ old('harga_satuan_rusak_sedang_non_permanen', $data->harga_satuan_rusak_sedang_non_permanen ?? '') }}"></td>
                </tr>
                <tr>
                    <td>1d) JUMLAH RUMAH RUSAK RINGAN</td>
                    <td><input type="number" class="form-control" name="rumah_rusak_ringan_permanen" placeholder="0" value="{{ old('rumah_rusak_ringan_permanen', $data->rumah_rusak_ringan_permanen ?? '') }}"></td>
                    <td><input type="number" class="form-control" name="rumah_rusak_ringan_non_permanen" placeholder="0" value="{{ old('rumah_rusak_ringan_non_permanen', $data->rumah_rusak_ringan_non_permanen ?? '') }}"></td>
                    <td><input type="number" class="form-control" name="rusak_ringan_jumlah" placeholder="0" value="{{ ($data->rumah_rusak_ringan_permanen ?? 0) + ($data->rumah_rusak_ringan_non_permanen ?? 0) }}" readonly></td>
                    <td><input type="number" class="form-control" name="harga_satuan_rusak_ringan_permanen" placeholder="0" value="{{ old('harga_satuan_rusak_ringan_permanen', $data->harga_satuan_rusak_ringan_permanen ?? '') }}"></td>
                    <td><input type="number" class="form-control" name="harga_satuan_rusak_ringan_non_permanen" placeholder="0" value="{{ old('harga_satuan_rusak_ringan_non_permanen', $data->harga_satuan_rusak_ringan_non_permanen ?? '') }}"></td>
                </tr>
            </tbody>
        </table>

        <p class="fw-bold mt-4">2. KERUSAKAN PRASARANA LINGKUNGAN</p>
        <p><strong>2.1 JALAN LINGKUNGAN</strong><br>
            Rusak berat: <input type="number" class="form-control d-inline-block" name="jalan_rusak_berat" placeholder="0" style="width: 150px;" value="{{ old('jalan_rusak_berat', $data->jalan_rusak_berat ?? '') }}"> m²<br>
            Rusak sedang: <input type="number" class="form-control d-inline-block" name="jalan_rusak_sedang" placeholder="0" style="width: 150px;" value="{{ old('jalan_rusak_sedang', $data->jalan_rusak_sedang ?? '') }}"> m²<br>
            Rusak ringan: <input type="number" class="form-control d-inline-block" name="jalan_rusak_ringan" placeholder="0" style="width: 150px;" value="{{ old('jalan_rusak_ringan', $data->jalan_rusak_ringan ?? '') }}"> m²<br>
            Harga Satuan/M²: Rp <input type="number" class="form-control d-inline-block" name="harga_satuan_jalan" placeholder="0" style="width: 150px;" value="{{ old('harga_satuan_jalan', $data->harga_satuan_jalan ?? '') }}">
        </p>

        <p><strong>2.2 SALURAN AIR/GORONG-GORONG</strong><br>
            Rusak berat: <input type="number" class="form-control d-inline-block" name="saluran_rusak_berat" placeholder="0" style="width: 150px;" value="{{ old('saluran_rusak_berat', $data->saluran_rusak_berat ?? '') }}"> m²<br>
            Rusak sedang: <input type="number" class="form-control d-inline-block" name="saluran_rusak_sedang" placeholder="0" style="width: 150px;" value="{{ old('saluran_rusak_sedang', $data->saluran_rusak_sedang ?? '') }}"> m²<br>
            Rusak ringan: <input type="number" class="form-control d-inline-block" name="saluran_rusak_ringan" placeholder="0" style="width: 150px;" value="{{ old('saluran_rusak_ringan', $data->saluran_rusak_ringan ?? '') }}"> m²<br>
            Harga Satuan/M²: Rp <input type="number" class="form-control d-inline-block" name="harga_satuan_saluran" placeholder="0" style="width: 150px;" value="{{ old('harga_satuan_saluran', $data->harga_satuan_saluran ?? '') }}">
        </p>

        <p><strong>2.3 BALAI PERTEMUAN RW/RT</strong><br>
            RUSAK BERAT: <input type="number" class="form-control d-inline-block" name="balai_rusak_berat" placeholder="0" style="width: 150px;" value="{{ old('balai_rusak_berat', $data->balai_rusak_berat ?? '') }}"> UNIT<br>
            RUSAK SEDANG: <input type="number" class="form-control d-inline-block" name="balai_rusak_sedang" placeholder="0" style="width: 150px;" value="{{ old('balai_rusak_sedang', $data->balai_rusak_sedang ?? '') }}"> UNIT<br>
            RUSAK RINGAN: <input type="number" class="form-control d-inline-block" name="balai_rusak_ringan" placeholder="0" style="width: 150px;" value="{{ old('balai_rusak_ringan', $data->balai_rusak_ringan ?? '') }}"> UNIT<br>
            Harga Satuan/M²: Rp <input type="number" class="form-control d-inline-block" name="harga_satuan_balai" placeholder="0" style="width: 150px;" value="{{ old('harga_satuan_balai', $data->harga_satuan_balai ?? '') }}">
        </p>

        <hr class="my-4">

        <h6 class="fw-bold">II. PERKIRAAN KERUGIAN</h6>
        <p><strong>1) BIAYA PEMBERSIHAN PUING</strong></p>
        <p>
            A. Jumlah Tenaga Kerja: <input type="number" class="form-control d-inline-block" name="tenaga_kerja_hok" placeholder="0" style="width: 100px;" value="{{ old('tenaga_kerja_hok', $data->tenaga_kerja_hok ?? '') }}"> HOK * Rp <input type="number" class="form-control d-inline-block" name="upah_harian" placeholder="0" style="width: 150px;" value="{{ old('upah_harian', $data->upah_harian ?? '') }}"> /Upah Harian<br>
            B. Jumlah Alat Berat: <input type="number" class="form-control d-inline-block" name="alat_berat_hari" placeholder="0" style="width: 100px;" value="{{ old('alat_berat_hari', $data->alat_berat_hari ?? '') }}"> Hari X Rp <input type="number" class="form-control d-inline-block" name="biaya_per_hari" placeholder="0" style="width: 150px;" value="{{ old('biaya_per_hari', $data->biaya_per_hari ?? '') }}"> /Hari
        </p>

        <p><strong>2) PERKIRAAN JUMLAH RUMAH YANG DISEWAKAN</strong><br>
            Jumlah Rumah: <input type="number" class="form-control d-inline-block" name="jumlah_rumah_disewa" placeholder="0" style="width: 100px;" value="{{ old('jumlah_rumah_disewa', $data->jumlah_rumah_disewa ?? '') }}"> Unit<br>
            Harga Sewa Per Bulan: <input type="number" class="form-control d-inline-block" name="harga_sewa_per_bulan" placeholder="0" style="width: 200px;" value="{{ old('harga_sewa_per_bulan', $data->harga_sewa_per_bulan ?? '') }}"> Rupiah<br>
            Durasi Sewa: <input type="number" class="form-control d-inline-block" name="durasi_sewa_bulan" placeholder="0" style="width: 100px;" value="{{ old('durasi_sewa_bulan', $data->durasi_sewa_bulan ?? '') }}"> Bulan
        </p>

        <p><strong>3) PERKIRAAN KEBUTUHAN HUNIAN SEMENTARA</strong><br>
            Tenda : <input type="number" class="form-control d-inline-block" name="jumlah_tenda" placeholder="0" style="width: 150px;" value="{{ old('jumlah_tenda', $data->jumlah_tenda ?? '') }}"> Unit<br>
            Barak : <input type="number" class="form-control d-inline-block" name="jumlah_barak" placeholder="0" style="width: 150px;" value="{{ old('jumlah_barak', $data->jumlah_barak ?? '') }}"> Unit<br>
            Rumah Sementara : <input type="number" class="form-control d-inline-block" name="jumlah_rumah_sementara" placeholder="0" style="width: 150px;" value="{{ old('jumlah_rumah_sementara', $data->jumlah_rumah_sementara ?? '') }}"> Unit
        </p>

        <p><strong>4) HARGA SATUAN PENYEDIAAN HUNIAN SEMENTARA</strong><br>
            Tenda : <input type="number" class="form-control d-inline-block" name="harga_tenda" placeholder="0" style="width: 200px;" value="{{ old('harga_tenda', $data->harga_tenda ?? '') }}"> Rupiah<br>
            Barak : <input type="number" class="form-control d-inline-block" name="harga_barak" placeholder="0" style="width: 200px;" value="{{ old('harga_barak', $data->harga_barak ?? '') }}"> Rupiah<br>
            Rumah Sementara : <input type="number" class="form-control d-inline-block" name="harga_rumah_sementara" placeholder="0" style="width: 200px;" value="{{ old('harga_rumah_sementara', $data->harga_rumah_sementara ?? '') }}"> Rupiah
        </p>

        <hr class="my-4">

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
                    // Perhitungan total kerusakan format1 (bisa disesuaikan jika field berubah)
                    $totalKerusakan += (($data->rumah_hancur_total_permanen ?? 0) + ($data->rumah_hancur_total_non_permanen ?? 0)) * (($data->harga_satuan_hancur_total_permanen ?? 0) + ($data->harga_satuan_hancur_total_non_permanen ?? 0));
                    $totalKerusakan += (($data->rumah_rusak_berat_permanen ?? 0) + ($data->rumah_rusak_berat_non_permanen ?? 0)) * (($data->harga_satuan_rusak_berat_permanen ?? 0) + ($data->harga_satuan_rusak_berat_non_permanen ?? 0));
                    $totalKerusakan += (($data->rumah_rusak_sedang_permanen ?? 0) + ($data->rumah_rusak_sedang_non_permanen ?? 0)) * (($data->harga_satuan_rusak_sedang_permanen ?? 0) + ($data->harga_satuan_rusak_sedang_non_permanen ?? 0));
                    $totalKerusakan += (($data->rumah_rusak_ringan_permanen ?? 0) + ($data->rumah_rusak_ringan_non_permanen ?? 0)) * (($data->harga_satuan_rusak_ringan_permanen ?? 0) + ($data->harga_satuan_rusak_ringan_non_permanen ?? 0));
                    // Tambahkan perhitungan lain jika ada
                @endphp
                <h4 class="mb-1">Rp {{ number_format($totalKerusakan, 0, ',', '.') }}</h4>
                <small>Total Kerusakan Format 1</small>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-calculate totals for housing damage
            function calculateHouseTotal(type) {
                const permanen = parseInt(document.querySelector(`input[name="rumah_${type}_permanen"]`).value) || 0;
                const nonPermanen = parseInt(document.querySelector(`input[name="rumah_${type}_non_permanen"]`).value) || 0;
                const totalField = document.querySelector(`input[name="${type}_jumlah"]`);
                if (totalField) {
                    totalField.value = permanen + nonPermanen;
                }
            }

            // Add event listeners for house damage calculations
            ['hancur_total', 'rusak_sedang', 'rusak_ringan', 'rusak_berat'].forEach(type => {
                const permanenField = document.querySelector(`input[name="rumah_${type}_permanen"]`);
                const nonPermanenField = document.querySelector(`input[name="rumah_${type}_non_permanen"]`);
                
                if (permanenField) {
                    permanenField.addEventListener('input', () => calculateHouseTotal(type));
                }
                if (nonPermanenField) {
                    nonPermanenField.addEventListener('input', () => calculateHouseTotal(type));
                }
            });

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
@endsection

