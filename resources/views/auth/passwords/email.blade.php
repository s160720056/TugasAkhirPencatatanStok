<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScalePro - Pemulihan Password</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --secondary: #0ea5e9;
            --accent: #f59e0b;
            --dark: #0f172a;
            --gray-50: #f8fafc;
        }

        body {
            font-family: "Inter", system-ui, sans-serif;
            color: #334155;
            overflow-x: hidden;
        }

        .navbar-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-family: "Space Grotesk", sans-serif;
            font-weight: 700;
            font-size: 1.6rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* HERO RESET PASSWORD */
        .reset-hero {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(37, 99, 235, 0.85)),
                        url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1920') center/cover no-repeat;
            display: flex;
            align-items: center;
            position: relative;
        }

        .reset-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
            padding: 2.8rem;
            max-width: 460px;
            width: 100%;
        }

        .form-control {
            border-radius: 12px;
            padding: 14px 18px;
            border: 1.5px solid #e2e8f0;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .btn-modern-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            padding: 14px 32px;
            font-weight: 600;
            border-radius: 12px;
            font-size: 1.05rem;
            transition: all 0.3s ease;
        }

        .btn-modern-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.4);
        }

        .section-tag {
            display: inline-block;
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .illustration-text {
            color: white;
            font-size: 2.8rem;
            font-weight: 700;
            line-height: 1.1;
            font-family: "Space Grotesk", sans-serif;
        }

        .security-features {
            display: flex;
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .security-item {
            text-align: center;
            flex: 1;
        }

        .security-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin: 0 auto 0.75rem;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-modern sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home.index') }}">
            <i class="bi bi-speedometer2 me-2"></i>ScalePro
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ route('home.index') }}" class="nav-link">Beranda</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- RESET PASSWORD SECTION -->
<section class="reset-hero">
    <div class="container">
        <div class="row align-items-center justify-content-center min-vh-100">
            
            <!-- Form Reset -->
            <div class="col-lg-5 col-md-8" data-aos="fade-right">
                <div class="reset-card">
                    <div class="text-center mb-4">
                        <i class="bi bi-key fs-1 text-primary"></i>
                        <h2 class="fw-bold mt-3">Pemulihan Password</h2>
                        <p class="text-muted">Masukkan email Anda untuk menerima instruksi reset password.</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-medium">Email Address</label>
                            <input type="email" name="email" 
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" 
                                   placeholder="Masukkan email Anda"
                                   required autofocus autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <a href="{{ route('login') }}" class="text-muted">
                                <i class="bi bi-arrow-left me-1"></i> Kembali ke Login
                            </a>
                            <button type="submit" class="btn btn-modern-primary">
                                <i class="bi bi-send me-2"></i> Kirim Instruksi
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <small class="text-muted">
                            © 2026 ScalePro • Sistem aman & terpercaya
                        </small>
                    </div>
                </div>
            </div>

            <!-- Side Illustration -->
            <div class="col-lg-6 d-none d-lg-block" data-aos="fade-left">
                <div class="ps-5">
                    <span class="section-tag">PASSWORD RECOVERY</span>
                    <h1 class="illustration-text mt-3 mb-4">
                        Pulihkan Akses<br>
                        Akun Anda<br>
                        Dalam Menit.
                    </h1>
                    <p class="text-white-50 fs-5 mb-5">
                        Kami akan mengirimkan link reset password aman langsung ke email Anda. 
                        Proses verifikasi instan dengan enkripsi end-to-end.
                    </p>

                    <div class="security-features">
                        <div class="security-item">
                            <div class="security-icon">
                                <i class="bi bi-envelope-check"></i>
                            </div>
                            <h6 class="fw-bold text-white mb-1">Email Verifikasi</h6>
                            <p class="text-white-50 small mb-0">Kirim dalam 60 detik</p>
                        </div>
                        <div class="security-item">
                            <div class="security-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <h6 class="fw-bold text-white mb-1">Enkripsi Tinggi</h6>
                            <p class="text-white-50 small mb-0">Data 100% aman</p>
                        </div>
                        <div class="security-item">
                            <div class="security-icon">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <h6 class="fw-bold text-white mb-1">Berlaku 1 Jam</h6>
                            <p class="text-white-50 small mb-0">Link reset sementara</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init({ once: true });
</script>

</body>
</html>