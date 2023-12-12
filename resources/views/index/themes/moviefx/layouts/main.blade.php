<!DOCTYPE HTML>
<html xmlns:og="http://ogp.me/ns#" lang="tr-TR">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <base>
    @foreach ($data['admin_meta'] as $item)
        <meta http-equiv="{{ $item->optional_2 ?? '' }}" name="{{ $item->value }}" content="{{ $item->optional ?? '' }}">
    @endforeach

    @foreach ($data['meta'] as $item)
        <meta http-equiv="{{ $item->optional_2 ?? '' }}" name="{{ $item->value }}"
            content="{{ $item->optional ?? '' }}">
    @endforeach

    <meta name="theme-color" content="#FDFD96" />

    <meta property="og:title" content="{{ $data['index_title']->value }} ">
    <meta property="og:site_name" content="{{ $data['index_title']->value }}">
    <meta property="og:url" content="{{ route('index') }}">
    <meta property="og:image" content="../../../{{ $data['index_icon']->value }}">

    <title>{{ $data['index_title']->value }}</title>

    <!--  CSS Dosyaları  -->
    <!-- İmages -->
    <link rel="icon" href="../../../{{ $data['index_icon']->value }}" type="image/x-icon">

    <!--Swipper-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="preload" href="../../../user/moviefx/assets/css/main.css" as="style">
    <link rel="stylesheet" href="../../../user/moviefx/assets/css/swiper.css">
    <link rel="stylesheet" href="../../../user/moviefx/assets/css/main.css">
    <link rel="stylesheet" href="../../../user/moviefx/assets/css/msfx.min.css">
    <link rel="stylesheet" href="../../../user/moviefx/assets/css/msfx-theme.min.css">
    <!--Sweet Alert-->
    <link rel="stylesheet" href="../../../user/css/sweetalert.min.css" />
    <link href="../../../user/css/sweetalert_dark.min.css" rel="stylesheet">
    <!--Özel-->
    <link rel="stylesheet" href="../../../index/css/censor.css" type="text/css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="../../../user/css/fontawesome_all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/brands.min.css"
        integrity="sha512-W/zrbCncQnky/EzL+/AYwTtosvrM+YG/V6piQLSe2HuKS6cmbw89kjYkp3tWFn1dkWV7L1ruvJyKbLz73Vlgfg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/solid.min.css"
        integrity="sha512-P9pgMgcSNlLb4Z2WAB2sH5KBKGnBfyJnq+bhcfLCFusrRc4XdXrhfDluBl/usq75NF5gTDIMcwI1GaG5gju+Mw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"
        integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="../../../user/animex/css/plyr.css" type="text/css">

    <style>
        .login-form-input {
            width: 70% !important;
        }
    </style>

    <!--JS Dosyaları-->
    <script src="../../../user/moviefx/assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../../user/moviefx/assets/js/jquery-ui.min.js"></script>
    <script src="../../../user/moviefx/assets/js/semantic.min.js"></script>
    <script src="../../../user/moviefx/assets/js/navigo.min.js"></script>
    <script src="../../../user/moviefx/assets/js/jquery.scrollbar.min.js?v=1"></script>
    <script src="../../../user/moviefx/assets/js/lazyload.min.js"></script>
    <script src="../../../user/moviefx/assets/js/sweetalert2.min.js"></script>
    <script src="../../../user/moviefx/assets/js/humane.min.js?v=2"></script>
    <script src="../../../user/moviefx/assets/js/main.min.js"></script>
    <script src="../../../user/animex/js/player.js"></script>

    <!-- Swipper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    @if (!Auth::user())
        <!--Giriş yapma ve kayıt olma ile ilgili modallar-->
        <script>
            $(document).ready(function() {
                @if (session('error'))
                    Swal.fire({
                        title: "Hata!",
                        text: "{{ session('error') }}",
                        type: "error"
                    });
                @endif
            });

            function login() {
                Swal.fire({
                    title: `<img src="../../../{{ $data['index_logo']->value }}" src="site logo" style="height: 32px; margin-top:50px;"> </img>`,
                    html: `
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <h3>Giriş Yap</h3>
                    <input type="email" name="email" id="email" class="swal2-input login-form-input" placeholder="E-mail Adresi *" required>
                    <input type="password" name="password" id="password" class="swal2-input login-form-input" placeholder="Şifre *" autocomplete="off" required>
                    <input type="text" name="theme" hidden value="theme3">
                    <div>
                        <a class="ui button danger" onclick="register()">Kayıt Ol</a>
                        <a class="ui button danger" href="#">Şifremi Unuttum?</a>
                    </div>
                    <div style="margin-top: 30px;">
                        <button class="ui button secondary" onclick="login()">Giriş Yap</button>
                    </div>

                </form>`,
                    showConfirmButton: false,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                });
            }

            function register() {
                Swal.fire({
                    title: `<img src="../../../{{ $data['index_logo']->value }}" src="site logo" style="height: 32px; margin-top:50px;">
                </img>`,
                    html: `
                <form action="{{ route('register') }}" method="POST" id="registerSubmitForm">
                    @csrf
                    <h3>Kayıt Ol</h3>
                    <input type="text" name="name" id="registerName" class="swal2-input login-form-input" placeholder="İsim *" required>

                    <label id="controlUsernameText"> </label>
                    <input type="text" name="username" id="registerUsername" class="swal2-input login-form-input" placeholder="Kullanıcı Adı *" onchange="controlUsername()" required>

                    <label id="controlEmailText"> </label>
                    <input type="email" name="email" id="registerEmail" class="swal2-input login-form-input" placeholder="E-mail Adresi *" onchange="controlEmail()" required>

                    <input type="password" name="password" id="registerPassword" class="swal2-input login-form-input" placeholder="Şifre *"
                        autocomplete="off" required>
                    <input type="password" name="password_repeat" id="registerPassword_repeat" class="swal2-input login-form-input" placeholder="Şifre Tekrarı *"
                        autocomplete="off" required>
                    <input type="text" name="theme" hidden value="theme3">
                    <div>
                        <a class="ui button danger" onclick="login()">Giriş Yap</a>
                    </div>
                    <div style="margin-top: 30px;">
                        <div style="margin:5px;">
                            <label id="registerMessageText" style="color:red;"> </label>
                        </div>
                        <a class="ui button secondary" onclick="registerSubmitFormButton()">Kayıt Ol</a>
                    </div>

                </form>`,
                    showConfirmButton: false,
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                });
            }
        </script>

        <!--Kayıt olma ile ilgili yardımcı modallar-->
        <script>
            var controlIsUsername = false;
            var controlIsEmail = false;

            function controlUsername() {
                var username = document.getElementById("registerUsername").value;
                var regex = /^[a-zA-Z0-9]+$/;
                if (username.length < 3) {
                    document.getElementById("controlUsernameText").innerText =
                        "Kullanılamaz";
                    document.getElementById("controlUsernameText").style.color = "red";
                    controlIsUsername = false;
                } else if (!regex.test(username)) {
                    document.getElementById("controlUsernameText").innerText =
                        "Kullanılamaz";
                    document.getElementById("controlUsernameText").style.color = "red";
                    controlIsUsername = false;
                } else {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                    });
                    $.ajax({
                        type: "POST",
                        url: '{{ route('index_control_username') }}',
                        data: {
                            username: username
                        },
                        success: function(control) {
                            if (control.control) {
                                document.getElementById("controlUsernameText").innerText =
                                    "Kullanılabilir";
                                document.getElementById("controlUsernameText").style.color =
                                    "green";
                            } else {
                                document.getElementById("controlUsernameText").innerText =
                                    "Kullanılamaz";
                                document.getElementById("controlUsernameText").style.color =
                                    "red";
                            }

                            controlIsUsername = control.control;
                        },
                    });
                }
            }

            function controlEmail() {
                var email = document.getElementById("registerEmail");
                var value = email.value;
                if (!email.checkValidity() || value.length == 0) {
                    document.getElementById("controlEmailText").innerText = "Kullanılamaz";
                    document.getElementById("controlEmailText").style.color = "red";
                    controlIsUsername = false;
                } else {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                    });
                    $.ajax({
                        type: "POST",
                        url: '{{ route('index_control_email') }}',
                        data: {
                            email: value
                        },
                        success: function(control) {
                            if (control.control) {
                                document.getElementById("controlEmailText").innerText =
                                    "Kullanılabilir";
                                document.getElementById("controlEmailText").style.color =
                                    "green";
                            } else {
                                document.getElementById("controlEmailText").innerText =
                                    "Kullanılamaz";
                                document.getElementById("controlEmailText").style.color =
                                    "red";
                            }

                            controlIsEmail = control.control;
                        },
                    });
                }
            }

            function registerSubmitFormButton() {
                var name = document.getElementById("registerName").value;
                var username = document.getElementById("registerUsername").value;
                var email = document.getElementById("registerEmail").value;
                var password = document.getElementById("registerPassword").value;
                var password_repeat = document.getElementById("registerPassword_repeat").value;

                if (
                    name.length == 0 ||
                    username.length == 0 ||
                    email.length == 0 ||
                    password.length == 0 ||
                    password_repeat.length == 0
                ) {
                    document.getElementById("registerMessageText").innerText =
                        "Lütfen Tüm gerekli alanları doldurunuz.";
                } else if (controlIsUsername && controlIsEmail) {

                    if (password == password_repeat) {
                        document.getElementById("registerSubmitForm").submit();
                    } else {
                        document.getElementById("registerMessageText").innerText =
                            "Şifre İle Şifre Tekrarı aynı değil.";
                    }
                } else {
                    if (!controlIsUsername) {
                        document.getElementById("registerMessageText").innerText =
                            "Bu Kullanıcı adı alınamaz";
                    } else {
                        document.getElementById("registerMessageText").innerText =
                            "Bu E-mail adresi alınamaz";
                    }
                }
            }
        </script>
    @endif

</head <body class="fluid">
<div data-gets data-type="pgskin"></div>
<main id="wrapper">,
    <!-- Header -->
    @include('index.themes.moviefx.layouts.topbar')

    <!-- Main -->
    <div id="wrapper-inner">
        <div class="triggered-overlay"></div>
        <!-- Menü -->
        @include('index.themes.moviefx.layouts.sidebar')

        <div id="content">
            <div class="inner-content container" id="page-index">
                <div id="router-view">
                    @yield('index_content')
                </div>
            </div>
        </div>
    </div>
    <!--Footer-->
    @include('index.themes.moviefx.layouts.footer')

    </div>
</main>

</body>

</html>
