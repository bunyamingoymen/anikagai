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
        return view("admin.keyvalue.list");
    }

    public function keyValueCreateScreen()
    {
        return view("admin.keyvalue.create");
    }

    public function keyValueCreate(Request $request)
    {
        $keyValue = new KeyValue();

        $keyValue->code = KeyValue::max('code') + 1;

        $keyValue->key = $request->key;
        $keyValue->value = $request->value;
        $keyValue->optional = $request->optional;
        $keyValue->optional_2 = $request->optional_2;

        $keyValue->create_user_code = Auth::guard('admin')->user()->code;

        $keyValue->save();

        return redirect()->route('admin_keyvalue_list')->with("success", Config::get('success.success_codes.10000010'));
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

        $keyValue->update_user_code = Auth::guard('admin')->user()->code;

        $keyValue->save();

        return redirect()->route('admin_keyvalue_list')->with("success", Config::get('success.success_codes.10000012'));
    }

    public function keyValueDelete(Request $request)
    {
        $keyValue = KeyValue::Where('code', $request->code)->Where('deleted', 0)->first();

        if (!$keyValue)
            return redirect()->back()->with("error", Config::get('error.error_codes.0000013'));

        $keyValue->deleted = 1;
        $keyValue->update_user_code = Auth::guard('admin')->user()->code;
        $keyValue->save();
        return redirect()->route('admin_keyvalue_list')->with("success", Config::get('success.success_codes.10000013'));
    }

    public function keyValueGetData(Request $request)
    {
        $take  = $request->showingCount ? $request->showingCount : Config::get('app.showCount');
        $skip = (($request->page - 1) * $take);
        $keyValues = KeyValue::Where('deleted', 0)->skip($skip)->take($take)->get();
        $page_count = ceil(KeyValue::Where('deleted', 0)->count() / $take);
        return ['keyValues' => $keyValues, "page_count" => $page_count];
    }
}
