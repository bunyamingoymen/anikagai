@extends('index.themes.animex.layouts.main')
@section('index_content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('index') }}"><i class="fa fa-home"></i> Anasayfa</a>
                        <span>Arama</span>
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
                                        <h4>Arama</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($results as $item)
                                @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <a
                                                href="{{ $item->type == 'anime' ? url('anime/' . $item->short_name) : url('webtoon/' . $item->short_name) }}">
                                                <div class="product__item__pic set-bg"
                                                    data-setbg="../../../{{ $item->image }}">
                                                    <div class="ep">{{ $item->score }} / 5</div>
                                                    <div class="comment"><i class="fa fa-comments"></i>
                                                        {{ $item->comment_count }}
                                                    </div>
                                                    <div class="view"><i class="fa fa-eye"></i>
                                                        {{ $item->click_count }}</div>
                                                </div>
                                            </a>
                                            <div class="product__item__text">
                                                <ul>
                                                    <li>{{ $item->main_category_name }}</li>
                                                </ul>
                                                <h5>
                                                    <a
                                                        href="{{ $item->type == 'anime' ? url('anime/' . $item->short_name) : url('webtoon/' . $item->short_name) }}{{ $item->short_name }}">
                                                        {{ $item->name }}
                                                    </a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <a href="{{ route('loginScreen') }}">
                                                <div class="product__item__pic">
                                                    <div
                                                        style="width: 100%; height: 100%; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                                        <div class="censor set-bg"
                                                            data-setbg="../../../{{ $item->image }}">
                                                        </div>
                                                        <div style="margin-top: 20px; z-index: 2;">
                                                            <a class="overlay-button" href="{{ route('loginScreen') }}">
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
                                                    <a href="{{ route('loginScreen') }}"> Bilinmiyor </a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class=" product__pagination">
                        <a href="{{ $path }}&p={{ $currentPage - 1 }}" {{ $currentPage <= 1 ? 'hidden' : '' }}><i
                                class="fa fa-angle-double-left"></i></a>
                        @for ($i = 1; $i <= $pageCount; $i++)
                            @if ($currentPage == $i)
                                <a href="{{ $path }}&p={{ $i }}"
                                    class="current-page">{{ $i }}</a>
                            @else
                                <a href="{{ $path }}&p={{ $i }}"
                                    class="current-page">{{ $i }}</a>
                            @endif
                        @endfor
                        <a href="{{ $path }}&p={{ $currentPage + 1 }}"
                            {{ $currentPage + 1 > $pageCount ? 'hidden' : '' }}>
                            <i class="fa fa-angle-double-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->


    <script src="../../../user/animex/js/jquery-3.3.1.min.js"></script>
@endsection
