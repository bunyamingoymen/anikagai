<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @foreach ($admin_meta as $item)
    <meta http-equiv="{{$item->optional_2 ?? ''}}" name="{{$item->value}}" content="{{$item->optional ?? ''}}">
    @endforeach

    @foreach ($meta as $item)
    <meta http-equiv="{{$item->optional_2 ?? ''}}" name="{{$item->value}}" content="{{$item->optional ?? ''}}">
    @endforeach
    <title>{{$index_title->value}}</title>

    <link rel="shortcut icon" type="image/x-icon" href="../../../{{$index_icon->value}}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../../../user/animex/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../../../user/animex/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../../../user/animex/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../../../user/animex/css/plyr.css" type="text/css">
    <link rel="stylesheet" href="../../../user/animex/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../../../user/animex/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../../../user/animex/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../../../user/animex/css/style.css" type="text/css">

    <!-- Plyr CSS -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />

    <!-- Plyr JS -->
    <script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>
</head>

<body>
    @include('index.themes.animex.layouts.preloader')

    @include('index.themes.animex.layouts.topbar')

    <!-- Product Section Begin -->
    @yield('index_content')

    <!-- Product Section End -->

    <!-- Footer Section Begin -->
    @include('index.themes.animex.layouts.footer')
    <!-- Footer Section End -->

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form action="{{route('search')}}" method="GET" class="search-model-form">
                <input type="text" name="query" id="query" placeholder="Ara.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

    <!-- Js Plugins -->
    <script src="../../../user/animex/js/jquery-3.3.1.min.js"></script>
    <script src="../../../user/animex/js/bootstrap.min.js"></script>
    <script src="../../../user/animex/js/player.js"></script>
    <script src="../../../user/animex/js/jquery.nice-select.min.js"></script>
    <script src="../../../user/animex/js/mixitup.min.js"></script>
    <script src="../../../user/animex/js/jquery.slicknav.js"></script>
    <script src="../../../user/animex/js/owl.carousel.min.js"></script>
    <script src="../../../user/animex/js/main.js"></script>


</body>

</html>