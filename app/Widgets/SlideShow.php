<?php



namespace App\Widgets;



use Arrilot\Widgets\AbstractWidget;

use App\components\Shared;



class SlideShow extends AbstractWidget

{

    /**

     * The configuration array.

     *

     * @var array

     */





    protected $config = ['country_id' => 0];



    /**

     * Treat this method as a controller action.

     * Return view() or other content to display.

     */

    public function run()

    {
        return self::getAllSlide($this->config);
    }

    public function getAllSlide($countryId){
        $getSlide = \App\SlideShow::where(['country_id'=> $countryId, 'status'=>1])->orderBy('order', "ASC")->get();
        $data = '';
        foreach ($getSlide as $key=>$slide) {      
            if($slide->photo > 0) {
            $data .='<div> 
                        <img data-u="image" src="'.Shared::getInstance()->urlResourceBig($slide->photo, $slide->user_id).'"/>
                        <div style="position:absolute;top:30px;left:30px;width:95%; text-align:right;height:120px;z-index:0;font-size:35px;color:#034ea2;line-height:60px; text-transform: capitalize;">'.$slide['title'].'</div>
                        <div style="position:absolute;top:214px;left:84px;width:480px;height:120px;z-index:0;font-size:30px;color:#ffffff;line-height:38px;">'.str_limit($slide['intro'],85).'</div>
                    </div>'; 
            }
        }
        return $data;
    }

}

