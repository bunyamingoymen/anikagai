<!-- Header Section Begin -->
<style>
    .notification-container {
        position: relative;
    }

    .notification-container i {
        top: 0;
        right: 0;
    }

    .notification-container span {
        position: absolute;
        top: -5px;
        right: -8px;
        font-size: 8px;
    }

    .notification-item {
        width: 100%;

        transition: opacity 0.3s ease;
        border-radius: 3px 3px 3px 3px;
    }

    .notification-item-read {
        background-color: var(--background-color);
    }

    .notification-item-unread {
        background-color: #0b0c2a;
    }

    .notification-item:hover {
        opacity: 0.6;
    }

    .notification-item h6,
    .notification-item p,
    .notification-top h6 {
        color: #fff;
    }

    .notification-items {
        border-radius: 20px 20px 10px 10px;
    }

    .notification-more a {
        font-size: 13px;
        text-decoration: none;
    }

    .notification-more a:hover {
        color: var(--second-color);
        text-decoration: none;
    }

    .notification-all-read {
        text-align-last: center;
    }

    .notification-all-read a {
        font-size: 13px;
        text-decoration: none;
        text-align-last: center;
    }
</style>

<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-1">
                <div class="header__logo">
                    <a href="{{ route('index') }}">
                        <img src="{{ url($data['index_logo']->value) }}" alt=""
                            style="max-width: 93px; max-height: 23px;">
                    </a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            @foreach ($menus as $item)
                                @if (isset($active_menu) && $active_menu->code == $item->code)
                                    <li class="active"><a
                                            href="{{ $item->optional_2 ? url($item->optional_2) : url('#') }}">{{ $item->value }}</a>
                                    </li>
                                @else
                                    <li><a href="{{ url($item->optional_2 ?? '') }}">{{ $item->value }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    <a href="javascript:;" class="search-switch"><span class="icon_search"></span></a>

                    @if (!Auth::user())
                        <a href="{{ route('loginScreen') }}"><span class="icon_profile"></span></a>
                    @else
                        <div class="dropdown d-inline-block notifications">
                            <a href="#" class="dropdown notification-container " data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-bell"></i>
                                <span class="badge badge-danger badge-pill"
                                    id="unreadedCountOut">{{ $notificaton_count }}
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 notification-items"
                                style="width: 300px; background-color:var(--menu-footer-color)"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center notification-top">
                                        <div class="col">
                                            <h6 class="m-0 font-weight-medium text-uppercase"> Bildirimler </h6>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge badge-pill badge-danger">Okunmamış<span
                                                    id="unreadedCountIn">
                                                    {{ $notificaton_count }}</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-1 border-bottom notification-all-read">
                                    <a class="col-lg-10 btn btn-success btn-block text-center" href="javascript:void(0)"
                                        onclick="allReadNotifications()">
                                        Hepsini okundu olarak işaretle
                                    </a>
                                </div>
                                <div data-simplebar style="">
                                    @foreach ($notificatons as $notificaton)
                                        <a href="Javascript:;" id="notification-item-code{{ $notificaton->code }}"
                                            onclick="clickNotifications({{ $notificaton->code }}, '{{ $notificaton->notification_image }}', '{{ $notificaton->notification_title }}', '{{ $notificaton->notification_text }}', '{{ $notificaton->notification_url }}')"
                                            class="text-reset notification-item {{ $notificaton->readed == 1 ? 'notification-item-read' : 'notification-item-unread' }}">
                                            <div class="media">
                                                <div class="avatar-xs m-3">
                                                    <img src="{{ url($notificaton->notification_image) }}"
                                                        alt="profile_pic" style="width: 35px; border-radius: 15%;">
                                                </div>
                                                <div class="media-body m-3">
                                                    <div class="row">
                                                        <div>
                                                            <h6 class="mt-0 mb-1">
                                                                {{ $notificaton->notification_title }}</h6>
                                                            <div class="font-size-12 text-muted">
                                                                <p class="mb-1">
                                                                    {{ $notificaton->notification_text }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach

                                </div>
                                <div class="p-1 border-top notification-more">
                                    <a class="btn-link btn btn-block text-center" href="javascript:void(0)">
                                        Bütün bildirimleri gör..
                                    </a>
                                </div>
                            </div>
                        </div>


                        <a href="{{ route('profile') }}"><span class="icon_profile"></span></a>
                        <a href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                    @endif
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
<!-- Header End -->
