<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\components\Shared;
class Experience extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = ['tour_type' => 0];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {

        return self::getExperience($this->config);
    }

    public function getExperience($cat_id){
    $getTour = \App\Tour::Where([['tour_type', '=', $cat_id ], ['web','=', 1]])->take(30)->get();
        $i = 0;
        $item = null;
        foreach( $getTour  as $key => $tour){
            $active = ($key < 3 ? 'active' : ''); 
            while ($i <= $key) {   
                // if item slide equal to 3 item per slide 
                if ($i % 3 == 0) {
                    $item .='<div class="item '.$active.'">';
                }               
                    $item .='<div class="col-sm-4">
                                <span class="thumbnail text-center">
                                    <a class="img-card" href="/tour/'.encrypt($tour['tour_id']).'">
                                        <img src="'.Shared::getInstance()->urlResource($tour['tour_picture']).'" alt="'.$tour['tour_name'].'">
                                    </a>
                                    <h3 class="text-danger"><b>$'.$tour['tour_price'].' </b></h3>
                                    <a href="/tour/'.encrypt($tour['tour_id']).'" >
                                        <p><b>'.str_limit($tour['tour_name'],32).'</b></p>
                                    </a>
                                    <p>'.str_limit($tour['tour_desc'],92).'</p>
                                    <hr class="line">
                                    <div class="row">                                      
                                        <div class="col-md-12 col-sm-12">
                                            <a style=" font-weight: 100;" href="/tour/'.encrypt($tour['tour_id']).'" class="w3-btn w3-white w3-border w3-border-green w3-round-xlarge"> View Detail </a>
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
                                <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-example"
                                    data-slide="prev"></a>
                                <a class="right fa fa-chevron-right btn btn-primary" href="#carousel-example"
                                     data-slide="next"></a>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="row">
                        <div id="carousel-example" class="carousel slide " data-ride="carousel">
                            <div class="carousel-inner">
                                '.$item.'                          
                            <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                     <div class="clear"></div>
                </div>
            </div>';
        return $data;
    }
}