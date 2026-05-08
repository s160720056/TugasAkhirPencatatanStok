@extends('layouts.app')
@section('content')
    <link href="//static.webcamtests.com/theme/img/favicon.ico" rel="icon" type="image/x-icon">
    <!-- <link href="//static.webcamtests.com/theme/css/main.min.css?0.0.65" rel="stylesheet"> -->

    <link href="{{ asset('assets/webcam/theme/css/main.min.css') }}" rel="stylesheet" type="text/css">


</head>

<body>


    <section>
        <div data-include-widget="name=webcam_photo">
            <div class="box box-middle">
                <div>
                    <h1>Take photo online</h1>
                    <ul id="webcam-notices">
                        <li class="notice-loading loading_detectingDevices" style="display: none;">Mendeteksi perangkat
                            media Anda. Tunggu sebentar...</li>
                        <li class="notice-loading loading_waitingPermission" style="display: none;">Menunggu izin
                            Anda...</li>
                        <li class="notice-loading loading_startingWebcamera" style="display: none;">Mulai webcam Anda.
                            Tunggu sebentar...</li>
                        <li class="notice-loading loading_detectingMaxres" style="display: none;">Mendeteksi resolusi
                            maksimum yang didukung. Tunggu sebentar...</li>
                        <li class="notice-info info_readMore" style="display: none;">Untuk informasi lebih lanjut,
                            silakan kunjungi halaman berikut:</li>
                        <li class="notice-info info_switchCamera" style="display: none;">Mengubah kamera akan mengatur
                            ulang proses saat ini. Apakah Anda ingin melanjutkan?</li>
                        <li class="notice-fail fail_unexpectedError" style="display: none;">Terjadi kesalahan tak
                            terduga. Muat ulang halaman dan coba lagi.</li>
                        <li class="notice-fail fail_noWebcamNoDevices" style="display: none;">Tidak dapat menemukan
                            perangkat media apa pun. Sangat mungkin peramban Anda tidak mengizinkan akses ke perangkat
                            ini. Coba muat ulang halaman ini atau buka menggunakan browser lain. Ingatlah bahwa untuk
                            memulai webcam Anda, Anda harus mengizinkan situs web kami untuk menggunakannya.</li>
                        <li class="notice-fail fail_noWebcamSomeDevices" style="display: none;">Tidak dapat menemukan
                            kamera web, namun ada perangkat media lain (seperti speaker atau mikrofon). Kemungkinan
                            besar, ini berarti webcam Anda tidak berfungsi dengan baik atau browser Anda tidak dapat
                            mengaksesnya.</li>
                        <li class="notice-fail fail_browserNotSupported" style="display: none;">Browser Anda tidak
                            mendukung fitur untuk mengakses perangkat media. Harap tingkatkan peramban Anda atau instal
                            yang lain.</li>
                        <li class="notice-fail fail_promiseNotAllowed" style="display: none;">Anda tidak mengizinkan
                            peramban menggunakan kamera web. Muat ulang halaman dan coba lagi.</li>
                        <li class="notice-fail fail_promiseNotReadable" style="display: none;">Tampaknya, webcam Anda
                            sedang digunakan atau diblokir oleh aplikasi lain. Untuk memulai webcam Anda, Anda harus
                            menutup aplikasi itu untuk sementara.</li>
                        <li class="notice-fail fail_devidUnavailable" style="display: none;">Sepertinya browser Anda
                            memblokir akses ke pengidentifikasi webcam. Karena itu, mustahil untuk mendeteksi dan
                            mengelola semua webcam yang tersedia.</li>
                        <li class="notice-fail fail_permissionTimeout" style="display: none;">Waktu tunggu untuk izin
                            Anda telah kedaluwarsa. Muat ulang halaman dan coba lagi.</li>
                        <li class="notice-fail fail_cannotStreamVideo" style="display: none;">Tidak dapat melakukan
                            streaming video. Penyebabnya mungkin kamera rusak atau sedang digunakan oleh aplikasi lain.
                        </li>
                        <li class="notice-fail fail_videoPaused" style="display: none;">Trek video dijeda.</li>
                        <li class="notice-fail fail_noStream" style="display: none;">Tidak dapat mendeteksi aliran
                            konten media yang aktif.</li>
                        <li class="notice-fail fail_noTrack" style="display: none;">Webcam Anda tidak menghasilkan trek
                            video apa pun.</li>
                        <li class="notice-fail fail_cannotGetTracks" style="display: none;">Browser Anda tidak mendukung
                            fitur untuk mengakses trek video.</li>
                        <li class="notice-fail fail_trackMuted" style="display: none;">Trek video tidak tersedia karena
                            masalah teknis.</li>
                        <li class="notice-fail fail_trackEnded" style="display: none;">Webcam Anda tiba-tiba berhenti
                            mengirim trek video.</li>
                        <li class="notice-fail fail_trackDisabled" style="display: none;">Untuk alasan yang tidak
                            diketahui, trek video dinonaktifkan.</li>
                        <li class="notice-text text_enableDevid" style="display: none;">Klik di sini untuk memungkinkan
                            akses ke pengidentifikasi webcam</li>
                        <li class="notice-text text_forceQuery" style="display: none;">Klik di sini untuk mencoba
                            memulai kamera dengan paksa</li>
                    </ul>

                    <div id="webcam-controls" style="display: none;">
                        <select id="webcam-selecter">
                           
                        </select>
                        <button id="webcam-launcher">Mulai Camera!</button>
                    </div>

                    <video id="webcam-stream" autoplay="" src="" style="background: none; display: none;">Penampil
                        webcam</video><canvas width="640" height="480" style="width: 100%; display: block;"></canvas>
                    <div id="webcam-actions"><button data-action="takePhoto"
                            style="display: inline-block;">Memotret</button><button data-action="stopWebcam"
                            style="display: inline-block;">Hentikan webcam</button></div>
                    <div style="">
                        <div style="text-align:center"><button name="effects" style="margin: 0px 2px;">effects<sup
                                    style="font-weight:bold"></sup></button><button name="filters"
                                style="margin: 0px 2px;">filters<sup style="font-weight:bold"></sup></button><button
                                name="colors" style="margin: 0px 2px;">colors<sup
                                    style="font-weight:bold"></sup></button><button name="transform"
                                style="margin: 0px 2px;">transform<sup style="font-weight:bold"></sup></button></div>
                        <div class="filter-group filter-group-effects" style="float: left; width: 50%; display: block;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">brightness</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">100%</span><input type="range"
                                    min="1" max="200" step="1" name="brightness"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-effects" style="float: left; width: 50%; display: block;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">contrast</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">100%</span><input type="range"
                                    min="1" max="200" step="1" name="contrast"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-effects" style="float: left; width: 50%; display: block;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">blur</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">0.1px</span><input
                                    type="range" min="0.1" max="30" step="0.1" name="blur"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-effects" style="float: left; width: 50%; display: block;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">grayscale</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1%</span><input type="range"
                                    min="1" max="100" step="1" name="grayscale"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-effects" style="float: left; width: 50%; display: block;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">hue</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1°</span><input type="range"
                                    min="1" max="360" step="1" name="hue"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-effects" style="float: left; width: 50%; display: block;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">invert</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1%</span><input type="range"
                                    min="1" max="100" step="1" name="invert"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-effects" style="float: left; width: 50%; display: block;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">saturate</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">100%</span><input type="range"
                                    min="1" max="200" step="1" name="saturate"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-effects" style="float: left; width: 50%; display: block;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">sepia</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1%</span><input type="range"
                                    min="1" max="100" step="1" name="sepia"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-filters" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">mosaic</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1px</span><input type="range"
                                    min="1" max="30" step="1" name="mosaic"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-filters" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">ice</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1px</span><input type="range"
                                    min="1" max="100" step="1" name="ice"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-filters" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">erode</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">0.1px</span><input
                                    type="range" min="0.1" max="20" step="0.1" name="erode"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-filters" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">dilate</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">0.1px</span><input
                                    type="range" min="0.1" max="20" step="0.1" name="dilate"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-colors" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">black</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1%</span><input type="range"
                                    min="1" max="100" step="1" name="black"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-colors" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">blue</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1%</span><input type="range"
                                    min="1" max="100" step="1" name="blue"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-colors" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">brown</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1%</span><input type="range"
                                    min="1" max="100" step="1" name="brown"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-colors" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">cyan</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1%</span><input type="range"
                                    min="1" max="100" step="1" name="cyan"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-colors" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">green</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1%</span><input type="range"
                                    min="1" max="100" step="1" name="green"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-colors" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">gray</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1%</span><input type="range"
                                    min="1" max="100" step="1" name="gray"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-colors" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">magenta</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1%</span><input type="range"
                                    min="1" max="100" step="1" name="magenta"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-colors" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">orange</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1%</span><input type="range"
                                    min="1" max="100" step="1" name="orange"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-colors" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">pink</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1%</span><input type="range"
                                    min="1" max="100" step="1" name="pink"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-colors" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">purple</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1%</span><input type="range"
                                    min="1" max="100" step="1" name="purple"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-colors" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">red</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1%</span><input type="range"
                                    min="1" max="100" step="1" name="red"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-colors" style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">yellow</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1%</span><input type="range"
                                    min="1" max="100" step="1" name="yellow"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-transform"
                            style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">rotate</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1°</span><input type="range"
                                    min="1" max="360" step="1" name="rotate"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-transform"
                            style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">flip</span><select style="padding: 1px;">
                                    <option value="horizontal"></option>
                                    <option value="vertical"></option>
                                </select>
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-transform"
                            style="float: left; width: 100%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">shape</span><select style="padding: 1px;">
                                    <option value="star"></option>
                                    <option value="heart"></option>
                                    <option value="circle"></option>
                                    <option value="hexagon"></option>
                                    <option value="yinyang"></option>
                                </select>
                                <div style="float: right; margin-left: 30px;">=<input type="number" value="50" min="0"
                                        max="100" step="1" style="padding:2px;width:50px" data-append="%">%</div>
                                <div style="float: right; margin-left: 30px;">=<input type="color" value="#000000"
                                        data-rgb="0,0,0"></div>
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div class="filter-group filter-group-transform"
                            style="float: left; width: 50%; display: none;">
                            <fieldset
                                style="background: rgb(242, 242, 242); border-radius: 4px; margin: 5px; padding: 5px;">
                                <input type="checkbox"
                                    style="float: left; vertical-align: middle; margin-top: 3px;"><span
                                    style="float: left; padding: 0px 5px;">border</span><span
                                    style="float: right; padding-left: 5px; width: 50px;">1px</span><input type="range"
                                    min="1" max="100" step="1" name="border"
                                    style="float: right; padding: 0px 5px; max-width: 50%;">
                                <div style="clear:both;width:100%"></div>
                            </fieldset>
                        </div>
                        <div style="clear:both;width:100%"></div>
                    </div>
                    <div id="webcam-snapshots"></div>
                    <br>
                  
                    
                </div>

                <svg id="svg-filters" height="0">

                    <filter id="svg-filter--filters-ice">
                        <feTurbulence type="turbulence" baseFrequency="0.05" numOctaves="1" result="turbulence">
                        </feTurbulence>
                        <feDisplacementMap in2="turbulence" in="SourceGraphic" scale="1" xChannelSelector="R"
                            yChannelSelector="G"></feDisplacementMap>
                    </filter>

                    <filter id="svg-filter--filters-mosaic">
                        <feFlood height="1" width="1"></feFlood>
                        <feComposite width="2" height="2"></feComposite>
                        <feTile result="OUT"></feTile>
                        <feComposite in="SourceGraphic" in2="OUT" operator="in"></feComposite>
                        <feMorphology operator="dilate" radius="1"></feMorphology>
                    </filter>

                    <filter id="svg-filter--filters-erode">
                        <feMorphology operator="erode" radius="0.1"></feMorphology>
                    </filter>

                    <filter id="svg-filter--filters-dilate">
                        <feMorphology operator="dilate" radius="0.1"></feMorphology>
                    </filter>

                    <path aria-label="star" d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z"></path>
                    <path aria-label="heart"
                        d="M 65,29 C 59,19 49,12 37,12 20,12 7,25 7,42 7,75 25,80 65,118 105,80 123,75 123,42 123,25 110,12 93,12 81,12 71,19 65,29 z">
                    </path>
                    <path aria-label="circle" d="M 100, 100 m -75, 0 a 75,75 0 1,0 150,0 a 75,75 0 1,0 -150,0"></path>
                    <path aria-label="hexagon"
                        d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z">
                    </path>
                    <path aria-label="yinyang" d="M82.334,41.167C82.334,18.467,63.867,0,41.167,0c-0.47,0-0.934,0.02-1.401,0.036v-0.01c-0.135,0-0.266,0.017-0.401,0.02
			  c-0.21,0.01-0.421,0.021-0.631,0.033c-0.503,0.024-1.004,0.055-1.497,0.114C16.375,2.178,0,19.794,0,41.167
			  c0,22.7,18.467,41.167,41.167,41.167S82.334,63.867,82.334,41.167z M46.359,22.072c0,2.868-2.325,5.193-5.192,5.193
			  c-2.868,0-5.193-2.325-5.193-5.193c0-2.868,2.325-5.193,5.193-5.193C44.034,16.879,46.359,19.205,46.359,22.072z M58.712,60.85
			  c0,10.053-8.497,18.231-18.941,18.231v0.034C19.472,78.378,3.183,61.645,3.183,41.167c0-16.67,10.8-30.857,25.768-35.957
			  c-5.579,3.616-9.291,9.911-9.291,17.072c0,11.177,9.017,20.271,20.112,20.305v0.032C50.216,42.619,58.712,50.797,58.712,60.85z
			  M41.167,66.688c-2.868,0-5.193-2.326-5.193-5.193c0-2.868,2.325-5.193,5.193-5.193c2.867,0,5.192,2.325,5.192,5.193
			  C46.359,64.361,44.034,66.688,41.167,66.688z"></path>

                    <filter id="svg-filter--colors-black">
                        <feFlood result="OUT" flood-color="black" flood-opacity="0.01"></feFlood>
                        <feBlend in="SourceGraphic" in2="OUT" mode="multiply"></feBlend>
                    </filter>
                    <filter id="svg-filter--colors-blue">
                        <feFlood result="OUT" flood-color="blue" flood-opacity="0.01"></feFlood>
                        <feBlend in="SourceGraphic" in2="OUT" mode="multiply"></feBlend>
                    </filter>
                    <filter id="svg-filter--colors-brown">
                        <feFlood result="OUT" flood-color="brown" flood-opacity="0.01"></feFlood>
                        <feBlend in="SourceGraphic" in2="OUT" mode="multiply"></feBlend>
                    </filter>
                    <filter id="svg-filter--colors-cyan">
                        <feFlood result="OUT" flood-color="cyan" flood-opacity="0.01"></feFlood>
                        <feBlend in="SourceGraphic" in2="OUT" mode="multiply"></feBlend>
                    </filter>
                    <filter id="svg-filter--colors-green">
                        <feFlood result="OUT" flood-color="green" flood-opacity="0.01"></feFlood>
                        <feBlend in="SourceGraphic" in2="OUT" mode="multiply"></feBlend>
                    </filter>
                    <filter id="svg-filter--colors-gray">
                        <feFlood result="OUT" flood-color="gray" flood-opacity="0.01"></feFlood>
                        <feBlend in="SourceGraphic" in2="OUT" mode="multiply"></feBlend>
                    </filter>
                    <filter id="svg-filter--colors-magenta">
                        <feFlood result="OUT" flood-color="magenta" flood-opacity="0.01"></feFlood>
                        <feBlend in="SourceGraphic" in2="OUT" mode="multiply"></feBlend>
                    </filter>
                    <filter id="svg-filter--colors-orange">
                        <feFlood result="OUT" flood-color="orange" flood-opacity="0.01"></feFlood>
                        <feBlend in="SourceGraphic" in2="OUT" mode="multiply"></feBlend>
                    </filter>
                    <filter id="svg-filter--colors-pink">
                        <feFlood result="OUT" flood-color="pink" flood-opacity="0.01"></feFlood>
                        <feBlend in="SourceGraphic" in2="OUT" mode="multiply"></feBlend>
                    </filter>
                    <filter id="svg-filter--colors-purple">
                        <feFlood result="OUT" flood-color="purple" flood-opacity="0.01"></feFlood>
                        <feBlend in="SourceGraphic" in2="OUT" mode="multiply"></feBlend>
                    </filter>
                    <filter id="svg-filter--colors-red">
                        <feFlood result="OUT" flood-color="red" flood-opacity="0.01"></feFlood>
                        <feBlend in="SourceGraphic" in2="OUT" mode="multiply"></feBlend>
                    </filter>
                    <filter id="svg-filter--colors-yellow">
                        <feFlood result="OUT" flood-color="yellow" flood-opacity="0.01"></feFlood>
                        <feBlend in="SourceGraphic" in2="OUT" mode="multiply"></feBlend>
                    </filter>
                </svg>
            </div>



           
        </div>
    </section>


    <script>var appvars = { "config": { "lang": { "photo": { "canvas": false }, "media": { "actions": { "download": "Unduh", "remove": "Menghapus" } }, "iso": "id" }, "domainRoot": ".webcamtests.com", "staticUrl": "\/\/static.webcamtests.com\/", "dev": false, "page": { "id": 34445 }, "assetsVersions": { "js": "0.2.8", "css": "0.0.65" }, "csrf": { "name": "TOKEN1149503187X1727016736", "value": "0x5ONOVRixOawWXhHoUmJSn3r7Xb.ZAm" } } };</script>
    <script src="//static.webcamtests.com/theme/js/jquery.js?0.2.8"></script>
    <script async="" src="//static.webcamtests.com/theme/js/main.min.js?0.2.8"></script>

    <!-- <script src="{{ asset('assets/webcam/theme/js/jquery.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/webcam/theme/js/main.min.js?0.2.8') }}"></script> -->

    <script>window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments) } gtag('js', new Date()); gtag('config', 'UA-109056013-26')</script>
   

    <!-- <script type="text/javascript" src="//static.webcamtests.com/widgets/webcam_api/js/main.min.js?0.2.8"></script> -->
    <!-- <script type="text/javascript" src="//static.webcamtests.com/widgets/webcam_api/js/adapter.min.js?0.2.8"></script> -->
    <script src="{{ asset('assets/webcam/widgets/webcam_api/js/main.min.js') }}"></script> 
    <script src="{{ asset('assets/webcam/widgets/webcam_api/js/adapter.min.js') }}"></script>
@endsection