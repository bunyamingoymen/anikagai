<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->user() && Auth::guard('admin')->user()->admin == 1) {
            if (Auth::guard('admin')->user()->user_type == 0) {
                return $next($request);
            }
            return redirect()->route('admin_index');
        }
        return redirect()->route('admin_login_screen')->with("error", "Buna Erişim Yetkiniz Bulunmamaktadır.");
    }
}
