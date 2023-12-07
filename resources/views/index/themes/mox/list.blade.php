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
                        <h2 class="title"><span>{{$title}} <span id="mainTitleID" style="color:red;"></span> </span>
                        </h2>
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
            <!--Başlık Ve Kategoriler-->
            <div class="row align-items-end mb-60">
                <div class="col-lg-6">
                    <div class="section-title text-center text-lg-left">
                        <span class="sub-title"></span>
                        <h2 class="title" id="PageTitle">Son EKlenen {{$title}}</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="movie-page-meta">
                        <div class="tr-movie-menu-active text-center">
                            <button class="active" data-filter="*">Animeler</button>
                        </div>
                        <form action="#" class="movie-filter-form">
                            <select class="" id="categorySelected" onchange="changeCategory()">
                                <option value="all">Hepsi</option>
                                @foreach ($allCategory as $category)
                                <option value="{{$category->short_name}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </form>
                        <form action="#" class="movie-filter-form">

                            <select class="custom-select" id="orderBySelected" onchange="changeOrderBy()">
                                <option value="created_AtDESC" selected>Son Eklenenler</option>
                                <option value="created_AtASC">İlk Eklenenler</option>
                                <option value="TrendsDESC">En çok izlenenler</option>
                                <option value="TrendsASC">En Az İzlenenler</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <!--Listeleme-->
            <div class="row tr-movie-active">
                @foreach ($list as $item)
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

            </div>
            <!--Sayfalama-->
            <div class="row">
                <div class="col-12">
                    <div class="pagination-wrap mt-30">
                        <nav>
                            <ul>
                                @if ($currentPage != 1)
                                <li><a href="javascript:;" onclick=" changePage({{$currentPage - 1}})">Geri</a></li>
                                @endif
                                @for ($i = 1; $i<=$pageCount; $i++) @if ($currentPage==$i) <li class="active"><a
                                        href="javascript:;" onclick=" changePage({{$i}})">{{$i}}</a></li>
                                    @else
                                    <li><a href="javascript:;" onclick=" changePage({{$i}})">{{$i}}</a></li>
                                    @endif
                                    @endfor
                                    @if ($currentPage != $pageCount)
                                    <li><a href=" javascript:;" onclick=" changePage({{$currentPage + 1}})">İleri</a>
                                    </li>
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

<!-- JS here -->
<script src="../../../user/mox/js/vendor/jquery-3.6.0.min.js"></script>

<script>
    var page = "{{ request('p', 1) }}";
    var orderBy = "{{request('orderBy', 'created_AtDESC')}}";
    var category = "{{request('category', 'all')}}";
    var adult = "{{request('adult', 'off')}}";

    $(document).ready(function () {
        document.getElementById("orderBySelected").value = orderBy;
        document.getElementById("categorySelected").value = category;

        if(adult == "on"){
            document.getElementById('mainTitleID').innerText = "+18";
        }
    });

    var url = "";

    function changeAdult(){
        if(adult == "off") adult="on";
        else if(adult == "on") adult="off";
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

    function changeCategory(){
        category = document.getElementById("categorySelected").value;
        changeURL();
    }

    function changeURL(){

        url = "{{$path}}?";
        first = false;

        if(adult != "off"){
            if(first) adult += "&adult=" + "on";
            else{
                first = true;
                url += "adult=" + "on"
            }
        }

        if(category != "all"){
            if(first) url += "&category=" + category;
            else{
                first = true;
                url += "category=" + category
            }
        }

        if(orderBy != "created_AtDESC"){
            if(first) url += "&orderBy=" + orderBy;
            else{
                first = true;
                url += "orderBy=" + orderBy
            }
        }

        if(page != "1"){
            if(first) url += "&p=" + page;
            else {
                first = true;
                url += "p=" + page
            }
        }

        window.location.href = url;
    }
</script>
@endsection