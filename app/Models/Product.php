<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function product_images(){
        return $this->hasMany(ProductImage::class);
    }

    public function product_variant_price(){
        return $this->hasMany(ProductVerientPrice::class);
    }

    public function vendors(){
        return $this->belongsTo(Vendor::class,'vendor_id');
    }

    public function product_category(){
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function product_sub_category(){
        return $this->belongsTo(ProductCategory::class, 'sub_category_id');
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class);
    }
    public function product_variant_value()
{
    return $this->hasManyThrough(ProductVerientValue::class,ProductVerientPrice::class,'product_id',
        'variant_id','id','id');
}

}
