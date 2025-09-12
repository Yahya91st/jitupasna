@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Edit Data Sektor Pendidikan (Format 2)</h5>
    <form action="{{ route('forms.form4.update-format2', $formPendidikan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="bencana_id" value="{{ $bencana->id }}">
        @include('forms.form4.format2.format2form4', ['edit' => true, 'data' => $formPendidikan])
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success">Update Data</button>
            <a href="{{ route('forms.form4.format2.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
