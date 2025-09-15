@extends('layouts.main')

@section('content')
<style>
    /* Kurangi padding pada tabel dan input agar lebih kompak */
    .table th, .table td {
        padding: 0.25rem 0.3rem !important;
    }
    .table input.form-control {
        padding: 0.15rem 0.3rem !important;
        font-size: 0.95rem;
    }
</style>

<div class="container mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <p class="fw-bold">Format 10: Pengumpulan Data Sektor Pertanian & Perkebunan</p>
     
    <form action="{{ route('forms.form4.store-format10') }}" method="POST">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ $bencana->id ?? request()->query('bencana_id') }}">
        <table class="table table-bordered">
            <tr>
                <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
            </tr>
        </table>

        

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle fw-bold" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-white">.<br>.</th>
                        <th rowspan="2" class="align-middle" style="width: 120px;">Jenis Tanaman</th>
                        <th rowspan="2" class="text-center">Luasan Terdampak (Ha)</th>
                        <th rowspan="2" class="text-center">Umur Tanaman Saat Bencana</th>
                        <th colspan="2" rowspan="2" class="text-center">Harga Panen per Ha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" class="bg-secondary text-white">PERKIRAAN KERUSAKAN</td>
                    </tr>
                    <tr>
                        <td rowspan="6" class="align-middle">Kerusakan Lahan Pertanian</td>
                        <td><input type="text" name="jenis_tanaman_[0]" class="form-control" placeholder="Jenis Tanaman"></td>
                        <td><input type="number" name="luas_terdampak_[0]" class="form-control" step="0.01"></td>
                        <td><input type="text" name="umur_tanaman_[0]" class="form-control"></td>
                        <td colspan="2"><input type="number" name="harga_panen_[0]" class="form-control"></td>
                    </tr>
                    @for ($i = 0; $i < 5; $i++)
                    <tr>
                        <td><input type="text" name="jenis_tanaman_{{ $i }}" class="form-control" placeholder="Jenis Tanaman"></td>
                        <td><input type="number" name="luas_terdampak_{{ $i }}" class="form-control" step="0.01"></td>
                        <td><input type="text" name="umur_tanaman_{{ $i }}" class="form-control"></td>
                        <td colspan="2"><input type="number" name="harga_panen_{{ $i }}" class="form-control"></td>
                    </tr>
                    @endfor
                    <tr>
                    <td rowspan="4" class="align-middle">Kerusakan Bibit dan Tanaman</td>
                    @for ($i = 0; $i <= 3; $i++)
                        <td><input type="text" name="bibit_jenis_{{ $i }}" placeholder="Jenis Tanaman" class="form-control"></td>
                        <td><input type="number" name="bibit_luas_{{ $i }}" class="form-control" step="0.01"></td>
                        <td><input type="text" name="bibit_umur_{{ $i }}" class="form-control"></td>
                        <td colspan="2"><input type="number" name="bibit_harga_{{ $i }}" class="form-control"></td>
                    </tr>
                    <tr>
                        @endfor
                    </tr>
                    <tr >
                        <td></td>
                        <td>Jenis Jaringan</td>
                        <td>Luasan Kerusakan</td>
                        <td>Luas Tanam Terdampak</td>
                        <td colspan="2" >Perkiraan Biaya Perbaikan</td>
                    </tr>
                    <tr>
                        <td rowspan="3">Sarana Irigasi</td>
                        <td>Jaringan Primer</td>
                        <td><input type="text" class="form-control form-control-sm" name="sarana_irigasi_primer_luas_rusak"></td>
                        <td><input type="number" class="form-control form-control-sm calculate-crop-damage" name="sarana_irigasi_primer_luas_tanam_terdampak" id="perkebunan_harga"></td>
                        <td colspan="2"><input type="number" class="form-control form-control-sm" name="sarana_irigasi_primer_biaya" id="perkebunan_total" ></td>
                    </tr>
                    <tr>
                        <td>Jaringan Tersier</td>
                        <td><input type="text" class="form-control form-control-sm" name="sarana_irigasi_tersier_luas_rusak"></td>
                        <td><input type="number" class="form-control form-control-sm calculate-crop-damage" name="sarana_irigasi_tersier_luas_tanam_terdampak" id="perkebunan_harga"></td>
                        <td colspan="2"><input type="number" class="form-control form-control-sm" name="sarana_irigasi_tersier_biaya" id="perkebunan_total" ></td>
                    </tr>
                    <tr>
                        <td>Jaringan Irigasi Desa</td>
                        <td><input type="text" class="form-control form-control-sm" name="sarana_irigasi_desa_luas_rusak"></td>
                        <td><input type="number" class="form-control form-control-sm calculate-crop-damage" name="sarana_irigasi_desa_luas_tanam_terdampak" id="perkebunan_harga"></td>
                        <td colspan="2"><input type="number" class="form-control form-control-sm" name="sarana_irigasi_desa_biaya" id="perkebunan_total" ></td>
                    </tr>
                    <tr>
                        <td>Mesin dan Bangunan</td>
                        <td>Harga Satuan</td>
                        <td>Rusak Berat</td>
                        <td>Rusak Sedang</td>
                        <td colspan="2">Rusak Ringan</td>
                    </tr>
                    <tr>
                        <td style="padding: 0;">
                            Mesin-mesin pertanian <br> dan peralatan
                        </td>                
                        <td><input type="text" class="form-control form-control-sm" name="mesin_harga_satuan_[0]"></td>
                        <td><input type="text" class="form-control form-control-sm" name="mesin_rusak_berat_[0]"></td>
                        <td><input type="text" class="form-control form-control-sm" name="mesin_rusak_sedang_[0]"></td>
                        <td colspan="2" ><input type="text" class="form-control form-control-sm" name="mesin_rusak_ringan_[0]"></td>
                    </tr>
                    @for ($i = 1; $i < 4; $i++)      
                    <tr>
                        <td></td>
                        <td><input type="text" class="form-control form-control-sm" name="mesin_harga_satuan_{{ $i }}"></td>
                        <td><input type="text" class="form-control form-control-sm" name="mesin_rusak_berat_{{ $i }}"></td>
                        <td><input type="text" class="form-control form-control-sm" name="mesin_rusak_sedang_{{ $i }}"></td>
                        <td colspan="2" ><input type="text" class="form-control form-control-sm" name="mesin_rusak_ringan_{{ $i }}"></td>
                    </tr>
                    @endfor
                    <tr>
                        <td style="padding: 0;">Kerusakan Gudang dan <br> Bangunan Lainnya</td>
                        <td><input type="text" class="form-control form-control-sm" name="gudang_harga_satuan_[0]"></td>
                        <td><input type="text" class="form-control form-control-sm" name="gudang_rusak_berat_[0]"></td>
                        <td><input type="text" class="form-control form-control-sm" name="gudang_rusak_sedang_[0]"></td>
                        <td colspan="2"><input type="text" class="form-control form-control-sm" name="gudang_rusak_ringan_[0]"></td>
                    </tr>
                    @for ($i = 1; $i < 4; $i++)            
                    <tr>
                        <td></td>
                        <td><input type="text" class="form-control form-control-sm" name="gudang_harga_satuan_{{ $i }}"></td>
                        <td><input type="text" class="form-control form-control-sm" name="gudang_rusak_berat_{{ $i }}"></td>
                        <td><input type="text" class="form-control form-control-sm" name="gudang_rusak_sedang_{{ $i }}"></td>
                        <td colspan="2"><input type="text" class="form-control form-control-sm" name="gudang_rusak_ringan_{{ $i }}"></td>
                    </tr>
                    @endfor
                    <tr>
                        <td>Produksi Yang Hilang Total</td>
                        <td>Jenis Tanaman</td>
                        <td>Luasan Tanaman</td>
                        <td >Produktifitas/Ha</td>
                        <td colspan="2">Harga Panen Per Kg</td>
                    </tr>
                    @for ($i = 0; $i < 6; $i++)
                    <tr>
                        <td><input type="number" name="produksi_hilang_nama_{{ $i }}" class="form-control"></td>
                        <td><input type="text" name="produksi_hilang_jenis_{{ $i }}" class="form-control"></td>
                        <td><input type="number" name="produksi_hilang_luas_{{ $i }}" class="form-control" step="0.01"></td>
                        <td><input type="number" name="produksi_hilang_produktivitas_{{ $i }}" class="form-control"></td>
                        <td colspan="2"><input type="number" name="produksi_hilang_harga_{{ $i }}" class="form-control"></td>
                    </tr>
                    @endfor
                    <tr>
                        <td>Penurunan Produksi</td>
                        <td>Jenis Tanaman</td>
                        <td>Luasan Tanaman</td>
                        <td>Selisih Penurunan Produktifitas</td>
                        <td>Harga Panen Per Kg</td>
                        <td style="padding:0; width: 120px; line-height: 1.1; text-align: center;">Jangka Waktu Penurunan Produktivitas</td>
                    </tr>           
                    @for ($i = 0; $i < 6; $i++)
                    <tr>
                        <td><input type="text" name="penurunan_nama_{{ $i }}" class="form-control"></td>
                        <td><input type="text" name="penurunan_jenis_{{ $i }}" class="form-control"></td>
                        <td><input type="number" name="penurunan_luas_{{ $i }}" class="form-control" step="0.01"></td>
                        <td><input type="number" name="penurunan_selisih_{{ $i }}" class="form-control"></td>
                        <td><input type="number" name="penurunan_harga_{{ $i }}" class="form-control"></td>
                        <td><input type="number" name="penurunan_waktu_{{ $i }}" class="form-control"></td>
                    </tr>
                    @endfor
                    <tr>
                        <th>Kenaikan Ongkos Produksi</th>
                        <th>Jenis Tanaman</th>
                        <th>Luasan Tanaman</th>
                        <th>Selisih Kenaikan Ongkos Produksi</th>
                    </tr>
                    @for ($i = 0; $i <= 3; $i++)
                    <tr>
                        <td><input type="number" class="form-control form-control-sm" name="kenaikan_ongkos_produksi_nama_{{ $i }}"></td>
                        <td><input type="number" class="form-control form-control-sm" name="kenaikan_ongkos_produksi_jenis_{{ $i }}"></td>
                        <td><input type="number" class="form-control form-control-sm" name="kenaikan_ongkos_produksi_luas_{{ $i }}"></td>
                        <td><input type="number" class="form-control form-control-sm" name="kenaikan_ongkos_produksi_selisih_{{ $i }}"></td>
                    </tr>   
                        @endfor
                </tbody>
            </table>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('forms.form4.index', ['bencana_id' => request()->query('bencana_id')]) }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    // Calculate crop damage
    $('.calculate-crop-damage').on('input', function() {
        const cropType = $(this).attr('name').split('_')_[0];
        const luas = parseFloat($('#' + cropType + '_luas').val()) || 0;
        const harga = parseFloat($('#' + cropType + '_harga').val()) || 0;
        $('#' + cropType + '_total').val(luas * harga);
    });

    // Calculate irrigation damage
    $('.calculate-irrigation').on('input', function() {
        const rusakBerat = parseFloat($('#irigasi_rusak_berat').val()) || 0;
        const rusakSedang = parseFloat($('#irigasi_rusak_sedang').val()) || 0;
        const rusakRingan = parseFloat($('#irigasi_rusak_ringan').val()) || 0;
        const harga = parseFloat($('#irigasi_harga').val()) || 0;
        $('#irigasi_total').val((rusakBerat + rusakSedang + rusakRingan) * harga);
    });

    // Calculate equipment damage
    $('.calculate-equipment').on('input', function() {
        const rusakBerat = parseFloat($('#peralatan_rusak_berat').val()) || 0;
        const rusakSedang = parseFloat($('#peralatan_rusak_sedang').val()) || 0;
        const rusakRingan = parseFloat($('#peralatan_rusak_ringan').val()) || 0;
        const harga = parseFloat($('#peralatan_harga').val()) || 0;
        $('#peralatan_total').val((rusakBerat + rusakSedang + rusakRingan) * harga);
    });

    // Calculate building damage
    $('.calculate-building').on('input', function() {
        const rusakBerat = parseFloat($('#bangunan_rusak_berat').val()) || 0;
        const rusakSedang = parseFloat($('#bangunan_rusak_sedang').val()) || 0;
        const rusakRingan = parseFloat($('#bangunan_rusak_ringan').val()) || 0;
        const harga = parseFloat($('#bangunan_harga').val()) || 0;
        $('#bangunan_total').val((rusakBerat + rusakSedang + rusakRingan) * harga);
    });
});
</script>
@endsection

