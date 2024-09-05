<?php

namespace App\Http\Controllers\Shop\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopIndexController extends Controller
{
    public function index(){
        return view('shop.themes.kidol.index');
    }

    public function login(){
        return view('shop.themes.kidol.login');
    }
}
