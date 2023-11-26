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
                        <img src="../../../{{$webtoon->image}}" alt=""
                            style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-8">
                    <div class="movie-details-content">
                        <h2><span>{{$webtoon->title}}</span></h2>
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
                                    <span><i class="far fa-clock"></i>{{$webtoon->episode_count}} Bölüm</span>
                                </li>
                            </ul>
                        </div>
                        <p>
                            {{$webtoon->description}}
                        </p>
                        <div class="movie-details-prime">
                            <ul>
                                <li class="share"><a href="#"><i class="fas fa-share-alt"></i> Paylaş</a></li>
                                <li class="streaming">
                                    <h6>Full HD</h6>
                                    <span>Tüm bölümer Mevcut</span>
                                </li>
                                <li class="watch"><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                        class="btn popup-video"><i class="fas fa-play"></i>Oku</a></li>
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
                                <p>2.700 <i class="far fa-eye"></i></p>
                            </div>
                        </div>
                        <div class="episode-watch-wrap">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <button class="btn-block text-left" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <span class="season">2.Sezon</span>
                                            <span class="video-count">24 Bölüm</span>
                                        </button>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <ul>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 1</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 2</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 3</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 4</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 5</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 6</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 7</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 8</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 9</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 10</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 11</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 12</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 13</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 14</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 15</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 16</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 17</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 18</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 19</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 20</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 21</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 22</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 23</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 24</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <button class="btn-block text-left collapsed" type="button"
                                            data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            <span class="season">1.Sezon</span>
                                            <span class="video-count">12 Bölüm</span>
                                        </button>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <ul>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 1</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 2</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 3</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 4</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 5</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 6</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 7</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 8</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 9</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 10</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 11</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                                        class="popup-video"><i class="fas fa-play"></i> Bölüm 12</a>
                                                    <span class="duration"><i class="far fa-clock"></i> 28 Min</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="episode-img">
                        <img src="../../../{{$webtoon->image}}" alt=""
                            style="min-width: 413px; min-height: 526px; max-width: 413px; max-height: 526px;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="movie-history-wrap">
                        <h3 class="title"><span>Hikaye</span></h3>
                        <p>
                            {{$webtoon->description}}
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
                @foreach ($trend_webtoons as $item)
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="movie-item mb-50">
                        <div class="movie-poster">
                            <a href="movie-details.html"><img src="../../../{{$item->image}}" alt=""
                                    style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;"></a>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                <h5 class="title"><a href="movie-details.html">{{$item->name}}</a></h5>
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