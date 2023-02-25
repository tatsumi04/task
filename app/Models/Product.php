<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'image_path',
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
    
    public function registProduct($data){
        DB::table('products')->insert([
            'company_id' => $data->company_id,
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
        ]);
    }

    public function findId($id){
        $products = DB::table('products')->find($id);
        return $products;
    }

    public function registImg($data){
        DB::table('products')->insert([
            'image_path' => $data->image_path,
        ]);
    }

}
