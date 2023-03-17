<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;
use App\Models\Company;

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
        $products = \DB::table('products')
        ->select(
            'products.id as products_id',
            'company_id',
            'company_name',
            'product_name',
            'price',
            'stock',
            'comment',
            'img_path',

        )
        ->leftjoin(
            'companies',
            'companies.id', '=', 'products.company_id',
            
        )->get();
        
        return $products;
    }

    public function getDetail($id){
        $products = \DB::table('products')
        ->select(
            'products.id as products_id',
            'company_id',
            'company_name',
            'product_name',
            'price',
            'stock',
            'comment',
            'img_path',

        )
        ->where('products.id',$id)
        ->leftjoin(
            'companies',
            'companies.id', '=', 'products.company_id',
            
        )->first();
        
        return $products;
    }

    public function getCompanyAll(){
        $products = \DB::table('companies')->get();
        return $products;
    }
    
    public function registProduct($data, $path){
        DB::table('products')->insert([
            'company_name' => $data->company_id,
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
        $product = DB::table('products')->where('id', $data->id)->update([
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock, 
            'company_id' => $data->company_id,
            'comment' => $data->comment,
        ]);
        //$product->save();
    }

    public function updateProductImg($data, $path){
        $product = DB::table('products')->where('id', $data->id)->update([
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock, 
            'company_id' => $data->company_id,
            'comment' => $data->comment,
            'img_path' => $path,
        ]);
        //$product->save();
    }

    public function sales(){
        return $this->hasMany(Sale::class);
    }
    public function company(){
        return $this->belongsTo(company::class,  'id', 'company_id');
    }
}
