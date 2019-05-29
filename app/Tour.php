<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
class Tour extends Model
{
    //
    protected $table = 'tours';

    public function supplier(){
        return $this->belongsToMany(Supplier::class, 'tour_suppliers');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsToMany(Category::class, 'category_tours');
    }

    public function country(){ 
        return $this->belongsTo(Country::class);
    }

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public static function getTourAll($cat_id){
    	return $users = \DB::table('tours')
            // ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('category_program_tour as cat', 'tours.id', '=', 'cat.program_tour_id')
            ->where(['cat.category_id'=> $cat_id, 'tours.tour_status'=> 1])
            ->paginate(12);
    }


    public static function getTourByCat($tour_id = 0){
        return $users = \DB::table('tours')
            // ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('category_program_tour as cat', 'tours.tour_id', '=', 'cat.tour')
            ->where(['cat.tour_id'=> $tour_id, 'tours.tour_status'=> 1])->orderBy('id', 'DESC')
            ->take(30);
    }
    public static function getTourBycount(){
        return $data = \DB::table('tbl_countview as v')
                          ->select('t.*',\DB::Raw(' count(v.tour_id) as t'))                                   
                          ->groupBy('v.tour_id')
                          ->join('tours as t', 'v.tour_id', '=', 't.id')
                          ->where(['web'=>1,'tour_status'=>1])
                          ->get();
    }
    public static function getTourByWeek($id=0){
        $today    = date('Y-m-d');
        $day      = date('Y-m-d',strtotime("-7 days"));
        return $data = \DB::table('tbl_countview as v')
                          ->select('t.*',\DB::Raw(' count(v.tour_id) as t,v.date'))                                   
                          ->groupBy('v.tour_id')
                          ->whereBetween('v.created_at', [$day,   $today])
                          ->whereNotIn('t.id',[$id])                         
                          ->join('tours as t', 'v.tour_id', '=', 't.id')
                          ->where(['t.web'=>1,'tour_status'=>1])
                          ->get();
    }
     public static function getTourByUser(){
        return $data = \DB::table('tbl_countview as v')
                          ->select('t.*',\DB::Raw(' count(v.tour_id) as t'))                                   
                          ->groupBy('v.tour_id')
                          ->join('tours as t', 'v.tour_id', '=', 't.id')
                          ->where(['v.user_id'=>\Auth::user()->id,'t.web'=>1,'t.tour_status'=>1])
                          ->get();
    }
}
