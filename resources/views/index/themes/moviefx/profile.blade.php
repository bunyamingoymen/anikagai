@extends("index.themes.moviefx.layouts.main")
@section('index_content')
<div class="inner-content container" id="page-profile">
    <div id="router-view">
        <div class="ui tiny modal generic-modal" id="following_modal">
            <div class="generic-header title-tertiary">{{$followed_user_count}} kişiyi takip ediyor.</div>
            <div class="content">
                <div class="ui very relaxed list">
                </div>
            </div>
        </div>
        <div class="ui tiny modal generic-modal" id="follower_modal">
            <div class="generic-header title-tertiary">
                {{$following_user_count}} kişi tarafından takip ediliyor.
            </div>
            <div class="content">
                <div class="ui very relaxed list">
                </div>
            </div>
        </div>
        <div class="ui tiny modal generic-modal" id="modal-block-user">
            <div class="generic-header title-tertiary">Engelle</div>
            <div class="content">
                <div class="mb-md text-center">
                    <svg class="mt-lg" width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 0c-11.04 0-20 8.96-20 20s8.96 20 20 20 20-8.96 20-20-8.96-20-20-20zm-16 20c0-8.84 7.16-16 16-16 3.7 0 7.1 1.26 9.8 3.38l-22.42 22.42c-2.12-2.7-3.38-6.1-3.38-9.8zm16 16c-3.7 0-7.1-1.26-9.8-3.38l22.42-22.42c2.12 2.7 3.38 6.1 3.38 9.8 0 8.84-7.16 16-16 16z"
                            fill="#ffffff" fill-rule="nonzero" />
                    </svg>
                    <h5 class="title-quaternary mt-md"><strong>@zortanov</strong> engellensin mi?</h5>
                    <p class="description-tertiary"><strong>@zortanov</strong> artık seni takip
                        edemeyecek, sen de
                        <strong>@zortanov</strong> adlı kişiden gelen bildirimleri görmeyeceksin.
                    </p>
                    <div class="text-center actions">
                        <button type="button" class="ui button danger profile-block-modal"
                            data-block="pSHHL39suqwvHuxWnpk=">Engelle</button>
                        <button type="button" class="ui button secondary cancel">İptal</button>
                    </div>
                </div>
            </div>
        </div>
        <section class="user-profile bg-cover-faker">
            <div class="ui grid">
                <div class="left floated sixteen wide tablet four wide computer column">
                    <div class="generic-box">
                        <section class="profile-section text-center">
                            <div class="text-right">
                            </div>
                            <figure class="user-profile-photo" role="presentation">
                                <a href="javascirpt:;" class="circle-progress-link">
                                    <img referrerpolicy="no-referrer"
                                        src="../../../{{$user->image ?? 'user/img/profile/default.png'}}"
                                        alt="{{'@'.$user->username}}">
                                </a>
                            </figure>
                            <h2 class="title-secondary">
                                <a href="javascirpt:;">
                                    {{'@'.$user->username}}
                                </a>
                            </h2>
                            <p>{{$user->name}}</p>
                            <div class="user-earnings">
                            </div>
                        </section>
                        <section class="profile-section">
                            <div class="profile-summary">
                                <div class="ui middle aligned divided list">
                                    <div class="item">
                                        <div class="right floated content text-white"><a
                                                href="javascript:;">{{$following_user_count}}</a></div>
                                        <div class="content">Takip Ettikleri</div>
                                    </div>
                                    <div class="item">
                                        <div class="right floated content text-white"><a href="javascript:;"
                                                data-modal="follower_modal">{{$following_user_count}}</a></div>
                                        <div class="content">Takip Edenler</div>
                                    </div>
                                    <div class="item">
                                        <div class="right floated content text-white">{{$watched_anime_count}}</div>
                                        <div class="content">İzlenen Anime Bölümleri</div>
                                    </div>
                                    <div class="item">
                                        <div class="right floated content text-white">{{$readed_webtoon_count}}</div>
                                        <div class="content">Okunan Webtoon Bölümleri</div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="profile-section text-center">
                            <p class="description-quaternary">Üyelik Tarihi: <span id="membeshipDate"></span></p>
                        </section>
                    </div>
                </div>
                <div id="profile-content" class="right floated sixteen wide tablet twelve wide computer column">
                    <div class="ui top tabular menu">
                        @if ($data['anime_active']->value == 1)
                        <a id="tabButtonFavoriteAnime" class="item tabButton active" href="javascript:;"
                            onclick="changeTab('tabButtonFavoriteAnime', 'profile-favorite-anime')">
                            Favori Animeler</a>
                        <a id="tabButtonFollowAnime" class="item tabButton" href="javascript:;"
                            onclick="changeTab('tabButtonFollowAnime', 'profile-followed-anime')">Takip Edilen
                            Animeler</a>
                        @endif

                        @if ($data['webtoon_active']->value == 1)
                        <a id="tabButtonFavoriteWebtoon" class="item tabButton" href="javascript:;"
                            onclick="changeTab('tabButtonFavoriteWebtoon', 'profile-favorite-webtoon')">Favori
                            Webtoonlar</a>
                        <a id="tabButtonFollowWebtoon" class="item tabButton" href="javascript:;"
                            onclick="changeTab('tabButtonFollowWebtoon', 'profile-followed-webtoon')">
                            Takip Edilen Animeler</a>
                        @endif

                    </div>

                    @if ($data['anime_active']->value == 1)
                    <div class="ui bottom attached tab segment active" id="profile-favorite-anime"
                        data-tab="favorite-anime">
                        <div class="dark-segment">
                            @if (count($favorite_animes) == 0)
                            <div class="alert alert-danger" role="alert">
                                Kullanıcının beğendiği herhangi bir anime mevcut değil.
                            </div>
                            @else
                            <ul class="flex flex-wrap flex-home">
                                @foreach ($favorite_animes as $item)
                                @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 ||
                                $item->showStatus == 2)))
                                <li class="mofy-moviesli" id="data_8263">
                                    <div class="mofy-movbox">
                                        <div class="mofy-movbox-image relative">
                                            <a href="{{url('anime/'.$item->short_name)}}" title="{{$item->name}}">
                                                <img class="" src="../../../{{$item->image}}" alt="{{$item->name}}"
                                                    data-src="">
                                                <div class="mofy-movbox-on absolute">
                                                    <div
                                                        class="mofy-movpoint flex items-center justify-between absolute">
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
                                                <img class="" src="../../../{{$item->image}}" alt="{{$item->name}}"
                                                    data-src="" style="filter: blur(7px);">
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
                            @endif
                        </div>
                    </div>

                    <div class="ui bottom attached tab segment" id="profile-followed-anime" data-tab="followed-anime">
                        <div class="dark-segment">
                            @if (count($follow_animes) == 0)
                            <div class="alert alert-danger" role="alert">
                                Kullanıcının beğendiği herhangi bir anime mevcut değil.
                            </div>
                            @else
                            <ul class="flex flex-wrap flex-home">
                                @foreach ($follow_animes as $item)
                                @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 ||
                                $item->showStatus == 2)))
                                <li class="mofy-moviesli" id="data_8263">
                                    <div class="mofy-movbox">
                                        <div class="mofy-movbox-image relative">
                                            <a href="{{url('anime/'.$item->short_name)}}" title="{{$item->name}}">
                                                <img class="" src="../../../{{$item->image}}" alt="{{$item->name}}"
                                                    data-src="">
                                                <div class="mofy-movbox-on absolute">
                                                    <div
                                                        class="mofy-movpoint flex items-center justify-between absolute">
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
                                                <img class="" src="../../../{{$item->image}}" alt="{{$item->name}}"
                                                    data-src="" style="filter: blur(7px);">
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
                            @endif
                        </div>
                    </div>
                    @endif

                    @if ($data['webtoon_active']->value == 1)

                    <div class="ui bottom attached tab segment {{$data['anime_active']->value == 0 ? 'active' : ''}}"
                        id="profile-favorite-webtoon" data-tab="favorite-webtoon">
                        <div class="dark-segment">
                            @if (count($favorite_webtoons) == 0)
                            <div class="alert alert-danger" role="alert">
                                Kullanıcının beğendiği herhangi bir anime mevcut değil.
                            </div>
                            @else
                            <ul class="flex flex-wrap flex-home">
                                @foreach ($favorite_webtoons as $item)
                                @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 ||
                                $item->showStatus == 2)))
                                <li class="mofy-moviesli" id="data_8263">
                                    <div class="mofy-movbox">
                                        <div class="mofy-movbox-image relative">
                                            <a href="{{url('webtoon/'.$item->short_name)}}" title="{{$item->name}}">
                                                <img class="" src="../../../{{$item->image}}" alt="{{$item->name}}"
                                                    data-src="">
                                                <div class="mofy-movbox-on absolute">
                                                    <div
                                                        class="mofy-movpoint flex items-center justify-between absolute">
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
                                                <img class="" src="../../../{{$item->image}}" alt="{{$item->name}}"
                                                    data-src="" style="filter: blur(7px);">
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
                            @endif
                        </div>
                    </div>

                    <div class="ui bottom attached tab segment" id="profile-followed-webtoon"
                        data-tab="followed-webtoon">
                        <div class="dark-segment">
                            @if (count($follow_webtoons) == 0)
                            <div class="alert alert-danger" role="alert">
                                Kullanıcının beğendiği herhangi bir anime mevcut değil.
                            </div>
                            @else
                            <ul class="flex flex-wrap flex-home">
                                @foreach ($follow_webtoons as $item)
                                @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 ||
                                $item->showStatus == 2)))
                                <li class="mofy-moviesli" id="data_8263">
                                    <div class="mofy-movbox">
                                        <div class="mofy-movbox-image relative">
                                            <a href="{{url('webtoon/'.$item->short_name)}}" title="{{$item->name}}">
                                                <img class="" src="../../../{{$item->image}}" alt="{{$item->name}}"
                                                    data-src="">
                                                <div class="mofy-movbox-on absolute">
                                                    <div
                                                        class="mofy-movpoint flex items-center justify-between absolute">
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
                                                <img class="" src="../../../{{$item->image}}" alt="{{$item->name}}"
                                                    data-src="" style="filter: blur(7px);">
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
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </section>
    </div>
