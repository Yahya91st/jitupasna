@extends('layouts.main')

@section('content')
<div class="container-fluid mt-4">
    <h4 class="text-center fw-bold mb-3">Format 9: SEKTOR TELKOM</h4>
    <h5 class="text-center mb-4">Kabupaten ...</h5>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('forms.form4.format9.store') }}" method="POST">
                @csrf
                <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
                
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
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
                                <td><input type="number" name="komponen[0][0][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][0][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][1][nama]" class="form-control form-control-sm" placeholder="Nama Komponen" value=""></td>
                                <td><input type="text" name="komponen[0][1][satuan]" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="komponen[0][1][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][1][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][2][nama]" class="form-control form-control-sm" placeholder="Nama Komponen" value=""></td>
                                <td><input type="text" name="komponen[0][2][satuan]" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="komponen[0][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][2][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][3][nama]" class="form-control form-control-sm" placeholder="Nama Komponen" value=""></td>
                                <td><input type="text" name="komponen[0][3][satuan]" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="komponen[0][3][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][3][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>

                            <!-- PERKIRAAN KERUGIAN -->
                            <tr>
                                <td colspan="5" class="fw-bold bg-secondary text-white">PERKIRAAN KERUGIAN</td>
                            </tr>
                            <tr>
                                <td rowspan="1" class="align-middle fw-bold bg-light">PERKIRAAN JANGKA WAKTU PEMULIHAN</td>
                                <td class="text-start">A. <input type="number" name="jangka_waktu_pemulihan_a" class="form-control d-inline-block" style="width: 80px; display: inline-block;" min="1" max="120" placeholder="12"> BULAN</td>
                                <td><input type="text" name="komponen[0][0][satuan]" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="komponen[1][0][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][0][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td style="padding:5px;">PERKIRAAN KEHILANGAN PENURUNAN PENDAPATAN</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">B. PERMINTAAN TELEKOMUNIKASI PER BULAN SEBELUM BENCANA</td>
                                <td><input type="text" name="komponen[0][0][satuan]" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="komponen[1][1][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][1][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">C. PERMINTAAN TELEKOMUNIKASI PER BULAN PASCA BENCANA</td>
                                <td><input type="text" name="komponen[0][0][satuan]" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="komponen[1][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][2][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">D. TARIF</td>
                                <td><input type="text" name="komponen[0][0][satuan]" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="komponen[1][1][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][1][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">E. PENURUNAN PENDAPATAN</td>
                                <td><input type="text" name="komponen[0][0][satuan]" class="form-control form-control-sm" placeholder="Satuan" value=""></td>
                                <td><input type="number" name="komponen[1][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][2][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
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