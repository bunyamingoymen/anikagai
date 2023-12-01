@extends("index.themes.animex.layouts.main")
@section('index_content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{route('index')}}"><i class="fa fa-home"></i> Anasayfa</a>
                    <span>{{$title}}</span>
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
                                    <h4>{{$title}}</h4>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="product__page__filter">
                                    <p>Kategoriler:</p>
                                    <select class="" id="categorySelected" onchange="changeCategory()">
                                        <option value="all">Hepsi</option>
                                        @foreach ($allCategory as $category)
                                        <option value="{{$category->short_name}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4">
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
                    <div class="row">
                        @foreach ($list as $item)
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="product__item">
                                @if ($path == "animeler")
                                <a href="{{url('anime/'.$item->short_name)}}">
                                    @elseif ($path == "webtoonlar")
                                    <a href="{{url('webtoon/'.$item->short_name)}}">
                                        @endif
                                        <div class="product__item__pic set-bg" data-setbg="../../../{{$item->image}}">
                                            <div class="ep">{{$item->score}} / 5</div>
                                            <div class="comment"><i class="fa fa-comments"></i> {{$item->comment_count}}
                                            </div>
                                            <div class="view"><i class="fa fa-eye"></i> {{$item->click_count}}</div>
                                        </div>
                                    </a>
                                    <div class="product__item__text">
                                        <ul>
                                            <li>{{$item->main_category_name}}</li>
                                        </ul>
                                        <h5>
                                            @if ($path == "animeler")
                                            <a href="{{url('anime/'.$item->short_name)}}">{{$item->name}}</a>
                                            @elseif ($path == "webtoonlar")
                                            <a href="{{url('webtoon/'.$item->short_name)}}">{{$item->name}}</a>
                                            @endif
                                        </h5>
                                    </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="product__pagination">
                    @if ($currentPage != 1)
                    <a href="javascript:;" onclick=" changePage({{$currentPage - 1}})"><i
                            class="fa fa-angle-double-left"></i></a>
                    @endif
                    @for ($i = 1; $i<=$pageCount; $i++) @if ($currentPage==$i) <a href="javascript:;"
                        onclick=" changePage({{$i}})" class="current-page">{{$i}}</a>
                        @else
                        <a href="javascript:;" onclick=" changePage({{$i}})">{{$i}}</a>
                        @endif
                        @endfor
                        @if ($currentPage != $pageCount)
                        <a href=" javascript:;" onclick=" changePage({{$currentPage + 1}})"><i
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
    var orderBy = "{{request('orderBy', 'created_AtDESC')}}";
    var category = "{{request('category', 'all')}}";

    $(document).ready(function () {
        document.getElementById("orderBySelected").value = orderBy;
        document.getElementById("categorySelected").value = category;
    });

    var url = "";
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
