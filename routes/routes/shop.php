<?php

use App\Http\Controllers\Shop\Index\ShopIndexController;
use App\Http\Controllers\Shop\Index\ShopSellerController;
use App\Http\Controllers\Shop\Index\ShopUserController;
use Illuminate\Support\Facades\Route;

Route::get('/shop', [ShopIndexController::class, "index"])->name('shop_index');
Route::get('/shop/list/{category_url?}', [ShopIndexController::class, "list"])->name('shop_list');
Route::get('/shop/detail/{code?}', [ShopIndexController::class, "detail"])->name('shop_product_detail');

//Hem satıcı hem de normal kullanıcı giriş yapmışsa girmemesi gereken sayfalar
Route::group(['middleware' => ['guest_shop', 'guest_shop_seller']], function () {
    Route::get('/shop/login', [ShopIndexController::class, "login"])->name('shop_login');
});


//Normal Kullanıcı Linkleri
Route::group(['middleware' => 'guest_shop'], function () {

    Route::post('/shop/user/login', [ShopUserController::class, "login"])->name('shop_user_login');

    Route::post('/shop/user/register', [ShopUserController::class, "register"])->name('shop_user_register');
});

Route::group(['middleware' => 'access_shop'], function () {
    Route::get('/shop/user/logout', [ShopUserController::class, "logout"])->name('shop_user_logout');
    Route::get('/shop/user/profile', [ShopUserController::class, "profile"])->name('shop_user_profile');

    Route::post('/shop/user/changeUserInformation', [ShopUserController::class, "changeUserInformation"])->name('shop_user_change_user_information');

    Route::post('/shop/user/changePassword', [ShopUserController::class, "changePassword"])->name('shop_user_change_password');

    Route::post('/shop/user/editAddress', [ShopUserController::class, "editAddress"])->name('shop_user_edit_address');

    Route::get('/shop/whislist', [ShopIndexController::class, "whislist"])->name('shop_whislist');

    Route::get('/shop/sepet', [ShopIndexController::class, "cart"])->name('shop_cart');

    Route::get('/shop/addWhislist', [ShopIndexController::class, "addWhislist"])->name('shop_add_whislist');
    Route::get('/shop/addCart', [ShopIndexController::class, "addCart"])->name('shop_add_cart');
});


//Satıcı Linkleri
Route::group(['middleware' => 'guest_shop_seller'], function () {

    Route::post('/shop/seller/login', [ShopSellerController::class, "login"])->name('shop_seller_login');

    Route::post('/shop/seller/register', [ShopSellerController::class, "register"])->name('shop_seller_register');
});

Route::group(['middleware' => 'access_shop_seller'], function () {
    Route::get('/shop/seller/logout', [ShopSellerController::class, "logout"])->name('shop_seller_logout');

    Route::get('/shop/seller/profile', [ShopSellerController::class, "profile"])->name('shop_seller_profile');

    Route::post('/shop/user/changePassword', [ShopSellerController::class, "changePassword"])->name('shop_seller_change_password');
    Route::post('/shop/user/changeSellerInformation', [ShopSellerController::class, "changeSellerInformation"])->name('shop_seller_change_seller_information');
});
