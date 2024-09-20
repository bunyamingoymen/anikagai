@extends('shop.themes.kidol.layouts.main')
@section('shop_body')
    <!--== Start Shop Area ==-->
    <section class="product-single-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-0">
                    <div class="single-product-slider">
                        <div class="single-product-thumb">
                            <div class="swiper-container single-product-thumb-slider">
                                <div class="swiper-wrapper">
                                    @foreach ($images as $image)
                                        <div class="swiper-slide zoom zoom-hover">
                                            <div class="thumb-item">
                                                <a class="lightbox-image" data-fancybox="gallery"
                                                    href="{{ url($image->path) }}">
                                                    <img src="{{ url($image->path) }}" alt="Image-HasTech">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="single-product-nav">
                            <div class="swiper-container single-product-nav-slider">
                                <div class="swiper-wrapper">
                                    @foreach ($images as $image)
                                        <div class="swiper-slide">
                                            <div class="nav-item">
                                                <img src="{{ url($image->path) }}" alt="Image-HasTech">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-product-info">
                        <h4 class="title">{{ $item->name }}</h4>
                        <div class="prices">
                            @php
                                if ($item->priceType == 'USD') {
                                    $priceType = '$';
                                } elseif ($item->priceType == 'EUR') {
                                    $priceType = '€';
                                } else {
                                    $priceType = '₺';
                                }
                            @endphp
                            <span class="price">{{ $item->price }} {{ $priceType }}</span>
                        </div>
                        <div class="product-rating">
                            <div class="rating">
                                <span class="fa fa-star" style="{{ $item->score < 1 ? 'color:gray;' : '' }}"></span>
                                <span class="fa fa-star" style="{{ $item->score < 2 ? 'color:gray;' : '' }}"></span>
                                <span class="fa fa-star" style="{{ $item->score < 3 ? 'color:gray;' : '' }}"></span>
                                <span class="fa fa-star" style="{{ $item->score < 4 ? 'color:gray;' : '' }}"></span>
                                <span class="fa fa-star" style="{{ $item->score < 5 ? 'color:gray;' : '' }}"></span>
                            </div>
                            <div class="review">
                                <a href="#/">( {{ $item->reviewCount }} Yorum )</a>
                            </div>
                        </div>
                        <p class="product-desc">
                            {!! $item->description !!}
                        </p>
                        <div class="quick-product-action">
                            <div class="action-top">
                                <div class="pro-qty">
                                    <input type="text" id="quantity" title="Quantity" value="01" />
                                </div>
                                <button class="btn btn-theme">Sepete Ekle</button>
                                <a class="btn-wishlist" href="shop-wishlist.html">Istek Listesine Ekle</a>
                            </div>
                        </div>
                        <div class="widget">
                            <h3 class="title">Satıcı:</h3>
                            <div class="widget-tags">
                                <span>{{ $sellerName }}</span>
                            </div>
                        </div>
                        <div class="widget">
                            <h3 class="title">Kategoriler:</h3>
                            <div class="widget-tags">
                                @foreach ($categories as $category)
                                    <a href="{{ route('shop_list', [$category->category_url]) }}">{{ $category->category_name }}
                                        {{ $loop->index == count($categories) - 1 ? '' : ',' }} </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-description-review">
                            <ul class="nav nav-tabs product-description-tab-menu" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="product-aditional-tab" data-bs-toggle="tab"
                                        data-bs-target="#commentProduct" type="button" role="tab"
                                        aria-selected="false">Açıklama</button>
                                </li>
                                @if (isset($features) && count($features) > 0)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="product-desc-tab" data-bs-toggle="tab"
                                            data-bs-target="#productDesc" type="button" role="tab"
                                            aria-controls="productDesc" aria-selected="true">Özellikler</button>
                                    </li>
                                @endif

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="product-review-tab" data-bs-toggle="tab"
                                        data-bs-target="#productReview" type="button" role="tab"
                                        aria-controls="productReview" aria-selected="false">Yorum
                                        ({{ $item->reviewCount }})</button>
                                </li>
                            </ul>
                            <div class="tab-content product-description-tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="commentProduct" role="tabpanel"
                                    aria-labelledby="product-aditional-tab">
                                    <div class="product-desc">
                                        <p>
                                            {!! $item->description !!}
                                        </p>
                                    </div>
                                </div>
                                @if (isset($features) && count($features) > 0)
                                    <div class="tab-pane fade " id="productDesc" role="tabpanel"
                                        aria-labelledby="product-desc-tab">
                                        <div class="product-desc">
                                            <div class="single-product-info">
                                                <table class="table">
                                                    <tbody>
                                                        @foreach ($features as $feature)
                                                            @php
                                                                $answer = '';
                                                                if ($feature->feature_type == 1) {
                                                                    foreach ($features_alt as $feature_alt) {
                                                                        if ($feature_alt->code == $feature->answer) {
                                                                            $answer = $feature_alt->value;
                                                                        }
                                                                    }
                                                                }

                                                                if ($answer == '') {
                                                                    $answer = $feature->answer;
                                                                }

                                                            @endphp
                                                            <tr>
                                                                <th scope="row">{{ $feature->feature_name }}:</th>
                                                                <td>{{ $answer }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="tab-pane fade" id="productReview" role="tabpanel"
                                    aria-labelledby="product-review-tab">
                                    <div class="product-review">
                                        <div class="review-header">
                                            <h4 class="title">Customer Reviews</h4>
                                            <div class="review-info">
                                                <ul class="review-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                                <span class="review-caption">Based on 1 review</span>
                                                <span class="review-write-btn">Write a review</span>
                                            </div>
                                        </div>
                                        <div class="product-review-form">
                                            <h4 class="title">Write a review</h4>
                                            <form action="#" method="post">
                                                <div class="review-form-content">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="reviewFormName">Name</label>
                                                                <input class="form-control" id="reviewFormName"
                                                                    type="text" placeholder="Enter your name"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="reviewFormEmail">Email</label>
                                                                <input class="form-control" id="reviewFormEmail"
                                                                    type="email" placeholder="john.smith@example.com"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="rating">
                                                                <span class="rating-title">Rating</span>
                                                                <span>
                                                                    <a class="fa fa-star-o" href="#/"></a>
                                                                    <a class="fa fa-star-o" href="#/"></a>
                                                                    <a class="fa fa-star-o" href="#/"></a>
                                                                    <a class="fa fa-star-o" href="#/"></a>
                                                                    <a class="fa fa-star-o" href="#/"></a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="reviewReviewTitle">Review Title</label>
                                                                <input class="form-control" id="reviewReviewTitle"
                                                                    type="text" placeholder="Give your review a title"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="reviewFormTextarea">Body of Review
                                                                    <span>(1500)</span></label>
                                                                <textarea class="form-control textarea" id="reviewFormTextarea" name="comment" rows="7"
                                                                    placeholder="Write your comments here" required=""></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group pull-right">
                                                                <button class="btn btn-theme" type="submit">Submit
                                                                    Review</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="review-content">
                                            <div class="review-item">
                                                <ul class="review-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                                <h4 class="title">Cobus Bester</h4>
                                                <h5 class="review-date"><span>Cobus Bester</span> on <span>Mar 03,
                                                        2021</span></h5>
                                                <p>Can’t wait to start mixin’ with this one! Irba-irr-Up-up-up-up-date your
                                                    theme!</p>
                                                <a class="review-report" href="#/">Report as Inappropriate</a>
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            <div class="review-item">
                                                <ul class="review-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                                <h4 class="title">Cobus Bester</h4>
                                                <h5 class="review-date"><span>Cobus Bester</span> on <span>Mar 05,
                                                        2021</span></h5>
                                                <p>Can’t wait to start mixin’ with this one! Irba-irr-Up-up-up-up-date your
                                                    theme!</p>
                                                <a class="review-report" href="#/">Report as Inappropriate</a>
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            <div class="review-item">
                                                <ul class="review-rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                                <h4 class="title">Cobus Bester</h4>
                                                <h5 class="review-date"><span>Cobus Bester</span> on <span>Mar 07,
                                                        2021</span></h5>
                                                <p>Can’t wait to start mixin’ with this one! Irba-irr-Up-up-up-up-date your
                                                    theme!</p>
                                                <a class="review-report" href="#/">Report as Inappropriate</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== End Shop Area ==-->

    <!--== Start Shop Area ==-->
    <!--
                                                                                                                                                            <section class="product-slider-area related-product-area">
                                                                                                                                                                <div class="container">
                                                                                                                                                                    <div class="row">
                                                                                                                                                                        <div class="col-lg-6 m-auto">
                                                                                                                                                                            <div class="section-title text-center">
                                                                                                                                                                                <h2 class="title">Benzer Ürünler</h2>
                                                                                                                                                                                <div class="desc">
                                                                                                                                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod incididunt ut labore
                                                                                                                                                                                        et dolore magna aliqua.</p>
                                                                                                                                                                                </div>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                    <div class="row">
                                                                                                                                                                        <div class="col-12">
                                                                                                                                                                            <div class="product-tab1-slider">
                                                                                                                                                                                @for ($i = 0; $i < 10; $i++)
    <div class="slide-item">

                                                                                                                                                                                        <div class="product-item">
                                                                                                                                                                                            <div class="product-thumb">
                                                                                                                                                                                                <img src="assets/img/shop/9.png" alt="Image">
                                                                                                                                                                                                <div class="product-action">
                                                                                                                                                                                                    <a class="action-quick-view" href="shop-cart.html"><i
                                                                                                                                                                                                            class="ion-ios-cart"></i></a>
                                                                                                                                                                                                    <a class="action-quick-view" href="javascript:void(0)"><i
                                                                                                                                                                                                            class="ion-arrow-expand"></i></a>
                                                                                                                                                                                                    <a class="action-quick-view" href="shop-wishlist.html"><i
                                                                                                                                                                                                            class="ion-heart"></i></a>
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
                                                                                                                                                                                                <h4 class="title"><a href="shop-single-product.html">Funskool Teddy Brown</a>
                                                                                                                                                                                                </h4>
                                                                                                                                                                                                <div class="prices">
                                                                                                                                                                                                    <span class="price">$190.12</span>
                                                                                                                                                                                                </div>
                                                                                                                                                                                            </div>
                                                                                                                                                                                        </div>

                                                                                                                                                                                    </div>
    @endfor
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>
                                                                                                                                                            </section>
                                                                                                                                                            -->
    <!--== End Shop Area ==-->
@endsection
