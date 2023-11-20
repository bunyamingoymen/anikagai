<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnimeCalendarController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AnimeEpisodecontroller;
use App\Http\Controllers\AuthClauseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthGroupController;
use App\Http\Controllers\FollowUserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KeyValueController;
use App\Http\Controllers\NotificationAdminController;
use App\Http\Controllers\TemplateAdminController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebtoonCalendarController;
use App\Http\Controllers\WebtoonController;
use App\Http\Controllers\WebtoonEpisodeController;
use App\Models\Template;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/anime/liste', [IndexController::class, 'list'])->name('list');

Route::get('/anime/{anime_name}', [IndexController::class, 'animeDetail'])->name('animeDetail');

Route::get('/anime/{anime_name}/{episode_name}', [IndexController::class, 'watch'])->name('watch');

Route::get('/webtoon/{webtoon_name}', [IndexController::class, 'webtoonDetail'])->name('webtoonDetail');

Route::get('/webtoon/{webtoon_name}/{episode_name}', [IndexController::class, 'read'])->name('read');





Route::group(['middleware' => 'guest'], function () {
    // Oturum açıkken erişilmemesi gereken sayfalar
    Route::get("/admin/login", [AdminController::class, "loginScreen"])->name('admin_login_screen');
    Route::post("/admin/login", [AdminController::class, "login"])->name('admin_login');
    // Diğer sayfalar...
});

