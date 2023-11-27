<?php

namespace App\Http\Controllers;

use App\Models\FavoriteAnime;
use App\Models\FavoriteWebtoon;
use App\Models\FollowAnime;
use App\Models\FollowWebtoon;
use App\Models\ScoredContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexDataController extends Controller
{
    public function followAnime(Request $request)
    {
        FollowAnime::create([
            'user_code' => $request->user_code,
            'anime_code' => $request->anime_code,
        ]);

        return redirect()->back();
    }

    public function followWebtoon(Request $request)
    {
        FollowWebtoon::create([
            'user_code' => $request->user_code,
            'webtoon_code' => $request->webtoon_code,
        ]);

        return redirect()->back();
    }

    public function followUser(Request $request)
    {
        FollowAnime::create([
            'followed_user_code' => $request->followed_user_code,
            'user_code' => $request->user_code,
        ]);

        return redirect()->back();
    }

    public function unfollowAnime(Request $request)
    {
        FollowAnime::where('user_code', $request->user_code)
            ->where('anime_code', $request->anime_code)
            ->delete();

        return redirect()->back();
    }

    public function unfollowWebtoon(Request $request)
    {
        FollowWebtoon::where('user_code', $request->user_code)
            ->where('webtoon_code', $request->webtoon_code)
            ->delete();

        return redirect()->back();
    }

    public function unfollowUser(Request $request)
    {
        FollowAnime::where('followed_user_code', $request->followed_user_code)
            ->where('user_code', $request->user_code)
            ->delete();

        return redirect()->back();
    }

    public function likeAnime(Request $request)
    {
        FavoriteAnime::create([
            'user_code' => $request->user_code,
            'anime_code' => $request->anime_code,
        ]);

        return redirect()->back();
    }

    public function likeWebtoon(Request $request)
    {
        FavoriteWebtoon::create([
            'user_code' => $request->user_code,
            'webtoon_code' => $request->webtoon_code,
        ]);

        return redirect()->back();
    }

    public function unlikeAnime(Request $request)
    {
        FavoriteAnime::where('user_code', $request->user_code)
            ->where('anime_code', $request->anime_code)
            ->delete();

        return redirect()->back();
    }

    public function unlikeWebtoon(Request $request)
    {
        FavoriteWebtoon::where('user_code', $request->user_code)
            ->where('webtoon_code', $request->webtoon_code)
            ->delete();

        return redirect()->back();
    }

    public function scoreUser(Request $request)
    {
        if (Auth::check()) {
            ScoredContent::updateOrCreate(
                [
                    'user_code' => $request->user_code,
                    'content_code' => $request->content_code,
                    'content_type' => $request->content_type,
                ],
                ['score' => $request->score]
            );

            $score_avg = ScoredContent::where('content_code', $request->content_code)
                ->where('content_type', $request->content_type)
                ->avg('score');

            if ($score_avg !== null) {
                $tableName = $request->content_type == 0 ? 'webtoons' : 'animes';

                DB::table($tableName)
                    ->where('code', $request->content_code)
                    ->update([
                        'score' => $score_avg,
                        'scoreUsers' => DB::raw('scoreUsers + 1'),
                    ]);

                return redirect()->back();
            }

            return redirect()->back()->with('error', 'Hesaplama hatası oluştu.');
        } else {
            return redirect()->back()->with('error', 'İlk Önce Giriş Yapmalısınız.');
        }
    }
}
