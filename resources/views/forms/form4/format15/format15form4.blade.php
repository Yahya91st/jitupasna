@extends('layouts.main')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="text-center fw-bold mb-3">PENGKAJIAN KEBUTUHAN PASCABENCANA</h2>
    <h4 class="text-center fw-bold mb-3">FORMAT 15: SEKTOR PARIWISATA</h4>
    <h5 class="text-center mb-4">Kabupaten [nama kabupaten]</h5>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Kerusakan Sektor Pariwisata</h5>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <span class="fw-bold">KABUPATEN:</span>
                <input type="text" name="kabupaten" class="form-control d-inline-block ms-2" style="width: 300px;">
            </div>            <form action="{{ route('forms.form4.format15.store') }}" method="POST">
                @csrf
                <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
                
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-middle"></th>
                                <th rowspan="2" class="text-center">JENIS FASILITAS</th>
                                <th colspan="3" class="text-center">TINGKAT KERUSAKAN</th>
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
                            
                            <!-- TEMPAT WISATA -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">A. Tempat Wisata</td>
                                <td class="text-start"><input type="text" name="komponen[0][0][jenis_fasilitas]" class="form-control form-control-sm" placeholder="a) Tempat Wisata" value="a) Tempat Wisata"></td>
                                <td><input type="number" name="komponen[0][0][rb_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][0][rs_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][0][rr_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][0][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][0][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][0][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][1][jenis_fasilitas]" class="form-control form-control-sm" placeholder="b) Hotel dan Restaurant" value="b) Hotel dan Restaurant"></td>
                                <td><input type="number" name="komponen[0][1][rb_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][1][rs_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][1][rr_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][1][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][1][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][1][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][2][jenis_fasilitas]" class="form-control form-control-sm" placeholder="Jenis Fasilitas Lainnya" value=""></td>
                                <td><input type="number" name="komponen[0][2][rb_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][2][rs_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][2][rr_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][2][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][2][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][2][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">B. Hotel Dan Restauran</td>
                                <td class="text-start"><input type="text" name="komponen[0][0][jenis_fasilitas]" class="form-control form-control-sm" placeholder="a) Tempat Wisata" value="a) Tempat Wisata"></td>
                                <td><input type="number" name="komponen[0][0][rb_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][0][rs_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][0][rr_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][0][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][0][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][0][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][1][jenis_fasilitas]" class="form-control form-control-sm" placeholder="b) Hotel dan Restaurant" value="b) Hotel dan Restaurant"></td>
                                <td><input type="number" name="komponen[0][1][rb_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][1][rs_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][1][rr_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][1][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][1][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][1][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="komponen[0][2][jenis_fasilitas]" class="form-control form-control-sm" placeholder="Jenis Fasilitas Lainnya" value=""></td>
                                <td><input type="number" name="komponen[0][2][rb_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][2][rs_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][2][rr_tingkat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][2][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][2][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][2][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            
                            <!-- PERKIRAAN KERUGIAN -->
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
                                <td rowspan="3" class="align-middle fw-bold bg-light">A. Kehilangan Total Pendapatan</td>
                                <td>Jenis Fasilitas</td>
                                <td>A. Pendapatan Normal Rata-rata</td>
                                <td>B. Jangka Waktu Pemulihan</td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="kerugian[0][1][jenis_kerugian]" class="form-control form-control-sm" placeholder="Jenis Kerugian Pariwisata" value=""></td>
                                <td><input type="number" name="kerugian[0][1][rb_nilai]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kerugian[0][1][rs_nilai]" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="kerugian[0][2][jenis_kerugian]" class="form-control form-control-sm" placeholder="Jenis Kerugian Pariwisata" value=""></td>
                                <td><input type="number" name="kerugian[0][2][rb_nilai]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kerugian[0][2][rs_nilai]" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">B. Penurunan Pendapatan</td>
                                <td>Jenis Fasilitas</td>
                                <td>A. Penurunan Pendapatan</td>
                                <td>B. Jangka Waktu Pemulihan</td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="kerugian[0][1][jenis_kerugian]" class="form-control form-control-sm" placeholder="Jenis Kerugian Pariwisata" value=""></td>
                                <td><input type="number" name="kerugian[0][1][rb_nilai]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kerugian[0][1][rs_nilai]" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="kerugian[0][2][jenis_kerugian]" class="form-control form-control-sm" placeholder="Jenis Kerugian Pariwisata" value=""></td>
                                <td><input type="number" name="kerugian[0][2][rb_nilai]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kerugian[0][2][rs_nilai]" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td class="align-middle fw-bold bg-light">C. Kenaikan Biaya Produksi</td>
                                <td>Jenis Fasilitas</td>
                                <td>A. Kenaikan Biaya Operasional</td>
                                <td>B. Jangka Waktu Pemulihan</td>
                            </tr>
                            <tr>
                                <td>Biaya Operasional Yang Lebih Tinggi</td>
                                <td class="text-start"><input type="text" name="kerugian[0][1][jenis_kerugian]" class="form-control form-control-sm" placeholder="Jenis Kerugian Pariwisata" value=""></td>
                                <td><input type="number" name="kerugian[0][1][rb_nilai]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kerugian[0][1][rs_nilai]" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start"><input type="text" name="kerugian[0][2][jenis_kerugian]" class="form-control form-control-sm" placeholder="Jenis Kerugian Pariwisata" value=""></td>
                                <td><input type="number" name="kerugian[0][2][rb_nilai]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kerugian[0][2][rs_nilai]" class="form-control" min="0" value="0"></td>
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
