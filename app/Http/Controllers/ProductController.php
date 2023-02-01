<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //商品情報一覧画面を表示
    public function showList(){
        $products = product::all();
        return view('list', ['products' => $products]);
    }

    //商品登録画面を表示
    public function showCommodity(){
        return view('commodity_register');
    }

    //商品登録
    public function exeStore(Request $request){
        //商品情報を受け取る
        $inputs = $request->all();
        $image = $request->file('image_path');
        //dd($image);
        //ブログを登録
        Product::create($inputs);

        if(isset($image)){
            $path = $image->store('images', 'public');
            Product::create([
                'image_path' => $path,
            ]);
        }

       
        \Session::flash('err_msg', '商品を登録しました');
            return redirect(route('commodity'));
    }

    //商品情詳細画面を表示
    public function showDetail($id){
        $product = Product::find($id);
        return view('detail', ['product' => $product]);
    }

    //商品情編集画面を表示
    public function showEdit($id){
        $product = Product::find($id);
        return view('edit', ['product' => $product]);
    }

    //商品情報を更新
    public function exeUpdate(Request $request){
        //ブログデータを受け取る
        $inputs = $request->all();
        
        $product = Product::find($inputs['id']);
        $image = $request->file('image_path');
        $path = $request->image_path;
        if (isset($image)) {
            // 現在の画像ファイルの削除
            \Storage::disk('public')->delete($path);
            // 選択された画像ファイルを保存してパスをセット
            $path = $image->store('images', 'public');
        }

            $product->fill([
                'product_name' =>$inputs['product_name'],
                'price' =>$inputs['price'],
                'stock' =>$inputs['stock'], 
                'company_id' =>$inputs['company_id'],
                'comment' =>$inputs['comment'],
                'image_path' =>$path
            ]);
            $product->save();
        //dd($product);
        \Session::flash('err_msg', 'ブログを更新しました');
            return view('edit', ['product' => $product]);
    }

    //ブログ削除
    public function exeDelete($id){
        $product = Product::destroy($id);

        return redirect(route('list'));
    }

    //検索
    public function exeSerch(Request $request){
        $search = $request->input('search');
        $category = $request->input('makerName-selecter');
        
        if($search){
            $products = Product::where('product_name', 'LIKE' , "%{$search}%")->get()->all();
        }
        if($category != '未選択'){
            $products = Product::where('company_id', 'LIKE' , "%{$category}%")->get()->all();
        }
        if($search && $category != '未選択'){
            $products = Product::whereProduct_name('product_name', 'LIKE' , "%{$search}%")->orWhere('company_id', 'LIKE' , "%{$category}%");
        }

        $params = array('products' => $products, 'search' => $search);
        return view('list',  ['products' => $products]);
    }
}
