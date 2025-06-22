@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Kuesioner Form 09</h1>
    
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
    
    @if($bencana)
        <div class="alert alert-light-primary color-primary mb-4">
            <p>Bencana: {{ $bencana->kategori_bencana->nama }}</p>
            <p>Tanggal: {{ $bencana->tanggal }}</p>
            <p>Lokasi: 
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
        <a href="{{ route('forms.form9.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">
            <i class="fa fa-plus mr-2"></i> Tambah Data Baru
        </a>
    </div>    <div class="bg-white rounded-lg shadow overflow-x-auto">
        @if(isset($forms) && count($forms) > 0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Kuesioner</th>
                    <th>Tanggal</th>
                    <th>Kecamatan</th>
                    <th>Desa/Kelurahan</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>            </thead>
            <tbody>
                @foreach($forms as $index => $form)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $form->nomor_kuesioner }}</td>
                    <td>{{ \Carbon\Carbon::parse($form->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $form->kecamatan }}</td>
                    <td>{{ $form->desa_kelurahan }}</td>
                    <td>{{ $form->jenis_kelamin }}</td>                    <td>                        <div class="btn-group" style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 4px;">
                            <a href="{{ route('forms.form9.show', $form->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                <i class="fa fa-eye"></i> Detail
                            </a>
                            <a href="{{ route('forms.form9.edit', $form->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('forms.form9.preview-pdf', $form->id) }}" class="btn btn-sm btn-secondary" title="Preview PDF" target="_blank">
                                <i class="fa fa-search"></i> Lihat PDF
                            </a>
                            <a href="{{ route('forms.form9.pdf', $form->id) }}" class="btn btn-sm btn-primary" title="Download PDF" target="_blank">
                                <i class="fa fa-download"></i> Unduh PDF
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-6 text-center">
            <p>Belum ada data kuesioner yang dibuat untuk bencana ini.</p>
            <a href="{{ route('forms.form9.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary mt-4">
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
        $('.table').DataTable();
    });
</script>
@endpush
