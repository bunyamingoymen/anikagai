<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FollowUserController;
use App\Http\Controllers\NotificationAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::controller(UserController::class)->group(function () {
    Route::get("/admin/user/update", "userUpdateScreen")->name('admin_user_update_screen');
    Route::post("/admin/user/update",  "userUpdate")->name('admin_user_update');
    Route::post("/admin/user/changePassword", "userChangePassword")->name('admin_user_change_password');
});

Route::middleware(['superuser'])->group(function () {
    require __DIR__.'/auth/superUser.php';
});

Route::middleware(['access'])->group(function () {
    require __DIR__.'/auth/access.php';
});
