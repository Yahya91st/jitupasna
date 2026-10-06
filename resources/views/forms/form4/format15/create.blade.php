@extends('layouts.main')

@section('content')
    @include('forms.form4.format15._form', [
        'action' => route('forms.form4.format15.store'),
        'method' => 'POST',
        'edit' => false,
    ])
@endsection
