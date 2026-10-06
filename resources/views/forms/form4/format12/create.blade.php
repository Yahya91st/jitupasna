@extends('layouts.main')

@section('content')
    @include('forms.form4.format12._form', [
        'action' => route('forms.form4.format12.store'),
        'method' => 'POST',
        'edit' => false,
    ])
@endsection
