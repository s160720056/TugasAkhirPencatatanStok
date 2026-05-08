<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title id="title_page">
        {{-- SV MOTOR -

        @php
        if (isset($menu)) {
        echo $menu;
        } else {
        echo 'Dashboard';
        }



        @endphp --}}
    </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />
    <link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/loader.js') }}"></script>

    <link href="{{ asset('assets/mdb/css/mdb.min.css') }}" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css"> --}}
    <script src="{{ asset('assets/apexchart/apex.min.js') }}"></script>
    <link href="{{ asset('assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/fontAwesome/css/all.css') }}" rel="stylesheet" type="text/css">


    <link href="{{ asset('assets/select2/select2.min.css') }}" rel="stylesheet" />

    {{-- select2 --}}





    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/sweetalerts/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="plugins/tempus-dominus/tempus-dominus.min.js">
    <link rel="stylesheet" type="text/css" href="plugins/tempus-dominus/tempus-dominus.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">






    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->




    <script src="{{ asset('assets/js/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/webcam/webcam.min.js') }}"></script>




</head>
<style>
    @font-face {
        font-family: 'Material Symbols Outlined';
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/materialsymbolsoutlined/v213/kJF1BvYX7BgnkSrUwT8OhrdQw4oELdPIeeII9v6oDMzByHX9rA6RzaxHMPdY43zj-jCxv3fzvRNU22ZXGJpEpjC_1v-p_4MrImHCIJIZrDCvHOej.woff2) format('woff2');
    }

    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined';
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        line-height: 1;
        letter-spacing: normal;
        text-transform: none;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        -webkit-font-feature-settings: 'liga';
        -webkit-font-smoothing: antialiased;
    }

    .icon {
        transform: scale(0.8);
        /* Adjust the scale factor as needed */
        display: inline-block;
        /* Ensure the scaling is applied correctly */
    }

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
</style>
<style>
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
</style>


<script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('assets/axios/axios.min.js') }}">
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute(
        'content');
</script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="assets/js/scrollspyNav.js"></script>
<script src="plugins/sweetalerts/sweetalert2.all.js"></script>

{{--
<script src="plugins/sweetalerts/sweetalert2.min.js"></script> --}}
<script src="plugins/sweetalerts/custom-sweetalert.js"></script>

@php

    $username = session()->get('username');
    $hak_akses = session()->get('hak_akses');
    $namaHakAkses = session()->get('nama_hak_akses');

    //timezone jakarta
    date_default_timezone_set('Asia/Jakarta');

@endphp

