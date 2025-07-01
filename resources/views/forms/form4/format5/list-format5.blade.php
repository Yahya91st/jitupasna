@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Laporan Ekonomi (Format 5)</h1>
    
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
        <a href="{{ route('forms.form4.format5form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
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
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kampung</th>
                            <th>Distrik</th>
                            <th>Total Kerusakan</th>
                            <th>Total Kerugian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->nama_kampung }}</td>
                            <td>{{ $report->nama_distrik }}</td>
                            <td>{{ number_format($report->total_kerusakan, 0, ',', '.') }}</td>
                            <td>{{ number_format($report->total_kerugian, 0, ',', '.') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('forms.form4.show-format5', $report->id) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('forms.form4.edit-format5', $report->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('forms.form4.destroy-format5', $report->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
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
