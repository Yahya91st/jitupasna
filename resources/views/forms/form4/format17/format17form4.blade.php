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
<div class="container-fluid mt-4">
    <h2 class="text-center fw-bold mb-3">PENGKAJIAN KEBUTUHAN PASCABENCANA</h2>
    <h4 class="text-center fw-bold mb-3">FORMAT 17: SEKTOR LINGKUNGAN HIDUP</h4>
    <h5 class="text-center mb-4">Kabupaten [nama kabupaten]</h5>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Kerusakan Sektor Lingkungan Hidup</h5>
        </div>
        <div class="card-body">
            <form action="{{ isset($edit) && $edit ? route('forms.form4.format17.update', $data->id) : route('forms.form4.format17.store') }}" method="POST">
                @csrf
                @if(isset($edit) && $edit)
                    @method('PATCH')
                @endif
                <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->bencana_id }}">
                
                <div class="mb-4">
                    <span class="fw-bold">NAMA KAMPUNG:</span>
                    <input type="text" name="nama_kampung" class="form-control d-inline-block ms-2" style="width: 300px;" value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}">
                </div>
                <div class="mb-4">
                    <span class="fw-bold">NAMA DISTRIK:</span>
                    <input type="text" name="nama_distrik" class="form-control d-inline-block ms-2" style="width: 300px;" value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}">
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle" style="width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 12%;">Keterangan</th>
                                <th style="width: 12%;">Jenis Kerusakan</th>
                                <th style="width: 8%;">RB</th>
                                <th style="width: 8%;">RS</th>
                                <th style="width: 8%;">RR</th>
                                <th style="width: 16%;">RB Harga</th>
                                <th style="width: 16%;">RS Harga</th>
                                <th style="width: 16%;">RR Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle fw-bold bg-light" colspan="8">Perkiraan Kerusakan</td>
                            </tr>
                            @for ($i = 1; $i <= 3; $i++)
                            <tr>
                                @if ($i == 1)
                                    <td class="text-start align-middle" rowspan="3">a) Ekosistem Darat</td>
                                @endif
                                <td><input type="text" name="ekosistem_darat_{{ $i }}_jenis" class="form-control form-control" value="{{ old('ekosistem_darat_'.$i.'_jenis', $data->{'ekosistem_darat_'.$i.'_jenis'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_darat_{{ $i }}_rb" class="form-control form-control" value="{{ old('ekosistem_darat_'.$i.'_rb', $data->{'ekosistem_darat_'.$i.'_rb'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_darat_{{ $i }}_rs" class="form-control form-control" value="{{ old('ekosistem_darat_'.$i.'_rs', $data->{'ekosistem_darat_'.$i.'_rs'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_darat_{{ $i }}_rr" class="form-control form-control" value="{{ old('ekosistem_darat_'.$i.'_rr', $data->{'ekosistem_darat_'.$i.'_rr'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_darat_{{ $i }}_rb_harga" class="form-control form-control" value="{{ old('ekosistem_darat_'.$i.'_rb_harga', $data->{'ekosistem_darat_'.$i.'_rb_harga'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_darat_{{ $i }}_rs_harga" class="form-control form-control" value="{{ old('ekosistem_darat_'.$i.'_rs_harga', $data->{'ekosistem_darat_'.$i.'_rs_harga'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_darat_{{ $i }}_rr_harga" class="form-control form-control" value="{{ old('ekosistem_darat_'.$i.'_rr_harga', $data->{'ekosistem_darat_'.$i.'_rr_harga'} ?? '') }}"></td>
                            </tr>
                            @endfor
                            @for ($i = 1; $i <= 3; $i++)
                            <tr>
                                @if ($i == 1)
                                    <td class="text-start align-middle" rowspan="3">b) Ekosistem Laut</td>
                                @endif
                                <td><input type="text" name="ekosistem_laut_{{ $i }}_jenis" class="form-control form-control" value="{{ old('ekosistem_laut_'.$i.'_jenis', $data->{'ekosistem_laut_'.$i.'_jenis'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_laut_{{ $i }}_rb" class="form-control form-control" value="{{ old('ekosistem_laut_'.$i.'_rb', $data->{'ekosistem_laut_'.$i.'_rb'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_laut_{{ $i }}_rs" class="form-control form-control" value="{{ old('ekosistem_laut_'.$i.'_rs', $data->{'ekosistem_laut_'.$i.'_rs'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_laut_{{ $i }}_rr" class="form-control form-control" value="{{ old('ekosistem_laut_'.$i.'_rr', $data->{'ekosistem_laut_'.$i.'_rr'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_laut_{{ $i }}_rb_harga" class="form-control form-control" value="{{ old('ekosistem_laut_'.$i.'_rb_harga', $data->{'ekosistem_laut_'.$i.'_rb_harga'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_laut_{{ $i }}_rs_harga" class="form-control form-control" value="{{ old('ekosistem_laut_'.$i.'_rs_harga', $data->{'ekosistem_laut_'.$i.'_rs_harga'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_laut_{{ $i }}_rr_harga" class="form-control form-control" value="{{ old('ekosistem_laut_'.$i.'_rr_harga', $data->{'ekosistem_laut_'.$i.'_rr_harga'} ?? '') }}"></td>
                            </tr>
                            @endfor
                            @for ($i = 1; $i <= 3; $i++)
                            <tr>
                                @if ($i == 1)
                                    <td class="text-start align-middle" rowspan="3">c) Ekosistem Udara</td>
                                @endif
                                <td><input type="text" name="ekosistem_udara_{{ $i }}_jenis" class="form-control form-control" value="{{ old('ekosistem_udara_'.$i.'_jenis', $data->{'ekosistem_udara_'.$i.'_jenis'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_udara_{{ $i }}_rb" class="form-control form-control" value="{{ old('ekosistem_udara_'.$i.'_rb', $data->{'ekosistem_udara_'.$i.'_rb'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_udara_{{ $i }}_rs" class="form-control form-control" value="{{ old('ekosistem_udara_'.$i.'_rs', $data->{'ekosistem_udara_'.$i.'_rs'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_udara_{{ $i }}_rr" class="form-control form-control" value="{{ old('ekosistem_udara_'.$i.'_rr', $data->{'ekosistem_udara_'.$i.'_rr'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_udara_{{ $i }}_rb_harga" class="form-control form-control" value="{{ old('ekosistem_udara_'.$i.'_rb_harga', $data->{'ekosistem_udara_'.$i.'_rb_harga'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_udara_{{ $i }}_rs_harga" class="form-control form-control" value="{{ old('ekosistem_udara_'.$i.'_rs_harga', $data->{'ekosistem_udara_'.$i.'_rs_harga'} ?? '') }}"></td>
                                <td><input type="number" name="ekosistem_udara_{{ $i }}_rr_harga" class="form-control form-control" value="{{ old('ekosistem_udara_'.$i.'_rr_harga', $data->{'ekosistem_udara_'.$i.'_rr_harga'} ?? '') }}"></td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="total_kerusakan" value="0">

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
