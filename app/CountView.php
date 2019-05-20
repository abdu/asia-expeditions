<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountView extends Model
{
      protected $table = 'tbl_countview';

       public static function Getdate($getde, $ip, $tour_id){
       return self::where(['created_at'=> $getde, 'ip'=> $ip, 'tour_id'=> $tour_id])->first();
    }

    public function tour(){
    	return $this->belongsTo(Tour::class);
    } 
           
    public function user(){
    	return $this->belongsTo(User::class);
    }



    public static  function getcount_tour(){
         $data = \DB::table('tbl_countview as v')
    ->select(\DB::Raw('t.tour_name, count(*) as total, v.tour_id as tour_id, u.fullname'))
    ->groupBy(\DB::raw('(v.tour_id),(t.tour_name),(u.fullname)'))
    ->join('tours as t', 'v.tour_id', '=', 't.id')
    ->join('users as u', 'v.user_id', '=', 'u.id')
    ->get();
       return $data;
    }
}
