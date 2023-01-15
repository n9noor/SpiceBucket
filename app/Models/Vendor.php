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
        'shop_name',
        'owner_name',
        'email',
        'password'
    ];
}
