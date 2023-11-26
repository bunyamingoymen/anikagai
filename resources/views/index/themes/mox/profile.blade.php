@extends("index.themes.mox.layouts.main")
@section('index_content')
<main>

    <!-- movie-details-area -->
    <section class="movie-details-area" data-background="../../../user/mox/img/bg/movie_details_bg.jpg">
        <div class="container">
            <div class="row align-items-center position-relative">
                <div class="col-xl-3 col-lg-4">
                    <div class="../../../user/mox/movie-details-img">
                        <img src="../../../{{$user->image ?? 'user/img/profile/default.png'}}" alt=""
                            style="min-width: 303px; min-height: 430px; max-width: 303px; max-height: 430px;">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-8">
                    <div class="movie-details-content">
                        <h2><span>{{$user->name}}</span></h2>
                        <p>{{$user->username}}</p>
                        <div class="banner-meta">
                            <ul>
                                <li class="quality">
                                    <span>HD</span>
                                </li>
                                <li class="category">
                                    <a href="#">Romaitk,</a>
                                    <a href="#">Dram</a>
                                </li>
                                <li class="release-time">
                                    <span><i class="far fa-calendar-alt"></i> 2014</span>
                                    <span><i class="far fa-clock"></i>Bölüm</span>
                                </li>
                            </ul>
                        </div>
                        <p>
                            {{$user->description ?? 'Açıklama Mevcut değil'}}
                        </p>
                        <div class="movie-details-prime">
                            <ul>
                                <li class="share"><a href="#"><i class="fas fa-share-alt"></i> Paylaş</a></li>
                                <li class="streaming">
                                    <h6>Full HD</h6>
                                    <span>Tüm bölümer Mevcut</span>
                                </li>
                                <li class="watch"><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                        class="btn popup-video"><i class="fas fa-play"></i>İzle</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="movie-details-btn">
                    @if (false)
                    <a href="img/poster/movie_details_img.jpg" class="download-btn" download="">İndir <img
                            src="../../../user/mox/fonts/download.svg" alt=""></a>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- movie-details-area-end -->

</main>
@endsection
