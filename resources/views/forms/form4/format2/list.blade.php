@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Laporan Format 2 - Sektor Pendidikan</h3>
                    <p class="text-subtitle text-muted">
                        Daftar laporan sektor pendidikan
                    </p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Daftar Laporan Sektor Pendidikan</h4>

                    <a href="{{ route('forms.form4.format2.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Tambah Data Baru
                    </a>
                </div>

                <div class="card-body">

                    @if ($reports->isEmpty())
                        <div class="alert alert-info">
                            Belum ada data laporan sektor pendidikan untuk bencana ini.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Desa</th>
                                        <th>Nama Kampung</th>
                                        <th>Nama Distrik</th>
                                        <th>Total Kerusakan</th>
                                        <th>Total Kerugian</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>{{ $report->id }}</td>

                                            <td>
                                                {{ collect($report->laporan->bencana->villages ?? [])->pluck('name')->implode(', ') }}
                                            </td>

                                            <td>{{ $report->nama_kampung }}</td>

                                            <td>{{ $report->nama_distrik }}</td>

                                            <td>
                                                Rp {{ number_format($report->total_kerusakan ?? 0, 0, ',', '.') }}
                                            </td>

                                            <td>
                                                Rp {{ number_format($report->total_kerugian ?? 0, 0, ',', '.') }}
                                            </td>

                                            <td>
                                                <a href="{{ route('forms.form4.format2.show', [
                                                    'formulir' => $report->id,
                                                ]) }}" class="btn btn-info btn-sm">
                                                    Lihat
                                                </a>

                                                <a href="{{ route('forms.form4.format2.edit', [
                                                    'formulir' => $report->id,
                                                ]) }}" class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>

                                                <form action="{{ route('forms.form4.format2.destroy', [
                                                    'formulir' => $report->id,
                                                ]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        Delete
                                                    </button>
                                                </form>

                                                <a href="{{ route('forms.form4.format2.preview', [
                                                    'formulir' => $report->id,
                                                ]) }}" class="btn btn-secondary btn-sm">
                                                    Preview PDF
                                                </a>

                                                <a href="{{ route('forms.form4.format2.pdf', [
                                                    'formulir' => $report->id,
                                                ]) }}" class="btn btn-primary btn-sm">
                                                    Generate PDF
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </section>

        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Form 4
            </a>
        </div>
    </div>
@endsection
