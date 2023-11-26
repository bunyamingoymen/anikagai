<?php

namespace App\Http\Middleware;

use App\Models\AuthorizationClauseGroup;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();
        $accessCode = ((Auth::guard('admin')->user()->user_type == 0 || Auth::guard('admin')->user()->user_type == 1) || (count(AuthorizationClauseGroup::Where('clause_id', Config::get('access.path_access_codes.' . $path))->Where('group_id', Auth::guard('admin')->user()->user_type)->get()) > 0)) ? 1 : 0;
        if ($accessCode == 1)
            return $next($request);
        else
            return redirect()->back();
    }
}
