<?php

namespace App\Providers;

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
        $indexPages = ['index.layouts.main', 'index.index'];
        $adminPages = ['admin.layouts.main'];
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
            $authArray = [
                'userRead' => 1, 'userGroupRead' => 1, 'groupAuthRead' => 1,
                'changeHome' => 1, 'changeLogo' => 1, 'changeMeta' => 1, 'changeTitle' => 1, 'changeMenu' => 1, 'changeSocialMedia' => 1,
                'adminMetaTag' => 1, 'KeyValue' => 1, 'clauseAuthUpdate' => 1,
                'animeRead' => 1, 'animeEpisodeRead' => 1, 'animeCalendarRead' => 1,
                'webtoonRead' => 1, 'webtoonEpisodeRead' => 1, 'webtoonCalendarRead' => 1,
                'pageRead' => 1, 'categoryRead' => 1, 'tagRead' => 1,
            ];
            //----------------------------------------------------------------

            // Görünüme veriyi gönder
            $view->with('notificationAdmin', $notificationAdmin)->with('notificationAdminCount', $notificationAdminCount)->with('title', $title)->with('pathName', $pathName)->with('pathRoute', $pathRoute)->with('authArray', $authArray);
        });

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
