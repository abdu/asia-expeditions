<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class Province extends AbstractWidget

{
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    protected $config = ['province_country' => 30 ];
    // protected $config = ['tbl_slide_country' => 0];

    public function run()
    {
        //
        return self::getProvince($this->config);
    }

    public function getProvince($countryId){
    $getPro = \App\Province::where([['province_country', '=', $countryId ],['province_status','=', 1], ['web', '=', 'yes']])->get();
    	$data = '';
    	foreach ($getPro as $key => $pro) {
    		$data .= '<li style="padding:2px 0px;"><a ng-href="#"> <i class="fa fa-arrow-circle-right"></i>&nbsp;&nbsp;'.$pro['province_name'].'</a></li>';
					
    	}

    	$all_data = '<ul class="list-unstyled">
						'.$data.'
				</ul>';
		return $all_data;
    }


}