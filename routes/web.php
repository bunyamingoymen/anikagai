<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnimeCalendarController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AuthClauseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthGroupController;
use App\Http\Controllers\KeyValueController;
use App\Http\Controllers\TemplateAdminController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebtoonCalendarController;
use App\Http\Controllers\WebtoonController;
use App\Models\Template;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index.index');
});




Route::get("/admin/login", [AdminController::class, "loginScreen"])->name('admin_login_screen');
Route::post("/admin/login", [AdminController::class, "login"])->name('admin_login');

Route::middleware(['auth'])->group(function () {
    Route::get("/admin/index", [AdminController::class, "index"])->name('admin_index');
    Route::get("/admin/logout", [AdminController::class, "logout"])->name('admin_logout');

    Route::get("/keyValue/list", [KeyValueController::class, "keyValueList"])->name('admin_keyvalue_list');
    Route::post("/keyValue/list/ajax", [KeyValueController::class, "keyValueGetData"])->name('admin_keyvalue_get_data');

    Route::get("/keyValue/create", [KeyValueController::class, "keyValueCreateScreen"])->name('admin_keyvalue_create_screen');
    Route::post("/keyValue/create", [KeyValueController::class, "keyValueCreate"])->name('admin_keyvalue_create');

    Route::get("/keyValue/update", [KeyValueController::class, "keyValueUpdateScreen"])->name('admin_keyvalue_update_screen');
    Route::post("/keyValue/update", [KeyValueController::class, "keyValueUpdate"])->name('admin_keyvalue_update');

    Route::post("/keyValue/delete", [KeyValueController::class, "keyValueDelete"])->name('admin_keyvalue_delete');

    //----------------------------------------------------------------

    Route::get("/user/list", [UserController::class, "userList"])->name('admin_user_list');
    Route::post("/user/list/ajax", [UserController::class, "userGetData"])->name('admin_user_get_data');

    Route::get("/user/create", [UserController::class, "userCreateScreen"])->name('admin_user_create_screen');
    Route::post("/user/create", [UserController::class, "userCreate"])->name('admin_user_create');

    Route::get("/user/update", [UserController::class, "userUpdateScreen"])->name('admin_user_update_screen');
    Route::post("/user/update", [UserController::class, "userUpdate"])->name('admin_user_update');

    Route::post("/user/delete", [UserController::class, "userDelete"])->name('admin_user_delete');

    Route::post("/user/changePassword", [UserController::class, "userChangePassword"])->name('admin_user_change_password');

    //----------------------------------------------------------------

    Route::get("/authClause/list", [AuthClauseController::class, "AuthClauseList"])->name('admin_authclause_list');
    Route::post("/authClause/list/ajax", [AuthClauseController::class, "AuthClauseGetData"])->name('admin_authclause_get_data');

    Route::get("/authClause/create", [AuthClauseController::class, "AuthClauseCreateScreen"])->name('admin_authclause_create_screen');
    Route::post("/authClause/create", [AuthClauseController::class, "AuthClauseCreate"])->name('admin_authclause_create');

    Route::get("/authClause/update", [AuthClauseController::class, "AuthClauseUpdateScreen"])->name('admin_authclause_update_screen');
    Route::post("/authClause/update", [AuthClauseController::class, "AuthClauseUpdate"])->name('admin_authclause_update');

    Route::post("/authClause/delete", [AuthClauseController::class, "AuthClauseDelete"])->name('admin_authclause_delete');

    //----------------------------------------------------------------

    Route::get("/authGroup/list", [AuthGroupController::class, "AuthGroupList"])->name('admin_authgroup_list');
    Route::post("/authGroup/list/ajax", [AuthGroupController::class, "AuthGroupGetData"])->name('admin_authgroup_get_data');

    Route::get("/authGroup/create", [AuthGroupController::class, "AuthGroupCreateScreen"])->name('admin_authgroup_create_screen');
    Route::post("/authGroup/create", [AuthGroupController::class, "AuthGroupCreate"])->name('admin_authgroup_create');

    Route::get("/authGroup/update", [AuthGroupController::class, "AuthGroupUpdateScreen"])->name('admin_authgroup_update_screen');
    Route::post("/authGroup/update", [AuthGroupController::class, "AuthGroupUpdate"])->name('admin_authgroup_update');

    Route::post("/authGroup/delete", [AuthGroupController::class, "AuthGroupDelete"])->name('admin_authgroup_delete');

    //----------------------------------------------------------------

    Route::get("/auth/list", [AuthController::class, "authList"])->name('admin_auth_list');

    Route::post("/auth/list/change", [AuthController::class, "authChange"])->name('admin_auth_change');

    Route::post("/auth/list/getGroup/ajax", [AuthController::class, "AuthGroupGetData"])->name('admin_authgroup_get_data');

    //-------------------------------------------------------------------

    Route::get("/anime/list", [AnimeController::class, "animeList"])->name('admin_anime_list');
    Route::post("/anime/list/ajax", [AnimeController::class, "animeGetData"])->name('admin_anime_get_data');

    Route::get("/anime/create", [AnimeController::class, "animeCreateScreen"])->name('admin_anime_create_screen');
    Route::post("/anime/create", [AnimeController::class, "animeCreate"])->name('admin_anime_create');

    Route::get("/anime/update", [AnimeController::class, "animeUpdateScreen"])->name('admin_anime_update_screen');
    Route::post("/anime/update", [AnimeController::class, "animeUpdate"])->name('admin_anime_update');

    Route::post("/anime/delete", [AnimeController::class, "animeDelete"])->name('admin_anime_delete');

    //-------------------------------------------------------------------
    Route::get("/anime/calendar", [AnimeCalendarController::class, "index"])->name('admin_animecalendar_index');

    Route::post("/anime/calendar/addEvent", [AnimeCalendarController::class, "addEvent"])->name('admin_animecalendar_addevent');

    //-------------------------------------------------------------------
    Route::get("/webtoon/list", [WebtoonController::class, "webtoonList"])->name('admin_webtoon_list');
    Route::post("/webtoon/list/ajax", [WebtoonController::class, "webtoonGetData"])->name('admin_webtoon_get_data');

    Route::get("/webtoon/create", [WebtoonController::class, "webtoonCreateScreen"])->name('admin_webtoon_create_screen');
    Route::post("/webtoon/create", [WebtoonController::class, "webtoonCreate"])->name('admin_webtoon_create');

    Route::get("/webtoon/update", [WebtoonController::class, "webtoonUpdateScreen"])->name('admin_webtoon_update_screen');
    Route::post("/webtoon/update", [WebtoonController::class, "webtoonUpdate"])->name('admin_webtoon_update');

    Route::post("/webtoon/delete", [WebtoonController::class, "webtoonDelete"])->name('admin_webtoon_delete');

    //-------------------------------------------------------------------
    Route::get("/webtoon/calendar", [WebtoonCalendarController::class, "index"])->name('admin_webtooncalendar_index');

    Route::post("/webtoon/calendar/addEvent", [WebtoonCalendarController::class, "addEvent"])->name('admin_webtooncalendar_addevent');
});
