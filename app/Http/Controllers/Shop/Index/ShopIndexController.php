<?php

namespace App\Http\Controllers\Shop\Index;

use App\Http\Controllers\Controller;
use App\Models\Shop\ShopWhishlist;
use App\Models\Shop\ShopCart;
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

    public function detail(Request $request)
    {
        $item = $this->getOneItem('shop_mysql', 'shop_categories', $request->code, $this->defaultModel, 0)['item'];
        return view('shop.themes.kidol.detail');
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
