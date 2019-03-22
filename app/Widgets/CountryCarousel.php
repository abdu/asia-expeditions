<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\components\Shared;

class CountryCarousel extends AbstractWidget
{
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        return $this->getCountry();
    }

    public function getCountry(){

    	$get_country = \App\Country::where('country_status',1)->get();

    	$i = ''; 
    	$item = '';
    	foreach ($get_country as $key => $coun) {
    		$active = ($key == 3 ? 'active' : '');
    		while ($i <= $key) {
        	
            	if ($i % 3 == 0) {
            		$item .='<div class="item '.$active.'">'.PHP_EOL;
            	}
            		$item .='<div class="col-sm-4">
                        <span class="thumbnail text-center">
                            <a class="img-card" href="/destination/'.$coun['country_slug'].'" >
                                <img src="'.Shared::getIntance()->urlResource($coun['country_photo']).'" alt="'.$coun['country_name'].'">
                            </a>
                            <h3 class="text-danger"> <b>'.$coun['country_name'].' </b></h3>                            
                         
                            <hr class="line">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <a href="/destination/'.$coun['country_slug'].'" class="btn btn-danger right button"> Book Now</a>
                                </div>      
                                                               
                            </div>
                        </span>
                    </div>'.PHP_EOL;
               		$i++;

            	if ($i % 3 == 0) {
            		$item .= '</div>'.PHP_EOL;
            	}
            }			   
    	}


    	$data ='
			    <div class="row">
			        <div class="row">
			            <div class="col-md-9">
			                
			            </div>
			            <div class="col-md-3">
			                <div class="controls pull-right ">
			                    <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-example-generic"
			                        data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-primary" href="#carousel-example-generic"
			                            data-slide="next"></a>
			                </div>
			            </div>
			        </div>
			        <div id="carousel-example-generic" class="carousel slide " data-ride="carousel">
			            <div class="carousel-inner">
							'.$item.'				           
			            </div>
			        </div>
			    </div>
			</div>';
		return $data;
    }
}