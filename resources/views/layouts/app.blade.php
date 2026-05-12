<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1...">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>...</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- CSS (Urut dari umum ke spesifik) -->
    <link href="{{ asset('bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/mdb/css/mdb.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/dashboard/dash_1.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/select2/select2.min.css') }}" rel="stylesheet">

    <!-- Datatable & Plugin CSS -->
    <link rel="stylesheet" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" href="plugins/table/datatable/dt-global_style.css">
    <link rel="stylesheet" href="plugins/sweetalerts/sweetalert2.css">
    <link rel="stylesheet" href="plugins/tempus-dominus/tempus-dominus.min.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    {{-- <script src="{{ asset('assets/js/loader.js') }}"></script> --}}
    <!-- Loader CSS (jika critical) -->
    {{-- <link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet"> --}}
</head>
<style>
    .select2-container--default .select2-selection--single {
        height: 38px;
        line-height: 36px;
    }

    .select2-container--default .select2-results__options {
        max-height: 200px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
    }

    .lock-screen {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        align-items: center;
        justify-content: center;
        text-align: center;
        z-index: 9999;
    }

    .lock-content {
        background: #333;
        padding: 20px;
        border-radius: 10px;
    }

    .lock-screen.locked {
        display: flex;
    }

    .bigBlackClawk {
        font-size: 1.5em;
        color: black;
    }
</style>


<script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('assets/axios/axios.min.js') }}">
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute(
        'content');
</script>
<script src="{{ asset('js/axios.js') }}"></script>
{{-- <script src="{{ asset('bootstrap5/js/bootstrap.bundle.min.js') }}"></script> --}}
<script src="assets/js/scrollspyNav.js"></script>
<script src="plugins/sweetalerts/sweetalert2.all.js"></script>


@php

    $username = session()->get('username');
    $hak_akses = session()->get('hak_akses');
    $namaHakAkses = session()->get('nama_hak_akses');

    //timezone jakarta
    date_default_timezone_set('Asia/Jakarta');

@endphp
<style>
    :root {
        --primary: #166534;
        --secondary: #854d0e;
        --light: #f8fafc;
    }

    body {
        font-family: "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        color: #333
    }

    .btn-primary {
        background: var(--primary);
        border: none;
        background-color: var(--primary)
    }

    .btn-primary:hover {
        background: #b71c1c
    }

    .text-primary {
        color: var(--primary) !important
    }

    .navbar-brand {
        font-weight: 600;
        font-size: 1.25rem
    }

    .navbar-nav .nav-link {
        font-weight: 500;
        margin-left: 1rem;
        transition: .3s
    }

    .navbar-nav .nav-link:hover {
        color: var(--primary) !important
    }

    #content {
        min-height: 90vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, var(--light) 0%, #fff 100%)
    }

    .stat-card {
        border: 1px solid #eee;
        border-radius: 12px;
        padding: 2rem 1rem;
        transition: .3s
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, .05)
    }

    footer ul {
        list-style: none;
        padding-left: 0
    }

    footer ul li {
        margin-bottom: .5rem
    }

    footer a {
        text-decoration: none;
        color: #adb5bd
    }

    footer a:hover {
        color: #fff
    }

    .slick-slide img {
        border-radius: 8px
    }

    .nav-link.active {
        color: var(--primary) !important
    }

    .nav-item .nav-link {
        color: var(--primary) !important
    }
</style>

