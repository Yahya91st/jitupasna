<div class="detail-card">
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="tipe-${detailCount}">Tipe</label>
                <select class="choices form-select tipe-select" name="details[${detailCount}][tipe]"
                    id="tipe-${detailCount}">
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
            <div class="form-group mb-0">
                <span class="delete-icon" style="cursor: pointer; color: #dc3545; font-size: 24px; font-weight: bold;">×</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-12">
            <div class="form-group">
                <label for="satuan_id-${detailCount}">Satuan</label>
                <select class="choices form-select" name="details[${detailCount}][satuan_id]"
                    id="satuan_id-${detailCount}">
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
