<?php

namespace App\Http\Controllers;

use App\Models\AuthorizationClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthClauseController extends Controller
{
    public function AuthClauseList()
    {
        $title = "Yetki Maddeleri";
        $clauses = AuthorizationClause::Where('deleted', 0)->take(10)->get();
        $currentCount = 1;
        $pageCountTest = AuthorizationClause::Where('deleted', 0)->count();
        if ($pageCountTest % 10 == 0)
            $pageCount = $pageCountTest / 10;
        else
            $pageCount = intval($pageCountTest / 10) + 1;
        return view("admin.auth.clauses.list", ["title" => $title, "clauses" => $clauses, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
    }

    public function AuthClauseCreateScreen()
    {
        $title = "Yetki Maddesi Ekle";

        return view("admin.auth.clauses.create", ["title" => $title]);
    }

    public function AuthClauseCreate(Request $request)
    {
        $clause = new AuthorizationClause();

        $clause_code = AuthorizationClause::orderBy('created_at', 'DESC')->first();
        if ($clause_code) $clause->code = $clause_code->code;
        else $clause->code = 1;

        $clause->text = $request->text;
        $clause->description = $request->description;

        $clause->create_user_code = Auth::user()->code;

        $clause->save();

        return redirect()->route('admin_authclause_list')->with("success", $this->successCreateMessage);
    }

    public function AuthClauseUpdateScreen(Request $request)
    {

        $clause = AuthorizationClause::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$clause)
            redirect()->back()->with("error", $this->errorsUpdateMessage . " Error: 0x00004");

        $title = "Yetki Maddesini Güncelle";

        return view("admin.auth.clauses.UPDATE", ["title" => $title, "clause" => $clause]);
    }

    public function AuthClauseUpdate(Request $request)
    {
        $clause = AuthorizationClause::Where('code', $request->code)->Where('deleted', 0)->first();

        
        if (!$clause)
            redirect()->back()->with("error", $this->errorsUpdateMessage . " Error: 0x00005");

        $clause->text = $request->text;
        $clause->description = $request->description;

        $clause->update_user_code = Auth::user()->code;

        $clause->save();

        return redirect()->route('admin_authclause_list')->with("success", $this->successCreateMessage);
    }

    public function AuthClauseDelete(Request $request)
    {
        $clause = AuthorizationClause::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$clause)
            redirect()->back()->with("error", $this->errorsDeleteMessage . " Error: 0x00006");

        $clause->deleted = 1;
        $clause->update_user_code = Auth::user()->code;
        $clause->save();
        return redirect()->route('admin_authclause_list')->with("success", $this->successDeleteMessage);
    }

    public function AuthClauseGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $clauses = AuthorizationClause::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $clauses;
    }
}
