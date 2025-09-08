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
<div class="container-fluid mt-4">
    <h2 class="text-center fw-bold mb-3">PENGKAJIAN KEBUTUHAN PASCABENCANA</h2>
    <h4 class="text-center fw-bold mb-3">FORMAT 14: SEKTOR PERDAGANGAN</h4>
    <h5 class="text-center mb-4">Kabupaten [nama kabupaten]</h5>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Kerusakan Sektor Perdagangan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('forms.form4.format14.store') }}" method="POST">
                @csrf
                <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
                
                <div class="mb-4">
                    <span class="fw-bold">NAMA KAMPUNG:</span>
                    <input type="text" name="nama_kampung" class="form-control d-inline-block ms-2" style="width: 300px;" value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}">
                </div>
                <div class="mb-4">
                    <span class="fw-bold">NAMA DISTRIK:</span>
                    <input type="text" name="nama_distrik" class="form-control d-inline-block ms-2" style="width: 300px;" value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle" style="width: 100%;">
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
                                <td class="text-start"><input type="text" name="tempatusaha_1_jenis" class="form-control form-control-sm" placeholder="Jenis Tempat Usaha" value=""></td>
                                <td><input type="number" name="tempatusaha_1_rb_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="tempatusaha_1_rs_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="tempatusaha_1_rr_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="tempatusaha_1_rb_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="tempatusaha_1_rs_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="tempatusaha_1_rr_harga" class="form-control" min="0" step="any" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="tempatusaha_2_jenis" class="form-control form-control-sm" placeholder="Jenis Tempat Usaha" value=""></td>
                                <td><input type="number" name="tempatusaha_2_rb_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="tempatusaha_2_rs_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="tempatusaha_2_rr_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="tempatusaha_2_rb_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="tempatusaha_2_rs_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="tempatusaha_2_rr_harga" class="form-control" min="0" step="any" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="tempatusaha_3_jenis" class="form-control form-control-sm" placeholder="Jenis Tempat Usaha" value=""></td>
                                <td><input type="number" name="tempatusaha_3_rb_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="tempatusaha_3_rs_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="tempatusaha_3_rr_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="tempatusaha_3_rb_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="tempatusaha_3_rs_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="tempatusaha_3_rr_harga" class="form-control" min="0" step="any" value="0"></td>
                            </tr>
                            
                            <!-- PERALATAN -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">b) Peralatan</td>
                                <td class="text-start"><input type="text" name="peralatan_1_jenis" class="form-control form-control-sm" placeholder="Jenis Peralatan" value=""></td>
                                <td><input type="number" name="peralatan_1_rb_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="peralatan_1_rs_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="peralatan_1_rr_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="peralatan_1_rb_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="peralatan_1_rs_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="peralatan_1_rr_harga" class="form-control" min="0" step="any" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="peralatan_2_jenis" class="form-control form-control-sm" placeholder="Jenis Peralatan" value=""></td>
                                <td><input type="number" name="peralatan_2_rb_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="peralatan_2_rs_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="peralatan_2_rr_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="peralatan_2_rb_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="peralatan_2_rs_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="peralatan_2_rr_harga" class="form-control" min="0" step="any" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="peralatan_3_jenis" class="form-control form-control-sm" placeholder="Jenis Peralatan" value=""></td>
                                <td><input type="number" name="peralatan_3_rb_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="peralatan_3_rs_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="peralatan_3_rr_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="peralatan_3_rb_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="peralatan_3_rs_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="peralatan_3_rr_harga" class="form-control" min="0" step="any" value="0"></td>
                            </tr>
                            
                            <!-- BARANG DAGANGAN -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">c) Barang Dagangan</td>
                                <td class="text-start"><input type="text" name="barangdagangan_1_jenis" class="form-control form-control-sm" placeholder="Jenis Barang Dagangan" value=""></td>
                                <td><input type="number" name="barangdagangan_1_rb_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="barangdagangan_1_rs_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="barangdagangan_1_rr_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="barangdagangan_1_rb_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="barangdagangan_1_rs_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="barangdagangan_1_rr_harga" class="form-control" min="0" step="any" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="barangdagangan_2_jenis" class="form-control form-control-sm" placeholder="Jenis Barang Dagangan" value=""></td>
                                <td><input type="number" name="barangdagangan_2_rb_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="barangdagangan_2_rs_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="barangdagangan_2_rr_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="barangdagangan_2_rb_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="barangdagangan_2_rs_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="barangdagangan_2_rr_harga" class="form-control" min="0" step="any" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="barangdagangan_3_jenis" class="form-control form-control-sm" placeholder="Jenis Barang Dagangan" value=""></td>
                                <td><input type="number" name="barangdagangan_3_rb_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="barangdagangan_3_rs_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="barangdagangan_3_rr_jumlah" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="barangdagangan_3_rb_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="barangdagangan_3_rs_harga" class="form-control" min="0" step="any" value="0"></td>
                                <td><input type="number" name="barangdagangan_3_rr_harga" class="form-control" min="0" step="any" value="0"></td>
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
