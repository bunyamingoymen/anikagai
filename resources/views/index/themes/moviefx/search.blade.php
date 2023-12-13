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
                            Arama
                            <span id="mainTitleID" style="color:red;"></span>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="dark-segment">
                <br />
                <div class="area latest-add-movies">
                    <ul class="flex flex-wrap">
                        @if (count($results) == 0)
                            <p class="p-0 m-0" style="color:white;">Herhangi Bir İçerik Mevcut Değil</p>
                        @else
                            @foreach ($results as $item)
                                @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                    <li class="mofy-moviesli" id="data_8263">
                                        <div class="mofy-movbox">
                                            <div class="mofy-movbox-image relative">
                                                <a href="{{ $item->type == 'anime' ? url('anime/' . $item->short_name) : url('webtoon/' . $item->short_name) }}"
                                                    title="{{ $item->name }}">
                                                    <img class="" src="../../../{{ $item->image }}"
                                                        alt="{{ $item->name }}">
                                                    <div class="mofy-movbox-on absolute">
                                                        <div
                                                            class="mofy-movpoint flex items-center justify-between absolute">
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
                                                    <img class="" src="../../../{{ $item->image }}"
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
                    @if (count($results) != 0)
                        <div class="ui pagination menu">
                            <a id="paginatin_prev" href="{{ $path }}&p={{ $currentPage - 1 }}"
                                {{ $currentPage <= 1 ? 'hidden' : '' }}> {{ '<' }}
                            </a>
                            @for ($i = 1; $i <= $pageCount; $i++)
                                @if ($currentPage == $i)
                                    <a href="{{ $path }}&p={{ $i }}"
                                        class="active item">{{ $i }}</a>
                                @else
                                    <a href="{{ $path }}&p={{ $i }}"
                                        class="item">{{ $i }}</a>
                                @endif
                            @endfor
                            <a id="paginatin_next" href="{{ $path }}&p={{ $currentPage + 1 }}"
                                {{ $currentPage + 1 > $pageCount ? 'hidden' : '' }}> {{ '>' }} </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        @if (!($currentPage <= 1))
            document.getElementById('paginatin_prev').classList.add('item');
        @endif

        @if (!($currentPage == $pageCount))
            document.getElementById('paginatin_next').classList.add('item');
        @endif
    </script>
@endsection
