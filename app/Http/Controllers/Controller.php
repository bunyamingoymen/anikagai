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
use Spatie\Sitemap\Sitemap;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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

        $anime_active_key = KeyValue::Where('key', 'anime_active')->first();
        $anima_active = $anime_active_key ? $anime_active_key->value : 0;

        $webtoon_active_key = KeyValue::Where('key', 'webtoon_active')->first();
        $webtoon_active = $webtoon_active_key ? $webtoon_active_key->value : 0;

        $sitemap = Sitemap::create();



        if ($webtoon_active == 1) {
            $webtoons = Webtoon::where('deleted', 0)->get();
            foreach ($webtoons as $webtoon) {
                $sitemap->add(route('webtoonDetail', ['short_name' => $webtoon->short_name]), $webtoon->created_at);
                foreach (WebtoonEpisode::where('deleted', 0)->Where('webtoon_code', $webtoon->code)->get() as $episode) {
                    $sitemap->add(route('read', ['short_name' => $webtoon->short_name, 'season' => $episode->season_short, 'episode' => $episode->episode_short]), $episode->created_at);
                }
            }
        }

        if ($anima_active == 1) {
            $animes = Anime::where('deleted', 0)->get();
            foreach ($animes as $anime) {
                $sitemap->add(route('animeDetail', ['short_name' => $anime->short_name]), $anime->created_at);
                foreach (AnimeEpisode::where('deleted', 0)->Where('anime_code', $anime->code)->get() as $episode) {
                    $sitemap->add(route('read', ['short_name' => $anime->short_name, 'season' => $episode->season_short, 'episode' => $episode->episode_short]), $episode->created_at);
                }
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

    public function generateUniqueCode($database, $table, $column = 'code', $length = 10)
    {
        // Belirli bir veritabanı bağlantısını kullanarak kontrol et
        $connection = DB::connection($database);

        do {
            // Rastgele bir kod oluştur
            $code = Str::lower(Str::random($length));

            // Oluşturulan kodun mevcut tabloda olup olmadığını kontrol et
            $exists = $connection->table($table)->where($column, $code)->exists();
        } while ($exists);

        return $code;
    }

    public function getDataFromDatabase($database, $model, $filters = [], $pagination = ['take' => 15, 'page' => 1])
    {
        // Veritabanı bağlantısını seç
        $connection = DB::connection($database);

        // Modelin tablo adını al
        $table = (new $model)->getTable();

        // Pagination ve filtre ayarları
        $take = $pagination['take'];
        $skip = (($pagination['page'] - 1) * $take);

        // Başlangıç query
        $query = $connection->table($table)->where('deleted', 0);

        // Filtreleri uygula
        foreach ($filters as $column => $value) {
            $query->where($column, $value);
        }

        // Verileri al
        $items = $query->skip($skip)->take($take)->get();
        $totalCount = $connection->table($table)->where('deleted', 0)->count();
        $page_count = ceil($totalCount / $take);

        return ['items' => $items, 'page_count' => $page_count];
    }

    public function getOneItem($code, $model, $is_create_new = 1){
        $item = $model::Where('deleted', 0)->where('code',$code)->first();
        $is_new = false;
        if(!$item && $is_create_new){
            $code = $this->generateUniqueCode('shop_mysql','shop_categories');
            $item = new $model;
            $item->code = $code;
            $item->create_user_code =  Auth::guard('admin')->user()->code;
            $is_new=true;
        }else if($item){
            $code = $item->code;
            $item->update_user_code =  Auth::guard('admin')->user()->code;
        }

        return ['item'=>$item, 'code'=>$code, 'is_new'=>$is_new];
    }

    public function getUrl($name, $prefix=""){
        // Küçük harfe çevir
        $url = strtolower($name);

        // Türkçe karakterleri değiştir
        $url = str_replace(['ı', 'ğ', 'ü', 'ş', 'ö', 'ç'], ['i', 'g', 'u', 's', 'o', 'c'], $url);

        // Boşlukları ve izin verilmeyen karakterleri tire ile değiştir
        $url = preg_replace('/[^a-z0-9]+/', '-', $url);

        // Baştaki ve sondaki tireleri temizle
        $url = trim($url, '-');

        //prefix değerini ekle
        if(!empty($prefix)){
            if(substr($prefix, -1) !== '/'){
                $prefix .= '/';
            }
        }

        return $prefix.$url;
    }
}
