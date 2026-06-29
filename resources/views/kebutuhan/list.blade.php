@extends('layouts.main')

@section('styles')
<style>
    :root {
        --orange-primary: #F28705;
        --orange-gradient: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
    }

    .page-container {
        padding: 2rem;
    }

    .page-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .page-header h2 {
        color: var(--orange-primary);
        font-weight: 600;
        margin: 0 0 0.5rem 0;
        font-size: 1.75rem;
    }

    .page-header p {
        color: #6c757d;
        margin: 0;
        font-size: 0.95rem;
    }

    .main-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .card-header-gradient {
        background: var(--orange-gradient);
        padding: 1.5rem;
    }

    .card-header-gradient h4 {
        color: white;
        margin: 0;
        font-weight: 600;
        font-size: 1.25rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .summary-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        padding: 1.5rem;
        text-align: center;
        height: 100%;
    }

    .summary-card h5 {
        color: #495057;
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 1rem;
    }

    .summary-card .total {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--orange-primary);
    }

    .table-container {
        overflow-x: auto;
        border-radius: 8px;
        border: 1px solid #dee2e6;
    }

    .table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: collapse;
    }

    .table thead th {
        background: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
        color: #495057;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.02);
    }

    .text-end {
        text-align: right;
    }

    .fw-bold {
        font-weight: 600;
    }

    .accordion-item {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-bottom: 1rem;
        overflow: hidden;
    }

    .accordion-button {
        background: var(--orange-gradient);
        color: white;
        border: none;
        font-weight: 600;
        padding: 1rem 1.5rem;
    }

    .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, #d97604 0%, #e68900 100%);
        color: white;
    }

    .accordion-button:focus {
        box-shadow: 0 0 0 0.2rem rgba(242, 135, 5, 0.25);
        border: none;
    }

    .accordion-button::after {
        filter: brightness(0) invert(1);
    }

    .accordion-body {
        padding: 1.5rem;
    }

    .accordion-body h5 {
        color: #495057;
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 1rem;
    }

    .list-group-item {
        border: 1px solid #dee2e6;
        padding: 0.75rem 1rem;
        transition: all 0.2s ease;
    }

    .list-group-item:hover {
        background: rgba(242, 135, 5, 0.08);
    }

    .badge {
        background: #17a2b8;
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .alert-info {
        background: linear-gradient(135deg, #e3f2fd 0%, #f0f8ff 100%);
        border: none;
        border-left: 4px solid #2196F3;
        color: #004085;
        border-radius: 8px;
        padding: 1rem 1.25rem;
    }

    .inner-card {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-bottom: 1rem;
        overflow: hidden;
    }

    .inner-card-header {
        background: #f8f9fa;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #dee2e6;
    }

    .inner-card-header h5,
    .inner-card-header h6 {
        margin: 0;
        color: #495057;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .inner-card-body {
        padding: 1rem;
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 1rem;
        }

        .page-header h2 {
            font-size: 1.5rem;
        }

        .card-header-gradient h4 {
            font-size: 1.1rem;
        }

        .summary-card .total {
            font-size: 1.5rem;
        }

        .table thead th,
        .table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.85rem;
        }

        .accordion-button {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
        }
    }
</style>
@endsection

@section('content')
<div class="page-container">

    <div class="page-header">
        <h2>
            <i data-feather="clipboard" class="me-2"></i>
            Ringkasan Formulir Pendataan
        </h2>
        <p>
            Daftar formulir pendataan yang telah diisi beserta total nilai
            kerusakan dan kerugian.
        </p>
    </div>

    <div class="main-card">

        <div class="card-header-gradient">
            <h4>
                <i data-feather="list"></i>
                Daftar Formulir
            </h4>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th width="10%">Nama Kampung</th>
                            <th width="10%">Nama Distrik</th>
                            <th>Nama Formulir</th>
                            <th width="18%">Kerusakan (Rp)</th>
                            <th width="18%">Kerugian (Rp)</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($summaries as $index => $summary)

                            <tr>

                                <td class="text-center">
                                    {{ $index + 1 }}
                                </td>

                                <td class="text-center fw-bold">
                                    {{ $summary['nama_kampung'] }}
                                </td>

                                <td class="text-center fw-bold">
                                    {{ $summary['nama_distrik'] }}
                                </td>

                                <td>
                                    {{ $summary['format'] }}
                                </td>

                                <td class="text-end">
                                    {{ number_format($summary['total_kerusakan'],0,',','.') }}
                                </td>

                                <td class="text-end">
                                    {{ number_format($summary['total_kerugian'],0,',','.') }}
                                </td>

                                <td class="text-center">

                                    <a
                                        href="{{ route('kebutuhan.show',$summary['id']) }}"
                                        class="btn btn-primary btn-sm">

                                        Detail

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center">

                                    Belum ada formulir yang telah diisi.

                                </td>

                            </tr>

                        @endforelse

                        <div class="card shadow mb-4">

                            <div class="card-header">
                                <h5 class="mb-0">
                                    Grafik Kerusakan & Kerugian
                                </h5>
                            </div>

                            <div class="card-body">

                                <canvas id="summaryChart"
                                        height="120">
                                </canvas>
                            </div>

                        </div>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script>
    // Initialize Feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }

</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const labels = @json(
    collect($summaries)
        ->pluck('nama_kampung')
);

const kerusakan = @json(
    collect($summaries)
        ->pluck('total_kerusakan')
);

const kerugian = @json(
    collect($summaries)
        ->pluck('total_kerugian')
);

</script>

<script>
const ctx = document
    .getElementById('summaryChart');

new Chart(ctx, {

    type: 'bar',

    data: {
        labels: labels,
        datasets: [
            {
                label: 'Kerusakan',
                data: kerusakan
            },
            {
                label: 'Kerugian',
                data: kerugian
            }
        ]
    },

    options: {

        responsive: true,

        scales: {

            y: {

                ticks: {

                    callback: function(value){
                        return (value/1000000) + ' Jt';
                    }

                }

            }

        }

    }

});

console.log(labels);
console.log(kerusakan);
console.log(kerugian);
</script>
@endsection
