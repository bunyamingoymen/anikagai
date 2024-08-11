<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\KeyValueController;
use App\Http\Controllers\AuthClauseController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::controller(KeyValueController::class)->group(function () {
    Route::get("/admin/keyValue/list", "keyValueList")->name('admin_keyvalue_list');
    Route::post("/admin/keyValue/list/ajax", "keyValueGetData")->name('admin_keyvalue_get_data');

    Route::get("/admin/keyValue/create", "keyValueCreateScreen")->name('admin_keyvalue_create_screen');
    Route::post("/admin/keyValue/create", "keyValueCreate")->name('admin_keyvalue_create');

    Route::get("/admin/keyValue/update", "keyValueUpdateScreen")->name('admin_keyvalue_update_screen');
    Route::post("/admin/keyValue/update", "keyValueUpdate")->name('admin_keyvalue_update');

    Route::post("/admin/keyValue/delete", "keyValueDelete")->name('admin_keyvalue_delete');
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

Route::controller(DataController::class)->group(function () {
    Route::get("/admin/data/adminMeta", "adminMetaList")->name('admin_data_admin_meta_list');
});

Route::get('/admin/php/test', function () {
    dd(phpinfo());
});

Route::get('/admin/php_artisan/{command}', function ($command) {
    if (app()->environment('production')) {
        abort(403, 'Bu işlem üretim ortamında çalıştırılamaz.');
    }

    try {
        Artisan::call($command);
        return Artisan::output();
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});
