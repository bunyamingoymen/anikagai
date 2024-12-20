<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectlfIndexAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()) {
            if (Auth::user()->is_active == 1) {
                return redirect()->route('profile');
            } else if (Auth::user()->is_active == 0) {
                Auth::logout();
                return redirect()->route('loginScreen')->with("error", "Hesabınız Aktif Değildir");
            }
        }
        return $next($request);
    }
}
