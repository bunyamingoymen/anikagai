<?php

use App\Http\Controllers\Shop\Admin\CargoCompaniesController;
use App\Http\Controllers\Shop\Admin\CategoryController;
use App\Http\Controllers\Shop\Admin\FeaturesController;
use App\Http\Controllers\Shop\Admin\KeyValueController;
use App\Http\Controllers\Shop\Admin\OrderController;
use App\Http\Controllers\Shop\Admin\ProductController;
use App\Http\Controllers\Shop\Admin\SellerController;
use App\Http\Controllers\Shop\Admin\SettingsController;
use App\Http\Controllers\Shop\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(CargoCompaniesController::class)->group(function () {
    Route::get("/admin/shop/cargoCompany", "list")->name('admin_shop_cargo_company_list');
    Route::post("/admin/shop/cargoCompany/ajax", "getData")->name('admin_shop_cargo_company_get_data');

    Route::get("/admin/shop/cargoCompany/create", "edit")->name('admin_shop_cargo_company_create');
    Route::get("/admin/shop/cargoCompany/update", "edit")->name('admin_shop_cargo_company_update');

    Route::post("/admin/shop/cargoCompany/save", "save")->name('admin_shop_cargo_company_save');

    Route::post("/admin/shop/cargoCompany/delete", "delete")->name('admin_shop_cargo_company_delete');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get("/admin/shop/category", "list")->name('admin_shop_category_list');
    Route::post("/admin/shop/category/ajax", "getData")->name('admin_shop_category_get_data');

    Route::get("/admin/shop/category/create", "edit")->name('admin_shop_category_create');
    Route::get("/admin/shop/category/update", "edit")->name('admin_shop_category_update');

    Route::post("/admin/shop/category/save", "save")->name('admin_shop_category_save');

    Route::post("/admin/shop/category/delete", "delete")->name('admin_shop_category_delete');
});

Route::controller(FeaturesController::class)->group(function () {
    Route::get("/admin/shop/feature", "list")->name('admin_shop_feature_list');
    Route::post("/admin/shop/feature/ajax", "getData")->name('admin_shop_feature_get_data');

    Route::get("/admin/shop/feature/create", "edit")->name('admin_shop_feature_create');
    Route::get("/admin/shop/feature/update", "edit")->name('admin_shop_feature_update');

    Route::post("/admin/shop/feature/save", "save")->name('admin_shop_feature_save');

    Route::post("/admin/shop/feature/delete", "delete")->name('admin_shop_feature_delete');
});

Route::controller(UserController::class)->group(function () {
    Route::get("/admin/shop/user", "list")->name('admin_shop_user_list');
    Route::post("/admin/shop/user/ajax", "getData")->name('admin_shop_user_get_data');

    Route::get("/admin/shop/user/create", "edit")->name('admin_shop_user_create');
    Route::get("/admin/shop/user/update", "edit")->name('admin_shop_user_update');
    Route::get("/admin/shop/user/changeActive", "changeActive")->name('admin_shop_user_change_active');

    Route::post("/admin/shop/user/save", "save")->name('admin_shop_user_save');

    Route::post("/admin/shop/user/delete", "delete")->name('admin_shop_user_delete');
});

Route::controller(SellerController::class)->group(function () {
    Route::get("/admin/shop/seller", "list")->name('admin_shop_seller_list');
    Route::post("/admin/shop/seller/ajax", "getData")->name('admin_shop_seller_get_data');

    Route::get("/admin/shop/seller/create", "edit")->name('admin_shop_seller_create');
    Route::get("/admin/shop/seller/update", "edit")->name('admin_shop_seller_update');
    Route::get("/admin/shop/seller/changeActive", "changeActive")->name('admin_shop_seller_change_active');

    Route::post("/admin/shop/seller/save", "save")->name('admin_shop_seller_save');

    Route::post("/admin/shop/seller/delete", "delete")->name('admin_shop_seller_delete');
});

Route::controller(ProductController::class)->group(function () {

    Route::post("/admin/shop/product/ajax/{type?}", "getData")->name('admin_shop_product_get_data');

    Route::get("/admin/shop/product/create", "edit")->name('admin_shop_product_create');
    Route::get("/admin/shop/product/update", "edit")->name('admin_shop_product_update');
    Route::get("/admin/shop/product/changeApproval", "changeApproval")->name('admin_shop_product_change_approval');
    Route::get("/admin/shop/product/changeActive", "changeActive")->name('admin_shop_product_change_active');

    Route::get("/admin/shop/product/deleteImage", "deleteImage")->name('admin_shop_product_delete_image');

    Route::post("/admin/shop/product/save", "save")->name('admin_shop_product_save');

    Route::post("/admin/shop/product/delete", "delete")->name('admin_shop_product_delete');

    Route::get("/admin/shop/product/{type?}", "list")->name('admin_shop_product_list');
});






Route::controller(OrderController::class)->group(function () {
    Route::get("/admin/shop/order/{type?}", "list")->name('admin_shop_order_list');
    Route::get("/admin/shop/order/ajax/{type?}", "getData")->name('admin_shop_order_get_data');

    Route::get("/admin/shop/order/create", "edit")->name('admin_shop_order_create');
    Route::get("/admin/shop/order/update", "edit")->name('admin_shop_order_update');

    Route::get("/admin/shop/order/delete", "delete")->name('admin_shop_order_delete');
});



Route::controller(SettingsController::class)->group(function () {
    Route::get("/admin/shop/settings", "list")->name('admin_shop_settings_list');

    Route::post("/admin/shop/generalSettings", "general_settings")->name('admin_shop_general_settings');

    Route::post("/admin/shop/archiveDeleteSettings", "archive_and_delete_settings")->name('admin_shop_archive_and_delete_settings');
});

Route::controller(KeyValueController::class)->group(function () {

});
