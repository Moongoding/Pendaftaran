<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="/img/favicon.ico" />

    <!-- Bootstrap CSS -->
    <link href="landing-page/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="landing-page/css/tiny-slider.css" rel="stylesheet">
    <link href="landing-page/css/style.css" rel="stylesheet">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

        <div class="container">
            <a class="navbar-brand" href="#">UPTD<span> DLHK</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li><a class="nav-link" href="shop.html">Produk</a></li>
                    <li><a class="nav-link" href="about.html">About us</a></li>
                    <li><a class="nav-link" href="services.html">Services</a></li>
                    <li><a class="nav-link" href="contact.html">Contact us</a></li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li><a class="nav-link" href="#"><img src="landing-page/images/user.svg"></a></li>
                    <li><a class="nav-link" href="cart.html"><img src="landing-page/images/cart.svg"></a></li>
                </ul>
            </div>
        </div>

    </nav>
    <!-- End Header/Navigation -->

    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        @foreach($homes as $home)
                        <h1>{{ $home->title }}</h1>
                            <p class="mb-4">{{ $home->body }}.</p>
                            @auth
                            <p><a href="/home" class="btn btn-white-outline">Masuk</a></p>
                            @else
                            <p><a href="/login" class="btn btn-secondary me-2">Login Now</a></p>
                        @endauth

                        @endforeach
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->



    <!-- Start Blog Section -->
    <div class="blog-section">
        <div class="container">

            <div class="row">
                @foreach ($analisa as $dataAnalisa)
                <div class="col-12 col-sm-6 col-md-4 mb-5">
                    <div class="post-entry">
                        @if ($dataAnalisa->image)
                            <a href="#" class="post-thumbnail"><img src="{{ asset('storage/' . $dataAnalisa->image) }}" alt="{{ $dataAnalisa->name }}"
                                    class="img-fluid"></a>
                        @else
                            <a href="#" class="post-thumbnail"><img src="ttps://source.unsplash.com/200x200?{{ $dataAnalisa->name }}" alt="{{ $dataAnalisa->name }}"
                                class="img-fluid"></a>
                        @endif
                        <div class="post-content-entry">
                            <h3><a href="#">Analisa {{ $dataAnalisa->name }}</a></h3>
                            <div class="meta">
                                <span>Rp <a href="#">{{ number_format($dataAnalisa->harga, 0, ',', '.') }}</a></span>
                                {{-- <span>on <a href="#">{{ $dataAnalisa->created_at->diffForHumans() }}</a></span> --}}

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Blog Section -->





    <!-- Start Footer Section -->
    <footer class="footer-section">
        <div class="container relative">

            <div class="row g-5 mb-5">
                <div class="col-lg-12">
                    @foreach($abouts as $about)
                    <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">{{ $about->title }}<span> {{ $about->title2 }}</span></a></div>
                    <p class="mb-4"><h4>{{ $about->body }}</h4></p>
                    <p class="mb-4"><h5>{{ $about->body2 }}</h5></p>
                    @endforeach
                </div>
            </div>

            <div class="sofa-img">
                <img src="landing-page/images/lab.png" alt="Image" class="img-fluid">
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="subscription-form">
                        <h3 class="d-flex align-items-center"><span class="me-1"><img src="landing-page/images/envelope-outline.svg"
                                    alt="Image" class="img-fluid"></span><span>Subscribe to Newsletter</span></h3>

                        <form action="#" class="row g-3">
                            <div class="col-auto">
                                <input type="text" class="form-control" placeholder="Enter your name">
                            </div>
                            <div class="col-auto">
                                <input type="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary">
                                    <span class="fa fa-paper-plane"></span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="border-top copyright">
                <div class="row pt-4">
                    <div class="col-lg-6 text-center text-lg-end">
                        <ul class="list-unstyled d-inline-flex ms-auto">
                            <li class="me-4"><p>Created by <a href="">KMM</a>. | &copy;2023</p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer Section -->


    <script src="landing-page/js/bootstrap.bundle.min.js"></script>
    <script src="landing-page/js/tiny-slider.js"></script>
    <script src="landing-page/js/custom.js"></script>
</body>

</html>
