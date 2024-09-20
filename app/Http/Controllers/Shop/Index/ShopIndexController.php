<?php

namespace App\Http\Controllers\Shop\Index;

use App\Http\Controllers\Controller;
use App\Models\Shop\ShopWhishlist;
use App\Models\Shop\ShopCart;
use App\Models\Shop\ShopSellers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopIndexController extends Controller
{
    public function index()
    {
        $database = 'shop_mysql';
        $model = 'App\Models\Shop\ShopProduct';

        $filters = [];

        $leftJoins = [
            ['table' => 'shop_files', 'first' => 'code', 'operator' => '=', 'second' => 'shop_files.parent_code', 'columns' => ['path' => 'image_path']]
        ];

        $orderBy = ['column' => 'created_at', 'type' => 'DESC'];

        $pagination = ['take' => 16, 'page' => 1];

        $trends = $this->getDataFromDatabase(['database' => $database, 'model' => $model, 'filters' => ['is_trend' => '1', 'is_approved' => '1', 'is_active' => '1', 'shop_files.description' => 'main image'], 'leftjoins' => $leftJoins, 'orderby' => $orderBy, 'pagination' => $pagination]);

        $products = $this->getDataFromDatabase(['database' => $database, 'model' => $model,  'filters' => ['is_approved' => '1', 'is_active' => '1', 'shop_files.description' => 'main image'], 'leftjoins' => $leftJoins, 'orderby' => $orderBy, 'pagination' => $pagination]);

        return view('shop.themes.kidol.index', compact('trends', 'products'));
    }

    public function list(Request $request)
    {
        $database = 'shop_mysql';
        $model = 'App\Models\Shop\ShopProduct';

        $filters = ['is_approved' => '1', 'is_active' => '1', 'shop_files.description' => 'main image'];

        $leftJoins = [
            ['table' => 'shop_files', 'first' => 'code', 'operator' => '=', 'second' => 'shop_files.parent_code', 'columns' => ['path' => 'image_path']]
        ];

        if ($request->category_url) {
            $joins = [
                ['table' => 'shop_category_products', 'first' => 'code', 'operator' => '=', 'second' => 'shop_category_products.product_code', 'columns' => []],
                ['table' => 'shop_categories', 'first' => 'shop_category_products.category_code', 'operator' => '=', 'second' => 'shop_categories.code', 'columns' => ['name' => 'category_name', 'code' => 'category_code', 'url' => 'category_url']],
            ];
            $filters['shop_categories.deleted'] = '0';
            $filters['shop_categories.url'] = $request->category_url;
        } else $joins = [];

        $orderBy = ['column' => 'created_at', 'type' => 'DESC'];

        $pagination = ['take' => 16, 'page' => $request->page ?? 1];

        if ($request->search) $search = ['search' => $request->search, 'dbSearch' => ['name', 'description']];
        else $search = [];

        $products = $this->getDataFromDatabase(['database' => $database, 'model' => $model,  'search' => $search, 'joins' => $joins, 'filters' => $filters, 'leftjoins' => $leftJoins, 'orderby' => $orderBy, 'pagination' => $pagination]);

        return view('shop.themes.kidol.list', compact('products'));
    }

    public function detail(Request $request, $code)
    {
        $item = $this->getOneItem('shop_mysql', 'shop_categories', $code, 'App\Models\Shop\ShopProduct', 0)['item'];

        if (!$item) abort(404);

        if ($item->seller_code != 1) {
            $seller = ShopSellers::Where('code', $request->seller_code)->where('deleted', 0)->where('is_active', 1)->first();
            if (!$seller) abort(404);
            $sellerName = $seller->show_name;
        } else $sellerName = 'Anikagai';

        $images = $this->getDataFromDatabase(['database' => 'shop_mysql', 'model' => 'App\Models\Shop\ShopFiles', 'filters' => ['parent_code' => $code], 'orderby' => ['column' => 'description', 'type' => 'ASC']])['items'];

        $feature_joins = [['table' => 'shop_features', 'first' => 'feature_code', 'operator' => '=', 'second' => 'shop_features.code', 'columns' => ['code' => 'feature_code', 'name' => 'feature_name', 'feature_type' => 'feature_type']]];
        $features = $this->getDataFromDatabase(['database' => 'shop_mysql', 'model' => 'App\Models\Shop\ShopProductFeatures', 'joins' => $feature_joins, 'filters' => ['product_code' => $code], 'orderby' => ['column' => 'feature_name', 'type' => 'ASC'], 'getQuery' => true]);

        $features_codes = $features['query']->skip(0)->take(100)->pluck('feature_code')->toArray();
        $whereIn = ['optional' => $features_codes];
        $filters['key'] = 'feature_type_multiple_selection';

        $features_alt = $this->getDataFromDatabase(['database' => 'shop_mysql', 'model' => 'App\Models\Shop\ShopKeyValue', 'pagination' => ['take' => 100, 'page' => 1], 'filters' => $filters, 'wherein' => $whereIn])['items'];
        $features = $features['items'];
        $category_joins = [['table' => 'shop_categories', 'first' => 'category_code', 'operator' => '=', 'second' => 'shop_categories.code', 'columns' => ['code' => 'category_code', 'name' => 'category_name', 'url' => 'category_url']]];
        $categories = $this->getDataFromDatabase(['database' => 'shop_mysql', 'model' => 'App\Models\Shop\ShopCategoryProducts', 'joins' => $category_joins, 'filters' => ['product_code' => $code], 'orderby' => ['column' => 'category_name', 'type' => 'ASC']])['items'];
        return view(
            'shop.themes.kidol.detail',
            compact(
                'item',
                'images',
                'features',
                'features_alt',
                'sellerName',
                'categories',
            )
        );
    }

    public function whislist()
    {
        return view('shop.themes.kidol.whislist');
    }

    public function cart()
    {
        return view('shop.themes.kidol.cart');
    }

    public function addWhislist(Request $request)
    {
        $item = new ShopWhishlist();
        $item->code = $this->generateUniqueCode('shop_mysql', 'shop_whishlists');
        $item->user_code = Auth::guard('shop_users')->user()->code;
        $item->product_code = $request->product_code;
        $item->wishlist_price = $request->price;
        $item->save();

        return redirect()->back()->with('success_whislist', 'Başarılı bir şekilde eklendi');
    }

    public function addCart(Request $request)
    {
        $item = new ShopCart();
        $item->code = $this->generateUniqueCode('shop_mysql', 'shop_carts');
        $item->user_code = Auth::guard('shop_users')->user()->code;
        $item->product_code = $request->product_code;
        $item->save();

        return redirect()->back()->with('success_cart', 'Başarılı bir şekilde eklendi');
    }

    public function login()
    {
        return view('shop.themes.kidol.login');
    }
}
