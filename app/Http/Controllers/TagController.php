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
        $tags = Tag::Where('deleted', 0)->take($this->showCount)->get();
        $currentCount = 1;
        $pageCountTest = Tag::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.tag.list", ["tags" => $tags, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
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
        $skip = (($request->page - 1) * $this->showCount);
        $tag = Tag::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $tag;
    }
}
