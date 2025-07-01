@extends('layouts.main')

@section('content')
<div class="container mt-4">    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 6: Sarana dan Prasarana Air Minum & Sanitasi</p>
    
    <form action="{{ route('forms.form4.store-format6') }}" method="POST">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">NAMA KAMPUNG</span>
                    <input type="text" class="form-control form-control-sm" name="nama_kampung" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <span class="input-group-text">NAMA DISTRIK</span>
                    <input type="text" class="form-control form-control-sm" name="nama_distrik" required>
                </div>
            </div>
        </div>

    <p><strong>A. Kerusakan Sarana Air Minum</strong></p>    <table class="table table-bordered text-center align-middle" style="border: 2px solid #000;">
        <thead>
            <tr>
                <th style="border: 1px solid #000;">Uraian</th>
                <th style="border: 1px solid #000;">Komponen</th>
                <th style="border: 1px solid #000;">Jumlah Kerusakan Unit</th>
                <th style="border: 1px solid #000;">Harga Satuan</th>
                <th style="border: 1px solid #000;">Total Biaya</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #000;">Sarana dan prasarana air minum</td> 
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td>  
                <td style="border: 1px solid #000;">Struktur Pengambilan Air</td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="struktur_air_jumlah" min="0" step="1"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="struktur_air_harga" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="struktur_air_total" min="0" readonly></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Instalasi Pemurnian Air</td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="instalasi_pemurnian_jumlah" min="0" step="1"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="instalasi_pemurnian_harga" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="instalasi_pemurnian_total" min="0" readonly></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Sistem Perpipaan</td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="perpipaan_jumlah" min="0" step="1"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="perpipaan_harga" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="perpipaan_total" min="0" readonly></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Sistem Penyimpanan</td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="penyimpanan_jumlah" min="0" step="1"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="penyimpanan_harga" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="penyimpanan_total" min="0" readonly></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Sumur</td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="sumur_jumlah" min="0" step="1"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="sumur_harga" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="sumur_total" min="0" readonly></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Lain lain</td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="mck_jumlah" min="0" step="1"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="mck_harga" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="mck_total" min="0" readonly></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;">Sistem Sanitasi</td> 
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
                <td style="border: 1px solid #000;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Jaringan Pembuangan</td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="sanitasi_jumlah" min="0" step="1"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="sanitasi_harga" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="sanitasi_total" min="0" readonly></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Septik Tank</td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="drainase_jumlah" min="0" step="1"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="drainase_harga" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="drainase_total" min="0" readonly></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">Sistem pengumpulan limbah padat</td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="drainase_jumlah" min="0" step="1"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="drainase_harga" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="drainase_total" min="0" readonly></td>
            </tr>
            <tr>
                <td style="border: 1px solid #000;"></td> 
                <td style="border: 1px solid #000;">WC umum</td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="drainase_jumlah" min="0" step="1"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="drainase_harga" min="0"></td>
                <td style="border: 1px solid #000;"><input type="number" class="form-control form-control-sm" name="drainase_total" min="0" readonly></td>
            </tr>
        </tbody>
    </table>
{{-- Perkiraan Kerugian Sistem Air Minum --}}
    <table border="1" cellspacing="0" cellpadding="4" style="border-collapse: collapse; width: 100%; border: 2px solid #000;">
        <tr style="background-color: #e0e0e0;">
            <th colspan="6" style="text-align: left; border: 1px solid #000;">PERKIRAAN KERUGIAN<br><i>SISTEM AIR MINUM</i></th>
        </tr>
        <tr>
            <td colspan="6" style="border: 1px solid #000;">Kehilangan/Penurunan Pendapatan PDAM: ………………………/Rp/Bulan</td>
        </tr>
        <tr>
            <td rowspan="4" style="width: 25%; border: 1px solid #000;">Kenaikan Biaya</td>
            <td style="border: 1px solid #000;">Biaya pemurnian air</td>
            <td colspan="4" style="border: 1px solid #000;">Sebutkan dasar perhitungan:</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000;">Biaya distribusi air</td>
            <td colspan="4" style="border: 1px solid #000;">Sebutkan dasar perhitungan:</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000;">Biaya pembersihan sumur</td>
            <td colspan="4" style="border: 1px solid #000;">Sebutkan dasar perhitungan:</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000;">Biaya lain</td>
            <td colspan="4" style="border: 1px solid #000;">Sebutkan dasar perhitungan:</td>
        </tr>
        <tr style="background-color: #f0f0f0;">
            <th colspan="6" style="text-align: left; border: 1px solid #000;"><i>Sistem Sanitasi</i></th>
        </tr>
        <tr>
            <td colspan="6" style="border: 1px solid #000;">Penurunan Pendapatan Instansi Yang Bertanggungjawab Terhadap Sanitasi<br>
            ………../Rp/Bulan</td>
        </tr>
        <tr>
            <td rowspan="2" style="border: 1px solid #000;">Kenaikan Biaya</td>
            <td style="border: 1px solid #000;">Pembersihan jaringan pembuangan</td>
            <td colspan="4" style="border: 1px solid #000;">Sebutkan dasar perhitungan:</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000;">Kenaikan biaya bahan kimia</td>
            <td colspan="4" style="border: 1px solid #000;">Sebutkan dasar perhitungan:</td>
        </tr>
    </table>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
        <a href="{{ route('forms.form4.index', ['bencana_id' => request()->query('bencana_id')]) }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto calculate totals for air minum section
    const airComponents = [
        { jumlah: 'struktur_air_jumlah', harga: 'struktur_air_harga', total: 'struktur_air_total' },
        { jumlah: 'instalasi_pemurnian_jumlah', harga: 'instalasi_pemurnian_harga', total: 'instalasi_pemurnian_total' },
        { jumlah: 'perpipaan_jumlah', harga: 'perpipaan_harga', total: 'perpipaan_total' },
        { jumlah: 'penyimpanan_jumlah', harga: 'penyimpanan_harga', total: 'penyimpanan_total' },
        { jumlah: 'sumur_jumlah', harga: 'sumur_harga', total: 'sumur_total' },
        { jumlah: 'mck_jumlah', harga: 'mck_harga', total: 'mck_total' },
    ];
    
    // Auto calculate totals for sanitasi section
    const sanitasiComponents = [
        { jumlah: 'sanitasi_jumlah', harga: 'sanitasi_harga', total: 'sanitasi_total' },
        { jumlah: 'drainase_jumlah', harga: 'drainase_harga', total: 'drainase_total' },
    ];
    
    // Function to set up auto-calculation for a component
    function setupAutoCalculation(component) {
        const jumlahInput = document.querySelector(`[name="${component.jumlah}"]`);
        const hargaInput = document.querySelector(`[name="${component.harga}"]`);
        const totalInput = document.querySelector(`[name="${component.total}"]`);
        
        function calculateTotal() {
            const jumlah = parseFloat(jumlahInput.value) || 0;
            const harga = parseFloat(hargaInput.value) || 0;
            totalInput.value = jumlah * harga;
        }
        
        jumlahInput.addEventListener('input', calculateTotal);
        hargaInput.addEventListener('input', calculateTotal);
    }
    
    // Setup auto-calculation for all components
    airComponents.forEach(setupAutoCalculation);
    sanitasiComponents.forEach(setupAutoCalculation);
});
</script>
@endsection
