<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tour;
use App\Country;
use App\Province;
use App\OurTeam;
use App\OurNews;
use App\Mail\ContactUs;
use App\Country_facts;

use App\Mail\ResetPassword;
use Carbon\Carbon;
use Validator;

use App\Setting; 
use App\Film;   

use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    //
    private $country = '';

    public function __construct(Country $country)
    {
        return $this->country = $country;
    }

    public function index(Request $request)
    {
        
        return view("index");
    }

    public function show(Request $request, $desName)
    {
         $coun = Country::where('country_slug', $desName)->first();
        return view('destination.index', compact('coun'));
    }

    public function getMice()
    {
        return view("mice.index");
    }

    public function getmiceName($Name){
        $mice = Setting::where('slug', $Name)->first();
        return view('mice.miceName', compact('mice'));
    }

    public function ourteam()
    {
        $team = User::where('web', 1)->get();
        return view('ourteam.index', ['ourteam' => $team]);
    }

    public function teamDetail($teamid)
    {
        $team = User::where('fullname', $teamid)->first();
        return view('ourteam.team_details', ['team' => $team]);
    }

    public function showProvince($country, $province)
    {
        
        $coun = Country::where('country_slug', $country)->first();
        $pro = Province::where('slug', $province)->first();
        $getTourByProvince = \App\Tour::where(['province_id'=> $pro->id, 'web'=>1, 'post_type'=>0])->orderBy('tour_name', 'ASC')->get();
        return view('destination.destination_tour', ['count'=> $coun, 'pro'=> $pro, 'getTourByProvince'=>$getTourByProvince]);
    }

    public function contactUs()
    {
        return view('contactus.form');
    }

    public function sendContactus(Request $req)
    {
        $data = ['fullname' => $req->fullname,
                'phone' => $req->phone,
                'email' => $req->email,
                'message' => $req->message ];
        Mail::to(config('app.email'))->send(new ContactUs($data));
        return back()->with('message', 'You message has been sent! We will contact you back in shortly !');
    }

    public function ournew()
    {
        $news = Tour::where(['post_type'=> 1, 'web'=>1])
            ->orderBy('id', 'desc')->paginate(12);
        return view('ournew.index')->with(['news' => $news]);
    }

    public function newsDetail($title)
    {
        $news = Tour::where('slug', $title)->first();
        return view('ournew.news_details')->with(['news' => $news]);
    }

    public function testSlide()
    {
        $tour = Tour::where('web', 1)
            ->orderBy('tour_id', 'desc')->paginate(8);
        return view('tour.testSlide', ['tours' => $tour]);
    }

    public function getInformation()
    {
        return view('destination.information');
    }

    public function getSiteMape()
    {
        return view('destination.sitemap');
    }

    public function getForgot()
    {
        return view('newsletter.getFogort');
    }
    public function getFilm($location){

        
        $con = Country::where('country_slug', $location)->first();
        return view('film.film_list', compact('con'));
    }
    public function film_detail($getdata){

        $data=Film::where('slug',$getdata)->first();
        return view('film.film_detail', compact('con','data'));
    }
    
    public function doForgot(Request $req)
    {
        $customer = User::where('email', $req->email)->first();
        if ($customer) {
            Mail::to($req->email)->send(new ResetPassword());
            return back()->with('sucess', 'Please check your email address');
        } else {
            return back()->with('warn', 'Your email not found ');
        }
    }

    public function getCreateNewPassword(Request $req)
    {
        return view('newsletter.Create_new_password');
    }

    public function doCreateNewPassword(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'new_password' => 'required|min:6',
            're_new_password' => 'required|min:6|same:new_password',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $nd = User::Where('email', decrypt($req->email))->first();
            $nd->password = encrypt($req->new_password);
            if ($nd->save()) {
                return back()->with('message', 'you has been update password');
            }
        }

    }
}
