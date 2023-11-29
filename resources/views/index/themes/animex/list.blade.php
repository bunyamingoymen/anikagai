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
                            <div class="col-lg-8 col-md-8 col-sm-6">
                                <div class="section-title">
                                    <h4>{{$title}}</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="product__page__filter">
                                    <p>Sırala:</p>
                                    <select class="" id="orderBySelected" onchange="changeOrderBy()">
                                        <option value="created_AtDESC" selected>Son Eklenenler</option>
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
                                <a href="anime/{{$item->short_name}}">
                                    @elseif ($path == "webtoonlar")
                                    <a href="webtoon/{{$item->short_name}}">
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
                                            <a href="anime/{{$item->short_name}}">{{$item->name}}</a>
                                            @elseif ($path == "webtoonlar")
                                            <a href="webtoon/{{$item->short_name}}">{{$item->name}}</a>
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

    $(document).ready(function () {
        document.getElementById("orderBySelected").value = orderBy;
    });

    function changeOrderBy() {
        var order = document.getElementById("orderBySelected").value;
        if (page == 1) {
            window.location.href = "?orderBy=" + order;
        } else {
            window.location.href = "?orderBy=" + order + "&p=" + page;
        }
    }

    function changePage(nextPage) {
        if (orderBy == "created_AtDESC") {
            window.location.href = "?p=" + nextPage;
        } else {
            window.location.href = "?orderBy=" + orderBy + "&p=" + nextPage;
        }
    }
</script>

@endsection