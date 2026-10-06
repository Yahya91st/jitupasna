@extends('layouts.main')

@section('content')
    @include('forms.form4.format17._form', [
        'action' => route('forms.form4.format17.update', [
            'formulir' => $formulir->id,
        ]),
        'method' => 'PATCH',
        'edit' => true,
    ])
@endsection
