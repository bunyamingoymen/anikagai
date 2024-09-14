<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Category;
use App\Models\ContentCategory;
use App\Models\ContentTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Spatie\Glide\GlideImage;

class AnimeController extends Controller
{
    public function animeList()
    {
        return view("admin.anime.anime.list");
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

            // Thumb oluştur
            $thumbPath = public_path('files/animes/animesImages/thumbnails');
            $thumbName = $anime->code . "_thumbnail." . $file->getClientOriginalExtension();

            GlideImage::create($path . '/' . $name)
                ->modify(['w' => 345, 'h' => 487, 'fit' => 'crop'])
                ->save($thumbPath . '/' . $thumbName);

            $anime->thumb_image = "files/animes/animesImages/thumbnails/" . $thumbName;

            $thumbName2 = $anime->code . "_thumbnail_2." . $file->getClientOriginalExtension();

            GlideImage::create($path . '/' . $name)
                ->modify(['w' => 135, 'h' => 195, 'fit' => 'crop'])
                ->save($thumbPath . '/' . $thumbName2);

            $anime->thumb_image_2 = "files/animes/animesImages/thumbnails/" . $thumbName2;
        } else {
            $anime->image = "";
        }

        if ($request->hasFile('poster')) {
            $filePoster = $request->file('poster');
            $pathPoster = public_path('files/animes/animesImages/poster');
            $namePoster = $anime->code . '_poster' . "." . $filePoster->getClientOriginalExtension();
            $filePoster->move($pathPoster, $namePoster);

            $thumbPathPoster = public_path('files/animes/animesImages/poster/thumbnails');
            $thumbNamePoster = $anime->code . '_poster' . "_thumbnail." . $filePoster->getClientOriginalExtension();

            GlideImage::create($pathPoster . '/' . $namePoster)
                ->modify(['w' => 1920, 'h' => 1080, 'fit' => 'crop'])
                ->save($thumbPathPoster . '/' . $thumbNamePoster);

            $anime->thumb_poster = "files/animes/animesImages/poster/thumbnails/" . $thumbNamePoster;
            $anime->poster = "files/animes/animesImages/poster/" . $namePoster;
        }



        $anime->description = $request->description;
        $anime->average_min = $request->average_min;
        $anime->date = $request->date;

        if ($request->main_category) {
            foreach ($request->main_category as $index => $item) {

                if ($index == 0) {
                    $anime->main_category = $item ? $item : 1;
                    $anime->main_category_name = $item ? Category::Where('code', $item)->first()->name : "Genel";
                }

                $content = new ContentCategory();
                $content->category_code = $item;
                $content->content_code = $anime->code;
                $content->content_type = 1;
                $content->is_main = 1;
                $content->save();
            }
        }

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
        $this->sitemapGenerator();
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

            // Thumb oluştur
            $thumbPath = public_path('files/animes/animesImages/thumbnails');
            $thumbName = $anime->code . "_thumbnail." . $file->getClientOriginalExtension();

            GlideImage::create($path . '/' . $name)
                ->modify(['w' => 345, 'h' => 487, 'fit' => 'crop'])
                ->save($thumbPath . '/' . $thumbName);

            $anime->thumb_image = "files/animes/animesImages/thumbnails/" . $thumbName;

            $thumbName2 = $anime->code . "_thumbnail_2." . $file->getClientOriginalExtension();

            GlideImage::create($path . '/' . $name)
                ->modify(['w' => 135, 'h' => 195, 'fit' => 'crop'])
                ->save($thumbPath . '/' . $thumbName2);

            $anime->thumb_image_2 = "files/animes/animesImages/thumbnails/" . $thumbName2;
        }

        if ($request->hasFile('poster')) {
            $filePoster = $request->file('poster');
            $pathPoster = public_path('files/animes/animesImages/poster');
            $namePoster = $anime->code . '_poster' . "." . $filePoster->getClientOriginalExtension();
            $filePoster->move($pathPoster, $namePoster);

            $thumbPathPoster = public_path('files/animes/animesImages/poster/thumbnails');
            $thumbNamePoster = $anime->code . '_poster' . "_thumbnail." . $filePoster->getClientOriginalExtension();

            GlideImage::create($pathPoster . '/' . $namePoster)
                ->modify(['w' => 1920, 'h' => 1080, 'fit' => 'crop'])
                ->save($thumbPathPoster . '/' . $thumbNamePoster);

            $anime->thumb_poster = "files/animes/animesImages/poster/thumbnails/" . $thumbNamePoster;
            $anime->poster = "files/animes/animesImages/poster/" . $namePoster;
        }

        $anime->description = $request->description;
        $anime->average_min = $request->average_min;
        $anime->date = $request->date;

        ContentCategory::Where('content_code', $anime->code)->Where('content_type', 1)->delete();
        if ($request->main_category) {
            foreach ($request->main_category as $index => $item) {

                if ($index == 0) {
                    $anime->main_category = $item ? $item : 1;
                    $anime->main_category_name = $item ? Category::Where('code', $item)->first()->name : "Genel";
                }

                $content = new ContentCategory();
                $content->category_code = $item;
                $content->content_code = $anime->code;
                $content->content_type = 1;
                $content->is_main = 1;
                $content->save();
            }
        }

        $anime->showStatus = $request->showStatus;

        if ($request->plusEighteen) $anime->plusEighteen = 1;
        else $anime->plusEighteen = 0;


        $anime->update_user_code = Auth::guard('admin')->user()->code;

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

        $this->sitemapGenerator();
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

        $this->sitemapGenerator();

        return redirect()->route('admin_anime_list')->with("success", Config::get('success.success_codes.10060013'));
    }

    public function animeGetData(Request $request)
    {
        $pagination = [
            'take' => $request->showingCount ? $request->showingCount : Config::get('app.showCount'),
            'page' => $request->page
        ];

        if($request->searchData){
            $search=[
                'search' => $request->searchData,
                'dbSearch' => ['name','description','main_category_name'],
                'short_name'=> true,
                'short_name_db' => 'short_name'
            ];
        }else $search = [];

        $result = $this->getDataFromDatabase('mysql', 'App\Models\Anime', [], $pagination, $search);


        return $result;
    }

    public function animeGetSeason(Request $request)
    {
        $season = Anime::Where('code', $request->code)->first();

        return $season;
    }
}
