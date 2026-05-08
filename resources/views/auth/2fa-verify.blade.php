<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <title>ScalePro | Two-Factor Authentication</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --secondary: #0ea5e9;
            --accent: #f59e0b;
            --dark: #0f172a;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: "Inter", system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .loading-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex; align-items: center; justify-content: center;
            z-index: 9999; transition: opacity 0.5s ease;
        }
        .loading-overlay.hidden { opacity: 0; visibility: hidden; }
        .loader { width: 60px; height: 60px; border: 5px solid rgba(255,255,255,0.3); border-top-color: white; border-radius: 50%; animation: spin 1s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        .navbar-modern { background: rgba(255,255,255,0.95); backdrop-filter: blur(12px); box-shadow: 0 1px 3px rgba(0,0,0,0.05); padding: 1rem 0; }
        .navbar-brand { font-family: "Space Grotesk", sans-serif; font-weight: 700; font-size: 1.5rem; background: linear-gradient(135deg, var(--primary), var(--secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        .login-wrapper { min-height: 100vh; position: relative; display: flex; align-items: center; justify-content: center; padding: 90px 1rem 3rem; }
        .login-wrapper::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1920') center/cover; opacity: 0.1; z-index: 1; }
        .login-wrapper::after { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(37,99,235,0.95), rgba(14,165,233,0.9)); z-index: 2; }

        .login-card { background: rgba(255,255,255,0.98); backdrop-filter: blur(20px); border-radius: 24px; overflow: hidden; box-shadow: 0 30px 80px rgba(0,0,0,0.2); display: flex; min-height: 600px; position: relative; z-index: 3; }
        .login-form-section { flex: 1; padding: 4rem; display: flex; flex-direction: column; justify-content: center; background: white; }
        .login-header { margin-bottom: 2.5rem; }
        .login-title { font-family: "Space Grotesk", sans-serif; font-size: 2rem; font-weight: 700; color: var(--dark); margin-bottom: 0.5rem; background: linear-gradient(135deg, var(--primary), var(--secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        .alert-modern { padding: 1rem 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; border: none; display: flex; align-items: center; gap: 1rem; }
        .alert-modern.alert-danger { background: rgba(239,68,68,0.1); color: #991b1b; }

        .form-control-modern {
            width: 100%; padding: 1.25rem 1rem 0.75rem 1rem; font-size: 1.8rem; text-align: center;
            letter-spacing: 12px; border: 2px solid #e2e8f0; border-radius: 12px; outline: none;
        }
        .form-control-modern:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(37,99,235,0.1); }

        .btn-login {
            width: 100%; padding: 1rem; background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white; border: none; border-radius: 12px; font-weight: 600; font-size: 1.05rem;
            cursor: pointer; transition: all 0.3s ease;
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 15px 40px rgba(37,99,235,0.3); }

        .tutorial-step { font-size: 0.95rem; }
        .app-logo { width: 42px; height: 42px; object-fit: contain; }
    </style>
</head>

<body>

    <!-- LOADING -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loader"></div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-modern fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-speedometer2 me-2"></i>ScalePro
            </a>
        </div>
    </nav>

    <!-- 2FA SECTION -->
    <div class="login-wrapper">
        <div class="login-container">
            <div class="login-card" data-aos="fade-up" data-aos-duration="1000">

                <!-- LEFT SIDE - FORM -->
                <div class="login-form-section">
                    <div class="login-header">
                        <h1 class="login-title">Two-Factor Authentication</h1>
                        <p class="text-muted">Masukkan kode 6 digit dari aplikasi authenticator Anda</p>
                    </div>

                    @if (session('error'))
                        <div class="alert-modern alert-danger">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert-modern alert-danger">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <!-- TUTORIAL -->
                    <div class="mb-4 p-3 bg-light rounded-3">
                        <h6 class="fw-semibold text-dark mb-3">
                            <i class="bi bi-lightbulb-fill text-warning"></i> Cara Memasukkan Kode
                        </h6>
                        <div class="tutorial-step">
                            <div class="d-flex mb-2">
                                <span class="badge bg-primary rounded-pill me-2">1</span>
                                Buka aplikasi <strong>Google Authenticator</strong>, <strong>Microsoft Authenticator</strong>, atau <strong>Authy</strong> di HP Anda
                            </div>
                            <div class="d-flex mb-2">
                                <span class="badge bg-primary rounded-pill me-2">2</span>
                                Cari akun <strong>ScalePro</strong>
                            </div>
                            <div class="d-flex">
                                <span class="badge bg-primary rounded-pill me-2">3</span>
                                Ketik 6 digit kode yang muncul di aplikasi
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('2fa.verify.post') }}" id="verifyForm">
                        @csrf

                        <div class="mb-4">
                            <input 
                                type="text" 
                                id="code"
                                name="code" 
                                maxlength="6"
                                autocomplete="off"
                                autofocus
                                required
                                class="form-control-modern"
                                placeholder="000000">
                            <small class="text-muted d-block mt-3">
                                <i class="bi bi-info-circle me-1"></i>
                                Kode akan otomatis diverifikasi setelah 6 digit terisi
                            </small>
                        </div>

                        <!-- SUPPORTED AUTHENTICATOR APPS -->
                        <div class="mb-4">
                            <p class="text-muted mb-2 small">Didukung oleh:</p>
                            <div class="d-flex gap-3">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/84/Google_Authenticator_%28April_2023%29.svg/960px-Google_Authenticator_%28April_2023%29.svg.png?_=20230427070223" 
                                     alt="Google Authenticator" class="app-logo" title="Google Authenticator">
                                <img src="https://mecdata.it/wp-content/uploads/2024/12/Microsoft_Authenticator_iOS_icon.webp" 
                                     alt="Microsoft Authenticator" class="app-logo" title="Microsoft Authenticator">
                                <img src="https://icon-icons.com/download-file?file=https%3A%2F%2Fimages.icon-icons.com%2F278%2FPNG%2F512%2FAuthy1_30200.png&id=30200&pack_or_individual=pack" 
                                     alt="Authy" class="app-logo" title="Authy">
                            </div>
                        </div>

                        <button type="submit" id="submitBtn" class="btn-login">
                            <i class="bi bi-shield-check me-2"></i>
                            Verifikasi Kode
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-muted text-decoration-none">
                            ← Kembali ke halaman login
                        </a>
                    </div>
                </div>

               
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });

        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('loadingOverlay').classList.add('hidden');
            }, 400);
        });

        // Auto submit ketika 6 digit terisi
        const codeInput = document.getElementById('code');
        const form = document.getElementById('verifyForm');

        codeInput.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length === 6) {
                form.submit();
            }
        });
    </script>
</body>
</html>