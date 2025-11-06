@extends('layouts.main')

@section('content')

    @if ($bencana)
        <div class="alert alert-light-primary color-primary mb-4">
            <p>Bencana: {{ $bencana->kategori_bencana->nama }}</p>
            <p>Tanggal: {{ $bencana->tanggal }}</p>
            <p>Lokasi:
                @foreach ($bencana->desa as $desa)
                    {{ $desa->nama }}@if (!$loop->last)
                        ,
                    @endif
                @endforeach
            </p>
        </div>
    @endif
    <div class="page-heading">
        <div class="page-title mb-4">
            <h3>Daftar Data Pendataan Tingkat Rumahtangga (Form 6)</h3>
            <p class="text-subtitle text-muted">Daftar seluruh data rumahtangga yang telah diinput</p>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="mb-3 d-flex justify-content-between">
                            <a href="{{ route('forms.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left mr-2"></i> Kembali
                            </a>
                            <a href="{{ route('forms.form6.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Tambah Data Baru
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Input</th>
                                        <th>Bencana</th>
                                        <th>Nama KK</th>
                                        <th>NIK</th>
                                        <th>Alamat</th>
                                        <th>Kategori Kerusakan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($form as $index => $data)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $data->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $data->bencana->nama_bencana }}</td>
                                            <td>{{ $data->nama_kk }}</td>
                                            <td>{{ $data->nik_kk }}</td>
                                            <td>
                                                {{ $data->dusun }}, RT {{ $data->rt }}/RW {{ $data->rw }},
                                                {{ $data->desa }}, {{ $data->kecamatan }}, {{ $data->kabupaten }}
                                            </td>
                                            <td>
                                                @if ($data->kategori_kerusakan == 'Rusak Berat')
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
                                                @if ($data->status_bantuan == 'Ya')
                                                    <span class="badge badge-success">Sudah Menerima Bantuan</span>
                                                @else
                                                    <span class="badge badge-dark">Belum Menerima Bantuan</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" style="display: flex; gap: 2px;">
                                                    <form action="{{ route('forms.form6.show', $data->id) }}" method="GET" style="display: inline;">
                                                        <button type="submit" class="btn btn-sm btn-info" title="Lihat Detail" style="padding: 4px; min-width: 28px;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 14px; height: 14px;">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('forms.form6.edit', $data->id) }}" method="GET" style="display: inline;">
                                                        <button type="submit" class="btn btn-sm btn-warning" title="Edit" style="padding: 4px; min-width: 28px;">
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
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
