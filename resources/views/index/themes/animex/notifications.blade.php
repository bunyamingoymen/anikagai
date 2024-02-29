@extends('index.themes.animex.layouts.main')
@section('index_content')
    <style>
        .product__item img {
            margin-top: 25px;
            height: 50px;
            border-radius: 15px;
        }

        .notification-item-unread {
            background-color: #0b0c2a;
        }

        .notification-item-read {
            background-color: var(--background-color);
        }

        .product__item {
            text-align: center;

            margin: 0px;
            padding: 0px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid #414a4c;
            border-radius: 10px;
            margin-top: 10px;
            padding: 10px;
            margin-left: 5%;
            width: 85%;
            text-align: justify;
            transition: opacity 0.3s ease;
        }

        .product__item:hover {
            opacity: 0.6;
        }

        .product__item p,
        .product__item h5,
        .product__item h4 {
            color: #fff;
        }
    </style>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('index') }}"><i class="fa fa-home"></i> Anasayfa</a>
                        <span>Bildirimler</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <section class="product-page spad">
        <div class="container">
            <div class="col-lg-12 mt-5">
                <div class="product__page__content">
                    @foreach ($notificatonsAll as $notificaton)
                        <a href="Javascript:void(0);"
                            onclick="clickNotifications({{ $notificaton->code }}, '{{ $notificaton->notification_image }}', '{{ $notificaton->notification_title }}', '{{ $notificaton->notification_text }}', '{{ $notificaton->notification_url }}', {{ $notificaton->readed }})">
                            <div id="notification-item-code-main{{ $notificaton->code }}"
                                class="product__item row
                        {{ $notificaton->readed == 1 ? 'notification-item-read' : 'notification-item-unread' }}">
                                <div class="">
                                    <div class="divimg">
                                        <img src="{{ url($notificaton->notification_image) }}" alt=""
                                            style="">
                                    </div>
                                </div>
                                <div class="col-lg-10 ml-4 mr-4">
                                    <h4 class="lg_font_size mb-3">
                                        {{ $notificaton->notification_title }}
                                    </h4>
                                    <p>{{ $notificaton->notification_text }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
