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
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengkajian Kebutuhan Pasca Bencana</h5>
    <p class="fw-bold">Format 11: Sektor Peternakan</p>

    <table class="table table-bordered">
            <tr>
                <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
            </tr>
        </table>
            <form action="{{ route('forms.form4.format11.store') }}" method="POST">
                @csrf
                <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
                
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle" style="width: 100%;">
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
                                <td rowspan="3" class="align-middle fw-bold ">a) Kematian Hewan Ternak</td>
                                <td class="text-start"><input type="text" name="kematian_jenis_0" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="kematian_unit_0" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kematian_harga_satuan_0" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            @for ($i = 1; $i <= 2; $i++)
                            
                            <tr>
                                <td class="text-start"><input type="text" name="kematian_jenis_{{ $i }}" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="kematian_unit_{{ $i }}" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kematian_harga_satuan_{{ $i }}" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            @endfor

                            <!-- KERUSAKAN KANDANG -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold ">b) Kerusakan Kandang</td>
                                <td class="text-start"><input type="text" name="kandang_jenis_0" class="form-control form-control-sm" placeholder="Jenis Kandang" value=""></td>
                                <td><input type="number" name="kandang_unit_0" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kandang_harga_satuan_0" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            @for ($i = 1; $i <= 2; $i++)
                            
                            <tr>
                                <td class="text-start"><input type="text" name="kandang_jenis_{{ $i }}" class="form-control form-control-sm" placeholder="Jenis Kandang" value=""></td>
                                <td><input type="number" name="kandang_unit_{{ $i }}" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="kandang_harga_satuan_{{ $i }}" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            @endfor

                            <!-- KERUSAKAN PERALATAN KANDANG -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold ">c) Kerusakan Peralatan Kandang</td>
                                <td class="text-start"><input type="text" name="peralatan_jenis_0" class="form-control form-control-sm" placeholder="Jenis Peralatan" value=""></td>
                                <td><input type="number" name="peralatan_unit_0" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="peralatan_harga_satuan_0" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            @for ($i = 1; $i <= 2; $i++)                            
                            <tr>
                                <td class="text-start"><input type="text" name="peralatan_jenis_{{ $i }}" class="form-control form-control-sm" placeholder="Jenis Peralatan" value=""></td>
                                <td><input type="number" name="peralatan_unit_{{ $i }}" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="peralatan_harga_satuan_{{ $i }}" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            @endfor
                            <!-- Produksi yang Hilang Total (3 baris) -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold ">d) Produksi yang Hilang Total</td>
                                <td class="text-start"><input type="text" name="hilang_jenis_0" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="hilang_unit_0" class="form-control" min="0" value="0" placeholder="Jumlah Unit yang Hilang"></td>
                                <td><input type="number" name="hilang_harga_satuan_0" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            @for ($i = 1; $i <= 2; $i++)
                            <tr>
                                <td class="text-start"><input type="text" name="hilang_jenis_{{ $i }}" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="hilang_unit_{{ $i }}" class="form-control" min="0" value="0" placeholder="Jumlah Unit yang Hilang"></td>
                                <td><input type="number" name="hilang_harga_satuan_{{ $i }}" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            @endfor
                            <!-- Penurunan Produktifitas (3 baris) -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold ">e) Penurunan Produktifitas</td>
                                <td class="text-start"><input type="text" name="produktifitas_jenis_0" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="produktifitas_unit_0" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="produktifitas_harga_satuan_0" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            @for ($i = 1; $i <= 2; $i++)
                            
                            <tr>
                                <td class="text-start"><input type="text" name="produktifitas_jenis_{{ $i }}" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="produktifitas_unit_{{ $i }}" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="produktifitas_harga_satuan_{{ $i }}" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            @endfor
                            <!-- Kenaikan Ongkos Produksi (3 baris) -->
                            <tr>
                                <td rowspan="3" class="align-middle fw-bold ">f) Kenaikan Ongkos Produksi</td>
                                <td class="text-start"><input type="text" name="ongkos_jenis_0" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="ongkos_unit_0" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="ongkos_harga_satuan_0" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            @for ($i = 1; $i <= 2; $i++)                            
                            <tr>
                                <td class="text-start"><input type="text" name="ongkos_jenis_{{ $i }}" class="form-control form-control-sm" placeholder="Jenis Hewan Ternak" value=""></td>
                                <td><input type="number" name="ongkos_unit_{{ $i }}" class="form-control" min="0" value="0"></td>
                                <td><input type="number" name="ongkos_harga_satuan_{{ $i }}" class="form-control" min="0" step="1000" value="0"></td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
</div>
@endsection
