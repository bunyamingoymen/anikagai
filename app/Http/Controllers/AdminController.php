<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Contact;
use App\Models\FollowUser;
use App\Models\IndexUser;
use App\Models\User;
use App\Models\WatchedAnime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $cacheKey = 'total_data';

        $totalData = cache()->remember($cacheKey, now()->addMinutes(120), function () {

            $now = now();
            $year = $now->year;
            $month = $now->month;

            $startOfWeek = now()->startOfWeek(); // Haftanın başlangıcı
            $endOfWeek = now()->endOfWeek();     // Haftanın sonu

            return [
                'total_index_user' => IndexUser::count(),
                'total_watch' => WatchedAnime::where('content_type', 1)->count(),
                'total_read' => WatchedAnime::where('content_type', 0)->count(),
                'total_comment' => Comment::where('deleted', 0)->count(),
                'index_user_year' => IndexUser::whereYear('created_at', $year)->count(),
                'index_user_month' =>  IndexUser::whereYear('created_at', $year)->whereMonth('created_at', $month)->count(),
                'index_user_week' => IndexUser::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),
                'index_user_today' => IndexUser::whereDate('created_at', now()->toDateString())->count(),
                'read_in_year' => WatchedAnime::where('content_type', 0)->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))->whereYear('created_at', $year)->groupBy(DB::raw('MONTH(created_at)'))->get(),
                'watch_in_year' => WatchedAnime::where('content_type', 1)->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))->whereYear('created_at', $year)->groupBy(DB::raw('MONTH(created_at)'))->get(),
            ];
        });

        $comments = DB::table('comments')
            ->Where('comments.deleted', 0)
            ->Where('comments.user_code', 'index_users.code')
            ->join('index_users', 'index_users.code', '=', 'comments.user_code')
            ->select('comments.code as code', 'comments.message as message', 'comments.date as date', 'index_users.image as user_image', 'index_users.name as user_name', 'index_users.username as user_username')
            ->orderBy('comments.created_at', 'DESC')
            ->take(5)
            ->get();

        return view('admin.index', ['totalData' => $totalData, 'comments' => $comments]);
    }

    public function contactScreen()
    {
        return view("admin.contact.contact");
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
        return view("admin.comment.comment");
    }

    public function commentDelete(Request $request)
    {
        $comment = Comment::Where('deleted', 0)->Where('code', $request->code)->first();

        if (!$comment) return redirect()->back()->with('error', Config::get('error.error_codes.0190013'));

        $comment->deleted = 1;
        $comment->save();
        return redirect()->back()->with('success', Config::get('success.success_codes.10190013'));
    }

    public function adminCommentchangeActive(Request $request)
    {
        $comment = Comment::Where('code', $request->code)->first();

        if (!$comment) return redirect()->back()->with('error', Config::get('error.error_codes.0190013'));

        if ($comment->is_active == 1) $comment->is_active = 0;
        else $comment->is_active = 1;

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
        $take  = $request->showingCount ? $request->showingCount : Config::get('app.showCount');
        $skip = (($request->page - 1) * $take);
        $contacts = Contact::Where('deleted', 0)->skip($skip)->take($take)->get();
        $pageCount = ceil(Contact::Where('deleted', 0)->count() / $take);

        return ['contacts' => $contacts, 'pageCount' => $pageCount];
    }

    public function commentGetData(Request $request)
    {
        $take  = $request->showingCount ? $request->showingCount : Config::get('app.showCount');
        $skip = (($request->page - 1) * $take);

        $matchGorup = [];
        array_push($matchGorup, ['deleted', 0]);

        if ($request->status) array_push($matchGorup, ['is_active', $request->status == 1 ? 0  : 1]);


        if ($request->spoiler) array_push($matchGorup, ['is_spoiler', $request->spoiler == 1 ? 0  : 1]);


        if ($request->user_code) array_push($matchGorup, ['user_code', $request->user_code]);


        if ($request->comment_count) array_push($matchGorup, ['comment_type', $request->comment_count == 1 ? 0  : 1]);


        $commentQuery = Comment::where($matchGorup)
            ->when($request->searchData, function ($query, $searchData) {
                $searchQueryData = '%' . $searchData . '%';
                return $query->where('message', 'LIKE', $searchQueryData);
            })
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    if ($request->webtoon_code) {
                        $q->where('content_type', 0)
                            ->where('content_code', $request->webtoon_code);
                    }
                })
                    ->orWhere(function ($q) use ($request) {
                        if ($request->anime_code) {
                            $q->where('content_type', 1)
                                ->where('content_code', $request->anime_code);
                        }
                    });
            });

        $pageCount = ceil($commentQuery->count() / $take);
        $comments = $commentQuery->skip($skip)->take($take)->get();


        return ['comments' => $comments, 'pageCount' => $pageCount];
    }

    public function commentPinned(Request $request)
    {
        if (!Auth::guard('admin')->user())
            return redirect()->back()->with('error', Config::get('error.error_codes.0000000'));

        $comment = Comment::Where('deleted', 0)->Where('code', $request->code)->first();
        if (!$comment)
            return redirect()->back()->with('error', Config::get('error.error_codes.0020020'));

        $comment->is_pinned = $comment->is_pinned == 1 ? 0 : 1; //Tam tersini işaretliyoruz.

        $comment->save();

        return redirect()->back()->with('success', Config::get('success.success_codes.10020020'));
    }
}
