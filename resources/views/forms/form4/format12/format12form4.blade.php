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
    <p class="fw-bold">Format 12: Sektor Perikanan</p>
    <table class="table table-bordered">
    <tr>
        <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
        <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
    </tr>
    </table>
    <form action="{{ route('forms.form4.format12.store') }}" method="POST">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">            
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle" style="width: 100%;">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle" style="width: 120px;">Perkiraan Kerusakan</th>
                        <th rowspan="2" class="text-center">Jenis Tempat Pemeliharaan</th>
                        <th rowspan="2" class="text-center">Unit Kerusakan</th>
                        <th colspan="2" rowspan="2" class="text-center">Harga Satuan</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <td colspan="5" class="fw-bold bg-secondary text-white">PERKIRAAN KERUSAKAN</td>

                    </tr>
                    
                    <!-- KERUSAKAN TEMPAT PEMELIHARAAN -->
                    <tr>
                        <td rowspan="3" class="align-middle fw-bold">a) Kerusakan Tempat Pemeliharaan Ikan (Kolam, Tambak, dsb) dan Peralatannya</td>
                        <td class="text-start"><input type="text" name="tempat_pemeliharaan_jenis_0" class="form-control form-control-sm" placeholder="Jenis Tempat Pemeliharaan" value=""></td>
                        <td><input type="number" name="tempat_pemeliharaan_unit_0" class="form-control" min="0" value="0"></td>
                        <td colspan="2"><input type="number" name="tempat_pemeliharaan_harga_satuan_0" class="form-control" min="0" step="1" value="0"></td>
                    </tr>
                    @for ($i = 1; $i <= 2; $i++)
                    <tr>
                        <td class="text-start"><input type="text" name="tempat_pemeliharaan_jenis_{{ $i }}" class="form-control form-control-sm" placeholder="Jenis Tempat Pemeliharaan" value=""></td>
                        <td><input type="number" name="tempat_pemeliharaan_unit_{{ $i }}" class="form-control" min="0" value="0"></td>
                        <td colspan="2"><input type="number" name="tempat_pemeliharaan_harga_satuan_{{ $i }}" class="form-control" min="0" step="1" value="0"></td>
                    </tr>
                    @endfor

                    <!-- KERUSAKAN KAPAL MOTOR -->
                    <tr>
                        <td class="text-white fw-bold bg-secondary" colspan="5">JENIS KAPAL MOTOR/PERAHU NELAYAN</td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="align-middle fw-bold">b) Kerusakan Kapal Motor/Perahu Nelayan</td>
                        <td class="text-start"><input type="text" name="kerusakan_kapal_perahu_jenis_0" class="form-control form-control-sm" placeholder="Jenis Kapal Motor/Perahu Nelayan" value=""></td>
                        <td><input type="number" name="kerusakan_kapal_perahu_unit_0" class="form-control" min="0" value="0"></td>
                        <td colspan="2"><input type="number" name="kerusakan_kapal_perahu_harga_satuan_0" class="form-control" min="0" step="1" value="0"></td>
                    </tr>
                    @for ($i = 1; $i <= 2; $i++)
                    <tr>
                        <td class="text-start"><input type="text" name="kerusakan_kapal_perahu_jenis_{{ $i }}" class="form-control form-control-sm" placeholder="Jenis Kapal Motor/Perahu Nelayan" value=""></td>
                        <td><input type="number" name="kerusakan_kapal_perahu_unit_{{ $i }}" class="form-control" min="0" value="0"></td>
                        <td colspan="2"><input type="number" name="kerusakan_kapal_perahu_harga_satuan_{{ $i }}" class="form-control" min="0" step="1" value="0"></td>
                    </tr>
                    @endfor
                    <!-- KERUSAKAN TEMPAT PELELANGAN IKAN -->
                    <tr>
                        <td rowspan="3" class="align-middle fw-bold">c) Kerusakan Tempat Pelelangan Ikan</td>
                        <td class="text-start"><input type="text" name="kerusakan_tempat_pelelangan_ikan_jenis_0" class="form-control form-control-sm" placeholder="Jenis Tempat Pelelangan" value=""></td>
                        <td><input type="number" name="kerusakan_tempat_pelelangan_ikan_unit_0" class="form-control" min="0" value="0"></td>
                        <td colspan="2"><input type="number" name="kerusakan_tempat_pelelangan_ikan_harga_satuan_0" class="form-control" min="0" step="1" value="0"></td>
                    </tr>
                    @for ($i = 1; $i <= 2; $i++)
                    <tr>
                        <td class="text-start"><input type="text" name="kerusakan_tempat_pelelangan_ikan_jenis_{{ $i }}" class="form-control form-control-sm" placeholder="Jenis Tempat Pelelangan" value=""></td>
                        <td><input type="number" name="kerusakan_tempat_pelelangan_ikan_unit_{{ $i }}" class="form-control" min="0" value="0"></td>
                        <td colspan="2"><input type="number" name="kerusakan_tempat_pelelangan_ikan_harga_satuan_{{ $i }}" class="form-control" min="0" step="1" value="0"></td>
                    </tr>
                    @endfor
                    
                    <tr>
                        <td colspan="5" class="fw-bold bg-secondary text-white">PERKIRAAN KERUGIAN</td>
                    </tr>
                    <tr>
                        <td class="align-middle">A. Produksi Yang Hilang Total</td>
                        <td class="text-center">Jenis Ikan</td>
                        <td class="text-center">Jumlah Produksi Yang Hilang</td>
                        <td colspan="2" class="text-center">Harga Satuan</td>
                    </tr>
                    @for ($i = 0; $i < 3; $i++)
                    <tr>
                        <td><input type="text" name="produksi_yang_hilang_total_nama_{{ $i }}" class="form-control form-control-sm" value=""></td>
                        <td class="text-start"><input type="text" name="produksi_yang_hilang_total_jenis_{{ $i }}" class="form-control form-control-sm" placeholder="Jenis Ikan" value=""></td>
                        <td><input type="number" name="produksi_yang_hilang_total_jumlah_{{ $i }}" class="form-control" min="0" value="0"></td>
                        <td colspan="2"><input type="number" name="produksi_yang_hilang_total_harga_satuan_{{ $i }}" class="form-control" min="0" step="1" value="0"></td>
                    </tr>
                    @endfor                            
                    <tr>
                        <td class="align-middle">B. Penurunan Produktifitas</td>
                        <td class="text-center">Jenis Ikan</td>
                        <td class="text-center">Penurunan Produktifitas</td>
                        <td class="text-center">Harga Satuan</td>
                        <td class="text-center">Jangka Waktu Pemulihan</td>
                    </tr>
                    @for ($i = 0; $i < 3; $i++)
                    <tr>
                        <td><input type="text" name="penurunan_produktivitas_nama_{{ $i }}" class="form-control form-control-sm" value=""></td>
                        <td class="text-start"><input type="text" name="penurunan_produktivitas_jenis_{{ $i }}" class="form-control form-control-sm" placeholder="Jenis Ikan" value=""></td>
                        <td><input type="number" name="penurunan_produktivitas_penurunan_produktifitas_{{ $i }}" class="form-control" min="0" value="0"></td>
                        <td><input type="number" name="penurunan_produktivitas_harga_satuan_{{ $i }}" class="form-control" min="0" step="1" value="0"></td>
                        <td><input type="text" name="penurunan_produktivitas_jangka_waktu_{{ $i }}" class="form-control" value=""></td>
                    </tr>
                    @endfor
                    <tr>
                        <td class="align-middle">C. Kenaikan Ongkos Produksi</td>
                        <td class="text-center">Jenis Ikan</td>
                        <td class="text-center">Kenaikan Biaya</td>
                        <td class="text-center">Harga Satuan</td>
                        <td class="text-center">Jangka Waktu Pemulihan</td>
                    </tr>
                    @for ($i = 0; $i < 3; $i++)
                    <tr>
                        <td><input type="text" name="kenaikan_ongkos_produksi_nama_{{ $i }}" class="form-control form-control-sm" value=""></td>
                        <td class="text-start"><input type="text" name="kenaikan_ongkos_produksi_jenis_{{ $i }}" class="form-control form-control-sm" placeholder="Jenis Ikan" value=""></td>
                        <td><input type="number" name="kenaikan_ongkos_produksi_kenaikan_biaya_{{ $i }}" class="form-control" min="0" value="0"></td>
                        <td><input type="number" name="kenaikan_ongkos_produksi_harga_satuan_{{ $i }}" class="form-control" min="0" step="1" value="0"></td>
                        <td><input type="text" name="kenaikan_ongkos_produksi_jangka_waktu_{{ $i }}" class="form-control" value=""></td>
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
