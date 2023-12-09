<!-- @extends("index.themes.moviefx.layouts.main")
@section('index_content')



<div class="featured-segment">
    <div class="row">
        <div id="owl-demo" class="owl-carousel owl-theme col-lg-8">
            @foreach ($slider_image as $index => $item)
            <div class="item">
                <img src="../../../{{$item->optional ?? ''}}" alt="">
            </div>
            @endforeach
        </div>
        <div class="owl-dots col-lg-2">
            <div class="">
                @foreach ($slider_image as $index => $item)
                <button role="button" class="owl-dot"><span><img src="../../../{{$item->optional ?? ''}}" alt=""
                            style="height: 50px;"></span></button>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div data-gets data-type="ssf"></div>
<div class="dark-segment">
    <div class="segment-title pt-lg">Yabancı Dizi Son Bölümler</div>
    <ul class="clearfix" id="result_lastEpisodes">
        <li class="segment-poster-sm">
            <div class="poster poster-xs">
                <a href="#" data-navigo>
                    <span class="date">
                        <date class="today">Bugün</date>
                    </span>
                    <div class="poster-subject">
                        <h2 class="truncate">Julia</h2>
                        <p class="poster-meta">
                            <span class="episode-no">Sezon 2 &middot; Bölüm 4</span>
                        </p>
                    </div>
                    <img alt="Julia 2. sezon/4. bolum" src="uploads/series/julia_thumb.jpg">
                </a>
            </div>
        </li>
        <li class="segment-poster-sm">
            <div class="poster poster-xs">
                <a href="#" data-navigo>
                    <span class="date">
                        <date class="today">Bugün</date>
                    </span>
                    <div class="poster-subject">
                        <h2 class="truncate">Rap Sh!t</h2>
                        <p class="poster-meta">
                            <span class="episode-no">Sezon 2 &middot; Bölüm 4</span>
                        </p>
                    </div>
                    <img alt="Rap Sh!t 2. sezon/4. bolum" src="uploads/series/rap-sh-t_thumb.jpg">
                </a>
            </div>
        </li>
        <li class="segment-poster-sm">
            <div class="poster poster-xs">
                <a href="#" data-navigo>
                    <span class="date">
                        <date class="today">Bugün</date>
                    </span>
                    <div class="poster-subject">
                        <h2 class="truncate">Frasier</h2>
                        <p class="poster-meta">
                            <span class="episode-no">Sezon 1 &middot; Bölüm 8</span>
                        </p>
                    </div>
                    <img alt="Frasier 1. sezon/8. bolum" src="uploads/series/frasier_thumb.jpg">
                </a>
            </div>
        </li>
        <li class="segment-poster-sm tv-season-final">
            <div class="poster poster-xs">
                <a href="#" data-navigo>
                    <span class="date">
                        <date class="today">Bugün</date>
                    </span>
                    <div class="poster-subject">
                        <h2 class="truncate">Boku no Daemon</h2>
                        <p class="poster-meta">
                            <span class="episode-no">Sezon 1 &middot; Bölüm 13</span>
                        </p>
                    </div>
                    <img alt="Boku no Daemon 1. sezon/13. bolum" src="uploads/series/my-daemon_thumb.jpg">
                </a>
            </div>
        </li>
        <li class="segment-poster-sm tv-season-new">
            <div class="poster poster-xs">
                <a href="#" data-navigo>
                    <span class="date">
                        <date class="today">Bugün</date>
                    </span>
                    <div class="poster-subject">
                        <h2 class="truncate">Boku no Daemon</h2>
                        <p class="poster-meta">
                            <span class="episode-no">Sezon 1 &middot; Bölüm 1</span>
                            <span class="episode-ses">
                                <i class="mofylag grey en" data-tooltip="Türkçe Altyazı" data-inverted></i>
                            </span>
                        </p>
                    </div>
                    <img alt="Boku no Daemon 1. sezon/1. bolum" src="uploads/series/my-daemon_thumb.jpg">
                </a>
            </div>
        </li>
        <li class="segment-poster-sm tv-season-final">
            <div class="poster poster-xs">
                <a href="#" data-navigo>
                    <span class="date">
                        <date class="today">Bugün</date>
                    </span>
                    <div class="poster-subject">
                        <h2 class="truncate">Robyn Hood</h2>
                        <p class="poster-meta">
                            <span class="episode-no">Sezon 1 &middot; Bölüm 8</span>
                            <span class="episode-ses">
                                <i class="mofylag grey en" data-tooltip="Türkçe Altyazı" data-inverted></i>
                            </span>
                        </p>
                    </div>
                    <img class="" alt="Robyn Hood 1. sezon/8. bolum" src="uploads/series/robyn-hood_thumb.jpg"
                        data-src="uploads/series/robyn-hood_thumb.jpg">
                </a>
            </div>
        </li>
    </ul>
    <button type="button" class="ui button load-more series-load-more" data-page="1" type="button">Daha Fazla
        Göster</button>
    <div class="ui grid mt-0 mb-0">
        <div class="left floated sixteen wide tablet eleven wide computer column pt-0 pb-0">
            <div class="dark-segment">
                <div class="segment-title">Son Eklenen Filmler</div>
                <ul class="flex flex-wrap flex-home">
                    <li class="mofy-moviesli" id="data_8263">
                        <div class="mofy-movbox">
                            <div class="mofy-movbox-image relative">
                                <a href="#" data-navigo title="Bottoms izle">
                                    <img class="lazy-wide" src="uploads/series/bottoms.jpg" alt="Bottoms" data-src="">
                                    <div class="mofy-movbox-on absolute">
                                        <div class="mofy-movsound flex justify-end">
                                            <i class="mofylag tr" data-tooltip="Türkçe Dublaj" data-inverted></i>
                                            <i class="mofylag grey en" data-tooltip="Türkçe Altyazı" data-inverted></i>
                                        </div>
                                        <div class="mofy-movpoint flex items-center justify-between absolute">
                                            <span class="flex items-center">
                                                <svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                                6.9
                                            </span>
                                            <p>2023</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="mofy-movbox-text">
                                <span class="block">
                                    <a href="#" class="block truncate" data-navigo>
                                        Bottoms
                                    </a>
                                </span>
                                <p class="truncate">Komedi, Romantik</p>
                            </div>
                        </div>
                    </li>
                    <li class="mofy-moviesli" id="data_8262">
                        <div class="mofy-movbox">
                            <div class="mofy-movbox-image relative">
                                <a href="#" data-navigo title="Ünlü Stilistin Gizemli Ölümü izle">
                                    <img class="" src="uploads/series/historia-de-un-crimen-mauricio-leal.jpg"
                                        alt="Ünlü Stilistin Gizemli Ölümü">
                                    <div class="mofy-movbox-on absolute">
                                        <div class="mofy-movsound flex justify-end">
                                            <i class="mofylag tr" data-tooltip="Türkçe Dublaj" data-inverted></i>
                                            <i class="mofylag grey en" data-tooltip="Türkçe Altyazı" data-inverted></i>
                                        </div>
                                        <div class="mofy-movpoint flex items-center justify-between absolute">
                                            <span class="flex items-center">
                                                <svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                                0.0
                                            </span>
                                            <p>2023</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="mofy-movbox-text">
                                <span class="block">
                                    <a href="#" class="block truncate" data-navigo>
                                        Ünlü Stilistin Gizemli Ölümü
                                    </a>
                                </span>
                                <p class="truncate">Suç</p>
                            </div>
                        </div>
                    </li>
                    <li class="mofy-moviesli" id="data_8204">
                        <div class="mofy-movbox">
                            <div class="mofy-movbox-image relative">
                                <a href="#" data-navigo title="Oppenheimer izle">
                                    <img class="" src="uploads/series/oppenheimer.jpg" alt="Oppenheimer"
                                        data-src="uploads/series/oppenheimer.jpg">
                                    <div class="mofy-movbox-on absolute">
                                        <div class="mofytrend absolute">
                                            <i class="bolt icon black mofysymbol"></i>
                                            <div class="mofytrend-text absolute text-center">
                                                <span class="block">HIT</span>
                                            </div>
                                        </div>
                                        <div class="mofy-movsound flex justify-end">
                                            <i class="mofylag tr" data-tooltip="Türkçe Dublaj" data-inverted></i>
                                            <i class="mofylag grey en" data-tooltip="Türkçe Altyazı" data-inverted></i>
                                        </div>
                                        <div class="mofy-movpoint flex items-center justify-between absolute">
                                            <span class="flex items-center">
                                                <svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                                8.5
                                            </span>
                                            <p>2023</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="mofy-movbox-text">
                                <span class="block">
                                    <a href="#" class="block truncate" data-navigo>
                                        Oppenheimer
                                    </a>
                                </span>
                                <p class="truncate">Biyografi, Dram, Tarih</p>
                            </div>
                        </div>
                    </li>
                    <li class="mofy-moviesli" id="data_8261">
                        <div class="mofy-movbox">
                            <div class="mofy-movbox-image relative">
                                <a href="#" data-navigo title="Kimseden Bana İnanmasını Beklemiyorum izle">
                                    <img class="" src="uploads/series/no-voy-a-pedirle-a-nadie-que-me-crea.jpg"
                                        alt="Kimseden Bana İnanmasını Beklemiyorum">
                                    <div class="mofy-movbox-on absolute">
                                        <div class="mofy-movsound flex justify-end">
                                            <i class="mofylag grey en" data-tooltip="Türkçe Altyazı" data-inverted></i>
                                        </div>
                                        <div class="mofy-movpoint flex items-center justify-between absolute">
                                            <span class="flex items-center">
                                                <svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                                0.0
                                            </span>
                                            <p>2023</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="mofy-movbox-text">
                                <span class="block">
                                    <a href="#" class="block truncate" data-navigo>
                                        Kimseden Bana İnanmasını Beklemiyorum
                                    </a>
                                </span>
                                <p class="truncate">Dram, Gerilim, Komedi</p>
                            </div>
                        </div>
                    </li>
                    <li class="mofy-moviesli" id="data_8259">
                        <div class="mofy-movbox">
                            <div class="mofy-movbox-image relative">
                                <a href="#" data-navigo title="Hell House LLC Origins: The Carmichael Manor izle">
                                    <img class="" src="uploads/series/hell-house-llc-origins-the-carmichael-manor.jpg"
                                        alt="Hell House LLC Origins: The Carmichael Manor">
                                    <div class="mofy-movbox-on absolute">
                                        <div class="mofy-movsound flex justify-end">
                                            <i class="mofylag grey en" data-tooltip="Türkçe Altyazı" data-inverted></i>
                                        </div>
                                        <div class="mofy-movpoint flex items-center justify-between absolute">
                                            <span class="flex items-center">
                                                <svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                                0.0
                                            </span>
                                            <p>2023</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="mofy-movbox-text">
                                <span class="block">
                                    <a href="#" class="block truncate" data-navigo>
                                        Hell House LLC Origins: The Carmichael Manor
                                    </a>
                                </span>
                                <p class="truncate">Gizem, Korku</p>
                            </div>
                        </div>
                    </li>
                    <li class="mofy-moviesli" id="data_8258">
                        <div class="mofy-movbox">
                            <div class="mofy-movbox-image relative">
                                <a href="#" data-navigo title="Ölüm Odası izle">
                                    <img class="" src="uploads/series/the-kill-room.jpg" alt="Ölüm Odası">
                                    <div class="mofy-movbox-on absolute">
                                        <div class="mofy-movsound flex justify-end">
                                            <i class="mofylag grey en" data-tooltip="Türkçe Altyazı" data-inverted></i>
                                        </div>
                                        <div class="mofy-movpoint flex items-center justify-between absolute">
                                            <span class="flex items-center">
                                                <svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                                5.4
                                            </span>
                                            <p>2023</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="mofy-movbox-text">
                                <span class="block">
                                    <a href="#" class="block truncate" data-navigo>
                                        Ölüm Odası
                                    </a>
                                </span>
                                <p class="truncate">Gerilim, Komedi, Suç</p>
                            </div>
                        </div>
                    </li>
                    <li class="mofy-moviesli" id="data_8257">
                        <div class="mofy-movbox">
                            <div class="mofy-movbox-image relative">
                                <a href="#" data-navigo title="Back on the Strip izle">
                                    <img class="" src="uploads/series/back-on-the-strip.jpg" alt="Back on the Strip">
                                    <div class="mofy-movbox-on absolute">
                                        <div class="mofy-movsound flex justify-end">
                                            <i class="mofylag grey en" data-tooltip="Türkçe Altyazı" data-inverted></i>
                                        </div>
                                        <div class="mofy-movpoint flex items-center justify-between absolute">
                                            <span class="flex items-center">
                                                <svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                                5.0
                                            </span>
                                            <p>2023</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="mofy-movbox-text">
                                <span class="block">
                                    <a href="#" class="block truncate" data-navigo>
                                        Back on the Strip
                                    </a>
                                </span>
                                <p class="truncate">Komedi</p>
                            </div>
                        </div>
                    </li>
                    <li class="mofy-moviesli" id="data_8256">
                        <div class="mofy-movbox">
                            <div class="mofy-movbox-image relative">
                                <a href="#" data-navigo title="Leo izle">
                                    <img class="" src="uploads/series/leo.jpg" alt="Leo">
                                    <div class="mofy-movbox-on absolute">
                                        <div class="mofy-movsound flex justify-end">
                                            <i class="mofylag tr" data-tooltip="Türkçe Dublaj" data-inverted></i>
                                            <i class="mofylag grey en" data-tooltip="Türkçe Altyazı" data-inverted></i>
                                        </div>
                                        <div class="mofy-movpoint flex items-center justify-between absolute">
                                            <span class="flex items-center">
                                                <svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg>
                                                0.0
                                            </span>
                                            <p>2023</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="mofy-movbox-text">
                                <span class="block">
                                    <a href="#" class="block truncate" data-navigo>
                                        Leo
                                    </a>
                                </span>
                                <p class="truncate">Aile, Animasyon, Komedi</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="right floated sixteen wide tablet five wide computer column pt-0 pb-0">
            <div class="dark-segment">
                <div class="segment-title" style="padding-bottom: 5px">Trendler
                </div>
                <ul class="clearfix">
                    <li class="segment-poster-sm bigColumn" style="width:100%;padding:6.66px 10px">
                        <div class="poster poster-xs">
                            <a href="#" data-navigo>
                                <div class="poster-subject">
                                    <h2 class="truncate">Breaking Bad</h2>
                                    <p class="poster-meta">
                                        <span class="episode-no">
                                            <span class="item rating"><svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg> 9.5</span>
                                            &middot; 2008
                                        </span>
                                    </p>
                                </div>
                                <img src="uploads/series/breaking-bad-izle-1_thumb.jpg" alt="Breaking Bad">
                            </a>
                        </div>
                    </li>
                    <li class="segment-poster-sm bigColumn" style="width:100%;padding:6.66px 10px">
                        <div class="poster poster-xs">
                            <a href="#" data-navigo>
                                <div class="poster-subject">
                                    <h2 class="truncate">Sherlock</h2>
                                    <p class="poster-meta">
                                        <span class="episode-no">
                                            <span class="item rating"><svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg> 9.2</span>
                                            &middot; 2010
                                        </span>
                                    </p>
                                </div>
                                <img class="" src="uploads/series/sherlock-izle-1_thumb.jpg" alt="Sherlock">
                            </a>
                        </div>
                    </li>
                    <li class="segment-poster-sm bigColumn" style="width:100%;padding:6.66px 10px">
                        <div class="poster poster-xs">
                            <a href="#" data-navigo>
                                <div class="poster-subject">
                                    <h2 class="truncate">The Sopranos</h2>
                                    <p class="poster-meta">
                                        <span class="episode-no">
                                            <span class="item rating"><svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg> 9.2</span>
                                            &middot; 1999
                                        </span>
                                    </p>
                                </div>
                                <img class="" src="uploads/series/the-sopranos-izle_thumb.jpg" alt="The Sopranos"
                                    data-src="uploads/series/the-sopranos-izle_thumb.jpg">
                            </a>
                        </div>
                    </li>
                    <li class="segment-poster-sm bigColumn" style="width:100%;padding:6.66px 10px">
                        <div class="poster poster-xs">
                            <a href="#" data-navigo>
                                <div class="poster-subject">
                                    <h2 class="truncate">Arcane</h2>
                                    <p class="poster-meta">
                                        <span class="episode-no">
                                            <span class="item rating"><svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg> 9.1</span>
                                            &middot; 2021
                                        </span>
                                    </p>
                                </div>
                                <img class="" src="uploads/series/arcane-league-of-legends_thumb.jpg" alt="Arcane">
                            </a>
                        </div>
                    </li>
                    <li class="segment-poster-sm bigColumn" style="width:100%;padding:6.66px 10px">
                        <div class="poster poster-xs">
                            <a href="#" data-navigo>
                                <div class="poster-subject">
                                    <h2 class="truncate">Friends</h2>
                                    <p class="poster-meta">
                                        <span class="episode-no">
                                            <span class="item rating"><svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg> 8.9</span>
                                            &middot; 1994
                                        </span>
                                    </p>
                                </div>
                                <img class="" src="uploads/series/friends-izle-1_thumb.jpg" alt="Friends">
                            </a>
                        </div>
                    </li>
                    <li class="segment-poster-sm bigColumn" style="width:100%;padding:6.66px 10px">
                        <div class="poster poster-xs">
                            <a href="#" data-navigo>
                                <div class="poster-subject">
                                    <h2 class="truncate">Stranger Things</h2>
                                    <p class="poster-meta">
                                        <span class="episode-no">
                                            <span class="item rating"><svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg> 8.9</span>
                                            &middot; 2016
                                        </span>
                                    </p>
                                </div>
                                <img class="" src="uploads/series/stranger-things-izle-4_thumb.jpg"
                                    alt="Stranger Things">
                            </a>
                        </div>
                    </li>
                    <li class="segment-poster-sm bigColumn" style="width:100%;padding:6.66px 10px">
                        <div class="poster poster-xs">
                            <a href="#" data-navigo>
                                <div class="poster-subject">
                                    <h2 class="truncate">Peaky Blinders</h2>
                                    <p class="poster-meta">
                                        <span class="episode-no">
                                            <span class="item rating"><svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg> 8.8</span>
                                            &middot; 2013
                                        </span>
                                    </p>
                                </div>
                                <img src="uploads/series/peaky-blinders-izle-1_thumb.jpg" alt="Peaky Blinders">
                            </a>
                        </div>
                    </li>
                    <li class="segment-poster-sm bigColumn" style="width:100%;padding:6.66px 10px">
                        <div class="poster poster-xs">
                            <a href="#" data-navigo>
                                <div class="poster-subject">
                                    <h2 class="truncate">Dark</h2>
                                    <p class="poster-meta">
                                        <span class="episode-no">
                                            <span class="item rating"><svg class="mofycon">
                                                    <use xlink:href="#icon-star"></use>
                                                </svg> 8.6</span>
                                            &middot; 2017
                                        </span>
                                    </p>
                                </div>
                                <img class="" src="uploads/series/dark-izle-3_thumb.jpg" alt="Dark">
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

-->