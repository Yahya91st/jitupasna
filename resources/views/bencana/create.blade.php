@extends('layouts.main')
<style>
    .row {
        margin-bottom: 20px;
    }

    /* Adjust the width of the Quill editor */
    .ql-container {
        width: 100% !important;
        /* or specify a fixed width like 300px */
        max-width: 100%;
        height: 300px !important;
        /* ensures it doesn't exceed its container's width */
    }

    .background {
        position: fixed;
        /* atau 'absolute', tergantung kebutuhan */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Warna gelap dengan transparansi */
        z-index: 1;
        /* Pastikan lebih tinggi dari elemen lain kecuali modal */
    }

    .overlay {
        z-index: 2;
        /* Pastikan lebih tinggi dari elemen lain kecuali modal */
    }

    img {
        display: block;
        max-width: 100%;
    }

    .image-container {
        overflow: hidden;
        max-width: 510px !important;
        max-height: 370px !important;
    }

    .preview {
        display: none;
    }

    @media (min-width: 768px) {

        /* Adjust the large (lg) screen breakpoint */
        .modal-lg {
            --bs-modal-width: 700px;
            /* Set your desired minimum width for large screens (lg) */
        }

        .preview {
            display: block;
            overflow: hidden;
            width: 210px;
            height: 210px;
            border: 1px solid red;
        }
    }

    .select2-container .select2-selection--single {
        height: 38px !important;
        /* Atur tinggi sesuai kebutuhan */
        display: flex;
        align-items: center;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px !important;
        /* Sesuaikan dengan tinggi yang diatur */
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px !important;
        /* Sesuaikan dengan tinggi yang diatur - 2px untuk padding */
    }

    .select2-container .select2-dropdown .select2-results__options {
        max-height: 220px;
        /* Atur tinggi maksimum sesuai kebutuhan */
    }
