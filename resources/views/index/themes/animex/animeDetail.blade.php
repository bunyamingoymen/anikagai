@extends("index.themes.animex.layouts.main")
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
                    <a href="{{route('index')}}"><i class="fa fa-home"></i> Anasayfa</a>
                    <a href="{{route('anime_list')}}">Animeler</a>
                    <span>{{$anime->name}}</span>
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
                    <div class="anime__details__pic set-bg" data-setbg="../../../{{$anime->image}}">
                        <div class="comment"><i class="fa fa-comments"></i> {{$anime->comment_count}}</div>
                        <div class="view"><i class="fa fa-eye"></i> {{$anime->click_Count}}</div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="anime__details__text">
                        <div class="anime__details__title">
                            <h3>{{$anime->name}}</h3>
                        </div>
                        <p style="margin-top: 10px;">
                            {{$anime->description}}
                        </p>
                        <div class="anime__details__widget">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <ul>
                                        <li><span>Türü:</span> Anime</li>
                                        <li><span>Yayınlanma:</span>{{$anime->date}}</li>
                                        <li><span>Kategoriler:</span> {{$anime->main_category_name ?? 'Genel'}},
                                            @foreach ($categories as $item)
                                            {{$item->name}},
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <ul>
                                        <li><span>Puan:</span> {{$anime->score}} / 5 ({{$anime->scoreUsers}} Oy
                                            Kullanıldı)</li>
                                        <li><span>Ortalama Süre:</span> {{$anime->average_min}} dk</li>
                                        <li><span>Görüntülenme:</span> {{$anime->click_count}}</li>
                                        <li><span>Bölüm Sayısı:</span> {{$anime->episode_count}} Bölüm</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="anime__details__btn">
                            @if ($followed)
                            <a href="javascript:;" onclick="unfollowAnime()" class="follow-btn"><i
                                    class="fa fa-plus"></i> Takipten Çıkar</a>
                            @else
                            <a href="javascript:;" onclick="followAnime()" class="follow-btn"><i class="fa fa-plus"></i>
                                Takip Et</a>
                            @endif
                            @if ($liked)
                            <a href="javascript:;" onclick="dislikeAnime()" class="follow-btn"><i
                                    class="fa fa-heart"></i> Favorilerden Çıkar</a>
                            @else
                            <a href="javascript:;" onclick="likeAnime()" class="follow-btn"><i
                                    class="fa fa-heart-o"></i> Favorilere Ekle</a>
                            @endif

                            <a href="{{url($firstEpisodeUrl)}}" {{$firstEpisodeUrl !="none" ? "" : "hidden" }}
                                class="watch-btn"><span>İlk Bölümü
                                    İzle</span> <i class="fa fa-angle-right"></i></a>
                        </div>
                        <p id="likeAnimeTextMessage" style="color:red;"></p>
                    </div>
                    <div class="anime__details__rating">
                        <span>{{$anime->scoreUsers}} Oy Kullanıldı</span>
                        <div class="rating">
                            <input id="scoreRateID" type="text" class="kv-ltr-theme-fas-star rating-loading"
                                data-size="sm" value="{{$anime->score}}" onchange="scoreUser()">
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            @if ($anime->season_count > 0)
            @for ($i = $anime->season_count; $i>=1; $i--)
            <div class="col-lg-8 col-md-8">

                <div class="col-lg-12 col-md-12 anime__details__episodes">
                    <div class="section-title">
                        <h5>{{$i}}.sezon</h5>
                    </div>
                    @foreach ($anime_episodes->where('season_short',$i) as $item)
                    @if (count($watched) > 0 && ($watched->Where('anime_episode_code',$item->code)->first()))
                    <a style="background-color: green;" href="{{url("anime/".$anime->short_name."/".$i."/".$item->episode_short)}}"
                        id="watchedATag{{$item->code}}" >
                        <div>
                            <label class="container">
                                <input type="checkbox" id="watched{{$item->code}}"
                                    onchange="watchAnime('{{$item->code}}')" value="{{$item->code}}" checked>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="ml-4">
                            {{$i}}.S - {{$item->episode_short }}.B - {{$item->name}}
                        </div>
                    </a>
                    @else
                    <a href="{{url("anime/".$anime->short_name."/".$i."/".$item->episode_short)}}"
                        id="watchedATag{{$item->code}}" >
                        <div>
                            <label class="container">
                                <input type="checkbox" id="watched{{$item->code}}"
                                    onchange="watchAnime('{{$item->code}}')" value="{{$item->code}}">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="ml-4">
                            {{$i}}.S - {{$item->episode_short }}.B - {{$item->name}}
                        </div>
                    </a>
                    @endif

                    @endforeach

                </div>
            </div>
            @endfor
            @else
            <div class="col-lg-12 col-md-12 section-title">
                <h5>Herhani gib bölüm mevcut değil.</h5>
            </div>
            @endif
            <div class="col-lg-4 col-md-4 justify-content-end">
                <div class="anime__details__sidebar">
                    <div class="section-title">
                        <h5>Benzer İçerikler</h5>
                    </div>
                    @foreach ($trend_animes as $item)
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="product__item">
                            <a href="{{url("anime/".$item->short_name)}}">
                                <div class="product__item__pic set-bg" data-setbg="../../../{{$item->image}}">
                                    <div class="ep">{{$item->score}} / 5</div>
                                    <div class="comment"><i class="fa fa-comments"></i> {{$item->comment_count}}</div>
                                    <div class="view"><i class="fa fa-eye"></i> {{$item->click_count}} </div>
                                </div>
                            </a>
                            <div class="product__item__text">
                                <ul>
                                    <li>{{$item->main_category_name ?? 'Genel'}}</li>
                                </ul>
                                <h5><a href="{{url("anime/".$item->short_name)}}">{{$item->name}}</a></h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Anime Section End -->

