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
        'image_file_name',
        'title',
        'price',
        'inventory', 
        'maker_name',
        'comment'
    ];
    
}
