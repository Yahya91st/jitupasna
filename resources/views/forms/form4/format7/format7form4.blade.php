@extends('layouts.main')

@section('content')
<div class="container mt-4">    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <h4 class="mb-3">Format 7. Pengumpulan Data Sektor Transportasi</h4>
    
<form method="POST" action="{{ route('forms.form4.format7.store') }}">
    @csrf
    <table class="table table-bordered">
        <tr>
            <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $bencana->nama_kampung ?? '') }}"></td>
            <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $bencana->nama_distrik ?? '') }}"></td>
        </tr>
    </table>
    <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
    <div class="table-responsive">
        <table class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; table-layout: auto; width: 100%;">
            <tbody>            
            <tr style="text-align: center;" >
                <th rowspan="2" style="border: 1px solid #000; vertical-align: middle; background-color: #f0f0f0; padding : 0px 3px;">URAIAN<br>PERKIRAAN KERUSAKAN</th>
                <th rowspan="2" style="border: 1px solid #000; vertical-align: middle; background-color: #f0f0f0; padding : 0px 3px;">Ruas Jalan/Nama Jembatan</th>
                <th rowspan="2" style="border: 1px solid #000; vertical-align: middle; background-color: #f0f0f0; padding : 0px 3px;">Jenis Jalan/Jembatan<br>(Jalan Nasional/Kab/Kota/Desa)</th>
                <th rowspan="2" style="border: 1px solid #000; vertical-align: middle; background-color: #f0f0f0; padding : 0px 3px;">Jenis Jalan/Jembatan (Aspal, Batu, Tanah)</th>
                <th colspan="3" style="border: 1px solid #000; background-color: #f0f0f0; padding: 0px 3px;">JUMLAH KERUSAKAN (Dalam Km)</th>
                <th rowspan="2" style="border: 1px solid #000; vertical-align: middle; background-color: #f0f0f0; padding: 0px 3px; width: auto; white-space: nowrap;">HARGA SATUAN/M2</th>
                <th rowspan="2" style="border: 1px solid #000; vertical-align: middle; background-color: #f0f0f0; padding: 0px 3px; width: auto; white-space: nowrap;">Perkiraan Biaya Perbaikan</th>
            </tr>
            <tr style="text-align: center;">
                <th style="border: 1px solid #000; background-color: #f0f0f0; padding : 0px 3px;">BERAT</th>
                <th style="border: 1px solid #000; background-color: #f0f0f0; padding : 0px 3px;">SEDANG</th>
                <th style="border: 1px solid #000; background-color: #f0f0f0; padding : 0px 3px;">RINGAN</th>
            </tr>
            <tr>
                <td style="padding : 0px 5px; border: 1px solid #000; font-weight: bold;">a.) JALAN</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="text" name="jalan_ruas" class="form-control form-control-sm"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="text" name="jalan_jenis" class="form-control form-control-sm" ></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="text" name="jalan_tipe" class="form-control form-control-sm" ></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="jalan_rusak_berat" class="form-control form-control-sm" ></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="jalan_rusak_sedang" class="form-control form-control-sm" ></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="jalan_rusak_ringan" class="form-control form-control-sm" ></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="jalan_harga_satuan" class="form-control form-control-sm" ></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="jalan_biaya_perbaikan" class="form-control form-control-sm" ></td>
                
            </tr>            <tr>
                <td style="padding : 0px 5px; border: 1px solid #000; font-weight: bold;">b) JEMBATAN</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="text" name="jembatan_nama" class="form-control" ></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="text" name="jembatan_jenis" class="form-control" ></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="text" name="jembatan_tipe" class="form-control" ></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="jembatan_rusak_berat" class="form-control" ></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="jembatan_rusak_sedang" class="form-control" ></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="jembatan_rusak_ringan" class="form-control" ></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="jembatan_harga_satuan" class="form-control" ></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="jembatan_biaya_perbaikan" class="form-control" ></td>
            </tr>
            <tr style="text-align: center;">                
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;  background-color: #f0f0f0;"><strong></strong></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;  background-color: #f0f0f0;"><strong>Jenis Kendaraan</strong></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;  background-color: #f0f0f0;"><strong>Jumlah</strong></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;  background-color: #f0f0f0;"><strong>Unit</strong></td>
                <td rowspan="8" colspan="3" style="padding : 0px 3px; border: 1px solid #000;  background-color: #f0f0f0;"><strong>Tidak diisi</strong></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;  background-color: #f0f0f0;"><strong></strong></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;  background-color: #f0f0f0;"><strong></strong></td>
            </tr>
            <tr>
                <td rowspan="7" style="padding : 0px 5px; width: 25%; border: 1px solid #000; vertical-align: top; background-color: #f8f8f8;">
                    <strong>c) Kerusakan KENDARAAN</strong><br>
                    <i>Diisi dengan jumlah unit kendaraan Darat dan laut yang rusak</i>
                </td>                
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;">Sedan dan Minibus</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="sedan_minibus_jumlah" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="sedan_minibus_unit" class="form-control" style="width: 70%; display: inline-block"> Unit</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" class="form-control"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" class="form-control"></td>
                
            </tr>
            <tr>                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;">Bus dan Truk</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="bus_truk_jumlah" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="bus_truk_unit" class="form-control" style="width: 70%; display: inline-block"> Unit</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number"></td>
            </tr>
            <tr>                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;">Kendaraan Berat</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="kendaraan_berat_jumlah" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="kendaraan_berat_unit" class="form-control" style="width: 70%; display: inline-block"> Unit</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number"></td>
            </tr>
            <tr>                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;">KAPAL LAUT</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="kapal_laut_jumlah" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="kapal_laut_unit" class="form-control" style="width: 70%; display: inline-block"> Unit</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number"></td>
            </tr>
            <tr>                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;">BUS AIR</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="bus_air_jumlah" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="bus_air_unit" class="form-control" style="width: 70%; display: inline-block"> Unit</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number"></td>
            </tr>
            <tr>                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;">SPEED BOAT</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="speed_boat_jumlah" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="speed_boat_unit" class="form-control" style="width: 70%; display: inline-block"> Unit</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number"></td>
            </tr>
            <tr>                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;">Perahu Klotok</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="perahu_klotok_jumlah" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="perahu_klotok_unit" class="form-control" style="width: 70%; display: inline-block"> Unit</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number"></td>
            </tr>            <tr>
                <td colspan="4" style="text-align: center; padding : 0px 3px; border: 1px solid #000; background-color: #f0f0f0; font-weight: bold;"></td>
                <td colspan="1" style="text-align: center; padding : 0px 3px; border: 1px solid #000; background-color: #f0f0f0; font-weight: bold;">BERAT</td>
                <td colspan="1" style="text-align: center; padding : 0px 3px; border: 1px solid #000; background-color: #f0f0f0; font-weight: bold;">SEDANG</td>
                <td colspan="1" style="text-align: center; padding : 0px 3px; border: 1px solid #000; background-color: #f0f0f0; font-weight: bold;">RINGAN</td>
                <td colspan="2" style="text-align: center; padding : 0px 3px; border: 1px solid #000; background-color: #f0f0f0; font-weight: bold;"></td>
