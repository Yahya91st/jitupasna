@extends('layouts.main')
@section('content')
    @php
        $items = $formulir->items ?? collect();
        $getItem = function ($kategori, $subKategori = null, $tingkatKerusakan = null) use ($items) {
            return $items->first(fn($item) => $item->kategori === $kategori && $item->sub_kategori === $subKategori && $item->tingkat_kerusakan === $tingkatKerusakan);
        };
        $getCategoryItem = fn($kategori) => $items->firstWhere('kategori', $kategori);
        $bangunan = ['gereja' => 'Gereja', 'kapel' => 'Kapel', 'masjid' => 'Masjid', 'musholla' => 'Musholla', 'pura' => 'Pura', 'vihara' => 'Vihara'];
    @endphp
    <div class="container mt-4">
        <h5 class="text-center fw-bold">Detail Form Sektor Keagamaan<br>Format 5</h5>
        <div class="alert alert-light-primary"><strong>Bencana:</strong> {{ $bencana->jenis_bencana ?? '-' }}<br><strong>Tanggal:</strong> {{ $bencana->tanggal ?? '-' }}</div>
        <table class="table table-bordered">
            <tr>
                <td><strong>NAMA KAMPUNG:</strong> {{ $formulir->nama_kampung ?? '-' }}</td>
                <td><strong>NAMA DISTRIK:</strong> {{ $formulir->nama_distrik ?? '-' }}</td>
            </tr>
        </table>
        <h6 class="fw-bold mt-4">I. KERUSAKAN BANGUNAN KEAGAMAAN</h6>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th>Jenis</th>
                        <th>Berat Negeri</th>
                        <th>Berat Swasta</th>
                        <th>Sedang Negeri</th>
                        <th>Sedang Swasta</th>
                        <th>Ringan Negeri</th>
                        <th>Ringan Swasta</th>
                        <th>Harga Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bangunan as $kategori => $label)
                        @php $categoryItem=$getCategoryItem($kategori); @endphp
                        <tr>
                            <td>{{ $label }}</td>
                            @foreach ([['berat', 'negeri'], ['berat', 'swasta'], ['sedang', 'negeri'], ['sedang', 'swasta'], ['ringan', 'negeri'], ['ringan', 'swasta']] as [$tingkat, $status])
                                <td>{{ $getItem($kategori, $status, $tingkat)?->jumlah ?? 0 }}</td>
                            @endforeach
                            <td class="text-end">
                                Rp {{ number_format($categoryItem?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h6 class="fw-bold mt-4">II. PERKIRAAN KERUGIAN</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ([['tenaga_kerja', 'Tenaga Kerja', 'HOK'], ['alat_berat', 'Alat Berat', 'Hari']] as [$kategori, $label, $satuan])
                    @php $item=$getCategoryItem($kategori); @endphp
                    <tr>
                        <td>{{ $label }}</td>
                        <td>{{ $item?->jumlah ?? 0 }} {{ $satuan }}</td>
                        <td class="text-end">Rp {{ number_format($item?->harga_satuan ?? 0, 0, ',', '.') }}</td>
                        <td class="text-end">Rp {{ number_format(($item?->jumlah ?? 0) * ($item?->harga_satuan ?? 0), 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 mb-4"><a href="{{ route('forms.form4.format5.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">Kembali</a> <a href="{{ route('forms.form4.format5.edit', $formulir->id) }}" class="btn btn-warning">Edit</a> <a href="{{ route('forms.form4.format5.pdf', $formulir->id) }}" class="btn btn-primary" target="_blank">PDF</a></div>
    </div>
@endsection
