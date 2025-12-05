@extends('layouts.main')

@section('content')
<style>
    .page-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .page-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .page-header h2 {
        color: #F28705;
        font-weight: 600;
        margin: 0;
    }

    .main-card {
        background: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-header {
        background: #f9f9f9;
        padding: 15px 20px;
        border-bottom: 1px solid #ddd;
    }

    .card-header h4 {
        margin: 0;
        color: #333;
        font-weight: 600;
    }

    .table-responsive {
        padding: 20px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }

    .table th,
    .table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .table th {
        background: #f9f9f9;
        font-weight: 600;
        color: #333;
        text-align: center;
    }

    .table tbody tr:nth-child(even) {
        background: #f9f9f9;
    }

    .table tbody tr:hover {
        background: rgba(242, 135, 5, 0.08);
    }

    .btn {
        display: inline-block;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-primary {
        background: #F28705;
        color: white;
    }

    .btn-primary:hover {
        background: #d97604;
        color: white;
    }

    .dropdown-menu {
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item {
        padding: 10px 15px;
        color: #333;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background: rgba(242, 135, 5, 0.08);
        color: #F28705;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-top: 20px;
    }

    .pagination .page-link {
        color: #F28705;
        border: 1px solid #ddd;
        padding: 8px 12px;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background: #F28705;
        color: white;
        border-color: #F28705;
    }

    .pagination .page-item.active .page-link {
        background: #F28705;
        border-color: #F28705;
        color: white;
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 10px;
        }

        .table th,
        .table td {
            padding: 8px 10px;
            font-size: 13px;
        }
    }
</style>

<div class="page-container">
    <div class="page-header">
        <h2>Data Kerugian Akibat Bencana</h2>
    </div>

    <div class="main-card">
        <div class="card-header">
            <h4>Daftar Kerugian</h4>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 12%;">Bencana Ref</th>
                        <th style="width: 10%;">Ref</th>
                        <th style="width: 18%;">Sektor Terdampak</th>
                        <th style="width: 18%;">Jumlah Terdampak</th>
                        <th style="width: 22%;">Estimasi Nilai Ekonomi</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kerugian as $item)
                        <tr>
                            <td style="text-align: center; font-weight: 600;">{{ $item->bencana->Ref }}</td>
                            <td style="text-align: center; font-weight: 600;">{{ $item->Ref }}</td>
                            <td>
                                @if ($item->tipe == 1)
                                    Pariwisata
                                @elseif ($item->tipe == 2)
                                    Pertanian
                                @elseif ($item->tipe == 3)
                                    Transportasi
                                @endif
                            </td>
                            <td style="text-align: center; font-weight: 600;">{{ $item->kuantitas }} {{ $item->satuan }}</td>
                            <td style="text-align: right;">{{ 'Rp ' . number_format($item->BiayaKeseluruhan, 2, ',', '.') }}</td>
                            <td style="text-align: center;">
                                <div class="btn-group">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenu{{ $item->id }}" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu{{ $item->id }}">
                                            <a href="{{ route('kerugian.edit', $item->id) }}" class="dropdown-item">
                                                Edit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="bd-example">
                {{ $kerugian->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
