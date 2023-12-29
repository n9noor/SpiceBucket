<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVerientValue extends Model
{
    use HasFactory;
    protected $table = 'product_variant_values';

    public function product_variants() {
        return $this->belongsTo(ProductVerient::class);
    }

    public function product_variant_price_1(){
        return $this->hasMany(ProductVerientPrice::class, 'variant_value_id_1');
    }

    public function product_variant_price_2(){
        return $this->hasMany(ProductVerientPrice::class, 'variant_value_id_2');
    }

    public function product_variant_price_3(){
        return $this->hasMany(ProductVerientPrice::class, 'variant_value_id_3');
    }
}
