@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Data Formulir 4</h1>
    <p>Data bencana: <strong>{{ $bencana->nama ?? '-' }}</strong></p>
    <p>Silakan pilih format di menu untuk melihat data masing-masing format Formulir 4.</p>
</div>
@endsection
