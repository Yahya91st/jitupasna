@extends('layouts.main')

@section('content')
    <div class="container">

        <h3 class="mb-4">
            Daftar Keputusan Pimpinan
        </h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">

            <div class="card-header">
                Daftar Bencana yang Membutuhkan Keputusan
            </div>

            <div class="card-body">

                {{-- Filter --}}
                <form method="GET" class="mb-3">

                    <div class="row">

                        <div class="col-md-4">

                            <select name="jenis_bencana" class="form-select" onchange="this.form.submit()">

                                <option value="">
                                    Semua Jenis Bencana
                                </option>

                                @foreach ($jenis_bencana as $key => $value)
                                    <option value="{{ $key }}" {{ request('jenis_bencana') == $key ? 'selected' : '' }}>

                                        {{ $value }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                </form>

                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>

                            <th width="80">
                                ID
                            </th>

                            <th>
                                Jenis Bencana
                            </th>

                            <th>
                                Tanggal Kejadian
                            </th>

                            <th>
                                Status Keputusan
                            </th>

                            <th width="220">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($bencana as $item)
                            <tr>

                                <td>
                                    {{ $item->id }}
                                </td>

                                <td>

                                    {{ config('bencana')[$item->jenis_bencana] ?? $item->jenis_bencana }}

                                </td>

                                <td>

                                    {{ $item->tanggal ? $item->tanggal->format('d-m-Y') : '-' }}

                                </td>

                                <td>

                                    @if (optional($item->laporan)->keputusan)
                                        <span class="badge bg-success">

                                            Sudah Diputuskan

                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">

                                            Belum Diputuskan

                                        </span>
                                    @endif

                                </td>

                                <td>
                                    @if ($item->laporan?->keputusan)
                                        <a href="{{ route('keputusan.edit', $item->laporan->keputusan) }}" class="btn btn-warning btn-sm">
                                            Edit Keputusan
                                        </a>

                                        <a href="{{ route('keputusan.preview', $item->laporan->keputusan) }}" class="btn btn-info btn-sm" target="_blank">
                                            Preview
                                        </a>
                                    @else
                                        <a href="{{ route('keputusan.create', $item->laporan) }}" class="btn btn-primary btn-sm">
                                            Tambah Keputusan
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

                <div class="d-flex justify-content-between align-items-center">

                    {{ $bencana->links() }}

                </div>

            </div>

        </div>

    </div>

    <script>
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>
@endsection
