@extends('layouts.main')

@section('content')
    <!-- Rekap Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie me-2"></i>
                        Rekap Data Bencana
                    </h5>
                    <div>
                        <a href="{{ route('rekap.index') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye me-1"></i>Lihat Semua Rekap
                        </a>
                        <a href="{{ route('rekap.dashboard') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </div>
                </div>
                <div class="card-content">
                    <!-- Summary Cards -->
                    <div class="row mb-3" style="margin: 15px;">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white mb-0">
                                <div class="card-body text-center py-3">
                                    <h4 class="mb-1">{{ $rekapSummary['total_rekaps'] }}</h4>
                                    <small>Total Rekap</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-danger text-white mb-0">
                                <div class="card-body text-center py-3">
                                    <h4 class="mb-1">Rp {{ number_format($rekapSummary['total_kerusakan'], 0, ',', '.') }}</h4>
                                    <small>Total Kerusakan</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white mb-0">
                                <div class="card-body text-center py-3">
                                    <h4 class="mb-1">Rp {{ number_format($rekapSummary['total_kerugian'], 0, ',', '.') }}</h4>
                                    <small>Total Kerugian</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white mb-0">
                                <div class="card-body text-center py-3">
                                    <h4 class="mb-1">{{ $rekapSummary['verified_rekaps'] }}</h4>
                                    <small>Verified</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Rekap Table -->
                    <div class="table-responsive" style="margin: 15px;">
                        <h6 class="mb-3">10 Rekap Terbaru:</h6>
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Bencana</th>
                                    <th>Lokasi</th>
                                    <th>Format Terisi</th>
                                    <th>Total Kerusakan</th>
                                    <th>Total Kerugian</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rekaps as $rekap)
                                    <tr>
                                        <td>
                                            <strong>{{ $rekap->bencana->nama_kejadian ?? '-' }}</strong><br>
                                            <small class="text-muted">{{ $rekap->bencana->tanggal_kejadian ?? '-' }}</small>
                                        </td>
                                        <td>
                                            <strong>{{ $rekap->nama_kampung ?? '-' }}</strong><br>
                                            <small class="text-muted">{{ $rekap->nama_distrik ?? '-' }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                {{ $rekap->getFilledFormatsCount() }}/17
                                            </span>
                                        </td>
                                        <td>
                                            <strong>Rp {{ number_format($rekap->total_kerusakan, 0, ',', '.') }}</strong>
                                        </td>
                                        <td>
                                            <strong>Rp {{ number_format($rekap->total_kerugian, 0, ',', '.') }}</strong>
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = match($rekap->status) {
                                                    'completed' => 'bg-success',
                                                    'verified' => 'bg-info',
                                                    default => 'bg-warning'
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}">
                                                {{ ucfirst($rekap->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('rekap.show', $rekap->id) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('rekap.pdf', $rekap->id) }}" class="btn btn-sm btn-outline-danger" title="PDF" target="_blank">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                            <p class="text-muted mb-0">Belum ada data rekap</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Original Kerusakan Section -->
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Data Kerusakan Dampak Bencana</h4>
                    {{-- <a href="{{ route('bencana.create') }}" class="btn btn-primary">Tambah Data Bencana</a> --}}
                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#inlineForm">Filter</button>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Bencana Ref</th>
                                    <th>Ref</th>
                                    <th>Kategori Bagunan</th>
                                    <th>Estimasi Biaya Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kerusakan as $item)
                                    <tr>
                                        <td class="text-bold-500">{{ $item->bencana->Ref }}</td>
                                        <td>{{ $item->Ref }}</td>
                                        <td>{{ $item->kategori_bangunan->nama }}</td>
                                        <td>{{ 'Rp ' . number_format($item->BiayaKeseluruhan, 2, ',', '.') }}</td>
                                        <td>
                                            <div class="btn-group mb-1">
                                                <div class="dropdown dropdown-color-icon">
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButtonEmoji" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonEmoji">
                                                        <a href="{{ route('kerusakan.edit', $item->id) }}"
                                                            class="dropdown-item">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem"
                                                                height="1.5rem" viewBox="0 0 24 24">
                                                                <g fill="none" stroke="#5A8DEE" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2">
                                                                    <path
                                                                        d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                                                    <path
                                                                        d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                                                </g>
                                                            </svg>
                                                            Update Data
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bd-example" style="margin-left: 10px; margin-top:10px; margin-right:10px">
                            {{ $kerusakan->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Form Kategori Bencana</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('kerusakan.index') }}" method="GET" id="filterForm">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="first-name-column">Kategori Bangunan</label>
                                    <div class="form-group">
                                        <select class="form-select" name="kategori_bangunan_id" id="kategori_bangunan_id">
                                            <option selected disabled value="">{{ __('Pilih...') }}</option>
                                            @foreach ($kategoribangunan as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ request()->input('kategori_bangunan_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" onclick="resetFilters()"
                                    data-dismiss="modal">{{ __('Reset') }}</button>
                                <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function resetFilters() {
        document.getElementById('kategori_bangunan_id').value = '';
        // Submit formulir secara otomatis untuk menghapus filter
        document.getElementById('filterForm').submit();
    }
</script>
