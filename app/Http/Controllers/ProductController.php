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
        $image = $request->file('image_file_name');
        //dd($image);
        //ブログを登録
        Product::create($inputs);

        if(isset($image)){
            $path = $image->store('images', 'public');
            Product::create([
                'image_file_name' => $path,
            ]);        }

       
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
            $product->fill([
                'title' =>$inputs['title'],
                'price' =>$inputs['price'],
                'inventory' =>$inputs['inventory'], 
                'maker_name' =>$inputs['maker_name'],
                'comment' =>$inputs['comment']
            ]);
            $product->save();
        
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
            $products = Product::where('title', 'LIKE' , "%{$search}%")->get()->all();
        }
        if($category){
            $products = Product::where('maker_name', 'LIKE' , "%{$category}%")->get()->all();
        }



        $params = array('products' => $products, 'search' => $search);
        return view('list',  ['products' => $products]);
    }
}
