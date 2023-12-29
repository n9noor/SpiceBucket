<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;        
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;



class Customer extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guard = 'api';

    protected $fillable = [
        'name',
        'image',
        'emailid',
        'google_id',
        'facebook_id'
    ];
     protected $hidden = [
        'password',
        'remember_token',
    ];
    public function customer_address(){
        return $this->hasMany(CustomerAddress::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function findForPassport($username) {
     return $this->whereEmailid($username)->first();
    }
    // protected function guard()
    // {
    //     return Auth::guard('customers');
    // }

    public function getImageAttribute($value)
    {
        if(!empty($value)){

         return  url('/public/images/customer_profile/'.$this->name.'/'.$value);
        }else{
            return  url('/public/images/no-image-available.jpg');            
        }
        
    }
}
