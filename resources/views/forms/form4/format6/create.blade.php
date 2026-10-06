@extends('layouts.main')

@section('content')
    @include('forms.form4.format6._form', [
        'action' => route('forms.form4.format6.store'),
        'method' => 'POST',
        'edit' => false,
    ])
@endsection
