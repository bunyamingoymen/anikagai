<header class="header-style-two">
    <div class="header-top-wrap">
        <div class="container custom-container">
            <div class="row align-items-center">
                <div class="col-md-6 d-none d-md-block">
                </div>
                <div class="col-md-6">
                    <div class="header-top-link">
                        <ul class="quick-link">
                            @foreach ($menu_alts as $item)
                            <li><a href="{{$item->optional_2 ? url($item->optional_2) : url("#")}}">{{$item->value}}</a></li>
                            @endforeach
                            @if (!Auth::user())
                            <li><a href="{{route('loginScreen')}}">Giriş Yap</a></li>
                            @else
                            <li>
                                <a href="{{route('profile')}}">{{Auth::user()->username}}</a>
                            </li>
                            <li><a href="{{route('logout')}}">Çıkış Yap</a></li>
                            @endif
                        </ul>
                        <ul class="header-social">
                            @foreach ($social_media as $item)
                            <li><a href="{{$item->optional ?? ''}}"><i class="fab fa-{{$item->value}}"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="sticky-header" class="menu-area">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                    <div class="menu-wrap">
                        <nav class="menu-nav show">
                            <div class="logo">
                                <a href="{{route('index')}}">
                                    <img src="../../../{{$logo->value}}" alt="Logo" style="max-width: 155px;">
                                </a>
                            </div>
                            <div class="navbar-wrap main-menu d-none d-lg-flex">
                                <ul class="navigation">
                                    @foreach ($menus as $item)
                                    @if (isset($active_menu) && $active_menu->code == $item->code)
                                    <li><a class="active" href="{{$item->optional_2 ? url($item->optional_2) : url("#")}}">{{$item->value}}</a></li>
                                    @else
                                    <li><a href="{{$item->optional_2 ? url($item->optional_2) : url("#")}}">{{$item->value}}</a></li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="header-action d-none d-md-block">
                                <ul>
                                    <li class="d-none d-xl-block">
                                        <div class="footer-search">
                                            <form action="{{route('search')}}" method="GET">
                                                <input type="text" name="query" id="query" placeholder="Arama Yap">
                                                <button><i class="fas fa-search"></i></button>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>

                    <!-- Mobile Menu  -->
                    <div class="mobile-menu">
                        <div class="close-btn"><i class="fas fa-times"></i></div>

                        <nav class="menu-box">
                            <div class="nav-logo"><a href="{{route('index')}}"><img
                                        src="../../../user/mox/img/logo/logo.png" alt="" title=""></a>
                            </div>
                            <div class="menu-outer">
                                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                            </div>
                            <div class="social-links">
                                <ul class="clearfix">
                                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                    <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                                    <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                    <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="menu-backdrop"></div>
                    <!-- End Mobile Menu -->

                </div>
            </div>
        </div>
    </div>
</header>