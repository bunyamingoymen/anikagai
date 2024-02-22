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
        /*
        $anime_episodes = DB::table('anime_episodes')
            ->Where('anime_episodes.deleted', 0)
            ->join('animes', 'animes.code', '=', 'anime_episodes.anime_code')
            ->select('anime_episodes.*', 'animes.name as anime_name', 'animes.image as anime_image')
            ->take($this->showCount)
            ->get();
        $currentCount = 1;
        $pageCountTest = AnimeEpisode::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        */
        return view("admin.anime.episode.list");
    }

    public function episodeCreateScreen()
    {

        $animes = Anime::Where('deleted', 0)->get();

        return view("admin.anime.episode.create", ['animes' => $animes]);
    }

    public function episodeCreate(Request $request)
    {
        $anime_episode = new AnimeEpisode();
        $anime_episode->code = AnimeEpisode::max('code') + 1;

        $anime_episode->name = $request->name;

        $anime_episode->anime_code = $request->anime_code;

        $anime_episode->description = $request->description;
        $anime_episode->season_short = $request->season_short;
        $anime_episode->episode_short = $request->episode_short;
        $anime_episode->publish_date = $request->publish_date;
        $anime_episode->click_count = 0;

        $anime_episode->intro_start_time_min = $request->intro_start_time_min;
        $anime_episode->intro_start_time_sec = $request->intro_start_time_sec;
        $anime_episode->intro_end_time_min = $request->intro_end_time_min;
        $anime_episode->intro_end_time_sec = $request->intro_end_time_sec;

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

        $anime = Anime::Where('code', $request->anime_code)->first();
        $anime->episode_count = $anime->episode_count + 1;
        $anime->season_count = $request->season_short > $anime->season_count ?  $request->season_short : $anime->season_count;
        $anime->save();


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

        $anime_episode->intro_start_time_min = $request->intro_start_time_min;
        $anime_episode->intro_start_time_sec = $request->intro_start_time_sec;
        $anime_episode->intro_end_time_min = $request->intro_end_time_min;
        $anime_episode->intro_end_time_sec = $request->intro_end_time_sec;

        $anime_episode->update_user_code = Auth::guard('admin')->user()->code;

        $anime_episode->save();

        $anime = Anime::Where('code', $request->anime_code)->first();
        $anime->season_count = $request->season_short > $anime->season_count ?  $request->season_short : $anime->season_count;
        $anime->save();

        return redirect()->route('admin_anime_episodes_list')->with("success", Config::get('success.success_codes.10080012'));
    }

    public function episodeDelete(Request $request)
    {
        $anime_episode = AnimeEpisode::Where('code', $request->code)->Where('deleted', 0)->first();
        $anime = Anime::Where('code', $anime_episode->anime_code)->Where('deleted', 0)->first();
        //dd($anime);

        if (!$anime_episode || !$anime)
            return redirect()->back()->with("error", Config::get('error.error_codes.0080013'));

        $anime_episode->deleted = 1;
        $anime_episode->update_user_code = Auth::guard('admin')->user()->code;
        $anime_episode->save();

        $anime->episode_count = $anime->episode_count - 1;

        if (!AnimeEpisode::Where('anime_code', $anime->code)->Where('season_short', $anime->season_count)->Where('deleted', 0)->exists()) {
            $anime->season_count = $anime->season_count - 1;
        }
        $anime->update_user_code = Auth::guard('admin')->user()->code;
        $anime->save();

        return redirect()->route('admin_anime_episodes_list')->with("success", Config::get('success.success_codes.10080013'));
    }

    public function episodeGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $searchData = $request->searchData;
        $selectedAnimeCode = $request->selectedAnimeCode;

        $episodeQuery = DB::table('anime_episodes')
            ->where("anime_episodes.deleted", 0)
            ->where("animes.deleted", 0)
            ->when($request->selectedAnimeCode, function ($query, $selectedAnimeCode) {
                return $query->where('animes.code', $selectedAnimeCode);
            })
            ->when($request->searchData, function ($query, $searchData) {
                return $query->where(function ($query) use ($searchData) {
                    $query->where('anime_episodes.name', 'LIKE', '%' . $searchData . '%')
                        ->orWhere('anime_episodes.description', 'LIKE', '%' . $searchData . '%')
                        ->orWhere('anime_episodes.minute', 'LIKE', '%' . $searchData . '%');
                });
            })
            ->join('animes', 'animes.code', '=', 'anime_episodes.anime_code')
            ->select('anime_episodes.*', 'animes.name as anime_name', 'animes.thumb_image_2 as anime_image');

        $anime_episode = $episodeQuery->skip($skip)->take($this->showCount)->get();
        $page_count = ceil($episodeQuery->count() / $this->showCount);

        return [
            'anime_episode' => $anime_episode,
            'page_count' => $page_count,
        ];
    }
}
