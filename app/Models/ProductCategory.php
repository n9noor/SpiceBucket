<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_category';

    public function vendors(){
        return $this->belongsTo(Vendor::class);
    }

    public function product_category(){
        return $this->hasMany(Product::class, 'category_id');
    }

    public function product_sub_category(){
        return $this->hasMany(Product::class, 'sub_category_id');
    }
}
