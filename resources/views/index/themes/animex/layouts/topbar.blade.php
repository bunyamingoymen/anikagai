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
                        <a href="#" class="notification-container">
                            <i class="fa-solid fa-bell"></i>
                            <span class="badge badge-danger badge-pill">3</span>
                        </a>
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
