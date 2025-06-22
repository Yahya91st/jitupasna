@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Rekapitulasi Kebutuhan Pascabencana</h1>
    
    @if($bencana ?? null)
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
        <a href="{{ route('forms.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Kembali
        </a>
        <a href="{{ route('forms.form11.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">
            <i class="fa fa-plus mr-2"></i> Tambah Data Baru
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        @if(isset($rekapitulasiList) && $rekapitulasiList->count() > 0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Sektor</th>
                    <th>Sub Sektor</th>
                    <th>Jenis Kebutuhan</th>
                    <th>Jumlah Unit</th>
                    <th>Total Kebutuhan</th>
                    <th>Prioritas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekapitulasiList as $index => $rekapitulasi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $rekapitulasi->sektor }}</td>
                    <td>{{ $rekapitulasi->sub_sektor }}</td>
                    <td>{{ Str::limit($rekapitulasi->jenis_kebutuhan, 50) }}</td>
                    <td>{{ number_format($rekapitulasi->jumlah_unit, 2) }} {{ $rekapitulasi->satuan }}</td>
                    <td>Rp {{ number_format($rekapitulasi->total_kebutuhan, 0, ',', '.') }}</td>
                    <td>
                        @if($rekapitulasi->prioritas == 'Tinggi')
                            <span class="badge bg-danger">Tinggi</span>
                        @elseif($rekapitulasi->prioritas == 'Sedang')
                            <span class="badge bg-warning">Sedang</span>
                        @else
                            <span class="badge bg-info">Rendah</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 4px;">
                            <a href="{{ route('forms.form11.show', $rekapitulasi->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                <i class="fa fa-eye"></i> Detail
                            </a>
                            <a href="{{ route('forms.form11.edit', $rekapitulasi->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('forms.form11.previewPdf', $rekapitulasi->id) }}" class="btn btn-sm btn-secondary" title="Preview PDF" target="_blank">
                                <i class="fa fa-search"></i> Lihat PDF
                            </a>
                            <a href="{{ route('forms.form11.pdf', $rekapitulasi->id) }}" class="btn btn-sm btn-primary" title="Download PDF" target="_blank">
                                <i class="fa fa-download"></i> Unduh PDF
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($bencana == null && method_exists($rekapitulasiList, 'links'))
        <div class="p-3">
            {{ $rekapitulasiList->links() }}
        </div>
        @endif
        
        @else
        <div class="p-6 text-center">
            <p>Belum ada data rekapitulasi kebutuhan yang disimpan untuk bencana ini.</p>
            <a href="{{ route('forms.form11.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary mt-4">
                <i class="fa fa-plus mr-2"></i> Tambah Data Sekarang
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('.table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            }
        });
    });
</script>
@endpush
