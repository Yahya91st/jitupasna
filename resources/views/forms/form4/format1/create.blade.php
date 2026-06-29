@extends('layouts.main')

@section('content')

@include('forms.form4.format1._form',[
    'action' => route('forms.form4.format1.store'),
    'method' => 'POST',
    'edit' => false,
])

@endsection