@extends('index.themes.mox.layouts.main')
@section('index_content')
    <link rel="stylesheet" href="{{ url('user/mox/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/aos.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/slick.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/default.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/responsive.css') }}">
    <!-- main-area -->

    <style>
        /* The container */
        .container {
            display: block;
            position: relative;
            padding-left: 25px;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input~.checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked~.checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked~.checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- default styles -->
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all"
        rel="stylesheet" type="text/css" />

    <!-- with v4.1.0 Krajee SVG theme is used as default (and must be loaded as below) - include any of the other theme CSS files as mentioned below (and change the theme property of the plugin) -->
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-fas/theme.css" media="all"
        rel="stylesheet" type="text/css" />

    <!-- important mandatory libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js"
        type="text/javascript"></script>

    <!-- with v4.1.0 Krajee SVG theme is used as default (and must be loaded as below) - include any of the other theme JS files as mentioned below (and change the theme property of the plugin) -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-fas/theme.js"></script>

    <!-- optionally if you need translation for your language then include locale file as mentioned below (replace LANG.js with your own locale file) -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/locales/LANG.js"></script>

    <main>

        <!-- movie-details-area -->
        <section class="movie-details-area" data-background="{{ url('user/mox/img/bg/movie_details_bg.jpg') }}">
            <div class="container">
                <div class="row align-items-center position-relative">
                    <div class="col-xl-3 col-lg-4">
                        <div class="{{ url('user/mox/movie-details-img') }}">
                            <img src="{{ url($anime->image) }}" alt=""
                                style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-8">
                        <div class="movie-details-content">
                            <h2>{{ $anime->name ?? 'not_found' }}</h2>
                            <div class="banner-meta">
                                <ul>
                                    <li class="category">
                                        <a href="#">{{ $anime->main_category_name }}</a>
                                        @foreach ($categories as $item)
                                            <a href="#">{{ $item->name }}</a>
                                        @endforeach

                                    </li>
                                    <li class="release-time">
                                        <span><i class="far fa-calendar-alt"></i> {{ $anime->date }}</span>
                                        <span><i class="far fa-clock"></i>{{ $anime->episode_count }} Bölüm</span>
                                    </li>
                                </ul>
                            </div>
                            <p>
                                {{ $anime->description }}
                            </p>
                            <div class="movie-details-prime">
                                <ul>
                                    <li class="share"><a href="#"><i class="fas fa-share-alt"></i> Paylaş</a></li>
                                    <li class="watch">
                                        @if ($followed)
                                            <a href="javascript:;" class="btn" onclick="unfollowAnime()"><i
                                                    class="fas fa-plus"></i>Takip
                                                Ediliyor</a>
                                        @else
                                            <a href="javascript:;" class="btn" onclick="followAnime()"><i
                                                    class="fas fa-plus"></i>Takip
                                                Et</a>
                                            <p style="color:red;" id="followAnimeTextMessage"></p>
                                        @endif

                                    </li>
                                    <li class=" watch">
                                        @if ($liked)
                                            <a href="javascript:;" class="btn" onclick="dislikeAnime()"><i
                                                    class="fas fa-heart"></i>Favorilere
                                                Eklendi</a>
                                        @else
                                            <a href="javascript:;" class="btn" onclick="likeAnime()"><i
                                                    class="fas fa-heart"></i>Favorilere
                                                Ekle</a>
                                            <p style="color:red;" id="likeAnimeTextMessage"></p>
                                        @endif

                                    </li>
                                    <li class="watch">
                                        <a href="{{ $firstEpisodeUrl != 'none' ? url($firstEpisodeUrl) : '' }}"
                                            class="btn"><i class="fas fa-play"
                                                {{ $firstEpisodeUrl == 'none' ? 'hidden' : '' }}></i>İlk
                                            Bölümü İzle</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="mt-5">
                                <span>{{ $anime->scoreUsers }} Oy Kullanıldı</span>
                                <div class="rating">
                                    <input id="scoreRateID" type="text" class="kv-ltr-theme-fas-star rating-loading"
                                        data-size="sm" value="{{ $anime->score }}" onchange="scoreUser()">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="movie-details-btn">
                        @if (false)
                            <a href="img/poster/movie_details_img.jpg" class="download-btn" download="">İndir <img
                                    src="{{ url('user/mox/fonts/download.svg') }}" alt=""></a>
                        @endif

                    </div>
                </div>
            </div>
        </section>
        <!-- movie-details-area-end -->

        <!-- episode-area -->
        <section class="episode-area episode-bg" data-background="{{ url('user/mox/img/bg/episode_bg.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="movie-episode-wrap">
                            <div class="episode-top-wrap">
                                <div class="section-title">
                                    <h2 class="title">Tüm bölümler</h2>
                                </div>
                                <div class="total-views-count">
                                    <p>{{ $anime->click_count }} <i class="far fa-eye"></i></p>
                                </div>
                            </div>
                            <div class="episode-watch-wrap">
                                <div class="accordion" id="accordionExample">
                                    @if ($anime->season_count > 0)
                                        @for ($i = $anime->season_count; $i >= 1; $i--)
                                            <div class="card">
                                                <div class="card-header " id="heading{{ $i }}">
                                                    <button class="btn-block text-left collapsed" type="button"
                                                        data-toggle="collapse" data-target="#collapse{{ $i }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse{{ $i }}">
                                                        <span class="season">{{ $i }} . sezon</span>
                                                        <span
                                                            class="video-count">{{ count($anime_episodes->where('season_short', $i)) }}
                                                            Bölüm</span>
                                                    </button>
                                                </div>
                                                @if ($i == $anime->season_count)
                                                    <div id="collapse{{ $i }}" class="collapse show"
                                                        aria-labelledby="heading{{ $i }}"
                                                        data-parent="#accordionExample">
                                                    @else
                                                        <div id="collapse{{ $i }}" class="collapse"
                                                            aria-labelledby="heading{{ $i }}"
                                                            data-parent="#accordionExample">
                                                @endif

                                                <div class="card-body">
                                                    <ul>
                                                        @foreach ($anime_episodes->where('season_short', $i) as $item)
                                                            <li>
                                                                <label class="container">
                                                                    <input type="checkbox"
                                                                        id="watched{{ $item->code }}"
                                                                        onchange="watchAnime('{{ $item->code }}')"
                                                                        value="{{ $item->code }}"
                                                                        {{ count($watched) > 0 && $watched->Where('anime_episode_code', $item->code)->first() ? 'checked' : '' }}>
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                @if (count($watched) > 0 && $watched->Where('anime_episode_code', $item->code)->first())
                                                                    <a
                                                                        href="{{ url('anime/' . $anime->short_name . '/' . $i . '/' . $item->episode_short) }}"><i
                                                                            class="fas fa-play"></i>
                                                                        <span style="color:green;"
                                                                            id='watchedATag{{ $item->code }}'>Bölüm
                                                                            {{ $item->episode_short }}</span> </a>
                                                                    <span class="duration"><i class="far fa-clock"></i>
                                                                        {{ $item->minute }}
                                                                        Dakika</span>
                                                                @else
                                                                    <a
                                                                        href="{{ url('anime/' . $anime->short_name . '/' . $i . '/' . $item->episode_short) }}"><i
                                                                            class="fas fa-play"></i>
                                                                        <span style="color:white;"
                                                                            id='watchedATag{{ $item->code }}'>Bölüm
                                                                            {{ $item->episode_short }}</span>

                                                                    </a>
                                                                    <span class="duration"><i class="far fa-clock"></i>
                                                                        {{ $item->minute }}
                                                                        Dakika</span>
                                                                @endif
                                                            </li>
                                                        @endforeach

                                                    </ul>
                                                </div>
                                            </div>
                                </div>
                                @endfor
                            @else
                                <p>Herhangi bir bölüm mevcut değil.</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="episode-img">
                        <img src="{{ url($anime->image) }}" alt=""
                            style="min-width: 413px; min-height: 526px; max-width: 413px; max-height: 526px;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="movie-history-wrap">
                        <h3 class="title"><span>Hikaye</span></h3>
                        <p>
                            {{ $anime->description }}
                        </p>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- episode-area-end -->

        <!-- tv-series-area -->
        <section class="tv-series-area tv-series-bg" data-background="{{ url('user/mox/img/bg/tv_series_bg02.jpg') }}">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center mb-50">
                            <span class="sub-title">En iyileri</span>
                            <h2 class="title">Trend Animeler</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach ($trend_animes as $item)
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="movie-item mb-50">
                                <div class="movie-poster">
                                    <a href="{{ url('anime/' . $item->short_name) }}"><img src="{{ url($item->image) }}"
                                            alt=""
                                            style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;"></a>
                                </div>
                                <div class="movie-content">
                                    <div class="top">
                                        <h5 class="title"><a
                                                href="{{ url('anime/' . $item->short_name) }}">{{ $item->name }}</a>
                                        </h5>
                                        <span class="date">{{ $item->date }}</span>
                                    </div>
                                    <div class="bottom">
                                        <ul>
                                            <li><span class="quality">{{ $item->main_category_name }}</span></li>
                                            <li>
                                                <span class="duration"><i class="far fa-clock"></i>
                                                    {{ $item->average_min }} dk</span>
                                                <span class="rating"><i class="fas fa-thumbs-up"></i>
                                                    {{ $item->score }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- tv-series-area-end -->

        <div id="hiddenDiv" hidden>

        </div>
    </main>
    <!-- main-area-end -->

    <!--Takip Etme/ Beğenme İşlemleri-->
    <script>
        function followAnime() {
            @if (Auth::user())
                var code = `<form action="{{ route('followAnime') }}" method="POST" id="followAnimeForm">
                            @csrf
                            <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                            <input type="text" name="anime_code" value="{{ $anime->code }}">
                        </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('followAnimeForm').submit();
            @else
                document.getElementById('followAnimeTextMessage').innerText = "Lütfen Giriş Yapınız."
            @endif
        }

        function unfollowAnime() {
            @if (Auth::user())
                var code = `<form action="{{ route('unfollowAnime') }}" method="POST" id="unfollowAnimeForm">
                @csrf
                <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                <input type="text" name="anime_code" value="{{ $anime->code }}">
            </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('unfollowAnimeForm').submit();
            @else
                document.getElementById('followAnimeTextMessage').innerText = "Lütfen Giriş Yapınız."
            @endif
        }

        function likeAnime() {
            @if (Auth::user())
                var code = `<form action="{{ route('likeAnime') }}" method="POST" id="likeAnimeForm">
                @csrf
                <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                <input type="text" name="anime_code" value="{{ $anime->code }}">
            </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('likeAnimeForm').submit();
            @else
                document.getElementById('likeAnimeTextMessage').innerText = "Lütfen Giriş Yapınız."
            @endif
        }

        function dislikeAnime() {
            @if (Auth::user())
                var code = `<form action="{{ route('unlikeAnime') }}" method="POST" id="unlikeAnimeForm">
                @csrf
                <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                <input type="text" name="anime_code" value="{{ $anime->code }}">
            </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('unlikeAnimeForm').submit();
            @else
                document.getElementById('likeAnimeTextMessage').innerText = "Lütfen Giriş Yapınız."
            @endif
        }
    </script>

    <!--Oy Kullanma İşlemleri-->
    <script>
        // initialize with defaults
        $("#scoreRateID").rating({
            theme: 'krajee-fas'
        });
        $(".caption").css("display", "none");
        $(".krajee-icon-clear").css("display", "none");
        $(".clear-rating-active").css("display", "none");

        function scoreUser() {
            @if (Auth::user())
                var score = document.getElementById("scoreRateID").value;
                var html = `<form action="{{ route('scoreUser') }}" id="scoreUserSubmitForm" method="POST">
                @csrf
                <input type="text" name="score" value="` + score + `">
                <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                <input type="text" name="content_code" value="{{ $anime->code }}">
                <input type="text" name="content_type" value="1">
            </form>`
                document.getElementById("hiddenDiv").innerHTML = html;
                document.getElementById("scoreUserSubmitForm").submit();
            @else
                document.getElementById("scoreRateID").value = "{{ $anime->score }}"
                Swal.fire({
                    title: "Hata",
                    text: authMessage,
                    color: "#fff",
                    icon: "error"
                });
            @endif
        }
    </script>

    <!-- İzleme ile ilgili fonksiyonlar -->
    <script>
        function watchAnime(anime_episode_code) {
            var id = "watched" + anime_episode_code;
            var anime_code = `{{ $anime->code }}`;
            @if (Auth::user())

                var value = document.getElementById(id).checked;

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
                            document.getElementById('watchedATag' + anime_episode_code).style.color = 'green';
                        } else if (response.response === 2) {
                            console.log("Bölüm izlenmedi olarak işaretlendi");
                            document.getElementById('watchedATag' + anime_episode_code).style.color = 'white';
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
@endsection
