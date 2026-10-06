@extends('layouts.main')

@section('content')
    @include('forms.form4.format7._form', [
        'action' => route('forms.form4.format7.store'),
        'method' => 'POST',
        'edit' => false,
    ])
@endsection
