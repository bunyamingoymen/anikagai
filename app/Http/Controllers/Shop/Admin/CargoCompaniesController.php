<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

class CargoCompaniesController extends Controller
{
    private $defaultModel, $defaultPath, $defaultRoute, $defaultListRoute, $defaultUpdateRoute, $defaultListPath, $defaultEditPath;

    public function __construct(){
        $this->defaultModel = 'App\Models\Shop\ShopKeyValue';

        $this->defaultPath = 'admin.shop.data.cargoCompany';
        $this->defaultListPath = $this->defaultPath . '.list';
        $this->defaultEditPath = $this->defaultPath . '.edit';

        $this->defaultRoute = 'admin_shop_cargo_company';
        $this->defaultListRoute = $this->defaultRoute.'_list';
        $this->defaultUpdateRoute = $this->defaultRoute.'_update';
    }

    public function list(){
        return view($this->defaultListPath);
    }

    public function edit(Request $request){
        if(Route::currentRouteName() == $this->defaultUpdateRoute){
            $item = $this->getOneItem($request->code, $this->defaultModel, 0)['item'];
            if(!$item) return redirect()->route($this->defaultListRoute)->with('error','Kategori güncellenirken bir hata meydana geldi');

            return view($this->defaultEditPath,['item'=>$item]);
        }
        return view($this->defaultEditPath);
    }

    public function save(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'İsim alanı giriniz. Max: 255 karakter.',
        ]);

        $getOne = $this->getOneItem($request->code, $this->defaultModel);

        $item = $getOne['item'];
        $is_new = $getOne['is_new'];
        $code = $getOne['code'];

        $item->value = $request->name;

        if($request->hasFile('image')){
            $file = $request->file('main_image');
            $main_path = 'shop_files/cargoCompanies/images';
            $path = public_path($main_path);
            $name = $code . "_main." . $file->getClientOriginalExtension();
            $file->move($path, $name);

            $item->optional = $main_path. "/" . $name;
        }

        $item->optional_2 = $request->description;

        $item->save();
        return redirect()->route($this->defaultListRoute)->with('success', $is_new ? 'Yeni Kargo Firması eklendi' : 'Kargo Firması güncellendi');

    }

    public function delete(Request $request){
        $item = $this->getOneItem($request->code, $this->defaultModel,0)['item'];
        if(!$item) return redirect()->route($this->defaultListRoute)->with('error','Kargo Firması silinirken bir hata meydana geldi');

        $item->deleted = 1;
        $item->save();

        return redirect()->route($this->defaultListRoute)->with('success','Kargo Firması Silindi');
    }

    public function getData(Request $request){

        $pagination = [
            'take' => $request->showingCount ? $request->showingCount : Config::get('app.showCount'),
            'page' => $request->page
        ];

        if($request->search){
            $search=[
                'search' => $request->search,
                'dbSearch' => ['value','optional_2']
            ];
        }else $search = [];

        $result = $this->getDataFromDatabase(['database'=>'shop_mysql', 'model'=>$this->defaultModel, 'pagination'=>$pagination, 'search'=>$search]);

        return $result;
    }
}
