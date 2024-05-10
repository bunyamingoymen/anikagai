<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\AnimeEpisode;
use App\Models\FavoriteAnime;
use App\Models\FollowAnime;
use App\Models\NotificationUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnimeEpisodecontroller extends Controller
{
    public function episodeList()
    {
        return view("admin.anime.episode.list");
    }

    public function episodeCreateScreen()
    {

        $animes = Anime::Where('deleted', 0)->get();

        if (count($animes) <= 0) {
            return redirect()->route('admin_anime_episodes_list')->with('error', 'Herhangi bir anime mevcut değil. İlk önce anime ekleyiniz');
        }

        return view("admin.anime.episode.create", ['animes' => $animes]);
    }

    //Sadece anime bölümünü oluşturur. Video dosyasını yüklemez
    public function epsiodeCreateJustEpiosde(Request $request)
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
        $anime_episode->video = "";
        $anime_episode->intro_start_time_min = $request->intro_start_time_min;
        $anime_episode->intro_start_time_sec = $request->intro_start_time_sec;
        $anime_episode->intro_end_time_min = $request->intro_end_time_min;
        $anime_episode->intro_end_time_sec = $request->intro_end_time_sec;

        $anime_episode->create_user_code = Auth::guard('admin')->user()->code;

        $anime_episode->save();

        return response()->json(['success' => true, 'message' => 'Aşama Bir Tamamlandı', 'episode_code' => $anime_episode->code]);
    }

    //Gelen videoları temp klasörüne yükler
    public function epsiodeCreateUploadVideo(Request $request)
    {
        //return response()->json(['success' => false, 'request' => $request]);
        if ($request->hasFile('file') && $request->episode_code) {
            //return response()->json(['success' => false, 'request' => $request, 'message' => 'Dosya Var']);
            $anime_episode = AnimeEpisode::Where('code', $request->episode_code)->where('deleted', 0)->first();
            if (!$anime_episode) return response()->json(['success' => false, 'message' => 'Anime Bölümü Bulunamadı', 'episode_code' => $request->episode_code]);

            $file = $request->file('file');
            //return response()->json(['success' => false, 'chunk' => $file, 'message' => 'Dosya Var']);
            $realPath = 'files/tmp/animesEpisodes/' . $anime_episode->anime_code . '/' . $anime_episode->season_short . '/' . $anime_episode->episode_short . '/' . $anime_episode->code . '/';
            $path = public_path($realPath);

            $name = $request->order . "." . $request->file_extension;

            //$file->move($path, $name);
            $file->storeAs('public/' . $realPath, $name);


            return response()->json(['success' => true, 'message' => 'Part ' . $request->order . ' yüklendi', 'episode_code' => $request->episode_code, 'name' => $name, 'path' => $realPath]);
        } else {
            return response()->json(['success' => false, 'message' => 'Aşama İkide Bir Hata Meydana Geldi', 'episode_code' => $request->episode_code]);
        }
    }

    //Geçici klasöre yüklenen her videoyu birleştirir ve animeye onu ekler.
    public function epsiodeCreateVideoMerge(Request $request)
    {
        $anime_episode = AnimeEpisode::Where('code', $request->episode_code)->where('deleted', 0)->first();
        if (!$anime_episode) return response()->json(['success' => false, 'message' => 'Anime Bölümü Bulunamadı', 'episode_code' => $request->episode_code]);

        $totalParts = $request->total_parts;
        $realPath = 'public/files/animes/animesEpisodes/' . $anime_episode->anime_code . "/" . $anime_episode->season_short . '/' . $anime_episode->episode_short;

        $name = $anime_episode->code . "." . $request->file_extension;

        $tmpPath = 'public/files/tmp/animesEpisodes/' . $anime_episode->anime_code . '/' . $anime_episode->season_short . '/' . $anime_episode->episode_short . '/' . $anime_episode->code . '/';

        for ($i = 1; $i <= $totalParts; $i++) {
            $filePartPath = $tmpPath . $i . '.' . $request->file_extension;
            $fileParts[] = Storage::get($filePartPath);
        }

        $mergedContent = implode('', $fileParts);
        $resultPath = $realPath . '/' . $name;
        // Birleştirilmiş içeriği oluşturulan dosyaya yaz
        Storage::put($resultPath, $mergedContent);

        $anime_episode->video = $resultPath;
        $anime_episode->save();

        Storage::deleteDirectory('public/files/tmp');

        //Animenin bölüm ve sezon sayısını ayarlayan komut
        if (true) {
            $anime = Anime::Where('code', $anime_episode->anime_code)->first();
            $anime->episode_count = $anime->episode_count ?  $anime->episode_count + 1 :  $anime->episode_count;
            $anime->season_count = $anime_episode->season_short > $anime->season_count ?  $anime_episode->season_short : $anime->season_count;
            $anime->save();
        }

        //sitemap güncelleme komutları
        $this->sitemapGenerator();

        //Beğenen ve takip eden kullanıcılara bildirim gönderme komutları
        if (true) {
            $publishDate = $anime_episode->publish_date;
            $EndDate = Carbon::parse($publishDate)->addMonths(1)->format('Y-m-d');

            $favorite_animes_user = FavoriteAnime::Where('anime_code', $anime->code)->get();
            $follow_animes_user = FollowAnime::Where('anime_code', $anime->code)->get();

            $notification_code = NotificationUser::max('notification_code') + 1;
            $this->sendNotificationIndexUser($anime->thumb_image_2, $anime->name, "Yeni Bölüm Yüklendi!!", url('anime/' . $anime->short_name . '/' . $anime_episode->season_short . '/' . $anime_episode->episode_short), 0, $publishDate, $EndDate, $notification_code);

            foreach ($favorite_animes_user as $item) {
                $this->sendNotificationIndexUser($anime->thumb_image_2, $anime->name, "Yeni Bölüm Yüklendi!!", url('anime/' . $anime->short_name . '/' . $anime_episode->season_short . '/' . $anime_episode->episode_short), $item->user_code, $publishDate, $EndDate, $notification_code);
            }

            foreach ($follow_animes_user as $item) {
                $this->sendNotificationIndexUser($anime->thumb_image_2, $anime->name, "Yeni Bölüm Yüklendi!!", url('anime/' . $anime->short_name . '/' . $anime_episode->season_short . '/' . $anime_episode->episode_short), $item->user_code, $publishDate, $EndDate, $notification_code);
            }
        }


        return response()->json(['success' => true, 'message' => 'Başarılı bir şekilde Anime Bölümü Ekleni']);
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
        $anime->episode_count = $anime->episode_count ?  $anime->episode_count + 1 :  $anime->episode_count;
        $anime->season_count = $request->season_short > $anime->season_count ?  $request->season_short : $anime->season_count;
        $anime->save();


        $anime_episode->create_user_code = Auth::guard('admin')->user()->code;

        $anime_episode->save();

        $this->sitemapGenerator();

        $publishDate = $anime_episode->publish_date;
        $EndDate = Carbon::parse($publishDate)->addMonths(1)->format('Y-m-d');

        $favorite_animes_user = FavoriteAnime::Where('anime_code', $anime->code)->get();
        $follow_animes_user = FollowAnime::Where('anime_code', $anime->code)->get();

        $notification_code = NotificationUser::max('notification_code') + 1;
        $this->sendNotificationIndexUser($anime->thumb_image_2, $anime->name, "Yeni Bölüm Yüklendi!!", url('anime/' . $anime->short_name . '/' . $anime_episode->season_short . '/' . $anime_episode->episode_short), 0, $publishDate, $EndDate, $notification_code);

        foreach ($favorite_animes_user as $item) {
            $this->sendNotificationIndexUser($anime->thumb_image_2, $anime->name, "Yeni Bölüm Yüklendi!!", url('anime/' . $anime->short_name . '/' . $anime_episode->season_short . '/' . $anime_episode->episode_short), $item->user_code, $publishDate, $EndDate, $notification_code);
        }

        foreach ($follow_animes_user as $item) {
            $this->sendNotificationIndexUser($anime->thumb_image_2, $anime->name, "Yeni Bölüm Yüklendi!!", url('anime/' . $anime->short_name . '/' . $anime_episode->season_short . '/' . $anime_episode->episode_short), $item->user_code, $publishDate, $EndDate, $notification_code);
        }



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

        $this->sitemapGenerator();

        return redirect()->route('admin_anime_episodes_list')->with("success", Config::get('success.success_codes.10080013'));
    }

    public function episodeGetData(Request $request)
    {
        $take  = $request->showingCount ? $request->showingCount : Config::get('app.showCount');
        $skip = (($request->page - 1) * $take);

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

        $anime_episode = $episodeQuery->skip($skip)->take($take)->get();
        $page_count = ceil($episodeQuery = DB::table('anime_episodes')
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
            ->select('anime_episodes.*', 'animes.name as anime_name', 'animes.thumb_image_2 as anime_image')->count() / $take);

        return [
            'anime_episode' => $anime_episode,
            'page_count' => $page_count,
        ];
    }
}
