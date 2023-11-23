<?php

namespace App\Providers;

use App\Models\AuthorizationClauseGroup;
use App\Models\KeyValue;
use App\Models\NotificationAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;

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
        /*
        //NOTE : Aşğıdaki sayfalara sadece super_user girebilir bu sebeple diğer sayfalar kısmında veriler yoktur
        Auth Clause tamamı
        admin_meta(Data'nın içinde)
        keyValue
        */
        $indexPages = ['index.layouts.main', 'index.index'];
        $adminPages = ['admin.layouts.main'];
        //
        $userPages = ['admin.users.create', 'admin.users.list', 'admin.users.update'];
        $authGroupPages = ['admin.auth.groups.create', 'admin.auth.groups.list', 'admin.auth.groups.update'];
        $authPages = ['admin.auth.auth.list'];
        $dataPages = ['admin.data.logo', 'admin.data.menu', 'admin.data.meta', 'admin.data.social', 'admin.data.title'];
        $animePages = ['admin.anime.anime.create', 'admin.anime.anime.list', 'admin.anime.anime.update'];
        $animeEpisodePages = ['admin.anime.episode.create', 'admin.anime.episode.list', 'admin.anime.episode.update'];
        $animeCalendarPages = ['admin.anime.calendar.calendar'];
        $webtoonPages = ['admin.webtoon.webtoon.create', 'admin.webtoon.webtoon.list', 'admin.webtoon.webtoon.update'];
        $webtoonEpisodePages = ['admin.webtoon.episode.create', 'admin.webtoon.episode.list', 'admin.webtoon.episode.update'];
        $webtoonCalendarPages = ['admin.webtoon.calendar.calendar'];
        $pagePages = ['admin.pages.create', 'admin.pages.list', 'admin.pages.update', 'admin.pages.show'];
        $categoryPages = ['admin.category.create', 'admin.category.list', 'admin.category.update'];
        $tagPages = ['admin.tag.create', 'admin.tag.list', 'admin.tag.update'];

        //----------------------------------------------------------------
        //Admin:
        View::composer($adminPages, function ($view) {
            //--Bildirimler
            $notificationAdmin = DB::table('notification_admins')
                ->Where('notification_admins.deleted', 0)
                ->Where('notification_admins.readed', 0)
                ->Where('notification_admins.to_user_code', Auth::user()->code)
                ->join('users', 'users.code', '=', 'notification_admins.from_user_code')
                ->select('notification_admins.*', 'users.name as from_user_name', 'users.surname as from_user_surname')
                ->get();
            $notificationAdminCount = count($notificationAdmin);
            //----------------------------------------------------------------
            //--Başlıklar
            $title = Config::get('title.titles.' . Request::path());
            $pathName = Config::get('title.titles./' . Request::path());
            $pathRoute = Config::get('title.titles.//' . Request::path());
            //----------------------------------------------------------------
            //--Yetkiler
            $userRead = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 2)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $userGroupRead = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 6)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $groupAuthRead = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 10)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $changeHome = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 13)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $changeLogo = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 14)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $changeMeta = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 15)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $changeTitle = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 16)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $changeMenu = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 17)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $changeSocialMedia = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 18)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $adminMetaTag = (Auth::user()->user_type == 0) ? 1 : 0;
            $KeyValue = (Auth::user()->user_type == 0) ? 1 : 0;
            $clauseAuthUpdate = (Auth::user()->user_type == 0) ? 1 : 0;
            $animeRead = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 20)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $animeEpisodeRead = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 24)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $animeCalendarRead = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 28)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $webtoonRead = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 32)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $webtoonEpisodeRead = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 36)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $webtoonCalendarRead = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 40)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $pageRead = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 44)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $categoryRead = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 48)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $tagRead = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', 52)->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;

            $authArray = [
                'userRead' => $userRead, 'userGroupRead' => $userGroupRead, 'groupAuthRead' => $groupAuthRead,
                'changeHome' => $changeHome, 'changeLogo' => $changeLogo, 'changeMeta' => $changeMeta, 'changeTitle' => $changeTitle, 'changeMenu' => $changeMenu, 'changeSocialMedia' => $changeSocialMedia,
                'adminMetaTag' => $adminMetaTag, 'KeyValue' => $KeyValue, 'clauseAuthUpdate' => $clauseAuthUpdate,
                'animeRead' => $animeRead, 'animeEpisodeRead' => $animeEpisodeRead, 'animeCalendarRead' => $animeCalendarRead,
                'webtoonRead' => $webtoonRead, 'webtoonEpisodeRead' => $webtoonEpisodeRead, 'webtoonCalendarRead' => $webtoonCalendarRead,
                'pageRead' => $pageRead, 'categoryRead' => $categoryRead, 'tagRead' => $tagRead,
            ];
            //----------------------------------------------------------------

            // Görünüme veriyi gönder
            $view->with(['notificationAdmin' => $notificationAdmin, 'notificationAdminCount' => $notificationAdminCount, 'title' => $title, 'pathName' => $pathName, 'pathRoute' => $pathRoute, 'authArray' => $authArray]);
        });

        //Diğer Sayfalar:

        View::composer($userPages, function ($view) {
            $create = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/user/create'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $list = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/user/list'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $update = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/user/update'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $delete = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/user/delete'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
        });

        View::composer($authGroupPages, function ($view) {
            $create = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/authGroup/create'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $list = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/authGroup/list'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $update = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/authGroup/update'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $delete = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/authGroup/delete'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
        });

        View::composer($authPages, function ($view) {
            $list = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/auth/list'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $update = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/auth/list/change'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $view->with(["list" => $list, "update" => $update]);
        });

        View::composer($dataPages, function ($view) {
            $logo = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/data/logo'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $meta = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/data/meta'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $menu = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/data/menu'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $social = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/data/social'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $title = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/data/title'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $view->with(["logo" => $logo, "meta" => $meta, "menu" => $menu, "social" => $social, 'title' => $title]);
        });

        View::composer($animePages, function ($view) {
            $create = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/anime/create'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $list = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/anime/list'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $update = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/anime/update'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $delete = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/anime/delete'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
        });

        View::composer($animeEpisodePages, function ($view) {
            $create = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/animeEpisodes/create'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $list = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/animeEpisodes/list'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $update = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/animeEpisodes/update'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $delete = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/animeEpisodes/delete'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
        });

        View::composer($animeCalendarPages, function ($view) {
            $create = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/anime/calendar/addEvent'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $list = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/anime/calendar'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $update = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/anime/calendar'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $delete = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/anime/calendar'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
        });

        View::composer($webtoonPages, function ($view) {
            $create = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/webtoon/create'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $list = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/webtoon/list'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $update = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/webtoon/update'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $delete = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/webtoon/delete'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
        });

        View::composer($webtoonEpisodePages, function ($view) {
            $create = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/animeEpisodes/create'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $list = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/animeEpisodes/list'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $update = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/animeEpisodes/update'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $delete = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/animeEpisodes/delete'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
        });

        View::composer($webtoonCalendarPages, function ($view) {
            $create = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/webtoon/calendar/addEvent'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $list = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/webtoon/calendar'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $update = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/webtoon/calendar'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $delete = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/webtoon/calendar'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
        });

        View::composer($pagePages, function ($view) {
            $create = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/page/create'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $list = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/page/list'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $show = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/page/show'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $update = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/page/update'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $delete = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/page/delete'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $view->with(["create" => $create, "list" => $list, "show" => $show, "update" => $update, "delete" => $delete]);
        });

        View::composer($categoryPages, function ($view) {
            $create = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/category/create'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $list = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/category/list'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $update = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/category/update'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $delete = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/category/delete'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
        });

        View::composer($tagPages, function ($view) {
            $create = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/tag/create'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $list = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/tag/list'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $update = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/tag/update'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $delete = ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . 'admin/tag/delete'))->Where('group_id', Auth::user()->user_type)->get()) > 0)) ? 1 : 0;
            $view->with(["create" => $create, "list" => $list, "update" => $update, "delete" => $delete]);
        });

        //----------------------------------------------------
        //Index:

        View::composer($indexPages, function ($view) {

            $logo = KeyValue::Where('key', 'index_logo')->first();
            $logo_footer = KeyValue::Where('key', 'index_logo_footer')->first();

            $index_icon = KeyValue::Where('key', 'index_icon')->first();
            $index_title = KeyValue::Where('key', 'index_title')->first();
            $index_text = KeyValue::Where('key', 'index_text')->first();

            $slider_image = KeyValue::Where('key', 'slider_image')->Where('value', 1)->Where('deleted', 0)->get();

            $meta = KeyValue::Where('key', 'meta')->Where('deleted', 0)->get();
            $admin_meta = KeyValue::Where('key', 'admin_meta')->Where('deleted', 0)->get();

            $social_media = KeyValue::Where('key', 'social_media')->Where('deleted', 0)->get();
            $menus = KeyValue::Where('key', 'menu')->where('optional', 1)->Where('deleted', 0)->get();
            $menu_alts = KeyValue::Where('key', 'menu_alt')->where('optional', 1)->Where('deleted', 0)->get();
            $active_menu = KeyValue::Where('key', 'menu')->Where('optional_2', Request::path())->first();

            $footer_copyright = KeyValue::Where('key', 'footer_copyright')->first();

            $anime_active = KeyValue::Where('key', 'anime_active')->first();
            $webtoon_active = KeyValue::Where('key', 'webtoon_active')->first();

            // Görünüme veriyi gönder
            $view->with('logo', $logo)->with('logo_footer', $logo_footer)->with('index_text', $index_text)->with('footer_copyright', $footer_copyright)->with('social_media', $social_media)->with('menus', $menus)->with('menu_alts', $menu_alts)->with('active_menu', $active_menu)->with('index_icon', $index_icon)->with('index_title', $index_title)->with('meta', $meta)->with('admin_meta', $admin_meta)->with('anime_active', $anime_active)->with('webtoon_active', $webtoon_active)->with('slider_image', $slider_image);
        });
    }
}
