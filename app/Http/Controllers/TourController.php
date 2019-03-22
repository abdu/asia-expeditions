<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tour;
use App\Mail\SendingEmail;
use App\Province;
use App\Country;
use App\HolidayType;
use App\Category;
use Illuminate\Support\Facades\Mail;;
 
class TourController extends Controller
{
    //
    public function tourDetails($tour_slug){
        $tour = Tour::where(['slug' => $tour_slug, 'web'=>1])->first();
        $tourLink = Tour::where(['tour_type'=>$tour->tour_type, 'web'=>1, 'post_type'=> 0, 'province_id'=>$tour->province_id])
                    ->whereNotIn('id', [$tour->id])
                    ->orderBy('tour_name', 'ASC')->take(30)->get();
        $getHotel = $tour->supplier;
        return view("tour.index", compact('tour', 'tourLink', 'getHotel'));
    }

    

    public function mailto(Request $request){
    	$tour = Tour::find($request->id);
    	Mail::to($request->emailto)->cc(config('app.email'))->send(new SendingEmail($tour));
        return back()->with('message-email', "Your program ".$request->tourName." has been sent to ".$request->emailto."");
    }

    public function getTest(){
    	$tour = $this->tour->take(30)->get();
    	return view("tour.test",['tour' => $tour]);
    }

    public function getSearchcity(Request $req){
    	$search = $req->sc != '' ? trim($req->sc) : null;
    	$pro = \DB::table('province')
            ->join('country', 'province.country_id', '=', 'country.id')
            ->select( 'province.province_name', 'country.country_name')
            ->where([['province.web','=', 1],['province.province_status','=',1],['province.province_name', 'LIKE', '%'.$search.'%']])
            ->orWhere('country.country_name', 'LIKE', '%'.$search.'%')
            ->get();
        $output = '';
        if ($pro) {
        	foreach ($pro as $key => $data) {	        	
	        	$output.='<li class="list-group-item" onclick="loadData(\''.$data->province_name.'\', \''.$data->country_name.'\')"><span style="cursor:pointer;">'.$data->province_name.'<b> '.$data->country_name.'</b></span></li>';
	        }
	        return Response($output);
        }else{
        	return json(['no' => 'Not found']);
        }
    }
    public function getTour(Request $req){
        $data = explode(',', $req->sc);
        $pro = Province::where('province_name', $data[0])->first();
        if (!isset($data[1]) ) {
            if (!isset($pro->province_country)) {
                $pro_con = 0;
            }else{
                $pro_con = $pro->province_country;
            }
            $coName  = Country::find($pro_con);
            $conN  = $coName['country_name'];
        }else{
            $conN = $data[1];
        }
        
        $count = Country::where('country_name', $conN)->first();
        $type = HolidayType::find($req->type);
        $tour = Tour::Where(['tour_type'=> $req->type, 'web'=>1, 'province_id'=> $pro->id, 'country_id'=> $count->id])->orderBy('tour_name', 'ASC')->paginate(30);
        if (!isset($data[1]) && !isset($data[1]) ) {

            $tour = Tour::Where(['post_type'=> 0, 'tour_type'=> $req->type, 'web'=>1])->orderBy('tour_name', 'ASC')->paginate(30);
            return view("search.search_result", ['tours'=> $tour, 'country'=> $count->country_name, 'province'=> $pro->province_name, 'type'=> $type->business_name]);
        }else{

            return view("search.search_result", ['tours' => $tour, 'country' => $count['country_name'], 'province' => $pro['province_name'], 'type' => $type['business_name']]);
        }
    }

    public function getTourName(Request $req){

        $tour = Tour::Where([['tour_name', 'LIKE', '%'.$req->tour_name.'%'], ['web','=', 1], ['post_type','=', 0]])->take(12)->orderBy('tour_name', 'ASC')->paginate();
        return view('search.search_tour', ['tours' => $tour, 'result' => $req->tour_name]);

    }   
}

