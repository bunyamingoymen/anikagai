<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class TagController extends Controller
{
    public function tagList()
    {
        return view("admin.tag.list");
    }

    public function tagCreateScreen()
    {
        return view("admin.tag.create");
    }

    public function tagCreate(Request $request)
    {
        $tag = new Tag();

        $tag->code = Tag::max('code') + 1;

        $tag->name = $request->name;
        $tag->description = $request->description;

        $tag->create_user_code = Auth::guard('admin')->user()->code;

        $tag->save();

        return redirect()->route('admin_tag_list')->with("success", Config::get('success.success_codes.10170010'));
    }

    public function tagUpdateScreen(Request $request)
    {

        $tag = Tag::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$tag)
            return redirect()->back()->with("error", Config::get('error.error_codes.0170002'));


        return view("admin.tag.update", ["tag" => $tag]);
    }

    public function tagUpdate(Request $request)
    {
        $tag = Tag::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$tag)
            return redirect()->back()->with("error", Config::get('error.error_codes.0170012'));

        $tag->name = $request->name;
        $tag->description = $request->description;

        $tag->update_user_code = Auth::guard('admin')->user()->code;

        $tag->save();

        return redirect()->route('admin_tag_list')->with("success", Config::get('success.success_codes.10170013'));
    }

    public function tagDelete(Request $request)
    {
        $tag = Tag::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$tag)
            return redirect()->back()->with("error", Config::get('error.error_codes.0170013'));

        $tag->deleted = 1;
        $tag->update_user_code = Auth::guard('admin')->user()->code;
        $tag->save();
        return redirect()->route('admin_tag_list')->with("success", Config::get('success.success_codes.10170013'));
    }

    public function tagGetData(Request $request)
    {
        $take  = $request->showingCount ? $request->showingCount : Config::get('app.showCount');
        $skip = (($request->page - 1) * $take);
        $tags = Tag::Where('deleted', 0)->skip($skip)->take($take)->get();
        $page_count = ceil(Tag::Where('deleted', 0)->count() / $take);
        return ['tags' => $tags, "page_count" => $page_count];
    }
}
