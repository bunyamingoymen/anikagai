<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\AnimeEpisode;
use App\Models\KeyValue;
use App\Models\NotificationUser;
use App\Models\Webtoon;
use App\Models\WebtoonEpisode;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Spatie\Sitemap\Sitemap;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function adultOn()
    {
        Cache::put('adult5', 1, 2629743);
        return redirect()->back();
    }

    public function sitemapGenerator()
    {
        $keyValue = KeyValue::Where('key', 'sitemap')->first();

        if (!$keyValue) {
            $keyValue = new KeyValue();
            $keyValue->code = KeyValue::max('code') + 1;
            $keyValue->key = "sitemap";
        }
        $keyValue->value = Carbon::now();
        $keyValue->save();

        $sitemap = Sitemap::create();

        $webtoons = Webtoon::where('deleted', 0)->get();
        $animes = Anime::where('deleted', 0)->get();
        foreach ($webtoons as $webtoon) {
            $sitemap->add(route('webtoonDetail', ['short_name' => $webtoon->short_name]), $webtoon->created_at);
            foreach (WebtoonEpisode::where('deleted', 0)->Where('webtoon_code', $webtoon->code)->get() as $episode) {
                $sitemap->add(route('read', ['short_name' => $webtoon->short_name, 'season' => $episode->season_short, 'episode' => $episode->episode_short]), $episode->created_at);
            }
        }

        foreach ($animes as $anime) {
            $sitemap->add(route('animeDetail', ['short_name' => $anime->short_name]), $anime->created_at);
            foreach (AnimeEpisode::where('deleted', 0)->Where('anime_code', $anime->code)->get() as $episode) {
                $sitemap->add(route('read', ['short_name' => $anime->short_name, 'season' => $episode->season_short, 'episode' => $episode->episode_short]), $episode->created_at);
            }
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $keyValue2 = KeyValue::Where('key', 'sitemap_alt')->first();

        if (!$keyValue2) {
            $keyValue2 = new KeyValue();
            $keyValue2->code = KeyValue::max('code') + 1;
            $keyValue2->key = "sitemap_alt";
        }
        $keyValue2->value = Carbon::now();
        $keyValue2->save();
    }

    public function testTekrar()
    {
        $keyValue = KeyValue::Where('key', 'testTekrar')->first();

        if (!$keyValue) {
            $keyValue = new KeyValue();
            $keyValue->code = KeyValue::max('code') + 1;
            $keyValue->key = "testTekrar";
        }
        $keyValue->value = Carbon::now();
        $keyValue->save();
    }

    public function makeShortName($name)
    {
        $alphabet = [
            'q', 'w', 'e', 'r', 't', 'y', 'u', 'ı', 'o', 'p', 'ğ', 'ü',
            'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'ş', 'i',
            'z', 'x', 'c', 'v', 'b', 'n', 'm', 'ö', 'ç'
        ];

        $name = $name;
        $shortName = '';

        // Gelen ismi karakter karakter parçalayarak kontrol ediyoruz
        for ($i = 0; $i < mb_strlen($name); $i++) {
            $character = mb_strtolower(mb_substr($name, $i, 1)); // Harfi küçük harfe dönüştürüyoruz
            if (in_array($character, $alphabet)) {
                $shortName .= $character;
            } else $shortName .= "-";
        }

        return $shortName;
    }

    public function sendNotificationIndexUser($image_url = 'index/img/default/notification.jpg', $notification_title, $notification_text, $notification_url = null, $to_user_code, $notification_date, $notification_end_date, $notification_code)
    {
        $notification = new NotificationUser();
        $notification->code = NotificationUser::max('code') + 1;
        $notification->notification_code = $notification_code;
        $notification->notification_image = $image_url;

        $notification->notification_title = $notification_title;
        $notification->notification_text = $notification_text;
        $notification->notification_url = $notification_url;

        $notification->from_user_code = 0;
        $notification->to_user_code = $to_user_code;

        $notification->notification_date = $notification_date;
        $notification->notification_end_date = $notification_end_date;

        $notification->create_user_code = Auth::guard('admin')->user() ? Auth::guard('admin')->user()->code : 0;

        $notification->save();

        return true;
    }
}
