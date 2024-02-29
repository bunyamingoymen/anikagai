<!DOCTYPE html>
<html lang="zxx">

<head>
    <!--Meta Etiketleri-->
    @foreach ($data['admin_meta'] as $item)
        {!! $item->value !!}
    @endforeach
    @foreach ($data['meta'] as $item)
        {!! $item->value !!}
    @endforeach
    <!--Başlık-->
    <title>{{ $data['index_title']->value }}</title>

    <!--CSS Dosyaları-->

    <style>
        :root {
            --background-color: #{{ $colors_code->nth(1)[0]->setting_value ?? 'fff' }};
            --menu-footer-color: #{{ $colors_code->nth(1)[1]->setting_value ?? 'fff' }};
            --second-color: #{{ $colors_code->nth(1)[2]->setting_value ?? 'fff' }};
        }
    </style>

    <link rel="shortcut icon" type="image/x-icon" href="{{ url($data['index_icon']->value) }}">
    <link rel="stylesheet" href="{{ url('index/css/censor.css') }}" type="text/css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Sweet Alert-->
    <link href="{{ url('admin/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href=" https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5.0.15/dark.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('user/animex/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('user/animex/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('user/animex/css/plyr.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('user/animex/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('user/animex/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('user/animex/css/style.css') }}" type="text/css">
    <script src="{{ url('user/animex/js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"
        integrity="sha512-ubuT8Z88WxezgSqf3RLuNi5lmjstiJcyezx34yIU2gAHonIi27Na7atqzUZCOoY4CExaoFumzOsFQ2Ch+I/HCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Sweet Alerts js -->
    <script src="{{ url('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!--Hata Mesajları-->
    <script>
        @if (session('error'))
            Swal.fire({
                title: "Hata",
                text: "{{ session('error') }}",
                color: "#fff",
                icon: "error"
            });
        @endif
        @if (session('success'))
            Swal.fire({
                title: "Başarılı",
                text: "{{ session('success') }}",
                color: "#fff",
                icon: "success"
            });
        @endif
    </script>

    <!-- +18 Komutları -->
    <script>
        function adultOkay() {
            Swal.fire({
                title: "Uyarı",
                text: "+18 İçerikleri Görmek İsityor Musunuz?",
                color: "#fff",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Onayla',
                cancelButtonText: `Vazgeç`,
            }).then((result) => {
                if (result.value) {
                    window.location.href = `{{ route('adultOn') }}`;
                }
            });
        }
    </script>

    <!-- Bildirim Ayarları-->
    <script>
        function clickNotifications(code, image, title, text, url, readed) {
            if (url) {
                if (readed == 1)
                    window.open(url, "_self");
                else
                    readNotification(code, 1, url)

            } else {
                Swal.fire({
                    title: title,
                    text: text,
                    color: "#fff",
                    iconHtml: `<img src="` + image + `" style="border-radius: 15%;">`,
                    customClass: {
                        icon: 'no-border'
                    }
                });

                if (readed == 0) {
                    readNotification(code, 0, url)
                }


            }


        }

        function readNotification(code, is_url, url) {
            $.ajax({
                type: 'GET',
                url: "{{ route('read_notification') }}",
                data: {
                    code: code,
                },
                success: function(response) {
                    if (response.result != 2) {
                        Swal.fire({
                            title: "Hata",
                            text: "Bildirim Okundu olarak işaretlenirken bir hata meydana geldi",
                            color: "#fff",
                            icon: `error`,
                        }).then((result) => {
                            if (is_url == 1) window.open(url, "_self");
                        });
                    } else {
                        if (is_url == 1) window.open(url, "_self");
                    }
                },
                error: function(error) {
                    if (is_url == 1) window.open(url, "_self");
                }
            });

            var notification_item_code = document.getElementById(
                'notification-item-code' + code);
            if (notification_item_code) {
                notification_item_code.classList.remove("notification-item-unread")
                notification_item_code.classList.add("notification-item-read")
            }

            var notification_item_code_main = document.getElementById(
                'notification-item-code-main' + code);

            if (notification_item_code_main) {
                notification_item_code_main.classList.remove("notification-item-unread")
                notification_item_code_main.classList.add("notification-item-read")
            }

            document.getElementById('unreadedCountOut').innerText = parseInt(
                document.getElementById('unreadedCountOut').innerText) - 1;

            document.getElementById('unreadedCountIn').innerText = parseInt(document
                .getElementById('unreadedCountIn').innerText) - 1;
        }

        function allReadNotifications() {
            $.ajax({
                type: 'GET',
                url: "{{ route('all_read_notification') }}",
                success: function(response) {},
                error: function(error) {}
            });

            var notification_item_unread = document.getElementsByClassName('notification-item');
            for (let index = 0; index < notification_item_unread.length; index++) {
                notification_item_unread[index].classList.add("notification-item-read");
                notification_item_unread[index].classList.remove("notification-item-unread");
                console.log('index: ' + index);
            }

            document.getElementById('unreadedCountOut').innerText = 0;

            document.getElementById('unreadedCountIn').innerText = 0;
        }
    </script>

</head>

<body>


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
            <form action="{{ route('search') }}" method="GET" class="search-model-form">
                <input type="text" name="query" id="query" placeholder="Ara.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

    <div id="hiddenDiv" hidden>

    </div>


</body>


<!--Font Awesome js-->
<script src="https://kit.fontawesome.com/b49f043adc.js" crossorigin="anonymous"></script>

<!-- Js Plugins -->

<script src="{{ url('user/animex/js/bootstrap.min.js') }}"></script>
<script src="{{ url('user/animex/js/player.js') }}"></script>
<script src="{{ url('user/animex/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ url('user/animex/js/mixitup.min.js') }}"></script>
<script src="{{ url('user/animex/js/jquery.slicknav.js') }}"></script>
<script src="{{ url('user/animex/js/owl.carousel.min.js') }}"></script>

<script src="{{ url('user/animex/js/main.js') }}"></script>

</html>
