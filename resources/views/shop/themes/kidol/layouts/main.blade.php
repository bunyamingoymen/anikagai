<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ env('APP_NAME') }} | Mağaza</title>

    <!--== Favicon ==-->
    <link rel="shortcut icon" href="{{ url('shop_files/assets/img/favicon.ico') }}" type="image/x-icon" />

    <!--== Google Fonts ==-->
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One:400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <style>
        :root {
            --background-color: #14161D;
            --menu-footer-color: #111216;
            --second-color: #e53637;
        }
    </style>

    <!--== Bootstrap CSS ==-->
    <link href="{{ url('shop_files/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!--== Font-awesome Icons CSS ==-->
    <link href="{{ url('shop_files/assets/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!--== Pe Icon 7 Min Icons CSS ==-->
    <link href="{{ url('shop_files/assets/css/pe-icon-7-stroke.min.css') }}" rel="stylesheet" />
    <!--== Ionicons CSS ==-->
    <link href="{{ url('shop_files/assets/css/ionicons.css') }}" rel="stylesheet" />
    <!--== Animate CSS ==-->
    <link href="{{ url('shop_files/assets/css/animate.css') }}" rel="stylesheet" />
    <!--== Aos CSS ==-->
    <link href="{{ url('shop_files/assets/css/aos.css') }}" rel="stylesheet" />
    <!--== FancyBox CSS ==-->
    <link href="{{ url('shop_files/assets/css/jquery.fancybox.min.css') }}" rel="stylesheet" />
    <!--== Slicknav CSS ==-->
    <link href="{{ url('shop_files/assets/css/slicknav.css') }}" rel="stylesheet" />
    <!--== Swiper CSS ==-->
    <link href="{{ url('shop_files/assets/css/swiper.min.css') }}" rel="stylesheet" />
    <!--== Slick CSS ==-->
    <link href="{{ url('shop_files/assets/css/slick.css') }}" rel="stylesheet" />
    <!--== Main Style CSS ==-->
    <link href="{{ url('shop_files/assets/css/style.css') }}" rel="stylesheet" />

    <!-- alertifyjs Css -->
    <link href="{{ url('admin/assets/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- alertifyjs default themes  Css -->
    <link href="{{ url('admin/assets/libs/alertifyjs/build/css/themes/default.min.css') }}" rel="stylesheet"
        type="text/css" />

</head>

