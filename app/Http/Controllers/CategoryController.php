<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CategoryController extends Controller
{
    public function categoryList()
    {
        return view("admin.category.list");
    }

    public function categoryCreateScreen()
    {
        return view("admin.category.create");
    }

    public function categoryCreate(Request $request)
    {
        $category = new Category();

        $category->code = Category::max('code') + 1;

        $category->name = $request->name;
        $category->short_name = $request->short_name;
        $category->description = $request->description;

        $category->create_user_code = Auth::guard('admin')->user()->code;

        $category->save();

        return redirect()->route('admin_category_list')->with("success", Config::get('success.success_codes.10160010'));
    }

    public function categoryUpdateScreen(Request $request)
    {

        $category = Category::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$category)
            return redirect()->back()->with("error", Config::get('error.error_codes.0160002'));


        return view("admin.category.update", ["category" => $category]);
    }

    public function categoryUpdate(Request $request)
    {
        $category = Category::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$category)
            return redirect()->back()->with("error", Config::get('error.error_codes.0160012'));

        $category->name = $request->name;
        $category->short_name = $request->short_name;
        $category->description = $request->description;

        $category->update_user_code = Auth::guard('admin')->user()->code;

        $category->save();

        return redirect()->route('admin_category_list')->with("success", Config::get('success.success_codes.10160012'));
    }

    public function categoryDelete(Request $request)
    {
        $category = Category::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$category)
            return redirect()->back()->with("error", Config::get('error.error_codes.0160013'));

        if ($category->code == 1) {
            return redirect()->back()->with("error", Config::get('error.error_codes.0160113'));
        }

        $category->deleted = 1;
        $category->update_user_code = Auth::guard('admin')->user()->code;
        $category->save();
        return redirect()->route('admin_category_list')->with("success", Config::get('success.success_codes.10160013'));
    }

    public function categoryGetData(Request $request)
    {
        $take  = $request->showingCount ? $request->showingCount : Config::get('app.showCount');
        $skip = (($request->page - 1) * $take);
        $categories = Category::Where('deleted', 0)->skip($skip)->take($take)->get();
        $page_count = ceil(Category::Where('deleted', 0)->count() / $take);
        return ['categories' => $categories, "page_count" => $page_count];
    }
}
