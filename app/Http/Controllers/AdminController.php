<?php

namespace App\Http\Controllers;

use App\Models\FollowUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $title = "Anaysafa";
        return view('admin.index', ["title" => $title]);
    }

    public function profile(Request $request)
    {
        $title = "Profil";
        $followed = 0;

        if ($request->has('code')) {
            $user = User::Where('code', $request->code)->first();
            $follow = FollowUser::Where('followed_user_code', $request->code)->Where('user_code', Auth::user()->code)->first();
            if ($follow) $followed = 1;
        } else {
            $user = Auth::user();
        }

        $followed_users = DB::table('follow_users')
            ->Where('follow_users.user_code', $user->code)
            ->join('users', 'users.code', '=', 'follow_users.followed_user_code')
            ->select('users.code as user_code', 'users.name as user_name', 'users.surname as user_surname', 'users.image as user_image', 'users.description as user_description')
            ->get();

        return view('admin.users.profile', ["title" => $title, 'user' => $user, 'followed' => $followed, 'followed_users' => $followed_users]);
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
