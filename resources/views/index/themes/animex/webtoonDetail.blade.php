@extends("index.themes.animex.layouts.main")
@section('index_content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{route('index')}}"><i class="fa fa-home"></i> Anasayfa</a>
                    <a href="{{route('webtoon_list')}}">Webtoonlar</a>
                    <span>{{$webtoon->name}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Webtoon Section Begin -->
<section class="anime-details spad">
    <div class="container">
        <div class="anime__details__content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="anime__details__pic set-bg" data-setbg="../../../{{$webtoon->image}}">
                        <div class="comment"><i class="fa fa-comments"></i> {{$item->comment_count}}</div>
                        <div class="view"><i class="fa fa-eye"></i> {{$webtoon->click_Count}}</div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="anime__details__text">
                        <div class="anime__details__title">
                            <h3>{{$webtoon->name}}</h3>
                        </div>
                        <div class="anime__details__rating">
                            <div class="rating">
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star-half-o"></i></a>
                            </div>
                            <span>{{$webtoon->scoreUsers}} Oy Kullanıldı</span>
                        </div>
                        <p>{{$webtoon->description}}</p>
                        <div class="anime__details__widget">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <ul>
                                        <li><span>Türü:</span> Webtoon</li>
                                        <li><span>Yayınlanma:</span>{{$webtoon->date}}</li>
                                        <li><span>Kategoriler:</span> {{$webtoon->main_category_name ?? 'Genel'}}
                                            @foreach ($categories as $item)
                                            {{$item->name}},
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <ul>
                                        <li><span>Puan:</span> {{$webtoon->score}} / 5 ({{$webtoon->scoreUsers}} Oy
                                            Kullanıldı)</li>
                                        <li><span>Ortalama Süre:</span> {{$webtoon->average_min}} dk</li>
                                        <li><span>Görüntülenme:</span> {{$webtoon->click_count}}</li>
                                        <li><span>Bölüm Sayısı:</span> {{$webtoon->episode_count}} Bölüm</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="anime__details__btn">
                            @if ($followed)
                            <a href="javascript:;" onclick="unfollowWebtoon()" class="follow-btn"><i
                                    class="fa fa-plus"></i> Takipten Çıkar</a>
                            @else
                            <a href="javascript:;" onclick="followWebtoon()" class="follow-btn"><i
                                    class="fa fa-plus"></i>
                                Takip Et</a>
                            @endif
                            @if ($liked)
                            <a href="javascript:;" onclick="dislikeWebtoon()" class="follow-btn"><i
                                    class="fa fa-heart"></i> Favorilerden Çıkar</a>
                            @else
                            <a href="javascript:;" onclick="likeWebtoon()" class="follow-btn"><i
                                    class="fa fa-heart-o"></i> Favorilere Ekle</a>
                            @endif

                            <a href="#" class="watch-btn"><span>Oku</span> <i class="fa fa-angle-right"></i></a>
                        </div>
                        <p id="likeWebtoonTextMessage" style="color:red;"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8">
                @if ($webtoon->season_count > 0)
                @for ($i = $webtoon->season_count; $i>=1; $i--)
                <div class="col-lg-12 col-md-12 webtoon__details__episodes">
                    <div class="section-title">
                        <h5>{{$i}}.sezon</h5>
                    </div>
                    @foreach ($webtoon_episodes->where('season_short',$i) as $item)
                    <a href="#">Bölüm {{$loop->index + 1}} - {{$item->name}}</a>
                    @endforeach
                    @endfor
                    @else
                    <div class="col-lg-12 col-md-12 section-title">
                        <h5>Herhani gib bölüm mevcut değil.</h5>
                    </div>
                    @endif

                </div>
            </div>
            <div class="col-lg-4 col-md-4 justify-content-end">
                <div class="webtoon__details__sidebar">
                    <div class="section-title">
                        <h5>Benzer İçerikler</h5>
                    </div>
                    @foreach ($trend_webtoons as $item)
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="product__item">
                            <a href="webtoon/{{$item->short_name}}">
                                <div class="product__item__pic set-bg" data-setbg="../../../{{$item->image}}">
                                    <div class="ep">{{$item->score}} / 5</div>
                                    <div class="comment"><i class="fa fa-comments"></i> {{$item->comment_count}}</div>
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
<!-- Webtoon Section End -->

<div id="hiddenDiv" hidden>

</div>

<script>
    function followWebtoon(){
        @if (Auth::user())
            var code = `<form action="{{route('followWebtoon')}}" method="POST" id="followWebtoonForm">
                            @csrf
                            <input type="text" name="user_code" value="{{Auth::user()->code}}">
                            <input type="text" name="webtoon_code" value="{{$webtoon->code}}">
                        </form>`;
            document.getElementById('hiddenDiv').innerHTML = code;
            document.getElementById('followWebtoonForm').submit();
        @else
            document.getElementById('followWebtoonTextMessage').innerText = "Lütfen Giriş Yapınız."
        @endif
    }
    function unfollowWebtoon(){
        @if (Auth::user())
            var code = `<form action="{{route('unfollowWebtoon')}}" method="POST" id="unfollowWebtoonForm">
                @csrf
                <input type="text" name="user_code" value="{{Auth::user()->code}}">
                <input type="text" name="webtoon_code" value="{{$webtoon->code}}">
            </form>`;
            document.getElementById('hiddenDiv').innerHTML = code;
            document.getElementById('unfollowWebtoonForm').submit();
        @else
            document.getElementById('followWebtoonTextMessage').innerText = "Lütfen Giriş Yapınız."
        @endif
    }
    function likeWebtoon(){
        @if (Auth::user())
            var code = `<form action="{{route('likeWebtoon')}}" method="POST" id="likeWebtoonForm">
                @csrf
                <input type="text" name="user_code" value="{{Auth::user()->code}}">
                <input type="text" name="webtoon_code" value="{{$webtoon->code}}">
            </form>`;
            document.getElementById('hiddenDiv').innerHTML = code;
            document.getElementById('likeWebtoonForm').submit();
        @else
            document.getElementById('likeWebtoonTextMessage').innerText = "Lütfen Giriş Yapınız."
        @endif
    }
    function dislikeWebtoon(){
        @if (Auth::user())
            var code = `<form action="{{route('unlikeWebtoon')}}" method="POST" id="unlikeWebtoonForm">
                @csrf
                <input type="text" name="user_code" value="{{Auth::user()->code}}">
                <input type="text" name="webtoon_code" value="{{$webtoon->code}}">
            </form>`;
            document.getElementById('hiddenDiv').innerHTML = code;
            document.getElementById('unlikeWebtoonForm').submit();
        @else
            document.getElementById('likeWebtoonTextMessage').innerText = "Lütfen Giriş Yapınız."
        @endif
    }
</script>

@endsection