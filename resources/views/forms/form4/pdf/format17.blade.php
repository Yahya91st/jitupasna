@extends('layouts.main')

@section('content')
    <h4 class="text-center font-bold mb-4">FORMATT 17: SEKTOR LINGKUNGAN HIDUP</h4>
    <div class="mb-4">
        <span class="font-semibold">KABUPATEN:</span>
    </div>

    <table class="table-auto w-full border border-black text-sm">
        <thead>
            <tr>
                <th rowspan="2" class="border border-black p-1 text-center">KETERANGAN</th>
                <th rowspan="2" class="border border-black p-1 text-center">Jenis Kerusakan</th>
                <th colspan="3" class="border border-black p-1 text-center">TINGKAT KERUSAKAN</th>
                <th colspan="3" class="border border-black p-1 text-center">HARGA SATUAN</th>
            </tr>
            <tr>
                <th class="border border-black p-1 text-center">RB</th>
                <th class="border border-black p-1 text-center">RS</th>
                <th class="border border-black p-1 text-center">RR</th>
                <th class="border border-black p-1 text-center">RB</th>
                <th class="border border-black p-1 text-center">RS</th>
                <th class="border border-black p-1 text-center">RR</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-black p-1 font-semibold">Perkiraan Kerusakan</td>
                <td class="border border-black p-1">a) Ekosistem Darat</td>
                <td class="border border-black p-1"></td>
                <td class="border border-black p-1"></td>
                <td class="border border-black p-1"></td>
                <td class="border border-black p-1"></td>
                <td class="border border-black p-1"></td>
                <td class="border border-black p-1"></td>
            </tr>
            <tr>
                <td></td>
                <td class="border border-black p-1">b) Ekosistem Laut</td>
                <td class="border border-black p-1"></td>
                <td class="border border-black p-1"></td>
                <td class="border border-black p-1"></td>
                <td class="border border-black p-1"></td>
                <td class="border border-black p-1"></td>
                <td class="border border-black p-1"></td>
            </tr>
            <tr>
                <td></td>
                <td class="border border-black p-1">c) Ekosistem Udara</td>
                <td class="border border-black p-1"></td>
                <td class="border border-black p-1"></td>
                <td class="border border-black p-1"></td>
                <td class="border border-black p-1"></td>
                <td class="border border-black p-1"></td>
                <td class="border border-black p-1"></td>
            </tr>
            <tr>
                <td class="border border-black p-1 font-semibold">Perkiraan Kerugian</td>
                <td class="border border-black p-1">a) Kehilangan Jasa Lingkungan</td>
                <td colspan="6" class="border border-black p-1">Dasar Perhitungan</td>
            </tr>
            <tr>
                <td></td>
                <td class="border border-black p-1">b) Biaya akibat Pencemaran Air</td>
                <td colspan="6" class="border border-black p-1">Dasar Perhitungan</td>
            </tr>
            <tr>
                <td></td>
                <td class="border border-black p-1">c) Biaya Pencemaran Udara</td>
                <td colspan="6" class="border border-black p-1">Dasar Perhitungan</td>
            </tr>
        </tbody>
    </table>
@endsection
