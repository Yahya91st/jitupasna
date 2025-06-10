@extends('layouts.main')

@section('title', 'Format 7: Sektor Transportasi')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Format 7: Pengumpulan Data Sektor Transportasi</h1>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Pengumpulan Data Sektor Transportasi
        </div>
        <div class="card-body">
            <form action="{{ route('forms.form4.store-format7') }}" method="POST" id="formTransportasi">
                @csrf
                <input type="hidden" name="bencana_id" value="{{ $bencana->id }}">
                
                <!-- PERKIRAAN KERUSAKAN -->
                <h4 class="mb-3">I. PERKIRAAN KERUSAKAN</h4>
                
                <!-- A. JALAN -->
                <h5 class="mb-3">A. JALAN</h5>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-light">
                            <tr class="text-center">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Ruas Jalan</th>
                                <th rowspan="2">Jenis Jalan (Nasional/Kab/Kota/Desa)</th>
                                <th rowspan="2">Jenis Jalan (Aspal/Batu/Tanah)</th>
                                <th colspan="3">Jumlah Kerusakan (Km)</th>
                                <th rowspan="2">Harga Satuan per M<sup>2</sup> (Rp)</th>
                                <th rowspan="2">Perkiraan Biaya Perbaikan (Rp)</th>
                                <th rowspan="2" class="align-middle">Aksi</th>
                            </tr>
                            <tr class="text-center">
                                <th>BERAT</th>
                                <th>SEDANG</th>
                                <th>RINGAN</th>
                            </tr>
                        </thead>
                        <tbody id="jalanTableBody">
                            <tr id="jalanRow0">
                                <td class="text-center">1</td>
                                <td><input type="text" name="jalan_ruas[]" class="form-control form-control-sm"></td>
                                <td>
                                    <select name="jalan_jenis_status[]" class="form-control form-control-sm">
                                        <option value="">Pilih Jenis</option>
                                        <option value="Nasional">Nasional</option>
                                        <option value="Kabupaten">Kabupaten</option>
                                        <option value="Kota">Kota</option>
                                        <option value="Desa">Desa</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="jalan_jenis_material[]" class="form-control form-control-sm">
                                        <option value="">Pilih Material</option>
                                        <option value="Aspal">Aspal</option>
                                        <option value="Batu">Batu</option>
                                        <option value="Tanah">Tanah</option>
                                    </select>
                                </td>
                                <td><input type="number" step="0.01" name="jalan_kerusakan_berat[]" class="form-control form-control-sm calculate-jalan"></td>
                                <td><input type="number" step="0.01" name="jalan_kerusakan_sedang[]" class="form-control form-control-sm calculate-jalan"></td>
                                <td><input type="number" step="0.01" name="jalan_kerusakan_ringan[]" class="form-control form-control-sm calculate-jalan"></td>
                                <td><input type="number" name="jalan_harga_satuan[]" class="form-control form-control-sm calculate-jalan"></td>
                                <td><input type="number" name="jalan_biaya_perbaikan[]" class="form-control form-control-sm" readonly></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'jalan')">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="10">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="addRow('jalan')">Tambah Baris</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <!-- B. JEMBATAN -->
                <h5 class="mb-3">B. JEMBATAN</h5>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-light">
                            <tr class="text-center">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama Jembatan</th>
                                <th rowspan="2">Jenis Jembatan (Nasional/Kab/Kota/Desa)</th>
                                <th rowspan="2">Jenis Jembatan (Beton/Baja/Kayu)</th>
                                <th colspan="3">Jumlah Kerusakan (Unit)</th>
                                <th rowspan="2">Harga Satuan per Unit (Rp)</th>
                                <th rowspan="2">Perkiraan Biaya Perbaikan (Rp)</th>
                                <th rowspan="2" class="align-middle">Aksi</th>
                            </tr>
                            <tr class="text-center">
                                <th>BERAT</th>
                                <th>SEDANG</th>
                                <th>RINGAN</th>
                            </tr>
                        </thead>
                        <tbody id="jembatanTableBody">
                            <tr id="jembatanRow0">
                                <td class="text-center">1</td>
                                <td><input type="text" name="jembatan_nama[]" class="form-control form-control-sm"></td>
                                <td>
                                    <select name="jembatan_jenis_status[]" class="form-control form-control-sm">
                                        <option value="">Pilih Jenis</option>
                                        <option value="Nasional">Nasional</option>
                                        <option value="Kabupaten">Kabupaten</option>
                                        <option value="Kota">Kota</option>
                                        <option value="Desa">Desa</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="jembatan_jenis_material[]" class="form-control form-control-sm">
                                        <option value="">Pilih Material</option>
                                        <option value="Beton">Beton</option>
                                        <option value="Baja">Baja</option>
                                        <option value="Kayu">Kayu</option>
                                    </select>
                                </td>
                                <td><input type="number" step="1" name="jembatan_kerusakan_berat[]" class="form-control form-control-sm calculate-jembatan"></td>
                                <td><input type="number" step="1" name="jembatan_kerusakan_sedang[]" class="form-control form-control-sm calculate-jembatan"></td>
                                <td><input type="number" step="1" name="jembatan_kerusakan_ringan[]" class="form-control form-control-sm calculate-jembatan"></td>
                                <td><input type="number" name="jembatan_harga_satuan[]" class="form-control form-control-sm calculate-jembatan"></td>
                                <td><input type="number" name="jembatan_biaya_perbaikan[]" class="form-control form-control-sm" readonly></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'jembatan')">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="10">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="addRow('jembatan')">Tambah Baris</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <!-- C. KERUSAKAN KENDARAAN -->
                <h5 class="mb-3">C. KERUSAKAN KENDARAAN</h5>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-light">
                            <tr class="text-center">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Jenis Kendaraan</th>
                                <th rowspan="2">Moda (Darat/Laut)</th>
                                <th colspan="3">Jumlah Kerusakan (Unit)</th>
                                <th rowspan="2">Harga Satuan (Rp)</th>
                                <th rowspan="2">Perkiraan Biaya Kerusakan (Rp)</th>
                                <th rowspan="2" class="align-middle">Aksi</th>
                            </tr>
                            <tr class="text-center">
                                <th>BERAT</th>
                                <th>SEDANG</th>
                                <th>RINGAN</th>
                            </tr>
                        </thead>
                        <tbody id="kendaraanTableBody">
                            <tr id="kendaraanRow0">
                                <td class="text-center">1</td>
                                <td><input type="text" name="kendaraan_jenis[]" class="form-control form-control-sm"></td>
                                <td>
                                    <select name="kendaraan_moda[]" class="form-control form-control-sm">
                                        <option value="">Pilih Moda</option>
                                        <option value="Darat">Darat</option>
                                        <option value="Laut">Laut</option>
                                    </select>
                                </td>
                                <td><input type="number" name="kendaraan_rusak_berat[]" class="form-control form-control-sm calculate-kendaraan"></td>
                                <td><input type="number" name="kendaraan_rusak_sedang[]" class="form-control form-control-sm calculate-kendaraan"></td>
                                <td><input type="number" name="kendaraan_rusak_ringan[]" class="form-control form-control-sm calculate-kendaraan"></td>
                                <td><input type="number" name="kendaraan_harga_satuan[]" class="form-control form-control-sm calculate-kendaraan"></td>
                                <td><input type="number" name="kendaraan_biaya_kerusakan[]" class="form-control form-control-sm" readonly></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'kendaraan')">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="9">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="addRow('kendaraan')">Tambah Baris</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <!-- KERUSAKAN PRASARANA TRANSPORTASI -->
                <h4 class="mb-3">II. KERUSAKAN PRASARANA TRANSPORTASI</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-light">
                            <tr class="text-center">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Jenis Prasarana</th>
                                <th rowspan="2">Tipe</th>
                                <th rowspan="2">Luas (m²)</th>
                                <th colspan="3">Tingkat Kerusakan</th>
                                <th rowspan="2">Harga Satuan (Rp/m²)</th>
                                <th rowspan="2">Perkiraan Biaya Kerusakan (Rp)</th>
                                <th rowspan="2" class="align-middle">Aksi</th>
                            </tr>
                            <tr class="text-center">
                                <th>BERAT</th>
                                <th>SEDANG</th>
                                <th>RINGAN</th>
                            </tr>
                        </thead>
                        <tbody id="prasaranaTableBody">
                            <tr id="prasaranaRow0">
                                <td class="text-center">1</td>
                                <td>
                                    <select name="prasarana_jenis[]" class="form-control form-control-sm">
                                        <option value="">Pilih Jenis</option>
                                        <option value="Terminal">Terminal</option>
                                        <option value="Dermaga">Dermaga</option>
                                        <option value="Bandara">Bandara</option>
                                    </select>
                                </td>
                                <td><input type="text" name="prasarana_tipe[]" class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.01" name="prasarana_luas[]" class="form-control form-control-sm"></td>
                                <td><input type="number" step="0.01" name="prasarana_rusak_berat[]" class="form-control form-control-sm calculate-prasarana" placeholder="%"></td>
                                <td><input type="number" step="0.01" name="prasarana_rusak_sedang[]" class="form-control form-control-sm calculate-prasarana" placeholder="%"></td>
                                <td><input type="number" step="0.01" name="prasarana_rusak_ringan[]" class="form-control form-control-sm calculate-prasarana" placeholder="%"></td>
                                <td><input type="number" name="prasarana_harga_satuan[]" class="form-control form-control-sm calculate-prasarana"></td>
                                <td><input type="number" name="prasarana_biaya_kerusakan[]" class="form-control form-control-sm" readonly></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'prasarana')">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="10">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="addRow('prasarana')">Tambah Baris</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <!-- KEHILANGAN PENDAPATAN SEKTOR TRANSPORTASI -->
                <h4 class="mb-3">III. KEHILANGAN PENDAPATAN SEKTOR TRANSPORTASI</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-light">
                            <tr class="text-center">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Jenis</th>
                                <th rowspan="2">A. Pendapatan per Hari (Rp)</th>
                                <th rowspan="2">B. Jumlah Angkutan yang Terkena Dampak (Buah)</th>
                                <th rowspan="2">C. Jumlah Hari Terhenti</th>
                                <th rowspan="2">Total Kehilangan Pendapatan (Rp)</th>
                                <th rowspan="2" class="align-middle">Aksi</th>
                            </tr>
                            <tr class="text-center">
                                <!-- Row untuk header kategori -->
                            </tr>
                        </thead>
                        <tbody id="pendapatanTableBody">
                            <tr id="pendapatanRow0">
                                <td class="text-center">1</td>
                                <td>
                                    <select name="pendapatan_jenis[]" class="form-control form-control-sm">
                                        <option value="">Pilih Jenis</option>
                                        <option value="Angkutan Darat">Angkutan Darat</option>
                                        <option value="Angkutan Laut/Sungai">Angkutan Laut/Sungai</option>
                                        <option value="Angkutan Udara">Angkutan Udara</option>
                                        <option value="Terminal">Terminal</option>
                                        <option value="Dermaga">Dermaga</option>
                                        <option value="Bandara">Bandara</option>
                                    </select>
                                </td>
                                <td><input type="number" name="pendapatan_per_hari[]" class="form-control form-control-sm calculate-pendapatan"></td>
                                <td><input type="number" name="pendapatan_jumlah_terdampak[]" class="form-control form-control-sm calculate-pendapatan"></td>
                                <td><input type="number" name="pendapatan_jumlah_hari[]" class="form-control form-control-sm calculate-pendapatan"></td>
                                <td><input type="number" name="pendapatan_total_kehilangan[]" class="form-control form-control-sm" readonly></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'pendapatan')">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="addRow('pendapatan')">Tambah Baris</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <!-- KENAIKAN BIAYA OPERASIONAL KENDARAAN AKIBAT JALAN RUSAK -->
                <h4 class="mb-3">IV. KENAIKAN BIAYA OPERASIONAL KENDARAAN AKIBAT JALAN RUSAK</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-light">
                            <tr class="text-center">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Jenis Kendaraan</th>
                                <th rowspan="2">A. Biaya Operasional Sebelum Bencana (Rp/km)</th>
                                <th rowspan="2">B. Biaya Operasional Setelah Bencana (Rp/km)</th>
                                <th rowspan="2">C. Jumlah Kendaraan Terdampak</th>
                                <th rowspan="2">D. Perkiraan Jarak Tempuh (km)</th>
                                <th rowspan="2">E. Perkiraan Durasi (hari)</th>
                                <th rowspan="2">Total Kenaikan Biaya (Rp)</th>
                                <th rowspan="2" class="align-middle">Aksi</th>
                            </tr>
                            <tr class="text-center">
                                <!-- Row untuk header kategori -->
                            </tr>
                        </thead>
                        <tbody id="operasionalTableBody">
                            <tr id="operasionalRow0">
                                <td class="text-center">1</td>
                                <td><input type="text" name="operasional_jenis_kendaraan[]" class="form-control form-control-sm"></td>
                                <td><input type="number" name="operasional_biaya_sebelum[]" class="form-control form-control-sm calculate-operasional"></td>
                                <td><input type="number" name="operasional_biaya_sesudah[]" class="form-control form-control-sm calculate-operasional"></td>
                                <td><input type="number" name="operasional_jumlah_kendaraan[]" class="form-control form-control-sm calculate-operasional"></td>
                                <td><input type="number" name="operasional_jarak_tempuh[]" class="form-control form-control-sm calculate-operasional"></td>
                                <td><input type="number" name="operasional_durasi[]" class="form-control form-control-sm calculate-operasional"></td>
                                <td><input type="number" name="operasional_total_kenaikan[]" class="form-control form-control-sm" readonly></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'operasional')">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="9">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="addRow('operasional')">Tambah Baris</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <!-- BIAYA PEMASANGAN INFRASTRUKTUR DARURAT -->
                <h4 class="mb-3">V. BIAYA PEMASANGAN INFRASTRUKTUR DARURAT</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-light">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Jenis Infrastruktur</th>
                                <th>A. Jumlah Unit Terdampak</th>
                                <th>B. Biaya Per Unit (Rp)</th>
                                <th>Total Biaya (Rp)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="infrastrukturTableBody">
                            <tr id="infrastrukturRow0">
                                <td class="text-center">1</td>
                                <td><input type="text" name="infrastruktur_jenis[]" class="form-control form-control-sm" placeholder="Misalnya: Jembatan Bailey"></td>
                                <td><input type="number" name="infrastruktur_jumlah_unit[]" class="form-control form-control-sm calculate-infrastruktur"></td>
                                <td><input type="number" name="infrastruktur_biaya_per_unit[]" class="form-control form-control-sm calculate-infrastruktur"></td>
                                <td><input type="number" name="infrastruktur_total_biaya[]" class="form-control form-control-sm" readonly></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'infrastruktur')">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="addRow('infrastruktur')">Tambah Baris</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <!-- Tombol Submit -->
                <div class="d-flex justify-content-end my-4">
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Fungsi untuk menambah baris pada tabel dinamis
    function addRow(tableType) {
        let tbody, template, rowCount;
        
        switch(tableType) {
            case 'jalan':
                tbody = document.getElementById('jalanTableBody');
                rowCount = tbody.rows.length;
                template = `
                    <tr id="jalanRow${rowCount}">
                        <td class="text-center">${rowCount + 1}</td>
                        <td><input type="text" name="jalan_ruas[]" class="form-control form-control-sm"></td>
                        <td>
                            <select name="jalan_jenis_status[]" class="form-control form-control-sm">
                                <option value="">Pilih Jenis</option>
                                <option value="Nasional">Nasional</option>
                                <option value="Kabupaten">Kabupaten</option>
                                <option value="Kota">Kota</option>
                                <option value="Desa">Desa</option>
                            </select>
                        </td>
                        <td>
                            <select name="jalan_jenis_material[]" class="form-control form-control-sm">
                                <option value="">Pilih Material</option>
                                <option value="Aspal">Aspal</option>
                                <option value="Batu">Batu</option>
                                <option value="Tanah">Tanah</option>
                            </select>
                        </td>
                        <td><input type="number" step="0.01" name="jalan_kerusakan_berat[]" class="form-control form-control-sm calculate-jalan"></td>
                        <td><input type="number" step="0.01" name="jalan_kerusakan_sedang[]" class="form-control form-control-sm calculate-jalan"></td>
                        <td><input type="number" step="0.01" name="jalan_kerusakan_ringan[]" class="form-control form-control-sm calculate-jalan"></td>
                        <td><input type="number" name="jalan_harga_satuan[]" class="form-control form-control-sm calculate-jalan"></td>
                        <td><input type="number" name="jalan_biaya_perbaikan[]" class="form-control form-control-sm" readonly></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'jalan')">Hapus</button>
                        </td>
                    </tr>
                `;
                break;
                
            case 'jembatan':
                tbody = document.getElementById('jembatanTableBody');
                rowCount = tbody.rows.length;
                template = `
                    <tr id="jembatanRow${rowCount}">
                        <td class="text-center">${rowCount + 1}</td>
                        <td><input type="text" name="jembatan_nama[]" class="form-control form-control-sm"></td>
                        <td>
                            <select name="jembatan_jenis_status[]" class="form-control form-control-sm">
                                <option value="">Pilih Jenis</option>
                                <option value="Nasional">Nasional</option>
                                <option value="Kabupaten">Kabupaten</option>
                                <option value="Kota">Kota</option>
                                <option value="Desa">Desa</option>
                            </select>
                        </td>
                        <td>
                            <select name="jembatan_jenis_material[]" class="form-control form-control-sm">
                                <option value="">Pilih Material</option>
                                <option value="Beton">Beton</option>
                                <option value="Baja">Baja</option>
                                <option value="Kayu">Kayu</option>
                            </select>
                        </td>
                        <td><input type="number" step="1" name="jembatan_kerusakan_berat[]" class="form-control form-control-sm calculate-jembatan"></td>
                        <td><input type="number" step="1" name="jembatan_kerusakan_sedang[]" class="form-control form-control-sm calculate-jembatan"></td>
                        <td><input type="number" step="1" name="jembatan_kerusakan_ringan[]" class="form-control form-control-sm calculate-jembatan"></td>
                        <td><input type="number" name="jembatan_harga_satuan[]" class="form-control form-control-sm calculate-jembatan"></td>
                        <td><input type="number" name="jembatan_biaya_perbaikan[]" class="form-control form-control-sm" readonly></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'jembatan')">Hapus</button>
                        </td>
                    </tr>
                `;
                break;
                
            case 'kendaraan':
                tbody = document.getElementById('kendaraanTableBody');
                rowCount = tbody.rows.length;
                template = `
                    <tr id="kendaraanRow${rowCount}">
                        <td class="text-center">${rowCount + 1}</td>
                        <td><input type="text" name="kendaraan_jenis[]" class="form-control form-control-sm"></td>
                        <td>
                            <select name="kendaraan_moda[]" class="form-control form-control-sm">
                                <option value="">Pilih Moda</option>
                                <option value="Darat">Darat</option>
                                <option value="Laut">Laut</option>
                            </select>
                        </td>
                        <td><input type="number" name="kendaraan_rusak_berat[]" class="form-control form-control-sm calculate-kendaraan"></td>
                        <td><input type="number" name="kendaraan_rusak_sedang[]" class="form-control form-control-sm calculate-kendaraan"></td>
                        <td><input type="number" name="kendaraan_rusak_ringan[]" class="form-control form-control-sm calculate-kendaraan"></td>
                        <td><input type="number" name="kendaraan_harga_satuan[]" class="form-control form-control-sm calculate-kendaraan"></td>
                        <td><input type="number" name="kendaraan_biaya_kerusakan[]" class="form-control form-control-sm" readonly></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'kendaraan')">Hapus</button>
                        </td>
                    </tr>
                `;
                break;
                
            case 'prasarana':
                tbody = document.getElementById('prasaranaTableBody');
                rowCount = tbody.rows.length;
                template = `
                    <tr id="prasaranaRow${rowCount}">
                        <td class="text-center">${rowCount + 1}</td>
                        <td>
                            <select name="prasarana_jenis[]" class="form-control form-control-sm">
                                <option value="">Pilih Jenis</option>
                                <option value="Terminal">Terminal</option>
                                <option value="Dermaga">Dermaga</option>
                                <option value="Bandara">Bandara</option>
                            </select>
                        </td>
                        <td><input type="text" name="prasarana_tipe[]" class="form-control form-control-sm"></td>
                        <td><input type="number" step="0.01" name="prasarana_luas[]" class="form-control form-control-sm"></td>
                        <td><input type="number" step="0.01" name="prasarana_rusak_berat[]" class="form-control form-control-sm calculate-prasarana" placeholder="%"></td>
                        <td><input type="number" step="0.01" name="prasarana_rusak_sedang[]" class="form-control form-control-sm calculate-prasarana" placeholder="%"></td>
                        <td><input type="number" step="0.01" name="prasarana_rusak_ringan[]" class="form-control form-control-sm calculate-prasarana" placeholder="%"></td>
                        <td><input type="number" name="prasarana_harga_satuan[]" class="form-control form-control-sm calculate-prasarana"></td>
                        <td><input type="number" name="prasarana_biaya_kerusakan[]" class="form-control form-control-sm" readonly></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'prasarana')">Hapus</button>
                        </td>
                    </tr>
                `;
                break;
                
            case 'pendapatan':
                tbody = document.getElementById('pendapatanTableBody');
                rowCount = tbody.rows.length;
                template = `
                    <tr id="pendapatanRow${rowCount}">
                        <td class="text-center">${rowCount + 1}</td>
                        <td>
                            <select name="pendapatan_jenis[]" class="form-control form-control-sm">
                                <option value="">Pilih Jenis</option>
                                <option value="Angkutan Darat">Angkutan Darat</option>
                                <option value="Angkutan Laut/Sungai">Angkutan Laut/Sungai</option>
                                <option value="Angkutan Udara">Angkutan Udara</option>
                                <option value="Terminal">Terminal</option>
                                <option value="Dermaga">Dermaga</option>
                                <option value="Bandara">Bandara</option>
                            </select>
                        </td>
                        <td><input type="number" name="pendapatan_per_hari[]" class="form-control form-control-sm calculate-pendapatan"></td>
                        <td><input type="number" name="pendapatan_jumlah_terdampak[]" class="form-control form-control-sm calculate-pendapatan"></td>
                        <td><input type="number" name="pendapatan_jumlah_hari[]" class="form-control form-control-sm calculate-pendapatan"></td>
                        <td><input type="number" name="pendapatan_total_kehilangan[]" class="form-control form-control-sm" readonly></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'pendapatan')">Hapus</button>
                        </td>
                    </tr>
                `;
                break;
                
            case 'operasional':
                tbody = document.getElementById('operasionalTableBody');
                rowCount = tbody.rows.length;
                template = `
                    <tr id="operasionalRow${rowCount}">
                        <td class="text-center">${rowCount + 1}</td>
                        <td><input type="text" name="operasional_jenis_kendaraan[]" class="form-control form-control-sm"></td>
                        <td><input type="number" name="operasional_biaya_sebelum[]" class="form-control form-control-sm calculate-operasional"></td>
                        <td><input type="number" name="operasional_biaya_sesudah[]" class="form-control form-control-sm calculate-operasional"></td>
                        <td><input type="number" name="operasional_jumlah_kendaraan[]" class="form-control form-control-sm calculate-operasional"></td>
                        <td><input type="number" name="operasional_jarak_tempuh[]" class="form-control form-control-sm calculate-operasional"></td>
                        <td><input type="number" name="operasional_durasi[]" class="form-control form-control-sm calculate-operasional"></td>
                        <td><input type="number" name="operasional_total_kenaikan[]" class="form-control form-control-sm" readonly></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'operasional')">Hapus</button>
                        </td>
                    </tr>
                `;
                break;
                
            case 'infrastruktur':
                tbody = document.getElementById('infrastrukturTableBody');
                rowCount = tbody.rows.length;
                template = `
                    <tr id="infrastrukturRow${rowCount}">
                        <td class="text-center">${rowCount + 1}</td>
                        <td><input type="text" name="infrastruktur_jenis[]" class="form-control form-control-sm" placeholder="Misalnya: Jembatan Bailey"></td>
                        <td><input type="number" name="infrastruktur_jumlah_unit[]" class="form-control form-control-sm calculate-infrastruktur"></td>
                        <td><input type="number" name="infrastruktur_biaya_per_unit[]" class="form-control form-control-sm calculate-infrastruktur"></td>
                        <td><input type="number" name="infrastruktur_total_biaya[]" class="form-control form-control-sm" readonly></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this, 'infrastruktur')">Hapus</button>
                        </td>
                    </tr>
                `;
                break;
        }
        
        const newRow = document.createElement('tr');
        newRow.innerHTML = template;
        tbody.appendChild(newRow.firstElementChild);
        
        // Inisialisasi event listener untuk kalkulasi otomatis pada input baru
        setupCalculations(tableType);
    }
    
    // Fungsi untuk menghapus baris
    function removeRow(button, tableType) {
        const row = button.closest('tr');
        row.remove();
        
        // Perbaiki nomor urutan setelah penghapusan
        const tbody = document.getElementById(`${tableType}TableBody`);
        const rows = tbody.querySelectorAll('tr');
        
        rows.forEach((row, index) => {
            row.querySelector('td:first-child').textContent = index + 1;
            row.id = `${tableType}Row${index}`;
        });
    }
    
    // Fungsi untuk menghitung total biaya/kerusakan
    function setupCalculations(tableType) {
        switch(tableType) {
            case 'jalan':
                document.querySelectorAll('.calculate-jalan').forEach(input => {
                    input.addEventListener('input', function() {
                        const row = this.closest('tr');
                        const beratKm = parseFloat(row.querySelector('[name="jalan_kerusakan_berat[]"]').value) || 0;
                        const sedangKm = parseFloat(row.querySelector('[name="jalan_kerusakan_sedang[]"]').value) || 0;
                        const ringanKm = parseFloat(row.querySelector('[name="jalan_kerusakan_ringan[]"]').value) || 0;
                        const hargaSatuan = parseFloat(row.querySelector('[name="jalan_harga_satuan[]"]').value) || 0;
                        
                        // Asumsi: 1 km jalan rata-rata lebarnya 7 meter jadi 7000 m²/km
                        const totalM2 = (beratKm + sedangKm + ringanKm) * 7000;
                        const biayaPerbaikan = totalM2 * hargaSatuan;
                        
                        row.querySelector('[name="jalan_biaya_perbaikan[]"]').value = Math.round(biayaPerbaikan);
                    });
                });
                break;
                
            case 'jembatan':
                document.querySelectorAll('.calculate-jembatan').forEach(input => {
                    input.addEventListener('input', function() {
                        const row = this.closest('tr');
                        const berat = parseInt(row.querySelector('[name="jembatan_kerusakan_berat[]"]').value) || 0;
                        const sedang = parseInt(row.querySelector('[name="jembatan_kerusakan_sedang[]"]').value) || 0;
                        const ringan = parseInt(row.querySelector('[name="jembatan_kerusakan_ringan[]"]').value) || 0;
                        const hargaSatuan = parseFloat(row.querySelector('[name="jembatan_harga_satuan[]"]').value) || 0;
                        
                        // Untuk jembatan, hitung berdasarkan unit
                        const biayaPerbaikan = (berat + sedang + ringan) * hargaSatuan;
                        
                        row.querySelector('[name="jembatan_biaya_perbaikan[]"]').value = Math.round(biayaPerbaikan);
                    });
                });
                break;
                
            case 'kendaraan':
                document.querySelectorAll('.calculate-kendaraan').forEach(input => {
                    input.addEventListener('input', function() {
                        const row = this.closest('tr');
                        const berat = parseInt(row.querySelector('[name="kendaraan_rusak_berat[]"]').value) || 0;
                        const sedang = parseInt(row.querySelector('[name="kendaraan_rusak_sedang[]"]').value) || 0;
                        const ringan = parseInt(row.querySelector('[name="kendaraan_rusak_ringan[]"]').value) || 0;
                        const hargaSatuan = parseFloat(row.querySelector('[name="kendaraan_harga_satuan[]"]').value) || 0;
                        
                        // Asumsi harga kerusakan berbeda berdasarkan tingkat kerusakan
                        const biayaKerusakan = (berat * hargaSatuan * 0.8) + (sedang * hargaSatuan * 0.5) + (ringan * hargaSatuan * 0.2);
                        
                        row.querySelector('[name="kendaraan_biaya_kerusakan[]"]').value = Math.round(biayaKerusakan);
                    });
                });
                break;
                
            case 'prasarana':
                document.querySelectorAll('.calculate-prasarana').forEach(input => {
                    input.addEventListener('input', function() {
                        const row = this.closest('tr');
                        const luas = parseFloat(row.querySelector('[name="prasarana_luas[]"]').value) || 0;
                        const beratPersen = parseFloat(row.querySelector('[name="prasarana_rusak_berat[]"]').value) || 0;
                        const sedangPersen = parseFloat(row.querySelector('[name="prasarana_rusak_sedang[]"]').value) || 0;
                        const ringanPersen = parseFloat(row.querySelector('[name="prasarana_rusak_ringan[]"]').value) || 0;
                        const hargaSatuan = parseFloat(row.querySelector('[name="prasarana_harga_satuan[]"]').value) || 0;
                        
                        // Hitung berdasarkan persentase kerusakan dikali luas
                        const totalKerusakan = (luas * beratPersen / 100) + (luas * sedangPersen / 100 * 0.5) + (luas * ringanPersen / 100 * 0.2);
                        const biayaKerusakan = totalKerusakan * hargaSatuan;
                        
                        row.querySelector('[name="prasarana_biaya_kerusakan[]"]').value = Math.round(biayaKerusakan);
                    });
                });
                break;
                
            case 'pendapatan':
                document.querySelectorAll('.calculate-pendapatan').forEach(input => {
                    input.addEventListener('input', function() {
                        const row = this.closest('tr');
                        const pendapatanPerHari = parseFloat(row.querySelector('[name="pendapatan_per_hari[]"]').value) || 0;
                        const jumlahTerdampak = parseInt(row.querySelector('[name="pendapatan_jumlah_terdampak[]"]').value) || 0;
                        const jumlahHari = parseInt(row.querySelector('[name="pendapatan_jumlah_hari[]"]').value) || 0;
                        
                        const totalKehilangan = pendapatanPerHari * jumlahTerdampak * jumlahHari;
                        
                        row.querySelector('[name="pendapatan_total_kehilangan[]"]').value = Math.round(totalKehilangan);
                    });
                });
                break;
                
            case 'operasional':
                document.querySelectorAll('.calculate-operasional').forEach(input => {
                    input.addEventListener('input', function() {
                        const row = this.closest('tr');
                        const biayaSebelum = parseFloat(row.querySelector('[name="operasional_biaya_sebelum[]"]').value) || 0;
                        const biayaSesudah = parseFloat(row.querySelector('[name="operasional_biaya_sesudah[]"]').value) || 0;
                        const jumlahKendaraan = parseInt(row.querySelector('[name="operasional_jumlah_kendaraan[]"]').value) || 0;
                        const jarakTempuh = parseFloat(row.querySelector('[name="operasional_jarak_tempuh[]"]').value) || 0;
                        const durasi = parseInt(row.querySelector('[name="operasional_durasi[]"]').value) || 0;
                        
                        const selisihBiaya = biayaSesudah - biayaSebelum;
                        const totalKenaikan = selisihBiaya * jumlahKendaraan * jarakTempuh * durasi;
                        
                        row.querySelector('[name="operasional_total_kenaikan[]"]').value = Math.round(totalKenaikan);
                    });
                });
                break;
                
            case 'infrastruktur':
                document.querySelectorAll('.calculate-infrastruktur').forEach(input => {
                    input.addEventListener('input', function() {
                        const row = this.closest('tr');
                        const jumlahUnit = parseInt(row.querySelector('[name="infrastruktur_jumlah_unit[]"]').value) || 0;
                        const biayaPerUnit = parseFloat(row.querySelector('[name="infrastruktur_biaya_per_unit[]"]').value) || 0;
                        
                        const totalBiaya = jumlahUnit * biayaPerUnit;
                        
                        row.querySelector('[name="infrastruktur_total_biaya[]"]').value = Math.round(totalBiaya);
                    });
                });
                break;
        }
    }
    
    // Inisialisasi event listener untuk kalkulasi otomatis saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        setupCalculations('jalan');
        setupCalculations('jembatan');
        setupCalculations('kendaraan');
        setupCalculations('prasarana');
        setupCalculations('pendapatan');
        setupCalculations('operasional');
        setupCalculations('infrastruktur');
    });
</script>
@endsection
