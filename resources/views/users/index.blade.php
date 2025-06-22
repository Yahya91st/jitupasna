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

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
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
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>                            <select class="form-select" id="role" name="role" required>
                                @foreach($availableRoles as $role)
                                <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">
                                @if(auth()->user()->hasRole('super-admin'))
                                    As a Super Admin, you can only create admin accounts.
                                @elseif(auth()->user()->hasRole('admin'))
                                    As an Admin, you can only create regular user accounts.
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
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
        <div class="card">            <div class="card-header">                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        @if(auth()->user()->hasRole('super-admin'))
                            Admin Accounts
                        @elseif(auth()->user()->hasRole('admin'))
                            Regular User Accounts
                        @else
                            Users
                        @endif
                    </h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="bi bi-plus"></i> Add User
                    </button>
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
