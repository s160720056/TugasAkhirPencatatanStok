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

    <style>
        :root {
            --primary: #166534;
            --secondary: #854d0e;
            --light: #f8fafc;
        }
    </style>


    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/loader.js') }}"></script>

    <link href="{{ asset('assets/mdb/css/mdb.min.css') }}" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
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

    <div  style="width: 100%;">
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


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.2.0/dist/signature_pad.umd.min.js"></script>
    <script src="{{ asset('assets/mdb/js/mdb.umd.min.js') }}"></script>

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
