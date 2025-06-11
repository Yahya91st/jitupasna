@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Diskusi Kelompok Terfokus (FGD)</h3>
                <p class="text-subtitle text-muted">Daftar seluruh pencatatan Diskusi Kelompok Terfokus (FGD)</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <div class="float-end">
                    <a href="{{ route('forms.form7.index') }}" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Tambah FGD Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="tabelFgd">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bencana</th>
                            <th>Tanggal FGD</th>
                            <th>Lokasi</th>
                            <th>Jumlah Peserta</th>
                            <th>Fasilitator</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fgds as $index => $fgd)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $fgd->bencana->Ref }}</td>
                            <td>{{ \Carbon\Carbon::parse($fgd->tanggal)->format('d F Y') }}</td>
                            <td>{{ $fgd->desa_kelurahan }}, {{ $fgd->kecamatan }}</td>
                            <td>{{ $fgd->jumlah_peserta }} orang</td>
                            <td>{{ $fgd->fasilitator }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('forms.form7.show', $fgd->id) }}" class="btn btn-sm btn-primary" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('forms.form7.edit', $fgd->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="{{ route('forms.form7.preview-pdf', $fgd->id) }}" class="btn btn-sm btn-info" target="_blank" title="Pratinjau PDF">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </a>
                                    <a href="{{ route('forms.form7.pdf', $fgd->id) }}" class="btn btn-sm btn-success" title="Unduh PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data FGD</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="d-flex justify-content-center mt-3">
                    {{ $fgds->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('#tabelFgd').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            },
            "paging": false,
            "ordering": true,
            "info": false,
            "searching": true
        });
    });
</script>
@endpush
