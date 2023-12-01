@extends("index.themes.mox.layouts.main")
@section('index_content')
<link rel="stylesheet" href="../../../user/mox/css/bootstrap.min.css">
<link rel="stylesheet" href="../../../user/mox/css/animate.min.css">
<link rel="stylesheet" href="../../../user/mox/css/magnific-popup.css">
<link rel="stylesheet" href="../../../user/mox/css/fontawesome-all.min.css">
<link rel="stylesheet" href="../../../user/mox/css/owl.carousel.min.css">
<link rel="stylesheet" href="../../../user/mox/css/flaticon.css">
<link rel="stylesheet" href="../../../user/mox/css/odometer.css">
<link rel="stylesheet" href="../../../user/mox/css/aos.css">
<link rel="stylesheet" href="../../../user/mox/css/slick.css">
<link rel="stylesheet" href="../../../user/mox/css/default.css">
<link rel="stylesheet" href="../../../user/mox/css/style.css">
<link rel="stylesheet" href="../../../user/mox/css/responsive.css">
<!-- main-area -->
<main>

    <!-- movie-details-area -->
    <section class="movie-details-area" data-background="../../../user/mox/img/bg/movie_details_bg.jpg">
        <div class="container">
            <div class="row align-items-center position-relative">
                <div class="col-xl-3 col-lg-4">
                    <div class="../../../user/mox/movie-details-img">
                        <img src="../../../{{$anime->image}}" alt=""
                            style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-8">
                    <div class="movie-details-content">
                        <h2>{{$anime->name ?? 'not_found'}}</h2>
                        <div class="banner-meta">
                            <ul>
                                <li class="category">
                                    <a href="#">{{$anime->main_category_name}}</a>
                                    @foreach ($categories as $item)
                                    <a href="#">{{$item->name}}</a>
                                    @endforeach

                                </li>
                                <li class="release-time">
                                    <span><i class="far fa-calendar-alt"></i> {{$anime->date}}</span>
                                    <span><i class="far fa-clock"></i>{{$anime->episode_count}} Bölüm</span>
                                </li>
                            </ul>
                        </div>
                        <p>
                            {{$anime->description}}
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
                                    <p style="color:red;" id="followAnimeTextMessageUst">  </p>
                                    <a href="javascript:;" class="btn" onclick="followAnime()"><i
                                            class="fas fa-plus"></i>Takip
                                        Et</a>
                                    <p style="color:red;" id="followAnimeTextMessage">  </p>
                                    @endif

                                </li>
                                <li class=" watch">
                                    @if ($liked)
                                    <a href="javascript:;" class="btn" onclick="dislikeAnime()"><i
                                            class="fas fa-heart"></i>Favorilere
                                        Eklendi</a>
                                    @else
                                    <p style="color:red;" id="likeAnimeTextMessageUst">  </p>
                                    <a href="javascript:;" class="btn" onclick="likeAnime()"><i
                                            class="fas fa-heart"></i>Favorilere
                                        Ekle</a>
                                    <p style="color:red;" id="likeAnimeTextMessage">  </p>
                                    @endif

                                </li>
                                <li class="watch">
                                    <a href="https://www.youtube.com/watch?v=R2gbPxeNk2E" class="btn popup-video"><i
                                            class="fas fa-play"></i>İzle</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="movie-details-btn">
                    @if (false)
                    <a href="img/poster/movie_details_img.jpg" class="download-btn" download="">İndir <img
                            src="../../../user/mox/fonts/download.svg" alt=""></a>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- movie-details-area-end -->

    <!-- episode-area -->
    <section class="episode-area episode-bg" data-background="../../../user/mox/img/bg/episode_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="movie-episode-wrap">
                        <div class="episode-top-wrap">
                            <div class="section-title">
                                <h2 class="title">Tüm bölümler</h2>
                            </div>
                            <div class="total-views-count">
                                <p>{{$anime->click_count}} <i class="far fa-eye"></i></p>
                            </div>
                        </div>
                        <div class="episode-watch-wrap">
                            <div class="accordion" id="accordionExample">
                                @if ($anime->season_count > 0)
                                @for ($i = $anime->season_count; $i>=1; $i--)
                                <div class="card">
                                    <div class="card-header " id="heading{{$i}}">
                                        <button class="btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="false"
                                            aria-controls="collapse{{$i}}">
                                            <span class="season">{{$i}} . sezon</span>
                                            <span
                                                class="video-count">{{count($anime_episodes->where('season_short',$i))}}
                                                Bölüm</span>
                                        </button>
                                    </div>
                                    @if ($i == $anime->season_count)
                                    <div id="collapse{{$i}}" class="collapse show" aria-labelledby="heading{{$i}}"
                                        data-parent="#accordionExample">
                                        @else
                                        <div id="collapse{{$i}}" class="collapse" aria-labelledby="heading{{$i}}"
                                            data-parent="#accordionExample">
                                            @endif

                                            <div class="card-body">
                                                <ul>
                                                    @foreach ($anime_episodes->where('season_short',$i) as $item)
                                                    <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                            class="popup-video"><i class="fas fa-play"></i> Bölüm
                                                            {{$item->episode_short}}</a>
                                                        <span class="duration"><i class="far fa-clock"></i>
                                                            {{$item->minute}}
                                                            Dakika</span>
                                                    </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                    @else
                                    <p>Herhani gib bölüm mevcut değil.</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="episode-img">
                            <img src="../../../{{$anime->image}}" alt=""
                                style="min-width: 413px; min-height: 526px; max-width: 413px; max-height: 526px;">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="movie-history-wrap">
                            <h3 class="title"><span>Hikaye</span></h3>
                            <p>
                                {{$anime->description}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- episode-area-end -->

    <!-- tv-series-area -->
    <section class="tv-series-area tv-series-bg" data-background="../../../user/mox/img/bg/tv_series_bg02.jpg">
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
                            <a href="{{url('anime/'.$item->short_name)}}"><img src="../../../{{$item->image}}" alt=""
                                    style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;"></a>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                <h5 class="title"><a href="{{url('anime/'.$item->short_name)}}">{{$item->name}}</a></h5>
                                <span class="date">{{$item->date}}</span>
                            </div>
                            <div class="bottom">
                                <ul>
                                    <li><span class="quality">{{$item->main_category_name}}</span></li>
                                    <li>
                                        <span class="duration"><i class="far fa-clock"></i>
                                            {{$item->average_min}} dk</span>
                                        <span class="rating"><i class="fas fa-thumbs-up"></i> 3.5</span>
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
            document.getElementById('followAnimeTextMessage').innerText = "Lütfen Giriş Yapınız."
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
            document.getElementById('followAnimeTextMessage').innerText = "Lütfen Giriş Yapınız."
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
@endsection