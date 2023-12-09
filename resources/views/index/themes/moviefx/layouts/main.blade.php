<!DOCTYPE HTML>
<html xmlns:og="http://ogp.me/ns#" lang="tr-TR">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <base>
    @foreach ($data['admin_meta'] as $item)
    <meta http-equiv="{{$item->optional_2 ?? ''}}" name="{{$item->value}}" content="{{$item->optional ?? ''}}">
    @endforeach

    @foreach ($data['meta'] as $item)
    <meta http-equiv="{{$item->optional_2 ?? ''}}" name="{{$item->value}}" content="{{$item->optional ?? ''}}">
    @endforeach

    <meta name="theme-color" content="#FDFD96" />

    <title>{{$data['index_title']->value}}</title>

    <meta property="og:title" content="{{$data['index_title']->value}} ">
    <meta property="og:site_name" content="{{$data['index_title']->value}}">
    <meta property="og:url" content="{{route('index')}}">
    <meta property="og:image" content="../../../{{$data['index_icon']->value}}">

    <!-- İmages -->
    <link rel="icon" href="../../../{{$data['index_icon']->value}}" type="image/x-icon">

    <script src="../../../user/moviefx/assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../../user/moviefx/assets/js/jquery-ui.min.js"></script>
    <script src="../../../user/moviefx/assets/js/semantic.min.js"></script>
    <script src="../../../user/moviefx/assets/js/navigo.min.js"></script>
    <script src="../../../user/moviefx/assets/js/jquery.scrollbar.min.js?v=1"></script>
    <script src="../../../user/moviefx/assets/js/lazyload.min.js"></script>
    <script src="../../../user/moviefx/assets/js/sweetalert2.min.js"></script>
    <script src="../../../user/moviefx/assets/js/humane.min.js?v=2"></script>
    <!--<script src="assets/js/msfx.min.js"></script>-->
    <script src="../../../user/moviefx/assets/js/main.min.js"></script>

    <link rel="stylesheet" href="../../../index/css/censor.css" type="text/css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Dosyaları -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <link rel="preload" href="../../../user/moviefx/assets/css/main.css" as="style">
    <link defer rel="stylesheet" href="../../../user/moviefx/assets/css/swiper.css">
    <link defer rel="stylesheet" href="../../../user/moviefx/assets/css/main.css">
    <link defer rel="stylesheet" href="../../../user/moviefx/assets/css/msfx.min.css">
    <link defer rel="stylesheet" href="../../../user/moviefx/assets/css/msfx-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"
        integrity="sha512-gOQQLjHRpD3/SEOtalVq50iDn4opLVup2TF8c4QPI3/NmUPNZOk2FG0ihi8oCU/qYEsw4P6nuEZT2lAG0UNYaw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="
    https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5.0.15/dark.min.css
    " rel="stylesheet">

</head>

<body class="fluid">
    <div data-gets data-type="pgskin"></div>
    <main id="wrapper">,
        <!-- Header -->
        @include('index.themes.moviefx.layouts.topbar')

        <!-- Main -->
        <div id="wrapper-inner">
            <div class="triggered-overlay"></div>
            <!-- Menü -->
            @include('index.themes.moviefx.layouts.sidebar')

            <div id="content">
                <div class="inner-content container" id="page-index">
                    <div id="router-view">
                        @yield('index_content')
                    </div>
                </div>
            </div>
        </div>
        <!--Footer-->
        @include('index.themes.moviefx.layouts.footer')

        </div>
    </main>

</body>

<!-- Mirrored from yabancidizi.pro/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Nov 2023 13:57:28 GMT -->

</html>