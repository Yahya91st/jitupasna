@extends('layouts.main')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="text-center fw-bold mb-3">PENGKAJIAN KEBUTUHAN PASCABENCANA</h2>
    <h4 class="text-center fw-bold mb-3">Format 16. Sektor Pemerintahan</h4>
    <h5 class="text-center mb-4">Kabupaten [nama kabupaten]</h5>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Kerusakan Sektor Pemerintahan</h5>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <span class="fw-bold">Kabupaten:</span>
                <input type="text" name="kabupaten" class="form-control d-inline-block ms-2" style="width: 300px;">
            </div>            <form action="{{ route('forms.form4.format16.store') }}" method="POST">
                @csrf
                <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
                
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-middle"></th>
                                <th colspan="3" class="text-center">Jumlah Unit yang Rusak</th>
                                <th colspan="3" class="text-center">HARGA SATUAN</th>
                            </tr>
                            <tr>
                                <th class="text-center">Berat</th>
                                <th class="text-center">Sedang</th>
                                <th class="text-center">Ringan</th>
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
                            </tr>
                            
                            <!-- KANTOR PEMKAB -->
                            <tr>
                                <td class="align-middle fw-bold bg-light">Kantor Pemkab</td>
                                <td><input type="number" name="komponen[0][berat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][sedang]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][ringan]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[0][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[0][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            
                            <!-- KANTOR KECAMATAN -->
                            <tr>
                                <td class="align-middle fw-bold bg-light">Kantor Kecamatan</td>
                                <td><input type="number" name="komponen[1][berat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][sedang]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][ringan]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[1][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[1][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[1][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            
                            <!-- KANTOR DINAS -->
                            <tr>
                                <td class="align-middle fw-bold bg-light">Kantor Dinas</td>
                                <td><input type="number" name="komponen[2][berat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][sedang]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][ringan]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[2][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[2][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[2][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            
                            <!-- KANTOR INSTANSI VERTIKAL -->
                            <tr>
                                <td class="align-middle fw-bold bg-light">Kantor Instansi Vertikal/Pemerintah Pusat</td>
                                <td><input type="number" name="komponen[3][berat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[3][sedang]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[3][ringan]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[3][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[3][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[3][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            
                            <!-- MEBELAIR DAN PERALATAN KANTOR -->
                            <tr>
                                <td class="align-middle fw-bold bg-light">Mebelair dan Peralatan Kantor</td>
                                <td><input type="number" name="komponen[4][berat]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[4][sedang]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[4][ringan]" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="komponen[4][rb_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[4][rs_harga]" class="form-control" min="0" step="1000" value="0"></td>
                                <td><input type="number" name="komponen[4][rr_harga]" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- SECTION PERKIRAAN KERUGIAN -->
                <div class="mt-5">
                    <h5 class="fw-bold mb-4 bg-secondary text-white p-3 text-center">PERKIRAAN KERUGIAN</h5>
                    
                    <!-- BIAYA PEMBERSIHAN PUING -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Biaya Pembersihan Puing</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="me-2">A. Biaya Tenaga Kerja</span>
                                    <input type="number" name="biaya_tenaga_kerja_hok" class="form-control me-2" style="width: 100px;" min="0" value="0">
                                    <span>HOK</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="me-2">Rp</span>
                                    <input type="number" name="upah_harian" class="form-control me-2" style="width: 150px;" min="0" step="1000" value="0">
                                    <span>Upah Harian</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <span class="me-2">B. Biaya Alat Berat</span>
                                    <input type="number" name="biaya_alat_berat_hari" class="form-control me-2" style="width: 100px;" min="0" value="0">
                                    <span class="me-2">Hari x Rp</span>
                                    <input type="number" name="biaya_alat_berat_tarif" class="form-control" style="width: 150px;" min="0" step="1000" value="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BIAYA SEWA KANTOR SEMENTARA -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-danger">Biaya Sewa Kantor Sementara</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="me-2">A. Jumlah Unit</span>
                                    <input type="number" name="sewa_kantor_jumlah_unit" class="form-control" style="width: 150px;" min="0" value="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <span class="me-2">B. Biaya Sewa per Unit</span>
                                    <input type="number" name="sewa_kantor_biaya_per_unit" class="form-control" style="width: 150px;" min="0" step="1000" value="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BIAYA RESTORASI ARSIP -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-danger">Biaya Restorasi Arsip</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="me-2">A. JUMLAH ARSIP</span>
                                    <input type="number" name="restorasi_arsip_jumlah" class="form-control" style="width: 150px;" min="0" value="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <span class="me-2">B. Harga Satuan</span>
                                    <input type="number" name="restorasi_arsip_harga_satuan" class="form-control" style="width: 150px;" min="0" step="1000" value="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KEHILANGAN PENDAPATAN RETRIBUSI -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-danger">Kehilangan Pendapatan Retribusi Jasa Pemerintahan</h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Dasar Perhitungan</label>
                                    <textarea name="dasar_perhitungan_retribusi" class="form-control" rows="3" placeholder="Masukkan dasar perhitungan kehilangan pendapatan retribusi..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
