<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tour;
use App\Mail\SendingEmail;
use App\Province;
use App\Country;
use App\HolidayType;
use App\Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInquiry;
use App\CountView;
use App\User;
use App\ItemOrder;
 
class TourController extends Controller
{
    //
    public function tourDetails($tour_slug){
        $tour     = Tour::where(['slug' => $tour_slug, 'web'=>1])->first();
        $tourLink = Tour::where(['tour_type'=>$tour->tour_type, 'web'=>1, 'post_type'=> 0, 'province_id'=>$tour->province_id])
                    ->whereNotIn('id', [$tour->id])
                    ->orderBy('tour_name', 'ASC')->take(30)->get();
        $getHotel = $tour->supplier;
        $ip       = \Request::ip(); 
        $today    = date('Y-m-d 00:00:00');
             if ( !CountView::Getdate($today, $ip , $tour->id)) {
                $adds                 = new CountView;
                $adds->ip             = $ip;                       
                $adds->tour_id        = $tour->id;
                $adds->user_id        = \Auth::id();
                $adds->save();   
            }

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
        $pro  = Province::where('province_name', $data[0])->first();
        if (!isset($data[1]) ) {
            if (!isset($pro->province_country)) {
                $pro_con = 0;
            }else{
                $pro_con = $pro->province_country;
            }
            $coName   = Country::find($pro_con);
            $conN     = $coName['country_name'];
        }else{
            $conN     = $data[1];
        }
        
        $count  = Country::where('country_name', $conN)->first();
        $type   = HolidayType::find($req->type);
        $tour   = Tour::Where(['tour_type'=> $req->type, 'web'=>1, 'province_id'=> $pro->id, 'country_id'=> $count->id])->orderBy('tour_name', 'ASC')->paginate(30);
        if (!isset($data[1]) && !isset($data[1]) ) {

            $tour = Tour::Where(['post_type'=> 0, 'tour_type'=> $req->type, 'web'=>1])->orderBy('tour_name', 'ASC')->paginate(30);
            return view("search.search_result", ['tours'=> $tour, 'country'=> $count->country_name, 'province'=> $pro->province_name, 'type'=> $type->business_name]);
        }else{

            return view("search.search_result", ['tours' => $tour, 'country' => $count['country_name'], 'province' => $pro['province_name'], 'type' => $type['business_name']]);
        }
    }

    public function getTourName(Request $req){
        $tour = Tour::Where([['tour_name', 'LIKE', '%'.$req->tour_name.'%'], ['web','=', 1]])
                    // ->take(12)
                    ->orderBy('tour_name', 'ASC')
                    ->paginate(12);
        return view('search.search_tour', ['tours' => $tour, 'result' => $req->tour_name]);

    }
    public function get_Tour_user(Request $req){
        if (!User::getExitEmail($req->email)) {
            $adds              = new User;
            $adds->name        = $req->fname;
            $adds->last        = $req->lname;
            $adds->fullname    = $req->fname .' '. $req->lname;
            $adds->email       = $req->email; 
            $adds->phone       = $req->mobile;
            $adds->role_id     = 7;
            $adds->picture     = 'no_image.png';
            $adds->nationality = $req->nationality;        
                if($adds->save()){
                 $add_item              = new ItemOrder;
                 $add_item->item_id     = $req->tour_id;
                 $add_item->customer_id = $adds->id;
                 $add_item->price       = $req->tour_price;
                 $add_item->fdate       = $req->fdate;
                 $add_item->tdate       = $req->tdate;
                 $add_item->a_requests  = $req->textarea;
                 $add_item->save(); 
                 Mail::to($req->email)->bcc(config('app.email'))->send(new SendInquiry($req->all()));       
                }                              
        return back()->with(["message"=> "Send Inquiry Success", 'get'=>'success']);

        }
            $add_item              = new ItemOrder;
            $add_item->item_id     = $req->tour_id;
            $add_item->customer_id = User::getIdByEmail($req->email)->id;
            $add_item->price       = $req->tour_price;
            $add_item->fdate       = $req->fdate;
            $add_item->tdate       = $req->tdate;
            $add_item->a_requests  = $req->textarea;
            $add_item->save();
            Mail::to($req->email)->bcc(config('app.email'))->send(new SendInquiry($req->all()));
            
        return back()->with(["message"=> "Send Inquiry Success", 'get'=>'success']);


       


    } 
}

