// ...existing code...
@extends('layouts.main')

@section('content')
<style>
    :root{
        --orange-primary:#F28705;
        --orange-gradient: linear-gradient(135deg,#F28705 0%,#FF9800 100%);
        --muted:#6b7280;
        --card-radius:10px;
    }

    .main-card{
        border-radius: var(--card-radius);
        box-shadow: 0 8px 30px rgba(20,20,20,0.06);
        overflow: hidden;
        border:1px solid rgba(0,0,0,0.04);
    }

    .card-header-gradient{
        background: var(--orange-gradient);
        color:#fff;
        padding: .9rem 1.25rem;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:.75rem;
    }
    .card-header-gradient h4{ margin:0; font-weight:700; font-size:1.05rem; }

    .btn-orange { background: var(--orange-gradient); color:#fff; border:0; padding:.45rem .9rem; border-radius:8px; font-weight:700; display:inline-flex; align-items:center; gap:.5rem; }
    .btn-light-secondary{ background:#fff; color:var(--orange-primary); border-radius:8px; padding:.45rem .9rem; border:0; font-weight:700; box-shadow: 0 4px 18px rgba(242,135,5,0.08); }

    .table-container{ overflow-x:auto; border-radius:8px; border:1px solid #eef0f2; }
    .table thead th{ background:#f8f9fa; font-weight:700; font-size:.75rem; color:#444; padding:.85rem; border-bottom:1px solid #e9ecef; text-transform:uppercase; }
    .table tbody td{ padding:.75rem; vertical-align:middle; color:#374151; border-bottom:1px solid #f1f1f1; }
    .table tbody tr:hover{ background:#fbfbfb; }

    .badge-role-admin{ background:#f87171; color:#fff; }
    .badge-role-super{ background:#fbbf24; color:#fff; }
    .badge-role-user{ background:#60a5fa; color:#fff; }

    @media (max-width:720px){
        .card-header-gradient{ flex-direction:column; align-items:flex-start; gap:.5rem; }
        .header-actions{ width:100%; display:flex; justify-content:space-between; gap:.5rem; }
    }
</style>

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
        <div class="card main-card">
            <div class="card-header card-header-gradient">
                <h4 class="card-title">
                    @if(auth()->user()->hasRole('super-admin'))
                        Admin Accounts
                    @elseif(auth()->user()->hasRole('admin'))
                        Regular User Accounts
                    @else
                        Users
                    @endif
                </h4>

                <div class="header-actions">
                    @if(auth()->user()->hasRole('super-admin'))
                        <a href="{{ url('/admins/create') }}" class="btn btn-light-secondary">
                            <i data-feather="plus"></i> Create Admin
                        </a>
                    @elseif(auth()->user()->hasRole('admin'))
                        <a href="{{ url('/users/create') }}" class="btn btn-light-secondary">
                            <i data-feather="plus"></i> Create User
                        </a>
                    @endif
                </div>
            </div>

            <div class="card-body card-content">
                <div class="table-container">
                    <table class="table table-striped" id="usersTable">
                        <thead>
                            <tr>
                                <th style="width:80px">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th style="width:160px">Role</th>
                                <th style="width:160px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->getKey() }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        @php
                                            $cls = $role->name == 'admin' ? 'badge-role-admin' : ($role->name == 'super-admin' ? 'badge-role-super' : 'badge-role-user');
                                        @endphp
                                        <span class="badge {{ $cls }}">{{ ucfirst($role->name) }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-orange">
                                        <i data-feather="edit"></i> Edit
                                    </a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light-secondary" onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i data-feather="trash-2"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    @if(method_exists($users, 'links'))
                        {{ $users->links() }}
                    @endif
                </div>
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
    document.addEventListener('DOMContentLoaded', function(){
        if (typeof feather !== 'undefined') feather.replace();
        let table1 = document.querySelector('#usersTable');
        if(table1){
            let dataTable = new simpleDatatables.DataTable(table1);
        }
    });
</script>
@endpush
// ...existing code...