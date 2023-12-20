@extends('index.themes.animex.layouts.main')
@section('index_content')
    <link rel="stylesheet" href="../../../user/animex/css/nice-select.css" type="text/css">
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('index') }}"><i class="fa fa-home"></i> Anasayfa</a>
                        <span>{{ $title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-2">
                                    <div class="section-title">
                                        <h4>{{ $title }} <span id="mainTitleID" style="color:red;"></span></h4>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 mt-2">
                                    <div class="product__page__filter">
                                        <p>Kategoriler:</p>
                                        <select class="" id="categorySelected" onchange="changeCategory()">
                                            <option value="all">Hepsi</option>
                                            <option value="genel">Genel</option>
                                            <option value="plusEighteen">
                                                {{ request('adult', 'off') == 'off' ? '+18' : '+18 olmayan' }}</option>
                                            @foreach ($allCategory->skip(1) as $category)
                                                <option value="{{ $category->short_name }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 mt-2">
                                    <div class="product__page__filter">
                                        <p>Sırala:</p>
                                        <select class="" id="orderBySelected" onchange="changeOrderBy()">
                                            <option value="created_AtDESC">Son Eklenenler</option>
                                            <option value="created_AtASC">İlk Eklenenler</option>
                                            <option value="TrendsDESC">En çok izlenenler</option>
                                            <option value="TrendsASC">En Az İzlenenler</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (count($list) == 0)
                            <div>
                                <p style="color:#fff;">Herhangi bir içerik mevcut değil</p>
                            </div>
                        @else
                            <div class="row">
                                @foreach ($list as $item)
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                            <div class="product__item">
                                                @if ($path == 'animeler')
                                                    <a href="{{ url('anime/' . $item->short_name) }}">
                                                    @elseif ($path == 'webtoonlar')
                                                        <a href="{{ url('webtoon/' . $item->short_name) }}">
                                                @endif
                                                <div class="product__item__pic set-bg"
                                                    data-setbg="../../../{{ $item->image }}">
                                                    <div class="ep">{{ $item->score }} / 5</div>
                                                    <div class="comment"><i class="fa fa-comments"></i>
                                                        {{ $item->comment_count }}
                                                    </div>
                                                    <div class="view"><i class="fa fa-eye"></i> {{ $item->click_count }}
                                                    </div>
                                                </div>
                                                </a>
                                                <div class="product__item__text">
                                                    <ul>
                                                        <li>{{ $item->main_category_name }}</li>
                                                    </ul>
                                                    <h5>
                                                        @if ($path == 'animeler')
                                                            <a
                                                                href="{{ url('anime/' . $item->short_name) }}">{{ $item->name }}</a>
                                                        @elseif ($path == 'webtoonlar')
                                                            <a
                                                                href="{{ url('webtoon/' . $item->short_name) }}">{{ $item->name }}</a>
                                                        @endif
                                                    </h5>
                                                </div>
                                            </div>
                                        @else
                                            <div class="product__item">
                                                <a href="{{ route('loginScreen') }}">
                                                    <div class="product__item__pic">
                                                        <div
                                                            style="width: 100%; height: 100%; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                                            <div class="censor set-bg"
                                                                data-setbg="../../../{{ $item->image }}">
                                                            </div>
                                                            <div style="margin-top: 20px; z-index: 2;">
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
                                                        <a href="{{ route('loginScreen') }}">Bilinmiyor</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                    <div class="product__pagination" {{ count($list) == 0 ? 'hidden' : '' }}>
                        @if ($currentPage != 1)
                            <a href="javascript:;" onclick=" changePage({{ $currentPage - 1 }})"><i
                                    class="fa fa-angle-double-left"></i></a>
                        @endif
                        @for ($i = 1; $i <= $pageCount; $i++)
                            @if ($currentPage == $i)
                                <a href="javascript:;" onclick=" changePage({{ $i }})"
                                    class="current-page">{{ $i }}</a>
                            @else
                                <a href="javascript:;" onclick=" changePage({{ $i }})">{{ $i }}</a>
                            @endif
                        @endfor
                        @if ($currentPage != $pageCount)
                            <a href=" javascript:;" onclick=" changePage({{ $currentPage + 1 }})"><i
                                    class="fa fa-angle-double-right"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->


    <script src="../../../user/animex/js/jquery-3.3.1.min.js"></script>


    <script>
        var page = "{{ request('p', 1) }}";
        var orderBy = "{{ request('orderBy', 'created_AtDESC') }}";
        var category = "{{ request('category', 'all') }}";
        var adult = "{{ request('adult', 'off') }}";

        $(document).ready(function() {
            document.getElementById("orderBySelected").value = orderBy;
            document.getElementById("categorySelected").value = category;

            if (adult == "on") {
                document.getElementById('mainTitleID').innerText = "+18";
            }
        });

        var url = "";

        function changeAdult() {
            if (adult == "off") adult = "on";
            else if (adult == "on") adult = "off";
            changeURL();
        }

        function changeOrderBy() {
            orderBy = document.getElementById("orderBySelected").value;
            changeURL();
        }

        function changePage(nextPage) {
            page = nextPage;
            changeURL();
        }

        function changeCategory() {

            if (document.getElementById("categorySelected").value == 'plusEighteen') {
                changeAdult();
            } else {
                category = document.getElementById("categorySelected").value;
                changeURL();
            }

        }

        function changeURL() {
            url = "{{ $path }}";
            first = false;

            if (adult != "off") {
                if (first)
                    adult += "&adult=" + "on";
                else {
                    first = true;
                    url += "?adult=" + "on"
                }
            }

            if (category != "all") {
                if (first) url += "&category=" + category;
                else {
                    first = true;
                    url += "?category=" + category
                }
            }

            if (orderBy != "created_AtDESC") {
                if (first) url += "&orderBy=" + orderBy;
                else {
                    first = true;
                    url += "?orderBy=" + orderBy
                }
            }

            if (page != "1") {
                if (first) url += "&p=" + page;
                else {
                    first = true;
                    url += "?p=" + page
                }
            }

            window.location.href = url;
        }
    </script>
@endsection
