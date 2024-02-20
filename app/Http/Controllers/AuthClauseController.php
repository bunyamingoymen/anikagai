<?php

namespace App\Http\Controllers;

use App\Models\AuthorizationClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AuthClauseController extends Controller
{
    public function AuthClauseList()
    {
        return view("admin.auth.clauses.list");
    }

    public function AuthClauseCreateScreen()
    {

        return view("admin.auth.clauses.create");
    }

    public function AuthClauseCreate(Request $request)
    {
        $clause = new AuthorizationClause();

        $clause->code = AuthorizationClause::max('code') + 1;

        $clause->text = $request->text;
        $clause->description = $request->description;

        $clause->create_user_code = Auth::guard('admin')->user()->code;

        $clause->save();

        return redirect()->route('admin_authclause_list')->with("success", Config::get('error.error_codes.10030010'));
    }

    public function AuthClauseUpdateScreen(Request $request)
    {

        $clause = AuthorizationClause::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$clause)
            return redirect()->back()->with("error", Config::get('error.error_codes.0030002'));

        return view("admin.auth.clauses.UPDATE", ["clause" => $clause]);
    }

    public function AuthClauseUpdate(Request $request)
    {
        $clause = AuthorizationClause::Where('code', $request->code)->Where('deleted', 0)->first();


        if (!$clause)
            return redirect()->back()->with("error", Config::get('error.error_codes.0030012'));

        $clause->text = $request->text;
        $clause->description = $request->description;

        $clause->update_user_code = Auth::guard('admin')->user()->code;

        $clause->save();

        return redirect()->route('admin_authclause_list')->with("success", Config::get('error.error_codes.10030012'));
    }

    public function AuthClauseDelete(Request $request)
    {
        $clause = AuthorizationClause::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$clause)
            return redirect()->back()->with("error", Config::get('error.error_codes.0030013'));

        $clause->deleted = 1;
        $clause->update_user_code = Auth::guard('admin')->user()->code;
        $clause->save();
        return redirect()->route('admin_authclause_list')->with("success", Config::get('error.error_codes.10030013'));
    }

    public function AuthClauseGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $clauses = AuthorizationClause::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        $page_count = ceil(AuthorizationClause::Where('deleted', 0)->count() / $this->showCount);
        return ['clauses' => $clauses, "page_count" => $page_count];
    }
}
