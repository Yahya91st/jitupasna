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
            <form action="{{ route('forms.form4.format11.store') }}" method="POST">
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
                                <td class="text-start"><input type="text" name="kematian_1_jenis" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="kematian_1_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kematian_1_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="kematian_2_jenis" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="kematian_2_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kematian_2_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="kematian_3_jenis" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="kematian_3_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kematian_3_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="kematian_4_jenis" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="kematian_4_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kematian_4_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>

                            <!-- KERUSAKAN KANDANG -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">b) Kerusakan Kandang</td>
                                <td class="text-start"><input type="text" name="kandang_1_jenis" class="form-control form-control-sm" placeholder="Jenis Kandang" value=""></td>
                                <td><input type="number" name="kandang_1_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kandang_1_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="kandang_2_jenis" class="form-control form-control-sm" placeholder="Jenis Kandang" value=""></td>
                                <td><input type="number" name="kandang_2_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kandang_2_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="kandang_3_jenis" class="form-control form-control-sm" placeholder="Jenis Kandang" value=""></td>
                                <td><input type="number" name="kandang_3_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kandang_3_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>

                            <!-- KERUSAKAN PERALATAN KANDANG -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">c) Kerusakan Peralatan Kandang</td>
                                <td class="text-start"><input type="text" name="peralatan_1_jenis" class="form-control form-control-sm" placeholder="Jenis Peralatan" value=""></td>
                                <td><input type="number" name="peralatan_1_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="peralatan_1_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="peralatan_2_jenis" class="form-control form-control-sm" placeholder="Jenis Peralatan" value=""></td>
                                <td><input type="number" name="peralatan_2_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="peralatan_2_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="peralatan_3_jenis" class="form-control form-control-sm" placeholder="Jenis Peralatan" value=""></td>
                                <td><input type="number" name="peralatan_3_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="peralatan_3_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <!-- Produksi yang Hilang Total (3 baris) -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">d) Produksi yang Hilang Total</td>
                                <td class="text-start"><input type="text" name="hilang_1_jenis" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="hilang_1_unit" class="form-control" min="0" value="0" placeholder="Jumlah Unit yang Hilang"></td>
                                <td><input type="number" name="hilang_1_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="hilang_2_jenis" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="hilang_2_unit" class="form-control" min="0" value="0" placeholder="Jumlah Unit yang Hilang"></td>
                                <td><input type="number" name="hilang_2_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="hilang_3_jenis" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="hilang_3_unit" class="form-control" min="0" value="0" placeholder="Jumlah Unit yang Hilang"></td>
                                <td><input type="number" name="hilang_3_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <!-- Penurunan Produktifitas (3 baris) -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">e) Penurunan Produktifitas</td>
                                <td class="text-start"><input type="text" name="produktifitas_1_jenis" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="produktifitas_1_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="produktifitas_1_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="produktifitas_2_jenis" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="produktifitas_2_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="produktifitas_2_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="produktifitas_3_jenis" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="produktifitas_3_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="produktifitas_3_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <!-- Kenaikan Ongkos Produksi (3 baris) -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold bg-light">f) Kenaikan Ongkos Produksi</td>
                                <td class="text-start"><input type="text" name="ongkos_1_jenis" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="ongkos_1_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="ongkos_1_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="ongkos_2_jenis" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="ongkos_2_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="ongkos_2_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            <tr>
                                <td class="text-start"><input type="text" name="ongkos_3_jenis" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="ongkos_3_unit" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="ongkos_3_harga_satuan" class="form-control" min="0" step="1000" value="0"></td>
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