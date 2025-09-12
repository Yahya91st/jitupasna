@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Edit Data Sektor Perlindungan Sosial (Format 4)</h5>
    
    <form action="{{ route('forms.form4.update-format4', $formSosial->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="bencana_id" value="{{ $bencana->id }}">
        
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">NAMA KAMPUNG</span>
                    <input type="text" class="form-control" name="nama_kampung" value="{{ $formSosial->nama_kampung }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">NAMA DISTRIK</span>
                    <input type="text" class="form-control" name="nama_distrik" value="{{ $formSosial->nama_distrik }}" required>
                </div>
            </div>
        </div>

        <p><strong>A. Kerusakan Fisik Bangunan / Sarana Pelayanan Sosial</strong></p>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th rowspan="2">Jenis Bangunan</th>
                        <th colspan="6">Jumlah Unit Rusak</th>
                        <th rowspan="2">Rata-rata Luas Bangunan</th>
                        <th rowspan="2">Harga Satuan Bangunan/m²</th>
                    </tr>
                    <tr>
                        <th>Berat Negeri</th>
                        <th>Berat Swasta</th>
                        <th>Sedang Negeri</th>
                        <th>Sedang Swasta</th>
                        <th>Ringan Negeri</th>
                        <th>Ringan Swasta</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Panti Asuhan</td>
                        <td><input type="number" class="form-control" name="panti_sosial_rb_negeri" value="{{ $formSosial->panti_sosial_rb_negeri }}"></td>
                        <td><input type="number" class="form-control" name="panti_sosial_rb_swasta" value="{{ $formSosial->panti_sosial_rb_swasta }}"></td>
                        <td><input type="number" class="form-control" name="panti_sosial_rs_negeri" value="{{ $formSosial->panti_sosial_rs_negeri }}"></td>
                        <td><input type="number" class="form-control" name="panti_sosial_rs_swasta" value="{{ $formSosial->panti_sosial_rs_swasta }}"></td>
                        <td><input type="number" class="form-control" name="panti_sosial_rr_negeri" value="{{ $formSosial->panti_sosial_rr_negeri }}"></td>
                        <td><input type="number" class="form-control" name="panti_sosial_rr_swasta" value="{{ $formSosial->panti_sosial_rr_swasta }}"></td>
                        <td><input type="text" class="form-control" name="panti_sosial_luas" value="{{ $formSosial->panti_sosial_luas }}"></td>
                        <td><input type="number" class="form-control" name="panti_sosial_harga_bangunan" value="{{ $formSosial->panti_sosial_harga_bangunan }}"></td>
                    </tr>
                    <tr>
                        <td>Panti Wredha</td>
                        <td><input type="number" class="form-control" name="panti_asuhan_rb_negeri" value="{{ $formSosial->panti_asuhan_rb_negeri }}"></td>
                        <td><input type="number" class="form-control" name="panti_asuhan_rb_swasta" value="{{ $formSosial->panti_asuhan_rb_swasta }}"></td>
                        <td><input type="number" class="form-control" name="panti_asuhan_rs_negeri" value="{{ $formSosial->panti_asuhan_rs_negeri }}"></td>
                        <td><input type="number" class="form-control" name="panti_asuhan_rs_swasta" value="{{ $formSosial->panti_asuhan_rs_swasta }}"></td>
                        <td><input type="number" class="form-control" name="panti_asuhan_rr_negeri" value="{{ $formSosial->panti_asuhan_rr_negeri }}"></td>
                        <td><input type="number" class="form-control" name="panti_asuhan_rr_swasta" value="{{ $formSosial->panti_asuhan_rr_swasta }}"></td>
                        <td><input type="text" class="form-control" name="panti_asuhan_luas" value="{{ $formSosial->panti_asuhan_luas }}"></td>
                        <td><input type="number" class="form-control" name="panti_asuhan_harga_bangunan" value="{{ $formSosial->panti_asuhan_harga_bangunan }}"></td>
                    </tr>
                    <tr>
                        <td>Panti Tuna Grahita</td>
                        <td><input type="number" class="form-control" name="balai_pelayanan_rb_negeri" value="{{ $formSosial->balai_pelayanan_rb_negeri }}"></td>
                        <td><input type="number" class="form-control" name="balai_pelayanan_rb_swasta" value="{{ $formSosial->balai_pelayanan_rb_swasta }}"></td>
                        <td><input type="number" class="form-control" name="balai_pelayanan_rs_negeri" value="{{ $formSosial->balai_pelayanan_rs_negeri }}"></td>
                        <td><input type="number" class="form-control" name="balai_pelayanan_rs_swasta" value="{{ $formSosial->balai_pelayanan_rs_swasta }}"></td>
                        <td><input type="number" class="form-control" name="balai_pelayanan_rr_negeri" value="{{ $formSosial->balai_pelayanan_rr_negeri }}"></td>
                        <td><input type="number" class="form-control" name="balai_pelayanan_rr_swasta" value="{{ $formSosial->balai_pelayanan_rr_swasta }}"></td>
                        <td><input type="text" class="form-control" name="balai_pelayanan_luas" value="{{ $formSosial->balai_pelayanan_luas }}"></td>
                        <td><input type="number" class="form-control" name="balai_pelayanan_harga_bangunan" value="{{ $formSosial->balai_pelayanan_harga_bangunan }}"></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Lainnya:</span>
                                <input type="text" class="form-control" name="lainnya_jenis" value="{{ $formSosial->lainnya_jenis }}">
                            </div>
                        </td>
                        <td><input type="number" class="form-control" name="lainnya_rb_negeri" value="{{ $formSosial->lainnya_rb_negeri }}"></td>
                        <td><input type="number" class="form-control" name="lainnya_rb_swasta" value="{{ $formSosial->lainnya_rb_swasta }}"></td>
                        <td><input type="number" class="form-control" name="lainnya_rs_negeri" value="{{ $formSosial->lainnya_rs_negeri }}"></td>
                        <td><input type="number" class="form-control" name="lainnya_rs_swasta" value="{{ $formSosial->lainnya_rs_swasta }}"></td>
                        <td><input type="number" class="form-control" name="lainnya_rr_negeri" value="{{ $formSosial->lainnya_rr_negeri }}"></td>
                        <td><input type="number" class="form-control" name="lainnya_rr_swasta" value="{{ $formSosial->lainnya_rr_swasta }}"></td>
                        <td><input type="text" class="form-control" name="lainnya_luas" value="{{ $formSosial->lainnya_luas }}"></td>
                        <td><input type="number" class="form-control" name="lainnya_harga_bangunan" value="{{ $formSosial->lainnya_harga_bangunan }}"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h6 class="fw-bold mt-4">B. Perkiraan Kerugian</h6>
        
        <div class="card mb-3">
            <div class="card-header py-1 small fw-bold">1) Biaya Pembersihan Puing</div>
            <div class="card-body py-2">
                <div class="input-group input-group-sm mb-2">
                    <span class="input-group-text">A. Biaya Tenaga Kerja</span>
                    <input type="number" class="form-control" name="biaya_tenaga_kerja_hok" value="{{ $formSosial->biaya_tenaga_kerja_hok }}">
                    <span class="input-group-text">x Rp</span>
                    <input type="number" class="form-control" name="biaya_tenaga_kerja_upah" value="{{ $formSosial->biaya_tenaga_kerja_upah }}">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-text">B. Biaya Alat Berat</span>
                    <input type="number" class="form-control" name="biaya_alat_berat_hari" value="{{ $formSosial->biaya_alat_berat_hari }}">
                    <span class="input-group-text">x Rp</span>
                    <input type="number" class="form-control" name="biaya_alat_berat_harga" value="{{ $formSosial->biaya_alat_berat_harga }}">
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header py-1 small fw-bold">2) Biaya Penyediaan Jatah Hidup</div>
            <div class="card-body py-2">
                <div class="input-group input-group-sm mb-2">
                    <span class="input-group-text">Perkiraan Jumlah Pengungsi</span>
                    <input type="number" class="form-control" name="jumlah_penerima" value="{{ $formSosial->jumlah_penerima }}">
                </div>
                <div class="input-group input-group-sm mb-2">
                    <span class="input-group-text">Rata rata biaya penanganan pengungsi</span>
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" name="bantuan_per_orang" value="{{ $formSosial->bantuan_per_orang }}">
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header py-1 small fw-bold">3) Tambahan Biaya Sosial</div>
            <div class="card-body py-2">
                <div class="input-group input-group-sm mb-2">
                    <span class="input-group-text">Biaya Pelayanan Kesehatan</span>
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" name="biaya_pelayanan_kesehatan" value="{{ $formSosial->biaya_pelayanan_kesehatan }}">
                </div>
                <div class="input-group input-group-sm mb-2">
                    <span class="input-group-text">Biaya Pelayanan Pendidikan</span>
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" name="biaya_pelayanan_pendidikan" value="{{ $formSosial->biaya_pelayanan_pendidikan }}">
                </div>
                <div class="input-group input-group-sm mb-2">
                    <span class="input-group-text">Biaya Pendampingan Psikososial</span>
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" name="biaya_pendampingan_psikososial" value="{{ $formSosial->biaya_pendampingan_psikososial }}">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-text">Biaya Pelatihan Darurat</span>
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" name="biaya_pelatihan_darurat" value="{{ $formSosial->biaya_pelatihan_darurat }}">
                </div>
            </div>
        </div>
        
        <div class="text-center mt-3 mb-5">
            <button type="submit" class="btn btn-success">Update Data</button>
            <a href="{{ route('forms.form4.list-format4', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
