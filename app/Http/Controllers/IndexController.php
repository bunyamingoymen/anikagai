<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\AnimeEpisode;
use App\Models\IndexUser;
use App\Models\KeyValue;
use App\Models\Theme;
use App\Models\Webtoon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();

        $trend_animes = Anime::Where('deleted', 0)->take(6)->orderBy('click_count', 'DESC')->get();
        $trend_webtoons = Webtoon::Where('deleted', 0)->take(6)->orderBy('click_count', 'DESC')->get();

        $animes = Anime::Where('deleted', 0)->take(20)->orderBy('created_at', 'DESC')->get();
        $webtoons = Webtoon::Where('deleted', 0)->take(20)->orderBy('created_at', 'DESC')->get();

        return view("index." . $themePath->themePath . ".index", ['trend_animes' => $trend_animes, 'trend_webtoons' => $trend_webtoons, 'animes' => $animes, 'webtoons' => $webtoons]);
    }

    public function list(Request $request)
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();
        $path = $request->path();

        $title = "";
        $list = array();
        $currentPage = $request->p ? $request->p : 1;
        $listItems = 8;
        $skip = (($currentPage - 1) * $listItems);

        if ($path == 'animeler') {
            $title = "Animeler";
            $list = Anime::Where('deleted', 0)->skip($skip)->take($listItems)->orderBy('created_at', 'DESC')->get();
            $pageCountTest = Anime::Where('deleted', 0)->count();
        } else if ($path == 'webtoonlar') {
            $title = "Webtoonlar";
            $list = Webtoon::Where('deleted', 0)->skip($skip)->take($listItems)->orderBy('created_at', 'DESC')->get();
            $pageCountTest = Anime::Where('deleted', 0)->count();
        } else {
            dd('hata'); //TODO hata sayfasına yolla
        }
        if ($pageCountTest % $listItems == 0)
            $pageCount = $pageCountTest / $listItems;
        else
            $pageCount = intval($pageCountTest / $listItems) + 1;

        if ($currentPage > $pageCount)
            dd(404); // TODO 404 sayfası oluşturup buraya yollayacağız

        if ($currentPage < -1)
            dd(404); //TODO 404 sayfası oluşturulup yollanacak

        return view("index." . $themePath->themePath . ".list", ['path' => $path, 'title' => $title, "list" => $list, 'pageCount' => $pageCount, 'currentPage' => $currentPage]);
    }

    public function animeDetail(Request $request)
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();

        $anime = Anime::Where('short_name', $request->short_name)->first();
        $trend_animes = Anime::Where('deleted', 0)->take(4)->orderBy('click_count', 'ASC')->get();

        $currentTime = Carbon::now();

        $anime_episodes = AnimeEpisode::Where('anime_code', $anime->code)->Where('publish_date', '<=', $currentTime)->get();

        return view("index." . $themePath->themePath . ".animeDetail", ['anime' => $anime, 'trend_animes' => $trend_animes, 'anime_episodes' => $anime_episodes]);
    }

    public function watch()
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();
        return view("index." . $themePath->themePath . ".watch");
    }

    public function webtoonDetail(Request $request)
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();

        $webtoon = Webtoon::Where('short_name', $request->short_name)->first();

        $trend_webtoons = Webtoon::Where('deleted', 0)->take(4)->orderBy('click_count', 'ASC')->get();

        return view("index." . $themePath->themePath . ".webtoonDetail", ['webtoon' => $webtoon, 'trend_webtoons' => $trend_webtoons]);
    }

    public function read()
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();
        return view("index." . $themePath->themePath . ".read");
    }

    public function loginScreen()
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();
        return view("index." . $themePath->themePath . ".login");
    }

    public function controlUsername(Request $request)
    {
        $user = IndexUser::Where('username', $request->username)->first();
        $control = false;
        if (!$user) $control = true; //bu kullanıcı adı ile kullanıcı yoksa doğru varsay yanlış döner

        return response()->json(['control' => $control]);
    }

    public function controlEmail(Request $request)
    {
        $user = IndexUser::Where('email', $request->email)->first();
        $control = false;
        if (!$user) $control = true; //bu kullanıcı adı ile kullanıcı yoksa doğru varsay yanlış döner

        return response()->json(['control' => $control]);
    }

    public function register(Request $request)
    {
        $newUser = new IndexUser();

        $user_code = IndexUser::orderBy('created_at', 'DESC')->first();
        if ($user_code) $newUser->code = $user_code->code + 1;
        else $newUser->code = 1;

        $newUser->name = $request->name;
        $newUser->username = $request->username;
        $newUser->email = $request->email;
        $newUser->image = '';
        $newUser->password = Hash::make($request->password);
        $newUser->save();

        Auth::login($newUser);

        return redirect()->route('index');
    }

    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('index');
        }
        return redirect()->route('loginScreen')->with("error", Config::get('error.error_codes.0020011'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
