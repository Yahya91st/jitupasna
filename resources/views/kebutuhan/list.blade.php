@extends('layouts.main')

@section('styles')
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
    
    .orange-header h3 {
        margin: 0;
        font-weight: 600;
        font-size: 1.8rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .orange-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
    }
    
    .detail-card {
        background: white;
        border-radius: 12px;
        border: 3px solid #F28705;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    
    .card-header {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
        border-bottom: none;
        border-radius: 12px 12px 0 0;
    }
    
    .card-header h4 {
        margin: 0;
        font-weight: 600;
    }
    
    .card-primary .card-header {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    }
    
    .card-danger .card-header {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    }
    
    .card-warning .card-header {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    }
    
    .card-success .card-header {
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
    }
    
    .card-info .card-header {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    }
    
    .card-secondary .card-header {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    }
    
    .card-light .card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #495057;
    }
    
    .text-end.fw-bold {
        background-color: #fff8f0;
        color: #F28705;
        padding: 8px;
        border-radius: 5px;
    }
    
    .numeric-total {
        font-size: 1.2em;
        color: #28a745;
        font-weight: 700;
    }
    
    .highlight-table {
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-radius: 12px;
        border: 2px solid #e9ecef;
        overflow: hidden;
    }
    
    .progress-bar-container {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 6px;
        margin-bottom: 10px;
    }
    
    .progress-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
        font-weight: 500;
        color: #495057;
    }
    
    .progress-bar {
        height: 25px;
        border-radius: 8px;
        transition: width 0.8s ease;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-shadow: 0 1px 2px rgba(0,0,0,0.2);
    }
    
    .table thead th {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
        border: none;
        padding: 15px 12px;
        font-weight: 600;
        text-align: center;
    }
    
    .table tbody tr {
        transition: all 0.3s ease;
    }
    
    .table tbody tr:hover {
        background-color: #fff8f0;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(242, 135, 5, 0.1);
    }
    
    .accordion-button {
        background: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
        color: white;
        border: none;
        font-weight: 600;
    }
    
    .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, #e07600 0%, #f57c00 100%);
        color: white;
    }
    
    .accordion-button:focus {
        border-color: #F28705;
        box-shadow: 0 0 0 0.2rem rgba(242, 135, 5, 0.25);
    }
    
    .list-group-item {
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .list-group-item:hover {
        background-color: #fff8f0;
        border-color: #F28705;
    }
    
    .badge {
        border-radius: 8px;
        font-weight: 500;
        padding: 6px 12px;
    }
    
    .fw-bold {
        font-weight: 700 !important;
    }
    
    .text-primary {
        color: #F28705 !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
<div class="main-card">
    <div class="orange-header">
        <h3>Ringkasan Tabel Berdasarkan Form</h3>
        <p class="text-subtitle">Daftar tabel kerusakan dan kerugian pada setiap form</p>
    </div>

    <div style="padding: 20px;">
        <div class="detail-card mb-4">
            <div class="card-header">
                <h4 class="card-title">Rekap Total Nilai Kerusakan & Kerugian</h4>
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
                        foreach ($tables as $key =>  $form) {
                            foreach ( $form['tables'] as $tableInfo) {
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
                
                <div class="col-md-6">
                    <div class="card highlight-table">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0">Total Kerusakan & Kerugian</h5>
                        </div>
                        <div class="card-body">
                            <h2 class="numeric-total">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h2>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card highlight-table">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Distribusi per Form</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped mb-0">
                                @foreach($totalByForm as $formKey => $total)
                                    <tr>
                                        <td>{{ $tables[$formKey]['name'] }}</td>
                                        <td class="text-end fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card highlight-table">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Visualisasi Distribusi Nilai</h5>
                        </div>
                        <div class="card-body">
                            <h6>Distribusi Berdasarkan Form</h6>
                            @foreach($totalByForm as $formKey => $total)
                                @php 
                                    $percentage = $grandTotal > 0 ? ($total / $grandTotal * 100) : 0;
                                    
                                    // Generate a color based on the form key
                                    $colors = ['primary', 'success', 'danger', 'warning', 'info'];
                                    $colorIndex = array_search($formKey, array_keys($totalByForm)) % count($colors);
                                    $color = $colors[$colorIndex];
                                @endphp
                                <div class="progress-label">
                                    <span>{{ $tables[$formKey]['name'] }}</span>
                                    <span>{{ number_format($percentage, 1) }}% (Rp {{ number_format($total, 0, ',', '.') }})</span>
                                </div>
                                <div class="progress-bar-container">
                                    <div class="progress-bar bg-{{ $color }}" role="progressbar" 
                                         style="width: {{ $percentage }}%" 
                                         aria-valuenow="{{ $percentage }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100"></div>
                                </div>
                            @endforeach
                            
                            <h6 class="mt-4">Distribusi Berdasarkan Tabel</h6>
                            @php
                                $tablePercentages = [];
                                foreach ($tableTotals as $tableName => $columnTotals) {
                                    $tableTotal = array_sum($columnTotals);
                                    if ($tableTotal > 0) {
                                        $tablePercentages[$tableName] = [
                                            'total' => $tableTotal,
                                            'percentage' => $grandTotal > 0 ? ($tableTotal / $grandTotal * 100) : 0
                                        ];
                                    }
                                }
                                
                                // Sort by total descending
                                uasort($tablePercentages, function($a, $b) {
                                    return $b['total'] <=> $a['total'];
                                });
                            @endphp
                            
                            @foreach($tablePercentages as $tableName => $data)
                                @php 
                                    // Generate a color
                                    $colors = ['primary', 'success', 'danger', 'warning', 'info', 'secondary', 'dark'];
                                    $colorIndex = array_search($tableName, array_keys($tablePercentages)) % count($colors);
                                    $color = $colors[$colorIndex];
                                @endphp
                                <div class="progress-label">
                                    <span>{{ $tableName }}</span>
                                    <span>{{ number_format($data['percentage'], 1) }}% (Rp {{ number_format($data['total'], 0, ',', '.') }})</span>
                                </div>
                                <div class="progress-bar-container">
                                    <div class="progress-bar bg-{{ $color }}" role="progressbar" 
                                         style="width: {{ $data['percentage'] }}%" 
                                         aria-valuenow="{{ $data['percentage'] }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Ringkasan Tabel Berdasarkan Form</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                        @foreach($tables as $formKey =>  $form)
                            @php
                                $isFirstRow = true;
                                $rowCount = count( $form['tables']);
                                $rowCount = $rowCount > 0 ? $rowCount : 1;
                            @endphp
                            
                            @if(empty( $form['tables']))
                                <tr>
                                    <td>{{  $form['name'] }}</td>
                                    <td>-</td>
                                    <td>{{  $form['description'] }}</td>
                                    <td>-</td>
                                </tr>
                            @else
                                @foreach( $form['tables'] as $index => $table)
                                    <tr>
                                        @if($isFirstRow)
                                            <td rowspan="{{ $rowCount }}">{{  $form['name'] }}</td>
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
      <div class="card mt-4">
        <div class="card-header">
            <h4 class="card-title">Kolom-kolom Terkait Kerusakan dan Kerugian</h4>
        </div>
        <div class="card-body">
            <div class="accordion" id="tableColumnsAccordion">
                @foreach($columns as $tableName => $tableColumns)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ str_replace('_', '', $tableName) }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ str_replace('_', '', $tableName) }}" aria-expanded="false"
                                aria-controls="collapse{{ str_replace('_', '', $tableName) }}">
                                Tabel: {{ $tableName }}
                            </button>
                        </h2>
                        <div id="collapse{{ str_replace('_', '', $tableName) }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ str_replace('_', '', $tableName) }}"
                            data-bs-parent="#tableColumnsAccordion">
                            <div class="accordion-body">                                <h5>Kolom Terkait</h5>
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
                                <div class="card mb-4">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0">Total Nilai Kerusakan/Kerugian</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
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
                                    <h5>Data Sampel (5 entri teratas)</h5>
                                    <div class="table-responsive">
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
                                                    <tr>                                                        @foreach($tableColumns as $column)
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
                                        <h5 class="mt-4">Data Relasi</h5>
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
                                                                    <div class="card mb-3">
                                                                        <div class="card-header bg-light">
                                                                            <h6 class="mb-0">Relasi: {{ ucfirst($relation) }}</h6>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            @if(is_object($item->$relation))
                                                                                @if(method_exists($item->$relation, 'toArray'))
                                                                                    @php $relationData = $item->$relation->toArray(); @endphp
                                                                                    @if(is_array($relationData))
                                                                                        <ul class="list-group">
                                                                                            @foreach($relationData as $key => $value)                                                                                            @if(!is_array($value) && !is_object($value))
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
                                                                                                        @foreach($relItemData as $relKey => $relValue)                                                                                                            @if(!is_array($relValue) && !is_object($relValue))
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
                                    <div class="alert alert-info">
                                        Tidak ada data sampel untuk ditampilkan
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h4 class="card-title">Hubungan Antar Tabel</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                            <td>hasMany</td>
                        </tr>
                        <tr>
                            <td>kerusakan</td>
                            <td>bencana</td>
                            <td>bencanas</td>
                            <td>belongsTo</td>
                        </tr>
                        <tr>
                            <td>kerusakan</td>
                            <td>kategori_bangunan</td>
                            <td>kategori_bangunan</td>
                            <td>belongsTo</td>
                        </tr>
                        <tr>
                            <td>detail_kerusakan</td>
                            <td>satuan</td>
                            <td>satuan</td>
                            <td>belongsTo</td>
                        </tr>
                        <tr>
                            <td>detail_kerusakan</td>
                            <td>hsd</td>
                            <td>hsd</td>
                            <td>belongsTo</td>
                        </tr>
                        <tr>
                            <td>kerugian</td>
                            <td>bencana</td>
                            <td>bencanas</td>
                            <td>belongsTo</td>
                        </tr>
                        <tr>
                            <td>pendataan</td>
                            <td>bencana</td>
                            <td>bencanas</td>
                            <td>belongsTo</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
@endsection
