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

    public function logout()
    {
        if (Auth::guard('shop_sellers')->user()) Auth::guard('shop_sellers')->logout();
        return redirect()->route('shop_index');
    }
}
