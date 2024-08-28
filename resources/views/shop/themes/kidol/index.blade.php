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

    <!--== Start Category Area Wrapper (Fetaured Categories) ==-->
    <section class="category-area product-category1-area" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
        <div class="row category-items1">
            <div class="col-sm-6 col-md-4">
            <div class="category-item">
                <div class="thumb thumb-style1">
                <img src="{{ url('shop_files/assets/img/category/1.png')}}" alt="Image" style="max-width: 200px;">
                <div class="content">
                    <div class="contact-info">
                    <h2 class="title">Baby Dress</h2>
                    <h4 class="price">$32.00</h4>
                    </div>
                    <a class="btn-link" href="shop.html">Shop Now</a>
                </div>
                </div>
            </div>
            </div>
            <div class="col-sm-6 col-md-4">
            <div class="category-item mt-xs-25">
                <div class="thumb thumb-style2">
                <img src="{{ url('shop_files/assets/img/category/2.png')}}" alt="Image" style="max-width: 200px;">
                <div class="content">
                    <div class="contact-info">
                    <h2 class="title">Baby Toys</h2>
                    <h4 class="price">$25.00</h4>
                    </div>
                    <a class="btn-link" href="shop.html">Shop Now</a>
                </div>
                </div>
            </div>
            </div>
            <div class="col-sm-6 col-md-4">
            <div class="category-item mt-sm-25">
                <div class="thumb thumb-style3">
                <img src="{{ url('shop_files/assets/img/category/3.png')}}" alt="Image" style="max-width: 200px;">
                <div class="content">
                    <div class="contact-info">
                    <h2 class="title">Teddy Bear</h2>
                    <h4 class="price">$18.00</h4>
                    </div>
                    <a class="btn-link" href="shop.html">Shop Now</a>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
    <!--== End Category Area Wrapper ==-->

    <!--== Start Product Tab Area Wrapper (Trend kısmı)==-->
    <section class="product-area product-style2-area">
        <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
            <div class="section-title text-center" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="title">Trending Product</h2>
                <div class="desc">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod incididunt ut labore et dolore magna aliqua. </p>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <div class="product-tab1-slider" data-aos="fade-up" data-aos-duration="1500">
                <div class="slide-item">
                <!-- Start Product Item -->
                <div class="product-item">
                    <div class="product-thumb">
                    <img src="{{ url('shop_files/assets/img/shop/9.png')}}" alt="Image">
                    <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                    </div>
                    </div>
                    <div class="product-info">
                    <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <h4 class="title"><a href="shop-single-product.html">Funskool Teddy Brown</a></h4>
                    <div class="prices">
                        <span class="price">$190.12</span>
                    </div>
                    </div>
                </div>
                <!-- End Product Item -->
                </div>
                <div class="slide-item">
                <!-- Start Product Item -->
                <div class="product-item">
                    <div class="product-thumb">
                    <img src="{{ url('shop_files/assets/img/shop/10.png')}}" alt="Image">
                    <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                    </div>
                    </div>
                    <div class="product-info">
                    <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <h4 class="title"><a href="shop-single-product.html">Newborn Kit Set</a></h4>
                    <div class="prices">
                        <span class="price">$190.12</span>
                    </div>
                    </div>
                </div>
                <!-- End Product Item -->
                </div>
                <div class="slide-item">
                <!-- Start Product Item -->
                <div class="product-item">
                    <div class="product-thumb">
                    <img src="{{ url('shop_files/assets/img/shop/11.png')}}" alt="Image">
                    <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                    </div>
                    </div>
                    <div class="product-info">
                    <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <h4 class="title"><a href="shop-single-product.html">Classic Fisher Gift</a></h4>
                    <div class="prices">
                        <span class="price">$190.12</span>
                    </div>
                    </div>
                </div>
                <!-- End Product Item -->
                </div>
                <div class="slide-item">
                <!-- Start Product Item -->
                <div class="product-item">
                    <div class="product-thumb">
                    <img src="{{ url('shop_files/assets/img/shop/12.png')}}" alt="Image">
                    <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                    </div>
                    </div>
                    <div class="product-info">
                    <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <h4 class="title"><a href="shop-single-product.html">Sassy Crib and Floor Mirror</a></h4>
                    <div class="prices">
                        <span class="price">$190.12</span>
                    </div>
                    </div>
                </div>
                <!-- End Product Item -->
                </div>
                <div class="slide-item">
                <!-- Start Product Item -->
                <div class="product-item">
                    <div class="product-thumb">
                    <img src="{{ url('shop_files/assets/img/shop/9.png')}}" alt="Image">
                    <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                    </div>
                    </div>
                    <div class="product-info">
                    <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <h4 class="title"><a href="shop-single-product.html">Funskool Teddy Brown</a></h4>
                    <div class="prices">
                        <span class="price">$190.12</span>
                    </div>
                    </div>
                </div>
                <!-- End Product Item -->
                </div>
                <div class="slide-item">
                <!-- Start Product Item -->
                <div class="product-item">
                    <div class="product-thumb">
                    <img src="{{ url('shop_files/assets/img/shop/10.png')}}" alt="Image">
                    <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                    </div>
                    </div>
                    <div class="product-info">
                    <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <h4 class="title"><a href="shop-single-product.html">Newborn Kit Set</a></h4>
                    <div class="prices">
                        <span class="price">$190.12</span>
                    </div>
                    </div>
                </div>
                <!-- End Product Item -->
                </div>
                <div class="slide-item">
                <!-- Start Product Item -->
                <div class="product-item">
                    <div class="product-thumb">
                    <img src="{{ url('shop_files/assets/img/shop/11.png')}}" alt="Image">
                    <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                    </div>
                    </div>
                    <div class="product-info">
                    <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <h4 class="title"><a href="shop-single-product.html">Classic Fisher Gift</a></h4>
                    <div class="prices">
                        <span class="price">$190.12</span>
                    </div>
                    </div>
                </div>
                <!-- End Product Item -->
                </div>
                <div class="slide-item">
                <!-- Start Product Item -->
                <div class="product-item">
                    <div class="product-thumb">
                    <img src="{{ url('shop_files/assets/img/shop/12.png')}}" alt="Image">
                    <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                    </div>
                    </div>
                    <div class="product-info">
                    <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <h4 class="title"><a href="shop-single-product.html">Sassy Crib and Floor Mirror</a></h4>
                    <div class="prices">
                        <span class="price">$190.12</span>
                    </div>
                    </div>
                </div>
                <!-- End Product Item -->
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
    <!--== End Product Tab Area Wrapper ==-->

    <!--== Start Category Area Wrapper (Small Banner)==-->
    <section class="category-area product-category2-area" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
        <div class="row category-items2">
            <div class="col-md-6">
            <div class="category-item">
                <div class="thumb">
                <img class="w-100" src="{{ url('shop_files/assets/img/category/4.png')}}" alt="Image">
                <div class="content">
                    <div class="contact-info">
                    <h2 class="title text-white">Collection</h2>
                    <h4 class="price text-white">Flat <span>20%</span> Off</h4>
                    </div>
                    <a class="btn-theme" href="shop.html">Shop Now</a>
                </div>
                </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="category-item mt-sm-50">
                <div class="thumb">
                <img class="w-100" src="{{ url('shop_files/assets/img/category/5.png')}}" alt="Image">
                <div class="content">
                    <div class="contact-info">
                    <h2 class="title">Collection</h2>
                    <h4 class="price">Flat <span>30%</span> Off</h4>
                    </div>
                    <a class="btn-theme" href="shop.html">Shop Now</a>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
    <!--== End Category Area Wrapper ==-->

    <!--== Start Product Tab Area Wrapper (Product) ==-->
    <section class="product-area product-style1-area">
        <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
            <div class="section-title text-center" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="title">New Products</h2>
                <div class="desc">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod incididunt ut labore et dolore magna aliqua</p>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <div class="product">
                <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <!-- Start Product Item -->
                    <div class="product-item">
                    <div class="product-thumb">
                        <img src="{{ url('shop_files/assets/img/shop/1.png')}}" alt="Image">
                        <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        </div>
                        <h4 class="title"><a href="shop-single-product.html">Funskool Teddy</a></h4>
                        <div class="prices">
                        <span class="price">$190.12</span>
                        </div>
                    </div>
                    </div>
                    <!-- End Product Item -->
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <!-- Start Product Item -->
                    <div class="product-item">
                    <div class="product-thumb">
                        <img src="{{ url('shop_files/assets/img/shop/2.png')}}" alt="Image">
                        <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        </div>
                        <h4 class="title"><a href="shop-single-product.html">Baby Play Sets</a></h4>
                        <div class="prices">
                        <span class="price">$190.12</span>
                        </div>
                    </div>
                    </div>
                    <!-- End Product Item -->
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <!-- Start Product Item -->
                    <div class="product-item">
                    <div class="product-thumb">
                        <img src="{{ url('shop_files/assets/img/shop/3.png')}}" alt="Image">
                        <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        </div>
                        <h4 class="title"><a href="shop-single-product.html">Jigsaw Puzzles For Kids</a></h4>
                        <div class="prices">
                        <span class="price">$190.12</span>
                        </div>
                    </div>
                    </div>
                    <!-- End Product Item -->
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <!-- Start Product Item -->
                    <div class="product-item">
                    <div class="product-thumb">
                        <img src="{{ url('shop_files/assets/img/shop/4.png')}}" alt="Image">
                        <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        </div>
                        <h4 class="title"><a href="shop-single-product.html">Abstract Girl Dress</a></h4>
                        <div class="prices">
                        <span class="price">$190.12</span>
                        </div>
                    </div>
                    </div>
                    <!-- End Product Item -->
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <!-- Start Product Item -->
                    <div class="product-item">
                    <div class="product-thumb">
                        <img src="{{ url('shop_files/assets/img/shop/5.png')}}" alt="Image">
                        <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        </div>
                        <h4 class="title"><a href="shop-single-product.html">Bruder Toys Mini Ships</a></h4>
                        <div class="prices">
                        <span class="price">$190.12</span>
                        </div>
                    </div>
                    </div>
                    <!-- End Product Item -->
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <!-- Start Product Item -->
                    <div class="product-item">
                    <div class="product-thumb">
                        <img src="{{ url('shop_files/assets/img/shop/6.png')}}" alt="Image">
                        <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        </div>
                        <h4 class="title"><a href="shop-single-product.html">Abstract Boy Dress</a></h4>
                        <div class="prices">
                        <span class="price">$190.12</span>
                        </div>
                    </div>
                    </div>
                    <!-- End Product Item -->
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <!-- Start Product Item -->
                    <div class="product-item">
                    <div class="product-thumb">
                        <img src="{{ url('shop_files/assets/img/shop/7.png')}}" alt="Image">
                        <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        </div>
                        <h4 class="title"><a href="shop-single-product.html">Funskool Teddy Pink</a></h4>
                        <div class="prices">
                        <span class="price">$190.12</span>
                        </div>
                    </div>
                    </div>
                    <!-- End Product Item -->
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <!-- Start Product Item -->
                    <div class="product-item">
                    <div class="product-thumb">
                        <img src="{{ url('shop_files/assets/img/shop/8.png')}}" alt="Image">
                        <div class="product-action">
                        <a class="action-quick-view" href="shop-cart.html"><i class="ion-ios-cart"></i></a>
                        <a class="action-quick-view" href="javascript:void(0)"><i class="ion-arrow-expand"></i></a>
                        <a class="action-quick-view" href="shop-wishlist.html"><i class="ion-heart"></i></a>
                        <a class="action-quick-view" href="shop-compare.html"><i class="ion-shuffle"></i></a>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        </div>
                        <h4 class="title"><a href="shop-single-product.html">Toys Box For Baby</a></h4>
                        <div class="prices">
                        <span class="price">$190.12</span>
                        </div>
                    </div>
                    </div>
                    <!-- End Product Item -->
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
    <!--== End Product Tab Area Wrapper ==-->
@endsection
