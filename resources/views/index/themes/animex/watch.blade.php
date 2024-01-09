@extends('index.themes.animex.layouts.main')
@section('index_content')
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

        .next-prev-button {
            position: absolute;
            left: 30px;
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
            .next-prev-button div a {
                font-size: 14px;
            }
        }
    </style>


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
                    <div class="anime__video__player justify-content-center">
                        <video id="anime-video-player-url" class="plyr video_size_class" controls crossorigin playsinline
                            poster="../../../{{ $anime->image }}">
                            <source src="../../../{{ $episode->video }}" type="video/mp4" size="720" />
                            <!-- Diğer çözünürlükleri buraya ekleyebilirsiniz -->
                            Your browser does not support the video tag.
                        </video>

                        @if ($next_episode_url != 'none')
                            <button id="nextEpisodeButton" class="overlay-button" style="display:none;" hidden>Sonraki
                                bölüme
                                geç</button>
                        @endif
                        @if ($prev_episode_url != 'none' || $next_episode_url != 'none')
                            <div class="row mt-2 next-prev-button">
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
                </div>
                <!--Bölümler-->
                <div class="anime__details__episodes">
                    @if ($anime->season_count > 0)
                        @for ($i = $anime->season_count; $i >= 1; $i--)
                            <div class="">

                                <div class=" anime__details__episodes">
                                    <div class="section-title">
                                        <h5>{{ $i }}.sezon</h5>
                                    </div>
                                    <div class="">
                                        @foreach ($anime_episodes->where('season_short', $i) as $item)
                                            @if ($item->season_short == $episode->season_short && $item->episode_short == $episode->episode_short)
                                                <a class="a_selected"
                                                    href="{{ url('anime/' . $anime->short_name . '/' . $i . '/' . $item->episode_short) }}">
                                                    {{ $i }} - {{ $item->episode_short }}.Bölüm -
                                                    {{ $item->name }}
                                                </a>
                                            @else
                                                @if (count($watched) > 0 && $watched->Where('anime_episode_code', $item->code)->first())
                                                    <a style="background-color: green;" class="a_selected"
                                                        href="{{ url('anime/' . $anime->short_name . '/' . $i . '/' . $item->episode_short) }}">
                                                        {{ $i }} - {{ $item->episode_short }}.Bölüm -
                                                        {{ $item->name }}
                                                    </a>
                                                @else
                                                    <a class=""
                                                        href="{{ url('anime/' . $anime->short_name . '/' . $i . '/' . $item->episode_short) }}">
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
                                            <a href="javascript:;" style="color:white; float:right;"
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
                                    </div>
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
                                    <p><a href="javascript:void();" id="spoiler_comment_button{{ $alt_comment->code }}"
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
                                <a href="anime/{{ $item->short_name }}">
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
