@extends('layouts.main')

@section('content')
<style>
    .page-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .page-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .page-header h2 {
        color: #F28705;
        font-weight: 600;
        margin: 0;
    }

    .main-card {
        background: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .card-header {
        background: #f9f9f9;
        padding: 15px 20px;
        border-bottom: 1px solid #ddd;
    }

    .card-header h4 {
        margin: 0;
        color: #333;
        font-weight: 600;
        font-size: 18px;
    }

    .card-body {
        padding: 20px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }

    .table th,
    .table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .table th {
        background: #f9f9f9;
        font-weight: 600;
        color: #333;
    }

    .table tbody tr:nth-child(even) {
        background: #f9f9f9;
    }

    .table tbody tr:hover {
        background: rgba(242, 135, 5, 0.08);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #F28705;
        box-shadow: 0 0 0 0.2rem rgba(242, 135, 5, 0.25);
    }

    .form-control:disabled {
        background: #f9f9f9;
        cursor: not-allowed;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-primary {
        background: #F28705;
        color: white;
    }

    .btn-primary:hover {
        background: #d97604;
        color: white;
    }

    .detail-card {
        border: 2px solid #ddd;
        border-radius: 6px;
        padding: 20px;
        background: #fafafa;
        margin-top: 10px;
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 10px;
        }

        .table th,
        .table td {
            padding: 8px 10px;
            font-size: 13px;
        }
    }
</style>

<div class="page-container">
    <div class="page-header">
        <h2>Edit Data Kerugian</h2>
    </div>

    <div class="main-card">
        <div class="card-header">
            <h4>Informasi Bencana</h4>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 30%;">Bencana</th>
                        <th style="width: 60%;">Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $bencana->id }}</td>
                        <td>{{ $bencana->kategori_bencana->nama }}</td>
                        <td>
                            @foreach ($bencana->desa as $index => $desa)
                                {{ $desa->nama }}{{ $index < count($bencana->desa) - 1 ? ', ' : '' }}
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="main-card">
        <div class="card-header">
            <h4>Form Edit Kerugian</h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{ route('kerugian.update', ['id' => $kerugian->id]) }}" method="POST">
                @method('PATCH')
                @csrf
                
                <div class="detail-card">
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="tipe-0">Sektor yang Terkena Dampak</label>
                                <input type="text" class="form-control" value="Pertanian" disabled>
                                <input type="hidden" id="tipe-0" name="tipe" value="2">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="nilai-ekonomi">Nilai Ekonomi Rata-Rata</label>
                                <input type="text" id="nilai-ekonomi" class="form-control" name="nilai_ekonomi"
                                    value="{{ number_format($kerugian->nilai_ekonomi, 0, ',', '.') }}">
                                <input type="hidden" id="nilai-ekonomi-hidden" name="nilai_ekonomi_hidden"
                                    value="{{ $kerugian->nilai_ekonomi }}">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="satuan_id-0">Satuan</label>
                                <select class="choices form-select" name="satuan_id" id="satuan_id-0">
                                    <option selected disabled value="">{{ __('Pilih...') }}</option>
                                    @foreach ($satuan as $item)
                                        <option value="{{ $item->id }}"
                                            {{ (old('satuan_id') ?? $kerugian->satuan_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="kuantitas-0">Jumlah Terkena Dampak</label>
                                <input type="number" id="kuantitas-0" class="form-control" name="kuantitas"
                                    value="{{ $kerugian->kuantitas }}" step="0.01" min="0">
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi">{{ $kerugian->deskripsi }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cleave = new Cleave('#nilai-ekonomi', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                prefix: 'Rp ',
                rawValueTrimPrefix: true, // Trim the prefix when sending the data to the server
                numeralDecimalMark: ',',
                delimiter: '.',
            });

            // Update hidden input with raw value
            const hiddenInput = document.getElementById('nilai-ekonomi-hidden');
            hiddenInput.value = cleave.getRawValue();

            // Listen for changes and update the hidden input field
            document.getElementById('nilai-ekonomi').addEventListener('input', function() {
                hiddenInput.value = cleave.getRawValue();
            });
        });
    </script>
    {{-- <script>
        document.getElementById('add-detail-btn').addEventListener('click', function() {
            // Mendapatkan jumlah detail kerusakan yang ada saat ini
            const detailCount = document.querySelectorAll('#additional-details .card').length;

            // Membuat elemen baru untuk detail kerusakan
            const newDetail = document.createElement('div');
            newDetail.classList.add('card');
            newDetail.innerHTML = `
            <div class="card-content"  style="border: 4px solid #ddd; margin-top: 10px">
            <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="tipe-${detailCount}">Sektor yang Terkena Dampak</label>
                        <select class="choices form-select" name="details[${detailCount}][tipe]" id="tipe-${detailCount}">
                            <option selected disabled value="">{{ __('Pilih...') }}</option>
            
                            <option value="2">Pertanian</option>
                        
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="nama-${detailCount}">Nilai Ekonomi Rata-Rata</label>
                        <input type="number" id="nama-${detailCount}" class="form-control" placeholder="" name="details[${detailCount}][nilai_ekonomi]">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="satuan-${detailCount}">Satuan</label>
                       <select class="choices form-select" name="details[${detailCount}][satuan_id]"
                        id="satuan_id-${detailCount}">
                        <option selected disabled value="">{{ __('Pilih...') }}</option>
                        @foreach ($satuan as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-md-2 col-12">
                    <div class="form-group">
                        <label for="kuantitas-${detailCount}">Jumlah Terkena Dampak</label>
                        <input type="number" id="kuantitas-${detailCount}" class="form-control" placeholder="" name="details[${detailCount}][kuantitas]">
                    </div>
                </div>
                <div class="col-md-1 col-12 d-flex align-items-center">
                    <div class="form-group mb-0">
                        <svg class="delete-icon" xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" viewBox="0 0 48 48" style="cursor: pointer;">
                            <g fill="none" stroke="#d51515" stroke-linejoin="round" stroke-width="4">
                                <path stroke-linecap="round" d="M8 11h32M18 5h12"/>
                                <path d="M12 17h24v23a3 3 0 0 1-3 3H15a3 3 0 0 1-3-3z"/>
                                <path stroke-linecap="round" d="m20 25l8 8m0-8l-8 8"/>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="company-column">Deskripsi</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="details[${detailCount}][deskripsi]"></textarea>
                                    </div>
                </div>
            </div>
        </div>
    </div>
    `;

            // Menambahkan elemen baru ke dalam div dengan id "additional-details"
            document.getElementById('additional-details').appendChild(newDetail);
            new Choices(`#tipe-${detailCount}`);
            new Choices(`#satuan_id-${detailCount}`);
            // Tambahkan event listener untuk menghapus baris ketika ikon diklik
            newDetail.querySelector('.delete-icon').addEventListener('click', function() {
                newDetail.remove();
            });
        });

        // Tambahkan event listener untuk ikon delete pada elemen yang sudah ada
        document.querySelectorAll('.delete-icon').forEach(function(icon) {
            icon.addEventListener('click', function() {
                icon.closest('.card').remove();
            });
        });
    </script> --}}
@endpush
