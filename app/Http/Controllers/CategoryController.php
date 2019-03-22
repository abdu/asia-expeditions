<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Tour;
class CategoryController extends Controller
{ 
    //
    public $category;
    public function __construct(Category $category){ 
    	return $this->category = $category;
    }	

    public function getCategory($catName){
    	$category = Category::where('slug', $catName)->first();
        $catTour = $category->tour;
    	return view('category.index', compact('category', 'catTour'));
    }
}
