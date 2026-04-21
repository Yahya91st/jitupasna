@extends('layouts.main')

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pengkajian Akibat Bencana</h4>
                    </div>      
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('kajian.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div>
                                    <div>
                                        <div class="form-group">
                                            <label for="gangguan_akses">Gangguan Akses</label>
                                            <p>Hilang atau terganggunya akses individu, keluarga dan masyarakat terhadap pemenuhan kebutuhan dasarnya akibat suatu bencana:</p>
                                            <textarea type="text" id="gangguan_akses" class="form-control"placeholder="Tulis di sini" name="gangguan_akses"></textarea>
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
    </section>   
@endsection                                     