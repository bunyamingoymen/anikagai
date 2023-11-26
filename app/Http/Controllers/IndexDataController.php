<?php

namespace App\Http\Controllers;

use App\Models\FavoriteAnime;
use App\Models\FavoriteWebtoon;
use App\Models\FollowAnime;
use App\Models\FollowWebtoon;
use Illuminate\Http\Request;

class IndexDataController extends Controller
{
    public function followAnime(Request $request)
    {

        $follow = new FollowAnime();
        $follow->user_code = $request->user_code;
        $follow->anime_code = $request->anime_code;
        $follow->save();

        return redirect()->back();
    }

    public function followWebtoon(Request $request)
    {
        $follow = new FollowWebtoon();
        $follow->user_code = $request->user_code;
        $follow->webtoon_code = $request->webtoon_code;
        $follow->save();

        return redirect()->back();
    }

    public function followUser(Request $request)
    {
        $follow = new FollowAnime();
        $follow->followed_user_code = $request->followed_user_code;
        $follow->user_code = $request->user_code;
        $follow->save();

        return redirect()->back();
    }

    public function unfollowAnime(Request $request)
    {
        FollowAnime::Where('user_code', $request->user_code)->Where('anime_code', $request->anime_code)->delete();
        return redirect()->back();
    }

    public function unfollowWebtoon(Request $request)
    {
        FollowWebtoon::Where('user_code', $request->user_code)->Where('webtoon_code', $request->webtoon_code)->delete();
        return redirect()->back();
    }

    public function unfollowUser(Request $request)
    {
        FollowAnime::Where('followed_user_code', $request->followed_user_code)->Where('user_code', $request->user_code)->delete();
        return redirect()->back();
    }

    public function likeAnime(Request $request)
    {
        $follow = new FavoriteAnime();
        $follow->user_code = $request->user_code;
        $follow->anime_code = $request->anime_code;
        $follow->save();

        return redirect()->back();
    }

    public function likeWebtoon(Request $request)
    {
        $follow = new FavoriteWebtoon();
        $follow->user_code = $request->user_code;
        $follow->webtoon_code = $request->webtoon_code;
        $follow->save();

        return redirect()->back();
    }

    public function unlikeAnime(Request $request)
    {
        FavoriteAnime::Where('user_code', $request->user_code)->Where('anime_code', $request->anime_code)->delete();
        return redirect()->back();
    }

    public function unlikeWebtoon(Request $request)
    {
        FavoriteWebtoon::Where('user_code', $request->user_code)->Where('webtoon_code', $request->webtoon_code)->delete();
        return redirect()->back();
    }
}
