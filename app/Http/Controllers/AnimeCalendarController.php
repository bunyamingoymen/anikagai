<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimeCalendarController extends Controller
{
    public function index()
    {
        $title = "Anime Takvimi";
        return view('admin.anime.calendar.calendar', ['title' => $title]);
    }
}
