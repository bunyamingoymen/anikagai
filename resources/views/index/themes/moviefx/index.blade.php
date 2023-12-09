@extends("index.themes.moviefx.layouts.main")
@section('index_content')

<style>
    .shadowText {
        text-shadow: 2px 0 #000, -2px 0 #000, 0 2px #000, 0 -2px #000,
            1px 1px #000, -1px -1px #000, 1px -1px #000, -1px 1px #000;
    }

    .swiper-container {
        width: 100%;
    }

    .swiper-slide {
        background-size: cover;
        background-position: 50%;
        min-height: 20vh;

        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    // overwrite swiper defaults
    .swiper-pagination {
        &-bullet {
            background-color: transparent;
            border: 2px solid #fff;
            border-radius: 50%;
            width: 12px;
            height: 12px;
            opacity: 1;
        }

        &-bullet-active {
            background-color: #fff;
        }
    }

    .swiper-button {
        &-container {
            background-color: rgba(0, 0, 0, 0.25);
        }

        &-prev {
            background-image:
                url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M0%2C22L22%2C0l2.1%2C2.1L4.2%2C22l19.9%2C19.9L22%2C44L0%2C22L0%2C22L0%2C22z'%20fill%3D'%23ffffff'%2F%3E%3C%2Fsvg%3E");
        }

        &-next {
            background-image:
                url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'%3E%3Cpath%20d%3D'M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z'%20fill%3D'%23ffffff'%2F%3E%3C%2Fsvg%3E");
        }
    }

    // GENERIC STUFF TO MAKE IT POP 💩
    body {
        display: flex;
        height: 100vh;
        width: 100%;
        font-family: "San Francisco Display Semibold";
    }

    .swiper-slide {
        &:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: black;
            opacity: 0.4;
        }

        h2 {
            pointer-events: none;
            opacity: 0;
            color: #ffffff;
            font-size: calc(5vw);
            letter-spacing: -1px;
            transform: translateY(-5%) scale(0.8);
            transition: 1s ease;
            text-transform: uppercase;
            text-shadow: 0 5px 5px rgba(0, 0, 0, 0.01);
        }

        &-active h2 {
            opacity: 1;
            transform: translateY(0%) scale(1);
            transition: 1s ease;
        }
    }

    // This gets in apple san francisco web font 🆒

    @font-face {
        font-family: "San Francisco Display Semibold";
        font-style: normal;
        font-weight: 400;
        src:
            url(https://applesocial.s3.amazonaws.com/assets/styles/fonts/sanfrancisco/sanfranciscodisplay-semibold-webfont.eot?#iefix) format("embedded-opentype"),
            url(https://applesocial.s3.amazonaws.com/assets/styles/fonts/sanfrancisco/sanfranciscodisplay-semibold-webfont.woff2) format("woff2"),
            url(https://applesocial.s3.amazonaws.com/assets/styles/fonts/sanfrancisco/sanfranciscodisplay-semibold-webfont.woff) format("woff"),
            url(https://applesocial.s3.amazonaws.com/assets/styles/fonts/sanfrancisco/sanfranciscodisplay-semibold-webfont.ttf) format("truetype"),
            url("fonts/sanfrancisco/sanfranciscodisplay-semibold-webfont.svg#San Francisco Display Semibold") format("svg");
    }
</style>

<!--Slider-->
<div class="featured-segment">
    <!-- Slider main container -->
    <div class="swiper-container">

        <!-- swiper slides -->
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background-image: url(https://source.unsplash.com/random?sig=24);">
                <h2>SIMPLE SWIPER</h2>
            </div>

            <div class="swiper-slide" style="background-image: url(https://source.unsplash.com/random?sig=53);">
                <h2>HELLO WORLD</h2>
            </div>

            <div class="swiper-slide" style="background-image: url(https://source.unsplash.com/random?sig=52);">
                <h2>Random Text 1</h2>
            </div>

            <div class="swiper-slide" style="background-image: url(https://source.unsplash.com/random?sig=21);">
            </div>

            <div class="swiper-slide" style="background-image: url(https://source.unsplash.com/random?sig=53);">
            </div>
        </div>
        <!-- !swiper slides -->

        <!-- next / prev arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <!-- !next / prev arrows -->

        <!-- pagination dots -->
        <div class="swiper-pagination"></div>
        <!-- !pagination dots -->
    </div>
</div>
<div class="dark-segment">
    <div class="ui grid mt-0 mb-0">
        <div class="left floated sixteen wide tablet eleven wide computer column pt-0 pb-0">
            @if ($data['anime_active']->value == 1)
            <div class="dark-segment">
                <div class="segment-title">Animeler</div>
                <ul class="flex flex-wrap flex-home">
                    @foreach ($animes as $item)
                    @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus ==
                    2)))
                    <li class="mofy-moviesli" id="data_8263">
                        <div class="mofy-movbox">
                            <div class="mofy-movbox-image relative">
                                <a href="{{url('anime/'.$item->short_name)}}" title="{{$item->name}}">
                                    <img class="" src="../../../{{$item->image}}" alt="{{$item->name}}" data-src="">
                                    <div class="mofy-movbox-on absolute">
                                        <div class="mofy-movpoint flex items-center justify-between absolute">
                                            <span class="flex items-center">
                                                <i class="fa-solid fa-star"></i>
                                                {{$item->score}}
                                            </span>
                                            <p>{{$item->date}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="mofy-movbox-text">
                                <span class="block">
                                    <a href="{{url('anime/'.$item->short_name)}}" class="block truncate">
                                        {{$item->name}}
                                    </a>
                                </span>
                                <p class="truncate">{{$item->main_category_name ?? 'Genel'}}</p>
                            </div>
                        </div>
                    </li>
                    @else
                    <li class="mofy-moviesli" id="data_8263">
                        <div class="mofy-movbox">
                            <div class="mofy-movbox-image relative">
                                <a href="javascript:;" onclick="login()" title="{{$item->name}}">
                                    <img class="" src="../../../{{$item->image}}" alt="{{$item->name}}" data-src=""
                                        style="filter: blur(7px);">
                                    <div class="mofy-movbox-on absolute">
                                        <div style="margin-top: 60%; z-index: 2;">
                                            <a class="overlay-button" href="javascript:;" onclick="login()"
                                                style="font-size: 10px; text-align: center;">Görmek için
                                                giriş yapınız</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="mofy-movbox-text">
                                <span class="block">
                                    <a href="javascript:;" onclick="login()" class="block truncate">
                                        Bilinmiyor
                                    </a>
                                </span>
                                <p class="truncate">Bilinmiyor</p>
                            </div>
                        </div>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            @endif
            @if ($data['webtoon_active']->value == 1)
            <div class="dark-segment">
                <div class="segment-title">Webtoonlar</div>
                <ul class="flex flex-wrap flex-home">
                    @foreach ($webtoons as $item)
                    @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus ==
                    2)))
                    <li class="mofy-moviesli" id="data_8263">
                        <div class="mofy-movbox">
                            <div class="mofy-movbox-image relative">
                                <a href="{{url('webtoon/'.$item->short_name)}}" title="{{$item->name}}">
                                    <img class="" src="../../../{{$item->image}}" alt="{{$item->name}}" data-src="">
                                    <div class="mofy-movbox-on absolute">
                                        <div class="mofy-movpoint flex items-center justify-between absolute">
                                            <span class="flex items-center">
                                                <i class="fa-solid fa-star"></i>
                                                {{$item->score}}
                                            </span>
                                            <p>{{$item->date}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="mofy-movbox-text">
                                <span class="block">
                                    <a href="{{url('webtoon/'.$item->short_name)}}" class="block truncate">
                                        {{$item->name}}
                                    </a>
                                </span>
                                <p class="truncate">{{$item->main_category_name ?? 'Genel'}}</p>
                            </div>
                        </div>
                    </li>
                    @else
                    <li class="mofy-moviesli" id="data_8263">
                        <div class="mofy-movbox">
                            <div class="mofy-movbox-image relative">
                                <a href="javascript:;" onclick="login()" title="{{$item->name}}">
                                    <img class="" src="../../../{{$item->image}}" alt="{{$item->name}}" data-src=""
                                        style="filter: blur(7px);">
                                    <div class="mofy-movbox-on absolute">
                                        <div style="margin-top: 60%; z-index: 2;">
                                            <a class="overlay-button" href="javascript:;" onclick="login()"
                                                style="font-size: 10px; text-align: center;">Görmek için
                                                giriş yapınız</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="mofy-movbox-text">
                                <span class="block">
                                    <a href="javascript:;" onclick="login()" class="block truncate">
                                        Bilinmiyor
                                    </a>
                                </span>
                                <p class="truncate">Bilinmiyor</p>
                            </div>
                        </div>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="right floated sixteen wide tablet five wide computer column pt-0 pb-0">
            <div class="dark-segment">
                @if ($data['anime_active']->value == 1)
                <div class="segment-title" style="padding-bottom: 5px">Trend Animeler
                </div>
                <ul class="clearfix">
                    @foreach ($trend_animes as $item)
                    <li class="segment-poster-sm bigColumn" style="width:100%;padding:6.66px 10px">
                        <div class="poster poster-xs">
                            <a href="{{url('anime/'.$item->short_name)}}">
                                <div class="poster-subject">
                                    <h2 class="truncate">{{$item->name}}</h2>
                                    <p class="poster-meta">
                                        <span class="episode-no">
                                            <span class="item rating">
                                                <i class="fa-solid fa-star"></i>
                                                {{$item->score}}</span>
                                            &middot; {{$item->date}}
                                        </span>
                                    </p>
                                </div>
                                <img src="../../../{{$item->image}}" alt="{{$item->name}}">
                            </a>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
            <div class="dark-segment">
                @if ($data['webtoon_active']->value == 1)
                <div class="segment-title" style="padding-bottom: 5px">Trend Animeler
                </div>
                <ul class="clearfix">
                    @foreach ($trend_webtoons as $item)
                    <li class="segment-poster-sm bigColumn" style="width:100%;padding:6.66px 10px">
                        <div class="poster poster-xs">
                            <a href="{{url('webtoon/'.$item->short_name)}}">
                                <div class="poster-subject">
                                    <h2 class="truncate">{{$item->name}}</h2>
                                    <p class="poster-meta">
                                        <span class="episode-no">
                                            <span class="item rating">
                                                <i class="fa-solid fa-star"></i>
                                                {{$item->score}}</span>
                                            &middot; {{$item->date}}
                                        </span>
                                    </p>
                                </div>
                                <img src="../../../{{$item->image}}" alt="{{$item->name}}">
                            </a>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    var Swipes = new Swiper('.swiper-container', {
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
        },
});
</script>
@endsection
