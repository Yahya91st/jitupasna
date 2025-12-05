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
            <i data-feather="bar-chart-2" style="width: 28px; height: 28px; margin-right: 8px;"></i>
            Ringkasan Tabel Berdasarkan Form
        </h2>
        <p>Daftar tabel kerusakan dan kerugian pada setiap form</p>
    </div>

    <!-- Summary Card -->
    <div class="main-card mb-4">
        <div class="card-header-gradient">
            <h4>
                <i data-feather="pie-chart" style="width: 20px; height: 20px; margin-right: 8px;"></i>
                Rekap Total Nilai Kerusakan & Kerugian
            </h4>
        </div>
        <div class="card-body">
            <div class="row">
                @php
                $grandTotal = 0;
                $totalByForm = [];
                
                // Calculate grand total and totals by form
                foreach ($tableTotals as $tableName => $columnTotals) {
                    foreach ($columnTotals as $column => $total) {
                        $grandTotal += $total;
                        
                        // Determine which form this table belongs to
                        $formKey = null;
                        foreach ($tables as $key => $form) {
                            foreach ($form['tables'] as $tableInfo) {
                                if ($tableInfo['name'] === $tableName) {
                                    $formKey = $key;
                                    break 2;
                                }
                            }
                        }
                        
                        if ($formKey) {
                            if (!isset($totalByForm[$formKey])) {
                                $totalByForm[$formKey] = 0;
                            }
                            $totalByForm[$formKey] += $total;
                        }
                    }
                }
                @endphp
                
                <div class="col-md-6 mb-3">
                    <div class="summary-card">
                        <h5>
                            <i data-feather="dollar-sign" style="width: 18px; height: 18px; margin-right: 6px;"></i>
                            Total Kerusakan & Kerugian
                        </h5>
                        <div class="total">Rp {{ number_format($grandTotal, 0, ',', '.') }}</div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-3">
                    <div class="summary-card">
                        <h5>
                            <i data-feather="trending-up" style="width: 18px; height: 18px; margin-right: 6px;"></i>
                            Distribusi per Form
                        </h5>
                        <div class="table-container">
                            <table class="table table-striped mb-0">
                                <tbody>
                                    @foreach($totalByForm as $formKey => $total)
                                        <tr>
                                            <td>{{ $tables[$formKey]['name'] }}</td>
                                            <td class="text-end fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Form Tables Summary -->
    <div class="main-card">
        <div class="card-header-gradient">
            <h4>
                <i data-feather="grid" style="width: 20px; height: 20px; margin-right: 8px;"></i>
                Ringkasan Tabel Berdasarkan Form
            </h4>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Form</th>
                            <th>Tabel</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tables as $formKey => $form)
                            @php
                                $isFirstRow = true;
                                $rowCount = count($form['tables']);
                                $rowCount = $rowCount > 0 ? $rowCount : 1;
                            @endphp
                            
                            @if(empty($form['tables']))
                                <tr>
                                    <td>{{ $form['name'] }}</td>
                                    <td>-</td>
                                    <td>{{ $form['description'] }}</td>
                                    <td>-</td>
                                </tr>
                            @else
                                @foreach($form['tables'] as $index => $table)
                                    <tr>
                                        @if($isFirstRow)
                                            <td rowspan="{{ $rowCount }}">{{ $form['name'] }}</td>
                                            @php $isFirstRow = false; @endphp
                                        @endif
                                        <td>{{ $table['name'] }}</td>
                                        <td>{{ $table['description'] }}</td>
                                        <td>{{ $table['count'] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Table Columns Accordion -->
    <div class="main-card mt-4">
        <div class="card-header-gradient">
            <h4>
                <i data-feather="columns" style="width: 20px; height: 20px; margin-right: 8px;"></i>
                Kolom-kolom Terkait Kerusakan dan Kerugian
            </h4>
        </div>
        <div class="card-body">
            <div class="accordion" id="tableColumnsAccordion">
                @foreach($columns as $tableName => $tableColumns)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ str_replace('_', '', $tableName) }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ str_replace('_', '', $tableName) }}" aria-expanded="false"
                                aria-controls="collapse{{ str_replace('_', '', $tableName) }}">
                                <i data-feather="database" style="width: 18px; height: 18px; margin-right: 8px;"></i>
                                Tabel: {{ $tableName }}
                            </button>
                        </h2>
                        <div id="collapse{{ str_replace('_', '', $tableName) }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ str_replace('_', '', $tableName) }}"
                            data-bs-parent="#tableColumnsAccordion">
                            <div class="accordion-body">
                                <h5>
                                    <i data-feather="list" style="width: 16px; height: 16px; margin-right: 6px;"></i>
                                    Kolom Terkait
                                </h5>
                                <ul class="list-group mb-4">
                                    @foreach($tableColumns as $column)
                                        <li class="list-group-item">
                                            {{ $column }}
                                            @if(isset($numericColumns[$tableName]) && in_array($column, $numericColumns[$tableName]))
                                                <span class="badge bg-info">Nilai Numerik</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                                
                                @if(isset($tableTotals[$tableName]) && count($tableTotals[$tableName]) > 0)
                                <div class="inner-card mb-4">
                                    <div class="inner-card-header">
                                        <h5>
                                            <i data-feather="dollar-sign" style="width: 16px; height: 16px; margin-right: 6px;"></i>
                                            Total Nilai Kerusakan/Kerugian
                                        </h5>
                                    </div>
                                    <div class="inner-card-body">
                                        <div class="table-container">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Kolom</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($tableTotals[$tableName] as $column => $total)
                                                        <tr>
                                                            <td>{{ $column }}</td>
                                                            <td class="text-end fw-bold">{{ number_format($total, 0, ',', '.') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                @if(isset($sampleData[$tableName]) && $sampleData[$tableName]->count() > 0)
                                    <h5>
                                        <i data-feather="file-text" style="width: 16px; height: 16px; margin-right: 6px;"></i>
                                        Data Sampel (5 entri teratas)
                                    </h5>
                                    <div class="table-container">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    @foreach($tableColumns as $column)
                                                        <th>{{ $column }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($sampleData[$tableName] as $item)
                                                    <tr>
                                                        @foreach($tableColumns as $column)
                                                            <td @if(isset($numericColumns[$tableName]) && in_array($column, $numericColumns[$tableName])) class="text-end fw-bold" @endif>
                                                                @if(property_exists($item, $column) || isset($item->$column))
                                                                    @if(isset($numericColumns[$tableName]) && in_array($column, $numericColumns[$tableName]) && is_numeric($item->$column))
                                                                        {{ number_format($item->$column, 0, ',', '.') }}
                                                                    @else
                                                                        {{ $item->$column }}
                                                                    @endif
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    @if(isset($relationshipData[$tableName]) && count($relationshipData[$tableName]) > 0)
                                        <h5 class="mt-4">
                                            <i data-feather="link" style="width: 16px; height: 16px; margin-right: 6px;"></i>
                                            Data Relasi
                                        </h5>
                                        <div class="accordion mt-2" id="relationAccordion{{ str_replace('_', '', $tableName) }}">
                                            @foreach($sampleData[$tableName] as $index => $item)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="relationHeading{{ str_replace('_', '', $tableName) }}{{ $index }}">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#relationCollapse{{ str_replace('_', '', $tableName) }}{{ $index }}" aria-expanded="false"
                                                            aria-controls="relationCollapse{{ str_replace('_', '', $tableName) }}{{ $index }}">
                                                            Data #{{ $index + 1 }} - Relasi
                                                        </button>
                                                    </h2>
                                                    <div id="relationCollapse{{ str_replace('_', '', $tableName) }}{{ $index }}" class="accordion-collapse collapse"
                                                        aria-labelledby="relationHeading{{ str_replace('_', '', $tableName) }}{{ $index }}"
                                                        data-bs-parent="#relationAccordion{{ str_replace('_', '', $tableName) }}">
                                                        <div class="accordion-body">
                                                            @foreach($relationshipData[$tableName] as $relation)
                                                                @if(isset($item->$relation) && $item->$relation)
                                                                    <div class="inner-card mb-3">
                                                                        <div class="inner-card-header">
                                                                            <h6>Relasi: {{ ucfirst($relation) }}</h6>
                                                                        </div>
                                                                        <div class="inner-card-body">
                                                                            @if(is_object($item->$relation))
                                                                                @if(method_exists($item->$relation, 'toArray'))
                                                                                    @php $relationData = $item->$relation->toArray(); @endphp
                                                                                    @if(is_array($relationData))
                                                                                        <ul class="list-group">
                                                                                            @foreach($relationData as $key => $value)
                                                                                                @if(!is_array($value) && !is_object($value))
                                                                                                    <li class="list-group-item">
                                                                                                        <strong>{{ $key }}:</strong> 
                                                                                                        @if(is_numeric($value) && 
                                                                                                            (strpos(strtolower($key), 'biaya') !== false || 
                                                                                                             strpos(strtolower($key), 'harga') !== false || 
                                                                                                             strpos(strtolower($key), 'nilai') !== false || 
                                                                                                             strpos(strtolower($key), 'kerugian') !== false || 
                                                                                                             strpos(strtolower($key), 'kerusakan') !== false))
                                                                                                            <span class="fw-bold text-primary">Rp {{ number_format($value, 0, ',', '.') }}</span>
                                                                                                        @else
                                                                                                            {{ $value }}
                                                                                                        @endif
                                                                                                    </li>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    @else
                                                                                        <p>{{ $relationData }}</p>
                                                                                    @endif
                                                                                @else
                                                                                    <p>{{ $item->$relation }}</p>
                                                                                @endif
                                                                            @elseif(is_array($item->$relation))
                                                                                @if(count($item->$relation) > 0)
                                                                                    <ul class="list-group">
                                                                                        @foreach($item->$relation as $relItem)
                                                                                            @if(is_object($relItem) && method_exists($relItem, 'toArray'))
                                                                                                @php $relItemData = $relItem->toArray(); @endphp
                                                                                                <li class="list-group-item">
                                                                                                    <ul>
                                                                                                        @foreach($relItemData as $relKey => $relValue)
                                                                                                            @if(!is_array($relValue) && !is_object($relValue))
                                                                                                                <li><strong>{{ $relKey }}:</strong> 
                                                                                                                @if(is_numeric($relValue) && 
                                                                                                                    (strpos(strtolower($relKey), 'biaya') !== false || 
                                                                                                                     strpos(strtolower($relKey), 'harga') !== false || 
                                                                                                                     strpos(strtolower($relKey), 'nilai') !== false || 
                                                                                                                     strpos(strtolower($relKey), 'kerugian') !== false || 
                                                                                                                     strpos(strtolower($relKey), 'kerusakan') !== false))
                                                                                                                    <span class="fw-bold text-primary">Rp {{ number_format($relValue, 0, ',', '.') }}</span>
                                                                                                                @else
                                                                                                                    {{ $relValue }}
                                                                                                                @endif
                                                                                                                </li>
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                </li>
                                                                                            @else
                                                                                                <li class="list-group-item">{{ $relItem }}</li>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @else
                                                                                    <p>Tidak ada data relasi</p>
                                                                                @endif
                                                                            @else
                                                                                <p>{{ $item->$relation }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <p>Tidak ada data untuk relasi {{ $relation }}</p>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @else
                                    <div class="alert-info">
                                        <i data-feather="alert-circle" style="width: 18px; height: 18px; margin-right: 6px;"></i>
                                        Tidak ada data sampel untuk ditampilkan
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Relationships Table -->
    <div class="main-card mt-4">
        <div class="card-header-gradient">
            <h4>
                <i data-feather="share-2" style="width: 20px; height: 20px; margin-right: 8px;"></i>
                Hubungan Antar Tabel
            </h4>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Tabel</th>
                            <th>Relasi</th>
                            <th>Tabel Terkait</th>
                            <th>Jenis Relasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>kerusakan</td>
                            <td>detail</td>
                            <td>detail_kerusakan</td>
                            <td><span class="badge bg-success">hasMany</span></td>
                        </tr>
                        <tr>
                            <td>kerusakan</td>
                            <td>bencana</td>
                            <td>bencanas</td>
                            <td><span class="badge bg-primary">belongsTo</span></td>
                        </tr>
                        <tr>
                            <td>kerusakan</td>
                            <td>kategori_bangunan</td>
                            <td>kategori_bangunan</td>
                            <td><span class="badge bg-primary">belongsTo</span></td>
                        </tr>
                        <tr>
                            <td>detail_kerusakan</td>
                            <td>satuan</td>
                            <td>satuan</td>
                            <td><span class="badge bg-primary">belongsTo</span></td>
                        </tr>
                        <tr>
                            <td>detail_kerusakan</td>
                            <td>hsd</td>
                            <td>hsd</td>
                            <td><span class="badge bg-primary">belongsTo</span></td>
                        </tr>
                        <tr>
                            <td>kerugian</td>
                            <td>bencana</td>
                            <td>bencanas</td>
                            <td><span class="badge bg-primary">belongsTo</span></td>
                        </tr>
                        <tr>
                            <td>pendataan</td>
                            <td>bencana</td>
                            <td>bencanas</td>
                            <td><span class="badge bg-primary">belongsTo</span></td>
                        </tr>
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
@endsection
