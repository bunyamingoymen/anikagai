<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class EarnedValuesController extends Controller
{
    public function getData(Request $request)
    {
        $pagination = [
            'take' => $request->showingCount ? $request->showingCount : Config::get('app.showCount'),
            'page' => $request->page
        ];

        if ($request->searchData) {
            $search = [
                'search' => $request->searchData,
                'dbSearch' => ['product_code', 'order_code'],
            ];
        } else $search = [];

        if ($request->seller_code) $filters['seller_code'] = $request->seller_code;
        else $filters = [];

        $result = $this->getDataFromDatabase(['database' => 'mysql', 'model' => 'App\Models\Anime', 'filters' => $filters, 'pagination' => $pagination, 'search' => $search]);

        return $result;
    }
}
