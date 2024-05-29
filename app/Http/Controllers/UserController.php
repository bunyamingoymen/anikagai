<?php

namespace App\Http\Controllers;

use App\Models\AuthorizationGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function userList()
    {
        return view("admin.users.list",);
    }

    public function userCreateScreen()
    {
        $users_groups = AuthorizationGroup::Where('deleted', 0)->get();
        return view("admin.users.create", ['users_groups' => $users_groups]);
    }

    public function userCreate(Request $request)
    {
        $user = new User();

        $user->code = User::max('code') + 1;

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

        $user->facebook = $request->facebook;
        $user->instagram = $request->instagram;
        $user->twitter = $request->twitter;
        $user->discord = $request->discord;


        $user->create_user_code = Auth::guard('admin')->user()->code;

        $user->save();

        return redirect()->route('admin_user_list')->with("success", Config::get('success.success_codes.10010010'));
    }

    public function userUpdateScreen(Request $request)
    {

        $user = User::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$user)
            return redirect()->back()->with("error", Config::get('error.error_codes.0010002'));

        $users_groups = AuthorizationGroup::Where('deleted', 0)->get();

        return view("admin.users.update", ["user" => $user, "users_groups" => $users_groups]);
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

        if (!(Auth::guard('admin')->user()->code == 0 || Auth::guard('admin')->user()->code == 1) && ($request->user_type == 0 || $request->code == 1)) {
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

        $user->facebook = $request->facebook;
        $user->instagram = $request->instagram;
        $user->twitter = $request->twitter;
        $user->discord = $request->discord;

        $user->update_user_code = Auth::guard('admin')->user()->code;

        $user->save();

        return redirect()->back()->with("success", Config::get('success.success_codes.10010012'));
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
        $user->update_user_code = Auth::guard('admin')->user()->code;
        $user->save();
        return redirect()->route('admin_user_list')->with("success", Config::get('success.success_codes.10010013'));
    }

    public function userChangePassword(Request $request)
    {

        $user = User::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$user)
            return redirect()->back()->with("error", Config::get('error.error_codes.0010112'));

        if (!(Auth::guard('admin')->user()->code == 0 || Auth::guard('admin')->user()->code == 1) && ($user->user_type == 0 || $user->user_type == 1)) {
            return redirect()->back()->with('error', Config::get('error.error_codes.0000000'));
        }

        /*
                if (($user->code == 0) && (Auth::guard('admin')->user()->user_type != 0)) {
            return redirect()->back()->with("error", "Bu Kullanıcının şifresini değiştiremezsiniz");
        }*/

        $user->password = Hash::make($request->password);
        $user->update_user_code = Auth::guard('admin')->user()->code;
        $user->save();

        return redirect()->back()->with("success", Config::get('success.success_codes.10010112'));
    }

    public function userGetData(Request $request)
    {
        $take  = $request->showingCount ? $request->showingCount : Config::get('app.showCount');
        $skip = (($request->page - 1) * $take);
        $users = DB::table('users')
            ->where("users.deleted", 0)
            ->Where('user_type', '!=', '0')
            ->join('authorization_groups', 'authorization_groups.code', '=', 'users.user_type')
            ->select('users.*', 'authorization_groups.text as group_name')
            ->skip($skip)->take($take)->get();
        //$users = User::Where('deleted', 0)->Where('user_type', '!=', '0')->skip($skip)->take($take)->get();
        $pageCount = ceil(DB::table('users')
            ->where("users.deleted", 0)
            ->Where('user_type', '!=', '0')
            ->join('authorization_groups', 'authorization_groups.code', '=', 'users.user_type')
            ->select('users.*', 'authorization_groups.text as group_name')->count() / $take);


        return ['users' => $users, 'pageCount' => $pageCount];
    }
}
