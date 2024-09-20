<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop\ShopUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $defaultModel, $defaultPath, $defaultRoute, $defaultListRoute, $defaultUpdateRoute, $defaultListPath, $defaultEditPath;

    public function __construct()
    {
        $this->defaultModel = 'App\Models\Shop\ShopUsers';

        $this->defaultPath = 'admin.shop.user.user';
        $this->defaultListPath = $this->defaultPath . '.list';
        $this->defaultEditPath = $this->defaultPath . '.edit';

        $this->defaultRoute = 'admin_shop_user';
        $this->defaultListRoute = $this->defaultRoute . '_list';
        $this->defaultUpdateRoute = $this->defaultRoute . '_update';
    }

    public function list()
    {
        return view($this->defaultListPath);
    }

    public function edit(Request $request)
    {
        if (Route::currentRouteName() == $this->defaultUpdateRoute) {
            $item =  $this->getOneItem('shop_mysql', 'shop_users', $request->code, $this->defaultModel, 0)['item'];

            if (!$item) return redirect()->route($this->defaultListRoute)->with('error', 'Üye güncellenirken bir hata meydana geldi');

            return view($this->defaultEditPath, ['item' => $item]);
        }
        return view($this->defaultEditPath);
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name'      => 'required|string|max:255',
            'surname'   => 'required|string|max:255',
            'username'  => 'required|string|max:255',
            'email'     => 'required|string|max:255',
        ], [
            'name.required' => 'İsim alanı giriniz. Max: 255 karakter.',
            'surname.required' => 'Soyisim alanı giriniz. Max: 255 karakter.',
            'username.required' => 'Kullanıcı alanı giriniz. Max: 255 karakter.',
            'email.required' => 'E-mail alanı giriniz. Max: 255 karakter.',
        ]);

        $getOne = $this->getOneItem('shop_mysql', 'shop_users', $request->code, $this->defaultModel);

        $item = $getOne['item'];
        $is_new = $getOne['is_new'];
        $code = $getOne['code'];

        $item->name = $request->name;
        $item->surname = $request->surname;
        $item->username = $request->username;
        $item->email = $request->email;
        $item->password = Hash::make($request->password);
        $item->phone = $request->phone;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = public_path('files/shop/users');
            $name = $code . "." . $file->getClientOriginalExtension();
            $file->move($path, $name);
            $item->image = "files/shop/users/" . $name;
        } else $item->image = '';

        $item->save();

        return redirect()->route($this->defaultListRoute)->with('success', $is_new ? 'Yeni üye eklendi' : 'Üye güncellendi');
    }

    public function delete(Request $request)
    {
        $item =  $this->getOneItem('shop_mysql', 'shop_users', $request->code, $this->defaultModel, 0)['item'];
        if (!$item) return redirect()->route($this->defaultListRoute)->with('error', 'Üye silinirken bir hata meydana geldi');

        $item->deleted = 1;
        $item->save();

        return redirect()->route($this->defaultListRoute)->with('success', 'Üye Silindi');
    }

    public function changeActive(Request $request)
    {
        $item =  $this->getOneItem('shop_mysql', 'shop_users', $request->code, $this->defaultModel, 0)['item'];
        if (!$item) return redirect()->route($this->defaultListRoute)->with('error', 'Üyenin aktifliği güncellenirken hata meydana geldi');

        if ($item->is_active == 1) $item->is_active = 0;
        else $item->is_active = 1;

        $item->save();

        return redirect()->route($this->defaultListRoute)->with('success', 'Üyenin aktiflik durumu güncellendi');
    }

    public function getData(Request $request)
    {
        $pagination = [
            'take' => $request->showingCount ? $request->showingCount : Config::get('app.showCount'),
            'page' => $request->page
        ];

        $result = $this->getDataFromDatabase(['database' => 'shop_mysql',  'model' => $this->defaultModel, 'pagination' => $pagination]);

        return $result;
    }
}
