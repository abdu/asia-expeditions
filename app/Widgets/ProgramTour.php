<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\components\Shared;

class ProgramTour extends AbstractWidget
{
	// $public $tour;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */



    protected $config = ['tour_type' => 0];

    public function run()
    {

		return self::getTourSlide($this->config);
    }


    public function getTourSlide($cat_id ){

    	$getTour = \App\ProgramTour::Where([['tour_type', '=', $cat_id ], ['web','=', 1]])->take(30)->get();
		$i = 0;
	    $item = '';
	    foreach( $getTour  as $key => $tour){
    		$active = ($key < 3 ? 'active' : ''); 
        	while ($i <= $key) {        	
                // if item slide equal to 3 item per slide 
            	if ($i % 3 == 0) {
            		$item .='<div class="item '.$active.'">';
            	}
               
            		$item .='<div class="col-sm-4">
                                <span class="thumbnail text-center">
                                    <a class="img-card" href="/tour/'.$tour->tour_slug.'">
                                        <img src="'.Shared::getInstance()->urlResource($tour['tour_picture']).'" alt="'.$tour['tour_name'].'">
                                    </a>
                                    <h3 class="text-danger"><b>$'.$tour['tour_price'].' </b></h3>
                                    <a href="/tour/'.$tour->tour_slug.'" ><p><b>'.str_limit($tour['tour_name'],32).'</b></p></a>
                                    <p>'.str_limit($tour['tour_desc'],82).'</p>
                                    <hr class="line">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <a href="/tour/'.$tour->tour_slug.'" class=" w3-btn w3-white w3-border w3-border-green w3-round-xlarge"> View Detail</a>
                                        </div>                                          
                                    </div>
                                </span>
                            </div>';
               		$i++;
                // if item slide equal to 3 item  per slide 
            	if ($i % 3 == 0) {
            		$item .= '</div>';
            	}                
            }			   
	    }

		$data ='<div class="row">
                    <div class="row">
			        <div class="col-md-9">
			        </div>
			            <div class="col-md-3">
			                <div class="controls pull-right" style="margin-bottom:5px;">
			                    <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-example-generic"
			                        data-slide="prev"></a>
                                <a class="right fa fa-chevron-right btn btn-primary" href="#carousel-example-generic"
			                         data-slide="next"></a>
			                </div>
			            </div>
			        </div>
                    <div class="row">
                        <div class="row">
        			        <div id="carousel-example-generic" class="carousel slide " data-ride="carousel">
        			            <div class="carousel-inner">
        							'.$item.'				           
        			            </div>
        			        </div>
                        </div>
                    </div>
			    </div>
			</div>';
		return $data;
    }
}