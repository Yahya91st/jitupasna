@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <h2 class="text-center mb-4">Daftar Laporan Sektor Telekomunikasi (Format 9)</h2>
    
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
        <a href="{{ route('form4.index', ['bencana_id' => $bencana_id ?? '']) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left me-2"></i> Kembali ke Form 4
        </a>
        <a href="{{ route('format9form4', ['bencana_id' => $bencana_id ?? '']) }}" class="btn btn-primary">
            <i class="fa fa-plus me-2"></i> Tambah Data Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kampung</th>
                            <th>Distrik</th>
                            <th>Total Kerusakan (Rp)</th>
                            <th>Total Kerugian (Rp)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($forms as $form)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $form->nama_kampung }}</td>
                            <td>{{ $form->nama_distrik }}</td>
                            <td class="text-end">{{ number_format($form->getTotalDamage(), 0, ',', '.') }}</td>
                            <td class="text-end">{{ number_format($form->getTotalLoss(), 0, ',', '.') }}</td>
                            <td>                                <div class="btn-group">
                                    <a href="{{ route('show-format9', $form->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('format9.pdf', $form->id) }}" target="_blank" class="btn btn-sm btn-danger" title="Download PDF">
                                        <i class="fa fa-file-pdf"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data laporan sektor telekomunikasi</td>
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
