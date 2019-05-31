<?php

namespace App\Http\Controllers;
use App\Cart;
use Illuminate\Http\Request;
use App\User;
use App\ProgramTour;

use Validator;
use App\ItemOrder;
use Illuminate\Support\Facades\Auth;

use App\Customer;
use App\Invoice;

class CustomerController extends Controller
{
    public function getAccount(){
        return view('customer.index');
    }

    public function doAccount(Request $req){
        // return $req->all();
        $cusA              = User::find($req->id);
        $cusA->name        = $req->first_name;
        $cusA->last        = $req->last_name;
        $cusA->fullname    = $req->first_name." ".$req->last_name;
        $cusA->nationality = $req->nation;
        $cusA->passport    = $req->passport_number;
        $cusA->expiry_date = $req->expiry_date;              
        $cusA->address     = $req->address_street;
        $cusA->province_id = $req->town_city;
        $cusA->country_id  = $req->country_state;
        $cusA->postal      = $req->zip_code;
        $cusA->phone       = $req->phone_number;
        $cusA->email       = $req->email;  
        $cusA->created_at  = date('Y-m-d');
        $cusA->updated_at  = date('Y-m-d');
        $cusA->save();
        return back()->with(['message'=> 'you has been update profile','get'=>'success']);;
    }

    public function doCreateNewPassword(Request $req){
        $validator = Validator::make($req->all(), [
            'new_password'    =>  'required|min:6',
            're_new_password' =>  'required|min:6|same:new_password',           
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with(['message'=> 'incorrect your Re-New Password','get'=>'warning']);
        }else{
            $nd = Customer::Where('email', $req->email)->first();
            $nd->password       = encrypt($req->new_password);
            $nd->password_text  = $req->new_password;
            $nd->save();
            return back()->with(['message'=> 'you has been update password','get'=>'success']);
        }
    }
    public function showlogin($get){
        return view('customer.set_password', compact('get'));

    }
    public function do_set_login(Request $req){
        if (!User::getpass($req->email,$req->new_password)) {
            $validator = Validator::make($req->all(), [
                'email'        => 'required|email',
                'new_password' => 'required|min:6',
                're_password'  => 'required_with:new_password|same:new_password|min:6'
            ]);        
            if(!$validator->fails()){
                $add                 = User::Where('email', $req->email)->first();
                $add->password       = bcrypt($req->new_password);
                $add->password_text  = $req->new_password;
                $add->remember_token = $req->_token;
                $add->save();
                    if (\Auth::attempt(['email'=>$req->email, 'password'=>$req->new_password, 'banned'=>0])) {
                        return redirect()->intended('/');
                    }

            }else{
                return back()->withInput()->with(["message"=> "incorrect your confirm password",'get'=>'warning']);
            }
        }
        return back()->withInput()->with(["message"=>"your user already",'get'=>'warning']);

    }

    public function getLogout(){
        // session_destroy();
        \Auth::logout();
        return back();
    }

  
}
