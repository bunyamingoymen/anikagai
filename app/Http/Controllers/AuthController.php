<?php

namespace App\Http\Controllers;

use App\Models\AuthorizationClause;
use App\Models\AuthorizationClauseGroup;
use App\Models\AuthorizationGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function authList()
    {
        $groups = AuthorizationGroup::Where('deleted', 0)->get();
        $clauses = AuthorizationClause::Where('deleted', 0)->get();

        return view('admin.auth.auth.list', ['groups' => $groups, 'clauses' => $clauses]);
    }

    public function authChange(Request $request)
    {
        AuthorizationClauseGroup::Where("group_id", $request->groupSelectBox)->delete();
        $selectedClauses = $request->selected_clauses ?? [];
        foreach ($selectedClauses as $item) {
            $new_clause_group = new AuthorizationClauseGroup();

            $new_clause_group->code = AuthorizationClauseGroup::max('code') + 1;

            $new_clause_group->group_id = $request->groupSelectBox;
            $new_clause_group->clause_id = $item;
            $new_clause_group->create_user_code = Auth::guard('admin')->user()->code;
            $new_clause_group->save();
        }

        return redirect()->route('admin_auth_list')->with("success", Config::get('success.success_codes.10050012'));
    }

    public function AuthGroupGetData(Request $request)
    {
        $includeData = DB::table('authorization_clause_groups')
            ->where('authorization_groups.code', $request->group_code)
            ->join('authorization_groups', 'authorization_clause_groups.group_id', '=', 'authorization_groups.code')
            ->join('authorization_clauses', 'authorization_clause_groups.clause_id', '=', 'authorization_clauses.code')
            ->select('authorization_clauses.text as clause_text', 'authorization_clauses.code as clause_code')
            ->get();

        // JSON olarak döndür
        return response()->json($includeData);
    }
}
