<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="{{route('index')}}">
                        <img src="../../../{{$logo->value}}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            @foreach ($menus as $item)
                            @if (isset($active_menu) && $active_menu->code == $item->code)
                            <li class="active"><a href="{{$item->optional_2?? ''}}">{{$item->value}}</a></li>
                            @else
                            <li><a href="{{$item->optional_2?? ''}}">{{$item->value}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="header__right">
                    <a href="#" class="search-switch"><span class="icon_search"></span></a>
                    <a href="./login.html"><span class="icon_profile"></span></a>
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
<!-- Header End -->