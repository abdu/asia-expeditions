<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Film;
use App\Tour;

class FilmController extends Controller
{
    //
    public function filmList(Request $req){
        $conId = isset($req->loc) ? $req->loc : \Auth::user()->country_id;
    	$data=Film::where(['country_id'=> $conId])->get();
    	return view('admin.film.film_list', compact('data','conId','proId'));
    }
      public function filmForm(Request $req){
      	 $tour  = Film::find($req->eid);
      	$conId = isset($tour->country_id) ? $tour->country_id : \Auth::user()->country_id;
        $proId = isset($tour->province_id) ? $tour->province_id : \Auth::user()->province_id;
      	return view('admin.film.film_form', compact('tour','proId','conId'));

    }
      public function filmCreate(Request $req){
      	  $gallery = '';
          $type    ='';
        if ($req->gallery) {
            foreach ($req->gallery as $key => $img) {
                $gallery .= $img."|";
            }
        }
        if ($req->keyVideo) {
            $type=1; 
        }else{$type=0;}
      	
        if (isset($req->eid) && !empty($req->eid)) {
            $aFilm = Film::find($req->eid);
            $message = 'Film Successfully Updated';
        }else{
            $aFilm = new Film;    
            $message = 'Film  Successfully Added';
        }
        $aFilm->title = $req->title;
        $aFilm->slug = str_slug($req->title,'-');
        $aFilm->country_id = $req->country;
        $aFilm->province_id = $req->province;
        $aFilm->desc = $req->tour_desc;
        $aFilm->photo = $req->image;
        $aFilm->gallery = $gallery;
        $aFilm->video = $req->keyVideo;
        $aFilm->user_id = \Auth::user()->id;
        $aFilm->status = 1;
        $aFilm->type = $type;
        
        if($aFilm->save()){
            return redirect()->route("filmList")->with(['message'=> $message]);
        }

    }


}
