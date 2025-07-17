@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <h2 class="text-center mb-4">Daftar Laporan Sektor Telekomunikasi (Format 9)</h2>
    
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(isset($bencana))
        <div class="alert alert-info mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1"><strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama ?? 'Tidak tersedia' }}</p>
                    <p class="mb-1"><strong>Tanggal:</strong> {{ $bencana->tanggal ?? 'Tidak tersedia' }}</p>
                    <p class="mb-0"><strong>Lokasi:</strong> 
                        @if(isset($bencana->desa) && $bencana->desa->count() > 0)
                            @foreach($bencana->desa as $desa)
                                {{ $desa->nama }}@if(!$loop->last), @endif
                            @endforeach
                        @else
                            Tidak tersedia
                        @endif
                    </p>
                </div>
            </div>
        </div>
    @endif      <div class="mb-4 d-flex justify-content-between">
        <a href="{{ route('forms.form4.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left me-2"></i> Kembali ke Form 4
        </a>
        <a href="{{ route('forms.form4.format9form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
            <i class="fa fa-plus me-2"></i> Tambah Data Baru
        </a>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="table-responsive">                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="thead-light">
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
                                <a href="{{ route('forms.form4.show-format9', $report->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                <a href="{{ route('forms.form4.edit-format9', $report->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('forms.form4.destroy-format9', $report->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @if(Route::has('forms.form4.format9.pdf'))
                                    <a href="{{ route('forms.form4.format9.pdf', $report->id) }}" class="btn btn-secondary btn-sm">PDF</a>
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
