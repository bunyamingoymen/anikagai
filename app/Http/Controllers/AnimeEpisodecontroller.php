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
use League\Flysystem\Visibility;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

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
        $anime_episode->is_url = 0;

        $anime_episode->video = "";

        $anime_episode->video_minute = $request->video_minute ? $request->video_minute : 0;
        $anime_episode->video_second = $request->video_second ? $request->video_second : 0;

        $anime_episode->intro_start_time_min = $request->intro_start_time_min ? $request->intro_start_time_min : 0;
        $anime_episode->intro_start_time_sec = $request->intro_start_time_sec ? $request->intro_start_time_sec : 0;
        $anime_episode->intro_end_time_min = $request->intro_end_time_min ? $request->intro_end_time_min : 0;
        $anime_episode->intro_end_time_sec = $request->intro_end_time_sec ? $request->intro_end_time_sec : 0;

        $anime_episode->next_episode_time_min = $request->next_episode_time_min ? $request->next_episode_time_min : 0;
        $anime_episode->next_episode_time_sec = $request->next_episode_time_sec ? $request->next_episode_time_sec : 0;

        $anime_episode->show_intro_button = $request->show_intro_button ? 1 : 0;
        $anime_episode->show_next_episode_button = $request->show_next_episode_button ? 1 : 0;

        $anime_episode->create_user_code = Auth::guard('admin')->user()->code;

        $anime_episode->save();

        return response()->json(['success' => true, 'message' => 'Aşama Bir Tamamlandı', 'episode_code' => $anime_episode->code]);
    }

    //Video yükler
    public function episodeCreate(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        if (!$receiver->isUploaded()) {
            //file not uploaded
        }
        $fileReceived = $receiver->receive();

        if ($fileReceived->isFinished()) {
            $file = $fileReceived->getFile(); //getFile
            $extension = $file->getClientOriginalExtension();
            $fileName = '_' . md5(time() . '.' . $extension);
            $disk = Storage::disk(config('filesystems.disks.public_chunks'));
            $path = $disk->put('public/videos/animeEpisodes', $file, Visibility::PUBLIC);

            unlink($file->getPathname());

            return [
                'path' => $path,
                'filename' => $fileName,
                'request' => $request,
            ];
        }

        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status => true',
            'request' => $request,
        ];
    }

    //Geçici klasöre yüklenen her videoyu birleştirir ve animeye onu ekler.
    public function epsiodeCreateVideoMerge(Request $request)
    {
        $anime_episode = AnimeEpisode::Where('code', $request->episode_code)->where('deleted', 0)->first();
        if (!$anime_episode) {
            response()->json(['success' => false, 'message' => 'Aşama 3 controller hata']);
        }
        $anime_episode->video = $request->path;
        $anime_episode->save();


        //Animenin bölüm ve sezon sayısını ayarlayan komut
        if (true) {
            $anime = Anime::Where('code', $anime_episode->anime_code)->first();
            $anime->episode_count = AnimeEpisode::Where('deleted', 0)->where('anime_code', $anime->code)->count();
            $anime->season_count = AnimeEpisode::Where('deleted', 0)->where('anime_code', $anime->code)->max('season_short');
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

    public function episodeCreateURLScreen()
    {
        $animes = Anime::Where('deleted', 0)->get();

        if (count($animes) <= 0) {
            return redirect()->route('admin_anime_episodes_list')->with('error', 'Herhangi bir anime mevcut değil. İlk önce anime ekleyiniz');
        }

        return view('admin.anime.episode.create_url', ['animes' => $animes]);
    }

    public function episodeCreateURL(Request $request)
    {
        $episode = new AnimeEpisode();
        $episode->code = AnimeEpisode::max('code') + 1;
        $episode->name = $request->name;
        $episode->anime_code = $request->anime_code;
        $episode->video = $request->video;
        $episode->description = $request->description;
        $episode->season_short = $request->season_short;
        $episode->episode_short = $request->episode_short;
        $episode->video_minute = $request->video_minute ? $request->video_minute : 0;
        $episode->video_second = $request->video_second ? $request->video_second : 0;
        $episode->publish_date = $request->publish_date;
        $episode->intro_start_time_min = $request->intro_start_time_min ? $request->intro_start_time_min : 0;
        $episode->intro_start_time_sec = $request->intro_start_time_sec ? $request->intro_start_time_sec : 0;
        $episode->intro_end_time_min = $request->intro_end_time_min ? $request->intro_end_time_min : 0;
        $episode->intro_end_time_sec = $request->intro_end_time_sec ? $request->intro_end_time_sec : 0;
        $episode->next_episode_time_min = $request->next_episode_time_min ? $request->next_episode_time_min : 0;
        $episode->next_episode_time_sec = $request->next_episode_time_sec ? $request->next_episode_time_sec : 0;
        $episode->is_url = $request->is_url ? $request->is_url : 1;


        $episode->show_intro_button = $request->show_intro_button ? 1 : 0;
        $episode->show_next_episode_button = $request->show_next_episode_button ? 1 : 0;

        $episode->create_user_code = Auth::guard('admin')->user()->code;

        $episode->save();

        return redirect()->route('admin_anime_episodes_list')->with('success', 'Başarılı Bir Şekilde Anime Bölümü Eklendi');
    }

    public function episodeUpdateScreen(Request $request)
    {

        $anime_episode = AnimeEpisode::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$anime_episode)
            return redirect()->back()->with("error", Config::get('error.error_codes.0080002'));

        $anime = Anime::Where('deleted', 0)->Where('code', $anime_episode->anime_code)->first();

        return view("admin.anime.episode.update", ["anime_episode" => $anime_episode, "anime" => $anime]);
    }

    public function epsiodeUpdate(Request $request)
    {
        $anime_episode = AnimeEpisode::Where('code', $request->code)->Where('deleted', 0)->first();
        $anime = Anime::Where('code', $request->anime_code)->first();

        if (!$anime_episode || !$anime)
            return redirect()->back()->with("error", Config::get('error.error_codes.0080012'));

        $anime_episode->name = $request->name;

        $anime_episode->description = $request->description;
        $anime_episode->season_short = $request->season_short;
        $anime_episode->episode_short = $request->episode_short;
        $anime_episode->publish_date = $request->publish_date;

        $anime_episode->video_minute = $request->video_minute ? $request->video_minute : 0;
        $anime_episode->video_second = $request->video_second ? $request->video_second : 0;

        $anime_episode->intro_start_time_min = $request->intro_start_time_min ? $request->intro_start_time_min : 0;
        $anime_episode->intro_start_time_sec = $request->intro_start_time_sec ? $request->intro_start_time_sec : 0;
        $anime_episode->intro_end_time_min = $request->intro_end_time_min ? $request->intro_end_time_min : 0;
        $anime_episode->intro_end_time_sec = $request->intro_end_time_sec ? $request->intro_end_time_sec : 0;

        $anime_episode->next_episode_time_min = $request->next_episode_time_min ? $request->next_episode_time_min : 0;
        $anime_episode->next_episode_time_sec = $request->next_episode_time_sec ? $request->next_episode_time_sec : 0;

        $anime_episode->show_intro_button = $request->show_intro_button ? 1 : 0;
        $anime_episode->show_next_episode_button = $request->show_next_episode_button ? 1 : 0;

        if ($anime_episode->is_url != 0) {
            $anime_episode->video = $request->video ? $request->video : $anime_episode->video;
            $anime_episode->is_url = $request->is_url ? $request->is_url : 1;
        }

        $anime_episode->update_user_code = Auth::guard('admin')->user()->code;

        $anime_episode->save();

        $anime->episode_count = AnimeEpisode::Where('deleted', 0)->where('anime_code', $anime->code)->count();
        $anime->season_count = AnimeEpisode::Where('deleted', 0)->where('anime_code', $anime->code)->max('season_short');
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

        $anime->episode_count = AnimeEpisode::Where('deleted', 0)->where('anime_code', $anime->code)->count();

        $anime->season_count = AnimeEpisode::Where('deleted', 0)->where('anime_code', $anime->code)->max('season_short');

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
