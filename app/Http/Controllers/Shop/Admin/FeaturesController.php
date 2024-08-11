<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function list(){
        return view('admin.shop.data.feature.list');
    }

    public function edit(Request $request){
        return view('admin.shop.data.feature.edit');
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
