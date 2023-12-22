<style>
    .custom-menu-container {
        display: none !important;
        position: fixed;
        top: 120px;
        left: -250px;
        /* Menüyü sayfanın solundan dışarıda başlat */
        width: 250px;
        height: 100%;
        background-color: var(--three-color);
        padding-top: 20px;
        transition: left 0.3s ease;
        /* Animasyonlu geçiş ekleyin */
        z-index: 1000;
        /* Menüyü diğer öğelerin üzerine getirin */
        overflow-y: auto;
        max-height: calc(100vh - 20px);
        /* Dikey kaydırma ekleyin */
    }

    /* Diğer stillemeleri ekleyin */

    .main-content {
        margin-left: 250px;
        /* Menü açıkken içerik kaymasını önleyin */
        transition: margin-left 0.3s ease;
        /* Animasyonlu geçiş ekleyin */
    }

    /* İsteğe bağlı olarak menü kapalıyken görünmeyecek öğeleri gizleyebilirsiniz */
    .custom-menu-container.closed {
        left: -250px !important;
    }

    .custom-menu-container.opened {
        left: 0px !important;
    }

    .main-content.closed {
        margin-left: 0;
    }

    @media only screen and (max-width:992px) {
        .custom-menu-container {
            display: block !important;
        }
    }
</style>

<header id="header">
    <button class="mobile-menu-trigger"><span>&nbsp;</span></button>
    <div class="custom-menu-container closed">
        <a href="">Link</a>
        <a href="">Link</a>
    </div>

    <div id="logo">

        <a href="{{ route('index') }}"
            style="background: url(../../../{{ $data['index_logo']->value }}) center no-repeat; display: block; width: 100%; height: 75px; background-size: 160px 32px;"></a>

    </div>
    <div id="header-middle">
        <div id="search">
            <div>
                <span class="deleteicon"></span>
                <form action="{{ route('search') }}" method="GET">
                    <label for="tvSearch">
                        <input type="search" name="query" class="form-control deletable" autocomplete="off"
                            id="tvSearch" placeholder="Ara...">
                    </label>
                    <button type="button" aria-label="Ara">
                        <svg class="mofycon">
                            <i class="fa fa-search"></i>
                        </svg>
                    </button>
                </form>
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
