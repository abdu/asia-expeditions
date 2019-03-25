<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $table = 'province';

    public function sentemail(){
    	return $this->hasMany('App\SentEmail', 'province_id');
    }

      public function tour(){
    	return $this->hasMany(Tour::class);
    }
      public function film(){
    	return $this->hasMany(Film::class);
    }

}
