<header id="header">
    <button class="mobile-menu-trigger"><span>&nbsp;</span></button>
    <div id="logo">

        <a href="{{ route('index') }}"
            style="background: url(../../../{{ $data['index_logo']->value }}) center no-repeat; display: block; width: 100%; height: 75px; background-size: 160px 32px;"></a>

    </div>
    <div id="header-middle">
        <div id="search">
            <div>
                <span class="deleteicon"></span>
                <label for="tvSearch">
                    <input type="search" name="search" class="form-control deletable" autocomplete="off" id="tvSearch"
                        placeholder="Dizi ve film ara...">
                </label>
                <button type="button" aria-label="Dizi veya film ara">
                    <svg class="mofycon">
                        <i class="fa fa-search"></i>
                    </svg>
                </button>
            </div>
            <div id="search-results" style="display: none;">
                <div class="section-heading">En İyi Sonuçlar</div>
                <div id="search-response"></div>
            </div>
        </div>
        <div id="user">
            <div class="left floated author">
                @if (Auth::user())
                    <a class="ui button secondary" href="{{ route('profile') }}">{{ Auth::user()->username }}</a>
                    <a class="ui button danger desktop-only" href="{{ route('logout') }}">Çıkış Yap</a>
                @else
                    <a class="ui button secondary" onclick="login()">Giriş Yap</a>
                    <a class="ui button secondary desktop-only" onclick="register()">Kayıt Ol</a>
                @endif

            </div>
        </div>
    </div>
</header>
