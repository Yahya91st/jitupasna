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
    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }
</style>


    <div class="container mt-4">
        <h5 class="text-center fw-bold">Formulir 04<br>Pengkajian Kebutuhan Pasca Bencana</h5>
        <p class="fw-bold">Format 13: Sektor Industri dan UMKM</p>

        <form action="{{ route('forms.form4.format13.store') }}" method="POST">
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
                        <th style="width: 10%;">Keterangan</th>
                        <th style="width: 14%;">Jenis Kerusakan</th>
                        <th style="width: 8%;">RB</th>
                        <th style="width: 8%;">RS</th>
                        <th style="width: 9%;">RR</th>
                        <th style="width: 10%;">RB Harga</th>
                        <th style="width: 15%;">RS Harga</th>
                        <th style="width: 14%;">RR Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="card-header bg-danger"> 
                        <td style="background-color: #A3AFBD;" class="align-middle fw-bold text-white" colspan="8">PERKIRAAN KERUSAKAN</td>
                    </tr>
                    <tr>
                        <td class="align-middle fw-bold">Pabrik/tempat usaha</td>
                        <td><input type="number" name="pabrik_berat" class="form-control" min="0" value="{{ old('pabrik_berat', $data->pabrik_berat ?? '0') }}"></td>
                        <td><input type="number" name="pabrik_sedang" class="form-control" min="0" value="{{ old('pabrik_sedang', $data->pabrik_sedang ?? '0') }}"></td>
                        <td><input type="number" name="pabrik_ringan" class="form-control" min="0" value="{{ old('pabrik_ringan', $data->pabrik_ringan ?? '0') }}"></td>
                        <td><input type="number" name="pabrik_rb_harga" class="form-control" min="0" step="any" value="{{ old('pabrik_rb_harga', $data->pabrik_rb_harga ?? '0') }}"></td>
                        <td><input type="number" name="pabrik_rs_harga" class="form-control" min="0" step="any" value="{{ old('pabrik_rs_harga', $data->pabrik_rs_harga ?? '0') }}"></td>
                        <td><input type="number" name="pabrik_rr_harga" class="form-control" min="0" step="any" value="{{ old('pabrik_rr_harga', $data->pabrik_rr_harga ?? '0') }}"></td>
                        <td><input type="number" name="pabrik_total" class="form-control" min="0" step="any" value="{{ old('pabrik_total', $data->pabrik_total ?? '0') }}"></td>
                    </tr>
                    <tr>
                        <td class="align-middle fw-bold">Mesin dan peralatan</td>
                        <td><input type="number" name="mesin_berat" class="form-control" min="0" value="{{ old('mesin_berat', $data->mesin_berat ?? '0') }}"></td>
                        <td><input type="number" name="mesin_sedang" class="form-control" min="0" value="{{ old('mesin_sedang', $data->mesin_sedang ?? '0') }}"></td>
                        <td><input type="number" name="mesin_ringan" class="form-control" min="0" value="{{ old('mesin_ringan', $data->mesin_ringan ?? '0') }}"></td>
                        <td><input type="number" name="mesin_rb_harga" class="form-control" min="0" step="any" value="{{ old('mesin_rb_harga', $data->mesin_rb_harga ?? '0') }}"></td>
                        <td><input type="number" name="mesin_rs_harga" class="form-control" min="0" step="any" value="{{ old('mesin_rs_harga', $data->mesin_rs_harga ?? '0') }}"></td>
                        <td><input type="number" name="mesin_rr_harga" class="form-control" min="0" step="any" value="{{ old('mesin_rr_harga', $data->mesin_rr_harga ?? '0') }}"></td>
                        <td><input type="number" name="mesin_total" class="form-control" min="0" step="any" value="{{ old('mesin_total', $data->mesin_total ?? '0') }}"></td>
                    </tr>
                    <tr>
                        <td class="align-middle fw-bold">Bahan baku</td>
                        <td><input type="number" name="bahan_baku_berat" class="form-control" min="0" value="{{ old('bahan_baku_berat', $data->bahan_baku_berat ?? '0') }}"></td>
                        <td><input type="number" name="bahan_baku_sedang" class="form-control" min="0" value="{{ old('bahan_baku_sedang', $data->bahan_baku_sedang ?? '0') }}"></td>
                        <td><input type="number" name="bahan_baku_ringan" class="form-control" min="0" value="{{ old('bahan_baku_ringan', $data->bahan_baku_ringan ?? '0') }}"></td>
                        <td><input type="number" name="bahan_baku_rb_harga" class="form-control" min="0" step="any" value="{{ old('bahan_baku_rb_harga', $data->bahan_baku_rb_harga ?? '0') }}"></td>
                        <td><input type="number" name="bahan_baku_rs_harga" class="form-control" min="0" step="any" value="{{ old('bahan_baku_rs_harga', $data->bahan_baku_rs_harga ?? '0') }}"></td>
                        <td><input type="number" name="bahan_baku_rr_harga" class="form-control" min="0" step="any" value="{{ old('bahan_baku_rr_harga', $data->bahan_baku_rr_harga ?? '0') }}"></td>
                        <td><input type="number" name="bahan_baku_total" class="form-control" min="0" step="any" value="{{ old('bahan_baku_total', $data->bahan_baku_total ?? '0') }}"></td>
                    </tr>
                    <tr>
                        <td class="align-middle fw-bold">Bahan jadi</td>
                        <td><input type="number" name="bahan_jadi_berat" class="form-control" min="0" value="{{ old('bahan_jadi_berat', $data->bahan_jadi_berat ?? '0') }}"></td>
                        <td><input type="number" name="bahan_jadi_sedang" class="form-control" min="0" value="{{ old('bahan_jadi_sedang', $data->bahan_jadi_sedang ?? '0') }}"></td>
                        <td><input type="number" name="bahan_jadi_ringan" class="form-control" min="0" value="{{ old('bahan_jadi_ringan', $data->bahan_jadi_ringan ?? '0') }}"></td>
                        <td><input type="number" name="bahan_jadi_rb_harga" class="form-control" min="0" step="any" value="{{ old('bahan_jadi_rb_harga', $data->bahan_jadi_rb_harga ?? '0') }}"></td>
                        <td><input type="number" name="bahan_jadi_rs_harga" class="form-control" min="0" step="any" value="{{ old('bahan_jadi_rs_harga', $data->bahan_jadi_rs_harga ?? '0') }}"></td>
                        <td><input type="number" name="bahan_jadi_rr_harga" class="form-control" min="0" step="any" value="{{ old('bahan_jadi_rr_harga', $data->bahan_jadi_rr_harga ?? '0') }}"></td>
                        <td><input type="number" name="bahan_jadi_total" class="form-control" min="0" step="any" value="{{ old('bahan_jadi_total', $data->bahan_jadi_total ?? '0') }}"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr class="my-4">
        <h6 class="fw-bold">II. PERKIRAAN KERUGIAN</h6>
        <table class="table table-bordered mt-3">
            <thead>
                <tr style="background-color: #A3AFBD; text-bold">
                    <th colspan="4">1. KEHILANGAN TOTAL PRODUKSI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 20%">A. Jenis Komoditi</td>
                    <td style="width: 80%" colspan="3">
                        <input type="text" name="kehilangan_jenis_komoditi" class="form-control" 
                            value="{{ old('kehilangan_jenis_komoditi', $data->kehilangan_jenis_komoditi ?? '') }}">
                    </td>
                </tr>
                <tr>
                    <td>B. Jumlah Produksi</td>
                    <td colspan="3">
                        <input type="number" name="kehilangan_jumlah_produksi" class="form-control" 
                            value="{{ old('kehilangan_jumlah_produksi', $data->kehilangan_jumlah_produksi ?? '') }}">
                    </td>
                </tr>
                <tr>
                    <td>C. Harga Satuan</td>
                    <td colspan="3">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="kehilangan_harga_satuan" class="form-control" 
                                value="{{ old('kehilangan_harga_satuan', $data->kehilangan_harga_satuan ?? '') }}">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered mt-3">
            <thead>
                <tr style="background-color: #A3AFBD; text-bold">
                    <th colspan="5">2. PENURUNAN PRODUKTIFITAS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 20%">A. Jenis Komoditi</td>
                    <td colspan="4">
                        <input type="text" name="penurunan_jenis_komoditi" class="form-control" 
                            value="{{ old('penurunan_jenis_komoditi', $data->penurunan_jenis_komoditi ?? '') }}">
                    </td>
                </tr>
                <tr>
                    <td>B. Produksi Sebelum Bencana</td>
                    <td colspan="4">
                        <input type="number" name="penurunan_produksi_sebelum" class="form-control" 
                            value="{{ old('penurunan_produksi_sebelum', $data->penurunan_produksi_sebelum ?? '') }}">
                    </td>
                </tr>
                <tr>
                    <td>C. Produksi Sesudah Bencana</td>
                    <td colspan="4">
                        <input type="number" name="penurunan_produksi_sesudah" class="form-control" 
                            value="{{ old('penurunan_produksi_sesudah', $data->penurunan_produksi_sesudah ?? '') }}">
                    </td>
                </tr>
                <tr>
                    <td>D. Harga Satuan</td>
                    <td colspan="4">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="penurunan_harga_satuan" class="form-control" 
                                value="{{ old('penurunan_harga_satuan', $data->penurunan_harga_satuan ?? '') }}">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered mt-3">
            <thead>
                <tr style="background-color: #A3AFBD; text-bold;">
                    <th colspan="5">3. KENAIKAN ONGKOS PRODUKSI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="fw-bold" style="background-color: #f8f9fa;">A. Biaya Bahan Baku Yang Lebih Tinggi</td>
                </tr>
                <tr>
                    <td style="width: 20%">Jenis Produk</td>
                    <td colspan="4">
                        <input type="text" name="kenaikan_bahan_jenis_produk" class="form-control" 
                            placeholder="Masukkan jenis produk" 
                            value="{{ old('kenaikan_bahan_jenis_produk', $data->kenaikan_bahan_jenis_produk ?? '') }}">
                    </td>
                </tr>
                <tr>
                    <td>B. Biaya Sebelum Bencana</td>
                    <td colspan="4">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="kenaikan_bahan_biaya_sebelum" class="form-control" 
                                placeholder="0" 
                                value="{{ old('kenaikan_bahan_biaya_sebelum', $data->kenaikan_bahan_biaya_sebelum ?? '') }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>C. Biaya Sesudah Bencana</td>
                    <td colspan="4">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="kenaikan_bahan_biaya_sesudah" class="form-control" 
                                placeholder="0" 
                                value="{{ old('kenaikan_bahan_biaya_sesudah', $data->kenaikan_bahan_biaya_sesudah ?? '') }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>D. Harga Satuan</td>
                    <td colspan="4">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="kenaikan_bahan_harga_satuan" class="form-control" 
                                placeholder="0" 
                                value="{{ old('kenaikan_bahan_harga_satuan', $data->kenaikan_bahan_harga_satuan ?? '') }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="section-header">Biaya Operasional Yang Lebih Tinggi</td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div class="form-group">
                            <textarea name="kenaikan_operasional_keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan biaya operasional">{{ old('kenaikan_operasional_keterangan', $data->kenaikan_operasional_keterangan ?? '') }}</textarea>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">II. PERKIRAAN KERUGIAN</h6>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">1. KEHILANGAN TOTAL PRODUKSI</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">A. Jenis Komoditi</label>
                            <input type="text" name="kehilangan_jenis_komoditi" class="form-control" 
                                placeholder="Masukkan jenis komoditi" 
                                value="{{ old('kehilangan_jenis_komoditi', $data->kehilangan_jenis_komoditi ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">B. Jumlah Produksi</label>
                            <input type="number" name="kehilangan_jumlah_produksi" class="form-control" 
                                placeholder="0" min="0"
                                value="{{ old('kehilangan_jumlah_produksi', $data->kehilangan_jumlah_produksi ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">C. Harga Satuan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="kehilangan_harga_satuan" class="form-control" 
                                    placeholder="0" min="0"
                                    value="{{ old('kehilangan_harga_satuan', $data->kehilangan_harga_satuan ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold mb-3">2. PENURUNAN PRODUKTIFITAS</h6>
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">A. Jenis Komoditi</label>
                            <input type="text" name="penurunan_jenis_komoditi" class="form-control" 
                                placeholder="Masukkan jenis komoditi"
                                value="{{ old('penurunan_jenis_komoditi', $data->penurunan_jenis_komoditi ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">B. Produksi Sebelum Bencana</label>
                            <input type="number" name="penurunan_produksi_sebelum" class="form-control" 
                                placeholder="0" min="0"
                                value="{{ old('penurunan_produksi_sebelum', $data->penurunan_produksi_sebelum ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">C. Produksi Sesudah Bencana</label>
                            <input type="number" name="penurunan_produksi_sesudah" class="form-control" 
                                placeholder="0" min="0"
                                value="{{ old('penurunan_produksi_sesudah', $data->penurunan_produksi_sesudah ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">D. Harga Satuan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="penurunan_harga_satuan" class="form-control" 
                                    placeholder="0" min="0"
                                    value="{{ old('penurunan_harga_satuan', $data->penurunan_harga_satuan ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold mb-3">3. KENAIKAN ONGKOS PRODUKSI</h6>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="mb-3">Biaya Bahan Baku Yang Lebih Tinggi</h6>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">A. Jenis Produk</label>
                                    <input type="text" name="kenaikan_bahan_jenis_produk" class="form-control" 
                                        placeholder="Masukkan jenis produk"
                                        value="{{ old('kenaikan_bahan_jenis_produk', $data->kenaikan_bahan_jenis_produk ?? '') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">B. Biaya Sebelum Bencana</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="biaya_sebelum" class="form-control" 
                                            placeholder="0" min="0"
                                            value="{{ old('biaya_sebelum', $data->biaya_sebelum ?? '') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">C. Biaya Sesudah Bencana</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="biaya_sesudah" class="form-control" 
                                            placeholder="0" min="0"
                                            value="{{ old('biaya_sesudah', $data->biaya_sesudah ?? '') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">D. Harga Satuan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="harga_satuan" class="form-control" 
                                            placeholder="0" min="0"
                                            value="{{ old('harga_satuan', $data->harga_satuan ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3">Biaya Operasional Yang Lebih Tinggi</h6>
                            <textarea name="kenaikan_operasional_keterangan" class="form-control" rows="3" 
                                placeholder="Masukkan keterangan biaya operasional">{{ old('kenaikan_operasional_keterangan', $data->kenaikan_operasional_keterangan ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitBtn = form.querySelector('button[type="submit"]');
            
            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
            });
        });
    </script>
</div>
</div>
@endsection
