@extends('layouts.main')

@section('content')
    @include('forms.form4.format1._form', [
        'action' => route('forms.form4.format1.update', [
            'formulir' => $formulir->id,
        ]),
        'method' => 'PATCH',
        'edit' => true,
    ])
@endsection
