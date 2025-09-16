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
    <p class="fw-bold">Format 8: Sektor Listrik</p> 

    <form method="POST" action="{{ route('forms.form4.store-format8') }}">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
        
            <table class="table table-bordered">
                <tr>
                    <td style="width: 50%">NAMA KAMPUNG: <input type="text" class="form-control" name="nama_kampung" required value="{{ old('nama_kampung', $data->nama_kampung ?? '') }}"></td>
                    <td>NAMA DISTRIK: <input type="text" class="form-control" name="nama_distrik" required value="{{ old('nama_distrik', $data->nama_distrik ?? '') }}"></td>
                </tr>
            </table>        
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle" style="width: 100%;">
                    <thead>
                        <tr>
                            <th rowspan="2">Uraian</th>
                            <th rowspan="2">Komponen</th>
                            <th colspan="2">Jumlah Kerusakan</th>
                            <th rowspan="2">Harga Satuan (Rp)</th>
                        </tr>
                        <tr>
                            <th>Satuan</th>
                            <th>Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="fw-bold bg-secondary text-white"><td colspan="5">PERKIRAAN KERUSAKAN</td></tr>
                        <tr>
                            <td>
                                SISTEM TRANSMISI DAN DISTRIBUSI
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>KABEL (meter)</td>
                            <td><input type="number" name="kabel_unit" class="form-control" value="0" min="0" step="any"></td>
                            <td><input type="number" name="kabel_harga_satuan" class="form-control" value="0" min="0" step="any"></td>
                            <td><input type="number" name="kabel_jumlah" class="form-control" value="0" min="0" step="any" ></td>
                            
                        </tr>
                        <tr>
                            <td></td>
                            <td>TIANG</td>
                            <td><input type="number" name="tiang_unit" class="form-control" value="0" min="0" step="any"></td>
                            <td><input type="number" name="tiang_harga_satuan" class="form-control" value="0" min="0" step="any"></td>
                            <td><input type="number" name="tiang_jumlah" class="form-control" value="0" min="0" step="any" ></td>
                            
                        </tr>
                        <tr>
                            <td></td>
                            <td>GARDU/TRAFO</td>
                            <td><input type="number" name="trafo_unit" class="form-control" value="0" min="0" step="any"></td>
                            <td><input type="number" name="trafo_harga_satuan" class="form-control" value="0" min="0" step="any"></td>
                            <td><input type="number" name="trafo_jumlah" class="form-control" value="0" min="0" step="any" ></td>
                            
                        </tr>
                        <tr><td>SISTEM PEMBANGKITAN</td></tr>
                        <tr>
                            <td></td>
                            <td>PLTA</td>
                            <td><input type="number" name="plta_unit" class="form-control" value="0" min="0" step="any"></td>
                            <td><input type="number" name="plta_harga_satuan" class="form-control" value="0" min="0" step="any"></td>
                            <td><input type="number" name="plta_jumlah" class="form-control" value="0" min="0" step="any" ></td>
                            
                        </tr>
                        <tr>
                            <td></td>
                            <td>PLTU</td>
                            <td><input type="number" name="pltu_unit" class="form-control" value="0" min="0" step="any"></td>
                            <td><input type="number" name="pltu_harga_satuan" class="form-control" value="0" min="0" step="any"></td>
                            <td><input type="number" name="pltu_jumlah" class="form-control" value="0" min="0" step="any" ></td>
                            
                        </tr>
                        <tr>
                            <td></td>
                            <td>PLTD</td>
                            <td><input type="number" name="pltd_unit" class="form-control" value="0" min="0" step="any"></td>
                            <td><input type="number" name="pltd_harga_satuan" class="form-control" value="0" min="0" step="any"></td>
                            <td><input type="number" name="pltd_jumlah" class="form-control" value="0" min="0" step="any" ></td>
                            
                        </tr>
                        <tr>
                            <td></td>
                            <td>PEMBANGKIT LAIN-LAIN</td>
                            <td><input type="number" name="pembangkit_lain_unit" class="form-control" value="0" min="0" step="any"></td>
                            <td><input type="number" name="pembangkit_lain_harga_satuan" class="form-control" value="0" min="0" step="any"></td>
                            <td><input type="number" name="pembangkit_lain_jumlah" class="form-control" value="0" min="0" step="any" ></td>
                        </tr>
                        <tr><td>PEMULIHAN & DARURAT</td></tr>
                        <tr>
                            <td></td>
                            <td>Perkiraan Jangka Waktu Pemulihan (bulan)</td>
                            <td><input type="number" name="jangka_waktu_pemulihan_bulan" class="form-control" value="0" min="0" step="any"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>GENSET (unit)</td>
                            <td><input type="number" name="genset_unit" class="form-control" value="0" min="0" step="any"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Biaya Pengadaan</td>
                            <td><input type="number" name="genset_biaya_pengadaan" class="form-control" value="0" min="0" step="any"></td>

                        </tr>
                        <tr><td>PERKIRAAN KEHILANGAN/PENURUNAN PENDAPATAN</td></tr>
                        <tr>
                            <td></td>
                            <td>B. Permintaan Listrik Sebelum Bencana</td>
                            <td><input type="number" name="permintaan_listrik_sebelum_kwh" class="form-control" value="0" min="0" step="any"></td>
                            <td>kWh</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>C. Permintaan Listrik Pasca Bencana</td>
                            <td><input type="number" name="permintaan_listrik_pasca_kwh" class="form-control" value="0" min="0" step="any"></td>
                            <td>kWh</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>D. Tarif Listrik per kWh</td>
                            <td><input type="number" name="tarif_listrik_per_kwh" class="form-control" value="0" min="0" step="any"></td>
                            <td>Rp</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>E. Penurunan Pendapatan</td>
                            <td><input type="number" name="penurunan_pendapatan" class="form-control" value="0" min="0" step="any"></td>
                            <td>Rp</td>
                        </tr>
                        <tr><td>PERKIRAAN KENAIKAN BIAYA OPERASIONAL</td></tr>
                        <tr>
                            <td></td>
                            <td>B. Biaya Operasional Sebelum</td>
                            <td><input type="number" name="biaya_operasional_sebelum" class="form-control" value="0" min="0" step="any"></td>
                            <td>Rp</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>C. Biaya Operasional Pasca</td>
                            <td><input type="number" name="biaya_operasional_pasca" class="form-control" value="0" min="0" step="any"></td>
                            <td>Rp</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>D. Kenaikan Biaya Operasional</td>
                            <td><input type="number" name="kenaikan_biaya_operasional" class="form-control" value="0" min="0" step="any"></td>
                            <td>Rp</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        
        <div class="mt-3 text-center mb-5">
            <button type="submit" class="btn btn-primary px-4 py-2">Simpan Data</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const components = [
            { unit: 'kabel_unit', harga: 'kabel_harga_satuan', jumlah: 'kabel_jumlah' },
            { unit: 'tiang_unit', harga: 'tiang_harga_satuan', jumlah: 'tiang_jumlah' },
            { unit: 'trafo_unit', harga: 'trafo_harga_satuan', jumlah: 'trafo_jumlah' },
            { unit: 'plta_unit', harga: 'plta_harga_satuan', jumlah: 'plta_jumlah' },
            { unit: 'pltu_unit', harga: 'pltu_harga_satuan', jumlah: 'pltu_jumlah' },
            { unit: 'pltd_unit', harga: 'pltd_harga_satuan', jumlah: 'pltd_jumlah' },
            { unit: 'pembangkit_lain_unit', harga: 'pembangkit_lain_harga_satuan', jumlah: 'pembangkit_lain_jumlah' },
        ];
        function setupAutoCalculation(component) {
            const unitInput = document.querySelector(`[name="${component.unit}"]`);
            const hargaInput = document.querySelector(`[name="${component.harga}"]`);
            const jumlahInput = document.querySelector(`[name="${component.jumlah}"]`);
            function calculate() {
                const unit = parseFloat(unitInput.value) || 0;
                const harga = parseFloat(hargaInput.value) || 0;
                jumlahInput.value = unit * harga;
            }
            unitInput.addEventListener('input', calculate);
            hargaInput.addEventListener('input', calculate);
        }
        components.forEach(setupAutoCalculation);
    });
</script>
@endsection
