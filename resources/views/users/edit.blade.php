@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit User</h3>
                <p class="text-subtitle text-muted">Edit user information</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit User: {{ $user->name }}</h4>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password (leave blank to keep current)</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="text-muted">Only fill this if you want to change the password</small>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="role" class="form-label">Role</label>                        <select class="form-select" id="role" name="role" required>
                            @if(auth()->user()->hasRole('super-admin'))
                                <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                            @elseif(auth()->user()->hasRole('admin'))
                                <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>User</option>
                            @else
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <small class="form-text text-muted">
                            @if(auth()->user()->hasRole('super-admin'))
                                As a Super Admin, you can only manage admin accounts.
                            @elseif(auth()->user()->hasRole('admin'))
                                As an Admin, you can only manage regular user accounts.
                            @endif
                        </small>
                    </div>
                    
                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
