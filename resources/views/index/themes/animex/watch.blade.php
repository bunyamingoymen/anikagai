@extends('index.themes.animex.layouts.main')
@section('index_content')
    <style>
        /* Video konteynerini pozisyonlandırma */

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap');

        .next-prev-button {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .next-prev-button div a {
            background-color: var(--second-color);
            opacity: 0.7;
            color: white;
            border-radius: 10px;
            padding: 4px 15px !important;

            border: 2px solid rgba(175, 175, 175, 0.3);
            box-shadow: 0 2px 10px var(--second-color);
            ;
            transition: opacity 0.3s ease, transform 0.1s ease, border 0.3s ease;
            font-family: 'Roboto', sans-serif !important;
            display: flex;
            align-items: center;
        }

        .next-prev-button div a:hover {
            opacity: 1;
        }

        @media only screen and (max-width: 479px) {
            .next-prev-button div a {
                font-size: 14px;
            }
        }

        /*
                                                                                                                                            .custom-play-button-rewind {
                                                                                                                                                position: absolute;
                                                                                                                                                top: 47%;
                                                                                                                                                left: 40%;
                                                                                                                                                transform: translate(-50%, -50%);
                                                                                                                                                z-index: 10;
                                                                                                                                                background-color: transparent;
                                                                                                                                                color: white;
                                                                                                                                                border: none;
                                                                                                                                                border-radius: 50%;
                                                                                                                                                width: 45px;
                                                                                                                                                height: 45px;
                                                                                                                                                display: flex;
                                                                                                                                                justify-content: center;
                                                                                                                                                align-items: center;
                                                                                                                                                cursor: pointer;
                                                                                                                                                font-size: 24px;
                                                                                                                                            }

                                                                                                                                            .custom-play-button-fast {
                                                                                                                                                position: absolute;
                                                                                                                                                top: 47%;
                                                                                                                                                left: 60%;
                                                                                                                                                transform: translate(-50%, -50%);
                                                                                                                                                z-index: 10;
                                                                                                                                                background-color: transparent;
                                                                                                                                                color: white;
                                                                                                                                                border: none;
                                                                                                                                                border-radius: 50%;
                                                                                                                                                width: 45px;
                                                                                                                                                height: 45px;
                                                                                                                                                display: flex;
                                                                                                                                                justify-content: center;
                                                                                                                                                align-items: center;
                                                                                                                                                cursor: pointer;
                                                                                                                                                font-size: 24px;
                                                                                                                                            }

                                                                                                                                            .control-button {
                                                                                                                                                transition: opacity 0.5s ease-in-out;
                                                                                                                                                opacity: 0;
                                                                                                                                                visibility: hidden;
                                                                                                                                            }

                                                                                                                                            .control-button.show {
                                                                                                                                                opacity: 1;
                                                                                                                                                visibility: visible;
                                                                                                                                            }
                                                                                                                                                */
    </style>

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('index') }}"><i class="fa fa-home"></i> Anasayfa</a>
                        <a href="{{ route('anime_list') }}">Animeler</a>
                        <a href="{{ route('animeDetail', ['short_name' => $anime->short_name]) }}">{{ $anime->name }}</a>
                        <span>{{ $episode->season_short . '.S ' . $episode->episode_short . '.B' }}
                            {{ $episode->name ? ' - ' . $episode->name : '' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <section class="anime-details spad">
        <div class="container">
            <div class="row">
                <!--İzlenme-->
                <div class="col-lg-12">
                    <div class="anime__details__review">
                        <div class="section-title" {{ $anime->plusEighteen == '0' ? 'hidden' : '' }}>
                            <h5 style="color:#e53637">+18</h5>
                        </div>
                    </div>

                    <div class="anime__video__player">
                        @if ($episode->is_url == 0)
                            <video id="anime-video-player-url" class="plyr" playsinline controls
                                data-poster="{{ url($anime->thumb_poster ?? $anime->thumb_image) }}">
                                <source src="{{ asset('storage/' . $episode->video) }}" type="video/mp4" size="1080" />
                            </video>
                        @elseif ($episode->is_url == 1)
                            <video id="anime-video-player-url" class="plyr" playsinline controls
                                data-poster="{{ url($anime->thumb_poster ?? $anime->thumb_image) }}">
                                <source src="{{ $episode->video }}" type="video/mp4" size="1080" />
                            </video>
                        @else
                            {!! $episode->video !!}
                        @endif

                        <button id="rewind-button" class="custom-play-button-rewind control-button show" hidden><img
                                src="{{ url('index/img/icon/rewind.svg') }}" alt=""></button>
                        <button id="fast-button" class="custom-play-button-fast control-button show" hidden><img
                                src="{{ url('index/img/icon/fast.svg') }}" alt=""></button>


                        @if ($prev_episode_url != 'none' || $next_episode_url != 'none')
                            <div class="col-lg-12 row mt-2 next-prev-button">
                                @if ($prev_episode_url != 'none')
                                    <div class="float-left">
                                        <a href="{{ url($prev_episode_url) }}">
                                            <span class="arrow_left mr-2"></span>
                                            Önceki Bölüm
                                        </a>
                                    </div>
                                @else
                                    <div class="float-right"></div> <!-- Boş div ekle -->
                                @endif
                                @if ($next_episode_url != 'none')
                                    <div class="float-right">
                                        <a href="{{ url($next_episode_url) }}">
                                            Sonraki Bölüm
                                            <span class="arrow_right ml-2"></span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <!--Bölümler-->
                <div class="col-lg-8">

                    @php
                        $season_count = $anime_episodes->max('season_short');
                        $series_episodes = $anime_episodes;
                        $show_checkbox = false;
                        $episode_type = 'anime';
                        $short_name = $anime->short_name;
                    @endphp

                    @include('index.themes.animex.layouts.sections.episodes')
                </div>
            </div>

            <!--Yorumlar ve Benzer içerikler-->
            <div class="row">
                <!--Yorumlar-->
                <div class="col-lg-8">
                    <div class="anime__details__review">
                        <div class="section-title">
                            <h5>Yorumlar</h5>
                        </div>
                        @if (count($comments_main) > 0)
                            @foreach ($comments_main as $main_comment)
                                <div class="anime__review__item">
                                    <div class="anime__review__item__pic">
                                        <img src="{{ url($main_comment->user_image ?? 'user/img/profile/default.png') }}"
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

                                            <div style="float:right;">
                                                @php
                                                    $liked = $like_comments
                                                        ->where('comment_code', $main_comment->code)
                                                        ->first()
                                                        ? $like_comments
                                                            ->where('comment_code', $main_comment->code)
                                                            ->first()->like_type
                                                        : -1;

                                                @endphp
                                                <span class="mr-1 ml-1">
                                                    <span>{{ $main_comment->like_count }}</span>
                                                    <span class="mr-1 ml-1"
                                                        onclick="{{ $liked == 1 ? 'likeRecallComment(' . $main_comment->code . ')' : 'likeComment(1,' . $main_comment->code . ')' }}"
                                                        style="cursor: pointer;">
                                                        <i class="fa fa-thumbs-up" aria-hidden="true"
                                                            style="{{ $liked == 1 ? 'color:green;' : '' }}"></i>
                                                    </span>
                                                </span>
                                                <span class="mr-1 ml-1">
                                                    <span>{{ $main_comment->unlike_count }}</span>
                                                    <span class="mr-1 ml-1"
                                                        onclick="{{ $liked == 0 ? 'likeRecallComment(' . $main_comment->code . ')' : 'likeComment(0,' . $main_comment->code . ')' }}"
                                                        style="cursor: pointer;">
                                                        <i class="fa fa-thumbs-down " aria-hidden="true"
                                                            style="{{ $liked == 0 ? 'color:red;' : '' }}"></i>
                                                    </span>
                                                </span>

                                            </div>
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
                                                onclick="ReplyComment('AnswerMain{{ $main_comment->code }}','{{ $episode->code }}','1','1','{{ $main_comment->code }}')">
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
                                        @if (Auth::user() && Auth::user()->code == $main_comment->index_user_code)
                                            <a class="mr-3 ml-3" href="javascript:;"
                                                onclick="deleteComment('{{ $main_comment->code }}', '{{ $main_comment->index_user_code }}')"
                                                style="color:white; float:right;">
                                                <i class="fa fa-trash " aria-hidden="true"></i> Sil
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div id="AnswerMain{{ $main_comment->code }}"></div>
                                @foreach ($comments_alt->Where('comment_top_code', $main_comment->code) as $alt_comment)
                                    <div class="blog__details__comment__item blog__details__comment__item--reply">
                                        <div class="anime__review__item__pic">
                                            <img src="{{ url($alt_comment->user_image ?? 'user/img/profile/default.png') }}"
                                                alt="">
                                        </div>
                                        <div class="anime__review__item__text">
                                            <h6>
                                                <a style="color:#fff;"
                                                    href={{ url('profile?username=' . $alt_comment->user_username) }}>
                                                    {{ $alt_comment->user_name ?? ' not_found' }} </a>
                                                - <span>{{ $alt_comment->date }}</span>

                                                <div style="float:right;">
                                                    @php
                                                        $liked = $like_comments
                                                            ->where('comment_code', $alt_comment->code)
                                                            ->first()
                                                            ? $like_comments
                                                                ->where('comment_code', $alt_comment->code)
                                                                ->first()->like_type
                                                            : -1;

                                                    @endphp
                                                    <span class="mr-1 ml-1">
                                                        <span>{{ $alt_comment->like_count }}</span>
                                                        <span class="mr-1 ml-1"
                                                            onclick="{{ $liked == 1 ? 'likeRecallComment(' . $alt_comment->code . ')' : 'likeComment(1,' . $alt_comment->code . ')' }}"
                                                            style="cursor: pointer;">
                                                            <i class="fa fa-thumbs-up" aria-hidden="true"
                                                                style="{{ $liked == 1 ? 'color:green;' : '' }}"></i>
                                                        </span>
                                                    </span>
                                                    <span class="mr-1 ml-1">
                                                        <span>{{ $alt_comment->unlike_count }}</span>
                                                        <span class="mr-1 ml-1"
                                                            onclick="{{ $liked == 0 ? 'likeRecallComment(' . $alt_comment->code . ')' : 'likeComment(0,' . $alt_comment->code . ')' }}"
                                                            style="cursor: pointer;">
                                                            <i class="fa fa-thumbs-down " aria-hidden="true"
                                                                style="{{ $liked == 0 ? 'color:red;' : '' }}"></i>
                                                        </span>
                                                    </span>

                                                </div>
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
                                                    onclick="ReplyComment('AnswerAltMain{{ $alt_comment->code }}','{{ $episode->code }}','1','1','{{ $main_comment->code }}')">
                                                    <i class="fa fa-reply" aria-hidden="true"></i> Cevapla
                                                </a>
                                            @endif
                                            @if (Auth::user() && Auth::user()->code == $alt_comment->index_user_code)
                                                <a class="mr-3 ml-3" href="javascript:;"
                                                    onclick="deleteComment('{{ $alt_comment->code }}', '{{ $alt_comment->index_user_code }}')"
                                                    style="color:white; float:right;">
                                                    <i class="fa fa-trash " aria-hidden="true"></i> Sil
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
                                    <input type="text" name="anime_code" value="{{ $anime->code }}">
                                    <input type="text" name="content_code" value="{{ $episode->code }}">
                                    <input type="text" name="content_type" value="1">
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
                <!--Benzer içerikler-->
                <div class="col-lg-4 col-md-4 justify-content-end">
                    <div class="anime__details__sidebar">
                        <div class="section-title">
                            <h5>Benzer İçerikler</h5>
                        </div>
                        @foreach ($trend_animes as $item)
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <div class="product__item">
                                    <a href="{{ url('anime/' . $item->short_name) }}">
                                        <div class="product__item__pic set-bg"
                                            data-setbg="{{ url($item->thumb_image) }}">
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
                                        <h5><a href="{{ url('anime/' . $item->short_name) }}">{{ $item->name }}</a>
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

    <!-- hls.js -->
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

    <!-- İzleme ile ilgili fonksiyonlar -->
    <script>
        var is_send = false;

        function watchAnime(anime_episode_code) {
            var anime_code = `{{ $anime->code }}`;
            @if (Auth::user())
                if (!is_send) {
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
                                content_type: 1,
                                just_watch: 1,
                            }
                        })
                        .done(function(response) {
                            is_send = true;
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
                            console.log('AJAX hatası: ' + textStatus + ' - ' + errorThrown + ' - ' + JSON.stringify(
                                jqXHR));
                        });
                }
            @else
                alert("İlk Önce Giriş yapmanız gerekmektedir.")
                document.getElementById(id).checked = false;
            @endif
        }
    </script>

    <!-- Video Ayarları -->
    <script>
        @if ($episode->show_intro_button == 1)
            var showIntroButtonTime = 60 * {{ $episode->intro_start_time_min ?? 0 }} +
                {{ $episode->intro_start_time_sec ?? 0 }}; // İntro Başlangıç zamanı

            var endIntroButtonTime = 60 * {{ $episode->intro_end_time_min ?? 0 }} +
                {{ $episode->intro_end_time_sec ?? 1 }}; // intro bitiş zamanı
        @endif

        @if ($next_episode_url != 'none' && $episode->show_next_episode_button == 1)
            var showNextEpisodeButtonTime = 60 * {{ $episode->next_episode_time_min ?? 0 }} +
                {{ $episode->next_episode_time_sec ?? 0 }};
        @endif

        var video_time = 60 * {{ $episode->video_minute ?? 0 }} + {{ $episode->video_second ?? 0 }};
        var watch_time = video_time * 0.90;

        var is_watch = {{ $is_watched ? 'true' : 'false' }};

        //plyr de gösterilecek kontroller
        var controls = [
            'play-large', // ortadaki büyük başlat tuşu
            'play', // alttaki başlat tuşu
            'progress', // İlerleme Bölümü
            'current-time', // Şu anki zaman
            'duration', // Toplam zaman
            'mute', // Ses kapatma
            'volume', // Ses kontrol
            'rewind', // Rewind by the seek time (default 10 seconds)
            'fast-forward', // Fast forward by the seek time (default 10 seconds)
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

        var language = {
            restart: 'Yeniden başlat',
            rewind: 'Geri sar {seektime} saniye',
            play: 'Oynat',
            pause: 'Duraklat',
            fastForward: 'İleri sar {seektime} saniye',
            seek: 'Ara',
            seekLabel: '{currentTime} / {duration}',
            played: 'Oynatıldı',
            buffered: 'Tamponlandı',
            currentTime: 'Şu anki zaman',
            duration: 'Süre',
            volume: 'Ses',
            mute: 'Sessize al',
            unmute: 'Sesi aç',
            enableCaptions: 'Altyazıyı etkinleştir',
            disableCaptions: 'Altyazıyı devre dışı bırak',
            download: 'İndir',
            enterFullscreen: 'Tam ekran yap',
            exitFullscreen: 'Tam ekrandan çık',
            frameTitle: 'Player for {title}',
            captions: 'Altyazılar',
            settings: 'Ayarlar',
            menuBack: 'Geri',
            speed: 'Hız',
            normal: 'Normal',
            quality: 'Kalite',
            loop: 'Döngü',
            start: 'Başlangıç',
            end: 'Bitiş',
            all: 'Tümü',
            reset: 'Sıfırla',
            disabled: 'Devre dışı',
            advertisement: 'Reklam',
            qualityBadge: {
                1080: 'HD',
                480: 'SD',
            }
        }

        //plyr kütüphanesi elemanları
        document.addEventListener('DOMContentLoaded', function() {

            //Player'ı tanımlamak
            var player = new Plyr('#anime-video-player-url', {
                controls: controls,
                settings: settings,
                tooltips: tooltips,
                storage: {
                    enabled: true,
                    key: 'plyr_{{ $episode->code }}'
                },
                seekTime: 10, // Sets the seek time to 10 seconds
                i18n: language,
            });

            //İleri ve geri butonlarının görünümlerini ayarlar
            if (true) {
                document.querySelector('.plyr__controls__item[data-plyr="rewind"]').innerHTML =
                    '<i class="fas fa-undo-alt"></i>';
                document.querySelector('.plyr__controls__item[data-plyr="fast-forward"]').innerHTML =
                    '<i class="fas fa-undo-alt" style="-webkit-transform: scaleX(-1); transform: scaleX(-1);"></i>';
            }

            @if ($episode->show_intro_button == 1)
                //İntro zamanlarında sorun yoksa introButton oluşturuluyor
                if (endIntroButtonTime > showIntroButtonTime) {
                    var introButton = document.createElement('button');
                    introButton.type = 'button';
                    introButton.id = 'introButton';
                    introButton.className = 'plyr__controls__item overlay-button'; // Plyr kontrol sınıfını ekleyin
                    introButton.innerHTML = 'İntroyu Atla';
                    introButton.hidden = true;
                    introButton.style.display = "none";
                    document.getElementsByClassName('plyr__controls')[0].appendChild(introButton);
                }
            @endif


            //bir sonraki bölüm varsa. Sonraki bölüme atla butonu oluşturuluyor.
            @if ($next_episode_url != 'none' && $episode->show_next_episode_button == 1)
                var nextButton = document.createElement('button');
                nextButton.type = 'button';
                nextButton.id = 'nextEpisodeButton';
                nextButton.className =
                    'plyr__controls__item overlay-button'; // Plyr kontrol sınıfını ekleyin
                nextButton.innerHTML = ' <div> Sonraki Bölüm </div>';
                nextButton.hidden = true;
                nextButton.style.display = "none";
                document.getElementsByClassName('plyr__controls')[0].appendChild(nextButton);
            @endif

            // Video başlatıldığında
            player.on('play', function() {});

            //Video Durdurulduğunda
            player.on('pause', function() {
                //document.querySelector('.plyr__controls__item[data-plyr="rewind"]').hidden = false;

                /*
                document.getElementById('rewind-button').classList.add('show');
                document.getElementById('fast-button').classList.add('show');
                */
            });

            // Kontroller gizlendiğinde tetiklenir
            player.on('controlshidden', () => {
                /*
                document.getElementById('rewind-button').classList.remove('show');
                document.getElementById('fast-button').classList.remove('show');
                */
            });

            // Kontroller gösterildiğinde tetiklenir
            player.on('controlsshown', () => {
                /*
                document.getElementById('rewind-button').classList.add('show');
                document.getElementById('fast-button').classList.add('show');
                */
            });

            /*
            document.querySelector('#rewind-button').addEventListener('click', function() {
                player.currentTime -= 10;
            });

            document.querySelector('#fast-button').addEventListener('click', function() {
                player.currentTime += 10;
            });
            */

            // Video oynatılırken
            player.on('timeupdate', function(event) {
                var currentTime = event.detail.plyr.currentTime; // Geçerli video zamanını al
                if (player.duration != currentTime) {
                    @if ($episode->show_intro_button == 1)
                        // İntro başlangıç zamanı ile bitiş zamanı arassında ise ve daha önce intro butonu gözükmediyse
                        if ((currentTime >= showIntroButtonTime && currentTime <= endIntroButtonTime &&
                                document
                                .getElementById('introButton').style.display == "none")) {

                            showButton('introButton');

                            showControl();

                        } else if (currentTime > endIntroButtonTime && document.getElementById(
                                'introButton')
                            .style.display != "none") {
                            hideButton('introButton');
                        }
                    @endif

                    //bir sonraki bölüm varsa son saniyeler buton gözükür.
                    @if ($next_episode_url != 'none' && $episode->show_next_episode_button == 1)
                        if (showNextEpisodeButtonTime != 0 && showNextEpisodeButtonTime <=
                            currentTime && document.getElementById('nextEpisodeButton').style.display ==
                            "none") {
                            //Eğer Kullanıcı girşi yapmışsa otomatik olarak izlendi olarak işaretleniyor

                            showButton('nextEpisodeButton');

                            showControl();

                        } else if (showNextEpisodeButtonTime > currentTime && document.getElementById(
                                'nextEpisodeButton').style.display != "none") {
                            hideButton('nextEpisodeButton');
                        }
                    @endif



                    if (!is_watch && currentTime <= watch_time) {
                        @if (Auth::user() && count($watched->Where('anime_episode_code', $episode->code)) == 0)
                            watchAnime("{{ $episode->code }}");
                        @endif
                        is_watch = true;
                    }
                }
            });

            //video tam ekran butonuna basıldığında
            player.on('fullscreenchange', (event) => {});

            //video yeniden başlatıldğında
            player.on('restart', function() {
                @if ($episode->show_intro_button == 1)
                    hideButton('introButton');
                @endif

                @if ($next_episode_url != 'none' && $episode->show_next_episode_button == 1)
                    hideButton('nextEpisodeButton');
                @endif
            });

            @if ($episode->show_intro_button == 1)
                // Butonlara tıklandığında
                var introButton = document.getElementById('introButton');

                //introButton tuşu varsa ve ona basılırsa
                if (introButton) {
                    introButton.addEventListener('click', function() {
                        player.currentTime = endIntroButtonTime;
                    });
                }
            @endif

            //bir sonraki bölüm varsa ve ona basılırsa
            @if ($next_episode_url != 'none' && $episode->show_next_episode_button == 1)
                var nextEpisodeButton = document.getElementById('nextEpisodeButton');
                if (nextEpisodeButton) {
                    nextEpisodeButton.addEventListener('click', function() {
                        // Belirlediğiniz linke git
                        window.location.href =
                            '{{ url($next_episode_url) }}'; // bir sonraki bölüm url'i
                    });
                }
            @endif
        });
    </script>

    <!--Video Ayarları Fonksiyonu-->
    <script>
        //Kontrolu 3 saniyeliğine gösterip gizle
        function showControl() {
            document.getElementsByClassName('plyr--video')[0].classList.remove(
                'plyr--hide-controls');
            controlsTimeout = setTimeout(() => {
                document.getElementsByClassName('plyr--video')[0].classList.add(
                    'plyr--hide-controls');
            }, 3000);
        }

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
                                <input type="text" name="anime_code" value="{{ $anime->code }}">
                                <input type="text" name="content_code" value="` + content_code + `">
                                <input type="text" name="content_type" value="` + content_type + `">
                                <input type="text" name="comment_type" value="` + comment_type + `">
                                <input type="text" name="comment_top_code" value="` + comment_top_code + `">
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

    <!--Yorum Beğenme Ayarları-->
    <script>
        function likeComment(like_type, comment_code) {
            @if (Auth::user())
                var html =
                    `<form action='{{ route('likeComment') }}' method="POST" id="likeCommentForm">
                        @csrf
                        <input type="text" name="content_code" value='{{ $anime->code }}'>
                        <input type="text" name="content_episode_code" value='{{ $episode->code }}'>
                        <input type="text" name="content_type" value='1'>
                        <input type="text" name="comment_code" value='${comment_code}'>
                        <input type="text" name="like_type" value='${like_type}'>
                    </form>`;

                document.getElementById('hiddenDiv').innerHTML = html;

                document.getElementById('likeCommentForm').submit();
            @else
                notAuth();
            @endif
        }

        function likeRecallComment(comment_code) {
            @if (Auth::user())
                var html =
                    `<form action='{{ route('likeRecallComment') }}' method="POST" id="likeRecallCommentForum">
                        @csrf
                        <input type="text" name="content_code" value='{{ $anime->code }}'>
                        <input type="text" name="content_episode_code" value='{{ $episode->code }}'>
                        <input type="text" name="content_type" value='1'>
                        <input type="text" name="comment_code" value='${comment_code}'>
                    </form>`;

                document.getElementById('hiddenDiv').innerHTML = html;

                document.getElementById('likeRecallCommentForum').submit();
            @else
                notAuth();
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

        @if (Auth::user())
            //Kullanıcı giriş yaptıysa İşlem Yapabilme
            function deleteComment(code, index_user_code) {

                var auth_code = "{{ Auth::user()->code }}";
                if (auth_code === index_user_code) {
                    Swal.fire({
                        title: 'Emin Misin?',
                        text: 'Bu Yorumu silmek istediğine emin misin?',
                        icon: 'warning',
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'Onayla',
                        denyButtonText: `Vazgeç`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            var html =
                                `<form action='{{ route('deleteComment') }}' method="POST" id="deleteCommentForm"> @csrf`;
                            html += `<input type="text" name="code" value='` + code + `'>`;
                            html += `</form>`

                            document.getElementById('hiddenDiv').innerHTML = html;

                            document.getElementById('deleteCommentForm').submit();
                        }
                    })
                }

            }
        @endif
    </script>
@endsection
