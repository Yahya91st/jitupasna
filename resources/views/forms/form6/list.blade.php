@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6" style="color: #F28705;">Daftar Data Pendataan Tingkat Rumahtangga (Form 6)</h1>
    
    @if($bencana)
        <div class="alert mb-4" style="background-color: rgba(108, 117, 125, 0.1); border: 1px solid rgba(108, 117, 125, 0.2); color: #495057;">
            <p>Bencana: {{ $bencana->kategori_bencana->nama }}</p>
            <p>Tanggal: {{ $bencana->tanggal }}</p>
            <p>Lokasi: 
                @foreach($bencana->desa as $desa)
                    {{ $desa->nama }}@if(!$loop->last), @endif
                @endforeach
            </p>
        </div>
    @endif
    
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="mb-4 flex justify-between">
        <a href="{{ route('forms.index', ['bencana_id' => $bencana->id]) }}" class="btn" style="background-color: #6c757d; color: white; border: none;">
            <i class="fa fa-arrow-left mr-2"></i> Kembali
        </a>
        <a href="{{ route('forms.form6.index', ['bencana_id' => $bencana->id]) }}" class="btn" style="background-color: #F28705; color: white; border: none;">
            <i class="fa fa-plus mr-2"></i> Tambah Data Baru
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        @if($form->count() > 0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama KK</th>
                    <th>NIK</th>
                    <th>Alamat</th>
                    <th>Kategori Kerusakan</th>
                    <th>Status Bantuan</th>
                    <th>Tanggal Input</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($form as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->nama_kk }}</td>
                    <td>{{ $data->nik_kk }}</td>
                    <td>
                        {{ $data->dusun }}, RT {{ $data->rt }}/RW {{ $data->rw }},
                        {{ $data->desa }}, {{ $data->kecamatan }}
                    </td>
                    <td>
                        @if($data->kategori_kerusakan == 'Rusak Berat')
                            <span class="badge badge-danger">{{ $data->kategori_kerusakan }}</span>
                        @elseif($data->kategori_kerusakan == 'Rusak Sedang')
                            <span class="badge badge-warning">{{ $data->kategori_kerusakan }}</span>
                        @elseif($data->kategori_kerusakan == 'Rusak Ringan')
                            <span class="badge badge-info">{{ $data->kategori_kerusakan }}</span>
                        @else
                            <span class="badge badge-success">{{ $data->kategori_kerusakan }}</span>
                        @endif
                    </td>
                    <td>
                        @if($data->status_bantuan == 'Ya')
                            <span class="badge badge-success">Sudah Terima</span>
                        @else
                            <span class="badge badge-secondary">Belum Terima</span>
                        @endif
                    </td>
                    <td>{{ $data->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <div class="btn-group" style="display: flex; gap: 2px;">
                            <form action="{{ route('forms.form6.show', $data->id) }}" method="GET" style="display: inline;">
                                <button type="submit" class="btn btn-sm" style="background-color: #6c757d; color: white; border: none; padding: 4px; min-width: 28px;" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 14px; height: 14px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                    </svg>
                                </button>
                            </form>
                            <form action="{{ route('forms.form6.edit', $data->id) }}" method="GET" style="display: inline;">
                                <button type="submit" class="btn btn-sm" style="background-color: #F28705; color: white; border: none; padding: 4px; min-width: 28px;" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 14px; height: 14px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                            </form>
                            <form action="{{ route('forms.form6.destroy', $data->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data rumahtangga ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus" style="padding: 4px; min-width: 28px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 14px; height: 14px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
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
            <p>Belum ada data pendataan rumahtangga untuk bencana ini.</p>
            <a href="{{ route('forms.form6.index', ['bencana_id' => $bencana->id]) }}" class="btn mt-4" style="background-color: #F28705; color: white; border: none;">
                <i class="fa fa-plus mr-2"></i> Tambah Data Sekarang
            </a>
        </div>
        @endif
    </div>
</div>
@endsection