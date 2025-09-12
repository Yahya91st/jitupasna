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

        <h6 class="fw-bold mt-4">2. KERUSAKAN PRASARANA LINGKUNGAN</h6>

        <table class="table table-bordered mt-3">
            <thead>
                <tr class="bg-light">
                    <th colspan="5">2.1 JALAN LINGKUNGAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 15%">Rusak Berat</td>
                    <td style="width: 25%">
                        <div class="input-group">
                            <input type="number" class="form-control" name="jalan_rusak_berat" placeholder="0" value="{{ old('jalan_rusak_berat', $data->jalan_rusak_berat ?? '') }}">
                            <span class="input-group-text">m²</span>
                        </div>
                    </td>
                    <td style="width: 15%">Harga Satuan/M²</td>
                    <td style="width: 25%">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="harga_satuan_jalan" placeholder="0" value="{{ old('harga_satuan_jalan', $data->harga_satuan_jalan ?? '') }}">
                        </div>
                    </td>
                    <td style="width: 20%"></td>
                </tr>
                <tr>
                    <td>Rusak Sedang</td>
                    <td>
                        <div class="input-group">
                            <input type="number" class="form-control" name="jalan_rusak_sedang" placeholder="0" value="{{ old('jalan_rusak_sedang', $data->jalan_rusak_sedang ?? '') }}">
                            <span class="input-group-text">m²</span>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td>Rusak Ringan</td>
                    <td>
                        <div class="input-group">
                            <input type="number" class="form-control" name="jalan_rusak_ringan" placeholder="0" value="{{ old('jalan_rusak_ringan', $data->jalan_rusak_ringan ?? '') }}">
                            <span class="input-group-text">m²</span>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered mt-3">
            <thead>
                <tr class="bg-light">
                    <th colspan="5">2.2 SALURAN AIR/GORONG-GORONG</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 15%">Rusak Berat</td>
                    <td style="width: 25%">
                        <div class="input-group">
                            <input type="number" class="form-control" name="saluran_rusak_berat" placeholder="0" value="{{ old('saluran_rusak_berat', $data->saluran_rusak_berat ?? '') }}">
                            <span class="input-group-text">m²</span>
                        </div>
                    </td>
                    <td style="width: 15%">Harga Satuan/M²</td>
                    <td style="width: 25%">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="harga_satuan_saluran" placeholder="0" value="{{ old('harga_satuan_saluran', $data->harga_satuan_saluran ?? '') }}">
                        </div>
                    </td>
                    <td style="width: 20%"></td>
                </tr>
                <tr>
                    <td>Rusak Sedang</td>
                    <td>
                        <div class="input-group">
                            <input type="number" class="form-control" name="saluran_rusak_sedang" placeholder="0" value="{{ old('saluran_rusak_sedang', $data->saluran_rusak_sedang ?? '') }}">
                            <span class="input-group-text">m²</span>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td>Rusak Ringan</td>
                    <td>
                        <div class="input-group">
                            <input type="number" class="form-control" name="saluran_rusak_ringan" placeholder="0" value="{{ old('saluran_rusak_ringan', $data->saluran_rusak_ringan ?? '') }}">
                            <span class="input-group-text">m²</span>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered mt-3">
            <thead>
                <tr class="bg-light">
                    <th colspan="5">2.3 BALAI PERTEMUAN RW/RT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 15%">Rusak Berat</td>
                    <td style="width: 25%">
                        <div class="input-group">
                            <input type="number" class="form-control" name="balai_rusak_berat" placeholder="0" value="{{ old('balai_rusak_berat', $data->balai_rusak_berat ?? '') }}">
                            <span class="input-group-text">UNIT</span>
                        </div>
                    </td>
                    <td style="width: 15%">Harga Satuan/M²</td>
                    <td style="width: 25%">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="harga_satuan_balai" placeholder="0" value="{{ old('harga_satuan_balai', $data->harga_satuan_balai ?? '') }}">
                        </div>
                    </td>
                    <td style="width: 20%"></td>
                </tr>
                <tr>
                    <td>Rusak Sedang</td>
                    <td>
                        <div class="input-group">
                            <input type="number" class="form-control" name="balai_rusak_sedang" placeholder="0" value="{{ old('balai_rusak_sedang', $data->balai_rusak_sedang ?? '') }}">
                            <span class="input-group-text">UNIT</span>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td>Rusak Ringan</td>
                    <td>
                        <div class="input-group">
                            <input type="number" class="form-control" name="balai_rusak_ringan" placeholder="0" value="{{ old('balai_rusak_ringan', $data->balai_rusak_ringan ?? '') }}">
                            <span class="input-group-text">UNIT</span>
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>

        <hr class="my-4">

        <h6 class="fw-bold">II. PERKIRAAN KERUGIAN</h6>
        <table class="table table-bordered mt-3">
            <thead>
                <tr class="bg-light">
                    <th colspan="4">1) BIAYA PEMBERSIHAN PUING</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 15%">A. Jumlah Tenaga Kerja</td>
                    <td style="width: 35%">
                        <div class="input-group">
                            <input type="number" class="form-control" name="tenaga_kerja_hok" placeholder="0" value="{{ old('tenaga_kerja_hok', $data->tenaga_kerja_hok ?? '') }}">
                            <span class="input-group-text">HOK</span>
                        </div>
                    </td>
                    <td style="width: 15%">Upah Harian</td>
                    <td style="width: 35%">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="upah_harian" placeholder="0" value="{{ old('upah_harian', $data->upah_harian ?? '') }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>B. Jumlah Alat Berat</td>
                    <td>
                        <div class="input-group">
                            <input type="number" class="form-control" name="alat_berat_hari" placeholder="0" value="{{ old('alat_berat_hari', $data->alat_berat_hari ?? '') }}">
                            <span class="input-group-text">Hari</span>
                        </div>
                    </td>
                    <td>Biaya per Hari</td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="biaya_per_hari" placeholder="0" value="{{ old('biaya_per_hari', $data->biaya_per_hari ?? '') }}">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered mt-3">
            <thead>
                <tr class="bg-light">
                    <th colspan="4">2) PERKIRAAN JUMLAH RUMAH YANG DISEWAKAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 15%">Jumlah Rumah</td>
                    <td style="width: 35%">
                        <div class="input-group">
                            <input type="number" class="form-control" name="jumlah_rumah_disewa" placeholder="0" value="{{ old('jumlah_rumah_disewa', $data->jumlah_rumah_disewa ?? '') }}">
                            <span class="input-group-text">Unit</span>
                        </div>
                    </td>
                    <td style="width: 15%">Harga Sewa/Bulan</td>
                    <td style="width: 35%">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="harga_sewa_per_bulan" placeholder="0" value="{{ old('harga_sewa_per_bulan', $data->harga_sewa_per_bulan ?? '') }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Durasi Sewa</td>
                    <td>
                        <div class="input-group">
                            <input type="number" class="form-control" name="durasi_sewa_bulan" placeholder="0" value="{{ old('durasi_sewa_bulan', $data->durasi_sewa_bulan ?? '') }}">
                            <span class="input-group-text">Bulan</span>
                        </div>
                    </td>
                    <td colspan="2"></td>
                </tr>
            </tbody>
        </table>

        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr class="bg-light">
                            <th colspan="2">3) PERKIRAAN KEBUTUHAN HUNIAN SEMENTARA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 30%">Tenda</td>
                            <td>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="jumlah_tenda" placeholder="0" value="{{ old('jumlah_tenda', $data->jumlah_tenda ?? '') }}">
                                    <span class="input-group-text">Unit</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Barak</td>
                            <td>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="jumlah_barak" placeholder="0" value="{{ old('jumlah_barak', $data->jumlah_barak ?? '') }}">
                                    <span class="input-group-text">Unit</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Rumah Sementara</td>
                            <td>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="jumlah_rumah_sementara" placeholder="0" value="{{ old('jumlah_rumah_sementara', $data->jumlah_rumah_sementara ?? '') }}">
                                    <span class="input-group-text">Unit</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr class="bg-light">
                            <th colspan="2">4) HARGA SATUAN HUNIAN SEMENTARA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 30%">Tenda</td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" name="harga_tenda" placeholder="0" value="{{ old('harga_tenda', $data->harga_tenda ?? '') }}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Barak</td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" name="harga_barak" placeholder="0" value="{{ old('harga_barak', $data->harga_barak ?? '') }}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Rumah Sementara</td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" name="harga_rumah_sementara" placeholder="0" value="{{ old('harga_rumah_sementara', $data->harga_rumah_sementara ?? '') }}">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

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
                    // 1. Perhitungan kerusakan rumah (gunakan logika yang benar: setiap jenis × harga masing-masing)
                    $totalKerusakan += ($data->rumah_hancur_total_permanen ?? 0) * ($data->harga_satuan_hancur_total_permanen ?? 0);
                    $totalKerusakan += ($data->rumah_hancur_total_non_permanen ?? 0) * ($data->harga_satuan_hancur_total_non_permanen ?? 0);
                    $totalKerusakan += ($data->rumah_rusak_berat_permanen ?? 0) * ($data->harga_satuan_rusak_berat_permanen ?? 0);
                    $totalKerusakan += ($data->rumah_rusak_berat_non_permanen ?? 0) * ($data->harga_satuan_rusak_berat_non_permanen ?? 0);
                    $totalKerusakan += ($data->rumah_rusak_sedang_permanen ?? 0) * ($data->harga_satuan_rusak_sedang_permanen ?? 0);
                    $totalKerusakan += ($data->rumah_rusak_sedang_non_permanen ?? 0) * ($data->harga_satuan_rusak_sedang_non_permanen ?? 0);
                    $totalKerusakan += ($data->rumah_rusak_ringan_permanen ?? 0) * ($data->harga_satuan_rusak_ringan_permanen ?? 0);
                    $totalKerusakan += ($data->rumah_rusak_ringan_non_permanen ?? 0) * ($data->harga_satuan_rusak_ringan_non_permanen ?? 0);
                    
                    // 2. Perhitungan kerusakan prasarana lingkungan
                    $totalKerusakan += (($data->jalan_rusak_berat ?? 0) + ($data->jalan_rusak_sedang ?? 0) + ($data->jalan_rusak_ringan ?? 0)) * ($data->harga_satuan_jalan ?? 0);
                    $totalKerusakan += (($data->saluran_rusak_berat ?? 0) + ($data->saluran_rusak_sedang ?? 0) + ($data->saluran_rusak_ringan ?? 0)) * ($data->harga_satuan_saluran ?? 0);
                    $totalKerusakan += (($data->balai_rusak_berat ?? 0) + ($data->balai_rusak_sedang ?? 0) + ($data->balai_rusak_ringan ?? 0)) * ($data->harga_satuan_balai ?? 0);
                    
                    // 3. Biaya pembersihan puing (dipindahkan dari kerugian ke kerusakan)
                    $totalKerusakan += ($data->tenaga_kerja_hok ?? 0) * ($data->upah_harian ?? 0);
                    $totalKerusakan += ($data->alat_berat_hari ?? 0) * ($data->biaya_per_hari ?? 0);
                    
                    // 4. Biaya rumah sewa (dipindahkan dari kerugian ke kerusakan)
                    $totalKerusakan += ($data->jumlah_rumah_disewa ?? 0) * ($data->harga_sewa_per_bulan ?? 0) * ($data->durasi_sewa_bulan ?? 0);
                    
                    // 5. Biaya hunian sementara (dipindahkan dari kerugian ke kerusakan)
                    $totalKerusakan += ($data->jumlah_tenda ?? 0) * ($data->harga_tenda ?? 0);
                    $totalKerusakan += ($data->jumlah_barak ?? 0) * ($data->harga_barak ?? 0);
                    $totalKerusakan += ($data->jumlah_rumah_sementara ?? 0) * ($data->harga_rumah_sementara ?? 0);
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

