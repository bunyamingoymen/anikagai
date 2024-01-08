<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ContentCategory;
use App\Models\ContentTag;
use App\Models\Tag;
use App\Models\Webtoon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class WebtoonController extends Controller
{
    public function webtoonList()
    {
        $webtoons = Webtoon::Where('deleted', 0)->take($this->showCount)->get();
        $currentCount = 1;
        $pageCountTest = Webtoon::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.webtoon.webtoon.list", ["webtoons" => $webtoons, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
    }

    public function webtoonCreateScreen()
    {
        $categories = Category::Where('deleted', 0)->get();
        $tags = Tag::Where('deleted', 0)->get();
        return view("admin.webtoon.webtoon.create", ["categories" => $categories, "tags" => $tags]);
    }

    public function webtoonCreate(Request $request)
    {
        $webtoon = new Webtoon();

        $webtoon->code = Webtoon::max('code') + 1;

        $webtoon->name = $request->name;
        $webtoon->short_name = $request->short_name;

        if ($request->hasFile('image')) {
            // Dosyayı al
            $file = $request->file('image');

            $path = public_path('files/webtoons/webtoonImages');
            $name = $webtoon->code . "." . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $webtoon->image = "files/webtoons/webtoonImages/" . $name;
        } else {
            $webtoon->image = "";
        }

        $webtoon->description = $request->description;
        $webtoon->average_min = $request->average_min;
        $webtoon->date = $request->date;

        $webtoon->main_category = $request->main_category ? $request->main_category : 1;
        $webtoon->main_category_name = $request->main_category ? Category::Where('code', $request->main_category)->first()->name : "Genel";

        $webtoon->showStatus = $request->showStatus;

        if ($request->plusEighteen) $webtoon->plusEighteen = 1;
        else $webtoon->plusEighteen = 0;

        $webtoon->create_user_code = Auth::guard('admin')->user()->code;

        $webtoon->save();

        if ($request->category) {
            foreach ($request->category as $item) {
                $content = new ContentCategory();
                $content->category_code = $item;
                $content->content_code = $webtoon->code;
                $content->content_type = 0;
                $content->save();
            }
        }

        if ($request->tag) {
            foreach ($request->tag as $item) {
                $content = new ContentTag();
                $content->tag_code = $item;
                $content->content_code = $webtoon->code;
                $content->content_type = 0;
                $content->save();
            }
        }

        return redirect()->route('admin_webtoon_list')->with("success", Config::get('success.success_codes.10090010'));
    }

    public function webtoonUpdateScreen(Request $request)
    {

        $webtoon = Webtoon::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$webtoon)
            return redirect()->back()->with("error", Config::get('error.error_codes.0090002'));

        $categories = Category::Where('deleted', 0)->get();
        $selectedCategories = ContentCategory::Where('content_code', $webtoon->code)->Where('content_type', 0)->get();

        $tags = Tag::Where('deleted', 0)->get();
        $selectedTags = ContentTag::Where('content_code', $webtoon->code)->Where('content_type', 0)->get();

        return view("admin.webtoon.webtoon.update", ["webtoon" => $webtoon, "categories" => $categories, "tags" => $tags, "selectedCategories" => $selectedCategories, "selectedTags" => $selectedTags]);
    }

    public function webtoonUpdate(Request $request)
    {
        $webtoon = Webtoon::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$webtoon)
            return redirect()->back()->with("error", Config::get('error.error_codes.0090012'));

        $webtoon->name = $request->name;
        $webtoon->short_name = $request->short_name;

        if ($request->hasFile('image')) {
            // Dosyayı al
            $file = $request->file('image');

            $path = public_path('files/webtoons/webtoonImages');
            $name = $webtoon->code . "" . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $webtoon->image = "files/webtoons/webtoonImages/" . $name;
        }

        $webtoon->description = $request->description;
        $webtoon->average_min = $request->average_min;
        $webtoon->date = $request->date;

        $webtoon->main_category = $request->main_category ? $request->main_category : 1;
        $webtoon->main_category_name = $request->main_category ? Category::Where('code', $request->main_category)->first()->name : "Genel";

        $webtoon->showStatus = $request->showStatus;

        if ($request->plusEighteen) $webtoon->plusEighteen = 1;
        else $webtoon->plusEighteen = 0;

        $webtoon->update_user_code = Auth::guard('admin')->user()->code;

        $webtoon->save();

        ContentCategory::Where('content_code', $webtoon->code)->Where('content_type', 0)->delete();
        if ($request->category) {
            foreach ($request->category as $item) {
                $content = new ContentCategory();
                $content->category_code = $item;
                $content->content_code = $webtoon->code;
                $content->content_type = 0;
                $content->save();
            }
        }

        ContentTag::Where('content_code', $webtoon->code)->Where('content_type', 0)->delete();
        if ($request->tag) {
            foreach ($request->tag as $item) {
                $content = new ContentTag();
                $content->tag_code = $item;
                $content->content_code = $webtoon->code;
                $content->content_type = 0;
                $content->save();
            }
        }

        return redirect()->route('admin_webtoon_list')->with("success", Config::get('success.success_codes.10090012'));
    }

    public function webtoonDelete(Request $request)
    {
        $webtoon = Webtoon::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$webtoon)
            return redirect()->back()->with("error", Config::get('error.error_codes.0090013'));

        $webtoon->deleted = 1;
        $webtoon->update_user_code = Auth::guard('admin')->user()->code;
        $webtoon->save();
        return redirect()->route('admin_webtoon_list')->with("success", Config::get('success.success_codes.10090013'));
    }

    public function webtoonGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $webtoons = Webtoon::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $webtoons;
    }

    public function webtoonGetSeason(Request $request)
    {
        $season = Webtoon::Where('code', $request->code)->first();

        return $season;
    }
}
