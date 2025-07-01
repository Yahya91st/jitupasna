@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Form Sektor Perumahan</h1>
    
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
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Kembali
        </a>
        <a href="{{ route('forms.form4.format1form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
            <i class="fa fa-plus mr-2"></i> Tambah Data Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        @if($reports->count() > 0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kampung</th>
                    <th>Distrik</th>
                    <th>Total Kerusakan</th>
                    <th>Total Kerugian</th>
                    <th>Tanggal Input</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->nama_kampung }}</td>
                    <td>{{ $data->nama_distrik }}</td>
                    <td>{{ number_format($data->total_kerusakan ?? 0, 0, ',', '.') }}</td>
                    <td>{{ number_format($data->total_kerugian ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $data->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('forms.form4.show-format1', $data->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-eye"></i> Detail
                            </a>
                            <a href="{{ route('forms.form4.edit-format1', $data->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('forms.form4.preview-pdf', $data->id) }}" class="btn btn-sm btn-secondary" target="_blank">
                                <i class="fa fa-search"></i> Lihat PDF
                            </a>
                            <a href="{{ route('forms.form4.pdf', $data->id) }}" class="btn btn-sm btn-primary" target="_blank">
                                <i class="fa fa-download"></i> Unduh PDF
                            </a>
                            <form action="{{ route('forms.form4.destroy-format1', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-6 text-center">
            <p>Belum ada data form yang disimpan untuk bencana ini.</p>
            <a href="{{ route('forms.form4.format1form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary mt-4">
                <i class="fa fa-plus mr-2"></i> Tambah Data Sekarang
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
