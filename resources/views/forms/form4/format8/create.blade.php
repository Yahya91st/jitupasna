@extends('layouts.main')

@section('content')
    @include('forms.form4.format8._form', [
        'action' => route('forms.form4.format8.store'),
        'method' => 'POST',
        'edit' => false,
    ])
@endsection
