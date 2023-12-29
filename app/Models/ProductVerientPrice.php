<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVerientPrice extends Model
{
    use HasFactory;
    protected $table = 'product_variant_price';

    protected $fillable = [
        'product_id','variant_value_id_1','variant_value_id_2','variant_value_id_3','product_mrp','discount_price','discount_percentage','net_price','b2b_price','sku','barcode','net_weight','quantity','mark_as_default','mark_as_default','image_id','created_by','updated_by'
    ];

    public function products(){
        return $this->belongsTo(Product::class);
    }

    public function product_variant_values_1() {
        return $this->belongsTo(ProductVerientValue::class, 'variant_value_id_1');
    }

    public function product_variant_values_2() {
        return $this->belongsTo(ProductVerientValue::class, 'variant_value_id_2');
    }

    public function product_variant_values_3() {
        return $this->belongsTo(ProductVerientValue::class, 'variant_value_id_3');
    }
    public function product_images() {
        return $this->belongsTo(ProductImage::class, 'image_id');
    }
}
