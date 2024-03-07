<?php

namespace App\Http\Middleware;

use App\Models\Anime;
use App\Models\AnimeEpisode;
use App\Models\Webtoon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class ClickCountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $short_name = $request->short_name;
        $route_name = Route::currentRouteName(); // Route'un adını alır;

        $ipAddress = $request->ip();
        $key = "click_count:{$short_name}:{$route_name}:{$ipAddress}";
        $title = "";
        if ($route_name  == 'animeDetail' || $route_name == 'watch') {
            $animeDetail = Anime::Where('short_name', $short_name)->first();
            if ($route_name  == 'animeDetail') {
                $title = $animeDetail->name . " - " . env('APP_NAME');
            } else if ($route_name == 'watch') {
                $title = $animeDetail->name . " - " . $request->season . ".Sezon " . " - " . $request->episode . ".Bölüm" . " - " . env('APP_NAME');
            }
        } else if ($route_name  == 'webtoonDetail' || $route_name == 'read') {
            $webtoonDetail = Webtoon::Where('short_name', $short_name)->first();
            if ($route_name  == 'webtoonDetail') {
                $title = $webtoonDetail->name . " - " . env('APP_NAME');
            } else if ($route_name  == 'read') {
                $title = $webtoonDetail->name . " - " . $request->season . ".Sezon " . " - " . $request->episode . ".Bölüm" . " - " . env('APP_NAME');
            }
        }


        if (!Cache::has($key)) {
            // İp adresine ait cache bulunmuyorsa veya süresi dolduysa
            Cache::put($key, 1, 60 * 60); // 60 dakika süreyle sakla
            if ($route_name == 'animeDetail' || $route_name == 'watch') {
                $anime = Anime::Where('short_name', $short_name)->first();
                if ($anime) {
                    $anime->click_count = $anime->click_count + 1;
                    $anime->save();
                } else abort(404);
            } else if ($route_name == 'webtoonDetail' || $route_name == 'read') {
                $webtoon = Webtoon::Where('short_name', $short_name)->first();
                if ($webtoon) {
                    $webtoon->click_count = $webtoon->click_count + 1;
                    $webtoon->save();
                } else abort(404);
            }
            // Örneğin: YourModel::where('ip_address', $ipAddress)->increment('click_count');
        }

        $request->merge(['title' => $title]);

        return $next($request);
    }
}
