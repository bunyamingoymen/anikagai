@extends("index.themes.mox.layouts.main")
@section('index_content')
<main>

    <!-- movie-details-area -->
    <section class="movie-details-area" data-background="../../../user/mox/img/bg/movie_details_bg.jpg">
        <div class="container">
            <div class="row align-items-center position-relative">
                <div class="col-xl-3 col-lg-4">
                    <div class="../../../user/mox/movie-details-img">
                        <img src="../../../{{$user->image ?? 'user/img/profile/default.png'}}" alt=""
                            style="min-width: 303px;  max-width: 303px;">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-8">
                    <div class="movie-details-content">
                        <h2><span>{{$user->name}}</span></h2>
                        <h4>@ {{$user->username}}</h4>
                        <p>
                            {{$user->description ?? 'Açıklama Mevcut değil'}}
                        </p>
                    </div>
                </div>
                <div class="movie-details-btn">
                    @if (false)
                    <a href="../../../user/mox/img/poster/movie_details_img.jpg" class="download-btn" download="">İndir
                        <img src="../../../user/mox/fonts/download.svg" alt=""></a>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- movie-details-area-end -->

    <!-- up-coming-movie-area -->
    <section class="top-rated-movie tr-movie-bg" data-background="../../user/mox/img/bg/tr_movies_bg.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center mb-50">
                        <span class="sub-title">Beğenilenler</span>
                        <h2 class="title">Favoriler</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="tr-movie-menu-active text-center">
                        <button class="active" data-filter="*">Hepsi</button>
                        @if ($anime_active->value == 1)
                        <button class="" data-filter=".tab-favorite-anime">Animeler</button>
                        @endif
                        @if ($webtoon_active->value == 1)
                        <button class="" data-filter=".tab-favorite-webtoon">Webtoonlar</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row tr-movie-active">
                @if ($anime_active->value == 1)
                @foreach ($favorite_animes as $item)
                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-favorite-anime">
                    <div class="movie-item mb-60">
                        <div class="movie-poster">
                            <a href="{{url("anime/".$item->short_name)}}"><img src="../../../{{$item->image}}" alt=""
                                    style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;"></a>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                <h5 class="title"><a href="{{url("anime/".$item->short_name)}}">{{$item->name}}</a>
                                </h5>
                                <span class="date">{{$item->date}}</span>
                            </div>
                            <div class="bottom">
                                <ul>
                                    <li><span class="quality">{{$item->main_category_name ?? 'Genel'}}</span>
                                    </li>
                                    <li>
                                        <span class="duration"><i class="far fa-clock"></i>
                                            {{$item->average_min}}</span>
                                        <span class="rating"><i class="fas fa-thumbs-up"></i>
                                            {{$item->score}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                @if ($webtoon_active->value == 1)
                @foreach ($favorite_webtoons as $item)
                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-favorite-webtoon">
                    <div class="movie-item mb-60">
                        <div class="movie-poster">
                            <a href="{{url("webtoon/".$item->short_name)}}"><img src="../../../{{$item->image}}" alt=""
                                    style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;"></a>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                <h5 class="title"><a href="{{url("webtoon/".$item->short_name)}}">{{$item->name}}</a>
                                </h5>
                                <span class="date">{{$item->date}}</span>
                            </div>
                            <div class="bottom">
                                <ul>
                                    <li><span class="quality">{{$item->main_category_name ?? 'Genel'}}</span>
                                    </li>
                                    <li>
                                        <span class="duration"><i class="far fa-clock"></i>
                                            {{$item->average_min}}</span>
                                        <span class="rating"><i class="fas fa-thumbs-up"></i>
                                            {{$item->score}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

            </div>
        </div>
    </section>
    <!-- up-coming-movie-area-end -->

    <!-- up-coming-movie-area -->
    <section class="top-rated-movie tr-movie-bg" data-background="../../user/mox/img/bg/tr_movies_bg.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center mb-50">
                        <h2 class="title">Takip Edilenler</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="tr-movie-menu-active text-center">
                        <button class="active" data-filter="*">Hepsi</button>
                        @if ($anime_active->value == 1)
                        <button class="" data-filter=".tab-follow_animes">Animeler</button>
                        @endif
                        @if ($webtoon_active->value == 1)
                        <button class="" data-filter=".tab-follow_webtoons">Webtoonlar</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row tr-movie-active">
                @if ($anime_active->value == 1)
                @foreach ($follow_animes as $item)
                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-follow_animes">
                    <div class="movie-item mb-60">
                        <div class="movie-poster">
                            <a href="{{url("anime/".$item->short_name)}}"><img src="../../../{{$item->image}}" alt=""
                                    style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;"></a>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                <h5 class="title"><a href="{{url("anime/".$item->short_name)}}">{{$item->name}}</a>
                                </h5>
                                <span class="date">{{$item->date}}</span>
                            </div>
                            <div class="bottom">
                                <ul>
                                    <li><span class="quality">{{$item->main_category_name ?? 'Genel'}}</span>
                                    </li>
                                    <li>
                                        <span class="duration"><i class="far fa-clock"></i>
                                            {{$item->average_min}}</span>
                                        <span class="rating"><i class="fas fa-thumbs-up"></i>
                                            {{$item->score}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                @if ($webtoon_active->value == 1)
                @foreach ($follow_webtoons as $item)
                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-follow_webtoons">
                    <div class="movie-item mb-60">
                        <div class="movie-poster">
                            <a href="{{url("webtoon/".$item->short_name)}}"><img src="../../../{{$item->image}}" alt=""
                                    style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;"></a>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                <h5 class="title"><a href="{{url("webtoon/".$item->short_name)}}">{{$item->name}}</a>
                                </h5>
                                <span class="date">{{$item->date}}</span>
                            </div>
                            <div class="bottom">
                                <ul>
                                    <li><span class="quality">{{$item->main_category_name ?? 'Genel'}}</span>
                                    </li>
                                    <li>
                                        <span class="duration"><i class="far fa-clock"></i>
                                            {{$item->average_min}}</span>
                                        <span class="rating"><i class="fas fa-thumbs-up"></i>
                                            {{$item->score}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

            </div>
        </div>
    </section>
    <!-- up-coming-movie-area-end -->

    <!-- up-coming-movie-area -->
    <section class="top-rated-movie tr-movie-bg" data-background="../../user/mox/img/bg/tr_movies_bg.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center mb-50">
                        <h2 class="title">İzlenen/Okunanlar</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="tr-movie-menu-active text-center">
                        <button class="active" data-filter="*">Hepsi</button>
                        @if ($anime_active->value == 1)
                        <button class="" data-filter=".tab-watched_animes">Animeler</button>
                        @endif
                        @if ($webtoon_active->value == 1)
                        <button class="" data-filter=".tab-readed_webtoons">Webtoonlar</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row tr-movie-active">
                @if ($anime_active->value == 1)
                @foreach ($watched_animes as $item)
                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-watched_animes">
                    <div class="movie-item mb-60">
                        <div class="movie-poster">
                            <a href={{url("anime/".$item->short_name)}}"><img src="../../../{{$item->image}}" alt=""
                                    style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;"></a>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                <h5 class="title"><a href="{{url("anime/".$item->short_name)}}">{{$item->name}}</a>
                                </h5>
                                <span class="date">{{$item->date}}</span>
                            </div>
                            <div class="bottom">
                                <ul>
                                    <li><span class="quality">{{$item->main_category_name ?? 'Genel'}}</span>
                                    </li>
                                    <li>
                                        <span class="duration"><i class="far fa-clock"></i>
                                            {{$item->average_min}}</span>
                                        <span class="rating"><i class="fas fa-thumbs-up"></i>
                                            {{$item->score}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                @if ($webtoon_active->value == 1)
                @foreach ($readed_webtoons as $item)
                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-readed_webtoons">
                    <div class="movie-item mb-60">
                        <div class="movie-poster">
                            <a href="{{url("webtoon/".$item->short_name)}}"><img src="../../../{{$item->image}}" alt=""
                                    style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;"></a>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                <h5 class="title"><a href="{{url("webtoon/".$item->short_name)}}">{{$item->name}}</a>
                                </h5>
                                <span class="date">{{$item->date}}</span>
                            </div>
                            <div class="bottom">
                                <ul>
                                    <li><span class="quality">{{$item->main_category_name ?? 'Genel'}}</span>
                                    </li>
                                    <li>
                                        <span class="duration"><i class="far fa-clock"></i>
                                            {{$item->average_min}}</span>
                                        <span class="rating"><i class="fas fa-thumbs-up"></i>
                                            {{$item->score}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

            </div>
        </div>
    </section>
    <!-- up-coming-movie-area-end -->

</main>
@endsection