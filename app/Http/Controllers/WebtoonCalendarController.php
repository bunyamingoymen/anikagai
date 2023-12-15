<?php

namespace App\Http\Controllers;

use App\Models\Webtoon;
use App\Models\WebtoonCalendar;
use App\Models\WebtoonCalendarList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class WebtoonCalendarController extends Controller
{
    public function index()
    {

        $webtoons = Webtoon::Where('deleted', 0)->get();

        $currentDate = Carbon::now(); // Şu anki tarih ve saat
        $twoMonthLater = $currentDate->copy()->addMonth(2);
        $currentDate = Carbon::now()->subDay();
        $webtoon_calendar_lists = DB::table('webtoon_calendar_lists')
            ->Where('webtoon_calendars.deleted', 0)
            ->Where('webtoons.deleted', 0)
            ->whereBetween('webtoon_calendar_lists.date', [$currentDate, $twoMonthLater])
            ->join('webtoon_calendars', 'webtoon_calendars.code', '=', 'webtoon_calendar_lists.webtoons_calendar_code')
            ->join('webtoons', 'webtoons.code', '=', 'webtoon_calendars.webtoons_code')
            ->select(
                'webtoons.name as webtoon_name',
                'webtoons.code as webtoons_code',
                'webtoons_calendars.code as webtoons_calendar_code',
                'webtoons_calendars.description as webtoons_calendar_description',
                'webtoons_calendars.first_date as webtoons_calendar_first_date',
                'webtoons_calendars.cycle_type as webtoons_calendar_cycle_type',
                'webtoons_calendars.special_type as webtoons_calendar_special_type',
                'webtoons_calendars.special_count as webtoons_calendar_special_count',
                'webtoons_calendars.end_date as webtoons_calendar_end_date',
                'webtoons_calendars.background_color as webtoons_calendar_background_color',
                'webtoons_calendar_lists.code as webtoons_calendar_lists_code',
                'webtoons_calendar_lists.calendar_order as webtoons_calendar_list_calendar_order',
                'webtoons_calendar_lists.date as webtoons_calendar_list_date'
            )
            ->get();

        return view('admin.webtoon.calendar.calendar', ['webtoons' => $webtoons, 'webtoon_calendar_lists' => $webtoon_calendar_lists]);
    }

    public function addEvent(Request $request)
    {
        $webtoon_calendar = new WebtoonCalendar();

        $webtoon_calendar->code = WebtoonCalendar::max('code') + 1;

        $webtoon_calendar->webtoon_code = $request->webtoon_code;
        $webtoon_calendar->description = $request->description;
        $webtoon_calendar->first_date = $request->first_date;
        $webtoon_calendar->cycle_type = $request->cycle_type;
        $webtoon_calendar->special_type = $request->special_type;
        $webtoon_calendar->special_count = $request->special_count;
        $webtoon_calendar->end_date = $request->end_date;
        $webtoon_calendar->background_color = $request->background_color;

        $webtoon_calendar->create_user_code = Auth::guard('admin')->user()->code;

        $webtoon_calendar->save();

        $calendar_order = 1;
        foreach ($request->fullDate as $date) {

            $webtoon_calendar_list = new WebtoonCalendarList();
            $webtoon_calendar_list->code = WebtoonCalendarList::max('code') + 1;
            $webtoon_calendar_list->webtoon_calendar_code = $webtoon_calendar->code;
            $webtoon_calendar_list->calendar_order = $calendar_order;
            $webtoon_calendar_list->date = $date;
            $webtoon_calendar_list->save();
            $calendar_order++;
        }

        return redirect()->route('admin_webtooncalendar_index')->with('success', Config::get('success.success_codes.10100010'));
    }

    public function changeEvent(Request $request)
    {
        $webtoon_calendar = WebtoonCalendar::Where('code', $request->webtoon_calendar_code)->first();

        if (!$webtoon_calendar)
            return redirect()->back()->with('error', Config::get('error.error_codes.0100012'));

        $webtoon_calendar->webtoon_code = $request->webtoon_code;
        $webtoon_calendar->description = $request->description;
        $webtoon_calendar->first_date = $request->first_date;
        $webtoon_calendar->cycle_type = $request->cycle_type;
        $webtoon_calendar->special_type = $request->special_type;
        $webtoon_calendar->special_count = $request->special_count;
        $webtoon_calendar->end_date = $request->end_date;

        $webtoon_calendar->update_user_code = Auth::guard('admin')->user()->code;

        $webtoon_calendar->save();

        $calendar_order = 1;
        WebtoonCalendarList::Where('webtoon_calendar_code', $webtoon_calendar->code)->delete();

        foreach ($request->fullDate as $date) {

            $webtoon_calendar_list = new WebtoonCalendarList();
            $webtoon_calendar_list->code = WebtoonCalendarList::max('code') + 1;
            $webtoon_calendar_list->anime_calendar_code = $webtoon_calendar->code;
            $webtoon_calendar_list->calendar_order = $calendar_order;
            $webtoon_calendar_list->date = $date;
            $webtoon_calendar_list->save();
            $calendar_order++;
        }

        return redirect()->route('admin_animecalendar_index')->with('success', Config::get('success.success_codes.10100012'));
    }

    public function deleteEvent(Request $request)
    {
        $webtoon_calendar = WebtoonCalendar::where('code', $request->code)->first();
        if (!$webtoon_calendar) return redirect()->back()->with('error', Config::get('error.error_codes.0100013'));

        $webtoon_calendar->deleted = 1;
        $webtoon_calendar->update_user_code = Auth::guard('admin')->user()->code;
        $webtoon_calendar->save();

        return redirect()->route('admin_animecalendar_index')->with('success', Config::get('success.success_codes.10100013'));
    }

    public function getWebtoonCalendar(Request $request)
    {
        $currentDate = Carbon::now(); // Şu anki tarih ve saat
        $numberOfMonth = intval($request->showedMonth) + intval($request->changeMonth);
        $twoMonthLater = $currentDate->copy()->addMonth(intval($request->showedMonth));
        $otherMonthLater = $currentDate->copy()->addMonth($numberOfMonth);
        $webtoonn_calendar_lists = DB::table('webtoon_calendar_lists')
            ->Where('webtoon_calendars.deleted', 0)
            ->Where('webtoons.deleted', 0)
            ->whereBetween('webtoon_calendar_lists.date', [$twoMonthLater, $otherMonthLater])
            ->join('webtoon_calendars', 'webtoon_calendars.code', '=', 'webtoon_calendar_lists.webtoon_calendar_code')
            ->join('webtoons', 'webtoons.code', '=', 'webtoon_calendars.webtoon_code')
            ->select(
                'webtoon.name as webtoon_name',
                'webtoon.code as webtoon_code',
                'webtoon_calendars.code as webtoon_calendar_code',
                'webtoon_calendars.description as webtoon_calendar_description',
                'webtoon_calendars.first_date as webtoon_calendar_first_date',
                'webtoon_calendars.cycle_type as webtoon_calendar_cycle_type',
                'webtoon_calendars.special_type as webtoon_calendar_special_type',
                'webtoon_calendars.special_count as webtoon_calendar_special_count',
                'webtoon_calendars.end_date as webtoon_calendar_end_date',
                'webtoon_calendars.background_color as webtoon_calendar_background_color',
                'webtoon_calendar_lists.calendar_order as webtoon_calendar_list_calendar_order',
                'webtoon_calendar_lists.date as webtoon_calendar_list_date'
            )
            ->get();

        return $webtoonn_calendar_lists;
    }
}
