@extends('shop.themes.kidol.layouts.main')
@section('shop_body')
    <div class="product-area product-grid-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-toolbar-wrap">
                        <div class="product-showing-status">
                            <p class="count-result"><span>12 </span> Product Found of <span> 30</span></p>
                        </div>
                        <div class="product-sorting-menu product-sorting">
                            <span class="current">Sort By : <span> Default <i class="fa fa-angle-down"></i></span></span>
                            <ul>
                                <li class="active"><a href="shop.html" class="active">Sort by Default</a></li>
                                <li><a href="shop.html">Sort by Popularity</a></li>
                                <li><a href="shop.html">Sort by Rated</a></li>
                                <li><a href="shop.html">Sort by Latest</a></li>
                                <li><a href="shop.html">Sort by Price: <i class="lastudioicon-arrow-up"></i></a></li>
                                <li><a href="shop.html">Sort by Price: <i class="lastudioicon-arrow-down"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    @if (!isset($products['items']) || count($products['items']) <= 0)
                        <div class="section-title text-center" data-aos="fade-up" data-aos-duration="1000">
                            <h2 class="title mt-5">Herhangi bir ürün mevcut degil</h2>
                        </div>
                    @else
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
                                                <a class="action-quick-view {{ isset($product->cart_product_code) && ($product->cart_product_code = $product->code) ? 'active' : '' }}"
                                                    href="{{ route('shop_add_cart') }}?product_code={{ $product->code }}"><i
                                                        class="ion-ios-cart"></i></a>
                                                <a class="action-quick-view"
                                                    href="javascript:showDetail('{{ $product->code }}', '{{ $product->name }}', '{{ $image_path }}', '{{ $product->description }}', '{{ $product->price }}', '{{ $priceType }}', '0', '{{ $product->score }}', {{ isset($product->cart_product_code) && ($product->cart_product_code = $product->code) }});"><i
                                                        class="ion-arrow-expand"></i></a>
                                                <a class="action-quick-view {{ isset($product->whislist_product_code) && ($product->whislist_product_code = $product->code) ? 'active' : '' }}"
                                                    href="{{ route('shop_add_whislist') }}?product_code={{ $product->code }}"><i
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
                                            <h4 class="title"><a
                                                    href="{{ route('shop_product_detail', ['code' => $product->code]) }}">{{ $product->name }}</a>
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
                    @endif

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pagination-area">
                                <nav>
                                    <ul class="page-numbers">
                                        <li>
                                            <a class="page-number next" href="shop.html">
                                                <i class="fa fa-angle-left"></i>
                                            </a>
                                        </li>
                                        @for ($i = 1; $i <= $products['page_count']; $i++)
                                            @php
                                                if (($i == 1 && !isset($p)) || (isset($p) && $p == $i)) {
                                                    $active = 'active';
                                                } else {
                                                    $active = '';
                                                }
                                            @endphp
                                            <li>
                                                <a class="page-number {{ $active }}" href="shop.html">1</a>
                                            </li>
                                        @endfor
                                        <li>
                                            <a class="page-number next" href="shop.html">
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
