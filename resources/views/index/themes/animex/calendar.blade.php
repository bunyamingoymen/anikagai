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
            ;
            border-radius: 10px;
            margin-top: 10px;
            padding-right: 10px;
            padding-left: 10px;
            margin-left: 10px;
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

                            <li class="nav-item">
                                <a class="nav-link active active_tab_button" id="anime_calendar" aria-current="page"
                                    href="javascript:;" onclick="selectTab('anime_calendar','anime_calendar_tab')"
                                    data-bs-target="#anime_calendar_tab">Anime Takvimi</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="webtoon_calendar" href="javascript:;" style="color:white;"
                                    onclick="selectTab('webtoon_calendar','webtoon_calendar_tab')"
                                    data-bs-target="#webtoon_calendar_tab">Webtoon Takvimi</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active active_tab" id="anime_calendar_tab" role="tabpanel"
                                aria-labelledby="favorite_animes_tab">
                                <div class="col-lg-12 mt-5">
                                    <div class="product__page__content">
                                        <div class="row">

                                            <div class="">
                                                <div class="product__item">
                                                    <div class="col-lg-4 product__item__text calendar-text">
                                                        <h5 class="">
                                                            <a>25 Aralık</a>
                                                        </h5>

                                                    </div>
                                                    <div class="row" style="margin-left: 150px;">
                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/2.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/2.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/2.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/2.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product__item">
                                                    <div class="col-lg-4 product__item__text calendar-text">
                                                        <h5 class="">
                                                            <a>25 Aralık</a>
                                                        </h5>

                                                    </div>
                                                    <div class="row" style="margin-left: 150px;">
                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/2.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/2.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/2.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/2.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active active_tab" id="webtoon_calendar_tab" role="tabpanel"
                                aria-labelledby="favorite_animes_tab">
                                <div class="col-lg-12 mt-5">
                                    <div class="product__page__content">
                                        <div class="row">

                                            <div class="">
                                                <div class="product__item">
                                                    <div class="col-lg-4 product__item__text calendar-text">
                                                        <h5 class="">
                                                            <a>26 Aralık</a>
                                                        </h5>

                                                    </div>
                                                    <div class="row" style="margin-left: 150px;">
                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/3.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/3.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/3.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/3.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product__item">
                                                    <div class="col-lg-4 product__item__text calendar-text">
                                                        <h5 class="">
                                                            <a>27 Aralık</a>
                                                        </h5>

                                                    </div>
                                                    <div class="row" style="margin-left: 150px;">
                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/4.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/4.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/24.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="product__item__text row">
                                                            <div>
                                                                <img src="../../../files/animes/animesImages/4.jpg"
                                                                    alt=""
                                                                    style="width: 30px; height: 30px; margin-top: 10px; margin-bottom: 10px; overflow: hidden;  border-radius: 8px;">
                                                            </div>
                                                            <div>
                                                                <h5 style="font-size: 16px; ">
                                                                    Tokyo Ghoul <span
                                                                        style="font-size: 14px; color:#a0a0a0"> 1.sezon
                                                                        1.Bölüm</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
