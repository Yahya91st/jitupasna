@extends('layouts.main')

@section('content')
    <div class="container">

        <h3 class="mb-4">Verifikasi Laporan Bencana</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bencana</th>
                            <th>Tanggal Kejadian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($laporan as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <div class="bencana-info">
                                        <h6 class="bencana-name">{{ config('bencana')[$item->bencana->jenis_bencana] }}</h6>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}</td>
                                <td>
                                    <ul class="location-list">
                                        @foreach ($item->villages as $village)
                                            {{ $village['name'] ?? $village['code'] }}
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>

                                <td>

                                    <a href="{{ route('verifikasi.show', $item) }}" class="btn btn-primary btn-sm">

                                        Lihat

                                    </a>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>

    </div>
@endsection
