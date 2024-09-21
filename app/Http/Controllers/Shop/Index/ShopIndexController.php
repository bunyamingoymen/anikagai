<?php

namespace App\Http\Controllers\Shop\Index;

use App\Http\Controllers\Controller;
use App\Models\Shop\ShopWhishlist;
use App\Models\Shop\ShopCart;
use App\Models\Shop\ShopProduct;
use App\Models\Shop\ShopSellers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopIndexController extends Controller
{
    public function index()
    {
        $database = 'shop_mysql';
        $model = 'App\Models\Shop\ShopProduct';

        $filters = ['is_approved' => '1', 'is_active' => '1'];

        $leftJoins = [
            ['table' => 'shop_files', 'first' => 'code', 'operator' => '=', 'second' => 'shop_files.parent_code', 'columns' => ['path' => 'image_path', 'parent_code' => 'parent_code'], 'where' => ['description' => ['can_be_null' => false, 'value' => 'main image']]],
        ];

        if (Auth::guard('shop_users')->user()) {
            $leftJoins[] = ['table' => 'shop_whishlists', 'first' => 'code', 'operator' => '=', 'second' => 'shop_whishlists.product_code', 'columns' => ['product_code' => 'whislist_product_code', 'deleted' => 'whislist_deleted', 'user_code' => 'whislist_user_code'], 'where' => ['deleted' => ['can_be_null' => false, 'value' => 0], 'user_code' => Auth::guard('shop_users')->user()->code,]];
            $leftJoins[] = ['table' => 'shop_carts', 'first' => 'code', 'operator' => '=', 'second' => 'shop_carts.product_code', 'columns' => ['product_code' => 'cart_product_code', 'user_code' => 'cart_user_code'], 'where' => ['user_code' => Auth::guard('shop_users')->user()->code]];
        }

        $orderBy = ['column' => 'created_at', 'type' => 'DESC'];

        $pagination = ['take' => 16, 'page' => 1];

        $products = $this->getDataFromDatabase(['database' => $database, 'model' => $model,  'filters' => $filters, 'leftjoins' => $leftJoins, 'orderby' => $orderBy, 'pagination' => $pagination, 'groupby' => true]);

        $filters['is_trend'] = '1';
        $trends = $this->getDataFromDatabase(['database' => $database, 'model' => $model, 'filters' => $filters, 'leftjoins' => $leftJoins, 'orderby' => $orderBy, 'pagination' => $pagination, 'groupby' => true]);

        return view('shop.themes.kidol.index', compact('trends', 'products'));
    }

    public function list(Request $request)
    {
        $database = 'shop_mysql';
        $model = 'App\Models\Shop\ShopProduct';

        $filters = ['is_approved' => '1', 'is_active' => '1'];

        $leftJoins = [
            ['table' => 'shop_files', 'first' => 'code', 'operator' => '=', 'second' => 'shop_files.parent_code', 'columns' => ['path' => 'image_path', 'parent_code' => 'parent_code'], 'where' => ['description' => ['can_be_null' => false, 'value' => 'main image']]],
        ];

        if (Auth::guard('shop_users')->user()) {
            $leftJoins[] = ['table' => 'shop_whishlists', 'first' => 'code', 'operator' => '=', 'second' => 'shop_whishlists.product_code', 'columns' => ['product_code' => 'whislist_product_code', 'deleted' => 'whislist_deleted', 'user_code' => 'whislist_user_code'], 'where' => ['deleted' => ['can_be_null' => false, 'value' => 0], 'user_code' => Auth::guard('shop_users')->user()->code,]];
            $leftJoins[] = ['table' => 'shop_carts', 'first' => 'code', 'operator' => '=', 'second' => 'shop_carts.product_code', 'columns' => ['product_code' => 'cart_product_code', 'user_code' => 'cart_user_code'], 'where' => ['user_code' => Auth::guard('shop_users')->user()->code]];
        }

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
        $item = $this->getDataFromDatabase(['database' => 'shop_mysql', 'model' => 'App\Models\Shop\ShopProduct', 'filters' => ['code' => $code], 'isfirst' => true])['item'];

        if (!$item) abort(404);

        if ($item->seller_code != 1) {
            $seller = ShopSellers::Where('code', $request->seller_code)->where('deleted', 0)->where('is_active', 1)->first();
            if (!$seller) abort(404);
            $sellerName = $seller->show_name;
        } else $sellerName = 'Anikagai';

        $images = $this->getDataFromDatabase(['database' => 'shop_mysql', 'model' => 'App\Models\Shop\ShopFiles', 'filters' => ['parent_code' => $code], 'orderby' => ['column' => 'description', 'type' => 'ASC']])['items'];

        $feature_joins = [['table' => 'shop_features', 'first' => 'feature_code', 'operator' => '=', 'second' => 'shop_features.code', 'columns' => ['code' => 'feature_code', 'name' => 'feature_name', 'feature_type' => 'feature_type']]];
        $features = $this->getDataFromDatabase(['database' => 'shop_mysql', 'model' => 'App\Models\Shop\ShopProductFeatures', 'joins' => $feature_joins, 'filters' => ['product_code' => $code], 'orderby' => ['column' => 'feature_name', 'type' => 'ASC', 'put_table' => false], 'getQuery' => true]);

        $features_codes = $features['query']->skip(0)->take(100)->pluck('feature_code')->toArray();
        $whereIn = ['optional' => $features_codes];
        $filters['key'] = 'feature_type_multiple_selection';

        $features_alt = $this->getDataFromDatabase(['database' => 'shop_mysql', 'model' => 'App\Models\Shop\ShopKeyValue', 'pagination' => ['take' => 100, 'page' => 1], 'filters' => $filters, 'wherein' => $whereIn])['items'];
        $features = $features['items'];
        $category_joins = [['table' => 'shop_categories', 'first' => 'category_code', 'operator' => '=', 'second' => 'shop_categories.code', 'columns' => ['code' => 'category_code', 'name' => 'category_name', 'url' => 'category_url']]];
        $categories = $this->getDataFromDatabase(['database' => 'shop_mysql', 'model' => 'App\Models\Shop\ShopCategoryProducts', 'joins' => $category_joins, 'filters' => ['product_code' => $code], 'orderby' => ['column' => 'category_name', 'type' => 'ASC', 'put_table' => false]])['items'];
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
        $product = ShopProduct::Where('code', $request->product_code)->where('deleted', 0)->where('is_approved', 1)->where('is_active', 1)->first();


        if (!$product) abort(404);

        $item = ShopWhishlist::where('user_code', Auth::guard('shop_users')->user()->code)->where('product_code', $request->product_code)->first();

        $message = 'Başarılı bir şekilde istek listesine eklendi';
        if ($item) {

            if ($item->deleted == 0) {
                $item->deleted = 1;
                $message = 'Başarılı bir şekilde istek listesinden kaldırıldı';
            } else {
                $item->deleted = 0;
            }
        } else {
            $item = new ShopWhishlist();
            $item->code = $this->generateUniqueCode('shop_mysql', 'shop_whishlists');
            $item->user_code = Auth::guard('shop_users')->user()->code;
            $item->product_code = $request->product_code;

            $item->wishlist_price = $product->price;
            $item->deleted = 0;
        }

        $item->save();

        return redirect()->back()->with('success', $message);
    }

    public function addCart(Request $request)
    {
        $product = ShopProduct::Where('code', $request->product_code)->where('deleted', 0)->where('is_approved', 1)->where('is_active', 1)->first();

        if (!$product) abort(404);

        $item = ShopCart::where('user_code', Auth::guard('shop_users')->user()->code)->where('product_code', $request->product_code)->first();
        $message = 'Başarılı bir şekilde sepete eklendi';

        if ($item) {
            $item->delete();
            $message = 'Başarılı bir şekilde sepetten kaldırıldı';
        } else {
            $item = new ShopCart();
            $item->code = $this->generateUniqueCode('shop_mysql', 'shop_carts');
            $item->user_code = Auth::guard('shop_users')->user()->code;
            $item->product_code = $request->product_code;
            $item->save();
        }

        return redirect()->back()->with('success', $message);
    }

    public function login()
    {
        return view('shop.themes.kidol.login');
    }
}
