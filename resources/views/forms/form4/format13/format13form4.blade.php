@extends('layouts.main')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="text-center fw-bold mb-3">PENGKAJIAN KEBUTUHAN PASCABENCANA</h2>
    <h4 class="text-center fw-bold mb-3">FORMAT 13: SEKTOR INDUSTRI DAN UMKM</h4>
    <h5 class="text-center mb-4">Kabupaten [nama kabupaten]</h5>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Kerusakan Sektor Industri dan UMKM</h5>
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
            </div>            <form action="{{ route('forms.form4.format13.store') }}" method="POST">
                @csrf
                <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
                
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead>
                            <tr>
                                <th rowspan="2"></th>
                                <th rowspan="2" class="align-middle">JENIS KOMODITI</th>
                                <th colspan="3" class="text-center">JUMLAH KERUSAKAN</th>
                                <th colspan="3" class="text-center">HARGA SATUAN/M2</th>
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
                                <td class="fw-bold bg-secondary text-white">Perkiraan Kerusakan</td>
                            </tr>
                            
                            <!-- PABRIK/TEMPAT USAHA -->
                            <tr>
                                <td class="align-middle fw-bold bg-light">a) Pabrik/tempat usaha</td>
                                <td><input type="text"></td>
                                <td><input type="number" name="komponen[0][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][rs_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][rr_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            
                            <!-- MESIN DAN PERALATAN -->
                            <tr>
                                <td class="align-middle fw-bold bg-light">b) Mesin dan peralatan</td>
                                <td><input type="text"></td>
                                <td><input type="number" name="komponen[1][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][rs_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][rr_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[1][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[1][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            
                            <!-- BAHAN BAKU -->
                            <tr>
                                <td class="align-middle fw-bold bg-light">c) Bahan baku</td>
                                <td><input type="text"></td>
                                <td><input type="number" name="komponen[2][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][rs_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][rr_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[2][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[2][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            
                            <!-- BAHAN JADI -->
                            <tr>
                                <td class="align-middle fw-bold bg-light">d) Bahan jadi</td>
                                <td><input type="text"></td>
                                <td><input type="number" name="komponen[3][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[3][rs_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[3][rr_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[3][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[3][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[3][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold bg-secondary text-white">Perkiraan Kerugian</td>
                            </tr>
                            <tr>
                                    <td>A. Kehilangan Total Produksi</td>
                                    <td class="text-center">A: Jenis Komoditi</td>
                                    <td class="text-center">B: Jumlah Produksi</td>
                                    <td class="text-center">C: Harga Satuan</td>
                            </tr>
                            <tr>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="number" name="komponen[3][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[3][rs_jumlah]" class="form-control" min="0" value="0"></td>                                
                            </tr>
                            <tr>
                                    <td>B. Penurunan Produktifitas</td>
                                    <td class="text-center">A: Jenis Komoditi</td>
                                    <td class="text-center">B: Produksi Sebelum Bencana</td>
                                    <td class="text-center">C: Produksi Sesudah Bencana</td>
                                    <td class="text-center">D: Harga Satuan</td>
                            </tr>
                            <tr>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="number" name="komponen[3][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[3][rs_jumlah]" class="form-control" min="0" value="0"></td>                                
                                <td><input type="number" name="komponen[3][rs_jumlah]" class="form-control" min="0" value="0"></td>                                
                            </tr>
                            <tr>
                                    <td>C. Kenaikan Ongkos Produksi</td>
                                </tr>
                                <tr>
                                    <td class="text-center">Biaya Bahan Baku Yang Lebih Tinggi</td>
                                    <td class="text-center">A: Jenis Produk</td>
                                    <td class="text-center">B: Biaya Sebelum Bencana</td>
                                    <td class="text-center">C: Biaya Sesudah Bencana</td>
                                    <td class="text-center">D: Harga Satuan</td>
                                </tr>
                                <tr>
                                    <td><input type="text"></td>
                                    <td><input type="text"></td>
                                    <td><input type="number" name="komponen[3][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                    <td><input type="number" name="komponen[3][rs_jumlah]" class="form-control" min="0" value="0"></td>                                
                                    <td><input type="number" name="komponen[3][rs_jumlah]" class="form-control" min="0" value="0"></td>                                
                                </tr>
                                <tr>
                                    <td class="text-center">Biaya Operasional Yang Lebih Tinggi</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text"></td>
                                    <td><input type="text"></td>
                                    <td><input type="number" name="komponen[3][rb_jumlah]" class="form-control" min="0" value="0"></td>
                                    <td><input type="number" name="komponen[3][rs_jumlah]" class="form-control" min="0" value="0"></td>                                
                                    <td><input type="number" name="komponen[3][rs_jumlah]" class="form-control" min="0" value="0"></td>                                
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
