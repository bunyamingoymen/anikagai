<?php

namespace App\Http\Controllers;

use App\Models\AuthorizationGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AuthGroupController extends Controller
{
    public function AuthGroupList()
    {
        return view("admin.auth.groups.list");
    }

    public function AuthGroupCreateScreen()
    {

        return view("admin.auth.groups.create");
    }

    public function AuthGroupCreate(Request $request)
    {
        $group = new AuthorizationGroup();

        $group->code = AuthorizationGroup::max('code') + 1;

        $group->text = $request->text;
        $group->description = $request->description;

        $group->create_user_code = Auth::guard('admin')->user()->code;

        $group->save();

        return redirect()->route('admin_authgroup_list')->with("success", Config::get('success.success_codes.10040010'));
    }

    public function AuthGroupUpdateScreen(Request $request)
    {

        $group = AuthorizationGroup::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$group)
            return redirect()->back()->with("error", Config::get('error.error_codes.0040002'));

        return view("admin.auth.groups.update", ["group" => $group]);
    }

    public function AuthGroupUpdate(Request $request)
    {
        $group = AuthorizationGroup::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$group)
            return redirect()->back()->with("error", Config::get('error.error_codes.0040012'));

        $group->text = $request->text;
        $group->description = $request->description;

        $group->update_user_code = Auth::guard('admin')->user()->code;

        $group->save();

        return redirect()->route('admin_authgroup_list')->with("success", Config::get('success.success_codes.10040012'));
    }

    public function AuthGroupDelete(Request $request)
    {
        $group = AuthorizationGroup::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$group)
            return redirect()->back()->with("error", Config::get('error.error_codes.0040013'));

        $group->deleted = 1;
        $group->update_user_code = Auth::guard('admin')->user()->code;
        $group->save();

        return redirect()->route('admin_authgroup_list')->with("success", Config::get('success.success_codes.10040013'));
    }

    public function AuthGroupGetData(Request $request)
    {
        $take  = $request->showingCount ? $request->showingCount : Config::get('app.showCount');
        $skip = (($request->page - 1) * $take);
        $groups = AuthorizationGroup::Where('deleted', 0)->skip($skip)->take($take)->get();
        $page_count = ceil(AuthorizationGroup::Where('deleted', 0)->count() / $take);
        return ['groups' => $groups, "page_count" => $page_count];
    }
}
