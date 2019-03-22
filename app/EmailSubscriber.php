<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailSubscriber extends Model
{
    //
    protected $table = 'tbl_subscribe';

    public static function checkEmail($email){
    	return self::select('email')->Where('email', $email)->first();
    }

}
