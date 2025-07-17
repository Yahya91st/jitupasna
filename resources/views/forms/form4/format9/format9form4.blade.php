@extends('layouts.main')

@section('content')
<div class="container-fluid mt-4">
    <h4 class="text-center fw-bold mb-3">Format 9: SEKTOR TELKOM</h4>

    <div class="card">
        <div class="card-body">
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
                    <table class="table table-bordered text-center align-middle" style="min-width: 1200px;">
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
                                <td rowspan="4" class="align-middle fw-bold bg-light">KERUSAKAN SARANA DAN PRASARANA</td>
                                <td class="text-start"><input type="text" name="komponen[0][0][nama]" class="form-control form-control-sm" placeholder="Nama Komponen" value=""></td>
                                <td><input type="text" name="komponen[0][0][satuan]" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="kerusakan_1_jumlah_unit" class="form-control" min="0" value="0" readonly></td>
                                <td><input type="number" name="kerusakan_1_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][1][nama]" class="form-control form-control-sm" placeholder="Nama Komponen" value=""></td>
                                <td><input type="text" name="komponen[0][1][satuan]" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="kerusakan_2_jumlah_unit" class="form-control" min="0" value="0" readonly></td>
                                <td><input type="number" name="kerusakan_2_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][2][nama]" class="form-control form-control-sm" placeholder="Nama Komponen" value=""></td>
                                <td><input type="text" name="komponen[0][2][satuan]" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="kerusakan_3_jumlah_unit" class="form-control" min="0" value="0" readonly></td>
                                <td><input type="number" name="kerusakan_3_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][3][nama]" class="form-control form-control-sm" placeholder="Nama Komponen" value=""></td>
                                <td><input type="text" name="komponen[0][3][satuan]" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="kerusakan_4_jumlah_unit" class="form-control" min="0" value="0" readonly></td>
                                <td><input type="number" name="kerusakan_4_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>

                            <!-- PERKIRAAN KERUGIAN -->
                            <tr>
                                <td colspan="5" class="fw-bold bg-secondary text-white">PERKIRAAN KERUGIAN</td>
                            </tr>
                            <tr>
                                <td rowspan="1" class="align-middle fw-bold bg-light">PERKIRAAN JANGKA WAKTU PEMULIHAN</td>
                                <td class="text-start">A. <input type="number" name="jangka_waktu_pemulihan_a" class="form-control d-inline-block" style="width: 80px; display: inline-block;" min="1" max="120" placeholder="12"> BULAN</td>
                                <td><input type="text" name="jangka_waktu_satuan" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="jangka_waktu_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="jangka_waktu_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td style="padding:5px;">PERKIRAAN KEHILANGAN PENURUNAN PENDAPATAN</td>
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
                                <td><input type="text" name="komponen[0][0][satuan]" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="komponen[1][1][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][1][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">C. BIAYA OPERASIONAL PER BULAN PASCA BENCANA</td>
                                <td><input type="text" name="komponen[0][0][satuan]" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="komponen[1][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][2][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">D. KENAIKAN BIAYA OPERASIONAL</td>
                                <td><input type="text" name="komponen[0][0][satuan]" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="komponen[1][1][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][1][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function setupAutoCalculation(satuanName, hargaName, jumlahName) {
            const satuanInput = document.querySelector(`[name="${satuanName}"]`);
            const hargaInput = document.querySelector(`[name="${hargaName}"]`);
            const jumlahInput = document.querySelector(`[name="${jumlahName}"]`);
            function calculate() {
                const satuan = parseFloat(satuanInput.value) || 0;
                const harga = parseFloat(hargaInput.value) || 0;
                jumlahInput.value = satuan * harga;
            }
            satuanInput.addEventListener('input', calculate);
            hargaInput.addEventListener('input', calculate);
        }
        setupAutoCalculation('kerusakan_1_satuan', 'kerusakan_1_harga_satuan', 'kerusakan_1_jumlah_unit');
        setupAutoCalculation('kerusakan_2_satuan', 'kerusakan_2_harga_satuan', 'kerusakan_2_jumlah_unit');
        setupAutoCalculation('kerusakan_3_satuan', 'kerusakan_3_harga_satuan', 'kerusakan_3_jumlah_unit');
        setupAutoCalculation('kerusakan_4_satuan', 'kerusakan_4_harga_satuan', 'kerusakan_4_jumlah_unit');
    });
</script>