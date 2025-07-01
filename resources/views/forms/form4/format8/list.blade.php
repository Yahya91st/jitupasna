@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <h4 class="mb-3">Format 8. Daftar Data Sektor Listrik</h4>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana_id]) }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Format
            </a>            <a href="{{ route('forms.form4.format8form4', ['bencana_id' => $bencana_id]) }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Data Baru
            </a>
        </div>
        <div class="col-md-6">
            <form action="{{ route('forms.form4.list-format8') }}" method="GET" class="d-flex">
                <select name="bencana_id" class="form-select me-2" onchange="this.form.submit()">
                    <option value="">Pilih Bencana</option>
                    @foreach(\App\Models\Bencana::orderBy('tanggal', 'desc')->get() as $bencana)
                        <option value="{{ $bencana->id }}" {{ $bencana_id == $bencana->id ? 'selected' : '' }}>
                            {{ $bencana->nama_bencana }} ({{ \Carbon\Carbon::parse($bencana->tanggal)->format('d-m-Y') }})
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-outline-primary">Filter</button>
            </form>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>No.</th>
                            <th>Kampung</th>
                            <th>Distrik</th>
                            <th>Total Kerusakan</th>
                            <th>Total Kerugian</th>
                            <th>Tanggal Input</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($forms as $index => $form)
                            <tr>
                                <td>{{ $forms->firstItem() + $index }}</td>
                                <td>{{ $form->nama_kampung }}</td>
                                <td>{{ $form->nama_distrik }}</td>
                                <td>Rp {{ number_format($form->getTotalDamage(), 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($form->getTotalLoss(), 0, ',', '.') }}</td>
                                <td>{{ $form->created_at->format('d-m-Y H:i') }}</td>                                <td>
                                    <a href="{{ route('forms.form4.show-format8', $form->id) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('forms.form4.pdf-format8', $form->id) }}" target="_blank" class="btn btn-sm btn-danger">
                                        <i class="bi bi-file-pdf"></i> PDF
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-3">Belum ada data untuk sektor listrik</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{ $forms->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
