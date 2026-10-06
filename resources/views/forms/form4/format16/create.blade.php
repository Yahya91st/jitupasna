@extends('layouts.main')

@section('content')
    @include('forms.form4.format16._form', [
        'action' => route('forms.form4.format16.store'),
        'method' => 'POST',
        'edit' => false,
    ])
@endsection
