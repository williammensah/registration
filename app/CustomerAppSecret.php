<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerAppSecret extends Model
{
    //
    protected $fillable = ['customer_app_id','serial_number','secret'];
   
     protected $table = 'customer_app_secret';
    public $timestamps = FALSE;

    public function customers_apps()
    {
        return $this->belongsTo('App\CustomerApp');
    }
}
