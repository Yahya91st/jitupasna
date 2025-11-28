@extends('layouts.main')

@section('content')
<style>
    * {
        font-family: 'Times New Roman', Times, serif;
    }
    
    .main-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        border: none;
        overflow: hidden;
    }
    
    .orange-header {
        background: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
        color: white;
        padding: 20px;
        margin: -1px -1px 20px -1px;
        border-radius: 15px 15px 0 0;
    }
    
    .orange-header h4 {
        margin: 0;
        font-weight: 600;
        font-size: 1.5rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .table-container {
        padding: 0 20px 20px 20px;
    }
    
    .table thead th {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
        border: none;
        padding: 15px 12px;
        font-weight: 600;
        text-align: center;
        font-size: 0.95rem;
    }
    
    .table tbody tr {
        transition: all 0.3s ease;
    }
    
    .table tbody tr:hover {
        background-color: #fff8f0;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(242, 135, 5, 0.15);
    }
    
    .table td {
        padding: 15px 12px;
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(242, 135, 5, 0.3);
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #e07600 0%, #f57c00 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(242, 135, 5, 0.4);
    }
    
    .dropdown-item {
        padding: 10px 15px;
        transition: all 0.3s ease;
    }
    
    .dropdown-item:hover {
        background-color: #fff8f0;
        color: #F28705;
    }
    
    .pagination {
        margin-top: 20px;
    }
    
    .pagination .page-link {
        color: #F28705;
        border: 1px solid #e9ecef;
        padding: 10px 15px;
        margin: 0 2px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .pagination .page-link:hover {
        background-color: #F28705;
        color: white;
        border-color: #F28705;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(242, 135, 5, 0.3);
    }
    
    .pagination .page-item.active .page-link {
        background-color: #F28705;
        border-color: #F28705;
        color: white;
        box-shadow: 0 2px 8px rgba(242, 135, 5, 0.3);
    }
    
    .text-bold-500 {
        font-weight: 600;
        color: #495057;
    }
    
    h6 {
        color: #6c757d;
        font-weight: 600;
        margin: 0;
    }
</style>

<div class="container-fluid">
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card main-card">
                <div class="orange-header">
                    <h4>Data Kerugian Akibat Bencana</h4>
                </div>
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Bencana Ref</th>
                                    <th>Ref</th>
                                    <th>Sektor Terdampak</th>
                                    <th>Jumlah Terdampak</th>
                                    <th>Estimasi Nilai Ekonomi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kerugian as $item)
                                    <tr>
                                        <td class="text-bold-500">{{ $item->bencana->Ref }}</td>
                                        <td class="text-bold-500">{{ $item->Ref }}</td>
                                        <td>
                                            @if ($item->tipe == 1)
                                                <h6>Pariwisata</h6>
                                            @elseif ($item->tipe == 2)
                                                <h6>Pertanian</h6>
                                            @elseif ($item->tipe == 3)
                                                <h6>Transportasi</h6>
                                            @endif
                                        </td>
                                        <td class="text-bold-500">{{ $item->kuantitas }} {{ $item->satuan }}</td>
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
                                                        <a href="{{ route('kerugian.edit', $item->id) }}"
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
                                                        {{-- <a href="{{ route('bencana.show', $item->id) }}"
                                                            class="dropdown-item">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem"
                                                                height="2rem" viewBox="0 0 24 24">
                                                                <path fill="#5A8DEE"
                                                                    d="M12 9a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3m0-4.5c5 0 9.27 3.11 11 7.5c-1.73 4.39-6 7.5-11 7.5S2.73 16.39 1 12c1.73-4.39 6-7.5 11-7.5M3.18 12a9.821 9.821 0 0 0 17.64 0a9.821 9.821 0 0 0-17.64 0" />
                                                            </svg>
                                                            Detail
                                                        </a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bd-example" style="margin-left: 10px; margin-top:10px; margin-right:10px">
                            {{ $kerugian->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
