@extends('layouts.main')

@section('content')

@include('forms.form4.format1._form',[
    'action' => route('forms.form4.format1.update',[
        'formulir'=>$formulir->id,
        'nomor_input'=>$nomor_input,
    ]),
    'method' => 'PATCH',
    'edit' => true,
])

@endsection