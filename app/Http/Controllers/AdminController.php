<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Contact;
use App\Models\FollowUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function contactScreen()
    {
        $contacts = Contact::Where('deleted', 0)->take(10)->get();
        $currentCount = 1;
        $pageCountTest = Contact::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.contact.contact", ["contacts" => $contacts, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
    }

    public function contactAnswer(Request $request)
    {
        $contact = Contact::Where('deleted', 0)->Where('code', $request->code)->first();

        if (!$contact) return redirect()->back()->with('error', Config::get('error.error_codes.0180013'));

        $contact->answered = $request->answered;
        $contact->save();
        return redirect()->back()->with('success', Config::get('success.success_codes.10180012'));
    }

    public function contactDelete(Request $request)
    {
        $contact = Contact::Where('deleted', 0)->Where('code', $request->code)->first();

        if (!$contact) return redirect()->back()->with('error', Config::get('error.error_codes.0180013'));

        $contact->deleted = 1;
        $contact->save();
        return redirect()->back()->with('success', Config::get('success.success_codes.10180013'));
    }

    public function commentScreen()
    {
        $comments = Comment::Where('deleted', 0)->take(10)->get();
        $currentCount = 1;
        $pageCountTest = Comment::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.comment.comment", ["comments" => $comments, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
    }

    public function commentDelete(Request $request)
    {
        $comment = Comment::Where('deleted', 0)->Where('code', $request->code)->first();

        if (!$comment) return redirect()->back()->with('error', Config::get('error.error_codes.0190013'));

        $comment->deleted = 1;
        $comment->save();
        return redirect()->back()->with('success', Config::get('success.success_codes.10190013'));
    }

    public function profile(Request $request)
    {
        $followed = 0;

        if ($request->has('code')) {
            $user = User::Where('code', $request->code)->first();
            $follow = FollowUser::Where('followed_user_code', $request->code)->Where('user_code', Auth::guard('admin')->user()->code)->first();
            if ($follow) $followed = 1;
        } else {
            $user = Auth::guard('admin')->user();
        }

        $followed_users = DB::table('follow_users')
            ->Where('follow_users.user_code', $user->code)
            ->join('users', 'users.code', '=', 'follow_users.followed_user_code')
            ->select('users.code as user_code', 'users.name as user_name', 'users.surname as user_surname', 'users.image as user_image', 'users.description as user_description')
            ->get();

        $anime_episodes = DB::table('anime_episodes')
            ->where('anime_episodes.deleted', 0)
            ->where('anime_episodes.create_user_code')
            ->join('animes', 'animes.code', '=', 'anime_episodes.anime_code')
            ->select('anime_episodes.*', 'animes.name as anime_name', 'animes.image as anime_image')
            ->get();

        $webtoon_episodes = DB::table('webtoon_episodes')
            ->where('webtoon_episodes.deleted', 0)
            ->where('webtoon_episodes.create_user_code')
            ->join('webtoons', 'webtoons.code', '=', 'webtoon_episodes.webtoon_code')
            ->select('webtoon_episodes.*', 'webtoons.name as webtoon_name', 'webtoons.image as webtoon_image')
            ->get();

        return view('admin.users.profile', ['user' => $user, 'followed' => $followed, 'followed_users' => $followed_users, 'anime_episodes' => $anime_episodes, 'webtoon_episodes' => $webtoon_episodes]);
    }

    public function loginScreen()
    {
        return view('admin.register.login');
    }

    public function login(Request $request)
    {

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::guard('admin')->user()->deleted == 0 && Auth::guard('admin')->user()->admin == 1)
                return redirect()->route('admin_index')->with("success", Config::get('success.success_codes.10020011'));
            else Auth::guard('admin')->logout();
            return redirect()->route('admin_login_screen')->with('error', Config::get('error.error_codes.0000000'));
        }
        return redirect()->route('admin_login_screen')->with("error", Config::get('error.error_codes.0020011'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login_screen')->with("success", "Çıkış Başarılı");
    }

    public function contactGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $contacts = Contact::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $contacts;
    }

    public function commentGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $comments = Comment::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $comments;
    }
}
