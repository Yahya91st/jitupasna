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
    }

    .card-body {
        padding: 20px;
    }

    .detail-card {
        background: #fafafa;
        border: 2px solid #ddd;
        border-radius: 6px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        display: block;
    }

    .form-control,
    .form-select {
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 8px 12px;
        font-size: 14px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #F28705;
        box-shadow: 0 0 0 0.2rem rgba(242, 135, 5, 0.25);
        outline: none;
    }

    .btn {
        display: inline-block;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-right: 5px;
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

    .delete-icon {
        cursor: pointer;
        color: #dc3545;
        font-size: 24px;
        font-weight: bold;
    }

    .delete-icon:hover {
        color: #a71d2a;
    }

    .row {
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 10px;
        }

        .card-body {
            padding: 15px;
        }

        .detail-card {
            padding: 15px;
        }
    }
</style>

<div class="page-container">
    <div class="page-header">
        <h2>Tambah Data Kerusakan</h2>
    </div>

    <div class="main-card">
        <form class="form" id="kerusakan-form" action="{{ route('kerusakan.store', ['id' => $bencana->id]) }}" method="POST">
            @csrf
            <div class="card-header">
                <h4>Form Data Kerusakan</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="kategori_bangunan_id">Kategori Bangunan</label>
                            <select class="choices form-select" name="kategori_bangunan_id" id="kategori_bangunan_id">
                                <option selected disabled value="">Pilih...</option>
                                @foreach ($kategoribangunan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('kategori_bangunan_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi"></textarea>
                        </div>
                    </div>
                </div>

                <div id="additional-details"></div>

                <div class="d-flex justify-content-end" style="margin-top: 20px;">
                    <button type="button" id="add-detail-btn" class="btn btn-primary">Tambah Detail</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('script')
    <script>
        document.getElementById('add-detail-btn').addEventListener('click', function() {
            const detailCount = document.querySelectorAll('#additional-details .card').length;

            const newDetail = document.createElement('div');
            newDetail.classList.add('card');
            newDetail.innerHTML = `
<div class="detail-card">
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="tipe-${detailCount}">Tipe</label>
                <select class="choices form-select tipe-select" name="details[${detailCount}][tipe]" id="tipe-${detailCount}">
                    <option selected disabled value="">Pilih...</option>
                    <option value="1">Bahan</option>
                    <option value="2">Upah</option>
                    <option value="3">Alat</option>
                </select>
            </div>
        </div>
        <div class="col-md-5 col-12">
            <div class="form-group">
                <label for="nama-${detailCount}">Nama</label>
                <input type="text" id="nama-${detailCount}" class="form-control" name="details[${detailCount}][nama]">
            </div>
        </div>
        <div class="col-md-1 col-12 d-flex align-items-center">
            <span class="delete-icon">×</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-12">
            <div class="form-group">
                <label for="satuan_id-${detailCount}">Satuan</label>
                <select class="choices form-select" name="details[${detailCount}][satuan_id]" id="satuan_id-${detailCount}">
                    <option selected disabled value="">Pilih...</option>
                    @foreach ($satuan as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="form-group">
                <label for="harga-${detailCount}" id="label-harga-${detailCount}">Harga per Satuan</label>
                <input type="number" id="harga-${detailCount}" class="form-control" name="details[${detailCount}][harga]">
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="form-group">
                <label for="kuantitas-${detailCount}" id="label-JumlahKuantitas-${detailCount}">Jumlah Kuantitas</label>
                <input type="number" id="kuantitas-${detailCount}" class="form-control" name="details[${detailCount}][kuantitas]">
            </div>
        </div>
        <div class="col-md-3 col-12" id="kuantitas-item-container-${detailCount}"></div>
    </div>
</div>

    `;

            document.getElementById('additional-details').appendChild(newDetail);

            new Choices(`#tipe-${detailCount}`);
            new Choices(`#satuan_id-${detailCount}`);

            const tipeSelect = newDetail.querySelector('.tipe-select');
            const hargaLabel = newDetail.querySelector(`#label-harga-${detailCount}`);
            const JumlahKuantitasLabel = newDetail.querySelector(`#label-JumlahKuantitas-${detailCount}`);
            tipeSelect.addEventListener('change', function() {
                const kuantitasItemContainer = document.getElementById(
                    `kuantitas-item-container-${detailCount}`);

                if (this.value == "2" || this.value == "3") {
                    if (this.value == "2") {
                        hargaLabel.textContent = 'Upah per Satuan';
                        JumlahKuantitasLabel.textContent = 'Jumlah Pekerja';
                    } else if (this.value == "3") {
                        hargaLabel.textContent = 'Harga per Satuan';
                        JumlahKuantitasLabel.textContent = 'Jumlah Alat';
                    }

                    if (!kuantitasItemContainer.innerHTML) {
                        kuantitasItemContainer.innerHTML = `
                <div class="form-group">
                    <label for="kuantitas_item-${detailCount}" id="label-kuantitasItem-${detailCount}">Kuantitas Berdasarkan Satuan</label>
                    <input type="number" id="kuantitas_item-${detailCount}" class="form-control" name="details[${detailCount}][kuantitas_item]">
                </div>
            `;
                    }
                    const KuantitasItemLabel = newDetail.querySelector(
                        `#label-kuantitasItem-${detailCount}`);
                    if (this.value == "2") {
                        KuantitasItemLabel.textContent = 'Jumlah Hari';
                    } else if (this.value == "3") {
                        KuantitasItemLabel.textContent = 'Kuantitas Berdasarkan Satuan';
                    }
                } else {
                    hargaLabel.textContent = 'Harga per Satuan';
                    JumlahKuantitasLabel.textContent = 'Jumlah Kuantitas';
                    kuantitasItemContainer.innerHTML = '';
                }
            });
            // Set kuantitas input visibility based on initial selection
            tipeSelect.dispatchEvent(new Event('change'));

            // Event listener for delete icon
            newDetail.querySelector('.delete-icon').addEventListener('click', function() {
                newDetail.remove();
            });
        });

        // Event listener for existing delete icons
        document.querySelectorAll('.delete-icon').forEach(function(icon) {
            icon.addEventListener('click', function() {
                icon.closest('.card').remove();
            });
        });
    </script>
@endpush
