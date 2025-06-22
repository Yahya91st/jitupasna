@extends('layouts.main')

@section('content')
    <div class="page-heading">
    <div class="page-title mb-4">
        <h3>Pilih Kejadian Bencana</h3>
        <p class="text-subtitle text-muted">Silahkan pilih kejadian bencana untuk melihat data kerusakan</p>
    </div>
</div>

<div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Daftar Kejadian Bencana</h4>
                    <div>
                        <button class="btn btn-danger" type="button" data-toggle="modal"
                            data-target="#inlineForm">Filter</button>
                    </div>
                </div>
                <div class="card-content">
                    <div class="alert alert-info">
                        <h5 class="alert-heading"><i data-feather="info"></i> Informasi</h5>
                        <p>Pilih bencana untuk melihat semua data kerusakan yang telah diinput pada formulir-formulir pendataan.</p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Ref</th>
                                    <th>Bencana</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi (Kelurahan/Desa)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bencana as $item)
                                    <tr>
                                        <td>{{ $item->Ref }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="rounded img-fluid avatar-40 me-3 bg-soft-primary"
                                                    src="{{ asset('/frontend/dist/assets/images/avatar/' . $item['gambar']) }}"
                                                    alt="profile" style="width: 100px; height: 100px; margin-right: 10px;">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-0">{{ $item->kategori_bencana->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-bold-500">{{ $item->tanggal }}</td>
                                        <td>
                                            @foreach ($item->desa as $desa)
                                                <li> {{ $desa->nama }}</li>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('kerusakan.detail', $item->id) }}" class="btn btn-primary">
                                                <i class="fa fa-chart-bar mr-1"></i>
                                                Lihat Data Kerusakan
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bd-example" style="margin-left: 10px; margin-top:10px; margin-right:10px">
                            {{ $bencana->links() }}
                        </div>
                    </div>
                </div>
                <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Filter Bencana</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>                            
                            <form action="{{ route('kerusakan.list') }}" method="GET" id="filterForm">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="first-name-column">Kategori Bencana</label>
                                        <div class="form-group">
                                            <select class="form-select" name="kategori_bencana_id" id="kategori_bencana_id">
                                                <option selected disabled value="">{{ __('Pilih...') }}</option>
                                                @foreach ($kategoribencana as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ request()->input('kategori_bencana_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" onclick="resetFilters()"
                                        data-dismiss="modal">{{ __('Reset') }}</button>
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function resetFilters() {
        document.getElementById('kategori_bencana_id').value = '';
        document.getElementById('filterForm').submit();
    }
</script>
