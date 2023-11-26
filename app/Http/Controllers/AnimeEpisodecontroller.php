<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\AnimeEpisode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AnimeEpisodecontroller extends Controller
{
    public function episodeList()
    {
        //$anime_episodes = AnimeEpisode::Where('deleted', 0)->take(10)->get();
        $anime_episodes = DB::table('anime_episodes')
            ->join('animes', 'animes.code', '=', 'anime_episodes.anime_code')
            ->select('anime_episodes.*', 'animes.name as anime_name', 'animes.image as anime_image')
            ->get();
        $currentCount = 1;
        $pageCountTest = AnimeEpisode::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.anime.episode.list", ["anime_episodes" => $anime_episodes, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
    }

    public function episodeCreateScreen()
    {

        $animes = Anime::Where('deleted', 0)->get();

        return view("admin.anime.episode.create", ['animes' => $animes]);
    }

    public function episodeCreate(Request $request)
    {
        $anime_episode = new AnimeEpisode();

        $anime_episode_code = AnimeEpisode::orderBy('created_at', 'DESC')->first();
        if ($anime_episode_code) $anime_episode->code = $anime_episode_code->code + 1;
        else $anime_episode->code = 1;

        $anime_episode->name = $request->name;

        $anime_episode->anime_code = $request->anime_code;

        $anime_episode->description = $request->description;
        $anime_episode->season_short = $request->season_short;
        $anime_episode->episode_short = $request->episode_short;
        $anime_episode->publish_date = $request->publish_date;
        $anime_episode->click_count = 0;

        if ($request->hasFile('video')) {
            // Dosyayı al
            $file = $request->file('video');

            $path = public_path('files/animes/animesEpisodes/' . $request->anime_code . "/" . $anime_episode->season_short . '/' . $anime_episode->episode_short);
            $name = $anime_episode->code . "." . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $anime_episode->video = 'files/animes/animesEpisodes/' . $request->anime_code . "/" . $anime_episode->season_short . '/' . $anime_episode->episode_short . "/" . $name;
        } else {
            $anime_episode->video = "";
        }



        $anime_episode->create_user_code = Auth::guard('admin')->user()->code;

        $anime_episode->save();

        return response()->json(['success' => true]);
    }

    public function episodeUpdateScreen(Request $request)
    {

        $anime_episode = AnimeEpisode::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$anime_episode)
            return redirect()->back()->with("error", Config::get('error.error_codes.0080002'));

        $anime = Anime::Where('deleted', 0)->Where('code', $anime_episode->code)->first();

        return view("admin.anime.episode.update", ["anime_episode" => $anime_episode, "anime" => $anime]);
    }

    public function epsiodeUpdate(Request $request)
    {
        $anime_episode = AnimeEpisode::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$anime_episode)
            return redirect()->back()->with("error", Config::get('error.error_codes.0080012'));

        $anime_episode->name = $request->name;

        $anime_episode->description = $request->description;
        $anime_episode->season_short = $request->season_short;
        $anime_episode->episode_short = $request->episode_short;
        $anime_episode->publish_date = $request->publish_date;

        $anime_episode->update_user_code = Auth::guard('admin')->user()->code;

        $anime_episode->save();

        return redirect()->route('admin_anime_episodes_list')->with("success", Config::get('success.success_codes.10080012'));
    }

    public function episodeDelete(Request $request)
    {
        $anime_episode = AnimeEpisode::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$anime_episode)
            return redirect()->back()->with("error", Config::get('error.error_codes.0080013'));

        $anime_episode->deleted = 1;
        $anime_episode->update_user_code = Auth::guard('admin')->user()->code;
        $anime_episode->save();
        return redirect()->route('admin_anime_episodes_list')->with("success", Config::get('success.success_codes.10080013'));
    }

    public function episodeGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $anime_episode = AnimeEpisode::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $anime_episode;
    }
}
