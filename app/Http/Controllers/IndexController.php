<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\AnimeEpisode;
use App\Models\Category;
use App\Models\Contact;
use App\Models\FavoriteAnime;
use App\Models\FavoriteWebtoon;
use App\Models\FollowAnime;
use App\Models\FollowWebtoon;
use App\Models\IndexUser;
use App\Models\KeyValue;
use App\Models\Page;
use App\Models\Theme;
use App\Models\ThemeSetting;
use App\Models\Webtoon;
use App\Models\WebtoonEpisode;
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
        $onlyUsers = Auth::user() ? ["0", "1"] : ["1"];
        $additionalData = [
            'trend_animes' => $this->getTrendContent(Anime::class, $onlyUsers, 6, 'click_count'),
            'trend_webtoons' => $this->getTrendContent(Webtoon::class, $onlyUsers, 6, 'click_count'),
            'animes' => $this->getContent(Anime::class, $onlyUsers, 20, 'created_at', 'DESC'),
            'webtoons' => $this->getContent(Webtoon::class, $onlyUsers, 20, 'created_at', 'DESC'),
            'slider_image' => KeyValue::where('key', 'slider_image')->where('deleted', 0)->get(),
            'slider_show' => ThemeSetting::where('theme_code', KeyValue::Where('key', 'selected_theme')->first()->value)->where('setting_name', 'showSlider')->first()->setting_value,
        ];

        return $this->loadThemeView('index', $additionalData);
    }


    public function list(Request $request)
    {
        $onlyUsers = Auth::user() ? ["0", "1"] : ["1"];
        $selected_theme = KeyValue::where('key', 'selected_theme')->first();
        $themePath = Theme::where('code', $selected_theme->value)->first();
        $path = $request->path();
        $title = "";
        $list = [];
        $currentPage = $request->p ?: 1;
        $listItemsSetting = ThemeSetting::where('theme_code', $selected_theme->value)->where('setting_name', 'listCount')->first();
        $listItems = $listItemsSetting ? $listItemsSetting->setting_value : 20;
        $skip = max(0, ($currentPage - 1) * $listItems);

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
            $list = Anime::Where('deleted', 0)->whereIn('onlyUsers', $onlyUsers)->orderBy($orderByType, $orderByList)->skip($skip)->take($listItems)->get();
            $pageCountTest = Anime::Where('deleted', 0)->count();
        } elseif ($path == 'webtoonlar') {
            $title = "Webtoonlar";
            $list = Webtoon::Where('deleted', 0)->whereIn('onlyUsers', $onlyUsers)->skip($skip)->take($listItems)->orderBy($orderByType, $orderByList)->get();
            $pageCountTest = Webtoon::Where('deleted', 0)->count();
        } else {
            abort(404); // TODO: hata sayfasına yönlendir
        }
        //dd($listItems);
        $pageCount = $pageCountTest % intval($listItems) == 0 ? $pageCountTest / $listItems : $pageCount = intval($pageCountTest / $listItems) + 1;

        if ($currentPage > $pageCount || $currentPage < 1)
            abort(404); // TODO: 404 sayfasına yönlendir


        return $this->loadThemeView('list', compact('path', 'title', 'list', 'pageCount', 'currentPage'));
    }

    public function read()
    {
        return $this->loadThemeView('read');
    }

    public function contactScreen()
    {
        return $this->loadThemeView('contact');
    }

    public function contact(Request $request)
    {
        $newContact = new Contact();
        $newContact->code = Contact::max('code') + 1;
        $newContact->fill($request->only(['name', 'email', 'subject', 'message']));
        $newContact->save();

        return redirect()->route('contact_screen')->with('success', 'Başarılı bir şekilde mesaj gönderildi.');
    }

    public function animeDetail(Request $request)
    {

        $anime = Anime::where('short_name', $request->short_name)->first();
        $trend_animes = $this->getTrendContent(Anime::class, ['deleted' => 0], 4, 'click_count', 'ASC');

        $currentTime = Carbon::now();
        $anime_episodes = AnimeEpisode::where('anime_code', $anime->code)
            ->where('publish_date', '<=', $currentTime)
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

        return $this->loadThemeView('animeDetail', compact('anime', 'trend_animes', 'anime_episodes', 'categories', 'followed', 'liked'));
    }

    public function webtoonDetail(Request $request)
    {
        $webtoon = Webtoon::where('short_name', $request->short_name)->firstOrFail();

        $trend_webtoons = Webtoon::where('deleted', 0)
            ->take(4)
            ->orderBy('click_count', 'ASC')
            ->get();

        $currentTime = now();

        $webtoon_episodes = WebtoonEpisode::where('webtoon_code', $webtoon->code)
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

        $categories = Category::whereHas('contentCategories', function ($query) use ($webtoon) {
            $query->where('content_code', $webtoon->code)
                ->where('content_type', 0);
        })->get();

        $additionalData = [
            'webtoon' => $webtoon,
            'trend_webtoons' => $trend_webtoons,
            'webtoon_episodes' => $webtoon_episodes,
            'categories' => $categories,
            'followed' => $followed,
            'liked' => $liked,
        ];

        return $this->loadThemeView('webtoonDetail', $additionalData);
    }

    public function watch()
    {
        return $this->loadThemeView('watch');
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

        return redirect()->route('loginScreen')->with("error", Config::get('error.error_codes.0020011'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function controlUsername(Request $request)
    {
        $control = !IndexUser::where('username', $request->username)->exists();

        return response()->json(['control' => $control]);
    }

    public function controlEmail(Request $request)
    {
        $control = !IndexUser::where('email', $request->email)->exists();

        return response()->json(['control' => $control]);
    }


    // Diğer fonksiyonları da benzer şekilde düzenleyebilirsiniz...

    // Yardımcı Fonksiyonlar

    protected function loadThemeView($viewName, $additionalData = [])
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();

        return view("index." . $themePath->themePath . ".$viewName", $additionalData);
    }

    protected function getTrendContent($modelClass, $onlyUsers, $take, $orderBy)
    {
        return $modelClass::where('deleted', 0)->whereIn('onlyUsers', $onlyUsers)->take($take)->orderBy($orderBy, 'DESC')->get();
    }

    protected function getContent($modelClass, $onlyUsers, $take, $orderByType, $orderByList, $skip = 0)
    {
        return $modelClass::where('deleted', 0)
            ->whereIn('onlyUsers', $onlyUsers)
            ->skip($skip)
            ->take($take)
            ->orderBy($orderByType, $orderByList)
            ->get();
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

    public function profile(Request $request)
    {
        $user = IndexUser::where('username', $request->username)->first();

        if (!$user)
            $user = Auth::user();


        return $this->loadThemeView('profile', compact('user'));
    }
}
