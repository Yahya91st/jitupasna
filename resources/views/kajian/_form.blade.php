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

<div class="card">

    <div class="card-header">
        Hasil Kajian
    </div>

    <div class="card-body">

        <div class="form-group">

            <label>Gangguan Akses</label>

            <textarea
                name="kehilangan_akses"
                class="form-control @error('kehilangan_akses') is-invalid @enderror"
                rows="4"
                required>{{ old('kehilangan_akses', $kajian->kehilangan_akses ?? '') }}</textarea>

            @error('kehilangan_akses')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <div class="form-group mt-3">

            <label>Gangguan Fungsi</label>

            <textarea
                name="gangguan_fungsi"
                class="form-control @error('gangguan_fungsi') is-invalid @enderror"
                rows="4"
                required>{{ old('gangguan_fungsi', $kajian->gangguan_fungsi ?? '') }}</textarea>

            @error('gangguan_fungsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <div class="form-group mt-3">

            <label>Peningkatan Risiko</label>

            <textarea
                name="peningkatan_resiko"
                class="form-control @error('peningkatan_resiko') is-invalid @enderror"
                rows="4"
                required>{{ old('peningkatan_resiko', $kajian->peningkatan_resiko ?? '') }}</textarea>

            @error('peningkatan_resiko')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

    </div>

    <div class="card-footer text-end">

        <a href="{{ route('kajian.index') }}"
            class="btn btn-secondary">

            Kembali

        </a>

        <button
            type="submit"
            class="btn btn-primary">

            <i data-feather="save"></i>

            {{ isset($kajian) ? 'Perbarui Kajian' : 'Simpan Kajian' }}

        </button>

    </div>

</div>
@endsection