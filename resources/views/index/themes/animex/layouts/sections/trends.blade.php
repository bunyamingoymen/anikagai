@php
    //Burası anime detail ve webtoon detail de kullanılan benzer içerikler kısmı
@endphp

<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="trending__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Benzer İçerikler</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($trend_series as $item)
                            @if ($item->showStatus == 0 || (Auth::user() && ($item->showStatus == 1 || $item->showStatus == 2)))
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <div class="product__item">
                                        <a href="{{ url($trend_type . '/' . $item->short_name) }}">
                                            <div class="product__item__pic set-bg"
                                                data-setbg="{{ url($item->thumb_image) }}">
                                                <div class="ep">{{ $item->score }} / 5</div>
                                                <div class="comment"><i class="fa fa-comments"></i>
                                                    {{ $item->comment_count }}
                                                </div>
                                                <div class="view"><i class="fa fa-eye"></i>
                                                    {{ $item->click_count }} </div>
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                <li>{{ $item->main_category_name ?? 'Genel' }}</li>
                                            </ul>
                                            <h5><a
                                                    href="{{ url($trend_type . '/' . $item->short_name) }}">{{ $item->name }}</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <a href="{{ route('loginScreen') }}">
                                            <div class="product__item__pic" style="">
                                                <div
                                                    style="width: 100%; height: 100%; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                                    <div class="censor set-bg"
                                                        data-setbg="{{ url($item->thumb_image) }}">
                                                    </div>
                                                    <div style="margin-top: 20px; z-index: 2;">
                                                        <a class="overlay-button"
                                                            href="{{ route('loginScreen') }}">Görmek için
                                                            giriş yapınız</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product__item__text">
                                                <ul>
                                                    <li>Bilinmiyor</li>
                                                </ul>
                                                <h5><a href="{{ route('loginScreen') }}">Bilinmiyor</a>
                                                </h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
