<?php

namespace App\Http\Controllers;

use App\Models\AuthorizationGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userList()
    {
        $title = "Kullanıcılar";
        $users = User::Where('deleted', 0)->Where('code', '!=', 0)->take(10)->get();
        $currentCount = 1;
        $pageCountTest = User::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.users.list", ["title" => $title, "users" => $users, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
    }

    public function userCreateScreen()
    {
        $title = "Yeni Kullanıcı Oluştur";

        $users_groups = AuthorizationGroup::Where('deleted', 0)->get();

        return view("admin.users.create", ["title" => $title, 'users_groups' => $users_groups]);
    }

    public function userCreate(Request $request)
    {
        $user = new User();

        $user_code = User::orderBy('created_at', 'DESC')->first();
        if ($user_code) $user->code = $user_code->code + 1;
        else $user->code = 1;

        $user_email = User::Where('email', $request->email)->first();
        if ($user_email) {
            return redirect()->back()->with('error', Config::get('error.error_codes.0010010'));
        }

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($request->hasFile('image')) {
            // Dosyayı al
            $file = $request->file('image');

            $path = public_path('admin/assets/images/users');
            $name = $user->code . "." . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $user->image = "admin/assets/images/users/" . $name;
        } else {
            $user->image = "";
        }

        $user->description = $request->description;
        $user->user_type = $request->user_type;
        if ($request->admin)
            $user->admin = 1;
        else
            $user->admin = 0;


        $user->create_user_code = Auth::user()->code;

        $user->save();

        return redirect()->route('admin_user_list')->with("success", $this->successCreateMessage);
    }

    public function userUpdateScreen(Request $request)
    {

        $user = User::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$user)
            return redirect()->back()->with("error", Config::get('error.error_codes.0010002'));

        $title = "Kullanıcıyı Güncelle";

        $users_groups = AuthorizationGroup::Where('deleted', 0)->get();

        return view("admin.users.update", ["title" => $title, "user" => $user, "users_groups" => $users_groups]);
    }

    public function userUpdate(Request $request)
    {
        $user = User::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$user)
            return redirect()->back()->with("error", Config::get('error.error_codes.0010012'));

        $user_email = User::Where('email', $request->email)->Where('code', "!=", $request->code)->first();

        if ($user_email) {
            return redirect()->back()->with('error', Config::get('error.error_codes.0010010'));
        }

        if (($user->code == 0 || $user->code == 1) && ($request->user_type != 0 || $request->code != 1)) {
            return redirect()->back()->with('error', Config::get('error.error_codes.0000000'));
        }

        if (($user->code == 0 || $user->code == 1) && !$request->admin) {
            return redirect()->back()->with('error', Config::get('error.error_codes.0000000'));
        }

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($request->hasFile('image')) {
            // Dosyayı al
            $file = $request->file('image');

            $path = public_path('admin/assets/images/users');
            $name = $user->code . "." . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $user->image = "admin/assets/images/users/" . $name;
        }

        $user->description = $request->description;
        $user->user_type = $request->user_type;
        if ($request->admin)
            $user->admin = 1;
        else
            $user->admin = 0;

        $user->update_user_code = Auth::user()->code;

        $user->save();

        return redirect()->back()->with("success", $this->successCreateMessage);
    }

    //code:0 ve code:1 kullanıcıları ne olursa olsun silinmemeli.
    public function userDelete(Request $request)
    {
        $user = User::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$user)
            return redirect()->back()->with("error", Config::get('error.error_codes.0010013'));

        if ($user->code == 0 || $user->code == 1) {
            return redirect()->back()->with("error", Config::get('error.error_codes.0000000'));
        }

        $user->deleted = 1;
        $user->update_user_code = Auth::user()->code;
        $user->save();
        return redirect()->route('admin_user_list')->with("success", $this->successDeleteMessage);
    }

    public function userChangePassword(Request $request)
    {

        $user = User::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$user)
            return redirect()->back()->with("error", Config::get('error.error_codes.0010112'));

        //dd(Auth::user()->user_type);
        if (!(($user->user_type == 0 || $user->user_type == 1) && (Auth::user()->user_type == 0 || Auth::user()->user_type == 1))) {
            return redirect()->back()->with("error", Config::get('error.error_codes.0000000'));
        }

        /*
                if (($user->code == 0) && (Auth::user()->user_type != 0)) {
            return redirect()->back()->with("error", "Bu Kullanıcının şifresini değiştiremezsiniz");
        }*/

        $user->password = Hash::make($request->password);
        $user->update_user_code = Auth::user()->code;
        $user->save();

        return redirect()->back()->with("success", "Başarılı Bir Şekilde Şifre Değiştirildi.");
    }

    public function userGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $users = User::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $users;
    }
}