</div>

<!--Üyelik Tarihini Ayarlama Fonksiyonları-->
<script>
    var date = '{{$user->created_at}}'.split(' ')[0];
    if(date.split('-').length == 3){
        getTurkishDate(date.split('-')[0], date.split('-')[1], date.split('-')[2])
    }else{
        alert('yanlış')
    }

    function getTurkishDate(year, month, day){
        document.getElementById('membeshipDate').innerText = day + " " + getTurkishMont(month) + " " + year;
    }

    function getTurkishMont(month){
        if(month === "1" || month === "01") return "Ocak";
        else if(month === "2" || month === "02") return "Şubat";
        else if(month === "3" || month === "03") return "Mart";
        else if(month === "4" || month === "04") return "Nisan";
        else if(month === "5" || month === "05") return "Mayıs";
        else if(month === "6" || month === "06") return "Haziran";
        else if(month === "7" || month === "07") return "Temmuz";
        else if(month === "8" || month === "08") return "Ağustos";
        else if(month === "9" || month === "09") return "Eylül";
        else if(month === "10") return "Ekim";
        else if(month === "11") return "Kasım";
        else if(month === "12") return "Aralık";
        else return "Not";
    }
</script>

<script>
    var activeTabID = "{{$data['anime_active']->value == 1 ? 'profile-favorite-anime' : 'profile-favorite-webtoon'}}";
    var activeButtonID = "{{$data['anime_active']->value == 1 ? 'tabButtonFavoriteAnime' : 'tabButtonFavoriteWebtoon'}}";
    function changeTab(clickButtonID, tabSectionID){
        document.getElementById(activeTabID).classList.remove("active");
        document.getElementById(activeButtonID).classList.remove("active");

        document.getElementById(tabSectionID).classList.add("active");
        document.getElementById(clickButtonID).classList.add("active");

        activeTabID = tabSectionID;
        activeButtonID = clickButtonID;
    }
</script>
@endsection
