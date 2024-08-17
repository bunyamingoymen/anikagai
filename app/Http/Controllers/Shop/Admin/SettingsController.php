<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop\ShopKeyValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SettingsController extends Controller
{
    public function list(){

        //** General Settings */
        $storeActive = ShopKeyValue::Where('key','store_active')->first();
        $newSellerAccept = ShopKeyValue::Where('key','new_seller_accept')->first();
        $approwNotRequired = ShopKeyValue::Where('key','approw_not_required')->first();
        //** General Settings */

         //** Archive And Delete Settings */
         $addArchive = ShopKeyValue::Where('key','add_archive')->first();
         $archiveTime = ShopKeyValue::Where('key','archive_time')->first();
         $DeleteAutomatic = ShopKeyValue::Where('key','delete_automatic')->first();
         $deleteTime = ShopKeyValue::Where('key','delete_time')->first();
         //** Archive And Delete Settings */

        return view('admin.shop.other.setting',['storeActive'=>$storeActive, 'newSellerAccept'=>$newSellerAccept, 'approwNotRequired'=>$approwNotRequired]);
    }

    public function general_settings(Request $request){

        //**** Mağaza Aktif Kısmı
        $storeActive = ShopKeyValue::Where('key','store_active')->first();

        if(!$storeActive){
            $storeActive = new ShopKeyValue();
            $storeActive->code = $this->generateUniqueCode('shop_mysql','shop_key_values');
            $storeActive->key = 'store_active';
            $storeActive->create_user_code = Auth::guard('admin')->user()->code;
        }

        $storeActive->value = $request->has('store_active') ? '1' : '0';
        $storeActive->update_user_code = Auth::guard('admin')->user()->code;
        $storeActive->save();
        //---**** Mağaza Aktif Kısmı



        //**** Yeni satıcı Kabul Edilebilir
        $newSellerAccept = ShopKeyValue::Where('key','new_seller_accept')->first();

        if(!$newSellerAccept){
            $newSellerAccept = new ShopKeyValue();
            $newSellerAccept->code = $this->generateUniqueCode('shop_mysql','shop_key_values');
            $newSellerAccept->key = 'new_seller_accept';
            $newSellerAccept->create_user_code = Auth::guard('admin')->user()->code;
        }
        $newSellerAccept->value = $request->has('new_seller_accept') ? '1' : '0';
        $newSellerAccept->update_user_code = Auth::guard('admin')->user()->code;
        $newSellerAccept->save();
        //---**** Yeni satıcı Kabul Edilebilir


        //**** Onaya gerek yok
        $approwNotRequired = ShopKeyValue::Where('key','approw_not_required')->first();

        if(!$approwNotRequired){
            $approwNotRequired = new ShopKeyValue();
            $approwNotRequired->code = $this->generateUniqueCode('shop_mysql','shop_key_values');
            $approwNotRequired->key = 'approw_not_required';
            $approwNotRequired->create_user_code = Auth::guard('admin')->user()->code;
        }
        $approwNotRequired->value = $request->has('approw_not_required') ? '1' : '0';
        $approwNotRequired->update_user_code = Auth::guard('admin')->user()->code;
        $approwNotRequired->save();
        //---**** Onaya gerek yok

        return redirect()->back()->with('success','Ayarlar başarılı bir şekilde kaydedildi');
    }

    public function archive_and_delete_settings(Request $request){

        $addArchive = ShopKeyValue::Where('key','add_archive')->first();

        if(!$addArchive){
            $addArchive = new ShopKeyValue();
            $addArchive->code = $this->generateUniqueCode('shop_mysql','shop_key_values');
            $addArchive->key = 'add_archive';
            $addArchive->create_user_code = Auth::guard('admin')->user()->code;
        }

        $addArchive->value = $request->has('add_archive') ? '1' : '0';
        $addArchive->update_user_code = Auth::guard('admin')->user()->code;
        $addArchive->save();



        $archiveTime = ShopKeyValue::Where('key','archive_time')->first();

        if(!$archiveTime){
            $archiveTime = new ShopKeyValue();
            $archiveTime->code = $this->generateUniqueCode('shop_mysql','shop_key_values');
            $archiveTime->key = 'archive_time';
            $archiveTime->create_user_code = Auth::guard('admin')->user()->code;
        }

        $archiveTime->value = $request->has('archive_time') ? $request->archive_time  : Config::get('app.archive_time');
        $archiveTime->update_user_code = Auth::guard('admin')->user()->code;
        $archiveTime->save();



        $DeleteAutomatic = ShopKeyValue::Where('key','delete_automatic')->first();

        if(!$DeleteAutomatic){
            $DeleteAutomatic = new ShopKeyValue();
            $DeleteAutomatic->code = $this->generateUniqueCode('shop_mysql','shop_key_values');
            $DeleteAutomatic->key = 'delete_automatic';
            $DeleteAutomatic->create_user_code = Auth::guard('admin')->user()->code;
        }

        $DeleteAutomatic->value = $request->has('delete_automatic') ? '1' : '0';
        $DeleteAutomatic->update_user_code = Auth::guard('admin')->user()->code;
        $DeleteAutomatic->save();



        $deleteTime = ShopKeyValue::Where('key','delete_time')->first();

        if(!$deleteTime){
            $deleteTime = new ShopKeyValue();
            $deleteTime->code = $this->generateUniqueCode('shop_mysql','shop_key_values');
            $deleteTime->key = 'delete_time';
            $deleteTime->create_user_code = Auth::guard('admin')->user()->code;
        }

        $deleteTime->value = $request->has('delete_time') ? $request->delete_time  : Config::get('app.delete_time');
        $deleteTime->update_user_code = Auth::guard('admin')->user()->code;
        $deleteTime->save();

        return redirect()->back()->with('success','Ayarlar başarılı bir şekilde kaydedildi');
    }
}