</tr>            <tr>
                <td rowspan="3" style="padding : 0px 5px; padding : 0px 3px; border: 1px solid #000; background-color: #f8f8f8; font-weight: bold; vertical-align: middle;">KERUSAKAN PRASARANA TRANSPORTASI  <br>(Lengkapi informasi dengan luasan dan tipe)</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;">TERMINAL</td>
                <td style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="terminal_jumlah" class="form-control" style="width: 100%"></td>
                <td style="padding : 0px 3px; border: 1px solid #000; text-align: center;">Unit</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="terminal_rusak_berat" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="terminal_rusak_sedang" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="terminal_rusak_ringan" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="terminal_biaya_perbaikan" class="form-control" style="width: 100%"></td>
            </tr>
            <tr>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;">DERMAGA</td>
                <td style="padding : 0px 3px; border: 1px solid #000; text-align: center;"><input type="number" name="dermaga_jumlah" class="form-control" style="width: 100%"></td>
                <td style="padding : 0px 3px; border: 1px solid #000; text-align: center;">Unit</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="dermaga_rusak_berat" class="form-control" style="width: 100%"></td>                
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="dermaga_rusak_sedang" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="dermaga_rusak_ringan" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="dermaga_biaya_perbaikan" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"></td>
            </tr>
            <tr>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;">BANDARA</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="bandara_jumlah" class="form-control" style="width: 100%"></td>                
                <td style="padding : 0px 3px; border: 1px solid #000; text-align: center;">Unit</td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="bandara_rusak_berat" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="bandara_rusak_sedang" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="bandara_rusak_ringan" class="form-control" style="width: 100%"></td>
                <td colspan="1" style="padding : 0px 3px; border: 1px solid #000;"><input type="number" name="bandara_biaya_perbaikan" class="form-control" style="width: 100%"></td>
            </tr><tr>
                <td colspan="9" style="padding : 0px 3px; border: 1px solid #000; background-color: #f0f0f0; font-weight: bold; text-align: center;">KEHILANGAN PENDAPATAN</td>
            </tr>
            <tr>                <td style="padding : 0px 5px; padding : 0px 3px; border: 1px solid #000; font-weight: bold; background-color: #f8f8f8;">KEHILANGAN PENDAPATAN ANGKUTAN DARAT</td>
                <td colspan="4" style="padding : 0px 3px; border: 1px solid #000;">A. PENDAPATAN PER HARI: <input type="number" name="pendapatan_darat_per_hari" class="form-control" style="width: 50%; display: inline-block"> Rp</td>
                <td colspan="4" style="padding : 0px 3px; border: 1px solid #000;">B: JUMLAH ANGKUTAN YANG TERKENA DAMPAK: <input type="number" name="jumlah_angkutan_darat_terdampak" class="form-control" style="width: 50%; display: inline-block"> Unit</td>
            </tr>
            <tr>                <td style="padding : 0px 5px; padding : 0px 3px; border: 1px solid #000; font-weight: bold; background-color: #f8f8f8;">KEHILANGAN PENDAPATAN ANGKUTAN LAUT/SUNGAI</td>
                <td colspan="4" style="padding : 0px 3px; border: 1px solid #000;">A. PENDAPATAN PER HARI: <input type="number" name="pendapatan_laut_per_hari" class="form-control" style="width: 50%; display: inline-block"> Rp</td>
                <td colspan="4" style="padding : 0px 3px; border: 1px solid #000;">B: JUMLAH ANGKUTAN YANG TERKENA DAMPAK: <input type="number" name="jumlah_angkutan_laut_terdampak" class="form-control" style="width: 50%; display: inline-block"> Unit</td>
            </tr>
            <tr>                <td style="padding : 0px 5px; padding : 0px 3px; border: 1px solid #000; font-weight: bold; background-color: #f8f8f8;">KEHILANGAN PENDAPATAN ANGKUTAN UDARA</td>
                <td colspan="4" style="padding : 0px 3px; border: 1px solid #000;">A. PENDAPATAN PER HARI: <input type="number" name="pendapatan_udara_per_hari" class="form-control" style="width: 50%; display: inline-block"> Rp</td>
                <td colspan="4" style="padding : 0px 3px; border: 1px solid #000;">B: JUMLAH ANGKUTAN YANG TERKENA DAMPAK: <input type="number" name="jumlah_angkutan_udara_terdampak" class="form-control" style="width: 50%; display: inline-block"> Unit</td>
            </tr>            <tr>                <td style="padding : 0px 5px; padding : 0px 3px; border: 1px solid #000; font-weight: bold; background-color: #f8f8f8;">KEHILANGAN PENDAPATAN TERMINAL</td>
                <td colspan="8" style="padding : 0px 3px; border: 1px solid #000;">A. PENDAPATAN PER HARI: <input type="number" name="pendapatan_terminal_per_hari" class="form-control" style="width: 30%; display: inline-block"> Rp</td>
            </tr>
            <tr>                <td style="padding : 0px 5px; padding : 0px 3px; border: 1px solid #000; font-weight: bold; background-color: #f8f8f8;">KEHILANGAN PENDAPATAN DERMAGA</td>
                <td colspan="8" style="padding : 0px 3px; border: 1px solid #000;">A. PENDAPATAN PER HARI: <input type="number" name="pendapatan_dermaga_per_hari" class="form-control" style="width: 30%; display: inline-block"> Rp</td>
            </tr>
            <tr>                <td style="padding : 0px 5px; padding : 0px 3px; border: 1px solid #000; font-weight: bold; background-color: #f8f8f8;">KEHILANGAN PENDAPATAN BANDARA</td>
                <td colspan="8" style="padding : 0px 3px; border: 1px solid #000;">A. PENDAPATAN PER HARI: <input type="number" name="pendapatan_bandara_per_hari" class="form-control" style="width: 30%; display: inline-block"> Rp</td>
            </tr>
            <tr>                <td rowspan="3" style="padding : 0px 5px; padding : 0px 3px; border: 1px solid #000; font-weight: bold; vertical-align: middle; background-color: #f8f8f8;">KENAIKAN BIAYA OPERASIONAL KENDARAAN AKIBAT PENGGUNAAN JALAN YANG RUSAK</td>
                <td colspan="8" style="padding : 0px 3px; border: 1px solid #000;">A. BIAYA OPERASIONAL KENDARAAN SEBELUM BENCANA: <input type="number" name="biaya_operasional_sebelum" class="form-control" style="width: 30%; display: inline-block"> Rp</td>
            </tr>
            <tr>
                <td colspan="8" style="padding : 0px 3px; border: 1px solid #000;">B. BIAYA OPERASIONAL KENDARAAN SETELAH BENCANA: <input type="number" name="biaya_operasional_setelah" class="form-control" style="width: 30%; display: inline-block"> Rp</td>
            </tr><tr>
                <td colspan="8" style="padding : 0px 3px; border: 1px solid #000;">C. JUMLAH KENDARAAN TERDAMPAK: <input type="number" name="jumlah_kendaraan_biaya_operasional" class="form-control" style="width: 30%; display: inline-block"> Unit</td>
            </tr>
                        
            <tr>                <td rowspan="2" style="padding : 0px 5px; padding : 0px 3px; border: 1px solid #000; font-weight: bold; background-color: #f8f8f8;">BIAYA PEMASANGAN INFRASTRUKTUR DARURAT (Misalnya: Jembatan Bailey)</td>
                <td colspan="8" style="padding : 0px 3px; border: 1px solid #000;">
                    A. JUMLAH UNIT TERDAMPAK: <input type="number" name="infrastruktur_darurat_jumlah" class="form-control" style="width: 30%; display: inline-block"> Unit
                </td>
            </tr>
            <tr>
                <td colspan="8" style="padding : 0px 3px; border: 1px solid #000;">
                    B. BIAYA PER UNIT: <input type="number" name="infrastruktur_darurat_biaya" class="form-control" style="width: 30%; display: inline-block"> Rp
                </td>            </tr>
        </tbody>
    </table>
    
    <div class="mt-3 text-center">
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </div>
</form>
</div>
@endsection

