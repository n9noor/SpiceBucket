<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceNumber extends Model
{
    use HasFactory;
    protected $table = 'invoice_numbers';
    protected $fillable = [
        'id', 'order_id','created_at','updated_at'
    ];
     
}
