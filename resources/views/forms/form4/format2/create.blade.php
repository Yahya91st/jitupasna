@extends('layouts.main')

@section('content')

@include('forms.form4.format2._form',[
    'action' => route('forms.form4.format2.store'),
    'method' => 'POST',
    'edit' => false,
])

@endsection