<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DLHK</title>

    <!-- Font Style -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
        rel="stylesheet" />
    <!-- Father Icon -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Style -->
    <link rel="stylesheet" href="landing-page/style.css" />
    <style>
    .menu-card-image {
        width: 200px;
        height: 200px;
        overflow: hidden;
    }
    </style>
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar">
        <a href="#" class="navbar-logo">UPTD <span>DLHK</span> </a>
        <div class="navbar-nav">
            <a href="#home">Home</a>
            <a href="#about">Tentang Kami</a>
            <a href="#menu">Menu</a>
            <a href="#contact">Kontak</a>
        </div>

        <div class="navbar-extra">
            <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Start Jumbotron -->
    <section class="hero" id="home">
        <main class="content">
            @foreach($homes as $home)
            <h1>{{ $home->title }} <span>{{ $home->title2 }}</span></h1>
            <p>
                {{ $home->body }}
            </p>
            @endforeach
            @auth
                <a href="home " class="cta">Masuk</a>
                @else
                <a href="/login" class="cta">Login</a>
            @endauth
        </main>
    </section>
    <!-- End Jumbotron -->

    <!-- about start -->
    <section id="about" class="about">
        @foreach($abouts as $about)
        <h2><span>{{ $about->title }}</span> {{ $about->title2 }}</h2>
        <div class="row">
            <div class="about-img">
                <img src="https://source.unsplash.com/500x300?chemistry-lab" alt="Tentang Kami" />
            </div>
            <div class="content">
                <h3>{{ $about->body }}</h3>
                <p>
                    {{ $about->body2 }}
                </p>
            </div>
        </div>
        @endforeach
    </section>

    <!-- about end -->


    <!-- Menu Start -->
<section id="menu" class="menu">
    <h2><span>Produk</span> Kami</h2>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nostrum, impedit quas culpa explicabo eum ipsum
        debitis sapiente officia nesciunt pariatur!</p>
    <div class="row">
        @foreach ($analisa as $dataAnalisa)
            <div class="menu-card">
                @if ($dataAnalisa->image)
                    <!-- Jika ada gambar analisa, tampilkan gambar analisa -->
                    <img class="menu-card-image" src="{{ asset('storage/' . $dataAnalisa->image) }}" alt="{{ $dataAnalisa->name }}" />
                @else
                    <!-- Jika tidak ada gambar analisa, tampilkan gambar dari sumber eksternal (misalnya, Unsplash) -->
                    <img class="menu-card-image" src="https://source.unsplash.com/200x200?{{ $dataAnalisa->name }}" alt="{{ $dataAnalisa->name }}" />
                @endif
                <h3 class="menu-card-title">{{ $dataAnalisa->name }}</h3>
                <p class="menu-card-price">{{ $dataAnalisa->harga }}</p>
                <form action="{{ route('cart.add', $dataAnalisa->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                </form>
            </div>
        @endforeach
    </div>
</section>
<!-- Menu End -->


    {{-- Contact Start --}}
    <section id="contact" class="contact">
        <h2>Hubungi <span>Kami</span></h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione ducimus animi soluta numquam.</p>

        <div class="row">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.9314612317517!2d106.48348967793375!3d-6.2727431879453315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4206f8b5190775%3A0xb59dddbe878ed0d1!2sDinas%20Lingkungan%20Hidup%20%26%20Kebersihan%20(DLHK)%20Kab.%20Tangerang!5e0!3m2!1sid!2sid!4v1693799102052!5m2!1sid!2sid"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>

            <form action="">
                <div class="input-group">
                    <i data-feather="user"></i>
                    <input type="text" placeholder="nama">
                </div>
                <div class="input-group">
                    <i data-feather="mail"></i>
                    <input type="text" placeholder="email">
                </div>
                <div class="input-group">
                    <i data-feather="phone"></i>
                    <input type="text" placeholder="No Handphone">
                </div>
                <button type="submit" class="btn">Kirim Pesan</button>
            </form>
        </div>
    </section>
    {{-- Contact End --}}

    {{-- Start Footer --}}
    <footer>
        <div class="sosials">
            <a href=""><i data-feather="instagram"></i></a>
        </div>

        <div class="links">
            <a href="#home">Home</a>
            <a href="#about">Tentang Kami</a>
            <a href="#menu">Produk Kami</a>
            <a href="#contact">Hubungi Kami</a>
        </div>

        <div class="credit">
            <p>Created by <a href="">KMM</a>. | &copy;2023</p>
        </div>
    </footer>
    {{-- End Footer --}}

    <!-- Call Father Icon -->
    <script>
        feather.replace();

    </script>


    <!-- Style -->
    <script src="landing-page/style.js"></script>
</body>

</html>
