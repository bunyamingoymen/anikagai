<?php

namespace App\Http\Controllers;

use App\Models\Webtoon;
use App\Models\WebtoonEpisode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class WebtoonEpisodeController extends Controller
{
    public function episodeList()
    {

        $webtoon_episodes = DB::table('webtoon_episodes')
            ->join('webtoons', 'webtoons.code', '=', 'webtoon_episodes.webtoon_code')
            ->select('webtoon_episodes.*', 'webtoons.name as webtoon_name', 'webtoons.image as webtoon_image')
            ->get();
        $currentCount = 1;
        $pageCountTest = WebtoonEpisode::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.webtoon.episode.list", ["webtoon_episodes" => $webtoon_episodes, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
    }

    public function episodeCreateScreen()
    {

        $webtoons = Webtoon::Where('deleted', 0)->get();

        return view("admin.webtoon.episode.create", ['webtoons' => $webtoons]);
    }

    public function episodeCreate(Request $request)
    {
        $webtoon_episode = new WebtoonEpisode();

        $webtoon_episode_code = WebtoonEpisode::orderBy('created_at', 'DESC')->first();
        if ($webtoon_episode_code) $webtoon_episode->code = $webtoon_episode_code->code + 1;
        else $webtoon_episode->code = 1;

        $webtoon_episode->name = $request->name;

        $webtoon_episode->webtoon_code = $request->webtoon_code;

        $webtoon_episode->description = $request->description;
        $webtoon_episode->season_short = $request->season_short;
        $webtoon_episode->episode_short = $request->episode_short;
        $webtoon_episode->publish_date = $request->publish_date;
        $webtoon_episode->click_count = 0;

        if ($request->hasFile('video')) {
            // Dosyayı al
            $file = $request->file('video');

            $path = public_path('files/webtoons/webtoonsEpisodes/' . $request->webtoon_code . "/" . $webtoon_episode->season_short . '/' . $webtoon_episode->episode_short);
            $name = $webtoon_episode->code . "." . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $webtoon_episode->file = 'files/webtoons/webtoonsEpisodes/' . $request->webtoon_code . "/" . $webtoon_episode->season_short . '/' . $webtoon_episode->episode_short . "/" . $name;
        } else {
            $webtoon_episode->file = "";
        }



        $webtoon_episode->create_user_code = Auth::guard('admin')->user()->code;

        $webtoon_episode->save();

        return response()->json(['success' => true]);
    }

    public function episodeUpdateScreen(Request $request)
    {

        $webtoon_episode = WebtoonEpisode::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$webtoon_episode)
            return redirect()->back()->with("error", Config::get('error.error_codes.0110002'));

        $webtoons = Webtoon::Where('deleted', 0)->get();


        return view("admin.webtoon.episode.update", ["webtoon_episode" => $webtoon_episode, "webtoons" => $webtoons]);
    }

    public function epsiodeUpdate(Request $request)
    {
        $webtoon_episode = WebtoonEpisode::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$webtoon_episode)
            return redirect()->back()->with("error", Config::get('error.error_codes.0110012'));

        $webtoon_episode->name = $request->name;

        $webtoon_episode->description = $request->description;
        $webtoon_episode->season_short = $request->season_short;
        $webtoon_episode->episode_short = $request->episode_short;

        $webtoon_episode->update_user_code = Auth::guard('admin')->user()->code;

        $webtoon_episode->save();

        return redirect()->route('admin_webtoon_episodes_list')->with("success", Config::get('success.success_codes.10110012'));
    }

    public function episodeDelete(Request $request)
    {
        $webtoon_episode = WebtoonEpisode::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$webtoon_episode)
            return redirect()->back()->with("error", Config::get('error.error_codes.0110013'));

        $webtoon_episode->deleted = 1;
        $webtoon_episode->update_user_code = Auth::guard('admin')->user()->code;
        $webtoon_episode->save();
        return redirect()->route('admin_webtoon_episodes_list')->with("success", Config::get('success.success_codes.10110013'));
    }

    public function episodeGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $webtoon_episode = WebtoonEpisode::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $webtoon_episode;
    }
}
