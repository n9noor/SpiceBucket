<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $guarded=[
        'id'
    ];

    protected $fillable=[
        'responsible_person','store_name','vendor_alias','business_emailid','password','phone','gst','lat','long','token_id','address','document','is_active','is_approved','verified','created_by','updated_by','decline_comment','shipping_pincode','shipping_state','shipping_country','image','slug','qac_user_id','vendor_slider_image','vendor_offer_image_1','vendor_offer_image_2','vendor_offer_image_3','tab_category'
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function product_category() {
        return $this->hasMany(ProductCategory::class);
    }
}
