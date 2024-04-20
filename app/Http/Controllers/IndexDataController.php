<?php

namespace App\Http\Controllers;

use App\Models\FavoriteAnime;
use App\Models\FavoriteWebtoon;
use App\Models\FollowAnime;
use App\Models\FollowIndexUser;
use App\Models\FollowUser;
use App\Models\FollowWebtoon;
use App\Models\LikeContentUser;
use App\Models\ScoredContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexDataController extends Controller
{
    public function followAnime(Request $request)
    {
        $followed = new FollowAnime();
        $followed->user_code = $request->user_code;
        $followed->anime_code = $request->anime_code;
        $followed->save();

        return redirect()->back();
    }

    public function followWebtoon(Request $request)
    {

        $followed = new FollowWebtoon();
        $followed->user_code = $request->user_code;
        $followed->webtoon_code = $request->webtoon_code;
        $followed->save();

        return redirect()->back();
    }

    public function followUser(Request $request)
    {
        $followed = new FollowIndexUser();
        $followed->followed_user_code = $request->followed_user_code;
        $followed->user_code = $request->user_code;
        $followed->save();

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


    public function likeAnime(Request $request)
    {

        $favorite = new FavoriteAnime();
        $favorite->anime_code = $request->anime_code;
        $favorite->user_code = $request->user_code;
        $favorite->save();

        return redirect()->back();
    }

    public function likeWebtoon(Request $request)
    {

        $favorite = new FavoriteWebtoon();
        $favorite->webtoon_code = $request->webtoon_code;
        $favorite->user_code = $request->user_code;
        $favorite->save();

        return redirect()->back();
    }

    public function unlikeAnime(Request $request)
    {
        FavoriteAnime::Where('anime_code', $request->anime_code)->where('user_code', $request->user_code)->delete();

        return redirect()->back();
    }

    public function unlikeWebtoon(Request $request)
    {

        FavoriteWebtoon::Where('webtoon_code', $request->webtoon_code)->where('user_code', $request->user_code)->delete();

        return redirect()->back();
    }

    public function scoreUser(Request $request)
    {
        if (Auth::check()) {
            $score = ScoredContent::Where("user_code", $request->user_code)->Where("content_code", $request->content_code)->Where("content_type", $request->content_type)->first();
            if (!$score) $score = new ScoredContent();

            $score->score = $request->score;
            $score->user_code = $request->user_code;
            $score->content_code = $request->content_code;
            $score->content_type = $request->content_type;
            $score->save();

            $score_avg = ScoredContent::where('content_code', $request->content_code)
                ->where('content_type', $request->content_type)
                ->avg('score');

            if ($score_avg !== null) {
                $tableName = $request->content_type == 0 ? 'webtoons' : 'animes';

                DB::table($tableName)
                    ->where('code', $request->content_code)
                    ->update([
                        'score' => $score_avg,
                        'scoreUsers' => ScoredContent::where('content_code', $request->content_code)
                            ->where('content_type', $request->content_type)->count(),
                    ]);

                return redirect()->back();
            }

            return redirect()->back()->with('error', 'Hesaplama hatası oluştu.');
        } else {
            return redirect()->back()->with('error', 'İlk Önce Giriş Yapmalısınız.');
        }
    }

    public function followIndexUser(Request $request)
    {
        if (!Auth::user())
            return redirect()->back()->with("error", "Lütfen ilk önce giriş yapınız.");
        $follow_user = new FollowIndexUser();
        $follow_user->followed_user_code = $request->followed_user_code;
        $follow_user->user_code = Auth::user()->code;
        $follow_user->save();

        return redirect()->back();
    }

    public function unfollowIndexUser(Request $request)
    {
        if (!Auth::user())
            return redirect()->back()->with("error", "Lütfen ilk önce giriş yapınız.");
        FollowIndexUser::where('followed_user_code', $request->followed_user_code)
            ->where('user_code', Auth::user()->code)
            ->delete();

        return redirect()->back();
    }

    public function likeComment(Request $request)
    {
        if (!Auth::user())
            return redirect()->back()->with('error', 'Lütfen İlk Önce Giriş Yapınız');

        $like = LikeContentUser::Where('content_code', $request->content_code)
            ->Where('content_episode_code', $request->content_episode_code)
            ->Where('content_type', $request->content_type)
            ->Where('comment_code', $request->comment_code)
            ->Where('user_code', Auth::user()->code)
            ->first();

        if (!$like) {
            $like = new LikeContentUser();
            $like->content_code = $request->content_code;
            $like->content_episode_code = $request->content_code;
            $like->content_type = $request->content_type;
            $like->comment_code = $request->content_code;
            $like->user_code = Auth::user()->code;
        }
        $like->like_type = $request->like_type;
        $like->save();

        return redirect()->back();
    }

    public function likeRecallComment(Request $request)
    {
        if (!Auth::user())
            return redirect()->back()->with('error', 'Lütfen İlk Önce Giriş Yapınız');

        $like = LikeContentUser::Where('content_code', $request->content_code)
            ->Where('content_episode_code', $request->content_episode_code)
            ->Where('content_type', $request->content_type)
            ->Where('comment_code', $request->comment_code)
            ->Where('user_code', Auth::user()->code)
            ->first();

        if (!$like) {
            return redirect()->back()->with('error', 'Bir Hata Meydana Geldi');
        }

        $like->delete();

        return redirect()->back();
    }
}
