<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Perusahaan - Halocoko</title>

    <link rel="icon" href="https://via.placeholder.com/32" type="image/x-icon">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .img-placeholder {
            width: 100%;
            height: 220px;
            background: #e9ecef;
            border: 2px dashed #adb5bd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-weight: 500;
        }

        .hero-img {
            height: 320px;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="https://halocoko.com/wp-content/uploads/2025/01/150px-X-150px_LOGO-HALOCOKO-RED-BROWN-01-1-70x70.png" width="40" class="me-2">
            Halocoko
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#about">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                <li class="nav-item">
                    <button class="btn btn-primary ms-lg-3">Login</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <h1 class="fw-bold">Profil Perusahaan Halocoko</h1>
                <p class="text-muted fs-5">
                    Kami berkomitmen menghadirkan es krim cokelat berkualitas tinggi
                    yang menciptakan momen manis untuk semua usia.
                </p>
                <a href="#" class="btn btn-primary mt-3">Pelajari Lebih Lanjut</a>
            </div>
            <div class="col-md-6">
                <!-- SLOT GAMBAR HERO -->
                <div class="img-placeholder hero-img">
                    Banner / Foto Produk Halocoko
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section id="about" class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4">
                <!-- SLOT GAMBAR TENTANG -->
                <div class="img-placeholder">
                    Foto Brand / Aktivitas Produksi
                </div>
            </div>
            <div class="col-md-6">
                <h2>Tentang Halocoko</h2>
                <p class="text-muted">
                    Halocoko percaya bahwa cokelat memiliki kekuatan ajaib untuk
                    menciptakan momen tak terlupakan, baik untuk anak-anak
                    maupun orang dewasa.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- WHY -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Mengapa Harus Halocoko?</h2>

        <div class="row justify-content-center align-items-center">
            <div class="col-md-5 mb-4">
                <!-- SLOT GAMBAR RISET / PRODUK -->
                <div class="img-placeholder">
                    Gambar Produk / Market Insight
                </div>
            </div>
            <div class="col-md-6">
                <h5>Varian Rasa Favorit Indonesia</h5>
                <p class="text-muted">
                    Berdasarkan riset, 62,8% masyarakat Indonesia menyukai
                    cokelat. Halocoko hadir sebagai spesialis es krim cokelat
                    dengan pasar luas dan berkelanjutan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- FACILITY -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Fasilitas Produksi</h2>

        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="img-placeholder mb-3">Foto Pabrik 01</div>
                <h5>Aice Sumatera Industry</h5>
                <p class="text-muted">Fasilitas manufaktur modern dan terintegrasi.</p>
            </div>

            <div class="col-md-4 mb-4">
                <div class="img-placeholder mb-3">Foto Pabrik 02</div>
                <h5>Aice Ice Cream Jatim</h5>
                <p class="text-muted">Pabrik es krim terbesar di Asia Tenggara.</p>
            </div>

            <div class="col-md-4 mb-4">
                <div class="img-placeholder mb-3">Foto Pabrik 03</div>
                <h5>Alpen Food Industry</h5>
                <p class="text-muted">Standar keamanan pangan internasional.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5 bg-primary text-white text-center">
    <div class="container">
        <h3>Ayo Bergabung Bersama Kami</h3>
        <p class="mb-4">
            Investasi rendah, keuntungan tinggi, dan dukungan penuh untuk mitra.
        </p>
        <a href="#" class="btn btn-light">Jadi Reseller</a>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p class="mb-1">
            The Suite Tower, Jl. Boulevard Pantai Indah Kapuk No.1, Jakarta Utara
        </p>
        <small>Copyright © 2026 Halocoko</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
