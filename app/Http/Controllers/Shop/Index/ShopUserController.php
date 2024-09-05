<?php

namespace App\Http\Controllers\Shop\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopUserController extends Controller
{
    public function login(Request $request){
        //dd($request->toArray());
        if (Auth::guard('shop_users')->attempt(['email' => $request->email, 'password' => $request->password]) || Auth::guard('shop_users')->attempt(['username' => $request->email, 'password' => $request->password])){
            return redirect()->route('shop_index');
        }
        dd('başarısız');
    }
}
