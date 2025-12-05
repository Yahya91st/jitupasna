@extends('layouts.main')

@section('content')
<style>
    :root{
        --orange-primary: #F28705;
        --orange-gradient: linear-gradient(135deg,#F28705 0%,#FF9800 100%);
        --muted:#6b7280;
        --card-radius:10px;
    }

    .main-card{
        border-radius: var(--card-radius);
        box-shadow: 0 8px 30px rgba(20,20,20,0.06);
        border: 1px solid rgba(0,0,0,0.04);
        overflow: hidden;
    }
    .card-header-gradient{
        background: var(--orange-gradient);
        color:#fff;
        padding:.85rem 1rem;
        display:flex;
        align-items:center;
        justify-content:space-between;
    }
    .card-header-gradient h4{ margin:0; font-weight:700; font-size:1.05rem; }

    .btn-orange{ background:var(--orange-gradient); color:#fff; border:0; padding:.45rem .9rem; border-radius:8px; font-weight:700; }
    .btn-light-secondary{ background:#f7f7f8; color:var(--muted); border:1px solid #e6e9ec; padding:.45rem .9rem; border-radius:8px; }

    .input-icon{ width:46px; display:flex; align-items:center; justify-content:center; background:#fff; border-right:0; }
    .form-control:focus{ box-shadow: 0 0 0 0.12rem rgba(242,135,5,0.12); border-color: var(--orange-primary); }
    .toggle-password{ cursor:pointer; color:var(--muted); }

    .form-text-muted{ color:#6c757d; font-size:.85rem; }

    @media (max-width: 768px){
        .card-header-gradient{ padding:.7rem .8rem; }
    }
</style>

<div class="container mt-4">
    <div class="col-md-8 mx-auto">
        <div class="card main-card">
            <div class="card-header card-header-gradient">
                <h4 class="mb-0">Edit User: {{ $user->name }}</h4>
                <a href="{{ route('users.index') }}" class="btn btn-light-secondary">Kembali</a>
            </div>

            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa input:</strong>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('users.update', $user) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <div class="input-group">
                            <span class="input-group-text input-icon"><i data-feather="user"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                   name="name" value="{{ old('name', $user->name) }}" required>
                        </div>
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text input-icon"><i data-feather="mail"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                   name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password (kosongkan jika tidak diubah)</label>
                        <div class="input-group">
                            <span class="input-group-text input-icon"><i data-feather="lock"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" autocomplete="new-password" placeholder="Isi jika ingin ganti">
                            <span class="input-group-text toggle-password" id="togglePassword" title="Tampilkan password">
                                <i data-feather="eye" id="toggleIcon"></i>
                            </span>
                        </div>
                        @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        <small class="form-text text-muted">Hanya isi jika ingin mengubah password saat ini.</small>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
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
                                Sebagai Super Admin, Anda dapat mengelola akun admin.
                            @elseif(auth()->user()->hasRole('admin'))
                                Sebagai Admin, Anda dapat mengelola akun user reguler.
                            @endif
                        </small>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('users.index') }}" class="btn btn-light-secondary">Batal</a>
                        <button type="submit" class="btn btn-orange">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof feather !== 'undefined') feather.replace();

        const toggle = document.getElementById('togglePassword');
        const pwd = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');

        if (toggle && pwd && icon) {
            toggle.addEventListener('click', function () {
                const type = pwd.getAttribute('type') === 'password' ? 'text' : 'password';
                pwd.setAttribute('type', type);
                icon.setAttribute('data-feather', type === 'text' ? 'eye-off' : 'eye');
                if (typeof feather !== 'undefined') feather.replace();
            });
        }
    });
</script>
@endsection
```// filepath: c:\laragon\www\jitupasna\resources\views\users\edit.blade.php
@extends('layouts.main')

@section('content')
<style>
    :root{
        --orange-primary: #F28705;
        --orange-gradient: linear-gradient(135deg,#F28705 0%,#FF9800 100%);
        --muted:#6b7280;
        --card-radius:10px;
    }

    .main-card{
        border-radius: var(--card-radius);
        box-shadow: 0 8px 30px rgba(20,20,20,0.06);
        border: 1px solid rgba(0,0,0,0.04);
        overflow: hidden;
    }
    .card-header-gradient{
        background: var(--orange-gradient);
        color:#fff;
        padding:.85rem 1rem;
        display:flex;
        align-items:center;
        justify-content:space-between;
    }
    .card-header-gradient h4{ margin:0; font-weight:700; font-size:1.05rem; }

    .btn-orange{ background:var(--orange-gradient); color:#fff; border:0; padding:.45rem .9rem; border-radius:8px; font-weight:700; }
    .btn-light-secondary{ background:#f7f7f8; color:var(--muted); border:1px solid #e6e9ec; padding:.45rem .9rem; border-radius:8px; }

    .input-icon{ width:46px; display:flex; align-items:center; justify-content:center; background:#fff; border-right:0; }
    .form-control:focus{ box-shadow: 0 0 0 0.12rem rgba(242,135,5,0.12); border-color: var(--orange-primary); }
    .toggle-password{ cursor:pointer; color:var(--muted); }

    .form-text-muted{ color:#6c757d; font-size:.85rem; }

    @media (max-width: 768px){
        .card-header-gradient{ padding:.7rem .8rem; }
    }
</style>

<div class="container mt-4">
    <div class="col-md-8 mx-auto">
        <div class="card main-card">
            <div class="card-header card-header-gradient">
                <h4 class="mb-0">Edit User: {{ $user->name }}</h4>
                <a href="{{ route('users.index') }}" class="btn btn-light-secondary">Kembali</a>
            </div>

            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa input:</strong>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('users.update', $user) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <div class="input-group">
                            <span class="input-group-text input-icon"><i data-feather="user"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                   name="name" value="{{ old('name', $user->name) }}" required>
                        </div>
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text input-icon"><i data-feather="mail"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                   name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password (kosongkan jika tidak diubah)</label>
                        <div class="input-group">
                            <span class="input-group-text input-icon"><i data-feather="lock"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" autocomplete="new-password" placeholder="Isi jika ingin ganti">
                            <span class="input-group-text toggle-password" id="togglePassword" title="Tampilkan password">
                                <i data-feather="eye" id="toggleIcon"></i>
                            </span>
                        </div>
                        @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        <small class="form-text text-muted">Hanya isi jika ingin mengubah password saat ini.</small>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
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
                                Sebagai Super Admin, Anda dapat mengelola akun admin.
                            @elseif(auth()->user()->hasRole('admin'))
                                Sebagai Admin, Anda dapat mengelola akun user reguler.
                            @endif
                        </small>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('users.index') }}" class="btn btn-light-secondary">Batal</a>
                        <button type="submit" class="btn btn-orange">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof feather !== 'undefined') feather.replace();

        const toggle = document.getElementById('togglePassword');
        const pwd = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');

        if (toggle && pwd && icon) {
            toggle.addEventListener('click', function () {
                const type = pwd.getAttribute('type') === 'password' ? 'text' : 'password';
                pwd.setAttribute('type', type);
                icon.setAttribute('data-feather', type === 'text' ? 'eye-off' : 'eye');
                if (typeof feather !== 'undefined') feather.replace();
            });
        }
    });
</script>
@endsection