<?php

namespace App\Http\Controllers;

use App\Models\FollowUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class FollowUserController extends Controller
{
    public function followUser(Request $request)
    {
        $follow = new FollowUser();

        $follow_code = FollowUser::orderBy('created_at', 'DESC')->first();
        if ($follow_code) $follow->code = $follow_code->code + 1;
        else $follow->code = 1;

        $follow->followed_user_code = $request->followed_user_code;
        $follow->user_code = Auth::user()->code;

        $follow->save();

        return redirect()->back()->with("success", Config::get('success.success_codes.10140012'));
    }
    public function unfollowUser(Request $request)
    {
        $follow = FollowUser::Where('followed_user_code', $request->followed_user_code)->Where('user_code', Auth::user()->code)->first();

        if (!$follow) {
            return redirect()->back()->with('error', Config::get('error.error_codes.0140012'));
        }

        $follow->delete();

        return redirect()->back()->with("success", Config::get('success.success_codes.10140112'));
    }
}
