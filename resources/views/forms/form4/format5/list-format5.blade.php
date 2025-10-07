@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Laporan Sektor Agama (Format 5)</h1>
    
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
        </a>
        <a href="{{ route('forms.form4.format5.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
            <i class="fa fa-plus mr-2"></i> Tambah Data Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-lg" id="dataTable">
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
                        @forelse($reports as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report->nama_kampung }}</td>
                            <td>{{ $report->nama_distrik }}</td>
                            <td>Rp. {{ number_format($report->total_kerusakan ?? 0, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($report->total_kerugian ?? 0, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('forms.form4.format5.show', $report->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                <a href="{{ route('forms.form4.format5.edit', $report->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('forms.form4.format5.destroy', $report->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @if(Route::has('forms.form4.format5.pdf'))
                                    <a href="{{ route('forms.form4.format5.pdf', $report->id) }}" class="btn btn-secondary btn-sm">PDF</a>
                                @else
                                    <a href="#" class="btn btn-secondary btn-sm disabled">PDF</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection
