<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>TA Penjualan - Reset Password</title>
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('home.index') }}#tentang">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home.index') }}#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home.index') }}#portofolio">Portofolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home.index') }}#testimoni">Testimoni</a></li>
                    <li class="nav-item"><a class="btn btn-outline-secondary ms-lg-3 px-3" href="{{ route('home.index') }}">Beranda</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <div class="login-card">
                        <h3 class="fw-bold mb-2">Reset Password</h3>
                        <p class="text-muted mb-3">Masukkan email dan password baru Anda.</p>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <div class="input-group">
                                    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" placeholder="Masukkan password baru">
                                    <button class="btn btn-outline-secondary" type="button" id="toggle-password">Tampilkan</button>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password" placeholder="Ulangi password baru">
                                    <button class="btn btn-outline-secondary" type="button" id="toggle-password-confirm">Tampilkan</button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a class="text-muted" href="{{ route('login') }}">Kembali ke Login</a>
                                <button type="submit" class="btn btn-primary px-4">Reset Password</button>
                            </div>
                        </form>
                        <small class="text-muted">© 2025 Halocoko Malang</small>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('assets/website/1260-x-1153-Rasa-Lebih-Berkarakter-1024x937.webp') }}" class="img-fluid rounded shadow" alt="Halocoko">
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePwd = document.getElementById('toggle-password');
        const pwd = document.getElementById('password');
        if (togglePwd && pwd) {
            togglePwd.addEventListener('click', function () {
                const isText = pwd.type === 'text';
                pwd.type = isText ? 'password' : 'text';
                togglePwd.textContent = isText ? 'Tampilkan' : 'Sembunyikan';
            });
        }
        const togglePwdC = document.getElementById('toggle-password-confirm');
        const pwdC = document.getElementById('password-confirm');
        if (togglePwdC && pwdC) {
            togglePwdC.addEventListener('click', function () {
                const isText = pwdC.type === 'text';
                pwdC.type = isText ? 'password' : 'text';
                togglePwdC.textContent = isText ? 'Tampilkan' : 'Sembunyikan';
            });
        }
    </script>
</body>
</html>
