<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\AnimeEpisode;
use App\Models\KeyValue;
use App\Models\Theme;
use App\Models\Webtoon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();

        $trend_animes = Anime::Where('deleted', 0)->take(6)->orderBy('click_count', 'ASC')->get();
        $trend_webtoons = Webtoon::Where('deleted', 0)->take(6)->orderBy('click_count', 'ASC')->get();

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

        $anime_episodes = AnimeEpisode::Where('anime_code', $anime->code)->get();

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

        $webtoon = Anime::Where('short_name', $request->short_name)->first();

        $trend_webtoons = Anime::Where('deleted', 0)->take(4)->orderBy('click_count', 'ASC')->get();

        return view("index." . $themePath->themePath . ".webtoonDetail", ['webtoon' => $webtoon, 'trend_webtoons' => $trend_webtoons]);
    }

    public function read()
    {
        $selected_theme = KeyValue::Where('key', 'selected_theme')->first();
        $themePath = Theme::Where('code', $selected_theme->value)->first();
        return view("index." . $themePath->themePath . ".read");
    }
}