</style>
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Data Bencana</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('bencana.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Kategori Bencana</label>
                                            <div class="form-group">
                                                <select class="choices form-select" name="kategori_bencana_id">
                                                    <option selected disabled value="">{{ __('Pilih...') }}</option>
                                                    @foreach ($kategoribencana as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Tanggal Bencana</label>
                                            <input type="date" id="last-name-column" class="form-control" placeholder="" name="tanggal">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="province">Provinsi</label>
                                            <select id="province" name="province_code" class="form-control">
                                                <option value="">Memuat provinsi...</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="regency">Kabupaten</label>
                                            <select id="regency" name="regency_code" class="form-control">
                                                <option value="">Pilih Kabupaten/Kota</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="kecamatan">Kecamatan</label>
                                            <select id="kecamatan" name="district_code" class="form-control">
                                                <option value="">Pilih Kecamatan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="desa">Desa</label>
                                            <select id="desa" name="village_code" class="form-control" multiple>
                                                <!-- jika tidak multi, hapus atribut multiple -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Deskripsi</label>
                                            <div id="full"></div>
                                            <input type="hidden" name="deskripsi" id="deskripsi">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <div class="card-header pb-4 border-dashed rounded" style="border: 1px dashed rgb(94, 87, 87);">
                                                        <div class="profile-img-edit position-relative d-flex justify-content-center align-items-center">
                                                            <img src="/frontend/dist/assets/images/avatar/no-image.png" id="firstImage" alt="profile-pic" class="theme-color-default-img profile-pic rounded avatar-100">
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="croppedImageData" name="avatar">
                                                    <div class="img-extension mt-3">
                                                        <div class="row">
                                                            <div>
                                                                <div class="d-inline-block align-items-center py-1">
                                                                    <span>Only</span>
                                                                    <a href="#">.jpg</a>
                                                                    <a href="#">.png</a>
                                                                    <a href="#">.jpeg</a>
                                                                    <span>allowed</span>
                                                                </div>
                                                                <div class="d-inline-block align-items-center">
                                                                    <span>Max. File size</span>
                                                                    <a href="#">10 MB</a>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <button type="button" id="chooseImageButton">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" viewBox="0 0 24 24">
                                                                        <path fill="#5A8DEE" d="M11 16V7.85l-2.6 2.6L7 9l5-5l5 5l-1.4 1.45l-2.6-2.6V16zm-5 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z" />
                                                                    </svg>
                                                                    <input type="file" name="image" class="image" id="imageInput" style="display: none;">
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for image preview and cropping -->
        <div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Crop Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="docs-demo">
                                    <div class="image-container">
                                        <img id="image" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 px-0">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="crop">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="{{ asset('frontend/dist/assets/vendors/quill/quill.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Image cropper ---
            var bs_modal = $('#modal');
            var image = document.getElementById('image');
            var cropper, reader, file;

            $("body").on("change", ".image", function(e) {
                var files = e.target.files;
                var maxFileSizeInBytes = 10 * 1024 * 1024;
                var allowedExtensions = ['jpg', 'jpeg', 'png'];

                if (files && files.length > 0) {
                    file = files[0];
                    var fileExtension = file.name.split('.').pop().toLowerCase();

                    if (!allowedExtensions.includes(fileExtension)) {
                        alert("Only .jpg, .jpeg, and .png files are allowed.");
                        $(this).val('');
                        return;
                    }

                    if (file.size > maxFileSizeInBytes) {
                        alert("File size exceeds the maximum allowed size.");
                        $(this).val('');
                        return;
                    }

                    var done = function(url) {
                        image.src = url;
                        bs_modal.modal('show');
                    };

                    if (window.URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function() {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
                $(this).val('');
            });

            bs_modal.on('shown.bs.modal', function() {
                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                    dragMode: 'move',
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function() {
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
            });

            $("#crop").click(function() {
                if (!cropper) return;
                var canvas = cropper.getCroppedCanvas({
                    width: 300,
                    height: 300
                });
                var croppedImage = canvas.toDataURL();
                $("#firstImage").attr("src", croppedImage);
                $("#croppedImageData").val(croppedImage);
                bs_modal.modal('hide');
            });

            document.getElementById('chooseImageButton').addEventListener('click', function() {
                document.getElementById('imageInput').click();
            });

            // --- Quill editors ---
            function initializeQuill(selector) {
                return new Quill(selector, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{
                                font: []
                            }, {
                                size: []
                            }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{
                                color: []
                            }, {
                                background: []
                            }],
                            [{
                                script: 'super'
                            }, {
                                script: 'sub'
                            }],
                            [{
                                list: 'ordered'
                            }, {
                                list: 'bullet'
                            }, {
                                indent: '-1'
                            }, {
                                indent: '+1'
                            }],
                            ['direction', {
                                align: []
                            }],
                            ['link', 'image', 'video'],
                            ['clean']
                        ]
                    }
                });
            }

            var descriptionEditor = document.querySelector('#full') ? initializeQuill('#full') : null;
            var notesEditor = document.querySelector('#full-nama') ? initializeQuill('#full-nama') : null;

            var form = document.querySelector('form');
            if (form) {
                form.onsubmit = function() {
                    if (descriptionEditor && document.querySelector('#deskripsi')) {
                        document.querySelector('#deskripsi').value = descriptionEditor.root.innerHTML;
                    }
                    if (notesEditor && document.querySelector('#nama')) {
                        document.querySelector('#nama').value = notesEditor.root.innerHTML;
                    }
                };
            }

            // --- Wilayah selects (single DOMContentLoaded handler) ---
            var $prov = document.getElementById('province');
            var $reg = document.getElementById('regency');
            var $kec = document.getElementById('kecamatan');
            var $desa = document.getElementById('desa');

            if ($prov && $reg && $kec && $desa) {
                const apiBase = 'https://wilayah.id/api';
                const choicesDesa = new Choices('#desa', {
                    removeItemButton: true,
                    placeholderValue: 'Pilih Desa...'
                });

                function cacheGet(key) {
                    try {
                        return JSON.parse(sessionStorage.getItem(key));
                    } catch {
                        return null;
                    }
                }

                function cacheSet(key, val) {
                    try {
                        sessionStorage.setItem(key, JSON.stringify(val));
                    } catch {}
                }

                function setOptions($el, list, placeholder = 'Pilih...') {
                    const normalized = Array.isArray(list) ? list : (list && list.data ? list.data : []);
                    $el.innerHTML = `<option value="">${placeholder}</option>`;
                    normalized.forEach(item => {
                        const opt = document.createElement('option');
                        opt.value = item.code ?? item.id ?? '';
                        opt.textContent = item.name ?? item.nama ?? opt.value;
                        $el.appendChild(opt);
                    });
                    try {
                        $el.selectedIndex = 0;
                    } catch (e) {}
                    console.log(`[wilayah] setOptions for #${$el.id} count=`, normalized.length);
                }

                function fetchJson(url) {
                    return fetch(url).then(r => {
                        if (!r.ok) throw new Error('Network response not ok');
                        return r.json();
                    });
                }

                (function loadProvinces() {
                    const key = 'wilayah:provinces';
                    const cached = cacheGet(key);
                    if (cached) {
                        setOptions($prov, cached, 'Pilih Provinsi');
                        return;
                    }

                    fetchJson(`${apiBase}/provinces.json`)
                        .then(resp => {
                            const list = Array.isArray(resp) ? resp : (resp.data ?? []);
                            cacheSet(key, list);
                            setOptions($prov, list, 'Pilih Provinsi');
                        })
                        .catch(() => {
                            fetchJson('/wilayah/provinces')
                                .then(localResp => {
                                    const list = Array.isArray(localResp) ? localResp : (localResp.data ?? []);
                                    cacheSet(key, list);
                                    setOptions($prov, list, 'Pilih Provinsi');
                                })
                                .catch(err => {
                                    console.error('[wilayah] loadProvinces failed', err);
                                    setOptions($prov, [], 'Error memuat provinsi');
                                });
                        });
                })
                ();

                $prov.addEventListener('change', function() {
                    try {
                        const code = this.value;
                        console.log('[wilayah] province.change, code=', code);
                        setOptions($reg, [], 'Memuat...');
                        setOptions($kec, [], 'Pilih Kecamatan');
                        choicesDesa.clearStore();

                        if (!code) {
                            setOptions($reg, [], 'Pilih Kabupaten/Kota');
                            return;
                        }

                        const key = `wilayah:regencies:${code}`;
                        const cached = cacheGet(key);
                        if (cached) {
                            setOptions($reg, cached, 'Pilih Kabupaten/Kota');
                            return;
                        }

                        const externalUrl = `${apiBase}/regencies/${encodeURIComponent(code)}.json`;
                        fetchJson(externalUrl)
                            .then(resp => {
                                const list = Array.isArray(resp) ? resp : (resp.data ?? []);
                                cacheSet(key, list);
                                setOptions($reg, list, 'Pilih Kabupaten/Kota');
                            })
                            .catch(() => {
                                fetchJson(`/wilayah/regencies/${encodeURIComponent(code)}`)
                                    .then(localResp => {
                                        const list = Array.isArray(localResp) ? localResp : (localResp.data ?? []);
                                        cacheSet(key, list);
                                        setOptions($reg, list, 'Pilih Kabupaten/Kota');
                                    })
                                    .catch(err => {
                                        console.error('[wilayah] reg local error', err);
                                        setOptions($reg, [], 'Error memuat kabupaten');
                                    });
                            });
                    } catch (e) {
                        console.error('[wilayah] province.change handler error', e);
                        setOptions($reg, [], 'Error memuat kabupaten');
                    }
                });

                $reg.addEventListener('change', function() {
                    const code = this.value;
                    setOptions($kec, [], 'Memuat...');
                    choicesDesa.clearStore();
                    if (!code) {
                        setOptions($kec, [], 'Pilih Kecamatan');
                        return;
                    }

                    const key = `wilayah:districts:${code}`;
                    const cached = cacheGet(key);
                    if (cached) {
                        setOptions($kec, cached, 'Pilih Kecamatan');
                        return;
                    }

                    fetchJson(`${apiBase}/districts/${encodeURIComponent(code)}.json`)
                        .then(resp => {
                            const list = Array.isArray(resp) ? resp : (resp.data ?? []);
                            cacheSet(key, list);
                            setOptions($kec, list, 'Pilih Kecamatan');
                        })
                        .catch(() => {
                            fetchJson(`/wilayah/districts/${encodeURIComponent(code)}`)
                                .then(localResp => {
                                    const list = Array.isArray(localResp) ? localResp : (localResp.data ?? []);
                                    cacheSet(key, list);
                                    setOptions($kec, list, 'Pilih Kecamatan');
                                })
                                .catch(err => {
                                    console.error('[wilayah] kec local error', err);
                                    setOptions($kec, [], 'Error memuat kecamatan');
                                });
                        });
                });

                $kec.addEventListener('change', function() {
                    const code = this.value;
                    choicesDesa.clearStore();
                    if (!code) return;

                    const key = `wilayah:villages:${code}`;
                    const cached = cacheGet(key);
                    if (cached) {
                        choicesDesa.setChoices(cached.map(v => ({
                            value: v.code,
                            label: v.name
                        })), 'value', 'label', false);
                        return;
                    }

                    fetchJson(`${apiBase}/villages/${encodeURIComponent(code)}.json`)
                        .then(resp => {
                            const list = Array.isArray(resp) ? resp : (resp.data ?? []);
                            cacheSet(key, list);
                            choicesDesa.setChoices(list.map(v => ({
                                value: v.code,
                                label: v.name
                            })), 'value', 'label', false);
                        })
                        .catch(() => {
                            fetchJson(`/wilayah/villages/${encodeURIComponent(code)}`)
                                .then(localResp => {
                                    const list = Array.isArray(localResp) ? localResp : (localResp.data ?? []);
                                    cacheSet(key, list);
                                    choicesDesa.setChoices(list.map(v => ({
                                        value: v.code,
                                        label: v.name
                                    })), 'value', 'label', false);
                                })
                                .catch(err => {
                                    console.error('[wilayah] village local error', err);
                                });
                        });
                });
            }
        }); // end DOMContentLoaded
    </script>
@endpush
