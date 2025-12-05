@extends('layouts.main')

@section('content')
<style>
    :root {
        --orange-primary: #F28705;
        --orange-gradient: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
    }

    .row {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .main-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .card-header-gradient {
        background: var(--orange-gradient);
        padding: 1.5rem;
    }

    .card-header-gradient h4 {
        color: white;
        margin: 0;
        font-weight: 600;
        font-size: 1.25rem;
    }

    .info-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .info-card-header {
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        padding: 1rem 1.5rem;
    }

    .info-card-header h4 {
        color: white;
        margin: 0;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .table-container {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: collapse;
    }

    .table thead th {
        background: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
        color: #495057;
    }

    .location-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .location-list li {
        padding: 0.25rem 0;
        color: #495057;
        position: relative;
        padding-left: 1rem;
    }

    .location-list li:before {
        content: "•";
        color: #2196F3;
        font-weight: bold;
        position: absolute;
        left: 0;
    }

    .card-content {
        padding: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: block;
        font-size: 0.9rem;
    }

    .form-control,
    .form-select {
        width: 100%;
        padding: 0.625rem 0.875rem;
        font-size: 0.9rem;
        border: 1px solid #ced4da;
        border-radius: 8px;
        transition: all 0.3s ease;
        background-color: white;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--orange-primary);
        box-shadow: 0 0 0 0.2rem rgba(242, 135, 5, 0.25);
        outline: none;
    }

    .form-control:read-only {
        background-color: #f8f9fa;
        cursor: not-allowed;
    }

    #quill-deskripsi {
        width: 100% !important;
        min-height: 150px;
        box-sizing: border-box;
        border-radius: 8px;
    }

    .ql-container {
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .ql-toolbar {
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .detail-card {
        border: 2px solid #dee2e6;
        border-radius: 12px;
        margin-top: 1rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .detail-card:hover {
        border-color: var(--orange-primary);
        box-shadow: 0 2px 8px rgba(242, 135, 5, 0.15);
    }

    .detail-card .card-body {
        padding: 1.5rem;
    }

    .btn-add-detail {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border: none;
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-add-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        color: white;
    }

    .btn-submit {
        background: var(--orange-gradient);
        color: white;
        border: none;
        padding: 0.625rem 2rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(242, 135, 5, 0.3);
        color: white;
    }

    .delete-icon {
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .delete-icon:hover {
        transform: scale(1.1);
    }

    .delete-icon:hover path {
        stroke: #c82333;
    }

    @media (max-width: 768px) {
        .card-header-gradient,
        .info-card-header {
            padding: 1rem;
        }

        .card-header-gradient h4,
        .info-card-header h4 {
            font-size: 1rem;
        }

        .card-content {
            padding: 1rem;
        }

        .table thead th,
        .table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.85rem;
        }

        .detail-card .card-body {
            padding: 1rem;
        }
    }
</style>

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <!-- Info Card -->
            <div class="info-card">
                <div class="info-card-header">
                    <h4>
                        <i data-feather="info" style="width: 18px; height: 18px; margin-right: 8px;"></i>
                        Informasi Bencana
                    </h4>
                </div>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Bencana ID</th>
                                <th>Bencana</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $bencana->id }}</td>
                                <td>{{ $bencana->kategori_bencana->nama }}</td>
                                <td>
                                    <ul class="location-list">
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

            <!-- Form Card -->
            <div class="main-card">
                <form class="form" id="kerusakan-form" action="{{ route('kerusakan.store', ['id' => $bencana->id]) }}" method="POST">
                    @csrf
                    <div class="card-header-gradient">
                        <h4>
                            <i data-feather="edit-3" style="width: 20px; height: 20px; margin-right: 8px;"></i>
                            Tambah Data Kerusakan
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="kategori-bangunan">
                                        <i data-feather="home" style="width: 14px; height: 14px; margin-right: 4px;"></i>
                                        Tipe Bangunan
                                    </label>
                                    <select class="choices form-select" name="kategori_bangunan_id" id="kategori-bangunan" required>
                                        <option selected disabled value="">Pilih Tipe Bangunan...</option>
                                        @foreach ($kategoribangunan as $item)
                                            <option value="{{ $item->id }}" {{ old('kategori_bangunan_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="deskripsi">
                                        <i data-feather="file-text" style="width: 14px; height: 14px; margin-right: 4px;"></i>
                                        Deskripsi
                                    </label>
                                    <div id="quill-deskripsi"></div>
                                    <input type="hidden" id="deskripsi" name="deskripsi">
                                </div>
                            </div>
                        </div>

                        <div id="additional-details"></div>

                        <div class="row">
                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="button" id="add-detail-btn" class="btn-add-detail">
                                    <i data-feather="plus-circle" style="width: 18px; height: 18px;"></i>
                                    Tambah Detail
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn-submit">
                                    <i data-feather="save" style="width: 18px; height: 18px; margin-right: 6px;"></i>
                                    Submit Data
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    // Initialize Feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
</script>
@endsection

@push('script')
<script src="{{ asset('frontend/dist/assets/vendors/quill/quill.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function initializeQuill(selector) {
            return new Quill(selector, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ font: [] }, { size: [] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ color: [] }, { background: [] }],
                        [{ script: 'super' }, { script: 'sub' }],
                        [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                        ['direction', { align: [] }],
                        ['clean']
                    ]
                }
            });
        }

        // Initialize Quill editor
        const descriptionEditor = initializeQuill('#quill-deskripsi');

        // Set hidden input value on form submit
        document.querySelector('form').onsubmit = function() {
            document.querySelector('#deskripsi').value = descriptionEditor.root.innerHTML;
        };
    });
