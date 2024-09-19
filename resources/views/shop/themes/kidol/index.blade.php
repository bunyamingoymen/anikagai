@extends('shop.themes.kidol.layouts.main')
@section('shop_body')
    <!--== Start Hero Area Wrapper (Slider) ==-->
    <section class="home-slider-area slider-default">
        <div class="home-slider-content">
        <div class="swiper-container home-slider-container">
            <div class="swiper-wrapper">
            <div class="swiper-slide">
                <!-- Start Slide Item -->
                <div class="home-slider-item">
                <div class="thumb-one bg-img" data-bg-img="{{ url('shop_files/assets/img/slider/1.png')}}"></div>
                <div class="slider-content-area">
                    <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="content">
                            <div class="inner-content">
                            <h2>Best Kids Store & Online Shop</h2>
                            <p>Give The Gift Of Your Children Everyday</p>
                            <a href="shop.html" class="btn-theme">Shop This Now</a>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <img class="thumb-two" src="{{ url('shop_files/assets/img/slider/2.png')}}" alt="Image" style="max-width: 684px;">
                    <img class="thumb-four" src="{{ url('shop_files/assets/img/photos/3.png')}}" alt="Image" style="max-width: 118px;">
                </div>
                </div>
                <!-- End Slide Item -->
            </div>
            </div>
        </div>
        </div>
    </section>
    <!--== End Hero Area Wrapper ==-->

    <!--== Start Product Tab Area Wrapper (Trend kısmı)==-->
    @if (count($trends['items'])>0)
    <section class="product-area product-style2-area mt-5">
        <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
            <div class="section-title text-center" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="title">Öne Çıkan Ürünler</h2>
                <div class="desc">
                <p></p>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <div class="product-tab1-slider" data-aos="fade-up" data-aos-duration="1500">
                @foreach ($trends['items'] as $trend)
                <div class="slide-item">
                    @php
                        if($trend->priceType == 'USD') $priceType = '$';
                        else if($trend->priceType == 'EUR') $priceType = '€';
                        else $priceType = '₺';

                        $image_path = $trend->image_path ?? '';
                        $image_path = url($trend->image_path);
                    @endphp
                    <!-- Start Product Item -->
                    <div class="product-item">
                        <div class="product-thumb">
                        <img src="{{ $image_path }}" alt="Image">
                        <div class="product-action">
                            <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                            <a class="action-quick-view" href="javascript:showDetail('{{$trend->code}}', '{{$trend->name}}', '{{$image_path}}', '{{$trend->description}}', '{{$trend->price}}', '{{$priceType}}', '0', '{{$trend->score}}');"><i class="ion-arrow-expand"></i></a>
                            <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        </div>
                        </div>
                        <div class="product-info">
                        <div class="rating">
                            <span class="fa fa-star" style="{{$trend->score<1 ? 'color: gray;' : ''}}" ></span>
                            <span class="fa fa-star" style="{{$trend->score<2 ? 'color: gray;' : ''}}"></span>
                            <span class="fa fa-star" style="{{$trend->score<3 ? 'color: gray;' : ''}}"></span>
                            <span class="fa fa-star" style="{{$trend->score<4 ? 'color: gray;' : ''}}"></span>
                            <span class="fa fa-star" style="{{$trend->score<5 ? 'color: gray;' : ''}}"></span>
                        </div>
                        <h4 class="title"><a href="shop-single-product.html">{{$trend->name}}</a></h4>

                        <div class="prices">
                            <span class="price">{{$trend->price}} {{$priceType}}</span>
                        </div>
                        </div>
                    </div>
                    <!-- End Product Item -->
                </div>
                @endforeach


            </div>
            </div>
        </div>
        </div>
    </section>
    @endif
    <!--== End Product Tab Area Wrapper ==-->

    <!--== Start Product Tab Area Wrapper (Product) ==-->
    @if (count($products['items'])>0)
    <section class="product-area product-style1-area mt-5">
        <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
            <div class="section-title text-center" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="title">Ürünlerimiz</h2>
                <div class="desc">
                <p></p>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <div class="product">
                <div class="row">
                    @foreach ($products['items']  as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <!-- Start Product Item -->
                        <div class="product-item">
                        <div class="product-thumb">
                            @php
                                $image_path = $product->image_path ?? '';
                                $image_path= url($image_path);

                                if($product->priceType == 'USD') $priceType = '$';
                                else if($product->priceType == 'EUR') $priceType = '€';
                                else $priceType = '₺';
                            @endphp
                            <img src="{{ url($image_path)}}" alt="Image">
                            <div class="product-action">
                            <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                            <a class="action-quick-view" href="javascript:showDetail('{{$product->code}}', '{{$product->name}}', '{{$image_path}}', '{{$product->description}}', '{{$product->price}}', '{{$priceType}}', '0', '{{$product->score}}');"><i class="ion-arrow-expand"></i></a>
                            <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="rating">
                            <span class="fa fa-star" style="{{$product->score<1 ? 'color: gray;' : ''}}"></span>
                            <span class="fa fa-star" style="{{$product->score<2 ? 'color: gray;' : ''}}"></span>
                            <span class="fa fa-star" style="{{$product->score<3 ? 'color: gray;' : ''}}"></span>
                            <span class="fa fa-star" style="{{$product->score<4 ? 'color: gray;' : ''}}"></span>
                            <span class="fa fa-star" style="{{$product->score<5 ? 'color: gray;' : ''}}"></span>
                            </div>
                            <h4 class="title"><a href="shop-single-product.html">{{$product->name}}</a></h4>
                            <div class="prices">
                            <span class="price">{{$product->price}}  {{$priceType}}</span>
                            </div>
                        </div>
                        </div>
                        <!-- End Product Item -->
                    </div>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
    @endif

    <!--== End Product Tab Area Wrapper ==-->
@endsection
