<?php

namespace App\Providers;

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
            $yourData = "Deneme"; // Burada veritabanından veriyi çekebilirsiniz;

            // Görünüme veriyi gönder
            $view->with('yourData', $yourData);
        });
    }
}
