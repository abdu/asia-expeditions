<?php

use Illuminate\Http\Request;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/user', function (Request $request) {
//     // return $request->user();
//     // echo 'hello';
// });

// Route::get('/user', function (Request $request) {
//     // return $request->user();

//     // return 'Please have a nice day';
//     return User::getUserAll();

// });
Route::resource('/user', 'APIController', [ 'only' => ['index','store','show','update','destroy']]);

// Route::resource('/category', 'HomeController', [ 'only' => ['index','store','show','update','destroy']]);


