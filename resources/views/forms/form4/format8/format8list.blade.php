@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Laporan Infrastruktur (Format 8)</h1>
    
    @if($bencana)
        <div class="alert alert-light-primary color-primary mb-4">
            <p><strong>Bencana:</strong> {{ $bencana->kategori_bencana->nama }}</p>
            <p><strong>Tanggal:</strong> {{ $bencana->tanggal }}</p>
            <p><strong>Lokasi:</strong> 
                @foreach($bencana->desa as $desa)
                    {{ $desa->nama }}@if(!$loop->last), @endif
                @endforeach
            </p>
        </div>
    @endif
    
    <div class="mb-4 flex justify-between">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left mr-2"></i> Kembali ke Form 4
        </a>
        <a href="{{ route('forms.form4.format8form4', ['bencana_id' => $bencana->id]) }}" class="btn btn-primary">
            <i class="fa fa-plus mr-2"></i> Tambah Data Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kampung</th>
                            <th>Distrik</th>
                            <th>Gardu Listrik Rusak Total</th>
                            <th>Gardu Listrik Rusak Sebagian</th>
                            <th>Harga Satuan Gardu</th>
                            <th>Jaringan Primer Rusak</th>
                            <th>Harga Satuan Jaringan Primer</th>
                            <th>Jaringan Sekunder Rusak</th>
                            <th>Harga Satuan Jaringan Sekunder</th>
                            <th>Tiang Listrik Rusak</th>
                            <th>Harga Satuan Tiang Listrik</th>
                            <th>Transformer Rusak</th>
                            <th>Harga Satuan Transformer</th>
                            <th>Panel Listrik Rusak</th>
                            <th>Harga Satuan Panel Listrik</th>
                            <th>Genset Rusak</th>
                            <th>Harga Satuan Genset</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($formData as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report->nama_kampung }}</td>
                            <td>{{ $report->nama_distrik }}</td>
                            <td>{{ $report->gardu_listrik_rusak_total }}</td>
                            <td>{{ $report->gardu_listrik_rusak_sebagian }}</td>
                            <td>{{ $report->harga_satuan_gardu }}</td>
                            <td>{{ $report->jaringan_primer_rusak }}</td>
                            <td>{{ $report->harga_satuan_jaringan_primer }}</td>
                            <td>{{ $report->jaringan_sekunder_rusak }}</td>
                            <td>{{ $report->harga_satuan_jaringan_sekunder }}</td>
                            <td>{{ $report->tiang_listrik_rusak }}</td>
                            <td>{{ $report->harga_satuan_tiang_listrik }}</td>
                            <td>{{ $report->transformer_rusak }}</td>
                            <td>{{ $report->harga_satuan_transformer }}</td>
                            <td>{{ $report->panel_listrik_rusak }}</td>
                            <td>{{ $report->harga_satuan_panel_listrik }}</td>
                            <td>{{ $report->genset_rusak }}</td>
                            <td>{{ $report->harga_satuan_genset }}</td>
                            <td>
                                <a href="{{ route('forms.form4.show-format8', $report->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                <a href="{{ route('forms.form4.edit-format8', $report->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('forms.form4.destroy-format8', $report->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="19" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection
