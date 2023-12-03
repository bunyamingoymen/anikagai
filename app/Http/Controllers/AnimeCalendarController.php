<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\AnimeCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AnimeCalendarController extends Controller
{
    public function index()
    {

        $animes = Anime::Where('deleted', 0)->get();

        //$anime_calendars = AnimeCalendar::Where('deleted', 0)->get();

        $anime_calendars = DB::table('anime_calendars')
            ->join('animes', 'animes.code', '=', 'anime_calendars.anime_code')
            ->select('anime_calendars.*', 'animes.name as anime_name')
            ->get();

        return view('admin.anime.calendar.calendar', ['animes' => $animes, 'anime_calendars' => $anime_calendars]);
    }

    public function addEvent(Request $request)
    {
        $anime_calendar = new AnimeCalendar();

        $anime_calendar->code = AnimeCalendar::max('code') + 1;

        $anime_calendar->anime_code = $request->anime_code;
        $anime_calendar->description = $request->description;
        $anime_calendar->first_date = $request->first_date;
        $anime_calendar->cycle_type = $request->cycle_type;
        $anime_calendar->special_type = $request->special_type;
        $anime_calendar->special_count = $request->special_count;
        $anime_calendar->end_date = $request->end_date;
        $anime_calendar->background_color = $request->background_color;

        $anime_calendar->create_user_code = Auth::guard('admin')->user()->code;

        $anime_calendar->save();

        return redirect()->route('admin_animecalendar_index')->with('success', Config::get('success.success_codes.10070010'));
    }
}
