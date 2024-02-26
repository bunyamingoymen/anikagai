<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class PageController extends Controller
{
    public function pageList()
    {
        return view("admin.pages.list");
    }

    public function pageCreateScreen()
    {
        return view("admin.pages.create");
    }

    public function pageCreate(Request $request)
    {
        $page = new Page();

        $page->code = Page::max('code') + 1;

        $page_name_control = Page::Where('short_name', $request->short_name)->Where('deleted', 0)->first();

        if ($page_name_control)
            return redirect()->back()->with('error', Config::get('error.error_codes.0150010'));


        $page->name = $request->name;
        $page->short_name = $request->short_name;
        $page->text = $request->text;
        $page->description = $request->description;

        $page->create_user_code = Auth::guard('admin')->user()->code;

        $page->save();

        return redirect()->route('admin_page_list')->with('success', Config::get('success.success_codes.10150010'));
    }

    public function pageUpdateScreen(Request $request)
    {
        $page = Page::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$page)
            return redirect()->back()->with("error", Config::get('error.error_codes.0150002'));


        return view("admin.pages.update", ["page" => $page]);
    }

    public function pageUpdate(Request $request)
    {
        $page = Page::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$page)
            return redirect()->back()->with("error", Config::get('error.error_codes.0150012'));

        $page_name_control = Page::Where('short_name', $request->short_name)->Where('deleted', 0)->Where('code', "!=", $request->code)->first();

        if ($page_name_control)
            return redirect()->back()->with('error', Config::get('error.error_codes.0150010'));

        $page->name = $request->name;
        $page->short_name = $request->short_name;
        $page->text = $request->text;
        $page->description = $request->description;

        $page->update_user_code = Auth::guard('admin')->user()->code;

        $page->save();

        return redirect()->route('admin_page_list')->with('success', Config::get('success.success_codes.10150012'));
    }

    public function pageDelete(Request $request)
    {
        $page = Page::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$page)
            return redirect()->back()->with("error", Config::get('error.error_codes.0150002'));


        $page->deleted = 1;
        $page->update_user_code = Auth::guard('admin')->user()->code;
        $page->save();

        return redirect()->route('admin_page_list')->with('success', Config::get('success.success_codes.10150013'));
    }

    public function pageShow(Request $request)
    {
        $page = Page::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$page)
            return redirect()->back()->with("error", Config::get('error.error_codes.0150001'));


        return view("admin.pages.show", ["page" => $page]);
    }

    public function pageGetData(Request $request)
    {
        $take  = $request->showingCount ? $request->showingCount : Config::get('app.showCount');
        $skip = (($request->page - 1) * $take);
        $pages = Page::Where('deleted', 0)->skip($skip)->take($take)->get();
        $page_count = ceil(Page::Where('deleted', 0)->count() / $take);
        return ['pages' => $pages, "page_count" => $page_count];
    }
}
