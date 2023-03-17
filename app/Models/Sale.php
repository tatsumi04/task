<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\product;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
