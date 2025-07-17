@extends('layouts.main')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>User Management</h3>
                <p class="text-subtitle text-muted">Manage user accounts and permissions</p>
            </div>
        </div>
    </div>

    <!-- Flash message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        @if(auth()->user()->hasRole('super-admin'))
                            Admin Accounts
                        @elseif(auth()->user()->hasRole('admin'))
                            Regular User Accounts
                        @else
                            Users
                        @endif
                    </h4>
                    @if(auth()->user()->hasRole('super-admin'))
                        <a href="{{ url('/admins/create') }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Create Admin
                        </a>
                    @elseif(auth()->user()->hasRole('admin'))
                        <a href="{{ url('/users/create') }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Create User
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="usersTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>                            <td>{{ $user->getKey() }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>                            <td>
                                @foreach($user->roles as $role)
                                <span class="badge bg-{{ $role->name == 'admin' ? 'danger' : ($role->name == 'super-admin' ? 'warning' : 'info') }}">
                                    {{ ucfirst($role->name) }}
                                </span>
                                @endforeach
                            </td> <td>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('frontend/dist/assets/vendors/simple-datatables/style.css') }}">
@endpush

@push('script')
<script src="{{ asset('frontend/dist/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#usersTable');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>
@endpush
