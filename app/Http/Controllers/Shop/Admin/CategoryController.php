<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list(){
        return view('admin.shop.data.category.list');
    }

    public function edit(Request $request){
        return view('admin.shop.data.category.edit');
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
