<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view("index.index");
    }

    public function list()
    {
        return view("index.list");
    }

    public function animeDetail()
    {
        return view("index.animeDetail");
    }

    public function watch()
    {
        return view("index.watch");
    }

    public function webtoonDetail()
    {
        return view("index.webtoonDetail");
    }

    public function read()
    {
        return view("index.read");
    }
}
