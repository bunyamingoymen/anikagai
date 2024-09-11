<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

class ProductController extends Controller
{

    private $defaultModel, $defaultPath, $defaultRoute, $defaultListRoute, $defaultUpdateRoute, $defaultListPath, $defaultEditPath;

    public function __construct(){
        $this->defaultModel = 'App\Models\Shop\ShopProduct';

        $this->defaultPath = 'admin.shop.product';
        $this->defaultListPath = $this->defaultPath . '.list';
        $this->defaultEditPath = $this->defaultPath . '.edit';

        $this->defaultRoute = 'admin_shop_product';
        $this->defaultListRoute = $this->defaultRoute.'_list';
        $this->defaultUpdateRoute = $this->defaultRoute.'_update';
    }

    public function list($type = null){
        if(!$type) $type = -1;
        return view($this->defaultListPath, ['type'=> $type]);
    }

    public function edit(Request $request){
        if(Route::currentRouteName() == $this->defaultUpdateRoute){
            $item = $this->getOneItem($request->code, $this->defaultModel, 0)['item'];
            if(!$item) return redirect()->route($this->defaultListRoute)->with('error','ürün güncellenirken bir hata meydana geldi');

            return view($this->defaultEditPath,['item'=>$item]);
        }
        return view($this->defaultEditPath);
    }

    public function save(Request $request){
        $getOne = $this->getOneItem($request->code, $this->defaultModel);

        $item = $getOne['item'];
        $is_new = $getOne['is_new'];
        $code = $getOne['code'];

        $item->seller_code = '1'; //Anikagai admin sayfasında oluşturuldu
        $item->url = $this->getUrl($request->name);
        $item->name = $request->name;
        $item->price = $request->price;
        $item->priceType = $request->priceType;
        $item->description = $request->description;
        $item->is_approved = $request->has('is_approved') ? 1 : 0;
        $item->is_active = $request->has('is_active') ? 1 : 0;

        $item->save();
        return redirect()->route($this->defaultListRoute)->with('success', $is_new ? 'Yeni ürün eklendi' : 'Ürün güncellendi');

    }

    public function delete(Request $request){
        $item = $this->getOneItem($request->code, $this->defaultModel,0)['item'];
        if(!$item) return redirect()->route($this->defaultListRoute)->with('error','Ürün silinirken bir hata meydana geldi');

        $item->deleted = 1;
        $item->save();

        return redirect()->route($this->defaultListRoute)->with('success','Ürün Silindi');
    }

    public function changeApproval(Request $request){
        $item = $this->getOneItem($request->code, $this->defaultModel,0)['item'];
        if(!$item) return redirect()->route($this->defaultListRoute)->with('error','Ürünün onaylanma durumu değiştirilirken');

        $item->is_approved = $item->is_approved == 1 ? 0 : 1;
        $item->save();
        return redirect()->route($this->defaultListRoute)->with('success','Ürünün onaylanma durumu güncellendi');
    }

    public function changeActive(Request $request){
        $item = $this->getOneItem($request->code, $this->defaultModel,0)['item'];
        if(!$item) return redirect()->route($this->defaultListRoute)->with('error','Ürünün onaylanma durumu değiştirilirken');

        $item->is_active = $item->is_active == 1 ? 0 : 1;
        $item->save();
        return redirect()->route($this->defaultListRoute)->with('success','Ürünün onaylanma durumu güncellendi');
    }

    public function getData(Request $request){

        $pagination = [
            'take' => $request->showingCount ? $request->showingCount : Config::get('app.showCount'),
            'page' => $request->page
        ];
        $filters = [];
        if($request->type != "-1"){
            if($request->type=="sale"){

                $filters['is_approved'] = "1";
                $filters['is_active'] = "1";

            }else if($request->type=="unapproved") $filters['is_approved'] = "0";
            else if($request->type=="passive") $filters['is_active'] = "0";
        }

        $result = $this->getDataFromDatabase('shop_mysql', $this->defaultModel, $filters, $pagination);

        return $result;
    }
}
