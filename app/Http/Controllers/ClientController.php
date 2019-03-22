<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ClientEmail;
use App\User;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Mail;;

class ClientController extends Controller
{

	public function getCLientList(){
	    $clients = User::where(['banned'=>0, 'user_type'=>3])->orderBy('id', 'DESC')->get();
	    return view('admin.client.clientList', compact('clients'));    
	}

	public function getClientForm(){
		return view('admin.client.clientForm');
	}

	public function createClient(Request $req){
		if (!User::emailExit($req->email)) {
			if ( $req->hasFile('photo') ) {
                $image = $req->file('photo');
                $photo = date('M-Y-d').'-'.time().'.'.$image->getClientOriginalExtension();
                $img = Image::make($image->getRealPath())->fit(110, 190);
                $img->save(public_path('photos/shares/thumbs/'.$photo));
                $image->move(public_path('photos/shares/'), $photo);   
            }else{
            	$photo = '';
            }
			$password = $req->password;
			$auser = new User;
	    	$auser->name = $req->name;
	    	$auser->web = 1;
	    	$auser->password = bcrypt($password);
	    	$auser->password_text = $password;
	    	$auser->email = $req->email;
	    	$auser->phone = $req->phone;
	    	$auser->from = $req->client_from;
	    	$auser->picture = $photo;
	    	$auser->date = date('Y-m-d');	    	
	    	$auser->user_type = 3;
	    	$auser->status = 1;
	    	$auser->descs = $req->descs;
	    	$auser->save();
	    	$data = ['email'=> $req->email, 'password'=> $password];
	    	Mail::to($req->email)->cc(\Auth::user()->email)->send(new ClientEmail($data));
	    	return back()->with('message', 'One client has been added');
		}else{
			return back()->with('message', 'client email exits in the our system');
		}
	}

	public function getEditClient($clientId){
		$client = User::find($clientId);
		return view('admin.client.clientFormEdit', compact('client'));
	}

	public function updateClient(Request $req){
		if ( $req->hasFile('photo') ) {
            $image = $req->file('photo');
            $photo = date('M-Y-d').'-'.time().'.'.$image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath())->fit(100, 90);
            $img->save(public_path('photos/shares/thumbs/'.$photo));
            $image->move(public_path('photos/shares/'), $photo);   
        }else{
        	$photo = $req->old_photo;
        }
		$auser = User::find($req->eid);
    	$auser->name = $req->name;
    	$auser->web = 1;
    	$auser->phone = $req->phone;
    	$auser->from = $req->client_from;
    	$auser->date = date('Y-m-d');	    	
    	$auser->user_type = 3;
    	$auser->status = 1;
    	$auser->picture = $photo;
    	$auser->descs = $req->descs;
    	$auser->save();
    	return back()->with('message', 'One client has been updated');
	}

	public function getClientName(){
		return view('admin.index');
	}

	public function getViewByClientName($clientViewById){
		$client = User::where('id', $clientViewById)->first();
		return view('admin.client.ViewByClientName', compact('client'));
	}
}
