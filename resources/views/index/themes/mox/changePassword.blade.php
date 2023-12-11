@extends('index.themes.mox.layouts.main')
@section('index_content')
    <!-- main-area -->
    <main>

        <!-- contact-area -->
        <section class="contact-area contact-bg" data-background="../../../user/mox/img/bg/contact_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="contact-form-wrap">
                            <div class="widget-title mb-50">
                                <h5 class="title">Şifre Değiştir</h5>
                            </div>
                            <div class="contact-form ">
                                <form action="{{ route('change_profile_password') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="password" name="old_password" id="old_password"
                                                placeholder=" Eski Şifre *">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="password" name="password" id="password" placeholder="Şifre *">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="password" name="password_repeat" id="password_repeat"
                                                placeholder="Şifre Tekrarı *">
                                        </div>
                                    </div>
                                    <p style="color: green;" id="successMessage"></p>
                                    <p style="color:red;" id="ErrorTextMessage2"></p>
                                    <button class="btn">Şifreyi Değiştir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->
    </main>

    <!-- JS here -->
    <script src="../../../user/mox/js/vendor/jquery-3.6.0.min.js"></script>

    <script>
        @if (session('error'))
            document.getElementById("ErrorTextMessage").innerText =
                "{{ session('error') }}";
        @endif
        function changePasswordFormButton() {
            var old_password = document.getElementById("old_password").value;
            var password = document.getElementById("password").value;
            var password_repeat = document.getElementById("password_repeat").value;

            if (old_password.length == 0 || password.length == 0 || password_repeat.length == 0) {
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
