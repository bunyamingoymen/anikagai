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
        $clauses = AuthorizationClause::Where('deleted', 0)->take(10)->get();
        $currentCount = 1;
        $pageCountTest = AuthorizationClause::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.auth.clauses.list", ["clauses" => $clauses, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
    }

    public function AuthClauseCreateScreen()
    {

        return view("admin.auth.clauses.create");
    }

    public function AuthClauseCreate(Request $request)
    {
        $clause = new AuthorizationClause();

        $clause_code = AuthorizationClause::orderBy('created_at', 'DESC')->first();
        if ($clause_code) $clause->code = $clause_code->code + 1;
        else $clause->code = 1;

        $clause->text = $request->text;
        $clause->description = $request->description;

        $clause->create_user_code = Auth::user()->code;

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

        $clause->update_user_code = Auth::user()->code;

        $clause->save();

        return redirect()->route('admin_authclause_list')->with("success", Config::get('error.error_codes.10030012'));
    }

    public function AuthClauseDelete(Request $request)
    {
        $clause = AuthorizationClause::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$clause)
            return redirect()->back()->with("error", Config::get('error.error_codes.0030013'));

        $clause->deleted = 1;
        $clause->update_user_code = Auth::user()->code;
        $clause->save();
        return redirect()->route('admin_authclause_list')->with("success", Config::get('error.error_codes.10030013'));
    }

    public function AuthClauseGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $clauses = AuthorizationClause::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $clauses;
    }
}
