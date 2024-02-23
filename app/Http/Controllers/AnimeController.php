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
        $skip = (($request->page - 1) * $this->showCount);

        $animesQuery = Anime::where('deleted', 0)
            ->when($request->searchData, function ($query, $searchData) {
                // Arama terimi için özel karakter dönüşümü
                $shortName = preg_replace_callback('/[ğĞüÜşŞıİöÖçÇ\s]/u', function ($match) {
                    return strtolower(preg_replace('/[\p{Mn}]/u', '', iconv('UTF-8', 'ASCII//TRANSLIT', $match[0])));
                }, $searchData);

                $searchQueryData = '%' . $searchData . '%';
                $shortNameData = '%' . $shortName . '%';

                return $query->where(function ($query) use ($searchQueryData, $shortNameData) {
                    $query->where('name', 'LIKE', $searchQueryData)
                        ->orWhere('description', 'LIKE', $searchQueryData)
                        ->orWhere('main_category_name', 'LIKE', $searchQueryData)
                        ->orWhere('short_name', 'LIKE', $shortNameData);
                });
            });
        $page_count = ceil($animesQuery->count() / $this->showCount);
        $animes = $animesQuery->skip($skip)->take($this->showCount)->get();




        return [
            'animes' => $animes,
            'page_count' => $page_count
        ];
    }

    public function animeGetSeason(Request $request)
    {
        $season = Anime::Where('code', $request->code)->first();

        return $season;
    }
}
