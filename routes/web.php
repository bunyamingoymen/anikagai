<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnimeCalendarController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AnimeEpisodecontroller;
use App\Http\Controllers\AuthClauseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthGroupController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\FollowUserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\IndexDataController;
use App\Http\Controllers\KeyValueController;
use App\Http\Controllers\NotificationAdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebtoonCalendarController;
use App\Http\Controllers\WebtoonController;
use App\Http\Controllers\WebtoonEpisodeController;
use Illuminate\Support\Facades\Route;

Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/animeler', 'list')->name('anime_list');
    Route::get('/webtoonlar', 'list')->name('webtoon_list');

    Route::get('/logout', 'logout')->name('logout');
    Route::get('/profile', 'profile')->name('profile');

    Route::post("/control/username/ajax", 'controlUsername')->name('index_control_username');
    Route::post("/control/email/ajax", 'controlEmail')->name('index_control_email');

    Route::get('/contact', 'contactScreen')->name('contact_screen');
    Route::post('/contact', 'contact')->name('contact');
});

Route::group(['middleware' => 'guest_index'], function () {
    // Oturum açıkken erişilmemesi gereken sayfalar
    Route::get('/login', [IndexController::class, "loginScreen"])->name('loginScreen');
    Route::post('/register', [IndexController::class, "register"])->name('register');
    Route::post('/login', [IndexController::class, "login"])->name('login');
});


Route::group(['middleware' => 'click'], function () {
    Route::controller(IndexController::class)->group(function () {
        Route::get('/anime/{short_name}', 'animeDetail')->name('animeDetail');

        Route::get('/anime/{short_name}/{season}/{episode}', 'watch')->name('watch');

        Route::get('/webtoon/{short_name}', 'webtoonDetail')->name('webtoonDetail');

        Route::get('/webtoon/{short_name}/{season}/{episode}', 'read')->name('read');
    });
});

Route::controller(IndexDataController::class)->group(function () {
    Route::post('/followAnime', 'followAnime')->name('followAnime');
    Route::post('/followWebtoon', 'followWebtoon')->name('followWebtoon');
    Route::post('/followUser', 'followUser')->name('followUser');
    Route::post('/unfollowAnime', 'unfollowAnime')->name('unfollowAnime');
    Route::post('/unfollowWebtoon', 'unfollowWebtoon')->name('unfollowWebtoon');
    Route::post('/unfollowUser', 'unfollowUser')->name('unfollowUser');
    Route::post('/likeAnime', 'likeAnime')->name('likeAnime');
    Route::post('/likeWebtoon', 'likeWebtoon')->name('likeWebtoon');
    Route::post('/unlikeAnime', 'unlikeAnime')->name('unlikeAnime');
    Route::post('/unlikeWebtoon', 'unlikeWebtoon')->name('unlikeWebtoon');
});

Route::group(['middleware' => 'guest'], function () {
    // Oturum açıkken erişilmemesi gereken sayfalar
    Route::get("/admin/login", [AdminController::class, "loginScreen"])->name('admin_login_screen');
    Route::post("/admin/login", [AdminController::class, "login"])->name('admin_login');
});

