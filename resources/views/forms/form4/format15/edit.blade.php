@extends('layouts.main')

@section('content')
    @include('forms.form4.format15._form', [
        'action' => route('forms.form4.format15.update', [
            'formulir' => $formulir->id,
        ]),
        'method' => 'PATCH',
        'edit' => true,
    ])
@endsection
