@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Anggaran Kegiatan PKPB</h1>
    
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
        <div>
            <a href="{{ route('forms.form12.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary me-2">
                <i class="fa fa-plus mr-2"></i> Tambah Data Baru
            </a>
            <a href="{{ route('forms.form12.indeks') }}" class="btn btn-info">
                <i class="fa fa-chart-bar mr-2"></i> Kelola Indeks Biaya
            </a>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        @if(isset($anggaranList) && $anggaranList->count() > 0)
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sektor</th>
                        <th>Komponen Kebutuhan</th>
                        <th>Kegiatan</th>
                        <th>Volume</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anggaranList as $index => $anggaran)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $anggaran->sektor }}</td>
                        <td>{{ $anggaran->komponen_kebutuhan }}</td>
                        <td>{{ Str::limit($anggaran->kegiatan, 50) }}</td>
                        <td>{{ number_format($anggaran->volume, 0) }} {{ $anggaran->satuan }}</td>
                        <td>Rp {{ number_format($anggaran->harga_satuan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($anggaran->jumlah, 0, ',', '.') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('forms.form12.show', $anggaran->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('forms.form12.edit', $anggaran->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('forms.form12.previewPdf', $anggaran->id) }}" class="btn btn-sm btn-secondary" title="Preview PDF" target="_blank">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a href="{{ route('forms.form12.pdf', $anggaran->id) }}" class="btn btn-sm btn-primary" title="Download PDF" target="_blank">
                                    <i class="fa fa-download"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="font-weight-bold bg-light">
                        <td colspan="6" class="text-end">Total:</td>
                        <td colspan="2">Rp {{ number_format($anggaranList->sum('jumlah'), 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
            
            @if($bencana == null && method_exists($anggaranList, 'links'))
                <div class="p-3">
                    {{ $anggaranList->links() }}
                </div>
            @endif
        @else
            <div class="p-6 text-center">
                <p>Belum ada data anggaran kegiatan yang disimpan.</p>
                <a href="{{ route('forms.form12.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary mt-4">
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
