@extends('layouts.main')

@section('content')

                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Kampung</th>
                                    <th>Nama Distrik</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)

                                <tr>
                                    <td>{{ $report->id }}</td>
                                    <td>{{ optional($report->items->first())->nama_kampung }}</td>
                                    <td>{{ optional($report->items->first())->nama_distrik }}</td>

                                    <td>

                                        <a href="{{ route('forms.form4.format1.show',$report->id) }}"
                                        class="btn btn-info btn-sm">
                                            Lihat
                                        </a>

                                        <a href="{{ route('forms.form4.format1.edit',$report->id) }}"
                                        class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('forms.form4.format1.destroy', [
                                            'formulir' => $report->id,
                                        ]) }}"
                                            method="POST"
                                            style="display:inline-block;"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?');">
        
                                            @csrf
                                            @method('DELETE')
        
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </form>
        
                                        <a href="{{ route('forms.form4.format1.preview', [
                                            'formulir' => $report->id,
                                        ]) }}" class="btn btn-info">
                                            Preview PDF
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- <i class="bi bi-plus"></i> Tambah Data Baru -->
                </a>
            </div>
        </div>
    </section>
    <div class="d-flex justify-content-between mt-3">
        <a href="{{ route('forms.form4.index', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Form 4
        </a>
    </div>
</div>
@endsection
