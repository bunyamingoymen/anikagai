<header class="header-wrapper">
    <div class="header-area header-default sticky-header sticky">
        <div class="container">
            <div class="row row-gutter-0 align-items-center">
                <div class="col-4 col-sm-6 col-lg-2">
                    <div class="header-logo-area">
                        <a href="{{ route('shop_index') }}">
                            <img class="logo-main" src="{{ url('shop_files/assets/img/logo.png') }}" alt="Logo" />
                            <img class="logo-light" src="{{ url('shop_files/assets/img/logo.png') }}" alt="Logo" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 sticky-md-none">
                    <div class="header-navigation-area d-none d-md-block">
                        <ul class="main-menu nav position-relative">
                            <li class="active"><a href="{{ route('shop_index') }}">Anasayfa</a></li>
                            @if (isset($categories) && count($categories) > 0)
                                <li class="has-submenu"><a href="{{ route('shop_list') }}">Tüm Ürünler</a>
                                    <ul class="submenu-nav">
                                        @foreach ($categories as $category)
                                            <li><a
                                                    href="{{ route('shop_list', [$category->url]) }}">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif

                            <li><a href="about.html">Hakkımızda</a></li>
                            <li><a href="about.html">İletişim</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-8 col-sm-6 col-lg-2">
                    <div class="header-action-area">
                        <div class="header-action-search">
                            <button class="btn-search btn-search-menu">
                                <i class="pe-7s-search"></i>
                            </button>
                        </div>
                        @if (Auth::guard('shop_users')->user())
                            <div class="header-action-search">
                                <button class="btn-search"
                                    onclick="window.location.href='{{ route('shop_whislist') }}'">
                                    <i class="pe-7s-like"></i>
                                </button>
                            </div>


                            <div class="header-action-search">
                                <a class="btn-search" href="{{ route('shop_login') }}">
                                    <i class="pe-7s-users"></i>
                                </a>
                            </div>

                            <div class="header-action-search">
                                <a class="btn-search" href="{{ route('shop_user_logout') }}">
                                    <i class="pe-7s-power"></i>
                                </a>
                            </div>
                        @elseif (Auth::guard('shop_sellers')->user())
                            <div class="header-action-search">
                                <a class="btn-search" href="{{ route('shop_login') }}">
                                    <i class="pe-7s-users"></i>
                                </a>
                            </div>
                            <div class="header-action-search">
                                <a class="btn-search" href="{{ route('shop_seller_logout') }}">
                                    <i class="pe-7s-power"></i>
                                </a>
                            </div>
                        @else
                            <div class="header-action-search">
                                <a class="btn-search" href="{{ route('shop_login') }}">
                                    <i class="pe-7s-users"></i>
                                </a>
                            </div>
                        @endif
                        @if (Auth::guard('shop_users')->user())
                            <div class="header-action-cart">
                                <a class="btn-cart cart-icon" href="{{ route('shop_cart') }}">
                                    <span class="cart-count">{{ $cartTotalCount }}</span>
                                    <i class="pe-7s-shopbag"></i>
                                </a>
                            </div>
                        @endif

                        <button class="btn-menu d-lg-none">
                            <i class="ion-navicon"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
