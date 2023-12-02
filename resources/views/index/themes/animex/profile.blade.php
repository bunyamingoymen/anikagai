@extends("index.themes.animex.layouts.main")
@section('index_content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{route('index')}}"><i class="fa fa-home"></i> Anasayfa</a>
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
                    <div class="anime__details__pic set-bg"
                        data-setbg="../../../{{$user->image ?? 'user/img/profile/default.png'}}">
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="anime__details__text">
                        <div class="anime__details__title">
                            <h3>{{$user->name}}</h3>
                            <p>{{'@'.$user->username}}</p>
                        </div>
                        <p style="margin-top: 10px;">
                            {{$user->description}}
                        </p>
                        <div class="anime__details__widget2">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <ul>
                                        <li><span>Takip Ettiği Animeler:</span> {{count($follow_animes)}}</li>
                                        <li><span>Takip Ettiği Webtoonlar:</span> {{count($follow_webtoons)}}</li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <ul>
                                        <li><span>Beğendiği Animeler:</span> {{count($favorite_animes)}}</li>
                                        <li><span>Beğendiği Webtoonlar:</span> {{count($favorite_webtoons)}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="anime__details__btn">
                            @if (true)
                            <a href="javascript:;" onclick="unfollowAnime()" class="follow-btn"><i
                                    class="fa fa-plus"></i>
                                Takipten Çıkar</a>
                            @else
                            <a href="javascript:;" onclick="followAnime()" class="follow-btn"><i class="fa fa-plus"></i>
                                Takip Et</a>
                            @endif
                            @if (true)
                            <a href="javascript:;" onclick="dislikeAnime()" class="follow-btn"><i
                                    class="fa fa-heart"></i>
                                Favorilerden Çıkar</a>
                            @else
                            <a href="javascript:;" onclick="likeAnime()" class="follow-btn"><i
                                    class="fa fa-heart-o"></i>
                                Favorilere Ekle</a>
                            @endif
                        </div>
                        <p id="likeAnimeTextMessage" style="color:red;"></p>
                    </div>
                </div>
            </div>
        </div>
        @if ($anime_active->value == 1 || $webtoon_active->value == 1)
        <div class="anime__details__content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="anime__details__text">
                        <ul class="nav nav-tabs">
                            @if ($anime_active->value == 1)
                            <li class="nav-item">
                                <a class="nav-link active active_tab_button" id="favorite_animes" aria-current="page"
                                    href="javascript:;" onclick="selectTab('favorite_animes','favorite_animes_tab')"
                                    data-bs-target="#favorite_animes_tab">Favori
                                    Animeler</a>
                            </li>
                            @endif
                            @if ($webtoon_active->value == 1)
                            <li class="nav-item">
                                <a class="nav-link {{$anime_active->value == 0 ? 'active active_tab_button' : ''}}"
                                    id="favorite_webtoons" style="{{$anime_active->value == 0 ? '' : 'color:white;'}}"
                                    href="javascript:;" onclick="selectTab('favorite_webtoons','favorite_webtoons_tab')"
                                    data-bs-target="#favorite_webtoons_tab">Favori
                                    Webtoonlar</a>
                            </li>
                            @endif
                            @if ($anime_active->value == 1)
                            <li class="nav-item">
                                <a class="nav-link" id="follow_animes" style="color:white;" href="javascript:;"
                                    onclick="selectTab('follow_animes', 'follow_animes_tab')"
                                    data-bs-target="#follow_animes_tab">Takip Ettiği
                                    Animeler</a>
                            </li>
                            @endif
                            @if ($webtoon_active->value == 1)
                            <li class="nav-item">
                                <a class="nav-link" id="follow_webtoons" style="color:white;" href="javascript:;"
                                    onclick="selectTab('follow_webtoons','follow_webtoons_tab')"
                                    data-bs-target="#follow_webtoons_tab">Takip Ettiği Webtoonlar</a>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @if ($anime_active->value == 1)
                            <div class="tab-pane fade show active active_tab" id="favorite_animes_tab" role="tabpanel"
                                aria-labelledby="favorite_animes_tab">
                                <div class="col-lg-12 mt-5">
                                    <div class="product__page__content">
                                        <div class="row">
                                            @foreach ($favorite_animes as $item)
                                            <div class="col-lg-3 col-md-6 col-sm-6">
                                                <div class="product__item">
                                                    <a href="{{url('anime/'.$item->short_name)}}">
                                                        <div class="product__item__pic set-bg"
                                                            data-setbg="../../../{{$item->image}}">
                                                            <div class="ep">{{$item->score}} / 5</div>
                                                            <div class="comment"><i class="fa fa-comments"></i>
                                                                {{$item->comment_count}}
                                                            </div>
                                                            <div class="view"><i class="fa fa-eye"></i>
                                                                {{$item->click_count}}</div>
                                                        </div>
                                                    </a>
                                                    <div class="product__item__text">
                                                        <ul>
                                                            <li>{{$item->main_category_name}}</li>
                                                        </ul>
                                                        <h5>

                                                            <a
                                                                href="{{url('anime/'.$item->short_name)}}">{{$item->name}}</a>

                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($webtoon_active->value == 1)
                            <div class="tab-pane fade {{$anime_active->value == 0 ? 'show active active_tab' : ''}}"
                                id="favorite_webtoons_tab" role="tabpanel" aria-labelledby="favorite_webtoons_tab">
                                <div class="col-lg-12 mt-5">
                                    <div class="product__page__content">
                                        <div class="row">
                                            @foreach ($favorite_webtoons as $item)
                                            <div class="col-lg-3 col-md-6 col-sm-6">
                                                <div class="product__item">
                                                    <a href="{{url('anime/'.$item->short_name)}}">
                                                        <div class="product__item__pic set-bg"
                                                            data-setbg="../../../{{$item->image}}">
                                                            <div class="ep">{{$item->score}} / 5</div>
                                                            <div class="comment"><i class="fa fa-comments"></i>
                                                                {{$item->comment_count}}
                                                            </div>
                                                            <div class="view"><i class="fa fa-eye"></i>
                                                                {{$item->click_count}}</div>
                                                        </div>
                                                    </a>
                                                    <div class="product__item__text">
                                                        <ul>
                                                            <li>{{$item->main_category_name}}</li>
                                                        </ul>
                                                        <h5>

                                                            <a
                                                                href="{{url('anime/'.$item->short_name)}}">{{$item->name}}</a>

                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($anime_active->value == 1)
                            <div class="tab-pane fade" id="follow_animes_tab" role="tabpanel"
                                aria-labelledby="follow_animes_tab">
                                <div class="col-lg-12 mt-5">
                                    <div class="product__page__content">
                                        <div class="row">
                                            @foreach ($follow_animes as $item)
                                            <div class="col-lg-3 col-md-6 col-sm-6">
                                                <div class="product__item">
                                                    <a href="{{url('anime/'.$item->short_name)}}">
                                                        <div class="product__item__pic set-bg"
                                                            data-setbg="../../../{{$item->image}}">
                                                            <div class="ep">{{$item->score}} / 5</div>
                                                            <div class="comment"><i class="fa fa-comments"></i>
                                                                {{$item->comment_count}}
                                                            </div>
                                                            <div class="view"><i class="fa fa-eye"></i>
                                                                {{$item->click_count}}</div>
                                                        </div>
                                                    </a>
                                                    <div class="product__item__text">
                                                        <ul>
                                                            <li>{{$item->main_category_name}}</li>
                                                        </ul>
                                                        <h5>

                                                            <a
                                                                href="{{url('anime/'.$item->short_name)}}">{{$item->name}}</a>

                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($webtoon_active->value == 1)
                            <div class="tab-pane fade" id="follow_webtoons_tab" role="tabpanel"
                                aria-labelledby="favorite_webtoons_tab">
                                <div class="col-lg-12 mt-5">
                                    <div class="product__page__content">
                                        <div class="row">
                                            @foreach ($follow_webtoons as $item)
                                            <div class="col-lg-3 col-md-6 col-sm-6">
                                                <div class="product__item">
                                                    <a href="{{url('anime/'.$item->short_name)}}">
                                                        <div class="product__item__pic set-bg"
                                                            data-setbg="../../../{{$item->image}}">
                                                            <div class="ep">{{$item->score}} / 5</div>
                                                            <div class="comment"><i class="fa fa-comments"></i>
                                                                {{$item->comment_count}}
                                                            </div>
                                                            <div class="view"><i class="fa fa-eye"></i>
                                                                {{$item->click_count}}</div>
                                                        </div>
                                                    </a>
                                                    <div class="product__item__text">
                                                        <ul>
                                                            <li>{{$item->main_category_name}}</li>
                                                        </ul>
                                                        <h5>

                                                            <a
                                                                href="{{url('anime/'.$item->short_name)}}">{{$item->name}}</a>

                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
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

@endsection