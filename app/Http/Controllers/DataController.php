<?php

namespace App\Http\Controllers;

use App\Models\KeyValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class DataController extends Controller
{
    public function logoList()
    {

        $logo = KeyValue::Where('key', 'index_logo')->first();
        $logo_footer = KeyValue::Where('key', 'index_logo_footer')->first();

        $icon = KeyValue::Where('key', 'index_icon')->first();

        if (!$logo || !$logo_footer || !$icon) {
            return redirect()->back()->with("error", Config::get('error.error_codes.0120001'));
        }

        return view('admin.data.logo', ['logo' => $logo, 'logo_footer' => $logo_footer, 'icon' => $icon]);
    }

    public function logoChange(Request $request)
    {
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $path = 'index/img/logo/';
            $name = "logo." . $logo->getClientOriginalExtension();
            $logo->move(public_path($path), $name);

            $logoVal = KeyValue::Where('key', 'index_logo')->first();
            $logoVal->value = $path . $name;
            $logoVal->save();
        }

        if ($request->hasFile('logo_footer')) {
            $footer = $request->file('logo_footer');
            $path = 'index/img/logo_footer/';
            $name = "logo_footer." . $footer->getClientOriginalExtension();
            $footer->move(public_path($path), $name);

            $footerVal = KeyValue::Where('key', 'index_logo_footer')->first();
            $footerVal->value = $path . $name;
            $footerVal->save();
        }

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $path = 'index/img/icon/';
            $name = "icon." . $icon->getClientOriginalExtension();
            $icon->move(public_path($path), $name);

            $iconVal = KeyValue::Where('key', 'index_icon')->first();
            $iconVal->value = $path . $name;
            $iconVal->save();
        }

        return redirect()->route('admin_data_logo_list')->with("success", Config::get('success.success_codes.10120012'));
    }

    public function menuList()
    {

        $menus = KeyValue::Where('key', 'menu')->Where('deleted', 0)->get();
        $menu_alts = KeyValue::Where('key', 'menu_alt')->Where('deleted', 0)->get();

        if (!$menus || !$menu_alts) {
            return redirect()->back()->with("error", Config::get('error.error_codes.0120101'));
        }

        return view('admin.data.menu', ['menus' => $menus, 'menu_alts' => $menu_alts]);
    }

    public function menuAdd(Request $request)
    {

        $menu = new KeyValue();

        $menu_code = KeyValue::orderBy('created_at', 'DESC')->first();
        if ($menu_code) $menu->code = $menu_code->code + 1;
        else $menu->code = 1;

        $menu->key = $request->menu_type;
        $menu->value = $request->menu;

        if ($request->showMenu) $menu->optional = 1;
        else $menu->optional = 0;

        $menu->optional_2 = $request->url;

        $menu->save();

        return redirect()->route('admin_data_menu_list')->with("success", Config::get('success.success_codes.10120010'));
    }

    public function menuUpdate(Request $request)
    {

        $menu = KeyValue::Where('code', $request->code)->first();

        if (!$menu)
            return redirect()->back()->with("error", Config::get('error.error_codes.0120012'));

        $menu->value = $request->menu;
        if ($request->showMenu) $menu->optional = 1;
        else $menu->optional = 0;
        $menu->optional_2 = $request->url;
        $menu->save();

        return redirect()->route('admin_data_menu_list')->with("success", Config::get('success.success_codes.10120112'));
    }

    public function menuDelete(Request $request)
    {

        $menu = KeyValue::Where('code', $request->code)->first();
        if (!$menu)
            return redirect()->back()->with("error", Config::get('error.error_codes.0120013'));

        $menu->deleted = 1;
        $menu->save();

        return redirect()->route('admin_data_menu_list')->with("success", Config::get('success.success_codes.10120013'));
    }

    public function metaList()
    {
        $meta = KeyValue::Where('key', 'meta')->Where('deleted', 0)->get();

        if (!$meta)
            return redirect()->back()->with("error", Config::get('error.error_codes.0120201'));

        return view('admin.data.meta', ['meta' => $meta]);
    }

    public function adminMetaList()
    {
        $meta = KeyValue::Where('key', 'admin_meta')->Where('deleted', 0)->get();

        if (!$meta)
            return redirect()->back()->with("error", Config::get('error.error_codes.0120201'));

        return view('admin.data.meta', ['meta' => $meta]);
    }

    public function metaAdd(Request $request)
    {
        $meta = new KeyValue();

        $meta_code = KeyValue::orderBy('created_at', 'DESC')->first();
        if ($meta_code) $meta->code = $meta_code->code + 1;
        else $meta->code = 1;

        $meta->key = $request->key;
        $meta->value = $request->name ? $request->name : " ";
        $meta->optional = $request->content;
        $meta->optional_2 = $request->equiv;

        $meta->save();

        if ($meta->key == "admin_meta") {
            return redirect()->route('admin_data_admin_meta_list')->with("success", Config::get('success.success_codes.10120110'));
        }

        return redirect()->route('admin_data_meta_list')->with("success", Config::get('success.success_codes.10120110'));
    }

    public function metaUpdate(Request $request)
    {
        $meta = KeyValue::Where('code', $request->code)->first();

        if (!$meta)
            return redirect()->back()->with("error", Config::get('error.error_codes.0120112'));

        $meta->value = $request->name ? $request->name : " ";
        $meta->optional = $request->content;
        $meta->optional_2 = $request->equiv;
        $meta->save();

        if ($meta->key == "admin_meta") {
            return redirect()->route('admin_data_admin_meta_list')->with("success", Config::get('success.success_codes.10120212'));
        }

        return redirect()->route('admin_data_meta_list')->with("success", Config::get('success.success_codes.10120212'));
    }

    public function metaDelete(Request $request)
    {
        $meta = KeyValue::Where('code', $request->code)->first();

        if (!$meta)
            return redirect()->back()->with("error", Config::get('error.error_codes.0120113'));

        $meta->deleted = 1;
        $meta->save();

        if ($meta->key == "admin_meta") {
            return redirect()->route('admin_data_admin_meta_list')->with("success", Config::get('success.success_codes.10120113'));
        }

        return redirect()->route('admin_data_meta_list')->with("success", Config::get('success.success_codes.10120113'));
    }

    public function socialList()
    {
        $social = KeyValue::Where('key', 'social_media')->Where('deleted', 0)->get();

        if (!$social)
            return redirect()->back()->with("error", Config::get('error.error_codes.0120301'));

        return view('admin.data.social', ['meta' => $social]);
    }

    public function socialAdd(Request $request)
    {
        $social = new KeyValue();

        $social_code = KeyValue::orderBy('created_at', 'DESC')->first();
        if ($social_code) $social->code = $social_code->code + 1;
        else $social->code = 1;

        $social->key = 'social_media';
        $social->value = $request->social;
        $social->optional = $request->url;
        $social->save();

        return redirect()->route('admin_data_social_list')->with("success", Config::get('success.success_codes.10120210'));
    }

    public function socialUpdate(Request $request)
    {
        $social = KeyValue::Where('code', $request->code)->first();

        if (!$social)
            return redirect()->back()->with("error", Config::get('error.error_codes.0120212'));

        $social->value = $request->social;
        $social->optional = $request->url;
        $social->save();

        return redirect()->route('admin_data_social_list')->with("success", Config::get('success.success_codes.10120312'));
    }

    public function socialDelete(Request $request)
    {
        $social = KeyValue::Where('code', $request->code)->first();

        if (!$social)
            return redirect()->back()->with("error", Config::get('error.error_codes.0120213'));

        $social->deleted = 1;
        $social->save();

        return redirect()->route('admin_data_social_list')->with("success", Config::get('success.success_codes.10120213'));
    }

    public function titleList()
    {
        $index_title = KeyValue::Where('key', 'index_title')->first();
        if (!$index_title) {
            return redirect()->back()->with("error", Config::get('error.error_codes.0120401'));
        }
        return view('admin.data.title', ['index_title' => $index_title]);
    }

    public function titleChange(Request $request)
    {
        $index_title = KeyValue::Where('key', 'index_title')->first();
        if (!$index_title) {
            return redirect()->back()->with("error", Config::get('error.error_codes.0120312'));
        }
        $index_title->value = $request->index_title;
        $index_title->save();
        return redirect()->back()->with('success', Config::get('success.success_codes.10120412'));
    }
}
