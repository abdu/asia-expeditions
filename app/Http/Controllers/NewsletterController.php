<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\EmailSubscriber;

use App\SendingEmail;
use App\Admin;
use App\Tour;
use App\Mail\Subscriber;
use App\Mail\sendTemplate;
use App\SentEmail;
use Illuminate\Support\Facades\Mail;
class NewsletterController extends Controller
{
 
    public function getViewDashboard(){
        return view('admin.index');
    }

    public function getEmailList(){
        $emails = EmailSubscriber::orderBy('id', 'DESC')->get();
        return view('admin.subscribe.emailList', compact('emails'));
    }

    public function getSentEmailList(){
        $sentEmail = SentEmail::orderBy('id', 'DESC')->get();
        return view('admin.subscribe.sentEmailList', compact('sentEmail'));
    }

    public function getEmailtemplate(Request $req){
        if (isset($req->country_sort)) {
            $tours = Tour::where(['country_id'=>$req->country_sort, 'tour_status'=>1, 'web'=>1])->get();
        }else{
            $tours = Tour::where(['tour_status'=>1, 'web'=>1])->get();
        }                   
        return view('admin.subscribe.emailtemplate', compact('tours'));
    }

    public function sendEmail(Request $req){

        $allEmail = explode(',', $req->email);
        Mail::bcc($allEmail)->send(new SendTemplate($req->all()));
        $sentem = new SentEmail;
        $sentem->email = $req->email;
        $sentem->user_id = \Auth::user()->id;
        $sentem->destination_id = $req->country;
        $sentem->save();
        return back()->with('submessage', 'Your template has been sent');
    }

    public function getEmailSubscribe(Request $req)
    {
        if (!EmailSubscriber::checkEmail($req->email)) {
            $ip= \Request::ip();
            $data = \Location::get($ip);            
            $nmail = new EmailSubscriber;
            $nmail->email = $req->email;
            $nmail->ip = $ip;
            $nmail->countryName = $data->countryName;
            $nmail->countryCode = $data->countryCode;
            $nmail->regionCode = $data->regionCode;
            $nmail->regionName = $data->regionName;
            $nmail->cityName = $data->cityName;
            $nmail->zipCode = $data->zipCode;
            $nmail->isoCode = $data->isoCode;
            $nmail->postalCode = $data->postalCode;
            $nmail->latitude = $data->latitude;
            $nmail->longitude = $data->longitude;
            $nmail->metroCode = $data->metroCode;
            $nmail->areaCode = $data->areaCode;
            $nmail->status = 1;
            $nmail->save();
            Mail::to($req->email)->send(new Subscriber());
            return back()->with(['submessage'=> 'Your email has been subsrcribe with us! Thanks you for join with us ', 'get'=>'success']);            
        } else {
            return back()->with(['submessage'=> 'Your email already subscribed','get'=>'warning']);
        }
    }

    public function getNewsletter()
    {
        return view('emails.newsletter');
    }

    // search email for sent template to clients\
    public function getsearchMailsubscribe(Request $req){
        // return $req->mail;
        $search = $req->mail != '' ? trim($req->mail) : null;
        $email = EmailSubscriber::select('id', 'email')->where("email", "LIKE", "%".$search."%")->get();
        $output =''; 
        if ($email) {
            foreach ($email as $key => $val) {
                $output .= '<a href="javascript:void(0)" class="list-group-item item-mail" data-image="'.$val->email.'">'.$val->email.'</a>';
            }
            return Response($output);
        }else{
            return response()->json(['status', 0]);
        }

    }
}
