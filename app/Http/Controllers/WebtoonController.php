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
        return view("admin.webtoon.webtoon.list");
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
                ->modify(['w' => 345, 'h' => 487, 'fit' => 'crop'])
                ->save($thumbPath . '/' . $thumbName);

            $webtoon->thumb_image = "files/webtoons/webtoonImages/thumbnails/" . $thumbName;

            $thumbName2 = $webtoon->code . "_thumbnail_2." . $file->getClientOriginalExtension();

            GlideImage::create($path . '/' . $name)
                ->modify(['w' => 135, 'h' => 195, 'fit' => 'crop'])
                ->save($thumbPath . '/' . $thumbName2);

            $webtoon->thumb_image_2 = "files/webtoons/webtoonImages/thumbnails/" . $thumbName2;
        } else {
            $webtoon->image = "";
            $webtoon->thumb_image = "";
        }

        if ($request->hasFile('poster')) {
            $filePoster = $request->file('poster');
            $pathPoster = public_path('files/webtoons/webtoonsImages/poster');
            $namePoster = $webtoon->code . '_poster' . "." . $filePoster->getClientOriginalExtension();
            $filePoster->move($pathPoster, $namePoster);

            $thumbPathPoster = public_path('files/webtoons/webtoonsImages/poster/thumbnails');
            $thumbNamePoster = $webtoon->code . '_poster' . "_thumbnail." . $filePoster->getClientOriginalExtension();

            GlideImage::create($pathPoster . '/' . $namePoster)
                ->modify(['w' => 1920, 'h' => 1080, 'fit' => 'crop'])
                ->save($thumbPathPoster . '/' . $thumbNamePoster);

            $webtoon->thumb_poster = "files/webtoons/webtoonsImages/poster/thumbnails/" . $thumbNamePoster;
            $webtoon->poster = "files/webtoons/webtoonsImages/poster/" . $namePoster;
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

        $this->sitemapGenerator();

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

            // Thumb oluştur
            $thumbPath = public_path('files/webtoons/webtoonImages/thumbnails');
            $thumbName = $webtoon->code . "_thumbnail." . $file->getClientOriginalExtension();

            GlideImage::create($path . '/' . $name)
                ->modify(['w' => 345, 'h' => 487, 'fit' => 'crop'])
                ->save($thumbPath . '/' . $thumbName);

            $webtoon->thumb_image = "files/webtoons/webtoonImages/thumbnails/" . $thumbName;

            $thumbName2 = $webtoon->code . "_thumbnail_2." . $file->getClientOriginalExtension();

            GlideImage::create($path . '/' . $name)
                ->modify(['w' => 135, 'h' => 195, 'fit' => 'crop'])
                ->save($thumbPath . '/' . $thumbName2);

            $webtoon->thumb_image_2 = "files/webtoons/webtoonImages/thumbnails/" . $thumbName2;
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

        $this->sitemapGenerator();

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

        $this->sitemapGenerator();

        return redirect()->route('admin_webtoon_list')->with("success", Config::get('success.success_codes.10090013'));
    }

    public function webtoonGetData(Request $request)
    {
        $take  = $request->showingCount ? $request->showingCount : Config::get('app.showCount');
        $skip = (($request->page - 1) * $take);

        $webtoonsQuery = Webtoon::where('deleted', 0)
            ->when($request->searchData, function ($query, $searchData) {
                // Arama terimi için özel karakter dönüşümü
                $shortName =  $this->makeShortName($searchData);

                $searchQueryData = '%' . $searchData . '%';
                $shortNameData = '%' . $shortName . '%';

                return $query->where(function ($query) use ($searchQueryData, $shortNameData) {
                    $query->where('name', 'LIKE', $searchQueryData)
                        ->orWhere('description', 'LIKE', $searchQueryData)
                        ->orWhere('main_category_name', 'LIKE', $searchQueryData)
                        ->orWhere('short_name', 'LIKE', $shortNameData);
                });
            });
        $page_count = ceil($webtoonsQuery->count() / $take);
        $webtoons = $webtoonsQuery->skip($skip)->take($take)->get();



        return [
            'webtoons' => $webtoons,
            'page_count' => $page_count,
            'count' => $webtoonsQuery,
        ];
    }

    public function webtoonGetSeason(Request $request)
    {
        $season = Webtoon::Where('code', $request->code)->first();
        return $season;
    }
}
