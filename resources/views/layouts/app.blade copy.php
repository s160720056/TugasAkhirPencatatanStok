<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title id="title_page">{{ isset($menu) ? $menu : 'Dashboard' }} - SV MOTOR</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Space+Grotesk:wght@500;600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Symbols+Outlined:400,500,600" rel="stylesheet">

    <!-- Core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/mdb/css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/fontAwesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/select2/select2.min.css') }}" rel="stylesheet">

    <!-- DataTable & SweetAlert -->
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/sweetalerts/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="plugins/tempus-dominus/tempus-dominus.min.css">

    <style>
    :root {
        --primary: #2196f7;
        --primary-dark: #b71c1c;
        --sidebar-width: 280px;
        --navbar-height: 64px;
    }

    /* Light / Dark Mode Variables */
    body {
        --bg: #f8fafc;
        --card-bg: #ffffff;
        --text: #0f172a;
        --text-muted: #64748b;
        --border: #e2e8f0;
        --sidebar-bg: #ffffff;
    }

    body.dark {
        --bg: #0f172a;
        --card-bg: #1e2937;
        --text: #f1f5f9;
        --text-muted: #94a3b8;
        --border: #334155;
        --sidebar-bg: #1e2937;
    }

    body {
        font-family: 'Inter', system_ui, sans-serif;
        background: var(--bg);
        color: var(--text);
        transition: background 0.3s ease, color 0.3s ease;
    }

    /* ==================== NAVBAR ==================== */
    .navbar {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05);
        border-bottom: 1px solid var(--border);
        height: var(--navbar-height);
        z-index: 1050;
    }

    body.dark .navbar {
        background: rgba(30, 41, 59, 0.95);
    }

    .header-container .container-fluid {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    @media (max-width: 991px) {
        .header-container .container-fluid {
            padding-left: 12px;
            padding-right: 12px;
        }
        .navbar-brand img {
            width: 36px;
            height: 36px;
        }
    }

    /* ==================== SIDEBAR ==================== */
    .sidebar-wrapper {
        position: fixed;
        top: var(--navbar-height);
        left: 0;
        width: var(--sidebar-width);
        height: calc(100vh - var(--navbar-height));
        background: var(--sidebar-bg);
        border-right: 1px solid var(--border);
        box-shadow: 2px 0 15px -3px rgba(0, 0, 0, 0.08);
        z-index: 1040;
        overflow-y: auto;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateX(-100%);
    }

    /* Desktop (≥992px) - always visible unless collapsed */
    @media (min-width: 992px) {
        .sidebar-wrapper {
            transform: translateX(0);
        }
        body.sidebar-collapsed .sidebar-wrapper {
            transform: translateX(-280px);
        }
        #content {
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
        }
        body.sidebar-collapsed #content {
            margin-left: 0;
        }
    }

    /* Mobile - slide-in drawer */
    body.sidebar-open .sidebar-wrapper {
        transform: translateX(0);
    }

    .sidebar-inner {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    /* Profile Section */
    .profile-info {
        padding: 28px 20px;
        background: rgba(0, 0, 0, 0.02);
        border-bottom: 1px solid var(--border);
    }

    .profile-info img {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    /* Menu Container */
    .menu-container {
        flex: 1;
        padding: 16px 12px;
        overflow-y: auto;
    }

    /* Menu Items */
    .menu {
        margin: 3px 8px;
    }

    .menu a {
        display: flex;
        align-items: center;
        padding: 13px 16px;
        border-radius: 12px;
        text-decoration: none;
        color: #475569;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .menu a:hover {
        background: #f1f5f9;
        color: var(--primary);
        transform: translateX(6px);
    }

    .menu.active a {
        background: #2196f7;
        color: white;
        font-weight: 600;
        box-shadow: 0 4px 15px -2px rgba(211, 47, 47, 0.35);
    }

    .menu .material-symbols-outlined {
        font-size: 24px;
        width: 28px;
        flex-shrink: 0;
        margin-right: 16px;
    }

    /* Dark Mode Adjustments */
    body.dark .menu a {
        color: #cbd5e1;
    }

    body.dark .menu a:hover {
        background: #334155;
    }

    body.dark .menu.active a {
        background: #2196f7;
    }

    /* Overlay for mobile */
    .overlay {
        position: fixed;
        top: var(--navbar-height);
        left: 0;
        width: 100%;
        height: calc(100vh - var(--navbar-height));
        background: rgba(0, 0, 0, 0.5);
        z-index: 1030;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    @media (min-width: 992px) {
        .overlay { display: none; }
    }

    body.sidebar-open .overlay {
        opacity: 1;
        visibility: visible;
    }

    /* ==================== CONTENT ==================== */
    #content {
        background: var(--bg);
        min-height: calc(100vh - var(--navbar-height));
        padding-top: var(--navbar-height);           /* IMPORTANT: prevents overlap with fixed navbar */
        transition: margin-left 0.3s ease;
    }

    @media (max-width: 991px) {
        #content {
            padding-top: var(--navbar-height);       /* mobile safety */
            margin-left: 0 !important;
        }
    }

    /* Other Components */
    .dropdown-menu {
        background: var(--card-bg);
        border: 1px solid var(--border);
        box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1);
    }

    .btn-primary {
        background: var(--primary);
        border: none;
        border-radius: 9999px;
        font-weight: 600;
    }

    .btn-primary:hover { background: var(--primary-dark); }

    /* Loader */
    #load_screen {
        position: fixed;
        inset: 0;
        background: var(--bg);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 99999;
        opacity: 1;
        transition: opacity 0.4s ease;
    }

    .modern-spinner {
        width: 56px;
        height: 56px;
        border: 5px solid #e2e8f0;
        border-top-color: var(--primary);
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    body.dark .modern-spinner {
        border-color: #334155;
        border-top-color: var(--primary);
    }

    @keyframes spin { to { transform: rotate(360deg); } }

    .loader-text {
        margin-top: 16px;
        font-weight: 500;
        color: var(--text-muted);
    }
    </style>
</head>

<body class="sidebar-noneoverflow">

    <input type="hidden" id="menuNavBar" value="{{ $menu ?? '' }}">

    <!-- LOADER -->
    <div id="load_screen">
        <div class="loader-content text-center">
            <div class="modern-spinner mx-auto"></div>
            <div class="loader-text mt-3">Memuat...</div>
        </div>
    </div>

    <!-- NAVBAR -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-lg">
            <div class="container-fluid px-3 px-md-4">
                <div class="d-flex align-items-center gap-3">
                    @if (isset($menu) && $menu != 'register')
                        <!-- Sidebar Toggle -->
                        <button id="sidebarToggle" class="btn btn-link text-decoration-none p-2">
                            <span class="material-symbols-outlined">menu</span>
                        </button>

                        <a href="{{ route('home.index') }}" class="navbar-brand d-flex align-items-center gap-2">
                            <img src="assets/img/90x90.jpg" alt="logo" id="navbar-logo" class="rounded-3" width="42" height="42">
                            <span id="judul_app" class="d-none d-md-block fw-semibold fs-5"></span>
                        </a>
                    @else
                        <a href="{{ route('home.index') }}" class="btn btn-outline-secondary">← Kembali</a>
                    @endif
                </div>

                @if (isset($menu) && $menu != 'register')
                    <ul class="navbar-nav ms-auto align-items-center gap-2 gap-md-3">
                        <!-- Dark Mode Toggle -->
                        <li class="nav-item">
                            <button id="darkModeToggle" class="btn btn-link text-decoration-none p-2" title="Toggle Dark Mode">
                                <span class="material-symbols-outlined" id="themeIcon">dark_mode</span>
                            </button>
                        </li>

                        <!-- User Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                                <img src="assets/img/90x90.jpg" id="navbar-avatar" alt="avatar" class="rounded-circle" width="34" height="34">
                                <div class="d-none d-sm-block text-start">
                                    <span class="fw-medium">@php echo explode(' ', trim(session('username') ?? ''))[0]; @endphp</span>
                                    <small class="text-muted d-block">{{ session('nama_hak_akses') }}</small>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('home.index') }}">
                                    <span class="material-symbols-outlined">home</span> Beranda
                                </a></li>
                                <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('PengaturanToko') }}">
                                    <span class="material-symbols-outlined">settings</span> Pengaturan
                                </a></li>
                                <li><a class="dropdown-item d-flex align-items-center gap-2" onclick="lockScreen()">
                                    <span class="material-symbols-outlined">lock</span> Kunci Layar
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item d-flex align-items-center gap-2 text-danger">
                                            <span class="material-symbols-outlined">logout</span> Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endif
            </div>
        </header>
    </div>

    <!-- MAIN CONTAINER -->
    <div class="main-container" id="container">
        <div class="overlay"></div>

        <!-- SIDEBAR -->
        <div class="sidebar-wrapper">
            @if (isset($menu) && $menu != 'register')
                <nav id="sidebar" class="sidebar-nav">
                    <div class="sidebar-inner">

                        <!-- Profile Section -->
                        <div class="profile-info px-4 py-5 border-bottom">
                            <div class="d-flex align-items-center gap-3">
                                <img src="/storage/toko/1/logo_69d35ef29e609.avif" 
                                     id="sidebar-avatar" 
                                     alt="avatar" 
                                     class="rounded-circle" 
                                     width="52" height="52">
                                <div>
                                    <h6 class="mb-0 fw-semibold text-dark">admin</h6>
                                    <small class="text-muted">Manager</small>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Container -->
                        <div class="menu-container px-3 py-4" id="accordionExample">
                            {{-- Dynamic menu injected by JS --}}
                        </div>

                    </div>
                </nav>
            @endif
        </div>

        <!-- CONTENT -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing" id="isiContent">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (config('app.warning_message'))
                        <div class="alert alert-warning alert-dismissible fade show">
                            <strong>Perhatian!</strong> Aplikasi ini sedang dalam tahap uji coba.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error') || session('success'))
                        <div class="alert alert-{{ session('error') ? 'danger' : 'success' }} alert-dismissible fade show">
                            {{ session('error') ?? session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- LOCK SCREEN -->
    <div id="lock-screen" class="lock-screen d-none flex-column align-items-center justify-content-center position-fixed top-0 start-0 w-100 h-100">
        <div class="lock-content text-center">
            <span class="material-symbols-outlined" style="font-size: 4.5rem; color: #2196f7;">lock</span>
            <h3 class="mt-3 mb-4 fw-semibold">Layar Terkunci</h3>
            <form id="unlock-form" class="d-flex flex-column gap-3">
                <div class="form-floating">
                    <input type="password" id="password" class="form-control" placeholder="Password" required>
                    <label for="password">Masukkan Password</label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg">Buka Kunci</button>
                <button type="button" onclick="logOut()" class="btn btn-outline-secondary">Keluar</button>
            </form>
        </div>
    </div>

    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
        @csrf
        <button type="submit" id="tombolLogout" style="display:none;"></button>
    </form>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/axios/axios.min.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <script src="{{ asset('plugins/sweetalerts/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('assets/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/qrCodeScanner/qrcodescan.min.js') }}"></script>

    <script>
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;

    function hideLoader() {
        const loader = document.getElementById('load_screen');
        if (loader) {
            loader.style.opacity = '0';
            setTimeout(() => { loader.style.display = 'none'; }, 400);
        }
    }

    function initDarkMode() {
        const toggle = document.getElementById('darkModeToggle');
        const icon = document.getElementById('themeIcon');
        const body = document.body;

        if (localStorage.getItem('darkMode') === 'true') {
            body.classList.add('dark');
            icon.textContent = 'light_mode';
        }

        toggle.addEventListener('click', () => {
            body.classList.toggle('dark');
            const isDark = body.classList.contains('dark');
            localStorage.setItem('darkMode', isDark);
            icon.textContent = isDark ? 'light_mode' : 'dark_mode';
        });
    }

    function initSidebarToggle() {
        const toggleBtn = document.getElementById('sidebarToggle');
        const body = document.body;
        const overlay = document.querySelector('.overlay');

        // Load saved state (desktop only)
        if (window.innerWidth >= 992 && localStorage.getItem('sidebarCollapsed') === 'true') {
            body.classList.add('sidebar-collapsed');
        }

        toggleBtn.addEventListener('click', () => {
            if (window.innerWidth < 992) {
                // Mobile → open drawer
                body.classList.toggle('sidebar-open');
                if (body.classList.contains('sidebar-open')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            } else {
                // Desktop → collapse
                body.classList.toggle('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', body.classList.contains('sidebar-collapsed'));
            }
        });

        // Close sidebar when clicking overlay (mobile)
        if (overlay) {
            overlay.addEventListener('click', () => {
                body.classList.remove('sidebar-open');
                document.body.style.overflow = '';
            });
        }

        // Close sidebar when clicking any menu link on mobile
        document.addEventListener('click', function (e) {
            if (window.innerWidth < 992 && body.classList.contains('sidebar-open')) {
                if (e.target.closest('.menu a')) {
                    body.classList.remove('sidebar-open');
                    document.body.style.overflow = '';
                }
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && body.classList.contains('sidebar-open')) {
                body.classList.remove('sidebar-open');
                document.body.style.overflow = '';
            }
        });

        // Reset on window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) {
                body.classList.remove('sidebar-open');
                document.body.style.overflow = '';
            }
        });
    }

    $(document).ready(function () {
        initDarkMode();
        initSidebarToggle();

        const forceHide = setTimeout(hideLoader, 4000);
        const currentMenu = $('#menuNavBar').val();

        if (currentMenu && currentMenu !== 'register') {
            axios.post('/cekHakAkses', { menu: currentMenu || 'home' })
                .then(response => {
                    if (response.data.status === 'success') {
                        $('#accordionExample').html(response.data.data || '').show();
                        $('#content').show();

                        setTimeout(() => {
                            if (typeof App !== 'undefined' && typeof App.init === 'function') {
                                try { App.init(); } catch (e) { console.warn('App.init skipped:', e); }
                            }
                        }, 300);
                    } else if (response.data.status === 'error') {
                        window.location.href = response.data.firstMenuUrl || '/';
                    }
                    hideLoader();
                    clearTimeout(forceHide);
                })
                .catch(err => {
                    console.error('Hak Akses check failed:', err);
                    $('#content').show();
                    hideLoader();
                    clearTimeout(forceHide);
                });
        } else {
            $('#content').show();
            hideLoader();
            if (typeof App !== 'undefined') App.init();
        }

        // Store Info
        axios.get('/toko/getInfoToko')
            .then(res => {
                if (res.data.status === 'success') {
                    const { nama_toko, logo_toko } = res.data.data;
                    if (nama_toko) $('#judul_app').text(nama_toko);
                    if (logo_toko) {
                        $('#navbar-logo, #navbar-avatar, #sidebar-avatar').attr('src', `/storage/${logo_toko}`);
                    }
                }
            });

        $('.select2').select2({ theme: 'bootstrap-5' });
    });

    // Lock Screen Functions
    function lockScreen() {
        const lock = document.getElementById('lock-screen');
        lock.classList.remove('d-none');
        lock.classList.add('d-flex');
        $('#content').hide();
    }

    function logOut() {
        document.getElementById('tombolLogout').click();
    }

    // Unlock Form
    document.addEventListener('DOMContentLoaded', () => {
        const unlockForm = document.getElementById('unlock-form');
        if (unlockForm) {
            unlockForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const password = document.getElementById('password').value;
                try {
                    const res = await fetch('/unlock', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ password })
                    });
                    const data = await res.json();
                    if (data.success) {
                        const lock = document.getElementById('lock-screen');
                        lock.classList.add('d-none');
                        lock.classList.remove('d-flex');
                        $('#content').show();
                    } else {
                        Swal.fire('Gagal', 'Password salah', 'error');
                    }
                } catch (err) {
                    Swal.fire('Error', 'Terjadi kesalahan', 'error');
                }
            });
        }
    });
</script>
</body>
</html>