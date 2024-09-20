<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop\ShopCategories;
use App\Models\Shop\ShopCategoryFeatures;
use App\Models\Shop\ShopFeatures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

class CategoryController extends Controller
{

    private $defaultModel, $defaultPath, $defaultRoute, $defaultListRoute, $defaultUpdateRoute, $defaultListPath, $defaultEditPath;

    public function __construct()
    {
        $this->defaultModel = 'App\Models\Shop\ShopCategories';

        $this->defaultPath = 'admin.shop.data.category';
        $this->defaultListPath = $this->defaultPath . '.list';
        $this->defaultEditPath = $this->defaultPath . '.edit';

        $this->defaultRoute = 'admin_shop_category';
        $this->defaultListRoute = $this->defaultRoute . '_list';
        $this->defaultUpdateRoute = $this->defaultRoute . '_update';
    }


    public function list()
    {
        return view($this->defaultListPath);
    }

    public function edit(Request $request)
    {
        $features = ShopFeatures::Where('deleted', 0)->get();
        if (Route::currentRouteName() == $this->defaultUpdateRoute) {
            $item = $this->getOneItem('shop_mysql', 'shop_categories', $request->code, $this->defaultModel, 0)['item'];
            if (!$item) return redirect()->route($this->defaultListRoute)->with('error', 'Kategori güncellenirken bir hata meydana geldi');

            $values = ShopCategoryFeatures::Where('category_code', $request->code)->get();

            return view($this->defaultEditPath, ['item' => $item, 'values' => $values, 'features' => $features]);
        }
        return view($this->defaultEditPath, ['features' => $features]);
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'İsim alanı giriniz. Max: 255 karakter.',
        ]);

        $getOne = $this->getOneItem('shop_mysql', 'shop_categories', $request->code, $this->defaultModel);

        $item = $getOne['item'];
        $is_new = $getOne['is_new'];
        $code = $getOne['code'];

        $item->name = $request->name;
        $item->url = $this->getUrl($request->name);
        $item->description = $request->description;

        ShopCategoryFeatures::Where('category_code', $code)->delete();
        if ($request->has('features')) {
            foreach ($request->features as $value) {
                $cat_fea = new ShopCategoryFeatures();
                $cat_fea->category_code = $code;
                $cat_fea->feature_code = $value;
                $cat_fea->save();
            }
        }
        $item->save();
        return redirect()->route($this->defaultListRoute)->with('success', $is_new ? 'Yeni kategori eklendi' : 'Kategori güncellendi');
    }

    public function delete(Request $request)
    {
        $item = $this->getOneItem('shop_mysql', 'shop_categories', $request->code, $this->defaultModel, 0)['item'];
        if (!$item) return redirect()->route($this->defaultListRoute)->with('error', 'Kategori silinirken bir hata meydana geldi');

        $item->deleted = 1;
        $item->save();

        return redirect()->route($this->defaultListRoute)->with('success', 'Kategori Silindi');
    }

    public function getData(Request $request)
    {

        $pagination = [
            'take' => $request->showingCount ? $request->showingCount : Config::get('app.showCount'),
            'page' => $request->page
        ];

        if ($request->search) {
            $search = [
                'search' => $request->search,
                'dbSearch' => ['name', 'description']
            ];
        } else $search = [];

        $result = $this->getDataFromDatabase(['database' => 'shop_mysql', 'model' => $this->defaultModel, 'pagination' => $pagination, 'search' => $search]);

        return $result;
    }
}
