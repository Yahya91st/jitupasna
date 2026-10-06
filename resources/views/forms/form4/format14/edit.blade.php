@extends('layouts.main')

@section('content')
    @include('forms.form4.format14._form', [
        'action' => route('forms.form4.format14.update', [
            'formulir' => $formulir->id,
        ]),
        'method' => 'PATCH',
        'edit' => true,
    ])
@endsection
