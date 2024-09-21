<?php

namespace App\Http\Controllers\Shop\Index;

use App\Http\Controllers\Controller;
use App\Models\Shop\ShopSellers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ShopSellerController extends Controller
{
    public function login(Request $request)
    {
        //dd($request->toArray());
        if (Auth::guard('shop_sellers')->attempt(['email' => $request->email, 'password' => $request->password]) || Auth::guard('shop_sellers')->attempt(['username' => $request->email, 'password' => $request->password])) {
            return redirect()->route('shop_index');
        }
        return redirect()->back()->with('error', 'Giriş Başarısız');
    }

    public function register(Request $request)
    {
        $email = $request->email;
        $username = $request->username;

        if (ShopSellers::Where('deleted', 0)->where('email', $email)->exists()) return redirect()->back()->with('error', 'Bu E-mail adresi kullanımda');
        if (ShopSellers::Where('deleted', 0)->where('username', $username)->exists()) return redirect()->back()->with('error', 'Bu kullanıcı adı kullanımda');

        $seller = new ShopSellers();
        $seller->code = $this->generateUniqueCode('shop_mysql', 'shop_sellers');
        $seller->username = $username;
        $seller->email = $email;
        $seller->password = Hash::make($request->password);
        $seller->create_user_code = 0;
        $seller->save();

        Auth::guard('shop_sellers')->login($seller);

        return redirect()->route('shop_index');
    }

    public function profile()
    {
        return view('shop.themes.kidol.sellerProfile');
    }

    public function changeSellerInformation(Request $request)
    {
        $user = ShopSellers::Where('deleted', 0)->where('is_active', 1)->where('code', Auth::guard('shop_sellers')->user()->code)->first();

        $user->show_name = $request->show_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $user->description = $request->description;

        $user->IBAN = $request->IBAN;
        $user->IBAN_Name = $request->IBAN_Name;

        $user->max_cargo_price = $request->max_cargo_price;

        $user->facebook = $request->facebook;
        $user->instagram = $request->instagram;
        $user->twitter = $request->twitter;
        $user->discord = $request->discord;
        $user->website = $request->website;

        $user->save();
        
        return redirect()->back()->with('success', 'Başarılı bir şekilde güncellendi');
    }

    public function changePassword(Request $request)
    {
        $user = ShopSellers::Where('deleted', 0)->where('is_active', 1)->where('code', Auth::guard('shop_sellers')->user()->code)->first();
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Mevcut Şifre Yanlış');
        }
        if ($request->new_password != $request->new_password_repeat) {
            return redirect()->back()->with('error', 'Şifre ile şifre tekrarı aynı değil');
        }
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Şifre başarıyla değiştirildi!');
    }

    public function logout()
    {
        if (Auth::guard('shop_sellers')->user()) Auth::guard('shop_sellers')->logout();
        return redirect()->route('shop_index');
    }
}
