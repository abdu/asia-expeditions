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
        $cusA = Customer::Where('id', $req->id)->first();
        $cusA->first_name = $req->first_name;
        $cusA->middle_name = $req->middle_name;
        $cusA->last_name = $req->last_name;
        $cusA->nation = $req->nation;
        $cusA->passport_number = $req->passport_number;
        $cusA->email = $req->email;
        $cusA->phone_number = $req->phone_number;
        $cusA->expiry_date = $req->expiry_date;
        $cusA->address_street = $req->address_street;
        $cusA->town_city = $req->town_city;
        $cusA->country_state = $req->country_state;
        $cusA->zip_code = $req->zip_code;
        $cusA->created_at = date('Y-m-d');
        $cusA->updated_at = date('Y-m-d');
        $cusA->save();
        return back();
    }

    public function doCreateNewPassword(Request $req){
        $validator = Validator::make($req->all(), [
            'new_password' =>  'required|min:6',
            're_new_password' =>  'required|min:6|same:new_password',           
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $nd = Customer::Where('email', $req->email)->first();
            $nd->password  = encrypt($req->new_password);
            $nd->save();
            return back()->with('messagep', 'you has been update password');
        }
    }

    public function getLogout(){
        // session_destroy();
        \Auth::logout();
        return redirect('register');
    }

  
}
