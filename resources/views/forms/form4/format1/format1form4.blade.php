@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
        <p class="fw-bold">Format 1a: Pengumpulan Data Sektor Perumahan</p>
        
        <form action="{{ route('forms.form4.format1.store') }}" method="POST">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">

        <table class="table table-bordered">
            <tr>
                <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required></td>
                <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required></td>
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
                    <td><input type="number" class="form-control" name="rumah_hancur_total_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rumah_hancur_total_non_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="hancur_total_jumlah" placeholder="0" readonly></td>
                    <td><input type="number" class="form-control" name="harga_satuan_hancur_total_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="harga_satuan_hancur_total_non_permanen" placeholder="0"></td>
                </tr>
                <tr>
                    <td>1b) JUMLAH RUMAH RUSAK BERAT</td>
                    <td><input type="number" class="form-control" name="rumah_rusak_berat_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rumah_rusak_berat_non_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rusak_berat_jumlah" placeholder="0" readonly></td>
                    <td><input type="number" class="form-control" name="harga_satuan_rusak_berat_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="harga_satuan_rusak_berat_non_permanen" placeholder="0"></td>
                </tr>
                <tr>
                    <td>1c) JUMLAH RUMAH RUSAK SEDANG</td>
                    <td><input type="number" class="form-control" name="rumah_rusak_sedang_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rumah_rusak_sedang_non_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rusak_sedang_jumlah" placeholder="0" readonly></td>
                    <td><input type="number" class="form-control" name="harga_satuan_rusak_sedang_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="harga_satuan_rusak_sedang_non_permanen" placeholder="0"></td>
                </tr>
                <tr>
                    <td>1d) JUMLAH RUMAH RUSAK RINGAN</td>
                    <td><input type="number" class="form-control" name="rumah_rusak_ringan_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rumah_rusak_ringan_non_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="rusak_ringan_jumlah" placeholder="0" readonly></td>
                    <td><input type="number" class="form-control" name="harga_satuan_rusak_ringan_permanen" placeholder="0"></td>
                    <td><input type="number" class="form-control" name="harga_satuan_rusak_ringan_non_permanen" placeholder="0"></td>
                </tr>
            </tbody>
        </table>

        <p class="fw-bold mt-4">2. KERUSAKAN PRASARANA LINGKUNGAN</p>
        <p><strong>2.1 JALAN LINGKUNGAN</strong><br>
            Rusak berat: <input type="number" class="form-control d-inline-block" name="jalan_rusak_berat" placeholder="0" style="width: 150px;"> m²<br>
            Rusak sedang: <input type="number" class="form-control d-inline-block" name="jalan_rusak_sedang" placeholder="0" style="width: 150px;"> m²<br>
            Rusak ringan: <input type="number" class="form-control d-inline-block" name="jalan_rusak_ringan" placeholder="0" style="width: 150px;"> m²<br>
            Harga Satuan/M²: Rp <input type="number" class="form-control d-inline-block" name="harga_satuan_jalan" placeholder="0" style="width: 150px;">
        </p>

        <p><strong>2.2 SALURAN AIR/GORONG-GORONG</strong><br>
            Rusak berat: <input type="number" class="form-control d-inline-block" name="saluran_rusak_berat" placeholder="0" style="width: 150px;"> m²<br>
            Rusak sedang: <input type="number" class="form-control d-inline-block" name="saluran_rusak_sedang" placeholder="0" style="width: 150px;"> m²<br>
            Rusak ringan: <input type="number" class="form-control d-inline-block" name="saluran_rusak_ringan" placeholder="0" style="width: 150px;"> m²<br>
            Harga Satuan/M²: Rp <input type="number" class="form-control d-inline-block" name="harga_satuan_saluran" placeholder="0" style="width: 150px;">
        </p>

        <p><strong>2.3 BALAI PERTEMUAN RW/RT</strong><br>
            RUSAK BERAT: <input type="number" class="form-control d-inline-block" name="balai_rusak_berat" placeholder="0" style="width: 150px;"> UNIT<br>
            RUSAK SEDANG: <input type="number" class="form-control d-inline-block" name="balai_rusak_sedang" placeholder="0" style="width: 150px;"> UNIT<br>
            RUSAK RINGAN: <input type="number" class="form-control d-inline-block" name="balai_rusak_ringan" placeholder="0" style="width: 150px;"> UNIT<br>
            Harga Satuan/M²: Rp <input type="number" class="form-control d-inline-block" name="harga_satuan_balai" placeholder="0" style="width: 150px;">
        </p>

        <hr class="my-4">

        <h6 class="fw-bold">II. PERKIRAAN KERUGIAN</h6>
        <p><strong>1) BIAYA PEMBERSIHAN PUING</strong></p>
        <p>
            A. Jumlah Tenaga Kerja: <input type="number" class="form-control d-inline-block" name="tenaga_kerja_hok" placeholder="0" style="width: 100px;"> HOK * Rp <input type="number" class="form-control d-inline-block" name="upah_harian" placeholder="0" style="width: 150px;"> /Upah Harian<br>
            B. Jumlah Alat Berat: <input type="number" class="form-control d-inline-block" name="alat_berat_hari" placeholder="0" style="width: 100px;"> Hari X Rp <input type="number" class="form-control d-inline-block" name="biaya_per_hari" placeholder="0" style="width: 150px;"> /Hari
        </p>

        <p><strong>2) PERKIRAAN JUMLAH RUMAH YANG DISEWAKAN</strong><br>
            Jumlah Rumah: <input type="number" class="form-control d-inline-block" name="jumlah_rumah_disewa" placeholder="0" style="width: 100px;"> Unit<br>
            Harga Sewa Per Bulan: <input type="number" class="form-control d-inline-block" name="harga_sewa_per_bulan" placeholder="0" style="width: 200px;"> Rupiah<br>
            Durasi Sewa: <input type="number" class="form-control d-inline-block" name="durasi_sewa_bulan" placeholder="0" style="width: 100px;"> Bulan
        </p>

        <p><strong>3) PERKIRAAN KEBUTUHAN HUNIAN SEMENTARA</strong><br>
            Tenda : <input type="number" class="form-control d-inline-block" name="jumlah_tenda" placeholder="0" style="width: 150px;"> Unit<br>
            Barak : <input type="number" class="form-control d-inline-block" name="jumlah_barak" placeholder="0" style="width: 150px;"> Unit<br>
            Rumah Sementara : <input type="number" class="form-control d-inline-block" name="jumlah_rumah_sementara" placeholder="0" style="width: 150px;"> Unit
        </p>

        <p><strong>4) HARGA SATUAN PENYEDIAAN HUNIAN SEMENTARA</strong><br>
            Tenda : <input type="number" class="form-control d-inline-block" name="harga_tenda" placeholder="0" style="width: 200px;"> Rupiah<br>
            Barak : <input type="number" class="form-control d-inline-block" name="harga_barak" placeholder="0" style="width: 200px;"> Rupiah<br>
            Rumah Sementara : <input type="number" class="form-control d-inline-block" name="harga_rumah_sementara" placeholder="0" style="width: 200px;"> Rupiah
        </p>

        <hr class="my-4">

        <div class="row mb-4">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </div>
        </form>

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
