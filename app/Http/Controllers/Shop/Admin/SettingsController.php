<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop\ShopKeyValue;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function list(){
        $storeActive = ShopKeyValue::Where('key','store_active')->first();
        $newSellerAccept = ShopKeyValue::Where('key','new_seller_accept')->first();
        $approwNotRequired = ShopKeyValue::Where('key','approw_not_required')->first();

        return view('admin.shop.other.setting',['storeActive'=>$storeActive, 'newSellerAccept'=>$newSellerAccept, 'approwNotRequired'=>$approwNotRequired]);
    }

    public function general_settings(Request $request){

        //**** Mağaza Aktif Kısmı
        $storeActive = ShopKeyValue::Where('key','store_active')->first();

        if(!$storeActive){
            $storeActive = new ShopKeyValue();
            $storeActive->code = $this->generateUniqueCode('shop_mysql','shop_key_values');
            $storeActive->key = 'store_active';
        }

        $storeActive->value = $request->has('store_active') ? '1' : '0';
        $storeActive->save();
        //---**** Mağaza Aktif Kısmı



        //**** Yeni satıcı Kabul Edilebilir
        $newSellerAccept = ShopKeyValue::Where('key','new_seller_accept')->first();

        if(!$newSellerAccept){
            $newSellerAccept = new ShopKeyValue();
            $newSellerAccept->code = $this->generateUniqueCode('shop_mysql','shop_key_values');
            $newSellerAccept->key = 'new_seller_accept';
        }
        $newSellerAccept->value = $request->has('new_seller_accept') ? '1' : '0';
        $newSellerAccept->save();
        //---**** Yeni satıcı Kabul Edilebilir


        //**** Onaya gerek yok
        $approwNotRequired = ShopKeyValue::Where('key','approw_not_required')->first();

        if(!$approwNotRequired){
            $approwNotRequired = new ShopKeyValue();
            $approwNotRequired->code = $this->generateUniqueCode('shop_mysql','shop_key_values');
            $approwNotRequired->key = 'approw_not_required';
        }
        $approwNotRequired->value = $request->has('approw_not_required') ? '1' : '0';
        $approwNotRequired->save();
        //---**** Onaya gerek yok

        return redirect()->back()->with('success','Ayarlar başarılı bir şekilde kaydedildi');
    }

    public function update(){

    }

    public function delete(){

    }

    public function getData(){

    }
}
