@extends('index.themes.animex.layouts.main')
@section('index_content')
    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="{{ url('user/animex/img/normal-breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Giriş Yap</h2>
                        <p>Giriş Yap</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Login Section Begin -->
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form login__form2">
                        <h3>Giriş Yap</h3>
                        <form action="{{ route('login') }}" method="POST" id="loginFormID">
                            @csrf
                            <input type="text" name="check" id="check" placeholder="Check *" style="display:none;">
                            <div class="input__item login_input">
                                <input type="text" name="email" id="email"
                                    placeholder="E-mail Adresi VEYA Kullanıcı adı *">
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item login_input">
                                <input type="password" name="password" id="password" placeholder="Şifre *">
                                <span class="icon_lock"></span>
                            </div>
                            <div class="">
                                <input type="checkbox" name="remember_me" id="remember_me" checked>
                                <label for="remember_me" style="color:white;">Beni Hatırla</label>
                            </div>
                            <div class="g-recaptcha" data-callback="imNotARobotv2"
                                data-sitekey="{{ config('services.recaptcha.site_key_v2') }}"></div>
                            <button type="button" class="site-btn" onclick="loginFormButton()">Giriş Yap</button>
                        </form>
                        <a href="javascript:void(0);" onclick="forgotPassword();" class="forget_pass">Şifremi Unuttum?</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Kayıt Ol</h3>
                        <form action="{{ route('register') }}" method="POST" id="registerSubmitForm">
                            @csrf
                            <input type="text" name="check" id="registerCheck" placeholder="Check *"
                                style="display:none;">
                            <div class="input__item login_input">
                                <input type="text" name="name" id="registerName" placeholder="İsim *">
                                <span class="icon_profile"></i></span>
                            </div>
                            <div class="input__item">

                                <div class="login_input">
                                    <input type="text" name="username" id="registerUsername"
                                        placeholder="Kullanıcı Adı *" onchange="controlUsername()">
                                    <span class="icon_profile"></span>
                                </div>
                                <small id="controlUsernameText"></small>
                            </div>
                            <div class="input__item">
                                <div class="login_input">
                                    <input type="email" name="email" id="registerEmail" placeholder="E-mail *"
                                        onchange="controlEmail()">
                                    <span class="icon_mail"></span>
                                </div>
                                <small id="controlEmailText"></small>
                            </div>

                            <div class="input__item login_input">
                                <input type="password" name="password" id="registerPassword" placeholder="Şifre *">
                                <span class="icon_lock"></span>
                            </div>
                            <div class="input__item login_input">
                                <input type="password" name="password_repeat" id="registerPassword_repeat"
                                    placeholder="Şifre Tekrarı *">
                                <span class="icon_lock"></span>
                            </div>
                            <div class="g-recaptcha" data-callback="imNotARobot"
                                data-sitekey="{{ config('services.recaptcha.site_key_v2') }}"></div>
                            <button class="site-btn" type="button" onclick="registerSubmitFormButton()">Kayıt Ol</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Section End -->

    <!-- Js Plugins -->
    <script src="{{ url('user/animex/js/jquery-3.3.1.min.js') }}"></script>

    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

    <script type="text/javascript">
        var notRobot = false;
        var imNotARobot = function() {
            notRobot = true;
        };

        var notRobotv2 = false;
        var imNotARobotv2 = function() {
            notRobotv2 = true;
        };
    </script>

    <!--Kayıt İşlemleri için fonksiyonlar-->
    <script>
        var controlIsUsername = false;
        var controlIsEmail = false;

        function controlUsername() {
            var username = document.getElementById("registerUsername").value;
            if (username.length < 3) {

                document.getElementById("controlUsernameText").innerText =
                    "Kullanılamaz";
                document.getElementById("controlUsernameText").style.color = "red";
                controlIsUsername = false;
            } else if (!controlCharacterUsername(username)) {

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

        function controlUsernameRegister() {
            var username = document.getElementById("registerUsername").value;
            if (username.length < 3) {
                Swal.fire({
                    title: "Hata",
                    text: "Bu Kullanıcı adı alınamaz",
                    icon: "error"
                });
                controlIsUsername = false;
            } else if (!controlCharacterUsername(username)) {
                Swal.fire({
                    title: "Hata",
                    text: "Bu Kullanıcı adı alınamaz",
                    icon: "error"
                });
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
                            controlEmailRegister();
                        } else {
                            Swal.fire({
                                title: "Hata",
                                text: "Bu Kullanıcı adı alınamaz",
                                icon: "error"
                            });
                        }

                        controlIsUsername = control.control;
                    },
                });
            }
        }

        function controlEmailRegister() {
            var email = document.getElementById("registerEmail");
            var value = email.value;
            if (!email.checkValidity() || value.length == 0) {
                Swal.fire({
                    title: "Hata",
                    text: "Bu E-mail adresi alınamaz",
                    icon: "error"
                });
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
                            var password = document.getElementById("registerPassword").value;
                            var password_repeat = document.getElementById(
                                "registerPassword_repeat").value
                            if (password == password_repeat) {
                                document.getElementById("registerSubmitForm").submit();
                            } else {
                                Swal.fire({
                                    title: "Hata",
                                    text: "Şifre İle Şifre Tekrarı",
                                    icon: "error"
                                });
                            }
                        } else {
                            Swal.fire({
                                title: "Hata",
                                text: "Bu E-mail adresi alınamaz",
                                icon: "error"
                            });
                        }

                        controlIsEmail = control.control;
                    },
                });
            }
        }

        function registerSubmitFormButton() {
            if (notRobot) {
                var name = document.getElementById("registerName").value;
                var username = document.getElementById("registerUsername").value;
                var email = document.getElementById("registerEmail").value;
                var password = document.getElementById("registerPassword").value;
                var password_repeat = document.getElementById(
                    "registerPassword_repeat"
                ).value;
                if (
                    name.length == 0 ||
                    username.length == 0 ||
                    email.length == 0 ||
                    password.length == 0 ||
                    password_repeat.length == 0
                ) {
                    Swal.fire({
                        title: "Hata",
                        text: "Lütfen gerekli alanları doldurunuz.",
                        icon: "error"
                    });
                } else if (controlIsUsername && controlIsEmail) {

                    if (password == password_repeat) {
                        document.getElementById("registerSubmitForm").submit();
                    } else {
                        Swal.fire({
                            title: "Hata",
                            text: "Şifre İle Şifre Tekrarı",
                            icon: "error"
                        });
                    }
                } else {
                    if (!controlIsUsername) {
                        controlUsernameRegister();
                    } else {
                        controlEmailRegister();
                    }
                }
            } else {
                Swal.fire({
                    title: "Hata",
                    text: "Lütfen robot olmadığınızı doğrulayınız.",
                    icon: "error"
                });
            }
        }
    </script>

    <!--Giriş yapma için fonskiyonlar-->
    <script>
        function loginFormButton() {
            if (notRobotv2) {
                var password = document.getElementById("password");
                var email = document.getElementById("email");
                if (password.length <= 0 || email.length <= 0) {
                    Swal.fire({
                        title: "Hata",
                        text: "Lütfen gerekli yerleri doldurunuz.",
                        icon: "error"
                    });
                } else {
                    document.getElementById("loginFormID").submit();
                }
            } else {
                Swal.fire({
                    title: "Hata",
                    text: "Lütfen robot olmadığınızı doğrulayınız.",
                    icon: "error"
                });
            }
        }
    </script>

    <script>
        @if (session('error'))
            Swal.fire({
                title: "Hata",
                text: "{{ session('error') }}",
                icon: "error"
            });
            document.getElementsByClassName('nice-select')[0].hidden = true;
        @endif
    </script>

    <!--Şifremi Unuttum için fonksiyonlar-->
    <script>
        function forgotPassword() {
            Swal.fire({
                title: "Şifremi Unuttum",
                text: "Lütfen E-mail adresinizi giriniz",
                input: "email",
                inputAttributes: {
                    autocapitalize: "off"
                },
                icon: "info",

            }).then((result) => {
                Swal.fire({
                    title: "Başarılı",
                    text: "Eğer E-mail adresiniz mevcutsa yeni şifreniz E-mail adresinize gönderildi",
                    icon: "success",
                });
                if (result.value) {
                    $.ajax({
                        url: '{{ route('forgotPassword') }}', // İstek yapılacak URL
                        data: {
                            email: result.value,
                            _token: "{{ csrf_token() }}" // CSRF token'ı ekleyin
                        },
                        success: function(data) {
                            console.log(true);
                        },
                        error: function(error) {
                            console.log(true);
                        }
                    });
                }
            });
        }
    </script>
@endsection
