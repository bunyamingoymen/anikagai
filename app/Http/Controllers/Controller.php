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

    public function getDataFromDatabase($data=[])
    {
        //$data içinde bulunan veriler: 'database'=>'shop_mysql', 'model'=>'App\Models\Shop\ShopProduct', $filters = [], $pagination = ['take' => 15, 'page' => 1], $search = [], $whereIn = [], $joins=[]


        //örnek orderby: $orderBy = ['column'=>'created_at', 'type'=>'DESC']
        //Örnek wherein: whereIn = [ 'category_code'=>['1','2','3'], 'feature_code'=>['4','5','6'] ]
        //Örnek joins: $joins = [ ['table' => 'categories', 'first' => 'category_id', 'operator' => '=', 'second' => 'categories.id', 'columns'=>['name'=>'category_name', 'code'=>'category_code']] ];
        //Örnek search: $search=['search' => $request->searchData, 'dbSearch' => ['name','description','main_category_name'], 'short_name'=> true, 'short_name_db' => 'short_name' ];
        //örnek filter(where): $filters['is_approved'] = "1";   $filters['is_active'] = "1";
        //örnek pagination: $pagination = [ 'take' => $request->showingCount ? $request->showingCount : Config::get('app.showCount'), 'page' => $request->page];
        //Eğer burada ana tablo olarak gönderilen tablodan bir değer alacaksanız (wherein ya da join..vs.) Tablonun adını yukarıdaki dizilerden herhangi birini oluştururken girmemelisiniz. Aksi taktirde hata verecektir.

        //data ile gelen değerleri eşleştirme
        // Anahtarları küçük harfe çevir
        $data = array_change_key_case($data, CASE_LOWER);

        // Veritabanı bağlantısı ayarla (Varsayılan 'mysql')
        $database = $data['database'] ?? 'mysql';

        // Modeli ayarla (Eğer model yoksa null döner)
        $model = $data['model'] ?? null;
        if (!$model) return null;

        // Filtreleri ayarla (Varsayılan boş dizi)
        $filters = $data['filters'] ?? [];

        // Sayfalama ayarları (Varsayılan 15 kayıt ve 1. sayfa)
        $pagination = $data['pagination'] ?? ['take' => 15, 'page' => 1];

        // Arama ayarları (Varsayılan boş dizi)
        $search = $data['search'] ?? [];

        // WhereIn koşulları (Varsayılan boş dizi)
        $whereIn = $data['wherein'] ?? [];

        // Join ayarları (Varsayılan boş dizi)
        $joins = $data['joins'] ?? [];

        $leftJoins = $data['leftjoins'] ?? [];

        $rightJoins = $data['rightjoins'] ?? [];

        $groupBy = $data['groupby'] ?? false;

        $orderBy = $data['orderby'] ?? false;

        $getQuery = $data['getquery'] ?? false;

        $mainTableAlias = $data['maintablealias'] ?? 'main';


        // Veritabanı bağlantısını seç
        $connection = DB::connection($database);

        // Modelin tablo adını al
        $table = (new $model)->getTable() . ' as ' . $mainTableAlias;

        // Pagination ayarları
        $take = $pagination['take'];
        $skip = (($pagination['page'] - 1) * $take);

        // Başlangıç query
        $query = $connection->table($table);

        // Seçilecek sütunları ekle
        $mainTableColumns = $connection->getSchemaBuilder()->getColumnListing((new $model)->getTable());
        $selectColumns = [];

        foreach ($mainTableColumns as $column) {
            $selectColumns[] = $mainTableAlias . '.' . $column; // Ana tablodaki tüm sütunlar
        }
        $query->select("$mainTableAlias.*");

        // Join işlemi
        if (!empty($joins)) {
            foreach ($joins as $index => $join) {
                if (isset($join['table'], $join['first'], $join['operator'], $join['second'], $join['columns'])) {
                    // Join işlemi
                    $first = strpos($join['first'],'.') ? $join['first'] : $mainTableAlias . '.'.$join['first'];
                    $second = strpos($join['second'],'.') ? $join['second'] : $mainTableAlias . '.'.$join['second'];

                    $query->join($join['table'], $first, $join['operator'], $second);

                    // Join edilen tablonun belirli sütunlarını alias ile ekle
                    foreach ($join['columns'] as $column => $alias) {
                        if(strpos($column,'.'))  $selectColumns[] = $column . ' as ' . $alias;
                        else $join['table'] . '.' . $column . ' as ' . $alias;
                    }
                }
            }
        }

        // Join işlemi
        if (!empty($leftJoins)) {
            foreach ($leftJoins as $index => $left) {
                if (isset($left['table'], $left['first'], $left['operator'], $left['second'], $left['columns'])) {
                    // Join işlemi
                    $first = strpos($left['first'],'.') ? $left['first'] : $mainTableAlias . '.'.$left['first'];
                    $second = strpos($left['second'],'.') ? $left['second'] : $mainTableAlias . '.'.$left['second'];

                    $query->leftJoin($left['table'], $first, $left['operator'], $second);

                    // Join edilen tablonun belirli sütunlarını alias ile ekle
                    foreach ($left['columns'] as $column => $alias) {
                        if(strpos($column,'.'))  $selectColumns[] = $column . ' as ' . $alias;
                        else $left['table'] . '.' . $column . ' as ' . $alias;
                    }
                }
            }
        }

        //filtre ayarları
        if(in_array($mainTableAlias.'.deleted',$selectColumns)) $filters['deleted'] = 0;

        // Filtreleri uygula
        foreach ($filters as $column => $value) {
            if(strpos($column,'.')) $query->where($column, $value);
            else $query->where($mainTableAlias.'.'.$column, $value);
        }

        // Arama işlemi
        if (isset($search['search']) && is_string($search['search']) && isset($search['dbSearch']) && is_array($search['dbSearch'])) {
            $query->where(function($q) use ($search, $mainTableAlias) {
                // İlk kolon için where kullanıyoruz
                $firstColumn = true;
                foreach ($search['dbSearch'] as $column) {
                    if ($firstColumn) {
                        if(strpos($column,'.')) $q->where($column, 'LIKE', '%' . $search['search'] . '%');
                        else $q->where($mainTableAlias.'.'.$column, 'LIKE', '%' . $search['search'] . '%');
                        $firstColumn = false;
                    } else {
                        if(strpos($column,'.'))  $q->orWhere($column, 'LIKE', '%' . $search['search'] . '%');
                        else $q->orWhere($mainTableAlias.'.'.$column, 'LIKE', '%' . $search['search'] . '%');
                    }
                }

                // Eğer kısa isim ya da URL de aranmak istenirse
                if (isset($search['short_name']) && isset($search['short_name_db']) && $search['short_name']) {
                    $shortName = $this->makeShortName($search['search']);
                    if(strpos($column,'.'))  $q->orWhere($search['short_name_db'], 'LIKE', '%' . $shortName  . '%');
                    else $q->orWhere($mainTableAlias.'.'.$search['short_name_db'], 'LIKE', '%' . $shortName  . '%');
                }
            });
        }

        // WhereIn işlemi
        if (!empty($whereIn) && count($whereIn) > 0) {
            foreach ($whereIn as $column => $values) {
                if (is_array($values) && count($values) > 0) {
                    if(strpos($column,'.')) $query->whereIn($column, $values);
                    else $query->whereIn($mainTableAlias.'.'.$column, $values);
                }
            }
        }

        $query->select($selectColumns);


        if($groupBy){
            $query->groupBy($selectColumns);
        }



        // Verileri al
        $items = $query->skip($skip)->take($take)->get();
        $page_count = ceil( $query->count() / $take);

        if($getQuery) return ['items' => $items, 'page_count' => $page_count, 'query'=>$query];

        return ['items' => $items, 'page_count' => $page_count];
    }


    public function getOneItem($code, $model, $is_create_new = 1, $filters=[]){
        $filters['deleted'] = 0;
        $filters['code'] = $code;
        $item = $model::Where($filters)->first();
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
