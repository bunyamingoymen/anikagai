@extends('shop.themes.kidol.layouts.main')
@section('shop_body')
    <!--== Start Login Wrapper ==-->
    <section class="login-register-area">
    </section>
    <!--== End Login Wrapper ==-->

    <section class="product-area product-style1-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-tab-content">
                        <ul class="nav nav-tabs" id="myTab" role="tablist" data-aos="fade-up" data-aos-duration="1000">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="our-features-tab" data-bs-toggle="tab"
                                    data-bs-target="#shop-user-login" type="button" role="tab"
                                    aria-controls="shop-user-login" aria-selected="true">Üye Girisi</button>
                            </li>
                            @if ($newSellerAccept)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="shop-seller-login-tab" data-bs-toggle="tab"
                                        data-bs-target="#shop-seller-login" type="button" role="tab"
                                        aria-controls="shop-seller-login" aria-selected="false">Satıcı Girisi</button>
                                </li>
                            @endif
                        </ul>

                        <div class="tab-content" id="myTabContent" data-aos="fade-up" data-aos-duration="1300">
                            <div class="tab-pane fade show active" id="shop-user-login" role="tabpanel"
                                aria-labelledby="shop-user-login-tab">
                                <div class="row">
                                    <div class="col-md-6 login-register-border">
                                        <div class="login-register-content">
                                            <div class="login-register-title mb-30">
                                                <h2>Giris Yap</h2>
                                            </div>
                                            <div class="login-register-style login-register-pr">
                                                <form action="{{ route('shop_user_login') }}" method="post">
                                                    @csrf
                                                    <div class="login-register-input">
                                                        <input type="text" name="email"
                                                            placeholder="Kullanıcı adı veya e-mail adresi" required>
                                                    </div>
                                                    <div class="login-register-input">
                                                        <input type="password" name="password" placeholder="Şifre" required>
                                                        <div class="forgot">
                                                            <a href="#">Şifremi Unuttum?</a>
                                                        </div>
                                                    </div>
                                                    <div class="remember-me-btn">
                                                        <input type="checkbox">
                                                        <label>Beni Hatırla</label>
                                                    </div>
                                                    <div class="btn-style-3">
                                                        <button class="btn" type="submit">Giriş Yap</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="login-register-content login-register-pl">
                                            <div class="login-register-title mb-30">
                                                <h2>Üye Ol</h2>
                                            </div>
                                            <div class="login-register-style">
                                                <form action="{{ route('shop_user_register') }}" method="post">
                                                    @csrf
                                                    <div class="login-register-input">
                                                        <input type="text" name="username" placeholder="Kullanıcı Adı"
                                                            required>
                                                    </div>
                                                    <div class="login-register-input">
                                                        <input type="email" name="email" placeholder="E-mail adresi"
                                                            required>
                                                    </div>
                                                    <div class="login-register-input">
                                                        <input type="password" name="password" placeholder="Şifre" required>
                                                    </div>
                                                    <div class="login-register-paragraph">
                                                        <p>Üye olmanız durumunda Kişisel Verilerin Korunması Kanununu
                                                            onaylamış olursunuz. Daha fazlası için <a
                                                                href="#">gizlilik sözleşmesi</a>'ne bakabilirsiniz.
                                                        </p>
                                                    </div>
                                                    <div class="btn-style-3">
                                                        <button class="btn" type="submit">Üye Ol</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($newSellerAccept)
                                <div class="tab-pane fade" id="shop-seller-login" role="tabpanel"
                                    aria-labelledby="shop-seller-login-tab">
                                    <div class="row">
                                        <div class="col-md-6 login-register-border">
                                            <div class="login-register-content">
                                                <div class="login-register-title mb-30">
                                                    <h2>Satıcı Girisi</h2>
                                                </div>
                                                <div class="login-register-style login-register-pr">
                                                    <form action="{{ route('shop_seller_login') }}" method="post">
                                                        @csrf
                                                        <div class="login-register-input">
                                                            <input type="text" name="email"
                                                                placeholder="Kullanıcı adı veya e-mail adresi">
                                                        </div>
                                                        <div class="login-register-input">
                                                            <input type="password" name="password" placeholder="Şifre">
                                                            <div class="forgot">
                                                                <a href="#">Şifremi Unuttum?</a>
                                                            </div>
                                                        </div>
                                                        <div class="remember-me-btn">
                                                            <input type="checkbox">
                                                            <label>Beni Hatırla</label>
                                                        </div>
                                                        <div class="btn-style-3">
                                                            <button class="btn" type="submit">Giriş Yap</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="login-register-content login-register-pl">
                                                <div class="login-register-title mb-30">
                                                    <h2>Üye Ol</h2>
                                                </div>
                                                <div class="login-register-style">
                                                    <form action="{{ route('shop_seller_register') }}" method="post">
                                                        @csrf
                                                        <div class="login-register-input">
                                                            <input type="text" name="username"
                                                                placeholder="Kullanıcı Adı">
                                                        </div>
                                                        <div class="login-register-input">
                                                            <input type="text" name="email"
                                                                placeholder="E-mail adresi">
                                                        </div>
                                                        <div class="login-register-input">
                                                            <input type="password" name="password" placeholder="Şifre">
                                                        </div>
                                                        <div class="login-register-paragraph">
                                                            <p>Üye olmanız durumunda Kişisel Verilerin Korunması Kanununu
                                                                onaylamış olursunuz. Daha fazlası için <a
                                                                    href="#">gizlilik sözleşmesi</a>'ne
                                                                bakabilirsiniz.
                                                            </p>
                                                        </div>
                                                        <div class="btn-style-3">
                                                            <button class="btn" type="submit">Üye Ol</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script></script>
@endsection
