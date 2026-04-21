exclude@extends('layouts.main')

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pengkajian Akibat Bencana</h4>
                    </div>
                    @if ($bencana)
                        <p class="text-subtitle text-muted">
                            Bencana: {{ $bencana->kategori_bencana->nama }} - Ref: {{ $bencana->Ref }} - Tanggal: {{ $bencana->tanggal }}
                            <a href="{{ route('bencana.index', ['source' => 'kajian']) }}" class="btn btn-sm" style="background-color: #6c757d; color: white; border: none;">
                                Ganti Bencana
                            </a>
                        </p>
                    @endif
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('kajian.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div>
                                    <div>
                                        <div class="form-group">
                                            <label for="gangguan_fungsi">Gangguan Fungsi</label>
                                            <textarea type="text" id="gangguan_fungsi" class="form-control"placeholder="Tulis di sini" name="gangguan_fungsi"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="kehilangan_akses">Kehilangan Akses</label>
                                            <textarea type="text" id="kehilangan_akses" class="form-control"placeholder="Tulis di sini" name="kehilangan_akses"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="peningkatan_resiko">Peningkatan Resiko</label>
                                            <textarea type="text" id="peningkatan_resiko" class="form-control"placeholder="Tulis di sini" name="peningkatan_resiko"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>   
@endsection