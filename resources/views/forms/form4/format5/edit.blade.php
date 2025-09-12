@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Edit Data Sektor Keagamaan (Format 5)</h5>
    <form action="{{ route('forms.form4.update-format5', $formKeagamaan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="bencana_id" value="{{ $bencana->id }}">
        @include('forms.form4.format5.format5form4', ['edit' => true, 'data' => $formKeagamaan])
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success">Update Data</button>
            <a href="{{ route('forms.form4.format5.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
