<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>TA Penjualan - Registrasi</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
    <style>
        :root{--primary:#2196f7;--secondary:#795548;--light:#fff8f0}
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
<script>
    window.onload = function() {
       window.location.href = "{{ route('login') }}";
    }
</script>
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
            <div class="row align-items-start">
                <div class="col-lg-6 mb-4">
                    <div class="login-card">
                        <h3 class="fw-bold mb-2">Registrasi Bisnis</h3>
                        <p class="text-muted mb-3">Lengkapi informasi bisnis dan akun pengguna.</p>
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <h5 class="mb-3">Informasi Bisnis</h5>
                            <div class="mb-3 text-center">
                                <img id="logo-preview" src="{{ asset('assets/contohLogo/contohLogo.png') }}" alt="Logo Preview" class="rounded-circle" style="width:150px;height:150px;object-fit:cover">
                                <input id="logo_toko" type="file" name="logo_toko" class="form-control mt-2 @error('logo_toko') is-invalid @enderror">
                                @error('logo_toko')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama_toko" class="form-label">Nama Bisnis</label>
                                <input id="nama_toko" type="text" name="nama_toko" class="form-control @error('nama_toko') is-invalid @enderror" value="{{ old('nama_toko') }}" placeholder="Nama Bisnis">
                                @error('nama_toko')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                                <input id="nama_pemilik" type="text" name="nama_pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror" value="{{ old('nama_pemilik') }}" placeholder="Nama Pemilik">
                                @error('nama_pemilik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat_toko" class="form-label">Alamat Bisnis</label>
                                <input id="alamat_toko" type="text" name="alamat_toko" class="form-control @error('alamat_toko') is-invalid @enderror" value="{{ old('alamat_toko') }}" placeholder="Alamat Bisnis">
                                @error('alamat_toko')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="tlp" class="form-label">No Telepon</label>
                                <input id="tlp" type="text" name="tlp" class="form-control @error('tlp') is-invalid @enderror" value="{{ old('tlp') }}" placeholder="No Telepon">
                                @error('tlp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="ppn" class="form-label">PPN</label>
                                <input id="ppn" type="text" name="ppn" class="form-control @error('ppn') is-invalid @enderror" value="{{ old('ppn') }}" placeholder="PPN">
                                @error('ppn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="email_toko" class="form-label">Email Bisnis</label>
                                <input id="email_toko" type="email" name="email_toko" class="form-control @error('email_toko') is-invalid @enderror" value="{{ old('email_toko') }}" placeholder="Email Bisnis">
                                @error('email_toko')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <hr class="my-3">
                            <h5 class="mb-3">Informasi Pengguna</h5>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input id="nama" type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama" required>
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input id="username" type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" autocomplete="username" placeholder="Username" required>
                                @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" placeholder="Email" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input id="alamat" type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" autocomplete="street-address" placeholder="Alamat" required>
                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input id="no_hp" type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" autocomplete="tel" placeholder="No HP" required>
                                @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="toggle-password">Tampilkan</button>
                                    @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input id="password-confirm" type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="toggle-password-confirm">Tampilkan</button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <a class="text-muted" href="{{ route('login') }}">Sudah punya akun? Login</a>
                                <button type="submit" class="btn btn-primary px-4">Register</button>
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
        const logoInput = document.getElementById('logo_toko');
        const logoPrev = document.getElementById('logo-preview');
        if (logoInput && logoPrev) {
            logoInput.addEventListener('change', function() {
                const file = this.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function(e) { logoPrev.src = e.target.result; };
                reader.readAsDataURL(file);
            });
        }
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
