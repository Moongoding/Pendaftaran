<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="/template/assets/images/logos/favicon.png" />
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

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
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
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                            autofocus id="email" placeholder="Email" value="{{ old('email') }}">
                                        <label for="email" class="form-label">Email</label>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-4">
                                        <div class="form-floating">
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
                                            <label for="password" class="form-label">Password</label>
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

                                    <div
                                        class="d-flex grid gap-0 column-gap-3 align-items-center justify-content-center mb-5">
                                        <a href="/" class="btn btn-primary p-2 g-col-6 rounded-2 w-100">Back to
                                            Landing
                                            Page </a>
                                        <button type="submit"
                                            class="btn btn-primary p-2 g-col-6 rounded-2 w-100">Login</button>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center">
                                        Dont have an account?
                                        <a class="text-primary fw-bold ms-2"
                                            href="/register">Create an account</a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="text-primary fw-bold" href="#">Forgot Password
                                            ?</a>
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
