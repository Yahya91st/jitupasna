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
    <p class="fw-bold">Format 14: Sektor Perdagangan</p>

    <form action="{{ isset($edit) && $edit ? route('forms.form4.format14.update', $data->id) : route('forms.form4.format14.store') }}" method="POST">
        @csrf
        @if(isset($edit) && $edit)
            @method('PATCH')
        @endif
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">

        <table class="table table-bordered">
            <tr>
                <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
            </tr>
        </table>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" style="border-bottom: 0cap;" class="text-center align-middle">JENIS TEMPAT USAHA</th>
                        <th colspan="3" style="border-bottom: 0cap;" class="text-center">JUMLAH KERUSAKAN</th>
                        <th colspan="3" style="border-bottom: 0cap;" class="text-center">HARGA SATUAN</th>
                    </tr>
                    <tr>
                        <th style="border-bottom: 0cap;" class="text-center">RB</th>
                        <th style="border-bottom: 0cap;" class="text-center">RS</th>
                        <th style="border-bottom: 0cap;" class="text-center">RR</th>
                        <th style="border-bottom: 0cap;" class="text-center">RB</th>
                        <th style="border-bottom: 0cap;" class="text-center">RS</th>
                        <th style="border-bottom: 0cap;" class="text-center">RR</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Section: Perkiraan Kerusakan -->
                    <tr>
                        <td class="bg-secondary align-middle fw-bold text-white text-center" colspan="7">PERKIRAAN KERUSAKAN</td>
                    </tr>
                    
                    <!-- Tempat Usaha -->
                    <tr>
                        <td colspan="8" class="text-bold">a) Tempat usaha (Pasar, Warung, Toko)</td>
                    </tr>
                    @for ($i = 1; $i <= 3; $i++)
                    <tr>
                        <td>
                            <input type="text" name="tempatusaha_jenis_{{ $i }}" class="form-control" placeholder="Jenis Tempat Usaha" 
                                value="{{ old('tempatusaha_jenis_' . $i, $data->{'tempatusaha_' . $i . '_jenis'} ?? '') }}">
                        </td>
                        <td>
                            <input type="number" name="tempatusaha_rb_jumlah_{{ $i }}" class="form-control" min="0" 
                                value="{{ old('tempatusaha_rb_jumlah_' . $i, $data->{'tempatusaha_' . $i . '_rb_jumlah'} ?? 0) }}">
                        </td>
                        <td>
                            <input type="number" name="tempatusaha_rs_jumlah_{{ $i }}" class="form-control" min="0" 
                                value="{{ old('tempatusaha_rs_jumlah_' . $i, $data->{'tempatusaha_' . $i . '_rs_jumlah'} ?? 0) }}">
                        </td>
                        <td>
                            <input type="number" name="tempatusaha_rr_jumlah_{{ $i }}" class="form-control" min="0" 
                                value="{{ old('tempatusaha_rr_jumlah_' . $i, $data->{'tempatusaha_' . $i . '_rr_jumlah'} ?? 0) }}">
                        </td>
                        <td>
                            <input type="number" name="tempatusaha_rb_harga_{{ $i }}" class="form-control" min="0" step="any" 
                                value="{{ old('tempatusaha_rb_harga_' . $i, $data->{'tempatusaha_' . $i . '_rb_harga'} ?? 0) }}">
                        </td>
                        <td>
                            <input type="number" name="tempatusaha_rs_harga_{{ $i }}" class="form-control" min="0" step="any" 
                                value="{{ old('tempatusaha_rs_harga_' . $i, $data->{'tempatusaha_' . $i . '_rs_harga'} ?? 0) }}">
                        </td>
                        <td>
                            <input type="number" name="tempatusaha_rr_harga_{{ $i }}" class="form-control" min="0" step="any" 
                                value="{{ old('tempatusaha_rr_harga_' . $i, $data->{'tempatusaha_' . $i . '_rr_harga'} ?? 0) }}">
                        </td>
                    </tr>
                    @endfor
                    
                    <!-- Peralatan -->
                    <tr class="fw-bold">
                        <td colspan="8">b) Peralatan</td>
                    </tr>
                    @for ($i = 1; $i <= 3; $i++)
                    <tr>
                        <td>
                            <input type="text" name="peralatan_jenis_{{ $i }}" class="form-control" placeholder="Jenis Peralatan" 
                                value="{{ old('peralatan_jenis_' . $i, $data->{'peralatan_' . $i . '_jenis'} ?? '') }}">
                        </td>
                        <td>
                            <input type="number" name="peralatan_rb_jumlah_{{ $i }}" class="form-control" min="0" 
                                value="{{ old('peralatan_rb_jumlah_' . $i, $data->{'peralatan_' . $i . '_rb_jumlah'} ?? 0) }}">
                        </td>
                        <td>
                            <input type="number" name="peralatan_rs_jumlah_{{ $i }}" class="form-control" min="0" 
                                value="{{ old('peralatan_rs_jumlah_' . $i, $data->{'peralatan_' . $i . '_rs_jumlah'} ?? 0) }}">
                        </td>
                        <td>
                            <input type="number" name="peralatan_rr_jumlah_{{ $i }}" class="form-control" min="0" 
                                value="{{ old('peralatan_rr_jumlah_' . $i, $data->{'peralatan_' . $i . '_rr_jumlah'} ?? 0) }}">
                        </td>
                        <td>
                            <input type="number" name="peralatan_rb_harga_{{ $i }}" class="form-control" min="0" step="any" 
                                value="{{ old('peralatan_rb_harga_' . $i, $data->{'peralatan_' . $i . '_rb_harga'} ?? 0) }}">
                        </td>
                        <td>
                            <input type="number" name="peralatan_rs_harga_{{ $i }}" class="form-control" min="0" step="any" 
                                value="{{ old('peralatan_rs_harga_' . $i, $data->{'peralatan_' . $i . '_rs_harga'} ?? 0) }}">
                        </td>
                        <td>
                            <input type="number" name="peralatan_rr_harga_{{ $i }}" class="form-control" min="0" step="any" 
                                value="{{ old('peralatan_rr_harga_' . $i, $data->{'peralatan_' . $i . '_rr_harga'} ?? 0) }}">
                        </td>
                    </tr>
                    @endfor
                    
                    <!-- Barang Dagangan -->
                    <tr class="fw-bold">
                        <td colspan="8">c) Barang Dagangan</td>
                    </tr>
                    @for ($i = 1; $i <= 3; $i++)
                    <tr>
                        <td>
                            <input type="text" name="barangdagangan_jenis_{{ $i }}" class="form-control" placeholder="Jenis Barang Dagangan" 
                                value="{{ old('barangdagangan_jenis_' . $i, $data->{'barangdagangan_' . $i . '_jenis'} ?? '') }}">
                        </td>
                        <td>
                            <input type="number" name="barangdagangan_rb_jumlah_{{ $i }}" class="form-control" min="0" 
                                value="{{ old('barangdagangan_rb_jumlah_' . $i, $data->{'barangdagangan_' . $i . '_rb_jumlah'} ?? 0) }}">
                        </td>
                        <td>
                            <input type="number" name="barangdagangan_rs_jumlah_{{ $i }}" class="form-control" min="0" 
                                value="{{ old('barangdagangan_rs_jumlah_' . $i, $data->{'barangdagangan_' . $i . '_rs_jumlah'} ?? 0) }}">
                        </td>
                        <td>
                            <input type="number" name="barangdagangan_rr_jumlah_{{ $i }}" class="form-control" min="0" 
                                value="{{ old('barangdagangan_rr_jumlah_' . $i, $data->{'barangdagangan_' . $i . '_rr_jumlah'} ?? 0) }}">
                        </td>
                        <td>
                            <input type="number" name="barangdagangan_rb_harga_{{ $i }}" class="form-control" min="0" step="any" 
                                value="{{ old('barangdagangan_rb_harga_' . $i, $data->{'barangdagangan_' . $i . '_rb_harga'} ?? 0) }}">
                        </td>
                        <td>
                            <input type="number" name="barangdagangan_rs_harga_{{ $i }}" class="form-control" min="0" step="any" 
                                value="{{ old('barangdagangan_rs_harga_' . $i, $data->{'barangdagangan_' . $i . '_rs_harga'} ?? 0) }}">
                        </td>
                        <td>
                            <input type="number" name="barangdagangan_rr_harga_{{ $i }}" class="form-control" min="0" step="any" 
                                value="{{ old('barangdagangan_rr_harga_' . $i, $data->{'barangdagangan_' . $i . '_rr_harga'} ?? 0) }}">
                        </td>
                    </tr>
                    @endfor
                    
                    <!-- Section: Perkiraan Kerugian -->
                    <tr>
                        <td class="bg-secondary align-middle fw-bold text-white text-center" colspan="7">PERKIRAAN KERUGIAN</td>
                    </tr>
                    
                    <!-- Kehilangan Penjualan Total -->
                    <tr class="fw-bold">
                        <td>A. Kehilangan Penjualan Total</td>
                        <td colspan="2">NAMA TEMPAT USAHA</td>
                        <td colspan="2">A. PENJUALAN NORMAL</td>
                        <td colspan="2">B. PERKIRAAN JANGKA WAKTU PEMULIHAN</td>
                    </tr>
                    @for ($i = 1; $i <= 3; $i++)
                    <tr>
                        <td></td>
                        <td colspan="2"> 
                            <input type="text" name="kehilangan_penjualan_nama_{{ $i }}" class="form-control" placeholder="Nama Tempat Usaha" 
                                value="{{ old('kehilangan_penjualan_nama_' . $i, $data->{'kehilangan_penjualan_' . $i . '_nama'} ?? '') }}">
                        </td>
                        <td colspan="2">
                            <input type="text" name="kehilangan_penjualan_normal_{{ $i }}" class="form-control" min="0" step="any" placeholder="Penjualan Normal" 
                                value="{{ old('kehilangan_penjualan_normal_' . $i, $data->{'kehilangan_penjualan_' . $i . '_normal'} ?? 0) }}">
                        </td>
                        <td colspan="2">
                            <input type="number" name="kehilangan_penjualan_pemulihan_{{ $i }}" class="form-control" min="0" placeholder="Waktu Pemulihan" 
                                value="{{ old('kehilangan_penjualan_pemulihan_' . $i, $data->{'kehilangan_penjualan_' . $i . '_pemulihan'} ?? 0) }}">
                        </td>
                    </tr>
                    @endfor
                    
                    <!-- Penurunan Produktifitas -->
                    <tr class="fw-bold">
                        <td colspan="8">B. Penurunan Produktifitas</td>
                    </tr>
                    @for ($i = 1; $i <= 3; $i++)
                    <tr>
                        <td></td>
                        <td colspan="2">
                            <input type="text" name="penurunan_produktifitas_nama_{{ $i }}" class="form-control" placeholder="Nama Tempat Usaha" 
                                value="{{ old('penurunan_produktifitas_' . $i . '_nama', $data->{'penurunan_produktifitas_' . $i . '_nama'} ?? '') }}">
                        </td>
                        <td colspan="2">
                            <input type="number" name="penurunan_produktifitas_normal_{{ $i }}" class="form-control" min="0" step="any" placeholder="Penjualan Normal" 
                                value="{{ old('penurunan_produktifitas_' . $i . '_normal', $data->{'penurunan_produktifitas_' . $i . '_normal'} ?? 0) }}">
                        </td>
                        <td colspan="2">
                            <input type="number" name="penurunan_produktifitas_pemulihan_{{ $i }}" class="form-control" min="0" placeholder="Waktu Pemulihan" 
                                value="{{ old('penurunan_produktifitas_' . $i . '_pemulihan', $data->{'penurunan_produktifitas_' . $i . '_pemulihan'} ?? 0) }}">
                        </td>
                    </tr>
                    @endfor
                    
                    <!-- Kenaikan Biaya Produksi -->
                    <tr class="fw-bold">
                        <td colspan="8">C. Kenaikan Biaya Produksi</td>
                    </tr>
                    <tr>
                        <td rowspan="3">Biaya Operasional yang lebih tinggi</td>
                    @for ($i = 1; $i <= 3; $i++)
                        <td colspan="2">
                            <input type="text" name="kenaikan_biaya_nama" class="form-control" placeholder="Nama Tempat Usaha" 
                                value="{{ old('kenaikan_biaya_' . $i . '_nama', $data->{'kenaikan_biaya_' . $i . '_nama'} ?? '') }}">
                        </td>
                        <td colspan="2">
                            <input type="number" name="kenaikan_biaya_operasional" class="form-control" min="0" step="any" placeholder="Kenaikan Biaya Operasional" 
                                value="{{ old('kenaikan_biaya_' . $i . '_operasional', $data->{'kenaikan_biaya_' . $i . '_operasional'} ?? 0) }}">
                        </td>
                        <td colspan="2">
                            <input type="number" name="kenaikan_biaya_pemulihan" class="form-control" min="0" placeholder="Waktu Pemulihan" 
                                value="{{ old('kenaikan_biaya_' . $i . '_pemulihan', $data->{'kenaikan_biaya_' . $i . '_pemulihan'} ?? 0) }}">
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger mt-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success mt-4">{{ session('success') }}</div>
        @endif

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Total Perhitungan</h5>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Total Perkiraan Kerusakan:</strong><br>
                        RB: Rp. <?php 
                            $total_rb = 0;
                            for($i = 1; $i <= 3; $i++) {
                                $total_rb += (old("tempatusaha_{$i}_rb_jumlah", $data->{"tempatusaha_{$i}_rb_jumlah"} ?? 0) * old("tempatusaha_{$i}_rb_harga", $data->{"tempatusaha_{$i}_rb_harga"} ?? 0));
                                $total_rb += (old("peralatan_{$i}_rb_jumlah", $data->{"peralatan_{$i}_rb_jumlah"} ?? 0) * old("peralatan_{$i}_rb_harga", $data->{"peralatan_{$i}_rb_harga"} ?? 0));
                                $total_rb += (old("barangdagangan_{$i}_rb_jumlah", $data->{"barangdagangan_{$i}_rb_jumlah"} ?? 0) * old("barangdagangan_{$i}_rb_harga", $data->{"barangdagangan_{$i}_rb_harga"} ?? 0));
                            }
                            echo number_format($total_rb, 0, ',', '.');
                        ?><br>
                        RS: Rp. <?php 
                            $total_rs = 0;
                            for($i = 1; $i <= 3; $i++) {
                                $total_rs += (old("tempatusaha_{$i}_rs_jumlah", $data->{"tempatusaha_{$i}_rs_jumlah"} ?? 0) * old("tempatusaha_{$i}_rs_harga", $data->{"tempatusaha_{$i}_rs_harga"} ?? 0));
                                $total_rs += (old("peralatan_{$i}_rs_jumlah", $data->{"peralatan_{$i}_rs_jumlah"} ?? 0) * old("peralatan_{$i}_rs_harga", $data->{"peralatan_{$i}_rs_harga"} ?? 0));
                                $total_rs += (old("barangdagangan_{$i}_rs_jumlah", $data->{"barangdagangan_{$i}_rs_jumlah"} ?? 0) * old("barangdagangan_{$i}_rs_harga", $data->{"barangdagangan_{$i}_rs_harga"} ?? 0));
                            }
                            echo number_format($total_rs, 0, ',', '.');
                        ?><br>
                        RR: Rp. <?php 
                            $total_rr = 0;
                            for($i = 1; $i <= 3; $i++) {
                                $total_rr += (old("tempatusaha_{$i}_rr_jumlah", $data->{"tempatusaha_{$i}_rr_jumlah"} ?? 0) * old("tempatusaha_{$i}_rr_harga", $data->{"tempatusaha_{$i}_rr_harga"} ?? 0));
                                $total_rr += (old("peralatan_{$i}_rr_jumlah", $data->{"peralatan_{$i}_rr_jumlah"} ?? 0) * old("peralatan_{$i}_rr_harga", $data->{"peralatan_{$i}_rr_harga"} ?? 0));
                                $total_rr += (old("barangdagangan_{$i}_rr_jumlah", $data->{"barangdagangan_{$i}_rr_jumlah"} ?? 0) * old("barangdagangan_{$i}_rr_harga", $data->{"barangdagangan_{$i}_rr_harga"} ?? 0));
                            }
                            echo number_format($total_rr, 0, ',', '.');
                        ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Total Perkiraan Kerugian:</strong><br>
                        Kehilangan Penjualan: Rp. <?php 
                            $total_kehilangan = 0;
                            for($i = 1; $i <= 3; $i++) {
                                $total_kehilangan += old("kehilangan_penjualan_{$i}_total", $data->{"kehilangan_penjualan_{$i}_total"} ?? 0);
                            }
                            echo number_format($total_kehilangan, 0, ',', '.');
                        ?><br>
                        Penurunan Produktifitas: Rp. <?php 
                            $total_produktifitas = 0;
                            for($i = 1; $i <= 3; $i++) {
                                $total_produktifitas += old("penurunan_produktifitas_{$i}_total", $data->{"penurunan_produktifitas_{$i}_total"} ?? 0);
                            }
                            echo number_format($total_produktifitas, 0, ',', '.');
                        ?><br>
                        Kenaikan Biaya: Rp. <?php 
                            $total_kenaikan = 0;
                            for($i = 1; $i <= 3; $i++) {
                                $total_kenaikan += old("kenaikan_biaya_{$i}_total", $data->{"kenaikan_biaya_{$i}_total"} ?? 0);
                            }
                            echo number_format($total_kenaikan, 0, ',', '.');
                        ?>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <strong>TOTAL KESELURUHAN: Rp. <?php 
                        echo number_format(($total_rb + $total_rs + $total_rr + $total_kehilangan + $total_produktifitas + $total_kenaikan), 0, ',', '.');
                    ?></strong>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                Simpan Data
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = form.querySelector('button[type="submit"]');
    const spinner = submitBtn.querySelector('.spinner-border');

    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        spinner.classList.remove('d-none');
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
    });
});
</script>
@endsection
