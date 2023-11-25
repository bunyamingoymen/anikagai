@extends("index.themes.mox.layouts.main")
@section('index_content')
@if (isset($webtoon_active) && isset($anime_active) && $webtoon_active->value == 0 && $anime_active->value == 0)
<main>
    <div class="gallery-area position-relative mb-2">
        <p style="color: black; text-align: center;">Sistemdei bütün veriler kapalı</p>
    </div>
</main>
@else
<main>

    <!-- gallery-area -->
    <div class="gallery-area position-relative mb-2">
        <div class="gallery-bg"></div>
        <div class="container-fluid p-0 fix">
            <div class="row gallery-active">
                @foreach ($slider_image as $item)
                <div class="col-12">
                    <div class="gallery-item">
                        <a href="{{$item->optional_2 ?? ''}}">
                            <img src="../../../{{$item->optional ?? ''}}" alt="">
                        </a>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="slider-nav"></div>
    </div>
    <!-- gallery-area-end -->

    <!-- up-coming-movie-area -->
    <section class="ucm-area ucm-bg2" data-background="../../../user/img/bg/ucm_bg02.jpg">
        <div class="container">
            <div class="row align-items-end mb-55">
                <div class="col-lg-6">
                    <div class="section-title title-style-three text-center text-lg-left">
                        <h2 class="title">Trendler</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ucm-nav-wrap">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @if (isset($webtoon_active) && $webtoon_active->value == 1)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="webtoons-tab" data-toggle="tab" href="#webtoons"
                                    role="tab" aria-controls="webtoons" aria-selected="false">Webtoon</a>
                            </li>
                            @endif
                            @if (isset($anime_active) && $anime_active->value == 1)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="anime-tab" data-toggle="tab" href="#anime" role="tab"
                                    aria-controls="anime" aria-selected="false">Anime</a>
                            </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="webtoons" role="tabpanel" aria-labelledby="movies-tab">
                    <div class="ucm-active-two owl-carousel">
                        @foreach ($trend_webtoons as $item)
                        <div class="movie-item movie-item-two mb-30">
                            <div class="movie-poster"
                                style="min-width: 195px; min-height: 285px; max-width: 195px; max-height: 285px;">
                                <a href="webtoon/{{$item->short_name}}"><img src="../../../{{$item->image}}" alt=""></a>
                            </div>
                            <div class="movie-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h5 class="title"><a href="#">{{$item->name}}</a></h5>
                                <span class="rel">Adventure</span>
                                <div class="movie-content-bottom">
                                    <ul>
                                        <li class="tag">
                                            <a href="#">HD</a>
                                            <a href="#">English</a>
                                        </li>
                                        <li>
                                            <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="tab-pane fade" id="anime" role="tabpanel" aria-labelledby="anime-tab">
                    <div class="ucm-active-two owl-carousel">
                        @foreach ($trend_animes as $item)
                        <div class="movie-item movie-item-two mb-30">
                            <div class="movie-poster"
                                style="min-width: 195px; min-height: 285px; max-width: 195px; max-height: 285px;">
                                <a href="anime/{{$item->short_name}}"><img src="../../../{{$item->image}}" alt=""></a>
                            </div>
                            <div class="movie-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h5 class="title"><a href="#">{{$item->name}}</a></h5>
                                <span class="rel">Adventure</span>
                                <div class="movie-content-bottom">
                                    <ul>
                                        <li class="tag">
                                            <a href="#">HD</a>
                                            <a href="#">English</a>
                                        </li>
                                        <li>
                                            <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- up-coming-movie-area-end -->

    <!-- top-rated-movie -->
    <section class="top-rated-movie tr-movie-bg2" data-background="../../../user/img/bg/tr_movies_bg.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title title-style-three text-center mb-70">
                        <h2 class="title">Animeler</h2>
                    </div>
                </div>
            </div>
            <div class="row movie-item-row">
                @foreach ($animes as $item)
                <div class="custom-col-">
                    <div class="movie-item movie-item-two">
                        <div class="movie-poster"
                            style="min-width: 195px; min-height: 285px; max-width: 195px; max-height: 285px;">
                            <img src="../../../{{$item->image}}" alt="">
                            <ul class="overlay-btn">
                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                        class="popup-video btn">İzle</a></li>
                                <li><a href="anime/{{$item->short_name}}" class="btn">Detay</a></li>
                            </ul>
                        </div>
                        <div class="movie-content">
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h5 class="title"><a href="#">{{$item->name}}</a></h5>
                            <span class="rel">Adventure</span>
                            <div class="movie-content-bottom">
                                <ul>
                                    <li class="tag">
                                        <a href="#">HD</a>
                                        <a href="#">English</a>
                                    </li>
                                    <li>
                                        <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="tr-movie-btn text-center mt-25">
                <a href="#" class="btn">Devamına Bak</a>
            </div>
        </div>
    </section>
    <!-- top-rated-movie-end -->

    <!-- top-rated-movie -->
    <section class="top-rated-movie tr-movie-bg2" data-background="../../../user/img/bg/tr_movies_bg.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title title-style-three text-center mb-70">
                        <h2 class="title">Webtoonlar</h2>
                    </div>
                </div>
            </div>
            <div class="row movie-item-row">
                @foreach ($webtoons as $item)
                <div class="custom-col-">
                    <div class="movie-item movie-item-two">
                        <div class="movie-poster"
                            style="min-width: 195px; min-height: 285px; max-width: 195px; max-height: 285px;">
                            <img src="../../../{{$item->image}}" alt="">
                            <ul class="overlay-btn">
                                <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                        class="popup-video btn">İzle</a>
                                </li>
                                <li><a href="webtoon/{{$item->short_name}}" class="btn">Detay</a></li>
                            </ul>
                        </div>
                        <div class="movie-content">
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h5 class="title"><a href="#">{{$item->name}}</a></h5>
                            <span class="rel">Adventure</span>
                            <div class="movie-content-bottom">
                                <ul>
                                    <li class="tag">
                                        <a href="#">HD</a>
                                        <a href="#">English</a>
                                    </li>
                                    <li>
                                        <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="tr-movie-btn text-center mt-25">
                <a href="#" class="btn">Devamına Bak</a>
            </div>
        </div>
    </section>
    <!-- top-rated-movie-end -->

</main>
@endif
@endsection