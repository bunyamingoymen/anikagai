<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\AnimeEpisode;
use App\Models\Contact;
use App\Models\FavoriteAnime;
use App\Models\FavoriteWebtoon;
use App\Models\FollowAnime;
use App\Models\FollowWebtoon;
use App\Models\IndexUser;
use App\Models\KeyValue;
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
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();

        $trend_animes = Anime::Where('deleted', 0)->take(6)->orderBy('click_count', 'DESC')->get();
        $trend_webtoons = Webtoon::Where('deleted', 0)->take(6)->orderBy('click_count', 'DESC')->get();

        $animes = Anime::Where('deleted', 0)->take(20)->orderBy('created_at', 'DESC')->get();
        $webtoons = Webtoon::Where('deleted', 0)->take(20)->orderBy('created_at', 'DESC')->get();

        $slider_image = KeyValue::Where('key', 'slider_image')->Where('deleted', 0)->get();

        $slider_show = ThemeSetting::Where('theme_code', $selected_theme->value)->Where('setting_name', 'showSlider')->first()->setting_value;

        return view("index." . $themePath->themePath . ".index", ['slider_image' => $slider_image, 'trend_animes' => $trend_animes, 'trend_webtoons' => $trend_webtoons, 'animes' => $animes, 'webtoons' => $webtoons, 'slider_show' => $slider_show]);
    }

    public function list(Request $request)
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();
        $path = $request->path();

        $title = "";
        $list = array();
        $currentPage = $request->p ? $request->p : 1;
        $listItems = ThemeSetting::Where('theme_code', $selected_theme->value)->Where('setting_name', 'listCount')->first()->setting_value;
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

        $followed = false;
        $liked = false;

        if (Auth::user()) {
            $follow = FollowAnime::Where('user_code', Auth::user()->code)->Where('anime_code', $anime->code)->first();
            $like = FavoriteAnime::Where('user_code', Auth::user()->code)->Where('anime_code', $anime->code)->first();
            if ($follow) $followed = true;
            if ($like) $liked = true;
        }

        $categories = DB::table('categories')
            ->Where('content_categories.content_code', $anime->code)
            ->Where('content_categories.content_type', 1)
            ->join('content_categories', 'content_categories.category_code', '=', 'categories.code')
            ->join('animes', 'animes.code', '=', 'content_categories.content_code')
            ->select('categories.*')
            ->get();

        return view("index." . $themePath->themePath . ".animeDetail", ['anime' => $anime, 'trend_animes' => $trend_animes, 'anime_episodes' => $anime_episodes, 'categories' => $categories, 'followed' => $followed, 'liked' => $liked]);
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

        $currentTime = Carbon::now();

        $webtoon_episodes = WebtoonEpisode::Where('webtoon_code', $webtoon->code)->Where('publish_date', '<=', $currentTime)->get();

        $followed = false;
        $liked = false;

        if (Auth::user()) {
            $follow = FollowWebtoon::Where('user_code', Auth::user()->code)->Where('webtoon_code', $webtoon->code)->first();
            $like = FavoriteWebtoon::Where('user_code', Auth::user()->code)->Where('webtoon_code', $webtoon->code)->first();
            if ($follow) $followed = true;
            if ($like) $liked = true;
        }

        $categories = DB::table('categories')
            ->Where('content_categories.content_code', $webtoon->code)
            ->Where('content_categories.content_type', 0)
            ->join('content_categories', 'content_categories.category_code', '=', 'categories.code')
            ->join('webtoons', 'webtoons.code', '=', 'content_categories.content_code')
            ->select('categories.*')
            ->get();

        return view("index." . $themePath->themePath . ".webtoonDetail", ['webtoon' => $webtoon, 'trend_webtoons' => $trend_webtoons, 'webtoon_episodes' => $webtoon_episodes, 'categories' => $categories, 'followed' => $followed, 'liked' => $liked]);
    }

    public function read()
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();
        return view("index." . $themePath->themePath . ".read");
    }

    public function contactScreen()
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();

        return view("index." . $themePath->themePath . ".contact");
    }

    public function contact(Request $request)
    {
        $newContact = new Contact();

        $contact_code = Contact::orderBy('created_at', 'DESC')->first();
        if ($contact_code) $newContact->code = $contact_code->code + 1;
        else $newContact->code = 1;

        $newContact->name = $request->name;
        $newContact->email = $request->email;
        $newContact->subject = $request->subject;
        $newContact->message = $request->message;
        $newContact->save();

        return redirect()->route('contact_screen')->with('success', 'Başarılı bir şekilde mesaj gönderildi.');
    }

    public function loginScreen()
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();
        return view("index." . $themePath->themePath . ".login");
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

    public function profile(Request $request)
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();

        $user = IndexUser::Where('username', $request->username)->first();
        if (!$user) {
            $user = Auth::user();
        }
        return view("index." . $themePath->themePath . ".profile", ['user' => $user]);
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
}
