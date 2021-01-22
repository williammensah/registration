<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Descriptor\ApplicationDescription;

class CustomerAppCredential extends Model
{
    //
    // protected $casts = ['id' => 'integer'];
    protected $fillable = ['customer_app_id','client_id','activation_count','secret'];
    
    public $timestamps = FALSE;
    protected $table = 'customer_app_credentials';

    public function apps()
    {
        return $this->belongsToMany('App\App');
    }
    public function customers_apps()
    {
        return $this->belongsToMany('App\CustomerApp');
    }

  

}
