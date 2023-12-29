<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardDetail extends Model
{
    use HasFactory;
    protected $table = 'card_details';
    protected $fillable = [
        'customer_id','card_number','cardholder_name','expiration_month','expiration_year'
];

}