Route::middleware(['auth'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get("/admin/index", "index")->name('admin_index');
        Route::get("/admin/logout", "logout")->name('admin_logout');

        Route::get("/admin/profile", "profile")->name('admin_profile');
    });

    Route::controller(FollowUserController::class)->group(function () {
        Route::post("/admin/followUser", "followUser")->name('admin_follow_user');
        Route::post("/admin/unfollowUser", "unfollowUser")->name('admin_unfollow_user');
    });

    Route::controller(NotificationAdminController::class)->group(function () {
        Route::post("/admin/sendMessage", "sendMessage")->name('admin_send_message');
        Route::post("/admin/readNotification", "readNotification")->name('admin_read_notification');
    });

    Route::post("/admin/user/changePassword", [UserController::class, "userChangePassword"])->name('admin_user_change_password');

    Route::middleware(['superuser'])->group(function () {
        Route::controller(KeyValueController::class)->group(function () {
            Route::get("/admin/keyValue/list", "keyValueList")->name('admin_keyvalue_list');
            Route::post("/admin/keyValue/list/ajax", "keyValueGetData")->name('admin_keyvalue_get_data');

            Route::get("/admin/keyValue/create", "keyValueCreateScreen")->name('admin_keyvalue_create_screen');
            Route::post("/admin/keyValue/create", "keyValueCreate")->name('admin_keyvalue_create');

            Route::get("/admin/keyValue/update", "keyValueUpdateScreen")->name('admin_keyvalue_update_screen');
            Route::post("/admin/keyValue/update", "keyValueUpdate")->name('admin_keyvalue_update');

            Route::post("/admin/keyValue/delete", "keyValueDelete")->name('admin_keyvalue_delete');

            Route::get('/admin/php/test', function () {
                dd(phpinfo());
            });
        });

        Route::controller(AuthClauseController::class)->group(function () {
            Route::get("/admin/authClause/list", "AuthClauseList")->name('admin_authclause_list');
            Route::post("/admin/authClause/list/ajax", "AuthClauseGetData")->name('admin_authclause_get_data');

            Route::get("/admin/authClause/create", "AuthClauseCreateScreen")->name('admin_authclause_create_screen');
            Route::post("/admin/authClause/create", "AuthClauseCreate")->name('admin_authclause_create');

            Route::get("/admin/authClause/update", "AuthClauseUpdateScreen")->name('admin_authclause_update_screen');
            Route::post("/admin/authClause/update", "AuthClauseUpdate")->name('admin_authclause_update');

            Route::post("/admin/authClause/delete", "AuthClauseDelete")->name('admin_authclause_delete');
        });

        Route::get("/admin/data/adminMeta", [DataController::class, "adminMetaList"])->name('admin_data_admin_meta_list');
    });

    Route::middleware(['access'])->group(function () {

        Route::controller(UserController::class)->group(function () {
            Route::get("/admin/user/list", "userList")->name('admin_user_list');
            Route::post("/admin/user/list/ajax", "userGetData")->name('admin_user_get_data');

            Route::get("/admin/user/create", "userCreateScreen")->name('admin_user_create_screen');
            Route::post("/admin/user/create", "userCreate")->name('admin_user_create');

            Route::get("/admin/user/update", "userUpdateScreen")->name('admin_user_update_screen');
            Route::post("/admin/user/update", "userUpdate")->name('admin_user_update');

            Route::post("/admin/user/delete", "userDelete")->name('admin_user_delete');
        });

        Route::controller(AuthGroupController::class)->group(function () {
            Route::get("/admin/authGroup/list", "AuthGroupList")->name('admin_authgroup_list');
            Route::post("/admin/authGroup/list/ajax", "AuthGroupGetData")->name('admin_authgroup_get_data');

            Route::get("/admin/authGroup/create", "AuthGroupCreateScreen")->name('admin_authgroup_create_screen');
            Route::post("/admin/authGroup/create", "AuthGroupCreate")->name('admin_authgroup_create');

            Route::get("/admin/authGroup/update", "AuthGroupUpdateScreen")->name('admin_authgroup_update_screen');
            Route::post("/admin/authGroup/update", "AuthGroupUpdate")->name('admin_authgroup_update');

            Route::post("/admin/authGroup/delete", "AuthGroupDelete")->name('admin_authgroup_delete');
        });

        Route::controller(AuthController::class)->group(function () {
            Route::get("/admin/auth/list", "authList")->name('admin_auth_list');

            Route::post("/admin/auth/list/change", "authChange")->name('admin_auth_change');

            Route::post("/admin/auth/list/getGroup/ajax", "AuthGroupGetData")->name('admin_authgroup_get_data');
        });

        Route::controller(DataController::class)->group(function () {
            Route::get("/admin/data/home", "homeList")->name('admin_data_home_list');
            Route::post("/admin/data/home", "homeChange")->name('admin_data_home');
            Route::post("/admin/data/home/showContent", "showContent")->name('admin_data_show_content');

            Route::get("/admin/data/logo", "logoList")->name('admin_data_logo_list');
            Route::post("/admin/data/logo", "logoChange")->name('admin_data_logo');

            Route::get("/admin/data/menu", "menuList")->name('admin_data_menu_list');
            Route::post("/admin/data/menu/add", "menuAdd")->name('admin_data_menu_add');
            Route::post("/admin/data/menu/update", "menuUpdate")->name('admin_data_menu_update');
            Route::post("/admin/data/menu/delete", "menuDelete")->name('admin_data_menu_delete');


            Route::get("/admin/data/meta", "metaList")->name('admin_data_meta_list');
            Route::post("/admin/data/meta/add", "metaAdd")->name('admin_data_meta_add');
            Route::post("/admin/data/meta/update", "metaUpdate")->name('admin_data_meta_update');
            Route::post("/admin/data/meta/delete", "metaDelete")->name('admin_data_meta_delete');

            Route::get("/admin/data/social", "socialList")->name('admin_data_social_list');
            Route::post("/admin/data/social/add", "socialAdd")->name('admin_data_social_add');
            Route::post("/admin/data/social/update", "socialUpdate")->name('admin_data_social_update');
            Route::post("/admin/data/social/delete", "socialDelete")->name('admin_data_social_delete');

            Route::get("/admin/data/title", "titleList")->name('admin_data_title_list');
            Route::post("/admin/data/title", "titleChange")->name('admin_data_title');
        });

        Route::controller(AnimeController::class)->group(function () {
            Route::get("/admin/anime/list", "animeList")->name('admin_anime_list');
            Route::post("/admin/anime/list/ajax", "animeGetData")->name('admin_anime_get_data');

            Route::post("/admin/anime/season/ajax", "animeGetSeason")->name('admin_anime_get_season');

            Route::get("/admin/anime/create", "animeCreateScreen")->name('admin_anime_create_screen');
            Route::post("/admin/anime/create", "animeCreate")->name('admin_anime_create');

            Route::get("/admin/anime/update", "animeUpdateScreen")->name('admin_anime_update_screen');
            Route::post("/admin/anime/update", "animeUpdate")->name('admin_anime_update');

            Route::post("/admin/anime/delete", "animeDelete")->name('admin_anime_delete');
        });

        Route::controller(AnimeEpisodecontroller::class)->group(function () {
            Route::get("/admin/animeEpisodes/list", "episodeList")->name('admin_anime_episodes_list');
            Route::post("/admin/animeEpisodes/list/ajax", "episodeGetData")->name('admin_anime_episodes_get_data');

            Route::get("/admin/animeEpisodes/create", "episodeCreateScreen")->name('admin_anime_episodes_create_screen');
            Route::post("/admin/animeEpisodes/create", "episodeCreate")->name('admin_anime_episodes_create'); //Ajax ile cretae yapıyor

            Route::get("/admin/animeEpisodes/update", "episodeUpdateScreen")->name('admin_anime_episodes_update_screen');
            Route::post("/admin/animeEpisodes/update", "epsiodeUpdate")->name('admin_anime_episodes_update');

            Route::post("/admin/animeEpisodes/delete", "episodeDelete")->name('admin_anime_episodes_delete');
        });

        Route::controller(AnimeCalendarController::class)->group(function () {
            Route::get("/admin/anime/calendar", "index")->name('admin_animecalendar_index');

            Route::post("/admin/anime/calendar/addEvent", "addEvent")->name('admin_animecalendar_addevent');
        });

        Route::controller(WebtoonController::class)->group(function () {
            Route::get("/admin/webtoon/list", "webtoonList")->name('admin_webtoon_list');
            Route::post("/admin/webtoon/list/ajax", "webtoonGetData")->name('admin_webtoon_get_data');

            Route::get("/admin/webtoon/create", "webtoonCreateScreen")->name('admin_webtoon_create_screen');
            Route::post("/admin/webtoon/create", "webtoonCreate")->name('admin_webtoon_create');

            Route::get("/admin/webtoon/update", "webtoonUpdateScreen")->name('admin_webtoon_update_screen');
            Route::post("/admin/webtoon/update", "webtoonUpdate")->name('admin_webtoon_update');

            Route::post("/admin/webtoon/delete", "webtoonDelete")->name('admin_webtoon_delete');
        });

        Route::controller(WebtoonEpisodeController::class)->group(function () {
            Route::get("/admin/webtoonEpisodes/list", "episodeList")->name('admin_webtoon_episodes_list');
            Route::post("/admin/webtoonEpisodes/list/ajax", "episodeGetData")->name('admin_webtoon_episodes_get_data');

            Route::get("/admin/webtoonEpisodes/create", "episodeCreateScreen")->name('admin_webtoon_episodes_create_screen');
            Route::post("/admin/webtoonEpisodes/create", "episodeCreate")->name('admin_webtoon_episodes_create'); //Ajax ile cretae yapıyor

            Route::get("/admin/webtoonEpisodes/update", "episodeUpdateScreen")->name('admin_webtoon_episodes_update_screen');
            Route::post("/admin/webtoonEpisodes/update", "epsiodeUpdate")->name('admin_webtoon_episodes_update');

            Route::post("/admin/webtoonEpisodes/delete", "episodeDelete")->name('admin_webtoon_episodes_delete');
        });

        Route::controller(WebtoonCalendarController::class)->group(function () {
            Route::get("/admin/webtoon/calendar", "index")->name('admin_webtooncalendar_index');

            Route::post("/admin/webtoon/calendar/addEvent", "addEvent")->name('admin_webtooncalendar_addevent');
        });

        Route::controller(PageController::class)->group(function () {
            Route::get("/admin/page/list", "pageList")->name('admin_page_list');
            Route::post("/admin/page/list/ajax", "pageGetData")->name('admin_page_get_data');

            Route::get("/admin/page/show", "pageShow")->name('admin_page_show');

            Route::get("/admin/page/create", "pageCreateScreen")->name('admin_page_create_screen');
            Route::post("/admin/page/create", "pageCreate")->name('admin_page_create'); //Ajax ile cretae yapıyor

            Route::get("/admin/page/update", "pageUpdateScreen")->name('admin_page_update_screen');
            Route::post("/admin/page/update", "pageUpdate")->name('admin_page_update');

            Route::post("/admin/page/delete", "pageDelete")->name('admin_page_delete');
        });

        Route::controller(CategoryController::class)->group(function () {
            Route::get("/admin/category/list", "categoryList")->name('admin_category_list');
            Route::post("/admin/category/list/ajax", "categoryGetData")->name('admin_category_get_data');

            Route::get("/admin/category/create", "categoryCreateScreen")->name('admin_category_create_screen');
            Route::post("/admin/category/create", "categoryCreate")->name('admin_category_create');

            Route::get("/admin/category/update", "categoryUpdateScreen")->name('admin_category_update_screen');
            Route::post("/admin/category/update", "categoryUpdate")->name('admin_category_update');

            Route::post("/admin/category/delete", "categoryDelete")->name('admin_category_delete');
        });

        Route::controller(TagController::class)->group(function () {
            Route::get("/admin/tag/list", "tagList")->name('admin_tag_list');
            Route::post("/admin/tag/list/ajax", "tagCreateScreen")->name('admin_tag_get_data');

            Route::get("/admin/tag/create",  "tagCreateScreen")->name('admin_tag_create_screen');
            Route::post("/admin/tag/create", "tagCreate")->name('admin_tag_create');

            Route::get("/admin/tag/update", "tagUpdateScreen")->name('admin_tag_update_screen');
            Route::post("/admin/tag/update", "tagUpdate")->name('admin_tag_update');

            Route::post("/admin/tag/delete", "tagDelete")->name('admin_tag_delete');
        });
    });
});
