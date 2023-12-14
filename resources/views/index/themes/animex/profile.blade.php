@extends('index.themes.animex.layouts.main')
@section('index_content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('index') }}"><i class="fa fa-home"></i> Anasayfa</a>
                        <span>Profil</span>
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
                        <img src="../../../{{ $user->image ?? 'user/img/profile/default.png' }}" alt=""
                            style="max-height: 200px; min-height: 200px;">
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $user->name }}</h3>
                                <p>{{ '@' . $user->username }}</p>
                            </div>
                            <p style="margin-top: 10px;">
                                {{ $user->description }}
                            </p>
                            <div class="anime__details__widget2">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Takip Ettiği Animeler:</span> {{ count($follow_animes) }}</li>
                                            <li><span>Takip Ettiği Webtoonlar:</span> {{ count($follow_webtoons) }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Beğendiği Animeler:</span> {{ count($favorite_animes) }}</li>
                                            <li><span>Beğendiği Webtoonlar:</span> {{ count($favorite_webtoons) }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                @if (Auth::user() && $user->code == Auth::user()->code)
                                    <div>
                                        <a href="{{ route('change_profile_settings_screen') }}" class="follow-btn"><i
                                                class="fa fa-info"></i>
                                            Bilgilerimi Değiştir</a>
                                        <a href="{{ route('change_profile_password_screen') }}" class="follow-btn"><i
                                                class="fa fa-key"></i>
                                            Şifremi değiştir</a>
                                    </div>
                                @else
                                    <div>
                                        @if ($followed_user)
                                            <a href="javascript:;" onclick="unfollowIndexUser()" class="follow-btn">
                                                <i class="fa fa-plus"></i>
                                                Kullanıcıyı Takipten Çıkar
                                            </a>
                                        @else
                                            <a href="javascript:;" onclick="followIndexUser()" class="follow-btn">
                                                <i class="fa fa-plus"></i>
                                                Kullanıcıyı Takip Et
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($data['anime_active']->value == 1 || $data['webtoon_active']->value == 1)
                <div class="anime__details__content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="anime__details__text">
                                <ul class="nav nav-tabs">
                                    @if ($data['anime_active']->value == 1)
                                        <li class="nav-item">
                                            <a class="nav-link active active_tab_button" id="favorite_animes"
                                                aria-current="page" href="javascript:;"
                                                onclick="selectTab('favorite_animes','favorite_animes_tab')"
                                                data-bs-target="#favorite_animes_tab">Favori
                                                Animeler</a>
                                        </li>
                                    @endif
                                    @if ($data['webtoon_active']->value == 1)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $data['anime_active']->value == 0 ? 'active active_tab_button' : '' }}"
                                                id="favorite_webtoons"
                                                style="{{ $data['anime_active']->value == 0 ? '' : 'color:white;' }}"
                                                href="javascript:;"
                                                onclick="selectTab('favorite_webtoons','favorite_webtoons_tab')"
                                                data-bs-target="#favorite_webtoons_tab">Favori
                                                Webtoonlar</a>
                                        </li>
                                    @endif
                                    @if ($data['anime_active']->value == 1)
                                        <li class="nav-item">
                                            <a class="nav-link" id="follow_animes" style="color:white;" href="javascript:;"
                                                onclick="selectTab('follow_animes', 'follow_animes_tab')"
                                                data-bs-target="#follow_animes_tab">Takip Ettiği
                                                Animeler</a>
                                        </li>
                                    @endif
                                    @if ($data['webtoon_active']->value == 1)
                                        <li class="nav-item">
                                            <a class="nav-link" id="follow_webtoons" style="color:white;"
                                                href="javascript:;"
                                                onclick="selectTab('follow_webtoons','follow_webtoons_tab')"
                                                data-bs-target="#follow_webtoons_tab">Takip Ettiği Webtoonlar</a>
                                        </li>
                                    @endif
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    @if ($data['anime_active']->value == 1)
                                        <div class="tab-pane fade show active active_tab" id="favorite_animes_tab"
                                            role="tabpanel" aria-labelledby="favorite_animes_tab">
                                            <div class="col-lg-12 mt-5">
                                                <div class="product__page__content">
                                                    <div class="row">
                                                        @foreach ($favorite_animes as $item)
                                                            @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                                                <div class="col-lg-3 col-md-6 col-sm-6">
                                                                    <div class="product__item">
                                                                        <a href="{{ url('anime/' . $item->short_name) }}">
                                                                            <div class="product__item__pic set-bg"
                                                                                data-setbg="../../../{{ $item->image }}">
                                                                                <div class="ep">{{ $item->score }} / 5
                                                                                </div>
                                                                                <div class="comment"><i
                                                                                        class="fa fa-comments"></i>
                                                                                    {{ $item->comment_count }}
                                                                                </div>
                                                                                <div class="view"><i
                                                                                        class="fa fa-eye"></i>
                                                                                    {{ $item->click_count }}</div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="product__item__text">
                                                                            <ul>
                                                                                <li>{{ $item->main_category_name }}</li>
                                                                            </ul>
                                                                            <h5>

                                                                                <a
                                                                                    href="{{ url('anime/' . $item->short_name) }}">{{ $item->name }}</a>

                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="col-lg-3 col-md-6 col-sm-6">
                                                                    <div class="product__item">
                                                                        <a href="{{ route('loginScreen') }}">
                                                                            <div class="product__item__pic"
                                                                                data-setbg="../../../{{ $item->image }}">
                                                                                <div
                                                                                    style="width: 100%; height: 100%; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                                                                    <div class="censor set-bg"
                                                                                        data-setbg="../../../{{ $item->image }}">
                                                                                    </div>
                                                                                    <div
                                                                                        style="margin-top: 20px; z-index: 2;">
                                                                                        <a class="overlay-button"
                                                                                            href="{{ route('loginScreen') }}">
                                                                                            Görmek için giriş yapınız
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="product__item__text">
                                                                            <ul>
                                                                                <li>Bilinmiyor</li>
                                                                            </ul>
                                                                            <h5>
                                                                                <a
                                                                                    href="{{ route('loginScreen') }}">Bilinmiyor</a>
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($data['webtoon_active']->value == 1)
                                        <div class="tab-pane fade {{ $data['anime_active']->value == 0 ? 'show active active_tab' : '' }}"
                                            id="favorite_webtoons_tab" role="tabpanel"
                                            aria-labelledby="favorite_webtoons_tab">
                                            <div class="col-lg-12 mt-5">
                                                <div class="product__page__content">
                                                    <div class="row">
                                                        @foreach ($favorite_webtoons as $item)
                                                            @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                                                <div class="col-lg-3 col-md-6 col-sm-6">
                                                                    <div class="product__item">
                                                                        <a href="{{ url('anime/' . $item->short_name) }}">
                                                                            <div class="product__item__pic set-bg"
                                                                                data-setbg="../../../{{ $item->image }}">
                                                                                <div class="ep">{{ $item->score }} /
                                                                                    5</div>
                                                                                <div class="comment"><i
                                                                                        class="fa fa-comments"></i>
                                                                                    {{ $item->comment_count }}
                                                                                </div>
                                                                                <div class="view"><i
                                                                                        class="fa fa-eye"></i>
                                                                                    {{ $item->click_count }}</div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="product__item__text">
                                                                            <ul>
                                                                                <li>{{ $item->main_category_name }}</li>
                                                                            </ul>
                                                                            <h5>

                                                                                <a
                                                                                    href="{{ url('anime/' . $item->short_name) }}">{{ $item->name }}</a>

                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="col-lg-3 col-md-6 col-sm-6">
                                                                    <div class="product__item">
                                                                        <a href="{{ route('loginScreen') }}">
                                                                            <div class="product__item__pic"
                                                                                data-setbg="../../../{{ $item->image }}">
                                                                                <div
                                                                                    style="width: 100%; height: 100%; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                                                                    <div class="censor set-bg"
                                                                                        data-setbg="../../../{{ $item->image }}">
                                                                                    </div>
                                                                                    <div
                                                                                        style="margin-top: 20px; z-index: 2;">
                                                                                        <a class="overlay-button"
                                                                                            href="{{ route('loginScreen') }}">
                                                                                            Görmek için giriş yapınız
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="product__item__text">
                                                                            <ul>
                                                                                <li>Bilinmiyor</li>
                                                                            </ul>
                                                                            <h5>
                                                                                <a
                                                                                    href="{{ route('loginScreen') }}">Bilinmiyor</a>
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($data['anime_active']->value == 1)
                                        <div class="tab-pane fade" id="follow_animes_tab" role="tabpanel"
                                            aria-labelledby="follow_animes_tab">
                                            <div class="col-lg-12 mt-5">
                                                <div class="product__page__content">
                                                    <div class="row">
                                                        @foreach ($follow_animes as $item)
                                                            @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                                                <div class="col-lg-3 col-md-6 col-sm-6">
                                                                    <div class="product__item">
                                                                        <a href="{{ url('anime/' . $item->short_name) }}">
                                                                            <div class="product__item__pic set-bg"
                                                                                data-setbg="../../../{{ $item->image }}">
                                                                                <div class="ep">{{ $item->score }} /
                                                                                    5</div>
                                                                                <div class="comment"><i
                                                                                        class="fa fa-comments"></i>
                                                                                    {{ $item->comment_count }}
                                                                                </div>
                                                                                <div class="view"><i
                                                                                        class="fa fa-eye"></i>
                                                                                    {{ $item->click_count }}</div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="product__item__text">
                                                                            <ul>
                                                                                <li>{{ $item->main_category_name }}</li>
                                                                            </ul>
                                                                            <h5>

                                                                                <a
                                                                                    href="{{ url('anime/' . $item->short_name) }}">{{ $item->name }}</a>

                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="col-lg-3 col-md-6 col-sm-6">
                                                                    <div class="product__item">
                                                                        <a href="{{ route('loginScreen') }}">
                                                                            <div class="product__item__pic"
                                                                                data-setbg="../../../{{ $item->image }}">
                                                                                <div
                                                                                    style="width: 100%; height: 100%; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                                                                    <div class="censor set-bg"
                                                                                        data-setbg="../../../{{ $item->image }}">
                                                                                    </div>
                                                                                    <div
                                                                                        style="margin-top: 20px; z-index: 2;">
                                                                                        <a class="overlay-button"
                                                                                            href="{{ route('loginScreen') }}">
                                                                                            Görmek için giriş yapınız
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="product__item__text">
                                                                            <ul>
                                                                                <li>Bilinmiyor</li>
                                                                            </ul>
                                                                            <h5>
                                                                                <a
                                                                                    href="{{ route('loginScreen') }}">Bilinmiyor</a>
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($data['webtoon_active']->value == 1)
                                        <div class="tab-pane fade" id="follow_webtoons_tab" role="tabpanel"
                                            aria-labelledby="favorite_webtoons_tab">
                                            <div class="col-lg-12 mt-5">
                                                <div class="product__page__content">
                                                    <div class="row">
                                                        @foreach ($follow_webtoons as $item)
                                                            @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                                                <div class="col-lg-3 col-md-6 col-sm-6">
                                                                    <div class="product__item">
                                                                        <a href="{{ url('anime/' . $item->short_name) }}">
                                                                            <div class="product__item__pic set-bg"
                                                                                data-setbg="../../../{{ $item->image }}">
                                                                                <div class="ep">{{ $item->score }} /
                                                                                    5</div>
                                                                                <div class="comment"><i
                                                                                        class="fa fa-comments"></i>
                                                                                    {{ $item->comment_count }}
                                                                                </div>
                                                                                <div class="view"><i
                                                                                        class="fa fa-eye"></i>
                                                                                    {{ $item->click_count }}</div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="product__item__text">
                                                                            <ul>
                                                                                <li>{{ $item->main_category_name }}</li>
                                                                            </ul>
                                                                            <h5>

                                                                                <a
                                                                                    href="{{ url('anime/' . $item->short_name) }}">{{ $item->name }}</a>

                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="col-lg-3 col-md-6 col-sm-6">
                                                                    <div class="product__item">
                                                                        <a href="{{ route('loginScreen') }}">
                                                                            <div class="product__item__pic"
                                                                                data-setbg="../../../{{ $item->image }}">
                                                                                <div
                                                                                    style="width: 100%; height: 100%; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                                                                    <div class="censor set-bg"
                                                                                        data-setbg="../../../{{ $item->image }}">
                                                                                    </div>
                                                                                    <div
                                                                                        style="margin-top: 20px; z-index: 2;">
                                                                                        <a class="overlay-button"
                                                                                            href="{{ route('loginScreen') }}">
                                                                                            Görmek için giriş yapınız
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                        <div class="product__item__text">
                                                                            <ul>
                                                                                <li>Bilinmiyor</li>
                                                                            </ul>
                                                                            <h5>
                                                                                <a
                                                                                    href="{{ route('loginScreen') }}">Bilinmiyor</a>
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- Anime Section End -->

    <div hidden id="hiddenDiv">

    </div>

    <script>
        function selectTab(id, tab_id) {
            document.getElementsByClassName('active_tab_button')[0].style.color = "white";
            document.getElementsByClassName('active_tab_button')[0].classList.remove('active');
            document.getElementsByClassName('active_tab_button')[0].classList.remove('active_tab_button');

            document.getElementById(id).classList.add('active');
            document.getElementById(id).classList.add('active_tab_button');
            document.getElementById(id).style.color = "";

            document.getElementsByClassName('active_tab')[0].classList.remove('show');
            document.getElementsByClassName('active_tab')[0].classList.remove('active');
            document.getElementsByClassName('active_tab')[0].classList.remove('active_tab');

            document.getElementById(tab_id).classList.add('show');
            document.getElementById(tab_id).classList.add('active');
            document.getElementById(tab_id).classList.add('active_tab');
        }
    </script>

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
                Swal.fire({
                    title: "Hata",
                    text: authMessage,
                    color: "#fff",
                    icon: "error"
                });
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
                Swal.fire({
                    title: "Hata",
                    text: authMessage,
                    color: "#fff",
                    icon: "error"
                });
            @endif
        }
    </script>

@endsection
