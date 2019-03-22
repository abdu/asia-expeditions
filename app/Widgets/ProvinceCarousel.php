<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\components\Shared;
class ProvinceCarousel extends AbstractWidget
{
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
  	protected $config = ['province_country' => 0];
    public function run()
    {
        //
        return $this->getProvince($this->config);
    }

    public function getProvince($coun_Id){

    	$get_province = \App\Province::where([['province_country','=', $coun_Id],['web','=',1]])->get();
    	$i = ''; 
    	$item = '';

    	foreach ($get_province as $key => $pro) {
            $intro = ($pro['province_intro'] != '' ? $pro['province_intro'] : null);
            $getpro = \App\Country::where('country_id', $pro['province_country'])->first();
    		$active = ($key == 3 ? 'active' : '');
    		while ($i <= $key) {
        	
            	if ($i % 3 == 0) {
            		$item .='<div class="item '.$active.'">';
            	}
            		$item .='<div class="col-sm-4">
                        <span class="thumbnail text-center">
                            <a class="img-card" href="/destination/'.$getpro['country_slug'].'/'.$pro['slug'].'" title="'.$pro['province_name'].'">
                                <img src="'.Shared::getInstance()->urlResource($pro['province_picture']).'" alt="'.$pro['province_name'].'">
                            </a>                            
                            <h3><a class="text-danger" href="/destination/'.$getpro['country_slug'].'/'.$pro['slug'].'" ><p><b>'.$pro['province_name'].'</b></p></a></h3>
                                <span>'.str_limit($intro,82).'</span>      
                         
                            <hr class="line">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <a style="font-weight:100;" href="/destination/'.$getpro['country_slug'].'/'.$pro['slug'].'" class=" w3-btn w3-white w3-border w3-border-green w3-round-xlarge"> View More</a>
                                </div>      
                             <div class="clear"></div>                          
                            </div>
                        </span>
                    </div>';
               		$i++;

            	if ($i % 3 == 0) {
            		$item .= '</div>';
            	}
            }			   
    	}

    	$data ='
			    <div class="row">
			        <div class="row">
                        <div class="col-md-12">
    			            <div class="col-md-9">
    			                
    			            </div>
    			            <div class="col-md-3">
                                <div class="controls pull-right " style="margin-bottom:5px;">
                                    <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-example"
                                        data-slide="prev"></a>
                                    <a  href="#carousel-example" class="right fa fa-chevron-right btn btn-primary" href="#carousel-example"
                                            data-slide="next"></a>
                                </div>
                            </div>  
                        </div>
			        </div>
			         
			        <div id="carousel-example" class="carousel slide " data-ride="carousel">
			            <div class="carousel-inner">
							'.$item.'				           
			            </div>
			        </div>
			   
			</div>';
		return $data;
    }
}