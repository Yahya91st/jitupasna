@extends('layouts.main')

@section('content')

<style>
    .main-card {
        border-radius: 10px;
        box-shadow: 0 8px 30px rgba(20,20,20,0.06);
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.04);
    }
    .card-header-gradient {
        background: linear-gradient(135deg, #F28705 0%, #FF9800 100%);
        color: #fff;
        padding: 0.9rem 1.25rem;
        display:flex;
        align-items:center;
        justify-content:space-between;
    }
    .btn-light-secondary {
        background:#f7f7f8; color:#6b7280; border:1px solid #e6e9ec; padding:.45rem .9rem; border-radius:8px;
    }
    .input-icon { width:46px; display:flex; align-items:center; justify-content:center; border-right:0; background:#fff; }
    .form-control:focus { box-shadow: 0 0 0 0.12rem rgba(242,135,5,0.12); border-color: #F28705; }
    .toggle-password { cursor:pointer; color: #6b7280; }
</style>

<div class="container mt-4">
    <div class="col-md-8 mx-auto">
        <div class="card main-card">
            <div class="card-header card-header-gradient">
                <h4 class="mb-0">Tambah User Baru</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa input:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('users.store') }}" method="POST" novalidate>
                    @csrf

                     <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <div class="input-group">
                            <span class="input-group-text input-icon"><i data-feather="user"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required>
                        </div>
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text input-icon"><i data-feather="mail"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" required>
                        </div>
                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text input-icon"><i data-feather="lock"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required>
                            <span class="input-group-text toggle-password" id="togglePassword" title="Tampilkan password">
                                <i data-feather="eye" id="toggleIcon"></i>
                            </span>
                        </div>
                         @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <button type="submit" class="btn btn-orange">Simpan</button>
                        <a href="{{ route('users.index') }}" class="btn btn-light-secondary">Batal</a>
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
            toggle.addEventListener('click', function (e) {
                const type = pwd.getAttribute('type') === 'password' ? 'text' : 'password';
                pwd.setAttribute('type', type);
                // toggle feather icon
                icon.setAttribute('data-feather', type === 'text' ? 'eye-off' : 'eye');
                if (typeof feather !== 'undefined') feather.replace();
                 });
        }
    });
</script>
@endsection