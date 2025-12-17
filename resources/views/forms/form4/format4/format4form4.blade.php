@extends('layouts.main')

@section('content')
    <style>
        .table th,
        .table td {
            padding: 0.25rem 0.3rem !important;
            vertical-align: middle !important;
            text-align: center;
        }

        .table input.form-control {
            padding: 0.15rem 0.3rem !important;
            font-size: 0.95rem;
        }
    </style>
    <div class="container mt-4">
        <h5 class="text-center fw-bold" style="color: #F28705;">Formulir 04<br>Pengkajian Kebutuhan Pasca Bencana</h5>
        <p class="fw-bold">Format 4: Sektor Perlindungan Sosial</p>
        <form action="{{ route('forms.form4.store-format4') }}" method="POST">
            @csrf
            <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">

            <table class="table table-bordered mb-2">
                <tr>
                    <td style="width: 50%">
                        NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required>
                    </td>
                    <td>
                        NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required>
                    </td>
                </tr>
            </table>

            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle small">
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
                    <tbody>
                        @foreach ([['Panti Asuhan', 'panti_asuhan'], ['Panti Wredha', 'panti_wredha'], ['Panti Tuna Grahita', 'panti_tuna_grahita'], ['Lainnya', 'lainnya']] as [$label, $prefix])
                            <tr>
                                <td class="align-middle fw-bold">{{ $label }}</td>
                                <td><input type="number" name="{{ $prefix }}_rb_negeri" class="form-control" min="0" value="{{ old($prefix . '_rb_negeri', $data->{$prefix . '_rb_negeri'} ?? '0') }}"></td>
                                <td><input type="number" name="{{ $prefix }}_rb_swasta" class="form-control" min="0" value="{{ old($prefix . '_rb_swasta', $data->{$prefix . '_rb_swasta'} ?? '0') }}"></td>
                                <td><input type="number" name="{{ $prefix }}_rs_negeri" class="form-control" min="0" value="{{ old($prefix . '_rs_negeri', $data->{$prefix . '_rs_negeri'} ?? '0') }}"></td>
                                <td><input type="number" name="{{ $prefix }}_rs_swasta" class="form-control" min="0" value="{{ old($prefix . '_rs_swasta', $data->{$prefix . '_rs_swasta'} ?? '0') }}"></td>
                                <td><input type="number" name="{{ $prefix }}_rr_negeri" class="form-control" min="0" value="{{ old($prefix . '_rr_negeri', $data->{$prefix . '_rr_negeri'} ?? '0') }}"></td>
                                <td><input type="number" name="{{ $prefix }}_rr_swasta" class="form-control" min="0" value="{{ old($prefix . '_rr_swasta', $data->{$prefix . '_rr_swasta'} ?? '0') }}"></td>
                                <td><input type="number" name="{{ $prefix }}_luas" class="form-control" min="0" step="1000" value="{{ old($prefix . '_luas', $data->{$prefix . '_luas'} ?? '0') }}"></td>
                                <td><input type="number" name="{{ $prefix }}_harga_bangunan" class="form-control" min="0" step="1000" value="{{ old($prefix . '_harga_bangunan', $data->{$prefix . '_harga_bangunan'} ?? '0') }}"></td>
                                <td><input type="number" name="{{ $prefix }}_harga_obat" class="form-control" min="0" step="1000" value="{{ old($prefix . '_harga_obat', $data->{$prefix . '_harga_obat'} ?? '0') }}"></td>
                                <td><input type="number" name="{{ $prefix }}_harga_meubelair" class="form-control" min="0" step="1000" value="{{ old($prefix . '_harga_meubelair', $data->{$prefix . '_harga_meubelair'} ?? '0') }}"></td>
                                <td><input type="number" name="{{ $prefix }}_harga_peralatan" class="form-control" min="0" step="1000" value="{{ old($prefix . '_harga_peralatan', $data->{$prefix . '_harga_peralatan'} ?? '0') }}"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h6 class="fw-bold mt-3 mb-2">Perkiraan Kerugian</h6>
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead>
                        <tr class="bg-secondary text-white">
                            <th colspan="4">1. BIAYA PEMBERSIHAN PUING</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 15%">A. Biaya Tenaga Kerja</td>
                            <td style="width: 35%">
                                <div class="input-group">
                                    <input type="number" name="biaya_tenaga_kerja_hok" class="form-control" placeholder="0">
                                    <span class="input-group-text">HOK</span>
                                </div>
                            </td>
                            <td style="width: 15%">Upah Harian</td>
                            <td style="width: 35%">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="biaya_tenaga_kerja_upah" class="form-control" placeholder="0">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>B. Biaya Alat Berat</td>
                            <td>
                                <div class="input-group">
                                    <input type="number" name="biaya_alat_berat_hari" class="form-control" placeholder="0">
                                    <span class="input-group-text">Hari</span>
                                </div>
                            </td>
                            <td>Tarif per Hari</td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="biaya_alat_berat_harga" class="form-control" placeholder="0">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead>
                        <tr class="bg-secondary text-white">
                            <th colspan="4">2. BIAYA PENYEDIAAN JATAH HIDUP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 15%">Jumlah Pengungsi</td>
                            <td style="width: 35%">
                                <input type="number" name="jumlah_penerima" class="form-control" placeholder="0">
                            </td>
                            <td style="width: 15%">Biaya per Orang</td>
                            <td style="width: 35%">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="bantuan_per_orang" class="form-control" placeholder="0">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead>
                        <tr class="bg-secondary text-white">
                            <th colspan="4">3. TAMBAHAN BIAYA SOSIAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 25%">Biaya Pelayanan Kesehatan</td>
                            <td style="width: 25%">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="biaya_pelayanan_kesehatan" class="form-control" placeholder="0">
                                </div>
                            </td>
                            <td style="width: 25%">Biaya Pelayanan Pendidikan</td>
                            <td style="width: 25%">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="biaya_pelayanan_pendidikan" class="form-control" placeholder="0">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Biaya Pendampingan Psikososial</td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="biaya_pendampingan_psikososial" class="form-control" placeholder="0">
                                </div>
                            </td>
                            <td>Biaya Pelatihan Darurat</td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="biaya_pelatihan_darurat" class="form-control" placeholder="0">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card mb-4 border-info">
                <div class="card-header bg-secondary text-white py-2">
                    <h6 class="mb-0 fw-bold bg-secondary text-white">TOTAL PERHITUNGAN KERUSAKAN</h6>
                </div>
                <div class="card-body py-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text fw-bold">Total Kerusakan (Rp)</span>
                                <input type="text" class="form-control fw-bold text-end" id="total_kerusakan_display" readonly style="background-color: #e9ecef;">
                                <input type="hidden" name="total_kerusakan" id="total_kerusakan_input">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text fw-bold">Total Kerugian (Rp)</span>
                                <input type="text" class="form-control fw-bold text-end" value="0" readonly style="background-color: #e9ecef;">
                                <input type="hidden" name="total_kerugian" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-info py-2 mb-0 small bg-secondary">
                        <i class="fas fa-info-circle"></i>
                        <strong>Catatan:</strong> Sesuai dengan pedoman terbaru, semua item kerugian telah dipindahkan ke dalam total kerusakan. Total kerugian = 0.
                    </div>
                </div>
            </div>

            <div class="text-center mt-3 mb-5">
                <button type="submit" class="btn btn-primary btn-sm">Simpan Data</button>
            </div>
        </form>
    </div>
    <script>
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        function calculateTotals() {
            let totalKerusakan = 0;
            const buildingTypes = ['panti_sosial', 'panti_asuhan', 'balai_pelayanan', 'lainnya'];
            buildingTypes.forEach(type => {
                const rbNegeri = parseFloat(document.querySelector(`input[name="${type}_rb_negeri"]`)?.value || 0);
                const rbSwasta = parseFloat(document.querySelector(`input[name="${type}_rb_swasta"]`)?.value || 0);
                const rsNegeri = parseFloat(document.querySelector(`input[name="${type}_rs_negeri"]`)?.value || 0);
                const rsSwasta = parseFloat(document.querySelector(`input[name="${type}_rs_swasta"]`)?.value || 0);
                const rrNegeri = parseFloat(document.querySelector(`input[name="${type}_rr_negeri"]`)?.value || 0);
                const rrSwasta = parseFloat(document.querySelector(`input[name="${type}_rr_swasta"]`)?.value || 0);
                const hargaBangunan = parseFloat(document.querySelector(`input[name="${type}_harga_bangunan"]`)?.value || 0);
                const totalUnits = rbNegeri + rbSwasta + rsNegeri + rsSwasta + rrNegeri + rrSwasta;
                totalKerusakan += totalUnits * hargaBangunan;
            });
            const biayaTenagaKerja = parseFloat(document.querySelector('input[name="biaya_tenaga_kerja_hok"]')?.value || 0) *
                parseFloat(document.querySelector('input[name="biaya_tenaga_kerja_upah"]')?.value || 0);
            const biayaAlatBerat = parseFloat(document.querySelector('input[name="biaya_alat_berat_hari"]')?.value || 0) *
                parseFloat(document.querySelector('input[name="biaya_alat_berat_harga"]')?.value || 0);
            totalKerusakan += biayaTenagaKerja + biayaAlatBerat;
            const biayaJatahHidup = parseFloat(document.querySelector('input[name="jumlah_penerima"]')?.value || 0) *
                parseFloat(document.querySelector('input[name="bantuan_per_orang"]')?.value || 0);
            totalKerusakan += biayaJatahHidup;
            totalKerusakan += parseFloat(document.querySelector('input[name="biaya_pelayanan_kesehatan"]')?.value || 0);
            totalKerusakan += parseFloat(document.querySelector('input[name="biaya_pelayanan_pendidikan"]')?.value || 0);
            totalKerusakan += parseFloat(document.querySelector('input[name="biaya_pendampingan_psikososial"]')?.value || 0);
            totalKerusakan += parseFloat(document.querySelector('input[name="biaya_pelatihan_darurat"]')?.value || 0);
            document.getElementById('total_kerusakan_display').value = formatRupiah(totalKerusakan);
            document.getElementById('total_kerusakan_input').value = totalKerusakan;
        }
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[type="number"]');
            inputs.forEach(input => {
                input.addEventListener('input', calculateTotals);
            });
            calculateTotals();
        });
    </script>
@endsection
