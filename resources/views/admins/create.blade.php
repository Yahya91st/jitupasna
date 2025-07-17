@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tambah Admin Baru</h3>
    <form action="{{ url('/admins') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url('/users') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
