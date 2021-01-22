<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerApp extends Model
{
    //
    protected $fillable = ['customer_id','app_id'];

     protected $table = 'customers_apps';
    //  protected $casts = [
    //     'id' => 'integer',
    //   ];

    public $timestamps = FALSE;
    public function customers()
    {
        return $this->belongsTo('App\Customer');
    }

    public function apps()
    {
        return $this->belongsTo('App\App');
    }

    public function customers_apps_credentials()
    {
        return $this->hasMany('App\CustomerAppCredential');
    }
  
    public function customers_apps_secrets()
    {
        return $this->hasMany('App\CustomerAppSecret');
    }
  
 
}
