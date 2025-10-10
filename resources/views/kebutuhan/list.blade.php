@extends('layouts.main')

@section('styles')
<style>
    .text-end.fw-bold {
        background-color: #f8f9fa;
        color: #0d6efd;
    }
    
    .numeric-total {
        font-size: 1.1em;
        color: #198754;
    }
    
    .numeric-column {
        position: relative;
    }
    
    .numeric-column::after {
        content: "Rp";
        position: absolute;
        left: 10px;
        color: #6c757d;
    }
    
    .highlight-table {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border-radius: 0.25rem;
    }
    
    .progress-bar-container {
        background-color: #f8f9fa;
        border-radius: 4px;
        padding: 4px;
        margin-bottom: 5px;
    }
    
    .progress-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2px;
    }
    
    .progress-bar {
        height: 20px;
        border-radius: 4px;
        transition: width 0.6s ease;
    }
</style>
@endsection

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Ringkasan Tabel Berdasarkan Form</h3>
            <p class="text-subtitle text-muted">Daftar tabel kerusakan dan kerugian pada setiap form</p>
        </div>
    </div>
</div>

<section class="section">    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
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
</section>
@endsection
