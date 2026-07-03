@extends('layouts.main')

@section('content')

<div class="container">

    <h3 class="mb-4">
        Detail Laporan Bencana
    </h3>

    <div class="card">

        <div class="card-body">

            <table class="table">

                <tr>
                    <th width="250">Jenis Bencana</th>
                    <td>{{ $jenisBencana }}</td>
                </tr>

                <tr>
                    <th>Desa</th>
                    <td>{{ $villages ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Tanggal Kejadian</th>
                    <td>{{ \Carbon\Carbon::parse($laporan->bencana->tanggal)->format('Y-m-d') }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($laporan->status_laporan) }}</td>
                </tr>

            </table>

        </div>

    </div>

    <div class="mt-3">

    {{-- Verifikasi --}}
    <form
        action="{{ route('verifikasi.verify', $laporan) }}"
        method="POST"
        class="d-inline">

        @csrf
        @method('PATCH')

        <button
            type="submit"
            class="btn btn-success">
            Verifikasi
        </button>

    </form>

    {{-- Revisi --}}
    <form
        action="{{ route('verifikasi.revision', $laporan) }}"
        method="POST"
        class="mt-3">

        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label class="form-label">
                Catatan Revisi
            </label>

            <textarea
                name="catatan_revisi"
                class="form-control @error('catatan_revisi') is-invalid @enderror"
                rows="4"
                    placeholder="Tuliskan alasan revisi..."
                    required>{{ old('catatan_revisi') }}</textarea>

                @error('catatan_revisi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button
                type="submit"
                class="btn btn-danger">
                Kirim Revisi
            </button>

        </form>

        
    </div>
    
    <div class="mt-3">
        <div class="card mt-4">
            <div class="card-header">
                Daftar Sektor
            </div>

            <div class="list-group list-group-flush">

                @foreach($formats as $format)

                    <a
                        href="{{ route('verifikasi.format', [
                            'laporan' => $laporan,
                            'format' => $format
                        ]) }}"
                        class="list-group-item list-group-item-action">

                        {{ $format->kode_format }}
                        -
                        {{ $format->nama_sektor }}

                    </a>

                @endforeach

            </div>
        </div>
        <a
            href="{{ route('verifikasi.index') }}"
            class="btn btn-secondary">
            Kembali
        </a>
    </div>

</div>

@endsection