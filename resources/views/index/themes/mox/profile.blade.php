@extends('index.themes.mox.layouts.main')
@section('index_content')
    <main>

        <!-- Kullanıcı Bilgileri Bölümü -->
        <section class="movie-details-area" data-background="../../../user/mox/img/bg/movie_details_bg.jpg">
            <div class="container">
                <div class="row align-items-center position-relative">
                    <div class="col-xl-3 col-lg-4">
                        <div class="../../../user/mox/movie-details-img">
                            <img src="../../../{{ $user->image ?? 'user/img/profile/default.png' }}" alt=""
                                style="min-width: 303px;  max-width: 303px;">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-8">
                        <div class="movie-details-content">
                            <h2><span>{{ $user->name }}</span></h2>
                            <h4>@ {{ $user->username }}</h4>
                            <p>
                                {{ $user->description ?? 'Açıklama Mevcut değil' }}
                            </p>
                            <div class="movie-details-prime">
                                <ul>
                                    @if (Auth::user() && $user->code == Auth::user()->code)
                                        <li class="watch">
                                            <a href="{{ route('change_profile_settings_screen') }}" class="btn"><i
                                                    class="fas fa-info"></i>Bilgilerimi Değiştir</a>
                                        </li>
                                        <li class="watch">
                                            <a href="{{ route('change_profile_password_screen') }}" class="btn"><i
                                                    class="fas fa-key"></i>Şifremi Değiştir</a>
                                        </li>
                                    @else
                                        @if ($followed_user)
                                            <li class=" watch">
                                                <a href="javascript:;" class="btn" onclick="unfollowIndexUser()"><i
                                                        class="fas fa-heart"></i>Kullanıcıyı Takipten Çıkar</a>
                                                <p style="color:red;" id="followUserTextMessage"></p>
                                            </li>
                                        @else
                                            <li class=" watch">
                                                <a href="javascript:;" class="btn" onclick="followIndexUser()"><i
                                                        class="fas fa-heart"></i>Kullanıcıyı Takip Et</a>
                                                <p style="color:red;" id="followUserTextMessage"></p>
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="movie-details-btn">
                        @if (false)
                            <a href="../../../user/mox/img/poster/movie_details_img.jpg" class="download-btn"
                                download="">İndir
                                <img src="../../../user/mox/fonts/download.svg" alt=""></a>
                        @endif

                    </div>
                </div>
            </div>
        </section>
        <!-- Kullanıcı Bilgileri Bölümü End -->

        <!-- Beğenilenler Bölümü -->
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
                            @if ($data['anime_active']->value == 1)
                                <button class="" data-filter=".tab-favorite-anime">Animeler</button>
                            @endif
                            @if ($data['webtoon_active']->value == 1)
                                <button class="" data-filter=".tab-favorite-webtoon">Webtoonlar</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row tr-movie-active">
                    @if ($data['anime_active']->value == 1)
                        @foreach ($favorite_animes as $item)
                            @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-favorite-anime">
                                    <div class="movie-item movie-item-three mb-50">
                                        <div class="movie-poster">
                                            <img src="{{ url($item->image) }}" alt=""
                                                style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;">
                                            <ul class="overlay-btn">
                                                <li><a href="{{ url('anime/' . $item->short_name) }}" class="btn">Detay</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="movie-content">
                                            <div class="top">
                                                <h5 class="title"><a
                                                        href="{{ url('anime/' . $item->short_name) }}">{{ $item->name }}</a>
                                                </h5>
                                                <span class="date">{{ $item->date }}</span>
                                            </div>
                                            <div class="bottom">
                                                <ul>
                                                    <li><span class="quality">{{ $item->main_category_name }}</span></li>
                                                    <li>
                                                        <span class="duration"><i class="far fa-clock"></i>
                                                            {{ $item->average_min }} dk</span>
                                                        <span class="rating"><i
                                                                class="fas fa-thumbs-up"></i>{{ $item->score }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-favorite-anime">
                                    <div class="movie-item movie-item-three mb-50">
                                        <div class="movie-poster">
                                            <div class="movie-poster" style="filter: blur(7px);">
                                                <img src=" {{ url($item->image) }}" alt=""
                                                    style=" min-width: 303px; min-height: 430px; max-width:
                                                                                303px; max-height: 430px;">
                                            </div>
                                            <ul class="overlay-btn">
                                                <li><a href="{{ route('login') }}" class="btn">Görmek için giriş
                                                        yapınız</a></li>

                                            </ul>
                                        </div>
                                        <div class="movie-content">
                                            <div class="top">
                                                <h5 class="title"><a href="{{ route('login') }}">Bilinmiyor</a>
                                                </h5>
                                                <span class=" date">0000</span>
                                            </div>
                                            <div class="bottom">
                                                <ul>
                                                    <li><span class="quality">Bilinmiyor</span></li>
                                                    <li>
                                                        <span class="duration"><i class="far fa-clock"></i>
                                                            0 dk</span>
                                                        <span class="rating"><i
                                                                class="fas fa-thumbs-up"></i>{{ $item->score }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif

                    @if ($data['webtoon_active']->value == 1)
                        @foreach ($favorite_webtoons as $item)
                            @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-favorite-webtoon">
                                    <div class="movie-item movie-item-three mb-50">
                                        <div class="movie-poster">
                                            <img src="{{ url($item->image) }}" alt=""
                                                style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;">
                                            <ul class="overlay-btn">
                                                <li><a href="{{ url('webtoon/' . $item->short_name) }}"
                                                        class="btn">Detay</a></li>

                                            </ul>
                                        </div>
                                        <div class="movie-content">
                                            <div class="top">
                                                <h5 class="title"><a
                                                        href="{{ url('webtoon/' . $item->short_name) }}">{{ $item->name }}</a>
                                                </h5>
                                                <span class="date">{{ $item->date }}</span>
                                            </div>
                                            <div class="bottom">
                                                <ul>
                                                    <li><span class="quality">{{ $item->main_category_name }}</span></li>
                                                    <li>
                                                        <span class="duration"><i class="far fa-clock"></i>
                                                            {{ $item->average_min }} dk</span>
                                                        <span class="rating"><i
                                                                class="fas fa-thumbs-up"></i>{{ $item->score }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-favorite-webtoon">
                                    <div class="movie-item movie-item-three mb-50">
                                        <div class="movie-poster">
                                            <div class="movie-poster" style="filter: blur(7px);">
                                                <img src=" {{ url($item->image) }}" alt=""
                                                    style=" min-width: 303px; min-height: 430px; max-width:
                                                                                                                303px; max-height: 430px;">
                                            </div>
                                            <ul class="overlay-btn">
                                                <li><a href="{{ route('login') }}" class="btn">Görmek için giriş
                                                        yapınız</a></li>

                                            </ul>
                                        </div>
                                        <div class="movie-content">
                                            <div class="top">
                                                <h5 class="title"><a href="{{ route('login') }}">Bilinmiyor</a>
                                                </h5>
                                                <span class=" date">0000</span>
                                            </div>
                                            <div class="bottom">
                                                <ul>
                                                    <li><span class="quality">Bilinmiyor</span></li>
                                                    <li>
                                                        <span class="duration"><i class="far fa-clock"></i>
                                                            0 dk</span>
                                                        <span class="rating"><i
                                                                class="fas fa-thumbs-up"></i>{{ $item->score }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
            </div>
        </section>
        <!-- Beğenilenler Bölümü End -->

        <!-- Takip Edilenler Bölümü-->
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
                            @if ($data['anime_active']->value == 1)
                                <button class="" data-filter=".tab-follow_animes">Animeler</button>
                            @endif
                            @if ($data['webtoon_active']->value == 1)
                                <button class="" data-filter=".tab-follow_webtoons">Webtoonlar</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row tr-movie-active">
                    @if ($data['anime_active']->value == 1)
                        @foreach ($follow_animes as $item)
                            @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-follow_animes">
                                    <div class="movie-item movie-item-three mb-50">
                                        <div class="movie-poster">
                                            <img src="{{ url($item->image) }}" alt=""
                                                style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;">
                                            <ul class="overlay-btn">
                                                <li><a href="{{ url('anime/' . $item->short_name) }}"
                                                        class="btn">Detay</a></li>

                                            </ul>
                                        </div>
                                        <div class="movie-content">
                                            <div class="top">
                                                <h5 class="title"><a
                                                        href="{{ url('anime/' . $item->short_name) }}">{{ $item->name }}</a>
                                                </h5>
                                                <span class="date">{{ $item->date }}</span>
                                            </div>
                                            <div class="bottom">
                                                <ul>
                                                    <li><span class="quality">{{ $item->main_category_name }}</span></li>
                                                    <li>
                                                        <span class="duration"><i class="far fa-clock"></i>
                                                            {{ $item->average_min }} dk</span>
                                                        <span class="rating"><i
                                                                class="fas fa-thumbs-up"></i>{{ $item->score }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-follow_animes">
                                    <div class="movie-item movie-item-three mb-50">
                                        <div class="movie-poster">
                                            <div class="movie-poster" style="filter: blur(7px);">
                                                <img src=" {{ url($item->image) }}" alt=""
                                                    style=" min-width: 303px; min-height: 430px; max-width:
                                                                                                                                            303px; max-height: 430px;">
                                            </div>
                                            <ul class="overlay-btn">
                                                <li><a href="{{ route('login') }}" class="btn">Görmek için giriş
                                                        yapınız</a></li>

                                            </ul>
                                        </div>
                                        <div class="movie-content">
                                            <div class="top">
                                                <h5 class="title"><a href="{{ route('login') }}">Bilinmiyor</a>
                                                </h5>
                                                <span class=" date">0000</span>
                                            </div>
                                            <div class="bottom">
                                                <ul>
                                                    <li><span class="quality">Bilinmiyor</span></li>
                                                    <li>
                                                        <span class="duration"><i class="far fa-clock"></i>
                                                            0 dk</span>
                                                        <span class="rating"><i
                                                                class="fas fa-thumbs-up"></i>{{ $item->score }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    @if ($data['webtoon_active']->value == 1)
                        @foreach ($follow_webtoons as $item)
                            @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-follow_webtoons">
                                    <div class="movie-item movie-item-three mb-50">
                                        <div class="movie-poster">
                                            <img src="{{ url($item->image) }}" alt=""
                                                style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;">
                                            <ul class="overlay-btn">
                                                <li><a href="{{ url('webtoon/' . $item->short_name) }}"
                                                        class="btn">Detay</a></li>

                                            </ul>
                                        </div>
                                        <div class="movie-content">
                                            <div class="top">
                                                <h5 class="title"><a
                                                        href="{{ url('webtoon/' . $item->short_name) }}">{{ $item->name }}</a>
                                                </h5>
                                                <span class="date">{{ $item->date }}</span>
                                            </div>
                                            <div class="bottom">
                                                <ul>
                                                    <li><span class="quality">{{ $item->main_category_name }}</span></li>
                                                    <li>
                                                        <span class="duration"><i class="far fa-clock"></i>
                                                            {{ $item->average_min }} dk</span>
                                                        <span class="rating"><i
                                                                class="fas fa-thumbs-up"></i>{{ $item->score }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-follow_webtoons">
                                    <div class="movie-item movie-item-three mb-50">
                                        <div class="movie-poster">
                                            <div class="movie-poster" style="filter: blur(7px);">
                                                <img src=" {{ url($item->image) }}" alt=""
                                                    style=" min-width: 303px; min-height: 430px; max-width:
                                                                                                                            303px; max-height: 430px;">
                                            </div>
                                            <ul class="overlay-btn">
                                                <li><a href="{{ route('login') }}" class="btn">Görmek için giriş
                                                        yapınız</a></li>

                                            </ul>
                                        </div>
                                        <div class="movie-content">
                                            <div class="top">
                                                <h5 class="title"><a href="{{ route('login') }}">Bilinmiyor</a>
                                                </h5>
                                                <span class=" date">0000</span>
                                            </div>
                                            <div class="bottom">
                                                <ul>
                                                    <li><span class="quality">Bilinmiyor</span></li>
                                                    <li>
                                                        <span class="duration"><i class="far fa-clock"></i>
                                                            0 dk</span>
                                                        <span class="rating"><i
                                                                class="fas fa-thumbs-up"></i>{{ $item->score }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
            </div>
        </section>
        <!-- Takip Edilenler Bölümü End-->

        <!-- İzlenenler Bölümü -->
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
                            @if ($data['anime_active']->value == 1)
                                <button class="" data-filter=".tab-watched_animes">Animeler</button>
                            @endif
                            @if ($data['webtoon_active']->value == 1)
                                <button class="" data-filter=".tab-readed_webtoons">Webtoonlar</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row tr-movie-active">
                    @if ($data['anime_active']->value == 1)
                        @foreach ($watched_animes as $item)
                            @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-watched_animes">
                                    <div class="movie-item movie-item-three mb-50">
                                        <div class="movie-poster">
                                            <img src="{{ url($item->image) }}" alt=""
                                                style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;">
                                            <ul class="overlay-btn">
                                                <li><a href="{{ url('webtoon/' . $item->short_name) }}"
                                                        class="btn">Detay</a></li>

                                            </ul>
                                        </div>
                                        <div class="movie-content">
                                            <div class="top">
                                                <h5 class="title"><a
                                                        href="{{ url('webtoon/' . $item->short_name) }}">{{ $item->name }}</a>
                                                </h5>
                                                <span class="date">{{ $item->date }}</span>
                                            </div>
                                            <div class="bottom">
                                                <ul>
                                                    <li><span class="quality">{{ $item->main_category_name }}</span></li>
                                                    <li>
                                                        <span class="duration"><i class="far fa-clock"></i>
                                                            {{ $item->average_min }} dk</span>
                                                        <span class="rating"><i
                                                                class="fas fa-thumbs-up"></i>{{ $item->score }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-watched_animes">
                                    <div class="movie-item movie-item-three mb-50">
                                        <div class="movie-poster">
                                            <div class="movie-poster" style="filter: blur(7px);">
                                                <img src=" {{ url($item->image) }}" alt=""
                                                    style=" min-width: 303px; min-height: 430px; max-width:
                                                                                                                                303px; max-height: 430px;">
                                            </div>
                                            <ul class="overlay-btn">
                                                <li><a href="{{ route('login') }}" class="btn">Görmek için giriş
                                                        yapınız</a></li>

                                            </ul>
                                        </div>
                                        <div class="movie-content">
                                            <div class="top">
                                                <h5 class="title"><a href="{{ route('login') }}">Bilinmiyor</a>
                                                </h5>
                                                <span class=" date">0000</span>
                                            </div>
                                            <div class="bottom">
                                                <ul>
                                                    <li><span class="quality">Bilinmiyor</span></li>
                                                    <li>
                                                        <span class="duration"><i class="far fa-clock"></i>
                                                            0 dk</span>
                                                        <span class="rating"><i
                                                                class="fas fa-thumbs-up"></i>{{ $item->score }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    @if ($data['webtoon_active']->value == 1)
                        @foreach ($readed_webtoons as $item)
                            @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-readed_webtoons">
                                    <div class="movie-item movie-item-three mb-50">
                                        <div class="movie-poster">
                                            <img src="{{ url($item->image) }}" alt=""
                                                style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;">
                                            <ul class="overlay-btn">
                                                <li><a href="{{ url('webtoon/' . $item->short_name) }}"
                                                        class="btn">Detay</a></li>

                                            </ul>
                                        </div>
                                        <div class="movie-content">
                                            <div class="top">
                                                <h5 class="title"><a
                                                        href="{{ url('webtoon/' . $item->short_name) }}">{{ $item->name }}</a>
                                                </h5>
                                                <span class="date">{{ $item->date }}</span>
                                            </div>
                                            <div class="bottom">
                                                <ul>
                                                    <li><span class="quality">{{ $item->main_category_name }}</span></li>
                                                    <li>
                                                        <span class="duration"><i class="far fa-clock"></i>
                                                            {{ $item->average_min }} dk</span>
                                                        <span class="rating"><i
                                                                class="fas fa-thumbs-up"></i>{{ $item->score }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-readed_webtoons">
                                    <div class="movie-item movie-item-three mb-50">
                                        <div class="movie-poster">
                                            <div class="movie-poster" style="filter: blur(7px);">
                                                <img src=" {{ url($item->image) }}" alt=""
                                                    style=" min-width: 303px; min-height: 430px; max-width:
                                                                                                                                                303px; max-height: 430px;">
                                            </div>
                                            <ul class="overlay-btn">
                                                <li><a href="{{ route('login') }}" class="btn">Görmek için giriş
                                                        yapınız</a></li>

                                            </ul>
                                        </div>
                                        <div class="movie-content">
                                            <div class="top">
                                                <h5 class="title"><a href="{{ route('login') }}">Bilinmiyor</a>
                                                </h5>
                                                <span class=" date">0000</span>
                                            </div>
                                            <div class="bottom">
                                                <ul>
                                                    <li><span class="quality">Bilinmiyor</span></li>
                                                    <li>
                                                        <span class="duration"><i class="far fa-clock"></i>
                                                            0 dk</span>
                                                        <span class="rating"><i
                                                                class="fas fa-thumbs-up"></i>{{ $item->score }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
            </div>
        </section>
        <!-- İzlenenler Bölümü End -->

    </main>

    <div hidden id="hiddenDiv">

    </div>

    <script>
        const authMessage = "Lütfen İlk Önce Giriş Yapınız!"

        function followIndexUser() {
            @if (Auth::user())
                var code = `<form action="{{ route('followIndexUser') }}" method="POST" id="followIndexUserForm">
                @csrf
                <input type="text" name="followed_user_code" value="{{ $user->code }}">
            </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('followIndexUserForm').submit();
            @else
                document.getElementById('followUserTextMessage').innerText = authMessage;
            @endif
        }

        function unfollowIndexUser() {
            @if (Auth::user())
                var code = `<form action="{{ route('unfollowIndexUser') }}" method="POST" id="unfollowIndexUserForm">
                @csrf
                <input type="text" name="followed_user_code" value="{{ $user->code }}">
            </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('unfollowIndexUserForm').submit();
            @else
                document.getElementById('followUserTextMessage').innerText = authMessage;
            @endif
        }
    </script>
@endsection
