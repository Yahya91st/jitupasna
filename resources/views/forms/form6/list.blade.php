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
                            <a href="{{ route('forms.form6.index') }}" class="btn btn-primary">
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
                                                    <span class="badge badge-secondary">Belum Menerima Bantuan</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 4px;">
                                                    <a href="{{ route('forms.form6.show', $data->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                                        <i class="fa fa-eye"></i> Detail
                                                    </a>
                                                    <a href="{{ route('forms.form6.edit', $data->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    <a href="{{ route('forms.form6.preview-pdf', $data->id) }}" class="btn btn-sm btn-secondary" title="Preview PDF" target="_blank">
                                                        <i class="fa fa-search"></i> Lihat PDF
                                                    </a>
                                                    <a href="{{ route('forms.form6.pdf', $data->id) }}" class="btn btn-sm btn-primary" title="Download PDF" target="_blank">
                                                        <i class="fa fa-download"></i> Unduh PDF
                                                    </a>
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
