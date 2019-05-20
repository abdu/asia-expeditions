<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CountView;

class ViewerController extends Controller
{
  	public function getviewer(){
   	$views= CountView::getcount_tour();
   	return view('admin.count_view.count_view', compact('views'));
   } 


}
