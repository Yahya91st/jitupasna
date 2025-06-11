<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - JITUPASNA</title>
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/css/bootstrap.css') }}">

    <link rel="shortcut icon" href="{{ asset('frontend/dist/assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/css/app.css') }}">
    <style>
        body {
            background-image: url('{{ asset('frontend/dist/assets/images/test_bg.jpeg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

        <div class="row">
            <div class="col-md-6 col-sm-12 mx-auto">
                <div class="card pt-4">
                    <div class="card-body">
                        <div class="text-center mb-5">
                            <img src="{{ asset('frontend/dist/assets/images/avatar/unslogo.png') }}" height="48"
                                class='mb-4'>
                            <h3>REGISTER</h3>
                            <p>PENGKAJIAN KEBUTUHAN PASCABENCANA</p>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <!-- Name -->
                            <div class="form-group position-relative has-icon-left">
                                <label for="name">Name</label>
                                <div class="position-relative">
                                    <input id="name" class="form-control" type="text" name="name"
                                        value="{{ old('name') }}" required autofocus autocomplete="name">
                                    <div class="form-control-icon">
                                        <i data-feather="user"></i>
                                    </div>
                                </div>
                                @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Email -->
                            <div class="form-group position-relative has-icon-left">
                                <label for="email">Email</label>
                                <div class="position-relative">
                                    <input id="email" class="form-control" type="email" name="email"
                                        value="{{ old('email') }}" required autocomplete="username">
                                    <div class="form-control-icon">
                                        <i data-feather="mail"></i>
                                    </div>
                                </div>
                                @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group position-relative has-icon-left">
                                <label for="password">Password</label>
                                <div class="position-relative">
                                    <input id="password" class="form-control" type="password" name="password" required
                                        autocomplete="new-password">
                                    <div class="form-control-icon">
                                        <i data-feather="lock"></i>
                                    </div>
                                </div>
                                @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group position-relative has-icon-left">
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="position-relative">
                                    <input id="password_confirmation" class="form-control" type="password" 
                                        name="password_confirmation" required autocomplete="new-password">
                                    <div class="form-control-icon">
                                        <i data-feather="lock"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="form-check clearfix my-4">
                                <div class="float-right">
                                    <a href="{{ route('login') }}">Already have an account?</a>
                                </div>
                            </div>
                            
                            <div class="clearfix">
                                <a href="{{ route('login') }}" class="btn btn-secondary float-left">Back to Login</a>
                                <button class="btn btn-primary float-right">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('frontend/dist/assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/js/app.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/js/main.js') }}"></script>
</body>

</html>
