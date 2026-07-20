@extends('layouts.main')

@section('content')
    <div class="container">

        <h3 class="mb-4">Daftar Kajian</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">

            <div class="card-header">
                Daftar Laporan Siap Dikaji
            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>
                            <th width="60">Bencana ID</th>
                            <th>Jenis Bencana</th>
                            <th>Tanggal Kejadian</th>
                            <th>Status Kajian</th>
                            <th width="280">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($bencana as $item)
                            <tr>

                                <td>{{ $item->id }}</td>

                                <td>
                                    {{ config('bencana')[$item->jenis_bencana] ?? $item->jenis_bencana }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                </td>

                                <td>
                                    @if (optional($item->laporan)->kajian)
                                        <span class="badge bg-success">
                                            Sudah Dibuat
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            Belum Dibuat
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if (optional($item->laporan)->kajian)
                                        <a href="{{ route('kajian.preview', $item->laporan->kajian) }}" class="btn btn-info btn-sm">
                                            <i data-feather="eye"></i>
                                            Preview
                                        </a>

                                        <a href="{{ route('kajian.pdf', $item->laporan->kajian) }}" class="btn btn-success btn-sm">
                                            <i data-feather="download"></i>
                                            PDF
                                        </a>

                                        <a href="{{ route('kajian.edit', $item->laporan->kajian) }}" class="btn btn-warning btn-sm">
                                            <i data-feather="edit"></i>
                                            Edit
                                        </a>
                                    @else
                                        <a href="{{ route('kajian.create', $item) }}" class="btn btn-primary btn-sm">
                                            <i data-feather="plus"></i>
                                            Tambah
                                        </a>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Belum ada data bencana.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    {{ $bencana->links() }}
                </div>

            </div>

        </div>

    </div>
@endsection
