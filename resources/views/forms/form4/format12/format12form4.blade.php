@extends('layouts.main')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="text-center fw-bold mb-3">PENGKAJIAN KEBUTUHAN PASCABENCANA</h2>
    <h4 class="text-center fw-bold mb-3">FORMAT 12: SEKTOR PERIKANAN</h4>
    <h5 class="text-center mb-4">Kabupaten [nama kabupaten]</h5>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Kerusakan Sektor Perikanan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('forms.form4.format12.store') }}" method="POST">
                @csrf
                <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
                <div class="mb-4">
                    <span class="fw-bold">KABUPATEN:</span>
                    <input type="text" name="kabupaten" class="form-control d-inline-block ms-2" style="width: 300px;">
                </div>
                <div class="mb-4">
                    <span class="fw-bold">NAMA KAMPUNG:</span>
                    <input type="text" name="nama_kampung" class="form-control d-inline-block ms-2" style="width: 300px;">
                </div>
                <div class="mb-4">
                    <span class="fw-bold">NAMA DISTRIK:</span>
                    <input type="text" name="nama_distrik" class="form-control d-inline-block ms-2" style="width: 300px;">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle" style="min-width: 1200px;">
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-middle" style="width: 120px;">Perkiraan Kerusakan</th>
                                <th rowspan="2" class="text-center">Jenis Tempat Pemeliharaan</th>
                                <th rowspan="2" class="text-center">Unit Kerusakan</th>
                                <th rowspan="2" class="text-center">Harga Satuan</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td class="fw-bold bg-secondary text-white">PERKIRAAN KERUSAKAN</td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                            </tr>
                            
                            <!-- KERUSAKAN TEMPAT PEMELIHARAAN -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">a) Kerusakan Tempat Pemeliharaan Ikan (Kolam, Tambak, dsb) dan Peralatannya</td>
                                <td class="text-start"><input type="text" name="komponen[0][0][jenis]" class="form-control form-control-sm" placeholder="Jenis Tempat Pemeliharaan" value=""></td>
                                <td><input type="number" name="komponen[0][0][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][0][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][1][jenis]" class="form-control form-control-sm" placeholder="Jenis Tempat Pemeliharaan" value=""></td>
                                <td><input type="number" name="komponen[0][1][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][1][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][2][jenis]" class="form-control form-control-sm" placeholder="Jenis Tempat Pemeliharaan" value=""></td>
                                <td><input type="number" name="komponen[0][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][2][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>

                            <!-- KERUSAKAN KAPAL MOTOR -->
                            <tr>
                                <td></td>
                                <td>Jenis Kapal Motor/Perahu Nelayan</td>
                            </tr>
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">b) Kerusakan Kapal Motor/Perahu Nelayan</td>
                                <td class="text-start"><input type="text" name="komponen[1][0][jenis]" class="form-control form-control-sm" placeholder="Jenis Kapal Motor/Perahu Nelayan" value=""></td>
                                <td><input type="number" name="komponen[1][0][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][0][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[1][1][jenis]" class="form-control form-control-sm" placeholder="Jenis Kapal Motor/Perahu Nelayan" value=""></td>
                                <td><input type="number" name="komponen[1][1][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][1][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[1][2][jenis]" class="form-control form-control-sm" placeholder="Jenis Kapal Motor/Perahu Nelayan" value=""></td>
                                <td><input type="number" name="komponen[1][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][2][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>

                            <!-- KERUSAKAN TEMPAT PELELANGAN IKAN -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">c) Kerusakan Tempat Pelelangan Ikan</td>
                                <td class="text-start"><input type="text" name="komponen[2][0][jenis]" class="form-control form-control-sm" placeholder="Jenis Tempat Pelelangan" value=""></td>
                                <td><input type="number" name="komponen[2][0][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][0][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[2][1][jenis]" class="form-control form-control-sm" placeholder="Jenis Tempat Pelelangan" value=""></td>
                                <td><input type="number" name="komponen[2][1][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][1][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[2][2][jenis]" class="form-control form-control-sm" placeholder="Jenis Tempat Pelelangan" value=""></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][2][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold bg-secondary text-white">PERKIRAAN KERUGIAN</td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                            </tr>
                            <tr>
                                <td class="align-middle">A. Produksi Yang Hilang Total</td>
                                <td class="text-center">Jenis Ikan</td>
                                <td class="text-center">Jumlah Produksi Yang Hilang</td>
                                <td class="text-center">Harga Satuan</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td class="align-middle">B. Penurunan Produktifitas</td>
                                <td class="text-center">Jenis Ikan</td>
                                <td class="text-center">Penurunan Produktifitas</td>
                                <td class="text-center">Harga Satuan</td>
                                <td class="text-center">Jangka Waktu Pemulihan</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td class="align-middle">C. Kenaikan Ongkos Produksi</td>
                                <td class="text-center">Jenis Ikan</td>
                                <td class="text-center">Kenaikan Biaya</td>
                                <td class="text-center">Harga Satuan</td>
                                <td class="text-center">Jangka Waktu Pemulihan</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="text" name="komponen[2][2][unit]" class="form-control"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
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
