<?php

namespace App\Http\Controllers\Shop\Index;

use App\Http\Controllers\Controller;
use App\Models\Shop\ShopUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ShopUserController extends Controller
{
    public function login(Request $request)
    {
        //dd($request->toArray());
        if (Auth::guard('shop_users')->attempt(['email' => $request->email, 'password' => $request->password]) || Auth::guard('shop_users')->attempt(['username' => $request->email, 'password' => $request->password])) {
            return redirect()->route('shop_index');
        }
        return redirect()->back()->with('error', 'Giriş Başarısız');
    }

    public function register(Request $request)
    {
        //dd($request->toArray());
        $email = $request->email;
        $username = $request->username;

        if (ShopUsers::Where('deleted', 0)->where('email', $email)->exists()) return redirect()->back()->with('error', 'Bu E-mail adresi kullanımda');
        if (ShopUsers::Where('deleted', 0)->where('username', $username)->exists()) return redirect()->back()->with('error', 'Bu kullanıcı adı kullanımda');

        $user = new ShopUsers();
        $user->code = $this->generateUniqueCode('shop_mysql', 'shop_users');
        $user->username = $username;
        $user->email = $email;
        $user->password = Hash::make($request->password);
        $user->create_user_code = 0;
        $user->save();

        Auth::guard('shop_users')->login($user);

        return redirect()->route('shop_index');
    }

    public function profile()
    {
        return view('shop.themes.kidol.userProfile');
    }

    public function logout()
    {

        if (Auth::guard('shop_users')->user()) Auth::guard('shop_users')->logout();
        return redirect()->route('shop_index');
    }
}
