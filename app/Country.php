<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = 'country';


    public static function getDestination($type = 1){
 		return self::where([['web','=', $type],['country_status','=', 1]])->get();
    }

    public function tour(){
    	return $this->hasMany(Tour::class);
    }

      public function film(){
        return $this->hasMany(Film::class);
    }

    public function slide(){
        return $this->hasMany(SlideShow::class);
    }

    public static function getCountryTour(){
        return \DB::table("country")
            ->join('tours', 'tours.country_id','=','country.id')
            ->where(['country.country_status'=> 1])
            ->select("country.*")
            ->groupBy('tours.country_id')
            ->orderBy('country.country_name', 'ASC')
            ->get();
    }

}
