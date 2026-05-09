<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>TA Penjualan - Login</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
    <style>
        :root{--primary:#166534;--secondary:#854d0e;--light:#f8fafc}
        body{font-family:"Poppins",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;color:#333}
        .btn-primary{background:var(--primary);border:none}
        .btn-primary:hover{background:#b71c1c}
        .text-primary{color:var(--primary)!important}
        .navbar-brand{font-weight:600;font-size:1.25rem}
        .navbar-nav .nav-link{font-weight:500;margin-left:1rem;transition:.3s}
        .navbar-nav .nav-link:hover{color:var(--primary)!important}
        .hero{min-height:90vh;display:flex;align-items:center;background:linear-gradient(135deg,var(--light) 0%, #fff 100%)}
        .login-card{border:1px solid #eee;border-radius:12px;padding:2rem;background:#fff;box-shadow:0 10px 20px rgba(0,0,0,.05)}
        .form-label{font-weight:500}
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home.index') }}">
                <img src="{{ asset('assets/website/150px-X-150px_LOGO-HALOCOKO-RED-BROWN-01-1-70x70.png') }}" width="40" class="me-2" alt="Logo">
                <span class="d-none d-md-inline">CV Kreasi Rasa Gembira</span>
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="/#tentang">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#portofolio">Portofolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#testimoni">Testimoni</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#kemitraan">Kemitraan</a></li>
                     <li class="nav-item"><a href="/" class="btn btn-primary ms-lg-3 px-3">Beranda</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <div class="login-card">
                        <h3 class="fw-bold mb-2">Masuk ke TA Penjualan</h3>
                        {{-- <p class="text-muted mb-3">Belum punya akun? <a href="{{ route('register') }}" class="text-primary">Daftar sekarang</a></p> --}}

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (request('success'))
                            <div class="alert alert-success">{{ request('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input id="username" type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Masukkan username">
                                @error('username')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password" placeholder="Masukkan password">
                                    <button class="btn btn-outline-secondary" type="button" id="toggle-password">Tampilkan</button>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a class="text-muted" href="{{ route('password.request') }}">Lupa Password?</a>
                                <button type="submit" class="btn btn-primary px-4">Log In</button>
                            </div>
                        </form>
                        <small class="text-muted">© 2025 Halocoko Malang</small>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('assets/website/whyHalocoko.webp') }}" class="img-fluid rounded shadow" alt="Halocoko">
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleBtn = document.getElementById('toggle-password');
        const pwdInput = document.getElementById('password');
        if (toggleBtn && pwdInput) {
            toggleBtn.addEventListener('click', function () {
                const isText = pwdInput.type === 'text';
                pwdInput.type = isText ? 'password' : 'text';
                toggleBtn.textContent = isText ? 'Tampilkan' : 'Sembunyikan';
            });
        }
    </script>
</body>
</html>
