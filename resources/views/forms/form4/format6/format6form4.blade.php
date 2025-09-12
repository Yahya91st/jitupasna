@extends('layouts.main')

@section('content')
<style>
    .compact-table td {
        padding: 4px 8px !important;
        vertical-align: middle;
    }
    
    .input-inline {
        position: relative;
        text-align: left;
    }
    
    .input-inline input {
        display: inline-block;
        width: 100px;
        height: 31px;
        border: 1px solid #ced4da;
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
        background-color: #fff;
        margin: 0 5px;
        vertical-align: middle;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    
    .input-right {
        position: relative;
        text-align: left;
        height: 46px;
    }
    
    .input-right input {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        width: 220px;
        height: 31px;
        border: 1px solid #ced4da;
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
        background-color: #fff;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    
    .input-inline input:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    .input-right input:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
</style>

<div class="container mt-4">    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 6: Sarana dan Prasarana Air Minum & Sanitasi</p>
    
    <form action="{{ isset($edit) && $edit ? route('forms.form4.update-format6', $data->id) : route('forms.form4.store-format6') }}" method="POST">
        @csrf
        @if(isset($edit) && $edit)
            @method('PUT')
        @endif
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">NAMA KAMPUNG</span>
                    <input type="text" class="form-control form-control-sm" name="nama_kampung" value="{{ isset($data) ? $data->nama_kampung : old('nama_kampung') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">NAMA DISTRIK</span>
                    <input type="text" class="form-control form-control-sm" name="nama_distrik" value="{{ isset($data) ? $data->nama_distrik : old('nama_distrik') }}" required>
                </div>
            </div>
        </div>

    <p><strong>A. Kerusakan Sarana Air Minum</strong></p>    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle compact-table" style="width: 100%;">
        <thead>
            <tr>
                <th style="border: 1px solid #000; padding: 4px 8px;">Uraian</th>
                <th style="border: 1px solid #000; padding: 4px 8px;">Komponen</th>
                <th colspan="2" style="border: 1px solid #000; padding: 4px 8px;">Jumlah Kerusakan</th>
                <th style="border: 1px solid #000; padding: 4px 8px;">Harga Satuan</th>
            </tr>
            <tr>
                <th style="border: 1px solid #000; padding: 4px 8px;"></th>
                <th style="border: 1px solid #000; padding: 4px 8px;"></th>
                <th style="border: 1px solid #000; padding: 4px 8px;">Unit</th>
                <th style="border: 1px solid #000; padding: 4px 8px;">Jumlah</th>
                <th style="border: 1px solid #000; padding: 4px 8px;"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #000;">Sarana dan prasarana air minum</td> 
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td>  
                <td style="border: 1px solid #000;">Struktur Pengambilan Air</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control form-control-sm" name="struktur_air_unit" value="{{ isset($data) ? $data->struktur_air_unit : old('struktur_air_unit') }}"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="struktur_air_jumlah" value="{{ isset($data) ? $data->struktur_air_jumlah : old('struktur_air_jumlah') }}" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="struktur_air_harga_satuan" value="{{ isset($data) ? $data->struktur_air_harga_satuan : old('struktur_air_harga_satuan') }}" min="0"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Instalasi Pemurnian Air</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control form-control-sm" name="instalasi_pemurnian_unit" value="{{ isset($data) ? $data->instalasi_pemurnian_unit : old('instalasi_pemurnian_unit') }}"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="instalasi_pemurnian_jumlah" value="{{ isset($data) ? $data->instalasi_pemurnian_jumlah : old('instalasi_pemurnian_jumlah') }}" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="instalasi_pemurnian_harga_satuan" value="{{ isset($data) ? $data->instalasi_pemurnian_harga_satuan : old('instalasi_pemurnian_harga_satuan') }}" min="0"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Sistem Perpipaan</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control form-control-sm" name="perpipaan_unit" value="{{ isset($data) ? $data->perpipaan_unit : old('perpipaan_unit') }}"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="perpipaan_jumlah" value="{{ isset($data) ? $data->perpipaan_jumlah : old('perpipaan_jumlah') }}" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="perpipaan_harga_satuan" value="{{ isset($data) ? $data->perpipaan_harga_satuan : old('perpipaan_harga_satuan') }}" min="0"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Sistem Penyimpanan</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control form-control-sm" name="penyimpanan_unit" value="{{ isset($data) ? $data->penyimpanan_unit : old('penyimpanan_unit') }}"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="penyimpanan_jumlah" value="{{ isset($data) ? $data->penyimpanan_jumlah : old('penyimpanan_jumlah') }}" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="penyimpanan_harga_satuan" value="{{ isset($data) ? $data->penyimpanan_harga_satuan : old('penyimpanan_harga_satuan') }}" min="0"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Sumur</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control form-control-sm" name="sumur_unit" value="{{ isset($data) ? $data->sumur_unit : old('sumur_unit') }}"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="sumur_jumlah" value="{{ isset($data) ? $data->sumur_jumlah : old('sumur_jumlah') }}" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="sumur_harga_satuan" value="{{ isset($data) ? $data->sumur_harga_satuan : old('sumur_harga_satuan') }}" min="0"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Lain lain</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control form-control-sm" name="mck_unit" value="{{ isset($data) ? $data->mck_unit : old('mck_unit') }}"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="mck_jumlah" value="{{ isset($data) ? $data->mck_jumlah : old('mck_jumlah') }}" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="mck_harga_satuan" value="{{ isset($data) ? $data->mck_harga_satuan : old('mck_harga_satuan') }}" min="0"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;">Sistem Sanitasi</td> 
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Jaringan Pembuangan</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control form-control-sm" name="sanitasi_unit" value="{{ isset($data) ? $data->sanitasi_unit : old('sanitasi_unit') }}"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="sanitasi_jumlah" value="{{ isset($data) ? $data->sanitasi_jumlah : old('sanitasi_jumlah') }}" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="sanitasi_harga_satuan" value="{{ isset($data) ? $data->sanitasi_harga_satuan : old('sanitasi_harga_satuan') }}" min="0"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Septik Tank</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control form-control-sm" name="drainase_unit" value="{{ isset($data) ? $data->drainase_unit : old('drainase_unit') }}"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="drainase_jumlah" value="{{ isset($data) ? $data->drainase_jumlah : old('drainase_jumlah') }}" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="drainase_harga_satuan" value="{{ isset($data) ? $data->drainase_harga_satuan : old('drainase_harga_satuan') }}" min="0"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Sistem pengumpulan limbah padat</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control form-control-sm" name="limbah_padat_unit" value="{{ isset($data) ? $data->limbah_padat_unit : old('limbah_padat_unit') }}"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="limbah_padat_jumlah" value="{{ isset($data) ? $data->limbah_padat_jumlah : old('limbah_padat_jumlah') }}" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="limbah_padat_harga_satuan" value="{{ isset($data) ? $data->limbah_padat_harga_satuan : old('limbah_padat_harga_satuan') }}" min="0"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">WC umum</td>
                <td style="border: 1px solid #000;"><input type="text" class="form-control form-control-sm" name="wc_umum_unit" value="{{ isset($data) ? $data->wc_umum_unit : old('wc_umum_unit') }}"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="wc_umum_jumlah" value="{{ isset($data) ? $data->wc_umum_jumlah : old('wc_umum_jumlah') }}" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="wc_umum_harga_satuan" value="{{ isset($data) ? $data->wc_umum_harga_satuan : old('wc_umum_harga_satuan') }}" min="0"></td>
            </tr>
        </tbody>
    </table>
{{-- Perkiraan Kerugian Sistem Air Minum --}}
    <table class="table table-bordered compact-table" style="width: 100%;">
        <tr style="background-color: #e0e0e0;">
            <th colspan="6" style="text-align: left; border: 1px solid #000; padding: 4px 8px;">PERKIRAAN KERUGIAN<br><i>SISTEM AIR MINUM</i></th>
        </tr>
        <tr>
            <td colspan="6" style="border: 1px solid #000;" class="input-inline">Kehilangan/Penurunan Pendapatan PDAM: <input type="number" name="kehilangan_pendapatan_pdam" value="{{ isset($data) ? $data->kehilangan_pendapatan_pdam : old('kehilangan_pendapatan_pdam') }}" class="form-control form-control-sm">/Rp/Bulan</td>
        </tr>
        <tr>
            <td rowspan="4" style="border: 1px solid #000; width: 100px;">Kenaikan Biaya</td>
            <td style="border: 1px solid #000; width: 500px;" class="input-right">Biaya pemurnian air <input type="number" name="biaya_pemurnian" value="{{ isset($data) ? $data->biaya_pemurnian : old('biaya_pemurnian') }}" class="form-control form-control-sm"></td>
            <td colspan="4" style="border: 1px solid #000" class="input-right">Sebutkan dasar perhitungan: <input type="text" name="dasar_perhitungan_biaya_pemurnian" value="{{ isset($data) ? $data->dasar_perhitungan_biaya_pemurnian : old('dasar_perhitungan_biaya_pemurnian') }}" class="form-control form-control-sm"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000;" class="input-right">Biaya distribusi air <input type="number" name="biaya_distribusi" value="{{ isset($data) ? $data->biaya_distribusi : old('biaya_distribusi') }}" class="form-control form-control-sm"></td>
            <td colspan="4" style="border: 1px solid #000;" class="input-right">Sebutkan dasar perhitungan: <input type="text" name="dasar_perhitungan_biaya_distribusi" value="{{ isset($data) ? $data->dasar_perhitungan_biaya_distribusi : old('dasar_perhitungan_biaya_distribusi') }}" class="form-control form-control-sm"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000;" class="input-right">Biaya pembersihan sumur <input type="number" name="biaya_pembersihan" value="{{ isset($data) ? $data->biaya_pembersihan : old('biaya_pembersihan') }}" class="form-control form-control-sm"></td>
            <td colspan="4" style="border: 1px solid #000;" class="input-right">Sebutkan dasar perhitungan: <input type="text" name="dasar_perhitungan_biaya_pembersihan" value="{{ isset($data) ? $data->dasar_perhitungan_biaya_pembersihan : old('dasar_perhitungan_biaya_pembersihan') }}" class="form-control form-control-sm"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000;" class="input-right">Biaya lain <input type="number" name="biaya_lain" value="{{ isset($data) ? $data->biaya_lain : old('biaya_lain') }}" class="form-control form-control-sm"></td>
            <td colspan="4" style="border: 1px solid #000;" class="input-right">Sebutkan dasar perhitungan: <input type="text" name="dasar_perhitungan_biaya_lain" value="{{ isset($data) ? $data->dasar_perhitungan_biaya_lain : old('dasar_perhitungan_biaya_lain') }}" class="form-control form-control-sm"></td>
        </tr>
        <tr style="background-color: #f0f0f0;">
            <th colspan="6" style="text-align: left; border: 1px solid #000;"><i>Sistem Sanitasi</i></th>
        </tr>
        <tr>
            <td colspan="6" style="border: 1px solid #000;" class="input-inline">Penurunan Pendapatan Instansi Yang Bertanggungjawab Terhadap Sanitasi : <input type="number" name="sanitasi_pendapatan" value="{{ isset($data) ? $data->sanitasi_pendapatan : old('sanitasi_pendapatan') }}" class="form-control form-control-sm"> /Rp/Bulan</td>
        </tr>
        <tr>
            <td rowspan="2" style="border: 1px solid #000;">Kenaikan Biaya</td>
            <td style="border: 1px solid #000;" class="input-right">Pembersihan jaringan pembuangan <input type="number" name="biaya_pembersihan_jaringan" value="{{ isset($data) ? $data->biaya_pembersihan_jaringan : old('biaya_pembersihan_jaringan') }}" class="form-control form-control-sm"></td>
            <td colspan="4" style="border: 1px solid #000;" class="input-right">Sebutkan dasar perhitungan: <input type="text" name="dasar_perhitungan_biaya_pembersihan_jaringan" value="{{ isset($data) ? $data->dasar_perhitungan_biaya_pembersihan_jaringan : old('dasar_perhitungan_biaya_pembersihan_jaringan') }}" class="form-control form-control-sm"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000;" class="input-right">Kenaikan biaya bahan kimia <input type="number" name="biaya_bahan_kimia" value="{{ isset($data) ? $data->biaya_bahan_kimia : old('biaya_bahan_kimia') }}" class="form-control form-control-sm"></td>
            <td colspan="4" style="border: 1px solid #000;" class="input-right">Sebutkan dasar perhitungan: <input type="text" name="dasar_perhitungan_biaya_bahan_kimia" value="{{ isset($data) ? $data->dasar_perhitungan_biaya_bahan_kimia : old('dasar_perhitungan_biaya_bahan_kimia') }}" class="form-control form-control-sm"></td>
        </tr>
    </table>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
        <a href="{{ route('forms.form4.index', ['bencana_id' => request()->query('bencana_id')]) }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">{{ isset($edit) && $edit ? 'Update Data' : 'Simpan Data' }}</button>
    </div>
    </form>
</div>

@endsection