<div id="hiddenDiv">

</div>

<script>
    function followAnime(){
        @if (Auth::user())
            var code = `<form action="{{route('followAnime')}}" method="POST" id="followAnimeForm">
                            @csrf
                            <input type="text" name="user_code" value="{{Auth::user()->code}}">
                            <input type="text" name="anime_code" value="{{$anime->code}}">
                        </form>`;
            document.getElementById('hiddenDiv').innerHTML = code;
            document.getElementById('followAnimeForm').submit();
        @else
            document.getElementById('likeAnimeTextMessage').innerText = "Lütfen Giriş Yapınız."
        @endif
    }
    function unfollowAnime(){
        @if (Auth::user())
            var code = `<form action="{{route('unfollowAnime')}}" method="POST" id="unfollowAnimeForm">
                @csrf
                <input type="text" name="user_code" value="{{Auth::user()->code}}">
                <input type="text" name="anime_code" value="{{$anime->code}}">
            </form>`;
            document.getElementById('hiddenDiv').innerHTML = code;
            document.getElementById('unfollowAnimeForm').submit();
        @else
            document.getElementById('likeAnimeTextMessage').innerText = "Lütfen Giriş Yapınız."
        @endif
    }
    function likeAnime(){
        @if (Auth::user())
            var code = `<form action="{{route('likeAnime')}}" method="POST" id="likeAnimeForm">
                @csrf
                <input type="text" name="user_code" value="{{Auth::user()->code}}">
                <input type="text" name="anime_code" value="{{$anime->code}}">
            </form>`;
            document.getElementById('hiddenDiv').innerHTML = code;
            document.getElementById('likeAnimeForm').submit();
        @else
            document.getElementById('likeAnimeTextMessage').innerText = "Lütfen Giriş Yapınız."
        @endif
    }
    function dislikeAnime(){
        @if (Auth::user())
            var code = `<form action="{{route('unlikeAnime')}}" method="POST" id="unlikeAnimeForm">
                @csrf
                <input type="text" name="user_code" value="{{Auth::user()->code}}">
                <input type="text" name="anime_code" value="{{$anime->code}}">
            </form>`;
            document.getElementById('hiddenDiv').innerHTML = code;
            document.getElementById('unlikeAnimeForm').submit();
        @else
            document.getElementById('likeAnimeTextMessage').innerText = "Lütfen Giriş Yapınız."
        @endif
    }
</script>

<script>
    // initialize with defaults
$("#scoreRateID").rating({theme: 'krajee-fas'});
$(".caption").css("display", "none");
$(".krajee-icon-clear").css("display", "none");
$(".clear-rating-active").css("display", "none");

function scoreUser(){
    @if (Auth::user())
        var score = document.getElementById("scoreRateID").value;
        var html = `<form action="{{route('scoreUser')}}" id="scoreUserSubmitForm" method="POST">
            @csrf
            <input type="text" name="score" value="`+score+`">
            <input type="text" name="user_code" value="{{Auth::user()->code}}">
            <input type="text" name="content_code" value="{{$anime->code}}">
            <input type="text" name="content_type" value="1">
        </form>`
        document.getElementById("hiddenDiv").innerHTML = html;
        document.getElementById("scoreUserSubmitForm").submit();
    @else
document.getElementById("likeAnimeTextMessage").innerText = "Lütfen İlk Önce Giriş Yapınız.";
    @endif
}
</script>

<!-- İzleme ile ilgili fonksiyonlar -->
<script>
    function watchAnime(anime_episode_code){
        var id = "watched" + anime_episode_code;
        var anime_code = `{{$anime->code}}`;
        @if (Auth::user())

            var value = document.getElementById(id).checked;

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
            });
            $.ajax({
                type: "POST",
                url: '{{ route("index_watched_anime") }}',
                data: {
                    anime_episode_code: anime_episode_code,
                    anime_code: anime_code,
                    content_type: 1
                }
            })
            .done(function (response) {
                if (response.response === 0) {
                    console.log('İşlem İçin Giriş Yapılması Gerekmektedir.');
                } else if (response.response === 1) {
                    console.log("Bölüm izlendi olarak işaretlendi");
                    document.getElementById('watchedATag'+anime_episode_code).style.background = 'green';
                } else if (response.response === 2) {
                    console.log("Bölüm izlenmedi olarak işaretlendi");
                    document.getElementById('watchedATag'+anime_episode_code).style.background = '';
                } else {
                    console.log('Bölüm izlendi olarak işaretlenirken beklenmedik bir hata meydana geldi');
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX hatası: ' + textStatus + ' - ' + errorThrown + ' - ' + JSON.stringify(jqXHR));
            });
        @else
            alert("İlk Önce Giriş yapmanız gerekmektedir.")
            document.getElementById(id).checked = false;
        @endif
    }
</script>

@endsection
