<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_datetime','orderid','customer_id','payment_amount','gst_on_amount','cod_charges','discount','delivery_fee','total_amount','payment_status','payment_source','order_status','payment_api_response','created_at','updated_at','tentative_dispatch_date','tentative_delivery_date','admin_remarks'
   
];
     public function customers(){
        return $this->belongsTo(Customer::class);
    }

    public function customer_address(){
        return $this->belongsTo(CustomerAddress::class);
    }

    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }
}