<body class="sidebar-noneoverflow">
    <input type="hidden" id="menuNavBar" value="{{ $menu ?? '' }}">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->

    <div class="header-container fixed-top">

        <header class="header navbar navbar-expand-sm navbar-light bg-white shadow-sm sticky-top">
            <ul class="navbar-nav theme-brand flex-row  text-center"
                style="border-right: 1px solid #000000ff;;background-image:linear-gradient(135deg,var(--light) 0%, #fff 100%);">
                <li class="nav-item theme-logo">
                    @if (isset($menu) && $menu != 'register')
                        <a href="{{ route('home.index') }}">
                            <img src="assets/img/90x90.jpg" class="navbar-logo" alt="logo" id="navbar-logo">
                        </a>
                    @else
                    @endif
                </li>
                <li class="nav-item theme-text">
                    @if (isset($menu) && $menu != 'register')
                        <a href="{{ route('home.index') }}" class="nav-link"></a>
                    @else
                        <a href="{{ route('home.index') }}" class="nav-link">Kembali</a>
                    @endif
                </li>
                <li class="nav-item toggle-sidebar">
                    <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg
                            xmlns="http://www.w3.org/2000/svg" widt h="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-list">
                            <line x1="8" y1="6" x2="21" y2="6" stroke="#000"></line>
                            <line x1="8" y1="12" x2="21" y2="12" stroke="#000"></line>
                            <line x1="8" y1="18" x2="21" y2="18" stroke="#000">
                            </line>
                            <line x1="3" y1="6" x2="3" y2="6" stroke="#000">
                            </line>
                            <line x1="3" y1="12" x2="3" y2="12" stroke="#000">
                            </line>
                            <line x1="3" y1="18" x2="3" y2="18" stroke="#000">
                            </line>
                        </svg></a>
                </li>

            </ul>
            <!-- Company Name in Center -->
            <div class="mx-auto">
                <h4 class="mb-0 font-weight-bold text-primary text-center" style="font-size: 15px;" id="judul_app">
                </h4>
            </div>
            @if (isset($menu) && $menu != 'register')
                <ul class="navbar-item flex-row navbar-dropdown">

                    <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path
                                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                </path>
                            </svg>
                        </a>
                        <div class="dropdown-menu position-absolute animated fadeInUp"
                            aria-labelledby="userProfileDropdown">
                            <div class="user-profile-section">
                                <div class="media mx-auto">
                                    <img src="assets/img/90x90.jpg" class="img-fluid mr-2" alt="avatar">
                                    <div class="media-body">
                                        <h5>Hello @php
                                            echo explode(' ', trim($username))[0];
                                        @endphp
                                        </h5>
                                        <p> @php
                                            echo $namaHakAkses;

                                        @endphp</p>
                                    </div>
                                </div>
                            </div>
                            {{-- home  --}}
                            <div class="dropdown-item">
                                <a href="{{ route('home.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <polyline points="3 9 12 2 21 9"></polyline>
                                        <path d="M9 21v-8a3 3 0 0 1 6 0v8">
                                        </path>
                                    </svg> <span>Home</span>
                                </a>
                            </div>
                            <div class="dropdown-item">
                                <a href="{{ route('PengaturanToko') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-settings">
                                        <circle cx="12" cy="12" r="3"></circle>
                                        <path
                                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                        </path>
                                    </svg>
                                    <span>Settings</span>
                                </a>
                            </div>
                            <div class="dropdown-item">
                                <a onclick="lockScreen()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2"
                                            ry="2">
                                        </rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg> <span>Lock Screen</span>
                                </a>
                            </div>

                            <div class="dropdown-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        style="background: none; border: none; padding: 0; cursor: pointer;">
                                        <a>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-log-out">
                                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                <polyline points="16 17 21 12 16 7"></polyline>
                                                <line x1="21" y1="12" x2="9" y2="12">
                                                </line>
                                            </svg>
                                            <span>Log Out</span>
                                        </a>
                                    </button>
                                </form>
                            </div>
                            @if (session('id_toko') && session('id_toko') != '')
                                <div class="dropdown-item">
                                    <form action="{{ route('toko.disconnect') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            style="background: none; border: none; padding: 0; cursor: pointer;">
                                            <a>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-log-out">
                                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                    <polyline points="16 17 21 12 16 7"></polyline>
                                                    <line x1="21" y1="12" x2="9"
                                                        y2="12">
                                                    </line>
                                                </svg>
                                                <span>Keluar Toko</span>
                                            </a>
                                        </button>
                                    </form>
                                </div>
                            @endif

                    </li>
                </ul>
            @endif
        </header>
    </div>

    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->

        <div class="sidebar-wrapper sidebar-theme bg-white">
            @if (isset($menu) && $menu != 'register')
                <nav id="sidebar">
                    <div class="profile-info">
                        <figure class="user-cover-image"></figure>
                        <div class="user-info">
                            <img src="assets/img/90x90.jpg" alt="avatar" id="navbar-avatar">

                            <h6 class="">@php
                                if (isset($username)) {
                                    echo 'Welcome,';
                                    echo $username;
                                }
                            @endphp</h6>
                            <p class="">
                                @php
                                    echo $namaHakAkses;

                                @endphp
                            </p>
                        </div>
                    </div>
                    <div class="shadow-bottom"></div>

                    <ul class="list-unstyled menu-categories" id="accordionExample" style="display: none">


                        {{-- <li class="menu active">

                            <a href="{{ route('absenQr.index') }}" id="absenButton"
                                class="btn btn-primary btn-block"
                                style="background-color: #3b3f5c; color: white; margin-top: 10px; margin-bottom: 10px; display:block;">
                                Dapatkan Kode Absen
                            </a>


                        </li> --}}

                        <li class="menu active">
                            <a href="{{ route('home.index') }}" style="background-color: white" aria-expanded="true"
                                class="dropdown-toggle">
                                <div class="">
                                    <span class="material-symbols-outlined" style="font-size: 24px; color: #b1b3c3;">
                                        home
                                    </span>
                                    <span style="margin-left:25px;color: #3b3f5c;font-weight:600">Home</span>
                                </div>

                            </a>

                        </li>
                        {{-- <li class="menu active">
                        <a href="{{ route('absen.index') }}" id="absen" style="background-color: white"
                            aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <!-- <svg width="20px" height="20px" viewBox="0 0 20 20">
                                    <path d="M3,1 L17,1 L17,1 C18.1045695,1 19,1.8954305 19,3 L19,17 L19,17 C19,18.1045695 18.1045695,19 17,19 L3,19 L3,19 C1.8954305,19 1,18.1045695 1,17 L1,3 L1,3 C1,1.8954305 1.8954305,1 3,1 Z"></path>
                                    <polyline points="4 11 8 15 16 6"></polyline>
                                    </svg> -->
                                <span class="material-symbols-outlined" style="font-size: 24px; color: #b1b3c3;">
                                    punch_clock
                                </span>
                                <span style="margin-left:25px;color: #3b3f5c;font-weight:600">Absen</span>
                            </div>
                        </a>
                    </li> --}}
                        {{-- <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            <span>Data Master</span>
                        </div>
                    </li>
                    @if (isset($menu) && $menu == 'barang')
                        <li class="menu active">
                    @else
                        <li class="menu">
                    @endif
                        <a href="{{ route('barang.index') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-box">
                                    <path
                                        d="M21 16V8a2 2 0 0 0-1-1.73L13 2.26a2 2 0 0 0-2 0L4 6.27A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4.01a2 2 0 0 0 2 0l7-4.01A2 2 0 0 0 21 16z">
                                    </path>
                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                </svg>
                                <span>Barang</span>
                            </div>
                        </a>
                    </li> --}}
                        {{-- @if (isset($menu) && $menu == 'kategori')
                        <li class="menu active">
                    @else
                        <li class="menu">
                    @endif
                        <a href="{{ route('kategori.index') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-layers">
                                    <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                    <polyline points="2 17 12 22 22 17"></polyline>
                                    <polyline points="2 12 12 17 22 12"></polyline>
                                </svg>
                                <span>Kategori</span>
                            </div>
                        </a>
                    </li>
                    @if (isset($menu) && $menu == 'satuan')
                        <li class="menu active">
                    @else
                        <li class="menu">
                    @endif
                        <a href="{{ route('satuan.index') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-box">
                                    <path d="M21 16V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10l9 4 9-4z"></path>
                                    <path d="M3 6l9 4 9-4"></path>
                                    <path d="M12 22v-4"></path>
                                </svg>

                                <span>Satuan</span>
                            </div>
                        </a>
                    </li>
                    @if (isset($menu) && $menu == 'customer')
                        <li class="menu active">
                    @else
                        <li class="menu">
                    @endif
                        <a href="{{ route('customer.index') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>

                                <span>Customer</span>
                            </div>
                        </a>
                    </li> --}}


                    </ul>

                </nav>
            @endif

        </div>

        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->

        <div id="content" class="main-content" style="display: none">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing" id="isiContent">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $('#addKunjunganNOOModal').modal('show');
                            });
                        </script>
                    @endif

                    @if (config('app.warning_message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Perhatian!</strong> Aplikasi ini sedang dalam tahap uji coba. Jika Anda menemui
                            masalah, silakan hubungi admin dengan menyertakan screenshot.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                            </button>
                        </div>
                    @endif


                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                            </button>
                        </div>
                    @elseif(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                            </button>
                        </div>
                    @endif


                    @yield('content')
                </div>

            </div>

        </div>

        <!--  END CONTENT AREA  -->


    </div>
    <!-- END MAIN CONTAINER -->
    <div id="lock-screen" class="lock-screen">
        <div class="lock-content">
            <span class="material-symbols-outlined" id="iconLock">
                lock
            </span>

            <h2 style="color:white">Screen Locked</h2>
            <form id="unlock-form">
                <label for="password" style="color:white">Enter Password:</label>
                <input type="password" id="password" name="password" required value="">
                <button type="submit">Unlock</button>
                <button type="button" onclick="logOut()">Logout</button>
            </form>
        </div>
    </div>

    {{-- create a hidden button logout --}}
    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
        @csrf
        <button type="submit" style="display: none" id="tombolLogout"></button>
    </form>

    <!-- ==================== SCRIPTS ==================== -->

    <!-- 1. jQuery (Hanya Sekali) -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>

    <!-- 2. Core Libraries -->
    <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/mdb/js/mdb.umd.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>


    <!-- 3. Axios (PENTING!) -->
    <script src="{{ asset('assets/axios/axios.min.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script> {{-- wrapper axiosPost, axiosGet dll --}}

    <!-- 4. Utility & Plugins -->
    <script src="{{ asset('assets/js/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/webcam/webcam.min.js') }}"></script>
    <script src="{{ asset('assets/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/apexchart/apex.min.js') }}"></script>
    <script src="plugins/sweetalerts/sweetalert2.all.js"></script>
    <script src="plugins/sweetalerts/custom-sweetalert.js"></script> {{-- tambahkan ini --}}
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.2/js/dataTables.searchPanes.js"></script>

    <!-- 5. Custom & Page Specific -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/dash_1.js') }}"></script>
    <script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/qrCodeScanner/qrcodescan.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.2.0/dist/signature_pad.umd.min.js"></script>
    <script>
        $.extend(true, $.fn.dataTable.defaults, {
            processing: true,
            serverSide: true,
            responsive: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            autoWidth: false,

            ajax: function(data, callback, settings) {
                setTimeout(function() {
                    $.ajax({
                        url: settings.ajax.url || settings.ajax,
                        type: settings.ajax.type || 'GET',
                        data: data,
                        success: function(json) {
                            callback(json);
                        },
                        error: function(xhr) {
                            console.error('DataTables AJAX error', xhr);
                        }
                    });
                }, 1000); // ⏱️ 1 detik delay
            },

            language: {
                searchPlaceholder: "Search...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ data",
                paginate: {
                    previous: "Prev",
                    next: "Next"
                }
            },

            drawCallback: function() {
                $('.dataTables_paginate .pagination')
                    .addClass('pagination-sm');
            }
        });
    </script>



    <script>
        $('.select2multi').select2();
        $('.select2').select2();

        $('#default-ordering').DataTable({
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "order": [
                [0, "asc"]
            ],
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7,
            drawCallback: function() {
                $('.dataTables_paginate > .pagination').addClass(
                    ' pagination-style-13 pagination-bordered mb-5');
            }
        });








        //trigger



        //axios post cek hak akses
        var menu = $('#menuNavBar').val();
        // Send POST request using Axios
        //make main-content display none
        if (menu != 'register') {

            document.getElementById('content').style.display = 'none';

            axiosPost('/cekHakAkses', {
                    menu: menu ?? 'home'
                })
                .then(function(response) {

                    if (response.data.status == "error") {
                        document.getElementById('content').style.display = 'none';

                        // Swal.fire({
                        //     title: "Error!",
                        //     text: response.data.message,
                        //     icon: "error",
                        //     confirmButtonColor: '#3085d6',
                        //     confirmButtonText: 'OK'
                        // }).then(() => {
                        //     document.body.style.display = 'none';

                        //     window.location.href = response.data.firstMenuUrl;
                        // });
                        document.body.style.display = 'none';

                        window.location.href = response.data.firstMenuUrl;
                    } else if (response.data.status == "success") {

                        var status_pengajuan_toko = response.data.toko;
                        if (status_pengajuan_toko == 'proses') {
                            Swal.fire({
                                title: "Info!",
                                text: "Toko Anda Sedang dalam proses verifikasi, mohon menunggu",
                                icon: "info",
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                //press button tombolLogout
                                document.getElementById('tombolLogout').click();
                            });
                        } else if (status_pengajuan_toko == 'diterima') {
                            // alert('you');
                        } else if (status_pengajuan_toko == 'ditolak') {
                            Swal.fire({
                                title: "Info!",
                                text: "Toko Anda Ditolak, Silahkan Hubungi Admin",
                                icon: "info",
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                //press button tombolLogout
                                document.getElementById('tombolLogout').click();
                            });
                        }
                        var isi = response.data.data ?? "";
                        var listmenu = response.data.topMenuData;
                        $('#accordionExample').html(isi);
                        $('#topBarMenuList').html(listmenu);
                        document.getElementById('accordionExample').style.display = 'block';

                        document.getElementById('content').style.display = 'block';
                        document.body.style.display = 'block';



                        //scroll to class="menu active"
                        var elmnt = document.getElementsByClassName("menu active")[0];
                        elmnt.scrollIntoView();


                    } else if (response.data.status == "chooseToko") {
                        document.getElementById('content').style.display = 'block';
                        document.body.style.display = 'block';
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        } else {
            document.getElementById('content').style.display = 'block';
            document.body.style.display = 'block';
        }

        // document.addEventListener("DOMContentLoaded", function () {
        //     var width = window.innerWidth;
        //     var height = window.innerHeight;

        //     // Check if width is less than height
        //     if (width < height) {
        //         document.getElementById('absenButton').style.display = 'block';
        //     }
        // });


        $(document).ready(function() {
            axiosGet('/toko/getInfoToko')
                .then(function(response) {
                    console.log(response.data);
                    if (response.data.status === "error") {
                        alert('Access denied: ' + response.data.message);

                    } else {
                        var nama_toko = response.data.data.nama_toko;
                        var id_toko = response.data.data.id_toko;


                        var logo_toko = response.data.data.logo_toko;
                        if (logo_toko) {
                            $('#navbar-logo').attr('src', '/storage/' + logo_toko);
                            $('#navbar-avatar').attr('src', '/storage/' + logo_toko);
                            console.log(logo_toko);
                        }



                        $('#judul_app').text(nama_toko);
                        var newTitle = nama_toko + ' - ' + @php echo json_encode(isset($menu) ? $menu : 'Dashboard'); @endphp;
                        console.log('New Title:', newTitle);
                        document.title = newTitle;
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });

        });


        //call toggle-sidebar class on load
        $(document).ready(function() {
            // $('.sidebarCollapse').click();
        });
    </script>

    <script>
        let check = 0;

        //prevent refresh page
        window.onbeforeunload = function() {
            //if lock screen is active do log out
            if (document.getElementById('lock-screen').classList.contains('locked')) {
                document.getElementById('logoutForm').submit();
                alert('Anda telah keluar dari sistem');
                return false;
            }
        };





        function onScanSuccess(decodedText, decodedResult) {
            if (check == 0) {
                axiosPost('/absenUser/', {
                        decodedText: decodedText
                    })
                    .then(function(response) {
                        console.log(response.data);

                        if (response.data.status == "error") {


                        } else {
                            check = 1;
                            // console.log(response.data.data);
                            Swal.fire({
                                title: "Success!",
                                text: response.data.message + " " + response.data.nama_user,
                                icon: "success",
                            }).then(() => {

                                //direct to home
                                // window.location.href = "/";

                            });
                            setTimeout(() => {
                                Swal.close();
                                check = 0;
                            }, 3000);
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 600,
                    height: 600
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>

    <script>
        function lockScreen() {
            const lockElement = document.getElementById('lock-screen');
            lockElement.style.display = 'flex';
            lockElement.classList.add('locked');
             document.getElementById('iconLock').textContent = 'lock';
            document.getElementById('content').style.display = 'none';
        }

        function logOut() {
            document.getElementById('tombolLogout').click();
        }
        document.addEventListener('DOMContentLoaded', () => {
            let timeout;
            // const lockDuration = 30000; // 3 seconds
            const lockDuration = 300 * 1000; // 300 seconds

            const lockScreen = () => {
                const lockElement = document.getElementById('lock-screen');
                lockElement.style.display = 'flex';
                lockElement.classList.add('locked');
                document.getElementById('content').style.display = 'none';
                document.getElementById('iconLock').textContent = 'lock';
                $('#password').val(''); // Clear password field
                //add session locked
                // window.location.href = "/logout";


            };


            const unlockScreen = () => {
                const lockElement = document.getElementById('lock-screen');
                lockElement.style.display = 'none';
                lockElement.classList.remove('locked');
                document.getElementById('content').style.display = 'block';
                resetTimer();
            };


            const resetTimer = () => {
                clearTimeout(timeout);
                 document.getElementById('iconLock').textContent = 'lock';
                timeout = setTimeout(lockScreen, lockDuration);
            };

            const handleUnlockFormSubmit = async (event) => {
                event.preventDefault();
                const password = document.getElementById('password').value;

                try {
                    const response = await fetch('/unlock', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: JSON.stringify({
                            password
                        }),
                    });
                    const data = await response.json();

                    if (data.success) {
                        const iconLock = document.getElementById('iconLock');

                        // Ubah icon jadi unlock
                        iconLock.textContent = 'lock_open_right';

                        // Unlock screen


                        // Setelah 10 detik lock kembali
                        setTimeout(() => {

                            // jika ada fungsi lockScreen()
                            if (typeof lockScreen === 'function') {
                                  unlockScreen();
                            }
                        }, 1000); // 10000ms = 10 detik

                    } else {
                        alert('Invalid password');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            };

            //when windows is not active do lock
            // window.addEventListener('blur', lockScreen);
            // window.addEventListener('focus', unlockScreen);


            document.addEventListener('mousemove', resetTimer);
            document.addEventListener('keypress', resetTimer);
            document.addEventListener('click', resetTimer);

            resetTimer(); // Start the timer on page load

            const unlockForm = document.getElementById('unlock-form');
            if (unlockForm) {
                unlockForm.addEventListener('submit', handleUnlockFormSubmit);
            }
        });
        // document.addEventListener('visibilitychange', () => {
        //     if (document.hidden) {
        //         lockScreen();
        //     }
        // });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/disable-devtool@latest"></script>
    <script>
        // alert(DisableDevtool.md5("0000wkid"));
        DisableDevtool({
            // =============================================
            // 1. REDIRECT OTOMATIS KE HOME ()
            // =============================================
            url: "/", // Fallback redirect (kalau gagal close window)
            md5: "11d07354dcea875c9f08598e77a2e666",
            // =============================================
            // 2. CALLBACK SAAT DEVTOOLS TERBUKA
            // =============================================
            ondevtoolopen: function(type, next) {
                console.log("%c🚨 DevTools TERDETEKSI! Tipe: " + type, "color:red;font-size:16px");

                // === KODE YANG KAMU INGINKAN ===
                document.body.innerHTML = "";
                document.body.style.backgroundColor = "black";
                document.body.style.color = "white";
                document.body.style.fontSize = "50px";
                document.body.style.textAlign = "center";
                document.body.style.display = "flex";
                document.body.style.alignItems = "center";
                document.body.style.justifyContent = "center";
                document.body.style.height = "100vh";
                document.body.style.margin = "0";
                document.body.innerText = "Please close the DevTools and refresh the page.";



                // Opsional: redirect ke home setelah beberapa detik
                // setTimeout(() => { window.location.href = "/"; }, 5000);
            },

            // =============================================
            // 3. Callback saat DevTools ditutup (opsional)
            // =============================================
            ondevtoolclose: function() {
                console.log("✅ DevTools ditutup");
            },

            // =============================================
            // 4. SEMUA PROTEKSION LAINNYA (full utilization)
            // =============================================
            tkName: "dev", // Nama parameter bypass (default: ddtk)
            interval: 500, // Deteksi tiap 250ms (lebih cepat = lebih agresif)
            clearLog: true, // Otomatis bersihkan console
            disableMenu: true, // Matikan klik kanan
            disableSelect: true, // Matikan select teks
            disableInputSelect: true, // Matikan select di input/textarea
            disableCopy: true, // Matikan Ctrl+C / copy
            disableCut: true, // Matikan cut
            disablePaste: true, // Matikan paste
            disableIframeParents: true, // Kalau di iframe, matikan juga parent
            clearIntervalWhenDevOpenTrigger: true, // Berhenti deteksi setelah trigger (hemat CPU)

            // =============================================
            // 5. Opsional lanjutan
            // =============================================
            // detectors: [0,1,3,4,5,6,7],     // Pilih detector spesifik (default semua)
            // stopIntervalTime: 3000,         // Berhenti deteksi di mobile setelah X ms
            rewriteHTML: "<h1 style='color:red;text-align:center;margin-top:50vh'>Access Denied</h1>",
            // timeOutUrl: "/timeout-page",    // URL kalau deteksi timeout
            // ignore: ['/admin', /login/],    // Halaman yang dikecualikan
        });
        document.addEventListener('auxclick', function(e) {
            if (e.button === 1) {
                e.stopImmediatePropagation();
                return true;
            }
        }, true);

        document.addEventListener('mousedown', function(e) {
            if (e.button === 1) {
                e.stopImmediatePropagation();
                return true;
            }
        }, true);
    </script>



    <!-- prefent inpect element -->
    {{--
    <script>
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });

        // Prevent inspect element on the page
        document.addEventListener('keydown', function (e) {
            const blockedKeys = [
                { ctrl: true, shift: true, key: 'I' }, // Ctrl+Shift+I
                { ctrl: true, shift: true, key: 'C' }, // Ctrl+Shift+C
                { ctrl: true, shift: true, key: 'J' }, // Ctrl+Shift+J
                { ctrl: true, key: 'U' },              // Ctrl+U
                { key: 'F12' }                         // F12
            ];

            for (let combo of blockedKeys) {
                if (combo.key === e.key &&
                    (!combo.ctrl || e.ctrlKey) &&
                    (!combo.shift || e.shiftKey)) {
                    e.preventDefault();
                    location.reload();
                    return false;
                }
            }
        });
    </script> --}}

    {{--
    <script>

        const devtools = () => {
            const threshold = 100;
            const check = () => {
                const start = performance.now();
                console.log('Checking DevTools...');
                debugger;
                const end = performance.now();
                if (end - start > threshold) {
                    document.body.innerHTML = "";
                    document.body.style.backgroundColor = "black";
                    document.body.style.color = "white";
                    document.body.style.fontSize = "50px";
                    document.body.style.textAlign = "center";
                    document.body.innerText = "Please close the DevTools and refresh the page.";
                }
            };
            setInterval(check, 5000);
        };
        devtools();
    </script> --}}







</body>

</html>
