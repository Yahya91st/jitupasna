@extends('layouts.main')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie me-2"></i>
                        Data Rekap Bencana
                    </h5>
                    <div>
                        <a href="{{ route('rekap.dashboard') }}" class="btn btn-info btn-sm">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                        <a href="{{ route('rekap.statistics') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-chart-bar me-1"></i>Statistik
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <select class="form-select form-select-sm" id="filterBencana">
                                <option value="">Semua Bencana</option>
                                @foreach($bencanas as $bencana)
                                    <option value="{{ $bencana->id }}">{{ $bencana->nama_kejadian }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select form-select-sm" id="filterStatus">
                                <option value="">Semua Status</option>
                                <option value="draft">Draft</option>
                                <option value="completed">Completed</option>
                                <option value="verified">Verified</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control form-control-sm" id="filterKampung" placeholder="Cari Kampung...">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary btn-sm" id="btnFilter">
                                <i class="fas fa-search me-1"></i>Filter
                            </button>
                            <button class="btn btn-secondary btn-sm" id="btnReset">
                                <i class="fas fa-times me-1"></i>Reset
                            </button>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $summary['total_rekap'] }}</h3>
                                    <p class="mb-0">Total Rekap</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $summary['completed'] }}</h3>
                                    <p class="mb-0">Completed</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $summary['draft'] }}</h3>
                                    <p class="mb-0">Draft</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $summary['verified'] }}</h3>
                                    <p class="mb-0">Verified</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">
                                        <input type="checkbox" id="selectAll" class="form-check-input">
                                    </th>
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
                                            <input type="checkbox" class="form-check-input rekap-checkbox" value="{{ $rekap->id }}">
                                        </td>
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
                                                {{ $rekap->getFilledFormatsCount() }}/17 Format
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
                                                <a href="{{ route('rekap.edit', $rekap->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('rekap.pdf', $rekap->id) }}" class="btn btn-sm btn-outline-danger" title="PDF" target="_blank">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                <button class="btn btn-sm btn-outline-danger" onclick="deleteRekap({{ $rekap->id }})" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada data rekap</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            Menampilkan {{ $rekaps->firstItem() ?? 0 }} - {{ $rekaps->lastItem() ?? 0 }} 
                            dari {{ $rekaps->total() }} data
                        </div>
                        <div>
                            {{ $rekaps->links() }}
                        </div>
                    </div>

                    <!-- Bulk Actions -->
                    <div class="mt-3" id="bulkActions" style="display: none;">
                        <div class="btn-group" role="group">
                            <button class="btn btn-warning btn-sm" onclick="bulkUpdateStatus('completed')">
                                <i class="fas fa-check me-1"></i>Mark as Completed
                            </button>
                            <button class="btn btn-info btn-sm" onclick="bulkUpdateStatus('verified')">
                                <i class="fas fa-check-circle me-1"></i>Mark as Verified
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="bulkDelete()">
                                <i class="fas fa-trash me-1"></i>Delete Selected
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data rekap ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let deleteId = null;

// Handle select all checkbox
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.rekap-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    toggleBulkActions();
});

// Handle individual checkboxes
document.querySelectorAll('.rekap-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', toggleBulkActions);
});

function toggleBulkActions() {
    const checkedBoxes = document.querySelectorAll('.rekap-checkbox:checked');
    const bulkActions = document.getElementById('bulkActions');
    
    if (checkedBoxes.length > 0) {
        bulkActions.style.display = 'block';
    } else {
        bulkActions.style.display = 'none';
    }
}

function deleteRekap(id) {
    deleteId = id;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

document.getElementById('confirmDelete').addEventListener('click', function() {
    if (deleteId) {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/rekap/delete/${deleteId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
});

function bulkUpdateStatus(status) {
    const checkedBoxes = document.querySelectorAll('.rekap-checkbox:checked');
    const ids = Array.from(checkedBoxes).map(cb => cb.value);
    
    if (ids.length === 0) {
        alert('Pilih data yang akan diupdate');
        return;
    }
    
    // Create form and submit
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("rekap.bulk-update-status") }}';
    
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    
    const idsInput = document.createElement('input');
    idsInput.type = 'hidden';
    idsInput.name = 'ids';
    idsInput.value = JSON.stringify(ids);
    
    const statusInput = document.createElement('input');
    statusInput.type = 'hidden';
    statusInput.name = 'status';
    statusInput.value = status;
    
    form.appendChild(csrfToken);
    form.appendChild(idsInput);
    form.appendChild(statusInput);
    document.body.appendChild(form);
    form.submit();
}

function bulkDelete() {
    const checkedBoxes = document.querySelectorAll('.rekap-checkbox:checked');
    const ids = Array.from(checkedBoxes).map(cb => cb.value);
    
    if (ids.length === 0) {
        alert('Pilih data yang akan dihapus');
        return;
    }
    
    if (confirm(`Apakah Anda yakin ingin menghapus ${ids.length} data?`)) {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("rekap.bulk-delete") }}';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const idsInput = document.createElement('input');
        idsInput.type = 'hidden';
        idsInput.name = 'ids';
        idsInput.value = JSON.stringify(ids);
        
        form.appendChild(csrfToken);
        form.appendChild(idsInput);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush
