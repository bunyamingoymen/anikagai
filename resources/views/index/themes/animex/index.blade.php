@extends("index.themes.animex.layouts.main")
@section('index_content')

<style>
</style>
<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="hero__slider owl-carousel">
            @foreach ($slider_image as $index => $item)
            <div id="heroSlider{{$index + 1}}" class="hero__items set-bg"
                data-setbg="../../../{{$item->optional ?? ''}}" onmouseover="showVideo({{ $index }})"
                onmouseout="hideVideo({{ $index }})">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="hero__text">
                            <h2>{{$item->value}}</h2>
                            <a href="{{$item->optional_2 ?? ''}}"><span>Sayfaya Git</span> <i
                                    class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="video-container">
                    <video class="video" preload="auto" loop muted>
                        <source src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Hero Section End -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if ($anime_active->value == 1)
                <div class="trending__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Animeler</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="{{route('anime_list')}}" class="primary-btn">Tümünü Görüntüle <span
                                        class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($animes as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <a href="{{url('anime/'.$item->short_name)}}">
                                    <div class="product__item__pic set-bg" data-setbg="../../../{{$item->image}}">
                                        <div class="ep">{{$item->score}} / 5</div>
                                        <div class="comment"><i class="fa fa-comments"></i> {{$item->comment_count}}
                                        </div>
                                        <div class="view"><i class="fa fa-eye"></i> {{$item->click_count}} </div>
                                    </div>
                                </a>
                                <div class="product__item__text">
                                    <ul>
                                        <li>{{$item->main_category_name ?? 'Genel'}}</li>
                                    </ul>
                                    <h5><a href="{{url('anime/'.$item->short_name)}}">{{$item->name}}</a></h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @if ($webtoon_active->value == 1)
                <div class="trending__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Webtoonlar</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="{{route('webtoon_list')}}" class="primary-btn">Tümünü Görüntüle <span
                                        class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($webtoons as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <a href="{{url('webtoon/'.$item->short_name)}}">
                                    <div class="product__item__pic set-bg" data-setbg="../../../{{$item->image}}">
                                        <div class="ep">{{$item->score}} / 5</div>
                                        <div class="comment"><i class="fa fa-comments"></i> {{$item->comment_count}}
                                        </div>
                                        <div class="view"><i class="fa fa-eye"></i> {{$item->click_count}} </div>
                                    </div>
                                </a>
                                <div class="product__item__text">
                                    <ul>
                                        <li>{{$item->main_category_name ?? 'Genel'}}</li>
                                    </ul>
                                    <h5><a href="{{url('webtoon/'.$item->short_name)}}">{{$item->name}}</a></h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="product__sidebar">
                    @if ($anime_active->value == 1)
                    <div class="product__sidebar__comment">
                        <div class="section-title">
                            <h5>Trend Animeler</h5>
                        </div>
                        @foreach ($trend_animes as $item)
                        <div class="product__sidebar__comment__item">
                            <div class="product__sidebar__comment__item__pic">
                                <img src="../../../{{$item->image}}" alt="" style="min-width: 90px !important; min-height: 130px !important; max-width: 90px !important; max-height: 130px
                                !important;">
                            </div>
                            <div class="product__sidebar__comment__item__text">
                                <ul>
                                    <li>{{$item->main_category_name}}</li>
                                </ul>
                                <h5><a href="{{url('anime/'.$item->short_name)}}">{{$item->name}}</a></h5>
                                <span><i class="fa fa-eye"></i> {{$item->click_count}} Görüntülenme</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @if ($webtoon_active->value == 1)
                    <div class="product__sidebar__comment">
                        <div class="section-title">
                            <h5>Trend Webtoonlar</h5>
                        </div>
                        @foreach ($trend_webtoons as $item)
                        <div class="product__sidebar__comment__item">
                            <div class="product__sidebar__comment__item__pic">
                                <img src="../../../{{$item->image}}" alt="" style="min-width: 90px !important; min-height: 130px !important; max-width: 90px !important; max-height: 130px
                                !important;">
                            </div>
                            <div class="product__sidebar__comment__item__text">
                                <ul>
                                    <li>{{$item->main_category_name}}</li>
                                </ul>
                                <h5><a href="{{url('webtoon/'.$item->short_name)}}">{{$item->name}}</a></h5>
                                <span><i class="fa fa-eye"></i> {{$item->click_count}} Görüntülenme</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Js Plugins -->
<script src="../../../user/animex/js/jquery-3.3.1.min.js"></script>
<script src="../../../user/animex/js/owl.carousel.min.js"></script>
<script>
    // Tüm video elementlerini seç ve varsayılan olarak gizle
    // Önceden çekilen videoların bilgilerini saklamak için bir nesne oluştur
    var fetchedVideos = {};

    var videoElements = document.querySelectorAll('.video');
    var videoElementsContainer = document.querySelectorAll('.video-container');
    videoElements.forEach(function (video) {
        //video.style.display = 'none';
    });

    function showVideo(index) {

    // Daha önce çekilen bir video varsa tekrar çekme
    if (fetchedVideos[index]) {
        // Tüm video elementlerini duraklat ve gizle
        videoElements.forEach(function (video) {
            video.pause();
        });

        // Videoları gizle ve daha önce çekilmiş videoyu göster
        videoElementsContainer.forEach(function (container, i) {
            if (i === index) {
                container.style.display = 'block';
                videoElements[i].src = fetchedVideos[index];
                videoElements[i].play();
            } else {
                container.style.display = 'none';
            }
        });
    } else {
        // AJAX isteği yap
        fetch('/fetchVideo?index=' + (index+1))
        .then(response => response.json())
        .then(data => {
            // Videonun URL'sini al
            var videoUrl = data.video;

            // Daha önce çekilen videoyu sakla
            fetchedVideos[index] = videoUrl;

            // Tüm video elementlerini duraklat ve gizle
            videoElements.forEach(function (video) {
            video.pause();
            });

        // Videoları gizle ve yeni videoyu göster
        videoElementsContainer.forEach(function (container, i) {
        if (i === index) {
            container.style.display = 'block';
            videoElements[i].src = videoUrl;
            videoElements[i].play();
        } else {
            container.style.display = 'none';
        }
        });
    })
    .catch(error => {
        console.error('Error fetching video:', error);
    });
}
}

    function hideVideo(index) {
    videoElementsContainer[index].style.display = 'none';
    videoElements[index].pause();
    }
</script>
@endsection