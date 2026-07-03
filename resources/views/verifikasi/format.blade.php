@extends('layouts.main')

@section('content')

<div class="container">

    <h3 class="mb-4">
        Daftar Kampung - {{ $format->nama_sektor }}
    </h3>

    <div class="card">

        <div class="card-body">

            @if($formulirs->isEmpty())

                <div class="alert alert-warning mb-0">
                    Belum ada data kampung pada sektor ini.
                </div>

            @else

                <table class="table table-bordered">

                    <thead>

                        <tr>
                            <th width="60">No</th>
                            <th>Nama Kampung</th>
                            <th>Nama Distrik</th>
                            <th width="150">Status</th>
                            <th width="120">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($formulirs as $formulir)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $formulir->nama_kampung }}
                                </td>

                                <td>
                                    {{ $formulir->nama_distrik }}
                                </td>

                                <td>
                                    {{ ucfirst($formulir->status) }}
                                </td>

                                <td>

                                    <a
                                        href="{{ route('verifikasi.formulir', [
                                            'laporan' => $laporan,
                                            'format' => $format,
                                            'formulir' => $formulir
                                        ]) }}"
                                        class="btn btn-primary btn-sm">

                                        Detail

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @endif

        </div>

    </div>

    <a
        href="{{ route('verifikasi.show', $laporan) }}"
        class="btn btn-secondary mt-3">

        Kembali

    </a>

</div>

@endsection