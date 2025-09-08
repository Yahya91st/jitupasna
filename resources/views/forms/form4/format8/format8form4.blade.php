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
<div class="container-fluid mt-4">
    <h5 class="text-center fw-bold">Formulir 04<br>Pengumpulan Data Sektor</h5>
    <h4 class="mb-3">Format 8. Pengumpulan Data Sektor Listrik</h4>

    <form method="POST" action="{{ route('forms.form4.store-format8') }}">
        @csrf
        <input type="hidden" name="bencana_id" value="{{ request()->bencana_id }}">
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Informasi Lokasi</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6 col-sm-12">
                        <label for="nama_kampung" class="form-label">Nama Kampung:</label>
                        <input type="text" class="form-control responsive-input" id="nama_kampung" name="nama_kampung" required>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="nama_distrik" class="form-label">Nama Distrik:</label>
                        <input type="text" class="form-control responsive-input" id="nama_distrik" name="nama_distrik" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Perkiraan Kerusakan Infrastruktur Listrik</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle" style="width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>Uraian</th>
                                <th>Unit</th>
                                <th>Harga Satuan (Rp)</th>
                                <th>Jumlah (Rp)</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="fw-bold bg-light"><td colspan="5">SISTEM TRANSMISI DAN DISTRIBUSI</td></tr>
                            <tr>
                                <td>KABEL (meter)</td>
                                <td><input type="number" name="kabel_unit" class="form-control" value="0"></td>
                                <td><input type="number" name="kabel_harga_satuan" class="form-control" value="0"></td>
                                <td><input type="number" name="kabel_jumlah" class="form-control" value="0" readonly></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>TIANG</td>
                                <td><input type="number" name="tiang_unit" class="form-control" value="0"></td>
                                <td><input type="number" name="tiang_harga_satuan" class="form-control" value="0"></td>
                                <td><input type="number" name="tiang_jumlah" class="form-control" value="0" readonly></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>GARDU/TRAFO</td>
                                <td><input type="number" name="trafo_unit" class="form-control" value="0"></td>
                                <td><input type="number" name="trafo_harga_satuan" class="form-control" value="0"></td>
                                <td><input type="number" name="trafo_jumlah" class="form-control" value="0" readonly></td>
                                <td></td>
                            </tr>
                            <tr class="fw-bold bg-light"><td colspan="5">SISTEM PEMBANGKITAN</td></tr>
                            <tr>
                                <td>PLTA</td>
                                <td><input type="number" name="plta_unit" class="form-control" value="0"></td>
                                <td><input type="number" name="plta_harga_satuan" class="form-control" value="0"></td>
                                <td><input type="number" name="plta_jumlah" class="form-control" value="0" readonly></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>PLTU</td>
                                <td><input type="number" name="pltu_unit" class="form-control" value="0"></td>
                                <td><input type="number" name="pltu_harga_satuan" class="form-control" value="0"></td>
                                <td><input type="number" name="pltu_jumlah" class="form-control" value="0" readonly></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>PLTD</td>
                                <td><input type="number" name="pltd_unit" class="form-control" value="0"></td>
                                <td><input type="number" name="pltd_harga_satuan" class="form-control" value="0"></td>
                                <td><input type="number" name="pltd_jumlah" class="form-control" value="0" readonly></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>PEMBANGKIT LAIN-LAIN</td>
                                <td><input type="number" name="pembangkit_lain_unit" class="form-control" value="0"></td>
                                <td><input type="number" name="pembangkit_lain_harga_satuan" class="form-control" value="0"></td>
                                <td><input type="number" name="pembangkit_lain_jumlah" class="form-control" value="0" readonly></td>
                                <td><input type="text" name="pembangkit_lain_keterangan" class="form-control" placeholder="Keterangan"></td>
                            </tr>
                            <tr class="fw-bold bg-light"><td colspan="5">PEMULIHAN & DARURAT</td></tr>
                            <tr>
                                <td>Perkiraan Jangka Waktu Pemulihan (bulan)</td>
                                <td colspan="4"><input type="number" name="jangka_waktu_pemulihan_bulan" class="form-control" value="0"></td>
                            </tr>
                            <tr>
                                <td>GENSET (unit)</td>
                                <td><input type="number" name="genset_unit" class="form-control" value="0"></td>
                                <td>Biaya Pengadaan</td>
                                <td><input type="number" name="genset_biaya_pengadaan" class="form-control" value="0"></td>
                                <td></td>
                            </tr>
                            <tr class="fw-bold bg-light"><td colspan="5">PERKIRAAN KEHILANGAN/PENURUNAN PENDAPATAN</td></tr>
                            <tr>
                                <td>Permintaan Listrik Sebelum Bencana (kWh)</td>
                                <td colspan="4"><input type="number" name="permintaan_listrik_sebelum_kwh" class="form-control" value="0"></td>
                            </tr>
                            <tr>
                                <td>Permintaan Listrik Pasca Bencana (kWh)</td>
                                <td colspan="4"><input type="number" name="permintaan_listrik_pasca_kwh" class="form-control" value="0"></td>
                            </tr>
                            <tr>
                                <td>Tarif Listrik per kWh (Rp)</td>
                                <td colspan="4"><input type="number" name="tarif_listrik_per_kwh" class="form-control" value="0"></td>
                            </tr>
                            <tr>
                                <td>Penurunan Pendapatan (Rp)</td>
                                <td colspan="4"><input type="number" name="penurunan_pendapatan" class="form-control" value="0"></td>
                            </tr>
                            <tr class="fw-bold bg-light"><td colspan="5">PERKIRAAN KENAIKAN BIAYA OPERASIONAL</td></tr>
                            <tr>
                                <td>Biaya Operasional Sebelum (Rp)</td>
                                <td colspan="4"><input type="number" name="biaya_operasional_sebelum" class="form-control" value="0"></td>
                            </tr>
                            <tr>
                                <td>Biaya Operasional Pasca (Rp)</td>
                                <td colspan="4"><input type="number" name="biaya_operasional_pasca" class="form-control" value="0"></td>
                            </tr>
                            <tr>
                                <td>Kenaikan Biaya Operasional (Rp)</td>
                                <td colspan="4"><input type="number" name="kenaikan_biaya_operasional" class="form-control" value="0"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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
