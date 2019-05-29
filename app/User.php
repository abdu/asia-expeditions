<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // use Notifiable;
    protected $table = 'users';
    private static $instance;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $user = null;
    protected $fillable = [
    
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }
    public function getAllUser(){

        return self::All();    
    }

    public function tour(){
        return $this->hasMany(Tour::class);
    }
        public function country(){
        return $this->belongsTo(Country::class);

    }
          public function province(){
        return $this->belongsTo(Province::class);

    }

    public static function getUser(){

        if (isset($_SESSION['email'])) {
            return self::where('email', $_SESSION['email'] )->first();
        }
        return null;
    }

    public static function getLastId(){       
        $lastId = \DB::table('tbl_invoice')->max('invoice_number');
        return $lastId + 1;
    }

    public function getUserAll(){
        return \DB::table('users');
    }
    
    public function film(){
        return $this->hasMany(Film::class);
    }

    public static function getExitEmail($email){
        return self::select('email')->where('email', $email)->first();
    }
    public static function getIdByEmail($email){
        return self::where('email', $email)->first();
    }
    public static function getpass($email,$pass){
        return self::where(['password_text'=> $pass,'email'=>$email])->first();
    }

}
