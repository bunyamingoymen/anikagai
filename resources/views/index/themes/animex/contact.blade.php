@extends('index.themes.animex.layouts.main')
@section('index_content')
    <!-- main-area -->
    <main>

        <!-- Normal Breadcrumb Begin -->
        <section class="normal-breadcrumb set-bg" data-setbg="../../../user/animex/img/normal-breadcrumb.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="normal__breadcrumb__text">
                            <h2>İletişim</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Normal Breadcrumb End -->

        <section class="login spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="login__form3">
                            <h3>İletişim</h3>
                            <form action="{{ route('contact') }}" method="POST">
                                @csrf
                                <div class="input__item">
                                    <input type="text" name="name" id="name" placeholder="İsim *">
                                    <span class="icon_profile"></span>
                                </div>
                                <div class="input__item">
                                    <input type="email" name="email" id="email" placeholder="E-mail *">
                                    <span class="icon_mail"></span>
                                </div>
                                <div class="input__item">
                                    <input type="text" name="subject" id="subject" placeholder="Konu *">
                                    <span class="icon_key"></span>
                                </div>
                                <div class="input__item">
                                    <textarea name="message" placeholder="Mesaj Giriniz..." cols="103" rows="10"></textarea>
                                </div>
                                <div>
                                    <span id="contactSuccessMessage" style="color: green;"></span>
                                </div>
                                <button type="submit" class="site-btn">Gönder</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <!-- main-area-end -->
    <script>
        @if (session('success'))
            document.getElementById('contactSuccessMessage').innerText = "{{ session('success') }}"
        @endif
    </script>
@endsection
