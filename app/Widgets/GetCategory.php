<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class getCategory extends AbstractWidget
{
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */

    public $config = ['category_type' => 'home'];
    public function run()
    {
        //
        return self::getCategory($this->config);
    }

    public function getCategory($catType){
    	$getCat = \App\Category::where('category_type' , $catType)->get();
    	$litem = '';
    	foreach ($getCat as $key => $value) {
    		$litem .='<li><a ng-href="/category/'.$value['category_name'].'">'.$value['category_name'].'</a></li>';
    	}
    	$data = '<ul class="dropdown-menu" role="menu"><li><a ng-href="/mice">M.I.C.E</a></li>'.$litem.'</ul>';
    	return $data;
    }
}