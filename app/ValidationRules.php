<?php

namespace App;


class ValidationRules
{

    /**
     * Rules for Validating requests
     */

    
    public $customer = [
    'surname' =>'required',
    'othername'=>'required',
    'sex'=>'required',
    'email'=>'required',
    'mobile'=>'required',
    'city'=>'required',
  ];
}
