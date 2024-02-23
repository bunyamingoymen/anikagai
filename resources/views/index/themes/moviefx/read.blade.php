@extends('index.themes.moviefx.layouts.main')
@section('index_content')
    <style>
        .comment-textarea {
            background-color: #111216;
            font-size: 13px;
            line-height: 1.9;
            color: #fff;
            font-family: circular, -apple-system, BlinkMacSystemFont, segoe ui, helvetica neue, Arial, sans-serif;
            border: 1px solid #1e2029;
            padding: 10px 15px;
            border-radius: 2px;
            box-shadow: none;
            display: block;
            height: auto;
            overflow: auto;
            cursor: text;
            margin-bottom: 1em;
            padding-right: 40px;
            width: 100%;
        }
    </style>

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
            width: 95%;
            position: relative;
            left: 20%;
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
                margin-bottom: 15px;
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <div class="inner-content container" id="page-series_detail">
        <div id="router-view">
            <div class="bg-cover-faker">
                <!--Üst yol daki temel bilgiler-->
                <div class="ui grid">
                    <!--İsim -->
                    <div class="left floated left aligned sixteen wide tablet nine wide computer column pb-0">
                        <div class="just-watching" data-season="1" data-episode="3">
                            <div class="Breadcrumb">
                                <span>
                                    <a href="{{ url('webtoon/' . $webtoon->short_name) }}"
                                        title="{{ $webtoon->name }} izle">{{ $webtoon->name }}</a>
                                </span> &gt; <span>
                                </span> &gt; {{ $episode->season_short }}. Sezon {{ $episode->episode_short }}.
                                Bölüm ({{ $episode->name }})
                            </div>
                        </div>
                    </div>
                    <!--Tarih-->
                    <div class="right floated right aligned six wide column computer only pb-0">
                        <div class="media-date">
                            <span>{{ $episode->date }}</span>
                        </div>
                    </div>
                </div>

                <!--İsim-->
                <div class="ui grid mt-0">
                    <div class="left floated sixteen wide tablet sixteen wide computer column">
                        <h1 class="page-title"><a href="../../after-the-party.html" style="display:inline-block;"
                                title="{{ $webtoon->name }} izle">{{ $webtoon->name }}</a> <span
                                class="light-title">{{ $episode->season_short }}. Sezon {{ $episode->episode_short }}.
                                Bölüm</span></h1>
                    </div>
                </div>
                <!--Önceki, sonraki bölüm-->
                <div id="series-tabs" class="ui pointing secondary menu">
                    <a class="ui pointing item active" href="#" class="item"><i
                            class=" en mr-xs"></i>{{ $webtoon->name }} Oku</a>
                    @if ($next_episode_url && $next_episode_url != 'none')
                        <a href="{{ url($next_episode_url) }}" class="item navigate navigate-prev right">
                            Önceki Bölüm </a>
                    @endif
                    @if ($next_episode_url && $next_episode_url != 'none')
                        <a
                            href="{{ url($next_episode_url) }}"class="item navigate navigate-next !($prev_episode_url && $prev_episode_url != 'none') ? 'right' : ''">
                            Sonraki Bölüm
                        </a>
                    @endif
                </div>

                <!--Okuma kısmı-->
                <div class="ui grid">
                    <div class="left floated left aligned column pb-0 twelve wide computer sixteen wide mobile"
                        id="playersol">
                        <div class="justify-content-center" style="position: relative;">
                            @foreach ($files as $item)
                                @if ($item->file_type == 'pdf')
                                    <iframe id="myIframe" src="{{ url($item->file) }}"
                                        style="max-width: 100%; min-width: 100%; height:800px;" frameborder="0"
                                        allowfullscreen></iframe>
                                    <button onclick="toggleFullScreen()" class="overlay-button">Tam Ekran</button>
                                @else
                                    <img src="{{ url($item->file) }}" alt="{{ $item->code }}" class="webtoon-image">
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!--Bölümler-->
                <div class="player-seasons">
                    @if ($webtoon->season_count > 0)
                        <div class="swiper-container" id="season-episode-silder">
                            <div class="season-info">
                                <ul>
                                    @for ($i = 1; $i <= $webtoon->season_count; $i++)
                                        <li id="season_{{ $i }}_tab_button"
                                            class="{{ $episode->season_short == $i ? 'active' : '' }}"
                                            onclick="changeSeason('season_{{ $i }}_tab_button','season_{{ $i }}_tab')">
                                            {{ $i }}.sezon</li>
                                    @endfor
                                </ul>
                            </div>
                            <div class="swiper-wrapper">
                                @foreach ($webtoon_episodes as $item)
                                    @if ($episode->season_short == $item->season_short)
                                        <div
                                            class="swiper-slide ss-episode season_regular season_{{ $item->season_short }}_tab">
                                        @else
                                            <div class="season_{{ $item->season_short }}_tab" hidden>
                                    @endif

                                    <div class="episode-container">
                                        <a href="{{ url('webtoon/' . $webtoon->short_name . '/' . $item->season_short . '/' . $item->episode_short) }}"
                                            class="episode-link">
                                            <h3>{{ $item->episode_short }}.Bölüm</h3>
                                            <small class="truncate">{{ $item->name }}</small>
                                            <date datetime="{{ $item->publish_date }}">{{ $item->publish_date }}
                                            </date>
                                        </a>
                                    </div>
                            </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            @endif
        </div>
    </div>
    <div class="bg-cover-bg"><img src="{{ url($webtoon->image) }}" /></div>
    <div class="common-lists">
        <div class="new-content">
            <h4 class="sidebar-heading">Genel Bakış</h4>
            <section class="episode-controls">
                <div class="show-info">
                    <div>
                        <img src="{{ url($webtoon->image) }}" alt="{{ $webtoon->name }}">
                        <div class="series-name">
                            <a href="../../after-the-party.html" title="{{ $webtoon->name }} izle">
                                <h2>{{ $webtoon->name }}</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="episode-overview">
                <div class="info-section">
                    <article>
                        {{ $episode->description ?? 'Açıklama Mevcut Değil' }}
                    </article>
                    <br>
                </div>
            </section>
        </div>
        <!--Yorum Alanı-->
        <div class="ui">
            <h4 class="sidebar-heading">Yorumlar (<span id="review-count">{{ $webtoon->comment_count }}</span>)
            </h4>
            @if (Auth::user())
                <div class="alert alert-danger" role="alert">
                    <div>
                        <div>Yeni Yorum Yaz: </div>
                        <br>
                    </div>
                    <form action="{{ route('addNewComment') }}" method="POST">
                        @csrf
                        <div hidden>
                            <input type="text" name="webtoon_code" value="{{ $webtoon->code }}">
                            <input type="text" name="content_code" value="{{ $episode->code }}">
                            <input type="text" name="content_type" value="1">
                            <input type="text" name="comment_type" value="0">
                            <input type="text" name="comment_top_code" value="0">
                        </div>
                        <textarea class="comment-textarea" name="message" placeholder="Yorumunuz" cols="100" rows="5"></textarea>
                        <div>
                            <button type="submit" class="ui button secondary" style="float:right;"><i
                                    class="fa fa-location-arrow"></i>
                                Gönder</button>
                            <br><br>
                        </div>
                    </form>

                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    Yorum yapabilmeki için <a href="javascript:;" onclick="login();">Giriş Yapmanız</a>
                    gerekmektedir.
                </div>
            @endif
            @if (count($comments_main) == 0)
                <h4 style="color: white;"> İlk Yorum Yapan Siz Olun</h4>
            @else
            @endif
            <section class="user-reviews">
                <div class="ui list" id="review-list">
                    @foreach ($comments_main as $main_comment)
                        <div class="item comment-item">
                            <img class="ui avatar image" alt="{{ $main_comment->user_username }}"
                                src="{{ url($main_comment->user_image ?? 'user/img/profile/default.png') }}" />
                            <div class="content">
                                <h6><a href="{{ url('profile?username=' . $main_comment->user_username) }}"
                                        class="review-author"
                                        title="{{ '@' . $main_comment->user_username }} Profilini Görüntüle">{{ '@' . $main_comment->user_username }}</a>
                                </h6>
                                <div class="review-time">{{ $main_comment->date }}</div>
                                <div class="review-content">
                                    <p>
                                        {{ $main_comment->message }}
                                    </p>
                                </div>
                                <div class="review-extras">
                                    <div class="flex-row buttons">
                                        <a href="javasciprt:;" class="reply-link"
                                            onclick="ReplyComment('AnswerMain{{ $loop->index }}','{{ $episode->code }}','1','1','{{ $main_comment->code }}')">
                                            <i class="fa fa-reply" aria-hidden="true"></i>
                                            Cevapla
                                        </a>
                                    </div>
                                    <div id="AnswerMain{{ $loop->index }}"></div>
                                    @foreach ($comments_alt->Where('comment_top_code', $main_comment->code) as $alt_comment)
                                        <div class="ui list sub-reviews">
                                            <div class="item comment-item">
                                                <img class="ui avatar image lazy-wide" referrerpolicy="no-referrer"
                                                    src="{{ url($alt_comment->user_image ?? 'user/img/profile/default.png') }}"
                                                    alt="{{ $alt_comment->user_username }}" />
                                                <div class="content">
                                                    <h6><a href="{{ url('profile?username=' . $alt_comment->user_username) }}"
                                                            class="review-author " title>{{ $alt_comment->user_name }}</a>
                                                    </h6>
                                                    <div class="review-time">{{ $alt_comment->date }}</div>
                                                    <div class="review-content">
                                                        <p>{{ $alt_comment->message }}</p>
                                                    </div>
                                                    <div class="review-extras">
                                                        <div class="flex-row buttons">
                                                            <button class="ui button fnc_addFeel"
                                                                onclick="ReplyComment('AnswerAltMain{{ $loop->index }}','{{ $episode->code }}','1','1','{{ $main_comment->code }}')">
                                                                <i class="fa fa-reply" aria-hidden="true"></i>
                                                                Reply
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="AnswerAltMain{{ $loop->index }}"></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
    </div>
    </div>

    <!--JS İçin Gerekli Değişkenler-->
    <script>
        //Bölüm ayarları için gerekli değişkenler
        var default_selected_button_div = "season_{{ $episode->season_short }}_tab_button";
        var default_selected_tab_div = "season_{{ $episode->season_short }}_tab";
    </script>

    <!--Bölüm Ayarları-->
    <script>
        @if ($webtoon->season_count > 0)
            var swip = new Swiper("#season-episode-silder", {
                spaceBetween: 0,
                noSwiping: !1,
                freeMode: !0,
                freeModeMomentum: !0,
                freeModeMomentumRatio: 0.5,
                freeModeMomentumVelocityRatio: 1,
                freeModeMomentumBounce: !1,
                freeModeSticky: !1,
                watchSlidesProgress: !0,
                touchStartPreventDefault: !0,
                touchStartForcePreventDefault: !0,
                mousewheel: {
                    invert: !1,
                    sensitivity: 1
                },
                slidesPerView: "auto",
                simulateTouch: !0,
            })

            function changeSeason(selected_tab_button_id, selected_tab_id) {
                document.getElementById(default_selected_button_div).classList.remove("active");
                document.getElementById(selected_tab_button_id).classList.add("active");

                var selected_tabs = document.getElementsByClassName(selected_tab_id);

                for (let i = 0; i < selected_tabs.length; i++) {
                    selected_tabs[i].hidden = false;
                    selected_tabs[i].classList.add('swiper-slide');
                    selected_tabs[i].classList.add('ss-episode');
                    selected_tabs[i].classList.add('season_regular');
                }

                var default_tabs = document.getElementsByClassName(default_selected_tab_div);
                for (let i = 0; i < default_tabs.length; i++) {
                    default_tabs[i].hidden = true;
                    default_tabs[i].classList.remove('swiper-slide');
                    default_tabs[i].classList.remove('ss-episode');
                    default_tabs[i].classList.remove('season_regular');
                }

                default_selected_button_div = selected_tab_button_id;
                default_selected_tab_div = selected_tab_id;
            }
        @endif
    </script>

    <!-- Yorum ayarları -->
    <script>
        function ReplyComment(commentDiv, content_code, content_type, comment_type, comment_top_code) {
            var commentDiv = document.getElementById(commentDiv);
            if (commentDiv.innerHTML == "") {
                var html = `<div class="ui list sub-reviews">
                    <div class="item comment-item">
                        <form action="{{ route('addNewComment') }}" method="POST">
                            @csrf
                            <div hidden>
                                <input type="text" name="webtoon_code" value="{{ $webtoon->code }}">
                                <input type="text" name="content_code" value="` + content_code + `">
                                <input type="text" name="content_type" value="` + content_type + `">
                                <input type="text" name="comment_type" value="` + comment_type + `">
                                <input type="text" name="comment_top_code" value="` + comment_top_code + `">
                            </div>
                            <textarea class="comment-textarea" name="message" placeholder="Yorumunuz" cols="100" rows="5"></textarea>
                            <button class="ui button secondary" style="float:right;" type="submit"><i class="fa fa-location-arrow"></i>
                                Gönder</button>
                        </form>
                    </div>
                </div>`;

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
