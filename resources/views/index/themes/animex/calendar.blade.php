@extends('index.themes.animex.layouts.main')
@section('index_content')
    <style>
        .calendar-text {
            text-align: center;
            background-color: var(--menu-footer-color);
            margin: 0px;
            padding: 0px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid #414a4c;
            border-radius: 10px;
            margin-top: 10px;
            padding-right: 10px;
            padding-left: 10px;
            margin-left: 10px;
            width: 80%;
        }

        .calendar-text h5 {
            text-align: center;
            line-height: 3;
            color: #fff;
        }

        .calendar-text img {
            width: 30px;
            height: 30px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .product__item .row .product__item__text {
            text-align: center;
            background-color: var(--background-color);
            margin: 0px;
            padding: 0px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid var(--second-color);
            border-radius: 10px;
            margin-top: 10px;
            padding-right: 30px;
            padding-left: 30px;
            margin-left: 30px;
        }

        .product__item .row .product__item__text h5 {
            text-align: center;
            line-height: 3;
            color: #fff;
            margin-left: 10px;
        }

        .product__item .row .product__item__text img {
            width: 30px;
            height: 30px;
            margin-top: 10px;
            margin-bottom: 10px;
            overflow: hidden;
            border-radius: 8px;
        }

        .calendar-text:hover {
            opacity: 0.7;
        }

        .calendar-text h5:hover {
            color: #fff !important;
        }

        .product__item .row .product__item__text:hover {
            opacity: 0.7;
        }

        .product__item .row .product__item__text .divtext .h5description {
            font-size: 14px;
            color: #a0a0a0;
        }

        @media only screen and (max-width: 479px) {

            .calendar-text {
                width: 150px;
            }

            .product__item .row .product__item__text {
                width: 250px;
                height: 50px;
                left: auto;
                position: relative;
                right: 40%;
                margin-top: 10px;
                display: block;
            }

            .product__item .row .product__item__text .divimg {
                width: 10%;
                position: absolute;
            }

            .product__item .row .product__item__text .divtext {
                width: 80%;
                margin-left: 10px;
            }

            .product__item .row .product__item__text img {
                width: 25px;
                height: 25px;
                margin-top: 10px;
                margin-bottom: 10px;
                overflow: hidden;
                border-radius: 8px;
                box-sizing: none;
            }

            .product__item .row .product__item__text h5 {
                line-height: 1;
                text-align: center;
                position: absolute;
                top: 25%;
                left: 25%;
            }

            .product__item .row .product__item__text .divtext .h5description {
                display: none;
            }
        }
    </style>

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('index') }}"><i class="fa fa-home"></i> Anasayfa</a>
                        <span>Takvim</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <section class="product-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__page__content">

                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-2">
                                    <div class="section-title">
                                        <h4>Takvim</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs">
                            @if ($data['anime_active']->value == 1 && $showAnime == 1)
                                <li class="nav-item">
                                    <a class="nav-link active active_tab_button" id="anime_calendar" aria-current="page"
                                        href="javascript:;" onclick="selectTab('anime_calendar','anime_calendar_tab')"
                                        data-bs-target="#anime_calendar_tab">Anime Takvimi</a>
                                </li>
                            @endif
                            @if ($data['webtoon_active']->value == 1 && $showWebtoon == 1)
                                <li class="nav-item">
                                    <a class="nav-link {{ !($data['anime_active']->value == 1 && $showAnime == 1) ? 'active active_tab_button' : '' }}"
                                        id="webtoon_calendar" href="javascript:;"
                                        style="{{ $data['anime_active']->value == 1 && $showAnime == 1 ? 'color:white;' : '' }}"
                                        onclick="selectTab('webtoon_calendar','webtoon_calendar_tab')"
                                        data-bs-target="#webtoon_calendar_tab">Webtoon Takvimi</a>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @if ($data['anime_active']->value == 1 && $showAnime == 1)
                                <div class="tab-pane fade show active active_tab" id="anime_calendar_tab" role="tabpanel"
                                    aria-labelledby="favorite_animes_tab">
                                    <div class="col-lg-12 mt-5">
                                        <div class="product__page__content">
                                            <div class="row">

                                                <div class="">
                                                    @foreach ($groupedAnimeCalendarLists as $date => $group)
                                                        <div class="product__item">
                                                            <div class="col-lg-4 product__item__text calendar-text">
                                                                <h5 class="">
                                                                    <a class="specialDates">{{ $date }}</a>
                                                                </h5>

                                                            </div>
                                                            <div class="row" style="margin-left: 150px;">
                                                                @foreach ($group as $item)
                                                                    <div class="product__item__text row">
                                                                        <div class="divimg">
                                                                            <img src="../../../{{ $item->anime_image }}"
                                                                                alt="" style="">
                                                                        </div>
                                                                        <div class="divtext">
                                                                            <h5 style="font-size: 16px; ">
                                                                                {{ $item->anime_name }} <span
                                                                                    class="h5description">
                                                                                    {{ $item->anime_calendar_description }}</span>
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($data['webtoon_active']->value == 1 && $showWebtoon == 1)
                                <div class="tab-pane fade {{ !($data['webtoon_active']->value == 1 && $showWebtoon == 1) ? 'show active active_tab' : '' }}"
                                    id="webtoon_calendar_tab" role="tabpanel" aria-labelledby="favorite_animes_tab">
                                    <div class="col-lg-12 mt-5">
                                        <div class="product__page__content">
                                            <div class="row">

                                                <div class="">
                                                    @foreach ($groupedWebtoonCalendarLists as $date => $group)
                                                        <div class="product__item">
                                                            <div class="col-lg-4 product__item__text calendar-text">
                                                                <h5 class="">
                                                                    <a class="specialDates">{{ $date }}</a>
                                                                </h5>

                                                            </div>
                                                            <div class="row" style="margin-left: 150px;">
                                                                @foreach ($group as $item)
                                                                    <div class="product__item__text row">
                                                                        <div class="divimg">
                                                                            <img src="../../../{{ $item->webtoon_image }}"
                                                                                alt=""
                                                                                style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                                        </div>
                                                                        <div class="divtext">
                                                                            <h5 style="font-size: 16px; ">
                                                                                {{ $item->webtoon_name }} <span
                                                                                    class="h5description">
                                                                                    {{ $item->webtoon_calendar_description }}</span>
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
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
    </section>
    <!--Tab değiştirme-->
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

    <!--Tarih  Ayarlama-->
    <script>
        var dates = document.getElementsByClassName('specialDates');

        for (var i = 0; i < dates.length; i++) {
            var text = dates[i].innerText.split('-');
            dates[i].innerText = getDate(text[0], text[1], text[2]);
        }

        function getDate(year, month, day) {
            return day + " " + getMonth(month) + " " + year
        }

        function getMonth(month) {

            if (month == 1) return "Ocak";
            else if (month == 2) return "Şubat";
            else if (month == 3) return "Mart";
            else if (month == 4) return "Nisan";
            else if (month == 5) return "Mayıs";
            else if (month == 6) return "Haziran";
            else if (month == 7) return "Temmuz";
            else if (month == 8) return "Ağustos";
            else if (month == 9) return "Eylül";
            else if (month == 10) return "Ekim";
            else if (month == 11) return "Kasım";
            else if (month == 12) return "Aralık";
            else return "HATA";

        }
    </script>
@endsection
