@extends('index.themes.moviefx.layouts.main')
@section('index_content')
    <div class="inner-content container" id="page-movies_list">
        <div id="router-view">
            <div data-gets data-type="hdr"></div>
            <!-- Kategori ve Başlık-->
            <div class="ui grid mb-0">
                <!-- Başlık -->
                <div class="left floated twelve wide tablet twelve wide computer column pb-0">
                    <div class="page-primary-title pt-sm pb-md">
                        <h1 class="segment-title pt-0 pb-0 mb-0">
                            {{ $title }}
                            <span id="mainTitleID" style="color:red;"></span>
                        </h1>
                    </div>
                </div>
                <!-- Kategori-->
                <div class="cat-tags">
                    <a href="javascript:;" onclick="changeCategory('all')" class="ui button secondary"
                        title="Hepsi">Hepsi</a>
                    <a href="javascript:;" onclick="changeCategory('genel')" class="ui button secondary"
                        title="Hepsi">Genel</a>
                    <a href="javascript:;" onclick="changeCategory('plusEighteen')" class="ui button secondary"
                        title="Hepsi">{{ request('adult', 'off') == 'off' ? '+18' : '+18 olmayan' }}</a>
                    @foreach ($allCategory->skip(1) as $category)
                        <a href="javascript:;" onclick="changeCategory('{{ $category->short_name }}')"
                            class="ui button secondary" title="{{ $category->name }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>

            <div class="dark-segment">
                <br />
                <div class="area latest-add-movies">
                    <div class="ui grid mb-0">
                        <div class="left floated twelve wide tablet eleven wide computer column">
                            <h2 class="segment-title p-0 m-0">{{ $title }}</h2>
                        </div>
                        <div class="right floated twelve wide tablet five wide computer wide column" id="di-all-items">
                            <div class="watch-together-button">
                                <span class="section-heading pr-md">Sırala:</span>
                                <select class="" id="orderBySelected" onchange="changeOrderBy()">
                                    <option value="created_AtDESC">Son Eklenenler</option>
                                    <option value="created_AtASC">İlk Eklenenler</option>
                                    <option value="TrendsDESC">En çok izlenenler</option>
                                    <option value="TrendsASC">En Az İzlenenler</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <ul class="flex flex-wrap">
                        @if (count($list) == 0)
                            <p class="p-0 m-0" style="color:white;">Herhangi Bir İçerik Mevcut Değil</p>
                        @else
                            @foreach ($list as $item)
                                @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                    <li class="mofy-moviesli" id="data_8263">
                                        <div class="mofy-movbox">
                                            <div class="mofy-movbox-image relative">
                                                @if ($path == 'animeler')
                                                    <a href="{{ url('anime/' . $item->short_name) }}"
                                                        title="{{ $item->name }}">
                                                    @elseif ($path == 'webtoonlar')
                                                        <a href="{{ url('webtoon/' . $item->short_name) }}"
                                                            title="{{ $item->name }}">
                                                @endif
                                                <img class="" src="{{ url($item->image) }}"
                                                    alt="{{ $item->name }}">
                                                <div class="mofy-movbox-on absolute">
                                                    <div class="mofy-movpoint flex items-center justify-between absolute">
                                                        <span class="flex items-center">
                                                            <i class="fa-solid fa-star"></i>
                                                            {{ $item->score }}
                                                        </span>
                                                        <p>{{ $item->date }}</p>
                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                            <div class="mofy-movbox-text">
                                                <span class="block">
                                                    <a href="{{ url('anime/' . $item->short_name) }}"
                                                        class="block truncate">
                                                        {{ $item->name }}
                                                    </a>
                                                </span>
                                                <p class="truncate">{{ $item->main_category_name ?? 'Genel' }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li class="mofy-moviesli" id="data_8263">
                                        <div class="mofy-movbox">
                                            <div class="mofy-movbox-image relative">
                                                <a href="javascript:;" onclick="login()" title="{{ $item->name }}">
                                                    <img class="" src="{{ url($item->image) }}"
                                                        alt="{{ $item->name }}" data-src=""
                                                        style="filter: blur(7px);">
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
                        @endif
                    </ul>
                    @if (count($list) != 0)
                        <div class="ui pagination menu">
                            <a href="javascript:;" onclick="changePage({{ $currentPage - 1 }})"
                                {{ $currentPage == 1 ? 'hidden' : "class='item'" }}> {{ '<' }}
                            </a>
                            @for ($i = 1; $i <= $pageCount; $i++)
                                @if ($currentPage == $i)
                                    <a href="javascript:;"onclick=" changePage({{ $i }})"
                                        class="active item">{{ $i }}</a>
                                @else
                                    <a href="javascript:;" onclick=" changePage({{ $i }})"
                                        class="item">{{ $i }}</a>
                                @endif
                            @endfor
                            <a href="javascript:;" onclick="changePage({{ $currentPage + 1 }})"
                                {{ $currentPage == $pageCount ? 'hidden' : "class='item'" }}> {{ '>' }} </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

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

        function changeCategory(selectedCategory) {
            if (selectedCategory == "plusEighteen") {
                changeAdult();
            } else {
                category = selectedCategory;
                changeURL();
            }
        }

        function changeURL() {
            url = "{{ $path }}";
            first = false;

            if (adult != "off") {
                if (first) adult += "&adult=" + "on";
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
