<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;
    protected $table = "mails";
    protected $guarded=[
        'id'
    ];


    // return  here detail of mail 
  static public function GetMailDetail($id)
    {
        return self::find($id);

    }
      
}
