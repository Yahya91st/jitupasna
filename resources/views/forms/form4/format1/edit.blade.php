@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h5 class="text-center fw-bold">Formulir 04<br>Edit Data Sektor Perumahan</h5>
        <p class="fw-bold">Format 1a: Edit Data Sektor Perumahan</p>
        
        @if($bencana)
            <div class="alert alert-light-primary color-primary mb-4">
                <p>Bencana: {{ $bencana->kategori_bencana->nama }}</p>
                <p>Tanggal: {{ $bencana->tanggal }}</p>
                <p>Lokasi: 
                    @foreach($bencana->desa as $desa)
                        {{ $desa->nama }}@if(!$loop->last), @endif
                    @endforeach
                </p>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger mb-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
        <form action="{{ route('forms.form4.update-format1', $formPerumahan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <table class="table table-bordered">
                <tr>
                    <td style="width: 50%">NAMA KAMPUNG: 
                        <input type="text" class="form-control" name="nama_kampung" value="{{ old('nama_kampung', $formPerumahan->nama_kampung) }}" required>
                    </td>
                    <td>NAMA DISTRIK: 
                        <input type="text" class="form-control" name="nama_distrik" value="{{ old('nama_distrik', $formPerumahan->nama_distrik) }}" required>
                    </td>
                </tr>
            </table>

            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th rowspan="2">Perkiraan Kerusakan</th>
                        <th colspan="3">Jumlah Rumah</th>
                        <th colspan="2">Harga Satuan</th>
                    </tr>
                    <tr>
                        <th>Rumah Permanen</th>
                        <th>Rumah Non Permanen</th>
                        <th>Jumlah</th>
                        <th>Permanen</th>
                        <th>Non Permanen</th>
                    </tr>
                </thead>                <tbody>
                    <tr>
                        <td>1a) JUMLAH RUMAH HANCUR TOTAL</td>
                        <td><input type="number" class="form-control" name="rumah_hancur_total_permanen" value="{{ old('rumah_hancur_total_permanen', $formPerumahan->rumah_hancur_total_permanen) }}" placeholder="0"></td>
                        <td><input type="number" class="form-control" name="rumah_hancur_total_non_permanen" value="{{ old('rumah_hancur_total_non_permanen', $formPerumahan->rumah_hancur_total_non_permanen) }}" placeholder="0"></td>
                        <td><input type="number" class="form-control" name="hancur_total_jumlah" placeholder="0" readonly></td>
                        <td><input type="number" class="form-control" name="harga_satuan_hancur_total_permanen" value="{{ old('harga_satuan_hancur_total_permanen', $formPerumahan->harga_satuan_hancur_total_permanen) }}" placeholder="0"></td>
                        <td><input type="number" class="form-control" name="harga_satuan_hancur_total_non_permanen" value="{{ old('harga_satuan_hancur_total_non_permanen', $formPerumahan->harga_satuan_hancur_total_non_permanen) }}" placeholder="0"></td>
                    </tr>
                    <tr>
                        <td>1b) JUMLAH RUMAH RUSAK BERAT</td>
                        <td><input type="number" class="form-control" name="rumah_rusak_berat_permanen" value="{{ old('rumah_rusak_berat_permanen', $formPerumahan->rumah_rusak_berat_permanen) }}" placeholder="0"></td>
                        <td><input type="number" class="form-control" name="rumah_rusak_berat_non_permanen" value="{{ old('rumah_rusak_berat_non_permanen', $formPerumahan->rumah_rusak_berat_non_permanen) }}" placeholder="0"></td>
                        <td><input type="number" class="form-control" name="rusak_berat_jumlah" placeholder="0" readonly></td>
                        <td><input type="number" class="form-control" name="harga_satuan_rusak_berat_permanen" value="{{ old('harga_satuan_rusak_berat_permanen', $formPerumahan->harga_satuan_rusak_berat_permanen) }}" placeholder="0"></td>
                        <td><input type="number" class="form-control" name="harga_satuan_rusak_berat_non_permanen" value="{{ old('harga_satuan_rusak_berat_non_permanen', $formPerumahan->harga_satuan_rusak_berat_non_permanen) }}" placeholder="0"></td>
                    </tr>
                    <tr>
                        <td>1c) JUMLAH RUMAH RUSAK SEDANG</td>
                        <td><input type="number" class="form-control" name="rumah_rusak_sedang_permanen" value="{{ old('rumah_rusak_sedang_permanen', $formPerumahan->rumah_rusak_sedang_permanen) }}" placeholder="0"></td>
                        <td><input type="number" class="form-control" name="rumah_rusak_sedang_non_permanen" value="{{ old('rumah_rusak_sedang_non_permanen', $formPerumahan->rumah_rusak_sedang_non_permanen) }}" placeholder="0"></td>
                        <td><input type="number" class="form-control" name="rusak_sedang_jumlah" placeholder="0" readonly></td>
                        <td><input type="number" class="form-control" name="harga_satuan_rusak_sedang_permanen" value="{{ old('harga_satuan_rusak_sedang_permanen', $formPerumahan->harga_satuan_rusak_sedang_permanen) }}" placeholder="0"></td>
                        <td><input type="number" class="form-control" name="harga_satuan_rusak_sedang_non_permanen" value="{{ old('harga_satuan_rusak_sedang_non_permanen', $formPerumahan->harga_satuan_rusak_sedang_non_permanen) }}" placeholder="0"></td>
                    </tr>
                    <tr>
                        <td>1d) JUMLAH RUMAH RUSAK RINGAN</td>
                        <td><input type="number" class="form-control" name="rumah_rusak_ringan_permanen" value="{{ old('rumah_rusak_ringan_permanen', $formPerumahan->rumah_rusak_ringan_permanen) }}" placeholder="0"></td>
                        <td><input type="number" class="form-control" name="rumah_rusak_ringan_non_permanen" value="{{ old('rumah_rusak_ringan_non_permanen', $formPerumahan->rumah_rusak_ringan_non_permanen) }}" placeholder="0"></td>
                        <td><input type="number" class="form-control" name="rusak_ringan_jumlah" placeholder="0" readonly></td>
                        <td><input type="number" class="form-control" name="harga_satuan_rusak_ringan_permanen" value="{{ old('harga_satuan_rusak_ringan_permanen', $formPerumahan->harga_satuan_rusak_ringan_permanen) }}" placeholder="0"></td>
                        <td><input type="number" class="form-control" name="harga_satuan_rusak_ringan_non_permanen" value="{{ old('harga_satuan_rusak_ringan_non_permanen', $formPerumahan->harga_satuan_rusak_ringan_non_permanen) }}" placeholder="0"></td>
                    </tr>
                    <tr class="table-success">
                        <td><strong>TOTAL KERUSAKAN</strong></td>
                        <td><input type="number" class="form-control" name="total_permanen" readonly></td>
                        <td><input type="number" class="form-control" name="total_non_permanen" readonly></td>
                        <td><input type="number" class="form-control" name="grand_total_rumah" readonly></td>
                        <td colspan="2"><strong>TOTAL KERUGIAN</strong></td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('forms.form4.list-format1', ['bencana_id' => $formPerumahan->bencana_id]) }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left me-2"></i> Kembali ke Daftar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save me-2"></i> Update Data
                </button>
            </div>
        </form>
    </div>

    <script>
        // Auto-calculate totals when inputs change
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[type="number"]');
            
            function calculateTotals() {
                // Calculate each category total
                const hancurTotalPermanen = parseInt(document.querySelector('input[name="rumah_hancur_total_permanen"]').value) || 0;
                const hancurTotalNonPermanen = parseInt(document.querySelector('input[name="rumah_hancur_total_non_permanen"]').value) || 0;
                const hancurTotalJumlah = hancurTotalPermanen + hancurTotalNonPermanen;
                document.querySelector('input[name="hancur_total_jumlah"]').value = hancurTotalJumlah;

                const rusakBeratPermanen = parseInt(document.querySelector('input[name="rumah_rusak_berat_permanen"]').value) || 0;
                const rusakBeratNonPermanen = parseInt(document.querySelector('input[name="rumah_rusak_berat_non_permanen"]').value) || 0;
                const rusakBeratJumlah = rusakBeratPermanen + rusakBeratNonPermanen;
                document.querySelector('input[name="rusak_berat_jumlah"]').value = rusakBeratJumlah;

                const rusakSedangPermanen = parseInt(document.querySelector('input[name="rumah_rusak_sedang_permanen"]').value) || 0;
                const rusakSedangNonPermanen = parseInt(document.querySelector('input[name="rumah_rusak_sedang_non_permanen"]').value) || 0;
                const rusakSedangJumlah = rusakSedangPermanen + rusakSedangNonPermanen;
                document.querySelector('input[name="rusak_sedang_jumlah"]').value = rusakSedangJumlah;

                const rusakRinganPermanen = parseInt(document.querySelector('input[name="rumah_rusak_ringan_permanen"]').value) || 0;
                const rusakRinganNonPermanen = parseInt(document.querySelector('input[name="rumah_rusak_ringan_non_permanen"]').value) || 0;
                const rusakRinganJumlah = rusakRinganPermanen + rusakRinganNonPermanen;
                document.querySelector('input[name="rusak_ringan_jumlah"]').value = rusakRinganJumlah;

                // Calculate grand totals
                const totalPermanen = hancurTotalPermanen + rusakBeratPermanen + rusakSedangPermanen + rusakRinganPermanen;
                const totalNonPermanen = hancurTotalNonPermanen + rusakBeratNonPermanen + rusakSedangNonPermanen + rusakRinganNonPermanen;
                const grandTotal = totalPermanen + totalNonPermanen;

                document.querySelector('input[name="total_permanen"]').value = totalPermanen;
                document.querySelector('input[name="total_non_permanen"]').value = totalNonPermanen;
                document.querySelector('input[name="grand_total_rumah"]').value = grandTotal;
            }

            // Add event listeners to all number inputs
            inputs.forEach(input => {
                if (!input.readOnly) {
                    input.addEventListener('input', calculateTotals);
                }
            });

            // Calculate initial totals
            calculateTotals();
        });
    </script>
@endsection
