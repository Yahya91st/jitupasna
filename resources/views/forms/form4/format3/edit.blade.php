@extends('layouts.main')

@section('content')
    @include('forms.form4.format3._form', [
        'action' => route('forms.form4.format3.update', [
            'formulir' => $formulir->id,
        ]),
        'method' => 'PATCH',
        'edit' => true,
        'data' => $formulir,
    ])
@endsection
