@extends('index.themes.animex.layouts.main')
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

        .overlay-button:hover {
            opacity: 1;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .webtoon-image {
            width: 80%;
            position: relative;
            left: 10%;
        }

        .next-prev-button {
            display: flex;
            justify-content: space-between;
        }

        .next-prev-button div a {
            background-color: #0b0c2a;
            color: white;
            border-radius: 10px;
            padding: 4px 15px !important;

            border: 2px solid rgba(175, 175, 175, 0.3);
            box-shadow: 0 2px 10px #0b0c2a;
            transition: opacity 0.5s ease, transform 0.1s ease, border 0.5s ease;
            font-family: 'Roboto', sans-serif !important;
            display: flex;
            align-items: center;
        }

        .next-prev-button div a:hover {
            border: 2px solid rgba(255, 255, 255, 0.8);
        }

        @media only screen and (max-width: 479px) {
            .overlay-button {
                opacity: 0;
                display: none;
            }

            .webtoon-image {
                width: 100%;
                position: relative;
                left: 0px;
            }

            .next-prev-button div a {
                font-size: 14px;
            }
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/viewerjs@1.10.0/dist/viewer.min.css">
    <script src="https://unpkg.com/viewerjs@1.10.0/dist/viewer.min.js"></script>
    <script src="../../../user/animex/js/jquery-3.3.1.min.js"></script>

    <section class="anime-details spad">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="anime__details__review">
                        <div class="section-title" {{ $webtoon->plusEighteen == '0' ? 'hidden' : '' }}>
                            <h5 style="color:#e53637">+18</h5>
                        </div>
                    </div>
                    @if ($prev_episode_url != 'none' || $next_episode_url != 'none')
                        <div class="row mt-5 mb-5 next-prev-button">
                            @if ($prev_episode_url != 'none')
                                <div class="mr-4">
                                    <a href="{{ url($prev_episode_url) }}">
                                        <span class="arrow_left mr-2"></span>
                                        Önceki Bölüme Geç
                                    </a>
                                </div>
                            @endif
                            @if ($next_episode_url != 'none')
                                <div>
                                    <a href="{{ url($next_episode_url) }}">
                                        Sonraki Bölüme Geç
                                        <span class="arrow_right ml-2"></span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="justify-content-center">
                        <div class="justify-content-center" style="position: relative;">
                            @foreach ($files as $index => $item)
                                @if ($item->file_type == 'pdf')
                                    <div class="pdf-viewer">
                                        <iframe id="pdfViewer" src = "../../../{{ $item->file }}"
                                            style="max-width: 100%; min-width: 100%; height:800px;" allowfullscreen
                                            webkitallowfullscreen></iframe>
                                    </div>
                                    <button onclick="toggleFullScreen()" class="overlay-button">Tam Ekran</button>
                                @else
                                    @if ($index < 3)
                                        <img id="image_{{ $item->code }}" src="../../../{{ $item->file }}"
                                            class="webtoon-image" alt="Resim {{ $item->code }}{{ $index + 1 }}">
                                    @else
                                        <img id="image_{{ $item->code }}" data-src="../../../{{ $item->file }}"
                                            class="webtoon-image lazy-load"
                                            alt="Resim {{ $item->code }}{{ $index + 1 }}">
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @if ($prev_episode_url != 'none' || $next_episode_url != 'none')
                        <div class="row mt-5 mb-5 next-prev-button">
                            @if ($prev_episode_url != 'none')
                                <div class="mr-4">
                                    <a href="{{ url($prev_episode_url) }}">
                                        <span class="arrow_left mr-2"></span>
                                        Önceki Bölüme Geç
                                    </a>
                                </div>
                            @endif
                            @if ($next_episode_url != 'none')
                                <div>
                                    <a href="{{ url($next_episode_url) }}">
                                        Sonraki Bölüme Geç
                                        <span class="arrow_right ml-2"></span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="anime__details__episodes">
                    @if ($webtoon->season_count > 0)
                        @for ($i = $webtoon->season_count; $i >= 1; $i--)
                            <div class="">

                                <div class=" anime__details__episodes">
                                    <div class="section-title">
                                        <h5>{{ $i }}.sezon</h5>
                                    </div>
                                    <div class="">
                                        @foreach ($webtoon_episodes->where('season_short', $i) as $item)
                                            @if ($item->season_short == $episode->season_short && $item->episode_short == $episode->episode_short)
                                                <a class="a_selected"
                                                    href="{{ url('webtoon/' . $webtoon->short_name . '/' . $i . '/' . $item->episode_short) }}">
                                                    {{ $i }} - {{ $item->episode_short }}.Bölüm -
                                                    {{ $item->name }}
                                                </a>
                                            @else
                                                @if (count($watched) > 0 && $watched->Where('anime_episode_code', $item->code)->first())
                                                    <a style="background-color: green;" class="a_selected"
                                                        href="{{ url('webtoon/' . $webtoon->short_name . '/' . $i . '/' . $item->episode_short) }}">
                                                        {{ $i }} - {{ $item->episode_short }}.Bölüm -
                                                        {{ $item->name }}
                                                    </a>
                                                @else
                                                    <a class=""
                                                        href="{{ url('webtoon/' . $webtoon->short_name . '/' . $i . '/' . $item->episode_short) }}">
                                                        {{ $i }} - {{ $item->episode_short }}.Bölüm -
                                                        {{ $item->name }}
                                                    </a>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @else
                        <div class="col-lg-12 col-md-12 section-title">
                            <h5>Herhangi bir bölüm mevcut değil.</h5>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">

                    <div class="anime__details__review">
                        <div class="section-title">
                            <h5>Yorumlar</h5>
                        </div>
                        @if (count($comments_main) > 0)
                            @foreach ($comments_main as $main_comment)
                                <div class="anime__review__item">
                                    <div class="anime__review__item__pic">
                                        <img src="../../../{{ $main_comment->user_image ?? 'user/img/profile/default.png' }}"
                                            alt="">
                                    </div>
                                    <div class="anime__review__item__text">
                                        <h6>

                                            @if ($main_comment->is_pinned == 1)
                                                <span><i class="fa fa-thumb-tack " aria-hidden="true"></i></span>
                                            @endif

                                            <a style="color:#fff;"
                                                href={{ url('profile?username=' . $main_comment->user_username) }}>
                                                {{ $main_comment->user_name ?? ' not_found' }} </a>
                                            - <span>{{ $main_comment->date }}</span>
                                        </h6>

                                        @if ($main_comment->is_spoiler == 1)
                                            <p hidden id="spoiler_comment{{ $main_comment->code }}">
                                                {{ $main_comment->message }}</p>
                                            <p><a href="javascript:void();"
                                                    id="spoiler_comment_button{{ $main_comment->code }}"
                                                    onclick="showSpoiler('spoiler_comment{{ $main_comment->code }}', 'spoiler_comment_button{{ $main_comment->code }}')">!!
                                                    Spoiler
                                                    görmek için tıklayınız !!</a></p>
                                        @else
                                            <p> {{ $main_comment->message }}</p>
                                        @endif


                                        @if (Auth::user())
                                            <a class="mr-3 ml-3" href="javascript:;" style="color:white; float:right;"
                                                onclick="ReplyComment('AnswerMain{{ $main_comment->code }}','{{ $episode->code }}','0','1','{{ $main_comment->code }}')">
                                                <i class="fa fa-reply" aria-hidden="true"></i> Cevapla
                                            </a>
                                        @endif
                                        @if (Auth::guard('admin')->user() && $commentPinned == 1)
                                            @if ($main_comment->is_pinned == 1)
                                                <a href="javascript:;" onclick="commentPinned('{{ $main_comment->code }}')"
                                                    style="color:white; float:right;">
                                                    <i class="fa fa-thumb-tack " aria-hidden="true"></i> Pini Kaldır
                                                </a>
                                            @else
                                                <a href="javascript:;" onclick="commentPinned('{{ $main_comment->code }}')"
                                                    style="color:white; float:right;">
                                                    <i class="fa fa-thumb-tack " aria-hidden="true"></i> Pinle
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div id="AnswerMain{{ $main_comment->code }}"></div>
                                @foreach ($comments_alt->Where('comment_top_code', $main_comment->code) as $alt_comment)
                                    <div class="blog__details__comment__item blog__details__comment__item--reply">
                                        <div class="anime__review__item__pic">
                                            <img src="../../../{{ $alt_comment->user_image ?? 'user/img/profile/default.png' }}"
                                                alt="">
                                        </div>
                                        <div class="anime__review__item__text">
                                            <h6>
                                                <a style="color:#fff;"
                                                    href={{ url('profile?username=' . $alt_comment->user_username) }}>
                                                    {{ $alt_comment->user_name ?? ' not_found' }} </a>
                                                - <span>{{ $alt_comment->date }}</span>
                                            </h6>
                                            @if ($alt_comment->is_spoiler == 1)
                                                <p hidden id="spoiler_comment{{ $alt_comment->code }}">
                                                    {{ $alt_comment->message }}</p>
                                                <p><a href="javascript:void();"
                                                        id="spoiler_comment_button{{ $alt_comment->code }}"
                                                        onclick="showSpoiler('spoiler_comment{{ $alt_comment->code }}', 'spoiler_comment_button{{ $alt_comment->code }}')">!!
                                                        Spoiler görmek için tıklayınız !!</a></p>
                                            @else
                                                <p> {{ $alt_comment->message }}</p>
                                            @endif

                                            @if (Auth::user())
                                                <a href="javascript:;" style="color:white; float:right;"
                                                    onclick="ReplyComment('AnswerAltMain{{ $alt_comment->code }}','{{ $episode->code }}','0','1','{{ $main_comment->code }}')">
                                                    <i class="fa fa-reply" aria-hidden="true"></i> Cevapla
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="AnswerAltMain{{ $alt_comment->code }}"></div>
                                @endforeach
                            @endforeach
                        @else
                            <p style="color: white;">İlk yorum atan siz olun!</p>
                        @endif

                    </div>
                    @if (Auth::user())
                        <div class="anime__details__form">
                            <div class="section-title">
                                <h5>Yorum Yaz</h5>
                            </div>
                            <form action="{{ route('addNewComment') }}" method="POST">
                                @csrf
                                <div hidden>
                                    <input type="text" name="webtoon_code" value="{{ $webtoon->code }}">
                                    <input type="text" name="content_code" value="{{ $episode->code }}">
                                    <input type="text" name="content_type" value="0">
                                    <input type="text" name="comment_type" value="0">
                                    <input type="text" name="comment_top_code" value="0">
                                </div>
                                <textarea name="message" placeholder="Yorumunuz"></textarea>
                                <div>
                                    <input type="checkbox" id="is_spoiler" name="is_spoiler">
                                    <label for="is_spoiler" style="color: #fff">Spoiler</label>
                                </div>
                                <button type="submit"><i class="fa fa-location-arrow"></i> Gönder</button>
                            </form>
                        </div>
                    @else
                        <div class="anime__details__form">
                            <div class="section-title">
                                <h5>Yorum Yapabilmeniz İçin Giriş Yapmalısınız.</h5>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4 col-md-4 justify-content-end">
                    <div class="anime__details__sidebar">
                        <div class="section-title">
                            <h5>Benzer İçerikler</h5>
                        </div>
                        @foreach ($trend_webtoons as $item)
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <div class="product__item">
                                    <a href="{{ url('webtoon/' . $item->short_name) }}">
                                        <div class="product__item__pic set-bg" data-setbg="../../../{{ $item->image }}">
                                            <div class="ep">{{ $item->score }} / 5</div>
                                            <div class="comment"><i class="fa fa-comments"></i>
                                                {{ $item->comment_count }}
                                            </div>
                                            <div class="view"><i class="fa fa-eye"></i> {{ $item->click_count }} </div>
                                        </div>
                                    </a>
                                    <div class="product__item__text">
                                        <ul>
                                            <li>{{ $item->main_category_name ?? 'Genel' }}</li>
                                        </ul>
                                        <h5><a href="{{ url('webtoon/' . $item->short_name) }}">{{ $item->name }}</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--PDF Ayarları-->
    <script>
        var pdfViewer = document.getElementById('pdfViewer');
        if (pdfViewer) {
            const viewer = new Viewer(document.getElementById('pdfViewer'), {
                inline: true,
                viewed() {
                    viewer.zoomTo(1);
                },
            });


            function toggleFullScreen() {
                var iframe = document.getElementById('pdfViewer');
                if (!document.fullscreenElement) {
                    iframe.requestFullscreen();
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    }
                }
            }
        }
    </script>

    <!-- Yorum ayarları -->
    <script>
        function ReplyComment(commentDiv, content_code, content_type, comment_type, comment_top_code) {
            @if (Auth::user())
                var commentDiv = document.getElementById(commentDiv);
                if (commentDiv.innerHTML == "") {
                    var html = `<div class="blog__details__comment__item blog__details__comment__item--reply">
                                    <div class="anime__details__form">
                                        <form action="{{ route('addNewComment') }}" method="POST">
                                            @csrf
                                            <div hidden>
                                                <input type="text" name="webtoon_code" value="{{ $webtoon->code }}">
                                                <input type="text" name="content_code" value="` + content_code + `">
                                                <input type="text" name="content_type" value="` + content_type + `">
                                                <input type="text" name="comment_type" value="` + comment_type + `">
                                                <input type="text" name="comment_top_code" value="` +
                        comment_top_code + `">
                                            </div>
                                            <textarea name="message" placeholder="Yorumunuz"></textarea>
                                            <div>
                                                <input type="checkbox" id="is_spoiler" name="is_spoiler">
                                                <label for="is_spoiler" style="color: #fff">Spoiler</label>
                                            </div>
                                            <button style="float:right;" type="submit"><i class="fa fa-location-arrow"></i>
                                                Gönder</button>
                                        </form>
                                    </div>
                                </div>`;

                    commentDiv.innerHTML = html;
                } else {
                    commentDiv.innerHTML = "";
                }
            @endif

        }

        function showSpoiler(commentID, buttonID) {
            document.getElementById(commentID).hidden = false;
            document.getElementById(buttonID).hidden = true;
        }
    </script>

    <!--Resimleri Yükleme-->
    <script>
        var isScrollingEnabled = true; // Kontrol mekanizması
        $(document).ready(function() {
            // Sayfa yüklendiğinde ilk 3 resmi görüntüle
            $('img').slice(0, 3).each(function() {
                $(this).attr('src', $(this).data('src')).removeClass('lazy-load');
            });

            // Sayfa aşağı indikçe diğer resimleri görüntüle
            $(window).scroll(function() {
                // Kontrol mekanizması
                if (isScrollingEnabled) {
                    $('img.lazy-load').each(function() {
                        if ($(this).offset().top < $(window).scrollTop() + $(window).height() +
                            200) {
                            $(this).attr('src', $(this).data('src')).removeClass('lazy-load');
                        }
                    });

                    // Son resme geldiğinde okundu olarak işaretle
                    checkLastImage();
                }
            });

            // Kullanıcı kaldığı yerden devam etmek isterse
            // Otomatik olarak kaydedilen konuma git
            goToSavedPosition();
        });
    </script>

    <!--Kaldığı yerden devam etme-->
    <script>
        const autoread = 5000;
        const scrool_cookie = "read_{{ $episode->code }}";

        setInterval(() => {
            if (isScrollingEnabled) {
                saveScrollPosition();
            }
        }, autoread);

        // Konumu çerezlere kaydetme
        function saveScrollPosition() {
            var currentPosition = window.scrollY;
            document.cookie = scrool_cookie + "=" + currentPosition;
        }

        // Kullanıcıyı belirli bir görselin olduğu yere götür
        function goToSavedPosition() {
            var savedPosition = getSavedScrollPosition(scrool_cookie);

            // Eğer kaydedilmiş bir konum varsa
            if (savedPosition !== null) {
                isScrollingEnabled = false; // Kontrol mekanizması
                window.scrollTo(0, savedPosition);
                isScrollingEnabled = true; // Kontrol mekanizması
            }
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

    <!--Son resimde ise okundu olarak işaretleme-->
    <script>
        var is_run = false;
        // Kontrol mekanizması
        function checkLastImage() {
            var lastImage = $('img.webtoon-image:last');


            if (lastImage.length > 0) {
                var lastImageBottom = lastImage.offset().top + lastImage.height();
                var windowBottom = $(window).scrollTop() + $(window).height();

                // Eğer son resme gelindiğinde
                if (lastImageBottom < windowBottom && !is_run) {
                    is_run = true;
                    watchAnime('{{ $episode->code }}'); // Özel işlemi tetikle
                }
            }
        }

        function watchAnime(anime_episode_code) {
            console.log('işaretleme fonksiyonu çalıştı');
            var anime_code = `{{ $webtoon->code }}`;
            @if (Auth::user())

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                });
                $.ajax({
                        type: "POST",
                        url: '{{ route('index_watched_anime') }}',
                        data: {
                            anime_episode_code: anime_episode_code,
                            anime_code: anime_code,
                            content_type: 0,
                            only_watch: 1,
                        }
                    })
                    .done(function(response) {
                        if (response.response === 0) {
                            console.log('İşlem İçin Giriş Yapılması Gerekmektedir.');
                        } else if (response.response === 1) {
                            console.log("Bölüm izlendi olarak işaretlendi");
                        } else if (response.response === 2) {
                            console.log("Bölüm izlenmedi olarak işaretlendi");
                        } else if (response.response === 3) {
                            console.log("Zaten izlendi olarak işaretlenmişti");
                        } else {
                            console.log('Bölüm izlendi olarak işaretlenirken beklenmedik bir hata meydana geldi');
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('AJAX hatası: ' + textStatus + ' - ' + errorThrown + ' - ' + JSON.stringify(jqXHR));
                    });
            @else
                console.log("İlk Önce Giriş yapmanız gerekmektedir.")
            @endif
        }
    </script>

    <!--Diğer Ayarlar-->
    <script>
        @if (Auth::guard('admin')->user() && $commentPinned == 1)
            function commentPinned(code) {
                var url = `/admin/comment/pinned?code=` + code;
                var type = "_self"
                window.open(url, type);
            }
        @endif
    </script>
@endsection
