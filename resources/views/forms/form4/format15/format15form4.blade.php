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
            <form action="{{ route('forms.form4.format15.store') }}" method="POST">
                @csrf
                <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
                
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
                                <td class="text-start"><input type="text" name="fasilitas_1_jenis" class="form-control form-control-sm" placeholder="a) Tempat Wisata" value="a) Tempat Wisata"></td>
                                <td><input type="number" name="fasilitas_1_rb_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_1_rs_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_1_rr_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_1_rb_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="fasilitas_1_rs_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="fasilitas_1_rr_harga" class="form-control" min="0" step="any" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="fasilitas_2_jenis" class="form-control form-control-sm" placeholder="b) Hotel dan Restaurant" value="b) Hotel dan Restaurant"></td>
                                <td><input type="number" name="fasilitas_2_rb_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_2_rs_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_2_rr_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_2_rb_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="fasilitas_2_rs_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="fasilitas_2_rr_harga" class="form-control" min="0" step="any" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="fasilitas_3_jenis" class="form-control form-control-sm" placeholder="Jenis Fasilitas Lainnya" value=""></td>
                                <td><input type="number" name="fasilitas_3_rb_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_3_rs_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_3_rr_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_3_rb_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="fasilitas_3_rs_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="fasilitas_3_rr_harga" class="form-control" min="0" step="any" value="0"></td>
                            </tr>
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">B. Hotel Dan Restauran</td>
                                <td class="text-start"><input type="text" name="fasilitas_4_jenis" class="form-control form-control-sm" placeholder="a) Tempat Wisata" value="a) Tempat Wisata"></td>
                                <td><input type="number" name="fasilitas_4_rb_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_4_rs_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_4_rr_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_4_rb_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="fasilitas_4_rs_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="fasilitas_4_rr_harga" class="form-control" min="0" step="any" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="fasilitas_5_jenis" class="form-control form-control-sm" placeholder="b) Hotel dan Restaurant" value="b) Hotel dan Restaurant"></td>
                                <td><input type="number" name="fasilitas_5_rb_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_5_rs_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_5_rr_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_5_rb_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="fasilitas_5_rs_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="fasilitas_5_rr_harga" class="form-control" min="0" step="any" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="fasilitas_6_jenis" class="form-control form-control-sm" placeholder="Jenis Fasilitas Lainnya" value=""></td>
                                <td><input type="number" name="fasilitas_6_rb_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_6_rs_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_6_rr_tingkat" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="fasilitas_6_rb_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="fasilitas_6_rs_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="fasilitas_6_rr_harga" class="form-control" min="0" step="any" value="0"></td>
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
                                <td class="text-start"><input type="text" name="kerugian_1_jenis" class="form-control form-control-sm" placeholder="Jenis Kerugian Pariwisata" value=""></td>
                                <td><input type="number" name="kerugian_1_rb_nilai" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kerugian_1_rs_nilai" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="kerugian_2_jenis" class="form-control form-control-sm" placeholder="Jenis Kerugian Pariwisata" value=""></td>
                                <td><input type="number" name="kerugian_2_rb_nilai" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kerugian_2_rs_nilai" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">B. Penurunan Pendapatan</td>
                                <td>Jenis Fasilitas</td>
                                <td>A. Penurunan Pendapatan</td>
                                <td>B. Jangka Waktu Pemulihan</td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="kerugian_3_jenis" class="form-control form-control-sm" placeholder="Jenis Kerugian Pariwisata" value=""></td>
                                <td><input type="number" name="kerugian_3_rb_nilai" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kerugian_3_rs_nilai" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="kerugian_4_jenis" class="form-control form-control-sm" placeholder="Jenis Kerugian Pariwisata" value=""></td>
                                <td><input type="number" name="kerugian_4_rb_nilai" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kerugian_4_rs_nilai" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td class="align-middle fw-bold bg-light">C. Kenaikan Biaya Produksi</td>
                                <td>Jenis Fasilitas</td>
                                <td>A. Kenaikan Biaya Operasional</td>
                                <td>B. Jangka Waktu Pemulihan</td>
                            </tr>
                            <tr>
                                <td>Biaya Operasional Yang Lebih Tinggi</td>
                                <td class="text-start"><input type="text" name="kerugian_5_jenis" class="form-control form-control-sm" placeholder="Jenis Kerugian Pariwisata" value=""></td>
                                <td><input type="number" name="kerugian_5_rb_nilai" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kerugian_5_rs_nilai" class="form-control" min="0" value="0"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start"><input type="text" name="kerugian_6_jenis" class="form-control form-control-sm" placeholder="Jenis Kerugian Pariwisata" value=""></td>
                                <td><input type="number" name="kerugian_6_rb_nilai" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kerugian_6_rs_nilai" class="form-control" min="0" value="0"></td>
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
