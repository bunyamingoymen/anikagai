<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        $indexShowContent = ThemeSetting::Where('theme_code', KeyValue::Where('key', 'selected_theme')->first()->value)->Where('setting_name', 'indexShowContent')->first()->setting_value;
        $additionalData = [
            'trend_animes' => $this->getTrendContent(Anime::class, 0, $this->sendShowStatus(1), 6, 'click_count'),
            'trend_webtoons' => $this->getTrendContent(Webtoon::class, 0, $this->sendShowStatus(1), 6, 'click_count'),
            'animes' => $this->getContent(Anime::class, $this->sendShowStatus(0), $indexShowContent, 'created_at', 'DESC'),
            'webtoons' => $this->getContent(Webtoon::class, $this->sendShowStatus(0), $indexShowContent, 'created_at', 'DESC'),
            'slider_image' => KeyValue::where('key', 'slider_image')->where('deleted', 0)->get(),
            'slider_show' => ThemeSetting::where('theme_code', KeyValue::Where('key', 'selected_theme')->first()->value)->where('setting_name', 'showSlider')->first()->setting_value,
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

            if ($selectedCategory == "all") {
                $list = Anime::Where('deleted', 0)->whereIn('showStatus', $this->sendShowStatus(0))->where('plusEighteen', $adult)->orderBy($orderByType, $orderByList)->skip($skip)->take($listItems)->get();
            } else {
                $list = Anime::Where('deleted', 0)->Where('main_category', $selectedCategory)->whereIn('showStatus', $this->sendShowStatus(0))->where('plusEighteen', $adult)->orderBy($orderByType, $orderByList)->skip($skip)->take($listItems)->get();
            }

            $pageCountTest = Anime::Where('deleted', 0)->where('plusEighteen', $adult)->count();
        } elseif ($path == 'webtoonlar') {
            $title = "Webtoonlar";
            if ($selectedCategory == "all") {
                $list = Webtoon::Where('deleted', 0)->whereIn('showStatus', $this->sendShowStatus(0))->where('plusEighteen', $adult)->skip($skip)->take($listItems)->orderBy($orderByType, $orderByList)->get();
            } else {
                $list = Webtoon::Where('deleted', 0)->Where('main_category', $selectedCategory)->whereIn('showStatus', $this->sendShowStatus(0))->where('plusEighteen', $adult)->skip($skip)->take($listItems)->orderBy($orderByType, $orderByList)->get();
            }

            $pageCountTest = Webtoon::Where('deleted', 0)->where('plusEighteen', $adult)->count();
        } else {
            abort(404); // TODO: hata sayfasına yönlendir
        }
        $pageCount = $pageCountTest % intval($listItems) == 0 ? $pageCountTest / $listItems : $pageCount = intval($pageCountTest / $listItems) + 1;
        if ($currentPage > $pageCount || $currentPage < 1)
            abort(404); // TODO: 404 sayfasına yönlendir

        //dd($list->toArray());
        return $this->loadThemeView('list', compact('path', 'title', 'list', 'pageCount', 'currentPage', 'allCategory'));
    }

    public function search(Request $request)
    {
        //TODO buraya kategori arama da eklenecek
        $query = $request->input('query');

        $selected_theme = KeyValue::where('key', 'selected_theme')->first();
        $listItemsSetting = ThemeSetting::where('theme_code', $selected_theme->value)->where('setting_name', 'listCount')->first();
        $listItems = $listItemsSetting ? $listItemsSetting->setting_value : 20;

        $currentPage = $request->p ? $request->p : 1;
        $skip = max(0, ($currentPage - 1) * $listItems);
        $path = "/search?query={$query}";

        // Anime, Webtoon, Tag ve Category modellerinden sorguları al
        $animeCount =
            Anime::Where('deleted', 0)
            ->where('plusEighteen', 0)
            ->whereIn('showStatus', $this->sendShowStatus(0))
            ->where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->count();

        $webtoonCount =
            Webtoon::Where('deleted', 0)
            ->where('plusEighteen', 0)
            ->whereIn('showStatus', $this->sendShowStatus(0))
            ->where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->count();

        $totalCount = $animeCount + $webtoonCount;
        $pageCount = $totalCount % intval($listItems) == 0 ? $totalCount / $listItems : $totalCount = intval($totalCount / $listItems) + 1;


        $results = [];
        $animes = [];
        $webtoons = [];

        if ($skip < $animeCount) {
            $animes =
                Anime::Where('deleted', 0)
                ->where('plusEighteen', 0)
                ->whereIn('showStatus', $this->sendShowStatus(0))
                ->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('name', 'LIKE', '%' . $query . '%')
                        ->orWhere('description', 'LIKE', '%' . $query . '%');
                })
                ->skip($skip)
                ->take($listItems)
                ->get();

            foreach ($animes as $anime) {
                $anime->type = 'anime';
            }
            if ($animes && count($animes) > 0) array_push($results, $animes);
        }

        if (!$animes || count($animes) < $listItems) {

            $newlistItem = $animes ? $listItems - count($animes) : $listItems;
            $newSkip = $animes ? $skip - count($animes) : 0;

            $webtoons =
                Webtoon::Where('deleted', 0)
                ->where('plusEighteen', 0)
                ->whereIn('showStatus', $this->sendShowStatus(0))
                ->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('name', 'LIKE', '%' . $query . '%')
                        ->orWhere('description', 'LIKE', '%' . $query . '%');
                })
                ->skip($skip)
                ->take($listItems)
                ->get();

            foreach ($webtoons as $webtoon) {
                $webtoon->type = 'webtoon';
            }
            if ($webtoons && count($webtoons) > 0)
                array_push($results, $webtoons);
        }

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

        $trend_animes = $this->getTrendContent(Anime::class, $anime->main_category, $this->sendShowStatus(1), 6, 'click_count');

        $currentTime = Carbon::now();
        $anime_episodes = AnimeEpisode::where('anime_code', $anime->code)
            ->where('publish_date', '<=', $currentTime)
            ->where('deleted', 0)
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
            ->select('categories.*')
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



        return $this->loadThemeView('animeDetail', compact('anime', 'trend_animes', 'anime_episodes', 'categories', 'followed', 'liked', 'firstEpisodeUrl', 'watched'));
    }

    public function watch(Request $request)
    {
        $anime = Anime::Where('deleted', 0)->Where('short_name', $request->short_name)->first();

        if (!$anime || $anime->showStatus == 4 || (!Auth::user() && ($anime->showStatus == 1 || $anime->showStatus == 2)))
            abort(404);

        $episode = AnimeEpisode::Where("deleted", 0)->Where('season_short', $request->season)->Where('episode_short', $request->episode)->first();
        $trend_animes = $this->getTrendContent(Anime::class, $anime->main_category, $this->sendShowStatus(1), 6, 'click_count');
        $currentTime = Carbon::now();
        $anime_episodes = AnimeEpisode::where('anime_code', $anime->code)
            ->where('publish_date', '<=', $currentTime)
            ->where('deleted', 0)
            ->get();
        $content_type = 1; //anime olduğu için
        $comments_main = DB::table('comments')
            ->Where('comments.deleted', 0)
            ->Where('comments.content_code', $episode->code)
            ->Where('comments.content_type', $content_type)
            ->Where('comments.comment_type', 0)
            ->Where('comments.comment_top_code', 0)
            ->join('index_users', 'index_users.code', '=', 'comments.user_code')
            ->select('index_users.name as user_name', 'index_users.username as user_username', 'index_users.image as user_image', 'comments.*')
            ->orderBy('comment_short', 'ASC')
            ->get();

        $comments_alt = DB::table('comments')
            ->Where('comments.deleted', 0)
            ->Where('comments.content_code', $episode->code)
            ->Where('comments.content_type', $content_type)
            ->Where('comments.comment_type', 1)
            ->Where('comments.comment_top_code', "!=", 0)
            ->join('index_users', 'index_users.code', '=', 'comments.user_code')
            ->select('index_users.name as user_name', 'index_users.username as user_username', 'index_users.image as user_image', 'comments.*')
            ->orderBy('comment_short', 'ASC')
            ->get();
        $next_episode_url = "none";
        $next_episode_control =
            AnimeEpisode::Where("deleted", 0)->Where('season_short', $request->season)->Where('episode_short', (intval($request->episode) + 1))->first();
        if (!$next_episode_control) {

            $next_episode_control =
                AnimeEpisode::Where("deleted", 0)->Where('season_short', intval(($request->season) + 1))->Where('episode_short', 1)->first();
        }


        $next_episode_url = $next_episode_control ? "anime/" . $anime->short_name . "/" . $next_episode_control->season_short . "/" . $next_episode_control->episode_short : "none";

        $watched = [];
        if (Auth::user())
            $watched = WatchedAnime::Where('anime_code', $anime->code)->Where('user_code', Auth::user()->code)->Where('content_type', 1)->get();

        return $this->loadThemeView('watch', compact('anime', 'episode', 'anime_episodes', 'trend_animes', 'comments_main', 'comments_alt', 'next_episode_url', 'watched'));
    }

    public function webtoonDetail(Request $request)
    {
        $webtoon = Webtoon::where('short_name', $request->short_name)->first();
        if (!$webtoon || $webtoon->showStatus == 4 || (!Auth::user() && ($webtoon->showStatus == 1 || $webtoon->showStatus == 2)))
            abort(404);


        $trend_webtoons = $this->getTrendContent(Webtoon::class, $webtoon->main_category, $this->sendShowStatus(1), 6, 'click_count');

        $currentTime = now();

        $webtoon_episodes = WebtoonEpisode::Where('deleted', 0)
            ->where('webtoon_code', $webtoon->code)
            ->where('publish_date', '<=', $currentTime)
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
            ->join('animes', 'animes.code', '=', 'content_categories.content_code')
            ->select('categories.*')
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

        $additionalData = [
            'webtoon' => $webtoon,
            'trend_webtoons' => $trend_webtoons,
            'webtoon_episodes' => $webtoon_episodes,
            'categories' => $categories,
            'followed' => $followed,
            'liked' => $liked,
            'firstEpisodeUrl' => $firstEpisodeUrl,
            'watched' => $watched,
        ];

        return $this->loadThemeView('webtoonDetail', $additionalData);
    }

    public function read(Request $request)
    {
        $webtoon = Webtoon::Where('deleted', 0)->Where('short_name', $request->short_name)->first();

        if (!$webtoon || $webtoon->showStatus == 4 || (!Auth::user() && ($webtoon->showStatus == 1 || $webtoon->showStatus == 2)))
            abort(404);

        $episode = WebtoonEpisode::Where("deleted", 0)->Where('season_short', $request->season)->Where('episode_short', $request->episode)->first();

        $trend_webtoons = $this->getTrendContent(Webtoon::class, $webtoon->main_category, $this->sendShowStatus(1), 6, 'click_count');

        $currentTime = Carbon::now();
        $webtoon_episodes = WebtoonEpisode::where('webtoon_code', $webtoon->code)
            ->where('publish_date', '<=', $currentTime)
            ->where('deleted', 0)
            ->get();

        $content_type = 0; //webtoon olduğu için

        $comments_main = DB::table('comments')
            ->Where('comments.deleted', 0)
            ->Where('comments.content_code', $episode->code)
            ->Where('comments.content_type', $content_type)
            ->Where('comments.comment_type', 0)
            ->Where('comments.comment_top_code', 0)
            ->join('index_users', 'index_users.code', '=', 'comments.user_code')
            ->select('index_users.name as user_name', 'index_users.username as user_username', 'index_users.image as user_image', 'comments.*')
            ->orderBy('comment_short', 'ASC')
            ->get();



        $comments_alt = DB::table('comments')
            ->Where('comments.deleted', 0)
            ->Where('comments.content_code', $episode->code)
            ->Where('comments.content_type', $content_type)
            ->Where('comments.comment_type', 1)
            ->Where('comments.comment_top_code', "!=", 0)
            ->join('index_users', 'index_users.code', '=', 'comments.user_code')
            ->select('index_users.name as user_name', 'index_users.username as user_username', 'index_users.image as user_image', 'comments.*')
            ->orderBy('comment_short', 'ASC')
            ->get();

        $next_episode_url = "none";
        $next_episode_control = WebtoonEpisode::Where("deleted", 0)->Where('season_short', $request->season)->Where('episode_short', (intval($request->episode) + 1))->first();

        if (!$next_episode_control) {
            $next_episode_control = WebtoonEpisode::Where("deleted", 0)->Where('season_short', intval(($request->season) + 1))->Where('episode_short', 1)->first();
        }

        $next_episode_url = $next_episode_control ? "webtoon/" . $webtoon->short_name . "/" . $next_episode_control->season_short . "/" . $next_episode_control->episode_short : "none";

        $watched = [];
        if (Auth::user()) $watched = WatchedAnime::Where('anime_code', $webtoon->code)->Where('user_code', Auth::user()->code)->Where('content_type', 0)->get();

        $files = WebtoonFile::Where('deleted', 0)->Where('webtoon_episode_code', $episode->code)->get();
        //dd($files);
        return $this->loadThemeView('read', compact('webtoon', 'episode', 'webtoon_episodes', 'trend_webtoons', 'comments_main', 'comments_alt', 'next_episode_url', 'watched', 'files'));
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

        return $this->loadThemeView('page', compact('page'));
    }

    public function contactScreen()
    {
        return $this->loadThemeView('contact');
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
        $comment = new Comment();
        $comment->code = Comment::max('code') + 1;
        $comment->content_code = $request->content_code;
        $comment->content_type = $request->content_type;
        $comment->comment_type = $request->comment_type;
        $comment->comment_top_code = $request->comment_top_code;

        $before_comment = Comment::Where('content_code', $request->content_code)->Where('content_type', $request->content_type)->Where('comment_type', $request->comment_type)->Where('comment_top_code', $request->comment_top_code)->first();

        $comment->comment_short = $before_comment ? $before_comment->comment_short + 1 : 1;

        $comment->message = $request->message;

        $comment->user_code = Auth::user()->code;
        $comment->date = Carbon::now();

        $comment->save();

        if ($request->content_type == 0) {
            $webtoon = Webtoon::Where('code', $request->webtoon_code)->first();
            $webtoon->comment_count = $webtoon->comment_count + 1;
            $webtoon->save();
        } else if ($request->content_type == 1) {
            $anime = Anime::Where('code', $request->anime_code)->first();
            $anime->comment_count = $anime->comment_count + 1;
            $anime->save();
        }

        return redirect()->back();
    }

    public function loginScreen()
    {
        return $this->loadThemeView('login');
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

        return redirect()->route('index');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('index');
        }

        $errorScreen = "loginScreen";
        if ($request->theme && $request->theme == "theme3") {
            $errorScreen = "index";
        }

        return redirect()->route($errorScreen)->with("error", Config::get('error.error_codes.0020011'));
    }

    public function logout()
    {
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

        return $this->loadThemeView('profile', compact('user', 'favorite_animes', 'follow_animes', 'watched_animes', 'favorite_webtoons', 'follow_webtoons', 'readed_webtoons', 'followed_user'));
    }

    public function changeProfileSettingsScreen()
    {
        if (Auth::user()) {
            $user = Auth::user();

            return $this->loadThemeView('changeProfile', compact('user'));
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
                // Dosyayı al
                $file = $request->file('image');

                $path = public_path('files/users/profile');
                $name = $user->code . "." . $file->getClientOriginalExtension();
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
            return $this->loadThemeView('changePassword');
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
        $response = 0; //0: başarısız, 1: eklendi 2:silindi;

        if (Auth::user()) {
            $watched = WatchedAnime::Where('anime_code', $request->anime_code)->Where('anime_episode_code', $request->anime_episode_code)->Where('content_type', $request->content_type)->Where('user_code', Auth::user()->code)->first();
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
        return response()->json(['response' => $response]);
    }


    // Yardımcı Fonksiyonlar

    protected function loadThemeView($viewName, $additionalData = [])
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();

        return view("index." . $themePath->themePath . ".$viewName", $additionalData);
    }

    protected function getTrendContent($modelClass, $main_category = 0, $showStatus, $take, $orderBy)
    {
        if ($main_category == 0) {
            return $modelClass::where('deleted', 0)
                ->where('plusEighteen', 0)
                ->whereIn('showStatus', $showStatus)
                ->take($take)
                ->orderBy($orderBy, 'DESC')
                ->get();
        } else {
            return $modelClass::where('deleted', 0)
                ->where('plusEighteen', 0)
                ->Where('main_category', $main_category)
                ->whereIn('showStatus', $showStatus)
                ->take($take)
                ->orderBy($orderBy, 'DESC')
                ->get();
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
