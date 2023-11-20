<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menü</li>

                <li>
                    <a href="{{route('admin_index')}}">
                        <i class="fas fa-home"></i>
                        <span>Anasayfa</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-play-circle"></i>
                        <span>Anime</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin_anime_list')}}">Animeler</a></li>
                        <li><a href="{{route('admin_anime_episodes_list')}}">Bölümler</a></li>
                        <li><a href="{{route('admin_animecalendar_index')}}">Takvim</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-book"></i>
                        <span>Webtoon</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin_webtoon_list')}}">Webtoon'lar</a></li>
                        <li><a href="{{route('admin_webtoon_episodes_list')}}">Bölümler</a></li>
                        <li><a href="{{route('admin_webtooncalendar_index')}}">Takvim</a></li>
                    </ul>
                </li>

                <li class="menu-title">Yönetim</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-address-card"></i>
                        <span>Kullanıcılar</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin_user_list')}}">Kullanıcılar</a></li>
                        <li><a href="{{route('admin_authgroup_list')}}">Kullanıcı Grupları</a></li>
                        <li><a href="{{route('admin_auth_list')}}">Grup Yetkileri</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-database"></i>
                        <span>Site Verileri</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Anasayfa Ayarları</a></li>
                        <li><a href="#">Logolar</a></li>
                        <li><a href="#">Meta Etiketleri</a></li>
                        <li><a href="#">Başlıklar</a></li>
                        <li><a href="#">Menüler</a></li>
                        <li><a href="{{route('admin_keyvalue_list')}}">Key Value</a></li>
                        <li><a href="{{route('admin_authclause_list')}}">Yetki Maddeleri</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>