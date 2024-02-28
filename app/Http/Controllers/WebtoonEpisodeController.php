<?php

namespace App\Http\Controllers;

use App\Models\FavoriteWebtoon;
use App\Models\FollowWebtoon;
use App\Models\Webtoon;
use App\Models\WebtoonEpisode;
use App\Models\WebtoonFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class WebtoonEpisodeController extends Controller
{
    public function episodeList()
    {
        return view("admin.webtoon.episode.list");
    }

    public function episodeCreateScreen()
    {

        $webtoons = Webtoon::Where('deleted', 0)->get();

        return view("admin.webtoon.episode.create", ['webtoons' => $webtoons]);
    }

    public function episodeCreate(Request $request)
    {
        $webtoon_episode = new WebtoonEpisode();

        $webtoon_episode->code = WebtoonEpisode::max('code') + 1;

        $webtoon_episode->name = $request->name;

        $webtoon_episode->webtoon_code = $request->webtoon_code;

        $webtoon_episode->description = $request->description;
        $webtoon_episode->season_short = $request->season_short;
        $webtoon_episode->episode_short = $request->episode_short;
        $webtoon_episode->publish_date = $request->publish_date;
        $webtoon_episode->click_count = 0;

        $webtoon_episode->create_user_code = Auth::guard('admin')->user()->code;

        $webtoon_episode->save();

        $fileTypeSelect = $request->fileTypeSelect;
        if ($fileTypeSelect == "pdf") {
            $pdf = new WebtoonFile();

            $pdf->code = WebtoonFile::max('code') + 1;

            $pdf->webtoon_episode_code = $webtoon_episode->code;
            $pdf->file_type = "pdf";
            if ($request->hasFile('pdf')) {
                // Dosyayı al
                $file = $request->file('pdf');

                $path = public_path('files/webtoons/webtoonsEpisodes/' . $request->webtoon_code . "/" . $webtoon_episode->season_short . '/' . $webtoon_episode->episode_short);
                $name = $pdf->code . "." . $file->getClientOriginalExtension();
                $file->move($path, $name);
                $pdf->file = 'files/webtoons/webtoonsEpisodes/' . $request->webtoon_code . "/" . $webtoon_episode->season_short . '/' . $webtoon_episode->episode_short . "/" . $name;
            } else {
                $pdf->file = "";
            }
            $pdf->file_order = 1;
            $pdf->create_user_code = Auth::guard('admin')->user()->code;

            $pdf->save();
        } else if ($fileTypeSelect == "image") {
            for ($i = 1; $i <= $request->totalFileCount; $i++) {
                $image = new WebtoonFile();

                $image->code = WebtoonFile::max('code') + 1;

                $image->webtoon_episode_code = $webtoon_episode->code;
                $image->file_type = "image";

                if ($request->hasFile('imageFile' . $i)) {
                    $file = $request->file('imageFile' . $i);

                    $path = public_path('files/webtoons/webtoonsEpisodes/' . $request->webtoon_code . "/" . $webtoon_episode->season_short . '/' . $webtoon_episode->episode_short);
                    $name = $webtoon_episode->code . "_" . $image->code . "." . $file->getClientOriginalExtension();
                    $file->move($path, $name);

                    $image->file = 'files/webtoons/webtoonsEpisodes/' . $request->webtoon_code . "/" . $webtoon_episode->season_short . '/' . $webtoon_episode->episode_short . "/" . $name;
                } else {
                    $image->file = "";
                }
                $image->file_order = $request->input('imageShort' . $i);
                $image->create_user_code = Auth::guard('admin')->user()->code;
                $image->save();
            }
        } else if ($fileTypeSelect == "zip") {
            if ($request->hasFile('zipFile')) {

                $path = 'files/webtoons/webtoonsEpisodes/' . $request->webtoon_code . '/' . $webtoon_episode->season_short . '/' . $webtoon_episode->episode_short . '/' . $webtoon_episode->code;
                $publicPath = public_path($path);

                $file = $request->file('zipFile');
                $name = $webtoon_episode->code . "_zip" . "." . $file->getClientOriginalExtension();
                $file->move($publicPath, $name);

                $zipPath = $publicPath . "/" . $name;

                if (file_exists($zipPath)) {
                    $zip = new ZipArchive;
                    $zip->open($zipPath);
                    $zip->extractTo($publicPath);
                    $zip->close();

                    //$files = Storage::allFiles($publicPath);
                    $files = glob($publicPath . '/*');

                    if (count($files) <= 0) {
                        $webtoon_episode->delete();
                        return response()->json(['success' => false, 'message' => 'Dosyalar bulunamadı.'], 405);
                    }

                    foreach ($files as $extractedFile) {
                        $filename = pathinfo($extractedFile, PATHINFO_FILENAME);
                        $extension = pathinfo($extractedFile, PATHINFO_EXTENSION);
                        if ($extension != "zip") {
                            if (!$this->isFileNameNumeric($filename)) {
                                // Dosya adı sadece sayılardan oluşmuyorsa, klasörü temizle ve hata döndür
                                File::deleteDirectory(public_path('files/webtoons/webtoonsEpisodes/' . $request->webtoon_code . '/' . $webtoon_episode->season_short . '/' . $webtoon_episode->episode_short));
                                WebtoonFile::Where('webtoon_episode_code', $webtoon_episode->code)->delete();
                                $webtoon_episode->delete();

                                return response()->json(['success' => false, 'message' => 'Dosya adları sadece sayılardan oluşmalıdır. Yüklenenler silindi.' . $filename], 400);
                            }
                            $image = new WebtoonFile();

                            $image->code = WebtoonFile::max('code') + 1;
                            $image->webtoon_episode_code = $webtoon_episode->code;
                            $image->file_type = "image";
                            $image->file = $path . '/' . $filename . '.' . $extension;
                            $image->file_order = intval($filename);
                            $image->save();
                        }
                    }
                }
            } else {
                $webtoon_episode->delete();
                return response()->json(['success' => false, 'message' => 'Dosya yüklenmedi.'], 405);
            }
        }

        $webtoon = Webtoon::Where('code', $request->webtoon_code)->first();
        $webtoon->episode_count = $webtoon->episode_count + 1;
        $webtoon->season_count = $request->season_short > $webtoon->season_count ?  $request->season_short : $webtoon->season_count;
        $webtoon->save();

        $this->sitemapGenerator();

        $favorite_webtoons_user = FavoriteWebtoon::Where('webtoon_code', $webtoon->code)->get();
        $follow_webtoons_user = FollowWebtoon::Where('webtoon_code', $webtoon->code)->get();

        $publishDate = $webtoon_episode->publish_date;
        $EndDate = Carbon::parse($publishDate)->addMonths(1)->format('Y-m-d');

        foreach ($favorite_webtoons_user as $item) {
            $this->sendNotificationIndexUser(0, $webtoon->thumb_image_2, null, $webtoon->name, "Yeni Bölüm Yüklendi!!", url('webtoon/' . $webtoon->short_name . '/' . $webtoon_episode->season_short . '/' . $webtoon_episode->episode_short), $item->user_code, $publishDate, $EndDate);
        }

        foreach ($follow_webtoons_user as $item) {
            $this->sendNotificationIndexUser(0, $webtoon->thumb_image_2, null, $webtoon->name, "Yeni Bölüm Yüklendi!!", url('webtoon/' . $webtoon->short_name . '/' . $webtoon_episode->season_short . '/' . $webtoon_episode->episode_short), $item->user_code, $publishDate, $EndDate);
        }

        return response()->json(['success' => true]);
    }

    public function episodeUpdateScreen(Request $request)
    {

        $webtoon_episode = WebtoonEpisode::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$webtoon_episode)
            return redirect()->back()->with("error", Config::get('error.error_codes.0110002'));

        $webtoon = Webtoon::Where('deleted', 0)->Where('code', $webtoon_episode->webtoon_code)->first();


        return view("admin.webtoon.episode.update", ["webtoon_episode" => $webtoon_episode, "webtoon" => $webtoon]);
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
        $webtoon_episode->publish_date = $request->publish_date;

        $webtoon_episode->update_user_code = Auth::guard('admin')->user()->code;

        $webtoon_episode->save();

        $webtoon = Webtoon::Where('code', $request->webtoon_code)->first();
        $webtoon->season_count = $request->season_short > $webtoon->season_count ?  $request->season_short : $webtoon->season_count;
        $webtoon->save();

        return redirect()->route('admin_webtoon_episodes_list')->with("success", Config::get('success.success_codes.10110012'));
    }

    public function episodeDelete(Request $request)
    {
        $webtoon_episode = WebtoonEpisode::Where('code', $request->code)->Where('deleted', 0)->first();
        $webtoon = Webtoon::Where('code', $webtoon_episode->webtoon_code)->Where('deleted', 0)->first();

        if (!$webtoon_episode || !$webtoon)
            return redirect()->back()->with("error", Config::get('error.error_codes.0110013'));

        $webtoon_episode->deleted = 1;
        $webtoon_episode->update_user_code = Auth::guard('admin')->user()->code;
        $webtoon_episode->save();

        $webtoon->episode_count = $webtoon->episode_count - 1;

        if (!WebtoonEpisode::Where('webtoon_code', $webtoon->code)->Where('season_short', $webtoon->season_count)->Where('deleted', 0)->exists()) {
            $webtoon->season_count = $webtoon->season_count - 1;
        }
        $webtoon->update_user_code = Auth::guard('admin')->user()->code;
        $webtoon->save();
        $this->sitemapGenerator();

        return redirect()->route('admin_webtoon_episodes_list')->with("success", Config::get('success.success_codes.10110013'));
    }

    public function episodeGetData(Request $request)
    {
        $take  = $request->showingCount ? $request->showingCount : Config::get('app.showCount');
        $skip = (($request->page - 1) * $take);
        $searchData = $request->searchData;
        $selectedWebtoonCode = $request->selectedWebtoonCode;

        $episodeQuery = DB::table('webtoon_episodes')
            ->where("webtoon_episodes.deleted", 0)
            ->where("webtoons.deleted", 0)
            ->when($request->selectedWebtoonCode, function ($query, $selectedWebtoonCode) {
                return $query->where('webtoons.code', $selectedWebtoonCode);
            })
            ->when($request->searchData, function ($query, $searchData) {
                return $query->where(function ($query) use ($searchData) {
                    $query->where('webtoon_episodes.name', 'LIKE', '%' . $searchData . '%')
                        ->orWhere('webtoon_episodes.description', 'LIKE', '%' . $searchData . '%')
                        ->orWhere('webtoon_episodes.minute', 'LIKE', '%' . $searchData . '%');
                });
            })
            ->join('webtoons', 'webtoons.code', '=', 'webtoon_episodes.webtoon_code')
            ->select('webtoon_episodes.*', 'webtoons.name as webtoon_name', 'webtoons.thumb_image_2 as webtoon_image');

        $webtoon_episode = $episodeQuery->skip($skip)->take($take)->get();
        $page_count = ceil(DB::table('webtoon_episodes')
            ->where("webtoon_episodes.deleted", 0)
            ->where("webtoons.deleted", 0)
            ->when($request->selectedWebtoonCode, function ($query, $selectedWebtoonCode) {
                return $query->where('webtoons.code', $selectedWebtoonCode);
            })
            ->when($request->searchData, function ($query, $searchData) {
                return $query->where(function ($query) use ($searchData) {
                    $query->where('webtoon_episodes.name', 'LIKE', '%' . $searchData . '%')
                        ->orWhere('webtoon_episodes.description', 'LIKE', '%' . $searchData . '%')
                        ->orWhere('webtoon_episodes.minute', 'LIKE', '%' . $searchData . '%');
                });
            })
            ->join('webtoons', 'webtoons.code', '=', 'webtoon_episodes.webtoon_code')
            ->select('webtoon_episodes.*', 'webtoons.name as webtoon_name', 'webtoons.thumb_image_2 as webtoon_image')->count() / $take);

        //return $webtoon_episode;
        return [
            'webtoon_episode' => $webtoon_episode,
            'page_count' => $page_count,
        ];
    }

    function isFileNameNumeric($filename)
    {
        return preg_match('/^\d+$/', $filename);
    }
}
