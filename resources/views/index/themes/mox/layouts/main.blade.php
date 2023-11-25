<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    @foreach ($admin_meta as $item)
    <meta http-equiv="{{$item->optional_2 ?? ''}}" name="{{$item->value}}" content="{{$item->optional ?? ''}}">
    @endforeach

    @foreach ($meta as $item)
    <meta http-equiv="{{$item->optional_2 ?? ''}}" name="{{$item->value}}" content="{{$item->optional ?? ''}}">
    @endforeach

    <title>{{$index_title->value}}</title>

    <link rel="shortcut icon" type="image/x-icon" href="../../../{{$index_icon->value}}">

    <!-- CSS here -->
    <link rel="stylesheet" href="../../../user/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../user/css/animate.min.css">
    <link rel="stylesheet" href="../../../user/css/magnific-popup.css">
    <link rel="stylesheet" href="../../../user/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../../../user/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../../user/css/flaticon.css">
    <link rel="stylesheet" href="../../../user/css/odometer.css">
    <link rel="stylesheet" href="../../../user/css/aos.css">
    <link rel="stylesheet" href="../../../user/css/slick.css">
    <link rel="stylesheet" href="../../../user/css/default.css">
    <link rel="stylesheet" href="../../../user/css/style.css">
    <link rel="stylesheet" href="../../../user/css/responsive.css">
</head>

<body>

    @include("index.themes.mox.layouts.preloader")

    <!-- Scroll-top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    @include('index.themes.mox.layouts.topbar')
    <!-- header-area-end -->


    <!-- main-area -->
    @yield('index_content')
    <!-- main-area-end -->


    <!-- footer-area -->
    @include('index.themes.mox.layouts.footer')
    <!-- footer-area-end -->


    <!-- JS here -->
    <script src="../../../user/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="../../../user/js/popper.min.js"></script>
    <script src="../../../user/js/bootstrap.min.js"></script>
    <script src="../../../user/js/isotope.pkgd.min.js"></script>
    <script src="../../../user/js/imagesloaded.pkgd.min.js"></script>
    <script src="../../../user/js/jquery.magnific-popup.min.js"></script>
    <script src="../../../user/js/owl.carousel.min.js"></script>
    <script src="../../../user/js/jquery.odometer.min.js"></script>
    <script src="../../../user/js/jquery.appear.js"></script>
    <script src="../../../user/js/slick.min.js"></script>
    <script src="../../../user/js/ajax-form.js"></script>
    <script src="../../../user/js/wow.min.js"></script>
    <script src="../../../user/js/aos.js"></script>
    <script src="../../../user/js/plugins.js"></script>
    <script src="../../../user/js/main.js"></script>
</body>


</html>