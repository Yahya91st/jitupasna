@extends('layouts.main')

@section('content')

@include('forms.form4.format3._form',[
    'action' => route('forms.form4.format3.update',[
        'formulir'=>$formulir->id,
        'nomor_input'=>$nomor_input,
    ]),
    'method' => 'PATCH',
    'edit' => true,
])

@endsection