<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //テーブル名
    protected $table = "products";

    //可変項目
    protected $fillable =
    [
        'image_path',
        'product_name',
        'price',
        'stock', 
        'company_id',
        'comment'
    ];
    
}
