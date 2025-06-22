<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JITUPASNA</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/vendors/chartjs/Chart.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('frontend/dist/assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/vendors/choices.js/choices.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/vendors/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/vendors/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />

    <!-- Custom CSS for sidebar active highlighting (simplified) -->
    <style>
        /* Simple sidebar highlighting */
        .sidebar-item.active>.sidebar-link {
            background-color: rgba(90, 141, 238, 0.1);
            border-left: 3px solid #5A8DEE;
            color: #5A8DEE;
            font-weight: bold;
        }

        .submenu.active {
            display: block;
        }

        .submenu li.active>a {
            color: #5A8DEE;
            font-weight: bold;
            position: relative;
        }

        .submenu li.active>a::before {
            content: "";
            position: absolute;
            left: -10px;
            top: 50%;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background-color: #5A8DEE;
            transform: translateY(-50%);
        }

        /* Flash message styling without JavaScript */
        .flash-message {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 20px;
            border-radius: 4px;
            color: #fff;
            font-weight: bold;
            z-index: 9999;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-left: 4px solid rgba(255, 255, 255, 0.5);
        }

        .flash-success {
            background-color: #4CAF50;
        }

        .flash-error {
            background-color: #F44336;
        }

        .flash-warning {
            background-color: #FF9800;
        }

        .flash-info {
            background-color: #2196F3;
        }

        /* CSS animation for flash messages (no JavaScript needed) */
        .animate-flash {
            animation: fadeInOut 5s ease-in-out forwards;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            10% {
                opacity: 1;
                transform: translateY(0);
            }

            90% {
                opacity: 1;
                transform: translateY(0);
            }

            100% {
                opacity: 0;
                visibility: hidden;
            }
        }
    </style>

    <!-- Custom styles that might be added from other views -->
    @stack('style')
</head>

<body>
    <div id="app">
        <!-- Flash Messages without JavaScript - using CSS animations instead -->
        @if (session('success'))
        <div class="flash-message flash-success animate-flash">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="flash-message flash-error animate-flash">
            {{ session('error') }}
        </div>
        @endif

        @if (session('warning'))
        <div class="flash-message flash-warning animate-flash">
            {{ session('warning') }}
        </div>
        @endif

        @if (session('info'))
        <div class="flash-message flash-info animate-flash">
            {{ session('info') }}
        </div>
        @endif

        @include('layouts.sidebar')
        <div id="main">
            @include('layouts.navbar')
            <div class="main-content container-fluid">
                <!-- Display validation errors -->
                @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <h4>The following errors occurred:</h4>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @yield('content')
            </div>
            {{-- @include('layouts.footer') --}}
        </div>
    </div>

    <!-- jQuery should be loaded before Bootstrap and any script that uses it -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS (depends on jQuery) -->
    <script src="{{ asset('frontend/dist/assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/js/app.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('frontend/dist/assets/js/main.js') }}"></script>

    <!-- Cropper.js (depends on jQuery and Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

    <!-- Include Choices.js -->
    <script src="{{ asset('frontend/dist/assets/vendors/choices.js/choices.min.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- No JavaScript here as per requirements -->
    <!-- Additional scripts that might be added from other views -->
    @stack('script')
</body>

</html>