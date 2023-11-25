@extends("index.themes.mox.layouts.main")
@section('index_content')
<link rel="stylesheet" href="../../../user/css/bootstrap.min.css">
<link rel="stylesheet" href="../../../user/css/animate.min.css">
<link rel="stylesheet" href="../../../user/css/magnific-popup.css">
<link rel="stylesheet" href="../../../user/css/fontawesome-all.min.css">
<link rel="stylesheet" href="../../../user/css/owl.carousel.min.css">
<link rel="stylesheet" href="../../../user/css/flaticon.css">
<link rel="stylesheet" href="../../../user/css/odometer.css">
<link rel="stylesheet" href="../../../user/css/aos.css">
<link rel="stylesheet" href="../../../user/css/slick.css">
<link rel="stylesheet" href="../../../user/css/default.css">
<link rel="stylesheet" href="../../../user/css/style.css">
<link rel="stylesheet" href="../../../user/css/responsive.css">
<!-- main-area -->
<main>

    <!-- movie-details-area -->
    <section class="movie-details-area" data-background="../../../user/img/bg/movie_details_bg.jpg">
        <div class="container">
            <div class="row align-items-center position-relative">
                <div class="col-xl-3 col-lg-4">
                    <div class="../../../user/movie-details-img">
                        <img src="../../../{{$anime->image}}" alt=""
                            style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-8">
                    <div class="movie-details-content">
                        <h2><span>{{$anime->title}}</span></h2>
                        <div class="banner-meta">
                            <ul>
                                <li class="quality">
                                    <span>HD</span>
                                </li>
                                <li class="category">
                                    <a href="#">Romaitk,</a>
                                    <a href="#">Dram</a>
                                </li>
                                <li class="release-time">
                                    <span><i class="far fa-calendar-alt"></i> 2014</span>
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
                                <li class="streaming">
                                    <h6>Full HD</h6>
                                    <span>Tüm bölümer Mevcut</span>
                                </li>
                                <li class="watch"><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                        class="btn popup-video"><i class="fas fa-play"></i>İzle</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="movie-details-btn">
                    @if (false)
                    <a href="img/poster/movie_details_img.jpg" class="download-btn" download="">İndir <img
                            src="../../../user/fonts/download.svg" alt=""></a>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- movie-details-area-end -->

    <!-- episode-area -->
    <section class="episode-area episode-bg" data-background="../../../user/img/bg/episode_bg.jpg">
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
    <section class="tv-series-area tv-series-bg" data-background="../../../user/img/bg/tv_series_bg02.jpg">
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
                            <a href="/anime/{{$item->short_name}}"><img src="../../../{{$item->image}}" alt=""
                                    style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;"></a>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                <h5 class="title"><a href="/anime/{{$item->short_name}}">{{$item->name}}</a></h5>
                                <span class="date">2021</span>
                            </div>
                            <div class="bottom">
                                <ul>
                                    <li><span class="quality">hd</span></li>
                                    <li>
                                        <span class="duration"><i class="far fa-clock"></i> 128 min</span>
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

</main>
<!-- main-area-end -->
@endsection