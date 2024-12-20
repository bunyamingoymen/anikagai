@extends('index.themes.animex.layouts.main')
@section('index_content')
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

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('index') }}"><i class="fa fa-home"></i> Anasayfa</a>
                        <a href="{{ route('webtoon_list') }}">Webtoonlar</a>
                        <span>{{ $webtoon->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="{{ url($webtoon->thumb_image) }}">
                            <div class="comment"><i class="fa fa-comments"></i> {{ $webtoon->comment_count }}</div>
                            <div class="view"><i class="fa fa-eye"></i> {{ $webtoon->click_Count }}</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $webtoon->name }}</h3>
                            </div>
                            <p style="margin-top: 10px;">
                                {{ $webtoon->description }}
                            </p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Türü:</span> Webtoon</li>
                                            <li><span>Yayınlanma:</span>{{ $webtoon->date }}</li>
                                            <li><span>Kategoriler:</span>
                                                @foreach ($categories as $item)
                                                    {{ $item->name }}
                                                    @unless ($loop->last)
                                                        ,
                                                    @endunless
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Puan:</span> {{ $webtoon->score }} / 5 ({{ $webtoon->scoreUsers }}
                                                Oy
                                                Kullanıldı)</li>
                                            <li><span>Ortalama Süre:</span> {{ $webtoon->average_min }} dk</li>
                                            <li><span>Görüntülenme:</span> {{ $webtoon->click_count }}</li>
                                            <li><span>Bölüm Sayısı:</span> {{ $webtoon->episode_count }} Bölüm</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                @if ($followed)
                                    <a href="javascript:;" onclick="unfollowWebtoon()" class="follow-btn"><i
                                            class="fa fa-plus"></i> Takipten Çıkar</a>
                                @else
                                    <a href="javascript:;" onclick="followWebtoon()" class="follow-btn"><i
                                            class="fa fa-plus"></i>
                                        Takip Et</a>
                                @endif
                                @if ($liked)
                                    <a href="javascript:;" onclick="dislikeWebtoon()" class="follow-btn"><i
                                            class="fa fa-heart"></i> Favorilerden Çıkar</a>
                                @else
                                    <a href="javascript:;" onclick="likeWebtoon()" class="follow-btn"><i
                                            class="fa fa-heart-o"></i> Favorilere Ekle</a>
                                @endif

                                <a href="{{ url($firstEpisodeUrl) }}" {{ $firstEpisodeUrl != 'none' ? '' : 'hidden' }}
                                    class="watch-btn"><span>İlk Bölümü
                                        Oku</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                        <div class="anime__details__rating">
                            <span>{{ $webtoon->scoreUsers }} Oy Kullanıldı</span>
                            <div class="rating">
                                <input id="scoreRateID" type="text" class="kv-ltr-theme-fas-star rating-loading"
                                    data-size="sm" value="{{ $webtoon->score }}" onchange="scoreUser()">
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                @php
                    $season_count = $webtoon_episodes->max('season_short');
                    $series_episodes = $webtoon_episodes;
                    $show_checkbox = true;
                    $episode_type = 'webtoon';
                    $short_name = $webtoon->short_name;

                    $trend_type = 'webtoon';
                    $trend_series = $trend_webtoons;
                @endphp

                @include('index.themes.animex.layouts.sections.episodes')


                @include('index.themes.animex.layouts.sections.trends')
            </div>
        </div>
    </section>
    <!-- Anime Section End -->

    <div id="hiddenDiv">

    </div>

    <!--Beğenme, Beğenmeme ile ilgili fonksiyonlar-->
    <script>
        const authMessage = "Lütfen İlk Önce Giriş Yapınız!"

        function followWebtoon() {
            @if (Auth::user())
                var code = `<form action="{{ route('followWebtoon') }}" method="POST" id="followWebtoonForm">
                            @csrf
                            <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                            <input type="text" name="webtoon_code" value="{{ $webtoon->code }}">
                        </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('followWebtoonForm').submit();
            @else
                Swal.fire({
                    title: "Hata",
                    text: authMessage,
                    color: "#fff",
                    icon: "error"
                });
            @endif
        }

        function unfollowWebtoon() {
            @if (Auth::user())
                var code = `<form action="{{ route('unfollowWebtoon') }}" method="POST" id="unfollowWebtoonForm">
                @csrf
                <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                <input type="text" name="webtoon_code" value="{{ $webtoon->code }}">
            </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('unfollowWebtoonForm').submit();
            @else
                Swal.fire({
                    title: "Hata",
                    text: authMessage,
                    color: "#fff",
                    icon: "error"
                });
            @endif
        }

        function likeWebtoon() {
            @if (Auth::user())
                var code = `<form action="{{ route('likeWebtoon') }}" method="POST" id="likeWebtoonForm">
                @csrf
                <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                <input type="text" name="webtoon_code" value="{{ $webtoon->code }}">
            </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('likeWebtoonForm').submit();
            @else
                Swal.fire({
                    title: "Hata",
                    text: authMessage,
                    color: "#fff",
                    icon: "error"
                });
            @endif
        }

        function dislikeWebtoon() {
            @if (Auth::user())
                var code = `<form action="{{ route('unlikeWebtoon') }}" method="POST" id="unlikeWebtoonForm">
                @csrf
                <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                <input type="text" name="webtoon_code" value="{{ $webtoon->code }}">
            </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('unlikeWebtoonForm').submit();
            @else
                Swal.fire({
                    title: "Hata",
                    text: authMessage,
                    color: "#fff",
                    icon: "error"
                });
            @endif
        }
    </script>

    <!--Score ile ilgili fonksiyonlar-->
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
                <input type="text" name="content_code" value="{{ $webtoon->code }}">
                <input type="text" name="content_type" value="0">
            </form>`
                document.getElementById("hiddenDiv").innerHTML = html;
                document.getElementById("scoreUserSubmitForm").submit();
            @else
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
            var anime_code = `{{ $webtoon->code }}`;
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
                            content_type: 0
                        }
                    })
                    .done(function(response) {
                        if (response.response === 0) {
                            console.log('İşlem İçin Giriş Yapılması Gerekmektedir.');
                        } else if (response.response === 1) {
                            console.log("Bölüm izlendi olarak işaretlendi");
                            document.getElementById('watchedATag' + anime_episode_code).style.background = 'green';
                        } else if (response.response === 2) {
                            console.log("Bölüm izlenmedi olarak işaretlendi");
                            document.getElementById('watchedATag' + anime_episode_code).style.background = '';
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
