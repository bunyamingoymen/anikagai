<?php

namespace App\Http\Controllers;

use App\Models\Webtoon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebtoonController extends Controller
{
    public function webtoonList()
    {
        $title = "Webtoonlar";
        $webtoons = Webtoon::Where('deleted', 0)->take(10)->get();
        $currentCount = 1;
        $pageCountTest = Webtoon::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.webtoon.webtoon.list", ["title" => $title, "webtoons" => $webtoons, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
    }

    public function webtoonCreateScreen()
    {
        $title = "Yeni Bir Webtoon Ekle";

        return view("admin.webtoon.webtoon.create", ["title" => $title]);
    }

    public function webtoonCreate(Request $request)
    {
        $webtoon = new Webtoon();

        $webtoon_code = Webtoon::orderBy('created_at', 'DESC')->first();
        if ($webtoon_code) $webtoon->code = $webtoon_code->code + 1;
        else $webtoon->code = 1;

        $webtoon->name = $request->name;

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
        $webtoon->episode_count = 0;
        $webtoon->click_count = 0;

        $webtoon->create_user_code = Auth::user()->code;

        $webtoon->save();

        return redirect()->route('admin_webtoon_list')->with("success", $this->successCreateMessage);
    }

    public function webtoonUpdateScreen(Request $request)
    {

        $webtoon = Webtoon::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$webtoon)
            return redirect()->back()->with("error", $this->errorsUpdateMessage . " Error: 0x00010");

        $title = "Webtoon Güncelle";

        return view("admin.webtoon.webtoon.update", ["title" => $title, "webtoon" => $webtoon]);
    }

    public function webtoonUpdate(Request $request)
    {
        $webtoon = Webtoon::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$webtoon)
            return redirect()->back()->with("error", $this->errorsUpdateMessage . " Error: 0x00011");

        $webtoon->name = $request->name;

        if ($request->hasFile('image')) {
            // Dosyayı al
            $file = $request->file('image');

            $path = public_path('files/webtoons/webtoonImages');
            $name = $webtoon->code . "" . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $webtoon->image = "files/webtoons/webtoonImages/" . $name;
        }

        $webtoon->description = $request->description;
        $webtoon->episode_count = 0;
        $webtoon->click_count = 0;

        $webtoon->update_user_code = Auth::user()->code;

        $webtoon->save();

        return redirect()->route('admin_webtoon_list')->with("success", $this->successCreateMessage);
    }

    public function webtoonDelete(Request $request)
    {
        $webtoon = Webtoon::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$webtoon)
            return redirect()->back()->with("error", $this->errorsDeleteMessage . " Error: 0x00012");

        $webtoon->deleted = 1;
        $webtoon->update_user_code = Auth::user()->code;
        $webtoon->save();
        return redirect()->route('admin_webtoon_list')->with("success", $this->successDeleteMessage);
    }

    public function webtoonGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $webtoons = Webtoon::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $webtoons;
    }
}
