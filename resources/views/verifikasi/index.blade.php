@extends('layouts.main')

@section('content')
<div class="container">

    <h3 class="mb-4">Verifikasi Laporan Bencana</h3>

    @if(session('success'))
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

                    @forelse($laporan as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->bencana->jenis_bencana ?? '-' }}</td>

                            <td>{{ \Carbon\Carbon::parse($item->bencana->tanggal)->format('Y-m-d') ?? '-' }}</td>

                            <td>

                                <span class="badge bg-secondary">
                                    {{ ucfirst($item->status_laporan) }}
                                </span>

                            </td>

                            <td>

                                <a
                                    href="{{ route('verifikasi.show', $item) }}"
                                    class="btn btn-primary btn-sm">

                                    Lihat

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center">
                                Belum ada laporan.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection