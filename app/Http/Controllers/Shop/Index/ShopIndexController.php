<?php

namespace App\Http\Controllers\Shop\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopIndexController extends Controller
{
    public function index(){
        $database = 'shop_mysql';
        $model = 'App\Models\Shop\ShopProduct';

        $filters = [];

        $leftJoins = [
            ['table' => 'shop_files', 'first' => 'code', 'operator' => '=', 'second' => 'shop_files.parent_code', 'columns'=>['path'=>'image_path']]
        ];

        $orderBy = ['column'=>'created_at', 'type'=>'DESC'];

        $pagination = ['take' => 16, 'page' => 1];

        $trends = $this->getDataFromDatabase(['database'=>$database, 'model'=>$model, 'filters'=> ['is_trend'=>'1', 'is_approved'=>'1', 'is_active'=>'1', 'shop_files.description'=>'main image'], 'leftjoins'=>$leftJoins, 'orderby' => $orderBy, 'pagination'=>$pagination ]);

        $products = $this->getDataFromDatabase(['database'=>$database, 'model'=>$model,  'filters'=> ['is_approved'=>'1', 'is_active'=>'1', 'shop_files.description'=>'main image'], 'leftjoins'=>$leftJoins, 'orderby' => $orderBy, 'pagination'=>$pagination ]);

        return view('shop.themes.kidol.index', compact('trends', 'products'));
    }

    public function list(Request $request){
        $database = 'shop_mysql';
        $model = 'App\Models\Shop\ShopProduct';

        $filters = [];

        $leftJoins = [
            ['table' => 'shop_files', 'first' => 'code', 'operator' => '=', 'second' => 'shop_files.parent_code', 'columns'=>['path'=>'image_path']]
        ];

        $orderBy = ['column'=>'created_at', 'type'=>'DESC'];

        $pagination = ['take' => 16, 'page' => $request->page ?? 1];

        $products = $this->getDataFromDatabase(['database'=>$database, 'model'=>$model,  'filters'=> ['is_approved'=>'1', 'is_active'=>'1', 'shop_files.description'=>'main image'], 'leftjoins'=>$leftJoins, 'orderby' => $orderBy, 'pagination'=>$pagination ]);

        return view('shop.themes.kidol.list', compact('products'));
    }

    public function login(){
        return view('shop.themes.kidol.login');
    }
}
