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
        $groups = AuthorizationGroup::Where('deleted', 0)->take($this->showCount)->get();
        $currentCount = 1;
        $pageCountTest = AuthorizationGroup::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.auth.groups.list", ["groups" => $groups, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
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
        $skip = (($request->page - 1) * $this->showCount);
        $groups = AuthorizationGroup::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $groups;
    }
}
