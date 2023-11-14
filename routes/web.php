<?php

use App\Http\Controllers\AdminController;
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
});
