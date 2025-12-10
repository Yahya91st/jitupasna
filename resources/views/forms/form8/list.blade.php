@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 style="color: #F28705; margin-bottom: 1.5rem;">Daftar Penilaian Kerusakan dan Kerugian (Form 8)</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="alert" style="background-color: rgba(108, 117, 125, 0.1); border-left: 4px solid #6c757d; padding: 1rem; margin-bottom: 1.5rem;">
        <p class="mb-1"><strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama }}</p>
        <p class="mb-1"><strong>Tanggal:</strong> {{ $bencana->tanggal }}</p>
        <p class="mb-0"><strong>Lokasi:</strong> 
            @foreach($bencana->desa as $desa)
                {{ $desa->nama }}@if(!$loop->last), @endif
            @endforeach
        </p>
    </div>
    
    <div class="mb-4">
        <a href="{{ route('forms.index', ['bencana_id' => $bencana->id]) }}" class="btn" style="background-color: #6c757d; color: white;">
            <i class="fa fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>
    
    <!-- Format Baru Form8 -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">📊 Format Analisis</h5>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card border-primary">
                        <div class="card-body text-center">
                            <i class="bi bi-table" style="font-size: 2rem; color: #007bff;"></i>
                            <h6 class="mt-2">Tabel Ringkas</h6>
                            <p class="text-muted small">Format tabel kompak untuk analisis cepat</p>
                            <a href="{{ route('forms.form8.table-ringkas') }}" class="btn btn-outline-primary btn-sm" target="_blank">
                                <i class="bi bi-file-pdf"></i> Lihat PDF
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="card border-success">
                        <div class="card-body text-center">
                            <i class="bi bi-list-ul" style="font-size: 2rem; color: #28a745;"></i>
                            <h6 class="mt-2">Format Per Baris</h6>
                            <p class="text-muted small">Detail setiap item dengan breakdown lengkap</p>
                            <a href="{{ route('forms.form8.form8-per-baris', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-success btn-sm">
                                <i class="bi bi-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="card border-info">
                        <div class="card-body text-center">
                            <i class="bi bi-plus-circle" style="font-size: 2rem; color: #17a2b8;"></i>
                            <h6 class="mt-2">Tambah Data Baru</h6>
                            <p class="text-muted small">Input data kerusakan dan kerugian</p>
                            <a href="{{ route('forms.form8.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-outline-info btn-sm">
                                <i class="bi bi-plus"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Jumlah Item</th>
                            <th>Total Kerusakan & Kerugian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($form) > 0)
                            @foreach($form as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') : '-' }}</td>
                                <td>
                                    @if($item->rows && $item->rows->count() > 0)
                                        {{ $item->rows->pluck('lokasi')->filter()->unique()->implode(', ') ?: '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->rows ? $item->rows->count() : 0 }} item</td>
                                <td class="text-end">Rp {{ number_format($item->rows ? $item->rows->sum('jumlah_kerusakan_kerugian') : 0, 0, ',', '.') }}</td>
                                <td>
                                    <div class="btn-group" style="display: flex; gap: 2px;">
                                        <form action="{{ route('forms.form8.show', $item->id) }}" method="GET" style="display: inline;">
                                            <button type="submit" class="btn btn-sm" title="Lihat Detail" style="background-color: #6c757d; color: white; padding: 4px; min-width: 28px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 14px; height: 14px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('forms.form8.edit', $item->id) }}" method="GET" style="display: inline;">
                                            <button type="submit" class="btn btn-sm" title="Edit" style="background-color: #F28705; color: white; padding: 4px; min-width: 28px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 14px; height: 14px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('forms.form8.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                        @else
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <p class="text-muted mb-3">Belum ada data penilaian</p>
                                    <a href="{{ route('forms.form8.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-sm" style="background-color: #F28705; color: white;">
                                        <i class="fa fa-plus mr-1"></i> Tambah Data Sekarang
                                    </a>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
</div>
@endsection
