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
        $returnArray = [];
        $anime_active_key = KeyValue::Where('key', 'anime_active')->first();
        $anima_active = $anime_active_key ? $anime_active_key->value : 0;

        $webtoon_active_key = KeyValue::Where('key', 'webtoon_active')->first();
        $webtoon_active = $webtoon_active_key ? $webtoon_active_key->value : 0;
        if ($anima_active == 1) {
            $anime_episodes = DB::table('anime_episodes')
                ->Where('anime_episodes.deleted', 0)
                ->Where('anime_episodes.video', '!=', '')
                ->join('animes', 'animes.code', '=', 'anime_episodes.anime_code')
                ->select('anime_episodes.*', 'animes.short_name as anime_short_name', 'animes.name as anime_name', 'animes.image as anime_image')
                ->latest()
                ->get();

            $returnArray['anime_episodes'] = $anime_episodes;
        }

        if ($webtoon_active == 1) {
            $webtoon_episodes = DB::table('webtoon_episodes')
                ->Where('webtoon_episodes.deleted', 0)
                ->join('webtoons', 'webtoons.code', '=', 'webtoon_episodes.webtoon_code')
                ->select('webtoon_episodes.*', 'webtoons.short_name as webtoon_short_name', 'webtoons.name as webtoon_name', 'webtoons.image as webtoon_image')
                ->latest()
                ->get();

            $returnArray['webtoon_episodes'] = $webtoon_episodes;
        }

        $des = KeyValue::Where("key", 'meta')->Where('value', 'description')->first();

        $returnArray['des'] = $des;

        return response()->view('index.rss', $returnArray)->header('Content-Type', 'text/xml');
    }
}
