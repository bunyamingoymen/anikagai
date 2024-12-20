<!doctype html>
<html class="no-js" lang="">

<style>
    :root {
        --one-color: #{{ $colors_code->nth(1)[0]->setting_value ?? 'fff' }};
        --two-color: #{{ $colors_code->nth(1)[1]->setting_value ?? 'fff' }};
        --three-color: #{{ $colors_code->nth(1)[2]->setting_value ?? 'fff' }};
        --four-color: #{{ $colors_code->nth(1)[3]->setting_value ?? 'fff' }};
        --five-color: #{{ $colors_code->nth(1)[4]->setting_value ?? 'fff' }};
    }
</style>

<head>
    <!-- Meta EtiketleriW-->
    <meta charset="utf-8">
    @foreach ($data['admin_meta'] as $item)
        <meta http-equiv="{{ $item->optional_2 ?? '' }}" name="{{ $item->value }}" content="{{ $item->optional ?? '' }}">
    @endforeach
    @foreach ($data['meta'] as $item)
        <meta http-equiv="{{ $item->optional_2 ?? '' }}" name="{{ $item->value }}" content="{{ $item->optional ?? '' }}">
    @endforeach

    <!-- Başlık -->
    <title>{{ $data['index_title']->value }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ url($data['index_icon']->value) }}">

    <!-- CSS Dosyaları -->
    <link rel="stylesheet" href="{{ url('user/mox/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/aos.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/slick.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/default.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('user/mox/css/responsive.css') }}">

    <!--plyr-->
    <link rel="stylesheet" href="{{ url('user/animex/css/plyr.css') }}" type="text/css">

    <style>
        .set-bg {
            background-size: cover;
            background-position: top center;
        }
    </style>


</head>

<body>

    @include('index.themes.mox.layouts.preloader')

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

    <!-- JS Dosyaları -->
    <script src="{{ url('user/mox/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('user/mox/js/popper.min.js') }}"></script>
    <script src="{{ url('user/mox/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('user/mox/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ url('user/mox/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ url('user/mox/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('user/mox/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('user/mox/js/jquery.odometer.min.js') }}"></script>
    <script src="{{ url('user/mox/js/jquery.appear.js') }}"></script>
    <script src="{{ url('user/mox/js/slick.min.js') }}"></script>
    <script src="{{ url('user/mox/js/ajax-form.js') }}"></script>
    <script src="{{ url('user/mox/js/wow.min.js') }}"></script>
    <script src="{{ url('user/mox/js/aos.js') }}"></script>
    <script src="{{ url('user/mox/js/plugins.js') }}"></script>
    <script src="{{ url('user/mox/js/main.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ url('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!--plyr-->
    <script src="{{ url('user/animex/js/player.js') }}"></script>

    <script>
        function controlCharacterUsername(name) {
            var alphabet = [
                'q', 'w', 'e', 'r', 't', 'y', 'u', 'ı', 'o', 'p', 'ğ', 'ü',
                'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'ş', 'i',
                'z', 'x', 'c', 'v', 'b', 'n', 'm', 'ö', 'ç'
            ];

            var is_control = false;

            for (var i = 0; i < name.length; i++) {
                var character = name[i].toLowerCase();
                if (alphabet.includes(character)) {
                    is_control = true;
                } else {
                    is_control = false;
                    break;
                }
            }

            return is_control;
        }
    </script>
</body>


</html>
