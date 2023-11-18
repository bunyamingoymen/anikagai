<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Anikagai - Webtoon Ve Anime</title>

    <meta name="description" content="Webtoon okuyabilir ve Anime izleyebilirsiniz">
    <meta name="author" content="Bünyamin Göymen">
    <meta name="author2" content="bgoymen">
    <META name="Copyright" content="Bu sitenin hakları Bünyamin Göymen ve Anikagai'ye aittir">

    <meta http-equiv="language" content="tr"> <!-- Türkçe -->

    <link rel="shortcut icon" type="image/x-icon" href="../../../user/img/favicon.png">

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

    @include("index.layouts.preloader")

    <!-- Scroll-top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    @include('index.layouts.topbar')
    <!-- header-area-end -->


    <!-- main-area -->
    @yield('index_content')
    <!-- main-area-end -->


    <!-- footer-area -->
    @include('index.layouts.footer')
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