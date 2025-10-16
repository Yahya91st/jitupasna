@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Daftar Analisa Data Akibat</h1>

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

        <div class="mb-4 flex justify-between">
            <a href="{{ route('forms.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left mr-2"></i> Kembali
            </a>
            <a href="{{ route('forms.form10.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary">
                <i class="fa fa-plus mr-2"></i> Tambah Data Baru
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-x-auto">
            @if (isset($analisaList) && $analisaList->count() > 0)
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sektor</th>
                            <th>Sub Sektor</th>
                            <th>Lokasi</th>
                            <th>Jumlah Kebutuhan</th>
                            <th>Tanggal Input</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($analisaList as $index => $analisa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $analisa->sektor }}</td>
                                <td>{{ $analisa->sub_sektor }}</td>
                                <td>{{ $analisa->lokasi }}</td>
                                <td>Rp {{ number_format($analisa->jumlah_kebutuhan, 0, ',', '.') }}</td>
                                <td>{{ $analisa->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 4px;">
                                        <a href="{{ route('forms.form10.show', $analisa->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                            <i class="fa fa-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('forms.form10.edit', $analisa->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('forms.form10.preview-pdf', $analisa->id) }}" class="btn btn-sm btn-secondary" title="Preview PDF" target="_blank">
                                            <i class="fa fa-search"></i> Lihat PDF
                                        </a>
                                        <a href="{{ route('forms.form10.pdf', $analisa->id) }}" class="btn btn-sm btn-primary" title="Download PDF" target="_blank">
                                            <i class="fa fa-download"></i> Unduh PDF
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($bencana == null && method_exists($analisaList, 'links'))
                    <div class="p-3">
                        {{ $analisaList->links() }}
                    </div>
                @endif
            @else
                <div class="p-6 text-center">
                    <p>Belum ada data analisa yang disimpan untuk bencana ini.</p>
                    <a href="{{ route('forms.form10.index', ['bencana_id' => request()->get('bencana_id')]) }}" class="btn btn-primary mt-4">
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
            $('.table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                }
            });
        });
    </script>
@endpush
