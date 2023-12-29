<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponMapping extends Model
{
    use HasFactory;
    protected $table = 'coupon_mapping';

    public function coupons(){
        $this->belongsTo(Coupon::class);
    }

    public function customers(){
        $this->belongsTo(Customer::class);
    }

    public function products(){
        $this->belongsTo(Product::class);
    }

    public function product_category(){
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function product_sub_category(){
        return $this->belongsTo(ProductCategory::class, 'sub_category_id');
    }

    public function vendors(){
        return $this->belongsTo(Vendor::class);
    }

}
