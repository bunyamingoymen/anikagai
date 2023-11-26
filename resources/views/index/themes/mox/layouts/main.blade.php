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
    <link rel="stylesheet" href="../../../user/mox/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../user/mox/css/animate.min.css">
    <link rel="stylesheet" href="../../../user/mox/css/magnific-popup.css">
    <link rel="stylesheet" href="../../../user/mox/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../../../user/mox/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../../user/mox/css/flaticon.css">
    <link rel="stylesheet" href="../../../user/mox/css/odometer.css">
    <link rel="stylesheet" href="../../../user/mox/css/aos.css">
    <link rel="stylesheet" href="../../../user/mox/css/slick.css">
    <link rel="stylesheet" href="../../../user/mox/css/default.css">
    <link rel="stylesheet" href="../../../user/mox/css/style.css">
    <link rel="stylesheet" href="../../../user/mox/css/responsive.css">
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
    <script src="../../../user/mox/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="../../../user/mox/js/popper.min.js"></script>
    <script src="../../../user/mox/js/bootstrap.min.js"></script>
    <script src="../../../user/mox/js/isotope.pkgd.min.js"></script>
    <script src="../../../user/mox/js/imagesloaded.pkgd.min.js"></script>
    <script src="../../../user/mox/js/jquery.magnific-popup.min.js"></script>
    <script src="../../../user/mox/js/owl.carousel.min.js"></script>
    <script src="../../../user/mox/js/jquery.odometer.min.js"></script>
    <script src="../../../user/mox/js/jquery.appear.js"></script>
    <script src="../../../user/mox/js/slick.min.js"></script>
    <script src="../../../user/mox/js/ajax-form.js"></script>
    <script src="../../../user/mox/js/wow.min.js"></script>
    <script src="../../../user/mox/js/aos.js"></script>
    <script src="../../../user/mox/js/plugins.js"></script>
    <script src="../../../user/mox/js/main.js"></script>
    <!-- Sweet Alerts js -->
    <script src="../../../admin/assets/libs/sweetalert2/sweetalert2.min.js"></script>
</body>


</html>
