@extends('layouts.main')

@section('content')
<style>
    /* Container & Layout */
    .page-container {
        padding: 20px;
    }

    /* Card Styling */
    .main-card {
        background: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
    }

    /* Page Header */
    .page-header {
        text-align: center;
        background: white;
        border-radius: 6px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 25px 20px;
        margin-bottom: 1.5rem;
    }

    .page-header h3 {
        margin: 0 0 10px 0;
        font-weight: bold;
        color: #F28705;
        font-size: 1.8rem;
    }

    .page-header p {
        margin: 0;
        color: #666;
        font-size: 1rem;
    }

    /* Card Header */
    .card-header {
        background: #f9f9f9;
        color: #333;
        font-weight: 600;
        padding: 15px 20px;
        border-bottom: 2px solid #ddd;
    }

    .card-header h4 {
        margin: 0;
        font-weight: 600;
        font-size: 1.2rem;
    }

    .card-body {
        padding: 20px;
    }

    /* Table Styling */
    .table {
        border: 1px solid #ddd;
        margin-bottom: 0;
        font-size: 14px;
    }

    .table td, .table th {
        padding: 12px 15px;
        border: 1px solid #ddd;
        vertical-align: middle;
    }

    .table thead th {
        background: #f9f9f9;
        color: #333;
        font-weight: 600;
        text-align: center;
        border-bottom: 2px solid #ddd;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Detail Card */
    .detail-card {
        border: 2px solid #ddd;
        border-radius: 6px;
        padding: 20px;
        margin-bottom: 15px;
        background: #fafafa;
    }

    /* Form Styling */
    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .form-control, .form-select {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px 14px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #F28705;
        box-shadow: 0 0 0 0.2rem rgba(242, 135, 5, 0.15);
    }

    /* Button Styling */
    .btn {
        padding: 10px 20px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        margin: 0 5px;
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

    .btn-success {
        background: #28a745;
        color: white;
    }

    .btn-success:hover {
        background: #218838;
        color: white;
    }

    /* Delete Icon */
    .delete-icon {
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .delete-icon:hover {
        transform: scale(1.1);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-container {
            padding: 10px;
        }

        .page-header h3 {
            font-size: 1.4rem;
        }

        .table {
            font-size: 12px;
        }

        .btn {
            padding: 8px 16px;
            font-size: 12px;
        }
    }
</style>

<div class="page-container">
    <!-- Page Header -->
    <div class="page-header">
        <h3>Tambah Data Kerugian</h3>
        <p>Formulir penambahan data kerugian akibat bencana</p>
    </div>

    <!-- Informasi Bencana -->
    <div class="main-card">
        <div class="card-header">
            <h4>Informasi Bencana</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Bencana ID</th>
                            <th style="width: 35%;">Bencana</th>
                            <th style="width: 50%;">Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center;">{{ $bencana->id }}</td>
                            <td>{{ $bencana->kategori_bencana->nama }}</td>
                            <td>
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach ($bencana->desa as $desa)
                                        <li>{{ $desa->nama }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Form Tambah Data -->
    <div class="main-card">
        <form class="form" id="kerusakan-form" action="{{ route('kerugian.store', ['id' => $bencana->id]) }}" method="POST">
            @csrf
            <div class="card-header">
                <h4>Data Kerugian</h4>
            </div>
            <div class="card-body">
                <div id="additional-details"></div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" id="add-detail-btn" class="btn btn-primary">
                        Tambah Detail
                    </button>
                    <button type="submit" class="btn btn-success">
                        Simpan Data
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
        document.getElementById('add-detail-btn').addEventListener('click', function() {
            // Mendapatkan jumlah detail kerusakan yang ada saat ini
            const detailCount = document.querySelectorAll('#additional-details .card').length;

            // Membuat elemen baru untuk detail kerusakan
            const newDetail = document.createElement('div');
            newDetail.classList.add('detail-card');
            newDetail.innerHTML = `
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
                        <input type="text" id="nilai-ekonomi-${detailCount}" class="form-control" placeholder="" name="details[${detailCount}][nilai_ekonomi]">
                          <input type="hidden" id="nilai-ekonomi-hidden-${detailCount}" name="details[${detailCount}][nilai_ekonomi_hidden]">
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
                        <input type="number" id="kuantitas-${detailCount}" class="form-control" placeholder="" name="details[${detailCount}][kuantitas]" step="0.01" min="0">
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
    `;

            // Menambahkan elemen baru ke dalam div dengan id "additional-details"
            document.getElementById('additional-details').appendChild(newDetail);
            new Choices(`#tipe-${detailCount}`);
            new Choices(`#satuan_id-${detailCount}`);
            // Initialize Cleave.js on the newly added field
            new Cleave(`#nilai-ekonomi-${detailCount}`, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                prefix: 'Rp ',
                rawValueTrimPrefix: true, // Trim the prefix when sending the data to the server
                numeralDecimalMark: ',',
                delimiter: '.',
                onValueChanged: function(e) {
                    // Set the raw value to the hidden input
                    document.getElementById(`nilai-ekonomi-hidden-${detailCount}`).value = e.target
                        .rawValue;
                }
            });
            // Tambahkan event listener untuk menghapus baris ketika ikon diklik
            newDetail.querySelector('.delete-icon').addEventListener('click', function() {
                newDetail.remove();
            });
        });

        // Tambahkan event listener untuk ikon delete pada elemen yang sudah ada
        document.querySelectorAll('.delete-icon').forEach(function(icon) {
            icon.addEventListener('click', function() {
                icon.closest('.detail-card').remove();
            });
        });
    </script>
@endpush
