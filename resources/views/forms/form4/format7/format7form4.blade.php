@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel dan input agar lebih kompak */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
        vertical-align: middle !important;
        text-align: center;
    }
    .table input.form-control {
        padding: 0.15rem 0.3rem !important;
        font-size: 0.95rem;
    }
    .table thead th {
        color: #727E8C !important;
        color: #ffffffff;
        font-weight: 600;
    }
    .input-group-text {
        padding: 0.15rem 0.5rem;
        font-size: 0.95rem;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
    }
    .input-group input.form-control {
        text-align: left;
    }
    .bg-secondary.text-white th {
        background-color: #475F7B !important;
        color: white !important;
    }
    .table-bordered > :not(caption) > * {
        border-width: 1px 0;
    }
    .table-bordered > :not(caption) > * > * {
        border-width: 0 1px;
    }
</style>
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengkajian Kebutuhan Pasca Bencana</h5>
    <p class="fw-bold">Format 7: Pengumpulan Data Sektor Transportasi</p>
    
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
            <table class="table table-bordered text-center align-middle" style="width: 100%;">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th colspan="9">I. PERKIRAAN KERUSAKAN INFRASTRUKTUR TRANSPORTASI</th>
                    </tr>
                    <tr>
                        <th rowspan="2" class="align-middle" style="width: 15%">Keterangan</th>
                        <th rowspan="2" style="width: 15%">Ruas Jalan/Nama Jembatan</th>
                        <th rowspan="2" style="width: 15%">Jenis Jalan/Jembatan<br>(Jalan Nasional/Kab/Kota/Desa)</th>
                        <th rowspan="2" style="width: 15%">Jenis Jalan/Jembatan<br>(Aspal, Batu, Tanah)</th>
                        <th colspan="3" class="text-center" style="width: 20%">JUMLAH KERUSAKAN (Dalam Km)</th>
                        <th rowspan="2" style="width: 10%">HARGA SATUAN/M2</th>
                        <th rowspan="2" style="width: 10%">Perkiraan Biaya<br>Perbaikan</th>
                    </tr>
                    <tr>
                        <th class="text-center">BERAT</th>
                        <th class="text-center">SEDANG</th>
                        <th class="text-center">RINGAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle fw-bold">JALAN</td>
                        <td><input type="text" name="jalan_ruas" class="form-control" value="{{ old('jalan_ruas', $data->jalan_ruas ?? '') }}"></td>
                        <td><input type="text" name="jalan_jenis" class="form-control" value="{{ old('jalan_jenis', $data->jalan_jenis ?? '') }}"></td>
                        <td><input type="text" name="jalan_tipe" class="form-control" value="{{ old('jalan_tipe', $data->jalan_tipe ?? '') }}"></td>
                        <td><input type="number" name="jalan_rusak_berat" class="form-control" min="0" value="{{ old('jalan_rusak_berat', $data->jalan_rusak_berat ?? '0') }}"></td>
                        <td><input type="number" name="jalan_rusak_sedang" class="form-control" min="0" value="{{ old('jalan_rusak_sedang', $data->jalan_rusak_sedang ?? '0') }}"></td>
                        <td><input type="number" name="jalan_rusak_ringan" class="form-control" min="0" value="{{ old('jalan_rusak_ringan', $data->jalan_rusak_ringan ?? '0') }}"></td>
                        <td><input type="number" name="jalan_harga_satuan" class="form-control" min="0" step="1000" value="{{ old('jalan_harga_satuan', $data->jalan_harga_satuan ?? '0') }}"></td>
                        <td><input type="number" name="jalan_biaya_perbaikan" class="form-control" min="0" step="1000" value="{{ old('jalan_biaya_perbaikan', $data->jalan_biaya_perbaikan ?? '0') }}"></td>
                    </tr>
                    <tr>
                        <td class="align-middle fw-bold">JEMBATAN</td>
                        <td><input type="text" name="jembatan_nama" class="form-control" value="{{ old('jembatan_nama', $data->jembatan_nama ?? '') }}"></td>
                        <td><input type="text" name="jembatan_jenis" class="form-control" value="{{ old('jembatan_jenis', $data->jembatan_jenis ?? '') }}"></td>
                        <td><input type="text" name="jembatan_tipe" class="form-control" value="{{ old('jembatan_tipe', $data->jembatan_tipe ?? '') }}"></td>
                        <td><input type="number" name="jembatan_rusak_berat" class="form-control" min="0" value="{{ old('jembatan_rusak_berat', $data->jembatan_rusak_berat ?? '0') }}"></td>
                        <td><input type="number" name="jembatan_rusak_sedang" class="form-control" min="0" value="{{ old('jembatan_rusak_sedang', $data->jembatan_rusak_sedang ?? '0') }}"></td>
                        <td><input type="number" name="jembatan_rusak_ringan" class="form-control" min="0" value="{{ old('jembatan_rusak_ringan', $data->jembatan_rusak_ringan ?? '0') }}"></td>
                        <td><input type="number" name="jembatan_harga_satuan" class="form-control" min="0" step="1000" value="{{ old('jembatan_harga_satuan', $data->jembatan_harga_satuan ?? '0') }}"></td>
                        <td><input type="number" name="jembatan_biaya_perbaikan" class="form-control" min="0" step="1000" value="{{ old('jembatan_biaya_perbaikan', $data->jembatan_biaya_perbaikan ?? '0') }}"></td>
                    </tr>
                    <tr>
                        <th colspan="9" class="bg-secondary text-white">II. KERUSAKAN KENDARAAN</th>
                    </tr>
                    @php
                        $kendaraan = [
                            ['Sedan dan Minibus', 'sedan_minibus'],
                            ['Bus dan Truk', 'bus_truk'],
                            ['Kendaraan Berat', 'kendaraan_berat'],
                            ['Kapal Laut', 'kapal_laut'],
                            ['Bus Air', 'bus_air'],
                            ['Speed Boat', 'speed_boat'],
                            ['Perahu Klotok', 'perahu_klotok'],
                        ];
                    @endphp
                    @foreach($kendaraan as [$label, $name])
                    <tr>
                        @if($loop->first)
                        <td class="text-start align-middle" rowspan="{{ count($kendaraan) }}">
                            <strong>c) Kerusakan kendaraan</strong><br>
                            <i>Diisi dengan jumlah unit kendaraan Darat dan laut yang rusak</i>
                        </td>
                        @endif
                        <td>{{ $label }}</td>
                        
                        <td colspan="2"><input type="number" name="{{ $name }}_jumlah" class="form-control form-control-sm"></td>
                        <td colspan="5">
                        <div class="input-group">
                            <input type="number" name="{{ $name }}_unit" class="form-control form-control-sm">
                            <span class="input-group-text" style="min-width:50px;">Unit</span>
                        </div>
                        </td>
                        
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="9" class="bg-secondary text-white">III. KERUSAKAN PRASARANA TRANSPORTASI</th>
                    </tr>
                    @php
                        $prasarana = [
                            ['TERMINAL', 'terminal'],
                            ['DERMAGA', 'dermaga'],
                            ['BANDARA', 'bandara'],
                        ];
                    @endphp
                    @foreach($prasarana as [$label, $name])
                    <tr>
                        <td>{{ $label }}</td>
                        
                        <td>Unit</td>
                        <td colspan="1"><input type="number" name="{{ $name }}_jumlah" class="form-control form-control-sm"></td>
                        <td colspan="1"><input type="number" name="{{ $name }}_rusak_berat" class="form-control form-control-sm"></td>
                        <td colspan="1"><input type="number" name="{{ $name }}_rusak_sedang" class="form-control form-control-sm"></td>
                        <td colspan="2"><input type="number" name="{{ $name }}_rusak_ringan" class="form-control form-control-sm"></td>
                        <td colspan="2"><input type="number" name="{{ $name }}_biaya_perbaikan" class="form-control form-control-sm"></td>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="9" class="bg-secondary text-white">IV. KEHILANGAN PENDAPATAN</th>
                    </tr>
                    <tr>
                        <td class="fw-bold text-start">KEHILANGAN PENDAPATAN ANGKUTAN DARAT</td>
                        <td colspan="3" class="text-start">
                            <div class="input-group input-group-currency">
                                <span class="input-group-text">A. PENDAPATAN PER HARI</span>
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="pendapatan_darat_per_hari" class="form-control form-control-sm">
                            </div>
                        </td>
                        <td colspan="5" class="text-start">
                            <div class="input-group">
                                <span class="input-group-text">B. JUMLAH ANGKUTAN TERDAMPAK</span>
                                <input type="number" name="jumlah_angkutan_darat_terdampak" class="form-control form-control-sm">
                                <span class="input-group-text">Unit</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-start">KEHILANGAN PENDAPATAN ANGKUTAN LAUT/SUNGAI</td>
                        <td colspan="3" class="text-start">
                            <div class="input-group input-group-currency">
                                <span class="input-group-text">A. PENDAPATAN PER HARI</span>
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="pendapatan_laut_per_hari" class="form-control form-control-sm">
                            </div>
                        </td>
                        <td colspan="5" class="text-start">
                            <div class="input-group">
                                <span class="input-group-text">B. JUMLAH ANGKUTAN TERDAMPAK</span>
                                <input type="number" name="jumlah_angkutan_laut_terdampak" class="form-control form-control-sm">
                                <span class="input-group-text">Unit</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-start">KEHILANGAN PENDAPATAN ANGKUTAN UDARA</td>
                        <td colspan="3 class="text-start">
                            <div class="input-group input-group-currency">
                                <span class="input-group-text">A. PENDAPATAN PER HARI</span>
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="pendapatan_udara_per_hari" class="form-control form-control-sm">
                            </div>
                        </td>
                        <td colspan="5" class="text-start">
                            <div class="input-group">
                                <span class="input-group-text">B. JUMLAH ANGKUTAN TERDAMPAK</span>
                                <input type="number" name="jumlah_angkutan_udara_terdampak" class="form-control form-control-sm">
                                <span class="input-group-text">Unit</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-start">KEHILANGAN PENDAPATAN TERMINAL</td>
                        <td colspan="8" class="text-start">
                            <div class="input-group input-group-currency">
                                <span class="input-group-text">A. PENDAPATAN PER HARI</span>
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="pendapatan_terminal_per_hari" class="form-control form-control-sm">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-start">KEHILANGAN PENDAPATAN DERMAGA</td>
                        <td colspan="8" class="text-start">
                            <div class="input-group input-group-currency">
                                <span class="input-group-text">A. PENDAPATAN PER HARI</span>
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="pendapatan_dermaga_per_hari" class="form-control form-control-sm">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-start">KEHILANGAN PENDAPATAN BANDARA</td>
                        <td colspan="8" class="text-start">
                            <div class="input-group input-group-currency">
                                <span class="input-group-text">A. PENDAPATAN PER HARI</span>
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="pendapatan_bandara_per_hari" class="form-control form-control-sm">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-start" rowspan="3" style="vertical-align: middle;">KENAIKAN BIAYA OPERASIONAL KENDARAAN AKIBAT PENGGUNAAN JALAN YANG RUSAK</td>
                        <td colspan="8" class="text-start">
                            <div class="input-group input-group-currency">
                                <span class="input-group-text">A. BIAYA OPERASIONAL KENDARAAN SEBELUM BENCANA</span>
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="biaya_operasional_sebelum" class="form-control form-control-sm">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" class="text-start">
                            <div class="input-group input-group-currency">
                                <span class="input-group-text">B. BIAYA OPERASIONAL KENDARAAN SETELAH BENCANA</span>
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="biaya_operasional_setelah" class="form-control form-control-sm">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" class="text-start">
                            <div class="input-group input-group-currency">
                                <span class="input-group-text">C. JUMLAH KENDARAAN TERDAMPAK</span>
                                <input type="number" name="jumlah_kendaraan_biaya_operasional" class="form-control form-control-sm">
                                <span class="input-group-text">Unit</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-start" rowspan="2" style="vertical-align: middle;">BIAYA PEMASANGAN INFRASTRUKTUR DARURAT (Misalnya: Jembatan Bailey)</td>
                        <td colspan="8" class="text-start">
                            <div class="input-group input-group-currency">
                                <span class="input-group-text">A. JUMLAH UNIT TERDAMPAK</span>
                                <input type="number" name="infrastruktur_darurat_jumlah" class="form-control form-control-sm">
                                <span class="input-group-text">Unit</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" class="text-start">
                            <div class="input-group input-group-currency">
                                <span class="input-group-text">B. BIAYA PER UNIT</span>
                                <span class="input-group-text">Rp</span>
                                <input type="number"  name="infrastruktur_darurat_biaya" class="form-control form-control-sm">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mb-4">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </div>
    </form>
</div>
@endsection