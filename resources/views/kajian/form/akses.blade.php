@extends('layouts.main')

@section('content')

<div class="card mb-3">
    <div class="card-header">
        Informasi Bencana
    </div>

    <div class="card-body">

        <table class="table">

            <tr>
                <th>Jenis Bencana</th>
                <td>{{ $laporan->bencana->jenis_bencana }}</td>
            </tr>

            <tr>
                <th>Tanggal</th>
                <td>{{ $laporan->bencana->tanggal }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>{{ ucfirst($laporan->status_laporan) }}</td>
            </tr>

        </table>

    </div>
</div>

<div class="card mb-3">

    <div class="card-header">
        Ringkasan Hasil Pendataan
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Kampung</th>
                    <th>Distrik</th>
                    <th>Format</th>
                    <th>Kerusakan</th>
                    <th>Kerugian</th>

                </tr>

            </thead>

            <tbody>

                @php
                    $totalKerusakan = 0;
                    $totalKerugian = 0;
                @endphp

                @foreach($summaries as $row)

                    @php
                        $totalKerusakan += $row['total_kerusakan'];
                        $totalKerugian += $row['total_kerugian'];
                    @endphp

                    <tr>

                        <td>{{ $row['nama_kampung'] }}</td>

                        <td>{{ $row['nama_distrik'] }}</td>

                        <td>{{ $row['format'] }}</td>

                        <td>
                            Rp {{ number_format($row['total_kerusakan'],0,',','.') }}
                        </td>

                        <td>
                            Rp {{ number_format($row['total_kerugian'],0,',','.') }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

            <tfoot>

                <tr>

                    <th colspan="3">
                        Total
                    </th>

                    <th>
                        Rp {{ number_format($totalKerusakan,0,',','.') }}
                    </th>

                    <th>
                        Rp {{ number_format($totalKerugian,0,',','.') }}
                    </th>

                </tr>

            </tfoot>

        </table>

    </div>

</div>

<form
    action="{{ route('kajian.store', $laporan) }}"
    method="POST">

    @csrf

    <div class="form-group">
        <label>Gangguan Akses</label>

        <textarea
            name="kehilangan_akses"
            class="form-control"
            rows="4"></textarea>
    </div>

    <div class="form-group mt-3">
        <label>Gangguan Fungsi</label>

        <textarea
            name="gangguan_fungsi"
            class="form-control"
            rows="4"></textarea>
    </div>

    <div class="form-group mt-3">
        <label>Analisis Risiko</label>

        <textarea
            name="peningkatan_resiko"
            class="form-control"
            rows="4"></textarea>
    </div>
    <div class="col-12 d-flex justify-content-end gap-2 mt-4">

        <button
            type="reset"
            class="btn btn-light-secondary">

            <i data-feather="x"></i>
            Reset

        </button>

        <button
            type="submit"
            class="btn btn-primary">

            <i data-feather="save"></i>
            Simpan Kajian

        </button>

    </div>

</form>

<!-- <div class="form-group mt-3">
    <label>Rekomendasi</label>

    <textarea
        name="rekomendasi"
        class="form-control"
        rows="4"></textarea>
</div> -->
@endsection                                     