<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderExtraCharges extends Model
{
    use HasFactory;
    protected $table = 'orders_extra_charges';
    protected $fillable = [
        'order_id',
        'vendor_id',
        'shipping_charges',
        'delivery_status_id',
        'delivery_fee',
        'cod_charges',
        'delivery_date',
    ];
}
