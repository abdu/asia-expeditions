<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    //
    protected $table = 'users';


    public function sentemail(){

    	return $this->hasMany(SentEmail::class);
    	
    }

    public static function emailExit($email){
    	return self::where('email', $email)->first();
    }
}
