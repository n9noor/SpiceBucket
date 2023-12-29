<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorOrderNumber extends Model
{
    use HasFactory;
    protected $table = 'vendor_order_number';
    protected $fillable = [
        'id', 'order_id','created_at','updated_at'
    ];
    
}
