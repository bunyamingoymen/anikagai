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
                        <h2 class="title"><span>Arama</span></h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('index')}}">Anasyafa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Arama</li>
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
                        <h2 class="title" id="PageTitle">Sonuçlar</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="movie-page-meta">
                        <div class="tr-movie-menu-active text-center">
                            <button class="active" data-filter="*">Arama</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row tr-movie-active">
                @foreach ($results as $result)
                @foreach ($result as $item)
                @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus ==
                2)))
                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-two">
                    <div class="movie-item movie-item-three mb-50">
                        <div class="movie-poster">
                            <img src="../../../{{$item->image}}" alt=""
                                style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;">
                            <ul class="overlay-btn">
                                <li><a href="{{$path == 'animeler' ? url('anime/'.$item->short_name) : url('webtoon/'.$item->short_name)}}"
                                        class="btn">Detay</a></li>

                            </ul>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                <h5 class="title"><a
                                        href="{{$path == 'animeler' ? url('anime/'.$item->short_name) : url('webtoon/'.$item->short_name)}}">{{$item->name}}</a>
                                </h5>
                                <span class="date">{{$item->date}}</span>
                            </div>
                            <div class="bottom">
                                <ul>
                                    <li><span class="quality">{{$item->main_category_name}}</span></li>
                                    <li>
                                        <span class="duration"><i class="far fa-clock"></i>
                                            {{$item->average_min}} dk</span>
                                        <span class="rating"><i class="fas fa-thumbs-up"></i>{{$item->score}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer cat-two">
                    <div class="movie-item movie-item-three mb-50">
                        <div class="movie-poster">
                            <div class="movie-poster" style="filter: blur(7px);">
                                <img src=" ../../../{{$item->image}}" alt="" style=" min-width: 303px; min-height: 430px; max-width:
                                                                            303px; max-height: 430px;">
                            </div>
                            <ul class="overlay-btn">
                                <li><a href="{{route('login')}}" class="btn">Görmek için giriş yapınız</a></li>

                            </ul>
                        </div>
                        <div class="movie-content">
                            <div class="top">
                                <h5 class="title"><a href="{{route('login')}}">Bilinmiyor</a>
                                </h5>
                                <span class=" date">0000</span>
                            </div>
                            <div class="bottom">
                                <ul>
                                    <li><span class="quality">Bilinmiyor</span></li>
                                    <li>
                                        <span class="duration"><i class="far fa-clock"></i>
                                            0 dk</span>
                                        <span class="rating"><i class="fas fa-thumbs-up"></i>{{$item->score}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                @endforeach

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="pagination-wrap mt-30">
                        <nav>
                            <ul>
                                <li><a href="{{$path}}&p={{$currentPage - 1}}" {{ ($currentPage<=1) ? 'hidden' : ''
                                        }}>Geri</a></li>
                                @for ($i = 1; $i<=$pageCount; $i++) @if ($currentPage==$i) <li class="active"><a
                                        href="{{$path}}&p={{$i}}">{{$i}}</a></li>
                                    @else
                                    <li><a href="{{$path}}&p={{$i}}">{{$i}}</a></li>
                                    @endif
                                    @endfor
                                    <li><a href="{{$path}}&p={{$currentPage + 1}}" {{ ( $currentPage + 1>$pageCount) ?
                                            'hidden' : '' }}>İleri</a></li>
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