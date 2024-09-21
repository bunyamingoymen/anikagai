<?php

namespace App\Http\Controllers\Shop\Index;

use App\Http\Controllers\Controller;
use App\Models\Shop\ShopUserAddress;
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
        $addresses = ShopUserAddress::Where('user_code', Auth::guard('shop_users')->user()->code)->orderBy('is_main_address', 'DESC')->get();
        return view('shop.themes.kidol.userProfile', compact('addresses'));
    }

    public function changeUserInformation(Request $request)
    {
        $user = ShopUsers::Where('deleted', 0)->where('is_active', 1)->where('code', Auth::guard('shop_users')->user()->code)->first();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        return redirect()->back()->with('success', 'Başarılı bir şekilde güncellendi');
    }

    public function changePassword(Request $request)
    {
        $user = ShopUsers::Where('deleted', 0)->where('is_active', 1)->where('code', Auth::guard('shop_users')->user()->code)->first();
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

    public function editAddress(Request $request)
    {
        $getOne = $this->getOneItem('shop_mysql', 'shop_user_addresses', $request->code, 'App\Models\Shop\ShopUserAddress', 1, [], false, false);

        $item = $getOne['item'];
        $item->user_code = Auth::guard('shop_users')->user()->code;
        $item->address_name = $request->address_name;
        $item->address = $request->address;
        $item->is_main_address = $request->is_main_address ? 1 : 0;
        $item->save();

        $other_address = ShopUserAddress::Where('user_code', Auth::guard('shop_users')->user()->code)->where('is_main_address', 1)->where('code', '!=', $getOne['code'])->get();

        foreach ($other_address as $address) {
            $address->is_main_address = 0;
            $address->save();
        }

        $message = $getOne['is_new'] ? 'Yeni Adres Eklendi' : 'Adres Güncellendi';
        return redirect()->back()->with('success', $message);
    }

    public function logout()
    {

        if (Auth::guard('shop_users')->user()) Auth::guard('shop_users')->logout();
        return redirect()->route('shop_index');
    }
}
