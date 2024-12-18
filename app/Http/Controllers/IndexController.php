<?php

namespace App\Http\Controllers;

use App\Mail\forgotPassword;
use App\Models\Anime;
use App\Models\AnimeEpisode;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\FavoriteAnime;
use App\Models\FavoriteWebtoon;
use App\Models\FollowAnime;
use App\Models\FollowIndexUser;
use App\Models\FollowWebtoon;
use App\Models\IndexUser;
use App\Models\KeyValue;
use App\Models\LikeContentUser;
use App\Models\NotificationUser;
use App\Models\Page;
use App\Models\Theme;
use App\Models\ThemeSetting;
use App\Models\WatchedAnime;
use App\Models\Webtoon;
use App\Models\WebtoonEpisode;
use App\Models\WebtoonFile;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexController extends Controller
{
    public function index()
    {
        $indexShowContent = ThemeSetting::Where('theme_code', KeyValue::Where('key', 'selected_theme')->first()->value)->Where('setting_name', 'indexShowContent')->first()->setting_value;

        $latest_episode_type_db = KeyValue::where('key', 'latest_episode_type')->first();

        if (!$latest_episode_type_db) $latestEpisodeType = 'none'; //son bölümleri gösterme
        else $latestEpisodeType = $latest_episode_type_db->value; //Ayarlara göre sırala

        $latestEpisodes = null;

        if ($latestEpisodeType != 'none') {
            $anime_active = KeyValue::where('key', 'anime_active')->exists(); // Anime bölümleri açık mı?
            $webtoon_active = KeyValue::where('key', 'webtoon_active')->exists(); // Webtoon bölümleri açık mı?

            $latestEpisodesQuery = null;

            if ($anime_active) {
                // Anime bölümleri sorgusu
                $animeQuery = DB::table('anime_episodes')
                    ->join('animes', 'animes.code', '=', 'anime_episodes.anime_code')
                    ->select('anime_episodes.*', DB::raw("'anime' as type"));
                $latestEpisodesQuery = $animeQuery;
            }

            if ($webtoon_active) {
                // Webtoon bölümleri sorgusu
                $webtoonQuery = DB::table('webtoon_episodes')
                    ->join('webtoons', 'webtoons.code', '=', 'webtoon_episodes.anime_code')
                    ->select('webtoon_episodes.*', DB::raw("'webtoon' as type"));

                if ($latestEpisodesQuery) {
                    // Eğer anime sorgusu varsa union yap
                    $latestEpisodesQuery = $latestEpisodesQuery->unionAll($webtoonQuery);
                } else {
                    // Sadece webtoon varsa
                    $latestEpisodesQuery = $webtoonQuery;
                }
            }

            if ($latestEpisodesQuery) {
                // Eğer bir sorgu varsa, sıralayıp limitle
                $latestEpisodes = $latestEpisodesQuery
                    ->orderBy('created_at', 'desc') // Timestamps'e göre sıralama
                    ->limit(10) // Son 10 bölümü al
                    ->get();
            }
        }

        $additionalData = [
            'trend_animes'      => $this->getTrendContent(Anime::class, 0, $this->sendShowStatus(1), 6, 'click_count', 0),
            'trend_webtoons'    => $this->getTrendContent(Webtoon::class, 0, $this->sendShowStatus(1), 6, 'click_count', 0),
            'animes'            => $this->getContent(Anime::class, $this->sendShowStatus(0), $indexShowContent, 'created_at', 'DESC'),
            'webtoons'          => $this->getContent(Webtoon::class, $this->sendShowStatus(0), $indexShowContent, 'created_at', 'DESC'),
            'slider_image'      => KeyValue::where('key', 'slider_image')->where('deleted', 0)->get(),
            'slider_image_alt'  => KeyValue::where('key', 'slider_image_alt')->where('deleted', 0)->get(),
            'slider_show'       => ThemeSetting::where('theme_code', KeyValue::Where('key', 'selected_theme')->first()->value)->where('setting_name', 'showSlider')->first()->setting_value,
            'latestEpisodes'    => $latestEpisodes,
            'latestEpisodeType' => $latestEpisodeType,
        ];

        return $this->loadThemeView('index', $additionalData);
    }

    public function fetchVideo(Request $request)
    {
        $keyValue = KeyValue::where('key', 'slider_video')->where("value", $request->code)->where('deleted', 0)->first();
        $video = 'none';
        if ($keyValue && $keyValue->optional) $video = "../../../" . $keyValue->optional;

        return response()->json(['video' => $video]);
    }

    public function list(Request $request)
    {
        $selected_theme = KeyValue::where('key', 'selected_theme')->first();
        $path = $request->path();
        $title = "";
        $list = [];
        $currentPage = $request->p ?: 1;
        $listItemsSetting = ThemeSetting::where('theme_code', $selected_theme->value)->where('setting_name', 'listCount')->first();
        $listItems = $listItemsSetting ? $listItemsSetting->setting_value : 20;
        $skip = max(0, ($currentPage - 1) * $listItems);
        $allCategory = Category::where('deleted', 0)->get();
        $pageCountTest = 0;

        $adult = 0;
        if ($request->adult && $request->adult == "on")
            $adult = 1;


        $selectedCategory = ((!$request->category) || ($request->category == "all")) ? "all" : Category::Where('short_name', $request->category)->first()->code;
        $orderByMapping = [
            'created_AtASC' => ['created_at', 'ASC'],
            'created_AtDESC' => ['created_at', 'DESC'],
            'TrendsASC' => ['click_count', 'ASC'],
            'TrendsDESC' => ['click_count', 'DESC'],
        ];

        $orderByType = 'created_at';
        $orderByList = 'DESC';

        if ($request->orderBy && array_key_exists($request->orderBy, $orderByMapping)) {
            list($orderByType, $orderByList) = $orderByMapping[$request->orderBy];
        }

        if ($path == 'animeler') {
            $title = "Animeler";

            $query = Anime::where('deleted', 0)
                ->whereIn('showStatus', $this->sendShowStatus(0))
                ->where('plusEighteen', $adult)
                ->orderBy($orderByType, $orderByList)
                ->skip($skip)
                ->take($listItems);

            if ($selectedCategory !== "all") {
                $query->where('main_category', $selectedCategory);
                $pageCountTest = Anime::where('deleted', 0)
                    ->whereIn('showStatus', $this->sendShowStatus(0))
                    ->where('plusEighteen', $adult)
                    ->where('main_category', $selectedCategory)
                    ->count();
            } else {
                $pageCountTest = Anime::where('deleted', 0)
                    ->whereIn('showStatus', $this->sendShowStatus(0))
                    ->where('plusEighteen', $adult)
                    ->count();
            }

            $list = $query->get();
        } elseif ($path == 'webtoonlar') {
            $title = "Webtoonlar";

            $query = Webtoon::where('deleted', 0)
                ->whereIn('showStatus', $this->sendShowStatus(0))
                ->where('plusEighteen', $adult)
                ->orderBy($orderByType, $orderByList)
                ->skip($skip)
                ->take($listItems);

            if ($selectedCategory !== "all") {
                $query->where('main_category', $selectedCategory);
                $pageCountTest = Webtoon::where('deleted', 0)
                    ->whereIn('showStatus', $this->sendShowStatus(0))
                    ->where('plusEighteen', $adult)
                    ->where('main_category', $selectedCategory)
                    ->count();
            } else {
                $pageCountTest = Webtoon::where('deleted', 0)
                    ->whereIn('showStatus', $this->sendShowStatus(0))
                    ->where('plusEighteen', $adult)
                    ->count();
            }

            $list = $query->get();
        } else {
            abort(404);
        }

        $pageCount = $pageCountTest % intval($listItems) == 0 ? $pageCountTest / $listItems : $pageCount = intval($pageCountTest / $listItems) + 1;

        //Eğer gidilmek istene sayfa 1 den küçük yada toplam sayfadan büyük ise 404 ekranına gider. Ancak eğer ilk sayfa ise ve liste değeri boş ise 404 sayfasına gitmez.
        if ((($currentPage > $pageCount) || ($currentPage < 1)) && !(count($list) == 0 && $currentPage == 1))
            abort(404);

        $title .= ' - ' . env('APP_NAME');
        //dd($list->toArray());
        return $this->loadThemeView('list', compact('path', 'title', 'list', 'pageCount', 'currentPage', 'allCategory'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $selected_theme = KeyValue::where('key', 'selected_theme')->first();
        $listItemsSetting = ThemeSetting::where('theme_code', $selected_theme->value)
            ->where('setting_name', 'listCount')
            ->first();
        $listItems = $listItemsSetting ? $listItemsSetting->setting_value : 20;

        $shortName = $this->makeShortName($query);

        $path = "/search?query={$query}";

        $currentPage = request()->input('p', 1); // Sayfa numarasını request'ten al, varsayılan olarak 1

        $animesResults = Anime::where('deleted', 0)
            ->where('plusEighteen', 0)
            ->whereIn('showStatus', $this->sendShowStatus(0))
            ->where(function ($queryBuilder) use ($query, $shortName) {
                $queryBuilder->where('name', 'LIKE', '%' . $query . '%')
                    ->where('short_name', 'LIKE', '%' . $shortName . '%')
                    ->orWhere('description', 'LIKE', '%' . $query . '%')
                    ->orWhere('main_category_name', 'LIKE', '%' . $query . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get(); // Get all results

        $webtoonsResults = Webtoon::where('deleted', 0)
            ->where('plusEighteen', 0)
            ->whereIn('showStatus', $this->sendShowStatus(0))
            ->where(function ($queryBuilder) use ($query, $shortName) {
                $queryBuilder->where('name', 'LIKE', '%' . $query . '%')
                    ->where('short_name', 'LIKE', '%' . $shortName . '%')
                    ->orWhere('description', 'LIKE', '%' . $query . '%')
                    ->orWhere('main_category_name', 'LIKE', '%' . $query . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get(); // Get all results

        // Sonuçları birleştir
        $combinedResults = $animesResults->merge($webtoonsResults);

        // Sonuçları oluşturulma tarihine göre sıralayın
        $sortedResults = $combinedResults->sortByDesc('created_at');

        // Toplam sonuç sayısı
        $totalResults = $sortedResults->count();

        // Sayfalama işlemi için sonuçları dilimleyin
        $resultsForCurrentPage = $sortedResults->slice(($currentPage - 1) * $listItems, $listItems)->all();

        // LengthAwarePaginator kullanarak sayfalama oluşturun
        $paginatedResults = new LengthAwarePaginator(
            $resultsForCurrentPage,
            $totalResults,
            $listItems,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // Her bir sonuca ait 'type' özelliğini ayarlayın
        $paginatedResults->getCollection()->map(function ($result) {
            $result->type = strpos($result->image, 'files/animes') === 0 ? 'anime' : 'webtoon';
            return $result;
        });

        $results = $paginatedResults;
        $pageCount = $results->lastPage();

        if ($currentPage < 1 || $currentPage > $pageCount) {
            abort(404);
        }

        return $this->loadThemeView('search', compact('results', 'pageCount', 'currentPage', 'path'));
    }

    public function animeDetail(Request $request)
    {

        $anime = Anime::where('short_name', $request->short_name)->first();
        if (!$anime || $anime->showStatus == 4 || (!Auth::user() && ($anime->showStatus == 1 || $anime->showStatus == 2)))
            abort(404);

        $trend_animes = $this->getTrendContent(Anime::class, $anime->main_category, $this->sendShowStatus(1), 6, 'click_count', $anime->code);

        $currentTime = Carbon::now();
        $anime_episodes = AnimeEpisode::where('anime_code', $anime->code)
            ->where('publish_date', '<=', $currentTime)
            ->where('deleted', 0)
            ->orderBy('episode_short', 'ASC')
            ->get();

        $followed = false;
        $liked = false;

        if (Auth::user()) {
            $follow = FollowAnime::where('user_code', Auth::user()->code)
                ->where('anime_code', $anime->code)
                ->first();

            $like = FavoriteAnime::where('user_code', Auth::user()->code)
                ->where('anime_code', $anime->code)
                ->first();

            $followed = $follow ? true : false;
            $liked = $like ? true : false;
        }

        $categories = DB::table('categories')
            ->where('content_categories.content_code', $anime->code)
            ->where('content_categories.content_type', 1)
            ->join('content_categories', 'content_categories.category_code', '=', 'categories.code')
            ->join('animes', 'animes.code', '=', 'content_categories.content_code')
            ->select('categories.*', 'content_categories.is_main')
            ->orderBy('is_main', 'DESC')
            ->get();


        $firstEpisodeUrl = 'none';
        if (count($anime_episodes) > 0) {
            $minSeasonShort = $anime_episodes->min('season_short');
            $minEpisodeShort = $anime_episodes->where('season_short', $minSeasonShort)->min('episode_short');

            $firstEpisodeUrl = "anime/" . $anime->short_name . "/" . $minSeasonShort . "/" . $minEpisodeShort;
        }
        $watched = [];
        if (Auth::user())
            $watched = WatchedAnime::Where('anime_code', $anime->code)->Where('user_code', Auth::user()->code)->Where('content_type', 1)->get();

        $title = $request->title ? $request->title : null;

        return $this->loadThemeView('animeDetail', compact(
            'anime',
            'trend_animes',
            'anime_episodes',
            'categories',
            'followed',
            'liked',
            'firstEpisodeUrl',
            'watched',
            'title',
        ));
    }

    public function watch(Request $request)
    {
        $anime = Anime::Where('deleted', 0)->Where('short_name', $request->short_name)->first();

        if (!$anime || $anime->showStatus == 4 || (!Auth::user() && ($anime->showStatus == 1 || $anime->showStatus == 2)))
            abort(404);

        $episode = AnimeEpisode::Where("deleted", 0)->where('anime_code', $anime->code)->Where('season_short', $request->season)->Where('episode_short', $request->episode)->first();

        if (!$episode) {
            abort(404);
        }

        $trend_animes = $this->getTrendContent(Anime::class, $anime->main_category, $this->sendShowStatus(1), 6, 'click_count', $anime->code);
        $currentTime = Carbon::now();
        $anime_episodes = AnimeEpisode::where('anime_code', $anime->code)
            ->where('publish_date', '<=', $currentTime)
            ->where('deleted', 0)
            ->orderBy('episode_short', 'ASC')
            ->get();
        $currentDate = Carbon::now();
        $content_type = 1; //anime olduğu için
        $comments_main = DB::table('comments')
            ->Where('comments.deleted', 0)
            ->Where('comments.content_code', $episode->code)
            ->Where('comments.content_type', $content_type)
            ->Where('comments.comment_type', 0)
            ->Where('comments.comment_top_code', 0)
            ->Where('comments.is_active', 1)
            ->join('index_users', 'index_users.code', '=', 'comments.user_code')
            ->select('index_users.code as index_user_code', 'index_users.name as user_name', 'index_users.username as user_username', 'index_users.image as user_image', 'comments.*')
            ->orderBy('is_pinned', 'DESC')
            ->orderBy('comment_short', 'ASC')
            ->get();

        $comments_alt = DB::table('comments')
            ->Where('comments.deleted', 0)
            ->Where('comments.content_code', $episode->code)
            ->Where('comments.content_type', $content_type)
            ->Where('comments.comment_type', 1)
            ->Where('comments.comment_top_code', "!=", 0)
            ->Where('comments.is_active', 1)
            ->join('index_users', 'index_users.code', '=', 'comments.user_code')
            ->select('index_users.code as index_user_code', 'index_users.name as user_name', 'index_users.username as user_username', 'index_users.image as user_image', 'comments.*')
            ->orderBy('comment_short', 'ASC')
            ->get();
        $next_episode_url = "none";
        $next_episode_control =
            AnimeEpisode::Where("deleted", 0)->where('anime_code', $anime->code)->Where('season_short', $request->season)->Where('episode_short', (intval($request->episode) + 1))->where('publish_date', '<=', $currentDate)->first();
        if (!$next_episode_control) {
            $next_episode_control =
                AnimeEpisode::Where("deleted", 0)->where('anime_code', $anime->code)->Where('season_short', intval(($request->season) + 1))->Where('episode_short', 1)->where('publish_date', '<=', $currentDate)->first();
        }


        $next_episode_url = $next_episode_control ? "anime/" . $anime->short_name . "/" . $next_episode_control->season_short . "/" . $next_episode_control->episode_short : "none";

        $prev_episode_url = "none";
        $prev_episode_control =
            AnimeEpisode::Where("deleted", 0)->where('anime_code', $anime->code)->Where('season_short', $request->season)->Where('episode_short', (intval($request->episode) - 1))->first();

        if (!$prev_episode_control) {
            $prev_episode_control =
                AnimeEpisode::Where("deleted", 0)->where('anime_code', $anime->code)->Where('season_short', intval(($request->season) - 1))->orderBy('episode_short', 'DESC')->first();
        }


        $prev_episode_url = $prev_episode_control ? "anime/" . $anime->short_name . "/" . $prev_episode_control->season_short . "/" . $prev_episode_control->episode_short : "none";
        //dd($next_episode_url);
        $watched = [];
        $is_watched = false;
        if (Auth::user()) {
            $watched = WatchedAnime::Where('anime_code', $anime->code)->Where('user_code', Auth::user()->code)->Where('content_type', 1)->get();

            $is_watched = WatchedAnime::Where('anime_code', $anime->code)
                ->Where('anime_episode_code', $episode->code)
                ->Where('user_code', Auth::user()->code)
                ->Where('content_type', 1)
                ->exists();
        }


        $title = $request->title ? $request->title : null;

        $user_code = Auth::user() ? Auth::user()->code : -1;
        $like_comments = LikeContentUser::Where('content_code', $anime->code)
            ->Where('content_episode_code', $episode->code)
            ->Where('content_type', 1)
            ->Where('user_code', $user_code)
            ->get();

        return $this->loadThemeView('watch', compact(
            'anime',
            'episode',
            'anime_episodes',
            'trend_animes',
            'comments_main',
            'comments_alt',
            'next_episode_url',
            'prev_episode_url',
            'watched',
            'is_watched',
            'title',
            'like_comments'
        ));
    }

    public function webtoonDetail(Request $request)
    {
        $webtoon = Webtoon::where('short_name', $request->short_name)->first();
        if (!$webtoon || $webtoon->showStatus == 4 || (!Auth::user() && ($webtoon->showStatus == 1 || $webtoon->showStatus == 2)))
            abort(404);


        $trend_webtoons = $this->getTrendContent(Webtoon::class, $webtoon->main_category, $this->sendShowStatus(1), 6, 'click_count', $webtoon->code);

        $currentTime = now();

        $webtoon_episodes = WebtoonEpisode::Where('deleted', 0)
            ->where('webtoon_code', $webtoon->code)
            ->where('publish_date', '<=', $currentTime)
            ->orderBy('episode_short', 'ASC')
            ->get();


        $followed = false;
        $liked = false;

        if (Auth::user()) {
            $follow = FollowWebtoon::where('user_code', Auth::user()->code)
                ->where('webtoon_code', $webtoon->code)
                ->first();

            $like = FavoriteWebtoon::where('user_code', Auth::user()->code)
                ->where('webtoon_code', $webtoon->code)
                ->first();

            $followed = (bool) $follow;
            $liked = (bool) $like;
        }

        $categories = DB::table('categories')
            ->where('content_categories.content_code', $webtoon->code)
            ->where('content_categories.content_type', 0)
            ->join('content_categories', 'content_categories.category_code', '=', 'categories.code')
            ->join('webtoons', 'webtoons.code', '=', 'content_categories.content_code')
            ->select('categories.*', 'content_categories.is_main')
            ->orderBy('is_main', 'DESC')
            ->get();

        $firstEpisodeUrl = 'none';
        if (count($webtoon_episodes) > 0) {
            $minSeasonShort = $webtoon_episodes->min('season_short');
            $minEpisodeShort = $webtoon_episodes->where('season_short', $minSeasonShort)->min('episode_short');

            $firstEpisodeUrl = "webtoon/" . $webtoon->short_name . "/" . $minSeasonShort . "/" . $minEpisodeShort;
        }

        $watched = [];
        if (Auth::user())
            $watched = WatchedAnime::Where('anime_code', $webtoon->code)->Where('user_code', Auth::user()->code)->Where('content_type', 0)->get();

        $title = $request->title ? $request->title : null;

        $additionalData = [
            'webtoon' => $webtoon,
            'trend_webtoons' => $trend_webtoons,
            'webtoon_episodes' => $webtoon_episodes,
            'categories' => $categories,
            'followed' => $followed,
            'liked' => $liked,
            'firstEpisodeUrl' => $firstEpisodeUrl,
            'watched' => $watched,
            'title' => $title,
        ];

        return $this->loadThemeView('webtoonDetail', $additionalData);
    }

    public function read(Request $request)
    {
        $webtoon = Webtoon::Where('deleted', 0)->Where('short_name', $request->short_name)->first();

        if (!$webtoon || $webtoon->showStatus == 4 || (!Auth::user() && ($webtoon->showStatus == 1 || $webtoon->showStatus == 2)))
            abort(404);

        $episode = WebtoonEpisode::Where("deleted", 0)->where('webtoon_code', $webtoon->code)->Where('season_short', $request->season)->Where('episode_short', $request->episode)->first();

        if (!$episode) {
            abort(404);
        }

        $trend_webtoons = $this->getTrendContent(Webtoon::class, $webtoon->main_category, $this->sendShowStatus(1), 6, 'click_count', $webtoon->code);

        $currentTime = Carbon::now();
        $webtoon_episodes = WebtoonEpisode::where('webtoon_code', $webtoon->code)
            ->where('publish_date', '<=', $currentTime)
            ->where('deleted', 0)
            ->orderBy('episode_short', 'ASC')
            ->get();

        $content_type = 0; //webtoon olduğu için
        $currentDate = Carbon::now();
        $comments_main = DB::table('comments')
            ->Where('comments.deleted', 0)
            ->Where('comments.content_code', $episode->code)
            ->Where('comments.content_type', $content_type)
            ->Where('comments.comment_type', 0)
            ->Where('comments.comment_top_code', 0)
            ->Where('comments.is_active', 1)
            ->join('index_users', 'index_users.code', '=', 'comments.user_code')
            ->select('index_users.code as index_user_code', 'index_users.name as user_name', 'index_users.username as user_username', 'index_users.image as user_image', 'comments.*')
            ->orderBy('is_pinned', 'DESC')
            ->orderBy('comment_short', 'ASC')
            ->get();



        $comments_alt = DB::table('comments')
            ->Where('comments.deleted', 0)
            ->Where('comments.content_code', $episode->code)
            ->Where('comments.content_type', $content_type)
            ->Where('comments.comment_type', 1)
            ->Where('comments.comment_top_code', "!=", 0)
            ->Where('comments.is_active', 1)
            ->join('index_users', 'index_users.code', '=', 'comments.user_code')
            ->select('index_users.code as index_user_code', 'index_users.name as user_name', 'index_users.username as user_username', 'index_users.image as user_image', 'comments.*')
            ->orderBy('comment_short', 'ASC')
            ->get();

        $next_episode_url = "none";
        $next_episode_control = WebtoonEpisode::Where("deleted", 0)->where('webtoon_code', $webtoon->code)->Where('season_short', $request->season)->Where('episode_short', (intval($request->episode) + 1))->where('publish_date', '<=', $currentDate)->first();

        if (!$next_episode_control) {
            $next_episode_control = WebtoonEpisode::Where("deleted", 0)->where('webtoon_code', $webtoon->code)->Where('season_short', intval(($request->season) + 1))->Where('episode_short', 1)->where('publish_date', '<=', $currentDate)->first();
        }

        $next_episode_url = $next_episode_control ? "webtoon/" . $webtoon->short_name . "/" . $next_episode_control->season_short . "/" . $next_episode_control->episode_short : "none";

        $prev_episode_url = "none";
        $prev_episode_control =
            WebtoonEpisode::Where("deleted", 0)->where('webtoon_code', $webtoon->code)->Where('season_short', $request->season)->Where('episode_short', (intval($request->episode) - 1))->first();

        if (!$prev_episode_control) {
            $prev_episode_control =
                WebtoonEpisode::Where("deleted", 0)->where('webtoon_code', $webtoon->code)->Where('season_short', intval(($request->season) - 1))->orderBy('episode_short', 'DESC')->first();
        }

        $prev_episode_url = $prev_episode_control ? "webtoon/" . $webtoon->short_name . "/" . $prev_episode_control->season_short . "/" . $prev_episode_control->episode_short : "none";


        $watched = [];
        if (Auth::user()) $watched = WatchedAnime::Where('anime_code', $webtoon->code)->Where('user_code', Auth::user()->code)->Where('content_type', 0)->get();

        $files = WebtoonFile::Where('deleted', 0)->Where('webtoon_episode_code', $episode->code)->orderBy('file_order', 'ASC')->get();

        $title = $request->title ? $request->title : null;

        $user_code = Auth::user() ? Auth::user()->code : -1;
        $like_comments = LikeContentUser::Where('content_code', $webtoon->code)
            ->Where('content_episode_code', $episode->code)
            ->Where('content_type', 0)
            ->Where('user_code', $user_code)
            ->get();

        return $this->loadThemeView('read', compact(
            'webtoon',
            'episode',
            'webtoon_episodes',
            'trend_webtoons',
            'comments_main',
            'comments_alt',
            'next_episode_url',
            'prev_episode_url',
            'watched',
            'files',
            'title',
            'like_comments',
        ));
    }

    public function calendar(Request $request)
    {
        $path = $request->path();

        $currentDate = Carbon::now(); // Şu anki tarih ve saat
        $oneMonthLater = $currentDate->copy()->addMonth(); // 1 ay sonraki tarih

        $anime_calendar_lists = [];
        $webtoonn_calendar_lists = [];
        $groupedAnimeCalendarLists = [];
        $groupedWebtoonCalendarLists = [];

        $showAnime = 0;
        $showWebtoon = 0;

        $currentDate = Carbon::now(); // Şu anki tarih ve saat
        $oneMonthLater = $currentDate->copy()->addMonth(1);
        $currentDate = Carbon::now()->subDay();

        if ($path == 'calendar' || $path == 'animeCalendar') {
            $showAnime = 1;
            $anime_calendar_lists = DB::table('anime_calendar_lists')
                ->Where('anime_calendars.deleted', 0)
                ->Where('animes.deleted', 0)
                ->whereBetween('anime_calendar_lists.date', [$currentDate, $oneMonthLater])
                ->join('anime_calendars', 'anime_calendars.code', '=', 'anime_calendar_lists.anime_calendar_code')
                ->join('animes', 'animes.code', '=', 'anime_calendars.anime_code')
                ->select(
                    'animes.name as anime_name',
                    'animes.short_name as anime_short_name',
                    'animes.code as anime_code',
                    'animes.thumb_image as anime_image',
                    'animes.showStatus as anime_show_status',
                    'anime_calendars.code as anime_calendar_code',
                    'anime_calendars.description as anime_calendar_description',
                    'anime_calendars.first_date as anime_calendar_first_date',
                    'anime_calendars.cycle_type as anime_calendar_cycle_type',
                    'anime_calendars.special_type as anime_calendar_special_type',
                    'anime_calendars.special_count as anime_calendar_special_count',
                    'anime_calendars.end_date as anime_calendar_end_date',
                    'anime_calendars.background_color as anime_calendar_background_color',
                    'anime_calendar_lists.code as anime_calendar_lists_code',
                    'anime_calendar_lists.calendar_order as anime_calendar_list_calendar_order',
                    'anime_calendar_lists.date as anime_calendar_list_date'
                )
                ->orderBy('anime_calendar_lists.date', 'ASC')
                ->get();

            $groupedAnimeCalendarLists = $anime_calendar_lists->groupBy('anime_calendar_list_date');
        }

        if ($path == 'calendar' || $path == 'webtoonCalendar') {
            $showWebtoon = 1;
            $webtoonn_calendar_lists = DB::table('webtoon_calendar_lists')
                ->Where('webtoon_calendars.deleted', 0)
                ->Where('webtoons.deleted', 0)
                ->whereBetween('webtoon_calendar_lists.date', [$currentDate, $oneMonthLater])
                ->join('webtoon_calendars', 'webtoon_calendars.code', '=', 'webtoon_calendar_lists.webtoon_calendar_code')
                ->join('webtoons', 'webtoons.code', '=', 'webtoon_calendars.webtoon_code')
                ->select(
                    'webtoons.name as webtoon_name',
                    'webtoons.short_name as webtoon_short_name',
                    'webtoons.showStatus as webtoon_show_status',
                    'webtoons.code as webtoon_code',
                    'webtoons.thumb_image as webtoon_image',
                    'webtoon_calendars.code as webtoon_calendar_code',
                    'webtoon_calendars.description as webtoon_calendar_description',
                    'webtoon_calendars.first_date as webtoon_calendar_first_date',
                    'webtoon_calendars.cycle_type as webtoon_calendar_cycle_type',
                    'webtoon_calendars.special_type as webtoon_calendar_special_type',
                    'webtoon_calendars.special_count as webtoon_calendar_special_count',
                    'webtoon_calendars.end_date as webtoon_calendar_end_date',
                    'webtoon_calendars.background_color as webtoon_calendar_background_color',
                    'webtoon_calendar_lists.calendar_order as webtoon_calendar_list_calendar_order',
                    'webtoon_calendar_lists.date as webtoon_calendar_list_date'
                )
                ->orderBy('webtoon_calendar_lists.date', 'ASC')
                ->get();

            $groupedWebtoonCalendarLists = $webtoonn_calendar_lists->groupBy('webtoon_calendar_list_date');
        }

        $title = "Takvim" . " - " . env('APP_NAME');
        if ($path == 'webtoonCalendar') $title = "Webtoon Takvimi" . " - " . env('APP_NAME');
        if ($path == 'animeCalendar') $title = "Anime Takvimi" . " - " . env('APP_NAME');

        return $this->loadThemeView('calendar', compact('anime_calendar_lists', 'groupedAnimeCalendarLists', 'showAnime', 'webtoonn_calendar_lists', 'groupedWebtoonCalendarLists', 'showWebtoon', 'title'));
    }

    public function showPage(Request $request)
    {
        $pageShortName = $request->short_name;

        $page = Page::where('deleted', 0)
            ->where('short_name', $pageShortName)
            ->first();

        if (!$page) {
            abort(404); // Sayfa bulunamazsa 404 hatası gönder
        }

        $title = $page->name . ' - ' . env('APP_NAME');

        return $this->loadThemeView('page', compact('page', 'title'));
    }

    public function contactScreen()
    {
        $title = 'İletişim' . ' - ' . env('APP_NAME');
        return $this->loadThemeView('contact', compact('title'));
    }

    public function contact(Request $request)
    {
        $newContact = new Contact();
        $newContact->code = Contact::max('code') + 1;

        $newContact->name = $request->name;
        $newContact->email = $request->email;
        $newContact->subject = $request->subject;
        $newContact->message = $request->message;
        $newContact->save();

        return redirect()->route('contact_screen')->with('success', 'Başarılı bir şekilde mesaj gönderildi.');
    }

    public function addNewComment(Request $request)
    {
        $comment_message = $request->message;

        $is_insult = false;

        $comment = new Comment();
        $comment->code = Comment::max('code') + 1;
        $comment->content_code = $request->content_code;
        $comment->content_type = $request->content_type;
        $comment->comment_type = $request->comment_type;
        $comment->comment_top_code = $request->comment_top_code;
        $comment->content_top_code = $request->content_type == 0 ? $request->webtoon_code : $request->anime_code;

        $before_comment = Comment::Where('content_code', $request->content_code)->Where('content_type', $request->content_type)->Where('comment_type', $request->comment_type)->Where('comment_top_code', $request->comment_top_code)->first();

        $comment->comment_short = $before_comment ? $before_comment->comment_short + 1 : 1;

        $comment->message = $comment_message;

        $comment->user_code = Auth::user()->code;
        $comment->date = Carbon::now();

        if ($request->is_spoiler) $comment->is_spoiler = 1;

        $comment_split = explode(" ", $comment_message);
        $comment_split_lowercase = array_map('strtolower', $comment_split);

        $insultMatches = KeyValue::where('deleted', 0)
            ->where('key', 'insult')
            ->where(function ($query) use ($comment_split_lowercase) {
                foreach ($comment_split_lowercase as $item) {
                    $query->orWhere('value', '=', $item);
                }
            })
            ->exists();

        if ($insultMatches) {
            $comment->is_active = 0;
            $is_insult = true;
        } else {
            $comment->is_active = 1;
        }

        $comment->save();

        if ($request->content_type == 0) {
            $webtoon = Webtoon::Where('code', $request->webtoon_code)->first();
            $webtoon->comment_count =
                DB::table('comments')
                ->join('webtoons', 'comments.content_top_code', '=', 'webtoons.code')
                ->join('webtoon_episodes', 'comments.content_code', '=', 'webtoon_episodes.code')
                ->where('webtoons.code', $webtoon->code)
                ->where('webtoon_episodes.deleted', 0)
                ->where('comments.deleted', 0)
                ->where('comments.content_type', 0)
                ->Where('comments.is_active', 1)
                ->count();
            $webtoon->save();
        } else if ($request->content_type == 1) {
            $anime = Anime::Where('code', $request->anime_code)->first();
            $anime->comment_count =
                DB::table('comments')
                ->join('animes', 'comments.content_top_code', '=', 'animes.code')
                ->join('anime_episodes', 'comments.content_code', '=', 'anime_episodes.code')
                ->where('animes.code', $anime->code)
                ->where('anime_episodes.deleted', 0)
                ->where('comments.deleted', 0)
                ->where('comments.content_type', 1)
                ->Where('comments.is_active', 1)
                ->count();
            $anime->save();
        }


        if (!$is_insult) {


            if ($comment->comment_top_code != 0) {
                $short_name = "";
                $season_short = "";
                $episode_short = "";

                if ($comment->content_type == 0) {
                    $webtoon_episode = WebtoonEpisode::Where('code', $comment->content_code)->first();
                    $season_short = $webtoon_episode ? $webtoon_episode->season_short : "0";
                    $episode_short = $webtoon_episode ? $webtoon_episode->episode_short : "0";

                    $short_name = $webtoon_episode ? (Webtoon::Where('code', $webtoon_episode->webtoon_code)->first() ? Webtoon::Where('code', $webtoon_episode->webtoon_code)->first()->short_name : "0") : "0";
                } else {
                    $anime_episode = AnimeEpisode::Where('code', $comment->content_code)->first();
                    $season_short = $anime_episode ? $anime_episode->season_short : "0";
                    $episode_short = $anime_episode ? $anime_episode->episode_short : "0";

                    $short_name = $anime_episode ? (Anime::Where('code', $anime_episode->anime_code)->first() ? Anime::Where('code', $anime_episode->anime_code)->first()->short_name : "0") : "0";
                }

                $comment_url = ($comment->content_type == 0 ? 'webtoon/' : 'anime/') . $short_name . '/' . $season_short . '/' . $episode_short;
                $user_comment = Comment::Where('code', $comment->comment_top_code)->first() ? Comment::Where('code', $comment->comment_top_code)->first()->user_code : 0;
                $publishDate = Carbon::now()->format('Y-m-d');
                $EndDate = Carbon::parse($publishDate)->addMonths(1)->format('Y-m-d');
                $notification_code = NotificationUser::max('notification_code') + 1;
                if ($user_comment != Auth::user()->code) {
                    $this->sendNotificationIndexUser("index/img/default/notification.jpg", "Yorumunuza cevap geldi", "Yeni bir cevap geldi: " . $comment->message, url($comment_url), $user_comment, $publishDate, $EndDate, $notification_code);
                }
            }
        }

        return redirect()->back();
    }

    public function deleteComment(Request $request)
    {
        $comment = Comment::where('code', $request->code)->first();

        if (!$comment)
            return redirect()->back();

        $comment->deleted = 1;
        $comment->save();

        if ($comment->content_type == 0) {
            $webtoon_episode = WebtoonEpisode::Where('code', $comment->content_code)->first();
            $webtoon = Webtoon::Where('code', $webtoon_episode->webtoon_code)->first();
            $webtoon->comment_count =
                DB::table('comments')
                ->join('webtoons', 'comments.content_top_code', '=', 'webtoons.code')
                ->join('webtoon_episodes', 'comments.content_code', '=', 'webtoon_episodes.code')
                ->where('webtoons.code', $webtoon->code)
                ->where('webtoon_episodes.deleted', 0)
                ->where('comments.deleted', 0)
                ->where('comments.content_type', 0)
                ->Where('comments.is_active', 1)
                ->count();
            $webtoon->save();
        } else if ($comment->content_type == 1) {
            $anime_episode = AnimeEpisode::Where('code', $comment->content_code)->first();
            $anime = Anime::Where('code', $anime_episode->anime_code)->first();
            $anime->comment_count =
                DB::table('comments')
                ->join('animes', 'comments.content_top_code', '=', 'animes.code')
                ->join('anime_episodes', 'comments.content_code', '=', 'anime_episodes.code')
                ->where('animes.code', $anime->code)
                ->where('anime_episodes.deleted', 0)
                ->where('comments.deleted', 0)
                ->where('comments.content_type', 1)
                ->Where('comments.is_active', 1)
                ->count();
            $anime->save();
        }

        return redirect()->back();
    }

    public function loginScreen()
    {
        $title = 'Giriş Yap' . ' - ' . env('APP_NAME');
        return $this->loadThemeView('login', compact('title'));
    }

    public function register(Request $request)
    {
        $userData = [
            'code' => IndexUser::max('code') + 1,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $newUser = IndexUser::create($userData);

        Auth::login($newUser);

        return redirect()->route('profile');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials2["username"] = $request->input('email');
        $credentials2["password"] = $request->input('password');
        //$credentials['username'] = $request->input('email');
        $remember = $request->remember_me ? true : false;
        if (Auth::attempt($credentials, $remember) || Auth::attempt($credentials2, $remember)) {
            if (Auth::user()->is_active == 1) {
                return redirect()->route('index');
            } else {
                Auth::logout();
                return redirect()->route('loginScreen')->with("error", "Hesabınız Aktif Değildir");
            }
        }

        $errorScreen = "loginScreen";
        if ($request->theme && $request->theme == "theme3") {
            $errorScreen = "index";
        }

        return redirect()->route($errorScreen)->with("error", Config::get('error.error_codes.0020011'));
    }

    public function logout()
    {
        // Remember token'ını geçersiz kıl ve sil
        $user = IndexUser::Where('code', Auth::user()->code)->first();
        $user->setRememberToken(null);
        $user->save();

        Auth::logout();
        return redirect()->route('index');
    }

    public function profile(Request $request)
    {
        $user = IndexUser::where('username', $request->username)->first();

        if (!$user)
            $user = Auth::user();
        if (!$user)
            return redirect()->route("loginScreen");

        $favorite_animes = DB::table('animes')
            ->Where('favorite_animes.user_code', $user->code)
            ->whereIn('animes.showStatus', $this->sendShowStatus(0))
            ->join('favorite_animes', 'favorite_animes.anime_code', '=', 'animes.code')
            ->select('animes.*')
            ->get();

        $follow_animes = DB::table('animes')
            ->Where('follow_animes.user_code', $user->code)
            ->whereIn('animes.showStatus', $this->sendShowStatus(0))
            ->join('follow_animes', 'follow_animes.anime_code', '=', 'animes.code')
            ->select('animes.*')
            ->get();

        $watched_animes = DB::table('animes')
            ->Where('watched_animes.user_code', $user->code)
            ->whereIn('animes.showStatus', $this->sendShowStatus(0))
            ->join('watched_animes', 'watched_animes.anime_code', '=', 'animes.code')
            ->select('animes.*')
            ->get();

        $favorite_webtoons = DB::table('webtoons')
            ->Where('favorite_webtoons.user_code', $user->code)
            ->whereIn('webtoons.showStatus', $this->sendShowStatus(0))
            ->join('favorite_webtoons', 'favorite_webtoons.webtoon_code', '=', 'webtoons.code')
            ->select('webtoons.*')
            ->get();

        $follow_webtoons = DB::table('webtoons')
            ->Where('follow_webtoons.user_code', $user->code)
            ->whereIn('webtoons.showStatus', $this->sendShowStatus(0))
            ->join('follow_webtoons', 'follow_webtoons.webtoon_code', '=', 'webtoons.code')
            ->select('webtoons.*')
            ->get();

        $readed_webtoons = DB::table('webtoons')
            ->Where('readed_webtoons.user_code', $user->code)
            ->whereIn('webtoons.showStatus', $this->sendShowStatus(0))
            ->join('readed_webtoons', 'readed_webtoons.webtoon_code', '=', 'webtoons.code')
            ->select('webtoons.*')
            ->get();

        $followed_user = false;
        if ((Auth::user()) && ($user->code != Auth::user()->code)) {
            $followed_user = FollowIndexUser::where('followed_user_code', $user->code)
                ->where('user_code', Auth::user()->code)->exists();
        }

        $following_user_count = FollowIndexUser::where('followed_user_code', $user->code)->count(); //takip eden kullanıcıların sayısı
        $followed_user_count = FollowIndexUser::where('user_code', $user->code)->count(); //takip ettiği kullanıcıların sayısı

        $watched_anime_count = WatchedAnime::Where('user_code', $user->code)->Where('content_type', 1)->count();
        $readed_webtoon_count = WatchedAnime::Where('user_code', $user->code)->Where('content_type', 0)->count();

        $title = 'Profil' . ' - ' . env('APP_NAME');
        return $this->loadThemeView('profile', compact('user', 'favorite_animes', 'follow_animes', 'watched_animes', 'favorite_webtoons', 'follow_webtoons', 'readed_webtoons', 'followed_user', 'following_user_count', 'followed_user_count', 'watched_anime_count', 'readed_webtoon_count', 'title'));
    }

    public function changeProfileSettingsScreen()
    {
        if (Auth::user()) {
            $user = Auth::user();
            $title = 'Profil' . ' - ' . env('APP_NAME');
            return $this->loadThemeView('changeProfile', compact('user', 'title'));
        }
        return redirect()->back()->with('error', "İlk Önce giriş yapmanız gerekmektedir.");
    }

    public function changeProfileSettings(Request $request)
    {
        if (Auth::user()) {
            $user = IndexUser::Where('code', Auth::user()->code)->first();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();

            return redirect()->route('profile')->with('success', "Başarılı Bir Şekilde Bilgiler Değiştirildi");
        }
        return redirect()->back()->with('error', "İlk Önce giriş yapmanız gerekmektedir.");
    }

    public function changeProfileImage(Request $request)
    {
        if (Auth::user()) {
            $user = IndexUser::Where('code', Auth::user()->code)->first();

            if ($request->hasFile('image')) {

                if ($user->image) {
                    $dosyaYolu = public_path($user->image);
                    if (File::exists($dosyaYolu)) {
                        File::delete($dosyaYolu);
                    }
                }
                // Dosyayı al
                $file = $request->file('image');
                $uniqDeger = Str::random(5);
                $path = public_path('files/users/profile');
                $name = $user->code . "_" . $uniqDeger . "." . $file->getClientOriginalExtension();
                $file->move($path, $name);
                $user->image = "files/users/profile/" . $name;

                $user->save();

                return redirect()->route('profile')->with('success', "Başarılı Bir Şekilde Resim Değiştirildi");
            } else {
                return redirect()->back()->with('error', "Herhangi bir dosya yüklenmedi");
            }
        }
        return redirect()->back()->with('error', "İlk Önce giriş yapmanız gerekmektedir.");
    }
    public function changeProfilePasswordScreen()
    {
        if (Auth::user()) {
            $title = 'Şifre Güncelle' . ' - ' . env('APP_NAME');
            $additionalData = ['title' => $title];
            return $this->loadThemeView('changePassword', $additionalData);
        }
        return redirect()->back()->with('error', "İlk Önce giriş yapmanız gerekmektedir.");
    }
    public function changeProfilePassword(Request $request)
    {
        if (Auth::user()) {
            $user = IndexUser::Where('code', Auth::user()->code)->first();

            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->route('profile')->with('success', "Başarılı Bir Şekilde Şifre Değiştirildi");
            } else {
                return redirect()->back()->with('error', "Eski Şifre aynı değildir.");
            }
        }
        return redirect()->back()->with('error', "İlk Önce giriş yapmanız gerekmektedir.");
    }

    public function controlUsername(Request $request)
    {
        if ($request->code)
            $control = !IndexUser::where('username', $request->username)->where('code', "!=", $request->code)->exists();
        else
            $control = !IndexUser::where('username', $request->username)->exists();

        return response()->json(['control' => $control]);
    }

    public function controlEmail(Request $request)
    {
        if ($request->code)
            $control = !IndexUser::where('email', $request->email)->where('code', "!=", $request->code)->exists();
        else
            $control = !IndexUser::where('email', $request->email)->exists();

        return response()->json(['control' => $control]);
    }

    public function watchedAnime(Request $request)
    {
        $response = 0; //0: başarısız, 1: eklendi 2:silindi, 3: zaten izlendi olarak eklenmişti;

        if (Auth::user()) {
            $watched = WatchedAnime::Where('anime_code', $request->anime_code)->Where('anime_episode_code', $request->anime_episode_code)->Where('content_type', $request->content_type)->Where('user_code', Auth::user()->code)->first();
            if ($request->only_watch && $request->only_watch == 1) {
                if (!$watched) {
                    $watched = new WatchedAnime();
                    $watched->anime_code = $request->anime_code;
                    $watched->anime_episode_code = $request->anime_episode_code;
                    $watched->content_type = $request->content_type;
                    $watched->user_code = Auth::user()->code;
                    $watched->save();
                    $response = 1;
                } else $response = 3;
            } else {
                if ($request->just_watch && $request->just_watch == 1) {
                    if (!$watched) {
                        $watched = new WatchedAnime();
                        $watched->anime_code = $request->anime_code;
                        $watched->anime_episode_code = $request->anime_episode_code;
                        $watched->content_type = $request->content_type;
                        $watched->user_code = Auth::user()->code;
                        $watched->save();
                        $response = 1;
                    }
                } else {
                    if ($watched) {
                        $watched->delete();
                        $response = 2;
                    } else {
                        $watched = new WatchedAnime();
                        $watched->anime_code = $request->anime_code;
                        $watched->anime_episode_code = $request->anime_episode_code;
                        $watched->content_type = $request->content_type;
                        $watched->user_code = Auth::user()->code;
                        $watched->save();
                        $response = 1;
                    }
                }
            }
        }
        return response()->json(['response' => $response]);
    }

    public function forgotPassword(Request $request)
    {

        $user = IndexUser::Where('email', $request->email)->first();

        if ($user) {
            // Harfler ve sayılar içeren bir karakter kümesi
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // Karakter kümesini karıştır
            $randomString = str_shuffle($characters);

            // İlk 10 karakteri al
            $newPassword = substr($randomString, 0, 10);

            $user->password = Hash::make($newPassword);
            $user->save();

            $subject = "Şifremi Unuttum";
            $name = $user->name;
            $password = $newPassword;
            $keyLogo = KeyValue::Where('key', 'index_logo')->first();
            $logo = '';
            if ($keyLogo) $logo = $keyLogo->value;

            $keyFooter = KeyValue::Where('key', 'footer_copyright')->first();
            $footer = '';
            if ($keyFooter) $footer = $keyFooter->value;

            $keyColor = ThemeSetting::where('theme_code', KeyValue::where('key', 'selected_theme')->first()->value)
                ->where('setting_name', 'colors_code')->orderBy('code', 'ASC')
                ->first();
            $color = '';
            if ($color) $color = $keyColor->value();

            Mail::to($user->email)->send(new forgotPassword($name, $password, $subject, $logo, $footer, $color));
        }

        return true;
    }

    public function showNotifications()
    {
        $notificatonsAll = NotificationUser::where('deleted', 0)
            ->Where('notification_end_date', '>=', Carbon::today())
            ->where('notification_date', '<=', Carbon::today())
            ->where('to_user_code', Auth::user()->code)
            ->orderBy('created_at', 'DESC')
            ->get();
        $additionalData = ['notificatonsAll' => $notificatonsAll];
        return $this->loadThemeView('notifications', $additionalData);
    }


    // Yardımcı Fonksiyonlar

    protected function loadThemeView($viewName, $additionalData = [])
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();

        return view("index." . $themePath->themePath . ".$viewName", $additionalData);
    }

    protected function getTrendContent($modelClass, $main_category = 0, $showStatus, $take, $orderBy, $exceptCode = 0)
    {
        if ($main_category == 0) {
            if ($exceptCode == 0) {
                return $modelClass::where('deleted', 0)
                    ->where('plusEighteen', 0)
                    ->whereIn('showStatus', $showStatus)
                    ->take($take)
                    ->orderBy($orderBy, 'DESC')
                    ->get();
            } else {
                return $modelClass::where('deleted', 0)
                    ->where('plusEighteen', 0)
                    ->where('code', "!=", $exceptCode)
                    ->whereIn('showStatus', $showStatus)
                    ->take($take)
                    ->orderBy($orderBy, 'DESC')
                    ->get();
            }
        } else {
            if ($exceptCode == 0) {
                return $modelClass::where('deleted', 0)
                    ->where('plusEighteen', 0)
                    ->Where('main_category', $main_category)
                    ->whereIn('showStatus', $showStatus)
                    ->take($take)
                    ->orderBy($orderBy, 'DESC')
                    ->get();
            } else {
                return $modelClass::where('deleted', 0)
                    ->where('plusEighteen', 0)
                    ->where('code', "!=", $exceptCode)
                    ->Where('main_category', $main_category)
                    ->whereIn('showStatus', $showStatus)
                    ->take($take)
                    ->orderBy($orderBy, 'DESC')
                    ->get();
            }
        }
    }

    protected function getContent($modelClass, $showStatus, $take, $orderByType, $orderByList, $skip = 0)
    {
        return $modelClass::where('deleted', 0)
            ->where('plusEighteen', 0)
            ->whereIn('showStatus', $showStatus)
            ->skip($skip)
            ->take($take)
            ->orderBy($orderByType, $orderByList)
            ->get();
    }

    public function sendShowStatus($type = 0)
    {
        //type 0 ise normal listelemedir. 1 ise trend yada benzer içerikleri listelemedir.

        if ($type == 0)
            return Auth::user() ? ["0", "1", "2"] : ["0", "2"];
        if ($type == 1)
            return Auth::user() ? ["0", "1", "2"] : ["0"];
    }
}
