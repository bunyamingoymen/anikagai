<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menü</li>

                <li>
                    <a href="{{ route('admin_index') }}">
                        <i class="fas fa-home"></i>
                        <span>Anasayfa</span>
                    </a>
                </li>

                <li id="sidebarAnimeSection" hidden>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-play-circle"></i>
                        <span>Anime</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li id="sidebarAnime"></li>
                        <li id="sidebarAnimeEpisode"></li>
                        <li id="sidebarAnimeCalendar"></li>
                    </ul>
                </li>

                <li id="sidebarWebtoonSection" hidden>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-book"></i>
                        <span>Webtoon</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li id="sidebarWebtoon"></li>
                        <li id="sidebarWebtoonEpisode"></li>
                        <li id="sidebarWebtoonCalendar"> </li>
                    </ul>
                </li>

                <li id="sidebarNotificationSection" hidden>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-bell"></i>
                        <span>Bildirimler</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li id="sidebarAddNotification"></li>
                        <li id="sidebarNotifications"></li>
                    </ul>
                </li>

                <li id="sidebarOtherSection" hidden>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-cogs"></i>
                        <span>Diğer Veriler</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li id="sidebarPage"></li>
                        <li id="sidebarCategory"></li>
                        <li id="sidebarTag"></li>
                    </ul>
                </li>

                <li id="sidebarShopAllSection" class="menu-title" hidden>Mağaza {!!$storeActive ? '<span class="badge badge-success float-right">Açık</span>' : '<span class="badge badge-danger float-right">Kapalı</span>'!!}</li>

                <li id="sidebarShopProductsSection"></li>

                <li id="sidebarShopOrderSection"></li>

                <li id="sidebarShopDataSection" hidden>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="far fa-file-alt"></i>
                        <span>Veriler</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li id="sidebarShopDataCateogorySection"></li>
                        <li id="sidebarShopDataFeatureSection"></li>
                        <li id="sidebarShopDataCargoCompaniesSection"></li>
                    </ul>
                </li>

                <li id="sidebarShopUserAllSection" hidden>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-users"></i>
                        <span>Kullanıcılar</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li id="sidebarShopUserUsersSection"></li>
                        <li id="sidebarShopUserSellerSection"></li>
                        <li id="sidebarShopUserSellerSection"></li>
                    </ul>
                </li>

                <li id="sidebarShopSettingsSection"></li>

                <li id="userDataSection" class="menu-title" hidden>Kullanıcı Verileri</li>

                <li id="sidebarContact"></li>

                <li id="sidebarComment"></li>

                <li id="sidebarIndexUser"></li>

                <li id="sidebarManagementAllSection" class="menu-title" hidden>Yönetim</li>

                <li id="sidebarUserSection" hidden>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-address-card"></i>
                        <span>Kullanıcılar</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li id="sidebarUser"></li>
                        <li id="sidebarUserGroup"></li>
                        <li id="sidebarGroupAuth"> </li>
                    </ul>
                </li>

                <li id="sidebarDataSection" hidden>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-database"></i>
                        <span>Site Ayarları</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li id="sidebarHomeSettings"></li>
                        <li id="sidebarThemeSettings"></li>
                        <li id="sidebarSliderVideo"></li>
                        <li id="sidebarLogoSettings"></li>
                        <li id="sidebarMetaSettings"></li>
                        <li id="sidebarTitleSettings"></li>
                        <li id="sidebarMenuSettings"></li>
                        <li id="sidebarSocialSettings"></li>
                    </ul>
                </li>

                <li id="sidebarSuperUserSection" hidden>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-hexagon-multiple-outline"></i>
                        <span>Yönetim</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li id="sidebarAdminMetaSettings"></li>
                        <li id="sidebarKeyValue"></li>
                        <li id="sidebarAuthClause"></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

