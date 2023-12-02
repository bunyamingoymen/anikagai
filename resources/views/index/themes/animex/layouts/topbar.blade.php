<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="{{route('index')}}">
                        <img src="../../../{{$data['index_logo']->value}}" alt=""
                            style="max-width: 93px; max-height: 23px;">
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            @foreach ($menus as $item)
                            @if (isset($active_menu) && $active_menu->code == $item->code)
                            <li class="active"><a href="{{$item->optional_2 ? url($item->optional_2) : url("#")}}">{{$item->value}}</a></li>
                            @else
                            <li><a href="{{url($item->optional_2 ?? '')}}">{{$item->value}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="header__right">
                    <a href="#" class="search-switch"><span class="icon_search"></span></a>

                    @if (!Auth::user())
                    <a href="{{route('loginScreen')}}"><span class="icon_profile"></span></a>
                    @else
                    <a href="{{route('profile')}}"><span class="icon_profile"></span></a>
                    <a href="{{route('logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                    @endif
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
<!-- Header End -->