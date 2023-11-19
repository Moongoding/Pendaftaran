<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="/img/favicon.ico" />
    <link rel="stylesheet" href="/template/assets/css/styles.min.css" />
    <style>
        .card-body .navbar-logo {
            display: block;
            justify-content: center;
            margin-bottom: 10px;
            font-size: 2rem;
            font-weight: 700;
            color: rgb(9, 9, 9);
        }

        .card-body .navbar-logo span {
            color: #74ddef;
            text-shadow: 1px 1px 1px rgb(9, 9, 9);
            text-shadow: rgb(9, 9, 9)
        }

    </style>
</head>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<body>
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
<div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="#" class="navbar-logo text-center">UPTD <span>DLHK</span></a>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>
                                        {{-- <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" autofocus id="email" placeholder="Email" value="{{ old('email') }}"> --}}
                                        <label for="email" class="form-label">{{ __('Email Address') }}</label>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-4">
                                        <div class="form-floating">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                                            {{-- <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password"> --}}
                                            <label for="password" class="form-label">{{ __('Password') }}</label>
                                            @error('password')
                                            <div class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <span class="input-group-text" id="showPasswordToggle">
                                            <i id="showPasswordIcon" class="ti ti-eye-off"></i>
                                        </span>
                                    </div>

                                    <div class="d-flex row mb-3">
                                        <div class="col-md-6 offset-md-0">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="d-flex grid gap-0 column-gap-3 align-items-center justify-content-center mb-5">
                                        <a href="/" class="btn btn-primary p-2 g-col-6 rounded-2 w-100">Back to
                                            Landing
                                            Page </a>
                                        <button type="submit"
                                            class="btn btn-primary p-2 g-col-6 rounded-2 w-100">{{ __('Login') }}</button>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center">
                                        Dont have an account?
                                        <a class="text-primary fw-bold ms-2"
                                            href="/register">Create an account</a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        @if (Route::has('password.request'))
                                            <a class="text-primary fw-bold" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/template/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="/template/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const passwordInput = document.getElementById('password');
        const showPasswordToggle = document.getElementById('showPasswordToggle');
        const showPasswordIcon = document.getElementById('showPasswordIcon');

        showPasswordToggle.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showPasswordIcon.className = 'ti ti-eye-check';
            } else {
                passwordInput.type = 'password';
                showPasswordIcon.className = 'ti ti-eye-off';
            }
        });
    </script>

    @include('sweetalert::alert')
</body>

</html>
