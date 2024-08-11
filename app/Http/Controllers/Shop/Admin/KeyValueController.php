<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeyValueController extends Controller
{
    public function cargoList(){
        return view('admin.shop.data.other.cargo_companies');
    }
}
