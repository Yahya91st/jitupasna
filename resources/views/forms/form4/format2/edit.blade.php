@extends('layouts.main')

@section('content')
    @include('forms.form4.format2._form', [
        'action' => route('forms.form4.format2.update', [
            'formulir' => $formulir->id,
        ]),
        'method' => 'PATCH',
        'edit' => true,
        'data' => $formulir,
    ])
@endsection
