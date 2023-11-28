@extends("index.themes.animex.layouts.main")
@section('index_content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{route('index')}}"><i class="fa fa-home"></i> Anasayfa</a>
                    <a href="{{route('anime_list')}}">Animeler</a>
                    <span>{{$anime->name}}</span>
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
                    <div class="anime__details__pic set-bg" data-setbg="../../../{{$anime->image}}">
                        <div class="comment"><i class="fa fa-comments"></i> 11</div>
                        <div class="view"><i class="fa fa-eye"></i> {{$anime->click_Count}}</div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="anime__details__text">
                        <div class="anime__details__title">
                            <h3>{{$anime->name}}</h3>
                        </div>
                        <div class="anime__details__rating">
                            <div class="rating">
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star-half-o"></i></a>
                            </div>
                            <span>{{$anime->scoreUsers}} Oy Kullanıldı</span>
                        </div>
                        <p>{{$anime->description}}</p>
                        <div class="anime__details__widget">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <ul>
                                        <li><span>Türü:</span> Anime</li>
                                        <li><span>Yayınlanma:</span>{{$anime->date}}</li>
                                        <li><span>Kategoriler:</span> {{$anime->main_category_name ?? 'Genel'}}
                                            @foreach ($categories as $item)
                                            {{$item->name}},
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <ul>
                                        <li><span>Puan:</span> {{$anime->score}} / 5 ({{$anime->scoreUsers}} Oy
                                            Kullanıldı)</li>
                                        <li><span>Ortalama Süre:</span> {{$anime->average_min}} dk</li>
                                        <li><span>Görüntülenme:</span> {{$anime->click_count}}</li>
                                        <li><span>Bölüm Sayısı:</span> {{$anime->episode_count}} Bölüm</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="anime__details__btn">
                            @if ($followed)
                            <a href="javascript:;" onclick="unfollowAnime()" class="follow-btn"><i
                                    class="fa fa-plus"></i> Takipten Çıkar</a>
                            @else
                            <a href="javascript:;" onclick="followAnime()" class="follow-btn"><i class="fa fa-plus"></i>
                                Takip Et</a>
                            @endif
                            @if ($liked)
                            <a href="javascript:;" onclick="dislikeAnime()" class="follow-btn"><i
                                    class="fa fa-heart"></i> Favorilerden Çıkar</a>
                            @else
                            <a href="javascript:;" onclick="likeAnime()" class="follow-btn"><i
                                    class="fa fa-heart-o"></i> Favorilere Ekle</a>
                            @endif

                            <a href="#" class="watch-btn"><span>İzle</span> <i class="fa fa-angle-right"></i></a>
                        </div>
                        <p id="likeAnimeTextMessage" style="color:red;"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if ($anime->season_count > 0)
            @for ($i = $anime->season_count; $i>=1; $i--)
            <div class="col-lg-8 col-md-8">

                <div class="col-lg-12 col-md-12 anime__details__episodes">
                    <div class="section-title">
                        <h5>{{$i}}.sezon</h5>
                    </div>
                    @foreach ($anime_episodes->where('season_short',$i) as $item)
                    <a href="#">{{$i}} - {{$item->episode_short }}.Bölüm - {{$item->name}}</a>
                    @endforeach

                </div>
            </div>
            @endfor
            @else
            <div class="col-lg-12 col-md-12 section-title">
                <h5>Herhani gib bölüm mevcut değil.</h5>
            </div>
            @endif
            <div class="col-lg-4 col-md-4 justify-content-end">
                <div class="anime__details__sidebar">
                    <div class="section-title">
                        <h5>Benzer İçerikler</h5>
                    </div>
                    @foreach ($trend_animes as $item)
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="product__item">
                            <a href="anime/{{$item->short_name}}">
                                <div class="product__item__pic set-bg" data-setbg="../../../{{$item->image}}">
                                    <div class="ep">{{$item->score}} / 5</div>
                                    <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                    <div class="view"><i class="fa fa-eye"></i> {{$item->click_count}} </div>
                                </div>
                            </a>
                            <div class="product__item__text">
                                <ul>
                                    <li>{{$item->main_category_name ?? 'Genel'}}</li>
                                </ul>
                                <h5><a href="webtoon/{{$item->short_name}}">{{$item->name}}</a></h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Anime Section End -->

<div id="hiddenDiv" hidden>

</div>

<script>
    function followAnime(){
        @if (Auth::user())
            var code = `<form action="{{route('followAnime')}}" method="POST" id="followAnimeForm">
                            @csrf
                            <input type="text" name="user_code" value="{{Auth::user()->code}}">
                            <input type="text" name="anime_code" value="{{$anime->code}}">
                        </form>`;
            document.getElementById('hiddenDiv').innerHTML = code;
            document.getElementById('followAnimeForm').submit();
        @else
            document.getElementById('likeAnimeTextMessage').innerText = "Lütfen Giriş Yapınız."
        @endif
    }
    function unfollowAnime(){
        @if (Auth::user())
            var code = `<form action="{{route('unfollowAnime')}}" method="POST" id="unfollowAnimeForm">
                @csrf
                <input type="text" name="user_code" value="{{Auth::user()->code}}">
                <input type="text" name="anime_code" value="{{$anime->code}}">
            </form>`;
            document.getElementById('hiddenDiv').innerHTML = code;
            document.getElementById('unfollowAnimeForm').submit();
        @else
            document.getElementById('likeAnimeTextMessage').innerText = "Lütfen Giriş Yapınız."
        @endif
    }
    function likeAnime(){
        @if (Auth::user())
            var code = `<form action="{{route('likeAnime')}}" method="POST" id="likeAnimeForm">
                @csrf
                <input type="text" name="user_code" value="{{Auth::user()->code}}">
                <input type="text" name="anime_code" value="{{$anime->code}}">
            </form>`;
            document.getElementById('hiddenDiv').innerHTML = code;
            document.getElementById('likeAnimeForm').submit();
        @else
            document.getElementById('likeAnimeTextMessage').innerText = "Lütfen Giriş Yapınız."
        @endif
    }
    function dislikeAnime(){
        @if (Auth::user())
            var code = `<form action="{{route('unlikeAnime')}}" method="POST" id="unlikeAnimeForm">
                @csrf
                <input type="text" name="user_code" value="{{Auth::user()->code}}">
                <input type="text" name="anime_code" value="{{$anime->code}}">
            </form>`;
            document.getElementById('hiddenDiv').innerHTML = code;
            document.getElementById('unlikeAnimeForm').submit();
        @else
            document.getElementById('likeAnimeTextMessage').innerText = "Lütfen Giriş Yapınız."
        @endif
    }
</script>

@endsection