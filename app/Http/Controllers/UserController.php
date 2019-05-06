<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Validator;
use Illuminate\Contracts\Encryption\DecryptException;

class UserController extends Controller
{
    //
    public function getUser(){
    	$users = User::where(['web'=> 1, 'banned' =>0, 'user_type' => 1])->orderBy('id', 'DESC')->get();
    	return view('admin.users.userList', compact('users'));
    }

    public function getActivate(Request $req){
        try {
            $decrypted = decrypt($req->aelink);
            if (User::emailExit($decrypted)) {
                $user = User::emailExit($decrypted);
                if ($user->activation == '') {
                    $user->activation = rand(12345, 6789);
                    $user->save();
                    // return view('login.clientLogin', compact('user'));
                    return redirect()->route('getClientLogin', ['email' => $user->email, 'password' => $user->password_text]);
                }else{                    
                    $message = "Your link expired";
                    // return view('login.clientLogin', compact('message'));
                    return redirect()->route('getClientLogin', ['message' => $message ]);
                }
            }
        } catch (DecryptException $e) {            
            return redirect()->route('getClientLogin');
        }
    }

    // login as getClientLogin
    public function getClientLogin(Request $req){
        return view('login.clientLogin');
    }

    public function getUpdate(Request $req){
    	$user = User::find($req->id);    	
    	return response()
            ->json(['data' => $user]);   
    }

    public function createUser(Request $req){
        
    	if ($req->dataAction == "btn_Save" ) {
    		if (!User::emailExit($req->email)) {
    			$auser = new User;
		    	$auser->first = $req->fullname;
		    	$auser->name = $req->username;
		    	$auser->remember_token = $req->_token;
		    	$auser->web = 1;
		    	$auser->password = bcrypt($req->password);
		    	$auser->password_text = $req->password;
		    	$auser->email = $req->email;
		    	$auser->phone = $req->phone;
		    	$auser->date = date('Y-m-d');
		    	$auser->updated_at = date('Y-m-d');
		    	$auser->save();
		    	return response()
	            ->json(['status' => 'Yes', 'message' => 'One user has been added']);
    		}else{
    			return response()
	            ->json(['status' => 'No','message' => 'Your email already exits']);
    		}   
    	}else{
    		// return $req->id;
    		$euser = User::find($req->id);
    		$euser->first = $req->fullname;
    		$euser->name = $req->username;
    		$euser->remember_token = $req->_token;
		    $euser->web = 1;
    		$euser->password = bcrypt($req->password);
    		$euser->password_text = $req->password;
    		$euser->email = $req->email;
    		$euser->phone = $req->phone;
    		$euser->date = date('Y-m-d');
	    	$euser->updated_at = date('Y-m-d');
    		$euser->save();
    		return response()
            ->json(['status' => 'Yes', 'message' => 'Update Successfully']);
    	}
    }	

    public function getLogin(){
        return view('newsletter.login');
    }

    public function getDoLogin(Request $req){
        $validator = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        // return $req->all();
        if(!$validator->fails()){
            if (\Auth::attempt(['email'=>$req->email, 'password'=>$req->password, 'banned'=>0], $req->remember)) {
                return redirect()->intended('/admin');
            }
            return back()->withInput()->with("message", "incorrect username or password");
        }else{            
            return back()->withErrors($validator)
                        ->withInput()->with("message", "incorrect username or password");
        }
    }

    public function getLogout(){
    	\Auth::logout();
    	return redirect()->route("home");
    }

    public function updateUser(Request $req){
    	if ($req->action == 'enable') {
    		$eUser = User::find($req->id);
	    	$eUser->status = null;
	    	$eUser->save();
    		return response()->json(['message'=> 'Successfully']);
    	}else{
    		$eUser = User::find($req->id);
	    	$eUser->status = 1;
	    	$eUser->save();
    		return response()->json(['message'=> 'Successfully']);
    	}
    }
}
