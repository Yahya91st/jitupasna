@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title mb-4">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Surat Keputusan Tim Kerja</h3>
                <p class="text-subtitle text-muted">Daftar Surat Keputusan Pembentukan Tim Kerja Pengkajian Kebutuhan Pascabencana</p>
            </div>            <div class="col-12 col-md-6 order-md-2 order-first">
                <div class="float-end">
                    <a href="{{ route('forms.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('forms.form2.index') }}" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Tambah Surat Keputusan Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-lg" id="tabelKeputusan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Lokasi</th>
                            <th>Bencana</th>
                            <th>Tanggal Ditetapkan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($form as $index => $data)                        
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->nomor_surat }}</td>
                            <td>{{ $data->lokasi }}</td>
                            <td>{{ $data->nama_bencana }}</td>
                            <td>{{ $data->tanggal_ditetapkan ?? '-' }}</td>     
                            <td>                           
                                <div class="btn-group" style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 4px;">
                                    <a href="{{ route('forms.form2.show', $data->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('forms.form2.edit', $data->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="{{ route('forms.form2.preview-pdf', $data->id) }}" class="btn btn-sm btn-secondary" title="Preview PDF" target="_blank">
                                        <i class="bi bi-file-earmark-pdf"></i> Lihat PDF
                                    </a>
                                    <a href="{{ route('forms.form2.pdf', $data->id) }}" class="btn btn-sm btn-primary" title="Download PDF" target="_blank">
                                        <i class="bi bi-download"></i> Unduh PDF
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data surat keputusan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('#tabelKeputusan').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            }
        });
    });
</script>
@endpush
