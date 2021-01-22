<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function customers()
    {
        return $this->belongsTo('App\Customer','id');
    }
    protected $table ='users';
    
    // public $timestamps = FALSE;
    const VERIFIED_USER ='1';
    const UNVERIFIED_USER ='0';

    protected $fillable = [
        'name', 'email', 
        'password',
        'customer_id',
        'verified',
        'verification_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','verification_token'
    ];

    public function scopeMightAlsoLike($query)
    {
        # code...
        return $query->inRandomOrder()->take(4);
    }
    
   
     //static method to generate verification code
    public static function generateVerificationCode()
       {
       return str_random(48);
      }
      public static function username(){
  
      $username  = Customer::distinct()->with('users')->where('id',Auth::user()->customer_id)->pluck('surname')->first();
      
      return $username;
  
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
