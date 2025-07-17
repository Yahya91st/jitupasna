@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h5 class="text-center fw-bold">Edit Data Sektor Pemerintahan (Format 16)</h5>
    <form action="{{ route('forms.form4.format16.update', $formPemerintahan->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="bencana_id" value="{{ $bencana->id }}">
        @include('forms.form4.format16.format16form4', ['edit' => true, 'data' => $formPemerintahan])
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success">Update Data</button>
            <a href="{{ route('forms.form4.format16.list', ['bencana_id' => $bencana->id]) }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
