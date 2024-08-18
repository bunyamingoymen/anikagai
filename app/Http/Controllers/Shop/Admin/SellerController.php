<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SellerController extends Controller
{
    public function list(){
        return view('admin.shop.user.seller.list');
    }

    public function edit(Request $request){
        return view('admin.shop.user.seller.edit');
    }

    public function save(Request $request){

    }

    public function delete(Request $request){

    }

    public function getData(Request $request){
        $pagination = [
            'take' => $request->showingCount ? $request->showingCount : Config::get('app.showCount'),
            'page' => $request->page
        ];

        $result = $this->getDataFromDatabase('shop_mysql', 'App\Models\Shop\ShopSellers', [], $pagination);

        return $result;
    }
}
