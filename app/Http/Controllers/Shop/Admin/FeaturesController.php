<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop\ShopFeatures;
use App\Models\Shop\ShopKeyValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;


class FeaturesController extends Controller
{

    private $defaultModel, $defaultPath, $defaultRoute, $defaultListRoute, $defaultUpdateRoute, $defaultListPath, $defaultEditPath;

    public function __construct()
    {
        $this->defaultModel = 'App\Models\Shop\ShopFeatures';

        $this->defaultPath = 'admin.shop.data.feature';
        $this->defaultListPath = $this->defaultPath . '.list';
        $this->defaultEditPath = $this->defaultPath . '.edit';

        $this->defaultRoute = 'admin_shop_feature';
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
            $item = $this->getOneItem('shop_mysql', 'shop_features', $request->code, $this->defaultModel, 0)['item'];
            if (!$item) return redirect()->route($this->defaultListRoute)->with('error', 'Özellik güncellenirken bir hata meydana geldi');
            $values = ShopKeyValue::Where('key', 'feature_type_multiple_selection')->Where('optional', $request->code)->get();
            return view($this->defaultEditPath, ['item' => $item, 'values' => $values]);
        }
        return view($this->defaultEditPath);
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'İsim alanı giriniz. Max: 255 karakter.',
        ]);


        $getOne = $this->getOneItem('shop_mysql', 'shop_features', $request->code, $this->defaultModel);

        $item = $getOne['item'];
        $is_new = $getOne['is_new'];
        $code = $getOne['code'];

        $item->name = $request->name;
        $item->description = $request->description;
        $item->feature_type = $request->feature_type ?? 0;
        $item->save();


        ShopKeyValue::Where('key', 'feature_type_multiple_selection')->where('optional', $code)->delete();

        if ($item->feature_type == 1 && $request->has('multiple_choose')) {
            $key = 'feature_type_multiple_selection';
            $optional = $code;
            foreach ($request->multiple_choose as $value) {
                $keyValue = new ShopKeyValue();
                $keyValue->code = $this->generateUniqueCode('shop_mysql', 'shop_key_values');
                $keyValue->key = $key;
                $keyValue->value = $value;
                $keyValue->optional = $optional;
                $keyValue->save();
            }
        }

        return redirect()->route($this->defaultListRoute)->with('success', $is_new ? 'Yeni Özellik eklendi' : 'Özellik güncellendi');
    }

    public function delete(Request $request)
    {
        $item = $this->getOneItem('shop_mysql', 'shop_features', $request->code, $this->defaultModel, 0)['item'];
        if (!$item) return redirect()->route($this->defaultListRoute)->with('error', 'Özellik silinirken bir hata meydana geldi');

        $item->deleted = 1;
        $item->save();
        return redirect()->route($this->defaultListRoute)->with('success', 'Özellik Silindi');
    }

    public function getData(Request $request)
    {

        $pagination = [
            'take' => $request->showingCount ? $request->showingCount : Config::get('app.showCount'),
            'page' => $request->page
        ];

        if ($request->category_codes) {
            $joins = [
                ['table' => 'shop_category_features', 'first' => 'shop_category_features.feature_code', 'operator' => '=', 'second' => 'code', 'columns' => []],
                ['table' => 'shop_categories', 'first' => 'shop_category_features.category_code', 'operator' => '=', 'second' => 'shop_categories.code', 'columns' => ['name' => 'category_name', 'code' => 'category_code']],
            ];
            $whereIn = ['shop_category_features.category_code' => $request->category_codes];
            $groupBy = true;
            $getQuery = true;
        } else {
            $whereIn = [];
            $joins = [];
            $groupBy = false;
            $getQuery = false;
        }

        $result = $this->getDataFromDatabase(['database' => 'shop_mysql', 'model' => $this->defaultModel, 'pagination' => $pagination, 'wherein' => $whereIn, 'joins' => $joins, 'groupby' => $groupBy, 'getQuery' => $getQuery]);

        if ($request->category_codes) {
            $take = $request->showingCount ? $request->showingCount : Config::get('app.showCount');
            $skip = (($request->page - 1) * $take);

            $codes = $result['query']->skip($skip)->take($take)->pluck('code')->toArray();
            $whereIn = ['optional' => $codes];
            $filters['key'] = 'feature_type_multiple_selection';
            $keyValues = $this->getDataFromDatabase(['database' => 'shop_mysql', 'model' => 'App\Models\Shop\ShopKeyValue', 'pagination' => ['take' => 100, 'page' => 1], 'filters' => $filters]);
            $result['key_values'] = $keyValues;
        }

        return $result;
    }
}
