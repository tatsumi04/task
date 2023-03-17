<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\product;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    //use HasFactory;

    protected $fillable = [
        'id',
        'company_name',
        'street_address',
        'representative_name',
    ];

    public function getCompanyList(){
        $companies = DB::table('companies')->get();
        return $companies;
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
