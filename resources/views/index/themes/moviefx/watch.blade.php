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
        .anime__video__player {
            margin-bottom: 70px;
        }

        .anime__video__player .plyr--video {
            border-radius: 5px;
            background: transparent;
        }

        .anime__video__player .plyr audio,
        .anime__video__player .plyr iframe,
        .anime__video__player .plyr video {
            width: 102%;
        }

        .anime__video__player .plyr--full-ui.plyr--video .plyr__control--overlaid {
            display: block;
        }

        .anime__video__player .plyr--video .plyr__control.plyr__tab-focus,
        .anime__video__player .plyr--video .plyr__control:hover,
        .anime__video__player .plyr--video .plyr__control[aria-expanded=true] {
            background: transparent;
        }

        .anime__video__player .plyr--video .plyr__controls {
            background: transparent;
        }

        .anime__video__player .plyr--video .plyr__progress__buffer {
            color: transparent;
        }



        .anime__video__player .plyr__controls .plyr__controls__item.plyr__progress__container {
            position: absolute;
            left: 26px;
            bottom: 45px;
            width: calc(100% - 60px);
        }

        .anime__video__player .plyr__menu {
            margin-right: 1%;
        }

        .anime__video__player .plyr__controls .plyr__controls__item:first-child {
            position: absolute;
            left: 32px;
            bottom: 8px;
        }

        .anime__video__player .plyr__controls .plyr__controls__item:last-child {
            position: absolute;
            right: 32px;
            bottom: 8px;
        }

        .anime__video__player .plyr__volume {
            position: absolute;
            width: auto;
            left: 176px;
        }

        .anime__video__player .plyr__time--current {
            position: absolute;
            width: auto;
            left: 76px;
        }

        .anime__video__player .plyr__time--duration {
            position: absolute;
            width: auto;
            left: 126px;
        }

        .anime__video__player .plyr__control--overlaid {
            background: transparent;
            background: var(--plyr-video-control-background-hover, var(--plyr-color-main, var(--plyr-color-main, transparent)));
        }

        .anime__video__player .plyr__control--overlaid svg {
            height: 60px;
            width: 50px;
        }

        .video_size_class {
            max-width: 1280px !important;
            max-height: 550px !important;
        }
    </style>

    <style>
        /* Video konteynerini pozisyonlandırma */
        .video-container {
            position: relative;
        }

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap');
        /* Roboto fontunu ekleyin veya
                                                                                                                                                                                                                                                                                        kendi tercih ettiğiniz bir font kullanabilirsiniz */

        .overlay-button {
            position: absolute !important;
            bottom: 75px !important;
            /* Alt kenardan biraz yukarıda */
            right: 25px !important;
            /* Sağ kenardan biraz sola */
            padding: 4px 15px !important;
            background-color: #0b0c2a;
            /* Yarı şeffaf siyah arkaplan */
            color: white;
            border-radius: 8px;
            border: 2px solid rgba(255, 255, 255, 0);
            /* Beyaz yarı şeffaf sınır (border) */
            opacity: 0;
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

        .video_size_class {
            max-width: 1280px !important;
            max-height: 550px !important;
        }


        /* Butonun üzerine gelindiğinde göster */
        .video-container:hover .overlay-button {
            display: block;
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
                                    <a href="{{ url('anime/' . $anime->short_name) }}"
                                        title="{{ $anime->name }} izle">{{ $anime->name }}</a>
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
                                title="{{ $anime->name }} izle">{{ $anime->name }}</a> <span
                                class="light-title">{{ $episode->season_short }}. Sezon {{ $episode->episode_short }}.
                                Bölüm</span></h1>
                    </div>
                </div>
                <!--Önceki, sonraki bölüm-->
                <div id="series-tabs" class="ui pointing secondary menu">
                    <a class="ui pointing item active" href="#" class="item"><i
                            class=" en mr-xs"></i>{{ $anime->name }} İzle</a>
                    @if ($prev_episode_url && $prev_episode_url != 'none')
                        <a href="{{ url($prev_episode_url) }}" class="item navigate navigate-prev right">
                            Önceki Bölüm </a>
                    @endif
                    @if ($next_episode_url && $next_episode_url != 'none')
                        <a
                            href="{{ url($next_episode_url) }}"class="item navigate navigate-next {{ !($prev_episode_url && $prev_episode_url != 'none') ? 'right' : '' }}">
                            Sonraki Bölüm
                        </a>
                    @endif
                </div>

                <!--Video kısmı-->
                <div class="ui grid">
                    <div class="left floated left aligned column pb-0 twelve wide computer sixteen wide mobile"
                        id="playersol">
                        <div class="anime__video__player justify-content-center">
                            <video id="anime-video-player-url" class="plyr video_size_class" controls crossorigin
                                playsinline poster="../../../{{ $anime->image }}">
                                <source src="../../../{{ $episode->video }}" type="video/mp4" size="720" />
                                <!-- Diğer çözünürlükleri buraya ekleyebilirsiniz -->
                                Your browser does not support the video tag.
                            </video>

                            @if ($next_episode_url != 'none')
                                <button id="nextEpisodeButton" class="overlay-button" style="display:none;" hidden>Sonraki
                                    bölüme
                                    geç</button>
                            @endif

                        </div>
                    </div>
                </div>

                <!--Bölümler-->
                <div class="player-seasons">
                    @if ($anime->season_count > 0)
                        <div class="swiper-container" id="season-episode-silder">
                            <div class="season-info">
                                <ul>
                                    @for ($i = 1; $i <= $anime->season_count; $i++)
                                        <li id="season_{{ $i }}_tab_button"
                                            class="{{ $episode->season_short == $i ? 'active' : '' }}"
                                            onclick="changeSeason('season_{{ $i }}_tab_button','season_{{ $i }}_tab')">
                                            {{ $i }}.sezon</li>
                                    @endfor
                                </ul>
                            </div>
                            <div class="swiper-wrapper">
                                @foreach ($anime_episodes as $item)
                                    @if ($episode->season_short == $item->season_short)
                                        <div
                                            class="swiper-slide ss-episode season_regular season_{{ $item->season_short }}_tab">
                                        @else
                                            <div class="season_{{ $item->season_short }}_tab" hidden>
                                    @endif

                                    <div class="episode-container">
                                        <a href="{{ url('anime/' . $anime->short_name . '/' . $item->season_short . '/' . $item->episode_short) }}"
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
    <div class="bg-cover-bg"><img src="../../../{{ $anime->image }}" /></div>
    <div class="common-lists">
        <div class="new-content">
            <h4 class="sidebar-heading">Genel Bakış</h4>
            <section class="episode-controls">
                <div class="show-info">
                    <div>
                        <img src="../../../{{ $anime->image }}" alt="{{ $anime->name }}">
                        <div class="series-name">
                            <a href="../../after-the-party.html" title="{{ $anime->name }} izle">
                                <h2>{{ $anime->name }}</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="episode-overview">
                <div class="info-section">
                    <article>
                        {{ $episode->description ?? '' }}
                    </article>
                    <br>
                </div>
            </section>
        </div>

        <!--Yorum Alanı-->
        <div class="ui">
            <h4 class="sidebar-heading">Yorumlar (<span id="review-count">{{ $anime->comment_count }}</span>)
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
                            <input type="text" name="anime_code" value="{{ $anime->code }}">
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
                                src="../../../{{ $main_comment->user_image ?? 'user/img/profile/default.png' }}" />
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
                                                    src="../../../{{ $alt_comment->user_image ?? 'user/img/profile/default.png' }}"
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

    <!-- İzleme ile ilgili fonksiyonlar -->
    <script>
        function watchAnime(anime_episode_code) {
            var anime_code = `{{ $anime->code }}`;
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
                            content_type: 1
                        }
                    })
                    .done(function(response) {
                        if (response.response === 0) {
                            console.log('İşlem İçin Giriş Yapılması Gerekmektedir.');
                        } else if (response.response === 1) {
                            console.log("Bölüm izlendi olarak işaretlendi");
                        } else if (response.response === 2) {
                            console.log("Bölüm izlenmedi olarak işaretlendi");
                        } else {
                            console.log('Bölüm izlendi olarak işaretlenirken beklenmedik bir hata meydana geldi');
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('AJAX hatası: ' + textStatus + ' - ' + errorThrown + ' - ' + JSON.stringify(jqXHR));
                    });
            @else
                alert("İlk Önce Giriş yapmanız gerekmektedir.")
                document.getElementById(id).checked = false;
            @endif
        }
    </script>

    <!-- Video Ayarları -->
    <script>
        var intro_start_time_min = {{ $episode->intro_start_time_min ?? 0 }}; // intr başlama zamanı dakikası
        var intro_start_time_sec = {{ $episode->intro_start_time_sec ?? 0 }}; // intro başlama saniyesi
        var showIntroButtonTime = 60 * intro_start_time_min + intro_start_time_sec; // İntro Başlangıç zamanı
        var intro_end_time_min = {{ $episode->intro_end_time_min ?? 0 }}; //intro bitiş zamanı dakikası
        var intro_end_time_sec = {{ $episode->intro_end_time_sec ?? 1 }}; //intro bitiş zamanı saniyesi
        var endIntroButtonTime = 60 * intro_end_time_min + intro_end_time_sec; // intro bitiş zamanı

        var is_show_intro_button = false; //Daha önce intryo atla butonu gösterildi mi?
        var is_hide_intro_button = false; //Daha önce introyu atla butonu gizlendi mi?

        var is_show_next_episode_button = false; //Daha önce bir sonraki bölüme atla butonu gösteirldi mi?

        //plyr de gösterilecek kontroller
        var controls = [
            'play-large', // ortadaki büyük başlat tuşu
            'play', // alttaki başlat tuşu
            'progress', // İlerleme Bölümü
            'current-time', // Şu anki zaman
            'duration', // Toplam zaman
            'mute', // Ses kapatma
            'volume', // Ses kontrol
            'settings', // Ayarler menüsü
            'fullscreen', // fullscreen tuşu
        ];

        var settings = [
            'play',
            'captions',
            'quality',
            'speed',
            'loop'
        ];

        var tooltips = {
            controls: false,
            seek: true
        };

        //plyr kütüphanesi elemanları
        document.addEventListener('DOMContentLoaded', function() {


            var player = new Plyr('#anime-video-player-url', {
                controls: controls,
                settings: settings,
                tooltips: tooltips,
                storage: {
                    enabled: true,
                    key: 'plyr_{{ $episode->code }}'
                },
            });

            //introButton oluşturuluyor
            var introButton = document.createElement('button');
            introButton.type = 'button';
            introButton.id = 'introButton';
            introButton.className = 'plyr__controls__item overlay-button'; // Plyr kontrol sınıfını ekleyin
            introButton.innerHTML = 'İntroyu Atla';
            introButton.hidden = true;
            introButton.style.display = "none";
            document.getElementsByClassName('plyr__controls')[0].appendChild(introButton);

            //bir sonraki bölüm varsa. Sonraki bölüme atla butonu oluşturuluyor.
            @if ($next_episode_url != 'none')
                var nextButton = document.createElement('button');
                nextButton.type = 'button';
                nextButton.id = 'nextEpisodeButton';
                nextButton.className = 'plyr__controls__item overlay-button'; // Plyr kontrol sınıfını ekleyin
                nextButton.innerHTML = 'Sonraki Bölüme Geç';
                nextButton.hidden = true;
                nextButton.style.display = "none";
                document.getElementsByClassName('plyr__controls')[0].appendChild(nextButton);
            @endif

            var showNextEpisodeButtonTime = null; // Video süresinin son 10 saniyesi
            var isFullScreen = false; //video tam ekranda mı?

            // Video başlatıldığında / durdurulup-başlatıldığında
            player.on('play', function() {
                showNextEpisodeButtonTime = player.duration - 60;
            });

            // Video oynatılırken
            player.on('timeupdate', function(event) {
                var currentTime = event.detail.plyr.currentTime; // Geçerli video zamanını al

                // İntro başlangıç zamanı ile bitiş zamanı arassında ise ve daha önce intro butonu gözükmediyse
                if ((currentTime >= showIntroButtonTime && currentTime <= endIntroButtonTime) && !
                    is_show_intro_button) {
                    // İntroyu atla butonunu göster
                    showButton('introButton');
                    is_show_intro_button = true;

                    //intro Atla butonunun aktif olduğunu göstermek için control'ü gösteriyoruz. ve 3 saniye sonra gizliyoruz.
                    document.getElementsByClassName('plyr--video')[0].classList.remove(
                        'plyr--hide-controls');
                    controlsTimeout = setTimeout(() => {
                        document.getElementsByClassName('plyr--video')[0].classList.add(
                            'plyr--hide-controls');
                    }, 3000); // 3000 milisaniye (3 saniye) sonra gizle
                }

                //introyu atla butonu daha önce gizlenmediyse ve şu anki zaamn introyu atla zamanını geçtiyse butonu gizler
                if (currentTime > endIntroButtonTime && !is_hide_intro_button) {
                    // İntroyu atla butonunu gizle
                    hideButton('introButton');
                    is_hide_intro_button = true;
                }

                //bir sonraki bölüm varsa son saniyeler buton gözükür.
                //Video son 10 saniyesinde ve daah önce sonraki bölüme geç butonu gösterilmediyse
                if (showNextEpisodeButtonTime !== null && showNextEpisodeButtonTime <= currentTime && !
                    is_show_next_episode_button) {
                    showButton('nextEpisodeButton');
                    //Eğer Kullanıcı girşi yapmışsa otomatik olarak izlendi olarak işaretleniyor
                    @if (Auth::user() && count($watched->Where('anime_episode_code', $episode->code)) == 0)
                        watchAnime("{{ $episode->code }}");
                    @endif

                    @if ($next_episode_url != 'none')
                        is_show_next_episode_button = true;
                        //Sonraki Bölüme Atla butonunun aktif olduğunu göstermek için control'ü gösteriyoruz. ve 3 saniye sonra gizliyoruz.
                        document.getElementsByClassName('plyr--video')[0].classList.remove(
                            'plyr--hide-controls');
                        controlsTimeout = setTimeout(() => {
                            document.getElementsByClassName('plyr--video')[0].classList.add(
                                'plyr--hide-controls');
                        }, 3000); // 3000 milisaniye (3 saniye) sonra gizle
                    @endif
                }


            });

            //video tam ekran butonuna basıldığında
            player.on('fullscreenchange', (event) => {
                if (isFullScreen) {
                    //tam ekrandan çıkıyor
                    isFullScreen = false;
                    document.getElementById('anime-video-player-url').classList.add('video_size_class');

                } else {
                    //tam ekrana giriyor
                    isFullScreen = true;
                    document.getElementById('anime-video-player-url').classList.remove('video_size_class');

                }
            });

            //video yeniden başlatıldğında
            player.on('restart', function() {
                //Video yeniden başlatılırsa introyu atla ve sonraki bölüme atla değerleri sıfırlanması gerekmektedir.
                var is_show_intro_button = false;
                var is_hide_intro_button = false;
                var is_show_next_episode_button = false;

                hideButton('introButton');
                @if ($next_episode_url != 'none')
                    hideButton('nextEpisodeButton');
                @endif
            });

            //sayfa tamamen yüklendiğin
            $(document).ready(function() {
                // Butonlara tıklandığında
                var introButton = document.getElementById('introButton');

                //introButton tuşu varsa ve ona basılırsa
                if (introButton) {
                    introButton.addEventListener('click', function() {
                        player.currentTime = endIntroButtonTime;
                    });
                }

                //bir sonraki bölüm varsa ve ona basılırsa
                @if ($next_episode_url != 'none')
                    var nextEpisodeButton = document.getElementById('nextEpisodeButton');
                    if (nextEpisodeButton) {
                        nextEpisodeButton.addEventListener('click', function() {
                            // Belirlediğiniz linke git
                            window.location.href =
                                '{{ url($next_episode_url) }}'; // bir sonraki bölüm url'i
                        });
                    }
                @endif
            })

            // Butonu göster
            function showButton(buttonId) {
                var button = document.getElementById(buttonId);
                if (button) {
                    opacity = 0;
                    count = 0;
                    button.hidden = false;
                    button.style.display = "block";
                    var old_opacity = button.style.opacity;
                    if (old_opacity == 0) {
                        var animationInterval = setInterval(function() {
                            if (count < 8) {
                                count++;
                                button.style.display = 'block';
                                opacity += 0.1;
                                button.style.opacity = opacity;
                            } else {
                                clearInterval(animationInterval);
                            }
                        }, 10);
                    }

                }
            }

            // Butonu gizle
            function hideButton(buttonId) {
                var button = document.getElementById(buttonId);
                if (button) {
                    button.hidden = true;
                    button.style.display = "none";
                    button.opacity = 0;
                }
            }
        });
    </script>

    <!--Bölüm Ayarları-->
    <script>
        @if ($anime->season_count > 0)
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
                                <input type="text" name="anime_code" value="{{ $anime->code }}">
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
@endsection
