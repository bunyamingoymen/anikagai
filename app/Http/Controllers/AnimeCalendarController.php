<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\AnimeCalendar;
use App\Models\AnimeCalendarList;
use Carbon\Carbon;
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
        $currentDate = Carbon::now(); // Şu anki tarih ve saat
        $twoMonthLater = $currentDate->copy()->addMonth(2);
        $currentDate = Carbon::now()->subDay();
        $anime_calendar_lists = DB::table('anime_calendar_lists')
            ->Where('anime_calendars.deleted', 0)
            ->Where('animes.deleted', 0)
            ->whereBetween('anime_calendar_lists.date', [$currentDate, $twoMonthLater])
            ->join('anime_calendars', 'anime_calendars.code', '=', 'anime_calendar_lists.anime_calendar_code')
            ->join('animes', 'animes.code', '=', 'anime_calendars.anime_code')
            ->select(
                'animes.name as anime_name',
                'animes.code as anime_code',
                'anime_calendars.code as anime_calendar_code',
                'anime_calendars.description as anime_calendar_description',
                'anime_calendars.first_date as anime_calendar_first_date',
                'anime_calendars.cycle_type as anime_calendar_cycle_type',
                'anime_calendars.special_type as anime_calendar_special_type',
                'anime_calendars.special_count as anime_calendar_special_count',
                'anime_calendars.end_date as anime_calendar_end_date',
                'anime_calendars.background_color as anime_calendar_background_color',
                'anime_calendar_lists.code as anime_calendar_lists_code',
                'anime_calendar_lists.calendar_order as anime_calendar_list_calendar_order',
                'anime_calendar_lists.date as anime_calendar_list_date'
            )
            ->get();

        return view('admin.anime.calendar.calendar', ['animes' => $animes, 'anime_calendar_lists' => $anime_calendar_lists]);
    }

    public function addEvent(Request $request)
    {
        dd($request->toArray());
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
        $calendar_order = 1;
        foreach ($request->fullDate as $date) {

            $anime_calendar_list = new AnimeCalendarList();
            $anime_calendar_list->code = AnimeCalendarList::max('code') + 1;
            $anime_calendar_list->anime_calendar_code = $anime_calendar->code;
            $anime_calendar_list->calendar_order = $calendar_order;
            $anime_calendar_list->date = $date;
            $anime_calendar_list->save();
            $calendar_order++;
        }

        return redirect()->route('admin_animecalendar_index')->with('success', Config::get('success.success_codes.10070010'));
    }

    public function changeEvent(Request $request)
    {
        $anime_calendar = AnimeCalendar::Where('code', $request->anime_calendar_code)->first();

        if (!$anime_calendar)
            return redirect()->back()->with('error', Config::get('error.error_codes.0070012'));


        $anime_calendar->code = AnimeCalendar::max('code') + 1;

        $anime_calendar->anime_code = $request->anime_code;
        $anime_calendar->description = $request->description;
        $anime_calendar->first_date = $request->first_date;
        $anime_calendar->cycle_type = $request->cycle_type;
        $anime_calendar->special_type = $request->special_type;
        $anime_calendar->special_count = $request->special_count;
        $anime_calendar->end_date = $request->end_date;

        $anime_calendar->update_user_code = Auth::guard('admin')->user()->code;

        $anime_calendar->save();

        $calendar_order = 1;
        AnimeCalendarList::Where('anime_calendar_code', $anime_calendar->code)->delete();
        foreach ($request->fullDate as $date) {

            $anime_calendar_list = new AnimeCalendarList();
            $anime_calendar_list->code = AnimeCalendarList::max('code') + 1;
            $anime_calendar_list->anime_calendar_code = $anime_calendar->code;
            $anime_calendar_list->calendar_order = $calendar_order;
            $anime_calendar_list->date = $date;
            $anime_calendar_list->save();
            $calendar_order++;
        }

        return redirect()->route('admin_animecalendar_index')->with('success', Config::get('success.success_codes.10070012'));
    }

    public function deleteEvent(Request $request)
    {
        $anime_calendar = AnimeCalendar::where('code', $request->code)->first();
        if (!$anime_calendar) return redirect()->back()->with('error', Config::get('error.error_codes.0070013'));

        $anime_calendar->deleted = 1;
        $anime_calendar->update_user_code = Auth::guard('admin')->user()->code;
        $anime_calendar->save();

        return redirect()->route('admin_animecalendar_index')->with('success', Config::get('success.success_codes.10070012'));
    }

    public function getAnimeCalendar(Request $request)
    {
        $currentDate = Carbon::now(); // Şu anki tarih ve saat
        $numberOfMonth = intval($request->showedMonth) + intval($request->changeMonth);
        $twoMonthLater = $currentDate->copy()->addMonth(intval($request->showedMonth));
        $otherMonthLater = $currentDate->copy()->addMonth($numberOfMonth);
        $anime_calendar_lists = DB::table('anime_calendar_lists')
            ->Where('anime_calendars.deleted', 0)
            ->Where('animes.deleted', 0)
            ->whereBetween('anime_calendar_lists.date', [$twoMonthLater, $otherMonthLater])
            ->join('anime_calendars', 'anime_calendars.code', '=', 'anime_calendar_lists.anime_calendar_code')
            ->join('animes', 'animes.code', '=', 'anime_calendars.anime_code')
            ->select(
                'animes.name as anime_name',
                'animes.code as anime_code',
                'anime_calendars.code as anime_calendar_code',
                'anime_calendars.description as anime_calendar_description',
                'anime_calendars.first_date as anime_calendar_first_date',
                'anime_calendars.cycle_type as anime_calendar_cycle_type',
                'anime_calendars.special_type as anime_calendar_special_type',
                'anime_calendars.special_count as anime_calendar_special_count',
                'anime_calendars.end_date as anime_calendar_end_date',
                'anime_calendars.background_color as anime_calendar_background_color',
                'anime_calendar_lists.calendar_order as anime_calendar_list_calendar_order',
                'anime_calendar_lists.date as anime_calendar_list_date'
            )
            ->get();

        return $anime_calendar_lists;
    }
}
