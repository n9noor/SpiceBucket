<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;
    protected $table = 'customer_address';
    protected $fillable = ['customer_id','address_type','firstname','lastname','phonenumber','emailid','address_line_1','address_line_2','address_line_3','city','state','pincode','lat','long','country','addition_information','companyname','is_active','created_by','updated_by'
];

    public function customers(){
        return $this->belongsTo(Customer::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
