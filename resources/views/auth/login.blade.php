<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <title>ScalePro | Login Sistem Weighbridge</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --secondary: #0ea5e9;
            --accent: #f59e0b;
            --dark: #0f172a;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-900: #0f172a;
            --success: #10b981;
            --danger: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", system-ui, -apple-system, sans-serif;
            color: #334155;
            overflow-x: hidden;
            line-height: 1.6;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
        }

        /* Loading Screen */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .loading-overlay.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader {
            width: 60px;
            height: 60px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Navbar Styles */
        .navbar-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            padding: 1rem 0;
        }

        .navbar-brand {
            font-family: "Space Grotesk", sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .nav-link {
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            position: relative;
            color: var(--gray-900) !important;
            margin: 0 0.5rem;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 80%;
        }

        /* Login Container */
        /* Login Container */
        /* Login Container */
        .login-wrapper {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 90px 1rem 3rem;
            /* ← ini yang memperbaiki overlap */
        }

        .login-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1920') center/cover;
            opacity: 0.1;
            z-index: 1;
        }

        .login-wrapper::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.95), rgba(14, 165, 233, 0.9));
            z-index: 2;
        }

        .login-container {
            position: relative;
            z-index: 3;
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
            display: flex;
            min-height: 600px;
        }

        /* Left Side - Form */
        .login-form-section {
            flex: 1;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
        }

        .login-header {
            margin-bottom: 3rem;
        }

        .login-title {
            font-family: "Space Grotesk", sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-subtitle {
            color: #64748b;
            font-size: 1.1rem;
        }

        /* Form Styles */
        .form-floating-modern {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-control-modern {
            width: 100%;
            padding: 1.25rem 1rem 0.75rem 1rem;
            font-size: 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            outline: none;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control-modern:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .form-control-modern.is-invalid {
            border-color: var(--danger);
        }

        .form-control-modern.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }

        .form-label-modern {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            font-size: 1rem;
            color: #64748b;
            transition: all 0.3s ease;
            pointer-events: none;
            background: white;
            padding: 0 0.5rem;
        }

        .form-control-modern:focus~.form-label-modern,
        .form-control-modern:not(:placeholder-shown)~.form-label-modern {
            top: 0;
            transform: translateY(-50%);
            font-size: 0.875rem;
            color: var(--primary);
            font-weight: 500;
        }

        .form-control-modern.is-invalid~.form-label-modern {
            color: var(--danger);
        }

        /* Password Toggle Button */
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            font-size: 1.25rem;
            transition: all 0.3s ease;
            z-index: 4;
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        /* Remember Me Checkbox */
        .form-check-modern {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .form-check-modern input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-right: 0.75rem;
            cursor: pointer;
            accent-color: var(--primary);
        }

        .form-check-modern label {
            cursor: pointer;
            user-select: none;
            color: #475569;
        }

        /* Login Button */
        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(37, 99, 235, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Links */
        .login-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
        }

        .login-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .login-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .login-link:hover::after {
            width: 100%;
        }

        /* Divider */
        .divider-modern {
            display: flex;
            align-items: center;
            margin: 2rem 0;
        }

        .divider-modern::before,
        .divider-modern::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .divider-modern span {
            padding: 0 1rem;
            color: #94a3b8;
            font-size: 0.875rem;
        }

        /* Social Login */
        .social-login {
            display: flex;
            gap: 1rem;
        }

        .btn-social {
            flex: 1;
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-weight: 500;
            color: #475569;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-social:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        /* Right Side - Branding */
        .login-branding-section {
            flex: 1;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .login-branding-section::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -150px;
            right: -150px;
        }

        .login-branding-section::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -200px;
            left: -200px;
        }

        .branding-content {
            position: relative;
            z-index: 1;
            text-align: center;
            color: white;
        }

        .branding-logo {
            font-family: "Space Grotesk", sans-serif;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .branding-logo i {
            font-size: 3.5rem;
            margin-right: 1rem;
        }

        .branding-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .branding-description {
            font-size: 1.1rem;
            opacity: 0.95;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            text-align: left;
            max-width: 300px;
            margin: 0 auto;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .feature-list i {
            font-size: 1.25rem;
            margin-right: 0.75rem;
            opacity: 0.95;
        }

        /* Floating Animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .float-element {
            animation: float 6s ease-in-out infinite;
        }

        .float-element-delayed {
            animation: float 6s ease-in-out infinite;
            animation-delay: 2s;
        }

        /* Alert Styles */
        .alert-modern {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border: none;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .alert-modern.alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #065f46;
        }

        .alert-modern.alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #991b1b;
        }

        .alert-modern i {
            font-size: 1.25rem;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            padding: 2rem 0;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.875rem;
            position: relative;
            z-index: 3;
        }

        .login-footer a {
            color: white;
            text-decoration: none;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }

        .login-footer a:hover {
            opacity: 0.8;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .login-card {
                flex-direction: column;
            }

            .login-branding-section {
                padding: 3rem;
                min-height: 300px;
            }

            .branding-logo {
                font-size: 2rem;
            }

            .branding-title {
                font-size: 1.5rem;
            }

            .login-form-section {
                padding: 3rem 2rem;
            }
        }

        @media (max-width: 576px) {
            .login-form-section {
                padding: 2rem 1.5rem;
            }

            .login-title {
                font-size: 1.5rem;
            }

            .social-login {
                flex-direction: column;
            }

            .login-links {
                flex-direction: column;
                gap: 1rem;
            }
        }

        /* Invalid Feedback */
        .invalid-feedback {
            display: block;
            margin-top: 0.5rem;
            color: var(--danger);
            font-size: 0.875rem;
        }

        /* Back to Home Button */
        .btn-back-home {
            background: white;
            color: var(--primary);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-back-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255, 255, 255, 0.3);
            color: var(--primary-dark);
        }
    </style>
</head>

<body>

    <!-- LOADING SCREEN -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loader"></div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-modern fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <i class="bi bi-speedometer2 me-2"></i>ScalePro
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="/#solusi">Solusi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#fitur">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#paket">Paket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#kontak">Kontak</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a href="/" class="btn-back-home">
                            <i class="bi bi-arrow-left"></i>Beranda
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- LOGIN SECTION -->
    <div class="login-wrapper">
        <div class="login-container">
            <div class="login-card" data-aos="fade-up" data-aos-duration="1000">

                <!-- LEFT SIDE - LOGIN FORM -->
                <div class="login-form-section">
                    <div class="login-header">
                        <h1 class="login-title">Selamat Datang!</h1>
                        <p class="login-subtitle">Masuk ke ScalePro Dashboard</p>
                    </div>

                    <!-- Alerts -->
                    @if (session('success'))
                        <div class="alert-modern alert-success">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (request('success'))
                        <div class="alert-modern alert-success">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>{{ request('success') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert-modern alert-danger">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <span>Username atau password salah!</span>
                        </div>
                    @endif

                    @error('captcha')
                        <div class="alert-modern alert-danger mt-2">
                            <i class="bi bi-shield-exclamation"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <!-- Username Input -->
                        <div class="form-floating-modern">
                            <input id="username" type="text" name="username"
                                class="form-control-modern @error('username') is-invalid @enderror"
                                value="{{ old('username') }}" required autocomplete="username" autofocus
                                placeholder=" ">
                            <label for="username" class="form-label-modern">Username</label>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="form-floating-modern">
                            <input id="password" type="password" name="password"
                                class="form-control-modern @error('password') is-invalid @enderror" required
                                autocomplete="current-password" placeholder=" ">
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                            <label for="password" class="form-label-modern">Password</label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="cf-turnstile" data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}" data-theme="auto">
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check-modern">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Ingat saya di perangkat ini</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-login">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Masuk ke Dashboard
                        </button>

                        <!-- Links -->
                        <div class="login-links">
                            <a href="{{ route('password.request') }}" class="login-link">
                                <i class="bi bi-key me-1"></i>Lupa Password?
                            </a>
                            {{-- <a href="/register" class="login-link">
                                <i class="bi bi-person-plus me-1"></i>Daftar Akun
                            </a> --}}
                        </div>

                        {{-- <!-- Divider -->
                        <div class="divider-modern">
                            <span>atau masuk dengan</span>
                        </div>

                        <!-- Social Login -->
                        <div class="social-login">
                            <a href="#" class="btn-social">
                                <i class="bi bi-google"></i>
                                Google
                            </a>
                            <a href="#" class="btn-social">
                                <i class="bi bi-microsoft"></i>
                                Microsoft
                            </a>
                        </div> --}}
                    </form>
                </div>

                <!-- RIGHT SIDE - BRANDING -->
                <div class="login-branding-section">
                    <div class="branding-content">
                        <div class="branding-logo float-element">
                            <i class="bi bi-speedometer2"></i>
                            <span>ScalePro</span>
                        </div>

                        <h2 class="branding-title">
                            Sistem Weighbridge Modern
                        </h2>

                        <p class="branding-description">
                            Platform monitoring real-time untuk timbangan truk elektronik
                            dengan teknologi terkini
                        </p>

                        <ul class="feature-list float-element-delayed">
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Real-time Dashboard
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Auto Report Generator
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Multi-User Access
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Cloud Data Backup
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                24/7 Support System
                            </li>
                        </ul>

                        <div class="mt-4">
                            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=500"
                                alt="Weighbridge Truck" class="img-fluid rounded-3 shadow-lg"
                                style="max-width: 300px; opacity: 0.9;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="login-footer">
        <div class="container">
            <p class="mb-0">
                © 2026 ScalePro Indonesia • All Rights Reserved
                <span class="mx-2">|</span>
                <a href="#">Privacy Policy</a>
                <span class="mx-2">•</span>
                <a href="#">Terms of Service</a>
                <span class="mx-2">•</span>
                <a href="#">Support Center</a>
            </p>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Loading Screen
        window.addEventListener('load', function () {
            setTimeout(() => {
                document.getElementById('loadingOverlay').classList.add('hidden');
            }, 500);
        });

        // Password Toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Toggle icon
                if (type === 'password') {
                    toggleIcon.classList.remove('bi-eye-slash');
                    toggleIcon.classList.add('bi-eye');
                } else {
                    toggleIcon.classList.remove('bi-eye');
                    toggleIcon.classList.add('bi-eye-slash');
                }
            });
        }

        // Form Validation Animation
        const form = document.getElementById('loginForm');
        const inputs = form.querySelectorAll('.form-control-modern');

        inputs.forEach(input => {
            input.addEventListener('blur', function () {
                if (this.value.trim() === '') {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });

            input.addEventListener('focus', function () {
                this.classList.remove('is-invalid');
            });
        });

        // Form Submit Handler
        form.addEventListener('submit', function (e) {
            let isValid = true;

            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    input.classList.add('is-invalid');
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
                // Shake animation
                form.style.animation = 'shake 0.5s';
                setTimeout(() => {
                    form.style.animation = '';
                }, 500);
            }
        });

        // Shake Animation
        const style = document.createElement('style');
        style.innerHTML = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
    `;
        document.head.appendChild(style);

        // Add ripple effect to buttons
        document.querySelectorAll('.btn-login, .btn-social').forEach(button => {
            button.addEventListener('click', function (e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                border-radius: 50%;
                background: rgba(255,255,255,0.5);
                left: ${x}px;
                top: ${y}px;
                pointer-events: none;
                transform: scale(0);
                animation: ripple 0.6s ease-out;
            `;

                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);

                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Ripple animation
        const rippleStyle = document.createElement('style');
        rippleStyle.innerHTML = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
        document.head.appendChild(rippleStyle);
    </script>

</body>

</html>
