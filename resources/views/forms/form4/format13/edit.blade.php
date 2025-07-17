@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Edit Data Sektor Industri (Format 13)</h5>
    <form action="{{ route('forms.form4.format13.update', $formIndustri->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="bencana_id" value="{{ $bencana->id }}">
        @include('forms.form4.format13.format13form4', ['edit' => true, 'data' => $formIndustri])
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success">Update Data</button>
            <a href="{{ route('forms.form4.format13.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