<body>

    <!--wrapper start-->
    <div class="wrapper home-default-wrapper">

        <!--== Start Preloader Content ==-->
        <div class="preloader-wrap">
            <div class="preloader">
                <span class="dot"></span>
                <div class="dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <!--== End Preloader Content ==-->

        <!--== Start Header Wrapper ==-->
        @include('shop.themes.kidol.layouts.header')
        <!--== End Header Wrapper ==-->

        <main class="main-content">
            @yield('shop_body')
        </main>

        <!--== Start Footer Area Wrapper ==-->
        @include('shop.themes.kidol.layouts.footer')
        <!--== End Footer Area Wrapper ==-->

        <!--== Scroll Top Button ==-->
        <div class="scroll-to-top"><span class="fa fa-angle-double-up"></span></div>

        <!--== Start Product Quick View ==-->
        <aside class="product-quick-view-modal">
            <div class="product-quick-view-inner">
                <div class="product-quick-view-content">
                    <button type="button" class="btn-close">
                        <span class="pe-7s-close"><i class="lastudioicon-e-remove"></i></span>
                    </button>
                    <div class="row row-gutter-0">


                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="thumb">
                                <img id="product_modal_img" src="" alt="Image">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="single-product-info">
                                <h4 class="title" id="product_modal_name"></h4>
                                <div class="prices">
                                    <span class="price" id="product_modal_price"></span>
                                </div>
                                <div class="product-rating">
                                    <div class="rating">
                                        <span class="fa fa-star" id="product_modal_star_one"></span>
                                        <span class="fa fa-star" id="product_modal_star_two"></span>
                                        <span class="fa fa-star" id="product_modal_star_three"></span>
                                        <span class="fa fa-star" id="product_modal_star_four"></span>
                                        <span class="fa fa-star" id="product_modal_star_five"></span>
                                    </div>
                                    <div class="review">
                                        <a href="#/" id='product_modal_review_count'></a>
                                    </div>
                                </div>
                                <p class="product-desc" id='product_modal_description'></p>
                                <div class="quick-product-action">
                                    <div class="action-top">
                                        <div class="pro-qty" id="product_modal_add_cart_count">
                                            <input type="text" id="quantity" title="Quantity" value="01" />
                                        </div>
                                        <a class="btn btn-theme" id="product_modal_add_cart">Sepete Ekle</a>
                                        <a class="btn-wishlist" id="product_modal_show_detail">Ayrıntıyı Gör</a>
                                    </div>
                                </div>
                                <div class="widget">
                                    <h3 class="title">Share:</h3>
                                    <div class="widget-tags widget-share">
                                        <span class="fa fa-facebook"></span>
                                        <span class="fa fa-dribbble"></span>
                                        <span class="fa fa-pinterest-p"></span>
                                        <span class="fa fa-twitter"></span>
                                        <span class="fa fa-linkedin"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas-overlay"></div>
        </aside>
        <!--== End Product Quick View ==-->

        <!--== Start Aside Search Menu ==-->
        <div class="search-box-wrapper">
            <div class="search-box-content-inner">
                <div class="search-box-form-wrap">
                    <form action="{{ route('shop_list') }}">
                        <div class="search-form position-relative">
                            <label for="search-input" class="sr-only"> Ara</label>
                            <input type="search" class="form-control" placeholder="Ara..." name='search'
                                id="search-input">
                            <button class="search-button"><i class="pe-7s-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <!--== End Aside Search Menu ==-->
            <a href="javascript:;" class="search-close"><i class="pe-7s-close"></i></a>
        </div>
        <!--== End Aside Search Menu ==-->

        <!--== Start Side Menu ==-->
        <aside class="off-canvas-wrapper">
            <div class="off-canvas-inner">
                <div class="off-canvas-overlay d-none"></div>
                <!-- Start Off Canvas Content Wrapper -->
                <div class="off-canvas-content">
                    <!-- Off Canvas Header -->
                    <div class="off-canvas-header">
                        <div class="close-action">
                            <button class="btn-close"><i class="pe-7s-close"></i></button>
                        </div>
                    </div>

                    <div class="off-canvas-item">
                        <!-- Start Mobile Menu Wrapper -->
                        <div class="res-mobile-menu">
                            <!-- Note Content Auto Generate By Jquery From Main Menu -->
                        </div>
                        <!-- End Mobile Menu Wrapper -->
                    </div>
                    <!-- Off Canvas Footer -->
                    <div class="off-canvas-footer"></div>
                </div>
                <!-- End Off Canvas Content Wrapper -->
            </div>
        </aside>
        <!--== End Side Menu ==-->
    </div>

    <!--=======================Javascript============================-->

    <!--=== Modernizr Min Js ===-->
    <script src="{{ url('shop_files/assets/js/modernizr.js') }}"></script>
    <!--=== jQuery Min Js ===-->
    <script src="{{ url('shop_files/assets/js/jquery-main.js') }}"></script>
    <!--=== jQuery Migration Min Js ===-->
    <script src="{{ url('shop_files/assets/js/jquery-migrate.js') }}"></script>
    <!--=== Popper Min Js ===-->
    <script src="{{ url('shop_files/assets/js/popper.min.js') }}"></script>
    <!--=== Bootstrap Min Js ===-->
    <script src="{{ url('shop_files/assets/js/bootstrap.min.js') }}"></script>
    <!--=== jquery Appear Js ===-->
    <script src="{{ url('shop_files/assets/js/jquery.appear.js') }}"></script>
    <!--=== jquery Swiper Min Js ===-->
    <script src="{{ url('shop_files/assets/js/swiper.min.js') }}"></script>
    <!--=== jquery Fancybox Min Js ===-->
    <script src="{{ url('shop_files/assets/js/fancybox.min.js') }}"></script>
    <!--=== jquery Aos Min Js ===-->
    <script src="{{ url('shop_files/assets/js/aos.min.js') }}"></script>
    <!--=== jquery Slicknav Js ===-->
    <script src="{{ url('shop_files/assets/js/jquery.slicknav.js') }}"></script>
    <!--=== jquery Countdown Js ===-->
    <script src="{{ url('shop_files/assets/js/jquery.countdown.min.js') }}"></script>
    <!--=== jquery Tippy Js ===-->
    <script src="{{ url('shop_files/assets/js/tippy.all.min.js') }}"></script>
    <!--=== Isotope Min Js ===-->
    <script src="{{ url('shop_files/assets/js/isotope.pkgd.min.js') }}"></script>
    <!--=== Parallax Min Js ===-->
    <script src="{{ url('shop_files/assets/js/parallax.min.js') }}"></script>
    <!--=== Slick  Min Js ===-->
    <script src="{{ url('shop_files/assets/js/slick.min.js') }}"></script>
    <!--=== jquery Wow Min Js ===-->
    <script src="{{ url('shop_files/assets/js/wow.min.js') }}"></script>
    <!--=== jquery Zoom Min Js ===-->
    <script src="{{ url('shop_files/assets/js/jquery-zoom.min.js') }}"></script>

    <!--=== Custom Js ===-->
    <script src="{{ url('shop_files/assets/js/custom.js') }}"></script>

    <!-- alertifyjs js -->
    <script src="{{ url('admin/assets/libs/alertifyjs/build/alertify.min.js') }}"></script>

    <!--Uyarı Mesajları-->
    <script>
        @if (session('success'))
            alertify.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            alertify.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            alertify.warning("{{ session('warning') }}");
        @endif
    </script>

    <!--Kısa özet gösteren sayfa ayarlanıyor.-->
    <script>
        var quickViewModal = $(".product-quick-view-modal");

        function showDetail(code, name, image_path, description, price, priceType, reviewCount, score, is_in_cart) {
            document.getElementById('product_modal_img').src = image_path;
            document.getElementById('product_modal_name').innerText = name;
            document.getElementById('product_modal_price').innerText = price + ' ' + priceType;

            if (score < 1) document.getElementById('product_modal_star_one').style.color = 'gray';
            if (score < 2) document.getElementById('product_modal_star_two').style.color = 'gray';
            if (score < 3) document.getElementById('product_modal_star_three').style.color = 'gray';
            if (score < 4) document.getElementById('product_modal_star_four').style.color = 'gray';
            if (score < 5) document.getElementById('product_modal_star_five').style.color = 'gray';

            if (is_in_cart) {
                document.getElementById('product_modal_add_cart_count').hidden = true;
                document.getElementById('product_modal_add_cart').innerText = 'Sepetten Çıkar';
            } else {
                document.getElementById('product_modal_add_cart_count').hidden = false;
                document.getElementById('product_modal_add_cart').innerText = 'Sepete Ekle';
            }


            document.getElementById('product_modal_review_count').innerText = '(' + reviewCount + ' adet inceleme)';
            document.getElementById('product_modal_description').innerHTML = description;
            document.getElementById('product_modal_add_cart').href = "{{ route('shop_add_cart') }}?product_code=" + code;
            document.getElementById('product_modal_show_detail').href = "{{ route('shop_product_detail') }}/" + code;
            code;


            quickViewModal.addClass('active');
            $("body").addClass('fix');
        }

        $(".btn-close, .canvas-overlay").on('click', function() {
            quickViewModal.removeClass('active');
            $("body").removeClass('fix');
        });
    </script>

</body>

</html>
