@extends('layouts.main')

@section('content')
    @include('forms.form4.format4._form', [
        'action' => route('forms.form4.format4.store'),
        'method' => 'POST',
        'edit' => false,
    ])
@endsection
