@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Surat Permohonan Keterlibatan dalam PDNA</h1>
    
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
        <a href="{{ route('forms.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Kembali
        </a>
        <a href="{{ route('forms.form1.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
            <i class="fa fa-plus mr-2"></i> Buat Surat Baru
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        @if( $form->count() > 0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Perihal</th>
                    <th>Kepada</th>
                    <th>Tanggal Input</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $form as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->nomor_surat }}</td>
                    <td>{{ $data->perihal }}</td>
                    <td>{{ $data->kepada }}</td>
                    <td>{{ $data->created_at->format('d-m-Y H:i') }}</td>                    <td>
                        <div class="btn-group" style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 4px;">
                            <a href="{{ route('forms.form1.show', $data->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-eye"></i> Detail
                            </a>
                            <a href="{{ route('forms.form1.edit', $data->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('forms.form1.preview-pdf', $data->id) }}" class="btn btn-sm btn-secondary" target="_blank">
                                <i class="fa fa-search"></i> Lihat PDF
                            </a>
                            <a href="{{ route('forms.form1.pdf', $data->id) }}" class="btn btn-sm btn-primary" target="_blank">
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
            <p>Belum ada surat permohonan yang dibuat untuk bencana ini.</p>
            <a href="{{ route('forms.form1.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary mt-4">
                <i class="fa fa-plus mr-2"></i> Buat Surat Sekarang
            </a>
        </div>
        @endif
    </div>
</div>
@endsection