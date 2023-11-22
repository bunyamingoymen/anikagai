<?php

namespace App\Http\Controllers;

use App\Models\KeyValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class KeyValueController extends Controller
{
    public function keyValueList()
    {
        $keyValues = KeyValue::Where('deleted', 0)->take(10)->get();
        $currentCount = 1;
        $pageCountTest = KeyValue::Where('deleted', 0)->count();
        if ($pageCountTest % $this->showCount == 0)
            $pageCount = $pageCountTest / $this->showCount;
        else
            $pageCount = intval($pageCountTest / $this->showCount) + 1;
        return view("admin.keyvalue.list", ["keyValues" => $keyValues, 'pageCount' => $pageCount, 'currentCount' => $currentCount]);
    }

    public function keyValueCreateScreen()
    {

        return view("admin.keyvalue.create");
    }

    public function keyValueCreate(Request $request)
    {
        $keyValue = new KeyValue();

        $keyValue_code = KeyValue::orderBy('created_at', 'DESC')->first();
        if ($keyValue_code) $keyValue->code = $keyValue_code->code + 1;
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
            return redirect()->back()->with("error", Config::get('error.error_codes.0000002'));


        return view("admin.keyvalue.update", ["keyValue" => $keyValue]);
    }

    public function keyValueUpdate(Request $request)
    {
        $keyValue = KeyValue::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$keyValue)
            return redirect()->back()->with("error", Config::get('error.error_codes.0000012'));

        $keyValue->key = $request->key;
        $keyValue->value = $request->value;
        $keyValue->optional = $request->optional;
        $keyValue->optional_2 = $request->optional_2;

        $keyValue->update_user_code = Auth::user()->code;

        $keyValue->save();

        return redirect()->route('admin_keyvalue_list')->with("success", $this->successCreateMessage);
    }

    public function keyValueDelete(Request $request)
    {
        $keyValue = KeyValue::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$keyValue)
            return redirect()->back()->with("error", Config::get('error.error_codes.0000013'));

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
