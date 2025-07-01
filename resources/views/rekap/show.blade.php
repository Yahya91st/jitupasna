@extends('layouts.main')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <!-- Header Card -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">
                            <i class="fas fa-eye me-2"></i>
                            Detail Rekap Bencana
                        </h5>
                        <small class="text-muted">ID: {{ $rekap->id }}</small>
                    </div>
                    <div>
                        <a href="{{ route('rekap.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                        <a href="{{ route('rekap.edit', $rekap->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <a href="{{ route('rekap.pdf', $rekap->id) }}" class="btn btn-danger btn-sm" target="_blank">
                            <i class="fas fa-file-pdf me-1"></i>Download PDF
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Nama Bencana:</strong></td>
                                    <td>{{ $rekap->bencana->nama_kejadian ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Kejadian:</strong></td>
                                    <td>{{ $rekap->bencana->tanggal_kejadian ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Kampung:</strong></td>
                                    <td>{{ $rekap->nama_kampung ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Distrik:</strong></td>
                                    <td>{{ $rekap->nama_distrik ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Status:</strong></td>
                                    <td>
                                        @php
                                            $statusClass = match($rekap->status) {
                                                'completed' => 'bg-success',
                                                'verified' => 'bg-info',
                                                default => 'bg-warning'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ ucfirst($rekap->status) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Format Terisi:</strong></td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $rekap->getFilledFormatsCount() }}/17 Format</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Dibuat:</strong></td>
                                    <td>{{ $rekap->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Diupdate:</strong></td>
                                    <td>{{ $rekap->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($rekap->catatan)
                    <div class="mt-3">
                        <strong>Catatan:</strong>
                        <p class="mt-2 p-3 bg-light rounded">{{ $rekap->catatan }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-danger text-white">
                        <div class="card-body text-center">
                            <h3>Rp {{ number_format($rekap->total_kerusakan, 0, ',', '.') }}</h3>
                            <p class="mb-0">Total Kerusakan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center">
                            <h3>Rp {{ number_format($rekap->total_kerugian, 0, ',', '.') }}</h3>
                            <p class="mb-0">Total Kerugian</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <h3>Rp {{ number_format($rekap->total_kerusakan + $rekap->total_kerugian, 0, ',', '.') }}</h3>
                            <p class="mb-0">Grand Total</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Format Details -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Detail Per Format
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @for($i = 1; $i <= 17; $i++)
                            @php
                                $formatIdColumn = "format{$i}_form4_id";
                                $formatData = null;
                                $formatName = "Format {$i}";
                                $isFilled = !empty($rekap->$formatIdColumn);
                                
                                // Set format names
                                switch($i) {
                                    case 1: $formatName = "Format 1 - Perumahan dan Pemukiman"; break;
                                    case 2: $formatName = "Format 2 - Sarana Pendidikan"; break;
                                    case 3: $formatName = "Format 3 - Sarana Kesehatan"; break;
                                    case 4: $formatName = "Format 4 - Tempat Ibadah"; break;
                                    case 5: $formatName = "Format 5 - Sektor Keagamaan"; break;
                                    case 6: $formatName = "Format 6 - Air Minum & Sanitasi"; break;
                                    case 7: $formatName = "Format 7 - Transportasi"; break;
                                    case 8: $formatName = "Format 8 - Komunikasi"; break;
                                    case 9: $formatName = "Format 9 - Energi"; break;
                                    case 10: $formatName = "Format 10 - Ekonomi"; break;
                                    case 11: $formatName = "Format 11 - Pertanian"; break;
                                    case 12: $formatName = "Format 12 - Perkebunan"; break;
                                    case 13: $formatName = "Format 13 - Peternakan"; break;
                                    case 14: $formatName = "Format 14 - Perikanan"; break;
                                    case 15: $formatName = "Format 15 - Kehutanan"; break;
                                    case 16: $formatName = "Format 16 - Pemerintahan"; break;
                                    case 17: $formatName = "Format 17 - Lingkungan"; break;
                                }
                                
                                // Get format data if available
                                if ($isFilled) {
                                    switch($i) {
                                        case 1: $formatData = $rekap->format1Form4; break;
                                        case 5: $formatData = $rekap->format5Form4; break;
                                        case 6: $formatData = $rekap->format6Form4; break;
                                        case 7: $formatData = $rekap->format7Form4; break;
                                    }
                                }
                            @endphp
                            
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card h-100 {{ $isFilled ? 'border-success' : 'border-secondary' }}">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h6 class="card-title">{{ $formatName }}</h6>
                                            @if($isFilled)
                                                <i class="fas fa-check-circle text-success"></i>
                                            @else
                                                <i class="fas fa-times-circle text-secondary"></i>
                                            @endif
                                        </div>
                                        
                                        @if($isFilled && $formatData)
                                            <div class="mt-2">
                                                @switch($i)
                                                    @case(1)
                                                        <small class="text-muted">Grand Total:</small><br>
                                                        <strong>Rp {{ number_format($formatData->grand_total ?? 0, 0, ',', '.') }}</strong>
                                                        @break
                                                    @case(5)
                                                        <small class="text-muted">Total Kerusakan:</small><br>
                                                        <strong>Rp {{ number_format($formatData->total_kerusakan_bangunan ?? 0, 0, ',', '.') }}</strong><br>
                                                        <small class="text-muted">Total Kerugian:</small><br>
                                                        <strong>Rp {{ number_format(($formatData->total_kerugian_peralatan ?? 0) + ($formatData->total_biaya_pembersihan ?? 0), 0, ',', '.') }}</strong>
                                                        @break
                                                    @case(6)
                                                        <small class="text-muted">Air Minum:</small><br>
                                                        <strong>Rp {{ number_format($formatData->total_kerusakan_air_minum ?? 0, 0, ',', '.') }}</strong><br>
                                                        <small class="text-muted">Sanitasi:</small><br>
                                                        <strong>Rp {{ number_format($formatData->total_kerusakan_sanitasi ?? 0, 0, ',', '.') }}</strong>
                                                        @break
                                                    @case(7)
                                                        <small class="text-muted">Infrastruktur:</small><br>
                                                        <strong>Rp {{ number_format($formatData->total_kerusakan_infrastruktur ?? 0, 0, ',', '.') }}</strong><br>
                                                        <small class="text-muted">Kerugian:</small><br>
                                                        <strong>Rp {{ number_format(($formatData->total_kehilangan_pendapatan ?? 0) + ($formatData->total_kenaikan_biaya_operasional ?? 0), 0, ',', '.') }}</strong>
                                                        @break
                                                    @default
                                                        <small class="text-success">Data tersedia</small>
                                                @endswitch
                                            </div>
                                        @else
                                            <div class="mt-2">
                                                <small class="text-muted">Belum diisi</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
