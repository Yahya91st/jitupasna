@extends('layouts.main')

@section('content')
    @include('forms.form4.format9._form', [
        'action' => route('forms.form4.format9.update', [
            'formulir' => $formulir->id,
        ]),
        'method' => 'PATCH',
        'edit' => true,
    ])
@endsection
