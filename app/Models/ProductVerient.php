<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVerient extends Model
{
    use HasFactory;
    protected $table = 'product_variants';

    public function product_variant_values() {
        return $this->hasMany(ProductVerientValue::class);
    }
}
