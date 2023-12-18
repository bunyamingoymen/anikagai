@extends('index.themes.animex.layouts.main')
@section('index_content')
    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="../../../user/animex/img/normal-breadcrumb.jpg">
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
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="input__item login_input">
                                <input type="email" name="email" id="email" placeholder="E-mail Adresi *">
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item login_input">
                                <input type="password" name="password" id="password" placeholder="Şifre *">
                                <span class="icon_lock"></span>
                            </div>
                            <button type="submit" class="site-btn">Giriş Yap</button>
                        </form>
                        <a href="#" class="forget_pass">Şifremi Unuttum?</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Kayıt Ol</h3>
                        <form action="{{ route('register') }}" method="POST" id="registerSubmitForm">
                            @csrf
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
                            <button class="site-btn" type="button" onclick="registerSubmitFormButton()">Kayıt Ol</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Section End -->

    <!-- Js Plugins -->
    <script src="../../../user/animex/js/jquery-3.3.1.min.js"></script>

    <!--Kayıt İşlemleri için fonksiyonlar-->
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
@endsection
