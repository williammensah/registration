<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
    'surname',
    'othername',
    'sex',
    'email',
    'mobile',
    'city',
    'region'
     ];
    //  public $timestamps = FALSE;
    
    protected $table = 'customers';


    public function users()
    {
        return $this->hasMany('App\User','id');
    }

    public function apps()
    {
        return $this->hasMany('App\App');
    }


    public function customers_apps()
    {
        return $this->hasMany('App\CustomerApp');
    }
  
  
}
