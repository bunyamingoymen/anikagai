<?php

namespace App\Http\Controllers;

use App\Models\KeyValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeyValueController extends Controller
{
    public function keyValueList()
    {
        $title = "KeyValue";
        $keyValues = KeyValue::Where('deleted', 0)->take(10)->get();
        $currentCount = 1;
        $pageCountTest = KeyValue::Where('deleted', 0)->count();
        if ($pageCountTest % 10 == 0)
            $pageCount = $pageCountTest / 10;
        else
            $pageCount = intval($pageCountTest / 10) + 1;
        return view("admin.keyvalue.list", ["title" => $title, "keyValues" => $keyValues, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
    }

    public function keyValueCreateScreen()
    {
        $title = "KeyValue Oluştur";

        return view("admin.keyvalue.create", ["title" => $title]);
    }

    public function keyValueCreate(Request $request)
    {
        $keyValue = new KeyValue();

        $keyValue_code = KeyValue::orderBy('created_at', 'DESC')->first();
        if ($keyValue_code) $keyValue->code = $keyValue_code->code;
        else $keyValue->code = 1;

        $keyValue->key = $request->key;
        $keyValue->value = $request->value;
        $keyValue->optional = $request->optional;
        $keyValue->optional_2 = $request->optional_2;

        $keyValue->create_user_code = Auth::user()->code;

        $keyValue->save();

        return redirect()->route('admin_keyvalue_list')->with("success", $this->successCreateMessage);
    }

    public function keyValueUpdateScreen(Request $request)
    {

        $keyValue = KeyValue::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$keyValue)
            redirect()->back()->with("error", $this->errorsUpdateMessage . " Error: 0x00001");

        $title = "KeyValue Güncelle";

        return view("admin.keyvalue.update", ["title" => $title, "keyValue" => $keyValue]);
    }

    public function keyValueUpdate(Request $request)
    {
        $keyValue = KeyValue::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$keyValue)
            redirect()->back()->with("error", $this->errorsUpdateMessage . " Error: 0x00002");

        $keyValue->key = $request->key;
        $keyValue->value = $request->value;
        $keyValue->optional = $request->optional;
        $keyValue->optional_2 = $request->optional_2;

        $keyValue->create_user_code = Auth::user()->code;

        $keyValue->save();

        return redirect()->route('admin_keyvalue_list')->with("success", $this->successCreateMessage);
    }

    public function keyValueDelete(Request $request)
    {
        $keyValue = KeyValue::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$keyValue)
            redirect()->back()->with("error", $this->errorsDeleteMessage . " Error: 0x00003");

        $keyValue->deleted = 1;
        $keyValue->update_user_code = Auth::user()->code;
        $keyValue->save();
        return redirect()->route('admin_keyvalue_list')->with("success", $this->successDeleteMessage);
    }

    public function keyValueGetData(Request $request)
    {
        $skip = (($request->page - 1) * $this->showCount);
        $keyValues = KeyValue::Where('deleted', 0)->skip($skip)->take($this->showCount)->get();
        return $keyValues;
    }
}
