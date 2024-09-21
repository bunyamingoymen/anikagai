<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\RssController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/routes/index.php';

Route::get('/feed', [RssController::class, "getRSS"])->name('getRSS');
Route::get('/adultOn', [Controller::class, "adultOn"])->name('adultOn');

require __DIR__ . '/routes/shop.php';
