@extends('layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title mb-4">
            <h3>Daftar Data Focus Group Discussion (Form 7)</h3>
            <p class="text-subtitle text-muted">Daftar seluruh data FGD yang telah dilaksanakan</p>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="mb-3 d-flex justify-content-between">
                        <a href="{{ route('forms.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('forms.form7.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Tambah Data FGD Baru
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Tanggal FGD</th>
                                    <th>Desa/Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th>Tempat Sesi</th>
                                    <th>Jumlah Peserta</th>
                                    <th>Fasilitator</th>
                                    <th style="width: 20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($form as $index => $form)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $form->tanggal ? \Carbon\Carbon::parse($form->tanggal)->format('d-m-Y') : '-' }}</td>
                                        <td>{{ $form->desa_kelurahan ?? '-' }}</td>
                                        <td>{{ $form->kecamatan ?? '-' }}</td>
                                        <td>{{ $form->tempat_sesi ?? '-' }}</td>
                                        <td>
                                            {{ $form->jumlah_peserta ?? 0 }} orang
                                            <br>
                                            <small class="text-muted">
                                                (P: {{ $form->jumlah_perempuan ?? 0 }}, L: {{ $form->jumlah_laki_laki ?? 0 }})
                                            </small>
                                        </td>
                                        <td>{{ $form->fasilitator ?? '-' }}</td>
                                        <td>
                                            <div class="btn-group" style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 4px;">
                                                <a href="{{ route('forms.form7.show', $form->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                                    <i class="bi bi-eye"></i> Detail
                                                </a>
                                                <a href="{{ route('forms.form7.edit', $form->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <a href="{{ route('forms.form7.preview-pdf', $form->id) }}" class="btn btn-sm btn-secondary" title="Preview PDF" target="_blank">
                                                    <i class="bi bi-search"></i> Lihat PDF
                                                </a>
                                                <a href="{{ route('forms.form7.pdf', $form->id) }}" class="btn btn-sm btn-primary" title="Download PDF" target="_blank">
                                                    <i class="bi bi-download"></i> Unduh PDF
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data FGD</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if (method_exists($form, 'links'))
                        <div class="mt-4">
                            {{ $form->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
