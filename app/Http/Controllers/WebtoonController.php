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
use Spatie\Glide\GlideImage;

class WebtoonController extends Controller
{
    public function webtoonList()
    {
        $currentCount = 1;
        $pageCountTest = Webtoon::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.webtoon.webtoon.list", ['pageCount' => $pageCount, 'currentCount' => $currentCount]);
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

            // Thumb oluştur
            $thumbPath = public_path('files/webtoons/webtoonImages/thumbnails');
            $thumbName = $webtoon->code . "_thumbnail." . $file->getClientOriginalExtension();

            GlideImage::create($path . '/' . $name)
                ->modify(['w' => 230, 'h' => 325, 'fit' => 'crop'])
                ->save($thumbPath . '/' . $thumbName);

            $webtoon->thumb_image = "files/webtoons/webtoonImages/thumbnails/" . $thumbName;
        } else {
            $webtoon->image = "";
            $webtoon->thumb_image = "";
        }

        $webtoon->description = $request->description;
        $webtoon->average_min = $request->average_min;
        $webtoon->date = $request->date;


        if ($request->main_category) {
            foreach ($request->main_category as $index => $item) {

                if ($index == 0) {
                    $webtoon->main_category = $item ? $item : 1;
                    $webtoon->main_category_name = $item ? Category::Where('code', $item)->first()->name : "Genel";
                }

                $content = new ContentCategory();
                $content->category_code = $item;
                $content->content_code = $webtoon->code;
                $content->content_type = 0;
                $content->is_main = 1;
                $content->save();
            }
        }


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

        ContentCategory::Where('content_code', $webtoon->code)->Where('content_type', 0)->delete();

        if ($request->main_category) {
            foreach ($request->main_category as $index => $item) {

                if ($index == 0) {
                    $webtoon->main_category = $item ? $item : 1;
                    $webtoon->main_category_name = $item ? Category::Where('code', $item)->first()->name : "Genel";
                }

                $content = new ContentCategory();
                $content->category_code = $item;
                $content->content_code = $webtoon->code;
                $content->content_type = 0;
                $content->is_main = 1;
                $content->save();
            }
        }

        $webtoon->showStatus = $request->showStatus;

        if ($request->plusEighteen) $webtoon->plusEighteen = 1;
        else $webtoon->plusEighteen = 0;

        $webtoon->update_user_code = Auth::guard('admin')->user()->code;

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
        $search = $request->search; // -1: arama yok, 0: ilk defa arama, 1: aramanın devamı, -99: Sayfalama iptal bütün veriyi getir.
        $searchData = $request->searchData ? $request->searchData : "0";
        $skip = (($request->page - 1) * $this->showCount);
        $pageCount = -1;
        if ($search == "-1") {
            $webtoons = Webtoon::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        } else if ($search == "-99") {
            $shortName = preg_replace_callback('/[ğĞüÜşŞıİöÖçÇ\s]/u', function ($match) {
                $normalizedChar = $match[0] === ' ' ? '-' : preg_replace('/[\p{Mn}]/u', '', iconv('UTF-8', 'ASCII//TRANSLIT', $match[0]));
                return strtolower($normalizedChar);
            }, $searchData);

            $shortName = strtolower($shortName);

            $webtoons = Webtoon::Where('deleted', 0)
                ->where(function ($queryBuilder) use ($searchData, $shortName) {
                    $queryBuilder->where('name', 'LIKE', '%' . $searchData . '%')
                        ->where('short_name', 'LIKE', '%' . $shortName . '%')
                        ->orWhere('description', 'LIKE', '%' . $searchData . '%')
                        ->orWhere('main_category_name', 'LIKE', '%' . $searchData . '%');
                })->get();
        } else {

            $shortName = preg_replace_callback('/[ğĞüÜşŞıİöÖçÇ\s]/u', function ($match) {
                $normalizedChar = $match[0] === ' ' ? '-' : preg_replace('/[\p{Mn}]/u', '', iconv('UTF-8', 'ASCII//TRANSLIT', $match[0]));
                return strtolower($normalizedChar);
            }, $searchData);

            $shortName = strtolower($shortName);

            $webtoons = Webtoon::Where('deleted', 0)
                ->where(function ($queryBuilder) use ($searchData, $shortName) {
                    $queryBuilder->where('name', 'LIKE', '%' . $searchData . '%')
                        ->where('short_name', 'LIKE', '%' . $shortName . '%')
                        ->orWhere('description', 'LIKE', '%' . $searchData . '%')
                        ->orWhere('main_category_name', 'LIKE', '%' . $searchData . '%');
                })
                ->skip($skip)->take($this->showCount)->get();
            if ($search == "0") {
                $pageCountTest =
                    Webtoon::Where('deleted', 0)
                    ->where(function ($queryBuilder) use ($searchData, $shortName) {
                        $queryBuilder->where('name', 'LIKE', '%' . $searchData . '%')
                            ->where('short_name', 'LIKE', '%' . $shortName . '%')
                            ->orWhere('description', 'LIKE', '%' . $searchData . '%')
                            ->orWhere('main_category_name', 'LIKE', '%' . $searchData . '%');
                    })->count();
                if ($pageCountTest % $this->showCount == 0)
                    $pageCount = $pageCountTest / $this->showCount;
                else
                    $pageCount = intval($pageCountTest / $this->showCount) + 1;
            }
        }

        return [
            'webtoons' => $webtoons,
            'pageCount' => $pageCount
        ];
    }

    public function webtoonGetSeason(Request $request)
    {
        $season = Webtoon::Where('code', $request->code)->first();
        return $season;
    }
}
