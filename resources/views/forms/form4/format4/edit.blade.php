@extends('layouts.main')

@section('content')
    @include('forms.form4.format4._form', [
        'action' => route('forms.form4.format4.update', [
            'formulir' => $formulir->id,
        ]),
        'method' => 'PATCH',
        'edit' => true,
        'data' => $formulir,
    ])
@endsection
