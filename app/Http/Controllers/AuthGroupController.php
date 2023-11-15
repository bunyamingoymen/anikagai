<?php

namespace App\Http\Controllers;

use App\Models\AuthorizationGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthGroupController extends Controller
{
    public function AuthGroupList()
    {
        $title = "Kullanıcı Grupları";
        $groups = AuthorizationGroup::Where('deleted', 0)->take(10)->get();
        $currentCount = 1;
        $pageCountTest = AuthorizationGroup::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.auth.groups.list", ["title" => $title, "groups" => $groups, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
    }

    public function AuthGroupCreateScreen()
    {
        $title = "Kullanıcı Grubu Oluştur";

        return view("admin.auth.groups.create", ["title" => $title]);
    }

    public function AuthGroupCreate(Request $request)
    {
        $group = new AuthorizationGroup();

        $group_code = AuthorizationGroup::orderBy('created_at', 'DESC')->first();
        if ($group_code) $group->code = $group_code->code + 1;
        else $group->code = 1;

        $group->text = $request->text;
        $group->description = $request->description;

        $group->create_user_code = Auth::user()->code;

        $group->save();

        return redirect()->route('admin_authgroup_list')->with("success", $this->successCreateMessage);
    }

    public function AuthGroupUpdateScreen(Request $request)
    {

        $group = AuthorizationGroup::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$group)
            return redirect()->back()->with("error", $this->errorsUpdateMessage . " Error: 0x00001");

        $title = "Kullanıcı Grubunu Güncelle";

        return view("admin.auth.groups.update", ["title" => $title, "group" => $group]);
    }

    public function AuthGroupUpdate(Request $request)
    {
        $group = AuthorizationGroup::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$group)
            return redirect()->back()->with("error", $this->errorsUpdateMessage . " Error: 0x00002");

        $group->text = $request->text;
        $group->description = $request->description;

        $group->update_user_code = Auth::user()->code;

        $group->save();

        return redirect()->route('admin_authgroup_list')->with("success", $this->successCreateMessage);
    }

    public function AuthGroupDelete(Request $request)
    {
        $group = AuthorizationGroup::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$group)
            return redirect()->back()->with("error", $this->errorsDeleteMessage . " Error: 0x00003");

        $group->deleted = 1;
        $group->update_user_code = Auth::user()->code;
        $group->save();

        return redirect()->route('admin_authgroup_list')->with("success", $this->successDeleteMessage);
    }

    public function AuthGroupGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $groups = AuthorizationGroup::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $groups;
    }
}
