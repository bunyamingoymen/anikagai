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
        $categories = Category::Where('deleted', 0)->take(10)->get();
        $currentCount = 1;
        $pageCountTest = Category::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.category.list", ["categories" => $categories, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
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
        $skip = (($request->page - 1) * $this->showCount);
        $category = Category::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $category;
    }
}
