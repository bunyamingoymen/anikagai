<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\KeyValue;
use App\Models\Webtoon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;

class RssController extends Controller
{
    public function getRSS()
    {
        $webtoon_episodes = DB::table('webtoon_episodes')
            ->Where('webtoon_episodes.deleted', 0)
            ->join('webtoons', 'webtoons.code', '=', 'webtoon_episodes.webtoon_code')
            ->select('webtoon_episodes.*', 'webtoons.short_name as webtoon_short_name', 'webtoons.name as webtoon_name', 'webtoons.image as webtoon_image')
            ->latest()
            ->get();

        $anime_episodes = DB::table('anime_episodes')
            ->Where('anime_episodes.deleted', 0)
            ->join('animes', 'animes.code', '=', 'anime_episodes.anime_code')
            ->select('anime_episodes.*', 'animes.short_name as anime_short_name', 'animes.name as anime_name', 'animes.image as anime_image')
            ->latest()
            ->get();

        $des = KeyValue::Where("key", 'meta')->Where('value', 'description')->first();

        return response()->view('index.rss', [
            'webtoon_episodes' => $webtoon_episodes,
            'anime_episodes' => $anime_episodes,
            'des' => $des
        ])->header('Content-Type', 'text/xml');
    }
}
