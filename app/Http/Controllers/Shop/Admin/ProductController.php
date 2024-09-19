<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop\ShopCategoryProducts;
use App\Models\Shop\ShopFiles;
use App\Models\Shop\ShopKeyValue;
use App\Models\Shop\ShopProductFeatures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

class ProductController extends Controller
{

    private $defaultModel, $defaultPath, $defaultRoute, $defaultListRoute, $defaultUpdateRoute, $defaultListPath, $defaultEditPath;

    public function __construct(){
        $this->defaultModel = 'App\Models\Shop\ShopProduct';

        $this->defaultPath = 'admin.shop.product';
        $this->defaultListPath = $this->defaultPath . '.list';
        $this->defaultEditPath = $this->defaultPath . '.edit';

        $this->defaultRoute = 'admin_shop_product';
        $this->defaultListRoute = $this->defaultRoute.'_list';
        $this->defaultUpdateRoute = $this->defaultRoute.'_update';
    }

    public function list($type = null){
        if(!$type) $type = -1;
        return view($this->defaultListPath, ['type'=> $type]);
    }

    public function edit(Request $request){
        if(Route::currentRouteName() == $this->defaultUpdateRoute){
            $item = $this->getOneItem('shop_mysql', 'shop_products' ,$request->code, $this->defaultModel, 0)['item'];
            if(!$item) return redirect()->route($this->defaultListRoute)->with('error','ürün güncellenirken bir hata meydana geldi');

            $categories = $this->getDataFromDatabase(['database'=>'shop_mysql', 'model'=>'App\Models\Shop\ShopCategories', 'filters'=>['shop_category_products.product_code'=>$request->code], 'pagination'=>['take' => 100, 'page' => 1], 'joins'=>[['table' => 'shop_category_products', 'first' => 'code', 'operator' => '=', 'second' => 'shop_category_products.category_code', 'columns'=>[]]]   ])['items'];

            $featuresAnswers = $this->getDataFromDatabase(['database'=>'shop_mysql', 'model'=>'App\Models\Shop\ShopProductFeatures', 'filters'=>['product_code'=>$request->code], 'pagination'=>['take' => 100, 'page' => 1] ])['items'];
            //dd($featuresAnswers);
            $main_image = ShopFiles::Where('parent_code',$item->code)->Where('description','main image')->first();

            $images = ShopFiles::Where('parent_code',$item->code)->Where('description','!=','main image')->Where('deleted',0)->get();

            $cargo_company = ShopKeyValue::Where('code',$item->cargo_company)->Where('key','cargo_company')->first();


            return view($this->defaultEditPath,
                            compact('item',
                                    'categories',
                                    'featuresAnswers',
                                    'main_image',
                                    'images',
                                    'cargo_company')
                        );
        }
        return view($this->defaultEditPath);
    }