<script>
    var html = ``;

    @if ($authArray['animeRead']  || $authArray['animeEpisodeRead']  || $authArray['animeCalendarRead'] )

        document.getElementById('sidebarAnimeSection').hidden = false;

        html = ``;

        @if ($authArray['animeRead'] )
            html = `<a href="{{ route('admin_anime_list') }}">Animeler</a>`;
            document.getElementById('sidebarAnime').innerHTML = html;
        @endif

        @if ($authArray['animeEpisodeRead'] )
            html = `<a href="{{ route('admin_anime_episodes_list') }}">Bölümler</a>`;
            document.getElementById('sidebarAnimeEpisode').innerHTML = html;
        @endif

        @if ($authArray['animeCalendarRead'] )
            html = `<a href="{{ route('admin_animecalendar_index') }}">Takvim</a>`;
            document.getElementById('sidebarAnimeCalendar').innerHTML = html;
        @endif
    @endif

    @if ($authArray['contactRead']  || $authArray['commentRead']  || $authArray['indexUserRead'] )

        document.getElementById('userDataSection').hidden = false;

        html = ``;

        @if ($authArray['contactRead'] )
            html =
                `<a href="{{ route('admin_contact_screen') }}"> <i class="fas fa-envelope"></i><span>İletişim</span></a>`;
            document.getElementById('sidebarContact').innerHTML = html;
        @endif

        @if ($authArray['commentRead'] )
            html =
                `<a href="{{ route('admin_comment_screen') }}"> <i class="fas fa-comment"></i> <span>Yorumlar</span> </a>`;
            document.getElementById('sidebarComment').innerHTML = html;
        @endif

        @if ($authArray['indexUserRead'] )
            html =
                `<a href="{{ route('admin_indexuser_list') }}"> <i class="fas fa-address-card"></i> <span>Üyeler</span> </a>`;
            document.getElementById('sidebarIndexUser').innerHTML = html;
        @endif
    @endif

    @if ($authArray['webtoonRead']  || $authArray['webtoonEpisodeRead']  || $authArray['webtoonCalendarRead'] )

        document.getElementById('sidebarWebtoonSection').hidden = false;

        html = ``;

        @if ($authArray['webtoonRead'] )
            html = `<a href="{{ route('admin_webtoon_list') }}">Webtoon'lar</a>`;
            document.getElementById('sidebarWebtoon').innerHTML = html;
        @endif

        @if ($authArray['webtoonEpisodeRead'] )
            html = `<a href="{{ route('admin_webtoon_episodes_list') }}">Bölümler</a>`;
            document.getElementById('sidebarWebtoonEpisode').innerHTML = html;
        @endif

        @if ($authArray['webtoonCalendarRead'] )
            html = `<a href="{{ route('admin_webtooncalendar_index') }}">Takvim</a>`;
            document.getElementById('sidebarWebtoonCalendar').innerHTML = html;
        @endif
    @endif

    @if ($authArray['showNotifications']  || $authArray['showNotifications'] )
        document.getElementById('sidebarNotificationSection').hidden = false;

        html = ``;

        @if ($authArray['showNotifications'] )
            html = `<a href="{{ route('admin_add_notifications_screen') }}">Yeni Bildirim Gönder</a>`;
            document.getElementById('sidebarAddNotification').innerHTML = html;
        @endif

        @if ($authArray['showNotifications'] )
            html = `<a href="{{ route('admin_show_notifications') }}">Gönderilmiş Bildirimler</a>`;
            document.getElementById('sidebarNotifications').innerHTML = html;
        @endif
    @endif

    @if ($authArray['pageRead']  || $authArray['categoryRead']  || $authArray['tagRead'] )

        document.getElementById('sidebarOtherSection').hidden = false;

        html = ``;

        @if ($authArray['pageRead'] )
            html = `<a href="{{ route('admin_page_list') }}">Sayfalar</a>`;
            document.getElementById('sidebarPage').innerHTML = html;
        @endif

        @if ($authArray['categoryRead'] )
            html = `<a href="{{ route('admin_category_list') }}">Kategoriler</a>`;
            document.getElementById('sidebarCategory').innerHTML = html;
        @endif

        @if ($authArray['tagRead'] )
            html = `<a href="{{ route('admin_tag_list') }}">Etiketler</a>`;
            document.getElementById('sidebarTag').innerHTML = html;
        @endif
    @endif

    @if (
        $authArray['userRead'] ||
            $authArray['userGroupRead'] ||
            $authArray['groupAuthRead'] ||
            $authArray['changeHome'] ||
            $authArray['changeLogo'] ||
            $authArray['changeMeta'] ||
            $authArray['changeTitle'] ||
            $authArray['changeMenu'] ||
            $authArray['changeSocialMedia'] ||
            $authArray['adminMetaTag'] ||
            $authArray['KeyValue'] ||
            $authArray['clauseAuthUpdate']  ||
            $authArray['changeSliderVideo']  ||
            $authArray['changeThemeSettings'] )

        document.getElementById('sidebarManagementAllSection').hidden = false;

        @if ($authArray['userRead']  || $authArray['userGroupRead']  || $authArray['groupAuthRead'] )

            document.getElementById('sidebarUserSection').hidden = false;

            html = ``;

            @if ($authArray['userRead'] )
                html = `<a href="{{ route('admin_user_list') }}">Kullanıcılar</a>`;
                document.getElementById('sidebarUser').innerHTML = html;
            @endif

            @if ($authArray['userGroupRead'] )
                html = `<a href="{{ route('admin_authgroup_list') }}">Kullanıcı Grupları</a>`;
                document.getElementById('sidebarUserGroup').innerHTML = html;
            @endif

            @if ($authArray['groupAuthRead'] )
                html = `<a href="{{ route('admin_auth_list') }}">Grup Yetkileri</a>`;
                document.getElementById('sidebarGroupAuth').innerHTML = html;
            @endif
        @endif

        @if (
            $authArray['changeHome']  ||
                $authArray['changeLogo']  ||
                $authArray['changeMeta']  ||
                $authArray['changeTitle']  ||
                $authArray['changeMenu']  ||
                $authArray['changeSocialMedia']  ||
                $authArray['changeSliderVideo']  ||
                $authArray['changeThemeSettings'] )

            document.getElementById('sidebarDataSection').hidden = false;

            html = ``;

            @if ($authArray['changeHome'] )
                html = `<a href="{{ route('admin_data_home_list') }}">Anasayfa Ayarları</a>`;
                document.getElementById('sidebarHomeSettings').innerHTML = html;
            @endif

            @if ($authArray['changeThemeSettings'] )
                html = `<a href="{{ route('admin_data_theme_list') }}">Tema Ayarları</a>`;
                document.getElementById('sidebarThemeSettings').innerHTML = html;
            @endif

            @if ($authArray['changeSliderVideo'] )
                html = `<a href="{{ route('admin_data_slider_video_list') }}">Slider Videoları</a>`;
                document.getElementById('sidebarSliderVideo').innerHTML = html;
            @endif

            @if ($authArray['changeLogo'] )
                html = `<a href="{{ route('admin_data_logo_list') }}">Logolar</a>`;
                document.getElementById('sidebarLogoSettings').innerHTML = html;
            @endif

            @if ($authArray['changeMeta'] )
                html = `<a href="{{ route('admin_data_meta_list') }}">Meta Etiketleri</a>`;
                document.getElementById('sidebarMetaSettings').innerHTML = html;
            @endif

            @if ($authArray['changeTitle'] )
                html = `<a href="{{ route('admin_data_title_list') }}">Başlıklar</a>`;
                document.getElementById('sidebarTitleSettings').innerHTML = html;
            @endif

            @if ($authArray['changeMenu'] )
                html = `<a href="{{ route('admin_data_menu_list') }}">Menüler</a>`;
                document.getElementById('sidebarMenuSettings').innerHTML = html;
            @endif

            @if ($authArray['changeSocialMedia'] )
                html = `<a href="{{ route('admin_data_social_list') }}">Sosyal Medya</a>`;
                document.getElementById('sidebarSocialSettings').innerHTML = html;
            @endif
        @endif

        @if ($authArray['adminMetaTag']  || $authArray['KeyValue']  || $authArray['clauseAuthUpdate'] )

            document.getElementById('sidebarSuperUserSection').hidden = false;

            html = ``;

            @if ($authArray['adminMetaTag'] )
                html = `<a href="{{ route('admin_data_admin_meta_list') }}">Admin Meta Etiketleri</a>`;
                document.getElementById('sidebarAdminMetaSettings').innerHTML = html;
            @endif

            @if ($authArray['KeyValue'] )
                html = `<a href="{{ route('admin_keyvalue_list') }}">Key Value</a>`;
                document.getElementById('sidebarKeyValue').innerHTML = html;
            @endif

            @if ($authArray['clauseAuthUpdate'] )
                html = `<a href="{{ route('admin_authclause_list') }}">Yetki Maddeleri</a>`;
                document.getElementById('sidebarAuthClause').innerHTML = html;
            @endif
        @endif
    @endif

    @if (
        $authArray['shopDataCategoryRead'] ||
            $authArray['shopDataFeatureRead'] ||
            $authArray['shopOrderRead'] ||
            $authArray['shopSettingsRead'] ||
            $authArray['shopProductRead'] ||
            $authArray['shopSellerRead'] ||
            $authArray['shopUsersRead'] ||
            $authArray['shopDataCargoCompaniesRead'])

        document.getElementById('sidebarShopAllSection').hidden = false;

        @if ($authArray['shopProductRead'])
            html = `<a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-shopping-bag"></i>
                            <span>Ürünler</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li id=""><a href="{{route('admin_shop_product_list')}}">Tümü</a></li>
                            <li id=""><a href="{{route('admin_shop_product_list',['type'=>'sale'])}}">Satışda</a></li>
                            <li id=""><a href="{{route('admin_shop_product_list',['type'=>'unapproved'])}}">Onaylanmamış</a></li>
                            <li id=""><a href="{{route('admin_shop_product_list',['type'=>'passive'])}}">Pasif</a></li>
                        </ul>`;
            document.getElementById('sidebarShopProductsSection').innerHTML = html;
        @endif

        @if($authArray['shopOrderRead'])
            html = `<a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-shopping-basket"></i>
                            <span>Siparişler</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li id=""><a href="{{route('admin_shop_order_list')}}">Tümü</a></li>
                            <li id=""><a href="{{route('admin_shop_order_list',['type'=>'approved'])}}">Onaylanmış</a></li>
                            <li id=""><a href="{{route('admin_shop_order_list',['type'=>'unapproved'])}}">Onaylanmamış</a></li>
                            <li id=""><a href="{{route('admin_shop_order_list',['type'=>'cancelled'])}}">İptal Edilen</a></li>
                        </ul>`;
            document.getElementById('sidebarShopOrderSection').innerHTML = html;
        @endif

        @if($authArray['shopSettingsRead'])
            html = `<a href="{{route('admin_shop_settings_list')}}"><i class="fas fa-cog"></i> <span>Mağaza Ayarları</span></a>`;

            document.getElementById('sidebarShopSettingsSection').innerHTML = html;
        @endif

        @if ($authArray['shopDataCategoryRead'] || $authArray['shopDataFeatureRead'] || $authArray['shopDataCargoCompaniesRead'])

            document.getElementById('sidebarShopDataSection').hidden = false;

            html = ``;

            @if ($authArray['shopDataCategoryRead'])
                html = `<a href="{{route('admin_shop_category_list')}}">Kategoriler</a>`;
                document.getElementById('sidebarShopDataCateogorySection').innerHTML = html;
            @endif

            @if ($authArray['shopDataFeatureRead'])
                html = `<a href="{{route('admin_shop_feature_list')}}">Özellikler</a>`;
                document.getElementById('sidebarShopDataFeatureSection').innerHTML = html;
            @endif

            @if ($authArray['shopDataCargoCompaniesRead'] )
                html = `<a href="{{route('admin_shop_cargo_company_list')}}">Kargo Firmaları</a>`;
                document.getElementById('sidebarShopDataCargoCompaniesSection').innerHTML = html;
            @endif

        @endif

        @if ($authArray['shopSellerRead'] || $authArray['shopUsersRead'])

            document.getElementById('sidebarShopUserAllSection').hidden = false;

            html = ``;

            @if ($authArray['shopSellerRead'] )
                html = `<a href="{{route('admin_shop_seller_list')}}">Satıcılar</a>`;
                document.getElementById('sidebarShopUserSellerSection').innerHTML = html;
            @endif

            @if ($authArray['shopUsersRead'] )
                html = `<a href="{{route('admin_shop_user_list')}}">Üyeler</a>`;
                document.getElementById('sidebarShopUserUsersSection').innerHTML = html;
            @endif
        @endif
    @endif
</script>
