<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop\ShopCategories;
use App\Models\Shop\ShopCategoryFeatures;
use App\Models\Shop\ShopFeatures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

class CategoryController extends Controller
{
    public function list(){
        return view('admin.shop.data.category.list');
    }

    public function edit(Request $request){
        $features = ShopFeatures::Where('deleted',0)->get();
        if(Route::currentRouteName() == "admin_shop_category_update"){
            $item = ShopCategories::Where('deleted',0)->Where('code',$request->code)->first();

            if(!$item) return redirect()->back()->with('error','Kategori güncellenirken bir hata meydana geldi');

            $values = ShopCategoryFeatures::Where('category_code',$request->code)->get();

            return view('admin.shop.data.category.edit',['item'=>$item, 'values'=>$values, 'features'=>$features]);
        }
        return view('admin.shop.data.category.edit',['features'=>$features]);
    }

    public function save(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'İsim alanı giriniz. Max: 255 karakter.',
        ]);

        $is_new = false;
        $item = ShopCategories::Where('deleted',0)->Where('code', $request->code)->first();

        if(!$item){
            $code = $this->generateUniqueCode('shop_mysql','shop_categories');
            $item = new ShopCategories();
            $item->code = $code;
            $is_new = true;
        }else $code = $item->code;

        $item->name = $request->name;
        $item->description = $request->description;

        ShopCategoryFeatures::Where('category_code',$code)->delete();
        if($request->has('features')){
            foreach($request->features as $value){
                $cat_fea = new ShopCategoryFeatures();
                $cat_fea->category_code = $code;
                $cat_fea->feature_code = $value;
                $cat_fea->save();
            }
        }

        if($is_new){
            $item->create_user_code = Auth::guard('admin')->user()->code;
            $item->save();
            return redirect()->route('admin_shop_category_list')->with('success','Yeni Kategori Eklendi');
        }else{
            $item->update_user_code = Auth::guard('admin')->user()->code;
            $item->save();
            return redirect()->route('admin_shop_category_list')->with('success','Kategori Güncellendi');
        }


    }

    public function delete(Request $request){
        $item = ShopCategories::Where('deleted',0)->Where('code',$request->code)->first();
        if(!$item) return redirect()->back()->with('error','Kategori silinirken bir hata meydana geldi');

        $item->deleted = 1;
        $item->update_user_code = Auth::guard('admin')->user()->code;
        $item->save();

        return redirect()->back()->with('success','Kategori Silindi');
    }

    public function getData(Request $request){

        $pagination = [
            'take' => $request->showingCount ? $request->showingCount : Config::get('app.showCount'),
            'page' => $request->page
        ];

        $result = $this->getDataFromDatabase('shop_mysql', 'App\Models\Shop\ShopCategories', [], $pagination);

        return $result;
    }
}
