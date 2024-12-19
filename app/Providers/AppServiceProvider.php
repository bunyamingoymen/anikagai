<?php

namespace App\Providers;

use App\Models\AuthorizationClauseGroup;
use App\Models\Category;
use App\Models\KeyValue;
use App\Models\NotificationAdmin;
use App\Models\Theme;
use App\Models\ThemeSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Anime;
use App\Models\NotificationUser;
use App\Models\Shop\ShopCategories;
use App\Models\Shop\ShopKeyValue;
use App\Models\Webtoon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        require_once app_path('Helpers/Functions.php');
        /*
        //NOTE : Aşğıdaki sayfalara sadece super_user girebilir bu sebeple diğer sayfalar kısmında veriler yoktur
        Auth Clause tamamı
        admin_meta(Data'nın içinde)
        keyValue
        */
        if ($this->hasTable('key_values') && $this->hasTable('themes')) {
            $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
            $themePath = $selected_theme ? Theme::Where('code', $selected_theme->value)->first() : Theme::first();
            if ($themePath) {
                $indexPages = ['index.' . $themePath->themePath . '.layouts.main', 'index.' . $themePath->themePath . '.index', 'index.' . $themePath->themePath . '.profile', 'index.' . $themePath->themePath . '.calendar', 'index.'];
                $watchPages = ['index.' . $themePath->themePath . '.watch', 'index.' . $themePath->themePath . '.read'];
                $themeThree = ['index.themes.moviefx.layouts.main', 'index.themes.moviefx.layouts.sidebar', 'index.themes.moviefx.layouts.topbar', 'index.themes.moviefx.layouts.footer', 'index.themes.moviefx.profile'];

                $shopPages = ['shop.themes.kidol.layouts.main', 'shop.themes.kidol.layouts.footer', 'shop.themes.kidol.layouts.header',];

                $adminPages = ['admin.layouts.main'];
                //
                $userPages = ['admin.users.create', 'admin.users.list', 'admin.users.update'];
                $authGroupPages = ['admin.auth.groups.create', 'admin.auth.groups.list', 'admin.auth.groups.update'];
                $authPages = ['admin.auth.auth.list'];
                $dataPages = ['admin.data.home', 'admin.data.theme', 'admin.data.logo', 'admin.data.menu', 'admin.data.meta', 'admin.data.social', 'admin.data.title', 'admin.data.sliderVideo'];
                $animePages = ['admin.anime.anime.create', 'admin.anime.anime.list', 'admin.anime.anime.update'];
                $animeEpisodePages = ['admin.anime.episode.create', 'admin.anime.episode.create_url', 'admin.anime.episode.list', 'admin.anime.episode.update'];
                $animeCalendarPages = ['admin.anime.calendar.calendar'];
                $webtoonPages = ['admin.webtoon.webtoon.create', 'admin.webtoon.webtoon.list', 'admin.webtoon.webtoon.update'];
                $webtoonEpisodePages = ['admin.webtoon.episode.create', 'admin.webtoon.episode.list', 'admin.webtoon.episode.update'];
                $webtoonCalendarPages = ['admin.webtoon.calendar.calendar'];
                $pagePages = ['admin.pages.create', 'admin.pages.list', 'admin.pages.update', 'admin.pages.show'];
                $categoryPages = ['admin.category.create', 'admin.category.list', 'admin.category.update'];
                $tagPages = ['admin.tag.create', 'admin.tag.list', 'admin.tag.update'];
                $notificationPages = ['admin.notification.create', 'admin.notification.list'];
                $indexUserPages = ['admin.indexUsers.create', 'admin.indexUsers.list', 'admin.indexUsers.update'];

                $commentPages = ['admin.comment.comment'];
                $contactPages = ['admin.contact.contact'];

                //shop:
                $shopDataCategoryPages = ['admin.shop.data.category.list', 'admin.shop.data.category.edit'];
                $shopDataFeaturePages = ['admin.shop.data.feature.list', 'admin.shop.data.feature.edit'];
                $shopDataCargoCompaniesPages = ['admin.shop.data.cargoCompany.list', 'admin.shop.data.cargoCompany.edit'];

                $shopOrderPages = ['admin.shop.order.list', 'admin.shop.order.edit'];

                $shopSettingsPages = ['admin.shop.other.setting'];

                $shopProductPages = ['admin.shop.product.list', 'admin.shop.product.edit'];

                $shopUserSellerPages = ['admin.shop.user.seller.list', 'admin.shop.user.seller.edit'];
                $shopUserUserPages = ['admin.shop.user.user.list', 'admin.shop.user.user.edit'];


                //shop index:

                if ($this->hasTable('users')) {

                    //----------------------------------------------------------------
                    //Admin:
                    View::composer($adminPages, function ($view) {
                        //--Bildirimler
                        $notificationAdmin = null;
                        $notificationAdminCount = 0;

                        // Veritabanı tablosu var mı kontrol et
                        if ($this->hasTable('notification_admins') && Auth::guard('admin')->check()) {
                            $notificationAdmin = DB::table('notification_admins')
                                ->where('notification_admins.deleted', 0)
                                ->where('notification_admins.readed', 0)
                                ->where('notification_admins.to_user_code', Auth::guard('admin')->user()->code)
                                ->join('users', 'users.code', '=', 'notification_admins.from_user_code')
                                ->select('notification_admins.*', 'users.name as from_user_name', 'users.surname as from_user_surname')
                                ->get();

                            $notificationAdminCount = count($notificationAdmin);
                        }
                        //----------------------------------------------------------------
                        // Başlıklar
                        $titleValues = $this->findTitleValue();

                        $title = $titleValues['title'];
                        $pathName = $titleValues['pathName'];
                        $pathRoute = $titleValues['pathRoute'];
                        //----------------------------------------------------------------
                        //--Yetkiler

                        //NOTE: Superuser Yetkileri
                        $adminMetaTag = (Auth::guard('admin')->user()->user_type == 0) ? 1 : 0;
                        $KeyValue = (Auth::guard('admin')->user()->user_type == 0) ? 1 : 0;
                        $clauseAuthUpdate = (Auth::guard('admin')->user()->user_type == 0) ? 1 : 0;
                        //------------------------

                        $userRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/user/list') ? 1 : 0;
                        $userGroupRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/authGroup/list') ? 1 : 0;
                        $groupAuthRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/auth/list') ? 1 : 0;

                        $changeLogo = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/logo') ? 1 : 0;
                        $changeHome = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/home') ? 1 : 0;
                        $changeMeta = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/meta') ? 1 : 0;
                        $changeTitle =  $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/title') ? 1 : 0;
                        $changeMenu = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/menu') ? 1 : 0;
                        $changeSocialMedia = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/social') ? 1 : 0;

                        $animeRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/anime/list') ? 1 : 0;
                        $animeEpisodeRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/animeEpisodes/list') ? 1 : 0;
                        $animeCalendarRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/anime/calendar') ? 1 : 0;

                        $webtoonRead =  $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/webtoon/list') ? 1 : 0;
                        $webtoonEpisodeRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/webtoonEpisodes/list') ? 1 : 0;
                        $webtoonCalendarRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/webtoon/calendar') ? 1 : 0;

                        $pageRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/page/list') ? 1 : 0;
                        $categoryRead =  $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/category/list') ? 1 : 0;
                        $tagRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/tag/list') ? 1 : 0;

                        $commentRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/comment') ? 1 : 0;
                        $contactRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/contact') ? 1 : 0;

                        $indexUserRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/indexUser/list') ? 1 : 0;

                        $changeSliderVideo = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/sliderVideo') ? 1 : 0;

                        $changeThemeSettings = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/theme') ? 1 : 0;

                        $showNotifications = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/notification/list') ? 1 : 0;

                        $addNotifications = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/notification/create') ? 1 : 0;

                        //shop:

                        $shopDataCategoryRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/category') ? 1 : 0;
                        $shopDataFeatureRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/feature') ? 1 : 0;
                        $shopOrderRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/order') ? 1 : 0;
                        $shopSettingsRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/settings') ? 1 : 0;
                        $shopProductRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/product') ? 1 : 0;
                        $shopSellerRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/seller') ? 1 : 0;
                        $shopUsersRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/user') ? 1 : 0;
                        $shopDataCargoCompaniesRead = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/cargoCompany') ? 1 : 0;


                        $authArray = [
                            'userRead' => $userRead,
                            'userGroupRead' => $userGroupRead,
                            'groupAuthRead' => $groupAuthRead,
                            'changeHome' => $changeHome,
                            'changeLogo' => $changeLogo,
                            'changeMeta' => $changeMeta,
                            'changeTitle' => $changeTitle,
                            'changeMenu' => $changeMenu,
                            'changeSocialMedia' => $changeSocialMedia,
                            'adminMetaTag' => $adminMetaTag,
                            'KeyValue' => $KeyValue,
                            'clauseAuthUpdate' => $clauseAuthUpdate,
                            'animeRead' => $animeRead,
                            'animeEpisodeRead' => $animeEpisodeRead,
                            'animeCalendarRead' => $animeCalendarRead,
                            'webtoonRead' => $webtoonRead,
                            'webtoonEpisodeRead' => $webtoonEpisodeRead,
                            'webtoonCalendarRead' => $webtoonCalendarRead,
                            'pageRead' => $pageRead,
                            'categoryRead' => $categoryRead,
                            'tagRead' => $tagRead,
                            'commentRead' => $commentRead,
                            'contactRead' => $contactRead,
                            'indexUserRead' => $indexUserRead,
                            'changeSliderVideo' => $changeSliderVideo,
                            'changeThemeSettings' => $changeThemeSettings,
                            'showNotifications' => $showNotifications,
                            'addNotifications' => $addNotifications,

                            'shopDataCategoryRead' => $shopDataCategoryRead,
                            'shopDataFeatureRead' => $shopDataFeatureRead,
                            'shopOrderRead' => $shopOrderRead,
                            'shopSettingsRead' => $shopSettingsRead,
                            'shopProductRead' => $shopProductRead,
                            'shopSellerRead' => $shopSellerRead,
                            'shopUsersRead' => $shopUsersRead,
                            'shopDataCargoCompaniesRead' => $shopDataCargoCompaniesRead,
                        ];
                        //----------------------------------------------------------------

                        //Mağaza Ayarları:
                        if ($this->hasTable('ShopKeyValue')) {
                            $storeActiveDB = ShopKeyValue::Where('key', 'store_active')->first();
                            if ($storeActiveDB) $storeActive = $storeActiveDB->value == "1" ? true : false;
                        }

                        if (!isset($storeActive)) $storeActive = false;
                        //----------------------------------------------------------------
                        // Görünüme veriyi gönder
                        $view->with([
                            'notificationAdmin' => $notificationAdmin,
                            'notificationAdminCount' => $notificationAdminCount,
                            'title' => $title,
                            'pathName' => $pathName,
                            'pathRoute' => $pathRoute,
                            'authArray' => $authArray,
                            'storeActive' => $storeActive,
                        ]);
                    });

                    //Diğer Sayfalar:

                    View::composer($userPages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/user/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/user/list') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/user/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/user/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
                    });

                    View::composer($authGroupPages, function ($view) {

                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/authGroup/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/authGroup/list') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/authGroup/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/authGroup/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
                    });

                    View::composer($authPages, function ($view) {
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/auth/list') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/auth/list/change') ? 1 : 0;

                        $view->with(["list" => $list, "update" => $update]);
                    });

                    View::composer($dataPages, function ($view) {

                        $homeData = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/home') ? 1 : 0;
                        $sliderVideoData = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/sliderVideo') ? 1 : 0;
                        $logoData = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/logo') ? 1 : 0;
                        $metaData = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/meta') ? 1 : 0;
                        $menuData = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/menu') ? 1 : 0;
                        $socialData = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/social') ? 1 : 0;
                        $titleData = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/title') ? 1 : 0;
                        $changeThemeSettings = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/data/theme') ? 1 : 0;

                        $view->with(["homeData" => $homeData, "logoData" => $logoData, "metaData" => $metaData, "menuData" => $menuData, "socialData" => $socialData, 'titleData' => $titleData, 'sliderVideoData' => $sliderVideoData, 'changeThemeSettings' => $changeThemeSettings]);
                    });

                    View::composer($animePages, function ($view) {

                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/anime/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/anime/list') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/anime/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/anime/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
                    });

                    View::composer($animeEpisodePages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/animeEpisodes/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/animeEpisodes/list') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/animeEpisodes/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/animeEpisodes/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
                    });

                    View::composer($animeCalendarPages, function ($view) {

                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/anime/calendar/addEvent') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/anime/calendar') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/anime/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/anime/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
                    });

                    View::composer($webtoonPages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/webtoon/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/webtoon/list') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/webtoon/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/webtoon/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
                    });

                    View::composer($webtoonEpisodePages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/webtoonEpisodes/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/webtoonEpisodes/list') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/webtoonEpisodes/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/webtoonEpisodes/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
                    });

                    View::composer($webtoonCalendarPages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/webtoon/calendar/addEvent') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/webtoon/calendar') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/webtoon/calendar') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/webtoon/calendar') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
                    });

                    View::composer($pagePages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/page/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/page/list') ? 1 : 0;
                        $show = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/page/show') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/page/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/page/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "show" => $show, "update" => $update, "delete" => $delete]);
                    });

                    View::composer($categoryPages, function ($view) {

                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/category/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/category/list') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/category/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/category/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
                    });

                    View::composer($tagPages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/tag/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/tag/list') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/tag/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/tag/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
                    });

                    View::composer($contactPages, function ($view) {
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/contact') ? 1 : 0;
                        $answer = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/contact/answer') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/contact/delete') ? 1 : 0;


                        $view->with(["list" => $list, "delete" => $delete, 'answer' => $answer]);
                    });

                    View::composer($commentPages, function ($view) {
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/comment') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/comment/delete') ? 1 : 0;

                        $view->with(["list" => $list, "delete" => $delete]);
                    });

                    View::composer($indexUserPages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/indexUser/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/indexUser/list') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/indexUser/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/indexUser/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
                    });

                    View::composer($notificationPages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/notification/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/notification/list') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/notification/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "delete" => $delete]);
                    });

                    //Shop:

                    View::composer($shopDataCategoryPages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/category/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/category') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/category/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/category/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
                    });

                    View::composer($shopDataFeaturePages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/feature/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/feature') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/feature/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/feature/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
                    });

                    View::composer($shopOrderPages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/order/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/order') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/order/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/order/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
                    });

                    View::composer($shopSettingsPages, function ($view) {
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/settings') ? 1 : 0;

                        $view->with(["list" => $list]);
                    });

                    View::composer($shopProductPages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/product/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/product') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/product/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/product/delete') ? 1 : 0;
                        $changeApproval = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/product/changeApproval') ? 1 : 0;
                        $changeActive = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/product/changeActive') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete, "changeApproval" => $changeApproval, "changeActive" => $changeActive]);
                    });

                    View::composer($shopUserSellerPages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/seller/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/seller') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/seller/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/seller/delete') ? 1 : 0;
                        $changeActive = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/seller/changeActive') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete, "changeActive" => $changeActive]);
                    });

                    View::composer($shopUserUserPages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/user/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/user') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/user/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/user/delete') ? 1 : 0;
                        $changeActive = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/user/changeActive') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete, "changeActive" => $changeActive]);
                    });

                    View::composer($shopDataCargoCompaniesPages, function ($view) {
                        $create = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/cargoCompany/create') ? 1 : 0;
                        $list = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/cargoCompany') ? 1 : 0;
                        $update = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/cargoCompany/update') ? 1 : 0;
                        $delete = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/shop/cargoCompany/delete') ? 1 : 0;

                        $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
                    });
                }
                //----------------------------------------------------
                //Index:
                View::composer($indexPages, function ($view) {

                    $keys = [
                        'index_logo',
                        'index_logo_footer',
                        'index_icon',
                        'index_title',
                        'index_text',
                        'footer_copyright',
                        'anime_active',
                        'webtoon_active'
                    ];

                    $keysGet = [
                        'meta',
                        'admin_meta',
                        'social_media'
                    ];

                    $data = collect();

                    foreach ($keys as $key) {
                        $item = KeyValue::where('key', $key)->where('deleted', 0)->first();
                        $data->put($key, $item);
                    }

                    foreach ($keysGet as $key) {
                        $item = KeyValue::where('key', $key)->where('deleted', 0)->get();
                        $data->put($key, $item);
                    }
                    $requestPath = Request::path();
                    // Özel durumlar
                    $menus = KeyValue::where('key', 'menu')->where('optional', 1)->where('deleted', 0)->get();
                    $menu_alts = KeyValue::where('key', 'menu_alt')->where('optional', 1)->where('deleted', 0)->get();
                    $active_menu = KeyValue::where('key', 'menu')->where('optional_2', $requestPath)->first();
                    $notificatons = [];

                    $notificaton_count = 0;
                    //dd(Carbon::today());
                    if (Auth::user()) {


                        $notificatons = NotificationUser::where('deleted', 0)
                            ->Where('notification_end_date', '>=', Carbon::today())
                            ->where('notification_date', '<=', Carbon::today())
                            ->where('to_user_code', Auth::user()->code)
                            ->orderBy('created_at', 'DESC')
                            ->take(3)
                            ->get();

                        $notificaton_count = NotificationUser::where('deleted', 0)
                            ->Where('notification_end_date', '>=', Carbon::today())
                            ->where('notification_date', '<=', Carbon::today())
                            ->Where('readed', 0)
                            ->where('to_user_code', Auth::user()->code)
                            ->count();
                    }
                    $sliderShow = ThemeSetting::Where('theme_code', KeyValue::Where('key', 'selected_theme')->first()->value)->Where('setting_name', 'showSlider')->first();

                    $colors_code = ThemeSetting::where('theme_code', KeyValue::where('key', 'selected_theme')->first()->value)
                        ->where('setting_name', 'colors_code')
                        ->get();

                    $view->with('data', $data)
                        ->with('menus', $menus)
                        ->with('menu_alts', $menu_alts)
                        ->with('active_menu', $active_menu)
                        ->with('requestPath', $requestPath)
                        ->with('sliderShow', $sliderShow)
                        ->with('colors_code', $colors_code)
                        ->with('notificatons', $notificatons)
                        ->with('notificaton_count', $notificaton_count);
                });

                View::composer($themeThree, function ($view) {
                    $categories = Category::Where('deleted', 0)->take(10)->get();
                    $trend_animes = $this->getTrendContent(Anime::class, 0, $this->sendShowStatus(1), 6, 'click_count');
                    $trend_webtoons = $this->getTrendContent(Webtoon::class, 0, $this->sendShowStatus(1), 6, 'click_count');
                    $view->with('categories', $categories)
                        ->with('trend_animes', $trend_animes)
                        ->with('trend_webtoons', $trend_webtoons);
                });

                View::composer($shopPages, function ($view) {
                    $categories = ShopCategories::Where('deleted', 0)->orderBy('created_at', 'DESC')->get();


                    if (Auth::guard('shop_users')->user()) {
                        $database = 'shop_mysql';
                        $model = 'App\Models\Shop\ShopProduct';

                        $filters = ['is_approved' => '1', 'is_active' => '1', 'shop_carts.user_code' => Auth::guard('shop_users')->user()->code];
                        $orderBy = ['column' => 'name', 'type' => 'ASC'];

                        $joins = [
                            ['table' => 'shop_carts', 'first' => 'code', 'operator' => '=', 'second' => 'shop_carts.product_code', 'columns' => ['product_code' => 'cart_product_code']],
                        ];

                        $leftJoins = [
                            ['table' => 'shop_files', 'first' => 'code', 'operator' => '=', 'second' => 'shop_files.parent_code', 'columns' => ['path' => 'image_path', 'parent_code' => 'parent_code'], 'where' => ['description' => ['can_be_null' => false, 'value' => 'main image']]],

                        ];

                        $cartTotalCount = $this->getDataFromDatabase(['database' => $database, 'model' => $model, 'joins' => $joins, 'leftjoins' => $leftJoins, 'filters' => $filters, 'orderby' => $orderBy, 'pagination' => ['take' => 100, 'page' => 1], 'totalcount' => true])['totalCount'];
                    } else {
                        $cartTotalCount = 0;
                    }

                    $view->with(['categories' => $categories, "cartTotalCount" => $cartTotalCount]);
                });

                View::composer($watchPages, function ($view) {

                    if (Auth::guard('admin')->user())
                        $commentPinned = $this->checkAuthorization(Auth::guard('admin')->user()->user_type, 'access.path_access_codes.admin/comment/pinned') ? 1 : 0;
                    else
                        $commentPinned = 0;

                    $view->with('commentPinned', $commentPinned);
                });
            }
        }
    }

    private function hasTable($tableName)
    {
        try {
            Schema::hasTable($tableName);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function checkAuthorization($adminUserType, $configKey)
    {

        $hasTable = $this->hasTable('authorization_clause_groups');

        if (!$hasTable || $adminUserType === null || $configKey === null) {
            return false;
        }

        $clauseId = Config::get($configKey);

        // Null kontrolü
        if ($clauseId === null) {
            return false;
        }

        return $adminUserType == 0 || $adminUserType == 1 ||
            AuthorizationClauseGroup::where('clause_id', $clauseId)
            ->where('group_id', $adminUserType)
            ->exists();
    }

    private function checkIndexPage($adminUserType, $action)
    {
        $hasTable = $this->hasTable('authorization_clause_groups');
        if (!$hasTable || !$adminUserType) {
            return false;
        }

        $clauseId = Config::get('access.path_access_codes.admin/webtoon/' . $action);
        return ($adminUserType == 0 || $adminUserType == 1) ||
            (count(AuthorizationClauseGroup::where('clause_id', $clauseId)
                ->where('group_id', $adminUserType)
                ->get()) > 0);
    }

    private function loadThemeView($viewName, $additionalData = [])
    {
        if ($this->hasTable('key_values')) {
            $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
            $themePath = Theme::Where('code', $selected_theme->value)->first();

            return view("index." . $themePath->themePath . ".$viewName", $additionalData);
        }
    }

    private function getTrendContent($modelClass, $main_category = 0, $showStatus, $take, $orderBy)
    {
        if ($main_category == 0) {
            return $modelClass::where('deleted', 0)
                ->where('plusEighteen', 0)
                ->whereIn('showStatus', $showStatus)
                ->take($take)
                ->orderBy($orderBy, 'DESC')
                ->get();
        } else {
            return $modelClass::where('deleted', 0)
                ->where('plusEighteen', 0)
                ->Where('main_category', $main_category)
                ->whereIn('showStatus', $showStatus)
                ->take($take)
                ->orderBy($orderBy, 'DESC')
                ->get();
        }
    }

    private function sendShowStatus($type = 0)
    {
        //type 0 ise normal listelemedir. 1 ise trend yada benzer içerikleri listelemedir.

        if ($type == 0)
            return Auth::user() ? ["0", "1", "2"] : ["0", "2"];
        if ($type == 1)
            return Auth::user() ? ["0", "1", "2"] : ["0"];
    }

    private function findTitleValue($path = null)
    {
        $path = $path ?? Request::path();
        $keyPrefix = 'title.titles.';

        $defaultValue = [
            'title' => 'Başlık Bulunamadı',
            'pathName' => ['Admin'],
            'pathRoute' => ["admin_index"],
        ];

        while ($path !== '') {
            $title = Config::get($keyPrefix . $path);
            $pathName = Config::get($keyPrefix . '/' . $path);
            $pathRoute = Config::get($keyPrefix . '//' . $path);

            if ($title || $pathName || $pathRoute) {
                return [
                    'title' => $title ?: $defaultValue['title'],
                    'pathName' => $pathName ?: $defaultValue['pathName'],
                    'pathRoute' => $pathRoute ?: $defaultValue['pathRoute'],
                ];
            }

            // Son / işaretinden sonrasını sil
            $lastSlashPosition = strrpos($path, '/');
            if ($lastSlashPosition === false) {
                break; // Artık / işareti yok, döngüden çık
            }

            $path = substr($path, 0, $lastSlashPosition);
        }

        // Hiçbir değer bulunamadığında özel bir değer döndür
        return [
            'title' => $defaultValue['title'],
            'pathName' => $defaultValue['pathName'],
            'pathRoute' => $defaultValue['pathRoute'],
        ];
    }

    private function makeShortName($name)
    {
        $alphabet = [
            'q',
            'w',
            'e',
            'r',
            't',
            'y',
            'u',
            'ı',
            'o',
            'p',
            'ğ',
            'ü',
            'a',
            's',
            'd',
            'f',
            'g',
            'h',
            'j',
            'k',
            'l',
            'ş',
            'i',
            'z',
            'x',
            'c',
            'v',
            'b',
            'n',
            'm',
            'ö',
            'ç'
        ];

        $name = $name;
        $shortName = '';

        // Gelen ismi karakter karakter parçalayarak kontrol ediyoruz
        for ($i = 0; $i < mb_strlen($name); $i++) {
            $character = mb_strtolower(mb_substr($name, $i, 1)); // Harfi küçük harfe dönüştürüyoruz
            if (in_array($character, $alphabet)) {
                $shortName .= $character;
            } else $shortName .= "-";
        }

        return $shortName;
    }

    private function getDataFromDatabase($data = [])
    {
        //$data içinde bulunan veriler: 'database'=>'shop_mysql', 'model'=>'App\Models\Shop\ShopProduct', $filters = [], $pagination = ['take' => 15, 'page' => 1], $search = [], $whereIn = [], $joins=[]


        //örnek orderby: $orderBy = ['column'=>'created_at', 'type'=>'DESC']
        //Örnek wherein: whereIn = [ 'category_code'=>['1','2','3'], 'feature_code'=>['4','5','6'] ]
        //Örnek joins: $joins = [ ['table' => 'categories', 'first' => 'category_id', 'operator' => '=', 'second' => 'categories.id', 'columns'=>['name'=>'category_name', 'code'=>'category_code']] ];
        //Örnek search: $search=['search' => $request->searchData, 'dbSearch' => ['name','description','main_category_name'], 'short_name'=> true, 'short_name_db' => 'short_name' ];
        //örnek filter(where): $filters['is_approved'] = "1";   $filters['is_active'] = "1";
        //örnek pagination: $pagination = [ 'take' => $request->showingCount ? $request->showingCount : Config::get('app.showCount'), 'page' => $request->page];
        //Eğer burada ana tablo olarak gönderilen tablodan bir değer alacaksanız (wherein ya da join..vs.) Tablonun adını yukarıdaki dizilerden herhangi birini oluştururken girmemelisiniz. Aksi taktirde hata verecektir.
        /*Örnek leftjoin
        $leftJoins = [
            ['table' => 'shop_files', 'first' => 'code', 'operator' => '=', 'second' => 'shop_files.parent_code', 'columns' => ['path' => 'image_path', 'parent_code' => 'parent_code']],
            ['table' => 'shop_whishlists', 'first' => 'code', 'operator' => '=', 'second' => 'shop_whishlists.product_code', 'columns' => ['product_code' => 'whislist_product_code', 'deleted' => 'whislist_deleted', 'user_code' => 'whislist_user_code'], 'where' => ['deleted' => ['can_be_null' => false, 'value' => 0], 'user_code' => Auth::guard('shop_users')->user()->code,]],
            ['table' => 'shop_carts', 'first' => 'code', 'operator' => '=', 'second' => 'shop_carts.product_code', 'columns' => ['product_code' => 'cart_product_code', 'user_code' => 'whislist_user_code'], 'where' => ['user_code' => Auth::guard('shop_users')->user()->code]]
        ];*/
        //data ile gelen değerleri eşleştirme
        // Anahtarları küçük harfe çevir
        $data = array_change_key_case($data, CASE_LOWER);

        // Veritabanı bağlantısı ayarla (Varsayılan 'mysql')
        $database = $data['database'] ?? 'mysql';

        // Modeli ayarla (Eğer model yoksa null döner)
        $model = $data['model'] ?? null;
        if (!$model) return null;

        // Filtreleri ayarla (Varsayılan boş dizi)
        $filters = $data['filters'] ?? [];

        // Sayfalama ayarları (Varsayılan 15 kayıt ve 1. sayfa)
        $pagination = $data['pagination'] ?? ['take' => 15, 'page' => 1];

        // Arama ayarları (Varsayılan boş dizi)
        $search = $data['search'] ?? [];

        // WhereIn koşulları (Varsayılan boş dizi)
        $whereIn = $data['wherein'] ?? [];

        // Join ayarları (Varsayılan boş dizi)
        $joins = $data['joins'] ?? [];

        $leftJoins = $data['leftjoins'] ?? [];

        $rightJoins = $data['rightjoins'] ?? [];

        $groupBy = $data['groupby'] ?? false;

        $orderBy = $data['orderby'] ?? null;

        $getQuery = $data['getquery'] ?? false;

        $isFirst = $data['isfirst'] ?? false;

        $totaCount = $data['totalcount'] ?? false;

        $mainTableAlias = $data['maintablealias'] ?? 'main';


        $result = [];
        // Veritabanı bağlantısını seç
        $connection = DB::connection($database);

        // Modelin tablo adını al
        $table = (new $model)->getTable() . ' as ' . $mainTableAlias;

        // Pagination ayarları
        $take = $pagination['take'];
        $skip = (($pagination['page'] - 1) * $take);

        // Başlangıç query
        $query = $connection->table($table);

        // Seçilecek sütunları ekle
        $mainTableColumns = $connection->getSchemaBuilder()->getColumnListing((new $model)->getTable());
        $selectColumns = [];
        if ($groupBy) $groupByColumns = [];

        foreach ($mainTableColumns as $column) {
            $selectColumns[] = $mainTableAlias . '.' . $column; // Ana tablodaki tüm sütunlar
            if ($groupBy) $groupByColumns[] = $mainTableAlias . '.' . $column;
        }

        // Join işlemi
        if (!empty($joins)) {
            foreach ($joins as $index => $join) {
                if (isset($join['table'], $join['first'], $join['operator'], $join['second'], $join['columns'])) {
                    // Join işlemi
                    $first = strpos($join['first'], '.') ? $join['first'] : $mainTableAlias . '.' . $join['first'];
                    $second = strpos($join['second'], '.') ? $join['second'] : $mainTableAlias . '.' . $join['second'];

                    $query->join($join['table'], $first, $join['operator'], $second);

                    // Join edilen tablonun belirli sütunlarını alias ile ekle
                    foreach ($join['columns'] as $column => $alias) {
                        if (strpos($column, '.'))  $selectColumns[] = $column . ' as ' . $alias;
                        else $selectColumns[] = $join['table'] . '.' . $column . ' as ' . $alias;

                        if ($groupBy) {
                            if (strpos($column, '.'))  $groupByColumns[] = $column;
                            else  $groupByColumns[] = $join['table'] . '.' . $column;
                        }
                    }
                }
            }
        }

        if (!empty($leftJoins)) {
            foreach ($leftJoins as $index => $left) {
                if (isset($left['table'], $left['first'], $left['operator'], $left['second'], $left['columns'])) {
                    $first = strpos($left['first'], '.') ? $left['first'] : $mainTableAlias . '.' . $left['first'];
                    $second = strpos($left['second'], '.') ? $left['second'] : $mainTableAlias . '.' . $left['second'];
                    // Alt sorgu ile LIMIT 1 eklenmiş join
                    $subQuery = $connection->table($left['table']);
                    $subQuerySelect = [];
                    foreach ($left['columns'] as $column => $alias) {
                        $col = (strpos($column, '.')) ? $column : $left['table'] . '.' . $column;
                        $subQuerySelect[] = $col;
                        $selectColumns[] = $col . ' as ' . $alias;

                        if ($groupBy) {
                            $groupByColumns[] = $col;
                        }
                    }


                    if (isset($left['where'])) {
                        foreach ($left['where'] as $left_where_index => $left_where) {
                            $left_column = (strpos($left_where_index, '.')) ? $left_where_index : $left['table'] . '.' . $left_where_index;
                            if (isset($left_where['can_be_null'])) {
                                if ($left_where['can_be_null']) $subQuery->where($left_column, $left_where['value'])->orWhere($left_column, null);
                                else $subQuery->where($left_column, $left_where['value']);
                            } else {
                                $subQuery->where($left_column, $left_where)->orWhere($left_column, null);
                            }
                        }
                    }

                    $subQuery->select($subQuerySelect)->orderBy('created_at', 'desc')->limit(1);
                    $query->leftJoinSub($subQuery, $left['table'], $first, $left['operator'], $second);

                    // Select edilen sütunlar

                }
            }
        }

        //dd($query->toSql());

        //filtre ayarları
        if (in_array($mainTableAlias . '.deleted', $selectColumns)) $filters['deleted'] = 0;

        // Filtreleri uygula
        foreach ($filters as $column => $value) {
            if (strpos($column, '.')) $query->where($column, $value);
            else $query->where($mainTableAlias . '.' . $column, $value);
        }

        // Arama işlemi
        if (isset($search['search']) && is_string($search['search']) && isset($search['dbSearch']) && is_array($search['dbSearch'])) {
            $query->where(function ($q) use ($search, $mainTableAlias) {
                // İlk kolon için where kullanıyoruz
                $firstColumn = true;
                foreach ($search['dbSearch'] as $column) {
                    if ($firstColumn) {
                        if (strpos($column, '.')) $q->where($column, 'LIKE', '%' . $search['search'] . '%');
                        else $q->where($mainTableAlias . '.' . $column, 'LIKE', '%' . $search['search'] . '%');
                        $firstColumn = false;
                    } else {
                        if (strpos($column, '.'))  $q->orWhere($column, 'LIKE', '%' . $search['search'] . '%');
                        else $q->orWhere($mainTableAlias . '.' . $column, 'LIKE', '%' . $search['search'] . '%');
                    }
                }

                // Eğer kısa isim ya da URL de aranmak istenirse
                if (isset($search['short_name']) && isset($search['short_name_db']) && $search['short_name']) {
                    $shortName = $this->makeShortName($search['search']);
                    if (strpos($column, '.'))  $q->orWhere($search['short_name_db'], 'LIKE', '%' . $shortName  . '%');
                    else $q->orWhere($mainTableAlias . '.' . $search['short_name_db'], 'LIKE', '%' . $shortName  . '%');
                }
            });
        }

        // WhereIn işlemi
        if (!empty($whereIn) && count($whereIn) > 0) {
            foreach ($whereIn as $column => $values) {
                if (is_array($values) && count($values) > 0) {
                    if (strpos($column, '.')) $query->whereIn($column, $values);
                    else $query->whereIn($mainTableAlias . '.' . $column, $values);
                }
            }
        }

        $query->select($selectColumns);


        if ($groupBy) $query->groupBy($groupByColumns);

        if ($orderBy) {
            if (strpos($orderBy['column'], '.'))  $orderByColumn = $orderBy['column'];
            else {
                if (!isset($orderBy['put_table'])) $orderByColumn = $mainTableAlias . '.' . $orderBy['column'];
                else if (isset($orderBy['put_table']) && $orderBy['put_table']) $orderByColumn = $mainTableAlias . '.' . $orderBy['column'];
                else $orderByColumn = $orderBy['column'];
            }
            $query->orderBy($orderByColumn, $orderBy['type']);
        }

        //dd($query->toSql());

        if ($totaCount) {
            $result['totalCount'] = $query->count();
        }

        // Verileri al
        if ($isFirst) {
            $result['item'] = $query->first();
        } else {
            $result['items'] = $query->skip($skip)->take($take)->get();
            $result['page_count'] = ceil($query->count() / $take);
        }

        if ($getQuery) $result['query'] = $query;

        return $result;
    }
}
