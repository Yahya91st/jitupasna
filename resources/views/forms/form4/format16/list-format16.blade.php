@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Laporan Sektor Pemerintahan (Format 16)</h1>
    
    @if($bencana)
        <div class="alert alert-light-primary color-primary mb-4">
            <p><strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama }}</p>
            <p><strong>Tanggal:</strong> {{ $bencana->tanggal }}</p>
            <p><strong>Lokasi:</strong> 
                @foreach($bencana->desa as $desa)
                    {{ $desa->nama }}@if(!$loop->last), @endif
                @endforeach
            </p>
        </div>
    @endif
    
    <div class="mb-4 flex justify-between">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Kembali ke Form 4
        </a>          <div class="flex gap-2">
            <a href="{{ route('forms.form4.format16form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                <i class="fa fa-plus mr-2"></i> Tambah Laporan Baru
            </a>
            <a href="{{ route('forms.form4.show-format16', $bencana->id) }}" class="btn btn-info">
                <i class="fa fa-eye mr-2"></i> Lihat Ringkasan Laporan
            </a>
            <a href="{{ route('forms.form4.format16-preview-pdf', $bencana->id) }}" class="btn btn-secondary" target="_blank">
                <i class="fa fa-file-pdf mr-2"></i> Lihat PDF
            </a>
            <a href="{{ route('forms.form4.format16-pdf', $bencana->id) }}" class="btn btn-success" target="_blank">
                <i class="fa fa-download mr-2"></i> Unduh PDF
            </a>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        @if($reports->count() > 0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kampung</th>
                    <th>Nama Distrik</th>
                    <th>Total Kerusakan</th>
                    <th>Total Kerugian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $index => $report)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $report->nama_kampung }}</td>
                        <td>{{ $report->nama_distrik }}</td>
                        <td>Rp. {{ number_format($report->total_kerusakan ?? 0, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($report->total_kerugian ?? 0, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('forms.form4.show-format16', $report->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('forms.form4.edit-format16', $report->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('forms.form4.destroy-format16', $report->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            @if(Route::has('forms.form4.format16.pdf'))
                                <a href="{{ route('forms.form4.format16.pdf', $report->id) }}" class="btn btn-secondary btn-sm">PDF</a>
                            @else
                                <a href="#" class="btn btn-secondary btn-sm disabled">PDF</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-4 text-center">
            <p>Belum ada data laporan untuk sektor pemerintahan.</p>
            <a href="{{ route('forms.form4.format16form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary mt-2">
                <i class="fa fa-plus mr-2"></i> Tambah Data Sekarang
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
