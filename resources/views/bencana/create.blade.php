@extends('layouts.main')

@section('content')
<style>
    :root {
        --orange-primary: #F28705;
        --orange-gradient: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
    }

    .main-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.04);
    }

    .card-header-gradient {
        background: var(--orange-gradient);
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header-gradient h4 {
        color: white;
        margin: 0;
        font-weight: 700;
        font-size: 1.15rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-content {
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: block;
        font-size: 0.9rem;
    }

    .form-control, .form-select {
        padding: 0.625rem 0.875rem;
        border-radius: 8px;
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--orange-primary);
        box-shadow: 0 0 0 0.2rem rgba(242, 135, 5, 0.15);
        outline: none;
    }

    .ql-container {
        min-height: 200px;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .ql-toolbar {
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        background: #f8f9fa;
    }

    .image-upload-card {
        border: 2px dashed #dee2e6;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .image-upload-card:hover {
        border-color: var(--orange-primary);
        background: #fff3e0;
    }

    .profile-pic {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 12px;
        margin: 0 auto 1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: block;
    }

    .upload-btn {
        background: var(--orange-gradient);
        color: white;
        border: none;
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .upload-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(242, 135, 5, 0.3);
    }

    .file-info {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 0.75rem;
    }

    .file-info a {
        color: var(--orange-primary);
        font-weight: 600;
        text-decoration: none;
    }

    .btn-orange {
        background: var(--orange-gradient);
        color: white;
        border: none;
        padding: 0.625rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-orange:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(242, 135, 5, 0.3);
        color: white;
    }

    .btn-light-secondary {
        background: #f8f9fa;
        color: #6c757d;
        border: 1px solid #dee2e6;
        padding: 0.625rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-light-secondary:hover {
        background: #e9ecef;
        border-color: #adb5bd;
    }

    .image-container {
        overflow: hidden;
        max-width: 510px;
        max-height: 370px;
    }

    .preview {
        display: none;
    }

    @media (min-width: 768px) {
        .modal-lg {
            --bs-modal-width: 700px;
        }

        .preview {
            display: block;
            overflow: hidden;
            width: 210px;
            height: 210px;
            border: 2px solid var(--orange-primary);
            border-radius: 8px;
        }
    }

    .modal-content {
        border-radius: 12px;
        border: none;
        overflow: hidden;
    }

    .modal-header {
        background: var(--orange-gradient);
        color: white;
        border: none;
        padding: 1.25rem 1.5rem;
    }

    .modal-header h5 {
        color: white;
        margin: 0;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .modal-header .close {
        color: white;
        opacity: 0.8;
        text-shadow: none;
    }

    .modal-header .close:hover {
        opacity: 1;
    }

    .choices__inner {
        border-radius: 8px;
        border: 1px solid #ced4da;
        padding: 0.375rem 0.5rem;
    }

    .choices[data-type*=select-multiple] .choices__inner {
        min-height: 44px;
    }

    @media (max-width: 768px) {
        .card-content {
            padding: 1.5rem;
        }

        .profile-pic {
            width: 150px;
            height: 150px;
        }

        .card-header-gradient {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }
    }
</style>

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card main-card">
                <div class="card-header card-header-gradient">
                    <h4>
                        <i data-feather="plus-circle" style="width: 20px; height: 20px;"></i>
                        Tambah Data Bencana
                    </h4>
                    <a href="{{ route('bencana.index') }}" class="btn btn-light-secondary">
                        <i data-feather="arrow-left" style="width: 16px; height: 16px;"></i>
                        Kembali
                    </a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="{{ route('bencana.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="kategori_bencana_id">Kategori Bencana</label>
                                        <select class="choices form-select" name="kategori_bencana_id" id="kategori_bencana_id" required>
                                            <option value="">Pilih...</option>
                                            @foreach ($kategoribencana as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Bencana</label>
                                        <input type="date" id="tanggal" class="form-control" name="tanggal" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="province">Provinsi</label>
                                        <select id="province" name="province_code" class="form-control" required>
                                            <option value="">Memuat provinsi...</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="regency">Kabupaten/Kota</label>
                                        <select id="regency" name="regency_code" class="form-control" required>
                                            <option value="">Pilih Kabupaten/Kota</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <select id="kecamatan" name="district_code" class="form-control" required>
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="desa">Desa (dapat pilih lebih dari satu)</label>
                                        <select id="desa" name="village_code[]" class="form-control" multiple required>
                                            <option value="">Pilih Desa...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <div id="full"></div>
                                        <input type="hidden" name="deskripsi" id="deskripsi">
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Gambar Bencana</label>
                                        <div class="image-upload-card">
                                            <img src="/frontend/dist/assets/images/avatar/no-image.png" 
                                                 id="firstImage" 
                                                 alt="Preview" 
                                                 class="profile-pic">
                                            <input type="hidden" id="croppedImageData" name="avatar">
                                            <button type="button" class="upload-btn" id="chooseImageButton">
                                                <i data-feather="upload" style="width: 18px; height: 18px;"></i>
                                                Pilih Gambar
                                            </button>
                                            <input type="file" name="image" class="image" id="imageInput" accept=".jpg,.jpeg,.png" style="display: none;">
                                            <div class="file-info">
                                                <div>Format: <a href="#">.jpg</a>, <a href="#">.png</a>, <a href="#">.jpeg</a></div>
                                                <div>Max. ukuran: <a href="#">10 MB</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                                <button type="reset" class="btn btn-light-secondary">
                                    <i data-feather="x" style="width: 16px; height: 16px;"></i>
                                    Reset
                                </button>
                                <button type="submit" class="btn btn-orange">
                                    <i data-feather="save" style="width: 16px; height: 16px;"></i>
                                    Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for image preview and cropping -->
    <div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">
                        <i data-feather="crop" style="width: 20px; height: 20px;"></i>
                        Crop Gambar
                    </h5>
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
                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i data-feather="x" style="width: 16px; height: 16px;"></i>
                        Batal
                    </button>
                    <button type="button" class="btn btn-orange" id="crop">
                        <i data-feather="check" style="width: 16px; height: 16px;"></i>
                        Simpan Perubahan
                    </button>
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
    // Initialize Feather Icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }

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
                alert("Hanya file .jpg, .jpeg, dan .png yang diperbolehkan.");
                $(this).val('');
                return;
            }

            if (file.size > maxFileSizeInBytes) {
                alert("Ukuran file melebihi batas maksimal 10 MB.");
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

    // --- Quill editor ---
    var descriptionEditor = new Quill('#full', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ font: [] }, { size: [] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ color: [] }, { background: [] }],
                [{ script: 'super' }, { script: 'sub' }],
                [{ list: 'ordered' }, { list: 'bullet' }, { indent: '-1' }, { indent: '+1' }],
                ['direction', { align: [] }],
                ['link', 'image', 'video'],
                ['clean']
            ]
        }
    });

    // --- Form submit handler ---
    var form = document.querySelector('form');
    if (form) {
        form.onsubmit = function() {
            document.querySelector('#deskripsi').value = descriptionEditor.root.innerHTML;
        };
    }

    // --- Wilayah selects ---
    var $prov = document.getElementById('province');
    var $reg = document.getElementById('regency');
    var $kec = document.getElementById('kecamatan');
    var $desa = document.getElementById('desa');

    if ($prov && $reg && $kec && $desa) {
        const apiBase = 'https://wilayah.id/api';
        
        // Initialize Choices.js for desa (multi-select)
        const choicesDesa = new Choices('#desa', {
            removeItemButton: true,
            placeholderValue: 'Pilih Desa...',
            searchEnabled: true,
            searchPlaceholderValue: 'Cari desa...'
        });

        function cacheGet(key) {
            try {
                const data = sessionStorage.getItem(key);
                return data ? JSON.parse(data) : null;
            } catch {
                return null;
            }
        }

        function cacheSet(key, val) {
            try {
                sessionStorage.setItem(key, JSON.stringify(val));
            } catch (e) {
                console.error('Cache set error:', e);
            }
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
            $el.selectedIndex = 0;
            console.log(`[wilayah] setOptions for #${$el.id}, count=${normalized.length}`);
        }

        function fetchJson(url) {
            return fetch(url, { 
                method: 'GET',
                headers: { 'Accept': 'application/json' }
            }).then(r => {
                if (!r.ok) throw new Error(`HTTP ${r.status}`);
                return r.json();
            });
        }

        // Load provinces on page load
        (function loadProvinces() {
            const key = 'wilayah:provinces';
            const cached = cacheGet(key);
            
            if (cached) {
                console.log('[wilayah] Loading provinces from cache');
                setOptions($prov, cached, 'Pilih Provinsi');
                return;
            }

            console.log('[wilayah] Fetching provinces from API');
            fetchJson(`${apiBase}/provinces.json`)
                .then(resp => {
                    const list = Array.isArray(resp) ? resp : (resp.data ?? []);
                    if (list.length > 0) {
                        cacheSet(key, list);
                        setOptions($prov, list, 'Pilih Provinsi');
                    } else {
                        throw new Error('Empty province list');
                    }
                })
                .catch(err => {
                    console.error('[wilayah] External API failed, trying local:', err);
                    fetchJson('/wilayah/provinces')
                        .then(localResp => {
                            const list = Array.isArray(localResp) ? localResp : (localResp.data ?? []);
                            cacheSet(key, list);
                            setOptions($prov, list, 'Pilih Provinsi');
                        })
                        .catch(localErr => {
                            console.error('[wilayah] Local API also failed:', localErr);
                            setOptions($prov, [], 'Error memuat provinsi - Refresh halaman');
                        });
                });
        })();

        // Province change handler
        $prov.addEventListener('change', function() {
            const code = this.value;
            console.log('[wilayah] Province changed:', code);
            
            setOptions($reg, [], 'Memuat kabupaten...');
            setOptions($kec, [], 'Pilih Kecamatan');
            choicesDesa.clearStore();
            choicesDesa.setChoices([], 'value', 'label', true);

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

            fetchJson(`${apiBase}/regencies/${encodeURIComponent(code)}.json`)
                .then(resp => {
                    const list = Array.isArray(resp) ? resp : (resp.data ?? []);
                    cacheSet(key, list);
                    setOptions($reg, list, 'Pilih Kabupaten/Kota');
                })
                .catch(err => {
                    console.error('[wilayah] Regency fetch failed:', err);
                    fetchJson(`/wilayah/regencies/${encodeURIComponent(code)}`)
                        .then(localResp => {
                            const list = Array.isArray(localResp) ? localResp : (localResp.data ?? []);
                            cacheSet(key, list);
                            setOptions($reg, list, 'Pilih Kabupaten/Kota');
                        })
                        .catch(localErr => {
                            console.error('[wilayah] Local regency failed:', localErr);
                            setOptions($reg, [], 'Error memuat kabupaten');
                        });
                });
        });

        // Regency change handler
        $reg.addEventListener('change', function() {
            const code = this.value;
            console.log('[wilayah] Regency changed:', code);
            
            setOptions($kec, [], 'Memuat kecamatan...');
            choicesDesa.clearStore();
            choicesDesa.setChoices([], 'value', 'label', true);

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
                .catch(err => {
                    console.error('[wilayah] District fetch failed:', err);
                    fetchJson(`/wilayah/districts/${encodeURIComponent(code)}`)
                        .then(localResp => {
                            const list = Array.isArray(localResp) ? localResp : (localResp.data ?? []);
                            cacheSet(key, list);
                            setOptions($kec, list, 'Pilih Kecamatan');
                        })
                        .catch(localErr => {
                            console.error('[wilayah] Local district failed:', localErr);
                            setOptions($kec, [], 'Error memuat kecamatan');
                        });
                });
        });

        // District change handler
        $kec.addEventListener('change', function() {
            const code = this.value;
            console.log('[wilayah] District changed:', code);
            
            choicesDesa.clearStore();
            choicesDesa.setChoices([{ value: '', label: 'Memuat desa...' }], 'value', 'label', true);

            if (!code) {
                choicesDesa.clearStore();
                return;
            }

            const key = `wilayah:villages:${code}`;
            const cached = cacheGet(key);
            
            if (cached) {
                choicesDesa.clearStore();
                choicesDesa.setChoices(
                    cached.map(v => ({ value: v.code, label: v.name })),
                    'value',
                    'label',
                    true
                );
                return;
            }

            fetchJson(`${apiBase}/villages/${encodeURIComponent(code)}.json`)
                .then(resp => {
                    const list = Array.isArray(resp) ? resp : (resp.data ?? []);
                    cacheSet(key, list);
                    choicesDesa.clearStore();
                    choicesDesa.setChoices(
                        list.map(v => ({ value: v.code, label: v.name })),
                        'value',
                        'label',
                        true
                    );
                })
                .catch(err => {
                    console.error('[wilayah] Village fetch failed:', err);
                    fetchJson(`/wilayah/villages/${encodeURIComponent(code)}`)
                        .then(localResp => {
                            const list = Array.isArray(localResp) ? localResp : (localResp.data ?? []);
                            cacheSet(key, list);
                            choicesDesa.clearStore();
                            choicesDesa.setChoices(
                                list.map(v => ({ value: v.code, label: v.name })),
                                'value',
                                'label',
                                true
                            );
                        })
                        .catch(localErr => {
                            console.error('[wilayah] Local village failed:', localErr);
                            choicesDesa.clearStore();
                            choicesDesa.setChoices([{ value: '', label: 'Error memuat desa' }], 'value', 'label', true);
                        });
                });
        });
    }
});
</script>
@endpush