<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JITUPASNA</title>
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/css/bootstrap.css') }}">

    <link rel="shortcut icon" href="{{ asset('frontend/dist/assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/css/app.css') }}">
    <style>
        :root {
            --orange-primary: #F28705;
            --orange-gradient: linear-gradient(135deg, #F28705 0%, #ff9800 100%);
        }

        body {
            background-image: url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=2071&auto=format&fit=crop');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .card-body {
            padding: 2rem;
        }

        h3 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .text-center p {
            color: #f0f0f0;
            font-size: 0.95rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .form-group label {
            font-weight: 600;
            color: #fff;
            margin-bottom: 0.5rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.6rem 1rem;
            padding-left: 2.5rem;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-control:focus {
            border-color: var(--orange-primary);
            box-shadow: none;
            outline: none;
            background: rgba(255, 255, 255, 0.25);
        }

        .form-control:focus + .form-control-icon {
            color: var(--orange-primary);
        }

        .form-control-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--orange-primary);
        }

        /* Hilangkan semua warna biru dari Bootstrap */
        .form-check-input:checked {
            background-color: var(--orange-primary) !important;
            border-color: var(--orange-primary) !important;
        }

        .form-check-input:focus {
            border-color: var(--orange-primary) !important;
            box-shadow: none !important;
        }

        .btn-primary {
            background: var(--orange-gradient);
            border: none;
            border-radius: 8px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(242, 135, 5, 0.4);
        }

        .btn-secondary {
            border-radius: 8px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
        a {
            color: #FFD700;
            text-decoration: none;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        a:hover {   
            color: var(--orange-primary);
            text-decoration: underline;
        }

        .checkbox label {
            font-weight: 400;
            color: #f0f0f0;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }
            text-decoration: underline;
        }

        .checkbox label {
            font-weight: 400;
            color: #f0f0f0;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .toggle-password {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: rgba(255, 255, 255, 0.8);
            transition: color 0.3s ease;
        }

        .toggle-password:hover {
            color: var(--orange-primary);
        }

        .logo-wrapper {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .logo-wrapper img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

        <div class="row">
            <div class="col-md-5 col-sm-12 mx-auto">
                <div class="card pt-4">
                    <div class="card-body">
                        <div class="text-center mb-5">
                            <div class="logo-wrapper">
                                <img src="{{ asset('frontend/dist/assets/images/avatar/unslogo.png') }}" alt="UNS Logo">
                            </div>
                            <h3>LOGIN</h3>
                            <p>PENGKAJIAN KEBUTUHAN
                                PASCABENCANA</p>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group position-relative has-icon-left">
                                <label for="username">Email</label>
                                <div class="position-relative">
                                    <input id="email" class="form-control" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username">
                                    <div class="form-control-icon">
                                        <i data-feather="user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left">
                                <div class="clearfix">
                                    <label for="password">Password</label>
                                    {{-- <a href="auth-forgot-password.html" class='float-right'>
                                        <small>Forgot password?</small>
                                    </a> --}}
                                </div>
                                <div class="position-relative">
                                    <input id="password" class="form-control" type="password" name="password" required
                                        autocomplete="current-password" style="padding-right: 2.5rem;">
                                    <div class="form-control-icon">
                                        <i data-feather="lock"></i>
                                    </div>
                                    <div class="toggle-password" onclick="togglePassword()">
                                        <i data-feather="eye" id="toggleIcon"></i>
                                    </div>
                                </div>
                            </div>

                            <div class='form-check clearfix my-4'>
                                <div class="checkbox float-left">
                                    <input type="checkbox" id="remember_me" class='form-check-input' name="remember">
                                    <label for="checkbox1">Remember me</label>
                                </div>
                                <div class="float-right">
                                    <a href="{{ route('register') }}">Don't have an account?</a>
                                </div>
                            </div>
                            <div class="clearfix">
                                <a href="{{ route('register') }}" class="btn btn-secondary float-left">Register</a>
                                <button class="btn btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('frontend/dist/assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/js/main.js') }}"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.setAttribute('data-feather', 'eye-off');
            } else {
                passwordInput.type = 'password';
                toggleIcon.setAttribute('data-feather', 'eye');
            }
            
            feather.replace();
        }
    </script>
</body>

</html>
