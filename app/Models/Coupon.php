<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Coupon extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ["id"];
    public function coupon_mapping(){
        return $this->hasOne(CouponMapping::class);
    }

    public function coupon_usage(){
        return $this->hasMany(CouponUsage::class);
    }
}
