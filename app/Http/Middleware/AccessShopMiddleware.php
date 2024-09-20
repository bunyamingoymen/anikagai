<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AccessShopMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('shop_users')->user() || Auth::guard('shop_sellers')->user()) {
            return $next($request);
        }
        return redirect()->route('shop_login')->with('error', 'İlk önce giriş yapmanız gerekmektedir');
    }
}
