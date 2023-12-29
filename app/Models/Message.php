<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = "messages";
    protected $guarded=[
        'id'
    ];


    // return  here detail of mail 
    static public function GetSmsDetail($id)
    {
        return self::find($id);

    }
      
}
