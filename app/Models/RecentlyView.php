<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentlyView extends Model
{
    use HasFactory;
    protected $table = 'recently_view';
    protected $fillable = [
        'product_id','customer_id','updated_at'
];

public function products(){
    $this->belongsTo(Product::class,'product_id');
}
}
