@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Form Sektor Perumahan</h1>
    
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
    
    <form action="{{ route('forms.form4.store') }}" method="POST" class="space-y-8">
        @csrf
        @if($bencana)
            <input type="hidden" name="bencana_id" value="{{ $bencana->id }}">
        @endif
        
        <!-- Identitas Lokasi -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Identitas Lokasi</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Kampung</label>
                    <input type="text" name="nama_kampung" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Distrik</label>
                    <input type="text" name="nama_distrik" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
            </div>
        </div>

        <!-- Perkiraan Kerusakan -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">I. PERKIRAAN KERUSAKAN</h2>
            
            <!-- Kerusakan Rumah -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-4">1. KERUSAKAN RUMAH</h3>
                
                <!-- Rumah Permanen -->
                <div class="mb-4">
                    <h4 class="font-medium mb-2">Rumah Permanen</h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Hancur Total</label>
                            <input type="number" name="rumah_hancur_total_permanen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rusak Berat</label>
                            <input type="number" name="rumah_rusak_berat_permanen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rusak Sedang</label>
                            <input type="number" name="rumah_rusak_sedang_permanen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rusak Ringan</label>
                            <input type="number" name="rumah_rusak_ringan_permanen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm font-medium text-gray-700">Harga Satuan</label>
                        <input type="number" step="0.01" name="harga_satuan_permanen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>

                <!-- Rumah Non-Permanen -->
                <div class="mb-4">
                    <h4 class="font-medium mb-2">Rumah Non-Permanen</h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Hancur Total</label>
                            <input type="number" name="rumah_hancur_total_non_permanen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rusak Berat</label>
                            <input type="number" name="rumah_rusak_berat_non_permanen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rusak Sedang</label>
                            <input type="number" name="rumah_rusak_sedang_non_permanen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rusak Ringan</label>
                            <input type="number" name="rumah_rusak_ringan_non_permanen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm font-medium text-gray-700">Harga Satuan</label>
                        <input type="number" step="0.01" name="harga_satuan_non_permanen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>
            </div>

            <!-- Prasarana Lingkungan -->
            <div>
                <h3 class="text-lg font-medium mb-4">2. KERUSAKAN PRASARANA LINGKUNGAN</h3>
                
                <!-- Jalan Lingkungan -->
                <div class="mb-4">
                    <h4 class="font-medium mb-2">2.1 JALAN LINGKUNGAN</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rusak Berat (m²)</label>
                            <input type="number" name="jalan_rusak_berat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rusak Sedang (m²)</label>
                            <input type="number" name="jalan_rusak_sedang" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rusak Ringan (m²)</label>
                            <input type="number" name="jalan_rusak_ringan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm font-medium text-gray-700">Harga Satuan per m²</label>
                        <input type="number" step="0.01" name="harga_satuan_jalan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>

                <!-- Saluran Air -->
                <div class="mb-4">
                    <h4 class="font-medium mb-2">2.2 SALURAN AIR / GORONG-GORONG</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rusak Berat (m²)</label>
                            <input type="number" name="saluran_rusak_berat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rusak Sedang (m²)</label>
                            <input type="number" name="saluran_rusak_sedang" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rusak Ringan (m²)</label>
                            <input type="number" name="saluran_rusak_ringan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm font-medium text-gray-700">Harga Satuan per m²</label>
                        <input type="number" step="0.01" name="harga_satuan_saluran" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>

                <!-- Balai Pertemuan -->
                <div class="mb-4">
                    <h4 class="font-medium mb-2">2.3 BALAI PERTEMUAN RW/RT</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rusak Berat (unit)</label>
                            <input type="number" name="balai_rusak_berat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rusak Sedang (unit)</label>
                            <input type="number" name="balai_rusak_sedang" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rusak Ringan (unit)</label>
                            <input type="number" name="balai_rusak_ringan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm font-medium text-gray-700">Harga Satuan per Unit</label>
                        <input type="number" step="0.01" name="harga_satuan_balai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>
            </div>
        </div>

        <!-- Perkiraan Kerugian -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">II. PERKIRAAN KERUGIAN</h2>
            
            <!-- Biaya Pembersihan -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-4">1. BIAYA PEMBERSIHAN PUING</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah HOK</label>
                        <input type="number" name="tenaga_kerja_hok" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Upah Harian</label>
                        <input type="number" step="0.01" name="upah_harian" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Hari Alat Berat</label>
                        <input type="number" name="alat_berat_hari" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Biaya Alat Berat per Hari</label>
                        <input type="number" step="0.01" name="biaya_per_hari" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>
            </div>

            <!-- Rumah Disewakan -->
            <div class="mb-6">
                <h3 class="text-lg font-medium mb-4">2. PERKIRAAN RUMAH YANG DISEWAKAN</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga Sewa per Bulan</label>
                    <input type="number" step="0.01" name="harga_sewa_per_bulan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
            </div>

            <!-- Hunian Sementara -->
            <div>
                <h3 class="text-lg font-medium mb-4">3. PERKIRAAN KEBUTUHAN HUNIAN SEMENTARA</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Tenda -->
                    <div>
                        <h4 class="font-medium mb-2">Tenda</h4>
                        <div class="space-y-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jumlah Unit</label>
                                <input type="number" name="jumlah_tenda" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga per Unit</label>
                                <input type="number" step="0.01" name="harga_tenda" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Barak -->
                    <div>
                        <h4 class="font-medium mb-2">Barak</h4>
                        <div class="space-y-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jumlah Unit</label>
                                <input type="number" name="jumlah_barak" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga per Unit</label>
                                <input type="number" step="0.01" name="harga_barak" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Rumah Sementara -->
                    <div>
                        <h4 class="font-medium mb-2">Rumah Sementara</h4>
                        <div class="space-y-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jumlah Unit</label>
                                <input type="number" name="jumlah_rumah_sementara" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga per Unit</label>
                                <input type="number" step="0.01" name="harga_rumah_sementara" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">
                Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection
