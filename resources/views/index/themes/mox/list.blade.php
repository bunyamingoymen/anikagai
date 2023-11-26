@extends("index.themes.mox.layouts.main")
@section('index_content')
<link rel="stylesheet" href="../../../user/mox/css/bootstrap.min.css">
<link rel="stylesheet" href="../../../user/mox/css/animate.min.css">
<link rel="stylesheet" href="../../../user/mox/css/magnific-popup.css">
<link rel="stylesheet" href="../../../user/mox/css/fontawesome-all.min.css">
<link rel="stylesheet" href="../../../user/mox/css/owl.carousel.min.css">
<link rel="stylesheet" href="../../../user/mox/css/flaticon.css">
<link rel="stylesheet" href="../../../user/mox/css/odometer.css">
<link rel="stylesheet" href="../../../user/mox/css/aos.css">
<link rel="stylesheet" href="../../../user/mox/css/slick.css">
<link rel="stylesheet" href="../../../user/mox/css/default.css">
<link rel="stylesheet" href="../../../user/mox/css/style.css">
<link rel="stylesheet" href="../../../user/mox/css/responsive.css">
<!-- main-area -->
<main>

    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="../../../user/mox/img/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title"><span>{{$title}}</span></h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('index')}}">Anasyafa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- movie-area -->
    <section class="movie-area movie-bg" data-background="../../../user/mox/img/bg/movie_bg.jpg">
        <div class="container">
            <div class="row align-items-end mb-60">
                <div class="col-lg-6">
                    <div class="section-title text-center text-lg-left">
                        <span class="sub-title"></span>
                        <h2 class="title">Son EKlenen Animeler</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="movie-page-meta">
                        <div class="tr-movie-menu-active text-center">
                            <button class="active" data-filter="*">Animeler</button>
                        </div>
                        <form action="#" class="movie-filter-form">
                            <select class="custom-select">
                                <option selected>Son Eklenenler</option>
                                <option selected>İlk Eklenenler</option>
                                <option value="1">En çok izlenenler</option>
                                <option value="2">En Az Özlenenler</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row tr-movie-active">
                @foreach ($list as $item)
                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-two">
                    <div class="movie-item movie-item-three mb-50">
                        <div class="movie-poster">
                            <img src="../../../{{$item->image}}" alt=""
                                style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;">
                            <ul class="overlay-btn">
                                <li class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </li>
                                @if ($path == "animeler")
                                <li><a href="#" class="btn">İzle</a></li>
                                @elseif ($path == "webtoonlar")
                                <li><a href="" # class="btn">Oku</a></li>
                                @endif
                                @if ($path == "animeler")
                                <li><a href="anime/{{$item->short_name}}" class="btn">Detay</a></li>
                                @elseif ($path == "webtoonlar")
                                <li><a href="webtoon/{{$item->short_name}}" class="btn">Detay</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                @if ($path == "animeler")
                                <h5 class="title"><a href="anime/{{$item->short_name}}">{{$item->name}}</a></h5>
                                @elseif ($path == "webtoonlar")
                                <h5 class="title"><a href="webtoon/{{$item->short_name}}">{{$item->name}}</a></h5>
                                @endif
                                <span class="date">{{$item->date}}</span>
                            </div>
                            <div class="bottom">
                                <ul>
                                    <li><span class="quality">{{$item->main_category_name}}</span></li>
                                    <li>
                                        <span class="duration"><i class="far fa-clock"></i>
                                            {{$item->average_min}} dk</span>
                                        <span class="rating"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="pagination-wrap mt-30">
                        <nav>
                            <ul>
                                @if ($currentPage != 1)
                                <li><a href="{{$path}}?p={{$currentPage - 1}}">Geri</a></li>
                                @endif
                                @for ($i = 1; $i<=$pageCount; $i++) @if ($currentPage==$i) <li class="active"><a
                                        href="{{$path}}?p={{$i}}">{{$i}}</a></li>
                                    @else
                                    <li><a href="{{$path}}?p={{$i}}">{{$i}}</a></li>
                                    @endif
                                    @endfor
                                    @if ($currentPage != $pageCount)
                                    <li><a href="{{$path}}?p={{$currentPage + 1}}">İleri</a></li>
                                    @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- movie-area-end -->

</main>
<!-- main-area-end -->
@endsection