Route::middleware(['auth'])->group(function () {
    Route::get("/admin/index", [AdminController::class, "index"])->name('admin_index');
    Route::get("/admin/logout", [AdminController::class, "logout"])->name('admin_logout');

    Route::get("/admin/profile", [AdminController::class, "profile"])->name('admin_profile');

    Route::post("/admin/followUser", [FollowUserController::class, "followUser"])->name('admin_follow_user');
    Route::post("/admin/unfollowUser", [FollowUserController::class, "unfollowUser"])->name('admin_unfollow_user');

    Route::post("/admin/sendMessage", [NotificationAdminController::class, "sendMessage"])->name('admin_send_message');
    Route::post("/admin/readNotification", [NotificationAdminController::class, "readNotification"])->name('admin_read_notification');

    Route::get("/admin/keyValue/list", [KeyValueController::class, "keyValueList"])->name('admin_keyvalue_list');
    Route::post("/admin/keyValue/list/ajax", [KeyValueController::class, "keyValueGetData"])->name('admin_keyvalue_get_data');

    Route::get("/admin/keyValue/create", [KeyValueController::class, "keyValueCreateScreen"])->name('admin_keyvalue_create_screen');
    Route::post("/admin/keyValue/create", [KeyValueController::class, "keyValueCreate"])->name('admin_keyvalue_create');

    Route::get("/admin/keyValue/update", [KeyValueController::class, "keyValueUpdateScreen"])->name('admin_keyvalue_update_screen');
    Route::post("/admin/keyValue/update", [KeyValueController::class, "keyValueUpdate"])->name('admin_keyvalue_update');

    Route::post("/admin/keyValue/delete", [KeyValueController::class, "keyValueDelete"])->name('admin_keyvalue_delete');

    //----------------------------------------------------------------

    Route::get("/admin/user/list", [UserController::class, "userList"])->name('admin_user_list');
    Route::post("/admin/user/list/ajax", [UserController::class, "userGetData"])->name('admin_user_get_data');

    Route::get("/admin/user/create", [UserController::class, "userCreateScreen"])->name('admin_user_create_screen');
    Route::post("/admin/user/create", [UserController::class, "userCreate"])->name('admin_user_create');

    Route::get("/admin/user/update", [UserController::class, "userUpdateScreen"])->name('admin_user_update_screen');
    Route::post("/admin/user/update", [UserController::class, "userUpdate"])->name('admin_user_update');

    Route::post("/admin/user/delete", [UserController::class, "userDelete"])->name('admin_user_delete');

    Route::post("/admin/user/changePassword", [UserController::class, "userChangePassword"])->name('admin_user_change_password');

    //----------------------------------------------------------------

    Route::get("/admin/authClause/list", [AuthClauseController::class, "AuthClauseList"])->name('admin_authclause_list');
    Route::post("/admin/authClause/list/ajax", [AuthClauseController::class, "AuthClauseGetData"])->name('admin_authclause_get_data');

    Route::get("/admin/authClause/create", [AuthClauseController::class, "AuthClauseCreateScreen"])->name('admin_authclause_create_screen');
    Route::post("/admin/authClause/create", [AuthClauseController::class, "AuthClauseCreate"])->name('admin_authclause_create');

    Route::get("/admin/authClause/update", [AuthClauseController::class, "AuthClauseUpdateScreen"])->name('admin_authclause_update_screen');
    Route::post("/admin/authClause/update", [AuthClauseController::class, "AuthClauseUpdate"])->name('admin_authclause_update');

    Route::post("/admin/authClause/delete", [AuthClauseController::class, "AuthClauseDelete"])->name('admin_authclause_delete');

    //----------------------------------------------------------------

    Route::get("/admin/authGroup/list", [AuthGroupController::class, "AuthGroupList"])->name('admin_authgroup_list');
    Route::post("/admin/authGroup/list/ajax", [AuthGroupController::class, "AuthGroupGetData"])->name('admin_authgroup_get_data');

    Route::get("/admin/authGroup/create", [AuthGroupController::class, "AuthGroupCreateScreen"])->name('admin_authgroup_create_screen');
    Route::post("/admin/authGroup/create", [AuthGroupController::class, "AuthGroupCreate"])->name('admin_authgroup_create');

    Route::get("/admin/authGroup/update", [AuthGroupController::class, "AuthGroupUpdateScreen"])->name('admin_authgroup_update_screen');
    Route::post("/admin/authGroup/update", [AuthGroupController::class, "AuthGroupUpdate"])->name('admin_authgroup_update');

    Route::post("/admin/authGroup/delete", [AuthGroupController::class, "AuthGroupDelete"])->name('admin_authgroup_delete');

    //----------------------------------------------------------------

    Route::get("/admin/auth/list", [AuthController::class, "authList"])->name('admin_auth_list');

    Route::post("/admin/auth/list/change", [AuthController::class, "authChange"])->name('admin_auth_change');

    Route::post("/admin/auth/list/getGroup/ajax", [AuthController::class, "AuthGroupGetData"])->name('admin_authgroup_get_data');

    //-------------------------------------------------------------------

    Route::get("/admin/anime/list", [AnimeController::class, "animeList"])->name('admin_anime_list');
    Route::post("/admin/anime/list/ajax", [AnimeController::class, "animeGetData"])->name('admin_anime_get_data');

    Route::get("/admin/anime/create", [AnimeController::class, "animeCreateScreen"])->name('admin_anime_create_screen');
    Route::post("/admin/anime/create", [AnimeController::class, "animeCreate"])->name('admin_anime_create');

    Route::get("/admin/anime/update", [AnimeController::class, "animeUpdateScreen"])->name('admin_anime_update_screen');
    Route::post("/admin/anime/update", [AnimeController::class, "animeUpdate"])->name('admin_anime_update');

    Route::post("/admin/anime/delete", [AnimeController::class, "animeDelete"])->name('admin_anime_delete');

    //----------------------------------------------------------------

    Route::get("/admin/animeEpisodes/list", [AnimeEpisodecontroller::class, "episodeList"])->name('admin_anime_episodes_list');
    Route::post("/admin/animeEpisodes/list/ajax", [AnimeEpisodecontroller::class, "episodeGetData"])->name('admin_anime_episodes_get_data');

    Route::get("/admin/animeEpisodes/create", [AnimeEpisodecontroller::class, "episodeCreateScreen"])->name('admin_anime_episodes_create_screen');
    Route::post("/admin/animeEpisodes/create", [AnimeEpisodecontroller::class, "episodeCreate"])->name('admin_anime_episodes_create'); //Ajax ile cretae yapıyor

    Route::get("/admin/animeEpisodes/update", [AnimeEpisodecontroller::class, "episodeUpdateScreen"])->name('admin_anime_episodes_update_screen');
    Route::post("/admin/animeEpisodes/update", [AnimeEpisodecontroller::class, "epsiodeUpdate"])->name('admin_anime_episodes_update');

    Route::post("/admin/animeEpisodes/delete", [AnimeEpisodecontroller::class, "episodeDelete"])->name('admin_anime_episodes_delete');

    //-------------------------------------------------------------------
    Route::get("/admin/anime/calendar", [AnimeCalendarController::class, "index"])->name('admin_animecalendar_index');

    Route::post("/admin/anime/calendar/addEvent", [AnimeCalendarController::class, "addEvent"])->name('admin_animecalendar_addevent');

    //-------------------------------------------------------------------
    Route::get("/admin/webtoon/list", [WebtoonController::class, "webtoonList"])->name('admin_webtoon_list');
    Route::post("/admin/webtoon/list/ajax", [WebtoonController::class, "webtoonGetData"])->name('admin_webtoon_get_data');

    Route::get("/admin/webtoon/create", [WebtoonController::class, "webtoonCreateScreen"])->name('admin_webtoon_create_screen');
    Route::post("/admin/webtoon/create", [WebtoonController::class, "webtoonCreate"])->name('admin_webtoon_create');

    Route::get("/admin/webtoon/update", [WebtoonController::class, "webtoonUpdateScreen"])->name('admin_webtoon_update_screen');
    Route::post("/admin/webtoon/update", [WebtoonController::class, "webtoonUpdate"])->name('admin_webtoon_update');

    Route::post("/admin/webtoon/delete", [WebtoonController::class, "webtoonDelete"])->name('admin_webtoon_delete');
    //----------------------------------------------------------------
    Route::get("/admin/webtoonEpisodes/list", [WebtoonEpisodeController::class, "episodeList"])->name('admin_webtoon_episodes_list');
    Route::post("/admin/webtoonEpisodes/list/ajax", [WebtoonEpisodeController::class, "episodeGetData"])->name('admin_webtoon_episodes_get_data');

    Route::get("/admin/webtoonEpisodes/create", [WebtoonEpisodeController::class, "episodeCreateScreen"])->name('admin_webtoon_episodes_create_screen');
    Route::post("/admin/webtoonEpisodes/create", [WebtoonEpisodeController::class, "episodeCreate"])->name('admin_webtoon_episodes_create'); //Ajax ile cretae yapıyor

    Route::get("/admin/webtoonEpisodes/update", [WebtoonEpisodeController::class, "episodeUpdateScreen"])->name('admin_webtoon_episodes_update_screen');
    Route::post("/admin/webtoonEpisodes/update", [WebtoonEpisodeController::class, "epsiodeUpdate"])->name('admin_webtoon_episodes_update');

    Route::post("/admin/webtoonEpisodes/delete", [WebtoonEpisodeController::class, "episodeDelete"])->name('admin_webtoon_episodes_delete');
    //-------------------------------------------------------------------
    Route::get("/admin/webtoon/calendar", [WebtoonCalendarController::class, "index"])->name('admin_webtooncalendar_index');

    Route::post("/admin/webtoon/calendar/addEvent", [WebtoonCalendarController::class, "addEvent"])->name('admin_webtooncalendar_addevent');

    Route::get('test', function () {
        dd(phpinfo());
    });
});
