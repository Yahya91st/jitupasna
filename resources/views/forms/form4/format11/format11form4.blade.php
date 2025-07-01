@extends('layouts.main')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="text-center fw-bold mb-3">PENGKAJIAN KEBUTUHAN PASCABENCANA</h2>
    <h4 class="text-center fw-bold mb-3">FORMAT 11: SEKTOR PETERNAKAN</h4>
    <h5 class="text-center mb-4">Kabupaten [nama kabupaten]</h5>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Kerusakan Sektor Peternakan</h5>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <span class="fw-bold">NAMA KAMPUNG:</span>
                <input type="text" name="nama_kampung" class="form-control d-inline-block ms-2" style="width: 300px;">
            </div>
            <div class="mb-4">
                <span class="fw-bold">NAMA DISTRIK:</span>
                <input type="text" name="nama_distrik" class="form-control d-inline-block ms-2" style="width: 300px;">
            </div>

            <form action="{{ route('forms.form4.format11.store') }}" method="POST">
                @csrf
                <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
                
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-middle">Perkiraan Kerusakan</th>
                                <th rowspan="2" class="text-center">Jenis Hewan Ternak</th>
                                <th rowspan="2" class="text-center">Jumlah Unit</th>
                                <th rowspan="2" class="text-center">Harga Satuan Ternak/Produk Ternak (Telur, Susu dsb)</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td colspan="4" class="fw-bold bg-secondary text-white">PERKIRAAN KERUSAKAN</td>
                            </tr>
                            
                            <!-- KEMATIAN HEWAN TERNAK -->
                            <tr>
                                <td rowspan="4" class="align-middle fw-bold bg-light">a) Kematian Hewan Ternak</td>
                                <td class="text-start"><input type="text" name="komponen[0][0][jenis]" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="komponen[0][0][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][0][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][1][jenis]" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="komponen[0][1][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][1][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][2][jenis]" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="komponen[0][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][2][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][3][jenis]" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="komponen[0][3][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][3][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>

                            <!-- KERUSAKAN KANDANG -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">b) Kerusakan Kandang</td>
                                <td class="text-start"><input type="text" name="komponen[1][0][jenis]" class="form-control form-control-sm" placeholder="Jenis Kandang" value=""></td>
                                <td><input type="number" name="komponen[1][0][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][0][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[1][1][jenis]" class="form-control form-control-sm" placeholder="Jenis Kandang" value=""></td>
                                <td><input type="number" name="komponen[1][1][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][1][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[1][2][jenis]" class="form-control form-control-sm" placeholder="Jenis Kandang" value=""></td>
                                <td><input type="number" name="komponen[1][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][2][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>

                            <!-- KERUSAKAN PERALATAN KANDANG -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">c) Kerusakan Peralatan Kandang</td>
                                <td class="text-start"><input type="text" name="komponen[2][0][jenis]" class="form-control form-control-sm" placeholder="Jenis Peralatan" value=""></td>
                                <td><input type="number" name="komponen[2][0][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][0][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[2][1][jenis]" class="form-control form-control-sm" placeholder="Jenis Peralatan" value=""></td>
                                <td><input type="number" name="komponen[2][1][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][1][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[2][2][jenis]" class="form-control form-control-sm" placeholder="Jenis Peralatan" value=""></td>
                                <td><input type="number" name="komponen[2][2][unit]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][2][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td rowspan="4" class="align-middle fw-bold bg-light">d) Produksi yang Hilang Total</td>
                                <td>Jenis Hewan Ternak</td>
                                <td>Jumalh Unit Yang Hilang</td>
                                <th class="text-center">Harga Satuan Ternak/Produk Ternak (Telur, Susu dsb)</th>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[3][0][jenis]" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="komponen[3][0][unit]" class="form-control" min="0" value="0" placeholder="Jumlah Unit yang Hilang"></td>
                                <td><input type="number" name="komponen[3][0][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[3][1][jenis]" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="komponen[3][1][unit]" class="form-control" min="0" value="0" placeholder="Jumlah Unit yang Hilang"></td>
                                <td><input type="number" name="komponen[3][1][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[3][2][jenis]" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="komponen[3][2][unit]" class="form-control" min="0" value="0" placeholder="Jumlah Unit yang Hilang"></td>
                                <td><input type="number" name="komponen[3][2][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td rowspan="4" class="align-middle fw-bold bg-light">E. Penurunan Produktifitas</td>
                                <td>Jenis Hewan Ternak</td>
                                <td>Penurunan Produktifitas Per Hari/Bulan/Tahun</td>
                                <td class="text-center">Harga Satuan Ternak/Produk Ternak (Telur, Susu dsb)</td>
                                <td>Perkiraan Jangka Waktu Pemulihan</td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[3][0][jenis]" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="komponen[3][0][unit]" class="form-control" min="0" value="0" placeholder="Jumlah Unit yang Hilang"></td>
                                <td><input type="number" name="komponen[3][0][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[3][1][jenis]" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="komponen[3][1][unit]" class="form-control" min="0" value="0" placeholder="Jumlah Unit yang Hilang"></td>
                                <td><input type="number" name="komponen[3][1][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[3][2][jenis]" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="komponen[3][2][unit]" class="form-control" min="0" value="0" placeholder="Jumlah Unit yang Hilang"></td>
                                <td><input type="number" name="komponen[3][2][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td rowspan="4" class="align-middle fw-bold bg-light">F. Kenaikan Ongkos Produksi</td>
                                <td>Jenis Hewan Ternak</td>
                                <td>Kenaikan Ongkos Produksi</td>
                                <td class="text-center">Jumlah Hewan Yang Terpengaruh</td>
                                <td>Perkiraan Jangka Waktu Pemulihan</td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[3][0][jenis]" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="komponen[3][0][unit]" class="form-control" min="0" value="0" placeholder="Jumlah Unit yang Hilang"></td>
                                <td><input type="number" name="komponen[3][0][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[3][1][jenis]" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="komponen[3][1][unit]" class="form-control" min="0" value="0" placeholder="Jumlah Unit yang Hilang"></td>
                                <td><input type="number" name="komponen[3][1][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[3][2][jenis]" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="komponen[3][2][unit]" class="form-control" min="0" value="0" placeholder="Jumlah Unit yang Hilang"></td>
                                <td><input type="number" name="komponen[3][2][harga_satuan]" class="form-control" min="0" step="1000" value="0"></td>
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