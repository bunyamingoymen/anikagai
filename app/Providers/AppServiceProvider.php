<?php

namespace App\Providers;

use App\Models\NotificationAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        $adminPages = ['admin.layouts.main'];
        View::composer($adminPages, function ($view) {
            //$notificationAdmin = NotificationAdmin::Where('deleted', 0)->Where('readed', 0)->Where('to_user_code', Auth::user()->code)->get(); // Burada veritabanından veriyi çekebilirsiniz;
            $notificationAdmin = DB::table('notification_admins')
                ->Where('notification_admins.deleted', 0)
                ->Where('notification_admins.readed', 0)
                ->Where('notification_admins.to_user_code', Auth::user()->code)
                ->join('users', 'users.code', '=', 'notification_admins.from_user_code')
                ->select('notification_admins.*', 'users.name as from_user_name', 'users.surname as from_user_surname')
                ->get();
            $notificationAdminCount = count($notificationAdmin);
            // Görünüme veriyi gönder
            $view->with('notificationAdmin', $notificationAdmin)->with('notificationAdminCount', $notificationAdminCount);
        });
    }
}
