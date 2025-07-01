@extends('layouts.main')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="text-center fw-bold mb-3">PENGKAJIAN KEBUTUHAN PASCABENCANA</h2>
    <h4 class="text-center fw-bold mb-3">FORMAT 14: SEKTOR PERDAGANGAN</h4>
    <h5 class="text-center mb-4">Kabupaten [nama kabupaten]</h5>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Kerusakan Sektor Perdagangan</h5>
        </div>
        <div class="card-body">
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
            </div>            <form action="{{ route('forms.form4.format14.store') }}" method="POST">
                @csrf
                <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
                
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-middle"></th>
                                <th rowspan="2" class="text-center">JENIS TEMPAT USAHA</th>
                                <th colspan="3" class="text-center">JUMLAH KERUSAKAN</th>
                                <th colspan="3" class="text-center">HARGA SATUAN</th>
                            </tr>
                            <tr>
                                <th class="text-center">RB</th>
                                <th class="text-center">RS</th>
                                <th class="text-center">RR</th>
                                <th class="text-center">RB</th>
                                <th class="text-center">RS</th>
                                <th class="text-center">RR</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td class="fw-bold bg-secondary text-white">PERKIRAAN KERUSAKAN</td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                            </tr>
                            
                            <!-- TEMPAT USAHA -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">a) Tempat usaha (Pasar, Warung, Toko)</td>
                                <td class="text-start"><input type="text" name="komponen[0][0][jenis]" class="form-control form-control-sm" placeholder="Jenis Tempat Usaha" value=""></td>
                                <td><input type="number" name="komponen[0][0][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][0][rs_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][0][rr_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][0][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][0][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][0][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][1][jenis]" class="form-control form-control-sm" placeholder="Jenis Tempat Usaha" value=""></td>
                                <td><input type="number" name="komponen[0][1][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][1][rs_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][1][rr_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][1][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][1][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][1][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][2][jenis]" class="form-control form-control-sm" placeholder="Jenis Tempat Usaha" value=""></td>
                                <td><input type="number" name="komponen[0][2][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][2][rs_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][2][rr_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][2][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][2][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][2][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            
                            <!-- PERALATAN -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">b) Peralatan</td>
                                <td class="text-start"><input type="text" name="komponen[1][0][jenis]" class="form-control form-control-sm" placeholder="Jenis Peralatan" value=""></td>
                                <td><input type="number" name="komponen[1][0][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][0][rs_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][0][rr_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][0][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[1][0][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[1][0][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[1][1][jenis]" class="form-control form-control-sm" placeholder="Jenis Peralatan" value=""></td>
                                <td><input type="number" name="komponen[1][1][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][1][rs_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][1][rr_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][1][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[1][1][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[1][1][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[1][2][jenis]" class="form-control form-control-sm" placeholder="Jenis Peralatan" value=""></td>
                                <td><input type="number" name="komponen[1][2][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][2][rs_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][2][rr_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][2][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[1][2][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[1][2][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            
                            <!-- BARANG DAGANGAN -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">c) Barang Dagangan</td>
                                <td class="text-start"><input type="text" name="komponen[2][0][jenis]" class="form-control form-control-sm" placeholder="Jenis Barang Dagangan" value=""></td>
                                <td><input type="number" name="komponen[2][0][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][0][rs_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][0][rr_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][0][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[2][0][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[2][0][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[2][1][jenis]" class="form-control form-control-sm" placeholder="Jenis Barang Dagangan" value=""></td>
                                <td><input type="number" name="komponen[2][1][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][1][rs_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][1][rr_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][1][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[2][1][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[2][1][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[2][2][jenis]" class="form-control form-control-sm" placeholder="Jenis Barang Dagangan" value=""></td>
                                <td><input type="number" name="komponen[2][2][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][2][rs_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][2][rr_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][2][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[2][2][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[2][2][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold bg-secondary text-white">PERKIRAAN KERUGIAN</td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                                <td class="fw-bold bg-secondary text-white"></td>
                            </tr>
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">A. Kehilangan Penjualan Total</td>
                                <td>Nama Tempat Usaha : Pasar/Warung/Kios</td>
                                <td>A. Penjualan Normal Per Minggu/Bulan</td>
                                <td>B. Perkiraan Jangka Waktu Pemulihan</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>    
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">B. Penurunan Prodduktifitas</td>
                                <td>Nama Tempat Usaha : Pasar/Warung/Kios</td>
                                <td>A. Penjualan Normal Per Minggu/Bulan</td>
                                <td>B. Perkiraan Jangka Waktu Pemulihan</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>    
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">C. Kenaikan Biaya Produksi</td>
                                <td>Nama Tempat Usaha : Pasar/Warung/Kios</td>
                                <td>A. Kenaikai Biaya Operasional</td>
                                <td>B. Perkiraan Jangka Waktu Pemulihan</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>    
                            </tr>
                            <tr>
                                <td>Kenaikan Biaya Operasional Yang Lebih Tinggi</td>
                            </tr>
                            <tr>
                                <td></td>
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
