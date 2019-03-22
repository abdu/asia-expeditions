<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'customer';

    public static function getExitEmail($email){
        return self::select('email')->Where('email', $email)->first();
    }
   	
}