<body class="sidebar-noneoverflow">

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
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-nav theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">

                    <a href="{{ route('home.index') }}">
                        <img src="assets/img/90x90.jpg" class="navbar-logo" alt="logo" id="navbar-logo">
                    </a>



                </li>

                <li class="nav-item toggle-sidebar">
                    <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg
                            xmlns="http://www.w3.org/2000/svg" widt h="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-list">
                            <line x1="8" y1="6" x2="21" y2="6"></line>
                            <line x1="8" y1="12" x2="21" y2="12"></line>
                            <line x1="8" y1="18" x2="21" y2="18"></line>
                            <line x1="3" y1="6" x2="3" y2="6"></line>
                            <line x1="3" y1="12" x2="3" y2="12"></line>
                            <line x1="3" y1="18" x2="3" y2="18"></line>
                        </svg></a>
                </li>

            </ul>

            <ul class="navbar-item flex-row navbar-dropdown ">
                <li class="nav-item dropdown apps-dropdown more-dropdown md-hidden d-none">
                    <div class="dropdown  custom-dropdown-icon">
                        <a class="dropdown-toggle btn" href="#" role="button" id="appSection"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-crosshair">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="22" y1="12" x2="18" y2="12"></line>
                                <line x1="6" y1="12" x2="2" y2="12"></line>
                                <line x1="12" y1="6" x2="12" y2="2"></line>
                                <line x1="12" y1="22" x2="12" y2="18"></line>
                            </svg><span>Apps</span> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg></a>

                        <div class="dropdown-menu dropdown-menu-right animated fadeInUp" aria-labelledby="appSection">
                            <a class="dropdown-item" data-value="Chat" href="apps_chat.html"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-message-square">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg> Chat</a>
                            <a class="dropdown-item" data-value="Mailbox" href="apps_mailbox.html"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg> Mailbox</a>
                            <a class="dropdown-item" data-value="Todo" href="apps_todoList.html"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg> Todo List</a>
                            <a class="dropdown-item" data-value="Notes" href="apps_notes.html"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg> Notes</a>
                            <a class="dropdown-item" data-value="Scrumboard" href="apps_scrumboard.html"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="12" y1="18" x2="12" y2="12"></line>
                                    <line x1="9" y1="15" x2="15" y2="15"></line>
                                </svg> Scrumboard</a>
                            <a class="dropdown-item" data-value="Contacts" href="apps_contacts.html"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg> Contacts</a>
                            <a class="dropdown-item" data-value="Invoice" href="apps_invoice.html"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-dollar-sign">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg> Invoice List</a>
                            <a class="dropdown-item" data-value="Calendar" href="apps_calendar.html"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2">
                                    </rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg> Calendar</a>
                        </div>
                    </div>
                </li>
            </ul>

            <ul class="navbar-item flex-row search-ul">
                <li class="nav-item align-self-center search-animated d-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-search toggle-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <form class="form-inline search-full form-inline search" role="search">
                        <div class="search-bar">
                            <input type="text" class="form-control search-form-control  ml-lg-auto"
                                placeholder="Search...">
                        </div>
                    </form>
                </li>
            </ul>
            <ul class="navbar-item flex-row navbar-dropdown">
                <li class="nav-item dropdown language-dropdown more-dropdown d-none">
                    <div class="dropdown  custom-dropdown-icon">
                        <a class="dropdown-toggle btn" href="#" role="button" id="langDropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                src="assets/img/ca.png" class="flag-width" alt="flag"><span>English</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg></a>

                        <div class="dropdown-menu dropdown-menu-right animated fadeInUp"
                            aria-labelledby="langDropdown">
                            <a class="dropdown-item" data-img-value="de" data-value="German"
                                href="javascript:void(0);"><img src="assets/img/de.png" class="flag-width"
                                    alt="flag">
                                German</a>
                            <a class="dropdown-item" data-img-value="jp" data-value="Japanese"
                                href="javascript:void(0);"><img src="assets/img/jp.png" class="flag-width"
                                    alt="flag">
                                Japanese</a>
                            <a class="dropdown-item" data-img-value="fr" data-value="French"
                                href="javascript:void(0);"><img src="assets/img/fr.png" class="flag-width"
                                    alt="flag">
                                French</a>
                            <a class="dropdown-item" data-img-value="ca" data-value="English"
                                href="javascript:void(0);"><img src="assets/img/ca.png" class="flag-width"
                                    alt="flag">
                                English</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown message-dropdown d-none">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="messageDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-message-circle">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg><span class="badge badge-primary"></span>
                    </a>
                    <div class="dropdown-menu p-0 position-absolute animated fadeInUp"
                        aria-labelledby="messageDropdown">
                        <div class="">
                            <a class="dropdown-item">
                                <div class="">

                                    <div class="media">
                                        <div class="user-img">
                                            <div class="avatar avatar-xl">
                                                <span class="avatar-title rounded-circle">KY</span>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="">
                                                <h5 class="usr-name">Kara Young</h5>
                                                <p class="msg-title">ACCOUNT UPDATE</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="">
                                    <div class="media">
                                        <div class="user-img">
                                            <div class="avatar avatar-xl">
                                                <span class="avatar-title rounded-circle">DA</span>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="">
                                                <h5 class="usr-name">Daisy Anderson</h5>
                                                <p class="msg-title">ACCOUNT UPDATE</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="">

                                    <div class="media">
                                        <div class="user-img">
                                            <div class="avatar avatar-xl">
                                                <span class="avatar-title rounded-circle">OG</span>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="">
                                                <h5 class="usr-name">Oscar Garner</h5>
                                                <p class="msg-title">ACCOUNT UPDATE</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown notification-dropdown d-none">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-bell">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg><span class="badge badge-success"></span>
                    </a>
                    <div class="dropdown-menu position-absolute animated fadeInUp"
                        aria-labelledby="notificationDropdown">
                        <div class="notification-scroll">

                            <div class="dropdown-item">
                                <div class="media server-log">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-server">
                                        <rect x="2" y="2" width="20" height="8" rx="2"
                                            ry="2"></rect>
                                        <rect x="2" y="14" width="20" height="8" rx="2"
                                            ry="2"></rect>
                                        <line x1="6" y1="6" x2="6" y2="6">
                                        </line>
                                        <line x1="6" y1="18" x2="6" y2="18">
                                        </line>
                                    </svg>
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">Server Rebooted</h6>
                                            <p class="">45 min ago</p>
                                        </div>

                                        <div class="icon-status">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-x">
                                                <line x1="18" y1="6" x2="6" y2="18">
                                                </line>
                                                <line x1="6" y1="6" x2="18" y2="18">
                                                </line>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-item">
                                <div class="media ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                        <path
                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                        </path>
                                    </svg>
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">Licence Expiring Soon</h6>
                                            <p class="">8 hrs ago</p>
                                        </div>

                                        <div class="icon-status">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-x">
                                                <line x1="18" y1="6" x2="6" y2="18">
                                                </line>
                                                <line x1="6" y1="6" x2="18" y2="18">
                                                </line>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-item">
                                <div class="media file-upload">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-file-text">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13">
                                        </line>
                                        <line x1="16" y1="17" x2="8" y2="17">
                                        </line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">Kelly Portfolio.pdf</h6>
                                            <p class="">670 kb</p>
                                        </div>

                                        <div class="icon-status">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-check">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-settings">
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
                                        echo $username;
                                    @endphp
                                    </h5>
                                    <p>Superadmin</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item d-none">
                            <a href="user_profile.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg> <span>My Profile</span>
                            </a>
                        </div>
                        <div class="dropdown-item d-none">
                            <a href="apps_mailbox.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox">
                                    <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                    <path
                                        d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                                    </path>
                                </svg> <span>My Inbox</span>
                            </a>
                        </div>
                        <div class="dropdown-item d-none">
                            <a href="auth_lockscreen.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
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

                    </div>
                </li>
            </ul>

        </header>
    </div>

    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->

        <div class="sidebar-wrapper sidebar-theme">

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

                <ul class="list-unstyled menu-categories" id="accordionExample">


                    {{-- <li class="menu active">

                        <a href="{{ route('absenQr.index') }}" id="absenButton" class="btn btn-primary btn-block"
                            style="background-color: #3b3f5c; color: white; margin-top: 10px; margin-bottom: 10px; display:block;">
                            Dapatkan Kode Absen
                        </a>


                    </li> --}}
                    @php
                        $isActive = !isset($menu);
                        $color = $isActive ? 'white' : '#3b3f5c';
                        $backgroundColor = $isActive ? '#304aca' : 'white';
                    @endphp
                    <li class="menu {{ $isActive ? 'active' : '' }}">
                        <a href="{{ route('admin.index') }}"
                            style="background: {{ $backgroundColor }}; color: {{ $color }};"
                            aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <span class="material-symbols-outlined" style="font-size: 24px; color: #b1b3c3;">
                                    home
                                </span>
                                <span style="margin-left:25px;font-weight:600; color:{{ $color }}">Home</span>
                            </div>
                        </a>
                    </li>

                    @php
                        $isActive = isset($menu) && $menu == 'pengajuanToko';
                        $color = $isActive ? 'white' : '#3b3f5c';
                        $backgroundColor = $isActive ? '#304aca' : 'white';
                    @endphp
                    <li class="menu {{ $isActive ? 'active' : '' }}">
                        <a href="{{ route('pengajuanToko.index') }}"
                            style="background: {{ $backgroundColor }}; color: {{ $color }};"
                            aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <span class="material-symbols-outlined" style="font-size: 24px; color: #b1b3c3;">
                                    real_estate_agent
                                </span>

                                <span style="margin-left:25px;font-weight:600; color:{{ $color }}">Pengajuan
                                    Toko</span>
                            </div>
                        </a>
                    </li>



                    {{-- @php
                        $isActive = isset($menu) && $menu == 'userAdmin';
                        $color = $isActive ? 'white' : '#3b3f5c';
                        $backgroundColor = $isActive ? '#304aca' : 'white';
                    @endphp
                    <li class="menu {{ $isActive ? 'active' : '' }}">
                        <a href="{{ route('userAdmin.index') }}"
                            style="background: {{ $backgroundColor }}; color: {{ $color }};"
                            aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <span class="material-symbols-outlined" style="font-size: 24px; color: #b1b3c3;">
                                    real_estate_agent
                                </span>

                                <span style="margin-left:25px;font-weight:600; color:{{ $color }}">User Admin</span>
                            </div>
                        </a>
                    </li> --}}









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


        </div>

        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->

        <div id="content" class="main-content" style="">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing" id="isiContent">

                    @yield('content')
                </div>

            </div>

        </div>

        <!--  END CONTENT AREA  -->


    </div>
    <!-- END MAIN CONTAINER -->
    <div id="lock-screen" class="lock-screen">
        <div class="lock-content">
            <i class="fas fa-lock fa-4x lock-icon"></i>
            <h2 style="color:white">Screen Locked</h2>
            <form id="unlock-form">
                <label for="password">Enter Password:</label>
                <input type="password" id="password" name="password" required value="aaaaaaaa">
                <button type="submit">Unlock</button>
            </form>
        </div>
    </div>

    {{-- create a hidden button logout --}}
    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
        @csrf
        <button type="submit" style="display: none" id="tombolLogout"></button>
    </form>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/input-mask.js') }}"></script>
    {{-- <script src="{{ asset('plugins/apex/apexcharts.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/dashboard/dash_1.js') }}"></script>
    <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.2/js/dataTables.searchPanes.js"></script>
    <script src="{{ asset('assets/js/qrCodeScanner/qrcodescan.min.js') }}"></script>
    <script src="{{ asset('assets/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/mdb/js/mdb.umd.min.js') }}"></script>



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

        //axios post cek hak akses

        // Send POST request using Axios
        //make main-content display none









        // {{-- Swal.fire({
        //     title: "Success!",
        //     text: "Data Berhasil Diubah",
        //     icon: "success",//imageUrl: "/random_image.php",
        //     imageWidth: 400,
        //     imageHeight: 200,
        //     imageAlt: "Custom image"
        // }).then(() => {
        //     location.reload();
        // }); --}}

        //every buttonn that showing swall show this

        // $('.swalDefaultSuccess').click(function() {
        //     Swal.fire({
        //         title: "Success!",
        //         text: "Data Berhasil Diubah",
        //      icon: "success",//imageUrl: "/random_image.php",
        //     imageWidth: 400,
        //     imageHeight: 200,
        //     imageAlt: "Custom image"
        // }).then(() => {
        //     location.reload();
        // });
    </script>








    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let timeout;
            // const lockDuration = 30000; // 3 seconds
            const lockDuration = 300000000;

            const lockScreen = () => {
                const lockElement = document.getElementById('lock-screen');
                lockElement.style.display = 'flex';
                lockElement.classList.add('locked');
                //add session locked
                // window.location.href = "/logout";


            };

            const unlockScreen = () => {
                const lockElement = document.getElementById('lock-screen');
                lockElement.style.display = 'none';
                lockElement.classList.remove('locked');
                resetTimer();
            };

            const resetTimer = () => {
                clearTimeout(timeout);
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
                        unlockScreen();
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
