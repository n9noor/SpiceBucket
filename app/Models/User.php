<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $guarded=[
        'id'
    ];

    protected $fillable=[
        'emailid',
        'role_id',
        'firstname'
    ];
}
