@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Format 16 - Sektor Pemerintahan</h1>
    <form action="{{ route('forms.form4.store-format16') }}" method="POST" class="space-y-8">
        @csrf
        <!-- Hidden field to pass bencana_id -->
        <input type="hidden" name="bencana_id" value="{{ $bencana->id }}">
        
        <!-- Perkiraan Kerusakan -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="py-4 px-4 text-xl font-semibold mb-4">I. PERKIRAAN KERUSAKAN</h2>
            
            <!-- Fasilitas Pemerintahan -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">Fasilitas Pemerintahan</h3>
                <div id="fasilitas-pemerintahan-container">
                    <div class="border p-4 rounded mb-4 relative">
                        <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700" onclick="deleteItem(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Fasilitas</label>
                                <select name="jenis_fasilitas[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Pilih Jenis Fasilitas</option>
                                    <option value="Kantor Pemkab">Kantor Pemkab</option>
                                    <option value="Kantor Kecamatan">Kantor Kecamatan</option>
                                    <option value="Kantor Dinas">Kantor Dinas</option>
                                    <option value="Kantor Instansi Vertikal">Kantor Instansi Vertikal/Pemerintah Pusat</option>
                                    <option value="Mebelair dan Peralatan Kantor">Mebelair dan Peralatan Kantor</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jumlah Unit Rusak Berat (RB)</label>
                                <input type="number" name="jumlah_rb[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jumlah Unit Rusak Sedang (RS)</label>
                                <input type="number" name="jumlah_rs[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jumlah Unit Rusak Ringan (RR)</label>
                                <input type="number" name="jumlah_rr[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga Satuan RB (Rp)</label>
                                <input type="number" step="0.01" name="harga_rb[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga Satuan RS (Rp)</label>
                                <input type="number" step="0.01" name="harga_rs[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga Satuan RR (Rp)</label>
                                <input type="number" step="0.01" name="harga_rr[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="mt-2 px-4 py-2 bg-blue-500 text-black rounded hover:bg-blue-600" onclick="addFasilitasPemerintahan()">
                    Tambah Fasilitas
                </button>
            </div>
        </div>
        
        <!-- Perkiraan Kerugian -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="py-4 px-4 text-xl font-semibold mb-4">II. PERKIRAAN KERUGIAN</h2>
            
            <!-- A. Biaya Pembersihan Puing -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">A. Biaya Pembersihan Puing</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tenaga Kerja (HOK)</label>
                        <input type="number" name="tenaga_kerja_hok" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Upah Harian (Rp)</label>
                        <input type="number" step="0.01" name="upah_harian" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alat Berat (Hari)</label>
                        <input type="number" name="alat_berat_hari" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Biaya Per Hari Alat Berat (Rp)</label>
                        <input type="number" step="0.01" name="biaya_per_hari_alat_berat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>
            </div>
            
            <!-- B. Biaya Sewa Kantor Sementara -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">B. Biaya Sewa Kantor Sementara</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Unit</label>
                        <input type="number" name="jumlah_unit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Biaya Sewa Per Unit (Rp)</label>
                        <input type="number" step="0.01" name="biaya_sewa_per_unit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>
            </div>
            
            <!-- C. Biaya Restorasi Arsip -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">C. Biaya Restorasi Arsip</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Arsip</label>
                        <input type="number" name="jumlah_arsip" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Harga Satuan (Rp)</label>
                        <input type="number" step="0.01" name="harga_satuan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>
            </div>
            
            <!-- D. Kehilangan Pendapatan Retribusi Jasa Pemerintahan -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">D. Kehilangan Pendapatan Retribusi Jasa Pemerintahan</h3>
                <div class="px-4">
                    <label class="block text-sm font-medium text-gray-700">Dasar Perhitungan</label>
                    <textarea name="dasar_perhitungan" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                </div>
            </div>
        </div>
        
        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function createDamageLine() {
        const template = document.querySelector('#fasilitas-pemerintahan-container > div').cloneNode(true);
        // Reset input values and selections
        template.querySelectorAll('input').forEach(input => input.value = '');
        template.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
        return template;
    }

    function deleteItem(button) {
        const item = button.closest('.border');
        const container = item.parentElement;
        
        // Don't delete if it's the last item in the container
        if (container.children.length > 1) {
            item.remove();
        } else {
            // Reset values instead of deleting if it's the last item
            item.querySelectorAll('input').forEach(input => input.value = '');
            item.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
        }
    }

    function addFasilitasPemerintahan() {
        const container = document.getElementById('fasilitas-pemerintahan-container');
        container.appendChild(createDamageLine());
    }
</script>
@endpush
