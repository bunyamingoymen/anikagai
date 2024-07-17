<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnimeCalendarController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AnimeEpisodecontroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthGroupController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\IndexUserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebtoonCalendarController;
use App\Http\Controllers\WebtoonController;
use App\Http\Controllers\WebtoonEpisodeController;
use Illuminate\Support\Facades\Route;


Route::controller(AdminController::class)->group(function () {
    Route::get("/admin/contact", "contactScreen")->name('admin_contact_screen');
    Route::post("/admin/contact/ajax", "contactGetData")->name('admin_contact_get_data');
    Route::post("/admin/contact/delete", "contactDelete")->name('admin_contact_delete');
    Route::post("/admin/contact/answer", "contactAnswer")->name('admin_contact_answer');

    Route::get("/admin/comment", "commentScreen")->name('admin_comment_screen');
    Route::post("/admin/comment/ajax", "commentGetData")->name('admin_comment_get_data');
    Route::post("/admin/comment/delete", "commentDelete")->name('admin_comment_delete');

    Route::get("/admin/comment/pinned", "commentPinned")->name('admin_comment_pinned');

    Route::get("/admin/comment/active", "adminCommentchangeActive")->name('admin_comment_change_active');
});

Route::controller(UserController::class)->group(function () {
    Route::get("/admin/user/list", "userList")->name('admin_user_list');
    Route::post("/admin/user/list/ajax", "userGetData")->name('admin_user_get_data');

    Route::get("/admin/user/create", "userCreateScreen")->name('admin_user_create_screen');
    Route::post("/admin/user/create", "userCreate")->name('admin_user_create');

    Route::post("/admin/user/delete", "userDelete")->name('admin_user_delete');
});

Route::controller(IndexUserController::class)->group(function () {
    Route::get("/admin/indexUser/list", "indexUserList")->name('admin_indexuser_list');
    Route::post("/admin/indexUser/list/ajax", "indexUserGetData")->name('admin_indexuser_get_data');

    Route::get("/admin/indexUser/create", "indexUserCreateScreen")->name('admin_indexuser_create_screen');
    Route::post("/admin/indexUser/create", "indexUserCreate")->name('admin_indexuser_create');

    Route::get("/admin/indexUser/update", "indexUserUpdateScreen")->name('admin_indexuser_update_screen');
    Route::post("/admin/indexUser/update", "indexUserUpdate")->name('admin_indexuser_update');

    Route::get("/admin/indexUser/active", "indexUserchangeActive")->name('admin_indexuser_change_active');

    Route::post("/admin/indexUser/delete", "indexUserDelete")->name('admin_indexuser_delete');
});

Route::controller(AuthGroupController::class)->group(function () {
    Route::get("/admin/authGroup/list", "AuthGroupList")->name('admin_authgroup_list');
    Route::post("/admin/authGroup/list/ajax", "AuthGroupGetData")->name('admin_authgroup_get_all_data');

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
    Route::post("/admin/data/home/changeThemeSettings", "changeThemeSettings")->name('admin_data_change_theme_settings');
    Route::post("/admin/data/home/changeSliderImages", "changeSliderImages")->name('admin_data_change_slider_images');
    Route::post("/admin/data/home/deleteSliderImages", "deleteSliderImages")->name('admin_data_delete_slider_images');
    Route::post("/admin/data/home/addSliderImages", "addSliderImages")->name('admin_data_add_slider_images');

    Route::get("/admin/data/theme", "themeList")->name('admin_data_theme_list');
    Route::post("/admin/data/changeThemeColor", "changeThemeColor")->name('admin_data_change_theme_color');

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

    Route::get("/admin/data/sliderVideo", "sliderVideoScreen")->name('admin_data_slider_video_list');
    Route::post("/admin/data/sliderVideo/ajax", "changeSliderVideo")->name('admin_data_slider_video');
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

    Route::post("/admin/animeEpisodes/epsiodeCreateJustEpiosde", "epsiodeCreateJustEpiosde")->name('admin_anime_just_episode_create');
    Route::post("/admin/animeEpisodes/epsiodeCreateVideoMerge", "epsiodeCreateVideoMerge")->name('admin_anime_merge_video_create');
    Route::post("/admin/animeEpisodes/create", "episodeCreate")->name('admin_anime_episodes_create'); //Ajax ile cretae yapıyor

    Route::get("/admin/animeEpisodes/createURL", "episodeCreateURLScreen")->name('admin_anime_episodes_create_url_screen');
    Route::post("/admin/animeEpisodes/createURL", "episodeCreateURL")->name('admin_anime_episodes_create_url');

    Route::get("/admin/animeEpisodes/update", "episodeUpdateScreen")->name('admin_anime_episodes_update_screen');
    Route::post("/admin/animeEpisodes/update", "epsiodeUpdate")->name('admin_anime_episodes_update');

    Route::post("/admin/animeEpisodes/delete", "episodeDelete")->name('admin_anime_episodes_delete');
});

Route::controller(AnimeCalendarController::class)->group(function () {
    Route::get("/admin/anime/calendar", "index")->name('admin_animecalendar_index');

    Route::post("/admin/anime/calendar/ajax", "getAnimeCalendar")->name('admin_animecalendar_get_anime_calendar');

    Route::post("/admin/anime/calendar/addEvent", "addEvent")->name('admin_animecalendar_addevent');

    Route::post("/admin/anime/calendar/changeEvent", "changeEvent")->name('admin_animecalendar_changeEvent');

    Route::get("/admin/anime/calendar/deleteEvent", "deleteEvent")->name('admin_animecalendar_deleteEvent');
});

Route::controller(WebtoonController::class)->group(function () {
    Route::get("/admin/webtoon/list", "webtoonList")->name('admin_webtoon_list');
    Route::post("/admin/webtoon/list/ajax", "webtoonGetData")->name('admin_webtoon_get_data');

    Route::post("/admin/webtoon/season/ajax", "webtoonGetSeason")->name('admin_webtoon_get_season');

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

    Route::post("/admin/webtoon/calendar/ajax", "getWebtoonCalendar")->name('admin_webtooncalendar_get_webtoon_calendar');

    Route::post("/admin/webtoon/calendar/addEvent", "addEvent")->name('admin_webtooncalendar_addevent');

    Route::post("/admin/webtoon/calendar/changeEvent", "changeEvent")->name('admin_webtooncalendar_changeEvent');

    Route::get("/admin/webtoon/calendar/deleteEvent", "deleteEvent")->name('admin_webtooncalendar_deleteEvent');
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
    Route::post("/admin/tag/list/ajax", "tagGetData")->name('admin_tag_get_data');

    Route::get("/admin/tag/create",  "tagCreateScreen")->name('admin_tag_create_screen');
    Route::post("/admin/tag/create", "tagCreate")->name('admin_tag_create');

    Route::get("/admin/tag/update", "tagUpdateScreen")->name('admin_tag_update_screen');
    Route::post("/admin/tag/update", "tagUpdate")->name('admin_tag_update');

    Route::post("/admin/tag/delete", "tagDelete")->name('admin_tag_delete');
});

Route::controller(NotificationController::class)->group(function () {
    Route::get("/admin/notification/list", "showNotifications")->name('admin_show_notifications');
    Route::post("/admin/notification/list/ajax", "notificationGetData")->name('admin_notification_get_data');

    Route::get("/admin/notification/create", "addNotificationsScreen")->name('admin_add_notifications_screen');
    Route::post("/admin/notification/create", "addNotifications")->name('admin_add_notifications');

    Route::post("/admin/notification/delete", "deleteNotification")->name('admin_delete_notifications');
});
