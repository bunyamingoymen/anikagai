<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\AnimeCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimeCalendarController extends Controller
{
    public function index()
    {
        $title = "Anime Takvimi";

        $animes = Anime::Where('deleted', 0)->get();

        return view('admin.anime.calendar.calendar', ['title' => $title, 'animes' => $animes]);
    }

    public function addEvent(Request $request)
    {
        $anime_calendar = new AnimeCalendar();

        $anime_calendar_code = AnimeCalendar::orderBy('created_at', 'DESC')->first();
        if ($anime_calendar_code) $anime_calendar->code = $anime_calendar_code->code + 1;
        else $anime_calendar->code = 1;

        $anime_calendar->anime_code = $request->anime_code;
        $anime_calendar->description = $request->description;
        $anime_calendar->first_date = $request->first_date;
        $anime_calendar->cycle_type = $request->cycle_type;
        $anime_calendar->special_type = $request->special_type;
        $anime_calendar->special_count = $request->special_count;

        $anime_calendar->create_user_code = Auth::user()->code;

        $anime_calendar->save();

        return redirect()->route('admin_calendar_index')->with('success', 'Takvim Eklendi');
    }
}
