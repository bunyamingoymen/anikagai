<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KeyValueController;
use App\Http\Controllers\TemplateAdminController;
use App\Http\Controllers\UserAdminController;
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
    return view('welcome');
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
});
