<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\IndexDataController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RssController;
use App\Http\Controllers\Shop\Index\ShopIndexController;
use App\Http\Controllers\Shop\Index\ShopUserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'is_active_index_user'], function () {

    Route::controller(IndexController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/animeler', 'list')->name('anime_list');
        Route::get('/webtoonlar', 'list')->name('webtoon_list');
        Route::get('/calendar', 'calendar')->name('calendar');
        Route::get('/animeCalendar', 'calendar')->name('anime_calendar');
        Route::get('/webtoonCalendar', 'calendar')->name('anime_calendar');


        Route::post("/control/username/ajax", 'controlUsername')->name('index_control_username');
        Route::post("/control/email/ajax", 'controlEmail')->name('index_control_email');

        Route::post("/control/watchedAnime/ajax", 'watchedAnime')->name('index_watched_anime');

        Route::get('/contact', 'contactScreen')->name('contact_screen');
        Route::post('/contact', 'contact')->name('contact');

        Route::get('/p/{short_name}', 'showPage')->name('showPage');

        Route::get('/search', 'search')->name('search');

        Route::get('/fetchVideo', 'fetchVideo');

        Route::get('/forgotPassword', 'forgotPassword')->name('forgotPassword');
    });

    Route::group(['middleware' => 'index_user'], function () {
        //oturum kapalıyken girilmemesi gereken sayfalar
        Route::controller(IndexController::class)->group(function () {

            Route::get('/profile', "profile")->name('profile');
            Route::get('/changeProfile', "changeProfileSettingsScreen")->name('change_profile_settings_screen');
            Route::post('/changeProfile', "changeProfileSettings")->name('change_profile_settings');
            Route::post('/changeProfileImage', "changeProfileImage")->name('change_profile_image');

            Route::get('/changeProfilePassword',  "changeProfilePasswordScreen")->name('change_profile_password_screen');
            Route::post('/changeProfilePassword', "changeProfilePassword")->name('change_profile_password');


            Route::post('/addNewComment', 'addNewComment')->name('addNewComment');
            Route::post('/deleteComment', 'deleteComment')->name('deleteComment');

            Route::get('/allNotifications',  "showNotifications")->name('all_notifications');

            Route::get('/logout', 'logout')->name('logout');
        });

        Route::controller(IndexDataController::class)->group(function () {
            Route::post('/followAnime', 'followAnime')->name('followAnime');
            Route::post('/followWebtoon', 'followWebtoon')->name('followWebtoon');
            Route::post('/followUser', 'followUser')->name('followUser');
            Route::post('/unfollowAnime', 'unfollowAnime')->name('unfollowAnime');
            Route::post('/unfollowWebtoon', 'unfollowWebtoon')->name('unfollowWebtoon');
            Route::post('/likeAnime', 'likeAnime')->name('likeAnime');
            Route::post('/likeWebtoon', 'likeWebtoon')->name('likeWebtoon');
            Route::post('/unlikeAnime', 'unlikeAnime')->name('unlikeAnime');
            Route::post('/unlikeWebtoon', 'unlikeWebtoon')->name('unlikeWebtoon');
            Route::post('/scoreUser', 'scoreUser')->name('scoreUser');

            Route::post('/followUser', 'followIndexUser')->name('followIndexUser');
            Route::post('/unfollowUser', 'unfollowIndexUser')->name('unfollowIndexUser');

            Route::post('/likeComment', 'likeComment')->name('likeComment');
            Route::post('/likeRecallComment', 'likeRecallComment')->name('likeRecallComment');
        });

        Route::controller(NotificationController::class)->group(function () {
            Route::get('/readNotification', 'readNotification')->name('read_notification');
            Route::get('/allReadNotification', 'allReadNotification')->name('all_read_notification');
        });
    });
});

Route::group(['middleware' => 'guest_index'], function () {
    // Oturum açıkken erişilmemesi gereken sayfalar
    Route::controller(IndexController::class)->group(function () {
        Route::get('/login', "loginScreen")->name('loginScreen');
        Route::post('/register', "register")->name('register');
        Route::post('/login', "login")->name('login');
    });
});

Route::group(['middleware' => 'click'], function () {
    Route::controller(IndexController::class)->group(function () {
        Route::get('/anime/{short_name}', 'animeDetail')->name('animeDetail');

        Route::get('/anime/{short_name}/{season}/{episode}', 'watch')->name('watch');

        Route::get('/webtoon/{short_name}', 'webtoonDetail')->name('webtoonDetail');

        Route::get('/webtoon/{short_name}/{season}/{episode}', 'read')->name('read');
    });
});

Route::group(['middleware' => 'guest'], function () {
    // Oturum açıkken erişilmemesi gereken sayfalar
    Route::controller(AdminController::class)->group(function () {
        Route::get("/admin/login",  "loginScreen")->name('admin_login_screen');
        Route::post("/admin/login", "login")->name('admin_login');
    });
});

Route::middleware(['auth'])->group(function () {
    require __DIR__ . '/routes/auth.php';
});


Route::get('/feed', [RssController::class, "getRSS"])->name('getRSS');
Route::get('/adultOn', [Controller::class, "adultOn"])->name('adultOn');



Route::get('/shop', [ShopIndexController::class, "index"])->name('shop_index');
Route::get('/shop/list/{category_url?}', [ShopIndexController::class, "list"])->name('shop_list');

Route::get('/shop/detail/{code?}', [ShopIndexController::class, "detail"])->name('shop_product_detail');

Route::group(['middleware' => 'guest_shop'], function () {
    Route::get('/shop/login', [ShopIndexController::class, "login"])->name('shop_login');

    Route::post('/shop/user/login', [ShopUserController::class, "login"])->name('shop_user_login');

    Route::post('/shop/user/register', [ShopUserController::class, "register"])->name('shop_user_register');
});

Route::group(['middleware' => 'access_shop'], function () {
    Route::get('/shop/user/logout', [ShopUserController::class, "logout"])->name('shop_user_logout');

    Route::get('/shop/addWhislist', [ShopIndexController::class, "addWhislist"])->name('shop_add_whislist');
    Route::get('/shop/addCart', [ShopIndexController::class, "addCart"])->name('shop_add_cart');
});
