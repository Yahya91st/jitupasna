@extends('layouts.main')

@section('content')
    @include('forms.form4.format17._form', [
        'action' => route('forms.form4.format17.store'),
        'method' => 'POST',
        'edit' => false,
    ])
@endsection
