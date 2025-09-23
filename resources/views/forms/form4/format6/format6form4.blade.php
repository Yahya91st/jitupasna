@extends('layouts.main')

@section('content')
<style>
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
        vertical-align: middle !important;
        text-align: center;
        border: 1px solid #bdbdbd !important;
    }
    .table thead th {
        background: #f8f9fa;
        font-weight: 600;
    }
    .table input.form-control, .table input.form-control-sm {
        padding: 0.15rem 0.3rem !important;
        font-size: 0.95rem;
        height: 31px;
        border-radius: 0.25rem;
    }
    .input-group-text {
        padding: 0.2rem 0.5rem !important;
        font-size: 0.9rem;
        background: #f1f1f1;
        border-radius: 0.25rem 0 0 0.25rem;
    }
    .form-label {
        font-weight: 500;
        margin-bottom: 0.2rem;
    }
</style>
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 6: Sarana dan Prasarana Air Minum & Sanitasi</p>

    <form action="{{ isset($edit) && $edit ? route('forms.form4.update-format6', $data->id) : route('forms.form4.store-format6') }}" method="POST">
        @csrf
        @if(isset($edit) && $edit)
            @method('PUT')
        @endif
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">

        <table class="table table-bordered mb-3">
            <tr>
                <td style="width: 50%">
                    <label class="form-label mb-0">NAMA KAMPUNG</label>
                    <input type="text" class="form-control" name="nama_kampung" required value="{{ isset($data) ? $data->nama_kampung : old('nama_kampung') }}">
                </td>
                <td>
                    <label class="form-label mb-0">NAMA DISTRIK</label>
                    <input type="text" class="form-control" name="nama_distrik" required value="{{ isset($data) ? $data->nama_distrik : old('nama_distrik') }}">
                </td>
            </tr>
        </table>

        <div class="table-responsive">
            <table class="table table-bordered mb-4">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 18%;">Uraian</th>
                        <th rowspan="2" style="width: 18%;">Komponen</th>
                        <th colspan="2" style="width: 18%;">Jumlah Kerusakan</th>
                        <th rowspan="2" style="width: 18%;">Harga Satuan</th>
                        <th rowspan="2" style="width: 28%;">Keterangan</th>
                    </tr>
                    <tr>
                        <th style="width: 9%;">Unit</th>
                        <th style="width: 9%;">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="6" class="align-middle fw-bold">Sarana dan Prasarana Air Minum</td>
                        <td>Struktur Pengambilan Air</td>
                        <td><input type="text" class="form-control" name="struktur_air_unit" value="{{ isset($data) ? $data->struktur_air_unit : old('struktur_air_unit') }}"></td>
                        <td><input type="number" class="form-control" name="struktur_air_jumlah" value="{{ isset($data) ? $data->struktur_air_jumlah : old('struktur_air_jumlah') }}"></td>
                        <td><input type="number" class="form-control" name="struktur_air_harga_satuan" value="{{ isset($data) ? $data->struktur_air_harga_satuan : old('struktur_air_harga_satuan') }}"></td>
                        <td><input type="text" class="form-control" name="struktur_air_keterangan" value="{{ isset($data) ? $data->struktur_air_keterangan : old('struktur_air_keterangan') }}"></td>
                    </tr>
                    <tr>
                        <td>Instalasi Pemurnian Air</td>
                        <td><input type="text" class="form-control" name="instalasi_pemurnian_unit" value="{{ isset($data) ? $data->instalasi_pemurnian_unit : old('instalasi_pemurnian_unit') }}"></td>
                        <td><input type="number" class="form-control" name="instalasi_pemurnian_jumlah" value="{{ isset($data) ? $data->instalasi_pemurnian_jumlah : old('instalasi_pemurnian_jumlah') }}"></td>
                        <td><input type="number" class="form-control" name="instalasi_pemurnian_harga_satuan" value="{{ isset($data) ? $data->instalasi_pemurnian_harga_satuan : old('instalasi_pemurnian_harga_satuan') }}"></td>
                        <td><input type="text" class="form-control" name="instalasi_pemurnian_keterangan" value="{{ isset($data) ? $data->instalasi_pemurnian_keterangan : old('instalasi_pemurnian_keterangan') }}"></td>
                    </tr>
                    <tr>
                        <td>Sistem Perpipaan</td>
                        <td><input type="text" class="form-control" name="perpipaan_unit" value="{{ isset($data) ? $data->perpipaan_unit : old('perpipaan_unit') }}"></td>
                        <td><input type="number" class="form-control" name="perpipaan_jumlah" value="{{ isset($data) ? $data->perpipaan_jumlah : old('perpipaan_jumlah') }}"></td>
                        <td><input type="number" class="form-control" name="perpipaan_harga_satuan" value="{{ isset($data) ? $data->perpipaan_harga_satuan : old('perpipaan_harga_satuan') }}"></td>
                        <td><input type="text" class="form-control" name="perpipaan_keterangan" value="{{ isset($data) ? $data->perpipaan_keterangan : old('perpipaan_keterangan') }}"></td>
                    </tr>
                    <tr>
                        <td>Sistem Penyimpanan</td>
                        <td><input type="text" class="form-control" name="penyimpanan_unit" value="{{ isset($data) ? $data->penyimpanan_unit : old('penyimpanan_unit') }}"></td>
                        <td><input type="number" class="form-control" name="penyimpanan_jumlah" value="{{ isset($data) ? $data->penyimpanan_jumlah : old('penyimpanan_jumlah') }}"></td>
                        <td><input type="number" class="form-control" name="penyimpanan_harga_satuan" value="{{ isset($data) ? $data->penyimpanan_harga_satuan : old('penyimpanan_harga_satuan') }}"></td>
                        <td><input type="text" class="form-control" name="penyimpanan_keterangan" value="{{ isset($data) ? $data->penyimpanan_keterangan : old('penyimpanan_keterangan') }}"></td>
                    </tr>
                    <tr>
                        <td>Sumur</td>
                        <td><input type="text" class="form-control" name="sumur_unit" value="{{ isset($data) ? $data->sumur_unit : old('sumur_unit') }}"></td>
                        <td><input type="number" class="form-control" name="sumur_jumlah" value="{{ isset($data) ? $data->sumur_jumlah : old('sumur_jumlah') }}"></td>
                        <td><input type="number" class="form-control" name="sumur_harga_satuan" value="{{ isset($data) ? $data->sumur_harga_satuan : old('sumur_harga_satuan') }}"></td>
                        <td><input type="text" class="form-control" name="sumur_keterangan" value="{{ isset($data) ? $data->sumur_keterangan : old('sumur_keterangan') }}"></td>
                    </tr>
                    <tr>
                        <td>Lain-lain</td>
                        <td><input type="text" class="form-control" name="lain_unit" value="{{ isset($data) ? $data->lain_unit : old('lain_unit') }}"></td>
                        <td><input type="number" class="form-control" name="lain_jumlah" value="{{ isset($data) ? $data->lain_jumlah : old('lain_jumlah') }}"></td>
                        <td><input type="number" class="form-control" name="lain_harga_satuan" value="{{ isset($data) ? $data->lain_harga_satuan : old('lain_harga_satuan') }}"></td>
                        <td><input type="text" class="form-control" name="lain_keterangan" value="{{ isset($data) ? $data->lain_keterangan : old('lain_keterangan') }}"></td>
                    </tr>
                    <tr>
                        <td rowspan="4" class="align-middle fw-bold">Sistem Sanitasi</td>
                        <td>Jaringan Pembuangan</td>
                        <td><input type="text" class="form-control" name="sanitasi_unit" value="{{ isset($data) ? $data->sanitasi_unit : old('sanitasi_unit') }}"></td>
                        <td><input type="number" class="form-control" name="sanitasi_jumlah" value="{{ isset($data) ? $data->sanitasi_jumlah : old('sanitasi_jumlah') }}"></td>
                        <td><input type="number" class="form-control" name="sanitasi_harga_satuan" value="{{ isset($data) ? $data->sanitasi_harga_satuan : old('sanitasi_harga_satuan') }}"></td>
                        <td><input type="text" class="form-control" name="sanitasi_keterangan" value="{{ isset($data) ? $data->sanitasi_keterangan : old('sanitasi_keterangan') }}"></td>
                    </tr>
                    <tr>
                        <td>Septik Tank</td>
                        <td><input type="text" class="form-control" name="septik_unit" value="{{ isset($data) ? $data->septik_unit : old('septik_unit') }}"></td>
                        <td><input type="number" class="form-control" name="septik_jumlah" value="{{ isset($data) ? $data->septik_jumlah : old('septik_jumlah') }}"></td>
                        <td><input type="number" class="form-control" name="septik_harga_satuan" value="{{ isset($data) ? $data->septik_harga_satuan : old('septik_harga_satuan') }}"></td>
                        <td><input type="text" class="form-control" name="septik_keterangan" value="{{ isset($data) ? $data->septik_keterangan : old('septik_keterangan') }}"></td>
                    </tr>
                    <tr>
                        <td>Sistem Pengumpulan Limbah Padat</td>
                        <td><input type="text" class="form-control" name="limbah_padat_unit" value="{{ isset($data) ? $data->limbah_padat_unit : old('limbah_padat_unit') }}"></td>
                        <td><input type="number" class="form-control" name="limbah_padat_jumlah" value="{{ isset($data) ? $data->limbah_padat_jumlah : old('limbah_padat_jumlah') }}"></td>
                        <td><input type="number" class="form-control" name="limbah_padat_harga_satuan" value="{{ isset($data) ? $data->limbah_padat_harga_satuan : old('limbah_padat_harga_satuan') }}"></td>
                        <td><input type="text" class="form-control" name="limbah_padat_keterangan" value="{{ isset($data) ? $data->limbah_padat_keterangan : old('limbah_padat_keterangan') }}"></td>
                    </tr>
                    <tr>
                        <td>WC Umum</td>
                        <td><input type="text" class="form-control" name="wc_umum_unit" value="{{ isset($data) ? $data->wc_umum_unit : old('wc_umum_unit') }}"></td>
                        <td><input type="number" class="form-control" name="wc_umum_jumlah" value="{{ isset($data) ? $data->wc_umum_jumlah : old('wc_umum_jumlah') }}"></td>
                        <td><input type="number" class="form-control" name="wc_umum_harga_satuan" value="{{ isset($data) ? $data->wc_umum_harga_satuan : old('wc_umum_harga_satuan') }}"></td>
                        <td><input type="text" class="form-control" name="wc_umum_keterangan" value="{{ isset($data) ? $data->wc_umum_keterangan : old('wc_umum_keterangan') }}"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr class="my-4">

        <h6 class="fw-bold">PERKIRAAN KERUGIAN</h6>
        <table class="table table-bordered mt-3">
            <tr style="background-color: #475F7B; color: white;">
                <th colspan="6" class="text-start" style="border: 1px solid #000;">SISTEM AIR MINUM</th>
            </tr>
            <tr>
                <td colspan="6" class="text-start" style="border: 1px solid #000;">
                    Kehilangan/Penurunan Pendapatan PDAM:
                    <input type="number" name="kehilangan_pendapatan_pdam" value="{{ isset($data) ? $data->kehilangan_pendapatan_pdam : old('kehilangan_pendapatan_pdam') }}" class="form-control d-inline-block" style="width:180px;"> /Rp/Bulan
                </td>
            </tr>
            <tr>
                <td rowspan="4" style="border: 1px solid #000; width: 120px;">Kenaikan Biaya</td>
                <td style="border: 1px solid #000; width: 320px;">
                    Biaya pemurnian air
                    <input type="number" name="biaya_pemurnian" value="{{ isset($data) ? $data->biaya_pemurnian : old('biaya_pemurnian') }}" class="form-control">
                </td>
                <td colspan="4" style="border: 1px solid #000;">
                    Sebutkan dasar perhitungan:
                    <input type="text" name="dasar_perhitungan_biaya_pemurnian" value="{{ isset($data) ? $data->dasar_perhitungan_biaya_pemurnian : old('dasar_perhitungan_biaya_pemurnian') }}" class="form-control">
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;">
                    Biaya distribusi air
                    <input type="number" name="biaya_distribusi" value="{{ isset($data) ? $data->biaya_distribusi : old('biaya_distribusi') }}" class="form-control">
                </td>
                <td colspan="4" style="border: 1px solid #000;">
                    Sebutkan dasar perhitungan:
                    <input type="text" name="dasar_perhitungan_biaya_distribusi" value="{{ isset($data) ? $data->dasar_perhitungan_biaya_distribusi : old('dasar_perhitungan_biaya_distribusi') }}" class="form-control">
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;">
                    Biaya pembersihan sumur
                    <input type="number" name="biaya_pembersihan" value="{{ isset($data) ? $data->biaya_pembersihan : old('biaya_pembersihan') }}" class="form-control">
                </td>
                <td colspan="4" style="border: 1px solid #000;">
                    Sebutkan dasar perhitungan:
                    <input type="text" name="dasar_perhitungan_biaya_pembersihan" value="{{ isset($data) ? $data->dasar_perhitungan_biaya_pembersihan : old('dasar_perhitungan_biaya_pembersihan') }}" class="form-control">
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;">
                    Biaya lain
                    <input type="number" name="biaya_lain" value="{{ isset($data) ? $data->biaya_lain : old('biaya_lain') }}" class="form-control">
                </td>
                <td colspan="4" style="border: 1px solid #000;">
                    Sebutkan dasar perhitungan:
                    <input type="text" name="dasar_perhitungan_biaya_lain" value="{{ isset($data) ? $data->dasar_perhitungan_biaya_lain : old('dasar_perhitungan_biaya_lain') }}" class="form-control">
                </td>
            </tr>
            <tr style="background-color: #475F7B; color: white;">
                <th colspan="6" class="text-start" style="border: 1px solid #000;">SISTEM SANITASI</th>
            </tr>
            <tr>
                <td colspan="6" class="text-start" style="border: 1px solid #000;">
                    Penurunan Pendapatan Instansi Yang Bertanggungjawab Terhadap Sanitasi :
                    <input type="number" name="sanitasi_pendapatan" value="{{ isset($data) ? $data->sanitasi_pendapatan : old('sanitasi_pendapatan') }}" class="form-control d-inline-block" style="width:180px;"> /Rp/Bulan
                </td>
            </tr>
            <tr>
                <td rowspan="2" style="border: 1px solid #000;">Kenaikan Biaya</td>
                <td style="border: 1px solid #000;">
                    Pembersihan jaringan pembuangan
                    <input type="number" name="biaya_pembersihan_jaringan" value="{{ isset($data) ? $data->biaya_pembersihan_jaringan : old('biaya_pembersihan_jaringan') }}" class="form-control">
                </td>
                <td colspan="4" style="border: 1px solid #000;">
                    Sebutkan dasar perhitungan:
                    <input type="text" name="dasar_perhitungan_biaya_pembersihan_jaringan" value="{{ isset($data) ? $data->dasar_perhitungan_biaya_pembersihan_jaringan : old('dasar_perhitungan_biaya_pembersihan_jaringan') }}" class="form-control">
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;">
                    Kenaikan biaya bahan kimia
                    <input type="number" name="biaya_bahan_kimia" value="{{ isset($data) ? $data->biaya_bahan_kimia : old('biaya_bahan_kimia') }}" class="form-control">
                </td>
                <td colspan="4" style="border: 1px solid #000;">
                    Sebutkan dasar perhitungan:
                    <input type="text" name="dasar_perhitungan_biaya_bahan_kimia" value="{{ isset($data) ? $data->dasar_perhitungan_biaya_bahan_kimia : old('dasar_perhitungan_biaya_bahan_kimia') }}" class="form-control">
                </td>
            </tr>
        </table>

        <div class="row mb-4">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">{{ isset($edit) && $edit ? 'Update Data' : 'Simpan Data' }}</button>
            </div>
        </div>
    </form>
</div>
@endsection