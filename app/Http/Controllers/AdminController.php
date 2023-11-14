<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function loginScreen()
    {
        return view('admin.register.login');
    }

    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->deleted == 0 && Auth::user()->admin == 1)
                return redirect()->route('admin_index')->with("success", "Giriş Başarılı");
            else Auth::logout();
            return redirect()->route('admin_login_screen')->with('error', "Bu Arayüz İçin Erişiminiz Bulunmamaktadır.");
        }
        return redirect()->route('admin_login_screen')->with("error", "E-mail Adresi ya da Şifre Hatalı");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin_login_screen')->with("success", "Çıkış Başarılı");
    }
}
