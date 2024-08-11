<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(){
        return view('admin.shop.user.user.list');
    }

    public function edit(Request $request){
        return view('admin.shop.user.user.edit');
    }

    public function create(){

    }

    public function update(){

    }

    public function delete(){

    }

    public function getData(){

    }
}