    public function save(Request $request){
        $getOne = $this->getOneItem('shop_mysql', 'shop_products' ,$request->code, $this->defaultModel);

        $item = $getOne['item'];
        $is_new = $getOne['is_new'];
        $code = $getOne['code'];

        $item->seller_code = '1'; //Anikagai admin sayfasında oluşturuldu
        $item->url = $this->getUrl($request->name);
        $item->name = $request->name;
        $item->price = $request->price;
        $item->priceType = $request->priceType;
        $item->description = $request->description;
        $item->is_trend = $request->is_trend ? 1 : 0;
        $item->is_approved = $is_new ? ($request->has('is_approved') ? 1 : 0) : $item->is_approved;
        $item->is_active = $is_new ? ($request->has('is_active') ? 1 : 0) : $item->is_active;
        $item->cargo_day = $request->cargo_day;
        $item->cargo_company = $request->cargo_company ?? '';
        $item->save();

        ShopCategoryProducts::Where('product_code',$code)->delete();
        if($request->has('selectCategory')){
            foreach($request->selectCategory as $value){
                $pro_cat = new ShopCategoryProducts();
                $pro_cat->product_code = $code;
                $pro_cat->category_code = $value;
                $pro_cat->save();
            }
        }


        ShopProductFeatures::Where('product_code',$code)->delete();
        if($request->has('features')){
            foreach($request->features as $index => $value){
                $pro_fea = new ShopProductFeatures();
                $pro_fea->product_code = $code;
                $pro_fea->feature_code = $index;
                $pro_fea->answer = $value;
                $pro_fea->save();
            }
        }

        if($request->hasFile('main_image')){
            $file = $request->file('main_image');
            $main_path = 'shop_files/products/images';
            $path = public_path($main_path);
            $name = $code . "_main." . $file->getClientOriginalExtension();
            $file->move($path, $name);

            $pro_fal = ShopFiles::Where('parent_code',$code)->Where('description','main image')->first();
            if(!$pro_fal){
                $pro_fal = new ShopFiles();
                $pro_fal->code = $this->generateUniqueCode('shop_mysql','shop_files');
                $pro_fal->parent_code = $code;
            }

            $pro_fal->name = $name;
            $pro_fal->path = $main_path."/" . $name;
            $pro_fal->type = 'img';
            $pro_fal->description = 'main image';
            $pro_fal->create_user_code = Auth::guard('admin')->user()->code;
            $pro_fal->update_user_code = Auth::guard('admin')->user()->code;
            $pro_fal->save();
        }

        if($request->hasFile('images')){
            foreach($request->file('images') as $index => $file){
                $main_path = 'shop_files/products/images';
                $path = public_path($main_path);
                $name = $code . "_image_" . $index . '.' . $file->getClientOriginalExtension();
                $file->move($path, $name);

                $pro_fal_multi = new ShopFiles();
                $pro_fal_multi->code = $this->generateUniqueCode('shop_mysql','shop_files');
                $pro_fal_multi->parent_code = $code;
                $pro_fal_multi->name = $name;
                $pro_fal_multi->path = $main_path."/" . $name;
                $pro_fal_multi->type = 'img';
                $pro_fal_multi->description = 'image';
                $pro_fal_multi->create_user_code = Auth::guard('admin')->user()->code;
                $pro_fal_multi->update_user_code = Auth::guard('admin')->user()->code;
                $pro_fal_multi->save();
            }
        }


        return redirect()->route($this->defaultListRoute)->with('success', $is_new ? 'Yeni ürün eklendi' : 'Ürün güncellendi');

    }

    public function deleteImage(Request $request){
        //$item = ShopFiles::Where('code',$request->code)->Where('parent_code', $request->parent_code)->Where('deleted', 0)->first();
        $item = $this->getOneItem('shop_mysql', 'shop_products' ,$request->code, 'App\Models\Shop\ShopFiles', 0, ['parent_code'=>$request->parent_code])['item'];
        if(!$item){
            return redirect()->back()->with('error','resim silinirken bir hata meydana geldi');
        }

        $item->deleted = 1;
        $item->save();
        return redirect()->back()->with('success','Başarılı bir şekilde resim silindi')->with('select_tab','images-videos-button-id');

    }

    public function delete(Request $request){
        $item = $this->getOneItem('shop_mysql', 'shop_products' ,$request->code, $this->defaultModel,0)['item'];
        if(!$item) return redirect()->route($this->defaultListRoute)->with('error','Ürün silinirken bir hata meydana geldi');

        $item->deleted = 1;
        $item->save();

        return redirect()->route($this->defaultListRoute)->with('success','Ürün Silindi');
    }

    public function changeApproval(Request $request){
        $item = $this->getOneItem('shop_mysql', 'shop_products' ,$request->code, $this->defaultModel,0)['item'];
        if(!$item) return redirect()->route($this->defaultListRoute)->with('error','Ürünün onaylanma durumu değiştirilirken');

        $item->is_approved = $item->is_approved == 1 ? 0 : 1;
        $item->save();
        return redirect()->route($this->defaultListRoute)->with('success','Ürünün onaylanma durumu güncellendi');
    }

    public function changeActive(Request $request){
        $item = $this->getOneItem('shop_mysql', 'shop_products' ,$request->code, $this->defaultModel,0)['item'];
        if(!$item) return redirect()->route($this->defaultListRoute)->with('error','Ürünün onaylanma durumu değiştirilirken');

        $item->is_active = $item->is_active == 1 ? 0 : 1;
        $item->save();
        return redirect()->route($this->defaultListRoute)->with('success','Ürünün onaylanma durumu güncellendi');
    }

    public function getData(Request $request){

        $pagination = [
            'take' => $request->showingCount ? $request->showingCount : Config::get('app.showCount'),
            'page' => $request->page
        ];
        $filters = [];
        if($request->type != "-1"){
            if($request->type=="sale"){

                $filters['is_approved'] = "1";
                $filters['is_active'] = "1";

            }else if($request->type=="unapproved") $filters['is_approved'] = "0";
            else if($request->type=="passive") $filters['is_active'] = "0";
        }

        $result = $this->getDataFromDatabase(['database'=>'shop_mysql', 'model'=>$this->defaultModel, 'filters'=>$filters, 'pagination'=>$pagination]);

        return $result;
    }
}
