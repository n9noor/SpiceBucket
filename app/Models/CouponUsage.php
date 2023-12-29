<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUsage extends Model
{
    use HasFactory;
    protected $table = 'coupon_usage';

    public function coupons(){
        $this->belongsTo(Coupon::class);
    }

    public function customers(){
        $this->belongsTo(Customer::class);
    }
}
