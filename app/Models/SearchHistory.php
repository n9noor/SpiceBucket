<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
     
    protected $table = 'search_histories';
    // public $timestamps = false;
    // protected $dateFormat = 'U';
    protected $guarded = ['id'];
 
}
