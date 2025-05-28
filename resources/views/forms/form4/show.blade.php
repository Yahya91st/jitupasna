@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Detail Form Sektor Perumahan</h1>
    
    @if(session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="mb-4 flex justify-between">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            Kembali
        </a>
        <a href="{{ route('forms.form4.pdf', $formPerumahan->id) }}" class="btn btn-primary" target="_blank">
            <i class="fa fa-download mr-2"></i> Unduh PDF
        </a>
    </div>
    
    @if($bencana)
        <div class="alert alert-light-primary color-primary mb-4">
            <p>Bencana: {{ $bencana->kategori_bencana->nama }}</p>
            <p>Tanggal: {{ $bencana->tanggal }}</p>
            <p>Lokasi: 
                @foreach($bencana->desa as $desa)
                    {{ $desa->nama }}@if(!$loop->last), @endif
                @endforeach
            </p>
        </div>
    @endif
    
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Identitas Lokasi</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Kampung</label>
                <p class="mt-1">{{ $formPerumahan->nama_kampung }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Distrik</label>
                <p class="mt-1">{{ $formPerumahan->nama_distrik }}</p>
            </div>
        </div>
    </div>
    
    <!-- I. PERKIRAAN KERUSAKAN -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">I. PERKIRAAN KERUSAKAN</h2>
        
        <!-- 1. KERUSAKAN RUMAH -->
        <div class="mb-6">
            <h3 class="text-lg font-medium mb-4">1. KERUSAKAN RUMAH</h3>
            
            <!-- Rumah Permanen -->
            <div class="mb-4">
                <h4 class="font-medium mb-2">Rumah Permanen</h4>
                <div class="overflow-x-auto">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Hancur Total</th>
                                <th>Rusak Berat</th>
                                <th>Rusak Sedang</th>
                                <th>Rusak Ringan</th>
                                <th>Harga Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $formPerumahan->rumah_hancur_total_permanen }}</td>
                                <td>{{ $formPerumahan->rumah_rusak_berat_permanen }}</td>
                                <td>{{ $formPerumahan->rumah_rusak_sedang_permanen }}</td>
                                <td>{{ $formPerumahan->rumah_rusak_ringan_permanen }}</td>
                                <td>Rp {{ number_format($formPerumahan->harga_satuan_permanen, 2, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Rumah Non-Permanen -->
            <div class="mb-4">
                <h4 class="font-medium mb-2">Rumah Non-Permanen</h4>
                <div class="overflow-x-auto">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Hancur Total</th>
                                <th>Rusak Berat</th>
                                <th>Rusak Sedang</th>
                                <th>Rusak Ringan</th>
                                <th>Harga Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $formPerumahan->rumah_hancur_total_non_permanen }}</td>
                                <td>{{ $formPerumahan->rumah_rusak_berat_non_permanen }}</td>
                                <td>{{ $formPerumahan->rumah_rusak_sedang_non_permanen }}</td>
                                <td>{{ $formPerumahan->rumah_rusak_ringan_non_permanen }}</td>
                                <td>Rp {{ number_format($formPerumahan->harga_satuan_non_permanen, 2, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- 2. KERUSAKAN JALAN -->
        <div class="mb-6">
            <h3 class="text-lg font-medium mb-4">2. KERUSAKAN JALAN</h3>
            <div class="overflow-x-auto">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Rusak Berat</th>
                            <th>Rusak Sedang</th>
                            <th>Rusak Ringan</th>
                            <th>Harga Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $formPerumahan->jalan_rusak_berat }} m²</td>
                            <td>{{ $formPerumahan->jalan_rusak_sedang }} m²</td>
                            <td>{{ $formPerumahan->jalan_rusak_ringan }} m²</td>
                            <td>Rp {{ number_format($formPerumahan->harga_satuan_jalan, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- 3. KERUSAKAN SALURAN -->
        <div class="mb-6">
            <h3 class="text-lg font-medium mb-4">3. KERUSAKAN SALURAN</h3>
            <div class="overflow-x-auto">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Rusak Berat</th>
                            <th>Rusak Sedang</th>
                            <th>Rusak Ringan</th>
                            <th>Harga Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $formPerumahan->saluran_rusak_berat }} m</td>
                            <td>{{ $formPerumahan->saluran_rusak_sedang }} m</td>
                            <td>{{ $formPerumahan->saluran_rusak_ringan }} m</td>
                            <td>Rp {{ number_format($formPerumahan->harga_satuan_saluran, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- 4. KERUSAKAN BALAI -->
        <div class="mb-6">
            <h3 class="text-lg font-medium mb-4">4. KERUSAKAN BALAI</h3>
            <div class="overflow-x-auto">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Rusak Berat</th>
                            <th>Rusak Sedang</th>
                            <th>Harga Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $formPerumahan->balai_rusak_berat }}</td>
                            <td>{{ $formPerumahan->balai_rusak_sedang }}</td>
                            <td>Rp {{ number_format($formPerumahan->harga_satuan_balai, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- II. PERKIRAAN KERUGIAN -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">II. PERKIRAAN KERUGIAN</h2>
        
        <div class="overflow-x-auto">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tenaga Kerja (HOK)</td>
                        <td>{{ $formPerumahan->tenaga_kerja_hok }}</td>
                        <td>Rp {{ number_format($formPerumahan->upah_harian, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Alat Berat (Hari)</td>
                        <td>{{ $formPerumahan->alat_berat_hari }}</td>
                        <td>Rp {{ number_format($formPerumahan->biaya_per_hari, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Harga Sewa per Bulan</td>
                        <td>-</td>
                        <td>Rp {{ number_format($formPerumahan->harga_sewa_per_bulan, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Tenda</td>
                        <td>{{ $formPerumahan->jumlah_tenda }}</td>
                        <td>Rp {{ number_format($formPerumahan->harga_tenda, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Barak</td>
                        <td>{{ $formPerumahan->jumlah_barak }}</td>
                        <td>Rp {{ number_format($formPerumahan->harga_barak, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Rumah Sementara</td>
                        <td>{{ $formPerumahan->jumlah_rumah_sementara }}</td>
                        <td>Rp {{ number_format($formPerumahan->harga_rumah_sementara, 2, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
