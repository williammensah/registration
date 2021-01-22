<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppSecret extends Model
{
    //
    protected $table = 'app_secret';

    protected $fillable = ['app_id','serial_number','secret'];
    public $timestamps = FALSE;
    public function apps()
    {
        return $this->belongsTo('App\App');
    }
}
