<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop\ShopFeatures;
use App\Models\Shop\ShopKeyValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;


class FeaturesController extends Controller
{
    public function list(){
        return view('admin.shop.data.feature.list');
    }

    public function edit(Request $request){

        if(Route::currentRouteName() == "admin_shop_feature_update"){
            $item = ShopFeatures::Where('deleted',0)->Where('code',$request->code)->first();
            if(!$item) return redirect()->back()->with('error','Özellik güncellenirken bir hata meydana geldi');
            $values = ShopKeyValue::Where('key','feature_type_multiple_selection')->Where('optional',$request->code)->get();
            return view('admin.shop.data.feature.edit',['item'=>$item, 'values'=>$values]);
        }
        return view('admin.shop.data.feature.edit');
    }

    public function save(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'İsim alanı giriniz. Max: 255 karakter.',
        ]);

        $item = ShopFeatures::Where('deleted',0)->Where('code',$request->code)->first();
        $is_new = false;
        if(!$item){
            $item = new ShopFeatures();
            $code = $this->generateUniqueCode('shop_mysql','shop_features');
            $item->code = $code;
            $is_new = true;
        }else $code = $item->code;

        $item->name = $request->name;
        $item->description = $request->description;
        $item->feature_type = $request->feature_type ?? 0;
        ShopKeyValue::Where('key','feature_type_multiple_selection')->where('optional',$code)->delete();


        if($item->feature_type == 1 && $request->has('multiple_choose')){
            $key = 'feature_type_multiple_selection';
            $optional = $code;
            foreach($request->multiple_choose as $value){
                $keyValue = new ShopKeyValue();
                $keyValue->code = $this->generateUniqueCode('shop_mysql','shop_key_values');;
                $keyValue->key = $key;
                $keyValue->value = $value;
                $keyValue->optional = $optional;
                $keyValue->save();
            }
        }

        if($is_new){
            $item->create_user_code = Auth::guard('admin')->user()->code;
            $item->save();
            return redirect()->route('admin_shop_feature_list')->with('success','Yeni Özellik Eklendi');
        }else{
            $item->update_user_code = Auth::guard('admin')->user()->code;
            $item->save();
            return redirect()->route('admin_shop_feature_list')->with('success','Özellik Güncellendi');
        }

    }

    public function delete(Request $request){
        $item = ShopFeatures::Where('deleted',0)->Where('code',$request->code)->first();
        if(!$item) return redirect()->back()->with('error','Özellik silinirken bir hata meydana geldi');

        $item->deleted = 1;
        $item->update_user_code = Auth::guard('admin')->user()->code;
        $item->save();
        return redirect()->back()->with('success','Özellik Silindi');

    }

    public function getData(Request $request){

        $pagination = [
            'take' => $request->showingCount ? $request->showingCount : Config::get('app.showCount'),
            'page' => $request->page
        ];

        $result = $this->getDataFromDatabase('shop_mysql', 'App\Models\Shop\ShopFeatures', [], $pagination);

        return $result;
    }
}
