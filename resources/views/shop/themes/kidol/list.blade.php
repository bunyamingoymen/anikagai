@extends('shop.themes.kidol.layouts.main')
@section('shop_body')
    @if (!isset($products['items']) || count($products['items']) <= 0)
        <section class="product-area product-style2-area mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 m-auto">
                        <div class="section-title text-center" data-aos="fade-up" data-aos-duration="1000">
                            <h2 class="title mt-5">Herhangi bir ürün mevcut degil</h2>
                            <div class="desc">
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


    <section class="product-area product-style1-area mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product">
                        <div class="row">
                            @foreach ($products['items'] as $product)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <!-- Start Product Item -->
                                    @php
                                        if ($product->priceType == 'USD') {
                                            $priceType = '$';
                                        } elseif ($product->priceType == 'EUR') {
                                            $priceType = '€';
                                        } else {
                                            $priceType = '₺';
                                        }

                                        $image_path = $product->image_path ?? '';
                                        $image_path = url($image_path);
                                    @endphp
                                    <div class="product-item">
                                        <div class="product-thumb">
                                            <img src="{{ $image_path }}" alt="Image">
                                            <div class="product-action">
                                                <a class="action-quick-view" href="shop-cart.html"><i
                                                        class="ion-ios-cart"></i></a>
                                                <a class="action-quick-view"
                                                    href="javascript:showDetail('{{ $product->code }}', '{{ $product->name }}', '{{ $image_path }}', '{{ $product->description }}', '{{ $product->price }}', '{{ $priceType }}', '0', '{{ $product->score }}');"><i
                                                        class="ion-arrow-expand"></i></a>
                                                <a class="action-quick-view" href="shop-wishlist.html"><i
                                                        class="ion-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <div class="rating">
                                                <span class="fa fa-star"
                                                    style="{{ $product->score < 1 ? 'color: gray;' : '' }}"></span>
                                                <span class="fa fa-star"
                                                    style="{{ $product->score < 2 ? 'color: gray;' : '' }}"></span>
                                                <span class="fa fa-star"
                                                    style="{{ $product->score < 3 ? 'color: gray;' : '' }}"></span>
                                                <span class="fa fa-star"
                                                    style="{{ $product->score < 4 ? 'color: gray;' : '' }}"></span>
                                                <span class="fa fa-star"
                                                    style="{{ $product->score < 5 ? 'color: gray;' : '' }}"></span>
                                            </div>
                                            <h4 class="title"><a href="shop-single-product.html">{{ $product->name }}</a>
                                            </h4>
                                            <div class="prices">

                                                <span class="price">{{ $product->price }} {{ $priceType }}</span>
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
@endsection
