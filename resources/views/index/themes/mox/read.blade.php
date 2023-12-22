@extends('index.themes.mox.layouts.main')
@section('index_content')

    <style>
        .overlay-button {
            position: absolute !important;
            bottom: 75px !important;
            /* Alt kenardan biraz yukarıda */
            right: 75px !important;
            /* Sağ kenardan biraz sola */
            padding: 4px 15px !important;
            background-color: #0b0c2a;
            /* Yarı şeffaf siyah arkaplan */
            color: white;
            border-radius: 8px;
            border: 2px solid rgba(255, 255, 255, 0);
            /* Beyaz yarı şeffaf sınır (border) */
            transition: opacity 0.5s ease, transform 0.1s ease, border 0.1s ease;
            /* Border için de animasyon eklendi */
            box-shadow: 0 2px 10px #0b0c2a;
            /* Gölge efekti */
            font-family: 'Roboto', sans-serif !important;
            /* Kullanılan fontu ayarlayın */
            z-index: 99999999;
        }

        .webtoon-image {
            width: 80%;
            position: relative;
            left: 10%;
        }

        .overlay-button:hover {
            opacity: 1;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        @media only screen and (max-width: 992px) {

            .webtoon-image {
                width: 130%;
                position: relative;
                left: -15%;
            }

            .overlay-button {
                opacity: 0;
                display: none;
            }


        }
    </style>

    <!-- main-area -->
    <main>


        <!-- contact-area -->
        <section class="contact-area contact-bg" data-background="../../../user/mox/img/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="contact-form-wrap">
                            <div class="widget-title mb-50">
                                <h5 class="title">{{ $webtoon->name }} <span style="color:#e53637"
                                        {{ $webtoon->plusEighteen == '0' ? 'hidden' : '' }}>+18</span>
                                </h5>
                            </div>
                            <div class="contact-form">
                                <div style="position: relative;" class="justify-content-center">
                                    @foreach ($files as $item)
                                        @if ($item->file_type == 'pdf')
                                            <iframe id="myIframe" src="../../../{{ $item->file }}"
                                                style="max-width: 100%; min-width: 100%; height:800px;" frameborder="0"
                                                allowfullscreen></iframe>
                                            <button onclick="toggleFullScreen()" class="overlay-button">Tam Ekran</button>
                                        @else
                                            <img class="webtoon-image" src="../../../{{ $item->file }}"
                                                alt="{{ $item->code }}">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

        <section class="blog-details-area blog-bg" data-background="../../../user/mox/img/bg/blog_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-comment mb-80">
                            <div class="widget-title mb-45">
                                <h5 class="title">Yorumlar</h5>
                            </div>
                            @if (count($comments_main) > 0)
                                <ul>
                                    @foreach ($comments_main as $main_comment)
                                        <li>
                                            <div class="single-comment">
                                                <div class="comment-avatar-img">
                                                    <img src="../../../{{ $main_comment->user_image ?? 'user/img/profile/default.png' }}"
                                                        alt="img">
                                                </div>
                                                <div class="comment-text">
                                                    <div class="comment-avatar-info">
                                                        <h5>{{ $main_comment->user_name ?? 'not_found' }} <span
                                                                class="comment-date">{{ $main_comment->date }}</span>
                                                        </h5>
                                                    </div>

                                                    <p>{{ $main_comment->message }}</p>
                                                </div>

                                            </div>
                                            <a href="javascript:;" class="comment-reply-link"
                                                onclick="ReplyComment('AnswerMain{{ $loop->index }}','{{ $episode->code }}','0','1','{{ $main_comment->code }}')">Cevapla
                                                <i class="fas fa-reply-all"></i></a>
                                        </li>

                                        <div id="AnswerMain{{ $loop->index }}"></div>

                                        @foreach ($comments_alt->Where('comment_top_code', $main_comment->code) as $alt_comment)
                                            <li class="comment-reply">
                                                <div class="single-comment">
                                                    <div class="comment-avatar-img">
                                                        <img src="../../../{{ $alt_comment->user_image ?? 'user/img/profile/default.png' }}"
                                                            alt="img">
                                                    </div>
                                                    <div class="comment-text">
                                                        <div class="comment-avatar-info">
                                                            <h5>{{ $alt_comment->user_name ?? 'not_found' }} <span
                                                                    class="comment-date">{{ $alt_comment->date }}</span>
                                                            </h5>
                                                        </div>
                                                        <p>{{ $alt_comment->message }}</p>
                                                    </div>
                                                </div>
                                                <a href="javascript:;" class="comment-reply-link"
                                                    onclick="ReplyComment('AnswerAltMain{{ $loop->index }}','{{ $webtoon->code }}','0','1','{{ $main_comment->code }}')">Cevapla
                                                    <i class="fas fa-reply-all"></i></a>
                                            </li>
                                            <div id="AnswerAltMain{{ $loop->index }}"></div>
                                        @endforeach
                                    @endforeach
                                </ul>
                            @else
                                <p style="color:white;">İlk Yorum Yapan Siz Olun</p>
                            @endif
                        </div>
                        @if (Auth::user())
                            <div class="contact-form-wrap">
                                <div class="widget-title mb-50">
                                    <h5 class="title">Yorum Yaz</h5>
                                </div>
                                <div class="contact-form">
                                    <form action="{{ route('addNewComment') }}" method="POST">
                                        @csrf
                                        <div hidden>
                                            <input type="text" name="webtoon_code" value="{{ $webtoon->code }}">
                                            <input type="text" name="content_code" value="{{ $episode->code }}">
                                            <input type="text" name="content_type" value="0">
                                            <input type="text" name="comment_type" value="0">
                                            <input type="text" name="comment_top_code" value="0">
                                        </div>
                                        <textarea name="message" placeholder="Yorum..."></textarea>
                                        <button class="btn" type='submit'>Gönder</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="contact-form-wrap">
                                <div class="widget-title mb-50">
                                    <h5 class="title">Yorum Yazmak İçin İlk Önce Giriş Yapmalısınız</h5>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>


    </main>
    <!-- main-area-end -->
    <script>
        @if (session('success'))
            document.getElementById('successMessage').innerText = "{{ session('success') }}"
        @endif
    </script>

    <script>
        function toggleFullScreen() {
            var iframe = document.getElementById('myIframe');
            if (!document.fullscreenElement) {
                iframe.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }
    </script>

    <!-- Yorum ayarları -->
    <script>
        function ReplyComment(commentDiv, content_code, content_type, comment_type, comment_top_code) {
            var commentDiv = document.getElementById(commentDiv);
            if (commentDiv.innerHTML == "") {
                var html = `<li class="comment-reply"> <div class="contact-form">
                        <form action="{{ route('addNewComment') }}" method="POST">
                            @csrf
                            <div hidden>
                                <input type="text" name="webtoon_code" value="{{ $webtoon->code }}">
                                <input type="text" name="content_code" value="` + content_code + `">
                                <input type="text" name="content_type" value="` + content_type + `">
                                <input type="text" name="comment_type" value="` + comment_type + `">
                                <input type="text" name="comment_top_code" value="` + comment_top_code + `">
                            </div>
                            <textarea name="message" placeholder="Yorumunuz"></textarea>
                            <button class="btn" type='submit'>Gönder</button>
                        </form>
                </div> </li>`;

                commentDiv.innerHTML = html;
            } else {
                commentDiv.innerHTML = "";
            }

        }
    </script>

    <!--Kaldığı yerden devam etme-->
    <script>
        const autoread = 5000;
        const scrool_cookie = "read_{{ $episode->code }}"
        console.log('sayfa başlatıldı')
        console.log(getSavedScrollPosition(scrool_cookie));
        setInterval(() => {
            saveScrollPosition();
        }, autoread);

        // Sayfa yüklendiğinde otomatik olarak kaydedilen konuma git
        window.onload = function() {
            goToSavedPosition();
        }
        // Konumu çerezlere kaydetme
        function saveScrollPosition() {
            var currentPosition = window.scrollY;
            document.cookie = scrool_cookie + "=" + currentPosition;
        }

        // Kullanıcıyı belirli bir görselin olduğu yere götür
        function goToSavedPosition() {
            var savedPosition = getSavedScrollPosition(scrool_cookie);
            window.scrollTo(0, savedPosition);
        }

        function getSavedScrollPosition(cookieName) {
            const cookies = document.cookie.split(';');

            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i].trim();

                // Çerez adını kontrol et
                if (cookie.startsWith(cookieName + '=')) {
                    // Çerez adını çıkartarak değeri al
                    return cookie.substring(cookieName.length + 1);
                }
            }

            // Belirli bir çerez bulunamazsa null döndür
            return null;
        }
    </script>
@endsection
