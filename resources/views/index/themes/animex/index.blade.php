@extends('index.themes.animex.layouts.main')
@section('index_content')
    <style>
        .plusEighteen {
            color: #ffffff;
            font-weight: 600;
            font-family: 'Oswald', sans-serif;
            line-height: 21px;
            text-transform: uppercase;
            padding-left: 20px;
            position: relative;
            opacity: 0.5;
            transition: opacity 0.5s ease, transform 0.1s ease, border 0.1s ease;
        }

        .plusEighteen:hover {
            opacity: 1;
        }
    </style>

    @include('index.themes.animex.layouts.preloader')

    <!-- Hero Section Begin -->
    @if ($sliderShow->setting_value == '1')
        <section class="hero">
            <div class="container">
                <div class="hero__slider owl-carousel">
                    @foreach ($slider_image as $index => $item)
                        @if (is_null($item->optional_3) ||
                                $item->optional_3 === 'both' ||
                                ($item->optional_3 === 'computer' && isDesktop()) ||
                                ($item->optional_3 === 'mobile' && isMobile()))
                            <div id="heroSlider{{ $index + 1 }}" class="hero__items set-bg"
                                data-setbg="{{ url($item->optional ?? '') }}"
                                onmouseover="showVideo({{ $index }},{{ $item->code }})"
                                onmouseout="hideVideo({{ $index }})">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="hero__text">
                                            @if (
                                                $slider_image_alt->Where('value', $item->code)->first() &&
                                                    $slider_image_alt->Where('value', $item->code)->first()->optional != '')
                                                <div class="label">
                                                    {{ $slider_image_alt->Where('value', $item->code)->first()->optional }}
                                                </div>
                                            @endif
                                            <h2>{{ $item->value }}</h2>
                                            @if (
                                                $slider_image_alt->Where('value', $item->code)->first() &&
                                                    $slider_image_alt->Where('value', $item->code)->first()->optional_2 != '')
                                                <p>
                                                    {{ $slider_image_alt->Where('value', $item->code)->first()->optional_2 }}
                                                </p>
                                            @endif
                                            <a href="{{ $item->optional_2 ?? '' }}"><span>Seriye Git</span> <i
                                                    class="fa fa-angle-right"></i></a>
                                        </div>

                                    </div>
                                    <div class="video-container">
                                        <video class="video" preload="auto" loop>
                                            <source src="" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (isset($latestEpisodes) &&
            !is_null($latestEpisodes) &&
            isset($latestEpisodeType) &&
            !is_null($latestEpisodeType) &&
            $latestEpisodeType != 'none' &&
            $latestEpisodes->isNotEmpty())
        <section class="latest-episodes spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="section-title">
                            <h4>Son Bölümler</h4>
                        </div>
                    </div>
                </div>
                @include('index.themes.animex.layouts.sections.latestEpsidoes.' . $latestEpisodeType)
            </div>
        </section>
    @endif
    <!-- Hero Section End -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if ($data['anime_active']->value == 1 && $animes->isNotEmpty())
                        <div class="trending__product">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="section-title">
                                        <h4>Animeler</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="btn__all">
                                        <a href="{{ route('anime_list') }}" class="primary-btn">Tümünü Görüntüle <span
                                                class="arrow_right"></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($animes as $item)
                                    @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="product__item">
                                                <a href="{{ url('anime/' . $item->short_name) }}">
                                                    <div class="product__item__pic set-bg"
                                                        data-setbg="{{ url($item->thumb_image) }}">
                                                        <div class="ep">{{ $item->score }} / 5</div>
                                                        <div class="comment"><i class="fa fa-comments"></i>
                                                            {{ $item->comment_count }}
                                                        </div>
                                                        <div class="view"><i class="fa fa-eye"></i>
                                                            {{ $item->click_count }} </div>
                                                    </div>
                                                </a>
                                                <div class="product__item__text">
                                                    <ul>
                                                        <li>{{ $item->main_category_name ?? 'Genel' }}</li>
                                                    </ul>
                                                    <h5><a
                                                            href="{{ url('anime/' . $item->short_name) }}">{{ $item->name }}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="product__item">
                                                <a href="{{ route('loginScreen') }}">
                                                    <div class="product__item__pic" style="">
                                                        <div
                                                            style="width: 100%; height: 100%; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                                            <div class="censor set-bg"
                                                                data-setbg="{{ url($item->thumb_image) }}">
                                                            </div>
                                                            <div style="margin-top: 20px; z-index: 2;">
                                                                <a class="overlay-button"
                                                                    href="{{ route('loginScreen') }}">Görmek için
                                                                    giriş yapınız</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product__item__text">
                                                        <ul>
                                                            <li>Bilinmiyor</li>
                                                        </ul>
                                                        <h5><a href="{{ route('loginScreen') }}">Bilinmiyor</a></h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if ($data['webtoon_active']->value == 1 && $webtoons->isNotEmpty())
                        <div class="trending__product">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="section-title">
                                        <h4>Webtoonlar</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="btn__all">
                                        <a href="{{ route('webtoon_list') }}" class="primary-btn">Tümünü Görüntüle <span
                                                class="arrow_right"></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($webtoons as $item)
                                    @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="product__item">
                                                <a href="{{ url('webtoon/' . $item->short_name) }}">
                                                    <div class="product__item__pic set-bg"
                                                        data-setbg="{{ url($item->thumb_image) }}">
                                                        <div class="ep">{{ $item->score }} / 5</div>
                                                        <div class="comment"><i class="fa fa-comments"></i>
                                                            {{ $item->comment_count }}
                                                        </div>
                                                        <div class="view"><i class="fa fa-eye"></i>
                                                            {{ $item->click_count }} </div>
                                                    </div>
                                                </a>
                                                <div class="product__item__text">
                                                    <ul>
                                                        <li>{{ $item->main_category_name ?? 'Genel' }}</li>
                                                    </ul>
                                                    <h5><a
                                                            href="{{ url('webtoon/' . $item->short_name) }}">{{ $item->name }}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="product__item">
                                                <a href="{{ route('loginScreen') }}">
                                                    <div class="product__item__pic" style="">
                                                        <div
                                                            style="width: 100%; height: 100%; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                                            <div class="censor set-bg"
                                                                data-setbg="{{ url($item->thumb_image) }}">
                                                            </div>
                                                            <div style="margin-top: 20px; z-index: 2;">
                                                                <a class="overlay-button"
                                                                    href="{{ route('loginScreen') }}">Görmek için
                                                                    giriş yapınız</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product__item__text">
                                                        <ul>
                                                            <li>Bilinmiyor</li>
                                                        </ul>
                                                        <h5><a href="{{ route('loginScreen') }}">Bilinmiyor</a></h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">
                        @if ($data['anime_active']->value == 1)
                            <div class=" product__sidebar__comment">
                                <div class="section-title">
                                    <h5>Trend Animeler</h5>
                                </div>
                                @foreach ($trend_animes as $item)
                                    <div class="product__sidebar__comment__item">
                                        <div class="product__sidebar__comment__item__pic">
                                            <img src="{{ url($item->thumb_image_2) }}" alt=""
                                                style="min-width: 90px !important; min-height: 130px !important; max-width: 90px !important; max-height: 130px
                                !important;">
                                        </div>
                                        <div class="product__sidebar__comment__item__text">
                                            <ul>
                                                <li>{{ $item->main_category_name }}</li>
                                            </ul>
                                            <h5><a href="{{ url('anime/' . $item->short_name) }}">{{ $item->name }}</a>
                                            </h5>
                                            <span><i class="fa fa-eye"></i> {{ $item->click_count }} Görüntülenme</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if ($data['webtoon_active']->value == 1)
                            <div class="product__sidebar__comment">
                                <div class="section-title">
                                    <h5>Trend Webtoonlar</h5>
                                </div>
                                @foreach ($trend_webtoons as $item)
                                    <div class="product__sidebar__comment__item">
                                        <div class="product__sidebar__comment__item__pic">
                                            <img src="{{ url($item->thumb_image_2) }}" alt=""
                                                style="min-width: 90px !important; min-height: 130px !important; max-width: 90px !important; max-height: 130px
                                !important;">
                                        </div>
                                        <div class="product__sidebar__comment__item__text">
                                            <ul>
                                                <li>{{ $item->main_category_name }}</li>
                                            </ul>
                                            <h5><a
                                                    href="{{ url('webtoon/' . $item->short_name) }}">{{ $item->name }}</a>
                                            </h5>
                                            <span><i class="fa fa-eye"></i> {{ $item->click_count }} Görüntülenme</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Js Plugins -->
    <script src="{{ url('user/animex/js/owl.carousel.min.js') }}"></script>
    <script>
        // Tüm video elementlerini seç ve varsayılan olarak gizle
        // Önceden çekilen videoların bilgilerini saklamak için bir nesne oluştur
        var fetchedVideos = {};

        var videoElements = document.querySelectorAll('.video');
        var videoElementsContainer = document.querySelectorAll('.video-container');
        videoElements.forEach(function(video) {
            //video.style.display = 'none';
        });

        function showVideo(index, code) {

            // Daha önce çekilen bir video varsa tekrar çekme
            if (fetchedVideos[index]) {
                //console.log('video yükleniyor...');
                // Tüm video elementlerini duraklat ve gizle
                videoElements.forEach(function(video) {
                    if (!video.paused) {
                        video.pause();
                    }
                });

                // Videoları gizle ve daha önce çekilmiş videoyu göster
                videoElementsContainer.forEach(function(container, i) {
                    if (i === index) {
                        container.style.display = 'block';
                        videoElements[i].src = fetchedVideos[index];
                        if (videoElements[i].paused) {
                            videoElements[i].play();
                        }

                    } else {
                        container.style.display = 'none';
                    }
                });
            } else {
                //console.log('video çekiliyor...');
                // AJAX isteği yap
                fetch('/fetchVideo?code=' + (code))
                    .then(response => response.json())
                    .then(data => {
                        // Videonun URL'sini al
                        var videoUrl = data.video;
                        if (videoUrl != "none") {
                            // Daha önce çekilen videoyu sakla
                            fetchedVideos[index] = videoUrl;

                            // Tüm video elementlerini duraklat ve gizle
                            videoElements.forEach(function(video) {
                                if (!video.paused) {
                                    video.pause();
                                }

                            });

                            // Videoları gizle ve yeni videoyu göster
                            videoElementsContainer.forEach(function(container, i) {
                                if (i === index) {
                                    container.style.display = 'block';
                                    videoElements[i].src = videoUrl;
                                    if (videoElements[i].paused) {
                                        videoElements[i].play();
                                    }

                                } else {
                                    container.style.display = 'none';
                                }
                            });
                        } else {
                            //console.log('Video Not Found');
                        }

                    })
                    .catch(error => {
                        console.error('Error fetching video:', error);
                    });
            }
        }

        function hideVideo(index) {
            videoElementsContainer[index].style.display = 'none';
            if (!videoElements[index].paused) {
                videoElements[index].pause();
            }
        }
    </script>
@endsection
