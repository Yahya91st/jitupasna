@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Format 17 - Sektor Lingkungan Hidup</h1>
    <form action="{{ route('forms.format17.store') }}" method="POST" class="space-y-8">
        @csrf
        
        <!-- Perkiraan Kerusakan -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="py-4 px-4 text-xl font-semibold mb-4">I. PERKIRAAN KERUSAKAN</h2>
            
            <!-- Ekosistem Darat -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">1. Ekosistem Darat</h3>
                <div id="ekosistem-darat-container">
                    <div class="border p-4 rounded mb-4 relative">
                        <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700" onclick="deleteItem(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kerusakan</label>
                                <input type="text" name="darat_jenis_kerusakan[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Rusak Berat (RB)</label>
                                <input type="number" name="darat_rb[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Rusak Sedang (RS)</label>
                                <input type="number" name="darat_rs[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Rusak Ringan (RR)</label>
                                <input type="number" name="darat_rr[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga Satuan RB</label>
                                <input type="number" step="0.01" name="darat_harga_rb[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga Satuan RS</label>
                                <input type="number" step="0.01" name="darat_harga_rs[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga Satuan RR</label>
                                <input type="number" step="0.01" name="darat_harga_rr[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="mt-2 px-4 py-2 bg-blue-500 text-black rounded hover:bg-blue-600" onclick="addEkosistemDarat()">
                    Tambah Jenis Kerusakan Darat
                </button>
            </div>
            
            <!-- Ekosistem Laut -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">2. Ekosistem Laut</h3>
                <div id="ekosistem-laut-container">
                    <div class="border p-4 rounded mb-4 relative">
                        <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700" onclick="deleteItem(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kerusakan</label>
                                <input type="text" name="laut_jenis_kerusakan[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Rusak Berat (RB)</label>
                                <input type="number" name="laut_rb[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Rusak Sedang (RS)</label>
                                <input type="number" name="laut_rs[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Rusak Ringan (RR)</label>
                                <input type="number" name="laut_rr[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga Satuan RB</label>
                                <input type="number" step="0.01" name="laut_harga_rb[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga Satuan RS</label>
                                <input type="number" step="0.01" name="laut_harga_rs[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga Satuan RR</label>
                                <input type="number" step="0.01" name="laut_harga_rr[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="mt-2 px-4 py-2 bg-blue-500 text-black rounded hover:bg-blue-600" onclick="addEkosistemLaut()">
                    Tambah Jenis Kerusakan Laut
                </button>
            </div>
            
            <!-- Ekosistem Udara -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">3. Ekosistem Udara</h3>
                <div id="ekosistem-udara-container">
                    <div class="border p-4 rounded mb-4 relative">
                        <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700" onclick="deleteItem(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kerusakan</label>
                                <input type="text" name="udara_jenis_kerusakan[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Rusak Berat (RB)</label>
                                <input type="number" name="udara_rb[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Rusak Sedang (RS)</label>
                                <input type="number" name="udara_rs[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Rusak Ringan (RR)</label>
                                <input type="number" name="udara_rr[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga Satuan RB</label>
                                <input type="number" step="0.01" name="udara_harga_rb[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga Satuan RS</label>
                                <input type="number" step="0.01" name="udara_harga_rs[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Harga Satuan RR</label>
                                <input type="number" step="0.01" name="udara_harga_rr[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="mt-2 px-4 py-2 bg-blue-500 text-black rounded hover:bg-blue-600" onclick="addEkosistemUdara()">
                    Tambah Jenis Kerusakan Udara
                </button>
            </div>
        </div>

        <!-- Perkiraan Kerugian -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="px-4 text-xl font-semibold mb-4">II. PERKIRAAN KERUGIAN</h2>
            
            <!-- Kehilangan Jasa Lingkungan -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">1. Kehilangan Jasa Lingkungan</h3>
                <div id="jasa-lingkungan-container">
                    <div class="border p-4 rounded mb-4 relative">
                        <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700" onclick="deleteItem(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kerugian</label>
                                <input type="text" name="jasa_jenis_kerugian[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Dasar Perhitungan</label>
                                <textarea name="jasa_dasar_perhitungan[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Rusak Berat (RB)</label>
                                <input type="number" name="jasa_rb[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Rusak Sedang (RS)</label>
                                <input type="number" name="jasa_rs[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Rusak Ringan (RR)</label>
                                <input type="number" name="jasa_rr[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="mt-2 px-4 py-2 bg-blue-500 text-black rounded hover:bg-blue-600" onclick="addJasaLingkungan()">
                    Tambah Jasa Lingkungan
                </button>
            </div>

            <!-- Pencemaran Air -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">2. Biaya Akibat Pencemaran Air</h3>
                <div id="pencemaran-air-container">
                    <div class="border p-4 rounded mb-4 relative">
                        <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700" onclick="deleteItem(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kerugian</label>
                                <input type="text" name="air_jenis_kerugian[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Dasar Perhitungan</label>
                                <textarea name="air_dasar_perhitungan[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Rusak Berat (RB)</label>
                                <input type="number" name="air_rb[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Rusak Sedang (RS)</label>
                                <input type="number" name="air_rs[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Rusak Ringan (RR)</label>
                                <input type="number" name="air_rr[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="mt-2 px-4 py-2 bg-blue-500 text-black rounded hover:bg-blue-600" onclick="addPencemaranAir()">
                    Tambah Pencemaran Air
                </button>
            </div>

            <!-- Pencemaran Udara -->
            <div class="mb-6">
                <h3 class="px-4 text-lg font-medium mb-4">3. Biaya Pencemaran Udara</h3>
                <div id="pencemaran-udara-container">
                    <div class="border p-4 rounded mb-4 relative">
                        <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700" onclick="deleteItem(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kerugian</label>
                                <input type="text" name="udara_jenis_kerugian[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Dasar Perhitungan</label>
                                <textarea name="udara_dasar_perhitungan[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Rusak Berat (RB)</label>
                                <input type="number" name="udara_rb[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Rusak Sedang (RS)</label>
                                <input type="number" name="udara_rs[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Rusak Ringan (RR)</label>
                                <input type="number" name="udara_rr[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="mt-2 px-4 py-2 bg-blue-500 text-black rounded hover:bg-blue-600" onclick="addPencemaranUdara()">
                    Tambah Pencemaran Udara
                </button>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-green-500 text-black rounded hover:bg-green-600">
                Simpan Data
            </button>
        </div>
    </form>
</div>

@endsection

@push('script')
<script>
    function createDamageLine(type) {
        const template = document.querySelector(`#ekosistem-${type}-container > div`).cloneNode(true);
        // Reset input values
        template.querySelectorAll('input').forEach(input => input.value = '');
        return template;
    }

    function createLossLine(type) {
        const template = document.querySelector(`#${type}-container > div`).cloneNode(true);
        // Reset input values
        template.querySelectorAll('input').forEach(input => input.value = '');
        template.querySelectorAll('textarea').forEach(textarea => textarea.value = '');
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
            item.querySelectorAll('textarea').forEach(textarea => textarea.value = '');
        }
    }

    function addEkosistemDarat() {
        const container = document.getElementById('ekosistem-darat-container');
        container.appendChild(createDamageLine('darat'));
    }

    function addEkosistemLaut() {
        const container = document.getElementById('ekosistem-laut-container');
        container.appendChild(createDamageLine('laut'));
    }

    function addEkosistemUdara() {
        const container = document.getElementById('ekosistem-udara-container');
        container.appendChild(createDamageLine('udara'));
    }

    function addJasaLingkungan() {
        const container = document.getElementById('jasa-lingkungan-container');
        container.appendChild(createLossLine('jasa-lingkungan'));
    }

    function addPencemaranAir() {
        const container = document.getElementById('pencemaran-air-container');
        container.appendChild(createLossLine('pencemaran-air'));
    }

    function addPencemaranUdara() {
        const container = document.getElementById('pencemaran-udara-container');
        container.appendChild(createLossLine('pencemaran-udara'));
    }
</script>
@endpush