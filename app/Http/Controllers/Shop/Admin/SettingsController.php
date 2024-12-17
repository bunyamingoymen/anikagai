<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use App\Models\KeyValue;
use App\Models\Shop\ShopKeyValue;
use App\Models\ThemeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SettingsController extends Controller
{
    public function list()
    {

        //** General Settings */
        $storeActive = ShopKeyValue::Where('key', 'store_active')->first();
        $newSellerAccept = ShopKeyValue::Where('key', 'new_seller_accept')->first();
        $approwNotRequired = ShopKeyValue::Where('key', 'approw_not_required')->first();
        //** General Settings */

        //komisyon Oranları ayarları
        $active_commission = ShopKeyValue::Where('key', 'active_commission')->first();
        $commission_rate = ShopKeyValue::Where('key', 'commission_rate')->first();

        //Ücretisz kargo ayarları
        $active_free_cargo = ShopKeyValue::Where('key', 'active_free_cargo')->first();
        $free_cargo_price = ShopKeyValue::Where('key', 'free_cargo_price')->first();
        $other_sellers_change_free_cargo = ShopKeyValue::Where('key', 'other_sellers_change_free_cargo')->first();

        //Mağaza tipi ayarları
        $active_shop_mode = ShopKeyValue::Where('key', 'active_shop_mode')->first();
        $shopModes = ShopKeyValue::Where('key', 'shop_modes')->get();


        //** Archive And Delete Settings */
        $addArchive = ShopKeyValue::Where('key', 'add_archive')->first();
        $archiveTime = ShopKeyValue::Where('key', 'archive_time')->first();
        $deleteAutomatic = ShopKeyValue::Where('key', 'delete_automatic')->first();
        $deleteTime = ShopKeyValue::Where('key', 'delete_time')->first();
        //** Archive And Delete Settings */

        $colors_code = ThemeSetting::where('theme_code', KeyValue::where('key', 'selected_theme')->first()->value)
            ->where('setting_name', 'colors_code')
            ->get();

        $colors_code_defaults = ThemeSetting::where('theme_code', KeyValue::where('key', 'selected_theme')->first()->value)
            ->where('setting_name', 'colors_code_default')
            ->get();

        $use_same_color = ShopKeyValue::Where('key', 'use_same_color')->first();
        $colors_different = ShopKeyValue::Where('key', 'colors_code')->get();


        $use_same_logo = ShopKeyValue::Where('key', 'use_same_logo')->first();
        $shop_logo = ShopKeyValue::Where('key', 'shop_logo')->first();

        return view(
            'admin.shop.other.setting',
            compact(
                'storeActive',
                'newSellerAccept',
                'approwNotRequired',

                'active_commission',
                'commission_rate',

                'active_free_cargo',
                'free_cargo_price',
                'other_sellers_change_free_cargo',

                'active_shop_mode',
                'shopModes',

                'addArchive',
                'archiveTime',
                'deleteAutomatic',
                'deleteTime',

                'colors_code',
                'colors_code_defaults',

                'use_same_color',
                'colors_different',

                'use_same_logo',
                'shop_logo',
            )
        );
    }

    public function general_settings(Request $request)
    {

        //**** Mağaza Aktif Kısmı
        $storeActive = ShopKeyValue::Where('key', 'store_active')->first();

        if (!$storeActive) {
            $storeActive = new ShopKeyValue();
            $storeActive->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $storeActive->key = 'store_active';
            $storeActive->create_user_code = Auth::guard('admin')->user()->code;
        }

        $storeActive->value = $request->has('store_active') ? '1' : '0';
        $storeActive->update_user_code = Auth::guard('admin')->user()->code;
        $storeActive->save();
        //---**** Mağaza Aktif Kısmı



        //**** Yeni satıcı Kabul Edilebilir
        $newSellerAccept = ShopKeyValue::Where('key', 'new_seller_accept')->first();

        if (!$newSellerAccept) {
            $newSellerAccept = new ShopKeyValue();
            $newSellerAccept->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $newSellerAccept->key = 'new_seller_accept';
            $newSellerAccept->create_user_code = Auth::guard('admin')->user()->code;
        }
        $newSellerAccept->value = $request->has('new_seller_accept') ? '1' : '0';
        $newSellerAccept->update_user_code = Auth::guard('admin')->user()->code;
        $newSellerAccept->save();
        //---**** Yeni satıcı Kabul Edilebilir


        //**** Onaya gerek yok
        $approwNotRequired = ShopKeyValue::Where('key', 'approw_not_required')->first();

        if (!$approwNotRequired) {
            $approwNotRequired = new ShopKeyValue();
            $approwNotRequired->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $approwNotRequired->key = 'approw_not_required';
            $approwNotRequired->create_user_code = Auth::guard('admin')->user()->code;
        }
        $approwNotRequired->value = $request->has('approw_not_required') ? '1' : '0';
        $approwNotRequired->update_user_code = Auth::guard('admin')->user()->code;
        $approwNotRequired->save();
        //---**** Onaya gerek yok

        return redirect()->back()->with('success', 'Ayarlar başarılı bir şekilde kaydedildi');
    }

    public function seller_settings(Request $request)
    {
        //**** Komisyon Aktif kısmı
        $active_commission = ShopKeyValue::Where('key', 'active_commission')->first();

        if (!$active_commission) {
            $active_commission = new ShopKeyValue();
            $active_commission->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $active_commission->key = 'active_commission';
            $active_commission->create_user_code = Auth::guard('admin')->user()->code;
        }

        $active_commission->value = $request->has('active_commission') ? '1' : '0';
        $active_commission->update_user_code = Auth::guard('admin')->user()->code;
        $active_commission->save();

        //**** Komisyon oranı
        $commission_rate = ShopKeyValue::Where('key', 'commission_rate')->first();

        if (!$commission_rate) {
            $commission_rate = new ShopKeyValue();
            $commission_rate->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $commission_rate->key = 'commission_rate';
            $commission_rate->create_user_code = Auth::guard('admin')->user()->code;
        }

        if ($request->has('active_commission')) $commission_rate->value = $request->has('commission_rate') ? $request->commission_rate : '0';
        else $commission_rate->value = '0';

        $commission_rate->update_user_code = Auth::guard('admin')->user()->code;
        $commission_rate->save();






        //**** Ücretsiz Kargo Aktif kısmı
        $active_free_cargo = ShopKeyValue::Where('key', 'active_free_cargo')->first();

        if (!$active_free_cargo) {
            $active_free_cargo = new ShopKeyValue();
            $active_free_cargo->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $active_free_cargo->key = 'active_free_cargo';
            $active_free_cargo->create_user_code = Auth::guard('admin')->user()->code;
        }

        $active_free_cargo->value = $request->has('active_free_cargo') ? '1' : '0';
        $active_free_cargo->update_user_code = Auth::guard('admin')->user()->code;
        $active_free_cargo->save();

        //**** ücretsiz Kargo
        $free_cargo_price = ShopKeyValue::Where('key', 'free_cargo_price')->first();

        if (!$free_cargo_price) {
            $free_cargo_price = new ShopKeyValue();
            $free_cargo_price->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $free_cargo_price->key = 'free_cargo_price';
            $free_cargo_price->create_user_code = Auth::guard('admin')->user()->code;
        }

        if ($request->has('active_free_cargo')) $free_cargo_price->value = $request->has('free_cargo_price') ? $request->free_cargo_price : '0';
        else $free_cargo_price->value = '0';

        $free_cargo_price->update_user_code = Auth::guard('admin')->user()->code;
        $free_cargo_price->save();


        //**** Satıcılar ücretsiz Kargo belirleyebilir
        $other_sellers_change_free_cargo = ShopKeyValue::Where('key', 'other_sellers_change_free_cargo')->first();

        if (!$other_sellers_change_free_cargo) {
            $other_sellers_change_free_cargo = new ShopKeyValue();
            $other_sellers_change_free_cargo->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $other_sellers_change_free_cargo->key = 'other_sellers_change_free_cargo';
            $other_sellers_change_free_cargo->create_user_code = Auth::guard('admin')->user()->code;
        }

        if ($request->has('active_free_cargo')) $other_sellers_change_free_cargo->value = $request->has('other_sellers_change_free_cargo') ? '1' : '0';
        else $other_sellers_change_free_cargo->value = '0';

        $other_sellers_change_free_cargo->update_user_code = Auth::guard('admin')->user()->code;
        $other_sellers_change_free_cargo->save();


        //**** Mağaza Modları
        $active_shop_mode = ShopKeyValue::Where('key', 'active_shop_mode')->first();

        if (!$active_shop_mode) {
            $active_shop_mode = new ShopKeyValue();
            $active_shop_mode->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $active_shop_mode->key = 'active_shop_mode';
            $active_shop_mode->create_user_code = Auth::guard('admin')->user()->code;
        }

        $active_shop_mode->value = $request->has('active_shop_mode') ? $request->active_shop_mode : 'mod_1';

        $active_shop_mode->update_user_code = Auth::guard('admin')->user()->code;
        $active_shop_mode->save();

        return redirect()->back()->with('success', 'Ayarlar başarılı bir şekilde kaydedildi');
    }

    public function archive_and_delete_settings(Request $request)
    {

        $addArchive = ShopKeyValue::Where('key', 'add_archive')->first();

        if (!$addArchive) {
            $addArchive = new ShopKeyValue();
            $addArchive->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $addArchive->key = 'add_archive';
            $addArchive->create_user_code = Auth::guard('admin')->user()->code;
        }

        $addArchive->value = $request->has('add_archive') ? '1' : '0';
        $addArchive->update_user_code = Auth::guard('admin')->user()->code;
        $addArchive->save();



        $archiveTime = ShopKeyValue::Where('key', 'archive_time')->first();

        if (!$archiveTime) {
            $archiveTime = new ShopKeyValue();
            $archiveTime->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $archiveTime->key = 'archive_time';
            $archiveTime->create_user_code = Auth::guard('admin')->user()->code;
        }

        $archiveTime->value = $request->has('archive_time') ? $request->archive_time  : Config::get('app.archive_time');
        $archiveTime->update_user_code = Auth::guard('admin')->user()->code;
        $archiveTime->save();



        $DeleteAutomatic = ShopKeyValue::Where('key', 'delete_automatic')->first();

        if (!$DeleteAutomatic) {
            $DeleteAutomatic = new ShopKeyValue();
            $DeleteAutomatic->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $DeleteAutomatic->key = 'delete_automatic';
            $DeleteAutomatic->create_user_code = Auth::guard('admin')->user()->code;
        }

        $DeleteAutomatic->value = $request->has('delete_automatic') ? '1' : '0';
        $DeleteAutomatic->update_user_code = Auth::guard('admin')->user()->code;
        $DeleteAutomatic->save();



        $deleteTime = ShopKeyValue::Where('key', 'delete_time')->first();

        if (!$deleteTime) {
            $deleteTime = new ShopKeyValue();
            $deleteTime->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $deleteTime->key = 'delete_time';
            $deleteTime->create_user_code = Auth::guard('admin')->user()->code;
        }

        $deleteTime->value = $request->has('delete_time') ? $request->delete_time  : Config::get('app.delete_time');
        $deleteTime->update_user_code = Auth::guard('admin')->user()->code;
        $deleteTime->save();

        return redirect()->back()->with('success', 'Ayarlar başarılı bir şekilde kaydedildi');
    }

    public function theme_settings(Request $request)
    {
        $use_same_color = ShopKeyValue::Where('key', 'use_same_color')->first();

        if (!$use_same_color) {
            $use_same_color = new ShopKeyValue();
            $use_same_color->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $use_same_color->key = 'use_same_color';
            $use_same_color->create_user_code = Auth::guard('admin')->user()->code;
        }

        $use_same_color->value = $request->has('use_same_color') ? '1' : '0';
        $use_same_color->update_user_code = Auth::guard('admin')->user()->code;
        $use_same_color->save();

        $colors_code = ThemeSetting::where('theme_code', KeyValue::where('key', 'selected_theme')->first()->value)
            ->where('setting_name', 'colors_code')
            ->get();

        //İlk önce varsayılan olarak bütün değerleri siliyoruz
        ShopKeyValue::Where('key', 'colors_code')->delete();

        //Eğer farklı renk kullanılacaksa bütün değerleri teker teker ekliyoruz.
        if ($request->has('use_same_color')) {
            foreach ($colors_code as $key => $value) {
                if (isset($request->hexcolors[$value->code])) {
                    $color = new ShopKeyValue();
                    $color->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
                    $color->key = 'colors_code';
                    $color->value = $request->hexcolors[$value->code];
                    $color->optional = $value->code;
                    $color->create_user_code = Auth::guard('admin')->user()->code;
                    $color->save();
                }
            }
        }


        //Logo Ayarları:

        $use_same_logo = ShopKeyValue::Where('key', 'use_same_logo')->first();

        if (!$use_same_logo) {
            $use_same_logo = new ShopKeyValue();
            $use_same_logo->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $use_same_logo->key = 'use_same_logo';
            $use_same_logo->create_user_code = Auth::guard('admin')->user()->code;
        }

        $use_same_logo->value = $request->has('use_same_logo') ? '1' : '0';
        $use_same_logo->update_user_code = Auth::guard('admin')->user()->code;
        $use_same_logo->save();

        ShopKeyValue::Where('key', 'shop_logo')->delete();
        if ($request->has('use_same_logo') && $request->hasFile('logo')) {
            $logo = $request->file('logo');
            $path = 'shop_files/img/logo/';
            $name = "logo." . $logo->getClientOriginalExtension();
            $logo->move(public_path($path), $name);

            $logoVal = new ShopKeyValue();
            $logoVal->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
            $logoVal->key = 'shop_logo';
            $logoVal->value = $path . $name;
            $logoVal->create_user_code = Auth::guard('admin')->user()->code;
            $logoVal->save();
        }


        return redirect()->back()->with('success', 'Ayarlar başarılı bir şekilde kaydedildi');
    }
}
