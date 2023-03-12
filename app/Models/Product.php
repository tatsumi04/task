<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id',
        'img_path',
        'product_name',
        'price',
        'stock', 
        'company_id',
        'comment'
    ];

    public function getList(){
        $products = DB::table('products')->get();
        return $products;
    }
    
    public function registProduct($data, $path){
        DB::table('products')->insert([
            'company_id' => $data->company_id,
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $path,
        ]);
    }

    public function findId($id){
        $products = DB::table('products')->find($id);
        return $products;
    }

    public function updateProduct($data){
        $product = DB::table('products')->update([
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock, 
            'company_id' => $data->company_id,
            'comment' => $data->comment,
        ]);
        //$product->save();
    }

    public function updateProductImg($data, $path){
        $product = DB::table('products')->update([
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock, 
            'company_id' => $data->company_id,
            'comment' => $data->comment,
            'img_path' => $path,
        ]);
        //$product->save();
    }
}
