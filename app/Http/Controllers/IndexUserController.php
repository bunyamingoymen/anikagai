<?php

namespace App\Http\Controllers;

use App\Models\IndexUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class IndexUserController extends Controller
{
    public function indexUserList()
    {
        return view("admin.indexUsers.list");
    }

    public function indexUserCreateScreen()
    {
        return view("admin.indexUsers.create");
    }

    public function indexUserCreate(Request $request)
    {
        $indexUser = new IndexUser();

        $indexUser->code = IndexUser::max('code') + 1;

        $user_email = IndexUser::Where('email', $request->email)->first();
        if ($user_email) {
            return redirect()->back()->with('error', Config::get('error.error_codes.0010010'));
        }

        $username = indexUser::Where('username', $request->username)->first();

        if ($username) {
            return redirect()->back()->with('error', "Bu Kullanıcı Adı Alınamaz..");
        }

        $indexUser->name = $request->name;
        $indexUser->username = $request->username;
        $indexUser->email = $request->email;
        $indexUser->password = Hash::make($request->password);

        if ($request->hasFile('image')) {
            // Dosyayı al
            $file = $request->file('image');

            $path = public_path('files/users/profile');
            $name = $indexUser->code . "." . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $indexUser->image = "files/users/profile/" . $name;
        } else {
            $indexUser->image = "";
        }

        $indexUser->description = $request->description;

        $indexUser->save();

        return redirect()->route('admin_indexuser_list')->with("success", Config::get('success.success_codes.10010010'));
    }

    public function indexUserUpdateScreen(Request $request)
    {
        $indexUser = IndexUser::Where('code', $request->code)->first();

        if (!$indexUser)
            return redirect()->back()->with("error", Config::get('error.error_codes.0010002'));

        return view("admin.indexUsers.update", ["indexUser" => $indexUser]);
    }

    public function indexUserUpdate(Request $request)
    {
        $indexUser = IndexUser::Where('code', $request->code)->first();

        if (!$indexUser)
            return redirect()->back()->with("error", Config::get('error.error_codes.0010012'));

        $user_email = indexUser::Where('email', $request->email)->Where('code', "!=", $request->code)->first();

        if ($user_email) {
            return redirect()->back()->with('error', Config::get('error.error_codes.0010010'));
        }

        $username = indexUser::Where('username', $request->username)->Where('code', "!=", $request->code)->first();

        if ($username) {
            return redirect()->back()->with('error', "Bu Kullanıcı Adı Alınamaz..");
        }

        $indexUser->name = $request->name;
        $indexUser->username = $request->username;
        $indexUser->email = $request->email;
        $indexUser->password = Hash::make($request->password);

        if ($request->hasFile('image')) {
            // Dosyayı al
            $file = $request->file('image');

            $path = public_path('files/users/profile');
            $name = $indexUser->code . "." . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $indexUser->image = "files/users/profile/" . $name;
        }

        $indexUser->description = $request->description;

        $indexUser->save();

        return redirect()->route('admin_indexuser_list')->with("success", Config::get('success.success_codes.10010012'));
    }

    public function indexUserDelete(Request $request)
    {
        $indexUser = IndexUser::Where('code', $request->code)->first();

        if (!$indexUser)
            return redirect()->back()->with("error", Config::get('error.error_codes.0010013'));

        //$indexUser->delete();
        $indexUser->deleted = 0;
        $indexUser->is_active = 0;
        $indexUser->save();
        return redirect()->route('admin_indexuser_list')->with("success", Config::get('success.success_codes.10010013'));
    }

    public function indexUserchangeActive(Request $request)
    {
        $user = IndexUser::Where('code', $request->code)->first();

        if (!$user)
            return redirect()->back()->with("error", Config::get('error.error_codes.0010012'));


        if ($user->is_active == 1)
            $user->is_active = 0;
        else
            $user->is_active = 1;

        $user->save();


        return redirect()->back()->with('success', Config::get('success.success_codes.10010012'));
    }

    public function indexUserGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $indexUsers = IndexUser::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        $pageCount = ceil(IndexUser::Where('deleted', 0)->count() / $this->showCount);


        return ['indexUsers' => $indexUsers, 'pageCount' => $pageCount];
    }
}
