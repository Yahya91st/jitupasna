@extends('layouts.main')

@section('content')
    @include('forms.form4.format16._form', [
        'action' => route('forms.form4.format16.update', [
            'formulir' => $formulir->id,
        ]),
        'method' => 'PATCH',
        'edit' => true,
    ])
@endsection
