<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'vendor_id',
        'product_id',
        'product_variant_price_id',
        'billing_customer_address_id',
        'shipping_customer_address_id',
        'product_qunatity',
        'product_price',
        'gst_on_product_price',
        'total_product_price',
        'created_at',
        'updated_at',
        'shipping_label',
        'shipping_length',
        'shipping_width',
        'shipping_height',
        'shipping_weight',
        'shipping_agency',
        'shipping_service',
        'shipping_carrier_name',
        'shipping_tracking_no',
        'shipping_date',
        'shipping_tracking_url',
        'order_status',
        'invoice_number',
        'vendor_order_id',
    ];
        public function vendor()
        {
            return $this->belongsTo(Vendor::class, 'vendor_id');
        }

        public function product()
        {
            return $this->belongsTo(Product::class, 'product_id');
        }

        public function billingCustomerAddress()
        {
            return $this->belongsTo(CustomerAddress::class, 'billing_customer_address_id');
        }
        public function shippingCustomerAddress()
        {
            return $this->belongsTo(CustomerAddress::class, 'shipping_customer_address_id');
        }
        public function productvariantPrice()
        {
            return $this->belongsTo(ProductVerientPrice::class, 'product_variant_price_id');
        }
}

