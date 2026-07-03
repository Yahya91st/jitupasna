@extends('layouts.main')

@section('content')

<div class="container">

    <h3 class="mb-4">
        Detail Formulir
    </h3>

    <div class="card">

        <div class="card-body">

            <table class="table">

                <tr>
                    <th width="250">Sektor</th>
                    <td>{{ $format->nama_sektor }}</td>
                </tr>

                <tr>
                    <th>Nama Kampung</th>
                    <td>{{ $formulir->nama_kampung }}</td>
                </tr>

                <tr>
                    <th>Nama Distrik</th>
                    <td>{{ $formulir->nama_distrik }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($formulir->status) }}</td>
                </tr>

            </table>

        </div>

    </div>

    <div class="card mt-3">

        <div class="card-header">
            Item Formulir
        </div>

        <div class="card-body">

            @if($items->isEmpty())

                <div class="alert alert-warning mb-0">
                    Tidak ada item formulir.
                </div>

            @else

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Sub Kategori</th>
                            <th>Kerusakan</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($items as $item)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $item->kategori }}</td>

                                <td>{{ $item->sub_kategori ?? '-' }}</td>

                                <td>{{ $item->tingkat_kerusakan ?? '-' }}</td>

                                <td>{{ $item->jumlah }}</td>

                                <td>{{ number_format($item->harga_satuan) }}</td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @endif

        </div>

    </div>
    <div class="mt-3">

        {{-- Verifikasi --}}
        <form
            action="{{ route('verifikasi.formulir.verify', $formulir) }}"
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
            action="{{ route('verifikasi.formulir.revision', $formulir) }}"
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

        <a
            href="{{ route('verifikasi.format', [
                'laporan' => $laporan,
                'format' => $format
            ]) }}"
            class="btn btn-secondary mt-3">

            Kembali

        </a>

    </div>

</div>

@endsection