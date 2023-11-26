<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('admin_login_screen');
    }

    public function handle($request, Closure $next, ...$guards)
    {
        return $next($request);
        // Kullanıcıyı doğrula
        if (Auth::guard('admin')->user()) {
            // Kullanıcı admin guard'ı ile doğrulandıysa devam et
            //return redirect()->route('admin_index');
            if (Auth::guard('admin')->user()->admin == 1)
                return $next($request);
            else {
                Auth::guard('admin')->logout();
                return redirect()->route('admin_login')->with('error', Config::get('error.error_codes.0000000'));
            }
        } else {
            // Kullanıcı admin guard'ı ile doğrulanmadıysa uygun bir işlem yapabilirsiniz.
            // Örneğin, bir hata mesajı gönderme veya yönlendirme yapabilirsiniz.
            return redirect()->route('admin_login');
        }
    }
}
