@extends('layouts.main')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="text-center fw-bold mb-3">PENGKAJIAN KEBUTUHAN PASCABENCANA</h2>
    <h4 class="text-center fw-bold mb-3">FORMAT 17: SEKTOR LINGKUNGAN HIDUP</h4>
    <h5 class="text-center mb-4">Kabupaten [nama kabupaten]</h5>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Kerusakan Sektor Lingkungan Hidup</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('forms.form4.format17.store') }}" method="POST">
                @csrf
                <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
                
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-middle">KETERANGAN</th>
                                <th rowspan="2" class="text-center">Jenis Kerusakan</th>
                                <th colspan="3" class="align-middle text-center" style="width: 20px;">TINGKAT KERUSAKAN</th>                                
                                <th colspan="3" class="align-middle text-center">HARGA SATUAN</th>
                            </tr>
                            <tr>
                                <th class="text-center">RB</th>
                                <th class="text-center">RS</th>
                                <th class="text-center">RR</th>
                                <th class="text-center">RB</th>
                                <th class="text-center">RS</th>
                                <th class="text-center">RR</th>
                            </tr>
                        </thead>
        <tbody>
            <tr>
                <td colspan="8" class="align-middle fw-bold bg-light">Perkiraan Kerusakan</td>
            </tr>
            <tr>
                <td class="text-start">a) Ekosistem Darat</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr>
                <td class="text-start">b) Ekosistem Laut</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr>
                <td class="text-start">c) Ekosistem Udara</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr>
                <td colspan="8" class="align-middle fw-bold bg-light">Perkiraan Kerugian</td>
            </tr>
            <tr>
                <td class="text-start">a) Kehilangan Jasa Lingkungan</td>
                <td>Dasar Perhitungan</td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr>
                <td class="text-start">b) Biaya akibat Pencemaran Air</td>
                <td>Dasar Perhitungan</td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr>
                <td class="text-start">c) Biaya Pencemaran Udara</td>
                <td>Dasar Perhitungan</td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

            </tr>
            <tr><td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>
                <td style="padding:5px"><input type="text" class="form-control form-control-sm"></td>

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
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;">b) Ekosistem Laut</td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;">c) Ekosistem Udara</td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td colspan="8" class="p-4 font-semibold text-lg" style="border: 1px solid #000; height: 50px;">Perkiraan Kerugian</td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;">a) Kehilangan Jasa Lingkungan</td>
                <td colspan="1" class="p-4" style="border: 1px solid #000; height: 60px;">Dasar Perhitungan</td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;">b) Biaya akibat Pencemaran Air</td>
                <td colspan="1" class="p-4" style="border: 1px solid #000; height: 60px;">Dasar Perhitungan</td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;">c) Biaya Pencemaran Udara</td>
                <td colspan="1" class="p-4" style="border: 1px solid #000; height: 60px;">Dasar Perhitungan</td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
            <tr>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>                
                <td class="p-4" style="border: 1px solid #000; height: 60px;"></td>
            </tr>
        </tbody>
    </table>
    </div>
</div>
@endsection
