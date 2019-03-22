<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class HolidayType extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = ['web' => 'yes'];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        
        // return view("widgets.holiday_type", [
        //     'config' => $this->config,
        // ]);
        return self::getCategory($this->config);
    }
    public function getCategory($catType){
        $getCat = \App\HolidayType::where('web' , $catType)->orderBy('name', 'ASC')->get();
        $litem = '';
        foreach ($getCat as $key => $value) {
            $litem .='<li><a href="/category/'.$value['slug'].'">'.$value['name'].'</a></li>';
        }
        $data = '<ul class="dropdown-menu" role="menu"><li><a href="/mice">M.I.C.E</a></li>'.$litem.'</ul>';
        return $data;
    }
}