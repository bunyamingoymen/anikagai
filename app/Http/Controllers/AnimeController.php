<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AnimeController extends Controller
{
    public function animeList()
    {
        $title = "Animeler";
        $animes = Anime::Where('deleted', 0)->take(10)->get();
        $currentCount = 1;
        $pageCountTest = Anime::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.anime.anime.list", ["title" => $title, "animes" => $animes, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
    }

    public function animeCreateScreen()
    {
        $title = "Yeni Bir Anime Ekle";


        return view("admin.anime.anime.create", ["title" => $title]);
    }

    public function animeCreate(Request $request)
    {
        $anime = new Anime();

        $anime_code = Anime::orderBy('created_at', 'DESC')->first();
        if ($anime_code) $anime->code = $anime_code->code + 1;
        else $anime->code = 1;

        $anime->name = $request->name;

        if ($request->hasFile('image')) {
            // Dosyayı al
            $file = $request->file('image');

            $path = public_path('files/animes/animesImages');
            $name = $anime->code . "." . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $anime->image = "files/animes/animesImages/" . $name;
        } else {
            $anime->image = "";
        }

        $anime->description = $request->description;
        $anime->episode_count = 0;
        $anime->click_count = 0;

        $anime->create_user_code = Auth::user()->code;

        $anime->save();

        return redirect()->route('admin_anime_list')->with("success", $this->successCreateMessage);
    }

    public function animeUpdateScreen(Request $request)
    {

        $anime = Anime::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$anime)
            return redirect()->back()->with("error", Config::get('error.error_codes.0060002'));

        $title = "Anime Güncelle";

        return view("admin.anime.anime.update", ["title" => $title, "anime" => $anime]);
    }

    public function animeUpdate(Request $request)
    {
        $anime = Anime::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$anime)
            return redirect()->back()->with("error", Config::get('error.error_codes.0060012'));

        $anime->name = $request->name;

        if ($request->hasFile('image')) {
            // Dosyayı al
            $file = $request->file('image');

            $path = public_path('files/animes/animesImages');
            $name = $anime->code . "" . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $anime->image = "files/animes/animesImages/" . $name;
        }

        $anime->description = $request->description;
        $anime->episode_count = 0;
        $anime->click_count = 0;

        $anime->update_user_code = Auth::user()->code;

        $anime->save();

        return redirect()->route('admin_anime_list')->with("success", $this->successCreateMessage);
    }

    public function animeDelete(Request $request)
    {
        $anime = Anime::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$anime)
            return redirect()->back()->with("error", Config::get('error.error_codes.0060013'));

        $anime->deleted = 1;
        $anime->update_user_code = Auth::user()->code;
        $anime->save();
        return redirect()->route('admin_anime_list')->with("success", $this->successDeleteMessage);
    }

    public function animeGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $animes = Anime::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $animes;
    }
}
