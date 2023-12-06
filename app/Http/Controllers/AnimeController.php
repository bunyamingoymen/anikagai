<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Category;
use App\Models\ContentCategory;
use App\Models\ContentTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AnimeController extends Controller
{
    public function animeList()
    {
        $animes = Anime::Where('deleted', 0)->take(10)->get();
        $currentCount = 1;
        $pageCountTest = Anime::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.anime.anime.list", ["animes" => $animes, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
    }

    public function animeCreateScreen()
    {
        $categories = Category::Where('deleted', 0)->get();
        $tags = Tag::Where('deleted', 0)->get();
        return view("admin.anime.anime.create", ['categories' => $categories, 'tags' => $tags]);
    }

    public function animeCreate(Request $request)
    {
        $anime = new Anime();

        $anime->code = Anime::max('code') + 1;

        $anime->name = $request->name;

        $anime->short_name = $request->short_name;

        if ($request->hasFile('image')) {
            // Dosyayı al
            $file = $request->file('image');

            $path = public_path('files/animes/animesImages');
            $name = $anime->code . "." . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $anime->image = "files/animes/animesImages/" . $name;
        } else {
            $anime->image = "";
        }

        $anime->description = $request->description;
        $anime->average_min = $request->average_min;
        $anime->date = $request->date;

        $anime->main_category = $request->main_category ? $request->main_category : 1;
        $anime->main_category_name = $request->main_category ? Category::Where('code', $request->main_category)->first()->name : "Genel";

        $anime->showStatus = $request->showStatus;

        if ($request->plusEighteen) $anime->plusEighteen = 1;
        else $anime->plusEighteen = 0;

        $anime->create_user_code = Auth::guard('admin')->user()->code;

        $anime->save();
        if ($request->category) {
            foreach ($request->category as $item) {
                $content = new ContentCategory();
                $content->category_code = $item;
                $content->content_code = $anime->code;
                $content->content_type = 1;
                $content->save();
            }
        }
        if ($request->tag) {
            foreach ($request->tag as $item) {
                $content = new ContentTag();
                $content->tag_code = $item;
                $content->content_code = $anime->code;
                $content->content_type = 1;
                $content->save();
            }
        }

        return redirect()->route('admin_anime_list')->with("success", Config::get('success.success_codes.10060010'));
    }

    public function animeUpdateScreen(Request $request)
    {

        $anime = Anime::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$anime)
            return redirect()->back()->with("error", Config::get('error.error_codes.0060002'));

        $categories = Category::Where('deleted', 0)->get();
        $selectedCategories = ContentCategory::Where('content_code', $anime->code)->Where('content_type', 1)->get();

        $tags = Tag::Where('deleted', 0)->get();
        $selectedTags = ContentTag::Where('content_code', $anime->code)->Where('content_type', 1)->get();

        return view("admin.anime.anime.update", ["anime" => $anime, 'categories' => $categories, 'tags' => $tags, 'selectedCategories' => $selectedCategories, 'selectedTags' => $selectedTags]);
    }

    public function animeUpdate(Request $request)
    {
        $anime = Anime::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$anime)
            return redirect()->back()->with("error", Config::get('error.error_codes.0060012'));

        $anime->name = $request->name;

        $anime->short_name = $request->short_name;

        if ($request->hasFile('image')) {
            // Dosyayı al
            $file = $request->file('image');

            $path = public_path('files/animes/animesImages');
            $name = $anime->code . "" . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $anime->image = "files/animes/animesImages/" . $name;
        }

        $anime->description = $request->description;
        $anime->average_min = $request->average_min;
        $anime->date = $request->date;

        $anime->main_category = $request->main_category ? $request->main_category : 1;
        $anime->main_category_name = $request->main_category ? Category::Where('code', $request->main_category)->first()->name : "Genel";

        $anime->showStatus = $request->showStatus;

        if ($request->plusEighteen) $anime->plusEighteen = 1;
        else $anime->plusEighteen = 0;


        $anime->update_user_code = Auth::guard('admin')->user()->code;

        $anime->save();

        ContentCategory::Where('content_code', $anime->code)->Where('content_type', 1)->delete();
        if ($request->category) {
            foreach ($request->category as $item) {
                $content = new ContentCategory();
                $content->category_code = $item;
                $content->content_code = $anime->code;
                $content->content_type = 1;
                $content->save();
            }
        }


        ContentTag::Where('content_code', $anime->code)->Where('content_type', 1)->delete();
        if ($request->tag) {
            foreach ($request->tag as $item) {
                $content = new ContentTag();
                $content->tag_code = $item;
                $content->content_code = $anime->code;
                $content->content_type = 1;
                $content->save();
            }
        }


        return redirect()->route('admin_anime_list')->with("success", Config::get('success.success_codes.10060012'));
    }

    public function animeDelete(Request $request)
    {
        $anime = Anime::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$anime)
            return redirect()->back()->with("error", Config::get('error.error_codes.0060013'));

        $anime->deleted = 1;
        $anime->update_user_code = Auth::guard('admin')->user()->code;
        $anime->save();
        return redirect()->route('admin_anime_list')->with("success", Config::get('success.success_codes.10060013'));
    }

    public function animeGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $animes = Anime::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $animes;
    }

    public function animeGetSeason(Request $request)
    {
        $season = Anime::Where('code', $request->code)->first();

        return $season;
    }
}
