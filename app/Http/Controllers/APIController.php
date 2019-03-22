<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class APIController extends Controller
{
    //
	protected $user = null;

	public function __construct( User $user){
		return $this->user = $user;
	}

    public function index(){
    	$user = $this->user->all();
    	return response()->json($user);
    }

    public function store(Request $request){

    	try {
    		if ($this->user->getExitEmail($request->email)) {
    			
    		return response('Your email is already exit ', 500);
    		}else{
	    		$user = new User([
	    			'name' => $request->name,
	    			'email' => $request->email,
	    			'password' => bcrypt($request->password),
	    		]);
	    		\Log::info('User Stored');
	    		$user->save();
	    		return response()->json(['status' => true, 'Added successfully'], 200);
	    	}
    		
    	} catch (Exception $e) {
    		\Log::critical("Could not stored user{$e->getCode()}, {$getLine()}, {$e->getMessage()}");
    		return response('Somthing bad ', 500);
    	}
    }
    public function show($id){
    	try {    		
    		$user = $this->user->find($id);
    		if (!$user) {
    			return response()->json(['This is not exit'], 404);
    		}
    		return response()->json($user, 200);
	    	
    	} catch (Exception $e) {
    		\Log::critical("Could not stored user{$e->getCode()}, {$getLine()}, {$e->getMessage()}");
    		return response('Somthing bad ', 500);
    	}
    }

    public function update(Request $request, $id){
    	try {    		
    		$user = $this->user->find($id);
    		$user->name = $request->name;
    		$user->email = $request->email;
    		$user->password = $request->password;
    		$user->save();
			return response()->json(['status' => true, 'Update successfully'], 200);
    		if (!$user) {
    			return response()->json(['This is not exit'], 404);
    		}    		
	    	
    	} catch (Exception $e) {
    		\Log::critical("Could not stored user{$e->getCode()}, {$getLine()}, {$e->getMessage()}");
    		return response('Somthing bad ', 500);
    	}
    }

    public function destroy($id){
    	try {    		
    		$user = $this->user->find($id);
    		if (!$user) {
    			return response()->json(['This is not exit'], 404);
    		}
    		$user->delete();
    		return response()->json('User deleted', 200);
	    	
    	} catch (Exception $e) {    		
    		\Log::critical('Could not stored user{$e->getCode()}, {$getLine()}, {$e->getMessage()}');
    		return response('Somthing bad ', 500);
    	}
    }
}