</script>

<script>
    document.getElementById('add-detail-btn').addEventListener('click', function() {
        const detailCount = document.querySelectorAll('#additional-details .detail-card').length;

        const newDetail = document.createElement('div');
        newDetail.classList.add('detail-card');
        newDetail.innerHTML = `
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="tipe-${detailCount}">
                                <i data-feather="layers" style="width: 14px; height: 14px; margin-right: 4px;"></i>
                                Tipe
                            </label>
                            <select class="choices form-select tipe-select" name="details[${detailCount}][tipe]" id="tipe-${detailCount}" required>
                                <option selected disabled value="">Pilih Tipe...</option>
                                <option value="1">Bahan</option>
                                <option value="2">Upah</option>
                                <option value="3">Alat</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 col-12">
                        <div class="form-group">
                            <label for="nama-${detailCount}">
                                <i data-feather="tag" style="width: 14px; height: 14px; margin-right: 4px;"></i>
                                Nama
                            </label>
                            <select id="nama-${detailCount}" class="choices form-select nama-select" name="details[${detailCount}][nama]">
                                <option selected disabled value="">Pilih Nama...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1 col-12 d-flex align-items-center justify-content-center">
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
                </div>
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="satuan-${detailCount}">Satuan</label>
                            <input type="text" id="satuan-${detailCount}" class="form-control satuan" name="details[${detailCount}][satuan]" readonly>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="harga-${detailCount}" id="label-harga-${detailCount}">Harga per Satuan</label>
                            <input type="text" id="harga-${detailCount}" class="form-control harga" name="details[${detailCount}][harga]" readonly>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label for="kuantitas-${detailCount}" id="label-JumlahKuantitas-${detailCount}">Jumlah Kuantitas</label>
                            <input type="text" id="kuantitas-${detailCount}" class="form-control" name="details[${detailCount}][kuantitas]" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-12" id="kuantitas-item-container-${detailCount}"></div>
                </div>
            </div>
        `;

        document.getElementById('additional-details').appendChild(newDetail);

        // Initialize Feather icons for new card
        if (typeof feather !== 'undefined') {
            feather.replace();
        }

        // Initialize Choices.js for Tipe and Nama dropdowns
        const tipeSelectElement = new Choices(document.getElementById(`tipe-${detailCount}`));
        const namaSelectElement = new Choices(document.getElementById(`nama-${detailCount}`));

        const tipeSelect = newDetail.querySelector('.tipe-select');
        const namaSelect = newDetail.querySelector('.nama-select');

        // Event listener for Tipe selection
        tipeSelect.addEventListener('change', function() {
            const tipe = this.value;
            const kuantitasItemContainer = newDetail.querySelector(`#kuantitas-item-container-${detailCount}`);
            const hargaLabel = newDetail.querySelector(`#label-harga-${detailCount}`);
            const JumlahKuantitasLabel = newDetail.querySelector(`#label-JumlahKuantitas-${detailCount}`);

            // Reset related fields when Tipe changes
            newDetail.querySelector(`#nama-${detailCount}`).value = '';
            newDetail.querySelector(`#satuan-${detailCount}`).value = '';
            newDetail.querySelector(`#harga-${detailCount}`).value = '';
            namaSelectElement.clearChoices();
            namaSelectElement.setChoices([{
                value: '',
                label: 'Pilih Nama...',
                selected: true,
                disabled: true
            }], 'value', 'label', true);

            if (tipe) {
                namaSelectElement.clearChoices();
                namaSelectElement.setChoices([{
                    value: '',
                    label: 'Pilih Nama...',
                    selected: true,
                    disabled: true
                }], 'value', 'label', true);

                fetch(`/get-nama-by-tipe/${tipe}`)
                    .then(response => response.json())
                    .then(data => {
                        const choices = data.map(item => ({
                            value: item.id,
                            label: item.nama,
                            customProperties: {
                                satuan: item.satuan,
                                harga: item.harga
                            }
                        }));
                        namaSelectElement.setChoices(choices, 'value', 'label');
                    })
                    .catch(error => console.error('Error:', error));

                if (tipe == "2") {
                    hargaLabel.textContent = 'Upah Tiap Satuan Dalam Rupiah';
                    JumlahKuantitasLabel.textContent = 'Kuantitas Berdasarkan Satuan';

                    if (!kuantitasItemContainer.innerHTML) {
                        kuantitasItemContainer.innerHTML = `
                            <div class="form-group">
                                <label for="kuantitas_item-${detailCount}" id="label-kuantitasItem-${detailCount}">Jumlah Pekerja</label>
                                <input type="number" id="kuantitas_item-${detailCount}" class="form-control" name="details[${detailCount}][kuantitas_item]" required>
                            </div>
                        `;
                    }
                } else if (tipe == "3") {
                    hargaLabel.textContent = 'Harga Tiap Satuan Dalam Rupiah';
                    JumlahKuantitasLabel.textContent = 'Jumlah Alat';

                    if (!kuantitasItemContainer.innerHTML) {
                        kuantitasItemContainer.innerHTML = `
                            <div class="form-group">
                                <label for="kuantitas_item-${detailCount}" id="label-kuantitasItem-${detailCount}">Jumlah Berdasarkan Satuan</label>
                                <input type="number" id="kuantitas_item-${detailCount}" class="form-control" name="details[${detailCount}][kuantitas_item]" required>
                            </div>
                        `;
                    }
                } else {
                    hargaLabel.textContent = 'Harga Tiap Satuan Dalam Rupiah';
                    JumlahKuantitasLabel.textContent = 'Jumlah Kuantitas';
                    kuantitasItemContainer.innerHTML = '';
                }
            } else {
                namaSelectElement.clearChoices();
                namaSelectElement.setChoices([{
                    value: '',
                    label: 'Pilih Nama...',
                    selected: true,
                    disabled: true
                }], 'value', 'label', true);
            }
        });

        // Event listener for Nama selection
        namaSelectElement.passedElement.element.addEventListener('change', function() {
            const selectedOption = namaSelectElement.getValue(true);
            const selectedItem = namaSelectElement.getValue(true);

            if (selectedItem) {
                const selectedOptionElement = namaSelectElement._currentState.items.find(item => item.value == selectedOption);
                const satuan = selectedOptionElement.customProperties.satuan;
                const harga = selectedOptionElement.customProperties.harga;

                newDetail.querySelector(`#satuan-${detailCount}`).value = satuan;
                newDetail.querySelector(`#harga-${detailCount}`).value = harga;
            }
        });

        // Set initial state for new card
        tipeSelect.dispatchEvent(new Event('change'));

        // Event listener for delete icon
        newDetail.querySelector('.delete-icon').addEventListener('click', function() {
            newDetail.remove();
        });

        // Event listener for kuantitas input
        newDetail.querySelector(`#kuantitas-${detailCount}`).addEventListener('blur', function() {
            let value = this.value.replace(',', '.');
            if (!isNaN(value) && parseFloat(value) === Number(value)) {
                this.value = parseFloat(value).toFixed(2);
            } else {
                alert("Mohon masukkan nilai yang valid.");
            }
        });
    });

    // Event listener for existing delete icons
    document.querySelectorAll('.delete-icon').forEach(function(icon) {
        icon.addEventListener('click', function() {
            icon.closest('.detail-card').remove();
        });
    });
</script>
@endpush
