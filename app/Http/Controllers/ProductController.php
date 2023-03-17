<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //商品情報一覧画面を表示
    public function showList(){
        $model = new Product();
        $products = $model->getList();

        return view('list', ['products' => $products]);
    }

    //商品登録画面を表示
    public function showCommodity(){
        $company = new Company();        
        $companies = $company->getCompanyList();
 
        return view('commodity_register', ['companies' => $companies]);
    }


    //商品登録
    public function exeStore(ProductRequest $request){
        //DB::beginTransaction();
        //try{
            //商品情報を受け取る
            // dd("aaa");
            $model = new Product(); 
            //$inputs = $model->getList();             
            $image = $request->file('img_path');            
            //dd($image);
            //商品を登録
            if($image){
                $path = $image->store('images', 'public');
                $model->registProduct($request ,$path);
                
            }
        //      DB::commit();
        //  }catch (\Exception $e) {
        //      DB::rollback();
        //      return back();
        //  }
         \Session::flash('err_msg', '商品を登録しました');
            return redirect(route('commodity'));
    }

    //商品情詳細画面を表示
    public function showDetail($id){
        $model = new Product();
        $product = $model->getDetail($id);

        return view('detail', ['product' => $product]);
    }

    //商品情編集画面を表示
    public function showEdit($id){
        $model = new Product();
        $product = $model->getDetail($id);
        $company = $model->getCompanyAll();

        return view('edit', ['product' => $product, 'companies' => $company]);
    }

    //商品情報を更新
    public function exeUpdate(ProductRequest $request){
        //DB::beginTransaction();
        //try{
            //商品データを受け取る
            $model = new Product();
            $product = $model->getDetail($request->id);
            $company = $model->getCompanyAll();

            //$product = Product::where('id', $request->id)->get();
            $image = $request->file('img_path');
            $path = $request->img_path;

            //dd($product);
            $model->updateProduct($request);
            
            if (isset($image)) {
                // 現在の画像ファイルの削除
                \Storage::disk('public')->delete($path);
                // 選択された画像ファイルを保存してパスをセット
                $path = $image->store('images', 'public');

                $model->updateProductImg($request, $path);
            }
        //     DB::commit();
        // }catch (\Exception $e) {
        //     DB::rollback();
        //     return back();
        // }
        
        \Session::flash('err_msg', 'ブログを更新しました');
            return view('edit', ['product' => $product, 'companies' => $company]);
    }

    //商品情報削除
    public function exeDelete($id){
        try{
            $product = Product::destroy($id);
        }catch (\Exception $e) {
            DB::rollback();
            return back();
        }
        

        return redirect(route('list'));
    }

    //検索
    public function exeSerch(Request $request){
        $search = $request->input('search');
        $category = $request->input('makerName-selecter');
        
        if($search && $category == '未選択'){
            $products = Product::where('product_name', 'LIKE' , "%{$search}%")->get()->all();
        }else if(!$search && $category != '未選択'){
            $products = Product::where('company_id', 'LIKE' , "%{$category}%")->get()->all();
        }else if($search && $category != '未選択'){
            $products = Product::where('product_name', 'LIKE' , "%{$search}%")->Where('company_id', 'LIKE' , "%{$category}%")->get()->all();
        }else if(!$search && $category == '未選択'){
            return redirect(route('list'));
        }

        $params = array('products' => $products,);
        return view('list',  ['products' => $products]);
    }
}
