@extends("index.themes.animex.layouts.main")
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
                    <form action="#">
                        <div class="input__item">
                            <input type="email" placeholder="E-mail Adresi *">
                            <span class="icon_mail"></span>
                        </div>
                        <div class="input__item">
                            <input type="password" placeholder="Şifre *">
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
                    <form action="#">
                        <div class="input__item">
                            <input type="text" name="name" id="registerName" placeholder="İsim *">
                            <span class="icon_profile"></i></span>
                            <small></small>
                        </div>
                        <div class="input__item">
                            <input type="text" name="username" id="registerUsername" placeholder="Kullanıcı Adı *">
                            <span class="icon_profile"></span>
                            <small></small>
                        </div>
                        <div class="input__item">
                            <input type="email" name="email" id="registerEmail" placeholder="E-mail *">
                            <span class="icon_mail"></span>
                            <small></small>
                        </div>

                        <div class="input__item">
                            <input type="password" name="password" id="registerPassword" placeholder="Şifre *">
                            <span class="icon_lock"></span>
                        </div>
                        <div class="input__item">
                            <input type="password" name="password_repeat" id="registerPassword_repeat"
                                placeholder="Şifre Tekrarı *">
                            <span class="icon_lock"></span>
                        </div>
                        <button type="submit" class="site-btn">Giriş Yap</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Login Section End -->

@endsection