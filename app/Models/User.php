<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;        
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guarded=[
        'id'
    ];

    protected $fillable=[
        'emailid',
        'role_id',
        'firstname'
    ];

    /*
    * Foreign Key working
    */
    public function roles(){
        return $this->belongsTo(Role::class);
    }
}
