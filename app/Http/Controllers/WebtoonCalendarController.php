<?php

namespace App\Http\Controllers;

use App\Models\Webtoon;
use App\Models\WebtoonCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WebtoonCalendarController extends Controller
{
    public function index()
    {

        $webtoons = Webtoon::Where('deleted', 0)->get();

        $webtoon_calendars = DB::table('webtoon_calendars')
            ->join('webtoons', 'webtoons.code', '=', 'webtoon_calendars.webtoon_code')
            ->select('webtoon_calendars.*', 'webtoons.name as webtoon_name')
            ->get();

        //dd($webtoon_calendars->toArray());

        return view('admin.webtoon.calendar.calendar', ['webtoons' => $webtoons, 'webtoon_calendars' => $webtoon_calendars]);
    }

    public function addEvent(Request $request)
    {
        $webtoon_calendar = new WebtoonCalendar();

        $webtoon_calendar_code = WebtoonCalendar::orderBy('created_at', 'DESC')->first();
        if ($webtoon_calendar_code) $webtoon_calendar->code = $webtoon_calendar_code->code + 1;
        else $webtoon_calendar->code = 1;

        $webtoon_calendar->webtoon_code = $request->webtoon_code;
        $webtoon_calendar->description = $request->description;
        $webtoon_calendar->first_date = $request->first_date;
        $webtoon_calendar->cycle_type = $request->cycle_type;
        $webtoon_calendar->special_type = $request->special_type;
        $webtoon_calendar->special_count = $request->special_count;
        $webtoon_calendar->end_date = $request->end_date;
        $webtoon_calendar->background_color = $request->background_color;

        $webtoon_calendar->create_user_code = Auth::user()->code;

        $webtoon_calendar->save();

        return redirect()->route('admin_webtooncalendar_index')->with('success', 'Takvim Eklendi');
    }
}
