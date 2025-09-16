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
    <p class="fw-bold">Format 9: Sektor Telkom</p>    
    <form action="{{ route('forms.form4.format9.store') }}" method="POST">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">        
            <table class="table table-bordered">
                <tr>
                    <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                    <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
                </tr>
            </table>

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle" style="width: 100%;">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle">URAIAN</th>
                        <th rowspan="2" class="text-center">KOMPONEN</th>
                        <th colspan="2" class="align-middle text-center">JUMLAH</th>
                        <th rowspan="2" class="text-center">HARGA SATUAN</th>
                    </tr>
                    <tr>
                        <th class="text-center">SATUAN</th>
                        <th class="text-center">UNIT</th>
                    </tr>                        </thead>
                
                <tbody>
                    <tr>
                        <td colspan="5" class="fw-bold bg-secondary text-white">PERKIRAAN KERUSAKAN</td>
                    </tr>
                    <!-- KERUSAKAN SARANA DAN PRASARANA -->
                    <tr>
                        <td rowspan="4" class="align-middle fw-bold">Kerusakan Sarana dan Prasarana</td>
                        <td class="text-start"><input type="text" name="komponen[0][0][nama]" class="form-control form-control-sm" placeholder="Nama Komponen" value=""></td>
                        <td><input type="text" name="kerusakan_1_satuan" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                        <td><input type="number" name="kerusakan_1_jumlah_unit" class="form-control" min="0" value="0" ></td>
                        <td><input type="number" name="kerusakan_1_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                    </tr>
                    <tr>
                        <td class="text-start"><input type="text" name="komponen[0][1][nama]" class="form-control form-control-sm" placeholder="Nama Komponen" value=""></td>
                        <td><input type="text" name="kerusakan_2_satuan" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                        <td><input type="number" name="kerusakan_2_jumlah_unit" class="form-control" min="0" value="0" ></td>
                        <td><input type="number" name="kerusakan_2_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                    </tr>
                    <tr>
                        <td class="text-start"><input type="text" name="komponen[0][2][nama]" class="form-control form-control-sm" placeholder="Nama Komponen" value=""></td>
                        <td><input type="text" name="kerusakan_3_satuan" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                        <td><input type="number" name="kerusakan_3_jumlah_unit" class="form-control" min="0" value="0" ></td>
                        <td><input type="number" name="kerusakan_3_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                    </tr>
                    <tr>
                        <td class="text-start"><input type="text" name="komponen[0][3][nama]" class="form-control form-control-sm" placeholder="Nama Komponen" value=""></td>
                        <td><input type="text" name="kerusakan_4_satuan" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                        <td><input type="number" name="kerusakan_4_jumlah_unit" class="form-control" min="0" value="0" ></td>
                        <td><input type="number" name="kerusakan_4_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                    </tr>
                    <!-- PERKIRAAN KERUGIAN -->
                    <tr>
                        <td colspan="5" class="fw-bold bg-secondary text-white">PERKIRAAN KERUGIAN</td>
                    </tr>
                    <tr>
                        <td rowspan="1" class="align-middle fw-bold">Perkiraan Jangka Waktu Pemulihan</td>
                        <td class="text-start">A. <input type="number" name="jangka_waktu_pemulihan_a" class="form-control d-inline-block" style="width: 80px; display: inline-block;" min="1" max="120" placeholder="12"> BULAN</td>
                        <td><input type="text" name="jangka_waktu_satuan" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                        <td><input type="number" name="jangka_waktu_unit" class="form-control" min="0" value="0"></td>
                        <td><input type="number" name="jangka_waktu_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="fw-bold bg-secondary text-white">PERKIRAAN KEHILANGAN PENURUNAN PENDAPATAN</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-start">B. PERMINTAAN TELEKOMUNIKASI PER BULAN SEBELUM BENCANA</td>
                        <td><input type="text" name="permintaan_sebelum_satuan" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                        <td><input type="number" name="permintaan_sebelum_unit" class="form-control" min="0" value="0"></td>
                        <td><input type="number" name="permintaan_sebelum_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-start">C. PERMINTAAN TELEKOMUNIKASI PER BULAN PASCA BENCANA</td>
                        <td><input type="text" name="permintaan_pasca_satuan" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                        <td><input type="number" name="permintaan_pasca_unit" class="form-control" min="0" value="0"></td>
                        <td><input type="number" name="permintaan_pasca_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-start">D. TARIF</td>
                        <td><input type="text" name="tarif_satuan" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                        <td><input type="number" name="tarif_unit" class="form-control" min="0" value="0"></td>
                        <td><input type="number" name="tarif_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-start">E. PENURUNAN PENDAPATAN</td>
                        <td><input type="text" name="penurunan_pendapatan_satuan" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                        <td><input type="number" name="penurunan_pendapatan_unit" class="form-control" min="0" value="0"></td>
                        <td><input type="number" name="penurunan_pendapatan_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                    </tr>
                    <tr>
                        <td style="padding:5px;">PERKIRAAN KENAIKAN BIAYA OPERASIONAL</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-start">B. BIAYA OPERASIONAL PER BULAN SEBELUM BENCANA</td>
                        <td><input type="text" name="biaya_op_sebelum_satuan" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                        <td><input type="number" name="biaya_op_sebelum_unit" class="form-control" min="0" value="0"></td>
                        <td><input type="number" name="biaya_op_sebelum_harga" class="form-control" min="0" step="1000" value="0"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-start">C. BIAYA OPERASIONAL PER BULAN PASCA BENCANA</td>
                        <td><input type="text" name="biaya_op_pasca_satuan" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                        <td><input type="number" name="biaya_op_pasca_unit" class="form-control" min="0" value="0"></td>
                        <td><input type="number" name="biaya_op_pasca_harga" class="form-control" min="0" step="1000" value="0"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-start">D. KENAIKAN BIAYA OPERASIONAL</td>
                        <td><input type="text" name="kenaikan_biaya_satuan" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                        <td><input type="number" name="kenaikan_biaya_unit" class="form-control" min="0" value="0"></td>
                        <td><input type="number" name="kenaikan_biaya_harga" class="form-control" min="0" step="1000" value="0"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </form>
        
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function setupAutoCalculation(satuanName, hargaName, jumlahName) {
            const satuanInput = document.querySelector(`[name="${satuanName}"]`);
            const hargaInput = document.querySelector(`[name="${hargaName}"]`);
            const jumlahInput = document.querySelector(`[name="${jumlahName}"]`);
            if (!satuanInput || !hargaInput || !jumlahInput) return;
            function calculate() {
                const satuan = parseFloat(satuanInput.value) || 0;
                const harga = parseFloat(hargaInput.value) || 0;
                const total = satuan * harga;
                jumlahInput.value = Number.isInteger(total) ? total : total.toFixed(2);
            }
            satuanInput.addEventListener('input', calculate);
            hargaInput.addEventListener('input', calculate);
            calculate(); // inisialisasi nilai saat load
        }
        setupAutoCalculation('kerusakan_1_satuan', 'kerusakan_1_harga_satuan', 'kerusakan_1_jumlah_unit');
        setupAutoCalculation('kerusakan_2_satuan', 'kerusakan_2_harga_satuan', 'kerusakan_2_jumlah_unit');
        setupAutoCalculation('kerusakan_3_satuan', 'kerusakan_3_harga_satuan', 'kerusakan_3_jumlah_unit');
        setupAutoCalculation('kerusakan_4_satuan', 'kerusakan_4_harga_satuan', 'kerusakan_4_jumlah_unit');
    });
</script>
