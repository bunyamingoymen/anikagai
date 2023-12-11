@extends('index.themes.animex.layouts.main')
@section('index_content')
    <!-- Login Section Begin -->
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="login__form">
                        <h3>Bilgiler</h3>
                        <form action="{{ route('change_profile_password') }}" method="POST" id="changePasswordForm">
                            @csrf
                            <span style="color:red;" id="ErrorTextMessage"></span>
                            <div class="input__item">

                                <input type="password" name="old_password" id="old_password" placeholder="Eski Şifre *">
                                <span class="icon_key"></i></span>
                            </div>
                            <div class="input__item">
                                <input type="password" name="password" id="password" placeholder="Yeni Şifre *">
                                <span class="icon_key"></i></span>
                            </div>
                            <div class="input__item">
                                <input type="password" name="password_repeat" id="password_repeat"
                                    placeholder="Yeni Şifre Tekrarı *">
                                <span class="icon_key"></i></span>
                            </div>
                            <span style="color:red;" id="ErrorTextMessage2"></span>
                            <button class="site-btn" type="button" onclick="changePasswordFormButton()">Güncelle</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Section End -->

    <!-- Js Plugins -->
    <script src="../../../user/animex/js/jquery-3.3.1.min.js"></script>

    <script>
        @if (session('error'))
            document.getElementById("ErrorTextMessage").innerText =
                "{{ session('error') }}";
        @endif
        function changePasswordFormButton() {
            var old_password = document.getElementById("old_password").value;
            var password = document.getElementById("password").value;
            var password_repeat = document.getElementById("password_repeat").value;

            if (
                old_password.length == 0 ||
                password.length == 0 ||
                password_repeat.length == 0
            ) {
                document.getElementById("ErrorTextMessage2").innerText =
                    "Lütfen Tüm gerekli alanları doldurunuz.";
            } else if (password == password_repeat) {
                document.getElementById("changePasswordForm").submit();
            } else {
                document.getElementById("ErrorTextMessage2").innerText =
                    "Şifre İle Şifre Tekrarı Uyuşmamaktadır.";
            }
        }
    </script>
@endsection
